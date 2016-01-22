<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 14-11-10
 * Time: 下午3:41
 */

class TenpayFeeCardCommand extends CConsoleCommand{
    public function run($args)
    {
        $errorCode = TenpayHelper::getTenpayErrorCode();
        $records = TenpayRecord::getNeedDealFeeCardTenpays();
        foreach($records as $record){
            if($record->paystate==0){//尚未调用代付提交接口则发起调用请求
                
                //转码问题导致无法调用提交接口的数据处理
                // $delay = time()-strtotime($record->updatetime);
                // $delaymin= (int)(($delay%(3600*24))/(60));
                // if($record->creationtime==$record->updatetime && $delaymin>60){
                //     $record->state = 2;
                //     $record->payreqcount = 3;
                //     $record->save();
                //     continue;
                // }

                //调用代付提交接口收到财付通返回状态（0：失败，1：成功）并更改状态
                $recordsArr = $record->setTenpayDetailsToRecords();
                $paystate = TenpayHelper::payTransfer($record,$recordsArr);
                if(in_array($paystate, $errorCode)){//调用失败
                    $errorcount = $record->payreqcount + 1;
                    if($errorcount>=3){
                        $record->state = 2;
                    }
                    $record->payreqcount += 1;
                    $record->save();
                }else{//调用成功，超时或无响应等
                    $record->paystate = 1;
                    $record->save();
                }

            }else{//调用代付提交接口成功则调用代付查询接口返回银行代付的处理结果
                $result = TenpayHelper::queryTransfer($record->package);
                if($result=='03020165'){//查询不到该批次号，则重新提交整个批次
                    $record->paystate = 0;
                    $record->payreqcount = 0;
                    $record->save();
                    continue;
                }
                if($result){//查询接口返回银行代付的处理结果成功
                    $data = TenpayHelper::xml_to_array($result['result']);
                    //只有返回最终态才设置批次状态（4，6，7）
                    $record->tradestate = $data['trade_state'];
                    $record->succount = $data['succ_count'];
                    $record->succfee = $data['succ_fee'];
                    $record->failcount = $data['fail_count'];
                    $record->failfee = $data['fail_fee'];

                    if($data['trade_state']==6){//银行处理完成（最终态）
                        $record->setTenpayQueryResult($data);
                        $record->state = 1;
                        $record->save();
                    }elseif($data['trade_state']==4 || $data['trade_state']==7){//整个批次都是失败（最终态）
                        $record->setTenpayQueryResult($data);
                        $record->state = 3;
                        $record->save();
                    }else{//处理中（中间态）
                        $record->setTenpayQueryResult($data);
                    }
                }else{//查询接口返回银行代付的处理结果失败
                    $record->queryfailtime = date("Y-m-d H:i:s",time());
                    $record->save();
                }
            }
        }
    }
}
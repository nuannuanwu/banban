<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 14-11-10
 * Time: 下午3:41
 */

class RollbackCommand extends CConsoleCommand{
    public function run($args)
    {
        //银行流程转出失败回滚发短信
        $details = TenpayDetail::getNeedRollbackDetails();
        foreach($details as $detail){
            //提款回滚
            $rollback = JceHelper::transferClassFeeRollBack($detail->cid,$detail->ordernum,$detail->payamt,$detail->userid);
            if($rollback){
                $detail->rollbackstate = 0;
                $detail->state = 4;
                $detail->save();
                if( is_object($detail->parent) ){
                    $detail->parent->state = 3;
                    $detail->parent->save();
                }
                //短信通知
                $mobile = $detail->recmobile;
                $errmsg = $detail->errmsg ? '（'.$detail->errmsg.'）' : '';
                $outMoney = sprintf('%0.2f', $detail->payamt/100);
                $msg = '尊敬的班班用户您好，您转出班费'. $outMoney .'元失败'.$errmsg.'，请尝试重新转出！';
                UCQuery::sendMobileMsg($mobile,$msg,Constant::SMS_CLASSFEE_ROLLOUT);
                $detail->issendmsg = 1;
                $detail->save();
            }
            
        }
        
        //三次调用失败回滚发短信
        $details = TenpayDetail::getNeedRollbackDetailsByThreeFail();
        foreach($details as $detail){
            //提款回滚
            $rollback = JceHelper::transferClassFeeRollBack($detail->cid,$detail->ordernum,$detail->payamt,$detail->userid);
            if($rollback){
                $detail->state = 4;
                $detail->save();
                if( is_object($detail->parent) ){
                    $detail->parent->tradestate = 99; //三次失败的最终态
                    $detail->parent->state = 3;
                    $detail->parent->save();
                }
                //短信通知
                $mobile = $detail->recmobile;
                $outMoney = sprintf('%0.2f', $detail->payamt/100);
                $msg = '尊敬的班班用户您好，您转出班费'. $outMoney .'元失败，请尝试重新转出！';
                UCQuery::sendMobileMsg($mobile,$msg,Constant::SMS_CLASSFEE_ROLLOUT);
                $detail->issendmsg = 1;
                $detail->save();
            }   
        }

        //审核不通过回滚发短信
        $details = TenpayDetail::getVerifyFail();
        foreach($details as $detail){
            //提款回滚
            $rollback = JceHelper::transferClassFeeRollBack($detail->cid,$detail->ordernum,$detail->payamt,$detail->userid);
            if($rollback){
                $detail->state = 4;
                $detail->save();
                if( is_object($detail->parent) ){
                    $detail->parent->tradestate = 98; //审核未通过
                    $detail->parent->state = 3;
                    $detail->parent->save();

                    $detail->rollbackstate = 0;
                    $detail->save();
                }
                //短信通知
                $mobile = $detail->recmobile;
                $outMoney = sprintf('%0.2f', $detail->payamt/100);
                $verify = TenpayVerify::model()->findByAttributes(array('package' => $detail->package));
                $msg = '亲爱的老师，由于' . $verify->reason . '，班费转出申请未通过。如有疑问，请联系班班客服QQ：1919036624。';
                UCQuery::sendMobileMsg($mobile,$msg,Constant::SMS_CLASSFEE_ROLLOUT);
                $detail->issendmsg = 1;
                $detail->save();
            }   
        }
    }
}
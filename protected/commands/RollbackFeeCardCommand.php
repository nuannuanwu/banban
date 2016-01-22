<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 14-11-10
 * Time: 下午3:41
 */

class RollbackFeeCardCommand extends CConsoleCommand{
    public function run($args)
    {
        //银行流程转出失败回滚发短信
        $details = TenpayDetail::getFeeCardNeedRollbackDetails();
        foreach($details as $detail){
            //提款回滚
            $rollback = JceHelper::transferClassFeeCardRollBack($detail->ordernum,$detail->payamt,$detail->userid);
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
                $msg = '尊敬的班班用户您好，您转出班费卡'. $outMoney .'元失败'.$errmsg.'，请尝试重新转出！';
                UCQuery::sendMobileMsg($mobile,$msg,Constant::SMS_CLASSFEE_ROLLOUT);
                $detail->issendmsg = 1;
                $detail->save();
            }
            
        }
        
        //三次调用失败回滚发短信
        $details = TenpayDetail::getFeeCardNeedRollbackDetailsByThreeFail();
        foreach($details as $detail){
            //提款回滚
            $rollback = JceHelper::transferClassFeeCardRollBack($detail->ordernum,$detail->payamt,$detail->userid);
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
                $msg = '尊敬的班班用户您好，您转出班费卡'. $outMoney .'元失败，请尝试重新转出！';
                UCQuery::sendMobileMsg($mobile,$msg,Constant::SMS_CLASSFEE_ROLLOUT);
                $detail->issendmsg = 1;
                $detail->save();
            }   
        }
    }
}
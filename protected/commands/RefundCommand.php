<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 14-11-10
 * Time: 下午3:41
 */

class RefundCommand extends CConsoleCommand{
    public function run($args)
    {
        $result = TenpayHelper::refundTransfer();
        if($result){
            $refunds = TenpayHelper::xml_to_array($result['cancel_set']);
            $refunds_count = $result['cancel_count'];
        }else{
            $refunds = array('cancel_count'=>0,'cancel_rec'=>array());
            $refunds_count = 0;
        }

        $refunds_rec = $refunds_count>1?$refunds['cancel_rec']:array($refunds['cancel_rec']);

        foreach($refunds_rec as $refund){
            $package = isset($refund['package_id'])?$refund['package_id']:'';
            $serial = isset($refund['serial'])?$refund['serial']:'';
            $detail = TenpayDetail::getTenpayDetailByAttrs($package,$serial);
            if($detail && $detail->package && $detail->state==3 && $detail->refund==0){
                $detail->state = 4;
                $detail->refund = 1;
                if($detail->save()){
                    //提款回滚
                    $title = '班费';
                    if($detail->transtype==0){
                        $rollback = JceHelper::transferClassFeeRollBack($detail->cid,$detail->ordernum,$detail->payamt,$detail->userid);
                    }else{
                        $rollback = JceHelper::transferClassFeeCardRollBack($detail->ordernum,$detail->payamt,$detail->userid);
                        $title = '班费卡';
                    }
                    
                    if($rollback){
                        //短信通知
                        $mobile = $detail->recmobile;
                        $outMoney = sprintf('%0.2f', $detail->payamt/100);
                        $outDate = date('Y年m月d号',strtotime($detail->modifytime));
                        // $msg = '尊敬的班班用户您好，非常抱歉的通知您，您于'.$outDate.'成功转出的'.$outMoney.'元'.$title.'，由于银行方面原因，已从银行账户退回至'.$title.'中，如有需要请重新转出'.$title.'。带来不便敬请谅解！如有疑问咨询4001013838。';
                        $msg = '尊敬的班班用户您好，非常抱歉的通知您，由于银行方面原因，您于'.$outDate.'提交转出的'.$outMoney.'元'.$title.'，已从银行账户退回至'.$title.'中，如有需要请重新提交转出。带来不便敬请谅解！如有疑问咨询4001013838。';
                        UCQuery::sendMobileMsg($mobile,$msg,Constant::SMS_CLASSFEE_ROLLOUT);
                    }else{
                        $detail->state = 3;
                        $detail->refund = 0;
                        $detail->save();
                    }
                }
            }
        }
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 14-11-10
 * Time: 下午3:41
 */

class TenpaySendCommand extends CConsoleCommand{
    public function run($args)
    {
        //error_reporting = E_ALL & ~E_DEPRECATED & ~E_STRICT
        error_reporting(E_ALL & ~E_DEPRECATED & ~E_STRICT);
        $details = TenpayDetail::getNeedSendNotice();
       // D($details);
        //给班级成员发班费转出成功通知
        foreach($details as $detailNotice){
            //$feeInfoArr = JceHelper::getClassFeeInfo(array($detailNotice->cid));
          //  D($feeInfoArr);
            TenpayRecord::sendClassNoticeByRedis($detailNotice);
            $detailNotice->issendnotice = 1;
            $detailNotice->save();
        }

        //给班主任发送班费转出成功短信
        $details = TenpayDetail::getNeedSendMsg();
        foreach($details as $detail){
            $mobile = $detail->recmobile;
            $outMoney = sprintf('%0.2f', $detail->payamt/100);
            $msg = '尊敬的班班用户您好，您成功转出班费'. $outMoney .'元，班费已转账到您尾号为'.substr($detail->bankacc, -4).'的银行卡中。';
            UCQuery::sendMobileMsg($mobile,$msg,Constant::SMS_CLASSFEE_ROLLOUT);
            $detail->issendmsg = 1;
            $detail->save();
        }
    }
}
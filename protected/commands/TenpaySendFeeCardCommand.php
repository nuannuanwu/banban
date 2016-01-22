<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 14-11-10
 * Time: 下午3:41
 */

class TenpaySendFeeCardCommand extends CConsoleCommand{
    public function run($args)
    {
        error_reporting(E_ALL & ~E_DEPRECATED & ~E_STRICT);
        // $details = TenpayDetail::getFeeCardNeedSendNotice();
        // //给用户发班费转出成功通知
        // foreach($details as $detailNotice){
        //     TenpayRecord::sendClassNoticeByRedis($detailNotice);
        //     $detailNotice->issendnotice = 1;
        //     $detailNotice->save();
        // }

        //给班主任发送班费转出成功短信
        $details = TenpayDetail::getFeeCardNeedSendMsg();
        foreach($details as $detail){
            $mobile = $detail->recmobile;
            $outMoney = sprintf('%0.2f', $detail->payamt/100);
            $msg = '尊敬的班班用户您好，您成功转出班费卡'. $outMoney .'元到您尾号为'.substr($detail->bankacc, -4).'的银行卡中。';
            UCQuery::sendMobileMsg($mobile,$msg,Constant::SMS_CLASSFEE_ROLLOUT);
            $detail->issendmsg = 1;
            $detail->save();
        }
    }
}
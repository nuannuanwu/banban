<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 14-9-5
 * Time: 上午11:08
 */

class NoticeSmsMonitorCommand extends CConsoleCommand
{
    public function run($args)
    {
        $sendtime = date('Y-m-d H:i:s',time());
        $user = Member::getUniqueMember('18948750132');
        $userid = $user->userid;
        $sql = "INSERT INTO xiaoxin.`tb_notice` ( `sender`, `sendertitle`, `receiver`, `receivertitle`, `noticetype`, `content`, `sendtime`, `cid`, `issendsms`, `state`, `creationtime`, `updatetime`, `deleted`, `sid`, `schoolname`, `receivename`, `evaluatetype`, `nfid`, `platform`, `readers`) VALUES('101','班班官方团队','{\"5\":\"".$userid."\"}','xxx','0','{\"content\":\"每天下午7点半给自己发送一条通知并发送短信，用来监控通知发送程序。\"}','".$sendtime."', NULL,'1','0','".$sendtime."','".$sendtime."','0','360501','通知短信监测','给自己','0',NULL,'0','0');";
        NoticeQuery::execute($sql);
    }
}
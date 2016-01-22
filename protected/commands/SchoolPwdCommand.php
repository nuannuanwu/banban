<?php
/**
* panrj 2014-12-08
* 通知类青豆日志
*/

class SchoolPwdCommand extends CConsoleCommand{

    public function run($args)
    {
        $sid = 29201;
        if(count($args)){
            $sid = $args[0];
        }
        // $update_sql = "UPDATE tb_user SET pwd='6a3b95736feff7a1c93a2e01a9336f27' WHERE deleted=0 AND mobilephone IN (SELECT mobile FROM tmp_import)";
        $sql = "SELECT mobile FROM tmp_import";
        $mobiles = UCQuery::queryColumn($sql);
        // print_r($mobiles);exit;

        foreach($mobiles as $mobile){
            $msg = '你好！松泉学校邀请家长使用免费班班（http://www.banban.im）平台接收学校发送的通知消息,手机端点击（http://t.cn/RwU3di3） 即可下载安装。您的账号:['.$mobile.']，密码:[465141]。客服电话:4001013838，工作时间:08:00-20:00';
            UCQuery::sendMobileMsg($mobile,$msg,99);
        }
        
    }
}
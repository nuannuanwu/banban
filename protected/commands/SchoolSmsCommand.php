<?php
/**
 * 紧急通知短信充值和应用消息相关
 * 每个月赠送的短信未使用的清零，然后根据上个月学生月活跃情况，赠送本月的短信数量。赠送完自动发送应用内消息。
 * panrj 2015-05-27
 */

class SchoolSmsCommand extends CConsoleCommand{
    public function run($args)
    {
        $month = date('Y-m', strtotime('-1 month'));
        $monthNum = date('n', strtotime('-1 month'));
        $cruMonthNum = date('n', time());
        $schools=SchoolSmsLog::getUnFirstMonthSchools();
        foreach($schools as $school){
            $isGiven = SchoolSmsLog::checkSchoolSmsReset($school->sid);//是否已经处理过
            if($isGiven===null){
                $activeNum = 0;
                // 统计学生数量
                $sql = "SELECT GROUP_CONCAT(g.guardian) guardian FROM tb_class_student_relation r,tb_class c,tb_user u,tb_guardian g WHERE r.deleted=0 AND u.deleted=0 AND c.deleted=0 AND r.student=u.userid AND g.deleted=0 AND g.state=1 AND r.student=g.child AND r.cid=c.cid AND c.sid=".$school->sid." AND r.state=1 GROUP BY g.child";
                $guardians = UCQuery::queryColumn($sql);
                foreach($guardians as $g){
                    $gu = explode(',', $g);
                    $is_active = WebsiteView::getStudentActive($gu,$month);
                    if($is_active>0){
                        $activeNum += 1;
                    }
                }
                $school_teachers = SchoolTeacherRelation::getSchoolSmsauthTeachers($school->sid);//查询具有发送紧急通知权限学校老师
                $transaction = Yii::app()->db_member->beginTransaction();
                try{
                    $smsnumOld = $school->smsnum;//上月剩余赠送短信
                    $smsleft = $school->smsnum + $school->buysms;
                    $usql = "SELECT SUM(num) AS used FROM tb_school_sms_log  WHERE DATE_FORMAT(creationtime,'%Y-%m')='".$month."' AND smstype IN (2,4) AND sid=".$school->sid;
                    $usedNum = UCQuery::queryScalar($usql);//上月使用的短信
                    // 赠送短信并且记录日志
                    $num = $activeNum*3;//本月要赠送的短信
                    $school->smsnum = $num;
                    $resetlog = new SchoolSmsLog;
                    $resetlog->sid = $school->sid;
                    $resetlog->smstype=5;
                    $resetlog->num = $smsnumOld;
                    $resetlog->creator = 101;
                    $log = new SchoolSmsLog;
                    $log->sid = $school->sid;
                    $log->smstype=0;
                    $log->num = $num;
                    $log->creator = 101;
                    if($school->save() && $resetlog->save() && $log->save()){
                        $transaction->commit();
                        $content = $smsnumOld?'已清零':'已全部用完';
                        $msg = $school->name."：您好！贵校".$monthNum."月份共使用“紧急通知”短信（免费及付费）".$usedNum."条，剩余".$smsleft."条。".$monthNum."月份‘班班官方’赠送给贵校的免费短信，尚余".$smsnumOld."条还未使用，".$content."。同时，根据".$monthNum."月份贵校使用班班的活跃学生数量（".$activeNum."人），特赠送".$cruMonthNum."月份免费短信".$num."条，做为校内紧急情况的短信通知。感谢您的支持与关注。如有疑问，请咨询电话4001013838。";
                        foreach($school_teachers as $st){//给每个具有权限的老师发送短信
                            UCQuery::sendMobileMsg($st->teacher0->mobilephone,$msg,Constant::SMS_SYS);
                        }
                    }else{
                        $transaction->rollback();
                    }
                    
                }catch (Exception $e) {
                    $transaction->rollback();
                }
            }
        }
    }
}
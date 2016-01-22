<?php
/**
 * 紧急通知短信充值和应用消息相关
 * 首月赠送短信。赠送完自动发送应用内消息。
 * panrj 2015-05-23
 */

class FirstMonthSmsCommand extends CConsoleCommand{
    public function run($args)
    {
        $schools=SchoolSmsLog::getFirstMonthSchools();

        foreach($schools as $school){
            $isGiven = SchoolSmsLog::model()->findByAttributes(array('smstype'=>3,'sid'=>$school->sid));//是否已经赠送过
            if($isGiven===null){
                // 统计学生数量
                $sql = "SELECT DISTINCT r.student FROM tb_class_student_relation r,tb_class c,tb_user u WHERE r.deleted=0 AND u.deleted=0 AND c.deleted=0 AND r.student=u.userid AND r.cid=c.cid AND c.sid=".$school->sid." AND r.state=1";
                $students = UCQuery::queryColumn($sql);
                $stunum = count($students);
                if(count($students)>0){
                    $school_teachers = SchoolTeacherRelation::getSchoolSmsauthTeachers($school->sid);//查询具有发送紧急通知权限学校老师
                    $transaction = Yii::app()->db_member->beginTransaction();
                    try{
                        // 赠送短信并且记录日志
                        $num = $stunum*3;
                        $school->smsnum = $num;
                        $log = new SchoolSmsLog;
                        $log->sid = $school->sid;
                        $log->smstype=3;
                        $log->num = $num;
                        $log->creator = 101;
                        if($school->save() && $log->save()){
                            $transaction->commit();
                            $msg = $school->name.'：您好！为感谢贵校使用班班平台“紧急通知”功能，首月根据贵校实际学生人数（'.$stunum.'人）免费赠送短信'.$num.'条，做为校内紧急情况的短信通知。感谢您的支持与关注。如有疑问，请咨询电话4001013838。';
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
}
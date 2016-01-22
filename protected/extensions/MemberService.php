<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 14-11-21
 * Time: 下午1:42
 */


class MemberService
{
    /*
    * 根据手机号,学生姓名，添加学生
    * $$issendinvite 是否发送邀请 1,发， 0－－不发
     * $desc 邀请的欢迎信息
     * $userinfo 发送者信息
     * $front 前台还是后台,前台与后台处理方式有点不一样
    * 返回学生id及要发送密码的数组
    */
    public static function addStudentByMobileAndName($mobile, $name, $cid, $role = '家长', $classInfo=null,$studentid='')
    {
        return Member::addStudentByMobileAndName($mobile, $name, $cid, $role,$classInfo,$studentid);
    }

    
       /*
    * 根据手机号,学生姓名，添加老师
    *  $issendinvite 是否发送邀请 1,发， 0－－不发
    * $desc 邀请的欢迎信息
    * $userinfo 发送者信息
    * $front 前台还是后台,前台与后台处理方式有点不一样
    * 返回学生id及要发送密码的数组
    */
    public static function addTeacherByMobileAndName($mobile, $name, $cid, $role = '老师', $classInfo=null)
    {
        return  Member::addTeacherByMobileAndName($mobile, $name, $cid, $role, $classInfo);

    }

    /*
     * 第三方获根据第三方的userid,areaid获取用
     * 户数据　
     */
    public static function getThreeMemberInfo($areaid, $threeuserid){
        $member=Member::model()->findByAttributes(array('threeareaid'=>$areaid,'deleted'=>0,'threeuserid'=>$threeuserid));
        if($member){
            $arr=$member;
        }else{
            $arr=array();
        }
        return $arr;
    }

    /*
    * 第三方注册　
    * $areaid 区域id
    * $threeuserid  第三方id
    * $name 用户姓名
    * $mobilephone 用户手机号
    */
    public static function setThreeMemberInfo($areaid, $threeuserid, $name, $mobilephone, $sex=0){
        $memberEntity = Member::model()->findByAttributes(array('mobilephone'=>$mobilephone,'deleted'=>0));
        if(!$memberEntity){
            $uid = UCQuery::makeMaxId(0, true);
            $member = new Member;
            $member->userid = $uid;
            $member->name =$name?$name:'three';
            $member->sex =(int)$sex;
            $member->account = "l" . $uid; //第三方用户前加l;
            $password = MainHelper::generate_code(6);
            $member->pwd = MainHelper::encryPassword($password);
            $member->mobilephone =$mobilephone;
            $member->identity = Constant::TEACHER_IDENTITY; //老师标志;
            $member->state = 1;
            $member->active  = 1;        // 1值为web激活
            $member->issendpwd = 0;
            $member->createtype =1;
            $member->threeuserid = $threeuserid;
            $member->threeareaid = $areaid;
            if($member->save()){
                $str = sprintf(Constant::getPublicSendPwdSms(), $member->mobilephone,$password);
                UCQuery::sendMobileMsg($member->mobilephone, $str);
                return $uid;    // 第三方登陆需要用户id
            }else{
                return false;
            }
        }else{
            $oldidentity = $memberEntity->identity;
            $newIdentity=Member::transIdentity(Constant::TEACHER_IDENTITY,$oldidentity);
            $memberEntity->state = 1;
            $memberEntity->identity = $newIdentity;
            $memberEntity->threeuserid = $threeuserid;
            $memberEntity->threeareaid = $areaid;
            $memberEntity->save();
            return $memberEntity->userid;
        }
    }

} 
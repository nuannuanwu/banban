<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 14-10-31
 * Time: 下午2:18
 */

class NoticeService
{
    /*
     * 根据用户id,查找用户的职务，再根据职务，查出登录用户有哪些日常功能(app)可以使用
     */
    public static function getAppByUid($uid, $returnArray = true)
    {
        $schoolTeachers = SchoolTeacherRelation::getTeachersSchoolRaletion($uid);
        $dutys = array();
        foreach ($schoolTeachers as $val) {
            if ($val->duty) {
                $dutys[] = $val->duty;
            }
        }
        $appArr = array();
        if (count($dutys)) {
            $appids = DutyApplicationRelation::getDutyAppIdArr($dutys);
            $appArr = Application::getAppsByIds($appids);
            $arr = array();
            if ($returnArray) {
                foreach ($appArr as $kval) {
                    $arr[] = array('appid' => $kval->appid, 'icon' => $kval->icon, 'url' => $kval->url, 'name' => $kval->name, 'desc' => $kval->desc);
                }
                return $arr;
            }
        }
        return $appArr;
    }

    /*
     * 传用户id,sid,获取班级
     * 如果对学校所有班级都有权限，则返回学校所有班级  tb_duty表 isseeallclass字段
     * 如果对年级所有班级都有权限，所回该年级所有班级
     * 否则返回我的所有班级
     * $backend =1代表后台管理员操作时，选学校所有班级
     */
    public static function getClassBySidUid($sid, $uid,$backend=0)
    {
        return ClassTeacherRelation::getDutyClassByTeacher($sid,$uid,true);
    }

    /*
     * 成绩管理时处理
    * 传用户id,sid,获取班级
    * 如果对学校所有班级都有权限，则返回学校所有班级  tb_duty表 isseeallclass字段
    * 如果对年级所有班级都有权限，所回该年级所有班级
    * 否则返回我的所有班级
    */
    public static function getExamClassBySidUid($sid, $uid)
    {
        $classs = ClassTeacherRelation::getDutyClassByTeacher($sid,$uid);
        return $classs;
    }
    /*
     * 判断老师在一个学校里是否有某个appid权限
     */
    public static function checkMonitorRight($sid,$uid,$appid){
        $isRight=false;

        $teacher=SchoolTeacherRelation::getSchoolTeachersRelation(array('sid'=>$sid,'teacher'=>$uid));

        if($teacher&&$teacher->duty){
            $isExists=DutyApplicationRelation::getDutyApplication($teacher->duty,$appid);
            if($isExists){
                $isRight=true;
            }
        }
        return $isRight;
    }

    /*
     *查年级主任权限时，合并年级主任的任教班级，去重班级处理
     */
    public static function isInClass($cid,$result){
        $isExists=false;
        foreach($result as $val){
            if($val['cid']==$cid){
                $isExists=true;
                break;
            }
        }
        return $isExists;
    }
    /*
    *查年级主任权限时，合并年级主任的任教班级，去重班级处理
    */
    public static function isInClassObject($cid,$result){
        $isExists=false;
        foreach($result as $val){
            if($val->cid==$cid){
                $isExists=true;
                break;
            }
        }
        return $isExists;
    }

    /*
     * 要用登录用户id,appid获取学校列表
     */
    public static function getMySchool($uid,$appid){
        $schoolList=array();
        $temp = UCQuery::getTeacherSchool($uid); //我的学校列表
        foreach ($temp as $k => $v) { //我每个学校下面的班级
            if(NoticeService::checkMonitorRight($v['sid'],$uid,$appid)){
                $schoolList[]=$v;
            }
        }
        return $schoolList;
    }

    /**
     * 查询所有属于我的班级
     * $teacher 老师的userid
     */
    public static function getMyClasses($teacher){
        $result = array();
        $classList = ClassTeacherRelation::getTeacherClassRelationByTeacher($teacher);
        $cids=array();
        $cidperson=array();
        $sids = array();
        foreach($classList as $val){
            if(!in_array($val->cid,$cids)){   //老师班级关系表中会有重复数据，去重
                if(!in_array($val->c->sid,$sids)){
                    $sids[]=$val->c->sid;
                }
                $cids[]=$val->cid;
                $ciddata=array('sid'=>$val->c->sid,'name'=>$val->c->name,'cid'=>$val->cid);
                $ciddata['students']=ClassStudentRelation::getClassStudents($val->cid);
                if(!empty($ciddata['students'])){
                    $cidperson[]=$ciddata;
                }
            }
        }
        $result['sids'] = $sids;  //返回所有我所在学校的学校id
        $result['cids'] = $cids;  //返回所有我所在的班级的班级id
        $result['cidperson'] = $cidperson; //返回所有我所在班级的详情
        return $result;

    }
    //获取收件箱未读条数
    public  static  function getNoreadnum(){
       // return 0;
        $uid = Yii::app()->user->id;
        $notice=JceHelper::getNoticeMsg(0,$uid,Constant::DIRECTION_FORCE,$uid);
        if(isset($notice['count'])){
            return $notice['count'];
        }else{
            return 0;
        }



    }
} 
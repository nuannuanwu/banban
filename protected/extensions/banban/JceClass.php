<?php
/**
* @author panrj 2015-01-08 
* JCE辅助类，提供班级常用方法
*/

class JceClass extends JceUser
{
	const NEW_AUDIT_HINT_COUNT = 'new_audit_hint_count';	// memcache key 最新审核消息列表 默认第一个 数
	const NEW_AUDIT_HINT_CLICK = 'new_audit_hint_click';	// memcache key 是否点击过审核消息列表
	
    /**
     * 申请教师认证
     * @param  string $uid 用户ID
     * @param  string $pic 认证照片url
     * @return boolean
     */
    public static function applyAuthTeacher($uid='',$pic='')
    {
        $inner_out = '';
        $inner = new TReqApplyAuthTeacher;
        $inner->uid->val = $uid;
        $inner->pic->val = $pic;
        
        $inner->writeTo($inner_out,0);
        
        $_out = self::writeToHttpPackage(ECMD_APPLY_AUTH_TEACHER,$inner_out,$uid);
        $response = self::readFromHttpPackage(APOLLO_CLASS_INFO,$_out);
        //mlog($response);
        if($response->iResult->val==0){
            return true;
        }
        return false;
    }

    /**
     * 创建班级
     * @param  string $name 班级名称
     * @return TClassCardInfo|boolean
     */
	public static function createClass($name='')
    {
        $inner_out = '';
        $inner = new TReqCreateClass;
        $inner->name->val = $name;
        
        $inner->writeTo($inner_out,0);
        
        $_out = self::writeToHttpPackage(ECMD_CREATE_CLASS,$inner_out);
        $response = self::readFromHttpPackage(APOLLO_CLASS_INFO,$_out);
        if($response->iResult->val==0){
            $res = new TRespCreateClass;
            $res->readFrom($response->vecData->get_val(),0);
            $info = $res->classCard;

            return $info;
        }
        return $response->iResult->val;
    }

    /**
     * 班级代码或班主任手机号查询班级
     * @param  string  $content 班级代码或班主任手机号
     * @param  integer $type     要查找的方式：1以班级代码方式查找, 2以班主任手机号号的方式查找
     * @return TRespSearchClass | boolean
     */
    public static function searchClass($content,$type)
    {
        $inner_out = '';
        $inner = new TReqSearchClass;
        $inner->content->val = $content;
        $inner->type->val = $type;
        
        $inner->writeTo($inner_out,0);
        
        $_out = self::writeToHttpPackage(ECMD_SEARCH_CLASS,$inner_out);
        $response = self::readFromHttpPackage(APOLLO_CLASS_INFO,$_out);
        // var_dump($response);
        if($response->iResult->val==0){
            $res = new TRespSearchClass;
            $res->readFrom($response->vecData->get_val(),0);
            return $res->vecClass->get_val();
        }
        return false;
    }

    /**
     * 加入班级
     * @param  integer $cid  要加入的班级id
     * @param  integer $uid  家长或者老师用户uid
     * @param  integer $type 加入方式：1以学生家长方式加入，2以任课老师方式加入
     * @param  string  $code 要加入的班级代码
     * @param  array   $info 学生家长或老师信息
     * @return integer       
     */
    public static function joinClass($cid=0,$uid=0,$type=1,$code='',$info=array())
    {
        $inner_out = '';
        $inner = new TReqJoinClass;
        $inner->cid->val = $cid;
        $inner->uid->val = $uid;
        $inner->type->val = $type;
        $inner->classCode->val = $code;
        $inner->studentName->val = isset($info['studentName'])?$info['studentName']:'';
        $inner->relation->val = isset($info['relation'])?$info['relation']:'';
        $inner->subjectName->val = isset($info['subjectName'])?$info['subjectName']:'';
        $inner->writeTo($inner_out,0);
        
        $_out = self::writeToHttpPackage(ECMD_JOIN_CLASS,$inner_out);
        $response = self::readFromHttpPackage(APOLLO_CLASS_INFO,$_out);
        return $response;
    }

    /**
     * 获取班级详情
     * @param  integer $cid  班级id
     * @param  integer $authority  1班主任 2任课老师 3监护人 4关注人
     * @return integer       
     */
    public static function classInfo($cid=0,$authority=4)
    {
        $inner_out = '';
        $inner = new TReqClassInfo;
        $inner->cid->val = $cid;
        $inner->authority->val = $authority;
        $inner->writeTo($inner_out,0);
        
        $_out = self::writeToHttpPackage(ECMD_GET_ClASSGINFO,$inner_out);
        $response = self::readFromHttpPackage(APOLLO_CLASS_INFO,$_out);
        if($response->iResult->val == 0){
            $res = new TRespClassInfo;
            $res->readFrom($response->vecData->get_val(), 0);
            return self::parseJceObj($res->tClass);
        }else{
            return false;
        }
    }
    
    /**
     * 班级设置
     * @param  integer $cid  班级id
     * @param  integer $flag 标识  0 更改学校 1更改班级名字 2 更改班级验证模式 3转让班级
     * @return integer
     */
    public static function classSetting($cid=110, $flag = 2, $params = array())
    {

        $inner_out = '';
        $inner = new TReqSetClass;
        $inner->cid->val = $cid;
        $inner->flag->val = $flag;
        if($flag == 0){
            $school = new TSchool();
            $school->name->val = $params['name'];
            $school->scid->val = $params['scid'];
            $school->aid->val = $params['aid'];
            $inner->tSchool = $school;
        }else if($flag == 1){
            $inner->cName->val = $params['classname'];
            $inner->stid->val = $params['stid'];
            $inner->gid->val = $params['gid'];
        }else if($flag == 2){
            $inner->validate->val = $params['validate'];            
        }else if($flag == 3){
            $inner->uid->val = $params['uid'];
        }
        $inner->writeTo($inner_out,0);

        $_out = self::writeToHttpPackage(ECMD_SETCLASS,$inner_out);
        $response = self::readFromHttpPackage(APOLLO_CLASS_INFO,$_out);
       // error_log("aaa:".$response->iResult->val);
       // D($response);
        return $response->iResult->val;
    }
    
    /**
     * 获取所有学校类型列表
     * @return Array
     */
    public static function getSchoolTypes()
    {
        $inner_out = '';
        $_out = self::writeToHttpPackage(ECMD_GET_ALL_SCHOOL_TYPES,$inner_out);
        $response = self::readFromHttpPackage(APOLLO_CLASS_INFO,$_out);
        if($response->iResult->val==0){
            $res = new TRespGetAllSchoolTypes;
            $res->readFrom($response->vecData->get_val(), 0);
            $types = $res->mapSChoolTypes->get_map();
            $typesArr = self::parseJceSimpleCmap($types, array('stid','name'));
            return $typesArr;
        }else{
            return array();
        }
    }
    
    /**
     * 获取所有年级列表
     * @return map mapSchoolGrades
     */
    public static function getAllGrades()
    {   
        $_out = self::writeToHttpPackage(ECMD_GET_ALL_GRADES, '');
        $response = self::readFromHttpPackage(APOLLO_CLASS_INFO, $_out);
        
        if($response->iResult->val == 0){
            $res = new TRespGetAllGrades;
            $res->readFrom($response->vecData->get_val(), 0);
            $grades = $res->vGrades->get_val();
            $gradesArr = self::parseJceCvector($grades, array('gid'=>'gid', 'name'=>'gName', 'stid'=>'stid'));
            return $gradesArr;
        }else {
            return array();
        }
    }
    
    /**
     * 获取当前班级的年级类型
     * @param integer $cid 班级id
     * @return integer
     */
    public static function getGradeByCurrClass($cid = 0)
    {
        $inner_out = '';
        $inner = new TReqGetClassGrade;
        $inner->cid->val = $cid;
        $inner->writeTo($inner_out, 0);
        
        $_out = self::writeToHttpPackage(ECMD_GET_CLASS_GRADE, $inner_out);
        $response = self::readFromHttpPackage(APOLLO_CLASS_INFO, $_out);
        if($response->iResult->val == 0){
            $res = new TRespGetClassGrade;
            $res->readFrom($response->vecData->get_val(), 0);
            $grade = self::parseJceObj($res->tGrade);
            return self::array_to_object(array('gid'=>$grade->gid, 'name'=>$grade->gName, 'stid'=>$grade->stid));
        }else {
            return array();
        }
    }

    /**
     * 获取用户班级列表
     * @return [type] [description]
     */
    public static function getClassList()
    {
        $_out = self::writeToHttpPackage(ECMD_GET_ClASSGROUPS,'');
        $response = self::readFromHttpPackage(APOLLO_CLASS_INFO,$_out);
        if(!$response->iResult->val){
            $res = new TRespClassGroups;
            $res->readFrom($response->vecData->get_val(),0);
            $groups = $res->vClassGroups->get_val();
            $groups = self::parseJceCvector($groups, array('title'=>'name', 'classes'=>'vClasses'));
            return $groups;
        }else{
            return false;
        }
    }
    
    /**
     * 获取老师用户班级列表
     * @return [type] [description]
     */
    public static function getTeacherClassList()
    {        
        $_out = self::writeToHttpPackage(ECMD_GET_TEACHER_OF_ClASS,'');
        $response = self::readFromHttpPackage(APOLLO_CLASS_INFO,$_out);
        if(!$response->iResult->val){
            $res = new TRespTeacherOfClass;
            $res->readFrom($response->vecData->get_val(),0);
            $lists = $res->vClasses->get_val();
            $lists = self::parseJceCvector($lists);
            return $lists;
        }else{
            return array();
        }
    }

    /**
     * 退出班级
     * @param  integer $cid  班级id
     * @param  integer $flag  0老师退出， 1学生退出 联动家长，只有第一关注人才能退出
     * @return [type]        [description]
     */
    public static function exitClass($cid=0,$flag=0, $studentId = 0 )
    {
        $inner_out = '';
        $inner = new TReqExitClass;
        $inner->cid->val = $cid;
        $inner->flag->val = $flag;
        $inner->studentId->val = $studentId;
        $inner->writeTo($inner_out,0);
        $_out = self::writeToHttpPackage(ECMD_EXITClASS,$inner_out);
        $response = self::readFromHttpPackage(APOLLO_CLASS_INFO,$_out);
        
        return $response;
    }

    /**
     * 获取班级成员
     * @param  integer $cid  班级id
     * @param  integer $flag 标识  0 学生 1老师可扩展此接口
     * @return [type]        [description]
     */
    public static function getClassMember($cid=0,$flag=0,$uid=0)
    {
        $inner_out = '';
        $inner = new TReqGetClassMember;
        $inner->cid->val = $cid;
        $inner->flag->val = $flag;
        $inner->writeTo($inner_out,0);
        $_out = self::writeToHttpPackage(ECMD_GETCLASSMEMBER,$inner_out,$uid);
        $response = self::readFromHttpPackage(APOLLO_CLASS_INFO,$_out);

        if($response->iResult->val==0){
            $res = new TRespGetClassMember;
            $res->readFrom($response->vecData->get_val(),0);
            if($flag == 0){
                return self::parseJceCvector($res->vStudents->get_val());
            }else{
                return self::parseJceCvector($res->vTeachers->get_val());
            }
        }
        
        return self::parseJceObj($response);
    }

    /**
     * 删除班级成员
     * @param  integer $cid  班级id
     * @param  integer $flag 标识  0 学生 1老师可扩展此接口
     * @return [type]        [description]
     */
    public static function deleteClassMember($cid=0,$flag=0,$memberid)
    {
        $inner_out = '';
        $inner = new TReqDeleteClassMember;
        $inner->cid->val = $cid;
        $inner->flag->val = $flag;
        
        $val = new c_string();
        $val->val = $memberid;
        $inner->vMemberIds->push_back($val);
        
        $inner->writeTo($inner_out,0);
        
        $_out = self::writeToHttpPackage(ECMD_DElETEDCLASSMEMBER,$inner_out);
        $response = self::readFromHttpPackage(APOLLO_CLASS_INFO,$_out);
        return $response;
    }
    
    /**
     * 修改学生学号
     * @param  String $stuid  学生id
     * @param  String $stuNum 学生学号
     * @return response obj
     */
    public static function setStudentNumber($stuid, $stuNum)
    {
        $inner_out = '';
        $inner = new TReqSetStudentNumber;
        $inner->studentNumber->val = $stuNum;
        $inner->studentUid->val = $stuid;
        $inner->writeTo($inner_out, 0);
        
        $_out = self::writeToHttpPackage(ECMD_SET_STUDENT_NUMBER,$inner_out);
        $response = self::readFromHttpPackage(APOLLO_CLASS_INFO,$_out);
        return self::parseJceObj($response);
        
    }
    
    /**
     * 修改老师任教科目
     * @param  String $stuid  学生id
     * @param  String $stuNum 学生学号
     * @return response obj
     */
    public static function setTeacherSubject($cid, $teacherId, $newSubject)
    {
        $inner_out = '';
        $inner = new TReqSetSubject;
        $inner->cid->val = $cid;
        $inner->teacherId->val = $teacherId;
        $inner->newSubject->val = $newSubject;
        $inner->writeTo($inner_out, 0);
        
        $_out = self::writeToHttpPackage(ECMD_SET_SUBJECT,$inner_out);
        $response = self::readFromHttpPackage(APOLLO_CLASS_INFO,$_out);
        return self::parseJceObj($response);
    }

    /**
     * 入班审核
     * @param  integer $mid  请求消息id 
     * @param  integer $flag 标识  1同意  2拒绝
     * @param  integer $cid  班级id
     * @return [type]        [description]
     */
    public static function verifyJionClass($mid=0,$flag=1,$cid=0)
    {
        $inner_out = '';
        $inner = new TReqVerifyJoinClass;
        $inner->auditRecordId->val = $mid;
        $inner->flag->val = $flag;
        $inner->cid->val = $cid;
        $inner->writeTo($inner_out,0);
        
        $_out = self::writeToHttpPackage(ECMD_VERIFYJIONCLASS,$inner_out);
        $response = self::readFromHttpPackage(APOLLO_CLASS_INFO,$_out);
        return $response;
    }
    
    /**
     * 获取审核列表是否最新
     * @return boolean true 显示图标 false 不显示图标
     */
    public static function getNewAuditHint()
    {
    	$res = self::getAuditRecords( Yii::app()->user->id, 1, 0 ); // 1 拉取最新  ， 0 拉取默认10条
        $data=isset($res['data'])?$res['data']:null;
    	$createTime = 0 ;
    	
    	if( false !== $data ){
    		foreach ( $data as $v ){
    			if( 0 == $v->status ){
    				$createTime = $v->createTime  ;
    				break;
    			}
    		}
    	}

        $cacheTime = Yii::app()->cache->get( self::NEW_AUDIT_HINT_COUNT ) ;
        
        // 当内存中大于 真实数据时，可能同步不一致，因为可当成新消息
    	if( $cacheTime < $createTime ){
    
    		return true;
    	}
    	 
    	return false;
    }
    
    /**
     * 入班审核列表
     * @param  integer $uid  班主任用户id
     * @param  integer $flag 拉取历史或最新记录 0历史 1最新
     * @param  integer $index  当前审核记录索引号， 默认为0
     * @return [type]        [description]
     */
    public static function getAuditRecords($uid, $flag, $index)
    {
        $inner_out = '';
        $inner = new TReqQueryAuditRecord;
        $inner->uid->val = $uid;
        $inner->flag->val = $flag;
        $inner->index->val = $index;
        $inner->writeTo($inner_out,0);
        $_out = self::writeToHttpPackage(ECMD_QUERY_AUDIT_RECORD,$inner_out);
        $response = self::readFromHttpPackage(APOLLO_CLASS_AUDIT,$_out);
        if($response->iResult->val == 0){
            $res = new TRespQueryAuditRecord;
            $res->readFrom($response->vecData->get_val(),0);
            $data= self::parseJceCvector($res->vAuditRecord->get_val());
            return array('data'=>$data,'total'=>$res->total->val);
        }
        
        return false;
    }

    /**
     * 解散班级
     * @param  integer $cid 请求班级id
     * @return [type]       [description]
     */
    public static function dismissClass($cid=0)
    {
        $inner_out = '';
        $inner = new TReqDismissClass;
        $inner->cid->val = $cid;
        $inner->writeTo($inner_out,0);
        
        $_out = self::writeToHttpPackage(ECMD_DISMISSCLASS,$inner_out);
        $response = self::readFromHttpPackage(APOLLO_CLASS_INFO,$_out);
        return $response;
    }

    /**
     * 获取我的认证学校列表
     * @return Array
     */
    public static function getAuthSchools($uid)
    {
        $inner_out = '';
        $_out = self::writeToHttpPackage(ECMD_GET_EMERGENCY_SCHOOL_CLASS_TEACHER,$inner_out,$uid);
        $response = self::readFromHttpPackage(APOLLO_CLASS_INFO,$_out);
        $v=new TRespGetEmergencySchoolClassTeacher;
        if($response->iResult->val==0){
            $v->readFrom($response->vecData->get_val(),0);
            $v=self::parseJceCvector($v->vEmSCT->get_val());
            return $v;
        }else{
            return array();
        }
    }

    /*
     * 检验手机验证码
     */
    public static function checkMobileCode($phone,$code,$type){
        $inner_out = '';
        $inner = new TReqCheckMobileAuthCode;
        $inner->mobile->val=$phone;
        $inner->code->val=$code;
        $inner->type->val=$type;
        $inner->writeTo($inner_out,0);
        $_out = self::writeToHttpPackage(ECMD_CHECK_MOBILE_AUTH_CODE,$inner_out);
        $response = self::readFromHttpPackage(APOLLO_USER_LOGIN,$_out);
        return $response;
    }

    public static function addStudent($name,$mobile,$mobile1,$mobile2,$mobile3,$mobile4,$cid){
//        $inner_out = '';
//        $inner = new TReqOmsAddSingleStudent;
//        $inner->mobile->val=$phone;
//        $inner->code->val=$code;
//        $inner->type->val=$type;
//        $inner->writeTo($inner_out,0);
//        $_out = self::writeToHttpPackage(ECMD_CHECK_MOBILE_AUTH_CODE,$inner_out);
//        $response = self::readFromHttpPackage(APOLLO_USER_LOGIN,$_out);
//        return $response;
        return true;

    }

    /*
     * 单独添加老师
     */
    public static function addTeacher($cid,$name,$mobile,$subject){
        $inner_out = '';
        $inner = new TReqWebImportTeacherIntoClass;
        $inner->mobile->val=$mobile;
        $inner->cid->val=$cid;
        $inner->name->val=$name;
        $inner->subject->val=$subject;
       // print "<pre>";
        //print_r($inner);
        $inner->writeTo($inner_out,0);
        $_out = self::writeToHttpPackage(ECMD_WEB_IMPORT_TEACHER_INTO_CLASS,$inner_out);
        $response = self::readFromHttpPackage(APOLLO_ADAPTE_INFO,$_out);
        //D($response);
        if($response->iResult->val==0){
            return array('result'=>0,'msg'=>'');
        }else{
            return array('result'=>$response->iResult->val,'msg'=>$response->sMessage->val);
        }
    }

    /*
     * 批量导入学生
     */
    public static function importStudent($arr,$cid){

         $inner_out = '';
         $inner = new TReqWebImportStudentGuardianIntoClass;
         $inner->cid->val=$cid;
        // $studentitem=new TWebImportStudentGuardianItem;
          $vector = new c_vector(new TWebImportStudentGuardianItem);
            foreach($arr as $val){
                if($val['error']==1) continue;
                $item=new TWebImportStudentGuardianItem;
                $item->studentName->val=$val['name'];
                $item->mobilePhone->val=$val['mobile'];
                $mobiles=new c_vector(new c_string);
                if($val['mobile2']){
                    $item2 = new c_string();
                    $item2->val = $val['mobile2'];
                    $mobiles->push_back($item2);
                }
                if($val['mobile3']){
                    $item3 = new c_string();
                    $item3->val = $val['mobile3'];
                    $mobiles->push_back($item3);
                }
                if($val['mobile4']){
                    $item4 = new c_string();
                    $item4->val = $val['mobile4'];
                    $mobiles->push_back($item4);
                }
                if($val['mobile5']){
                    $item5 = new c_string();
                    $item5->val = $val['mobile5'];
                    $mobiles->push_back($item5);
                }
                $item->vMobilePhones=$mobiles;
                $vector->push_back($item);
            }
        $inner->vStudentItem=$vector;
        //D($inner);
      $inner->writeTo($inner_out,0);
      $_out = self::writeToHttpPackage(ECMD_WEB_IMPORT_STUDENT_GUARDIAN_INTO_CLASS,$inner_out);
      $response = self::readFromHttpPackage(APOLLO_ADAPTE_INFO,$_out);

        $v=new TRespWebImportStudentGuardianIntoClass;

        if($response->iResult->val==0){
            $v->readFrom($response->vecData->get_val(),0);

            return array('result'=>$response->iResult->val,'totalstudent'=>$v->studentCount->val,'totalguardian'=>$v->guardianCount->val);
            //return $v;
        }else{
            return false;
        }
    }

    /*
     * 发送邀请短信
     */
    public static function sendInviteSms($mobiles,$content,$type=0){
        if(empty($mobiles)) return array('total'=>0);
        $mobiles=array_unique($mobiles);
        $inner_out = '';
        $inner = new TReqWebSmsInvitation;
        $inner->content->val=$content;
        $inner->type->val=$type;
        $vector = new c_vector(new c_string());
        foreach($mobiles as $mobile){
            if($mobile){
                $s=new c_string();
                $s->val=$mobile;
                $vector->push_back($s);
            }
        }
        $inner->vMobilePhone=$vector;

        $inner->writeTo($inner_out,0);
        $_out = self::writeToHttpPackage(ECMD_WEB_SMS_INVITATION,$inner_out);
        $response = self::readFromHttpPackage(APOLLO_ADAPTE_INFO,$_out);
        $v=new TRespWebSmsInvitation;
        if($response->iResult->val==0){
            $v->readFrom($response->vecData->get_val(),0);
            return array('total'=>$v->count->val);
        }
        return false;
    }

    /**
     * 获取用户在活动期间可拉新的班级
     * @return [type] [description]
     */
    public static function getPullNewClassList($uid)
    {
        $_out = self::writeToHttpPackage(ECMD_PULL_NEW_GET_USER_TEACH_CID,'',$uid);
        $response = self::readFromHttpPackage(APOLLO_PULL_NEW_PROXY,$_out);
        if(!$response->iResult->val){
            $res = new TRespPullNewGetUserTeachCid;
            $res->readFrom($response->vecData->get_val(),0);
            $classes = $res->vPNC->get_val();
            return $classes;
        }else{
            return false;
        }
    }
} 
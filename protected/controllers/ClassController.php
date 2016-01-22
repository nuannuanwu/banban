<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 15-1-23
 * Time: 上午10:37
 */

class ClassController extends Controller
{
    //班级设置标识
    const CLASS_CHANGE_SCHOOL = 0;      //更改学校
    const CLASS_CHANGE_CLASS_NAME = 1;  //更改班级名字
    const CLASS_CHANGE_INCLASS = 2;     //更改班级验证模式
    const CLASS_CHANGE_TRANS = 3;       //转让班级
    
    protected $viewFileName = false;		// 调用动作时，用来指定默认模版
    
    /**
     * @return array action filters
     */
    public function filters()
    {
        return array(
            'accessControl', // perform access control for CRUD operations
            // 'postOnly + delete', // we only allow deletion via POST request
        );
    }

    public function init()
    {
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules()
    {
        return array(
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('scheck', 'tcheck'),
                'users' => array('*'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('index','followclassstudents','followclassteachers','applylistajax', 'thirdinfo', 'view', 'teachers', 'pinvite', 'downloadxls', 'item', 'students', 'sinvite', 'apply', 'deleted', 'supload', 'update', 'invites', 'create', 'subjects', 'removeteacher', 'schoolgrade', 'depart',
                    'master', 'guardianteachers', 'delguardian','exportarea', 'guardians', 'guardianstudents',
                    'notmasterstudents', 'notmasterteachers', 'simport', 'scfinish', 'classexist', 'getschools', 'createsuccess',
                    'selectschool', 'getgrade', 'Isexist', 'giveupinvite', 'accept', 'refuse', 'removestudent', 'texport',
                    'sexport', 'sendpwd', 'generatecode', 'updatestudent', 'updatesubject', 'tupload', 'timport', 'anewpinvite', 'scfinish',
                    'scimport', 'scupload','uidmaster','leaveclass','updatestudentid', 'createdone', 'chooseclass', 'perfectinfo',
                     'inclassdone', 'setrealname', 'classinfo', 'gradesetting', 'schoolsetting', 'inclasssetting', 'applylist','inviteclassmates','mastersetting', 'exprules'),
                'users' => array('@'),
                //'expression'=>array($this,'loginAndNotDeleted'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }


    /**
     * 我的班级-班级列表
     * panrj 2014-08-09
     */
    public function actionIndex()
    {
        $ac = Yii::app()->request->getParam('ac', '');
        $teacher = Yii::app()->user->getInstance();
        $uid = Yii::app()->user->id;
        $identity = Yii::app()->user->getCurrIdentity();
        $classesData = JceClass::getClassList();    // 获取当前用户的班级列表
       if( false === $identity ){  // 身份认证失败
        	Yii::app()->end();
       }
        $uniqueClass4 = $uniqueClass3 = $uniqueClass1 = [];
        $allcids=array();
        $mymasternum = 0;
        if( false != $classesData )
	        foreach ( $classesData as $k=>$v ){
        		$temp = [];
	            foreach( $v->classes as $key=>$class ){
	                $classarr = array('cid' => $class->cid,'classCode'=>$class->code, 'name' => $class->name, 'master' => $class->authority, 'total' => $class->studentTotal, 'type' => $class->type
	                    , 'createtype'=>$class->createType,'childname'=>$class->childName,'sid' => $class->tSchool->scid, 'sname' => $class->tSchool->name, 'teachers_num' => $class->teacherTotal,'ismaster' => $identity->isMaster && $class->authority == 1 ? 1 : 0, 'url' => Yii::app()->createUrl('class/update/' . $class->cid));
	               
	                $varStr = $class->authority;
	                
	                if( 1 == $varStr ){
	                	$mymasternum++;
	                }

	                if( $varStr == 2 || 1 == $varStr ){
	                	$uniqueClass1['classes'][] = $classarr;
	               		$uniqueClass1['name'] = $v->title;
                        $allcids[]=$class->cid;
	                }
	                else{
	                	$temp['classes'][] = $classarr;
	                	$temp['name'] = $v->title;
	                	${'uniqueClass'.$varStr}[$k] = $temp;
	                }
	            }
	        }
//        $classFeeList=JceHelper::getClassFeeInfo($allcids);
//        $feeArr=array();
//        if(is_array($classFeeList)){
//            foreach($classFeeList as $val){
//                $feeArr[$val['cid']]=$val;
//            }
//        }
        $feeArr=array();
        $userinfo=Yii::app()->user->getInstance();
        $this->render('index', array(
                'teacher' => $teacher,
                'classTeacherList' => $uniqueClass1,
                'classGuardianList' => $uniqueClass3,
                'classFollowList' => $uniqueClass4,
                'identity' => $identity,
                'mymasternum'=>$mymasternum, // 统计老师的班主任数量
                'ac'=>$ac,
                'feeArr'=>$feeArr,
                'userinfo'=>$userinfo,
        		'newHint' => JceClass::getNewAuditHint()	// 是否显示最新审核列表图标
            )
        );
    }


    /**
     * 第三方信息完善
     */
    public function actionThirdinfo()
    {
        $request = Yii::app()->request;
        $userId = Yii::app()->session['thirdinfoUserid'];
        if ($userId === null)
            $this->redirect("index");

        $memberService = new MemberService();

        $thirdUser = Member::model()->findBypk($userId);

        if (!isset($thirdUser->threeareaid) || !isset($thirdUser->threeuserid))
            throw new ExceptionClass();

        // 1值为web激活
        if ( true == isset($thirdUser->active) && 1 == $thirdUser->active )
            $this->redirect(Yii::app()->createUrl('class/index'));

        if (Yii::app()->request->isPostRequest) {
            $thirdPost = $request->getParam("third");

            if (!preg_match('/^((1)+\d{10})$/', $thirdPost['phone'])) {
                Yii::app()->msg->postMsg('failed', '手机号码不正确!');
                $this->redirect(Yii::app()->createUrl('class/thirdinfo'));
            }

            $cache = Yii::app()->cache;
            $cacheKey = "third-part-info_" . $thirdPost['phone'];
            $cacheValue = $cache->get($cacheKey);

            if (!$cacheValue || $cacheValue !== $thirdPost['code']) {
                Yii::app()->msg->postMsg('failed', '验证码错误!');
                $this->redirect(Yii::app()->createUrl('class/thirdinfo'));
            }

            $thirdUser->name = $thirdPost['name'];
            $thirdUser->mobilephone = $thirdPost['phone'];
            $thirdUser->active  = 1;        // 1值为web激活

            $result = $thirdUser->save();

            if ($result) {
                unset(Yii::app()->session['thirdinfoUserid']);
                $this->redirect(Yii::app()->createUrl('class/create'));
            } else {
                Yii::app()->msg->postMsg('failed', '保存失败!');
                $this->redirect(Yii::app()->createUrl('class/thirdinfo'));
            }
        }

        $this->render('thirdinfo');
    }

    /**
     * 我的班级-创建班级,第一步，选择城市，输入学校
     *
     */
    public function actionSelectschool()
    {
        $userid = Yii::app()->user->id;
        $sid = Yii::app()->request->getParam('sid');
        $schooltype = SchoolType::getSchoolTypeData(); //所有学校类型
        $grades = Grade::model()->findAllByAttributes(array("deleted" => 0));
        if (isset($_POST['schoolname']) && isset($_POST['grade'])) {
            $schoolname = MainHelper::csubstr(trim($_POST['schoolname']), 0, 20,'utf8',false);
            $gradeId = $_POST['grade'];
            $stid = isset($_POST['stid']) ? implode($_POST['stid']) : '';
            $areaId = 1; //区域
            $school = School::model()->findByAttributes(array('name' => $schoolname, 'deleted' => 0, 'aid' => $areaId));
            $data = array('schoolname' => $schoolname, 'gradeId' => $gradeId, 'areaId' => $areaId, 'stid' => $stid, 'sid' => $school ? $school->sid : 0);
            Yii::app()->cache->set("userid_" . $userid . "create_school_class" . date("Y-m-d"), $data, 3600);
            $this->redirect(Yii::app()->createUrl('class/create?sid=' . ($school ? $school->sid : 0)));
        }
        $this->render('selectschool', array('sid' => $sid, 'schooltype' => $schooltype, 'grades' => $grades));
    }



    /*
     * 获取地区所有学校
     */
    public function actionGetschools()
    {
        $aid = Yii::app()->request->getParam("aid", 0);
        $name = Yii::app()->request->getParam("name", "");
        $schools = School::getSchoolArrByArea(array('area' => $aid, 'name' => $name));
        $arr = array();
        $py = new py_class();
        foreach ($schools as $val) {
            if ($val['pingyin']) {
                $arr[] = array('sid' => $val['sid'], 'name' => strtoupper(substr($val['pingyin'], 0, 1)) . ":" . $val['name'], 'pingyin' => $val['pingyin']);
            } else {
                $pingyin = $py->str2py($val['name']);
                $arr[] = array('sid' => $val['sid'], 'name' => strtoupper(substr($pingyin, 0, 1)) . ":" . $val['name'], 'pingyin' => $val['pingyin']);

            }
        }
        die(json_encode(array('status' => '0', 'data' => $arr)));
    }

    /**
     * 我的班级-创建班级
     * panrj 2014-08-09
     */
    public function actionCreate()
    {
        //非实名老师用户创班时强制填写实名
        $res = preg_match('/^用户\d+$/', Yii::app()->user->getRealName());
        if($res > 0){
            $this->redirect(Yii::app()->createUrl('class/setrealname', array('ty'=>'create')));
        }

        //不再用mysql，用接口判断
//        //家长身份跳到创建班级时如果当前用户建班达到三个时跳转 ac用于在index里显示弹窗
//        if(Yii::app()->request->getParam('acty') == 'chg'){
//            $mymasternum = ClassTeacherRelation::countTeacherMasterNum(Yii::app()->user->id);
//            if($mymasternum >= 3){
//                $this->redirect(Yii::app()->createUrl('class/index', array('ac'=>'gnot')));
//            }
//        }
        
        if (isset($_POST['Class'])) {
            $name = MainHelper::csubstr(trim($_POST['Class']['name']), 0, 20,'utf8',false); //班级名称
            $class = JceHelper::createClass($name);
            if(is_numeric($class) && $class == 101){
                Yii::app()->msg->postMsg('error', '您已经是三个班级的班主任');
                $this->redirect(array('create'));    
            }else if($class && $class->cid->val){
                $this->redirect(Yii::app()->createUrl('class/createdone', array('classCode'=>$class->classCode->val, 'cid'=>$class->cid->val, 'className'=>$class->cName->val)));
                exit;
            }
        }
        $this->render('create');
    }

    /**
     * 创建班级完成页面
     */
    public function actionCreatedone()
    {
        $classCode = Yii::app()->request->getParam('classCode');
        $cid = Yii::app()->request->getParam('cid');
        $className = Yii::app()->request->getParam('className');
        $this->render('createdone', array('classCode'=>$classCode, 'cid'=>$cid, 'className'=>$className));
    }
    
    /**
     * 加入班级-选择班级页面
     */
    public function actionChooseclass()
    {
        Yii::app()->session->remove('msg'); //删除加班班级时添加的错误提示信息
        $ty = Yii::app()->request->getParam('ty');
        if(strpos('tmp'.Yii::app()->user->getRealName(), '用户') > 0){
            $this->redirect(Yii::app()->createUrl('class/setrealname', array('ty'=>'add','identity'=>$ty)));
        }
        
        if((!empty($_POST) && isset($_POST['search']) || isset($_GET['search']))){
            $search = isset($_POST['search']) ? $_POST['search'] : $_GET['search'];
            if(strlen($search) == 11){
                $type = 2;
            }else if(strlen($search) == 8 || strlen($search) == 6){
                $type = 1;
            }else {
                Yii::app()->msg->postMsg('error', '请输入正确的手机号码或班级代码');
                $this->redirect(Yii::app()->createUrl('class/chooseclass', array('ty'=>$ty)));
            }
            $classList = JceHelper::searchClass($search, $type);
            if(count($classList)){
                $this->render('chooseclass', array('classList'=>$classList, 'type'=>$type, 'search'=>$search, 'ty'=>$ty));
                exit;
            }else{
                $this->render('chooseclass', array('classList'=>array(), 'type'=>$type, 'search'=>$search, 'ty'=>$ty));
                exit;
            }
        }
        $this->render('chooseclass', array('ty'=>$ty));
    }
    
    /**
     * 加入班级-完善信息页面
     */
    public function actionPerfectinfo()
    {
        $classCode = Yii::app()->request->getParam('classCode');
        $search = Yii::app()->request->getParam('search');
        $ty = Yii::app()->request->getParam('ty');
        $msg = Yii::app()->session['msg'] ? Yii::app()->session['msg'] : '';
        if($classCode){
            $class = JceHelper::searchClass($classCode, 1);
            $this->render('perfectinfo', array('class'=>isset($class[0])?$class[0]:null, 'classCode'=>$classCode, 'msg'=>$msg, 'search'=>$search, 'ty'=>$ty));
            exit;
        }
        $this->render('perfectinfo', array('ty'=>$ty,'classCode'=>$classCode));
    }
    
    /**
     * 加入班级-完成页面
     */
    public function actionInclassdone()
    {
        $classCode = Yii::app()->request->getParam('classCode');
        $studentName = Yii::app()->request->getParam('studentName');
        $relation = Yii::app()->request->getParam('relation','');
        $subjectName = Yii::app()->request->getParam('subjectName');
        $className = Yii::app()->request->getParam('className');
        $joinverify = Yii::app()->request->getParam('joinverify');
        $type = Yii::app()->request->getParam('type',1);
        $ty = Yii::app()->request->getParam('ty');
        if($classCode && ($studentName != '' || $subjectName != '')){
            $class = JceHelper::searchClass($classCode, 1);
            $cid = $class[0]->cid->val;
            $uid = Yii::app()->user->id;
            if($studentName){
                $type = 1;
                $info['studentName'] = $studentName;
                $info['relation'] = $relation;
            }else{
                $type = 2;
                $info['subjectName'] = $subjectName;
            }
            $response = JceHelper::joinClass($cid, $uid, $type, $classCode, $info);
            $result = $response->iResult->val;
            if($result == 0 || $result == ClassStatus::RES_JOIN_CLASS_SUBMITTED){
                $this->redirect(Yii::app()->createUrl('class/inclassdone', array('className'=>$class[0]->cName->val, 'joinverify'=>$class[0]->joinverify->val,'type'=>$type)));
            }else if($result == ClassStatus::RES_HTTPCLASS_EXIST_SAME_STUDENT_NAME){
                $tmpMsg = $response->sMessage->val;
                if(strpos($tmpMsg, '手机尾号')>0){
                    $ttmsg = mb_substr($tmpMsg, 0, 22, 'utf-8');
                    $tttmsg = mb_substr($tmpMsg, 22, 22, 'utf-8');
                    $tmpMsg = str_replace($ttmsg, $ttmsg."<br/>", $tmpMsg);
                    $tmpMsg = str_replace($tttmsg, $tttmsg."<br/>", $tmpMsg);
                }
                Yii::app()->session['msg'] = $tmpMsg;
                $this->redirect(Yii::app()->createUrl('class/perfectinfo', array('classCode'=>$classCode, 'ty'=>$ty)));
                exit;
            }else if($result == ClassStatus::RES_HTTPCLASS_ALREADY_IS_CLASS_TEACHER){
                Yii::app()->session['msg'] = 'msg teacher is exist';
                $this->redirect(Yii::app()->createUrl('class/perfectinfo', array('classCode'=>$classCode, 'ty'=>$ty)));
                exit;
            }else if($result == ClassStatus::RES_JOIN_CLASS_NOT_EXIST_CLASS){
                Yii::app()->msg->postMsg('success', $response->sMessage->val);
            }else if($result == ClassStatus::RES_JOIN_CLASS_TYPE_ERROR){
                Yii::app()->msg->postMsg('success', $response->sMessage->val);
            }else if($result == ClassStatus::RES_FORBID_JOIN_CLASS){
                Yii::app()->msg->postMsg('success', $response->sMessage->val);
            }else {
                Yii::app()->msg->postMsg('success', $response->sMessage->val);
            }
            $this->redirect(Yii::app()->createUrl('class/perfectinfo', array('classCode'=>$classCode, 'ty'=>$ty)));
            exit;
        }else if(!isset($className) || trim($className) == ''){
            $this->redirect(Yii::app()->createUrl('class/perfectinfo', array('classCode'=>$classCode, 'ty'=>$ty)));
        }
        
        $this->render('inclassdone', array('className'=>$className, 'joinverify'=>$joinverify,'type'=>$type));
    }

    public function actionCreatesuccess($id)
    {
        $addStudentNum = Yii::app()->request->getParam("addStudentNum", 0);
        $inviteNum = Yii::app()->request->getParam("inviteNum", 0);
        $this->render('createsuccess', array('cid' => $id, 'addStudentNum' => $addStudentNum, 'inviteNum' => $inviteNum));
    }
    
    /**
     * 以家长身份切换到老师创建班级或添加任课老师时如果没有真实名字强制先添加名字
     */
    public function actionSetrealname()
    {
        $ty = Yii::app()->request->getParam('ty','');
        $identity = Yii::app()->request->getParam('identity','g');
        $name = Yii::app()->request->getParam('realname');
        $uid=Yii::app()->user->id;
        if($name&&$uid){
            $user = Yii::app()->user->getInstance();
            $result=JceUser::setPersonInfo($uid,$user->icon,$user->sex,$name,$user->addressId);
            if($result&&$result->iResult->val==0){
                if($ty && $ty == 'create'){
                    $this->redirect(Yii::app()->createUrl('class/create', array('ty'=>$identity)));
                }else if($ty && $ty == 'add'){
                    $this->redirect(Yii::app()->createUrl('class/chooseclass', array('ty'=>$identity)));
                }else{
                    $this->redirect(Yii::app()->user->getReturnUrl());
                }
            }
        }
        $this->render('setrealname', array('ty'=>$ty, 'identity'=>$identity));
        
    }

    /**
     * 我的班级-老师列表
     */
    public function actionTeachers($id)
    {
        $page = (int)Yii::app()->request->getParam("page", 1);
        $mobiles=Yii::app()->request->getParam("mobiles", '');
        $import=Yii::app()->request->getParam("import", '');
        $ac=Yii::app()->request->getParam('ac',2);
        $class=JceClass::classInfo($id,$ac);
        $userid = Yii::app()->user->id;
        $userinfo = Yii::app()->user->getInstance();
        $teachers_old=JceClass::getClassMember($id,1);
       // D($teachers_old);
        $uid=Yii::app()->user->id;
        $isMaster=$class->masterUid==$userid?true:false;//$this->checkIsMaster($uid,$id,$teachers_old); //判断我在班级老师中是不是班主任

        $teachers = array();
        $teachersnum=count($teachers_old);
        $needSendpwdNum = 0;
        $teacher_ids = array();
        $masterinfo=null;
        $selectteacherids=array();//用于选择替换班主任的数据，除掉自己和重复的其它老师
        if( false !== $teachers_old )
        foreach ($teachers_old as $k=>$val) {
            if (!in_array($val->uid, $teacher_ids)) {
                $teacher_ids[] = $val->uid;
//                $stateArr=Member::getUserActiveState($val->uid);
//
//                $appstate=$stateArr['appstate'];
//                $webstate=$stateArr['webstate'];
//                $appactive=$stateArr['appactive'];
//                $webactive=$stateArr['webactive'];
//                $active=$stateArr['active'];
//                if (!$appactive&&!$webactive) {
//                    $needSendpwdNum++; //未激活状态
//                }
                if($val->uid!=$userid&&$val->type!=1){
                    $selectteacherids[]=$val;
                }

                //班主任放第一位;
                $tinfo=array('userid' => $val->uid, 'name' => $val->name, 'mobilephone' => $val->mobilePhone,
                    'teacher' => $val->uid, 'sid' => $val->uid, 'subject' => $val->subject, 'id' => $val->uid,
                    'creationtime' => property_exists($val,"joinTime")?substr($val->joinTime,0,10):'2015-05-01',
                    'cid' => $id,'type'=>$val->type,
                    'appstate'=>$val->loginstatus,'state' => 1, 'active'=>0,'client' => 0, 'web' => 0,'active'=>0,'appactive'=>0,'webactive'=>0);
                if(!$tinfo['appstate']){
                    $needSendpwdNum++;
                }
                $teachers[$tinfo['userid']] =$tinfo;
            }else{
                $tinfo=array('userid' => $val->uid, 'name' => $val->name, 'mobilephone' => $val->mobilePhone,
                    'teacher' => $val->uid, 'sid' => $val->uid, 'subject' => $val->subject, 'id' => $val->uid,
                    'creationtime' => property_exists($val,"joinTime")?substr($val->joinTime,0,10):'2015-05-01',
                    'cid' => $id,'type'=>$val->type,
                    'state' => 1, 'active'=>0,'client' => 0, 'web' => 0,'active'=>0,'appactive'=>0,'webactive'=>0);
                if(!empty($tinfo['subject'])){
                    $teachers[$tinfo['userid']]['subject']=($teachers[$tinfo['userid']]['subject']?$teachers[$tinfo['userid']]['subject'].",":'').$tinfo['subject'];
                }

            }
        }
        $data = UCQuery::PageData($teachers, $page); //分页

        $subjects = array();
        $schoolname=$class?$class->tSchool->name:'';
        $classFeeList=JceHelper::getClassFeeInfo(array($id));
        $this->render('teachers', array('mobiles'=>$mobiles,'import'=>$import,'isMaster'=>$isMaster,'teachers_old' => $selectteacherids, 'classFeeList'=>$classFeeList,'schoolname' => $schoolname, 'class' => $class, 'userinfo' => $userinfo, 'data' => $data, 'teachersnum'=>$teachersnum,'subjects' => $subjects, 'needSendpwdNum' => $needSendpwdNum));
    }

    /**
     * 我的班级-学生列表
     */
    public function actionStudents($id)
    {
        $ac=Yii::app()->request->getParam('ac',2);
        $import=Yii::app()->request->getParam('import',0);
        $totalstudent=Yii::app()->request->getParam('totalstudent',0);
        $totalguardian=Yii::app()->request->getParam('totalguardian',0);
        $mobiles=Yii::app()->request->getParam('mobiles','');
        $class = JceClass::classInfo($id,1);
        if(!$class){
            Yii::app()->msg->postMsg('error', '班级不存在');
            $this->redirect(Yii::app()->createUrl('class/index'));
            exit();
        }
        $userid = Yii::app()->user->id;
        $data=JceClass::getClassMember($id,0);
        $classstudentnum=count($data);//学生数量
        $classstudentnoactivenum=0;//未激活APP数量　
        $students=array();
        if(!is_array($data)){
        }else{
            foreach($data as $k=>$v){
                $students[]=array('name'=>$v->name,'id'=>1,'studentid'=>$v->studentNumber,'creationtime'=>$v->joinTime,'oldguardians'=>$v->vFamilys,'cid'=>$id,'userid'=>$v->sid,'student'=>$v->sid);
            }
        }
        $uid=Yii::app()->user->id;
        $isMaster=$class->masterUid==$userid?true:false;//$this->checkIsMaster($uid,$id,null); //判断我在班级老师中是不是班主任
        $userinfo = Yii::app()->user->getInstance();
        $page = (int)Yii::app()->request->getParam("page", 1);
        $arr = array();
        $needSendpwdNum = 0;
        $data = UCQuery::PageData($students, $page);
        //只对当页处理图标等显示
        if (is_array($data['datas'])) {
            foreach ($data['datas'] as $kk => $val) {
                $guradian = is_array($val['oldguardians'])?$val['oldguardians']:array();
                $guardiandata = array();
                foreach ($guradian as $k => $v) {
                    $appstate=$v->loginstatus?1:0;
                    if(!$appstate){
                        $classstudentnoactivenum++;
                    }

                    $guardiandata[$k]['role'] = $v->relation;
                    $guardiandata[$k]['mobile'] = $v->mobilePhone;
                    $guardiandata[$k]['client'] = 0;
                    $guardiandata[$k]['web'] = 0;
                    $guardiandata[$k]['active'] = 0;
                    $guardiandata[$k]['appactive'] = 0;
                    $guardiandata[$k]['webactive'] = 0;
                    $guardiandata[$k]['appstate'] = $appstate;
                    $guardiandata[$k]['name'] = $v->name;

                }
                $data['datas'][$kk]['guradians'] = $guardiandata;
            }
        }
       // D($data);
        $teacher = Yii::app()->user->getInstance();
        $schoolname=$class?$class->tSchool->name:'';
        $classFeeList=JceHelper::getClassFeeInfo(array($id));
        $this->render('students', array('mobiles'=>$mobiles,'classstudentnoactivenum'=>$classstudentnoactivenum,'classstudentnum'=>$classstudentnum,'import'=>$import,'totalstudent'=>$totalstudent,'totalguardian'=>$totalguardian,'isMaster'=>$isMaster,'schoolname' => $schoolname, 'classFeeList'=>$classFeeList,'class' => $class, 'userinfo' => $userinfo, 'data' => $data, 'needSendpwdNum' => $needSendpwdNum));
    }

    /**
     * 我的班级-单个添加老师
     */
    public function actionPinvite($id)
    {
        $teacher = Yii::app()->user->getInstance();
        $class = JceClass::classInfo($id,1);
        $userid = Yii::app()->user->id;
        if(!$class){
            Yii::app()->msg->postMsg('error', '班级不存在');
            $this->redirect(Yii::app()->createUrl('class/index/'));
        }
        $userid=Yii::app()->user->id;
        if($class->masterUid!==$userid){
            Yii::app()->msg->postMsg('error', '你不是班主任没有权限操作');
            $this->redirect(Yii::app()->createUrl('/class/students/'.$id));
            exit();
        }
        $allteachermobiles=array();
        $teachers_old=JceClass::getClassMember($id,1);
        foreach($teachers_old as $teachers){
            $allteachermobiles[]=$teachers->mobilePhone;
        }
        if (isset($_POST['Teacher'])) {
            $data = $_POST['Teacher'];

            $name = trim($data['name']);
            $mobile = trim($data['mobile']);
            $subject = trim($data['subject']);
            if(in_array($mobile,$allteachermobiles)){
                Yii::app()->msg->postMsg('error', '添加老师失败:该老师已经在班级中');
                $this->redirect(Yii::app()->createUrl('class/teachers/' . $id));
                exit();
            }
            $result = JceClass::addTeacher($id,$name,$mobile,$subject);
            Yii::log("添加老师结果:".$result['result'],CLogger::LEVEL_ERROR,'curl.log1');
            if ($result&&$result['result']=='0') {
              //  Yii::app()->msg->postMsg('success', '成功添加老师');
                $this->redirect(Yii::app()->createUrl('class/teachers/' . $id."?import=1&mobiles=".$mobile));
            }else{
                Yii::app()->msg->postMsg('error', '添加老师失败:'.$result['msg']);
                $this->redirect(Yii::app()->createUrl('class/teachers/' . $id));
            }
        }
        exit();
    }

    /**
     * 我的班级-单个添加学生
     */
    public function actionSinvite($id)
    {

        $class = JceClass::classInfo($id,1);
        if(!$class){
            Yii::app()->msg->postMsg('error', '班级不存在');
            $this->redirect(Yii::app()->createUrl('class/index/'));
        }
        $userid=Yii::app()->user->id;
        if($class->masterUid!==$userid){
            Yii::app()->msg->postMsg('error', '你不是班主任没有权限操作');
            $this->redirect(Yii::app()->createUrl('/class/students/'.$id));
            exit();
        }
        $students=JceClass::getClassMember($id,0);
        $totalstudent=is_array($students)?count($students):0;
        $names=array();
        if(is_array($students)){
            foreach($students as $val){
                $names[]=trim($val->name);
            }
        }
        $userid = Yii::app()->user->id;
        if (isset($_POST['Student'])) {
            $data = $_POST['Student'];
            $mobile = $data['mobile'];
            $mobile1 = $data['mobile1'];
            $mobile2 = $data['mobile2'];
            $mobile3 = $data['mobile3'];
            $mobile4 = $data['mobile4'];
            $mobiles=array();
            if($mobile){
                $mobiles[]=$mobile;
            }
            if($mobile1){
                $mobiles[]=$mobile1;
            }
            if($mobile2){
                $mobiles[]=$mobile2;
            }
            if($mobile3){
                $mobiles[]=$mobile3;
            }
            if($mobile4){
                $mobiles[]=$mobile4;
            }
            $name = trim($data['name']);
            if(in_array($name,$names)){
                Yii::app()->msg->postMsg('error', '班级中已存在学生' . $name . '');
                $this->redirect(Yii::app()->createUrl('class/students/' . $id));
                exit();
            }
            $num = 0;
            $tmpTotal = 1 + $totalstudent;
            if ($tmpTotal > 100) { //默认100
                $sub =100-$totalstudent;
                Yii::app()->msg->postMsg('error', '班级学生最多100，目前已有' . $totalstudent . '人,不能再添加');
                $this->redirect(Yii::app()->createUrl('class/students/' . $id));
            }
            $arr=array();
            $arr[]=array('name'=>$name,'mobile'=>$mobile,'mobile2'=>$mobile1,
                'mobile3'=>$mobile2,'mobile4'=>$mobile3,'mobile5'=>$mobile4,'error'=>0);
            $result =JceClass::importStudent($arr,$id);

            if ($result) {
               // Yii::app()->msg->postMsg('success', '成功添加学生:'.$name);
                $this->redirect(Yii::app()->createUrl('class/students/' . $id.'?totalstudent='.$result['totalstudent'].'&import=2&totalguardian='.$result['totalstudent'].'&mobiles='.implode(",",$mobiles)));

            }else{
                Yii::app()->msg->postMsg('error', '添加学生失败' . $num . '名');
                $this->redirect(Yii::app()->createUrl('class/students/' . $id));
            }

        }

        //$this->render('sinvite', array('class' => $class));
    }

    /**
     * 我的班级-导入学生
     */
    public function actionSupload()
    {
        $id = (int)Yii::app()->request->getParam("cid");
        $class = JceClass::classInfo($id,1);
        $userid = Yii::app()->user->id;
        if(!$class){
            Yii::app()->msg->postMsg('error', '班级不存在');
            $this->redirect(Yii::app()->createUrl('class/index/'));
        }
        $userid=Yii::app()->user->id;
        if($class->masterUid!==$userid){
            Yii::app()->msg->postMsg('error', '你不是班主任没有权限操作');
            $this->redirect(Yii::app()->createUrl('/class/students/'.$id));
            exit();
        }
        $classStudents=JceClass::getClassMember($id,0);//这个班的所有学生
        $this->render('supload', array('class' => $class,'classnum'=>count($classStudents)));
    }

    /**
     * 我的班级-导入老师
     */
    public function actionTupload()
    {
        $id = (int)Yii::app()->request->getParam("cid");
        $teacher = Yii::app()->user->getInstance();
        $class = MClass::model()->findByPk($id);
        $userid = Yii::app()->user->id;
        $this->checkSeeClass($userid, $id); //检查是否有权限查看班级;
        $this->render('tupload', array('class' => $class));
    }

    /**
     * 我的班级-导入老师到数据库
     */
    public function actionTimport($id)
    {
        $teacher = Yii::app()->user->getInstance();
        $class = MClass::model()->findByPk($id);
        $uid = Yii::app()->user->id;
        $ty = Yii::app()->request->getParam('ty');
        $userid = $uid;
        $this->checkSeeClass($userid, $id); //检查是否有权限查看班级;v
        $cache = Yii::app()->cache;
        $userinfo = Member::model()->findByPk($userid);
        $Arr = $cache->get("class" . $id . "teacherupload" . $userid);
        if (!$Arr) $Arr = array();
        $total = 0;
        foreach ($Arr as $sitem) {
            if ($sitem['error'] == 0)
                $total++;
        }
        $resultArr = array('status' => 0, 'msg' => '', 'cid' => $id, 'url' => '', 'nums' => 0);
        if (!count($Arr)) {
            Yii::app()->msg->postMsg('error', '未检测到有效数据，请先下载模版填写无误后上传！');
            $url = Yii::app()->createUrl('class/tupload?cid=' . $id);
            $resultArr['url'] = $url;
            die(json_encode($resultArr));
        } else {
            if ($ty == 'import') {
                $totalPeople = ClassTeacherRelation::getClassTeacherNumByCid($class->cid) + ClassStudentRelation::countClassStudentNum($class->cid);
                $tmpTotal = $total + $totalPeople;
                if ($tmpTotal > Constant::CLASS_TOTAL) { //默认100
                    $sub = (Constant::CLASS_TOTAL - $totalPeople) < 0 ? 0 : (Constant::CLASS_TOTAL - $totalPeople);
                    Yii::app()->msg->postMsg('error', '班级成员上限100，目前还能导入' . $sub . '人');
                    $url = Yii::app()->createUrl('/class/tupload?cid=' . $id);
                    $resultArr['url'] = $url;
                    die(json_encode($resultArr));
                }
                if($tmpTotal<Constant::CLASS_MIN_TOTAL){
                    Yii::app()->msg->postMsg('error', '班级成员最少'.Constant::CLASS_MIN_TOTAL.'人,请继续添加人数再导入');
                    $url = Yii::app()->createUrl('/class/tupload?cid=' . $id);
                    $resultArr['url'] = $url;
                    die(json_encode($resultArr));
                }

                $nameArr = array();
                $mobileArr = array();
                $num = 0;
                $sendpwd = array();
                foreach ($Arr as $teacher) {
                    if ($teacher['error'] == 0) {
                        $result = MemberService::addTeacherByMobileAndName($teacher['mobile'], trim($teacher['name']), $id, $class);
                        if ($result) {
                                $sendpwd[] = $result;//array('mobile' => $result['mobile'], 'password' => $result['password'], 'name' => trim($teacher['name']));
                        }
                        if(!isset($result['isexists'])){
                            $num += 1;
                        }
                    }
                }
                $cache->delete("class" . $id . "teacherupload" . $userid);
                $cache->set("class" . $id . "teacheruploadsendpwd" . $userid, $sendpwd);
                $resultArr['status'] = 1;
                $resultArr['tmp'] = $result;
                $resultArr['url'] = Yii::app()->createUrl('class/sendpwd?cid=' . $id)."&view=view&type=2";
                die(json_encode($resultArr));
            }
        }
        $this->render('timport', array('total' => $total, 'data' => $Arr, 'class' => $class, 'userinfo' => $userinfo));
    }

    /**
     * 我的班级-导入学生到数据库
     */
    public function actionSimport($id)
    {
        $teacher = Yii::app()->user->getInstance();
        $uid = Yii::app()->user->id;
        $userid = $uid;
        $cache = Yii::app()->cache;
        $arr = $cache->get("class" . $id . "studentupload" . $userid);
        $studenttotal=0;
        $guardiantotal=0;
        $class=JceClass::classInfo($id,1);
        if(!$class){
            Yii::app()->msg->postMsg('error', '班级不存在');
            $this->redirect(Yii::app()->createUrl('class/index/'));
        }
        $userid=Yii::app()->user->id;
        if($class->masterUid!==$userid){
            Yii::app()->msg->postMsg('error', '你不是班主任没有权限操作');
            $this->redirect(Yii::app()->createUrl('/class/students/'.$id));
            exit();
        }


        //发送到接口，获取返回数据
        $result=JceClass::importStudent($arr,$id);
        if($result&&is_array($result)){
            $this->redirect(Yii::app()->createUrl("/class/students/$id.?import=1&totalstudent=".$result['totalstudent'].'&totalguardian='.$result['totalguardian']));
        }else{
            Yii::app()->msg->postMsg('error', '导入出错了，请重试');
            $this->redirect(Yii::app()->createUrl("/class/students/$id.?import=0&totalstudent=".$result['totalstudent'].'&totalguardian='.$result['totalguardian']));
        }


    }

    /*
     * 校验用户有没有权限操作班级，只有班主任才全权拥有权限，添加删除学生老师....
     * 如果不加这个，用户可以在浏览器中输入别的班级id操作 ,接口做检验
     */
    public function checkSeeClass($userid, $id)
    {
    }
    /*
    * 校验用户有没有权限操作班级，只有班主任才全权拥有权限，添加删除学生老师....,其它老师可以查看学生，老师数据
    * 如果不加这个，用户可以在浏览器中输入别的班级id操作
    */
    public function checkSeeClassView($userid, $id)
    {
    }

    /*
     *重新邀请学生或老师
     */
    public function actionInviteclassmates(){
        $userid = Yii::app()->user->id;
        $cid = (int)Yii::app()->request->getParam('cid');
        $type = Yii::app()->request->getParam('ty'); //1老师 2学生 （班级重新邀请）
        $this->checkSeeClass($userid, $cid);
        $class=MClass::model()->findByPk($cid);
        if(!$class){
            Yii::app()->msg->postMsg('error', '班级不存在');
            $this->redirect(array("class/index"));
            exit();
        }
        if($userid){
           $userinfo=Member::model()->findByPk($userid);
        }else{

        }
        $this->render("inviteclassmates",array('class'=>$class,'type'=>$type,'userinfo'=>$userinfo));
    }

    /**
     * 重新邀请学生或老师,数据处理
     * $cid classid
     * zengp 2014-12-27
     */
    public function actionAnewpinvite()
    {

    }

    /*
     * 老师或学生发送密码邀请处理
     */
    public function actionSendpwd()
    {
        $userid = Yii::app()->user->id;
        $cid = (int)Yii::app()->request->getParam("cid", '0');
        $import = (int)Yii::app()->request->getParam("import", '0');
        $userinfo=Yii::app()->user->getInstance();
        $class=JceClass::classInfo($cid,1);
        if(!$class){
            Yii::app()->msg->postMsg('error', '班级不存在');
            $this->redirect(Yii::app()->createUrl('/class/index/'));
            exit();
        }
        if($class->masterUid!=$userid){
            Yii::app()->msg->postMsg('error', '你不是班主任没有权限操作');
            $this->redirect(Yii::app()->createUrl('/class/students/'.$cid));
            exit();
        }
        $cache=Yii::app()->cache;
        $type = (int)Yii::app()->request->getParam("type", '0');
        //发给学生的短信内容　
       // Yii::import('application.extensions.PHPEmoji', 1);
        $root = yii::app()->basePath;
        require_once($root . '/extensions/PHPEmoji/emoji.php');
        $smscotent='各位家长你们好：我是'.$class->name.'的班主任'.$userinfo->name.'老师。班级通知、 家庭作业、考试成绩...都会从这里发给大家。请大家尽快下载班班手机应用：'.SITE_MSG_DOWNLOAD_SHORT_URL.'。下载后，登录您的账号：%s，密码：%s，就能找到咱们班了。客服电话：400 101 3838。 ';
        if($type==1){ //发给老师的
            $smscotent='各位老师你们好：我是'.$class->name.'的班主任'.$userinfo->name.'老师。班级通知、家庭作业、考试成绩...都可以从这里发给学生家长。请大家尽快下载班班手机应用：'.SITE_MSG_DOWNLOAD_SHORT_URL.'。下载后，登录 您的账号：%s，密码：%s，就能找到咱们班了。客服电话：400 101 3838。 ';
        }
        $smscotent=strip_tags(emoji_unified_to_html($smscotent));
        $mobiles=array();//要发的手机号
        $res=null;
        if($import==1||$import==2){ //导入,添加时的 /发送邀请　　１是导入时，取cache数据，这批要导入的，２是添加时，添加的学生
            if($import==1){
                $arr = $cache->get("class" . $cid . "studentupload" . $userid);
                if(!empty($arr) &&is_array($arr)){
                    foreach($arr as $val){
                        if($val['error']==0){
                            if($val['mobile']){
                                $mobiles[]=$val['mobile'];
                            }
                            if($val['mobile2']){
                                $mobiles[]=$val['mobile2'];
                            }
                            if($val['mobile3']){
                                $mobiles[]=$val['mobile3'];
                            }
                            if($val['mobile4']){
                                $mobiles[]=$val['mobile4'];
                            }
                            if($val['mobile5']){
                                $mobiles[]=$val['mobile5'];
                            }
                        }
                    }
                    $res=JceClass::sendInviteSms($mobiles,$smscotent,0);
                    $cache->delete("class" . $cid . "studentupload" . $userid);
                }
            }else if($import==2){ //添加的学生
                $vmobile=Yii::app()->request->getParam('mobiles','');
                //error_log("send:$vmobile");
                $sendexam=Yii::app()->request->getParam("sendexam");
                if($sendexam){
                    $smscotent= "家长你好：我是 ".$class->name." 的班主任".$userinfo->name."老师。有您的孩子的考试成绩已发给您，请您尽快登录班班手机应用查看。今后的班级通知、
                     家庭作业、考试成绩...都会从这里发给您。您的登陆账号：%s，密码：%s。若你还未未下载班班，下载地址：".SITE_APP_DOWNLOAD_SHORT_URL."。客服电话：400 101 3838。";
                }
                error_log($smscotent);
                $cache->set("sendexaminvitefamily-$cid-$userid",1,3600);//发送成绩时的判断
                $mobiles=explode(",",$vmobile);

                if(count($mobiles)>0){
                    $res=JceClass::sendInviteSms($mobiles,$smscotent,0);
                }
            }
        }else if($import==3){
            //点一键邀请学生老师
            $date=date("Y-m-d");
            $todayinvite=$cache->get("invitesmsclass.$date.$userid.$cid.$type");
            if($todayinvite){
                if($type==0){
                    Yii::app()->msg->postMsg('error', '班主任一天针对一个班只能邀请一次学生');
                }else{
                    Yii::app()->msg->postMsg('error', '班主任一天针对一个班只能邀请一次老师');
                }
                if($type==0){
                    $this->redirect(Yii::app()->createUrl('/class/students/'.$cid));
                }else{
                    $this->redirect(Yii::app()->createUrl('/class/teachers/'.$cid));
                }
                exit();
            }

            $members=JceClass::getClassMember($cid,$type);
            if($type==0){ //学生，取家长未激活的
                foreach($members as $student){
                    if(is_array($student->vFamilys)){
                        foreach($student->vFamilys as $family){
                            if($family->loginstatus==0){
                                $mobiles[]=$family->mobilePhone;
                            }
                        }
                    }
                }
            }else{
                foreach($members as $teacher){ //老师,都老师未激活的
                    if($teacher->loginstatus==0){
                        $mobiles[]=$teacher->mobilePhone;
                    }
                }
            }

           // error_log("send mobile:".implode(",",$mobiles)." content:".$smscotent);
            $res=JceClass::sendInviteSms($mobiles,$smscotent,$type);
            $cache->set("invitesmsclass.$date.$userid.$cid.$type",'1',3600*24);
        }
        $ajax=Yii::app()->request->getParam('ajax',0);
        if($res){
            if($ajax){
                die(json_encode(array('status'=>$type==0?1:0,'total'=>isset($res['total'])?$res['total']:0)));
            }
            if($type==0){
                Yii::app()->msg->postMsg('success', '已成功给'.$res['total'].'名家长及关注人发送短信邀请');
            }else{
                Yii::app()->msg->postMsg('success', '已成功给'.$res['total'].'名任课老师发送短信邀请');
            }
        }else{
            if($type==0){
                Yii::app()->msg->postMsg('error', '给家长及关注人发送短信邀请失败');
            }else{
                Yii::app()->msg->postMsg('error', '给任课老师发送短信邀请失败');
            }
        }


        if($type==0){
            $this->redirect(Yii::app()->createUrl('/class/students/'.$cid));
        }else{
            $this->redirect(Yii::app()->createUrl('/class/teachers/'.$cid));
        }
        exit();
    }

    /*
       * 读取上传的学生excel
       */
    public function actionScheck()
    {
        $id = Yii::app()->request->getParam('cid');
        $userid = Yii::app()->request->getParam('uid');
        $classStudents=JceClass::getClassMember($id,0);//这个班的所有学生
        $classStudentsArr=array();
        $studentids=array();
        foreach($classStudents as $val){
            $classStudentsArr[]=$val->name;
            // $studentids[]=$val->sid;
        }
        $userid = $userid ? $userid : Yii::app()->user->id;
        if (isset($_FILES['file'])) {
            $uploadfile = $_FILES['file']['tmp_name'];
            Yii::$enableIncludePath = false;
            Yii::import('application.extensions.PHPExcel', 1);
            require_once(PHPEXCEL_ROOT . 'PHPExcel/IOFactory.php');
            require_once(PHPEXCEL_ROOT . 'PHPExcel/Reader/Excel2007.php');
            require_once(PHPEXCEL_ROOT . 'PHPExcel/Reader/Excel5.php');

            $objPHPExcel = new PHPExcel();
            $objReader = PHPExcel_IOFactory::createReader('Excel2007');
            if(!$objReader->canRead($uploadfile)){
               $objReader = PHPExcel_IOFactory::createReader('Excel5');
            }
            $objReader->setReadDataOnly(true);
            $objPHPExcel = $objReader->load($uploadfile);
            $objPHPExcel->setActiveSheetIndex(0);
            $ActiveSheet = $objPHPExcel->getActiveSheet();
            $max = $objPHPExcel->getActiveSheet()->getHighestRow();
            //if ($member->createtype == 1) {
               // $max = $max > 100 ? 101 : $max; //自注册班级成员不能超过100
            //}
            $dataArr = array();
            $uniqueArr = array();
            $repeatnames=array();
            $names=array();
            for ($row = 2; $row <= $max; $row++) {
                $name = $objPHPExcel->getActiveSheet()->getCellByColumnAndRow(0, $row)->getValue();
                $mobile = trim($objPHPExcel->getActiveSheet()->getCellByColumnAndRow(1, $row)->getValue());
                $mobile2 = trim($objPHPExcel->getActiveSheet()->getCellByColumnAndRow(2, $row)->getValue());
                $mobile3 = trim($objPHPExcel->getActiveSheet()->getCellByColumnAndRow(3, $row)->getValue());
                $mobile4 = trim($objPHPExcel->getActiveSheet()->getCellByColumnAndRow(4, $row)->getValue());
                $mobile5 = trim($objPHPExcel->getActiveSheet()->getCellByColumnAndRow(5, $row)->getValue());
                $mobile=preg_replace("/ /", '', $mobile);//去中文空格
                $mobile2=preg_replace("/[ ]+/", '', $mobile2);
                error_log("[$mobile2]");
                $mobile3=preg_replace("/ /", '', $mobile3);
                $mobile4=preg_replace("/ /", '', $mobile4);
                $mobile5=preg_replace("/ /", '', $mobile5);
                $studentid = '';//trim($objPHPExcel->getActiveSheet()->getCellByColumnAndRow(1, $row)->getValue());//学号
                $seque = $row - 1;
                $student_guardians=array();
                $isreightphone=true;
                $name = trim(mb_substr($name, 0, 8, 'utf-8'));
                if (!CheckHelper::IsMobile($mobile)) {
                    $mobile=$mobile.":X";
                    $isreightphone=false;
                }
                if(empty($mobile2)&&empty($mobile3)&&empty($mobile4)&&empty($mobile5)){
                   // array_push($dataArr, array('name' => $name, 'mobile' => $mobile,'mobile2' => $mobile2,'mobile3' => $mobile3,'mobile4' => $mobile4,'mobile5' => $mobile5,'studentid'=>$studentid,'error' => 0, 'seque' => $seque, 'msg' => ''));
                }else{
                    if($mobile2){
                        if (!CheckHelper::IsMobile($mobile2)) {
                            $mobile2=$mobile2.":X";
                            $isreightphone=false;
                        }
                    }
                    if($mobile3){
                        if (!CheckHelper::IsMobile($mobile3)) {
                            $mobile3=$mobile3.":X";
                            $isreightphone=false;
                        }
                    }
                    if($mobile4){
                        if (!CheckHelper::IsMobile($mobile4)) {
                            $mobile4=$mobile4.":X";
                            $isreightphone=false;
                        }
                    }
                    if($mobile5){
                        if (!CheckHelper::IsMobile($mobile5)) {
                            $mobile5=$mobile5.":X";
                            $isreightphone=false;
                        }
                    }
                }
                if(empty($name)){
                    array_push($dataArr, array('name' => $name, 'mobile' => $mobile,'mobile2' => $mobile2,'mobile3' => $mobile3,'mobile4' => $mobile4,'mobile5' => $mobile5, 'studentid'=>$studentid,'error' => 1, 'seque' => $seque, 'msg' => '姓名未填写','errorfile'=>1));
                    continue;
                }
                if(in_array($name,$classStudentsArr)){
                    array_push($dataArr, array('name' => $name, 'mobile' => $mobile,'mobile2' => $mobile2,'mobile3' => $mobile3,'mobile4' => $mobile4,'mobile5' => $mobile5, 'studentid'=>$studentid,'error' => 1, 'seque' => $seque, 'msg' => '该学生已经存在','errorfile'=>1));
                    continue;
                }

                if ($name) {

                    if(!in_array($name,$names)){
                        $names[]=$name;
                        if($isreightphone){
                           array_push($dataArr, array('name' => $name, 'mobile' => $mobile,'mobile2' => $mobile2,'mobile3' => $mobile3,'mobile4' => $mobile4,'mobile5' => $mobile5, 'studentid'=>$studentid,'error' => 0, 'seque' => $seque, 'msg' => '','errorfile'=>0));
                        }else{
                            array_push($dataArr, array('name' => $name, 'mobile' => $mobile,'mobile2' => $mobile2,'mobile3' => $mobile3,'mobile4' => $mobile4,'mobile5' => $mobile5, 'studentid'=>$studentid,'error' => 1, 'seque' => $seque, 'msg' => '格式有误','errorfile'=>0));
                        }
                    }else{
                        $repeatnames[]=$name;
                        array_push($dataArr, array('name' => $name, 'mobile' => $mobile,'mobile2' => $mobile2,'mobile3' => $mobile3,'mobile4' => $mobile4,'mobile5' => $mobile5, 'studentid'=>$studentid,'error' => 1, 'seque' => $seque, 'msg' => '表格中有重名','errorfile'=>1));
                    }
                }
            }
          //  error_log(json_encode($repeatnames,JSON_UNESCAPED_UNICODE));
            foreach($dataArr as $k=>$val){
                //error_log($val['name']);
                if(in_array($val['name'],$repeatnames)){
                    //error_log('sss:'.$k.":".json_encode($dataArr[$k],JSON_UNESCAPED_UNICODE));
                    $dataArr[$k]['error']=1;
                    $dataArr[$k]['errorfile']=1;
                    $dataArr[$k]['msg']='表格中有重名';
                }
            }
            $cache = Yii::app()->cache;
            $cache->set("class" . $id . "studentupload" . $userid, $dataArr);
            echo json_encode(array('status'=>1,'data'=>$dataArr,'oldnum'=>count($classStudentsArr)));
            //echo count($dataArr);
        } else {
            echo 0;
        }
    }

    /*
     * 读取上传的老师excel
     */
    public function actionTcheck()
    {
        $id = Yii::app()->request->getParam('cid');
        $userid = Yii::app()->request->getParam('uid');
        $userid = $userid ? $userid : Yii::app()->user->id;
        if (isset($_FILES['Filedata'])) {
            $uploadfile = $_FILES['Filedata']['tmp_name'];
            Yii::$enableIncludePath = false;
            Yii::import('application.extensions.PHPExcel', 1);
            require_once(PHPEXCEL_ROOT . 'PHPExcel/IOFactory.php');
            require_once(PHPEXCEL_ROOT . 'PHPExcel/Reader/Excel5.php');
            require_once(PHPEXCEL_ROOT . 'PHPExcel/Reader/Excel2007.php');
            $objPHPExcel = new PHPExcel();
            $objReader = PHPExcel_IOFactory::createReader('Excel2007');
            if(!$objReader->canRead($uploadfile)){
                $objReader = PHPExcel_IOFactory::createReader('Excel5');
            }
            $objReader->setReadDataOnly(true);
            $objPHPExcel = $objReader->load($uploadfile);
            $objPHPExcel->setActiveSheetIndex(0);
            $ActiveSheet = $objPHPExcel->getActiveSheet();
            $max = $objPHPExcel->getActiveSheet()->getHighestRow();
            $dataArr = array();
            $uniqueArr = array();
            for ($row = 2; $row <= $max; $row++) {
                $name = $objPHPExcel->getActiveSheet()->getCellByColumnAndRow(0, $row)->getValue();
                $mobile = $objPHPExcel->getActiveSheet()->getCellByColumnAndRow(1, $row)->getValue();
                $seque = $row - 1;
                if ($name && $mobile && CheckHelper::IsMobile($mobile)) {
                    if (!in_array($name . $mobile, $uniqueArr)) {
                        $uniqueArr[] = $name . $mobile;
                        array_push($dataArr, array('name' => $name, 'mobile' => $mobile, 'error' => 0, 'seque' => $seque, 'msg' => ''));
                    } else {
                        array_push($dataArr, array('name' => $name, 'mobile' => $mobile, 'error' => 1, 'seque' => $seque, 'msg' => '手机名字重复'));
                    }

                } else {
                    array_push($dataArr, array('name' => $name, 'mobile' => $mobile, 'error' => 1, 'seque' => $seque, 'msg' => '手机或名字不正确'));
                }
            }
            $cache = Yii::app()->cache;
            $cache->set("class" . $id . "teacherupload" . $userid, MainHelper::multi_unique($dataArr));
            echo count($dataArr);
        } else {
            echo 0;
        }
    }

    /**
     * 我的班级-移除老师
     * $id-- userid
     * panrj 2014-08-09
     */
    public function actionRemoveteacher($id)
    {
        $cid = Yii::app()->request->getParam('cid');
        $responne = JceClass::deleteClassMember($cid, 1,$id); // 1 为老师
        if ( $responne->iResult->val == RES_SUCCEED) {
            Yii::app()->msg->postMsg('success', '操作成功');
        } else {
            Yii::app()->msg->postMsg('error', '操作失败');
        }
        $this->redirect(Yii::app()->createUrl('class/teachers/' . $cid));

    }

    /**
     * 我的班级-移除学生
     * panrj 2014-08-09
     * $id 学生userid
     */
    public function actionRemovestudent($id)
    {
        $cid = Yii::app()->request->getParam('cid');
        $responne = JceClass::deleteClassMember($cid, 0,$id); // 0 为学生
        if ( $responne->iResult->val == RES_SUCCEED) {
            Yii::app()->msg->postMsg('success', '操作成功');
        }else{
            Yii::app()->msg->postMsg('error', '操作失败');            
        }
        $this->redirect(Yii::app()->request->urlReferrer?Yii::app()->request->urlReferrer:Yii::app()->createUrl('class/students/' . $cid));
    }

    public function actionScupload()
    {
        $id = (int)Yii::app()->request->getParam("cid");
        $class = MClass::model()->findByPk($id);
        $userid = Yii::app()->user->id;
        $this->checkSeeClass($userid, $id); //检查是否有权限操作班级;
        $userid = Yii::app()->user->id;
        $this->checkSeeClass($userid, $id); //检查是否有权限查看班级;
        $this->render('scupload', array('class' => $class));
    }

    /**
     * 我的班级-导入学生到数据库
     */
    public function actionScimport($id)
    {

    }

    public function actionScfinish($id)
    {

    }

    //非班主任(任课老师)进入学生，老师页面,合并到stuents,teachers中，不合并，调个css,js难

    //家长也不需要，到时要删除



    /**
     * 我的班级-解散班级
     * panrj 2014-08-09
     */
    public function actionDepart($id)
    {
        $userid=Yii::app()->user->id;
        $class=JceClass::classInfo($id,0);
        if($userid!=$class->masterUid){
            Yii::app()->msg->postMsg('error', '你不是班主任');
            $this->redirect(Yii::app()->createUrl('class/index/'));
            exit();
        }
        $response = JceClass::dismissClass($id);
        if( $response->iResult->val == RES_SUCCEED ){
            Yii::app()->msg->postMsg('success', '操作成功');
            $this->redirect(Yii::app()->createUrl('class/index'));
        }
        else{
            Yii::app()->msg->postMsg('error', '操作失败:'.$response->sMessage->val);
            $this->redirect(Yii::app()->createUrl('class/index'));
        }
    }



    /**
     * 我的班级-更换班主任
     * panrj 2014-08-09
     */
    public function actionMaster($id)
    {
        $class =JceClass::classInfo($id,1);

        $userid=Yii::app()->user->id;
        $isMaster=$class->masterUid==$userid?true:false;//$this->checkIsMaster($userid,$id,null); //判断我在班级老师中是不是班主任
        if(!$isMaster){
            Yii::app()->msg->postMsg('error', '你不是班主任');
            $this->redirect(Yii::app()->createUrl('class/index/'));
        }

        $uid =isset($_POST['uid'])?$_POST['uid']:0;
        if(!$uid){
            Yii::app()->msg->postMsg('error', '请选择转让老师 ');
            $this->redirect(Yii::app()->createUrl('class/mastersetting/'.$id));
        }
        if($uid==$userid){
            Yii::app()->msg->postMsg('error', '你已是该班的班主任');
            $this->redirect(Yii::app()->createUrl('class/index/'));
            exit();
        }

        $userinfo=JceUser::getUserInfo($uid);
        if(!$userinfo){
            Yii::app()->msg->postMsg('error', '请选择班主任');
            $this->redirect(Yii::app()->createUrl('class/mastersetting/'.$id));
        }
        if(empty($userinfo->mobilephone)){
            Yii::app()->msg->postMsg('error', '此用户还没绑定手机号');
            $this->redirect(Yii::app()->createUrl('class/mastersetting/'.$id));
        }
        if ($uid&&$class) {
          //  $userinfo = JceUser::getUserInfo($uid);
            $res=JceClass::classSetting($id,3,array('uid'=>$uid));
            if($res=='0'){
                Yii::app()->msg->postMsg('success', '更换成功');
                $this->redirect(Yii::app()->createUrl('class/classinfo?cid='.$id));
            }else if($res=='3089'){
                Yii::app()->msg->postMsg('error', '更换失败,'.$userinfo->name."已是三个班的班主任");
                $this->redirect(Yii::app()->createUrl('class/mastersetting/'.$id));
            }else{
                Yii::app()->msg->postMsg('error', '更换失败');
                $this->redirect(Yii::app()->createUrl('class/mastersetting/'.$id));
            }

        } else {
            Yii::app()->msg->postMsg('error', '请选择班主任');
            $this->redirect(Yii::app()->createUrl('class/mastersetting/'.$id));
        }

    }

    //学生监护人页面
    public function actionGuardians($id)
    {
        $cid = Yii::app()->request->getParam("cid", 0);
        $class = MClass::model()->findByPk($cid);
        $childinfo = Member::model()->findByPk($id);
        $guardians = Guardian::getChildGuardianRelationInFirst($id);

        // 是否本人权限检测
        if( isset($guardians[0]['guardian']) && Yii::app()->user->id !== $guardians[0]['guardian'] ){
            Yii::app()->msg->postMsg('error', '你没有权限进入此班');
            $this->redirect( Yii::app()->createUrl('class/index/') );
        }
        
        //是否修改孩子姓名
        $childname = isset($_POST['childname'])?trim($_POST['childname']):'';
        $userinfo = Member::model()->findByPk(Yii::app()->user->id);
        if ($childname && $childname != $childinfo->name) {
            $childinfo->name = $childname;
            $childinfo->save();
        }
        if(isset($_POST['firstid'])&&isset($_POST['firstrole'])){
            $firstguardian=Guardian::model()->findByPk((int)$_POST['firstid']);
            if($firstguardian){
                $firstrole=trim($_POST['firstrole'])?trim($_POST['firstrole']):'家长';
                if($firstguardian->role!=trim($_POST['firstrole'])){
                    $firstguardian->role=$firstrole;
                    $firstguardian->save();
                }
            }
        }

        if (isset($_POST['Student'])) {
            $roles = $_POST['Student']['name'];
            $mobiles = $_POST['Student']['mobile'];
            $nums=count($guardians)+count($mobiles);
            if($nums>5){
                Yii::app()->msg->postMsg('error', '学生最多添加5个家属');
                $this->redirect(Yii::app()->createUrl('class/guardians/' . $id . "?cid=" . $cid));
                exit();
            }

            $cid = $_POST['cid'];
            $class = MClass::model()->findByPk($cid);
            $num = 0;
            for ($i = 0, $len = count($mobiles); $i < $len; $i++) {
                $mobile = $mobiles[$i];
                $member = Member::getUniqueMember($mobile);
                if ($member) { //已存在
                    $newidentity=Member::transIdentity(4,$member->identity);
                    $member->identity=$newidentity;
                    $member->save();
                    if (!Guardian::getRelationByChildGuardian($member->userid, $id)) {
                        $guardian = new Guardian;
                        $guardian->child = $id;
                        $guardian->guardian = $member->userid;
                        $guardian->role = $roles[$i] ? $roles[$i] : '关注人';
                        $guardian->main = 0;
                        $guardian->save();
                    }
                } else {
                    $userid = UCQuery::makeMaxId(0, true);
                    $member = new Member;
                    $member->userid = $userid;
                    $member->state = 1;
                    $member->name = '用户' . substr($mobile, -4); //$_POST['Student']['name'] . '的' . $roles[$i];
                    $member->identity = Constant::FAMILY_IDENTITY; //家长标志;
                    $member->mobilephone = $mobile;
                    $member->account = "p" . $userid; //;aa
                    $member->issendpwd = 0;
                    $password = MainHelper::generate_code(6);
                    $member->pwd = MainHelper::encryPassword($password);
                    $member->createtype = 1;
                    if ($member->save()) {
                        $str = sprintf(Constant::getPublicSendPwdSms(),$mobile , $password);
                        UCQuery::sendMobileMsg($mobile, $str);
                        $guardian = new Guardian;
                        $guardian->child = $id;
                        $guardian->guardian = $userid;
                        $guardian->role = $roles[$i] ? $roles[$i] : '家长';
                        $guardian->main = 0;
                        $guardian->save();
                    }
                }
                $num++;
            }
            Yii::app()->msg->postMsg('success', '成功添加家属' . $num . '名');
            $this->redirect(Yii::app()->createUrl('class/guardians/' . $id . "?cid=" . $cid));
            exit();
        }else if(isset($_POST['firstid'])){
            Yii::app()->msg->postMsg('success', '修改成功');
            $this->redirect(Yii::app()->createUrl('class/guardians/' . $id . "?cid=" . $cid."&time=".time()));
            exit();
        }

        $this->render ( 'guardians', array (
				'guardians' => $guardians,
				'childinfo' => $childinfo,
				'class' => $class,
				'action' => Yii::app()->request->getParam('gtype', 0) == 0? 'guardianstudents':'followclassstudents',
				'userinfo' => $userinfo,
        		'gtype' => Yii::app()->request->getParam('gtype', 0)
		) );
    }
    //学生监护人页面
    public function actionDelguardian($id){
        $cid = Yii::app()->request->getParam("cid", 0);
        $childid = Yii::app()->request->getParam("childid", 0);
        $guardian=Guardian::model()->findByPk($id);
        $guardian->deleted=1;
        if($guardian->save()){
            Yii::app()->msg->postMsg('success', '删除成功' );
            $this->redirect(Yii::app()->createUrl('class/guardians/' . $childid . "?cid=" . $cid));
        }else{
            Yii::app()->msg->postMsg('error', '删除失败' );
            $this->redirect(Yii::app()->createUrl('class/guardians/' . $childid . "?cid=" . $cid));
        }
    }
    //查询某个人的班主任个数，用来弹框错误提示
    public function actionUidmaster(){
        $uid=(int)Yii::app()->request->getParam("uid",0);
        if($uid){
            $mymasternum = ClassTeacherRelation::model()->countByAttributes(array('deleted' => 0, 'teacher' => $uid,'type'=>1));;
            $userinfo=Member::model()->findByPk($uid);
            if ($mymasternum >= 3) {
                die(json_encode(array('status'=>'0','name'=>$userinfo->name)));
            }else{
                die(json_encode(array('status'=>'1')));
            }
        }
    }

    /**
     * 退出班级
     * @param int $cid
     */
    public function  actionLeaveclass($cid){
        $cid = Yii::app()->request->getParam("cid",0);
        $type = Yii::app()->request->getParam("type", 0);
        $studentid = Yii::app()->request->getParam("studentid", 0);
        if( false == in_array($type, [0,1]) ){  // 0 老师  1 学生及家长
        	Yii::app()->msg->postMsg('success', '退出班级失败');
        	$this->redirect(Yii::app()->request->urlReferrer);
        	Yii::app()->end();
        }
        $respone = JceClass::exitClass($cid, $type, $studentid); // 0 老师  1 学生及家长
        if( $respone->iResult->val == RES_SUCCEED ){
           Yii::app()->msg->postMsg('success', '退出班级成功');
           $this->redirect(Yii::app()->createUrl('class/index'));
        }else{
           Yii::app()->msg->postMsg('success', '退出班级失败');
           $this->redirect(Yii::app()->request->urlReferrer);
        }
    }
    
    /*
     * 学号修改
     */
    public function actionUpdatestudentid(){
        $result=array('status'=>'0','msg'=>'','data'=>array());
        $userid = Yii::app()->user->id;
        if(isset($_POST['cid'])&&isset($_POST['userid'])&&isset($_POST['studentid'])){
            $cid=(int)$_POST['cid'];
            $studentuserid=trim($_POST['userid']);
            $studentid=trim($_POST['studentid']);
            $this->checkSeeClass($userid,$cid);
            $res=JceClass::setStudentNumber($studentuserid,$studentid);
            if($res->iResult==0){
                $result['status']='1';
            }
        }
        die(json_encode($result));

    }
    
    /*
     * 科目修改
     */
    public function actionUpdatesubject(){
        $result=array('status'=>'0','msg'=>'','data'=>array());
        $userid = Yii::app()->user->id;
        if(isset($_POST['cid'])&&isset($_POST['userid'])&&isset($_POST['subject'])){
            $cid=(int)$_POST['cid'];
            $teacherId=trim($_POST['userid']);
            $newSubject=trim($_POST['subject']);
            $res=JceClass::setTeacherSubject($cid, $teacherId, $newSubject);
            if($res->iResult==0){
                $result['status']='1';
            }
        }
        die(json_encode($result));
    
    }

    //班级属性
    public function actionClassinfo()
    {
        $cid = Yii::app()->request->getParam('cid');
        $ac = Yii::app()->request->getParam('ac');
        $class = JceClass::classInfo($cid, $ac);
        $studentmember=JceClass::getClassMember($cid,0);
        $teachermember=JceClass::getClassMember($cid,1);
        $studentnum=is_array($studentmember)?count($studentmember):0;
        $studentnum=$studentnum+count($teachermember);
        $uid=Yii::app()->user->id;
        $isMaster=$class->masterUid==$uid?true:false;//$this->checkIsMaster($uid,$cid,null);
        $grades = BaseArea::AllGrades();
        if(false != $class){
            $gradeStypeStr = '需完善信息';
            $areaStr = '需完善信息';
            if(array_key_exists($class->grade,$grades)){
                $gradeStypeStr=$grades[$class->grade];
            }
//            $schooltype = JceClass::getSchoolTypes();
//            if($class->stid != 10){
//                foreach($schooltype as $stype){
//                    if($stype->stid == $class->stid)
//                        $gradeStypeStr = $stype->name;
//                }
//            }

            $currAreaIds = array('provId'=>0, 'cityId'=>0, 'areaId'=>0);
            $schoolInfo=array('name'=>$class->tSchool?$class->tSchool->name:'');
            if($class && $class->tSchool->scid != 1){
                $areaid=$class->tSchool->aid;
                if($class->tSchool->scid&&strlen($areaid)==6){
                    $currAreaIds['provId'] = substr($areaid,0,2)."0000";
                    $currAreaIds['cityId'] = substr($areaid,0,4).'00';
                    $currAreaIds['areaId'] = $areaid;
                    $provinceId= $currAreaIds['provId'];
                    $cityId= $currAreaIds['cityId'];
                }else{
                    $currAreaIds['provId'] = 0;
                    $currAreaIds['cityId'] = 0;
                    $currAreaIds['areaId'] = $areaid;
                }
            }
            $cache = Yii::app()->cache;
            $province_list = $cache->get("all_province_list");
            $city_list = $cache->get("city_list");
            $area_list = $cache->get("area_list");
            if (empty($province_list)) {
                $areas=BaseArea::getProvinceCity();
                $province_list=array();
                foreach($areas as $k=>$v){
                    $province_list[]=array('aid'=>$k,'name'=>$v['name']);
                }
                $cache->set("all_province_list", $province_list);
            }
            if(isset($provinceId)){
                if(empty($areas)){
                    $areas=BaseArea::getProvinceCity();
                }
                $city_list = isset($areas[$provinceId])?$areas[$provinceId]:array();
                $city_list=isset($city_list['citys'])?$city_list['citys']:array();
            }else{
                $city_list = array();
            }

            if($currAreaIds['provId'] > 0){

                foreach ($province_list as $proItem) {
                    if($proItem['aid'] == $currAreaIds['provId']){
                        $areaStr = $proItem['name'];
                    }
                }
                foreach ($city_list as $cityItem) {
                    if($cityItem['aid'] == $currAreaIds['cityId']){
                        $areaStr .= $cityItem['name']=='县'?'':$cityItem['name'];
                    }
                }
//                foreach ($area_list as $areaItem) {
//                    if($areaItem['aid'] == $currAreaIds['areaId']){
//                        $areaStr .= $areaItem['name'];
//                    }
//                }
            }
            $this->render('classinfo', array(
                'class' => $class,
                'schooltype' => null,
                'gradeStypeStr' => $gradeStypeStr,
                'grades' => $grades,
                'gradeInfo' => null,
                'schoolInfo' => $schoolInfo,
                'province_list' => $province_list,
                'city_list' => $city_list,
                'area_list' => $area_list,
                'currAreaIds' => $currAreaIds,
                'areaStr' => $areaStr,
                'ac' => $ac,
                'isMaster' => $isMaster,
                'studentnum'=>$studentnum,
                'from'=>Yii::app()->request->getParam('from')?Yii::app()->request->getParam('from'):'students'
            ));
        }else{
            Yii::app()->msg->postMsg('error', '未找到相应班级');
            $this->redirect(Yii::app()->createUrl('class/index'));
        }

        
        
    }
    
    /**
     * 班级属性-班级名称、年级设置 
     */
    public function actionGradesetting()
    {
        $cid = Yii::app()->request->getParam('cid');
        $ac = Yii::app()->request->getParam('ac');
        
        if($_POST && isset($_POST['Class'])){
            $params['classname'] = $_POST['Class']['name'];
            $params['stid'] = isset($_POST['Class']['stid'])?$_POST['Class']['stid']:0;
            $params['gid'] = isset($_POST['Class']['grade'])?$_POST['Class']['grade']:0;
            $cid = $_POST['Class']['cid'];
           /// D($params);
            $result = JceClass::classSetting($cid, self::CLASS_CHANGE_CLASS_NAME, $params);

            if($result == 0){
                Yii::app()->msg->postMsg('success', '修改成功');
                $this->redirect(Yii::app()->createUrl('class/gradesetting', array('cid'=>$cid, 'ac'=>$ac)));
            }else{
                Yii::app()->msg->postMsg('error', '修改失败');
                $this->redirect(Yii::app()->createUrl('class/gradesetting', array('cid'=>$cid, 'ac'=>$ac)));
            }
        }
        
        $class = JceClass::classInfo($cid, 1);
        if(!$class){
            Yii::app()->msg->postMsg('error', '修改失败,班级不存在');
            $this->redirect(Yii::app()->createUrl('class/index'));
        }
        $gradeInfo = null;
        $grades = BaseArea::AllGrades();
        $gradeInfo = $class->grade;
        $schooltype =null;// JceClass::getSchoolTypes();
        $this->render('gradesetting', array(
            'class' => $class,
            'schooltype' => $schooltype,
            'grades' => $grades,
            'gradeInfo' => $gradeInfo,
            'ac' => $ac,
        ));
    }
    
    /**
     * 班级属性-学校信息设置
     */
    public function actionSchoolsetting()
    {
        
        $cid = Yii::app()->request->getParam('cid');
        $ac = Yii::app()->request->getParam('ac');
        
        if($_POST && isset($_POST['Class'])){
            $params['scid'] = $_POST['Class']['schoolid'];
            $params['name'] = trim($_POST['Class']['schoolname']);
            $params['aid'] = isset($_POST['Class']['aid'])?$_POST['Class']['aid']:0;
            if(empty($params['aid'])){
                $params['aid']=$_POST['Class']['pid'];
            }
            $cid = $_POST['Class']['cid'];
            $result = JceClass::classSetting($cid, self::CLASS_CHANGE_SCHOOL, $params);
            if($result == 0){
                Yii::app()->msg->postMsg('success', '修改成功');
                $this->redirect(Yii::app()->createUrl('class/schoolsetting', array('cid'=>$cid, 'ac'=>$ac)));
            }else{
                Yii::app()->msg->postMsg('error', '修改失败');
                $this->redirect(Yii::app()->createUrl('class/schoolsetting', array('cid'=>$cid, 'ac'=>$ac)));
            }
        }
        $provinceId=0;
        $cityId=0;
        $class = JceClass::classInfo($cid, 1);
        if($class&&$class->tSchool){
            $areaid=$class->tSchool->aid;
            if($areaid&&strlen($areaid)==6){
                $currAreaIds['provId'] = substr($areaid,0,2)."0000";
                $currAreaIds['cityId'] = substr($areaid,0,4).'00';
                $currAreaIds['areaId'] = $areaid;
                $provinceId= $currAreaIds['provId'];
                $cityId= $currAreaIds['cityId'];
            }else{
                $currAreaIds['provId'] = 0;
                $currAreaIds['cityId'] = 0;
                $currAreaIds['areaId'] = $areaid;
            }
        }


        $uname = Yii::app()->user->getRealName();
        $userid = Yii::app()->user->id;
        
       // $schooltype = SchoolType::getSchoolTypeData(); //所有学校类型
        $cache = Yii::app()->cache;
        $province_list = array();
        $city_list =array();
        $area_list = array();
        $areas=array();
        if (empty($province_list)) {
            $areas=BaseArea::getProvinceCity();
            $province_list=array();
            foreach($areas as $k=>$v){
                $province_list[]=array('aid'=>$k,'name'=>$v['name']);
            }
        }
        if(isset($provinceId)){
            if(empty($areas)){
                $areas=BaseArea::getProvinceCity();
            }
            $city_list = isset($areas[$provinceId])?$areas[$provinceId]:array();
            $city_list=isset($city_list['citys'])?$city_list['citys']:array();
        }else{
            $city_list = array();
        }
        
        
        $this->render('schoolsetting', array(
            'class' => $class,
            'schooltype' => null,
            'schoolInfo' => null,
            'province_list' => $province_list,
            'city_list' => $city_list,
            'area_list' => $area_list,
            'currAreaIds' => $currAreaIds,
            'ac' => $ac,
        ));
        
    }
    
    /**
     * 班级属性-入班设置
     */
    public function actionInclasssetting()
    {
        $cid = Yii::app()->request->getParam('cid');
        $ac = Yii::app()->request->getParam('ac');
                
        if($_POST && isset($_POST['Class'])){
            $cid = $_POST['Class']['cid'];
            $ac = $_POST['ac'];
            $result = JceClass::classSetting($cid, self::CLASS_CHANGE_INCLASS, array('validate'=>$_POST['Class']['inclass']));
            if($result == 0){
                Yii::app()->msg->postMsg('success', '修改成功');
                $this->redirect(Yii::app()->createUrl('class/inclasssetting', array('cid'=>$cid, 'ac'=>$ac)));
            }else{
                Yii::app()->msg->postMsg('error', '修改失败');
                $this->redirect(Yii::app()->createUrl('class/inclasssetting', array('cid'=>$cid, 'ac'=>$ac)));
            }
        }
        
        $class = JceClass::classInfo($cid, 1);
        
        $this->render('inclasssetting', array(
            'class' => $class,
            'ac' => $ac,
        ));
    }
    
    /**
     * 入班申请列表
     */
    public function actionApplyList()
    {
    	$page = Yii::app()->request->getParam('page', 1);
    	$total = Yii::app()->request->getParam('total', 0);
    	$maxIndex = Yii::app()->request->getParam('maxIndex', 0);
    	$pageSize = 10;
        $data=null;
        if($page==1){
            $res = JceClass::getAuditRecords( Yii::app()->user->id, 1, 0);
            $total=$res['total']?$res['total']:0;
            $data=$res['data'];
            $maxIndex=isset($data[0])?$data[0]->index:0;
        }else{
            if($total>0){
                $index=$maxIndex-($page-1)*$pageSize;
                if($index<0) $index=0;
                $res = JceClass::getAuditRecords( Yii::app()->user->id, Constant::DIRECTION_DOWN, $index );
                if(isset($res['data'])){
                    $data=$res['data'];
                }
            }
        }
    	$hintCreateTime = 0;
    	$one = 0;
    	if( false !== $data ){
    	    foreach ( $data as $k => $v ){
    	        if( 0 == $v->status && 0 == $hintCreateTime && 0 == $one ){
    	            $hintCreateTime = $v->createTime ;
    	            $one = 1;  // 这里只取第一条
    	            Yii::app()->cache->set( JceClass::NEW_AUDIT_HINT_COUNT, $hintCreateTime ); // 记录数，为下次新消息准备
    	        }
    			if( $v->createTime ){
    			    $createTime = date('Y-m-d H:i:s', $v->createTime );
    			    $data[$k]->createTime = date('Y-m-d', $v->createTime ) == date('Y-m-d') ? '今天'.date('H:i:s',$v->createTime ) : $createTime;
    			}
    		}
    	}
		$data = $data ? $data: [];
		$cid = Yii::app()->request->getParam('cid');
		$pid = Yii::app()->request->getParam('mid');
		$flag = Yii::app()->request->getParam('flag');
		if(isset($_REQUEST['mid'])&&isset($_REQUEST['cid'])  ){
			$msg = '审核失败';
			if(  true == $cid && true == $pid ) {
				$response = JceClass::verifyJionClass( $pid, $flag, $cid );
				if( $response->iResult->val == RES_SUCCEED ){
					echo json_encode( [ 'success'=>1, 'msg'=>'审核成功'] );
					Yii::app()->end();
				}
				$msg = $response->sMessage->val;
			}
			echo json_encode( [ 'success'=>$response->iResult->val, 'msg'=>$msg] );
			Yii::app()->end();
		}
        $criteria=new   CDbCriteria();
        $pager = new CPagination($total);
        $pager->pageSize = Constant::MESSAGE_PAGE_SIZE;
        $pager->applyLimit($criteria);
        $pager->params['total']=$total;
        $pager->params['maxIndex']=$maxIndex;
        $this->render('applylist', [ 'applylist'=>$data, 'pages'=>$pager ]);
    }
    
    public function actionApplyListAjax()
    {
        $page = Yii::app()->request->getParam('page', 1);
        $index = Yii::app()->request->getParam('index', '');
        $pageSize = 10;
        
        if( $page > 1 ){
            $flag = 2; // 2拉取历史
            $index--;
        }
        else{
            $flag = 1; // 1拉取最新
            $index = ($page-1) *$pageSize;
        }
        
        $data = JceClass::getAuditRecords( Yii::app()->user->id, $flag, $index );
        
        $hintCreateTime = 0;
        $one = 0;
        if( false !== $data ){
            foreach ( $data as $k => $v ){
                if( 0 == $v->status && 0 == $hintCreateTime && 1 == $flag && 0 == $one ){
                    $hintCreateTime = $v->createTime ;
                    $one = 1;  // 这里只取第一条
                    Yii::app()->cache->set( JceClass::NEW_AUDIT_HINT_COUNT, $hintCreateTime ); // 记录数，为下次新消息准备
                }
                
                if( $v->createTime ){
    			    $createTime = date('Y-m-d H:i:s', $v->createTime );
    			
    			    $data[$k]->createTime = date('Y-m-d', $v->createTime ) == date('Y-m-d') ? '今天'.date('H:i:s',$v->createTime ) : $createTime;
    			}
            }
        }
        
        $ajaxData = ['status' => 0];
         
        if( true == $data ){
            $ajaxData['detail'] = $data;
            $ajaxData['status'] = 1;
        }
        else{
            $ajaxData['detail'] = [];
        }
        
        if(count($data) == $pageSize ){
           $ajaxData['showNext'] = true;
        }
        else{
           $ajaxData['showNext'] = false;
        }
        
        echo json_encode( $ajaxData, JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT );
    }

    /**
     * 班级属性-转让班主任
     */
    public function actionMastersetting($id)
    {
        $ac = Yii::app()->request->getParam('ac');
        $class = JceClass::classInfo($id, 1);
        $teachers=JceClass::getClassMember($id,1);
        $uid=Yii::app()->user->id;
        $this->render('mastersetting', array(
            'class' => $class,
            'ac' => $ac,
            'uid' => $uid,
            'teachers' => $teachers,
        ));
    }

    /*
     * 判断老师是否是班主任
     */
    public function checkIsMaster($uid,$cid,$teachers=null){
        if(is_array($teachers)){

        }else{
            $teachers=JceClass::getClassMember($cid,1);
        }
        $isMaster=false;
        foreach($teachers as $val){
            if($val->uid==$uid&&$val->type==1){
                $isMaster=true;
                break;
            }
        }
        return $isMaster;
    }

    public function actionExprules($id)
    {
        $class=JceClass::classInfo($id,1);
        $this->render('exprules',array('class'=>$class));
    }

}
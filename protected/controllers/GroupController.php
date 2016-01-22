<?php

class GroupController extends Controller
{

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

    public function init(){
        $uid= Yii::app()->user->id;
        if($uid){
            $user=Member::model()->findByPk($uid);
            if($user&&$user->issmsauth==0){
                Yii::app()->msg->postMsg('error', '你无权操作分组功能');
                $this->redirect(Yii::app()->createUrl("notice/receive"));

                exit();
            }
        }

    }

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('index','create','delete','update','member','getmember','view'),
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * 自定义分组-列表
	 * panrj 2014-08-09
	 */
	public function actionIndex()
	{
        $userid = Yii::app()->user->id;
        //获取我所有的学校
        $schools=SchoolTeacherRelation::getTeacherSchoolsBanBan($userid);
        $sids=array();//学校ids
        foreach($schools as $k=>$v){
            $sids[]=$k;
        }
        $grouplist=Group::getSchoolBanbanGroup($sids);//获取该老师的所有组
        $this->render('index',array("groups"=>$grouplist,'userid'=>$userid));
	}

	/**
	 * 自定义分组-创建
	 * panrj 2014-08-09
	 */
	public function actionCreate()
	{
		$userid = Yii::app()->user->id;
		$schools =SchoolTeacherRelation::getTeachersSchoolRaletion($userid);
        $schoolArr=array();
        $sids=array();
        foreach($schools as $val){

            if($val->s&&$val->s->createtype==0){
                if(!in_array($val->sid,$sids)){
                    $sids[]=$val->sid;
                }
                $schoolArr[]=array('sid'=>$val->s->sid,'schoolname'=>$val->s?$val->s->name:'');
            }
        }
        $userinfo=Yii::app()->user->getInstance();
		if(isset($_POST['Group'])){
			$name = $_POST['Group']['name'];
			$members = isset($_POST['Group']['uid'])?$_POST['Group']['uid']:array();
			$sid = $_POST['Group']['sid'];
			$group=new Group();
            $group->sid=$sid;
            $group->name=$name;
            $group->type=1;
            $group->creater=$userid;
            $group->ostype=1;
            $group->creationtime=date("Y-m-d H:i:s");
            if($group->save()){
                foreach($members as $uid){
                    $groupmember=new GroupMember();
                    $groupmember->gid=$group->gid;
                    $groupmember->member=$uid;
                    $groupmember->state=1;
                    $groupmember->deleted=0;
                    $groupmember->save();
                }
            }
			Yii::app()->msg->postMsg('success', '操作成功');
			$this->redirect(Yii::app()->createUrl('group/index'));
		}

		$this->render('create',array('schools'=>$schoolArr));
       // $this->render('create',array());
	}

	/**
	 * 自定义分组-删除
	 * panrj 2014-08-09
	 */
	public function actionDelete($id)
	{
        $uid=Yii::app()->user->id;
        $group=Group::model()->findByPk((int)$id);
        if($group){
            if($group->creater!=$uid){
                Yii::app()->msg->postMsg('error', '不是你自己创建的分组，不能删除');
                $this->redirect(Yii::app()->createUrl('group/index'));
                exit();
            }
            $group->deleted=1;
            if($group->save()){
                GroupMember::model()->updateAll(array("deleted"=>1),'gid=:gid',array(":gid"=>$id));
                Yii::app()->msg->postMsg('success', '删除成功');
                $this->redirect(Yii::app()->createUrl('group/index'));
            }else{
                Yii::app()->msg->postMsg('error', '删除失败');
                $this->redirect(Yii::app()->createUrl('group/index'));
            }
        }else{
            Yii::app()->msg->postMsg('error', '组不存在');
            $this->redirect(Yii::app()->createUrl('group/index'));
        }

	}
    public function actionView($id){
        $userid = Yii::app()->user->id;
        $userinfo=Yii::app()->user->getInstance();
        $schools =SchoolTeacherRelation::getTeachersSchoolRaletion($userid);
        $schoolArr=array();
        $sids=array();
        foreach($schools as $val){
            if(!in_array($val->sid,$sids)){
                $sids[]=$val->sid;
            }
            $schoolArr[]=array('sid'=>$val->s->sid,'schoolname'=>$val->s?$val->s->name:'');
        }
        $group = Group::model()->findByPk($id);
        $school = School::model()->findByPk($group->sid);
        $groupmembers=GroupMember::getGroupMembers($id);
        $groupuserids=array();
        $members=array();
        foreach($groupmembers as $gmember){
            $groupuserids[]=$gmember->member;
            $members[]=array("member"=>$gmember->member,'name'=>$gmember->member0?$gmember->member0->name:'');
        }
        $this->render('view',array('schools'=>$schoolArr,'group'=>$group,'members'=>$members,'school'=>$school));
    }

	/**
	 * 自定义分组-修改
	 * panrj 2014-08-09
	 */
	public function actionUpdate($id)
	{
		$userid = Yii::app()->user->id;
        $group=Group::model()->findByPk((int)$id);
        if($group){
            if($group->deleted==1){
                Yii::app()->msg->postMsg('error', '分组已删除');
                $this->redirect(Yii::app()->createUrl('group/index'));
                exit();
            }
            if($group->creater!=$userid){
                Yii::app()->msg->postMsg('error', '不是你自己创建的分组，不能修改');
                $this->redirect(Yii::app()->createUrl('group/index'));
                exit();
            }
        }else{
            Yii::app()->msg->postMsg('error', '分组不存在');
            $this->redirect(Yii::app()->createUrl('group/index'));
            exit();
        }


        $userinfo=Yii::app()->user->getInstance();
        $schools =SchoolTeacherRelation::getTeachersSchoolRaletion($userid);
        $schoolArr=array();
        $sids=array();
        foreach($schools as $val){
            if($val->s&&$val->s->createtype==0){
                if(!in_array($val->sid,$sids)){
                    $sids[]=$val->sid;
                }
                $schoolArr[]=array('sid'=>$val->s->sid,'schoolname'=>$val->s?$val->s->name:'');
            }
        }
		$group = Group::model()->findByPk($id);
		$school = School::model()->findByPk($group->sid);
		$groupmembers=GroupMember::getGroupMembers($id);
        $groupuserids=array();
        $members=array();
        foreach($groupmembers as $gmember){
            $groupuserids[]=$gmember->member;
            $members[]=array("member"=>$gmember->member,'name'=>$gmember->member0?$gmember->member0->name:'');
        }

		if(isset($_POST['Group'])){
            $name = $_POST['Group']['name'];
            $memberids = isset($_POST['Group']['uid'])?$_POST['Group']['uid']:array();
            $sid = $_POST['Group']['sid'];
            $group->sid=$sid;
            $group->name=$name;
            if($group->save()){
                foreach($memberids as $uid){
                    if(!in_array($uid,$groupuserids)){ //如果添加的userid不在原来的成员表中，则要添加
                        $groupmember=new GroupMember();
                        $groupmember->gid=$group->gid;
                        $groupmember->member=$uid;
                        $groupmember->state=1;
                        $groupmember->deleted=0;
                        $groupmember->save();
                    }
                }
                //循环旧的成员，如果旧的不在新的成员列表中，则要删除
                foreach($groupuserids as $deleteuser){
                    if(!in_array($deleteuser,$memberids)){
                        $memberuser=GroupMember::deleteGroupMember($id,$deleteuser);
                    }
                }
            }

			Yii::app()->msg->postMsg('success', '操作成功');
			$this->redirect(Yii::app()->createUrl('group/index'));
		}
		$this->render('update',array('schools'=>$schoolArr,'group'=>$group,'members'=>$members,'school'=>$school));
        		//$this->render('update',array());
	}

	/**
	 * 自定义分组-添加成员
	 * panrj 2014-08-09
	 */
	public function actionMember()
	{
		$ty = Yii::app()->request->getParam('ty');
		$sid = Yii::app()->request->getParam('sid');
		$userid = Yii::app()->user->id;
		$classArr = array();
		$departArr = array();
		$studentArr = array();
		$teacherArr = array();
		if($ty=='0'){//添加学生
            $classArr=NoticeService::getClassBySidUid($sid,$userid);
		}else{//添加老师
			$sql = "CALL php_xiaoxin_getTeacherDepartmentInSchool('0','".$sid."')";
			$departArr = UCQuery::queryAll($sql);
		}
		$con = $this->renderPartial('member',array(
				'classes'=>$classArr,
				'departs'=>$departArr,
				'students'=>$studentArr,
				'teachers'=>$teacherArr,
				'ty'=>$ty
			),true);
		echo $con;
	}

	public function actionGetmember()
	{
		$ty = Yii::app()->request->getParam('ty');
		$tid = (int)Yii::app()->request->getParam('tid');
        $sid = (int)Yii::app()->request->getParam('sid');
        $uid=Yii::app()->user->id;
        $members = array();
        $schoolinfo=School::model()->findByPk($sid);
        if($tid=="allTeacher"){

                 if($schoolinfo->enableddirectsend){
                     //开启定向发送
                     $teacherconfig = TeachersRelation::getTeachersRelation($uid,$sid);
                     if ($teacherconfig&&$teacherconfig->teachers) {
                         $userlist = Member::getUsersByUids(explode(",", $teacherconfig->teachers));
                         if (is_array($userlist)) {
                             foreach ($userlist as $val) {
                                 $members[] = array('userid' => $val->userid, 'name' => $val->name);
                             }
                         }
                     }
                 }else{
                     //不是定向开启的，直接查学校所有老师
                     $allTeacher = SchoolTeacherRelation::getSchoolTeachers(array('sid'=>$sid));
                     foreach($allTeacher as $k =>$v){
                         if($v&&$v->teacher&&$v->teacher0){
                           $members[$k]['userid'] =$v->teacher;
                           $members[$k]['name']=$v->teacher0->name;
                         }
                     }
                 }
        }else{
            if($ty=='0'){
                $sql = "CALL php_xiaoxin_getClassStudent('".$tid."')";
                $members = UCQuery::queryAll($sql);
            }else{
                $sql = "CALL php_xiaoxin_getDepartmentTeacher('".$tid."')";
                $members=array();
                $tempmember = UCQuery::queryAll($sql);
                if($schoolinfo->enableddirectsend){
                    $teacherconfig = TeachersRelation::getTeachersRelation($uid,$sid);
                    if($teacherconfig&&$teacherconfig->teachers){
                        $myteachers=explode(",",$teacherconfig->teachers);
                        foreach($tempmember as $val){
                            if(in_array($val['userid'],$myteachers)){
                                $members[]=$val;
                            }
                        }
                    }

                }else{
                    $members=$tempmember;
                }
            }
        }
		$con = $this->renderPartial('members',array('members'=>$members),true);
		echo $con;
	}
}
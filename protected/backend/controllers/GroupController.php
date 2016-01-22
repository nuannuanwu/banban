<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 14-11-4
 * Time: 上午10:04
 */

class GroupController extends Controller
{
    public function actionIndex()
    {

//        set_time_limit(0);
//
//        $area=UCQuery::queryAll("select * from tb_area where type=3  and aid in(110000,120000,310000,500000,710000,810000,820000) ");
//        $city=array();
//        foreach($area as $val){
//            $data=array('code'=>$val['aid'],'name'=>$val['name']);
//            $areas=UCQuery::queryAll("select aid as code,name from tb_area where aid like '".substr($val['aid'],0,2)."%' and aid>10000  and aid!=".$val['aid']);
//            //echo "select aid as code,name from tb_area where aid like '".substr($val['aid'],0,2)."%' and aid>10000";
//
//            $data['areas']=$areas;
//            $city[]=$data;
//
//
//        }
//
//
//       // $city=array();
//        //not in(110000,120000,310000,500000,710000,810000,820000)
//        $a1=UCQuery::queryAll("select * from tb_area where type=3  and  aid not in(110000,120000,310000,500000,710000,810000,820000)  ");
//        foreach($a1 as $val){
//            $a2=UCQuery::queryAll("select * from tb_area where parentid=".$val['aid']);
//
//            foreach($a2 as $v){
//                $areas=array();
//
//                $data=array('code'=>$v['aid'],'name'=>$v['name']);
//
//                if($v['aid']!=650200){
//                   $areas=UCQuery::queryAll("select aid as code,`name` from tb_area where parentid=".$v['aid']);
//                }else{
//                   $tmp=Area::getCity(array('cid'=>650200));
//                    foreach($tmp as $t){
//                        $areas[]=array('code'=>$t['aid'],'name'=>$t['name']);
//                    }
//
//                }
//
//
//                $data['areas']=$areas;
//
//                $city[]=$data;
//            }
//
//
//            //echo "select aid as code,name from tb_area where aid like '".substr($val['aid'],0,2)."%' and aid>10000";
//
//
//
//        }
//        error_log("aaa".json_encode(array('citys'=>$city),JSON_UNESCAPED_UNICODE));
//        D('end');
//        error_log(">36:".json_encode(array('citys'=>$city),JSON_UNESCAPED_UNICODE));
//        $city=array();
//        echo 'end';
//        error_log("我的:".json_encode($data));
//        die("ddd");
//       // D($city);
//        //error_log("fff".json_encode(array('citys'=>$city),JSON_UNESCAPED_UNICODE));
//       exit();
        // $schoolArr = School::getDataArr(true); //所有学校,带首字母用于下拉
        $userid = Yii::app()->user->id;
        $schoolArr = UserAccess::getUserSchools($userid);
        $query = isset($_GET['Group']) ? $_GET['Group'] : array('teacher' => '', 'sid' => '', 'name' => '', 'type' => -1);
        //如果传入学校，就要设置学校cookie
        if (isset($_GET['Group']) && isset($query['sid'])) {
            MainHelper::setCookie(Yii::app()->params['xxschoolid'], $query['sid']);
        } else {
            $query['sid'] = isset($_GET['Group']) ? $query['sid'] : MainHelper::getCookie(Yii::app()->params['xxschoolid']);
        }

        $page = (int)Yii::app()->request->getParam("page", 1);
        $query['page'] = $page;
        $groups = Group::model()->pageData($query);
       // D($groups);
        $teachers = array();
        if ($query['sid']) {
            $teachers = School::getSchoolTeacherArr($query['sid'],true);
        }
        $typeArr = array('-1' => '全部', '0' => '学生组', '1' => '老师组');
        $this->render('index', array('schools' => $schoolArr, 'groups' => $groups, 'query' => $query, 'teachers' => $teachers, 'typeArr' => $typeArr));
    }

    public function actionCreate()
    {

        if (isset($_POST['Group'])) {
            $model = new Group();
            $model->attributes = $_POST['Group'];
            $model->gid = UCQuery::makeMaxId(5, true);
            $model->state = 1;
            if ($model->save()) {
                //组成员
                $members = isset($_POST['Group']['uid']) ? $_POST['Group']['uid'] : array();
                $members = array_unique($members);
                foreach ($members as $val) {
                    $gmember = new GroupMember;
                    $gmember->gid = $model->gid;
                    $gmember->member = $val;
                    $gmember->state = 1;
                    $gmember->save();

                }
                //指定访问人
                $accessmembers = isset($_POST['Group']['accessids']) ? $_POST['Group']['accessids'] : array();
                $accessmembers = array_unique($accessmembers);
                foreach ($accessmembers as $k => $val) {
                    if ($val == $model->creater) {
                        unset($accessmembers[$k]);
                    }
                }
                if ($model->creater) {
                    $createInfo = Member::model()->findByPk($model->creater);
                    foreach ($accessmembers as $val) {
                        $amember = new GroupPermission();
                        $amember->gid = $model->gid;
                        $amember->userid = $val;
                        $amember->createor = $model->creater;
                        $amember->createname = $createInfo ? $createInfo->name : '';
                        $amember->save();

                    }
                }
                Yii::app()->msg->postMsg('success', '创建组成功');
                $this->redirect(array('index'));
            }
        }
        // $schoolArr = School::getDataArr(true); //所有学校
        $userid = Yii::app()->user->id;
        $schoolArr = UserAccess::getUserSchools($userid);
        $sid = MainHelper::getCookie(Yii::app()->params['xxschoolid']);
        $teachers = array();
        if ($sid) {
            $teachers = School::getSchoolTeacherArr($sid,true);
        }
        $this->render('create', array('schools' => $schoolArr, 'sid' => $sid, 'teachers' => $teachers));
    }

    public function actionUpdate($id)
    {
        $model = Group::model()->loadByPk($id);
        if (isset($_POST['Group'])) {
            $model->attributes = $_POST['Group'];
            $success = $model->save();
            if ($model->save()) {
                $members = isset($_POST['Group']['uid']) ? $_POST['Group']['uid'] : array();
                $members = array_unique($members);
                $oldmembers = GroupMember::getGroupMembersArr($id);
                $t1 = array_diff($members, $oldmembers); //新增加的
                $t2 = array_diff($oldmembers, $members); //删除的

                if (is_array($t1)) {
                    foreach ($t1 as $v) {
                        $gmember = new GroupMember;
                        $gmember->gid = $model->gid;
                        $gmember->member = $v;
                        $gmember->save();
                    }
                }
                if (is_array($t2)) { //要删除的
                    foreach ($t2 as $v) {
                        GroupMember::deleteGroupMember($model->gid, $v);
                    }
                }
                //指定访问人
                $accessmembers = isset($_POST['Group']['accessids']) ? $_POST['Group']['accessids'] : array();
                $accessmembers = array_unique($accessmembers);
                foreach ($accessmembers as $k => $val) {
                    if ($val == $model->creater) {
                        unset($accessmembers[$k]);
                    }
                }
                $oldaccessmembers = array();
                $oldaccessmemberList = GroupPermission::getGidShareUserArr($model->gid);
                foreach ($oldaccessmemberList as $val) {
                    $oldaccessmembers[] = $val['member'];
                }
                $t3 = array_diff($accessmembers, $oldaccessmembers); //新增加的
                $t4 = array_diff($oldaccessmembers, $accessmembers); //删除的

                if ($model->creater) {
                    $createInfo = Member::model()->findByPk($model->creater);

                    if (is_array($t3)) {
                        foreach ($t3 as $v) {
                            $amember = new GroupPermission();
                            $amember->gid = $model->gid;
                            $amember->userid = $v;
                            $amember->createor = $model->creater;
                            $amember->createname = $createInfo ? $createInfo->name : '';
                            $amember->save();
                        }
                    }
                }
                if (is_array($t4)) { //要删除的
                    foreach ($t4 as $v) {
                        GroupPermission::deletePermissionByGid($model->gid, $v);
                    }
                }
                Yii::app()->msg->postMsg('success', '编辑分组成功');
                $this->redirect(array('index'));
            }
        }
        // $schoolArr = School::getDataArr(true); //所有学校
        $userid = Yii::app()->user->id;
        $schoolArr = UserAccess::getUserSchools($userid);
        $teachers = array();
        if (!$model) {
            Yii::app()->msg->postMsg('error', '分组不存在');
            $this->redirect(array('index'));
            exit();

        }
        $sql = "CALL php_xiaoxin_GetGroupMemberList('" . $id . "')";
        $members = UCQuery::queryAll($sql);
        $shareMembers = GroupPermission::getGidShareUserArr($id); //指定给哪些用户可以访问
        if ($model->sid) {
            $teachers = School::getSchoolTeacherArr($model->sid);
        }
        $sql = "CALL php_xiaoxin_GetGroupMemberList('" . $id . "')";
        $members = UCQuery::queryAll($sql);

        $shareMembers = GroupPermission::getGidShareUserArr($id); //指定给哪些用户可以访问
        $typeArr = array('-1' => '全部', '0' => '学生组', '1' => '老师组');
        $this->render('update', array('schools' => $schoolArr, 'model' => $model, 'teachers' => $teachers, 'shareMembers' => $shareMembers, 'members' => $members, 'typeArr' => $typeArr));
    }

    public function actionDelete($id)
    {
        $list = Yii::app()->request->getParam("list", 0);
        if ($id) {

            $success = Group::deleteGroup($id);
            if ($success) {
                Yii::app()->msg->postMsg('success', '删除成功');
            } else {
                Yii::app()->msg->postMsg('error', '删除失败');
            }
            if ($list) {
                $this->redirect(Yii::app()->createUrl("group/index"));
            } else {
                $this->redirect($this->previousurl);
            }

        } else {
            Yii::app()->msg->postMsg('success', '参数传入有错误,请重试');
            $this->redirect($this->previousurl);
        }
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
        if ($ty == '0') { //添加学生
            $sql_text = "select * from tb_class where sid = $sid and deleted=0 order by seqno,`pingyin`";
            $classArr = UCQuery::queryAll($sql_text);
        } else { //添加老师
            $sql = "CALL php_xiaoxin_getTeacherDepartmentInSchool('0','" . $sid . "')";
            $departArr = UCQuery::queryAll($sql);
        }

        $con = $this->renderPartial('member', array(
            'classes' => $classArr,
            'departs' => $departArr,
            'students' => $studentArr,
            'teachers' => $teacherArr,
            'ty' => $ty
        ), true);
        echo $con;
    }

    public function actionGetmember()
    {
        $ty = Yii::app()->request->getParam('ty');
        $tid = Yii::app()->request->getParam('tid');
        $sid = Yii::app()->request->getParam('sid');
        $members = array();
        if ($tid == "allTeacher") {
            $allTeacher = SchoolTeacherRelation::getSchoolTeachers(array('sid' => $sid));
            foreach ($allTeacher as $k => $v) {
                if ($v && $v->teacher && $v->teacher0) {
                    $members[$k]['userid'] = $v->teacher;
                    $members[$k]['name'] = $v->teacher0->name;
                }
            }
        } else {
            if ($ty == '0') {
                $sql = "CALL php_xiaoxin_getClassStudent('" . $tid . "')";
                $members = UCQuery::queryAll($sql);
            } else {
                $sql = "CALL php_xiaoxin_getDepartmentTeacher('" . $tid . "')";
                $members = UCQuery::queryAll($sql);
            }

        }
        $con = $this->renderPartial('members', array('members' => $members), true);
        echo $con;
    }

} 
<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 15-1-23
 * Time: 上午10:01
 */

class NoticeController extends Controller
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


    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules()
    {
        return array(
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('scheck'),
                'users' => array('*'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('index', 'follow','invite','send','examnext','exampreview','checkbadword', 'getclassinfo','download','receive', 'smshistory','history', 'receivedetail', 'smshistorydetail','historydetail', 'schoolnotice_success','schoolnotice', 'getnoticesms', 'test', 'searchreceiver','reply','sendexam'),
                'users' => array('@'),
                'expression' => array($this, 'loginAndNotDeleted'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    public function actionNotice()
    {
        $this->render("notice");
    }

    public function init()
    {
        //$logintype = Yii::app()->user->getCurrIdentity();

    }

    /*
     * 进入校信的首页
     */
    public function actionIndex()
    {

    }

    /*
     * 发送消息(通知家长，布置作业，表扬批评)
     */
    public function actionSend()
    {
        if (isset($_POST['noticetype'])) {
            $noticeType = $_POST['noticetype'];
            $uids = isset($_POST['Group']['uid']) ? array_unique($_POST['Group']['uid']) : array();
            if (empty($uids)) {
                Yii::app()->msg->postMsg('error', '发布失败,请选择接收对象');
                $this->redirect(Yii::app()->createUrl('notice/send'));
                exit();
            }
            $c0 = array();
            $c1 = array();
            $c2 = array();
            $c3 = array();
            $c4 = array();
            $cidperson = array(); //保存每个班级的
            if (is_array($uids)) {
                foreach ($uids as $v) {
                    $tmp = explode("_", $v);
                    //1-0-id  第一个1代表学校id,第二个（0代表个人,1 班级，2分组，3年级，4全体老师)
                    $sid = (int)$tmp[0]; //学校id
                    if ($tmp[1] == 0) {
                        $c0[] = $tmp[2]; //个人uid
                    } else if ($tmp[1] == 1) {
                        $c1[] = $tmp[2]; //班级id
                    } else if ($tmp[1] == 2) {
                        $c2[] = $tmp[2]; //组id
                    } else if ($tmp[1] == 3) {
                        $c3[] = $tmp[2]; //年级id
                    } else if ($tmp[1] == 4) {
                        $c4[] = $tmp[2]; //全样师生
                    }
                    //新班班，第四个传班级id，统一全部传个人:学校id-0-学生id-班级id
                    if ($tmp[3]) {
                        if (!array_key_exists($tmp[3], $cidperson)) {
                            $cidperson[$tmp[3]] = array();
                        }
                        $cidperson[$tmp[3]][] = $tmp[2];
                    }
                }
            }

            $classname = "";
            $personname = "";
            $temp=array();//保存接者uid


            //如果班级的人数，等于选择的人数，则显示时，显示发送给：xx班，否则显示所有学生名
            foreach ($cidperson as $k => $v) {
                $classstudentnum = JceClass::getClassMember($k,0);

                if (count($classstudentnum) == count($v)) {
                    $mclass = JceClass::classInfo($k,0);
                    $classSids=array();
                    foreach($classstudentnum as $studentobject){
                        $temp[]=$studentobject->sid;
                    }

//                    foreach($c0 as $kk=>$vv){
//                        if(in_array($vv,$classSids)){
//                            $temp[]=$vv;
//                        }
//                    }
                    $c1[]=$k;
                    $classname .= $mclass->name . ",";
                } else {
                    if (count($v)) {
                        foreach ($v as $personuser) {
                            $persons = JceUser::getUserInfo($personuser);

                            $personname .= $persons->name . ",";
                            //$temp[]=$persons->uid;
                        }
                    }

                }
            }
            //print "<pre>";
           // print_r($c0);
           // print_r($c1);
            $c0=array_diff($c0,$temp);
           // D($c0);



            $receivername = "";
            if (!empty($classname)) {
                $receivername .= "" . rtrim($classname, ",");
            }
            if (!empty($personname)) {
                if (!empty($receivername)) {
                    $receivername .= "," . rtrim($personname, ",");
                } else {
                    $receivername .= "" . rtrim($personname, ",");
                }
            }

            $receiverObject=array();
            $receiver = array();
            $family_title = '';
            if (count($c0)) { //接收者所有个人id
               // $c0[]=Yii::app()->user->id;//主要方便测试，把自己加为收件人
                $receiver['5'] = implode(",", array_unique($c0)); //保存个人的接收者集合时，为了避免[0]的情况，改为5了
                $receiverObject[5]=array_unique($c0);
            }

            if (count($c1)) { //接收者所有班级id
                $receiver['1'] = implode(",", array_unique($c1));
                $receiverObject[1]=array_unique($c1);
            }
            if (count($c2)) { ////接收者所有分组id
                $receiver['2'] = implode(",", array_unique($c2));
                $receiverObject[2]=array_unique($c2);
            }
            if (count($c3)) { ////接收者所有年级id
                $receiver['3'] = implode(",", array_unique($c3));
                $receiverObject[3]=array_unique($c3);
            }
            if (count($c4)) { //这个是全体老师了,写入到message表时，查学校的所有老师
                $receiver['4'] = implode(",", $c4);
                $receiverObject[4]=array_unique($c4);
            }
            //D($receiverObject);
            if (!empty($noticeType)) {
                $uid = (int)Yii::app()->user->id;
                $instance=JceUser::getUserInfo($uid);
                if (isset($_POST['content'])) {
                    $success=false;
                   // D($instance);
                    $postevalute=isset($_POST['evaluatetype']) ? ((int)($_POST['evaluatetype'])) : 0;
                    $success =JceNotice::sendNotice(time(),$receiverObject,$noticeType,$instance->icon?$instance->icon:'',trim($_POST['content']),
                        $instance->name,$uid,$postevalute,$receivername);
                    if ($success) {
                        Yii::app()->msg->postMsg('success', '发布成功');
                    } else {
                        Yii::app()->msg->postMsg('error', '发布失败');
                        $this->redirect(Yii::app()->createUrl('notice/send'));
                        exit();
                    }
                    $this->redirect(Yii::app()->createUrl('notice/history'));
                } else {
                    Yii::app()->msg->postMsg('error', '发布失败,发送内容为空');
                    $this->redirect(Yii::app()->createUrl('notice/send'));
                }
            }
        }
        $uid = Yii::app()->user->id;
        $noticetype=Yii::app()->request->getParam("noticetype");//从发布成线，另一个页面点过来时，要跳到相应的tab去

        //获取学校
        $sids = array();
        $schools = array();
       // 获取老师的所有班级
        $classList=array();
         $classdata = JceClass::getClassList();    // 获取当前用户的班级列表
        //D($classdata);
         if(is_array($classdata)){
             foreach($classdata as $k=>$v){
                 if(is_array($v->classes)){
                     foreach($v->classes as $eachclass){
                         if($eachclass->authority==1||$eachclass->authority==2){
                             $classList[]=$eachclass;
                         }
                     }
                 }
             }
         }
       //  $classList=$classdata[0];

            $myclass=array();//用于所有斑级，其它是按学校来的
            $cids = array();
            $cidperson = array();
            foreach ($classList as $k=>$val) {
                if (!in_array($val->cid, $cids)) {
                    $cids[] = $val->cid;
                    $myclass[]=$val;
                    if(!array_key_exists($val->tSchool->scid,$sids)){
                        $sids[$val->tSchool->scid]=$val->tSchool->name;
                    }
                    $ciddata = array('sid' => $val->tSchool->scid, 'name' => $val->name, 'cid' => $val->cid);
                    $ciddata['classname']=$ciddata['name'];
                    $ciddata['name']=$ciddata['name'].($sids[$ciddata['sid']]?("（".$sids[$ciddata['sid']]."）"):'');
                    $ciddata['schoolname']=($sids[$ciddata['sid']]?("".$sids[$ciddata['sid']].""):'');
                    $studentdata=JceClass::getClassMember($val->cid,0);//班级下学生
                    $stuarr=array();
                    foreach($studentdata as $stu){
                       $stuarr[]=array('student'=>$stu->sid,'name'=>$stu->name);
                    }
                    $ciddata['students'] =$stuarr;
                    $ciddata['cidperson'] = $ciddata;
                    $cidperson[]=$ciddata;
                }
            }

        //转发时用
        $noticeid=Yii::app()->request->getParam("noticeid");
        $index=Yii::app()->request->getParam("index");
        $evalute=Yii::app()->request->getParam("evalute");
        $noticeinfo_content='';
        if($noticeid){
            $noticeinfo=JceNotice::getOneSendNotice($noticeid,$index,$uid,$uid);
            if($noticeinfo&&in_array($noticeinfo->iType,array(1,2,3))){
                $content=$noticeinfo->tContent;
                $noticeinfo_content=$content->content;  //转发时的内容
                $evalute=(int)$noticeinfo->evalute;
            }
        }
        //D($cidperson);
        $userinfo=Yii::app()->user->getInstance();
        $myusesign=$userinfo->name."老师";
        $this->render("send", array('noticetype'=>$noticetype,'userinfo'=>$userinfo, 'myusesign' => $myusesign, 'cids' => $cidperson, 'schools' => $schools,'noticeinfo_content'=>$noticeinfo_content,'evalute'=>$evalute));
    }


    /*
    * 紧急通知
    */
    public function actionSchoolnotice()
    {
        //测试用
        //如果已经登陆，可以uid不传
        //?action=test&uid=72828901&sendname=南头实验学校&receivername=二班&class=11,22&teachers=33,44&sid=19701&content=测试

        //http://dev.zhou.com/index.php/notice/schoolnotice?action=test&content=%E6%88%91%E6%98%AF%E5%B7%A5%E7%A7%91%E7%94%9F&receivername=%E4%B8%80%E7%8F%AD&uid=71801101
        //&class=212201&sid=21601&sendname=009%E5%AD%A6%E6%A0%A1
        $action=isset($_REQUEST['action'])?$_REQUEST['action']:'';
        if($action=='test'){
            $noticetype=isset($_REQUEST['noticetype'])?(int)$_REQUEST['noticetype']:4; //4,紧急通知
            $uid=isset($_REQUEST['uid'])?$_REQUEST['uid']:Yii::app()->user->id;
            $receivername=$_REQUEST['receivername'];//接收者名称  一班，二班
            $sendname=$_REQUEST['sendname']; //发送人姓名  李二老师 //必须
            $content=$_REQUEST['content']; //内容 //必须
            $sid=$_REQUEST['sid']; //学校id //必须
            $classIds=isset($_REQUEST['class'])?$_REQUEST['class']:'';  //必须
            $teachers=isset($_REQUEST['teacher'])?$_REQUEST['teacher']:''; //必须  老师和班级必须要传其一
            $issendsms=isset($_REQUEST['$issendsms'])?$_REQUEST['$issendsms']:0;
            $re=array();
            if(!empty($classIds)){
                $re[1]=explode(",",$classIds);
            }
            if(!empty($teachers)){
                $re[5]=explode(",",$teachers);
            }
            $resp =JceNotice::sendNotice(time(),$re,$noticetype,'',$content,
                $sendname,$uid,0,$receivername,$issendsms,$sid);
            echo '发布成功';die;

        } //用于测试手工在地址浏输入

        $user = Yii::app()->user->getInstance();
        if($user){
            if ($user->teacherauth!=2) {
                Yii::app()->msg->postMsg('error', '用户不是认证老师，不能使用');
                $this->redirect(Yii::app()->createUrl("notice/send"));
                exit();
            }
        }
        if (isset($_POST['noticetype'])) {
            $noticeType = $_POST['noticetype'];
            $sid = 0;
            $uids = isset($_POST['sendcid']) ? $_POST['sendcid'] : '';
            $allteacheruidstr='';
            if (empty($uids)) {
                Yii::app()->msg->postMsg('error', '发布失败,请选择接收对象');
                $this->redirect(Yii::app()->createUrl('notice/schoolnotice'));
                exit();
            }

            $cidperson = array(); //保存每个班级的
            $classinfo=JceClass::classInfo($uids,1);
            $receivername =  $classinfo->name;
            $c1=array($uids);
            $sid=0;
            if (!empty($noticeType)) {
                $uid = (int)Yii::app()->user->id;
                $instance=JceUser::getUserInfo($uid);
                $sendtitle=isset($_POST['sendertitle'])?trim($_POST['sendertitle']):$instance->name;
                $issendsms=1;//isset($_POST['issendsms'])?intval($_POST['issendsms']):1;
                if (!empty($_POST['content'])) {
                    $resp =JceNotice::sendNoticeUrgency(time(),array(1=>$c1),2,'',trim($_POST['content']),
                        $sendtitle,$uid,0,$receivername,$issendsms,$sid);
                    if ($resp&&$resp['status']==0) {
                        $students=JceClass::getClassMember($uids,0);//
                        $unbindstudents=array();
                        foreach($students as $val){
                            if(empty($val->vFamilys)){
                                $unbindstudents[]=$val;
                            }
                            if(is_array($val->vFamilys)){
                                $isbind=false;
                                foreach($val->vFamilys as $family){
                                    if(!empty($family->mobilePhone)){
                                        $isbind=true;
                                        break;
                                    }
                                }
                                if(!$isbind){
                                    $unbindstudents[]=$val;
                                }
                            }
                        }
                        $unbindstudentcount=count($unbindstudents);//未绑定手机号人数；
                       // D($unbindstudentcount);
                        if($unbindstudentcount){ //如有未绑定手机号的
                            $this->redirect(Yii::app()->createUrl('notice/schoolnotice_success?cid='.$uids));
                            exit();
                        }
                        //Yii::app()->msg->postMsg('success', '发布成功');
                    } else{
                        Yii::app()->msg->postMsg('error', '发布失败:'.$resp['message']);
                        $this->redirect(Yii::app()->createUrl('notice/schoolnotice'));
                        exit();
                    }
                    $this->redirect(Yii::app()->createUrl('notice/smshistory'));
                    //$this->redirect(Yii::app()->createUrl('notice/history'));
                } else {
                    Yii::app()->msg->postMsg('error', '发布失败,发送内容为空');
                    $this->redirect(Yii::app()->createUrl('notice/schoolnotice'));
                }
            }
        }
        $uid = Yii::app()->user->id;


        //获取学校
        $schools = array();
        $firstschoolname = "";
        $classList=array();
        //获取我的班级
        $schoolArr = array();
        if ($user) { //如果是老师，获取老师的所有班级
            // 获取老师的所有班级
            $classdata = JceClass::getClassList();    // 获取当前用户的班级列表
            $classList=array();
            if(is_array($classdata)){
                foreach($classdata as $k=>$v){
                    if(is_array($v->classes)){
                        foreach($v->classes as $eachclass){
                            if($eachclass->authority==1){
                                $classList[]=$eachclass;
                            }
                        }
                    }
                }
            }
        }

        $noticeid=Yii::app()->request->getParam("noticeid");
        $index=Yii::app()->request->getParam("index",0);
        $noticeinfo_content='';
        if($noticeid){
            $noticeinfo=JceNotice::getOneSendNotice($noticeid,0,$uid,$uid);
            if($noticeinfo&&$noticeinfo->iType==4){
                $content=$noticeinfo->tContent;
                $noticeinfo_content=$content->content;  //转发时的内容
            }
        }

      //  D($classList);
        $this->render("sendnotice", array('firstschoolname' => $firstschoolname, 'classs' => $classList, 'noticeinfo_content'=>$noticeinfo_content));
    }

    public function actionSchoolnotice_success(){
        if(isset($_POST['content'])){
            $uid = (int)Yii::app()->user->id;
            $instance=JceUser::getUserInfo($uid);
            if (isset($_POST['content'])) {
                $success=false;
                $postevalute= 0;
                $noticeType=2;//通知家长
                $receivername=$_POST['receivername'];
                $receiverObject=array('5'=>$_POST['uids']);
                $success =JceNotice::sendNotice(time(),$receiverObject,$noticeType,'',trim($_POST['content']),
                    $instance->name,$uid,$postevalute,$receivername);
                //D($success);
                if ($success) {
                    Yii::app()->msg->postMsg('success', '发布成功');
                    $this->redirect(Yii::app()->createUrl('notice/history'));
                    exit();
                } else {
                    Yii::app()->msg->postMsg('error', '发布失败');
                    $this->redirect(Yii::app()->createUrl('notice/history'));
                    exit();
                }
            }
        }
        $unbindstudents=array();
        $cid=Yii::app()->request->getParam('cid',0);
        if($cid){
            $students=JceClass::getClassMember($cid,0);//

            if(is_array($students)){
                foreach($students as $val){
                    if(empty($val->vFamilys)){
                        $unbindstudents[]=$val;
                    }
                    if(is_array($val->vFamilys)){
                        $isbind=false;
                        foreach($val->vFamilys as $family){
                            if(!empty($family->mobilePhone)){
                                $isbind=true;
                                break;
                            }
                        }
                        if(!$isbind){
                            $unbindstudents[]=$val;
                        }
                    }
                }
            }
        }

        $this->render("sendnotice_success",array('students'=>$unbindstudents));
    }

    /*
     * 收件箱
     */
    public function actionReceive()
    {
        $uid = Yii::app()->user->id;
      //  $loginType = Yii::app()->user->getCurrIdentity(); //登陆身份
        $instance=Yii::app()->user->getInstance();
        $page=(int)Yii::app()->request->getParam("page",1);
        $index=0;
        $oldurl=Yii::app()->user->returnUrl();
        $targetid=$uid;
        //if($uid=="71824001"){ //测试用,13530359720的帐号，到时要删除,本来只能收老师端的通知，不能收孩子的消息，这里是为了测试下收孩子的消息
           // $targetid="72641101";//
            //72641101
           // 72870201";//
        //}
        $totalres=JceNotice::getNoticeMsg(0,$targetid,Constant::DIRECTION_FORCE,$uid);
        if(!empty($totalres)){
            $total=$totalres['total'];
            $count=$totalres['count'];
        }
        $maxseq=0;
        if($total>0){
            $totalmaxindexres=$totalres['data'][0];
            $maxseq=$totalmaxindexres->index;
            $index=$maxseq-($page-1)*10;
        }

        if($page==1){
           $list=$totalres['data'];
        }else{
            $res=JceNotice::getNoticeMsg($index,$targetid,Constant::DIRECTION_DOWN,$uid);
            $list=$res['data'];
        }
        if ($uid != 11) {
            $data = array();
            $noticeIds = array();
            $noticeType = Constant::noticeTypeArray();
            $senders=array();
            foreach ($list as $key => $val) {
                $array = array('noticeid' => $val->iNoticeId, 'noticetype' => $val->iType, 'content' => $val->tContent,
                    'msgid' => 0,
                    'sender' => $val->sSenderId,
                    'sendertitle' => $val->sSenderTitle,
                    'receiver' => $val->targteid,
                    'receivertitle' =>$instance->name,
                    'sendtime' => $val->lSendTime,
                    'read' => $val->read,
                    'readusers' => array(),
                    'schoolname' => '',
                    'uname' => $instance->name,
                    'rguardian' => '',
                    'evaluatetype' => 0,
                    'sid' => 0,
                    'index'=>$val->index,
                    'targteid'=>$val->targteid,
                );
                if($array['targteid']!=$uid){
                    $user=JceUser::getUserInfo($array['targteid']);
                    $array['receivertitle']=$user?$user->name:'';
                }
                $array['sendtime'] = date("Y-m-d H:i:s",$val->lSendTime);
                $array['receivename'] = $instance->name;
                $data[] = $this->assemblyNotice($array);
            }
            $criteria=new   CDbCriteria();
            $pager = new CPagination($total);
            $pager->pageSize = Constant::MESSAGE_PAGE_SIZE;
            $pager->applyLimit($criteria);

            $this->render("receive", array('data' => $data, 'pages' => $pager, 'count' => $total, 'uid'=>$uid));
        } else {
            $this->render("receive", array('data' => array(), 'pages' => 0, 'count' => 0,'uid'=>$uid));
        }
    }

    /*
    * 发件箱
    */
    public function actionHistory()
    {

        $uid = Yii::app()->user->id;
       // $loginType = Yii::app()->user->getCurrIdentity(); //登陆身份
        $list=JceNotice::getSendNotice(1,0,$uid,0); //获取第一页数据
        $page=(int)Yii::app()->request->getParam("page",1);
        $index=0;
        $count=$list['total'];
        if($count>0){
            if(is_array($list['vNotice'])&&count($list['vNotice'])){
                $maxres=$list['vNotice'][0];
                $index=$maxres->index; //获取最大流水号
            }

        }
        $noticelist=array();
        if($page==1){
            $noticelist=$list['vNotice'];
        }else{
            $index=$index-($page-1)*10;
            $res=JceNotice::getSendNotice(Constant::DIRECTION_DOWN,$index,$uid,3);//传该页的最大流水号，往下拉，不要往上，往上有问题
            $noticelist=isset($res['vNotice'])?$res['vNotice']:array();
        }
        $data = array();
        $noticeIds = array();
        $listdata=array();
        $cidarr=array();

        if(is_array($noticelist)){
            foreach ($noticelist as $key => $val) {
                $array = array('noticeid' => $val->iNoticeId, 'noticetype' => $val->iType, 'content' => $val->tContent,
                    'sender' => $val->sSenderId,
                    'sendertitle' => $val->sSenderTitle,
                    'receiver' => '',
                    'receivertitle' => $val->receiverTitle,
                    'sendtime' => $val->lSendTime,
                    'receivename' => $val->receiverTitle,
                    'schoolname' =>'',
                    'evaluatetype' => $val->evalute,
                    'platform' => $val->nPlatform,
                    'ReceiverNum' => $val->ReceiverNum,
                    'readedNum' => $val->readedNum,
                    'index' => $val->index,
                );

                if($val->iType==1||$val->iType==2||$val->iType==3){
                    $readdetail=$this->getHistoryDetailcount($val->iNoticeId);

                    $array['ReceiverNum']=$readdetail['studentnum'];
                    $array['readedNum']=$readdetail['studentReadnum'];
                }

                if($val->iType==5){
                    $score=isset($val->tContent->vScore[0])?$val->tContent->vScore[0]:0;
                    $cid=$score?$score->cid:0;
                    if(isset($cidarr[$cid])){
                        $classinfo=$cidarr[$cid];
                        $array['classname']=$classinfo?$classinfo['name']:"未知班级";
                        $array['schoolname']=$classinfo?$classinfo['schoolname']:'未知学校';;
                    }else{
                        $info=JceClass::classInfo($cid,1);
                        $cidarr[$cid]=array('name'=>$info?$info->name:"未知班级",'schoolname'=>$info?$info->tSchool->name:'未知学校');
                        $array['classname']=$info?$info->name:"未知班级";
                        $array['schoolname']=$info?$info->tSchool->name:'未知学校';;
                    }
                }
                $array['sendtime']=date("Y-m-d H:i:s",$val->lSendTime);
                $percent = $array['ReceiverNum'] > 0 ? round(($array['readedNum'] / $array['ReceiverNum'] * 100),0) : 0;
                $array['percent'] = $percent;
                $data[] = $this->assemblyNotice($array);
            }
        }
        $criteria=new   CDbCriteria();
        $pager = new CPagination($count);
        $pager->pageSize = Constant::MESSAGE_PAGE_SIZE;
        $pager->applyLimit($criteria);
        $pager->params['total']=$count;
        $list['model'] = $data;
        $this->render("history", array('data' => $list, 'loginType' => 1,'count'=>$count,'pages'=>$pager));
    }

    /*
    * 已发短信
    */
    public function actionSmshistory()
    {

        $uid = Yii::app()->user->id;
        $list=JceNotice::getSmsSendNotice(0,-1,$uid); //获取第一页数据
        $page=(int)Yii::app()->request->getParam("page",1);
        $index=0;
        $count=$list['total'];
        if($count>0){
            if(is_array($list['vNotice'])&&count($list['vNotice'])){
                $maxres=$list['vNotice'][0];
                $index=$maxres->index; //获取最大流水号
            }

        }
        $noticelist=array();
        if($page==1){
            $noticelist=$list['vNotice'];
        }else{
            $index=$index-($page-1)*10;
            $res=JceNotice::getSmsSendNotice($index,Constant::DIRECTION_DOWN,$uid);//传该页的最大流水号，往下拉，不要往上，往上有问题
            $noticelist=isset($res['vNotice'])?$res['vNotice']:array();
        }
        $data = array();
        $noticeIds = array();
        $cache=Yii::app()->cache;
        if(is_array($noticelist)){
            foreach ($noticelist as $key => $val) {
                $array = array('noticeid' => $val->smsid, 'noticetype' => $val->iType,
                    'sender' => $val->sSenderId,
                    'sendertitle' => $val->sSenderTitle,
                    'receiver' => '',
                    'receivertitle' => $val->receiverTitle,
                    'sendtime' => $val->lSendTime,
                    'receivename' => $val->receiverTitle,
                    'schoolname' =>'',
                    'index' => $val->index,
                    'content'=>$val->content
                );
                $array['showclass']="icon7";
                $array['typedesc']="紧急通知";

                $array['sendtime']=date("Y-m-d H:i:s",$val->lSendTime);
                $array['showtime']=(substr($array['sendtime'], 0, 10) == date("Y-m-d")) ? ('今天 ' . substr($array['sendtime'], 11, 5)) : substr($array['sendtime'], 0, 16);
               // if(!$cache->get("smssenddetail_uid:".$uid."_smsid_".$val->smsid)){
                    $cache->set("smssenddetail_uid:".$uid."_smsid_".$val->smsid,$array);
              //  }
                $data[] = $array;

            }
        }
        $criteria=new   CDbCriteria();
        $pager = new CPagination($count);
        $pager->pageSize = Constant::MESSAGE_PAGE_SIZE;
        $pager->applyLimit($criteria);
        $pager->params['total']=$count;
        $list['model'] = $data;
        $this->render("smshistory", array('data' => $list, 'loginType' => 1,'count'=>$count,'pages'=>$pager));
    }

    /*
  * 收件箱详情页
  */
    public function actionReceivedetail($id)
    {

        $uid = Yii::app()->user->id;
        $oldurl=Yii::app()->user->returnUrl();
        $index=Yii::app()->request->getParam("index",0);
        $targteid=Yii::app()->request->getParam("targteid",0);
        if(empty($targteid)){
            $targteid=$uid;
        }
        $val=JceNotice::getOneNoticeMsg($id,$index,$targteid,$uid);
        $receiverinfo=null;
        if ($val) {
            if(Yii::app()->request->hostInfo.Yii::app()->request->getUrl()!=$oldurl){
                Yii::app()->cache->set("userid:$uid.receivedetail",$oldurl);
            }
            $instance=Yii::app()->user->getInstance();
            $array = array('noticeid' => $val->iNoticeId, 'noticetype' => $val->iType, 'content' => $val->tContent,
                'msgid' => 0,
                'sender' => $val->sSenderId,
                'sendertitle' => $val->sSenderTitle,
                'receiver' => $val->targteid,
                'receivertitle' =>$instance->name,
                'sendtime' => date("Y-m-d H:i:s",$val->lSendTime),
                'read' => $val->read,
                'readusers' => array(),
                'schoolname' => '',
                'uname' => $instance->name,
                'rguardian' => '',
                'evaluatetype' => 0,
                'sid' => 0,
                'index'=>$val->index,
                'targteid'=>$val->targteid
            );
            if($array['targteid']!=$uid){
                $user=JceUser::getUserInfo($array['targteid']);
                $array['receivertitle']=$user?$user->name:'';
            }
            $msginfo = $this->assemblyNotice($array);

            if ($val->read == 0) { //如果状态为未读，改为已读
                //发送确认通知
                JceNotice::ackNoticeStatus($msginfo['noticeid'],$val->targteid,1,$uid);
            }
        }
        $this->render("receivedetail", array('returnurl'=> Yii::app()->cache->get("userid:$uid.receivedetail")
            ,'msginfo' => $msginfo));
    }

    /*
  * 发件箱详情页
  */
    public function actionHistorydetail($id)
    {
        $uid = Yii::app()->user->id;
        $index=Yii::app()->request->getParam("index",0);
        $val=JceNotice::getOneSendNotice($id,$index,$uid,$uid);
       // D($val);
        if(!$val||!property_exists($val,'iNoticeId')){
            Yii::app()->msg->postMsg('error', '消息不存在');
            $this->redirect(array("notice/history"));
            exit();
        }
        $oldurl=Yii::app()->user->returnUrl();
        if(Yii::app()->request->hostInfo.Yii::app()->request->getUrl()!=$oldurl){
            Yii::app()->cache->set("userid:$uid.historydetail",$oldurl);
        }
        $instance=Yii::app()->user->getInstance();
        $array = array('noticeid' => $val->iNoticeId, 'noticetype' => $val->iType, 'content' => $val->tContent,
            'sender' => $val->sSenderId,
            'sendertitle' => $val->sSenderTitle,
            'receiver' => '',
            'receivertitle' => $val->receiverTitle,
            'sendtime' => date("Y-m-d H:i:s",$val->lSendTime),
            'receivename' => $val->receiverTitle,
            'schoolname' =>'',
            'evaluatetype' => $val->evalute,
            'platform' => $val->nPlatform,
            'ReceiverNum' => $val->ReceiverNum,
            'readedNum' => $val->readedNum,
            'index' => $val->index,);
        if($val->iType==5){
            $score=isset($val->tContent->vScore[0])?$val->tContent->vScore[0]:0;
            $cid=$score?$score->cid:0;
            $classinfo=null;
            if($cid){
                $classinfo=JceClass::classInfo($cid,1);
            }
            $array['classname']=$classinfo?$classinfo->name:"未知班级";
            $array['schoolname']=$classinfo?$classinfo->tSchool->name:'未知学校';;
        }
        $noticeinfo = $this->assemblyNotice($array);
        $studentnum=0; //学生数
        $guardiannum=0; //家长数
        $studentReadNum=0;
        $total_read=array();
        if($noticeinfo['noticetype']!==4){
        $readdetail=JceNotice::getNoticeSendDetail($id);
            if($readdetail){
                $studentRead=$readdetail->studentRead->get_val(); //已读家长数据
                $studentUnRead=$readdetail->studentUnread->get_val();//未读家长数据
                $teacherRead=$readdetail->teacherRead->get_val(); //已读老师数据
                $teacherunRead=$readdetail->teacherUnread->get_val(); //未读老师数据

                $alluids=array(); //所有家长uid和老师uid，用于用户活粤状态

                $studentuids=array();
                if(is_array($teacherRead)){
                    foreach($teacherRead as $val){
                        //老师type=1,以便以后紧急通知（）老师显示，现在暂时不显示老师，
                        $readdata=array('userid'=>$val->uid->val,'name'=>$val->name->val,'read'=>1,'family'=>array(),'readnum'=>1,'total'=>1,'type'=>1);
                        $total_read[]=$readdata;
                        $alluids[]=$val->uid->val;
                    }
                }
               // D($studentUnRead);
                //学生已读
                if(is_array($studentRead)){
                    foreach($studentRead as $val){
                        $readdata=array('userid'=>$val->sid->val,'name'=>$val->name->val,'read'=>1,'family'=>array(),'type'=>2);
                        $readnum=0;
                        if(is_array($val->vFamilys->get_val())){
                            foreach($val->vFamilys->get_val() as $family){
                                if($family->guardianType->val==1){
                                    $readnum++;
                                }
                                $readdata['family'][$family->uid->val]=array('role'=>$family->relation->val,'mobile'=>$family->mobilePhone->val,'userid'=>$family->uid->val,'read'=>1);
                            }
                        }
                        $readdata['total']=count($readdata['family']);
                        $readdata['readnum']=$readnum;
                        $total_read[$val->sid->val]=$readdata;
                    }
                }
                //老师未读
                if(is_array($teacherunRead)){
                    foreach($teacherunRead as $val){
                        $readdata=array('userid'=>$val->uid->val,'name'=>$val->name->val,'read'=>0,'family'=>array(),'readnum'=>0,'total'=>1,'type'=>1);
                        $total_read[]=$readdata;
                            $alluids[]=$val->uid->val;
                    }
                }
                //学生未读
                if(is_array($studentUnRead)){
                    foreach($studentUnRead as $k=>$val){
                        //要判断该学生是否有已读家长数据
                        $isread=false;
                        if(isset($total_read[$val->sid->val])){
                            $readdata=$total_read[$val->sid->val];
                            $isread=true;
                        }else{
                            $readdata=array('userid'=>$val->sid->val,'name'=>$val->name->val,'read'=>0,'family'=>array(),'type'=>2);
                        }
                        if(is_array($val->vFamilys->get_val())){
                            foreach($val->vFamilys->get_val() as $kk=>$family){
                                if(!isset( $readdata['family'][$family->uid->val]))
                                $readdata['family'][$family->uid->val]=array('role'=>$family->relation->val,'mobile'=>$family->mobilePhone->val,'userid'=>$family->uid->val,'read'=>0);
                            }
                        }
                        if(!$isread){
                            $readdata['readnum']=0;
                        }
                        $readdata['total']=count($readdata['family']);
                        $total_read[$val->sid->val]=$readdata;
                    }
                }
               //D($total_read);

                foreach($total_read as $t=>$val){
                    if($val['type']==2){
                        $studentnum++;
                        if($val['read']==1){
                            $studentReadNum++;
                        }
                        if(is_array($val['family'])){
                            foreach($val['family'] as $fa){
                                $guardiannum++;
                                $alluids[]=$fa['userid'];
                            }
                        }
                    }else{
                        $alluids[]=$val['userid'];
                    }
                }
            }
        }
        $readtimes=$readdetail->readTime->get_val();//获取阅读时间的数据，放在数组中
        if(is_array($readtimes)&&!empty($readtimes)){
            foreach($readtimes as $readval){
                $student=isset($total_read[$readval->tagid->val])?$total_read[$readval->tagid->val]:null;
                if($student){
                   if(is_array($student['family'])){
                       foreach($student['family'] as $k=>$val){
                           if($k==$readval->userid->val){
                               if($readval->readTime->val){
                                 $student['family'][$k]['readtime']=date("Y-m-d H:i:s",$readval->readTime->val);
                               }
                           }
                       }
                   }
                    $total_read[$readval->tagid->val]=$student;
                }
            }
        }
        //$stateArr=Member::getUserActiveState($alluids);//获取所有uid的活跃状态(家长及老师)
        $this->render("historydetail", array('returnurl'=> Yii::app()->cache->get("userid:$uid.historydetail"),
            'totalStudent'=>$studentnum,'studentReadNum'=>$studentReadNum,'stateArr'=>null,
            'guardiannum'=>$guardiannum,'total_res' => $total_read, 'uid' => $uid, 'noticeinfo' => $noticeinfo));
    }

    /*
 * 发件箱详情页
 */
    public function actionSmshistorydetail($id)
    {
        $uid = Yii::app()->user->id;
        $index=Yii::app()->request->getParam("index",0);
        $cache=Yii::app()->cache;
        $smsdetail=$cache->get("smssenddetail_uid:".$uid."_smsid_".$id);
        //缓存里没找到
        if(!$smsdetail){
            $val=null;
            $list=JceNotice::getSmsSendNotice($index,2,$uid);
              if(is_array($list['vNotice'])){
                  foreach($list['vNotice'] as $sms){
                      if($sms->smsid==$id){
                          $val=$sms;
                           break;
                      }
                  }
              }
            if($val){
                $array = array('noticeid' => $val->smsid, 'noticetype' => $val->iType,
                    'sender' => $val->sSenderId,
                    'sendertitle' => $val->sSenderTitle,
                    'receiver' => '',
                    'receivertitle' => $val->receiverTitle,
                    'sendtime' => $val->lSendTime,
                    'receivename' => $val->receiverTitle,
                    'schoolname' =>'',
                    'index' => $val->index,
                    'content'=>$val->content
                );
                $array['showclass']="icon7";
                $array['typedesc']="紧急通知";
                $array['sendtime']=date("Y-m-d H:i:s",$val->lSendTime);
                $array['showtime']=(substr($array['sendtime'], 0, 10) == date("Y-m-d")) ? ('今天 ' . substr($array['sendtime'], 11, 5)) : substr($array['sendtime'], 0, 16);
                $smsdetail=$array;
            }else{
                Yii::app()->msg->postMsg('error', '消息不存在');
                $this->redirect(array("notice/smshistory"));
                exit();
            }
        }

        $oldurl=Yii::app()->user->returnUrl();
        if(Yii::app()->request->hostInfo.Yii::app()->request->getUrl()!=$oldurl){
            Yii::app()->cache->set("userid:$uid.smshistorydetail",$oldurl);
        }
        $instance=Yii::app()->user->getInstance();
        $studentnum=0; //学生数
        $guardiannum=0; //家长数
        $studentReadNum=0;
        $total_read=array();
        $this->render("smshistorydetail", array('returnurl'=> Yii::app()->cache->get("userid:$uid.smshistorydetail"),
            'totalStudent'=>$studentnum,'studentReadNum'=>$studentReadNum,'stateArr'=>null,
            'guardiannum'=>$guardiannum,'total_res' => $total_read, 'uid' => $uid, 'noticeinfo' => $smsdetail));
    }

    //组装通知
    private function assemblyNotice($data)
    {
        $noticeTypedesc = Constant::noticeTypeArray();
        $data['typedesc'] = $noticeTypedesc[strval($data['noticetype'])] ? $noticeTypedesc[strval($data['noticetype'])] : ''; //通知中文说明
        $evaluatetypeArr = Constant::evaluatetypeArr();
        if ($data['noticetype'] == Constant::NOTICE_TYPE_3) {
            $data['typedesc'] .= "<span class='conduct'>（<font>" . $evaluatetypeArr[(int)$data['evaluatetype']] . "</font>）</span>";
        }
        $data['showtime'] = (substr($data['sendtime'], 0, 10) == date("Y-m-d")) ? ('今天 ' . substr($data['sendtime'], 11, 5)) : substr($data['sendtime'], 0, 16);
        $oldcontent_arr=$data['content'];
        $oldcontent=$oldcontent_arr->content;
       // D($oldcontent_arr);
       // $oldcontent = str_replace("\r\n", "<br/>", $oldcontent);
        $oldcontent = str_replace("\t", "&nbsp;&nbsp;", $oldcontent);
        $oldcontent = str_replace(array("<",">"), array("&lt","&gt"), $oldcontent);
        $oldcontent = nl2br($oldcontent);
        $oldcontent = str_replace("\t", "&nbsp;&nbsp;", $oldcontent);
        $data['content']=$oldcontent;
        if (isset($data['content']) && is_array($data['content']) && $data['noticetype'] == Constant::NOTICE_TYPE_8) { //新的餐单保存方式
        } else if (isset($oldcontent_arr->vScore)
            &&!empty($oldcontent_arr->vScore[0])&& $data['noticetype'] == Constant::NOTICE_TYPE_5) {
                $scorecontent=$oldcontent_arr->vScore[0];
                $cid=(int)$scorecontent->cid;
                $studentArr=array();
                if($cid){
                    $classmember=JceHelper::getClassMember($cid,0);
                    if(is_array($classmember)){
                        foreach($classmember as $student){
                            $studentArr[$student->sid]=$student->name;
                        }
                    }

                }
                $data['schoolname']=isset($data['schoolname'])?($data['schoolname']=='未知学校'?'':$data['schoolname']):'';
                $str = $data['schoolname']?("<span style='width:100px; display:inline-block; '>学校</span>：</span>" . $data['schoolname'] . "</br>"):'';
                $str=$str."<span style='width:100px; display:inline-block; '>班级</span>：" . (isset($data['classname'])?$data['classname']:'')
                    ."</br><span style='width:100px; display:inline-block; '>科目</span>：" . $oldcontent_arr->subject."</br> <span style='width:100px; display:inline-block; '
                >类型</span>：" . $scorecontent->title . "</br><span style='width:100px; display:inline-block; '>名称</span>：" . $scorecontent->examine.  "</br>";
                    $str.="<span style='width:100px; display:inline-block; '>时间</span>：" . date("Y-m-d",$scorecontent->timestamp)."</br>";
                $str .= '</br><p style=" color:#303030;  font-size:16px;">（成绩通知单）</p></br>';
                $str.='<table class="table table-bordered tableC" style="max-width:60%; font-size:15px;">';
                $str.="<thead>";
                $str.="<tr>";
                $str.="<th>姓名</th>";
                $subjects=str_replace('，', ',', $oldcontent_arr->subject);
                $sarr=array();
                $sarr=preg_split('/[,]/',trim($subjects));
                foreach($sarr as $subjectone){
                    $str.="<th>$subjectone</th>";
                }
                $str.="</tr>";
                $str.="<tbody>";
                foreach($oldcontent_arr->vScore as $vscroe){
                    if (is_array($vscroe->vSubjectScore)) {
                        $str.= "<td>" .(isset($studentArr[$vscroe->tagid])?$studentArr[$vscroe->tagid]:$scorecontent->tagid) . "</td>";

                        foreach ($vscroe->vSubjectScore as $kk => $exam) {
                            $str .= "<td>".(($exam->score===''||$exam->score==null)?'未录入成绩':$exam->score) . "</td>";
                        }
                    }
                    $str.="</tr>";

                }
                $str.="</tbody></table>";
                //"<span style='width:100px; display:inline-block; '>姓名</span>：" .$scorecontent->tagid . "</br> ";
//                if (is_array($scorecontent->vSubjectScore)) {
//                    $str .= "<span style='width:100px; display:inline-block; '>成绩</span>：";
//                    foreach ($scorecontent->vSubjectScore as $kk => $exam) {
//                        $str .= $exam->subject."：".(($exam->score===''||$exam->score==null)?'缺考':$exam->score) . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
//                    }
//                }
                $data['content'] = $str;
        }
        if ($data['noticetype'] == Constant::NOTICE_TYPE_0) { //班班公告
            $data['showclass'] = "icon5";
        } else if ($data['noticetype'] == Constant::NOTICE_TYPE_4) { //紧急通知
            $data['showclass'] = "icon6";
        } else if ($data['noticetype'] == Constant::NOTICE_TYPE_1) {
            $data['showclass'] = "icon2";
        } else if ($data['noticetype'] == Constant::NOTICE_TYPE_6) {
            $data['showclass'] = "icon1";
        } else if ($data['noticetype'] == Constant::NOTICE_TYPE_7) {
            $data['showclass'] = "icon1";
        } else if ($data['noticetype'] == Constant::NOTICE_TYPE_2 || $data['noticetype'] == Constant::NOTICE_TYPE_5 || $data['noticetype'] == Constant::NOTICE_TYPE_6) {
            $data['showclass'] = "icon3";
        } else if ($data['noticetype'] == Constant::NOTICE_TYPE_8) {
            $data['showclass'] = "icon1";
        } else if ($data['noticetype'] == Constant::NOTICE_TYPE_3) {
            $data['showclass'] = "icon4";
        } else {
            $data['showclass'] = "icon1"; //通知显示的class每种通知class不同
        }
        if (!empty($data['read'])) {
            $data['readMsg'] = '';
        } else {
            $data['readMsg'] = '未读';
        }
       // D($oldcontent_arr);
//        if (isset($content['images'])) {
//            $data['images'] = $content['images'];
//        } else {
//            $data['images'] = array();
//        }
        //手机上发的图片，保存在xiaoxin的服务器上需要换取地址
//        foreach ($data['images'] as $k => $v) {
//            if (is_string($v)) {
//                $data['images'][$k] = CLIENT_FILE_DOWNLOAD_URL . "?ac=getfile&Type=17&Name=" . $v;
//            } else if (is_array($v)) {
//                $data['images'][$k] = CLIENT_FILE_DOWNLOAD_URL . "?ac=getfile&Type=17&Name=" . $v['url'];
//            }
//        }
        //web上上传的图片，保存在七牛云

        if ($oldcontent_arr->vPhotos) {
            $data['pictures'] = $oldcontent_arr->vPhotos;
        } else {
            $data['pictures'] = array();
        }
        foreach ($data['pictures'] as $val) {
            if(is_array($val)&&isset($val['url'])){
                $data['images'][] = STORAGE_QINNIU_XIAOXIN_TX . $val['url'];
            }else if(is_string($val)){
                $data['images'][] = STORAGE_QINNIU_XIAOXIN_TX . $val;
            }
        }

        $data['receivername'] = '';
        return $data;
    }
    /*
     * 发布成绩
     */
    public function actionSendexam(){
       // D(Yii::app()->cache);
       // D($mem);
        $uid=Yii::app()->user->id;
        $instance=JceUser::getUserInfo($uid);
        $userIdentity = Yii::app()->user->getCurrIdentity();
        $cache=Yii::app()->cache;
        $examType=array('1'=>'单元考试','2'=>'月考','3'=>'期中考试','4'=>'期末考试');;
        $isclick=$cache->get("isfirstclicksendexam_".$uid)?1:0;
        if(!$isclick){
            $a=$cache->set("isfirstclicksendexam_".$uid,1,3600);
           // D($cache->get("isfirstclicksendexam_".$uid));
        }
       // D($cache->get("isfirstclicksendexam_".$uid));
        if(isset($_POST['cid'])&&isset($_POST['examname'])&&isset($_POST['examdate'])&& $uid && ($userIdentity->isTeacher)){
            $params=array();
            $params['examname']=$_POST['examname'];
            $params['examdate']=$_POST['examdate'];
            $params['examtype']=(string)$_POST['examtype'];//考试类型
            $params['examsubject']=$_POST['examsubject'];//考试科目
            $params['cid']=(int)$_POST['cid'];//考试科目
            $repeatstudents=isset($_POST['Student'])?$_POST['Student']:array();//重复学生数据

            $class=JceClass:: classInfo($params['cid'], 1);
            if(!$class){
                //没有斑级,提示
                Yii::app()->msg->postMsg('error', '班级不存在');
                exit();
            }
            //原来是考虑加上班级id,在flash组件中，做不到，一进入页面，就初始化了uploader,这时不管如何选择页面都是这个地址
            $scorekey="exam". "sendexam" . $uid.$params['cid'];
            $examscore=$cache->get($scorekey);
            $cache->delete("sendexaminvitefamily-".$params['cid']."-$uid");

            //看缓存中是否有成绩数据
            if(empty($examscore)){
                //没有斑级,提示
                Yii::app()->msg->postMsg('error', '没有录入成绩');
                $url=Yii::app()->createUrl("notice/sendexam");
                $this->redirect($url);
                exit();
            }
            if(!empty($repeatstudents)){
                $tempscore=array();
                foreach($examscore as $v){
                    $tempscore[$v['userid']]=$v;
                }
                 foreach($repeatstudents as $k=>$val){
                    if(array_key_exists($k,$tempscore)){
                        foreach($val as $subject=>$sc){
                            $tempscore[$k]['score'][$subject]=$sc;
                        }
                    }else{
                        $tempscore[$k]['userid']=$k;
                        $userinfo=JceUser::getUserInfo($k);
                        $tempscore[$k]['name']=$userinfo?$userinfo->name:"";
                        foreach($val as $subject=>$sc){
                            $tempscore[$k]['score'][$subject]=$sc;
                        }
                    }
                 }

                $cache->set($scorekey,$tempscore,600);
                $examscore=$cache->get($scorekey);

            }
          //  D($examscore);

            //接收人
            $classStudents=JceClass::getClassMember($params['cid'],0);//这个班的所有学生
            $classStudentsArr=array();
            $studentids=array();
            foreach($classStudents as $val){
                $classStudentsArr[$val->sid]=$val->name;
            }
            foreach($examscore as $vv){
                if($vv['userid']){
                   $studentids[]=$vv['userid'];
                }
            }
            $receiver=array('5'=>$studentids);//接收人
            $params['examtype']=$examType[$_POST['examtype']];
            $result=JceNotice::sendNoticeExam(time(),$receiver,5,$instance->icon?$instance->icon:'','',$instance->name,$uid,0,$class->name,$params,$examscore,$classStudentsArr);
            if($result){
                $this->redirect(Yii::app()->createUrl('/notice/examnext?cid='.$params['cid'].'&num='.count($studentids)));
            }
        }
        $identity = Yii::app()->user->getCurrIdentity();
        if( false === $identity ){  // 身份认证失败
            Yii::app()->end();
        }
        //获取学校
        $sids = array();
        $schools = array();
        // 获取老师的所有班级
        $classdata = JceClass::getClassList();    // 获取当前用户的班级列表
        $classList=array();
        $root = yii::app()->basePath;
        require_once($root . '/extensions/PHPEmoji/emoji.php');
        $hasemoji=array();
        if(is_array($classdata)){
            foreach($classdata as $k=>$v){
                if(is_array($v->classes)){
                    foreach($v->classes as $eachclass){
                        if($eachclass->authority==1||$eachclass->authority==2){
                            $classList[]=$eachclass;
                            $hasemoji[$eachclass->cid]=$this->checkHasemoji($eachclass->cid)?1:0;
                        }
                    }
                }
            }
        }
        $params=array();
        $params['examname']=Yii::app()->request->getParam('examname');//isset($_REQUEST['examname'])?$_REQUEST['examname']:'';
        $params['examdate']=Yii::app()->request->getParam('examdate');//isset($_REQUEST['examdate'])?$_REQUEST['examdate']:'';
        $params['examtype']=Yii::app()->request->getParam('examtype');//isset($_REQUEST['examtype'])?$_REQUEST['examtype']:'';//考试类型
        $params['examsubject']=Yii::app()->request->getParam('examsubject');//isset($_REQUEST['examsubject'])?$_REQUEST['examsubject']:'';//考试科目
        $params['cid']=Yii::app()->request->getParam('cid');//isset($_REQUEST['cid'])?$_REQUEST['cid']:'';//考试科目
        $this->render("sendexam",array('examtypes'=>$examType,'isclick'=>$isclick,'classs'=>$classList,'schools'=>$schools,'params'=>$params,'hasemoji'=>$hasemoji));
    }
    /*
     * 发布成绩预览
     */
    public function actionExampreview(){
        $cache=Yii::app()->cache;
        $uid=Yii::app()->user->id;
        $cid=(int)Yii::app()->request->getParam('cid');
        $data=$cache->get("exam" . "sendexam" . $uid.$cid);//完全匹配班级学生的成绩学生数据
        $notmatchdata=$cache->get("exam" . "sendexamnotmatch" . $uid.$cid); //没有匹配到班级学生名单的数据,即上传表格中有，但班级学生中没有
        $params=array();
        $params['cid']=$cid;
        $header=array();
        $classMember=JceClass::getClassMember($cid,0);
        $subjects='';
        $scorerelation=array();
        $names=array();
        if(empty($data)){
            Yii::app()->msg->postMsg('error', '发布失败,上传成绩为空');
            $this->redirect(Yii::app()->createUrl('/notice/sendexam'));
            exit();
        }
        if($data&&is_array($data)&&count($data)){
            $row1=$data[0];
            foreach($row1['score'] as $k=>$val){
                $header[]=$k;
            }
            foreach($data as $v){
                $names[]=$v['name'];
                $scorerelation[$v['name']]=$v['score'];
            }
        }

        $params['examsubject']=implode(",",$header);
        $params['examdate']= Yii::app()->request->getParam('examdate');
        $params['examtype']= Yii::app()->request->getParam('examtype');
        $params['examname']= Yii::app()->request->getParam('examname');

        $studentnames=array();
        $repeatnames=array(); //保存班级重名学生
        foreach($classMember as $val){
           if(!in_array($val->name,$studentnames)){
               $studentnames[]=$val->name;
           }else{
               $repeatnames[]=$val->name;
           }
        }
        $dec=0;//要减的重名学生数
        foreach($repeatnames as $val){
            if(in_array($val,$names)){
                $dec++;
            }
        }
        $repeatstudents=array();
        foreach($classMember as $val){
            if(in_array($val->name,$repeatnames)&&in_array($val->name,$names)){
                $repeatstudents[]=$val;
            }
        }
        $repeatfamily=array();
        $successnum=is_array($data)?count($data):0;
       // if(count($repeatnames)){
        $successnum-=$dec;
      //  }
        //D($repeatstudents);
        foreach($repeatstudents as $k=>$val){
            if($val->vFamilys){
                foreach($val->vFamilys as $family){
                    $repeatfamily[$val->sid]['name']=$val->name;
                    if($family->guardianType==1){
                        $repeatfamily[$val->sid]['role']=  '（'.( $family->relation?$family->relation:'家长 &nbsp;').'：'.$family->name.' &nbsp;'.($family->mobilePhone?$family->mobilePhone:'').'）';
                    }
                    if(isset($scorerelation[$val->name])){
                        $repeatfamily[$val->sid]['score']=$scorerelation[$val->name];
                    }else{
                        $reset=$row1['score'];
                        foreach($reset as $k=>$v){
                            $reset[$k]='';
                        }
                        $repeatfamily[$val->sid]['score']=$reset;
                    }

                }
            }
        }
        //D($repeatfamily);
        $nomatchnames=array_diff($studentnames,$names); //班级学生中有，上传表格中没有
        $this->render("exampreview",array('successnum'=>$successnum,'repeatfamily'=>$repeatfamily,'params'=>$params,'header'=>$header,'data'=>$data,'nomatchnames'=>$nomatchnames,'repeatnames'=>$repeatnames,'repeatstudents'=>$repeatstudents));
    }

    /*
     * 发布成绩完成
     */
    public function actionExamnext(){
        $num=(int)Yii::app()->request->getParam('num',0);
        $cid=(int)Yii::app()->request->getParam('cid',0);
        $class=null;
        $uid=Yii::app()->user->id;
        $userinfo=Yii::app()->user->getInstance();
        $unbindstudents=array();
        $header=array();
        $mobiles=array();
        $cache=Yii::app()->cache;
        $notmatchdata=$cache->get("exam" . "sendexamnotmatch" . $uid.$cid); //没有匹配到班级学生名单的数据,即上传表格中有，但班级学生中没有
        $data=$cache->get("exam" . "sendexam" . $uid.$cid); //成绩数据
        $scoredata=array();
        if(is_array($data)){
            foreach($data as $val){
                $scoredata[$val['userid']]=$val;
            }
        }

        if($cid){
            $class=JceClass::classInfo($cid,0);
            if($class){
                $members=JceClass::getClassMember($cid,0);
                foreach($members as $member){
                        if(is_array($member->vFamilys)){
                            foreach($member->vFamilys as $family){
                                if($family->guardianType==1&&$family->loginstatus==0&&!empty($family->mobilePhone)&&isset($scoredata[$member->sid])){ //只管家长有没有绑定
                                    $mobiles[]=$family->mobilePhone;
                                    $unbindstudents[$member->sid]=array('name'=>$member->name,'phone'=>$family->mobilePhone,'score'=>isset($scoredata[$member->sid]['score'])?$scoredata[$member->sid]['score']:array());
                                }
                            }
                        }

                }
            }
            $header=array();
            //D($mobiles);
            $row0=is_array($data)?array_shift($data):null;
            if(isset($row0['score'])){
                foreach($row0['score'] as $k=>$subject){
                    $header[]=$k;//科目数组
                }
            }
          //  $cache->delete("exam" . "sendexamnotmatch" . $uid.$cid); //删除缓存
           // $cache->delete("exam" . "sendexam" . $uid.$cid); //删除缓存
            $this->render("examnext",array('cid'=>$cid,'class'=>$class,'mobiles'=>implode(",",$mobiles),'userinfo'=>$userinfo,'num'=>$num,'unbindstudents'=>$unbindstudents,'notmatchdata'=>$notmatchdata,'header'=>$header));
        }
    }
    /*
     * 下载成绩模板
     */
    public function  actionDownload(){
            $cid=(int)Yii::app()->request->getParam("cid",0);
            if($cid) {
                $root = yii::app()->basePath;
                $classInfo = JceClass::classInfo($cid, 1);
                if(!$classInfo){
                    echo '无效班级';
                    die;
                }
                require_once($root . '/extensions/PHPEmoji/emoji.php');
                $excel_file = $classInfo->name.'-学生成绩';
                $header = array("姓名",'在本格中输入科目名称(若有多个科目，请自行增加列）' ); //excel表头
                $ceils = array();
                $classMan = array();
                $clsssStudent = JceClass::getClassMember($cid,0);;
                if(is_array($clsssStudent)){
                    foreach ($clsssStudent as $student) {
                        $studentname=emoji_unified_to_html($student->name);
                        if(strpos($studentname,'span')===false&&strpos($studentname,'class')===false&&strpos($studentname,'emoji')===false){
                            if(substr($student->name,0,1)=='0'){
                                $data = array('name' => ' '.$student->name);
                            }else{
                                $data = array('name' => strval($student->name));
                            }
                            $classMan[] = $data;
                        }

                    }
                }
               // $classMan[]=array('name'=>'学生姓名中有表情符号，无法匹配姓名，需家长修改学生名后，才可以发送');
                $score = array();
                foreach ($classMan as $kk => $val) {
                    $row = array();
                    $row[] = $val['name'];
                    $row[] = '';
                    $ceils[] = $row;
                }
                $classInfo->name=preg_replace('/[^\w\d\x{4e00}-\x{9fa5}]+$/ui','',$classInfo->name);
                $excel_content [] = array(
                    'sheet_name' => "(".$classInfo->name .")成绩录入" ,
                    'sheet_title' => $header,
                    'ceils' => $ceils,
                );
            }
            PHPExcelHelper::exportExamExcel($excel_content, $excel_file,1);
            exit();
    }

    /*
     * 上传成绩
     */
    public function actionScheck()
    {
        $uid = Yii::app()->request->getParam('uid') ? Yii::app()->request->getParam('uid') : Yii::app()->user->id;
        $cid = (int)Yii::app()->request->getParam('cid');
        if (empty($cid)) {
            die(json_encode(array('status' => '0', 'msg' => '上传失败,请选择班级')));
        }
        $classInfo=JceClass::classInfo($cid,0);
        if(!$classInfo){
            die(json_encode(array('status' => '0', 'msg' => '上传失败,班级不存在')));
        }
        $clsssStudent = JceClass::getClassMember($cid,0);;
        $classstudents=array();
        foreach($clsssStudent as $student){
            $classstudents[$student->name]=$student->sid;
        }
        if (isset($_FILES['file'])) {
            $cache = Yii::app()->cache;
            $cache->delete("exam" .  "sendexam" . $uid.$cid);
            $root = yii::app()->basePath;
            spl_autoload_unregister(array('YiiBase', 'autoload'));
            $filename=$_FILES['file']['name'];
            $uploadfile = $_FILES['file']['tmp_name'];
            Yii::$enableIncludePath = false;
            Yii::import('application.extensions.PHPExcel', 1);
            require_once($root . '/extensions/PHPExcel/IOFactory.php');
            require_once($root . '/extensions/PHPExcel/Reader/Excel5.php');
            require_once($root . '/extensions/PHPExcel/Reader/Excel2007.php');
            $objPHPExcel = new PHPExcel();
            $a=explode(".",$filename);
            $ext=$a[count($a)-1];
            if($ext=='xls'){
                $objReader = PHPExcel_IOFactory::createReader('Excel5');
            }else{
                $objReader = PHPExcel_IOFactory::createReader('Excel2007');
            }
            $objReader->setReadDataOnly(true);
            $objPHPExcel = $objReader->load($uploadfile);
            $objPHPExcel->setActiveSheetIndex(0);
            $ActiveSheet = $objPHPExcel->getActiveSheet();
            $allData = array();
             $userid=0;
             $max = $objPHPExcel->getActiveSheet()->getHighestRow();//最大行数
            //error_log("max:".$max);
             $columns= $objPHPExcel->getActiveSheet()->getHighestColumn();//最大列数　　ＣＤ
             $maxColumns=0;
            for($i='A'; $i<=$columns;$i++){
                $maxColumns++;  //最大列数转换成数字　
            }
             $subjects=array();
             $subjectnum=0; //科目数
             $dataArr = array();
             $subjects=array();
             $co1=trim($objPHPExcel->getActiveSheet()->getCellByColumnAndRow(0, 1)->getValue()); //姓名
             $co2=trim($objPHPExcel->getActiveSheet()->getCellByColumnAndRow(1, 1)->getValue());//科目1
             if(empty($co1)||empty($co2)){
                 spl_autoload_register(array('YiiBase', 'autoload'));
                 die(json_encode(array('status' => '0', 'msg' =>"上传的表格不符合示意图,(第一行第一列为`姓名`,且科目名不能为空)，请重新修改上传")));
             }
            if($co1&&$co1!='姓名'){ //第一行第一列必须为“姓名”
                spl_autoload_register(array('YiiBase', 'autoload'));
                die(json_encode(array('status' => '0', 'msg' => "上传的表格不符合示意图,(第一行第一列为`姓名`,且科目名不能为空)，请修改并重新上传")));
            }
            if(strpos($co2,'在本格中输入科目名称')!==false){
               // error_log("dfdd");
                spl_autoload_register(array('YiiBase', 'autoload'));
                die(json_encode(array('status' => '0', 'msg' => '上传的表格中有科目名称未填写，请补充并重新上传。')));
            }
            $subjects=array("1"=>$co2);
            for($j=2;$j<$maxColumns;$j++){ //检查是否有科目为空，为空则提示科目为空
                $cos=trim($objPHPExcel->getActiveSheet()->getCellByColumnAndRow($j, 1)->getValue());
                if(empty($cos)){
                    spl_autoload_register(array('YiiBase', 'autoload'));
                    die(json_encode(array('status' => '0', 'msg' => "上传的表格不符合示意图,(第一行第一列为`姓名`,且科目名不能为空)，请修改并重新上传")));
                }

                if(strpos($cos,'在本格中输入科目名称')!==false){
                   // error_log("dfdd");
                    spl_autoload_register(array('YiiBase', 'autoload'));
                    die(json_encode(array('status' => '0', 'msg' => '上传的表格中有科目名称未填写，请补充并重新上传。')));
                }

                $subjects[$j]=$cos;
            }
            $names=array();
            $ismatchclasstudent=array();;//上传的表格中不能匹配到班级学生，
            $repeatnames=array();
            for ($row = 2; $row <= $max; $row++) {
                $name = trim($objPHPExcel->getActiveSheet()->getCellByColumnAndRow(0, $row)->getValue()); //姓名
                if(empty($name)){
                    $subjectvalue=false;
                    for($aa=1;$aa<$maxColumns;$aa++){ //成绩为数组,key为第一行的'英语,地理....',
                        $temp_subject=trim($objPHPExcel->getActiveSheet()->getCellByColumnAndRow($aa, $row)->getValue()); //科目成绩
                        if($temp_subject){
                            $subjectvalue=true;
                            break;
                        }
                    }
                    if(!$subjectvalue){
                        continue; //如果整行未填写，过滤
                    }
                    spl_autoload_register(array('YiiBase', 'autoload'));
                    die(json_encode(array('status' => '0', 'msg' => '上传的表格中有姓名未填写，请补充后重新上传')));
                }
                if(!in_array($name,$names)){ //判断表格中的姓名是否有重复
                    $names[]=$name;
                }else{
                    $repeatnames[]=$name;
                }
                $exam=array();
                for($aa=1;$aa<$maxColumns;$aa++){ //成绩为数组,key为第一行的'英语,地理....',
                    $value=trim($objPHPExcel->getActiveSheet()->getCellByColumnAndRow($aa, $row)->getValue()); //科目成绩
                    if($value===''){
                        spl_autoload_register(array('YiiBase', 'autoload'));
                        die(json_encode(array('status' => '0', 'msg' => '上传的表格中有学生部分科目成绩未填写，请补充后重新上传')));
                    }
                    $value=MainHelper::csubstr($value,0,8,"utf-8",false);
                    $exam[$subjects[$aa]]=$value; //成绩('地理'=>'50','英语'=>"80");
                }
                $studentinfo=isset($classstudents[$name])?$classstudents[$name]:'';
                if($studentinfo){
                    //能完全匹配的数据
                    $data = array('userid' => $studentinfo, 'name' => $name, 'score' => $exam);
                    $dataArr[] = $data;
                }else{
                    //不能匹配班级姓名的学生数据
                    $data=array('userid' => $studentinfo, 'name' => $name, 'score' => $exam);
                    $ismatchclasstudent[] = $data;
                }



            }
            if(!empty($repeatnames)){
                spl_autoload_register(array('YiiBase', 'autoload'));
                die(json_encode(array('status' => "0", 'msg' => "上传的表格有重名学生：".implode(",",$repeatnames)."。无法匹配真实学生，请删除重名后重新上传")));
            }

            if(empty($dataArr)){
                spl_autoload_register(array('YiiBase', 'autoload'));
                die(json_encode(array('status' => '0', 'msg' => '上传表格的学生名单，和班级学生名单无一人匹配，请检查后重新上传')));
            }
           // error_log("exam" . "sendexam" . $uid);
            $cache->set("exam" . "sendexam" . $uid.$cid, $dataArr,3600);
            $cache->set("exam" . "sendexamnotmatch" . $uid.$cid, $ismatchclasstudent,3600);
            spl_autoload_register(array('YiiBase', 'autoload'));
            die(json_encode(array('status' => '1', 'msg' => '上传成功')));
        } else {
            die(json_encode(array('status' => '0', 'msg' => '上传失败')));
        }
    }

    /*
    * 转发消息
     * 在已发送，增加，已转发功能,跳到发消息页面
    */
    public function actionFollow()
    {
        $noticeid=Yii::app()->request->getParam("noticeid",0);
        $index=Yii::app()->request->getParam("index",0);
        $uid=Yii::app()->user->id;
        if($noticeid){
            $noticeinfo=$val=JceNotice::getOneSendNotice($noticeid,$index,$uid,$uid);
            if($noticeinfo){
                if(in_array($noticeinfo->iType,array(1,2,3))){
                    $this->redirect(Yii::app()->createUrl('notice/send?noticeid='.$noticeinfo->iNoticeId."&noticetype=".$noticeinfo->iType."&index=".$noticeinfo->index."&evalute=".$noticeinfo->evalute));
                }else if($noticeinfo->iType==4) {
                    $this->redirect(Yii::app()->createUrl('notice/schoolnotice?noticeid='.$noticeinfo->iNoticeId."&noticetype=".$noticeinfo->iType."&index=".$noticeinfo->index));
                }
            }else{
                Yii::app()->msg->postMsg('error', '转发失败,通知不存在');
                $this->redirect(Yii::app()->createUrl('notice/history'));
                exit();
            }
        }else{
            Yii::app()->msg->postMsg('error', '转发失败,通知不存在');
            $this->redirect(Yii::app()->createUrl('notice/history'));
            exit();
        }

    }
    /*
     * 获取已读数，总数
     */
    public function getHistoryDetailcount($id){
        $readdetail=JceNotice::getNoticeSendDetail($id);
        if(!$readdetail){
           return array('studentnum'=>0,'studentReadnum'=>0);
        }
        $studentRead=$readdetail->studentRead->get_val(); //已读家长数据
        $studentUnRead=$readdetail->studentUnread->get_val();//未读家长数据
        $teacherRead=$readdetail->teacherRead->get_val(); //已读老师数据
        $teacherunRead=$readdetail->teacherUnread->get_val(); //未读老师数据

        $total_read=array();
        $alluids=array(); //所有家长uid和老师uid，用于用户活粤状态
        $studentnum=0; //学生数
        $studentReadnum=0;
        $readuids=array();

        if(is_array($studentRead)){
            foreach($studentRead as $val){
                if(!in_array($val->sid->val,$alluids)){
                    $alluids[]=$val->sid->val;
                    $studentnum++;

                }
                foreach($val->vFamilys->get_val() as $family){
                    if($family->guardianType->val==1){
                        $studentReadnum++;
                    }
                }
            }
        }

        if(is_array($studentUnRead)){
            foreach($studentUnRead as $val){
                if(!in_array($val->sid->val,$alluids)){
                    $alluids[]=$val->sid->val;
                    $studentnum++;
                }
            }
        }
        return array('studentnum'=>$studentnum,'studentReadnum'=>$studentReadnum);

    }

    /*
     * 发送紧争通知，选择班级后，显示班级人数，班费余额，未绑定手机等情况
     */
    public function actionGetclassinfo(){
        $cid=Yii::app()->request->getParam("cid",0);
        if($cid){
            $uid=Yii::app()->user->id;
            $class=JceClass::classInfo($cid,0);
            $students=JceClass::getClassMember($cid,0);//

            $unbindstudents=array();
            foreach($students as $val){
                if(empty($val->vFamilys)){
                    $unbindstudents[]=$val;
                }
                if(is_array($val->vFamilys)){
                    $isbind=false;
                    foreach($val->vFamilys as $family){
                        if(!empty($family->mobilePhone)&&$family->guardianType==1){ //只管家长有没有绑定
                            $isbind=true;
                            break;
                        }
                    }
                    if(!$isbind){
                        $unbindstudents[]=$val;
                    }
                }
            }

            $studentcount=count($students);//学生人数
            $unbindstudentcount=count($unbindstudents);//未绑定手机号人数；
            $unbindstudentnames='';
            if($unbindstudentcount){
                foreach($unbindstudents as $stu){
                    $unbindstudentnames.=$stu->name.",";
                }

            }
            $unbindstudentnames=rtrim($unbindstudentnames,",");//未绑定

            $classFeelist= JceHelper::getClassFeeInfo(array($cid));//班费数据
            $totalClassFee=isset($classFeelist[0])?substr(sprintf("%.3f", $classFeelist[0]['dBalance']),0,-1):0;//班费余额
            die(json_encode(array('status'=>'1','data'=>array('totalClassFee'=>$totalClassFee,'studentcount'=>$studentcount,
                'name'=>$class->name,'unbindstudentcount'=>$unbindstudentcount,'unbindstudentnames'=>$unbindstudentnames))));
        }else{
            die(json_encode(array('status'=>'0','data'=>array())));
        }
    }

    /*
     * 检查是否有敏感词
     */
    public function actionCheckbadword(){
        $content=Yii::app()->request->getParam('content','');
        $type=1;
        if($content){
            $result=JceNotice::checkBadword($content,$type);
            die(json_encode($result));
        }else{
            die(json_encode(array('status'=>'0','msg'=>'')));
        }
    }

    /*
     * 检查班级学生是否有表情符号weixin
     */
    private function checkHasemoji($cid){
        $hasemoji=false;
        $classMember=JceClass::getClassMember($cid,0);
        foreach ($classMember as $student) {
            $studentname=emoji_unified_to_html($student->name);

            if(strpos($studentname,'span')===false&&strpos($studentname,'class')===false&&strpos($studentname,'emoji')===false){
            }else{
                $hasemoji=true;
                break;
            }
        }
        return $hasemoji;

    }
    /*
     * 查看是否已经发送过邀请
     */
    public function actionInvite(){
        $cid=(int)Yii::app()->request->getParam('cid',0);
        $uid=Yii::app()->user->id;
        $cache=Yii::app()->cache;
        $isinvite=$cache->get("sendexaminvitefamily-$cid-$uid");
        if($isinvite&&$isinvite==1){
            die(json_encode(array('status'=>'1')));
        }else{
            die(json_encode(array('status'=>'0')));

        }
    }



}
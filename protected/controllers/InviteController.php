<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 15-3-31
 * Time: 下午2:10
 */

class InviteController extends Controller{
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

            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('index', 'send','test','awarddetail','state'),
            'users' => array('@'),
                'expression' => array($this, 'loginAndNotDeleted'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }



    public function init()
    {

    }

    public function  actionIndex(){
        $uid=Yii::app()->user->id;
        if($uid){
            $user=Yii::app()->user->getInstance();
            $cache=Yii::app()->cache;
            $cache->set("userid_".$uid."_inviteteacher","1");
            $identity=Yii::app()->user->getCurrIdentity();
            if(!$identity->isTeacher){
                Yii::app()->msg->postMsg('error', '对不起，此功能只对老师开放，请以老师身份登录');
                $this->redirect(Yii::app()->createUrl('notice/receive'));
                exit();
            }
//             $sms="您的好友".$user->name."老师（号码".$user->mobilephone."）：邀请您使用“". SITE_NAME."”平台，可便捷对班级发送通知及作业，联络家长。登录官网 ".
//                 SITE_URL.' 注册建班就送话费、挣班费。下载手机APP客户端更方便使用。咨询电话4001013838。';
            $sms= $user->name.'在班班送你了一张班费劵，点击链接 http://xxxxxxxx 立即领取！班费在手，班级郊游，开班会，买学习用品…想出手时就出手。班班，能赚班费涨知识的家校沟通神器！';
            $this->render("index",array('user'=>$user,'sms'=>$sms));
        }
    }

    /**
     * 邀请推荐结果页面
     * @return [type] [description]
     */
    public function actionState()
    {
        $this->render('state');
    }

    public function  actionAwarddetail(){
        $uid = Yii::app()->user->id;
        $inviteList = UserRegisterInvited::getInviteList($uid, 2);
        
        $okNum = 0;
        $notNum = 0;
        $exchangeNum = 0;
        foreach ($inviteList as $invite){
            
            if($invite->state == 1){
                $exchangeNum += 1;
                continue;
            }
            
            $userInfo = Member::model()->findByPk($invite->recevier);
            
            $bean = $userInfo->bean;

            $exchangeInvite = TeacherActiveStat::model()->findByAttributes(array('teacherid'=>$invite->recevier, 'deleted'=>0));
            //如果被邀请人已注册且已领取建班礼包应该把此礼包减去的青豆加上
            if($exchangeInvite && $exchangeInvite->isexchange > 0){
                $bean += Constant::GIFT_ACTIVITY_BEANS;
            }
        
            if($bean >= Constant::GIFT_ACTIVITY_BEANS && $exchangeInvite && $exchangeInvite->activeusers >= Constant::GIFT_ACTIVITY_ACTIVEUSERS){
                $okNum += 1;
            }else{
                $notNum += 1;
            }
        }
        $exchangeMoney = $exchangeNum * 30;
        $this->render("awarddetail", array('okNum'=>$okNum, 'notNum'=>$notNum, 'exchangeNum'=>$exchangeNum, 'exchangeMoney'=>$exchangeMoney));
    }

    public function  actionAwardcontent(){
        $this->render("awardcontent");
    }
    
    /**
     * 发送邀请
     */
    public function  actionSend()
    {
        $uid=Yii::app()->user->id;
        $user=Yii::app()->user->getInstance();
        $identity=Yii::app()->user->getCurrIdentity();
        $result=array('status'=>'1','msg'=>'发送失败！请检查内容及格式，重新发送。', 'registers' => [], 'threeInvited' => []);
        if(!$identity->isTeacher){
            $result['status']=0;
            $result['msg']='功能只对老师用户开放主，请以老师方式登录';
            die(json_encode($result));
        }
        $mobile=isset($_POST['mobile'])?trim($_POST['mobile']):'';
        $selecttype=isset($_POST['selecttype'])?trim($_POST['selecttype']):'1';
        $sendname=isset($_POST['sendname'])?trim($_POST['sendname']):$user->name;
        $classcode=isset($_POST['classcode'])?trim($_POST['classcode']):'';
        $classname=isset($_POST['classname'])?trim($_POST['classname']):'';

        $final = [];
        if(empty($mobile)){
            $result['status']=0;
            $result['msg']='手机号不能为空';
        }else{
            $mobileArr = explode("\n", $mobile);
            foreach ($mobileArr as $item) {  
                $item = trim($item);              
                if(preg_match('/^1\d{10}$/', $item)){  
                   $final[] = $item; 
                }
            }
            if(!empty($final)) {
               // $sms= $user->name."在班班送你了一张班费劵，点击链接 ". SITE_URL . Yii::app()->createUrl('mobile/invprize', array('uid'=>$uid, 'source'=>3, 'clienttype'=>3)).' 立即领取！班费在手，班级郊游，开班会，买学习用品…想出手时就出手。班班，能赚班费涨知识的家校沟通神器！';
                $url=SITE_URL . Yii::app()->createUrl('mobile/invprize', array('uid'=>$uid));
                if($selecttype==1){
                    $sendname=isset($_POST['sendname_out'])?trim($_POST['sendname_out']):$user->name;
                    $sms=$sendname.'邀请你加入班班，点击 '.$url.' 领取见面礼。作业通知网页端、手机端轻松发布；动动手指挣班费，丰富班级活动。班班，能赚班费涨知识的家校沟通工具。';
                    //$sms="（Duang！）你被".$sendname."扔的一大坨班费砸中啦！立即领取 ". $url." 。初秋，艳阳天，景色辣么美，带孩子们来一场说走就走的秋游。班费不够？班班送千万班费，走起！班班，能赚班费涨知识的家校沟通神器";
                }else if($selecttype==2){
                    $sms="各位家长你们好：我是".$classname."的".$sendname."老师，新学期班级通知、家庭作业、考试成绩…都会从这里发给大家，请大家尽快下载班班手机应用：http://app.banban.im/install。下载后，输入班级代码:".$classcode." ,就能找到咱们班了。 ";
                  //  $sms="嗨，各位同学们，咱们班已经建好了，点击链接：".$url." 下载班班APP，输入班级代码：".$classcode."快来加入吧！” ——".$sendname."老师";
                }else{

                }
                $res = JceUser::sendSmsInvitation($final, $sms);
                $result['status'] = $res['result'] == 0 ? 1 : 0;
                $result['msg'] = $result['status'] == 0 ? '发送失败！' : '已成功发送推荐短信' . $res['sendcount']. '名！';
                $result['registers'] = $res['registers'];
                $result['threeInvited'] = $res['threeInvited'];
            }
        }
        
        $this->render('send', array('result'=>$result));
    }
    
    public function  actionSend_Backup(){
        $uid=Yii::app()->user->id;
        $user=Yii::app()->user->getInstance();
        $identity=Yii::app()->user->getCurrIdentity();
        $result=array('status'=>'1','msg'=>'已发出邀请，您可以继续给其它人发送邀请');
        if(!$identity->isTeacher){
            $result['status']=0;
            $result['msg']='功能只对老师用户开放主，请以老师方式登录';
            die(json_encode($result));
        }
        $mobile=isset($_POST['mobile'])?trim($_POST['mobile']):'';
        if(empty($mobile)){
            $result['status']=0;
            $result['msg']='手机号不能为空';

        }else{
            if(!preg_match('/^1\d{10}$/',$mobile)){
                $result['status']=0;
                $result['msg']='手机号格式有误';
            }else{
                //查看手机是否已存在
                $member=Member::getUniqueMember($mobile);
                if($member){
                    $result['status']=0;
                    $result['msg']='该好友已是班班用户，您无须给Ta发送邀请';
                    die(json_encode($result));
                }
                //计算当天是否达到10次
                $date=date("Y-m-d");
                $usersendnum=Yii::app()->cache->get($uid.'_'.$date.'_invite_num'); //怕用户不停的给一个人发短信，但只记录一条数据，所以缓存也要判断

                $todaysendnum=UserInvite::countTeacherSenderNum(array('sender'=>$uid,'creationtime'=>$date));
                //error_log("num:".$todaysendnum);
                if($todaysendnum>=10||($usersendnum &&$usersendnum>=10)){
                    $result['status']=0;
                    $result['msg']='今天您已累计发送10次邀请，无法再给更多人发送邀请';
                }else{
                    if(!$usersendnum){
                        $usersendnum=1;
                    }else{
                        $usersendnum++;
                    }
                    Yii::app()->cache->set($uid.'_'.$date.'_invite_num',$usersendnum,24*3600);
                    $userInvite=new UserInvite();
                    $userInvite->sender=$uid;
                    $userInvite->creationtime=date("Y-m-d H:i:s");
                    $userInvite->mobilephone=$mobile;
                    $hasinvite=UserInvite::getUserInvite(array('sender'=>$uid,'mobilephone'=>$mobile));
                    if(!$hasinvite){
                        $userInvite->save();//以前发送过，就不要再插数据了
                    }
                        //发送短信
                        $sms="您的好友".$user->name."老师（号码".$user->mobilephone."）：邀请您使用“". SITE_NAME."”平台，可便捷对班级发送通知及作业，联络家长。登录官网 ".
                            SITE_URL.' 注册建班就送话费、挣班费。下载手机APP客户端更方便使用。咨询电话4001013838。';
                        UCQuery::sendMobileMsg($mobile,$sms,Constant::SMS_OTHER);
                }
            }
        }
        die(json_encode($result));
       // $this->render("index");
    }

    public function actionTest(){

        /*
         *   $inner->uid->val = $cardinfo['uid'];
        $inner->name->val = $cardinfo['name'];
        $inner->category->val =$cardinfo['category'];
        $inner->money->val =$cardinfo['money'];
        $inner->endtime->val =$cardinfo['endtime'];
         */
        $a=JceClassFee::addClassFeeCard(array('uid'=>Yii::app()->user->id,'name'=>'普通卡','category'=>1,'money'=>200,'endtime'=>time()+36000));
        die($a);
        error_log("aaa");
        $arr=array();
        $areas=UCQuery::queryAll("select * from tb_area where `TYPE`=3 and deleted=0 ");
        foreach($areas as $k=>$v){

            $citys=array();
            $carr=array();
            if(!in_array("".$v['aid'],array("110000","120000","310000","810000","820000"))){
                $citys=UCQuery::queryAll("select aid,name from tb_area where  parentid=".$v['aid']." and deleted=0 ");
                $carr=array();
                foreach($citys as $city){
                    $carr[$city['aid']]=$city;
                }
            }
            $arr[$v['aid']]=array('name'=>$v['name'],'citys'=>$carr?$carr:array());


        }
        error_log(json_encode($arr,JSON_UNESCAPED_UNICODE));
        print var_export($arr,true);die;
        $today = Yii::app()->request->getParam('today','');
        if($today==''){
            $today=date("Y-m-d")."pv_activeuser";//当天活跃用户缓存键
        }else{
            $today=$today."pv_activeuser";
        }
    }

} 
<?php

class SiteController extends Controller
{

    public $defaultAction = 'login';
    /**
     * Declares class-based actions.
     */
    // public function actions()
    // {
    // 	return array(
    // 		// captcha action renders the CAPTCHA image displayed on the contact page
    // 		'captcha'=>array(
    // 			'class'=>'CCaptchaAction',
    // 			'backColor'=>0xFFFFFF,
    // 		),
    // 		// page action renders "static" pages stored under 'protected/views/site/pages'
    // 		// They can be accessed via: index.php?r=site/page&view=FileName
    // 		'page'=>array(
    // 			'class'=>'CViewAction',
    // 		),
    // 	);
    // }

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
                'actions' => array('login','linklogin','bindmobile', 'gettoken','setpwd', 'resetpwd', 'sendcode', 'getpwd', 'remote', 'findmobile', 'activeverify', 'activeuser', 'searchaccount', 'updateaccount','checkparentmobile', 'thirdinfo', 'error', 'banban', 'bbdynamic', 'contactus', 'about', 'invitedetail', 'changelogin', 'app'),
                'users' => array('*'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('index', 'account', 'password', 'logout', 'uploadfile', 'mobile', 'checkcode', 'getpwd', 'setpwd', 'resetpwd', 'teacher', 'guardian','switch', 'changemobile', 'goToOldPlantform','invitelist'),
                'users' => array('@'),
                //'expression'=>array($this,'loginAndNotDeleted'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    public function actionSwitch()
    {
        $goold = Yii::app()->request->getParam('goold', '');
        if(!$goold){
            $identity = Yii::app()->user->getCurrIdentity(); 
            if($identity->isTeacher){
                $this->redirect(Yii::app()->createUrl('notice/send'));
            }
            // else if($identity->isPatriarch || $identity->isFocus){
            //     $this->redirect(Yii::app()->createUrl('notice/receive'));
            // }
        }
        $returnurl = Yii::app()->request->getParam('return',Yii::app()->createUrl('notice/send'));
        $this->render('switch',array('returnurl'=>$returnurl));
    }

    public function actionTeacher()
    {
        Yii::app()->user->setIdentity(1);
        
        $user = Yii::app()->user->getInstance();
        if($user->isnewuser==1){//旧用户跳转到旧平台
            Yii::app()->user->goToOldPlantform();
        }

        $returnurl = Yii::app()->request->getParam('return',Yii::app()->createUrl('notice/send'));
        $this->redirect($returnurl);
    }

    public function actionGuardian()
    {
        Yii::app()->user->setIdentity(4);

        $user = Yii::app()->user->getInstance();
        if($user->isnewuser==1){//旧用户跳转到旧平台
            Yii::app()->user->goToOldPlantform();
        }

        $returnurl = Yii::app()->request->getParam('return',Yii::app()->createUrl('notice/receive'));
        if(strpos($returnurl, 'send')){
            $returnurl = Yii::app()->createUrl('notice/receive'); //防止首次双重身份用户选择家长身份时跳转到send
        }
        $this->redirect($returnurl);
    }
    
    //旧用户切换到旧平台
    public function actionGotooldplantform(){
        
        Yii::app()->session['gotoold'] = 1;
        
        $userinfo = Yii::app()->user->getInstance();
        if($userinfo->identity  == 5){
            Yii::app()->controller->redirect(Yii::app()->createUrl('site/switch', array('goold'=>1)));
        }else{
            Yii::app()->user->setIdentity($userinfo->identity);
            Yii::app()->user->goToOldPlantform();
        }
    }

    public function actionGettoken()
    {
        $request = Yii::app()->request;
        header("Content-type: application/json");
        
        if( $request->getParam('id') && $request->getParam('account') && $request->getParam('pwd') ){
            $data = Loginset::model()->getLoginToken( $request->getParam('id'), $request->getParam('account'), $request->getParam('pwd') );
            Yii::app()->session['tokenAuth'] = time();
            echo json_encode($data);
            Yii::app()->end();
        }
        else {
            echo '{"error":"错误参数!"}';
            Yii::app()->end();
        }
    }
   
    
    /**
     * 第三方帐号密码提交的登陆
     */
    protected function useUnionLogin()
    {
        $loginErrors = array();
        $request = Yii::app()->request;

        YiiMem::log( 'useUnionLogin:'.var_export( $_REQUEST ,true), 'info', 'application.constroller');
        if( $request->getParam('areaId') && $request->getParam('unionAccount') && $request->getParam('unionPwd') ){
            $unionAuth = Loginset::model()->sendLoginData( $request->getParam('areaId')
                                                    , $request->getParam('unionAccount'), $request->getParam('unionPwd') );
            
            YiiMem::log( 'useUnionLogin-sendLoginData-return:'.var_export( $unionAuth ,true), 'info', 'application.constroller');

            // 第三方验证是否成功
            if( $unionAuth['user_id'] > 0 ){
                Yii::app()->session['thirdinfoUserid'] = $unionAuth['user_id'];
                Yii::app()->session['thirdAreaid']      = $request->getParam('areaId');
                Yii::app()->session['thirdinfoAccount'] = $request->getParam('unionAccount');
                $this->redirect(Yii::app()->createUrl('site/thirdinfo'));
                Yii::app()->end();
            }
            else{
                $msg = Loginset::model()->getCurlErrorMsg( $unionAuth['result'] );
                $loginError = true == $msg?$msg:'第三方验证失败！';
                YiiMem::store(true);
                
                return $loginError;
            }
        }
        return '';
    }
    
    /**
     * 直接给予用户id一个合法身份
     * @param int $userid
     */
    protected function authUserIdentity( $userid, $jump = true )
    {
        // 远程信息入库，返回用户id
        if( $userid > 0 ){
            // 授权开始
            $user = JceHelper::getUserInfo($userid);
            
            // 登陆成功
            if ($user) {
                $identity = new RemoteUserIdentity($user);
                Yii::app()->user->login($identity);
                
                if( true == $jump ){

                    $currIdentity = Yii::app()->user->getCurrIdentity();
                    // mlog($currIdentity);
                    $userinfo = Yii::app()->user->getInstance();
                    if($currIdentity->isTeacher){
                        $this->redirect(Yii::app()->createUrl('notice/send'));
                    }else if($currIdentity->isPatriarch || $currIdentity->isFocus) {
                        //v4.0不禁止家长身份登录
                        $returnurl = Yii::app()->createUrl('site/switch');
                        $this->redirect($returnurl.'?return'.Yii::app()->user->getReturnUrl());
                    }else{
                        $returnurl = Yii::app()->createUrl('site/switch');
                        $this->redirect($returnurl.'?return'.Yii::app()->user->getReturnUrl());
                    }
                    Yii::app()->end();
                }
                else{
                    return true;
                }
            }
            else{
                $loginError = '用户登陆失败，请重新登陆！';
            }
        } else {
            $loginError = '该用户不存在,请验证后再登陆!';
        }
        
        YiiMem::store(true);
        Yii::app()->msg->postMsg('failed', $loginError);
        // 授权结束  
    }
    
    
    /**
     * 保存第三方登陆接收的数据
     * @param array $row
     * @param array $infos
     * @param object $user
     */
    protected function saveThirdinfoPost( $row, $infos, $user )
    {
        $laterJump = 0;     // 是否延时跳转，仅仅在已注册的流程上生效

        if ( true == Yii::app()->request->isPostRequest ) {
            $request = Yii::app()->request;
            $thirdPost = $request->getParam("third");
        
            if (!preg_match('/^((1)+\d{10})$/', $thirdPost['phone'])) {
                Yii::app()->msg->postMsg('failed', '手机号码不正确!');
                $this->redirect(Yii::app()->createUrl('site/thirdinfo?name='.$thirdPost['name'].'&phone='.$thirdPost['phone']));
                Yii::app()->end();
            }
        
            $cache = Yii::app()->cache;
            $cacheKey = "third-part-info_" . $thirdPost['phone'];
            $cacheValue = $cache->get($cacheKey);

            if( false == $cacheValue || $cacheValue !== $thirdPost['code']) {
                Yii::app()->msg->postMsg('failed', '验证码错误!');
                $this->redirect(Yii::app()->createUrl('site/thirdinfo?name='.$thirdPost['name'].'&phone='.$thirdPost['phone']));
                Yii::app()->end();
            }
        
            $name = true == trim( $thirdPost['name'] )? $thirdPost['name']:$infos['userinfo']['name'] ;
            $phone = true == trim( $thirdPost['phone'] )? $thirdPost['phone']:$infos['userinfo']['mobilephone'];
            
            $invitePhone = true == trim( $thirdPost['invite_phone'] )? trim($thirdPost['invite_phone']):false;	// 邀请人手机号
        
            $criteria = new CDbCriteria() ;
            $criteria ->condition = 'mobilephone = :mobilephone AND deleted = 0';  // 增加目前使用中的帐号判断
            $criteria ->params = array (':mobilephone' => $phone) ;
            $notRepeat = Member::model()->find( $criteria );
            $fistTime = false;

            if( false == $user && false == $notRepeat ){
                $userid = MemberService::setThreeMemberInfo( $row['areaid']
                    , Yii::app()->session['thirdinfoUserid'], $name, $phone, $infos['userinfo']['sex'] );
        
                YiiMem::log( 'actionThirdinfo-setThreeMemberInfo-return:userid='.$userid, 'info', 'application.constroller');
            }else{
                $user = true == $user ? $user:$notRepeat;
                $user->name = $name;
                $user->mobilephone = $phone;
                
                if( false == in_array( $user->identity, array( Constant::TEACHER_IDENTITY, Constant::TEACHER_FAMILY_IDENTITY ) ) ) {
                    $user->identity = Constant::TEACHER_IDENTITY; // 老师身份
                }
        
                if( $user->threeareaid != Yii::app()->session['thirdAreaid']
                    && $user->threeuserid != Yii::app()->session['thirdinfoUserid']){
                    $fistTime = true;
                }
                else {
                    $fistTime = false;
                }
        
                $user->threeareaid = Yii::app()->session['thirdAreaid'];
                $user->threeuserid = Yii::app()->session['thirdinfoUserid'];
                $userid = $user->userid && $user->update() ? $user->userid:false;
        
                YiiMem::log( 'actionThirdinfo-(user->update)-return:userid='.$userid, 'info', 'application.constroller');
            }
            
            if( true == $userid ) {
                
                // 邀请人手机号记录
                if( true == $invitePhone ){
                    $invite = new UserRegisterInvited();
                    $invite->mobilephone = $invitePhone;
                    $invite->recevier = $userid;
                    $invite->save();
                }
                
                unset(Yii::app()->session['thirdinfoUserid']);
                Yii::app()->session['thirdinfoSchoolId'] = $infos['userinfo']['school_id'];
                Yii::app()->session['thirdinfoSchoolName'] = $infos['userinfo']['school_name'];
                $this->authUserIdentity( $userid, false == $fistTime );
        
                Yii::app()->msg->postMsg('success', '你的手机号码已经注册过，3秒后直接进入');
                $laterJump = 3; // 设置3秒后js自动跳转
            } else {
                Yii::app()->msg->postMsg('failed', '保存失败！');
                YiiMem::store(true);
                $this->redirect(Yii::app()->createUrl('site/thirdinfo'));
        
                Yii::app()->end();
            }
        }
        
        return $laterJump;
    }

    public function actionThirdinfo()
    {
        $request = Yii::app()->request;
        
        if ( false == Yii::app()->session['thirdinfoUserid'] && false == Yii::app()->session['thirdAreaid'] ){
            Yii::app()->msg->postMsg('failed', '此次登陆不成功!');
            $this->redirect( Yii::app()->createUrl('site/login'));
            Yii::app()->end();
        }
        $nickname = Yii::app()->session['thirdinfoAccount']?Yii::app()->session['thirdinfoAccount']:'';
        $userInfo = JceHelper::thirdPartyUserLogin(Yii::app()->session['thirdinfoUserid'], Yii::app()->session['thirdAreaid'],'',$nickname);
        // conlog($userInfo);
        // var_dump($userInfo->uid);
        $this->authUserIdentity($userInfo->uid);
    }

    /**
     * 校信老师登陆页面
     * panrj 2014-08-09
     */
    public function actionLogin()
    {
        $wxLoginUrl = WX_GET_CODE_URL.'?appid='.WX_LOGIN_APPID.'&redirect_uri='.urlencode(WX_CALLBACK_URL).'&response_type=code&scope=snsapi_login&state=STATE#wechat_redirect';
        if(!Yii::app()->user->isGuest){
            $currIdentity = Yii::app()->user->getCurrIdentity();
            $userinfo = Yii::app()->user->getInstance();
            if($currIdentity->isTeacher){
                $this->redirect(Yii::app()->createUrl('notice/send'));
            }else if($currIdentity->isPatriarch || $currIdentity->isFocus) {
                //v4.0禁止家长身份登录
               // Yii::app()->user->logout();
               // $this->redirect('login');
            }else{
                $returnurl = Yii::app()->createUrl('site/switch');
                $this->redirect($returnurl.'?return'.Yii::app()->user->getReturnUrl());
            }
        }
        $model = new ULoginForm;
        $userinfo = '';
        $notTeacherError = '';
        if (isset($_POST['ULoginForm'])) {
            $model->attributes = $_POST['ULoginForm'];
            // validate user input and redirect to the previous page if valid
            if ($model->validate() && $model->login()) {
                $currIdentity = Yii::app()->user->getCurrIdentity();
                //D($currIdentity);
                if($currIdentity->isTeacher){
                    $this->redirect(Yii::app()->createUrl('notice/send'));
                }else if($currIdentity->isPatriarch || $currIdentity->isFocus) {
                    //$this->redirect(Yii::app()->createUrl('notice/receive'));
                    //v4.0禁止家长身份登录
                   // Yii::app()->user->logout();
                   // $notTeacherError = '非老师用户请下载手机客户端登录';
                   // D('aaa');
                    $this->redirect(Yii::app()->createUrl('site/switch?goold=1'));
                    exit();
                }else{
                    $this->redirect(Yii::app()->createUrl('site/switch'));
                }
            }
        }
        
        $unionLoginError = $this->useUnionLogin(); // 第三方登陆检测并执行
        
        $loginSets = Loginset::model()->getUnionLogins();
        
        // display the login form
        $this->renderPartial('login', array('model' => $model, 'unionLoginError'=>$unionLoginError, 'notTeacherError'=>$notTeacherError, 'loginSets'=>$loginSets,'wxLoginUrl'=>$wxLoginUrl));
    }

    /**
     * 客服后台登录接口
     * panrj 2014-08-23
     */
    public function actionRemote()
    {
        unset(Yii::app()->session['gotoold']);
        $userid = Yii::app()->request->getParam('userid');
        $time = Yii::app()->request->getParam('time');
        $pass = Yii::app()->request->getParam('pass');
        $url = Yii::app()->request->getParam('url','');
        $role = Yii::app()->request->getParam('identity');        
        $pre_site = Yii::app()->request->getParam('plant');
        if ($pre_site == 'backend') {
            $time = date('Y-m-d H:i:s', time());
            $pass = md5(md5($userid . $time . LOGIN_BANBAN_KEY));
        }
        $now = time();
        $past = strtotime($time);
        $t = $now - $past;
        
        if ($t < 1800) {
            $hash = md5(md5($userid . $time . LOGIN_BANBAN_KEY));
            if ($hash == $pass) {
                $user=JceHelper::getUserInfo($userid);
                if ($user) {
                    $identity = new RemoteUserIdentity($user);
                    Yii::app()->user->login($identity);

                    $currIdentity = Yii::app()->user->getCurrIdentity();
                    // mlog($currIdentity);
                    $userinfo = Yii::app()->user->getInstance();
                    if($currIdentity->isTeacher){
                        $this->redirect(Yii::app()->createUrl('notice/send'));
                    }else if($currIdentity->isPatriarch || $currIdentity->isFocus) {
                        //v4.0不禁止家长身份登录
                        $returnurl = Yii::app()->createUrl('site/switch');
                        $this->redirect($returnurl.'?return'.Yii::app()->user->getReturnUrl());
                    }else{
                        $returnurl = Yii::app()->createUrl('site/switch');
                        $this->redirect($returnurl.'?return'.Yii::app()->user->getReturnUrl());
                    }
                    Yii::app()->end();  
                    
                } else {
                    echo '<html><head><meta charset="UTF-8"></head>该用户不存在,请验证后再登陆</html>';
                    exit;
                }
            }
        } else {
            echo '<html><head><meta charset="UTF-8"></head>请求数据已过期,请重新登陆</html>';
            exit;
        }
    }
    
    //创建班级-切换身份登录
    public function actionChangelogin()
    {
        $ty = Yii::app()->request->getParam('ty');
        $userid = Yii::app()->user->id;
        
        $currIndentity = Yii::app()->user->getIdentity();
        
        if($ty == 'create'){
            Yii::app()->user->setIdentity(Constant::TEACHER_IDENTITY);
            $this->redirect(Yii::app()->createUrl('class/create', array('acty'=>'chg')));
        }else if($ty == 'tadd'){
            Yii::app()->user->setIdentity(Constant::TEACHER_IDENTITY);
            $this->redirect(Yii::app()->createUrl('class/chooseclass'));
        }else if($ty == 'gadd'){
            Yii::app()->user->setIdentity(Constant::FAMILY_IDENTITY);
            $this->redirect(Yii::app()->createUrl('class/chooseclass'));
        }
        
    }


    /**
     * 账号设置-基本信息
     * panrj 2014-08-09
     */
    public function actionAccount()
    {
        $myuser=JceUser::getPersonUserInfo(Yii::app()->user->id);
        $model =$myuser['user'];
        $banban=$myuser['banban'];//班班号
        $vThirdAccounts=$myuser['vThirdAccounts'];//第三方平台绑定情况
        $qq=null;
        $weixin=null;
        if(is_array($vThirdAccounts)){
            foreach($vThirdAccounts as $vcount){
                if($vcount->flag==1){
                    $qq=$vcount;
                }elseif($vcount->flag==2){
                    $weixin=$vcount;
                }
            }
        }

        if (isset($_POST['Account'])) {
            $info = $_POST['Account'];
            $model->name = isset($info['name'])&&!empty($info['name'])  ? $info['name'] : $model->name;
            $model->sex = isset($info['sex']) ? $info['sex'] : $model->sex;
            $model->address = isset($info['aid'])&&!empty($info['aid']) ? $info['aid'] : (isset($info['pid'])&&!empty($info['pid']) ? $info['pid']:$model->addressId);
            $model->icon = isset($info['icon']) ? $info['icon'] : $model->icon;
            $type=isset($info['type'])?$info['type']:14;
            $res=JceUser::setPersonInfo($model->uid,$model->icon,$model->sex,$model->name,$model->address,$type);
            if($res->iResult->val==0){
                Yii::app()->msg->postMsg('success', '修改成功');
                $this->redirect('account');
            }else{
                Yii::app()->msg->postMsg('error', '修改失败');
                $this->redirect('account');
            }
        }
        $icon=$model->icon;
        if(empty($icon)){
            $icon=Yii::app()->request->baseUrl . '/image/banban/mobile/ico_user.png';
        }else{
            $icon=preg_match('/^http/',$icon)?$icon:(STORAGE_QINNIU_XIAOXIN_TX.'/'.$icon);
        }
        $province_list = array();
        $city_list =array();
        $areas=array();
        $provinceId=!empty($model->addressId)?substr($model->addressId,0,2)."0000":'0';
        if (empty($province_list)) {
            $areas=BaseArea::getProvinceCity();
            $province_list=array();
            foreach($areas as $k=>$v){
                $province_list[]=array('aid'=>$k,'name'=>$v['name']);
            }
        }
        if(!empty($provinceId)){
            if(empty($areas)){
                $areas=BaseArea::getProvinceCity();
            }
            $city_list = isset($areas[$provinceId])?$areas[$provinceId]:array();
            $city_list=isset($city_list['citys'])?$city_list['citys']:array();
        }else{
            $city_list = array();
        }


        $cityname="未设置";
        if(!empty($model->addressId)){
            $right=substr($model->addressId,2,4);
            $left=substr($model->addressId,0,2).'0000';
            $provinceinfo=isset($areas[$left])?$areas[$left]:array();
            $cityname=isset($provinceinfo['name'])?$provinceinfo['name']:'';

            if($right!='0000'||substr($model->addressId,0,2)=='71'){
                //710001这是台湾的，数据弄错了，特殊处理一下,本来大陆的是431100这才是城市id,台湾临时弄错了，成了710001,理论应该是710100
                if(!substr($model->addressId,0,2)=='71'){
                    $cityid=substr($model->addressId,0,4).'00';
                }else{
                    $cityid=$model->addressId;
                }
                $cityinfo=isset($provinceinfo['citys'][$cityid])?$provinceinfo['citys'][$cityid]:'';
                $cityname=$cityname.'&nbsp;&nbsp;'.(isset($cityinfo['name'])?$cityinfo['name']:'');
            }

        }
        $this->render('account', array('user' => $model,'qq'=>$qq,'weixin'=>$weixin,'icon'=>$icon,'banban'=>$banban,'province_list'=>$province_list,'city_list'=>$city_list,'provinceId'=>$provinceId,'cityname'=>$cityname));
    }
    
    /**
     * 账号设置-邀请人列表
     * panrj 2014-08-09
     */
    public function actionInvitelist()
    {
        $userid = Yii::app()->user->id;
        $inviteMe = UserRegisterInvited::getInviteUser($userid);
        // $userInvMe = Member::model()->findByPk();
        $myInvite = UserRegisterInvited::getInviteListAll(array('sender'=>$userid));
    	$this->render('invitelist',
            array('inviteMe'=>$inviteMe,'myInvite'=>$myInvite)
        );
    }

    /**
     * 账号设置-修改密码
     * panrj 2014-08-09
     */
    public function actionPassword()
    {
        if (Yii::app()->user->isGuest) {
            Yii::app()->user->logout();
            $this->redirect('login');
        }
        $user = Yii::app()->user->getInstance();
        if (!$user) {
            Yii::app()->user->logout();
            $this->redirect(Yii::app()->login);
        }

        $model = new UChangePasswordForm;
        // collect user input data
        if (isset($_POST['UChangePasswordForm'])) {
            $res=JceUser::setPersonPassword($user->uid,$_POST['UChangePasswordForm']['currentPassword'],$_POST['UChangePasswordForm']['newPassword']);
            if($res->iResult->val==0){
                Yii::app()->msg->postMsg('success', '修改成功');
                $this->redirect(Yii::app()->createUrl('site/account'));
                exit();
            }else{
                Yii::app()->msg->postMsg('success', '操作失败');
                $this->redirect(Yii::app()->createUrl('site/account'));
                exit();
            }
        }
        $this->render('password', array('model' => $model));
    }


    /**
     * 账号设置-绑定手机-忘记密码-发送验证码
     * panrj 2014-08-14
     * $ty 验证码类型：旧密码，新密码，重置密码
     */
    public function actionSendcode()
    {
        $mobile = Yii::app()->request->getParam('mobile');
        $ty = Yii::app()->request->getParam('ty');
        //$role = Yii::app()->request->getParam('role');
        $userid = Yii::app()->user->id;
        if (Yii::app()->user->isGuest && $mobile) {
            // $sql = "CALL php_xiaoxin_GetUserByAttributes('" . $mobile . "','mobilephone','" . $role . "')";
            // $user = UCQuery::queryRow($sql);
            $user = Member::getUniqueMember($mobile);
            if ($user === null) {
                echo '该手机号码尚未绑定用户！';
                exit;
            }
            $userid = $user->userid;
        }
        if ($mobile && $ty) {
            if ($ty == 'old') {
                $is_usermobile = UCQuery::checkUserMobile($userid, $mobile);
                if (!$is_usermobile) {
                    echo '当前手机号码有误！';
                    exit;
                }
            } else {
                $count = Member::countByidentityMobile($mobile, $userid);
                if($count > 0){
                    echo '该号码已被绑定！';
                    exit;
                }
            }
            $cache = Yii::app()->cache;
            // $key = "ucmobile_".$ty.'_'.$mobile;
            $key = "ucmobile_" . $ty . '_' . $userid;
            //             $cache->delete($key);
            $timekey = $key . '_' . date('Ymd');
            //             $cache->delete($timekey);exit;
            $time = $cache->get($timekey);
            if ($time && $time >= 3) {
                echo '每天最多能发三次';
                exit;
            }
    
            $code = MainHelper::generate_code(6);
            // $code = '123456';
            $msg = "尊敬的用户，您本次获得的验证码是：" . $code."，请勿告诉他人。";
            UCQuery::sendMobileMsg($mobile, $msg,Constant::SMS_VERIFICATIONCODE);
    
            // $sql = "CALL fn_AddSmsMessage('".$mobile."','10001','101','".$code."','【蜻蜓校信】',0,1)";
            // $connection = Yii::app()->db_msg;
            // $connection->createCommand($sql)->execute();
    
            $time = $time ? $time + 1 : 1;
            $cache->set($timekey, $time, 172800);
            $cache->set($key, $code, 1800);
            echo 'success';
        } else {
            echo '发送失败';
        }
    }
    

    /**
     * 账号设置-绑定手机-检验验证码
     * panrj 2014-08-14
     * $ty 验证码类型：旧密码，新密码，重置密码
     */
    public function actionCheckcode()
    {
        $mobile = Yii::app()->request->getParam('mobile');
        $code = Yii::app()->request->getParam('code');
        $ty = Yii::app()->request->getParam('ty');
        $userid = Yii::app()->user->id;
        // $key = "ucmobile_".$ty.'_'.$mobile;
        $key = "ucmobile_" . $ty . '_' . $userid;
        $cache = Yii::app()->cache;
        $cachecode = $cache->get($key);
        $msg = $cachecode ? '验证码有误，请输入正确验证码' : '验证码已过期，请重新获取验证码';
        if ($mobile && $code && $ty) {
            if ($cachecode == $code) {
                $msg = 'success';
            }
        }
        echo $msg;
    }
    
    /**
     * 新班班-账号设置-绑定手机更换（ajax）
     * panrj 2014-08-09
     */
    public function actionChangemobile()
    {        
        $mobile = Yii::app()->request->getParam('mobile');
        $mobile = Yii::app()->request->getParam('mobile');
        $oldmobile = Yii::app()->request->getParam('oldmobile');
        $code = Yii::app()->request->getParam('code');
        $userid = Yii::app()->user->id;
        $user = Yii::app()->user->getInstance();
        $identity = $user->identity;
        $msg = '';
        $response = JceUser::setMobilePhone($userid,$mobile,$code,"",0,$oldmobile);//Member::countByidentityMobile($mobile, $userid);
        if($response&&$response->iResult->val == 0){
            Yii::app()->msg->postMsg('success', '操作成功');
            $msg = 'success';
        }else if($response->iResult->val == 3211){
            $msg = '该号码已被绑定';
        }else if($response->iResult->val == 27){
            $msg="验证码已过期";
        }else if($response->iResult->val == 28){
            $msg="验证码不匹配";
        }else{
            $msg="未知错误";
        }
        echo $msg;
    }
    
    
    
    /**
     * 忘记密码-验证验证码同时修改密码
     * zengp 2015-01-23
     * $ty 验证码类型：旧密码，新密码，重置密码
     */
    public function actionResetpwd(){
        
        $mobile = Yii::app()->request->getParam('mobile');
        $code = Yii::app()->request->getParam('code');
        $pwd = Yii::app()->request->getParam('pwd');
        
        $msg = 'error';
        if ($mobile && $code && $pwd) {
            
            $result = JceHelper::userResetPwd($mobile, $pwd, $code);
            if($result->iResult->val == 0)
                $msg = 'success';
            else if($result->iResult->val == 28)
                $msg = '验证码不匹配';
            
        }
        echo $msg;
    }

    public function actionUrl()
    {
        $this->render('url');
    }

    /**
     * 忘记密码
     */
    public function actionGetpwd()
    {   
        $this->renderPartial('getpwd');
    }


    /**
     * Logs out the current user and redirect to homepage.
     */
    public function actionLogout()
    {
        Yii::app()->user->logout();
        $this->redirect('/login/index');
    }

        
    /**
     * 第三方直接链接过来，提交的数据是否合法，然后重定向到班班的登陆入口接口
     */
    public function actionLinklogin()
    {
        $request = Yii::app()->request;
        
        YiiMem::log( 'actionLinklogin:'.var_export( $_REQUEST ,true), 'info', 'application.constroller');
        
        $result = Loginset::model()->checkThirdPartLogin($request->getParam('area_id'), $request->getParam('user_id')
            , $request->getParam('time'), $request->getParam('token') );
        
        if( true == $result ){
            $user   = MemberService::getThreeMemberInfo( (int)$request->getParam('area_id'), (int)$request->getParam('user_id') );
            
            $userid = is_object($user) && isset( $user['userid'] ) ? $user['userid'] : false;

            if( false == $userid || false == in_array( $userid, array( Constant::TEACHER_IDENTITY, Constant::TEACHER_FAMILY_IDENTITY )) ){                
                Yii::app()->session['thirdinfoUserid'] = (int)$request->getParam('user_id');
                Yii::app()->session['thirdAreaid']     = (int)$request->getParam('area_id');
                
                $this->redirect(Yii::app()->createUrl('site/thirdinfo'));
                Yii::app()->end();
            }
            
            $this->redirect( Yii::app()->createUrl('site/remote?identity=1&userid='.$user['userid'].'&plant=backend&'.$result ));
            Yii::app()->end();
        }
        
        YiiMem::log( 'actionLinklogin:json=result -1, third part is md5 false.', 'info', 'application.constroller');
        YiiMem::store(true);
        header("Content-type: application/json");
        echo '{"result":"-1"}';
        Yii::app()->end();
    }

    
    /**
     * This is the action to handle external exceptions.
     */
    public function actionError()
    {
        $error = Yii::app()->errorHandler->error;
        if($error)
        {
            if(Yii::app()->request->isAjaxRequest)
                echo $error['message'];
            else
                $this->renderPartial('error', array('error'=>$error));
        }
    }
    
    /**
     * 班班介绍
     */
    public function actionBanban()
    {
        $this->renderPartial('banban');
    }
    
    /**
     * 班班动态
     */
    public function actionBbdynamic()
    {
        $this->renderPartial('bbdynamic');
    }
    
    /**
     * 关于
     */
    public function actionAbout()
    {
        $this->renderPartial('about');
    }
    
    /**
     * 联系我们
     */
    public function actionContactus()
    {
        $this->renderPartial('contactus');
    }
    
    /**
     * 邀请详情
     */
    public function actionInvitedetail()
    {
        $this->renderPartial('invitedetail');
    }

    public function actionApp()
    {
        $this->renderPartial('app');
    }
    /*
     * 绑定手机号码
     * 第三方登陆后，还没有手机号码，绑定时填写手机号码
     */
    public function actionBindmobile(){
        if(isset($_POST['bindmobile'])){
            $bindmobile=$_POST['bindmobile'];
            $bindcode=$_POST['bindcode'];
            $bindpassword=$_POST['bindpassword'];
            $bindconfirmpassword=$_POST['bindconfirmpassword'];
            $ajax=isset($_POST['ajax'])?$_POST['ajax']:0; //如果是ajax请求就返回json
            $switch=isset($_POST['switch'])?$_POST['switch']:0; //＝1表示从switch页面进来,＝2 （班级首页进来）如果是从班级首页进来，成功后返回班级首页
            $userid = Yii::app()->user->id;
            if($userid){
                $result = JceUser::setMobilePhone($userid,$bindmobile,$bindcode,$bindpassword);
                if($result->iResult->val == 0){
                    Yii::app()->msg->postMsg('success', '绑定成功');
                    if($ajax){
                        die(json_encode(array('status'=>'1')));
                    }
                    if($switch==1){
                        $this->redirect(Yii::app()->createUrl('site/switch?goold=1'));
                    }
                    if($switch==2){
                        $this->redirect(Yii::app()->createUrl('class/index'));
                    }
                    $this->redirect(Yii::app()->createUrl('site/account'));
                }
                else if($result->iResult->val == 28){
                    $msg = '验证码不匹配';
                    if($ajax){
                        die(json_encode(array('status'=>'0','msg'=>$msg)));
                    }
                    Yii::app()->msg->postMsg('error', '绑定失败!'.$msg);
                    if($switch==1){
                        $this->redirect(Yii::app()->createUrl('site/switch?goold=1'));
                    }
                    if($switch==2){
                        $this->redirect(Yii::app()->createUrl('class/index'));
                    }
                    $this->redirect(Yii::app()->createUrl('site/account'));
                }else{
                    if($ajax){
                        die(json_encode(array('status'=>'0','msg'=>'绑定失败')));
                    }
                    Yii::app()->msg->postMsg('error', '绑定失败!');
                    if($switch==1){
                        $this->redirect(Yii::app()->createUrl('site/switch?goold=1'));
                    }
                    if($switch==2){
                        $this->redirect(Yii::app()->createUrl('class/index'));
                    }
                    $this->redirect(Yii::app()->createUrl('site/account'));
                }
            }


        }
    }
    
    
}
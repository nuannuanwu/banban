<?php
class LoginController extends Controller
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
                'actions' => array('index','joinus','educationconcept','worknotice','companynews','cooperation','linklogin','bindmobile', 'gettoken','setpwd', 'resetpwd', 'sendcode', 'getpwd', 'remote', 'findmobile', 'activeverify', 'activeuser', 'searchaccount', 'updateaccount','checkparentmobile', 'thirdinfo', 'error', 'banban', 'bbdynamic', 'contactus', 'about', 'invitedetail', 'changelogin', 'app'),
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

    /*
     * 加入我们
     */
    public function actionJoinus(){
        $userid=Yii::app()->user->id;
        $userinfo=null;
        if($userid){
            $userinfo=Yii::app()->user->getInstance();
        }
        $this->renderPartial('joinus',array('userid'=>$userid,'userinfo'=>$userinfo,));
    }
    /*
     * 教育观
     */
    public function actionEducationconcept(){
        $userid=Yii::app()->user->id;
        $userinfo=null;
        if($userid){
            $userinfo=Yii::app()->user->getInstance();
        }
        $this->renderPartial('educationconcept',array('userid'=>$userid,'userinfo'=>$userinfo,));
    }


    /*
     * 合作
     */
    public function actionCooperation(){
        $userid=Yii::app()->user->id;
        $userinfo=null;
        if($userid){
            $userinfo=Yii::app()->user->getInstance();
        }
        $this->renderPartial('cooperation',array('userid'=>$userid,'userinfo'=>$userinfo,));
    }

    /*
     * 　　公司动态
     */
    public function actionCompanynews(){
        $userid=Yii::app()->user->id;
        $userinfo=null;
        if($userid){
            $userinfo=Yii::app()->user->getInstance();
        }
        $this->renderPartial('companynews',array('userid'=>$userid,'userinfo'=>$userinfo,));
    }


    public function actionIndex(){
        $userid=Yii::app()->user->id;
        $userinfo=null;
        if($userid){
            $userinfo=Yii::app()->user->getInstance();
        }
        $model = new ULoginForm;
        $notTeacherError = '';
        if (isset($_POST['ULoginForm'])) {
            $model->attributes = $_POST['ULoginForm'];
            // validate user input and redirect to the previous page if valid
            if ($model->validate() && $model->login()) {
                $currIdentity = Yii::app()->user->getCurrIdentity();
               // D($currIdentity);
                if($currIdentity->isTeacher){
                    $this->redirect(Yii::app()->createUrl('login/index'));
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
        $loginSets = Loginset::model()->getUnionLogins();
        $unionLoginError = $this->useUnionLogin(); // 第三方登陆检测并执行
        $wxLoginUrl = WX_GET_CODE_URL.'?appid='.WX_LOGIN_APPID.'&redirect_uri='.urlencode(WX_CALLBACK_URL).'&response_type=code&scope=snsapi_login&state=STATE#wechat_redirect';
        $currIdentity=null;
        if($userid){
            $currIdentity = Yii::app()->user->getCurrIdentity();
        }
        $noticeurl=Yii::app()->createUrl('notice/send');
        if($currIdentity){
            if($currIdentity&&$currIdentity->isTeacher){
            }else if($currIdentity->isPatriarch || $currIdentity->isFocus) {
                $noticeurl=Yii::app()->createUrl('site/switch?goold=1');
            }
        }else{
            $noticeurl=Yii::app()->createUrl('site/switch');
        }
        $this->renderPartial('index',array('userid'=>$userid,'noticeurl'=>$noticeurl,'userinfo'=>$userinfo,'model' => $model, 'unionLoginError'=>$unionLoginError, 'loginSets'=>$loginSets,'wxLoginUrl'=>$wxLoginUrl));
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


} 
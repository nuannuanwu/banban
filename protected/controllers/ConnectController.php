<?php
require_once(dirname(__FILE__).'/../extensions/qqconnect/qqConnectAPI.php');

class ConnectController extends Controller
{
    public function actionTest()
    {
        mlog(Yii::app()->user->getThreeUserInfo());
    }

    public function actionQq()
    {
        $qc = new QC();
        $qc->qq_login();
    }

	public function actionQqcbk()
	{
        $qc = new QC();  
        $acs = $qc->qq_callback();//callback主要是验证code和state,返回token信息，并写入到文件中存储，方便get_openid从文件中度  
        $oid = $qc->get_openid();//根据callback获取到的token信息得到openid,所以callback必须在openid前调用  
        
        $qc = new QC($acs,$oid);  
        $uinfo = $qc->get_user_info();  

        // $oid = 'EDA0A810496B8D623D5EFE41B4884769';
        $nickname = isset($uinfo['nickname'])?$uinfo['nickname']:'';

        $info = array(
            'oid'=>$oid,
            'type'=>1,
            'account'=>'',
            'nickname'=>$nickname
        );
        $info = serialize($info);
        $this->redirect(Yii::app()->createUrl('connect/cbklogin').'?info='.$info);


        // $this->cbkLogin($oid, 1,$trdAccount='',$nickname);

        // $userInfo = JceHelper::thirdPartyUserLogin($oid, 1,$trdAccount='',$nickname);
        // $threeUserInfo = array('type'=>1,'nickname'=>$nickname);
        // $this->authUserIdentity($userInfo->uid,$threeUserInfo);
	}

    public function actionWxcbk()
    {
        $code = Yii::app()->request->getParam('code', '');
        $tokenStr = $this->sendWxRequest(WX_GET_TOKEN_URL,
            array(
                'appid'=>WX_LOGIN_APPID,
                'secret'=>WX_LOGIN_APPSECRET,
                'code'=>$code,
                'grant_type'=>'authorization_code',
            )
        );

        $accessInfo = json_decode($tokenStr);

        $checkToken = $this->sendWxRequest(WX_CHECK_TOKEN_URL,
            array(
                'access_token'=>$accessInfo->access_token,
                'openid'=>$accessInfo->openid
            )
        );
        $checkResult = json_decode($checkToken);
        if($checkResult->errcode==0){
            $userInfo = $this->sendWxRequest(WX_GET_USERINFO_URL,
                array(
                    'access_token'=>$accessInfo->access_token,
                    'openid'=>$accessInfo->openid
                )
            );
            $userInfo = json_decode($userInfo);
            $info = array(
                'oid'=>$userInfo->unionid,
                'type'=>2,
                'account'=>'',
                'nickname'=>$userInfo->nickname
            );
            $info = serialize($info);
            $this->redirect(Yii::app()->createUrl('connect/cbklogin').'?info='.$info);
            // $this->cbkLogin($userInfo->unionid, 2,$trdAccount='',$userInfo->nickname);
            $info = array(
                'oid'=>$userInfo->unionid,
                'type'=>2,
                'account'=>'',
                'nickname'=>$userInfo->nickname
            );
            $info = serialize($info);
            $this->redirect(Yii::app()->createUrl('connect/cbklogin').'?info='.$info);
            // $this->cbkLogin($userInfo->unionid, 2,$trdAccount='',$userInfo->nickname);

            // $user = JceHelper::thirdPartyUserLogin($userInfo->unionid, 2,$trdAccount='',$userInfo->nickname);
            // $threeUserInfo = array('type'=>2,'nickname'=>$userInfo->nickname);
            // $this->authUserIdentity($user->uid,$threeUserInfo);
        }else{
            Yii::app()->msg->postMsg('error', '登录失败');
            $this->redirect(Yii::app()->createUrl('site/login'));
        }
    }

    public function actionCbklogin()
    {
        $info = Yii::app()->request->getParam('info', '');
        $info = unserialize($info);
        $user = JceHelper::thirdPartyUserLogin($info['oid'], $info['type'],$info['account'],$info['nickname']);
        $threeUserInfo = array('type'=>$info['type'],'nickname'=>$info['nickname']);
        $this->authUserIdentity($user->uid,$threeUserInfo);
    }

    /**
     * 直接给予用户id一个合法身份
     * @param int $userid
     */
    protected function authUserIdentity( $userid, $info=array(), $jump = true )
    {
        // 远程信息入库，返回用户id
        if( $userid > 0 ){
            // 授权开始
            $user = JceHelper::getUserInfo($userid);    // 验证 正在使用中已激活的帐号
            // 登陆成功
            if ($user) {
                $identity = new RemoteUserIdentity($user);
                Yii::app()->user->login($identity);
                Yii::app()->user->setThreeUserInfo($info);

                if( true == $jump ){
                     $currIdentity = Yii::app()->user->getCurrIdentity();
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
    }

    public function sendWxRequest($url,$parms=array())
    {
        $curl = new Curl();
        $curl->success(function($instance) {});

        $curl->error(function($instance) {

            echo 'error------------------------------------';
            var_dump('error url:' . $instance->url . "\n");
            var_dump('error code:' . $instance->error_code . "\n");
            var_dump('error message:' . $instance->error_message . "\n");

            Yii::log("\n".'error url:' . $instance->url . "\n".'error code:' . $instance->error_code . "\n".'error message:' . $instance->error_message . "\n",CLogger::LEVEL_ERROR,'Curl.WXLOGIN');
            return '';
        });
        $curl->complete(function($instance) {});
        $result = $curl->get($url,$parms);
        return $result;
    }
}
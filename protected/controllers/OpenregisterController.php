<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 15-1-23
 * Time: 下午1:56
 */

class OpenregisterController extends Controller
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



//开放注册-验证手机
    public function actionIndex()
    {   
        $data = Yii::app()->request->getParam('Openregister');
        $phone = isset($data['phone'])?$data['phone']:'';
        $sendcode = isset($data['code'])?$data['code']:'';
        $invitephone = isset($data['invitephone'])?$data['invitephone']:'';
        $name = isset($data['name'])?$data['name']:'';
        $password = isset($data['password'])?$data['password']:'';
        $codeerror = isset($data['codeerror'])?$data['codeerror']:'';

        // $phone = Yii::app()->request->getParam('Openregister[phone]');
        // $sendcode = Yii::app()->request->getParam('Openregister[code]');
        // $invitephone = Yii::app()->request->getParam('Openregister[invitephone]', '');
        // $name = Yii::app()->request->getParam('Openregister[name]');
        // $password = Yii::app()->request->getParam('Openregister[password]');
        // $codeerror = Yii::app()->request->getParam('Openregister[codeerror]','');
        
        if ($phone && $sendcode && $name && $password) {
            
            $res = JceHelper::userRegister($phone, $sendcode, $password, $name, $invitephone);
            if(is_string($res)){
                $msg=explode(":",$res);
                $this->renderPartial('index', array('data'=>$data, 'errorInfo'=>'error:' . isset($msg[1])?$msg[1]:'服务器错误，请重试'));
                /*
                if($res == SendCodeStatus::RES_AUTHCODE_MISMATCH){
                    $this->renderPartial('index', array('data'=>$data, 'errorInfo'=>'验证码不匹配'));
                }else if($res == SendCodeStatus::RES_AUTHCODE_OUT_OF_DATE){
                    $this->renderPartial('index', array('data'=>$data, 'errorInfo'=>'验证码已过期'));
                }else if($res == UserRegisterStatus::RES_REGISTER_USER_FAIL){
                    $this->renderPartial('index', array('data'=>$data, 'errorInfo'=>'添加新用户失败'));
                }else {
                    $this->renderPartial('index', array('data'=>$data, 'errorInfo'=>'error:' . $res));
                }
                */
            }else{
                $this->redirect(array('openregsuccess', 'phone' => $phone, 'userid' => $res->uid->val, 'identity'=>$res->identity->val, 'isnewuser'=>$res->isnewuser->val));
            }            
            
        } else {
            $this->renderPartial('index', array('errorInfo'=>$codeerror));
        }
    }


    //开放注册-创建用户，学校
    public function actionOpenreginfo()
    {
        $cache = Yii::app()->cache;
        
        $phone = Yii::app()->request->getParam('phone');
        
        $key = "openregister_" . $phone;
        $cachePhone = $cache->get($key);
        if(!$cache->get($key)){
            //Yii::app()->msg->postMsg("error", '请先验证手机');
            $this->redirect('index');
            exit();
        }
        
        $cacheCode = $cache->get($key . '_code');

        $name = Yii::app()->request->getParam('name');      
        $password = Yii::app()->request->getParam('password');
        $invitephone=$cache->get("openregister_" . $phone."_invite");
        
        if ($phone && $name && $password && $cacheCode) {
    
            $res = JceHelper::userRegister($phone, $cacheCode, $password, $name, $invitephone);
            
            if(false == $res){
                $this->redirect(array('openreginfo','phone' => $phone));
            }else{
                $this->redirect(array('openregsuccess', 'phone' => $phone, 'userid' => $res->uid->val, 'identity'=>$res->identity->val, 'isnewuser'=>$res->isnewuser->val));
            }

        }else if ($phone) {
            $this->renderPartial('openreginfo', array('phone' => $phone));
        } else{
            $this->redirect('index');
        }
    }

    //开放注册-创建成功
    public function actionOpenregsuccess()
    { 
//         $this->renderPartial('openregsuccess', array('url'=>'banban', 'returnurl'=>'xxx'));exit;
        $phone = Yii::app()->request->getParam('phone');
        $userid = Yii::app()->request->getParam('userid');
        $identity = Yii::app()->request->getParam('identity');
        $isnewuser = Yii::app()->request->getParam('isnewuser');
        
        if($userid){
            $user = JceHelper::getUserInfo($userid);
            $identity = new RemoteUserIdentity($user);
            Yii::app()->user->login($identity);
        }
        
//         $time = date('Y-m-d H:i:s', time());
//         $pass = md5(md5($userid . $time . LOGIN_BANBAN_KEY));
//         $sid = 0;
//         $redirectUrl = Yii::app()->createUrl('class/create?sid=' . $sid);
//         $url = Yii::app()->request->baseUrl . '/index.php/site/remote?userid=' . $userid . '&pass=' . $pass . '&identity=' . 1 . '&time=' . $time . '&url=' . $redirectUrl;
        if ($phone && $userid) {
            $this->renderPartial('openregsuccess');
        } else {
            $this->redirect('index');
        } 
    }
} 
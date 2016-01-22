<?php
/**
* @author panrj 2014-08-09
* 继承CWebUser组建
*/

class WebUser extends CWebUser
{
    private $model;
    public $loginUrl = array('/site/login');
    public $authTimeout=2592000;
    public $absoluteAuthTimeout=2592000;
    public function __get($name)
    {
        if ($this->hasState('__userInfo')) {
            $user=$this->getState('__userInfo',array());
            if (isset($user[$name])) {
                return $user[$name];
            }
        }
        return parent::__get($name);
    }

    // //session_start()慢日志处理方案
    // public function setState($key,$value,$defaultValue=null)
    // {
    //     $flag = parent::setState($key,$value,$defaultValue);
    //     // close the session
    //     session_write_close();
    //     return $flag;
    // }

    public function getInstance()
    {
        if(!Yii::app()->user->isGuest){
            if(Yii::app()->user->id){
                $user=JceHelper::getUserInfo(Yii::app()->user->id);
                return $user;
            }else{
                Yii::app()->request->redirect(Yii::app()->baseUrl);
                exit();
            }
        }else{
            return (object)null;
        } 
    }

    public function getLogo()
    {
        $default_photo = $this->defaultPhoto();
        if(Yii::app()->user->isGuest)
            return Yii::app()->request->baseUrl.$default_photo;
        $ext = $this->getExtInstance();
        return Yii::app()->request->baseUrl.$default_photo;//暂时不使用七牛的
        if($ext&&$ext->photo ){
            return STORAGE_QINNIU_XIAOXIN_TX.$ext->photo;
        }else{
            return Yii::app()->request->baseUrl.$default_photo;
        }
    }

    public function getExtInstance()
    {
        if(!Yii::app()->user->isGuest){
            if(Yii::app()->user->id){
                $ext=UserExt::getOrCreateByUserid(Yii::app()->user->id);
                return $ext;
            }else{
                return (object)null;
            }
        }else{
            return (object)null;
        }
    }
    
    public function getRealName()
    {
        if(Yii::app()->user->isGuest)
            return '匿名用户';
        $user = $this->getInstance();
        if($user && $user->name != ''){
            return $user->name;
        }else{
            return '';
        }
    }

    /**
     * 获取当前用户的当前身份情况（班主任，任课老师，家长，关注人）
     */
    public function isTeacherUser($uid=0)
    {
        if(!$uid){
            $uid = Yii::app()->user->id;
        }
        if($uid){
            $identity = JceHelper::getIdentity($uid);
            $isteacher = ($identity->isTeacher || $identity->isMaster)?true:false;
            return $isteacher;

        }else{
            $url = Yii::app()->createUrl('site/login');
            Yii::app()->controller->redirect($url);
        }
    }

    public function setThreeUserInfo($info)
    {
        $info = serialize($info);
        //记session以防浏览器禁用cookie
        Yii::app()->session->add(LOGIN_THREE_USER_INFO,$info);
        //记cookie以防session失效
        $cookie = new CHttpCookie(LOGIN_THREE_USER_INFO, $info);
        $cookie->expire = time()+60*60*24*30;  //有限期30天
        Yii::app()->request->cookies[LOGIN_THREE_USER_INFO]=$cookie;
    }

    public function getThreeUserInfo()
    {
        if(Yii::app()->user->isGuest)
            return false;
        if(Yii::app()->session->get(LOGIN_THREE_USER_INFO)){
            return unserialize(Yii::app()->session->get(LOGIN_THREE_USER_INFO));
        }else{
            $cookie = Yii::app()->request->getCookies();
            $info_cookie = $cookie[LOGIN_THREE_USER_INFO]?$cookie[LOGIN_THREE_USER_INFO]->value:false;
            if($info_cookie){
                return unserialize($info_cookie);
            }
            return false;
        }
    }
    
    /**
     * 获取当前用户的当前身份情况（班主任，任课老师，家长，关注人）
     */
    public function getCurrIdentity($uid=0)
    {
        if(!$uid){
            $uid = Yii::app()->user->id;
        }
        if($uid){
            return JceHelper::getIdentity($uid);
        }else{
            $url = Yii::app()->createUrl('site/login');
            Yii::app()->controller->redirect($url);
        }
    }

    public function defaultPhoto()
    {
        if(Yii::app()->user->isGuest)
            return Yii::app()->request->baseUrl.'/image/xiaoxin/default_pic.jpg';
        $ext = $this->getExtInstance();
        $user = $this->getInstance();
        if($user->sex==0)
            return Yii::app()->request->baseUrl.'/image/xiaoxin/default_pic.jpg';
        if($user->sex==1)
            return Yii::app()->request->baseUrl.'/image/xiaoxin/man_pic.jpg';
        if($user->sex==2)
            return Yii::app()->request->baseUrl.'/image/xiaoxin/woman_pic.jpg';
    }

    /**
     * This method is called after the user is successfully logged in.
     * You may override this method to do some postprocessing (e.g. log the user
     * login IP and time; load the user permission information).
     * @param boolean $fromCookie whether the login is based on cookie.
     * @since 1.1.3
     */
    public function afterLogin($fromCookie)
    {
//         $user = self::getInstance();
//         $user->lastlogintime = date("Y-m-d H:i:s");
//         $user->lastloginip = Yii::app()->request->getUserHostAddress();
//         $user->save();
    }

    /**
     * 扩展login方法,用来保持用户登录状态
     * panrj 2015-10-19
     */
    public function login($identity)
    {
        return parent::login($identity,2592000);
    }

    /**
     * 扩展logout方法,用来销毁用户附加SESSION
     * panrj 2014-10-18
     */
    public function logout($destroySession=true)
    {
        if(Yii::app()->session->get(LOGIN_THREE_USER_INFO)){
            Yii::app()->session->remove(LOGIN_THREE_USER_INFO);
        }
        $cookie = Yii::app()->request->getCookies();
        unset($cookie[LOGIN_THREE_USER_INFO]);

        return parent::logout($destroySession);
    }

    public function returnUrl()
    {
        if(isset($_SERVER['HTTP_REFERER'])){
            return $_SERVER['HTTP_REFERER'];
        }else{
            return Yii::app()->session['previousurl'] ? Yii::app()->session['previousurl'] : '';
        }

    }
}
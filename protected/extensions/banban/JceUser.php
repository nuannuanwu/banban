<?php
/**
* @author panrj 2015-01-08 
* JCE辅助类，提供用户常用方法
*/

class JceUser extends JceHttpBase
{
    //被推荐人用手机号取班费劵 ECMD_GET_INVITED_CLASS_FEE_CARD
    const RES_GET_INVITED_CLASS_FEE_CARD_PHONE_INVALID = 1991; //手机号无效
    const RES_GET_INVITED_CLASS_FEE_CARD_PHONE_EXIST = 1992; //手机号已经存在
    
    /**
     * 用户注册
     * @param string $mobile
     * @param string $verifycode
     * @param string $pwd
     * @param string $username
     * @param string $invitemobile
     * @return TRespLoginRegister|boolean
     */
    public static function userRegister($mobile,$verifycode,$pwd,$username,$invitemobile='')
    {
        $inner_out = '';
        $inner = new TReqLoginRegister;
        $inner->mobile->val = $mobile;
        $inner->verifycode->val = $verifycode;
        $inner->pwd->val = md5(strtolower($pwd)."CK2012");
        $inner->username->val = $username;
        $inner->invitemobile->val = $invitemobile;
        $inner->writeTo($inner_out,0);
        
        $_out = self::writeToHttpPackage(ECM_LOGIN_REGISTER,$inner_out);
        $response = self::readFromHttpPackage(APOLLO_USER_LOGIN,$_out);
        if($response->iResult->val==0){
            $res = new TRespLoginRegister;
            $res->readFrom($response->vecData->get_val(),0);
            return $res;
        }
        return $response->iResult->val.":".$response->sMessage->val;
    }
    
    /**
     * 用户登录
     * @param string $account
     * @param string $pwd
     * @return TRespCommonLogin|boolean
     */
    public static function userLogin($account, $pwd)
    {
        $inner_out = '';
        $inner = new TReqCommonLogin;
        $inner->sAccount->val = $account;
        $inner->sPwd->val = md5(strtolower($pwd)."CK2012");
        $inner->sDeviceID->val = '';
        $inner->apnsToken->val = '';
        
        $inner->writeTo($inner_out,0);
        
        $_out = self::writeToHttpPackage(ECMD_LOGIN,$inner_out);
        $response = self::readFromHttpPackage(APOLLO_USER_LOGIN,$_out);
        if($response->iResult->val==0){
            $res = new TRespCommonLogin;
            $res->readFrom($response->vecData->get_val(),0);
            return $res;
        }
        return false;
    }

    /**
     * 第三方用户登录
     * @param string $account 第三方账号openID
     * @param string $loginType 登录类型
     * @param string $nick 第三方用户昵称
     * @param string $trdAccount 第三方帐号
     * @return TRespCommonLogin|boolean
     */
    public static function thirdPartyUserLogin($account, $loginType=0,$trdAccount='',$nick='')
    {
        $inner_out = '';
        $inner = new TReqCommonLogin;
        $inner->sAccount->val = $account;
        $inner->sDeviceID->val = '';
        $inner->apnsToken->val = '';
        $inner->loginType->val = $loginType;
        $inner->sTrdAccount->val = $trdAccount;
        $inner->nick->val = $nick;
        
        $inner->writeTo($inner_out,0);
        
        $_out = self::writeToHttpPackage(ECMD_LOGIN,$inner_out);
        $response = self::readFromHttpPackage(APOLLO_USER_LOGIN,$_out);
        
        if($response->iResult->val==0){
            $res = new TRespCommonLogin;
            $res->readFrom($response->vecData->get_val(),0);
            $res = self::parseJceObj($res);
            return $res;
        }

        return false;
    }
    
    /**
     * 重置密码
     * @param string $mobile
     * @param string $pwd
     * @param string $verifycode
     * @return TRespLoginReSetPwd|boolean
     */
    public static function userResetPwd($mobile, $pwd, $verifycode)
    {
        $inner_out = '';
        $inner = new TReqLoginReSetPwd;
        $inner->mobile->val = $mobile;
        $inner->pwd->val = md5(strtolower($pwd)."CK2012");
        $inner->verifycode->val = $verifycode;
        
        $inner->writeTo($inner_out,0);
        
        $_out = self::writeToHttpPackage(ECMD_RESET_PWD,$inner_out);
        $response = self::readFromHttpPackage(APOLLO_USER_LOGIN,$_out);
        return $response;
    }

    /**
     * 重置密码
     * @param string $uid
     * @return TUser
     */
    public static function getUserInfo($uid)
    {
        $_out = self::writeToHttpPackage(ECMD_GET_TUSER,'',$uid);
        $response = self::readFromHttpPackage(APOLLO_CLASS_INFO,$_out);
        if($response->iResult->val==0){
            $res = new TRespGetTUser;
            $res->readFrom($response->vecData->get_val(),0);
            $userObj = self::parseJceObj($res);
            $user = $userObj->user;
            return $user;
        }
        return false;
    }

    /**
     * 获取个人完整信息
     * @param string $uid
     * @return TUser
     */
    public static function getPersonUserInfo($uid)
    {
        $_out = self::writeToHttpPackage(ECMD_GET_TUSER,'',$uid);
        $response = self::readFromHttpPackage(APOLLO_CLASS_INFO,$_out);
        if($response->iResult->val==0){
            $res = new TRespGetTUser;
            $res->readFrom($response->vecData->get_val(),0);
            $userObj = self::parseJceObj($res);
            $user = $userObj->user;
            return array('user'=>$user,'banban'=>$userObj->banban,'vThirdAccounts'=>$userObj->vThirdAccounts);
        }
        return false;
    }
    
    /**
     * 获取用户具有的身份
     * @param number $uid 用户id
     */
    public static function getIdentity($uid=0)
    {
        $inner_out = '';
        $inner = new TReqGetDetailedIdentity;
        $inner->uid->val = $uid;
        $inner->writeTo($inner_out,0);
        
        $_out = self::writeToHttpPackage(ECMD_GET_DETAILED_IDENTITY, $inner_out, $uid);
        $response = self::readFromHttpPackage(APOLLO_CLASS_INFO,$_out);
        
        if($response->iResult->val==0){
            $res = new TRespGetDetailedIdentity;
            $res->readFrom($response->vecData->get_val(), 0);
            return self::parseJceObj($res);
        }
        return self::array_to_object(array('isTeacher'=>0, 'isMaster'=>0, 'isPatriarch'=>0, 'isFocus'=>0));
    }


    /*
     * 绑定手机，密码，用于qq登陆后，用户设置密码，手机
     */
    public static function setMobilePhone($uid,$mobile,$code,$pwd,$flag=1,$oldmobile='')
    {
        $inner_out = '';
        $inner = new TReqSetMobilePhone;
        $inner->uid->val = $uid;
        $inner->flag->val = $flag;
        $inner->mobilePhone->val = $mobile;
        $inner->oldMobilePhone->val = $oldmobile;
        $inner->code->val = $code;
        $inner->pwd->val = md5(strtolower($pwd)."CK2012");//$pwd;
        $inner->writeTo($inner_out,0);
        $_out = self::writeToHttpPackage(ECMD_SET_MOBILE_PHONE, $inner_out);
        $response = self::readFromHttpPackage(APOLLO_CLASS_INFO,$_out);
        return $response;
    }

    /*
 * 修改个人信息
 */
    public static function setPersonInfo($uid,$photo,$sex='',$name='',$address='',$flag=6)
    {
        $inner_out = '';
        $inner = new TReqSetPersonalInfo;
        $inner->uid->val = $uid;
        $inner->flag->val = $flag;
        $inner->photo->val = $photo;
        $inner->sex->val = $sex;
        $inner->name->val = $name;
        $inner->address->val = $address;
       // D($inner);
        $inner->writeTo($inner_out,0);
        $_out = self::writeToHttpPackage(ECMD_SET_PERSONAL_INFO, $inner_out);
        $response = self::readFromHttpPackage(APOLLO_CLASS_INFO,$_out);
        return $response;
    }

    /*
* 修改个人密码
*/
    public static function setPersonPassword($uid,$old,$new)
    {
        $inner_out = '';
        $inner = new TReqSetPassword;
        $inner->uid->val = $uid;
        $inner->newPwd->val = md5(strtolower($new)."CK2012");
        $inner->oldPwd->val = md5(strtolower($old)."CK2012");;
        $inner->writeTo($inner_out,0);
        $_out = self::writeToHttpPackage(ECMD_SET_PASSWORD, $inner_out);
        $response = self::readFromHttpPackage(APOLLO_CLASS_INFO,$_out);
        return $response;
    }




    // public static function updateUser()
    // {
    //     $inner_out = '';
    //     $inner = new TReqUpdateUser;
    //     $inner->mobile->val = $mobile;
    //     $inner->pwd->val = md5(strtolower($pwd)."CK2012");
    //     $inner->verifycode->val = $verifycode;
        
    //     $inner->writeTo($inner_out,0);
        
    //     $_out = self::writeToHttpPackage(ECMD_RESET_PWD,$inner_out);
    //     $response = self::readFromHttpPackage(APOLLO_USER_LOGIN,$_out);
    // }
    
    /**
     * 发送邀请短信
     * @param Array $mobiles
     * @param String content
     */
    public static function sendSmsInvitation($mobiles, $content)
    {
        $total = count($mobiles);

        $registerArr = array();
        $threeInvitArr = array();
        
        $inner_out = '';
        $inner = new TReqSendSmsInvitation;
        $inner->content->val = $content;
        $arr = new c_vector( new c_string() );
        foreach ($mobiles as $mobile) {
            $tstr = new c_string();
            $tstr->val = $mobile;
            $arr->push_back($tstr);
        }
        $inner->vMobilePhone = $arr;
        
        $inner->writeTo($inner_out,0);
        
        $_out = self::writeToHttpPackage(ECMD_SEND_SMS_INVITATION, $inner_out);
        $response = self::readFromHttpPackage(APOLLO_OMS_PROXY, $_out);
        
        if($response->iResult->val == 0){
            $resp = new TRespSendSmsInvitation;
            $resp->readFrom($response->vecData->get_val(), 0);
            $registerArr = self::parseJceCvector($resp->vRegisteredMobilePhones->get_val());
            $threeInvitArr = self::parseJceCvector($resp->vManyTimesInviteMobilePhones->get_val());
        }
        
        $sub = $total - (count($registerArr) + count($threeInvitArr));
//         conlog(['result' => $response->iResult->val , 'registeds' => $registerArr, 'threeInvited' => $threeInvitArr]);
        return ['result' => $response->iResult->val , 'registers' => $registerArr, 'threeInvited' => $threeInvitArr, 'sendcount' => $sub];
    }
    
    /**
     * 被推荐人用手机号取班费劵
     * @param String $mobilephone
     * @param Int $sender
     * @param Array $activeidArr
     */
    public static function getInvitedClassFeeCard($mobilephone, $sender, $activeidArr = array())
    {
        $inner_out = '';
        
        $inner = new TReqGetInvitedClassFeeCard;
        $inner->mobilePhone->val = $mobilephone;
        $inner->sender->val = $sender;
        isset($activeidArr[0]) ? $inner->activeid1->val = $activeidArr[0] : '';
        isset($activeidArr[1]) ? $inner->activeid2->val = $activeidArr[1] : '';
        isset($activeidArr[2]) ? $inner->activeid3->val = $activeidArr[2] : '';
        
        $inner->writeTo($inner_out, 0);
       // D($inner);
        $_out = self::writeToHttpPackage(ECMD_GET_INVITED_CLASS_FEE_CARD, $inner_out);
        $response = self::readFromHttpPackage(APOLLO_OMS_PROXY, $_out);

        //D($response);
        $iResult = $response->iResult->val;
        //error_log("classfeecard:".$iResult.";mobile:".$mobilephone.";$sender");
        if($iResult == 0||$iResult==1993){
            $res = new TRespGetInvitedClassFeeCard;
            $res->readFrom($response->vecData->get_val(), 0);
           // error_log("money:".$res->money->val);
            return array('amt'=>$res->money->val,'msg'=>$response->sMessage->val,'result'=>$iResult);
        }

        return array('amt'=>0,'msg'=>$response->sMessage->val,'result'=>$iResult);
    }

    /**
     * 获取孩子信息
     * @param string $uid
     * @return TUser
     */
    public static function getChildInfo($uid)
    {
        $_out = self::writeToHttpPackage(ECMD_GET_CHILD_INFO,'',$uid);
        $response = self::readFromHttpPackage(APOLLO_CLASS_INFO,$_out);
        $schoolInfo = array();
        if($response->iResult->val==0){
            $res = new TRespGetChildInfo;
            $res->readFrom($response->vecData->get_val(),0);
            $userObj = self::parseJceObj($res);
            foreach($userObj->vSchoolAndClassesInfo as $schInfo){
                $schoolInfo[] = $schInfo;
            }
            return (object)array('name'=>$userObj->name,'photo'=>$userObj->photo,'info'=>$schoolInfo);
        }
        return (object)array('name'=>'','photo'=>'','info'=>$schoolInfo);
    }
    
    
} 
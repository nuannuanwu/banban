<?php
/**
* @author panrj 2015-01-08 
* JCE辅助类，提供系统常用方法
*/
require_once('HttpProto_pdu.php');
require_once('notice_pdu.php');
require_once('JceEnum.php');
require_once('class_pdu.php');
require_once('Bean_pdu.php');
require_once('HttpClass_pdu.php');
require_once('login_pdu.php');
require_once('audit_pdu.php');
require_once('ClassFee_pdu.php');
require_once('ClassFeeCard_pdu.php');
require_once('zone_pdu.php');
require_once('OMSProxy_pdu.php');
require_once('Adapte_pdu.php');
require_once('word_pdu.php');
require_once('bank_pdu.php');
require_once('PullNewUserActivity_pdu.php');


class JceHttpBase
{
    /**
     * 发送手机短信（app下载链接内容）
     * @param String $mobilephone
     * @return Ambigous <object, TRespPackage>
     */
    public static function sendSmsDownloadAddr($mobilephone,$fullmsg=false)
    {        
        $inner_out = '';
        $inner = new TReqSendSmsLoadAppAddress;
        $inner->mobilePhone->val = $mobilephone;
        
        $inner->writeTo($inner_out,0);
        
        $_out = self::writeToHttpPackage(ECMD_SEND_SMS_LOAD_APP_ADDRESS, $inner_out);
        $response = self::readFromHttpPackage(APOLLO_OMS_PROXY, $_out);
        if($fullmsg){
            return self::parseJceObj($response);
        }
        return $response->iResult->val;
    }
    
    
    /**
     * 发送手机验证码
     * @param  string  $mobile 手机号
     * @param  integer $type   验证码用途：1注册，2找回密码，3修改绑定手机，4.班费转出
     * @return 
     */
    public static function sendMobileCode($mobile,$type)
    {
        $inner_out = '';
        $inner = new TCommonRequestAuth;
        $inner->mobile->val = $mobile;
        $inner->type->val = $type;
        
        $inner->writeTo($inner_out,0);
        
        $_out = self::writeToHttpPackage(ECMD_MOBILE_GET_AUTH_CODE,$inner_out);
        $response = self::readFromHttpPackage(APOLLO_USER_LOGIN,$_out);
        return $response;
    }

    /**
     * HTTP请求打包
     * @param  integer $CmdType HTTP请求命令字
     * @param  string $stream  内层包序列化内容
     * @return string $_out 打包后的二进制字符串
     */
    public static function writeToHttpPackage($CmdType,$stream,$uid=0)
    {
        $_out = "";
        $request = new THttpPackage;
        $request->sVer->val = SITE_VERSION;
        $components = $user = Yii::app()->getComponents();
        $userid = isset($components['user'])?Yii::app()->user->id:'';
        $request->uid->val = $uid?$uid:$userid;
        $request->nClientType->val = APOLLO_CLIENT_TYPE;
        $request->nCMDID->val = $CmdType;
        $request->iSequence->val = time();
        $request->vecData->push_back($stream);
        $request->writeTo($_out,0);
        return $_out;
    }

    /**
     * 获取HTTP响应包并解包
     * @param  string $url 请求URL
     * @param  string $stream HTTP请求打包后的二进制字符串
     * @return object TRespPackage
     */
    public static function readFromHttpPackage($url,$stream)
    {
        $curl = new Curl();
        $curl->success(function($instance) {
            // var_dump('successful');
            // echo 'call to "' . $instance->url . '" was successful. response was' . "\n";
            // echo $instance->response . "\n";
        });
        $curl->error(function($instance) {
            Yii::log("\n".'error url:' . $instance->url . "\n".'error code:' . $instance->error_code . "\n".'error message:' . $instance->error_message . "\n",CLogger::LEVEL_ERROR,'Curl.Apollo');
            
            echo '<html><head><meta charset="UTF-8"></head>服务器繁忙，请稍后再试！</html>';
            exit;
            // var_dump('error url:' . $instance->url . "\n");
            // var_dump('error code:' . $instance->error_code . "\n");
            // var_dump('error message:' . $instance->error_message . "\n");exit;
        });
        $curl->complete(function($instance) {
            // var_dump('call completed' . "\n");
        });
        $result = $curl->post($url,$stream);
        // V($result);
        $response = new TRespPackage;
        $response->readFrom($result,0);
        return $response;
    }
    

    /**
     * jce对象基本类型转换 
     * @author zengp 2015-05-25
     * @param JCE $obj
     * @return obj
     */
    public static function parseJceObj($obj)
    {
        foreach ($obj as $key => $value) {
            if(!property_exists($value, 'val')){
                if(strpos('tmp'.$value->get_class_name(),'list')){                    
                    $obj->$key = self::parseJceCvector($value->get_val());
                }else{
                    $obj->$key = self::parseJceObj($value);
                }
            }else{
                $obj->$key = $value->val;
            }
        }
        return $obj;        
    }
    
    /**
     * 数组转换为对象（数组对象的值为jce对象） 或用于修改key值
     * @author zengp 2015-05-25
     * @param array $array 数组item基础值为jce c_type
     * @return obj
     */
    protected function array_to_object($array) {
        if (is_array($array)) {
            $obj = new StdClass();
             
            foreach ($array as $key => $val){
                $obj->$key = $val;
            }
        }else {
            $obj = $array;
        }
         
        return $obj;
    }
    
    /**
     * 解析简单类型c_map（int，string）
     * @author zengp 2015-05-25
     * @param C_map $cmap
     * @param array $keyArr 自定义key名
     * @return multitype:StdClass
     */
    protected function parseJceSimpleCmap($cmap, $keyArr=array())
    {
        $arrs = array();
        foreach($cmap as $map){
            if(!empty($keyArr)){
                $arr = array($keyArr[0]=>$map['key']->val, $keyArr[1]=>$map['val']->val);
                
                $obj = new StdClass();
                foreach ($arr as $key => $val){
                    $obj->$key = $val;
                }
                $arrs[] = $obj;
            }else{
                $obj = new StdClass();
                $key = $map['key']->val;
                $val = $map['val']->val;
                $obj->$key = $val;
                $arrs[] = $obj;
            }
        }
        return $arrs;
    }
    
    /**
     * 解析c_vector
     * @author zengp 2015-05-25
     * @param c_vector $cvector
     * @param array $keyArr 自定义key名 array('自定义key'=>对象属性名,...)
     */
    protected function parseJceCvector($cvector, $keyArr=array())
    {
        if(!is_array($cvector)){
            return [];
        }
        
        $arrs = array();                
        foreach ($cvector as $vector){
            if(!property_exists($vector, 'val')){
                $vector = self::parseJceObj($vector);
            }else{
                $vector = $vector->val;
            }           
            if(!empty($keyArr)){
                foreach ($keyArr as $key=>$property){
                    $arr[$key] = $vector->$property;
                }
                $obj = new stdClass();
                foreach ($arr as $key => $val){
                    $obj->$key = $val;
                }
                $arrs[] = $obj;
            }else{
                $arrs[] = $vector;
            }
        }    
        return $arrs;
    }
    
    
}
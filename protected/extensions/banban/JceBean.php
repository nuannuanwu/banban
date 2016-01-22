<?php
/**
* @author panrj 2015-01-08 
* JCE辅助类，提供用户常用方法
*/

class JceBean extends JceClass
{
    /**
     * 获取用户青豆积分
     * @param number $uid
     * @return TRespAcquireBeanInfo|Ambigous <number, unknown>
     */
    public static function getBeanInfo($uid = 0)
    {
        if(!$uid) $uid = Yii::app()->user->id;
        
        $inner_out = '';
        $inner = new TReqAcquireBeanInfo;
        $inner->uid->val = $uid;
        $inner->writeTo($inner_out,0);
        
        $_out = self::writeToHttpPackage(ECMD_BEAN_INFO, $inner_out);
        $response = self::readFromHttpPackage(APOLLO_USER_BEAN, $_out);
        
        if($response->iResult->val==0){
            $res = new TRespAcquireBeanInfo;
            $res->readFrom($response->vecData->get_val(),0);
            return $res->bean->val;
        }
        return 0;
    }
    
    
}
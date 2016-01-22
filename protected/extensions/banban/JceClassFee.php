<?php
/**
* @author panrj 2015-01-08 
* JCE辅助类，提供班费常用方法
*/

class JceClassFee extends JceBean
{
    /**
     * 班费记账
     * @param  integer $cid   班级ID
     * @param  integer $uid   用户ID
     * @param  integer $event  操作事件号
     * @param  string $uname 用户姓名
     * @return object $res TRespIncome
     */
    public static function classFeeIncome($cid,$uid,$event,$uname,$iAdID=0)
    {
        $arr = array();
        $inner_out = '';
        $inner = new TReqIncome;
        $inner->uid->val = $uid;
        $inner->strName->val = $uname;
        $inner->cid->val = $cid;
        $inner->sEventID->val = $event;
        $inner->iAdID->val = $iAdID;
        $inner->writeTo($inner_out,0);

        if(Yii::app()->user->id){
            $_out = self::writeToHttpPackage(ECMD_CLASSFEE_INCOME,$inner_out);
        }else{
            $_out = self::writeToHttpPackage(ECMD_CLASSFEE_INCOME,$inner_out,$uid);
        }
        $response = self::readFromHttpPackage(APOLLO_CLASS_EXPENSE,$_out);
        if($response->iResult->val==0){
            $res = new TRespIncome;
            $res->readFrom($response->vecData->get_val(),0);
            return $res;
        }else if($response->iResult->val==39 || $response->iResult->val==45){ //已经参与过
            $res = new TRespIncome;
            $res->readFrom($response->vecData->get_val(),0);
            return $res;
        }else{
            $result=array('result'=>$response->iResult->val,'message'=>$response->sMessage->val);
            return $result;

        }
        return false;
    }

    /**
     * 班费提现回滚
     * @param  integer  $cid   班级ID
     * @param  integer  $order 订单号
     * @param  integer  $money 金额
     * @param  integer $uid   操作者ID，默认为当前登录用户
     * @return boolen         
     */
    public static function transferClassFeeRollBack($cid,$order,$money,$uid=0)
    {
        $arr = array();
        $inner_out = '';
        $inner = new TReqRollback;
        var_dump($order);
        $inner->cid->val = $cid;
        $inner->lOrderNum->val = $order;
        $inner->dValue->val = $money;
        $inner->writeTo($inner_out,0);
        echo "<pre>";var_dump($inner);
        $_out = self::writeToHttpPackage(ECMD_CLASSFEE_ROLLBACK,$inner_out,$uid);
        $response = self::readFromHttpPackage(APOLLO_CLASS_EXPENSE,$_out);
        echo "<pre>";var_dump($response);
        if($response->iResult->val==0){
            return true;
        }
        return false;
    }

    /**
     * 班费提现
     * @param  integer $uid   用户ID
     * @param  integer $cid   班级ID
     * @param  integer $money 金额
     * @param  string  $uname 用户姓名
     * @param  integer $type  0:转出  1：检测金额上下限50，300 iRet:46 2：检测月转出金额800 iRet:60、余额不足iRet:40
     * @return array        
     */
    public static function transferClassFee($uid,$cid,$money,$uname,$type=0)
    {
        $arr = array();
        $inner_out = '';
        $inner = new TReqTransfer;
        
        $inner->uid->val = $uid;
        $inner->strName->val = $uname;
        $inner->cid->val = $cid;
        $inner->dValue->val = $money;
        $inner->iType->val = $type;
        $inner->writeTo($inner_out,0);
        
        $_out = self::writeToHttpPackage(ECMD_CLASSFEE_TRANSFER,$inner_out);
        $response = self::readFromHttpPackage(APOLLO_CLASS_EXPENSE,$_out);
       // Yii::log("uid:$uid,transfer:$money:response:".$response->iResult->val,CLogger::LEVEL_ERROR,"curl");
        if($response->iResult->val==0){
            $res = new TRespTransfer;
            $res->readFrom($response->vecData->get_val(),0);
            $arr = array();
            $arr['iRet'] = $res->iRet->val;
           // Yii::log("uid:$uid,transfer:$money:result:".$res->iRet->val,CLogger::LEVEL_ERROR,"curl");
            $arr['strMsg'] = $res->strMsg->val;
            $arr['lOrderNum'] = $res->lOrderNum->val;
            $arr['monthTransferBanlance'] = $res->monthTransferBanlance->val;
            return $arr;
        }else{
            $res = new TRespTransfer;
            $res->readFrom($response->vecData->get_val(),0);
            $arr = array();
            $arr['iRet'] = $res->iRet->val;
           // Yii::log("uid:$uid,transfer:$money:result:".$res->iRet->val,CLogger::LEVEL_ERROR,"curl");
            $arr['strMsg'] = $res->strMsg->val;
            $arr['lOrderNum'] = $res->lOrderNum->val;
            $arr['monthTransferBanlance'] = $res->monthTransferBanlance->val;
            return $arr;
        }
    }


    /**
     * 班费明细
     * @param  integer  $cid   班级ID
     * @param  integer $order  订单号
     * @param  integer $driect 拉取方式，2表示向后拉取
     * @param  integer $size   每次拉取条数
     * @return array
     */
    public static function getClassFeeDetail($cid,$order=0,$driect=2,$size=50)
    {
        $arr = array();
        $inner_out = '';
        $inner = new TReqClassFeeDetail;
        $inner->iCid->val = $cid;
        $inner->lOrderNum->val = $order;
        $inner->iNum->val = $size;
        $inner->sDirection->val = $driect;
        $inner->writeTo($inner_out,0);

        $_out = self::writeToHttpPackage(ECMD_CLASSFEE_DETAIL,$inner_out);
        $response = self::readFromHttpPackage(APOLLO_CLASS_EXPENSE,$_out);
        if($response->iResult->val==0){
            $res = new TRespClassFeeDetail;
            $res->readFrom($response->vecData->get_val(),0);
            // mlog($res->vLog->get_val());
            $arr = array();
            foreach ($res->vLog->get_val() as $log){
                $arrTmp['uid'] = $log->uid->val;
                $arrTmp['strName'] = $log->strName->val;
                $arrTmp['sEventID'] = $log->sEventID->val;
                $arrTmp['dValue'] = $log->dValue->val/100;
                $arrTmp['timestamp'] = $log->timestamp->val;
                $arrTmp['sEventName'] = $log->sEventName->val;
                $arrTmp['lOrderNum'] = $log->lOrderNum->val;
                $arr[] = $arrTmp;
            }
            return $arr;
        }
        return false;
    }

    /**
     * 班费查看账户汇总
     * @param  array  $cids 班级ID
     * @return array
     */
    public static function getClassFeeInfo($cids=array())
    {
        $arr = array();
        $inner_out = '';
        $inner = new TReqClassFeeInfo;
        $vector = new c_vector(new c_int);
        foreach($cids as $cid){
            $c = new c_int;
            $c->val = $cid;
            $vector->push_back($c);  
        }
        
        $inner->vCid = $vector;
        $inner->writeTo($inner_out,0);

        $_out = self::writeToHttpPackage(ECMD_CLASSFEE_INFO,$inner_out);
        $response = self::readFromHttpPackage(APOLLO_CLASS_EXPENSE,$_out);
        if($response->iResult->val==0){
            $res = new TRespClassFeeInfo;
            $res->readFrom($response->vecData->get_val(),0);
            $arr = array();
            foreach($res->vFee->get_val() as $fee){
                $arrTmp['cid'] = $fee->cid->val;
                $arrTmp['dTotalIncome'] = $fee->dTotalIncome->val/100;
                $arrTmp['dBalance'] = $fee->dBalance->val/100;
                $arrTmp['dMax'] = $fee->dMax->val/100;
                $arrTmp['dToday'] = $fee->dToday->val/100;
                $arrTmp['createtime'] = $fee->createtime->val;
                $arrTmp['updatetime'] = $fee->updatetime->val;
                $arr[] = $arrTmp;
            }
            return $arr;
        }
        return false;
    }

    /**
     * 获取我的班费卡数据
     * @param  array  $cids 班级ID
     * @return array
     */
    public static function getClassFeeCard($uid,$index=0,$flag=1)
    {
        $arr = array();
        $inner_out = '';
        $inner = new TReqCardList;
        $inner->uid->val = $uid;
        $inner->index->val = $index;
        $inner->flag->val =$flag;
        $inner->writeTo($inner_out,0);
        $_out = self::writeToHttpPackage(ECMD_CLASSFEECARD_GET,$inner_out);
        $response = self::readFromHttpPackage(APOLLO_CLASS_CLASSFEECARD,$_out);
        if($response->iResult->val==0){
            $res = new TRespCardList;
            $res->readFrom($response->vecData->get_val(),0);
            $usearr = array();
            $unusearr = array();
            if(is_array($res->usableCards->get_val())){ //可使用的
                foreach($res->usableCards->get_val() as $val){
                    $usearr[]=array('cardid'=>$val->cardid->val,'status'=>$val->status->val,'ruleid'=>$val->ruleid->val,'money'=>substr(sprintf("%.3f", $val->money->val/100.0),0,-1),'endtime'=>date("Y-m-d",$val->endtime->val),'category'=>$val->category->val,'index'=>$val->index->val,'name'=>$val->name->val,
                    );
                }
            }
            //var_dump($usearr);
            //D($res->unusableCards->get_val());
            if(is_array($res->unusableCards->get_val())){ //最近一周内过期的
                foreach($res->unusableCards->get_val() as $val){
                    $unusearr[]=array('cardid'=>$val->cardid->val,'status'=>$val->status->val,'activeid'=>$val->ruleid->val,'money'=>substr(sprintf("%.3f", $val->money->val/100.0),0,-1),'endtime'=>date("Y-m-d",$val->endtime->val),'category'=>$val->category->val,'index'=>$val->index->val,'name'=>$val->name->val,
                    );
                }
            }
            return array('use'=>$usearr,'unuse'=>$unusearr,'total'=>$res->usableCardsCount->val,'amount'=>$res->amount->val);
        }
        return false;
    }

    /**
     * 增加班费卡
     * @param  array
     * @return array
     */
    public static function addClassFeeCard($cardinfo=array())
    {
        $arr = array();
        $inner_out = '';
        $inner = new TReqAddClassFeeCard;
        $inner->uid->val = $cardinfo['uid'];
        $inner->name->val = $cardinfo['name'];
        $inner->category->val =$cardinfo['category'];
        $inner->money->val =$cardinfo['money'];
        $inner->endtime->val =$cardinfo['endtime'];
        $inner->writeTo($inner_out,0);
        $_out = self::writeToHttpPackage(ECMD_CLASSFEECARD_ADD,$inner_out);
        $response = self::readFromHttpPackage(APOLLO_CLASS_CLASSFEECARD,$_out);
        if($response->iResult->val==0){
            $res=new TRespAddClassFeeCard;
            $res->readFrom($response->vecData->get_val(),0);
           // D($res);
            return true;
        }
        return false;
    }

    /**
     * 查询成员属于提现白名单
     * @param  array
     * @return array
     */
    public static function queryWhiteList($uid)
    {
        $inner_out = '';
        $inner = new TReqQueryWtihdrawWhiteList;
        $inner->uid->val = $uid;
        $inner->writeTo($inner_out,0);

        $_out = self::writeToHttpPackage(ECMD_CLASSFEECARD_QUERY_WHITE_LIST,$inner_out);
        $response = self::readFromHttpPackage(APOLLO_CLASS_CLASSFEECARD,$_out);
        
        if($response->iResult->val==0){
            $res=new TRespQueryWtihdrawWhiteList;
            $res->readFrom($response->vecData->get_val(),0);
            return $res->uid->val?true:false;
        }
        return false;
    }

    /**
     * 班费提现
     * @param  integer $uid   用户ID
     * @param  string  $uname 用户姓名
     * @param  integer $type  0:转出
     * @return array        
     */
    public static function transferClassFeeCard($uid,$uname,$type=0)
    {
        $arr = array();
        $inner_out = '';
        $inner = new TReqClassFeeCardRollout;
        
        $inner->uid->val = $uid;
        $inner->strName->val = $uname;
        $inner->iType->val = $type;
        $inner->writeTo($inner_out,0);
        
        $_out = self::writeToHttpPackage(ECMD_CLASSFEECARD_ROLL_OUT,$inner_out);
        $response = self::readFromHttpPackage(APOLLO_CLASS_CLASSFEECARD,$_out);

        if($response->iResult->val==0){
            $res = new TRespClassFeeCardRollout;
            $res->readFrom($response->vecData->get_val(),0);
            $arr = array();
            $arr['iRet'] = $res->iRet->val;
            $arr['strMsg'] = $res->strMsg->val;
            $arr['lOrderNum'] = $res->lOrderNum->val;
            $arr['amount'] = $res->amount->val;
            return $arr;
        }else{
            $res = new TRespTransfer;
            $arr = array();
            $arr['iRet'] = $response->iResult->val;
            $arr['strMsg'] = $response->sMessage->val;
            $arr['lOrderNum'] = 0;
            $arr['monthTransferBanlance'] = 0;
            return $arr;
        }
    }

    /**
     * 班费卡提现回滚
     * @param  integer  $order 订单号
     * @param  integer  $money 金额
     * @param  integer $uid   操作者ID，默认为当前登录用户
     * @return boolen         
     */
    public static function transferClassFeeCardRollBack($order,$money,$uid=0)
    {
        $arr = array();
        $inner_out = '';
        $inner = new TReqClassFeeCardRollback;
        $inner->lOrderNum->val = $order;
        $inner->dValue->val = $money;
        $inner->uid->val = $uid;
        $inner->writeTo($inner_out,0);

        $_out = self::writeToHttpPackage(ECMD_CLASSFEECARD_ROLLBACK,$inner_out,$uid);
        $response = self::readFromHttpPackage(APOLLO_CLASS_CLASSFEECARD,$_out);
        if($response->iResult->val==0){
            return true;
        }
        return false;
    }

    /**
     * 班费卡明细
     * @param  integer  $cid   班级ID
     * @param  integer $order  订单号
     * @param  integer $driect 拉取方式，2表示向后拉取
     * @param  integer $size   每次拉取条数
     * @return array
     */
    public static function getClassFeeCardDetail($uid=0,$order=0,$driect=2,$size=50)
    {
        $arr = array();
        $inner_out = '';
        $inner = new TReqClassFeeCardBillDetail;
        $inner->uid->val = $uid;
        $inner->lOrderNum->val = $order;
        $inner->iNum->val = $size;
        $inner->flag->val = $driect;
        $inner->writeTo($inner_out,0);

        $_out = self::writeToHttpPackage(ECMD_CLASSFEECARD_QUERY_BILL,$inner_out);
        $response = self::readFromHttpPackage(APOLLO_CLASS_CLASSFEECARD,$_out);
        if($response->iResult->val==0){
            $res = new TRespClassFeeCardBillDetail;
            $res->readFrom($response->vecData->get_val(),0);
            // mlog($res->vLog->get_val());
            $arr = array();
            foreach ($res->vLog->get_val() as $log){
                $arrTmp['uid'] = $log->uid->val;
                $arrTmp['strName'] = $log->strName->val;
                $arrTmp['sEventID'] = $log->sEventID->val;
                $arrTmp['dValue'] = $log->dValue->val/100;
                $arrTmp['timestamp'] = $log->timestamp->val;
                $arrTmp['strRemark'] = $log->strRemark->val;
                $arrTmp['lOrderNum'] = $log->lOrderNum->val;
                $arr[] = $arrTmp;
            }
            return $arr;
        }
        return false;
    }

    /**
     * 判断班级是否达标具有拉新活动免排队特权
     * @return boolen         
     */
    public static function checkPullNewClass($uid,$cid)
    {
        $inner_out = '';
        $inner = new TReqPullNewCidUpToStandard;
        $inner->cid->val = $cid;
        $inner->writeTo($inner_out,0);

        $_out = self::writeToHttpPackage(ECMD_PULL_NEW_CID_UP_TO_STANDARD,$inner_out,$uid);
        $response = self::readFromHttpPackage(APOLLO_PULL_NEW_PROXY,$_out);
        if($response->iResult->val==0){
            $res=new TRespPullNewCidUpToStandard;
            $res->readFrom($response->vecData->get_val(),0);
            return $res->b->val?true:false;
        }
        return false;
    }
} 
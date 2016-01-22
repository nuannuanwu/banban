<?php
/**
* @author panrj 2015-01-08 
* JCE辅助类，提供通知常用方法
*/
class JceNotice extends JceClassFee
{
    /**
     * 发送通知
     * @param number $micotime
     * @param array | number $receiverId
     * @param number $receiverType
     * @param number $noticeType
     * @param string $photo
     * @param string $content
     * @param string $uname
     * @param string $uid
     * @return boolean
     */
    public static function sendNotice( $micotime, $receiverId,  $noticeType, $photo, $content, $uname , $uid = null,$evalute=0 ,$receivername='',$issendsms=0,$schoolid=0)
    {
        $inner_out = '';
        
        if( null === $uid ){
            $uid = Yii::app()->user->id;
        }
        if($noticeType==4){
            $objSendNotice = new TReqSendEurgencyNotice;
           // D($objSendNotice);
        }else{
            $objSendNotice = new TReqSendNotice ;
        }
        $objNotice = new TNotice;
        $objContent = new TNoticeText;
        $vector = new c_vector(new TReceiverObject);
        foreach( (array)$receiverId  as $k=>$v ){
            foreach($v as $objectid){
                $re=new TReceiverObject;
                $re->iType->val=(int)$k;
                $re->objectId->val=$objectid;
                $vector->push_back($re);
            }

        }
        $objContent->content->val=$content;
        $objNotice->vReceiver=$vector;
        $objNotice->sSenderId->val = (int)$uid;                         //发送者ID
        $objNotice->sSenderPhoto->val = $photo;                      //发送者头像
        $objNotice->sSenderTitle->val =$uname;                    //XXX老师（发送者称呼）
        $objNotice->receiverTitle->val =$receivername;                    //XXX老师（发送者称呼）
        $objNotice->iType->val = (int)$noticeType;                             // class ENoticeType
        $objNotice->tContent  = $objContent;                          //通知内容
        if($noticeType==4){
            $objNotice->isSendSms->val=$issendsms;
            $objNotice->schoolid->val=$schoolid;
           // $objNotice->schoolName->val='ffff';
        }
        $objNotice->evalute->val  =$evalute;
        $objNotice->lSendTime->val = $micotime;                        //发送时间 ,单位ms
        $objNotice->nPlatform->val = APOLLO_CLIENT_TYPE;         //CLIENT_TYPE 客户端平台类型（Android iOS WEB）
        $objSendNotice->notice = $objNotice;     //发送通知

        $objSendNotice->writeTo($inner_out,0);
        if($noticeType==4){
             $_out = self::writeToHttpPackage(ECMD_URGENCY_NOTICE_SEND,$inner_out);//紧急通知
        }else{
             $_out = self::writeToHttpPackage(EMSG_NOTICE_SEND,$inner_out); // 普通通知
        }
        $response = self::readFromHttpPackage(APOLLO_NOTICE_PUSH,$_out);

        if($noticeType==4){ //紧急通知 特别一点
            //$resp=new TRespSendEurgencyNotice;
           // $resp->readFrom($response->vecData->get_val(),0);
            return array('status'=>$response->iResult->val,'message'=>$response->sMessage->val);
        }else{
            if($response->iResult->val==0){
                return true;
            }
        }
        return false;
    }

    /*
     * 发紧急通知
     */
    public static function sendNoticeUrgency( $micotime, $receiverId,  $noticeType, $photo, $content, $uname , $uid = null,$evalute=0 ,$receivername='',$issendsms=0,$schoolid=0)
    {
        $inner_out = '';
        if( null === $uid ){
            $uid = Yii::app()->user->id;

        }
        $instance=Yii::app()->user->getInstance();
        $objSendNotice = new TReqSendEurgencyNotice;
        $objNotice = new TNotice;
        $objContent = new TNoticeText;
        $vector = new c_vector(new TReceiverObject);
        foreach( (array)$receiverId  as $k=>$v ){
            foreach($v as $objectid){
                $re=new TReceiverObject;
                $re->iType->val=(int)$k;
                $re->objectId->val=$objectid;
                $vector->push_back($re);
            }
        }
        $objContent->content->val=$content;
        $objNotice->vReceiver=$vector;
        $objNotice->sSenderId->val = (int)$uid;                         //发送者ID
        $objNotice->sSenderPhoto->val = $instance?$instance->icon:"";                      //发送者头像
        $objNotice->sSenderTitle->val =$uname;                    //XXX老师（发送者称呼）
        $objNotice->receiverTitle->val =$receivername;                    //XXX老师（发送者称呼）
        $objNotice->iType->val = (int)$noticeType;                             // class ENoticeType
        $objNotice->tContent  = $objContent;                          //通知内容
        $objNotice->isSendSms->val=$issendsms;
        $objNotice->schoolid->val=$schoolid;
        $objNotice->evalute->val  =$evalute;
        $objNotice->lSendTime->val = $micotime;                        //发送时间 ,单位ms
        $objNotice->nPlatform->val = APOLLO_CLIENT_TYPE;         //CLIENT_TYPE 客户端平台类型（Android iOS WEB）
        $objSendNotice->notice = $objNotice;     //发送通知
        $objSendNotice->writeTo($inner_out,0);
        $_out = self::writeToHttpPackage(ECMD_URGENCY_NOTICE_SEND,$inner_out);//紧急通知
        $response = self::readFromHttpPackage(APOLLO_NOTICE_PUSH,$_out);
        return array('status'=>$response->iResult->val,'message'=>$response->sMessage->val);
    }

    /**
     * 发送成绩通知
     * @param number $micotime
     * @param array | number $receiverId
     * @param number $receiverType
     * @param number $noticeType
     * @param string $photo
     * @param string $content
     * @param string $uname
     * @param string $uid
     * @return boolean
     */
    public static function sendNoticeExam( $micotime, $receiverId,  $noticeType, $photo, $content, $uname , $uid = null,$evalute=0 ,$receivername='',
                                           $params,$studentscores,$classStudentsArr)
    {
        $inner_out = '';

        if( null === $uid ){
            $uid = Yii::app()->user->id;
        }
        $objSendNotice = new TReqSendNotice;
        $objNotice = new TNotice;
        $objContent = new TNoticeText;
        $vector = new c_vector(new TReceiverObject);

        foreach( (array)$receiverId  as $k=>$v ){
            foreach($v as $objectid){
               // D($objectid);
                if(!array_key_exists((int)$objectid,$classStudentsArr)){
                    continue;
                }
                $re=new TReceiverObject;
                $re->iType->val=(int)$k;
                $re->objectId->val=(int)$objectid;
                $vector->push_back($re);
            }
        }
        $objContent->subject->val=$params['examsubject'];//科目
        $vector1 = new c_vector(new TScoreContent);
        foreach($studentscores as $vv){
            $score=new TScoreContent;
            $score->examine->val=  $params['examname'];//考试名称
            $sendstudentname=$vv['name'];
            $sendstudentid=$vv['userid'];//isset($classStudentsArr[$sendstudentname])?$classStudentsArr[$sendstudentname]:0;
            if(empty($sendstudentid)){
                continue;
            }
          //  D($classStudentsArr);
            if(!array_key_exists((int)$sendstudentid,$classStudentsArr)){
                continue;
            }
            $score->tagid->val=  (string)$sendstudentid;//考生
            $score->timestamp->val=  strtotime($params['examdate']);//考试时间
            $score->title->val=  $params['examtype'];//考试类型
            $score->cid->val=(int)$params['cid'];
            $tsubjectScore= new  c_vector (new TSubjectScore);
            foreach($vv['score'] as $kk=>$tt){
                $su=new TSubjectScore;
                $su->subject->val=$kk;
                $su->score->val=$tt;
                $tsubjectScore->push_back($su);
            }
            $score->vSubjectScore=$tsubjectScore;
            $vector1->push_back($score);
        }



        $objContent->vScore=$vector1;
        $objContent->content->val=" ";
        $objNotice->vReceiver=$vector;
        $objNotice->sSenderId->val = (int)$uid;                         //发送者ID
        $objNotice->sSenderPhoto->val = $photo;                      //发送者头像
        $objNotice->sSenderTitle->val =$uname;                    //XXX老师（发送者称呼）
        $objNotice->receiverTitle->val =(string)$receivername;                    //XXX老师（发送者称呼）
        $objNotice->iType->val = (int)$noticeType;                             // class ENoticeType
        $objNotice->tContent  = $objContent;                          //通知内容
        $objNotice->evalute->val  =$evalute;
        $objNotice->lSendTime->val = $micotime;                        //发送时间 ,单位ms
        $objNotice->nPlatform->val = APOLLO_CLIENT_TYPE;         //CLIENT_TYPE 客户端平台类型（Android iOS WEB）
        $objSendNotice->notice = $objNotice;     //发送通知
       // D($objNotice);
        $objSendNotice->writeTo($inner_out,0);
        $_out = self::writeToHttpPackage(EMSG_NOTICE_SEND,$inner_out);
        $response = self::readFromHttpPackage(APOLLO_NOTICE_PUSH,$_out);
        if($response->iResult->val==0){
            return true;
        }
        return false;
    }
    
    /**
     * 发送系统通知
     * @param string $uid
     * @param string $childId
     * @param string $childName
     * @param string $cid
     * @param string $cidName
     * @param string $type
     * @param string $sendId
     * @param array | string $classMemberId
     * @param string $subject
     * @return number | boolean
     */
    public static function sendSystemNotice( $uid, $childId, $childName, $cid, $cidName, $type, $sendId, $classMemberId, $subject  )
    {
        $inner_out = '';
        $inner = new TReqSendSystemNotice;
        $inner->uid->val = $uid;                        //申请人
        $inner->childId->val = $childId;                //申请人是家长时的孩子id
        $inner->childName->val = $childName;            //申请人是家长时的孩子名字
        $inner->cid->val = $cid;                        //申请班级
        $inner->cidName->val = $cidName;                //申请班级名称
        $inner->type->val = $type;                      //系统通知类型, class ESystemNoticeType
        $inner->senderId->val = $sendId;                //系统通知的发送者ID
        $inner->nPlatform->val = APOLLO_CLIENT_TYPE;    //平台类型
        foreach( (array)$classMemberId as $v ){
            $val = new c_string();
            $val->val = $classMemberId;                 //当发送解散班级静态通知时， 需传入全班成员的ID，不包含班主任
            $inner->vObject->push_back($val) ;
        }
        $inner->subject->val = $subject;                //任教科目，   当申请人是老师时
        $inner->writeTo($inner_out,0);
        $_out = self::writeToHttpPackage(ECMD_SEND_SYSTEM_NOTICE,$inner_out);
        $response = self::readFromHttpPackage(APOLLO_NOTICE_PUSH,$_out);
        if( $response->iResult->val == 0 ){
            $res = new TRespSendSystemNotice;
            $res->readFrom($response->vecData->get_val(),0);
            return $res->result->val;
        }
        return false;
    }
    
    /**
     * 获取已收通知消息
     * @param number $index
     * @param string $targetId
     * @param number $flag
     * @param string $uid
     * @return boolean|object
     */
    public static function getNoticeMsg( $index, $targetId, $flag, $uid = null )
    {
        if( null === $uid ){
            $uid = Yii::app()->user->id;
        }
        $inner_out = '';
        $inner = new TReqGetNoticeMsg;
        $inner->index->val = $index;                     //流水号
        $inner->targetid->val = $targetId;                  //目标人id 比如孩子或自己 全部是0
        $inner->flag->val = $flag;                      //DIRECTION_TYPE,	1 表示向上（即取比较新的记录）, 2 表示向下（即比较旧的历史记录）
        $inner->uid->val = $uid;                        //用户自己id
        $inner->writeTo($inner_out,0);
        $_out = self::writeToHttpPackage(EMSG_NOTICE_GET,$inner_out);
        $response = self::readFromHttpPackage(APOLLO_NOTICE_RECEIVE,$_out);
        if($response->iResult->val==0){
           // return array('total'=>0,'count'=>0,'data'=>array());
            $res = new TRespGetNoticeMsg;
            $res->readFrom($response->vecData->get_val(),0);
            $NoticeMsg=$res->vNoticeMsg->get_val();
            $NoticeMsg=self::parseJceCvector($NoticeMsg);
            return array('total'=>$res->total->val,'count'=>$res->count->val,'data'=>$NoticeMsg);
        }
        
        return false;
    }

    /**
     * 获取已收通知消息详情
     * @param number $index
     * @param string $targetId
     * @param number $flag
     * @param string $uid
     * @return boolean|object
     */
    public static function getNoticeMsgDetail( $index,$uid=null )
    {
        if( null === $uid ){
            $uid = Yii::app()->user->id;
        }
        $inner_out = '';
        $inner = new TReqGetNoticeMsg;
        $inner->index->val = $index;                     //流水号
        $inner->uid->val = $uid;                        //用户自己id
        $inner->writeTo($inner_out,0);
        $_out = self::writeToHttpPackage(EMSG_NOTICE_GET,$inner_out);
        $response = self::readFromHttpPackage(APOLLO_NOTICE_RECEIVE,$_out);
        if($response->iResult->val==0){
            $res = new TRespGetNoticeMsg;
            $res->readFrom($response->vecData->get_val(),0);
            $NoticeMsg=$res->vNoticeMsg->get_val();
            $NoticeMsg=self::parseJceCvector($NoticeMsg);
            return $NoticeMsg;
        }
        return false;
    }
    
    /**
     * 确认通知读状态
     * @param number $noticeid
     * @param number $tagid
     * @param number $flag
     * @param string $uid
     * @return boolean
     */
    public function ackNoticeStatus( $noticeid, $tagid, $flag, $uid = null )
    {
        if( null === $uid ){
            $uid = Yii::app()->user->id;
        }
        $inner_out = '';
        $inner = new TReqAckNoticeStatus;
        $inner->noticeid->val = $noticeid;
        $inner->tagid->val = $tagid;
        $inner->flag->val = $flag;                        // 1 已读 
        $inner->uid->val = $uid;
        $inner->writeTo($inner_out,0);
        $_out = self::writeToHttpPackage(EMSG_NOTICE_ACK_STATUS,$inner_out);
        $response = self::readFromHttpPackage(APOLLO_NOTICE_RECEIVE,$_out);

        if($response->iResult->val==0){
            return true;
        }
        
        return false;
    }
    
    /**
     * 获取已发通知统计数据
     * @param number $noticeid
     * @param number $tagid
     * @param string $uid
     * @return TRespGetNoticeSendDetail|boolean
     */
    public function getNoticeSendDetail( $noticeid,$uid=null )
    {
        if( null === $uid ){
            $uid = Yii::app()->user->id;
        }
        $inner_out = '';
        $inner = new TReqGetNoticeSendDetail;//TReqAppSendNoticeDetail();//TReqGetNoticeSendDetail;
        $inner->noticeid->val = (string)$noticeid;
      //  D($inner);
        $inner->writeTo($inner_out,0);
        $_out = self::writeToHttpPackage(EMSG_NOTICE_SENDED_DETALL_GET,$inner_out);
        $response = self::readFromHttpPackage(APOLLO_NOTICE_RECEIVE,$_out);
       // D($response->vecData->get_val());
        if($response->iResult->val==0&&$response->vecData->get_val()){
            $res = new TRespGetNoticeSendDetail;//TRespAppSendNoticeDetail;//
            $res->readFrom($response->vecData->get_val(),0);
           // D($res);
            return $res;
        }
        return false;
    }
    
    /**
     * 拉取通知盒子
     * @param array|string $childid
     * @param string $uid
     * @return TRespGetNoticeboxs|boolean
     */
    public static function  getNoticeBoxes( $childid, $uid = null )
    {
        if( null === $uid ){
            $uid = Yii::app()->user->id;
        }
        $inner_out = '';
        $inner = new TReqGetNoticeboxs;
        
        foreach ( (array)$childid as $v ){
            $val = new c_string();
            $val->val = $v;
            $inner->vChild->push_back($val) ;               //我的孩子ID
        }
        $inner->uid->val = $uid;
        $inner->writeTo($inner_out,0);
        $_out = self::writeToHttpPackage(EMSG_NOTICE_BOXS_GET,$inner_out);
        $response = self::readFromHttpPackage(APOLLO_NOTICE_RECEIVE,$_out);
        if($response->iResult->val==0){
            $res = new TRespGetNoticeboxs;
            $res->readFrom($response->vecData->get_val(),0);
            $vNoticeboxs=$res->vNoticeboxs->get_val();
            $vNoticeboxs=self::parseJceCvector($vNoticeboxs);
            if(is_array($vNoticeboxs)){
                foreach($vNoticeboxs as $vv){
                    if($vv->targeterid==$uid){
                        return $vv;
                    }
                }
            }
            return $res;
        }
        
        return false;
    }
    
    
    /**
     * 推送通知盒子
     * @param array $param
     * 参数结构:
               [[
    					'iNoticeId'=>'',	//通知ID
    					'sSenderId'=>'',	//发送者ID
    					'sSenderPhoto'=>'',	//发送者头像
    					'sSenderTitle'=>'',	//XXX老师（发送者称呼）
    					'sReceiverId'=>'',	//接受者
    					'targteid'=>'',		//目标人id
    					'targtePhoto'=>'',	//目标人头像
    					'iType'=>'',		//class ENoticeType 
    					'lSendTime'=>'',	//发送时间 ,单位ms
    					'index'=>'',		// 相对于接受者用户通道的id
    					'read'=>'',			//已读1 未读0  
    					'evalute'=>'',		//点评类型,评价的时候出现 (0 表扬；1 批评)
    					'action'=>'',		//动作  0正常 1 url  2 未定
						'content' =>'', 	//通知内容
						'vPhotos' =>'', 	//URL： 手机上传图片，保存在公司服务器， web上传图片，保存在七牛云
						'vVoices' =>'', 	//URL : 音频
    			],...]
     * 接口结构:[
        	'vNoticeBoxs'=>[
        			'count' =>'',	 //数目未读消息
        			'total' =>'',	//总条数
        			'targeterid' =>'',	//消息来源人 如果是发给孩子就是孩子id 如果是自己的, 全部为0
        			'vNoticeMsgs' =>[	//部分未读消息最多给10条，
        					'iNoticeId'=>'',	//通知ID
        					'sSenderId'=>'',	//发送者ID
        					'sSenderPhoto'=>'',	//发送者头像
        					'sSenderTitle'=>'',	//XXX老师（发送者称呼）
        					'sReceiverId'=>'',	//接受者
        					'targteid'=>'',		//目标人id
        					'targtePhoto'=>'',	//目标人头像
        					'iType'=>'',		//class ENoticeType 
        					'lSendTime'=>'',	//发送时间 ,单位ms
        					'index'=>'',		// 相对于接受者用户通道的id
        					'read'=>'',			//已读1 未读0  
        					'evalute'=>'',		//点评类型,评价的时候出现 (0 表扬；1 批评)
        					'action'=>'',		//动作  0正常 1 url  2 未定
        					'tContent'=>[
        						'content' =>'', 	//通知内容
        						'vPhotos' =>'', 	//URL： 手机上传图片，保存在公司服务器， web上传图片，保存在七牛云
        						'vVoices' =>'', 	//URL : 音频
        					]
        			]
        	]
        ]
     * @param string $uid
     * @return TRespPushNoticeboxs|boolean
     */
    public function pushNoticeBoxes( $param, $uid = null )
    {
        if( null === $uid ){
            $uid = Yii::app()->user->id;
        }
        $stucture = [
            'iNoticeId'=>'',	//通知ID
            'sSenderId'=>'',	//发送者ID
            'sSenderPhoto'=>'',	//发送者头像
            'sSenderTitle'=>'',	//XXX老师（发送者称呼）
            'sReceiverId'=>'',	//接受者
            'targteid'=>'',		//目标人id
            'targtePhoto'=>'',	//目标人头像
            'iType'=>'',		//class ENoticeType
            'lSendTime'=>'',	//发送时间 ,单位ms
            'index'=>'',		// 相对于接受者用户通道的id
            'read'=>'',			//已读1 未读0
            'evalute'=>'',		//点评类型,评价的时候出现 (0 表扬；1 批评)
            'action'=>'',		//动作  0正常 1 url  2 未定
            'content' =>'', 	//通知内容
            'vPhotos' =>'', 	//URL： 手机上传图片，保存在公司服务器， web上传图片，保存在七牛云
            'vVoices' =>'', 	//URL : 音频
        ];
        
        $inner_out = '';
        $inner = new TReqPushNoticeboxs;
        $msgBox = new TNoticeMessageBox;
        
        foreach( $param as $v ){
            $v = array_merge( $stucture, $v );
            $message = new TNoticeMessage;
            $ntText = new TNoticeText;
            $ntText->content->val = $v['content'];
            $ntText->vPhotos->val = $v['vPhotos'];
            $ntText->vVoices->val = $v['vVoices'];
            $message->iNoticeId->val = $v['iNoticeId'];
            $message->sSenderId->val = $v['sSenderId'];
            $message->sSenderPhoto->val = $v['sSenderPhoto'];
            $message->sSenderTitle->val = $v['sSenderTitle'];
            $message->sReceiverId->val = $v['sReceiverId'];
            $message->targteid->val = $v['targteid'];
            $message->targtePhoto->val = $v['targtePhoto'];
            $message->iType->val = $v['iType'];
            $message->tContent = $ntText;
            $message->lSendTime->val = $v['iType'];
            $message->index->val = $v['index'];
            $message->read->val = $v['read'];
            $message->evalute->val = $v['evalute'];
            $message->action->val = $v['action'];
        }
        $msgBox->count->val = 0;
        $msgBox->total->val = 0;
        $msgBox->targeterid->val = 0;
        $inner->vNoticeBoxs->push_back( $msgBox ) ;               //我的孩子ID
        $inner->uid->val = $uid;
        $inner->writeTo($inner_out,0);
        $_out = self::writeToHttpPackage(EMSG_NOTICE_PSUH,$inner_out);
        $response = self::readFromHttpPackage(APOLLO_NOTICE_RECEIVE,$_out);
        
        if($response->iResult->val==0){
            $res = new TRespPushNoticeboxs;
            $res->readFrom($response->vecData->get_val(),0);
            return $res;
        }
        
        return false;
    }

    /**
     * 获取已发通知
     * @param number $index  流水号
     * @param string $flag  上拉或下拉
     * @param string $uid
     * $clienttype 客户端类型
     * @return boolean|object
     */
    public static function getSendNotice($flag,$index, $uid = null,$clienttype=0 )
    {
        if( null === $uid ){
            $uid = Yii::app()->user->id;
        }
        $inner_out = '';
        $inner = new TReqGetSendedNotices;
        $inner->uid->val = $uid;
        $inner->flag->val=$flag;
        $inner->index->val=$index;
        $inner->clientType->val=$clienttype;
        $inner->writeTo($inner_out,0);
        $_out = self::writeToHttpPackage(EMSG_NOTICE_SENDEDS_GET,$inner_out);
        $response = self::readFromHttpPackage(APOLLO_NOTICE_RECEIVE,$_out);
        if($response->iResult->val==0){
            $res = new TRespGetSendedNotices;
            $res->readFrom($response->vecData->get_val(),0);
            $vNotice=$res->vNotice->get_val();
            $vNotice=self::parseJceCvector($vNotice);
            $total=$res->total->val;
            return array('total'=>$total,'vNotice'=>$vNotice?$vNotice:array());
        }

        return false;
    }

    /**
     * 获取单条已收消息
     * @param number $index  流水号
     * @param string $flag  上拉或下拉
     * @param string $uid
     * $clienttype 客户端类型
     * @return boolean|object
     */
    public static function getOneNoticeMsg($noticeid,$index, $targetid=0,$uid = null )
    {
        if( null === $uid ){
            $uid = Yii::app()->user->id;
        }
        $inner_out = '';
        $inner = new TReqGetSingleNoticeMsg;
        $inner->uid->val = $uid;
        $inner->noticeid->val=$noticeid;
        $inner->index->val=(int)$index;
        $inner->targetid->val=$targetid;
        $inner->writeTo($inner_out,0);
        $_out = self::writeToHttpPackage(EMSG_SINGLE_NOTICE_GET,$inner_out);
        $response = self::readFromHttpPackage(APOLLO_NOTICE_RECEIVE,$_out);
        if($response->iResult->val==0){
            $res = new TRespGetSingleNoticeMsg;
            $res->readFrom($response->vecData->get_val(),0);
            $object=self::parseJceObj($res->NoticeMsg);
            return $object;
        }

        return false;
    }

    /**
     * 获取单条已发消息
     * @param number $index  流水号
     * @param string $flag  上拉或下拉
     * @param string $uid
     * $clienttype 客户端类型
     * @return boolean|object
     */
    public static function getOneSendNotice($noticeid,$index, $targetid=0,$uid = null )
    {
        if( null === $uid ){
            $uid = Yii::app()->user->id;
        }
        $inner_out = '';
        $inner = new TReqGetSingleSendedNotice;
        $inner->uid->val = $uid;
        $inner->noticeid->val=$noticeid;
        $inner->index->val=(int)$index;
        $inner->clientType->val=3;
        $inner->writeTo($inner_out,0);
        $_out = self::writeToHttpPackage(EMSG_SINGLE_SENDED_NOTICE_GET,$inner_out);
        $response = self::readFromHttpPackage(APOLLO_NOTICE_RECEIVE,$_out);
        if($response->iResult->val==0){
            $res = new TRespGetSingleSendedNotice;
            $res->readFrom($response->vecData->get_val(),0);
            $object=self::parseJceObj($res->notice);
            return $object;
        }
        return false;
    }
    /*
     * 获取已发短信列表
     */
    public static function getSmsSendNotice($index,$flag=-1, $uid = null )
    {
        if( null === $uid ){
            $uid = Yii::app()->user->id;
        }
        $inner_out = '';
        $inner = new TReqGetSendedSMS;
        $inner->uid->val = $uid;
        $inner->flag->val=$flag;
        $inner->index->val=$index;
        $inner->writeTo($inner_out,0);
        $_out = self::writeToHttpPackage(ECMD_SMS_SENDEDS_GET,$inner_out);

        $response = self::readFromHttpPackage(APOLLO_NOTICE_RECEIVE,$_out);
        if($response->iResult->val==0){
            $res = new TRespGetSendedSMS;
            $res->readFrom($response->vecData->get_val(),0);
            $vNotice=$res->vSMSMsg->get_val();
            $vNotice=self::parseJceCvector($vNotice);
            $total=$res->total->val;
            return array('total'=>$total,'vNotice'=>$vNotice?$vNotice:array());
        }

        return false;
    }

    /*
     * 检查是否有敏感词接口
     */
    public static function checkBadword($content, $type=0,$uid = null){
            if( null === $uid ){
                $uid = Yii::app()->user->id;
            }
            $inner_out = '';
            $inner = new TReqContainBadWord;
            $inner->content->val = $content;
            $inner->type->val = $type;
            $inner->writeTo($inner_out,0);

            $_out = self::writeToHttpPackage(ECMD_CONTAIN_BAD_WORD,$inner_out);
            $response = self::readFromHttpPackage(APOLLO_WORD_PROXY,$_out);

            if($response->iResult->val==0){
                return array('status'=>'0','msg'=>'0');
            }else{
                $res = new TRespContainBadWord;
                $res->readFrom($response->vecData->get_val(),0);
                $value=self::parseJceCvector($res->containedBadWord->get_val());
                return array('status'=>$res->b->val,'msg'=>$value?implode(",",$value):"");
            }
    }

} 
<?php
/**
* @author zengp 2015-07-16 
* JCE辅助类，提供用户常用方法
*/

class JceZone extends JceNotice
{
    /**
     * 获取话题详情
     * @param String $uid
     * @param String $zid
     * @return response
     */
    public static function getTopicDetail($zid)
    {
        $inner_out = '';
        $inner = new TReqZoneDetail;
        $inner->uid->val = '0';
        $inner->zid->val = $zid;
        $inner->writeTo($inner_out, 0);

        $_out = self::writeToHttpPackage(ECMD_GET_ZONE_DETAIL, $inner_out);
        $response = self::readFromHttpPackage(APOLLO_CLASS_ZONE, $_out);
        
        if($response->iResult->val==0){
            $res = new TRespZoneDetail;
            $res->readFrom($response->vecData->get_val(),0);
            
            $msgs = self::parseJceCvector($res->msgs->get_val());   
            $zone = self::parseJceObj($res->zone);
            return (object)array('msgs'=>$msgs,'zone'=>$zone);
        }
        return $response->iResult->val;
    }

    /**
     * 获取帖子详情
     * @param String $uid
     * @param String $pid
     * @return response
     */
    public static function getPostDetail($pid,$uid)
    {
        $inner_out = '';
        $inner = new TReqZoneMsgDetail;
        $inner->uid->val = $uid?$uid:0;//'0';
        $inner->msgid->val = $pid;
        $inner->writeTo($inner_out, 0);
        $_out = self::writeToHttpPackage(ECMD_GET_ZONE_MSGDETAIL, $inner_out);
        $response = self::readFromHttpPackage(APOLLO_CLASS_ZONE, $_out);
        // conlog($response);
        if($response->iResult->val==0){
            $res = new TRespZoneMsgDetail;
            $res->readFrom($response->vecData->get_val(),0);
            $post['content'] = self::parseJceCvector($res->conent->content->get_val());
            
            $post['comments'] = self::parseJceCvector($res->comments->get_val());

            $post['likers'] = self::parseJceCvector($res->likers->get_val());
            $post['msg'] = self::parseJceObj($res->msg);

            return (object)$post;
        }
        return $response->iResult->val;
    }

    /**
     * 发布话题
     * @param string $uid
     * @param Topic $topic
     * @return response
     */
    public static function publishTopic($uid, $topic)
    {
        $inner_out = '';
        
        $inner = new TReqPublishZone;
        //用户id        
        $inner->uid->val = $uid;
        //话题位置
        $inner->location->val = $topic->topicorder != 9999999 ? $topic->topicorder : 1;
        
        //话题详情 
        $t_topic = new TZoneObject;
        $t_topic->zid->val = $topic->topicid;
        $t_topic->title->val = $topic->topictitle;
        $t_topic->summary->val = $topic->topicsubtitle;
        $t_topic->type->val = 1;
        $t_topic->pic->val = $topic->topicpic;
        $t_topic->tag->val = $topic->topictag;
        $t_topic->opentype->val = $topic->topicprivilege;
        
        //首页链接
        $t_topic->url->val = $topic->topicurl ? $topic->topicurl : '';
        $t_topic->urlType->val = $topic->topicurltype;
        
        //话题详情图片跳转
        $detailUrl = new TZoneAction;
        $detailUrl->url->val = $topic->picurl ? $topic->picurl : '';
        $detailUrl->type->val = $topic->picurltype;
        $detailUrl->btncolor->val = 1;
        
        $publishTime = time();
        $t_topic->publishTime->val = $publishTime;
        
        //发布人
        $t_sender = new TZoneSenderObject;
        $sender = Yii::app()->user->getInstance();
        $t_sender->senderId->val = $sender->userid;
        $t_sender->senderName->val = $sender->nickname;
        $t_sender->photo->val = $sender->photo;        
        $t_topic->sender = $t_sender;
        
        $inner->zone = $t_topic;
        $inner->writeTo($inner_out, 0);
        
        $_out = self::writeToHttpPackage(ECMD_CREATE_ZONE, $inner_out);
        $response = self::readFromHttpPackage(APOLLO_CLASS_ZONE, $_out);
        
        if($response->iResult->val==0){
            $res = new TRespPublishZone;
            $res->readFrom($response->vecData->get_val(),0);
            $res = self::parseJceObj($res);
            if($res->zid) {
                Topic::updateTopicStateInfo($sender->userid, 1, $topic->topicid, $res->zid, $publishTime, $topic);                
            }
            return $res->zid;
        }
        return false;
    }
    
    
    /**
     * 编辑话题
     * @param String $uid
     * @param Topic $topic
     */
    public static function updateTopic($uid, $topic)
    {
        $inner_out = '';
        
        $inner = new TReqUpdateZone;
        
        //话题详情
        $t_topic = new TZoneObject;
        $t_topic->zid->val = $topic->id;
        $t_topic->title->val = $topic->topictitle;
        $t_topic->summary->val = $topic->topicsubtitle;
        $t_topic->type->val = 1;
        $t_topic->pic->val = $topic->topicpic;
        $t_topic->tag->val = $topic->topictag;
        $t_topic->opentype->val = $topic->topicprivilege;
        
        //首页链接
        $t_topic->url->val = $topic->topicurl ? $topic->topicurl : '';
        $t_topic->urlType->val = $topic->topicurltype;
        
        //话题详情图片跳转
        $detailUrl = new TZoneAction;
        $detailUrl->url->val = $topic->picurl ? $topic->picurl : '';
        $detailUrl->type->val = $topic->picurltype;
        $detailUrl->btncolor->val = 1;
        
        $inner->zone = $t_topic;
        $inner->writeTo($inner_out, 0);
        
        $_out = self::writeToHttpPackage(ECMD_ZONE_UPDATEZONE, $inner_out);
        $response = self::readFromHttpPackage(APOLLO_CLASS_ZONE, $_out);
        
        if($response->iResult->val==0){
            $res = new TRespUpdateZone;
            $res->readFrom($response->vecData->get_val(),0);
            $res = self::parseJceObj($res);       
            return $res;
        }
        return false;
        
    }
    
    
    /**
     * 隐藏/显示 话题
     * @param int $uid
     * @param Topic $topic
     * @param $type 0:显示 1:隐藏
     * @return boolean
     */
    public static function hideTopic($uid, $topic, $type)
    {    
        $inner_out = '';
        
        $inner = new TReqSMSHideContent;
        $inner->objectid->val = $topic->id;
        $inner->type->val = 0;
        $inner->uid->val = $uid;
        $inner->hide->val = $type;        
        
        $inner->writeTo($inner_out, 0);
        
        $_out = self::writeToHttpPackage(ECMD_ZONE_HIDECONTENT, $inner_out);
        $response = self::readFromHttpPackage(APOLLO_CLASS_ZONE, $_out);
        
        if($response->iResult->val == 0){
            if($type == 1){
                Topic::updateTopicStateInfo($uid, 3, $topic->topicid, 0, '', $topic);
            }else if($type == 0){
                Topic::updateTopicStateInfo($uid, 4, $topic->topicid, 0, '', $topic);
            }
                
            return true;
        }
        return false;
    }
    
    
    /**
     * 删除话题
     * @param int $uid
     * @param Topic $topic
     * @return boolean
     */
    public static function deleteTopic($uid, $topic)
    {        
        $inner_out = '';
        
        $inner = new TReqSMSDeleteContent;
        $inner->objectid->val = $topic->id;
        $inner->type->val = 0;
        $inner->uid->val = $uid;
        
        $inner->writeTo($inner_out, 0);
        
        $_out = self::writeToHttpPackage(ECMD_DELETE_ZONE_DELETECONTENT, $inner_out);
        $response = self::readFromHttpPackage(APOLLO_CLASS_ZONE, $_out);
        
        if($response->iResult->val == 0){
            Topic::updateTopicStateInfo($uid, 2, $topic->topicid, 0, '', $topic);
            return true;
        }
        return false;
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
}
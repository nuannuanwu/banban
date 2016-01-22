<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 15-3-23
 * Time: 下午5:15
 * 班班动态管理
 */

class NoticeController extends Controller{
    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    //列表
    public function actionIndex(){
        $page = (int)Yii::app()->request->getParam("page", 1);
        $startdate =Yii::app()->request->getParam("startdate", '');
        $enddate =Yii::app()->request->getParam("enddate", '');
        $noticetype =Yii::app()->request->getParam("noticetype", '');
        $sendphone =trim(Yii::app()->request->getParam("sendphone", ''));
        $receivephone =trim(Yii::app()->request->getParam("receivephone", ''));
        if($page<1) $page=1;
        $sendinfo=null;
        if($sendphone){
            $sendinfo=Member::getUniqueMember($sendphone);
        }
        $query['page'] = $page;
        $query['startdate'] = $startdate;
        $query['enddate'] = $enddate;
        $query['noticetype'] = $noticetype;
        $query['sender'] = $sendinfo?$sendinfo->userid:0;
        $query['receivephone'] = $receivephone;
        $noticeTypeArr=Constant::noticeTypeArray();
        $data=NoticeMessage::searchMessage($query);
        $query['sendphone']=$sendphone;
        $sendsmsArr=array('0'=>'不发短信','1'=>'发送短信','2'=>'app优先');
        $platformArr=array('0'=>'旧平台','1'=>'android','2'=>'ios','3'=>'新班班');
        $smsstateArr=array('0'=>'待处理','1'=>'已发送短信','2'=>'已处理未发送短信','3'=>'学校黑名单中的短信','4'=>'不在白名单中用户发送的短信','5'=>'异常','6'=>'已发送短信');
        $this->render('index',array('data'=>$data,'query'=>$query,'typeArr'=>$noticeTypeArr,'platformArr'=>$platformArr,'smsstateArr'=>$smsstateArr,'sendsmsArr'=>$sendsmsArr));
    }


} 
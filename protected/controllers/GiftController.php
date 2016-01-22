<?php

class GiftController extends Controller
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

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules()
    {
        return array(
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('cost_activity', 'cost_preview'),
                'users' => array('*'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('index', 'detail', 'share', 'invite'),
                'users' => array('@'),
                //'expression'=>array($this,'loginAndNotDeleted'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    //我的礼包
	public function actionIndex()
	{
		$identity = Yii::app()->user->getCurrIdentity();
		$uid = Yii::app()->user->id;
		$user = Yii::app()->user->getInstance();
		$bean = $user->bean;
		$activeusers = 0;
		$exchangeState = 0; //兑换状态 初始：兑换要求未达到
		$mgid = 0; //活动id
		
		//--建班注册礼包
		$activity = Activity::getActivity('建班大礼包');
        
		$endate = $activity->enddate;
		$currDate = date('Y-m-d', time());
		if($currDate > $endate){
		    $exchangeState = 2; //活动已过期
		}else if($user->isnewuser == 0){ //新用户
		    
		    $exchange = TeacherActiveStat::getActivityStat($uid);
		    $activeusers = isset($exchange->activeusers) ? $exchange->activeusers : $activeusers;	    
		    if($exchange && $exchange->isexchange == 1){
		        $exchangeState = 3; //用户已兑换
		    }else{
	            //礼包兑奖条件（导入并激活30人且青豆数达到500）                   
	            if($bean >= Constant::GIFT_ACTIVITY_BEANS && $exchange && $exchange->activeusers >= Constant::GIFT_ACTIVITY_ACTIVEUSERS){
	                $exchangeState = 1; //达到兑换要求
	            }
		    }
		    
		    $mgid = $activity->conf[0]->mgid;
		    Yii::app()->cache->set("exchange_" . $uid, $mgid); //活动id记在缓存
		}
		
		//---邀请好友礼包
		$inviteActivity = Activity::getActivity('邀请好友');
		
		$inviteList = UserRegisterInvited::getInviteList($uid, 2);

		$okArr = array();
		$notArr = array();
		$exArr = array();
		foreach ($inviteList as $invite){		    
		    $userInfo = Member::model()->findByPk($invite->recevier);
		    $identityByRecevier = Yii::app()->user->getCurrIdentity($invite->recevier);
		    if($identityByRecevier->isTeacher){
		        $bean = $userInfo->bean;
		        $tname = mb_substr($userInfo->name, 0, 1, 'utf-8');
		        
		        if($invite->state == 1){
		            $exArr[] = array('tname'=>$tname);
		            continue;
		        }
		        
		        $exchangeInvite = TeacherActiveStat::getActivityStat($invite->recevier);
		        $activityNum = 0;
		        if($exchangeInvite){
		            $activityNum = $exchangeInvite->activeusers;
		        }
		        //如果被邀请人已注册且已领取建班礼包应该把此礼包减去的青豆加上
		        if($exchangeInvite && $exchangeInvite->isexchange > 0){
		            $bean += Constant::GIFT_ACTIVITY_BEANS;
		        }
		        
		        if($bean >= Constant::GIFT_ACTIVITY_BEANS && $activityNum >= Constant::GIFT_ACTIVITY_ACTIVEUSERS){
		            $okArr[] = array('tname'=>$tname, 'inviteid'=>$invite->id);
		        }else{
		            $notArr[] = array('tname'=>$tname, 'bean'=>$bean, 'activitys'=>$activityNum);
		        }
		    }
		}
		
		$mgid = $inviteActivity->conf[0]->mgid;
		Yii::app()->cache->set("invite_" . $uid, $mgid); //活动id记在缓存
		
		$this->render('index',array(
                    		    'isnewuser'=>$user->isnewuser,
                    		    'identity'=>$identity, 
                    		    'exchange'=>$exchangeState, 
                    		    'bean'=> $user->bean, 
                    		    'activeusers'=>$activeusers, 
                    		    'okArr'=>$okArr, 
                    		    'notArr'=>$notArr, 
                    		    'exArr'=>$exArr
                    		)
		              );
	}
	
    //宣传路由（web端，手机端）
	public function actionCost_activity()
	{
	    $this->renderPartial('cost_activity');
	}
	
	//宣传页面
	public function actionCost_preview()
	{
	    $this->renderPartial('cost_preview');
	}
	
	//宣传详情
	public function actionDetail()
	{
	    $this->render('detail');
	}
	
	// 兑换奖品分享
	public function actionShare()
	{
	    //$ty = Yii::app()->request->getParam('ty');
	    
	    $this->render('share',array('ty'=>'regclass'));
	}
	
	//邀请好友礼包领取
	public function actionInvite($id)
	{
	    //$ty = Yii::app()->request->getParam('ty');
	    
	    $this->render('invite', array('ty'=>'invite', 'id'=>$id));
	}
	
		
}
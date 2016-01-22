<?php

class MobileController extends Controller
{
    const RES_GET_INVITED_CLASS_FEE_CARD_PHONE_INVALID = 1991;
    const RES_GET_INVITED_CLASS_FEE_CARD_PHONE_EXIST   = 1992;
    const RES_GET_INVITED_CLASS_FEE_CARD_ALREADY_GET   = 1993;
    const RES_SEND_SMS_LOAD_APP_ADDRESS_SMS_TIMES = 1971;
    const ACTIVITY_REDIRECT = false;
    const ACTIVITY_REDIRECT_URL = 'http://schoolseason.banban.im/api.aspx';

	public function actionIndex()
	{
		$this->renderPartial('index');
	}
    public function actionSurveyresult(){

    }

    /**
     * 线上拉新活动-老师拉家长
     */
    public function actionFeeaty()
    {
        $type = 'inner';
        $userid = Yii::app()->request->getParam('uid');
        $classes = JceClass::getPullNewClassList($userid);
        $classes = $classes?$classes:array();
        $this->renderPartial('feeaty',array('type'=>$type,'classes'=>$classes));
    }

        /**
     * 线上拉新活动-老师拉家长
     */
    public function actionNewinvite()
    {
        $type = 'share';
        $this->renderPartial('feeaty',array('type'=>$type));
    }

    public function actionGuardianinv()
    {
        $userid = Yii::app()->request->getParam('uid');
        $kid = Yii::app()->request->getParam('kid');

        $user = JceHelper::getUserInfo($userid);
        $user = $user?$user:$this->getEmptyJceObj('TUser');
        $child = JceHelper::getChildInfo($kid);
        $this->renderPartial('guardianinv', array('user'=>$user,'child'=>$child));
    }

	/**
	 * 问卷调查（应用内）
     * @param string 
	 */
	public function actionSurvey($id)
	{
        $shareuid=Yii::app()->request->getParam('uid');//
        $aid=Yii::app()->request->getParam('aid');
        $cid=Yii::app()->request->getParam('cid');
        $status=(int)Yii::app()->request->getParam('status');
        $uid=isset($_REQUEST['joinuid'])?$_REQUEST['joinuid']:''; //参加用户id
        $lastmoney=Yii::app()->request->getParam('lastmoney',0); //站内时，已经领取过的金额,接口通过url给
        if(empty($uid)&&!isset($_POST['uid'])){ //只传了分享uid,没传参与者uid，则到站外
           $this->redirect(array('mobile/surveyshare/'.$id,'uid'=>$shareuid));
            exit();
        }
        $surveyJson = Survey::getSurveyJson($id);
        $survey=Survey::model()->findByPk($id);
        $hasJoin = $status==1?1:0;//SurveyQuestionAnswer::model()->findByAttributes(array('sid'=>$id,'userid'=>$uid));
        if($survey){
            $surveyLevel=SurveyLevel::model()->findAllByAttributes(array('sid'=>$id));//
            $sharetitle='传说中只有1%的爸妈能拿到满分，你敢来测吗？';
            $sharedesc='做好这些测试题，胜过万年老鸡汤';
            if(isset($_POST['answer'])){ //post请求
                $answer=isset($_POST['answer'])?$_POST['answer']:'';
                $aid=isset($_POST['aid'])?$_POST['aid']:'';
                $uid=isset($_POST['uid'])?$_POST['uid']:'';
                $cid=isset($_POST['cid'])?$_POST['cid']:'';
                $lastmoney=isset($_POST['lastmoney'])?$_POST['lastmoney']:0;
                $score=SurveyQuestionItem::setScore($answer,$id,$uid,true);//计算分数

                $resultLevel=null;
                foreach($surveyLevel as $level){
                    if($score>=$level->minscore&&$score<=$level->maxscore){
                        $resultLevel=$level; //获取本次测试结果的等级信息
                        break;
                    }
                }
                $userinfo=JceHelper::getUserInfo($uid);
                $status=0;//未能领取到班费
                $money=0;
                $shareArr=array('a'=>array('desc'=>'选对这些题，你就离好爸妈不远了','title'=>'不敢相信，我竟然是文盲'),
                    'b'=>array('desc'=>'做好这些测试题，胜过万年老鸡汤','title'=>'我竟然是小学毕业'),
                    'c'=>array('desc'=>'看过那么多鸡汤，还是做不好爸妈的你，还不赶紧来测！','title'=>'我的父母能力是大学生水平'),
                    'd'=>array('desc'=>'传说中只有1%的爸妈能拿到满分，你敢来测吗？','title'=>'哈哈哈，我竟然是博士后'),
                );


                if($userinfo){
                    $curl=new Curl();
                    $url=Yii::app()->createAbsoluteUrl('/ajax/addclassfee/');//
                    $res=$curl->get($url,array('uid'=>$uid,'cid'=>$cid,'iadid'=>$aid,'uname'=>$userinfo?$userinfo->name:'','event'=>9));
                    //Yii::log("res:".$res,CLogger::LEVEL_ERROR);
                    $feeresult=json_decode($res,true);
                    if(is_array($feeresult)){
                        if($feeresult['money']==0){
                            $feeresult['result']=2;
                        }
                    }
                   // $feeresult=JceHelper::classFeeIncome($cid,$uid,6,$userinfo->name,$aid);
                    if(is_array($feeresult)&&($feeresult['result']==39)){
                        $status=2;//已经领取过
                        $money=sprintf("%.2f",$lastmoney?$lastmoney/100:(isset($feeresult['money'])?$feeresult['money']/100:0));
                    }else if(is_array($feeresult)&&$feeresult['result']==0){
                        $status=1;//成功领取到班费
                        $money=sprintf("%.2f",$feeresult['money']/100);
                    }
                    //分数D($feeresult->dValue->val);领取到的班费金额;
                    $this->renderPartial('survey_result',array('sharetitle'=>$sharetitle,'sharedesc'=>$sharedesc,'id'=>$id,'uid'=>$uid,'money'=>$money,'status'=>$status,'resultLevel'=>$resultLevel,'score'=>$score,'classfee'=>$feeresult,'surveyJson'=>$surveyJson));//结果
                }else{

                    $feeresult=JceHelper::classFeeIncome($cid,$uid,6,$userinfo?$userinfo->name:'',$aid);
                    $this->renderPartial('survey_result',array('sharetitle'=>$sharetitle,'sharedesc'=>$sharedesc,'id'=>$id,'uid'=>$uid,'money'=>$money,'status'=>$status,'resultLevel'=>$resultLevel,'score'=>$score,'classfee'=>array(),'surveyJson'=>$surveyJson));//结果
                }
                exit();
            }
            $itemArr='';
            $surveyQuestions='';
            $this->renderPartial('survey',array('status'=>$status,'lastmoney'=>$lastmoney,'cid'=>$cid,'aid'=>$aid,'id'=>$id,'uid'=>$uid,'questionnum'=>count($surveyQuestions),'survey'=>$survey,'surveyQuestionItem'=>$itemArr,'surveyQuestions'=>$surveyQuestions,'surveyLevel'=>$surveyLevel,'surveyJson'=>$surveyJson,'hasJoin'=>$hasJoin));
            exit();
        }else{
            $this->renderPartial('survey');
        }

	}

    /*
     * 点广告，挣　班费
     */
    public function actionSurveyday()
    {
        $aid=Yii::app()->request->getParam('aid');
        $cid=Yii::app()->request->getParam('cid');
        $uid=isset($_REQUEST['uid'])?$_REQUEST['uid']:''; //参加用户id
        $userinfo=JceHelper::getUserInfo($uid);
        $url=Yii::app()->createAbsoluteUrl('/ajax/addclassfee/');//
        $curl=new Curl();

        $res=$curl->get($url,array('uid'=>$uid,'cid'=>$cid,'iadid'=>$aid,'uname'=>$userinfo->name,'event'=>6));
        $feeresult=json_decode($res,true);

       // $res=JceHelper::classFeeIncome($cid,$uid,6,$userinfo->name,$aid);
        D($feeresult);
        $this->renderPartial('surveyday',array('res'=>$res)); $this->renderPartial('survey');
    }

	/**
	 * 问卷调查（应用外）
     * @param string 
	 */
	public function actionSurveyshare($id)
	{
        $uid=Yii::app()->request->getParam('uid');
        $aid=Yii::app()->request->getParam('aid');
        $cid=Yii::app()->request->getParam('cid');
        $status=Yii::app()->request->getParam('status');
        $lastmoney=Yii::app()->request->getParam('lastmoney',0);

       $surveyJson = Survey::getSurveyJson($id);
       // D($surveyJson);
        $survey=Survey::model()->findByPk($id);
        if($survey){
            $surveyLevel=SurveyLevel::model()->findAllByAttributes(array('sid'=>$id));//
          //  $surveyQuestionItems=SurveyQuestionItem::model()->findAllByAttributes(array('sid'=>$id));//
            $itemArr=array();

            //输入手机号有错误的情况下
            if(isset($_REQUEST['score'])&&isset($_REQUEST['level'])&&isset($_REQUEST['uid'])&&!isset($_POST['mobilephone'])){
                $resultLevel=null;
                foreach($surveyLevel as $levelItem){
                    if($levelItem->title==Yii::app()->request->getParam('level')){
                        $resultLevel=$levelItem; //获取本次测试结果的等级信息
                        break;
                    }
                }
                $errormsg=Yii::app()->request->getParam('errormsg');
                Yii::app()->msg->postMsg("error",'手机号码格式有错误');
                $this->renderPartial('surveyshare_result',array('errormsg'=>$errormsg,'id'=>$id,'status'=>$status,'resultLevel'=>$resultLevel,'score'=>Yii::app()->request->getParam('score'),'uid'=>$uid));//结果
                exit();
            }


            if(isset($_POST['answer'])){ //post请求//提交所有测试
                $answer=isset($_POST['answer'])?$_POST['answer']:'';
                $aid=isset($_POST['aid'])?$_POST['aid']:'';
                $uid=isset($_POST['uid'])?$_POST['uid']:'';
                $cid=isset($_POST['cid'])?$_POST['cid']:'';

                $score=SurveyQuestionItem::setScore($answer,$id,$uid,false);//Score($answer,$itemArr,$id,$uid);//计算分数

                $resultLevel=null;
                foreach($surveyLevel as $level){
                    if($score>=$level->minscore&&$score<=$level->maxscore){
                        $resultLevel=$level; //获取本次测试结果的等级信息
                        break;
                    }
                }
                $errormsg='';
                $this->renderPartial('surveyshare_result',array('errormsg'=>$errormsg,'id'=>$id,'status'=>$status,'resultLevel'=>$resultLevel,'score'=>$score,'uid'=>$uid));//结果
                exit();
            }elseif(isset($_POST['mobilephone'])&&isset($_POST['uid'])){
                //输入手机号post页面
                $uid=$_POST['uid'];
                $mobilephone=$_POST['mobilephone'];
                $id=$_POST['id'];
                $activeidArr = ['1', '2', '3'];
               // $curl=new Curl();
               // $url=Yii::app()->createAbsoluteUrl('/ajax/addclasscardfee/');//
                //$res=$curl->get($url,array('mobilephone'=>$mobilephone,'uid'=>$uid));
                //error_log("res:".$res);
              // $money=json_decode($res,true);
                $money = JceHelper::getInvitedClassFeeCard($_POST['mobilephone'], $uid, $activeidArr);
               // error_log("result".json_encode($money));
               // D($money);
                $status=$money['result'];
                if($status=='1991'){ //手机号有错误，返回上一个页面，保留分数信息
                    $this->redirect(Yii::app()->createUrl("mobile/surveyshare/$id?uid=".$uid."&score=".$_POST['score']."&level=".$_POST['level'].'&errormsg=请输入有效的手机号'));
                }
                $browser = new Browser();
                $bt = $browser->isMobile()?'app':'web';
                $this->renderPartial('surveyshare_classcard',array('bt'=>$bt,'id'=>$id,'status'=>$status,'money'=>$money,'mobilephone'=>$mobilephone,'uid'=>$uid,'surveyJson'=>$surveyJson));//结果
                exit();
            }else{
                //进入测试
                $surveyQuestions='';//SurveyQuestion::getQuestions(array('sid'=>$id));//
                $itemArr='';
                $this->renderPartial('surveyshare',array('lastmoney'=>$lastmoney,'cid'=>$cid,'aid'=>$aid,'id'=>$id,'uid'=>$uid,'questionnum'=>count($surveyQuestions),'survey'=>$survey,'surveyQuestionItem'=>$itemArr,'surveyQuestions'=>$surveyQuestions,'surveyLevel'=>$surveyLevel,'surveyJson'=>$surveyJson));
                exit();
            }
        }else{
            $this->renderPartial('surveyshare');
        }
		$this->renderPartial('surveyshare');
	}
       
    public function actionInvrule()
	{
		$this->renderPartial('invrule');
	}

	/**
	 * 班班-邀请有礼
     * @param string $uid 用户id
	 */
	public function actionInvprize()
	{
		$userid = Yii::app()->request->getParam('uid');
		$source = Yii::app()->request->getParam('source');
		$ac = Yii::app()->request->getParam('ac','');
		$money = Yii::app()->request->getParam('money');
		if(self::ACTIVITY_REDIRECT){
			$parms = '?uid='.$userid.'&source='.Yii::app()->request->getParam('source').'&clienttype='.Yii::app()->request->getParam('clienttype');
			$this->redirect(self::ACTIVITY_REDIRECT_URL.$parms);
		}
		$browser = new Browser();
		$bt = $browser->isMobile()?'app':'web';
		
		$user = JceHelper::getUserInfo($userid);
		$user = $user?$user:$this->getEmptyJceObj('TUser');
		if(isset($_POST['sendmobile']) && $_POST['sendmobile']){
			// var_dump(Yii::app()->request->url);
			//发送班费卡短信

			//$activeidArr = ['e176581c6bd4494fbb85d90191bd1691', 'b210147e25664d7ba488ef606a66c50b', '719405286358407da0cc04f7bc95e03d'];
	        $activeidArr = ['1', '2', '3'];
			$money = JceHelper::getInvitedClassFeeCard($_POST['sendmobile'], $userid, $activeidArr);
			// mlog($money);
			$ac = $bt=='web' ? 'webac' : 'appac';
			// $money = 125;
			if($money['result']==0){
				$this->redirect(Yii::app()->request->url.'&money='.$money['amt'].'&ac='.$ac.'&mobile='.$_POST['sendmobile']);
			}else{
				if($money['result']==self::RES_GET_INVITED_CLASS_FEE_CARD_ALREADY_GET || $money['result']==self::RES_GET_INVITED_CLASS_FEE_CARD_PHONE_EXIST){
					$this->redirect(Yii::app()->createUrl('mobile/clafail').'?mobile='.$_POST['sendmobile'].'&state='.$money['result']);
				}else{
					Yii::app()->msg->postMsg('error', $money['msg'], 'app');
					$this->redirect(Yii::app()->request->url);
				}
			}
			
		}


		if(isset($_POST['recmobile']) && $_POST['recmobile']){
			//发送应用下载短信
			$result = JceHelper::sendSmsDownloadAddr($_POST['recmobile']);
			if($result==0){
				Yii::app()->msg->postMsg('success', '发送成功','app');
			}else{
				$errormsg = $result==self::RES_SEND_SMS_LOAD_APP_ADDRESS_SMS_TIMES?'该手机号今天已接收3次短信，无法接收更多':'发送失败';
				Yii::app()->msg->postMsg('error', $errormsg,'app');
			}
			$this->redirect(Yii::app()->request->url);
		}
		$this->renderPartial('invprize',array('ac'=>$ac,'bt'=>$bt,'user'=>$user,'money'=>$money));
	}

	/**
	 * 班班-领取班费卡失败页面
     * @param string $uid 用户id
	 */
	public function actionInvfail()
	{
		$mobile = Yii::app()->request->getParam('mobile');
		$ac = Yii::app()->request->getParam('ac','');
		$browser = new Browser();
		$bt = $browser->isMobile()?'app':'web';
		if(isset($_POST['recmobile']) && $_POST['recmobile']){
			//发送应用下载短信
			$result = JceHelper::sendSmsDownloadAddr($_POST['recmobile']);
			if($result==0){
				Yii::app()->msg->postMsg('success', '发送成功','app');
			}else{
				$errormsg = $result==self::RES_SEND_SMS_LOAD_APP_ADDRESS_SMS_TIMES?'该手机号今天已接收3次短信，无法接收更多':'发送失败';
				Yii::app()->msg->postMsg('error', $errormsg,'app');
			}
			$this->redirect(Yii::app()->request->url);
		}

		$this->renderPartial('invfail',array('ac'=>$ac,'bt'=>$bt,'mobile'=>$mobile));
	}
       
    public function actionClafail()
	{
		$mobile = Yii::app()->request->getParam('mobile');
        $state = Yii::app()->request->getParam('state');
		$ac = Yii::app()->request->getParam('ac','');
		$browser = new Browser();
		$bt = $browser->isMobile()?'app':'web';
		if(isset($_POST['recmobile']) && $_POST['recmobile']){
			//发送应用下载短信
			$result = JceHelper::sendSmsDownloadAddr($_POST['recmobile']);
			if($result==0){
				Yii::app()->msg->postMsg('success', '发送成功','app');
			}else{
				$errormsg = $result==self::RES_SEND_SMS_LOAD_APP_ADDRESS_SMS_TIMES?'该手机号今天已接收3次短信，无法接收更多':'发送失败';
				Yii::app()->msg->postMsg('error', $errormsg,'app');
			}
			$this->redirect(Yii::app()->request->url);
		}

		$this->renderPartial('clafail',array('ac'=>$ac,'bt'=>$bt,'mobile'=>$mobile,'state'=>$state));
	}

	/**
	 * 班班-邀请有礼-去看看
     * @param string $uid 用户id
	 */
	public function actionInvprizescan()
	{
		if(isset($_POST['recmobile']) && $_POST['recmobile']){
			// var_dump(Yii::app()->request->url);
			//发送应用下载短信
			$result = JceHelper::sendSmsDownloadAddr($_POST['recmobile']);
			if($result==0){
				Yii::app()->msg->postMsg('success', '发送成功','app');
			}else{
				$errormsg = $result==self::RES_SEND_SMS_LOAD_APP_ADDRESS_SMS_TIMES?'该手机号今天已接收3次短信，无法接收更多':'发送失败';
				Yii::app()->msg->postMsg('error', $errormsg,'app');
			}
			$this->redirect(Yii::app()->request->url);
		}
		$this->renderPartial('invprizescan');
	}

	/**
	 * 班班-邀请有礼-去看看
     * @param string $uid 用户id
	 */
	public function actionClassinvscan()
	{
		if(isset($_POST['recmobile']) && $_POST['recmobile']){
			// var_dump(Yii::app()->request->url);
			//发送应用下载短信
			$result = JceHelper::sendSmsDownloadAddr($_POST['recmobile']);
			if($result==0){
				Yii::app()->msg->postMsg('success', '发送成功','app');
			}else{
				$errormsg = $result==self::RES_SEND_SMS_LOAD_APP_ADDRESS_SMS_TIMES?'该手机号今天已接收3次短信，无法接收更多':'发送失败';
				Yii::app()->msg->postMsg('error', $errormsg,'app');
			}
			$this->redirect(Yii::app()->request->url);
		}
		$this->renderPartial('classinvscan');
	}

	/**
	 * 班班-班费卡规则
     * @param string $uid 用户id
	 */
	public function actionClassfeecardrule()
	{
		$this->renderPartial('classfeecardrule');
	}

	/**
	 * 班班-建班邀请
     * @param string $uid 用户id
	 */
	public function actionClassinv()
	{
		$classid = Yii::app()->request->getParam('classid');
		$userid = Yii::app()->request->getParam('uid');
		$source = Yii::app()->request->getParam('source');
		$role = Yii::app()->request->getParam('role');
		$ac = Yii::app()->request->getParam('ac');
		$browser = new Browser();
		$bt = $browser->isMobile()?'app':'web';
        $state = Yii::app()->request->getParam('state');
		
		$class = JceHelper::classInfo($classid);
		$class = $class?$class:$this->getEmptyJceObj('TClass');
		$user = JceHelper::getUserInfo($userid);
		$user = $user?$user:$this->getEmptyJceObj('TUser');
        $cache=Yii::app()->cache;
		if(isset($_POST['recmobile']) && $_POST['recmobile']){
            $ac = $bt=='web' ? 'webac' : 'appac';
			
            //发送班费卡
            $activeidArr = ['1', '2', '3'];       
            $money = JceHelper::getInvitedClassFeeCard($_POST['recmobile'],$userid,$activeidArr);

            $result = JceHelper::sendSmsDownloadAddr($_POST['recmobile']);
            $this->redirect(Yii::app()->request->url.'&state=result');
			
		}
		$this->renderPartial('classinv',array('class'=>$class,'user'=>$user,'role'=>$role,'bt'=>$bt,'ac'=>$ac,'state'=>$state));
	}

    /**
     * 班班-建班邀请
     * @param string $uid 用户id
     */
    public function actionClassinvaty()
    {
        $classid = Yii::app()->request->getParam('cid');
        $userid = Yii::app()->request->getParam('uid');
        $source = Yii::app()->request->getParam('source');
        $role = Yii::app()->request->getParam('role');
        $ac = Yii::app()->request->getParam('ac');
        $browser = new Browser();
        $bt = $browser->isMobile()?'app':'web';
        $state = Yii::app()->request->getParam('state');
        
        $class = JceHelper::classInfo($classid);
        $class = $class?$class:$this->getEmptyJceObj('TClass');
        $user = JceHelper::getUserInfo($userid);
        $user = $user?$user:$this->getEmptyJceObj('TUser');
        $cache=Yii::app()->cache;
        if(isset($_POST['recmobile']) && $_POST['recmobile']){
            $ac = $bt=='web' ? 'webac' : 'appac';
            
            //发送班费卡
            $activeidArr = ['1', '2', '3'];       
            $money = JceHelper::getInvitedClassFeeCard($_POST['recmobile'],$userid,$activeidArr);

            $result = JceHelper::sendSmsDownloadAddr($_POST['recmobile']);
            $this->redirect(Yii::app()->request->url.'&state=result');
            
        }
        $this->renderPartial('classinvaty',array('class'=>$class,'user'=>$user,'role'=>$role,'bt'=>$bt,'ac'=>$ac,'state'=>$state));
    }

	/**
	 * 班费预览页面（晒班费）
	 */
	public function actionCost_preview()
	{
	    $classid = Yii::app()->request->getParam('classid');
	    $uid = Yii::app()->request->getParam('uid');
	    $source = Yii::app()->request->getParam('source');
	    $ac = Yii::app()->request->getParam('ac');
	    $browser = new Browser();
		$bt = $browser->isMobile()?'app':'web';

	    $class = JceHelper::classInfo($classid);
	    $class = $class?$class:$this->getEmptyJceObj('TClass');
	    $user = JceHelper::getUserInfo($uid);
	    $user = $user?$user:$this->getEmptyJceObj('TUser');

	    $cidArr = array($classid);
	    $feeInfo = JceHelper::getClassFeeInfo($cidArr);

	    if(isset($_POST['recmobile']) && $_POST['recmobile']){
			// var_dump(Yii::app()->request->url);
			//发送应用下载短信
			$result = JceHelper::sendSmsDownloadAddr($_POST['recmobile']);
			if($result==0){
				Yii::app()->msg->postMsg('success', '发送成功','app');
			}else{
				$errormsg = $result==self::RES_SEND_SMS_LOAD_APP_ADDRESS_SMS_TIMES?'该手机号今天已接收3次短信，无法接收更多':'发送失败';
				Yii::app()->msg->postMsg('error', '发送失败','app');
			}
			$this->redirect(Yii::app()->request->url);
		}
	    $this->renderPartial('cost_preview', array('ac'=>$ac,'bt'=>$bt,'class'=>$class, 'feeInfo'=>$feeInfo,'user'=>$user));
	}

	/**
	 * 客户端-我-邀请有礼
     * @param string $uid 用户id
	 */
	public function actionAppinv()
	{
		$userid = Yii::app()->request->getParam('uid');
		$source = Yii::app()->request->getParam('source');
		if(self::ACTIVITY_REDIRECT){
			$parms = '?joinuid='.$userid.'&uid='.$userid.'&source='.Yii::app()->request->getParam('source').'&clienttype='.Yii::app()->request->getParam('clienttype');
			$this->redirect(self::ACTIVITY_REDIRECT_URL.$parms);
		}
		$this->renderPartial('appinv',array('uid'=>$userid));
	}

	/**
	 * 推荐有奖
     * @param string $uid 用户id
	 */
	public function actionInviteshare()
	{
		$uid = Yii::app()->request->getParam('uid','');
		$this->renderPartial('inviteshare');
	}

	/**
	 * 教师认证
     * @param string $uid 用户id
     * @param string $type 认证状态：0，未认证；1，待审核，2审核通过
	 */
	public function actionTeachercertify()
	{	
		$uid = Yii::app()->request->getParam('uid','');
		$type = Yii::app()->request->getParam('type',0);
		$user = JceHelper::getUserInfo($uid);
		$user = $user?$user:$this->getEmptyJceObj('TUser');
		if(is_object($user) && property_exists($user, 'teacherauth')){
			$type=$user->teacherauth;
		}
		$this->renderPartial('teachercertify',array('uid'=>$uid,'type'=>$type));
		// if(isset($_FILES['qnupload'])){
		// 	require_once(dirname(__FILE__).'/../extensions/qiniu/qiniuphp/io.php');
		// 	require_once(dirname(__FILE__)."/../extensions/qiniu/qiniuphp/rs.php");

		// 	$ext = pathinfo($_FILES['qnupload']['name'],PATHINFO_EXTENSION);
		// 	$bucket = STORAGE_QINNIU_BUCKET_TX;
		// 	$filename = 'teacherauth'.MainHelper::create_guid().'.'.$ext;
		// 	// Yii::log($filename,CLogger::LEVEL_ERROR,'Api.Test');
		// 	$accessKey = STORAGE_QINNIU_ACCESSKEY;
		// 	$secretKey = STORAGE_QINNIU_SECRETKEY;

		// 	Qiniu_SetKeys($accessKey, $secretKey);
		// 	$putPolicy = new Qiniu_RS_PutPolicy($bucket);
		// 	$upToken = $putPolicy->Token(null);
		// 	$putExtra = new Qiniu_PutExtra();
		// 	$putExtra->Crc32 = 1;
		// 	list($ret, $err) = Qiniu_PutFile($upToken, $filename, $_FILES['qnupload']['tmp_name'], $putExtra);
		// 	if ($err !== null) {//上传失败
		// 	    $this->redirect(Yii::app()->createUrl('mobile/teachercertify',array('uid'=>$uid)));
		// 	} else {//上传成功
		// 		//提交认证资料
		// 		$url = STORAGE_QINNIU_XIAOXIN_TX.$filename;
		// 		$result = JceHelper::applyAuthTeacher($uid,$url);
		// 		if($result){
		// 			$this->redirect(Yii::app()->createUrl('mobile/teachercertify',array('uid'=>$uid,'type'=>1)));
		// 		}else{
		// 			$this->redirect(Yii::app()->createUrl('mobile/teachercertify',array('uid'=>$uid)));
		// 		}
		// 	}
		// }
	}

	/**
	 * 话题分享页
     * @param string $uid 用户id
     * @param string $topicid 话题id
	 */
	public function actionTopic()
	{
		$uid = Yii::app()->request->getParam('uid','');
		$topicid = Yii::app()->request->getParam('topicid','');
		$topic = JceHelper::getTopicDetail($topicid);
		
		$topicInfo = $topic->zone;
		$topicPosts = $topic->msgs;
		$posts = array_slice($topicPosts,0,3);
		
		$browser = new Browser();
		$bt = $browser->isMobile()?'app':'web';
		
		$this->renderPartial('topic',array('uid'=>$uid,'topicid'=>$topicid,'topic'=>$topicInfo,'posts'=>$posts, 'bt'=>$bt));
	}

	/**
	 * 帖子分享页
     * @param string $uid 用户id
     * @param string $postid 话题id
	 */
	public function actionPosts()
	{
		$uid = Yii::app()->request->getParam('uid','');
		$postid = Yii::app()->request->getParam('postid','');
		$post = JceHelper::getPostDetail($postid,$uid);
        // mlog($post->content);
		$browser = new Browser();
		$bt = $browser->isMobile()?'app':'web';
		
		$this->renderPartial('posts', array('uid'=>$uid, 'postid'=>$postid, 'post'=>$post, 'bt'=>$bt));
	}
	
	public function actionGetgiftbypost()
	{
        $userid = Yii::app()->request->getParam('uid');
        $source = Yii::app()->request->getParam('source');
        $ac = Yii::app()->request->getParam('ac','');
        $browser = new Browser();
        $bt = $browser->isMobile()?'app':'web';
        if(isset($_POST['sendmobile']) && $_POST['sendmobile']){
			//发送班费卡短信
            $activeidArr = ['1', '2', '3'];
			$money = JceHelper::getInvitedClassFeeCard($_POST['sendmobile'], $userid, $activeidArr);
			$ac = $bt=='web' ? 'webac' : 'appac';
			if($money['result']==0){
				$this->redirect(Yii::app()->request->url.'&money='.$money['amt'].'&ac='.$ac.'&mobile='.$_POST['sendmobile']);
			}else{
				if($money['result']==self::RES_GET_INVITED_CLASS_FEE_CARD_ALREADY_GET || $money['result']==self::RES_GET_INVITED_CLASS_FEE_CARD_PHONE_EXIST){
					$this->redirect(Yii::app()->createUrl('mobile/invfail').'?mobile='.$_POST['sendmobile']);
				}else{
					Yii::app()->msg->postMsg('error', $money['msg'], 'app');
					$this->redirect(Yii::app()->request->url);
				}
			}
		}

		if(isset($_POST['recmobile']) && $_POST['recmobile']){
			// var_dump(Yii::app()->request->url);
			//发送应用下载短信
			$result = JceHelper::sendSmsDownloadAddr($_POST['recmobile']);
			if($result==0){
				Yii::app()->msg->postMsg('success', '发送成功','app');
			}else{
				$errormsg = $result==self::RES_SEND_SMS_LOAD_APP_ADDRESS_SMS_TIMES?'该手机号今天已接收3次短信，无法接收更多':'发送失败';
				Yii::app()->msg->postMsg('error', '发送失败','app');
			}
			$this->redirect(Yii::app()->request->url);
		}
		
        $this->renderPartial('getgiftbypost',array('bt'=>$bt,'ac'=>$ac, 'uid'=>$userid));
	}
	
	/**
	 * 我的青豆页面
	 */
	public function actionMy_petits()
	{	     
	    $uid = Yii::app()->request->getParam('uid');
	    $beans = 0;
	    $uname = '';
	    $user=JceHelper::getUserInfo($uid);
    	$user = $user?$user:$this->getEmptyJceObj('TUser');
    	$uname = $user->name;
	    if($uid){
    	    $beans = JceHelper::getBeanInfo($uid);
    	    $identity = Yii::app()->user->getCurrIdentity($uid);
	    }
	    $this->renderPartial('my_petits', array('uid'=>$uid, 'user'=>$user,'beans'=>$beans, 'uname'=>$uname, 'identity'=>$identity));   
	}
	
	/**
	 * 帮助页面
	 */
	public function actionHelp()
	{
	    $uid = Yii::app()->request->getParam('uid');
	    $this->renderPartial('help', array('uid'=>$uid));
	}
	
	/**
	 * 班费规则页面
	 */
	public function actionCost_help()
	{
	    $uid = Yii::app()->request->getParam('uid');
	    $user = JceHelper::getUserInfo($uid);
		$user = $user?$user:$this->getEmptyJceObj('TUser');
		$identity = Yii::app()->user->getCurrIdentity($uid);
	    $this->renderPartial('cost_help', array('uid'=>$uid,'user'=>$user,'identity'=>$identity));
	}
	
	/**
	 * 班费宣传页面
	 */
	public function actionCost_intro()
	{
	    $uid = Yii::app()->request->getParam('uid');
	    $this->renderPartial('cost_intro', array('uid'=>$uid));
	}
	
	/**
	 * 使用条款页面
	 */
	public function actionClause()
	{
	    $this->renderPartial('clause');
	}
	
	/**
	 * 手机端班费宣传页面
	 */
	public function actionPublicity()
	{
	    $this->renderPartial('publicity');
	}

	public function actionClassintro()
	{
		$classid = Yii::app()->request->getParam('classid');
		$userid = Yii::app()->request->getParam('uid');
		$role = Yii::app()->request->getParam('role');
		$browser = new Browser();
		if(!$browser->isMobile()){
			$this->redirect(Yii::app()->createUrl('share/classintro',array('classid'=>$classid,'uid'=>$userid,'role'=>$role)));
		}
		$class = MClass::model()->findByPk($classid);

		if(!$class){
			$class = new MClass;
		}
		$user = Member::model()->findByPk($userid);
		if(!$user){
			$user = new Member;
		}
		$this->renderPartial('classintro',array('class'=>$class,'user'=>$user,'role'=>$role));
	}

	public function getEmptyJceObj($name)
	{
		$obj = new $name;
		$obj = Jcehelper::parseJceObj($obj);
		return $obj;
	}
}
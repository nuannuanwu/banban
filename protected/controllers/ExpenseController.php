<?php

class ExpenseController extends Controller
{

    const PAGE_NUM = 50;
    
	/**
     * @return array action filters
     */
    public function filters()
    {
        return array(
            'accessControl', // perform access control for CRUD operations
            // 'InlineIdentity',
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
                'actions' => array('test','testaa','expdetailajax','add', 'exprules', 'pay','query', 'preview','paytest', 'testnotice', 'rules'),
                'users' => array('*'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('send', 'index', 'expdetail', 'transfer', 'share','transfercard'),
                // 'roles' => array('teacher',),
                'users' => array('@'),
                //'expression'=>array($this,'loginAndNotDeleted'),
            ),

            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

	public function actionSend()
	{
		 $this->renderPartial('send');
	}
	
	public function actionTestnotice()
	{
	    $detail = TenpayDetail::model()->findByPk(59);
	    TenpayRecord::sendClassNotice($detail);
	}

	public function getCardTransInfo()
	{
		$uid = Yii::app()->user->id;
		$cardlist=JceClassFee::getClassFeeCard($uid,0,1);
		$amt = sprintf('%0.2f', $cardlist['amount']/100);
		$clickable = $amt>=50?true:false;
		$isInWhiteList = JceHelper::queryWhiteList($uid);
		$info = ['enable'=>$isInWhiteList,'amt'=>$amt,'clickable'=>$clickable];
		return $info;
	}

	public function actionTransfercard()
	{
	    $userid = Yii::app()->user->id;
        $instance=Yii::app()->user->getInstance();
        $transferInfo = $this->getCardTransInfo();
        if(!$transferInfo['enable'] || !$transferInfo['clickable']){
            $redirectUrl = Yii::app()->createUrl('expense/index/');
            Yii::app()->msg->postMsg('failed', '转出失败！');
            $this->redirect($redirectUrl);
            exit();
        }

		if(isset($_POST['Tenpay'])){
		    $tenpay = $_POST['Tenpay'];
		    $amt = round($transferInfo['amt']*100);
		    $mobile = Yii::app()->user->getInstance()->mobilephone;
		    $uname = Yii::app()->user->getRealName();   	
			
			$transaction = Yii::app()->db_xiaoxin->beginTransaction();
			try {
			    $timestr = TenpayHelper::microtime_format("YmdHisx",TenpayHelper::microtime_float());
			    $cu = 'FCT'.mt_rand(0,1000) . $userid;
			    if(strlen($cu) > 13){
			        $cu = substr($cu, 0, 13);
			    }
			    $package = $cu . $timestr;;
			    	
			    $record = new TenpayRecord;
			    $record->package = $package;
			    $record->count = 1;
			    $record->amount = $amt;
			    $record->transtype = 1;
			    $record->ban = 1;
			    if($record->save()){
			        $detail = new TenpayDetail;
			        $detail->package = $package;
			        $detail->cid = 0;
			        $detail->userid = $userid;
			        $detail->ordernum = 0;
			        $detail->serial = MainHelper::generate_code(6) . TenpayHelper::microtime_format("YmdHisx",TenpayHelper::microtime_float());
			        $detail->bankacc = str_replace(" ", "", $tenpay['rec_bankacc']);
			        $detail->banktype = $tenpay['bank_type'];
			        $detail->recname = $tenpay['rec_name'];
			        $detail->idcard = $tenpay['idcard'];
			        $detail->acctype = 1;
			        $detail->payamt = $amt;
			        $detail->area = $tenpay['area'];
			        $detail->city = $tenpay['city'];
			        $detail->subbankname = $tenpay['subbank_name'];
			        $detail->recmobile = $mobile;
			        $detail->paydesc = $tenpay['desc'];
			        $detail->transtype = 1;
			        $detail->ban = 1;
			         
			        if($detail->save()){
			            $transaction->commit();
			        }else{
			            //日志
			            $errmsg = "\n";
			            foreach($detail->errors as $dk=>$dv){
			            	$errmsg .= $dk . ':' . $dv[0] . "\n";
			            }
			            Yii::log($errmsg,CLogger::LEVEL_ERROR,'Tenpay.detail');
			        }
			    }else{
			        //日志
			        $errmsg = "\n";
		            foreach($record->errors as $rk=>$rv){
		            	$errmsg .= $rk . ':' . $rv[0] . "\n";
		            }
		            Yii::log($errmsg,CLogger::LEVEL_ERROR,'Tenpay.record');
			    }
			} catch (Exception $e) {
			    $transaction->rollback();
			    $this->render('transfercard', array('transferInfo'=>$transferInfo, 'authority'=>1, 'tenpay'=>$tenpay, 'transRst'=>'2', 'totalFee'=>$transferInfo['amt']));
			    exit;
			}
			// var_dump($record);
			// mlog($detail);
			if(!$record->isNewRecord && !$detail->isNewRecord){
			    $draw = JceHelper::transferClassFeeCard($userid,$uname,$type=0);
			}else{
			    $draw = false;
			}
			if($draw && $draw['iRet']==0 && $draw['lOrderNum']){
			    $record->ban = 0;
			    $record->save();
			    $detail->ban = 0;
			    $detail->ordernum = $draw['lOrderNum'];
			    $detail->save();

			    TenpayFeecard::addTransRecord($package,$userid); //OMS写入个人班费卡转出扩展表
			    Yii::app()->msg->postMsg('success', '转出成功');
                $this->redirect("/expense/index/");
	            exit;
			}else{
			    $errorMsg = isset($draw['strMsg'])?$draw['strMsg']:'';
			    $transRst = 2;
			    if($draw && $draw['iRet']){
			    	Yii::app()->msg->postMsg('failed', $errorMsg);
			    }
			    $this->render('transfercard', array('transferInfo'=>$transferInfo, 'authority'=>$authority, 'tenpay'=>$tenpay, 'transRst'=>$transRst, 'totalFee'=>$transferInfo['amt'],'errorMsg'=>$errorMsg));
			    exit;
			}
		} 
  		
  		$prevInfo = TenpayDetail::getPrevInfo($userid);
  		$prevcitys = [];
  		if($prevInfo && isset($prevInfo->city)){
  		    $citys = TenpayHelper::getCitys();
  		    $prevcitys = $citys[$prevInfo->area];
  		}
  		
	    $this->render('transfercard', array('transferInfo'=>$transferInfo, 'authority'=>1, 'totalFee'=>$transferInfo['amt'], 'previnfo'=>$prevInfo, 'prevcitys'=>$prevcitys));
	}

	public function actionIndex()
	{	
		$userid = Yii::app()->user->id;
		$uname = Yii::app()->user->getRealName();
        // mlog(JceHelper::transferClassFeeCard($userid,$uname,$type=0));
        
        // JceHelper::transferClassFeeCardRollBack(3,20000,$userid);
        // mlog(JceHelper::getClassFeeCardDetail($userid));

		$transInfo = $this->getCardTransInfo();
        $category_arr=array(1=>'普通卡',2=>'活动卡',0=>'其它卡');
        $page=(int)Yii::app()->request->getParam("page",1);
        $currentPage=(int)Yii::app()->request->getParam("currentPage",1);
        $next=trim(Yii::app()->request->getParam("next",'2'));
        $total=(int)Yii::app()->request->getParam("total",'0');
	    $uid = Yii::app()->user->id;
        $alluseArr=array();
        $minIndex=0;
        if($page<=1){
            $cardlist=JceClassFee::getClassFeeCard($uid,0,1);
            $usableCards_tmp=isset($cardlist['use'])?$cardlist['use']:array();;
            if(!empty($usableCards_tmp)){
                $minIndex=$usableCards_tmp[count($usableCards_tmp)-1]['index'];
            }
            //D($cardlist);
            $unusableCards=isset($cardlist['unuse'])?$cardlist['unuse']:array();;
            $total=isset($cardlist['total'])?$cardlist['total']:0;
            if($total>100){
                $alluseArr=$usableCards_tmp;
                $requestNum=ceil($total/100)-1;
                $i=0;
                while($i<$requestNum){
                    $cardlist=JceClassFee::getClassFeeCard($uid,$minIndex-1,2);
                    $usableCards_tmp=isset($cardlist['use'])?$cardlist['use']:array();;
                    if(!empty($usableCards_tmp)){
                        $minIndex=$usableCards_tmp[count($usableCards_tmp)-1]['index'];
                        $alluseArr=array_merge($alluseArr,$usableCards_tmp);
                    }
                    $i++;
                }
            }else{
                $alluseArr=$usableCards_tmp;
            }
            Yii::app()->cache->set($uid."classfeecard",$alluseArr,180);
            Yii::app()->cache->set($uid."classfeecardunuse",$unusableCards,180);
        }else{
            $alluseArr=Yii::app()->cache->get($uid."classfeecard");
            if(!is_array($alluseArr)){
                $alluseArr=array();
            }
            if(is_array($alluseArr)){
                $total=count($alluseArr);
            }
            $unusableCards=Yii::app()->cache->get($uid."classfeecardunuse");
            if(!is_array($unusableCards)){
                $unusableCards=array();
            }

        }
        $data = UCQuery::PageData($alluseArr, $page);
        $usableCards=isset($data['datas'])?($data['datas']):array();
        $pager=$data['pager'];

       // $unusableCards=array();

       // $unusableCards=isset($cardlist['unuse'])?$cardlist['unuse']:array();;
        $unusableCards=is_array($unusableCards)?array_slice($unusableCards,0,10):array();

        $totalPage=ceil($total/10);
		$this->render('index', array('total'=>$total,'totalPage'=>$totalPage,'pager'=>$pager,'currentPage'=>$currentPage,'page'=>$page,'usableCards'=>$usableCards,'unusableCards'=>$unusableCards,'category_arr'=>$category_arr,'transInfo'=>$transInfo));
	}

	
    public function actionAdd(){
       // echo 3600*24*24;
        JceClassFee::addClassFeeCard(array('uid'=>Yii::app()->user->id,'name'=>'班费卡','money'=>(int)(rand(1,20)*100),'endtime'=>3600*24*1,'category'=>1));
    }

    public function transCheck($isMaster,$instance,$cid)
    {
    	$userid = Yii::app()->user->id;
    	$transferCheck = array('msg'=>'');
        if($isMaster){
        	$transferCheck['showbutton'] = true;

        	$isBlack = FeeBlack::checkInFeeBlack($cid);
	    	if($isBlack){//黑名单检测
	    		$transferCheck['enable'] = false;
    			$transferCheck['msg'] = '亲爱的老师，么么哒，为防止恶意刷班费的行为“拐”走咱们的班费，班班在每天中午12点发放1000个提现名额，今天的名额已被抢光啦~ 请明天再试试吧~';
    			return $transferCheck;
	    	}
        	if($instance->teacherauth==2){
        		if(TenpayLimit::getUserMonthHistory($userid)){//每个老师每月只能提现一次
        			$transferCheck['enable'] = false;
        			$transferCheck['msg'] = '亲，为了防止刷班费行为，维护一个公平的环境，班费每月只能提现一次哦，你这个月已经提现过班费啦~~';
        			return $transferCheck;
        		}
        		$isTopLine = JceClassFee::checkPullNewClass($userid,$cid);
        		if($isTopLine){//班费免排队
        			$transferCheck['enable'] = true;
        			return $transferCheck;
        		}
        		$hour = (int)date('H',time());
     			if($hour<12 || TenpayLimit::checkIsOutTransMonthAmt()){//全平台每日限制5000元
     				$transferCheck['enable'] = false;
        			$transferCheck['msg'] = '亲爱的老师，么么哒，为防止恶意刷班费的行为“拐”走咱们的班费，班班在每天中午12点发放1000个提现名额，今天的名额已被抢光啦~ 请明天再试试吧~';
        			return $transferCheck;
     			}
        		$transferCheck['enable'] = true;
        		return $transferCheck;
        	}else{
        		$transferCheck['enable'] = false;
        		$transferCheck['msg'] = '您还未完成“教师认证”，不能转出班费。请先在手机应用客户端上完成“教师认证”。';
        		return $transferCheck;
        	}
        }else{
        	$transferCheck['showbutton'] = false;
        	return $transferCheck;
        }
    }
	
	public function actionExpdetail($id){
	    
	    $userid = Yii::app()->user->id;
	    $authority = Yii::app()->request->getParam('authority');
	    $from = Yii::app()->request->getParam('from');
	    $identity = Yii::app()->user->getCurrIdentity();
	    $cidArr = array($id);
	    $showNext = false;
	    
 	    $class = JceClass::classInfo($id, $authority);
        $isMaster=$class->masterUid==$userid?true:false;
        $instance=Yii::app()->user->getInstance();

        $transferCheck = $this->transCheck($isMaster,$instance,$id);
        $isPopup = Yii::app()->request->getParam('popup');
        if($isPopup=='popup'){
        	$transferCheck['msg'] = $transferCheck['msg']?$transferCheck['msg']:'亲爱的老师，么么哒，为防止恶意刷班费的行为“拐”走咱们的班费，班班在每天中午12点发放1000个提现名额，今天的名额已被抢光啦~ 请明天再试试吧~';
        }

	    $feeInfo = JceHelper::getClassFeeInfo($cidArr); 
	    
	    $feeDetail = JceHelper::getClassFeeDetail($id, 0, 2, self::PAGE_NUM);
	    $feeDetailFinal = array();
	    if(count($feeDetail) && $feeDetail){	        
	        foreach ($feeDetail as $fee){
	            $paydesc = '';
	            $detail = TenpayDetail::model()->findByAttributes(array('cid'=>$id, 'ordernum'=>$fee['lOrderNum']));
	            if(!empty($detail)){
	                $paydesc = $detail['paydesc'];	                
	            }
	            $fee['paydesc'] = $paydesc;
	            $feeDetailFinal[] = $fee;
	        }
	    }
	    
	    $lastOrderNum = count($feeDetail) ? $feeDetail[count($feeDetail)-1]['lOrderNum'] : 0;
	    if(count($feeDetail) == self::PAGE_NUM) $showNext = true;
	    
	    $this->render('expdetail', array('instance'=>$instance,'feeInfo'=>$feeInfo, 'isMaster'=>$isMaster,'from'=>$from,'class'=>$class, 'feedetail'=>$feeDetailFinal, 'lastOrderNum'=>$lastOrderNum, 'showNext'=>$showNext,'transferCheck'=>$transferCheck));
	     
	}
	
	public function actionExpdetailajax($id){
	    
	    $showNext = false;
	    
	    $lastOrderNum = Yii::app()->request->getParam('order') ? Yii::app()->request->getParam('order') : 0;
	    $driect = Yii::app()->request->getParam('driect') ? Yii::app()->request->getParam('driect') : 2;
	    
	    $feeDetail = JceHelper::getClassFeeDetail($id, $lastOrderNum, $driect, self::PAGE_NUM);
	    
	    $arr = array('status' => 0);
	    if(count($feeDetail) && $feeDetail){
	        if(count($feeDetail) == self::PAGE_NUM) $showNext = true;
	        $arr['showNext'] = $showNext; 
	        $arr['status'] = 1;
	        $lastOrderNum = $feeDetail[count($feeDetail)-1]['lOrderNum'];
 	        $arr['lastorder'] = $lastOrderNum; 	        
	        $feeDetailFinal = array();
	        foreach ($feeDetail as $item){
	            $detail = TenpayDetail::model()->findByAttributes(array('cid'=>$id, 'ordernum'=>$item['lOrderNum']));
	            if(!empty($detail)){
	                $item['evnetstr'] = str_replace(array($item['strName'],')','('),array('','',''),$item['sEventName']) . ' （' . $detail['paydesc'] . '）';
	            }else{
	                $item['evnetstr'] = str_replace(array($item['strName'],')','('),array('','',''),$item['sEventName']);
	            }
	            
	            $item['timestr'] = date('Y/m/d H:i',$item['timestamp']);
	            if($item['sEventID'] != ClassFeeEventID::EVENT_DEPOSIT&&$item['sEventID'] != ClassFeeEventID::EVENT_SENDNOTICE){
	                $item['moneystr'] = '<span class="green">+ ' . sprintf('￥%0.2f',$item['dValue']) . '</span>';
	            }else{
	                $item['moneystr'] = '<span class="red">- ' . sprintf('￥%0.2f',$item['dValue']) . '</span>';
	            }
	            
	            $feeDetailFinal[] = $item;
	        }
	        $arr['detail'] = $feeDetailFinal;   
	    }
	    echo json_encode($arr);
	
	}
	
	
	public function actionTransfer()
	{
	    $userid = Yii::app()->user->id;
	    $cid = Yii::app()->request->getParam('cid');
	    $totalFee = Yii::app()->request->getParam('totalFeeHidden');
	    $totalFee = $totalFee > 0 ? $totalFee : 0;
	    $identity = Yii::app()->user->getCurrIdentity();
	    $authority = Yii::app()->request->getParam('authority');

        if(!$cid){
            Yii::app()->msg->postMsg('failed', '请选择正确的班级!');
            $this->redirect('index');
        }

        $instance=Yii::app()->user->getInstance();
        $transferCheck = $this->transCheck(true,$instance,$cid);
        if(!$transferCheck['enable']){
            $redirectUrl = Yii::app()->createUrl('expense/expdetail/'.$cid,array('authority'=>$authority,'from'=>'students','popup'=>'popup'));
            $this->redirect($redirectUrl);
            exit();
        }

		if(isset($_POST['Tenpay'])){
		    $tenpay = $_POST['Tenpay'];
		    $amt = round($tenpay['pay_amt']*100);
		    $cid = $tenpay['cid'];

		    //state for chengdu while amt gt than 400
		    $isTopLine = JceClassFee::checkPullNewClass($userid,$cid);//except privilege user
		    if(!$isTopLine){
		    	$checkAmt = $this->checkTransAmt($cid,$amt);
		        if(!$checkAmt['enable']){
		        	$redirectUrl = Yii::app()->createUrl('expense/expdetail/'.$cid,array('authority'=>$authority,'from'=>'students','popup'=>'popup'));
		        	$this->redirect($redirectUrl);
		        }
		    }
		    

		    $mobile = Yii::app()->user->getInstance()->mobilephone;
		    $uname = Yii::app()->user->getRealName();   	
			
			$transaction = Yii::app()->db_xiaoxin->beginTransaction();
			try {
			    $timestr = TenpayHelper::microtime_format("YmdHisx",TenpayHelper::microtime_float());
			    $cu = $cid . $userid;
			    if(strlen($cu) > 13){
			        $cu = substr($cu, 0, 13);
			    }
			    $package = $cu . $timestr;
			    	
			    $record = new TenpayRecord;
			    $record->package = $package;
			    $record->count = 1;
			    $record->amount = $amt;
			    $record->ban = 1;
			    if($record->save()){
			        $detail = new TenpayDetail;
			        $detail->package = $package;
			        $detail->cid = $cid;
			        $detail->userid = $userid;
			        $detail->ordernum = 0;
			        $detail->serial = MainHelper::generate_code(6) . TenpayHelper::microtime_format("YmdHisx",TenpayHelper::microtime_float());
			        $detail->bankacc = str_replace(" ", "", $tenpay['rec_bankacc']);
			        $detail->banktype = $tenpay['bank_type'];
			        $detail->recname = $tenpay['rec_name'];
			        $detail->idcard = $tenpay['idcard'];
			        $detail->acctype = 1;
			        $detail->payamt = $amt;
			        $detail->area = $tenpay['area'];
			        $detail->city = $tenpay['city'];
			        $detail->subbankname = $tenpay['subbank_name'];
			        $detail->recmobile = $mobile;
			        $detail->paydesc = $tenpay['desc'];
			        $detail->ban = 1;
			         
			        if($detail->save()){
			            $transaction->commit();
			        }else{
			            //日志
			            $errmsg = "\n";
			            foreach($detail->errors as $dk=>$dv){
			            	$errmsg .= $dk . ':' . $dv[0] . "\n";
			            }
			            Yii::log($errmsg,CLogger::LEVEL_ERROR,'Tenpay.detail');
			        }
			    }else{
			        //日志
			        $errmsg = "\n";
		            foreach($record->errors as $rk=>$rv){
		            	$errmsg .= $rk . ':' . $rv[0] . "\n";
		            }
		            Yii::log($errmsg,CLogger::LEVEL_ERROR,'Tenpay.record');
			    }
			} catch (Exception $e) {
			    $transaction->rollback();
			    $this->render('transfer', array('cid'=>$cid, 'authority'=>$authority, 'tenpay'=>$tenpay, 'transRst'=>'2', 'totalFee'=>$totalFee));
			    exit;
			}
			
			if(!$record->isNewRecord && !$detail->isNewRecord){
			     $draw = JceHelper::transferClassFee($userid,$cid,$amt,$uname);
			}else{
			    $draw = false;
			}
			if($draw && $draw['iRet']==0 && $draw['lOrderNum']){
			    $record->ban = 0;
			    $record->save();
			    $detail->ban = 0;
			    $detail->ordernum = $draw['lOrderNum'];
			    $detail->save();

			    TenpayLimit::setRecordLimit($detail);//班费转出限制日志

			    TenpayVerify::addAuditRecord($package, [$cid]); //添加审核记录
			    
			    $totalFee = $totalFee - $tenpay['pay_amt'];
	            $totalFee = sprintf('%.2f', $totalFee);
                $this->redirect("/expense/expdetail/".$cid."?authority=".$authority."&from=students");
	            exit;
			}else{
			    $errorMsg = isset($draw['strMsg'])?$draw['strMsg']:'';
			    $transRst = 2;
			    if($draw && $draw['iRet'] == ClassFeeStatus::RES_CLASS_FEE_INSUFFICIENT_BALANCE){
			        $transRst = 4;
			    }else if($draw && $draw['iRet'] == ClassFeeStatus::RES_CLASS_FEE_BALANCE_LOWER_FIRST_TRANSFER_LIMIT){
			        $transRst = 3;
			    }else if($draw && $draw['iRet'] == ClassFeeStatus::RES_CLASS_FEE_BALANCE_LOWER_NORMAL_TRANSFER_LIMIT){
			        $transRst = 5;
			    }else if($draw && $draw['iRet'] == ClassFeeStatus::RES_CLASS_FEE_TRANSFER_OUT_OF_UPPER_LIMIT){
			        $transRst = 6;
			    }
			    $this->render('transfer', array('cid'=>$cid, 'authority'=>$authority, 'tenpay'=>$tenpay, 'transRst'=>$transRst, 'totalFee'=>$totalFee,'errorMsg'=>$errorMsg));
			    exit;
			}
		} 
		
		//班费余额
		$feeInfo = JceHelper::getClassFeeInfo(array($cid)); 
  		$totalFee = sprintf('%.2f',$feeInfo[0]['dBalance']);
  		
  		$prevInfo = TenpayDetail::getPrevInfo($userid);
  		$prevcitys = [];
  		if($prevInfo && isset($prevInfo->city)){
  		    $citys = TenpayHelper::getCitys();
  		    $prevcitys = $citys[$prevInfo->area];
  		}
  		
	    $this->render('transfer', array('cid'=>$cid, 'authority'=>$authority, 'totalFee'=>$totalFee, 'previnfo'=>$prevInfo, 'prevcitys'=>$prevcitys));
	}

	public function checkTransAmt($cid,$amt)
	{
		$result = array('enable'=>false,'count'=>false);
		if($amt<=40000){
			$result['enable'] = true;
		}else{
			$sql = "SELECT a.aid,a.parentid FROM tb_class c, tb_school s, tb_area a WHERE c.sid=s.sid AND s.aid=a.aid AND c.cid=".$cid;
			$areas = UCQuery::queryRow($sql);
			if($areas->aid==510100 || $areas->parentid==510100){
                $key="chengdutranscount".date('Y-m-d');
				$count = Yii::app()->cache->get($key);
				if($count && $count>=2){
					$result['enable'] = false;
				}else{
					$result['enable'] = true;
					$num = $count?($count+1):1;
					Yii::app()->cache->set($key,$num);
				}
			}else{
                $result['enable'] = true;
            }
		}
		return $result;
	}
	
	public function actionExprules()
	{
	    $this->render('rules');
	}

    public function actionRules()
    {
        $this->render('rules');
    }
	
	public function actionPay()
	{
		$packid = Yii::app()->request->getParam('pid','');
		$records = array(
            array(
            	'serial'=>1,
                'rec_bankacc'=>'6225887811111111', 
                'bank_type'=>1001,
                'rec_name'=>'张三',
                'pay_amt'=>1,
                'acc_type'=>1,
                'area'=>20,
                'city'=>775,
                'subbank_name'=> '招商银行深圳泰然金谷支行',
                'desc'=>'0', 
                'recv_mobile'=>'13631511111',
            ),
            // array(
            // 	'serial'=>2,
            //     'rec_bankacc'=>'6225887822222222', 
            //     'bank_type'=>1001,
            //     'rec_name'=>'李四',
            //     'pay_amt'=>2,
            //     'acc_type'=>1,
            //     'area'=>20,
            //     'city'=>775,
            //     'subbank_name'=> '招商银行深圳泰然金谷支行',
            //     'desc'=>'代付测试', 
            //     'recv_mobile'=>'13631522222',
            // ),
        );
		TenpayHelper::payTransfer($packid,$records,1,1);
		exit;
	}

	public function actionQuery()
	{
		$packid = Yii::app()->request->getParam('pid');
		TenpayHelper::queryTransfer($packid);
		exit;
	}

	public function actionPaytest()
	{
		$packid = Yii::app()->request->getParam('pid');
		$sid = Yii::app()->request->getParam('sid');
		$tstate = Yii::app()->request->getParam('tstate', 6);
		$record = TenpayRecord::model()->findByPk($packid);
		$data =array();
        $data['trade_state'] = $tstate;
        $data['succ_count'] = 1;
        $data['succ_fee'] = 1;
        $data['fail_count'] = 0;
        $data['fail_fee'] = 0; 

        $record->tradestate = $data['trade_state'];
        $record->succount = $data['succ_count'];
        $record->succfee = $data['succ_fee'];
        $record->failcount = $data['fail_count'];
        $record->failfee = $data['fail_fee'];
        $detail = TenpayDetail::getTenpayDetailByAttrs($packid,$sid);
        
        if(in_array($data['trade_state'], array(4,6,7))){
            
            //给班级成员发通知
            TenpayRecord::sendClassNotice($detail);
            
            $mobile = $detail->recmobile;
    		$outMoney = sprintf('%0.2f', $detail->payamt/100);
    		$msg = '尊敬的班班用户您好，您成功转出班费'. $outMoney .'元，班费已转账到您尾号为'.substr($detail->bankacc, -4).'的银行卡中。';
    		
    		UCQuery::sendMobileMsg($mobile,$msg,Constant::SMS_CLASSFEE_ROLLOUT);
        }
        
        $record->state = 1;
        $record->save();
        var_dump($record->errors);
        exit;

		$records = TenpayRecord::getNeedDealTenpays();		
        foreach($records as $record){
            if($record->paystate==0){//尚未调用代付提交接口则发起调用请求
                //调用代付提交接口收到财付通返回状态（0：失败，1：成功）并更改状态
                $recordsArr = $record->setTenpayDetailsToRecords();
                $paystate = TenpayHelper::payTransfer($record,$recordsArr);
                if($paystate){//调用成功
                    $record->paystate = 1;
                    $record->save();
                }else{//调用失败
                    $errorcount = $record->payreqcount + 1;
                    if($errorcount>=3){
                        $record->state = 2;
                    }
                    $record->payreqcount += 1;
                    $record->save();
                }

            }else{//调用代付提交接口成功则调用代付查询接口返回银行代付的处理结果
                $result = TenpayHelper::queryTransfer($record->package);
                if($result){//查询接口返回银行代付的处理结果成功
                    $data = TenpayHelper::xml_to_array($result['result']);
                    echo "<pre>";print_r($data);
                    //只有返回最终态才设置批次状态（4，6，7）
                    //$data = TenpayHelper::getTenpayTestData(); //测试模拟数据
                    
                    $record->tradestate = $data['trade_state'];
                    $record->succount = $data['succ_count'];
                    $record->succfee = $data['succ_fee'];
                    $record->failcount = $data['fail_count'];
                    $record->failfee = $data['fail_fee'];

                    if($data['trade_state']==6){//银行处理完成（最终态）
                        $record->setTenpayQueryResult($data);
                        $record->state = 1;
                        $record->save();
                    }elseif($data['trade_state']==4 || $data['trade_state']==7){//整个批次都是失败（最终态）
                        $record->setTenpayQueryResult($data);
                        $record->state = 1;
                        $record->save();
                    }else{//处理中（中间态）
                        $record->setTenpayQueryResult($data);
                    }
                }else{//查询接口返回银行代付的处理结果失败
                    $record->queryfailtime = date("Y-m-d H:i:s",time());
                   $record->save();
                }
            }
        }
	}
	
	public function actionPreview()
	{
	    $classid = Yii::app()->request->getParam('classid');
	    $uid = Yii::app()->request->getParam('uid');
	    $source = Yii::app()->request->getParam('source');
	    $clienttype = Yii::app()->request->getParam('clienttype');
	    $this->renderPartial('preview', array('classid'=>$classid, 'uid'=>$uid, 'source'=>$source, 'clienttype'=>$clienttype));
	    
	}
	
	public function actionShare()
	{
	    $cid = Yii::app()->request->getParam('cid');
	    
	    $this->render('share', array('cid'=>$cid));
	}

    /*
    * 判断老师是否是班主任
    */
    public function checkIsMaster($uid,$cid,$teachers=null){
        if(is_array($teachers)){

        }else{
            $teachers=JceClass::getClassMember($cid,1);
        }
        $isMaster=false;
        foreach($teachers as $val){
            if($val->uid==$uid&&$val->type==1){
                $isMaster=true;
                break;
            }
        }
        return $isMaster;
    }

    public function actionTestaa(){
        $checkAmt = $this->checkTransAmt(292,51000);

    }



}
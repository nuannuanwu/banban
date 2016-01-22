<?php
// error_reporting(0);
class TestController extends Controller
{
	/*
	增加班费卡，提供给测试用
	category 0，未知，1，普通卡，2，活动卡
	 */
	public function actionAddclassfeecard()
	{    
		$parms = array();
		$parms['uid'] = Yii::app()->user->id;
		if(!$parms['uid']){
			mlog('请先登录！！');
		}
		$parms['name'] = Yii::app()->request->getParam('name');
		$parms['category'] = Yii::app()->request->getParam('type');
		$parms['money'] = Yii::app()->request->getParam('money');
		$parms['endtime'] = Yii::app()->request->getParam('endtime');
		$parms['endtime'] = $parms['endtime']?strtotime($parms['endtime']):time();
		$result = JceHelper::addClassFeeCard($parms);
		if($result){
			mlog('增加班费卡成功');
		}else{
			mlog('增加班费卡失败');
		}
	}

	public function actionIndex()
	{
	    $cid = ['528408564'];
	    $feeInfo = JceHelper::getClassFeeInfo($cid);
	    $balance = sprintf("%.2f", $feeInfo[0]['dBalance']);
	    
	    $audit = new TenpayVerify();
	    $audit->package = 'sssssss';
	    $audit->balance = $balance * 100;
	    $audit->applydate = date('Y-m-d H:i:s');
	    //$audit->save();
	    conlog($audit->errors);
	    exit;
		$py = new py_class();
		$city = file_get_contents("city.json");
		
		$city = json_decode($city,true);
		$citys = $city['citys'];

		$newcity = array();
	
		foreach($citys as $c){
			$arr = $c;
			$name = str_split($arr['name'],3); 
			$arr['firstletter'] = '';
			foreach($name as $n){
				$arr['firstletter'].=strtoupper(substr($py->str2py(trim($n)),0,1));
			}
			// mlog($arr['name']);
			// $arr['firstletter'] = strtoupper(substr($arr['pinyin'],0,1));
			// $newcity[] = $arr;
			array_push($newcity, $arr);
		}
		$result = array();
		$result['citys'] = $newcity;
		// conlog($result);
		file_put_contents('newcity.json',json_encode($result));
		// conlog(json_encode($result));
	}

	public function actionQiniu()
	{
		var_dump($_FILES);
		if(isset($_FILES['qnupload'])){
			// conlog(dirname(__FILE__));
			require_once(dirname(__FILE__).'/../extensions/qiniu/qiniuphp/io.php');
			require_once(dirname(__FILE__)."/../extensions/qiniu/qiniuphp/rs.php");

			$ext = pathinfo($_FILES['qnupload']['name'],PATHINFO_EXTENSION);
			$bucket = STORAGE_QINNIU_BUCKET_TX;
			$filename = 'teacherauth'.MainHelper::create_guid().'.'.$ext;
			$accessKey = STORAGE_QINNIU_ACCESSKEY;
			$secretKey = STORAGE_QINNIU_SECRETKEY;

			Qiniu_SetKeys($accessKey, $secretKey);
			$putPolicy = new Qiniu_RS_PutPolicy($bucket);
			$upToken = $putPolicy->Token(null);
			$putExtra = new Qiniu_PutExtra();
			$putExtra->Crc32 = 1;
			list($ret, $err) = Qiniu_PutFile($upToken, $filename, $_FILES['qnupload']['tmp_name'], $putExtra);
			echo "====> Qiniu_PutFile result: \n";
			if ($err !== null) {
			    var_dump($err);
			} else {
			    var_dump($ret);
			}
		}else{
			echo '<html><form enctype="multipart/form-data" id="business-form" action="" method="post"><input type="file" name="qnupload" /><input class="btn btn-primary" id="busbtn" type="submit" name="yt0" value="提交"></form></html>';
		}
	}

	public function actionTenpayquery(){
		$package = Yii::app()->request->getParam('package');
		$result = TenpayTest::queryTransfer($package);
		echo '<pre>';
		echo 'Query Response-------------------------------------------<br>';
		print_r($result);
	 	if($result){
            $data = TenpayHelper::xml_to_array($result['result']);
            echo 'Result-----------------------------------------------<br>';
			print_r($data);
		}
	}

	public function actionExpense()
	{
		$cmd = Yii::app()->request->getParam('cmd');
		$cid = Yii::app()->request->getParam('cid');
		$uid = Yii::app()->request->getParam('uid',Yii::app()->user->id);
		$fee = Yii::app()->request->getParam('fee',1);
		$order = Yii::app()->request->getParam('order');
		$ty = Yii::app()->request->getParam('ty', 0); 
		if($cmd==50){
			mlog(JceHelper::classFeeIncome($cid,$uid,1,date('YmdHis',time())));
		}
		if($cmd==51){
			conlog(JceHelper::getClassFeeInfo(array($cid)));
		}
		if($cmd==52){
			conlog(JceHelper::getClassFeeDetail($cid,0,2,10));
		}
		if($cmd==53){
			conlog(JceHelper::transferClassFee($uid,$cid,$fee,'微微',$ty));
		}
		if($cmd==54){
			mlog(JceHelper::transferClassFeeRollBack($cid,$order,$fee,$uid));
		}
	}

	public function actionRefund()
	{
		$result = TenpayTest::refundTransfer();
		echo '<pre>';
		echo 'result---------------------------------------------<br>';
		print_r($result);
		if($result){
			$refunds = TenpayTest::xml_to_array($result['cancel_set']);
		}else{
			$refunds = array('cancel_count'=>0,'cancel_rec'=>array());
		}
		echo 'refunds---------------------------------------------<br>';
		print_r($refunds);
		
		$refunds_rec = $refunds['cancel_count']>1?$refunds['cancel_rec']:array($refunds['cancel_rec']);

		foreach($refunds_rec as $refund){
			echo 'refund---------------------------------------------<br>';
			var_dump($refund);
			$package = isset($refund['package_id'])?$refund['package_id']:'';
			$serial = isset($refund['serial'])?$refund['serial']:'';
			$detail = TenpayDetail::getTenpayDetailByAttrs($package,$serial);
			echo '$detail->package---------------------------------------------<br>';
			var_dump($detail->package);
			if($detail && $detail->package && $detail->state==3 && $detail->refund==0){
                //短信通知
                $mobile = $detail->recmobile;
                $outMoney = sprintf('%0.2f', $detail->payamt/100);
                $outDate = date('Y年m月d号',strtotime($detail->modifytime));
                $msg = '尊敬的班班用户您好，非常抱歉的通知您，您于'.$outDate.'成功转出的'.$outMoney.'元班费，由于银行方面原因，已从银行账户退回至班费中，如有需要请重新转出班费。带来不便敬请谅解！如有疑问咨询4001013838。';
                var_dump($msg);
			}
		}
	}

	public function actionPhpinfo()
	{
		phpinfo();
		exit;
	}
	
	public function actionTestimg()
	{
	    $src = Yii::app()->request->baseUrl."img/images/002.jpg";
	    $image = Yii::app()->image->load($src);
	    $image->resize(400, 100)->rotate(-45)->quality(75)->sharpen(20);
	    $image->render(); // or $image->save('images/small.jpg');
	}

	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}
<?php

class RemoteController extends Controller
{
	public function actionIndex()
	{
		$this->render('index');
	}

	public function actionLogin()
	{
		$parms = Yii::app()->request->getParam('parms');
		$parms = unserialize($parms);
		$userid = $parms['userid'];
		$hash = $parms['hash'];
		$rt = $parms['rt'];
		if(!$userid || !$hash || !$rt){
			echo '<html><head><meta charset="UTF-8"></head>请求参数无效,请重新登录</html>';
            exit;
		}
		$key = 'oms_banban_remote';
		$now = time();
        $t = $now - (int)$rt;

        if ($t<30){
        	$pass = md5(md5($userid . $key . $rt));
            if ($hash == $pass) {
        		$user = JceHelper::getUserInfo($userid);
		        $identity = new RemoteUserIdentity($user);
		        Yii::app()->user->login($identity);
		        $this->redirect(Yii::app()->createUrl('site/login'));exit;
            }
        	echo '<html><head><meta charset="UTF-8"></head>请求数据已过期,请重新登录</html>';
            exit;
        }else {
            echo '<html><head><meta charset="UTF-8"></head>请求数据已过期,请重新登录</html>';
            exit;
        }
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
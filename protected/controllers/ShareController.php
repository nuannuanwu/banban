<?php

class ShareController extends Controller
{
	public function actionClassintro()
	{
		$classid = Yii::app()->request->getParam('classid');
		$userid = Yii::app()->request->getParam('uid');
		$role = Yii::app()->request->getParam('role');
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
 }
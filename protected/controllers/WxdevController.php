<?php

class WxdevController extends Controller
{
	public function actionIndex()
	{
		$this->render('index');
	}

	public function actionBabyface()
	{
            require_once('jssdk.php');
            $jssdk = new JSSDK("wxa3e0fee749ef9692", "9e8fde27018a7b702e90c87367d3164a");
            $signPackage = $jssdk->GetSignPackage();
            $this->renderPartial('babyface',array('signPackage'=>$signPackage));
	}

	public function actionFacelift()
	{ 
            require_once('jssdk.php');
            $jssdk = new JSSDK("wxa3e0fee749ef9692", "9e8fde27018a7b702e90c87367d3164a");
            $signPackage = $jssdk->GetSignPackage();
            $fn = Yii::app()->request->getParam("fn"); 
            $imgtype = Yii::app()->request->getParam("p"); 
            $this->renderPartial('facelift',array('fileNme'=>$fn,'imgtype'=>$imgtype,'signPackage'=>$signPackage));
	} 
       public function actionWxshaer()
	{
            require_once('jssdk.php');
            $jssdk = new JSSDK("wxa3e0fee749ef9692", "9e8fde27018a7b702e90c87367d3164a");
            $signPackage = $jssdk->GetSignPackage();
            $fn = Yii::app()->request->getParam("fn");
            $imgtype = Yii::app()->request->getParam("p"); 
            $this->renderPartial('wxshaer',array('fileNme'=>$fn,'imgtype'=>$imgtype,'signPackage'=>$signPackage));
	} 
	public function actionImagemerge()
    {
    	$webroot = YiiBase::getPathOfAlias('webroot');
        $dir = Yii::app()->request->getParam('dir');
        $img = $_POST['uploadimage'];
        $img = str_replace('data:image/png;base64,', '', $img);
        $img = str_replace(' ', '+', $img);
        $data = base64_decode($img);
        $filename =  time().MainHelper::generate_password(12).'.png';

        if($dir){
            $folder='storage/'.$dir.'/'.date('Ym').'/';
        }else{
            $folder='storage/'.date('Ym').'/';
        }
        MainHelper::createFolder($folder);
        $target = $webroot.'/'.$folder.$filename; 
        $success = file_put_contents($target, $data);
        echo '/'.$folder.$filename;
    }
}
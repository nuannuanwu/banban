<?php

class TempController extends Controller
{
	public function actionIndex()
	{
		$res = JceClassFee::checkPullNewClass(3308,11);
		mlog($res);
		$answer = '{"1":"2","2":"8","3":"10","4":"13","5":"20","6":"22","7":"28","8":"31","9":"33","10":"38"}';
		$score = SurveyQuestionItem::setScore($answer,1,3308,true);
		mlog($score);
		$this->render('index');
	}

	public function actionTransclick()
	{
		$jsonData = ['status' => 1];
		$msg['userid'] = Yii::app()->user->id;
        $msg['ip'] = Yii::app()->request->userHostAddress;
        $msg['datetime'] = date('Y-m-d H:i:s', time());

        $state = file_put_contents(Yii::app()->getBasePath().'/runtime/transclick'.date('Y-m-d').'.log', join('|', $msg). PHP_EOL, FILE_APPEND );

        echo json_encode($jsonData);
	}

	public function actionClickreport()
	{
		$date = Yii::app()->request->getParam('date');
		$month = $date?$date:date('Y-m-d');
		$file = fopen(Yii::app()->getBasePath().'/runtime/transclick'.$month.'.log', "r");
		$log=array();
		//输出文本中所有的行，直到文件结束为止。
		while(! feof($file))
		{
			$log[] = explode('|',fgets($file));//fgets()函数从文件指针中读取一行
		}
		fclose($file);

		$ceils = array();
		foreach (array_filter($log) as $l) {
			if(isset($l[2]) && $l[2]){
				
				$arr = array();
				$arr[] = $l[0];
				$user = JceUser::getUserInfo($l[0]);
				$arr[] = $user?preg_replace('/[^\w\d\x{4e00}-\x{9fa5}]+$/ui','',$user->name):'';
				$arr[] = $l[2];
				$arr[] = $l[1];
				$ceils[] = $arr;
			}
		}

		$header = array('用户ID','用户姓名','点击时间','IP' ); //excel表头

		$excel_file = $month.'班费转出点击';
		$excel_content [] = array(
            'sheet_name' => "(".$month .")转出点击" ,
            'sheet_title' => $header,
            'ceils' => $ceils,
        );
        PHPExcelHelper::exportExcel($excel_content, $excel_file);
        exit();
	}

	public function actionLog()
	{
		$file = fopen('log.txt', "r");
		$log=array();
		//输出文本中所有的行，直到文件结束为止。
		while(! feof($file))
		{
			$cid = trim(fgets($file));
			if($cid){
				$cid = BaseUrl::decode($cid);
				$sql = "SELECT a.aid,a.parentid FROM tb_class c, tb_school s, tb_area a WHERE c.sid=s.sid AND s.aid=a.aid AND c.cid=".$cid;
				$areas = UCQuery::queryRow($sql);
				if($areas->aid==510100 || $areas->parentid==510100){
					if(!in_array($cid, $log)){
						$log[] = $cid;//fgets()函数从文件指针中读取一行
					}
				}
			}
			
		}
		fclose($file);

		$ceils = array();
		foreach (array_filter($log) as $l) {
				
				$arr = array();
				$arr[] = $l;
				$ceils[] = $arr;
		}

		$header = array('Cid' ); //excel表头

		$excel_file = '成都班级ID';
		$excel_content [] = array(
            'sheet_name' => "chengducid" ,
            'sheet_title' => $header,
            'ceils' => $ceils,
        );
        PHPExcelHelper::exportExcel($excel_content, $excel_file);
        exit();
	}

	public function actionCacheclearcd()
	{
		Yii::app()->cache->delete('chengdutranscount'.date('Y-m-d'));
		var_dump(Yii::app()->cache->get('chengdutranscount'.date('Y-m-d')));
	}

	public function actionCachegetcd()
	{
		var_dump(Yii::app()->cache->get('chengdutranscount'.date('Y-m-d')));
	}

	public function actionCachesetcd()
	{
		$cache = Yii::app()->request->getParam('cache');
		Yii::app()->cache->set('chengdutranscount'.date('Y-m-d'),$cache);
		var_dump(Yii::app()->cache->get('chengdutranscount'.date('Y-m-d')));
	}
	
}
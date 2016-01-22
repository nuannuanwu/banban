<?php

class OrderController extends Controller
{
	public function actionIndex()
	{
		$query = isset($_GET['ViewGoodsOrderUserCenter']) ? $_GET['ViewGoodsOrderUserCenter'] : array();
		$data = ViewGoodsOrderUserCenter::model()->pageData($query);
		$model = new ViewGoodsOrderUserCenter;
        $this->render('index',array('data'=>$data,'MallOrders'=>$query,'model'=>$model));
	}

	public function actionDeal()
	{
		$id = Yii::app()->request->getParam('id');
		$st = Yii::app()->request->getParam('st');
		$ac = Yii::app()->request->getParam('ac');
		
		$model = ViewGoodsOrderUserCenter::model()->find('moid=:moid', array(':moid' => $id));
		$order = MallOrders::model()->findByPk($id);
		$mogrid = $order->mallOrdersGoodsRelations[0]->mogrid;
		$mogext = MallOrderGoodsRelationExt::model()->findByAttributes(array('mogrid'=>$mogrid,'deleted'=>0));
		if(isset($order->mca) && isset($order->mca->contacter)){
			$contacter = $order->mca->contacter;
		}else if(isset($order->mca)){
			$contacter = Member::getName($order->mca->userid);
		}else{
			$contacter = '';
		}
		
		if(isset($ac) && $ac == 'noship' && $st !='' && $order->state==$st){
		    $order->state = -1; //拒绝发货
		    $order->save();
		    echo 'success';
		    exit;
		}
		
		if($order->state==$st && $st!=''){
			$order->state = $order->state + 1;
			$order->save();
			echo 'success';
		}else{
			$con = $this->renderPartial('deal',array('order'=>$order,'model'=>$model,'contacter'=>$contacter, 'mogext'=>$mogext),true);
        	echo $con;
		}
	}
}
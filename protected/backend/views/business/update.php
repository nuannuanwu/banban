<?php
/* @var $this BusinessController */
/* @var $model Business */

$this->breadcrumbs=array(
	'Businesses'=>array('index'),
	$model->name=>array('view','id'=>$model->bid),
	'Update',
);

$this->menu=array(
	array('label'=>'List Business', 'url'=>array('index')),
	array('label'=>'Create Business', 'url'=>array('create')),
	array('label'=>'View Business', 'url'=>array('view', 'id'=>$model->bid)),
	array('label'=>'Manage Business', 'url'=>array('admin')),
);
?>

<!--<h1>Update Business <?php echo $model->bid; ?></h1>-->

<?php $this->renderPartial('_form', array('model'=>$model,'subs'=>$subs, 'imageFlag'=>1)); ?>
<?php
/* @var $this DeliveryController */
/* @var $model Deliveries */

$this->breadcrumbs=array(
	'Deliveries'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Deliveries', 'url'=>array('index')),
	array('label'=>'Create Deliveries', 'url'=>array('create')),
	array('label'=>'View Deliveries', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Deliveries', 'url'=>array('admin')),
);
?>

<?php 
	$this->renderPartial(
			'_form', 
			array(
				'model' => $model,
				'pOrders' => $pOrders,
			)
		); 
?>
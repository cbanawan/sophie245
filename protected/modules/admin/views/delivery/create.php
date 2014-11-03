<?php
/* @var $this DeliveryController */
/* @var $model Deliveries */

$this->breadcrumbs=array(
	'Deliveries'=>array('admin'),
	'New Delivery',
);

$this->menu=array(
	array('label'=>'List Deliveries', 'url'=>array('index')),
	array('label'=>'Manage Deliveries', 'url'=>array('admin')),
);
?>

<?php $this->renderPartial(
		'_form', 
		array(
			'model' => $model,
			'pOrders' => $pOrders,
		)
	); ?>
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

<?php
	$this->widget('booster.widgets.TbAlert', array(
		'fade' => true,
		'closeText' => '&times;', // false equals no close link
		'events' => array(),
		'htmlOptions' => array(),
		'userComponentId' => 'user',
		'alerts' => array( // configurations per alert type
			// success, info, warning, error or danger
			'success' => array('closeText' => '&times;'),
			'info', // you don't need to specify full config
			'warning' => array('closeText' => false),
			'error' => array('closeText' => false)
		),
	));
?>

<?php $this->renderPartial(
		'_form', 
		array(
			'model' => $model,
			'pOrders' => $pOrders,
		)
	); ?>
<?php
/* @var $this PaymentsController */
/* @var $model Payments */

$this->breadcrumbs=array(
	'Payments'=>array('index'),
	'Create',
);

$this->menu=array(
	// array('label'=>'List Payments', 'url'=>array('index')),
	array('label'=>'Return to Order', 'url'=>$this->createUrl('orders/detail', array('id' => $model->orderId))),
);
?>

<h1>Create Payment for Sales Order #<?php echo $model->orderId ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model, 'paymentTypes' => $paymentTypes)); ?>
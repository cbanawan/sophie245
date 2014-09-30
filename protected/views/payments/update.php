<?php
/* @var $this PaymentsController */
/* @var $model Payments */

$this->breadcrumbs=array(
	'Payments'=>array('index'),
	$model->paymentId=>array('view','id'=>$model->paymentId),
	'Update',
);

$this->menu=array(
	array('label'=>'List Payments', 'url'=>array('index')),
	array('label'=>'Create Payments', 'url'=>array('create')),
	array('label'=>'View Payments', 'url'=>array('view', 'id'=>$model->paymentId)),
	array('label'=>'Manage Payments', 'url'=>array('admin')),
);
?>

<h1>Update Payments <?php echo $model->paymentId; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
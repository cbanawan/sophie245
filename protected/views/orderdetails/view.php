<?php
/* @var $this OrderdetailsController */
/* @var $model Orderdetails */

$this->breadcrumbs=array(
	'Orderdetails'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Orderdetails', 'url'=>array('index')),
	array('label'=>'Create Orderdetails', 'url'=>array('create')),
	array('label'=>'Update Orderdetails', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Orderdetails', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Orderdetails', 'url'=>array('admin')),
);
?>

<h1>View Orderdetails #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'orderId',
		'dateCreated',
		'dateLastModified',
		'productId',
		'quantity',
		'orderDetailStatusId',
	),
)); ?>

<?php
/* @var $this OrderstatusController */
/* @var $model Orderstatus */

$this->breadcrumbs=array(
	'Orderstatuses'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Orderstatus', 'url'=>array('index')),
	array('label'=>'Create Orderstatus', 'url'=>array('create')),
	array('label'=>'Update Orderstatus', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Orderstatus', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Orderstatus', 'url'=>array('admin')),
);
?>

<h1>View Orderstatus #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'status',
		'description',
		'_active',
	),
)); ?>

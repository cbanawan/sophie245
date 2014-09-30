<?php
/* @var $this ProvincesController */
/* @var $model Provinces */

$this->breadcrumbs=array(
	'Provinces'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Provinces', 'url'=>array('index')),
	array('label'=>'Create Provinces', 'url'=>array('create')),
	array('label'=>'Update Provinces', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Provinces', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Provinces', 'url'=>array('admin')),
);
?>

<h1>View Provinces #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'shortName',
		'name',
	),
)); ?>

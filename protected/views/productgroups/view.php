<?php
/* @var $this ProductgroupsController */
/* @var $model Productgroups */

$this->breadcrumbs=array(
	'Productgroups'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Productgroups', 'url'=>array('index')),
	array('label'=>'Create Productgroups', 'url'=>array('create')),
	array('label'=>'Update Productgroups', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Productgroups', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Productgroups', 'url'=>array('admin')),
);
?>

<h1>View Productgroups #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'description',
	),
)); ?>

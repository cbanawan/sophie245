<?php
/* @var $this UsertypesController */
/* @var $model Usertypes */

$this->breadcrumbs=array(
	'Usertypes'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Usertypes', 'url'=>array('index')),
	array('label'=>'Create Usertypes', 'url'=>array('create')),
	array('label'=>'Update Usertypes', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Usertypes', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Usertypes', 'url'=>array('admin')),
);
?>

<h1>View Usertypes #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'type',
		'description',
	),
)); ?>

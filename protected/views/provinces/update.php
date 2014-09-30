<?php
/* @var $this ProvincesController */
/* @var $model Provinces */

$this->breadcrumbs=array(
	'Provinces'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Provinces', 'url'=>array('index')),
	array('label'=>'Create Provinces', 'url'=>array('create')),
	array('label'=>'View Provinces', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Provinces', 'url'=>array('admin')),
);
?>

<h1>Update Provinces <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
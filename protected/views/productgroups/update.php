<?php
/* @var $this ProductgroupsController */
/* @var $model Productgroups */

$this->breadcrumbs=array(
	'Productgroups'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Productgroups', 'url'=>array('index')),
	array('label'=>'Create Productgroups', 'url'=>array('create')),
	array('label'=>'View Productgroups', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Productgroups', 'url'=>array('admin')),
);
?>

<h1>Update Productgroups <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
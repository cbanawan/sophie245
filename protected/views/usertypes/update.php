<?php
/* @var $this UsertypesController */
/* @var $model Usertypes */

$this->breadcrumbs=array(
	'Usertypes'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Usertypes', 'url'=>array('index')),
	array('label'=>'Create Usertypes', 'url'=>array('create')),
	array('label'=>'View Usertypes', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Usertypes', 'url'=>array('admin')),
);
?>

<h1>Update Usertypes <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
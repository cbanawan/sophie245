<?php
/* @var $this OrderstatusController */
/* @var $model Orderstatus */

$this->breadcrumbs=array(
	'Orderstatuses'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Orderstatus', 'url'=>array('index')),
	array('label'=>'Create Orderstatus', 'url'=>array('create')),
	array('label'=>'View Orderstatus', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Orderstatus', 'url'=>array('admin')),
);
?>

<h1>Update Orderstatus <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
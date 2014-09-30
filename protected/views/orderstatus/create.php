<?php
/* @var $this OrderstatusController */
/* @var $model Orderstatus */

$this->breadcrumbs=array(
	'Orderstatuses'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Orderstatus', 'url'=>array('index')),
	array('label'=>'Manage Orderstatus', 'url'=>array('admin')),
);
?>

<h1>Create Orderstatus</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
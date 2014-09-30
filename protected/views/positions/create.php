<?php
/* @var $this PositionsController */
/* @var $model Positions */

$this->breadcrumbs=array(
	'Positions'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Positions', 'url'=>array('index')),
	array('label'=>'Manage Positions', 'url'=>array('admin')),
);
?>

<h1>Create Positions</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
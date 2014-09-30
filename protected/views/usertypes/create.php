<?php
/* @var $this UsertypesController */
/* @var $model Usertypes */

$this->breadcrumbs=array(
	'Usertypes'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Usertypes', 'url'=>array('index')),
	array('label'=>'Manage Usertypes', 'url'=>array('admin')),
);
?>

<h1>Create Usertypes</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
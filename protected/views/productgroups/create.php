<?php
/* @var $this ProductgroupsController */
/* @var $model Productgroups */

$this->breadcrumbs=array(
	'Productgroups'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Productgroups', 'url'=>array('index')),
	array('label'=>'Manage Productgroups', 'url'=>array('admin')),
);
?>

<h1>Create Productgroups</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
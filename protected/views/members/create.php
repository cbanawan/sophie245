<?php
/* @var $this MembersController */
/* @var $model Members */

$this->breadcrumbs=array(
	'Members'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Members', 'url'=>array('index')),
	array('label'=>'Manage Members', 'url'=>array('admin')),
);
?>

<h2>Create Members</h2>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
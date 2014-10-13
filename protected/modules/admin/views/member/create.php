<?php
/* @var $this MemberController */
/* @var $model Members */

$this->breadcrumbs=array(
	'Members'=>array('admin'),
	'Create',
);

$this->menu=array(
	// array('label'=>'List Members', 'url'=>array('index')),
	array('label'=>'Manage Members', 'url'=>array('admin')),
);
?>

<?php 
	$this->renderPartial(
			'_form', 
			array(
				'model' => $model, 
				'title' => 'Created New Member'
			)
		); 
?>
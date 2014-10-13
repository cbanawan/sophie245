<?php
/* @var $this MemberController */
/* @var $model Members */

	$this->breadcrumbs=array(
		'Members'=>array('admin'),
		$model->id=>array('view','id'=>$model->id),
		'Update',
	);

	$this->menu=array(
		// array('label'=>'List Members', 'url'=>array('index')),
		array('label'=>'Create Members', 'url'=>array('create')),
		array('label'=>'View Members', 'url'=>array('view', 'id'=>$model->id)),
		array('label'=>'Manage Members', 'url'=>array('admin')),
	);
	$this->renderPartial(
			'_form', 
			array(
				'model' => $model,
				'title' => 'Update Member'
			)
		); 
?>
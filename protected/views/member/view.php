<?php
/* @var $this MemberController */
/* @var $model Members */

$this->breadcrumbs=array(
	'Members'=>array('admin'),
	$model->memberCode,
	'Update'=>array('update', 'id' => $model->id),
);

$this->menu=array(
	// array('label'=>'List Members', 'url'=>array('index')),
	array('label'=>'Create Members', 'url'=>array('create')),
	array('label'=>'Update Members', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Members', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Members', 'url'=>array('admin')),
);
?>

<h3><?php echo $model->codeName; ?></h3>

<?php $this->widget('booster.widgets.TbDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		// 'id',
		'memberCode',
		'firstName',
		'lastName',
		'middleName',
		'sponsorId',
		'_active',
		'homePhone',
		'mobilePhone',
		'emailAddress',
		'address1',
		'address2',
		'cityId',
		'dateJoined',
		'sponsorCode',
		'position',
	),
)); ?>

<?php
/* @var $this MemberController */
/* @var $model Members */

$this->breadcrumbs=array(
	'Member',
	'Create New Member' => array('create')
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#members-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h3>Manage Members</h3>

<p class="alert alert-info">
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('booster.widgets.TbGridView', array(
	'id'=>'members-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'dateJoined',
		'memberCode',
		'lastName',
		'firstName',
		'middleName',
		'sponsorCode',
		/*
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
		*/
		array(
			'class' => 'booster.widgets.TbButtonColumn',
			'template' => '{view}&nbsp;&nbsp;{update}',
		),
	),
)); ?>

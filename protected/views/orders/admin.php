<?php
/* @var $this OrdersController */
/* @var $model Orders */

$this->breadcrumbs=array(
	'Orders'=>array('admin'),
	'Manage',
);

$this->menu=array(
	// array('label'=>'List Orders', 'url'=>array('index')),
	array('label'=>'Create New Order', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#orders-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h2>Manage Orders</h2>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'orders-grid',
	'dataProvider'=>$model->search(),
	// 'filter'=>$model,
	'columns'=>array(
		'id',
		array(
			'name' => 'dateCreated',
			'value' => 'date("m/d/Y", strtotime($data->dateCreated))'
		),
		// 'dateLastModified',
		// 'memberId',
		array(
			'name' => 'memberCode',
			'value' => '$data->memberMemberCode',
			// 'filter'=> CHtml::activeTextField($model, 'memberCode'),
		),
		array(
			'name' => 'memberName',
			'value' => '$data->memberFullName',
			// 'filter'=> CHtml::activeTextField($model, 'memberCode'),
		),
		'user.username',
		'orderStatus.status',
		array(
			'name' => 'Amount',
			'value' => 'number_format($data->orderDetailSummary["net"], 2)',
			'htmlOptions' => array('class' => 'text-right'),
		),
		array(
			'name' => 'Payment',
			'value' => 'number_format($data->totalPayment, 2)',
			'htmlOptions' => array('class' => 'text-right'),
		),
		array(
			'class'=>'CButtonColumn',
			'template'=>'{view}',
			'viewButtonUrl' => 'Yii::app()->controller->createUrl("detail", array("id" => $data->id))',			
		),
	),
)); ?>

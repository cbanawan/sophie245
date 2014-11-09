<?php
/* @var $this DeliveryController */
/* @var $model Deliveries */

$this->breadcrumbs=array(
	'Deliveries',
	'Create New Delivery' => array('create')
);

$this->menu=array(
	array('label'=>'List Deliveries', 'url'=>array('index')),
	array('label'=>'Create Deliveries', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#deliveries-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<?php $this->beginWidget(
    'booster.widgets.TbPanel',
    array(
        'title' => 'Manage Deliveries',
        'headerIcon' => 'barcode',
		// 'padContent' => false,
        'htmlOptions' => array('class' => 'bootstrap-widget-table'),
		'headerButtons' => array(
            array(
                'class' => 'booster.widgets.TbButton',
				'label' => 'Export to CSV',
				'icon' => 'plus-sign',
				'size' => 'medium',
				'htmlOptions' => array(
					'id' => 'export-po-button',
					'title' => 'Export to CSV',
				),	
				// 'visible' => (!in_array($order->orderStatus->status, array('cancelled')))
            ),
        )	
    )
); ?>

<?php $this->widget('booster.widgets.TbGridView', array(
	'id'=>'deliveries-grid',
	'dataProvider'=>$model->search(),
	// 'filter'=>$model,
	'columns'=>array(
		'id',
		array(
			'name' => 'dateCreated',
			'header' => 'Date Created',
			'value' => 'date("m/d/Y h:i A", strtotime($data->dateCreated))',
		),
		array(
			'name' => 'dateLastModified',
			'header' => 'Last Modified',
			'value' => 'date("m/d/Y h:i A", strtotime($data->dateLastModified))',
		),
		array(
			'name' => 'dateDelivered',
			'header' => 'Delivery Date',
			'value' => 'date("m/d/Y", strtotime($data->dateDelivered))',
		),
		'purchaseOrderId',
		array(
			'name' => 'receviedBy',
			'header' => 'Received By',
			'value' => '$data->user->username',
		),
		array(
			'header' => 'Actions',
			'class' => 'booster.widgets.TbButtonColumn',
			'template' => '{view}',
			'buttons' => array(
				'view' => array(
					'icon' => 'zoom-in'
				),
			),
		),
	),
)); ?>

<?php $this->endWidget(); ?>

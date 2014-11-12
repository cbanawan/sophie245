<?php
/* @var $this PurchaseOrderController */
/* @var $model PurchaseOrders */

$this->breadcrumbs=array(
	'Purchase Orders',
	'Create New Purchase Order' => array('create'),
);

$this->menu=array(
	array('label'=>'List PurchaseOrders', 'url'=>array('index')),
	array('label'=>'Create PurchaseOrders', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#purchase-orders-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<?php $this->beginWidget(
    'booster.widgets.TbPanel',
    array(
        'title' => 'Manage Purchase Orders',
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
	'id'=>'purchase-orders-grid',
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
			'name' => 'dateOrdered',
			'header' => 'Order Date',
			'value' => 'date("m/d/Y", strtotime($data->dateOrdered))',
		),
		array(
			'name' => 'dateExpected',
			'header' => 'Date Expected',
			'value' => 'date("m/d/Y", strtotime($data->dateExpected))',
		),
		array(
			'name' => 'user.username',
			'header' => 'Prepared By',
		),
		array(
			'name' => 'totalAmount',
			'header' => 'Amount',
			'value' => '"Php " . number_format($data->totalAmount, 2)',
		),
		array(
			'name' => 'orderConfirmationNo',
			'header' => 'Confirmation No',
		),
		array(
			'name' => 'orderStatus.description',
			'header' => 'Status',
		),
		array(
			'class' => 'booster.widgets.TbButtonColumn',
			'template' => '{view}',
			'buttons' => array(
				'view' => array(
					'icon' => 'zoom-in'
				)
			)
		),
	),
)); ?>
<?php $this->endWidget(); ?>
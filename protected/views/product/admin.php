<?php
/* @var $this ProductController */
/* @var $model Products */

$this->breadcrumbs=array(
	'Manage',
	'Search' => array('search'),
	'Update Critical' => array('/admin/product/updateCritical')
);

Yii::app()->clientScript->registerScript('search', "
	$('.search-button').click(function(){
		$('.search-form').toggle();
		return false;
	});
	$('.search-form form').submit(function(){
		$('#products-grid').yiiGridView('update', {
			data: $(this).serialize()
		});
		return false;
	});
");
?>

<?php $this->beginWidget(
    'booster.widgets.TbPanel',
    array(
        'title' => 'Manage Products',
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
					'id' => 'export-products-button',
					'title' => 'Export to CSV',
				),	
				// 'visible' => (!in_array($order->orderStatus->status, array('cancelled')))
            ),
        )	
    )
); ?>

<?php $this->widget('booster.widgets.TbGridView', array(
	'id'=>'products-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		// 'id',
		'code',
		'description',
		'catalogPrice',
		'netPriceDiscount',
		'stocksOnHand',
		'catalogId',
		array(
			'name' => '_active',
			'value' => '$data->_active ? "Yes" : "No"',
		),
		/*
		'productGroupId',
		'catalogId',
		'_outOfStocksUp',
		*/
		array(
			'class' => 'booster.widgets.TbButtonColumn',
			'template'=>'{view}&nbsp;&nbsp;{update}',
			'buttons' => array(
				'view' => array(
					'icon' => 'edit',
				),
			)			
		),
	),
)); ?>

<?php $this->endWidget(); ?>

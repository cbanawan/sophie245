<?php $this->beginWidget(
    'booster.widgets.TbPanel',
    array(
        'title' => 'Product Deliveries',
        'headerIcon' => 'barcode',
		'headerButtons' => array(
            array(
				'class' => 'booster.widgets.TbButtonGroup',
				'size' => 'medium',
				'buttons' => array(
					array(
						'label' => 'Add Product',
						'icon' => 'plus-sign',
						'visible' => !$model->deliveryConfirmed,
						'htmlOptions' => array(
							'id' => 'update-po',
							//'onclick' => 'window.location.href="' . Yii::app()->createUrl('/admin/purchaseOrder/update', array('id' => $model->id)) . '"',
						)
					),
				),
            ),
		)		
    )
); ?>

<?php
	// var_dump($model->products);

	$products = new CArrayDataProvider('DeliveryProducts');
	$products->setData($model->products);		
	
	$this->widget(
		'booster.widgets.TbExtendedGridView',
		array(
			'type' => 'striped bordered',
			'dataProvider' => $products,
			'template' => "{items}",
			'columns' => array(
				array(
					'name' => 'id',
					'header' => '#',
					'htmlOptions' => array('style' => 'width: 60px')
				),
				// array('name' => 'productId', 'header' => 'Product ID'),
				array('name' => 'product.code', 'header' => 'Product Code'),
				array('name' => 'product.description', 'header' => 'Description'),
				array('name' => 'ordered', 'header' => 'Ordered'),
				array(
					'name' => 'delivered',
					'header' => 'Delivered',
					'class' => 'booster.widgets.TbEditableColumn',
					'headerHtmlOptions' => array('style' => 'width:200px'),
					'editable' => array(
						'type' => 'text',
						'url' => Yii::app()->createUrl('/admin/delivery/ajaxUpdateQuantity'),
					)
				),				
				/*array(
					'htmlOptions' => array('nowrap' => 'nowrap'),
					'class' => 'booster.widgets.TbButtonColumn',
					'template' => '{delete}',
					'viewButtonUrl' => null,
					'updateButtonUrl' => null,
					'deleteButtonUrl' => null,
				)*/
			)
		)
	);
?>

<?php $this->endWidget(); ?>
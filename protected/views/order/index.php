<?php
	$this->breadcrumbs=array(
		'Sales Order',
		'Create New Order' => array('order/create'),
	);
?>

<?php $this->beginWidget(
    'booster.widgets.TbPanel',
    array(
        'title' => 'Search Order',
        'headerIcon' => 'search',
		// 'padContent' => false,
        'htmlOptions' => array('class' => 'bootstrap-widget-table'),
    )
); ?>
		<?php
			$this->renderPartial('_orderSearch',array(
					'model'=>$orders,
					'orderStatus' => $orderStatus,
				));
		?>
<?php $this->endWidget(); ?>

<?php 
	Yii::app()->getClientScript()->registerScript("order-index", "
		$('#export-order-item-button').on('click',function() {
			window.location = '". $this->createUrl('export')  . "' + '&export=true&' + $('#order-search-form').serialize();
		});
	");	
?>

<?php $this->beginWidget(
    'booster.widgets.TbPanel',
    array(
        'title' => 'Sales Order Items',
        'headerIcon' => 'list-alt',
		// 'padContent' => false,
        'htmlOptions' => array('class' => 'bootstrap-widget-table'),
		'headerButtons' => array(
            array(
                'class' => 'booster.widgets.TbButton',
				'label' => 'Export to CSV',
				'icon' => 'plus-sign',
				'size' => 'medium',
				'htmlOptions' => array(
					'id' => 'export-order-item-button',
					'title' => 'Export to CSV',
				),	
				// 'visible' => (!in_array($order->orderStatus->status, array('cancelled')))
            ),
        )		
    )
); ?>

<?php
	$this->renderPartial(
				'_list',
				array(
					'orders'=>$orders,
				)
			);
?>			

<?php $this->endWidget(); ?>
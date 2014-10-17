<?php
	$this->breadcrumbs=array(
		'Sales Order' => array('order/index'),
		$order->id,
		'Create New Order' => array('order/create'),
	);
	
	Yii::app()->getClientScript()->registerScript("print-order", "
		$('#print').click(function(){
			window.open('" . Yii::app()->createUrl('order/print', array('id' => $order->id)) . "', '_blank');
		});
	");
?>

<?php $this->beginWidget(
    'booster.widgets.TbPanel',
    array(
        'title' => 'Sales Order Header',
        'headerIcon' => 'barcode',
		'headerButtons' => array(
            array(
				'class' => 'booster.widgets.TbButtonGroup',
				'size' => 'medium',
				'buttons' => array(
					array(
						'label' => 'Print Order',
						'icon' => 'print',
						'url' => Yii::app()->createUrl('order/print'),
						'htmlOptions' => array(
							'id' => 'print'
						)
					),
					array(
						'label' => 'Change Order Status',
						'icon' => 'cog',
						'items' => array(
							array(
								'label' => 'Cancel Order', 
								'url' => Yii::app()->createUrl('order/changeStatus', array('id' => $order->id, 'status' => 'cancelled')),
								'visible' => !in_array($order->orderStatus->status, array('cancelled')),
							),
							array(
								'label' => 'For Order Placement', 
								'url' => Yii::app()->createUrl('order/changeStatus', array('id' => $order->id, 'status' => 'forOrder')),
								'visible' => !in_array($order->orderStatus->status, array('cancelled', 'forOrder')),
							),
							array(
								'label' => 'Items Delivered', 
								'url' => Yii::app()->createUrl('order/changeStatus', array('id' => $order->id, 'status' => 'delivered')),
								'visible' => !in_array($order->orderStatus->status, array('cancelled', 'delivered')),
							),
							array(
								'label' => 'Order Served', 
								'url' => Yii::app()->createUrl('order/changeStatus', array('id' => $order->id, 'status' => 'served')),
								'visible' => !in_array($order->orderStatus->status, array('cancelled', 'served')),
							),
							array(
								'label' => 'Delete Order Permanently', 
								'url' => Yii::app()->createUrl('order/delete', array('id' => $order->id)),
								'visible' => in_array($order->orderStatus->status, array('cancelled')),
							),
							/*'---',
							array(
								'label' => 'Print Sales Order', 
								'url' => Yii::app()->createUrl('order/print', array('id' => $order->id)),
							),*/
						)
					),
				),
            ),
		)
    )
); ?>

	<div id='order-details' class="row">
		<?php 
			$orderDetails = $order->attributes;
			$orderDetails['memberName'] = $order->member->codeName;
			$orderDetails['orderStatus'] = $order->orderStatus->description;
			$this->renderPartial(
					'_detail',
					array(
						'order' => $orderDetails,
					)
				); 		
		?>
	</div>
	
<?php $this->endWidget(); ?>

<?php $this->beginWidget(
    'booster.widgets.TbPanel',
    array(
        'title' => 'Sales Order Items',
        'headerIcon' => 'list-alt',
		'padContent' => false,
        'htmlOptions' => array('class' => 'bootstrap-widget-table'),
		'headerButtons' => array(
            array(
                'class' => 'booster.widgets.TbButton',
				'label' => 'Add Order Item',
				'icon' => 'plus-sign',
				'size' => 'medium',
				'htmlOptions' => array(
					'title' => 'Add Order Item',
					'data-toggle' => 'modal',
					'data-target' => '#order-item-dialog',
				),				
				'visible' => (!in_array($order->orderStatus->status, array('cancelled')))
            ),
        )		
    )
); ?>
	
	<div id="order-items" class="text-right">
	<?php
		$this->renderPartial(
				'_items',
				array(
					'orderStatus' => $order->orderStatus->status,
					'orderDetails' => $order->orderdetails,
				)
			); 		
	?>
	</div>
<?php $this->endWidget(); ?>

<?php $this->beginWidget(
    'booster.widgets.TbPanel',
    array(
        'title' => 'Sales Order Payments',
        'headerIcon' => 'list-alt',
		'padContent' => false,
        'htmlOptions' => array('class' => 'bootstrap-widget-table'),
		'headerButtons' => array(
            array(
                'class' => 'booster.widgets.TbButton',
				'label' => 'Add Payment',
				'icon' => 'plus-sign',
				'size' => 'medium',
				'htmlOptions' => array(
					'title' => 'Add Order Payment',
					'data-toggle' => 'modal',
					'data-target' => '#order-payment-dialog',
					'onclick' => "
							$.ajax({
							  type: 'GET',
							  url: '" . Yii::app()->createUrl('order/ajaxGetOrder', array('id' => $order->id)) . "',
							  // data: $(this).serialize(),
							  datatype: 'json',
							  success: function(data) {
								  $('#amount').val(data.amountDue.toFixed(2));

								  $('#amountDue').text(data.netAmount.toFixed(2));
								  $('#requiredDeposit').text((data.netAmount/2).toFixed(2));
								  $('#totalPayment').text(data.totalPayment.toFixed(2));
								  $('#balanceDue').text(data.amountDue.toFixed(2));
							  }
							})
							  .done(function( msg ) {
								  $.fn.yiiGridView.update('order-items-grid');
							});							
						",
				),
				'visible' => (!in_array($order->orderStatus->status, array('cancelled')))
            ),
        )		
    )
); ?>
	
	<div id="order-items" class="text-right">
	<?php
		$this->renderPartial(
				'_payments',
				array(
					'payments' => $order->payments,
				)
			); 		
	?>
	</div>
<?php $this->endWidget(); ?>

<!-- New Order Item Dialog -->
<?php
$this->renderPartial(
		'_newOrderItemForm',
		array(
			'order' => $order,
		)
	); 	

$this->renderPartial(
		'_newPaymentForm',
		array(
			'order' => $order,
		)
	); 
?>
	 
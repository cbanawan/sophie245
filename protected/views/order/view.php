<?php
	$this->breadcrumbs=array(
		'Sales Order' => array('order/index'),
		$order->id,
		'Create New Order' => array('order/create'),
	);
	
	Yii::app()->getClientScript()->registerScript("add-order", "
		$(window).keydown(function(e) {
			switch (e.keyCode) {
				case 113: 
					$('#add-order-item-button').click();
					return false;
				case 114: 
					$('#add-order-payment-button').click();
					return false;
			}
			return; //using 'return' other attached events will execute
		});

	");
	
	$this->menu = array(
		array(
			'label' => 'Order',
			'url' => '#'
		)
	);
?>

<div class="container-fluid">
	<div class="row">
		<div>
			<div class="col-sm-4">
				<?php $this->beginWidget(
					'booster.widgets.TbPanel',
					array(
						'title' => 'Sales Order Header',
						'headerIcon' => 'barcode',
						'padContent' => true,
						'htmlOptions' => array('class' => 'bootstrap-widget-table'),
					)
				); ?>
				<div id="order-details-with-buttons">
					<?php
						$this->renderPartial(
									'_detailWithButtons',
									array(
										'order' => $order
									)
								);
					?>
				</div>

				<?php $this->endWidget(); ?>
			</div>
			<div class="col-sm-8">
			<?php $this->beginWidget(
				'booster.widgets.TbPanel',
				array(
					'title' => 'Sales Order Items',
					'headerIcon' => 'list-alt',
					'padContent' => true,
					'htmlOptions' => array('class' => 'bootstrap-widget-table'),
					'headerButtons' => array(
						array(
							'class' => 'booster.widgets.TbButton',
							'label' => 'Add Order Item',
							'icon' => 'plus-sign',
							'size' => 'medium',
							'htmlOptions' => array(
								'id' => 'add-order-item-button',
								'title' => 'Add Order Item',
								'data-toggle' => 'modal',
								'data-target' => '#order-item-dialog',
							),	
							'visible' => (!in_array($order->orderStatus->status, array('cancelled', 'served')))
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
					'padContent' => true,
					'htmlOptions' => array('class' => 'bootstrap-widget-table'),
					'headerButtons' => array(
						array(
							'class' => 'booster.widgets.TbButton',
							'label' => 'Add Payment',
							'icon' => 'plus-sign',
							'size' => 'medium',
							'htmlOptions' => array(
								'id' => 'add-order-payment-button',
								'title' => 'Add Order Payment',
								'data-toggle' => 'modal',
								'data-target' => '#order-payment-dialog',
								'onclick' => "
										$.ajax({
										  type: 'GET',
										  url: '" . Yii::app()->createUrl('order/ajaxGetOrder', array('id' => $order->id)) . "',
										  // data: $(this).serialize(),
										  datatype: 'json',
										  beforeSend: function() { Loading.show(); },
										  success: function(data) {
											  $('#amount').val(data.amountDue.toFixed(2));

											  $('#grossAmount').text(data.grossAmount.toFixed(2));
											  $('#amountDue').text(data.netAmount.toFixed(2));
											  $('#requiredDeposit').text((data.grossAmount/2).toFixed(2));
											  $('#totalPayment').text(data.totalPayment.toFixed(2));
											  $('#balanceDue').text(data.amountDue.toFixed(2));
										  }
										})
										  .done(function( msg ) {
											  $.fn.yiiGridView.update('order-items-grid');
											  Loading.hide();
										});							
									",
							),
							'visible' => !in_array($order->orderStatus->status, array('cancelled', 'served'))
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
			</div>
		</div>
	</div>
</div>





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
	 
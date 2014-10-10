<?php
/* @var $this OrderController */

	$this->breadcrumbs=array(
		'Admin' => array('default/index'),
		'Purchase Orders' => array('order/index'),
		'Order #' . $order->id,
		'Add New Order' => array('order/new'),
	);

	$this->menu = array(
		array(
			'label' => 'Cancel',
			'url' => $this->createUrl('order/changeStatus', array('id' => $order->id, 'status' => 'cancelled')),
			'visible' => !in_array($order->orderStatus->status, array('ordered', 'served', 'cancelled'))
		),
		array(
			'label' => 'Placed',
			'url' => $this->createUrl('order/changeStatus', array('id' => $order->id, 'status' => 'ordered')),
			'visible' => in_array($order->orderStatus->status, array('paid', 'partial'))
		),
		array(
			'label' => 'Print',
			'url' => $this->createUrl('/orders/preview', array('id' => $order->id)),
			'linkOptions' => array('target' => '_blank'),
		),
		array(
			'label' => 'Serve',
			'url' => $this->createUrl('order/changeStatus', array('id' => $order->id, 'status' => 'served')),
			'visible' => in_array($order->orderStatus->status, array('paid', 'ordered'))
		),
	);
?>
<div class="row">
	<div class="span4">
		<?php $this->beginWidget('zii.widgets.CPortlet', array(
				'title'=>'P.O. Header',
			));?>
			<div id="po-header">
			<?php 
			$this->renderPartial(
					'_header',
					array(
						'order'=>$order,
					)
				);	
			?>
			</div>
		<?php $this->endWidget(); ?>
	</div>
	<div class="span8">
		<?php
			$this->beginWidget('zii.widgets.CPortlet', array(
				'title'=>'P.O. Items',
			));
		?>
			<?php 
				if(!in_array($order->orderStatus->status, array('served', 'cancelled', 'ordered')))
				{
					echo CHtml::link('Add Order Item', '#', array('onclick'=>'$("#order-item-dialog").dialog("open"); return false;')); 
				}
			?>
			<div id="po-items">
				<?php
				$this->renderPartial(
					'_items', array(
						'orderId' => $order->id,
						'orderStatus' => $order->orderStatus->status,
						'orderDetails' => $order->orderdetails,
					)
				);
				?>
			</div>
		<?php $this->endWidget(); ?>
		
		<?php
			$this->beginWidget('zii.widgets.CPortlet', array(
				'title'=>'Payment Transactions',
			));
		?>
			<?php 
				if(!in_array($order->orderStatus->status, array('served', 'cancelled', 'ordered')))
				{
					echo CHtml::link('Add Payment', '#', array('onclick'=>'$("#payment-dialog").dialog("open"); return false;')); 
				}
			?>
			<div id="po-payments">
				<?php
				$payments = Payments::model()->with('user', 'paymentType')->findAll('orderId = :orderId', array(':orderId' => 0));			
				
				$this->renderPartial(
					'_payments', array(
						'orderId' => $order->id,
						'orderStatus' => $order->orderStatus->status,
						'payments' => $order->payments,
					)
				);
				?>
			</div>	
		<?php $this->endWidget(); ?>
	</div>
</div>

<?php 
	$this->beginWidget('zii.widgets.jui.CJuiDialog',array(
		'id'=>'payment-dialog',
		'options'=>array(
			'title'=>'Add Payment',
			'autoOpen'=>false,
			'resizable'=>false,
			'modal'=>true,
		),
	));
?>
	<?php
		Yii::app()->clientScript->registerScript('payment', "

		$('.new-order-payment-form form').submit(function(){
			$.ajax({
			  type: 'POST',
			  url: '" . Yii::app()->createUrl('admin/order/ajaxAddOrderPayment') . "',
			  data: $(this).serialize()
			})
			  .done(function( msg ) {
				    window.location.reload();
					/*$.fn.yiiGridView.update('orderpayments-grid');
					$.fn.yiiGridView.update('orderdetails-grid');
					// $.fn.yiiListView.update('po-header');
					
					$.ajax({
					  type: 'GET',
					  url: '" . Yii::app()->createUrl('admin/order/ajaxView', array('id' => $order->id)) . "',
					})
					  .success(function( result ) {
							$('#po-header').html(result);
					  });*/

			  });
			  
			$('#btnClearPayment').click();	
			$('#payment-dialog').dialog('close');
			return false;
		});
		");
	?>	
	<div class="new-order-payment-form">
		<?php 
			$paymentTypes = CHtml::listData(Paymenttypes::model()->findAll(), 'id', 'name');

			$payments = new Payments();
			$payments->orderId = $order->id;
			$payments->userId = 1;
			$this->renderPartial('_newPaymentForm',array(
				'model' => $payments,
				'paymentTypes' => $paymentTypes,
		)); ?>
	</div><!-- search-form -->				

<?php $this->endWidget('zii.widgets.jui.CJuiDialog'); ?>

<?php 
	$this->beginWidget('zii.widgets.jui.CJuiDialog',array(
		'id'=>'order-item-dialog',
		'options'=>array(
			'title'=>'Add Order Item',
			'autoOpen'=>false,
			'resizable'=>false,
			// 'draggable' => false,
			'width' => 425,
			'modal'=>true,
			'theme'=>'redmond'
		),
	));
?>

	<?php
		Yii::app()->clientScript->registerScript('item', "

		$('.new-order-detail-form form').submit(function(){
			$.ajax({
			  type: 'POST',
			  url: '" . Yii::app()->createUrl('admin/order/ajaxAddOrderItem') . "',
			  data: $(this).serialize()
			})
			  .done(function( msg ) {
				$.fn.yiiGridView.update('orderdetails-grid');
				$.fn.yiiGridView.update('orderpayments-grid');
					$.ajax({
					  type: 'GET',
					  url: '" . Yii::app()->createUrl('admin/order/ajaxView', array('id' => $order->id)) . "',
					})
					  .success(function( result ) {
							$('#po-header').html(result);
					  });				
			});

			var val = $(this).find('input[type=submit]:focus');
			  
			$('#btnClear').click();	
			
			// $('#order-item-dialog').dialog('close');			
			
			return false;
		});
		");
	?>	

	<div class="new-order-detail-form">
		<?php 
			$orderDetailModel = new Orderdetails();
			$orderDetailModel->orderId = $order->id;
			$this->renderPartial('_newOrderItemForm',array(
				'model'=>$orderDetailModel,
		)); ?>
	</div>
	
<?php $this->endWidget('zii.widgets.jui.CJuiDialog'); ?>

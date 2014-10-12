<?php
/* @var $this OrderController */

	$this->breadcrumbs=array(
		'Admin' => array('default/index'),
		'Purchase Order',
	);

	$this->menu = array(
		array(
			'label' => 'Add New Order',
			'url' => Yii::app()->createUrl('admin/order/new'),
		),
	);
?>


		<?php
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


<div class="row">
	<div class="span12">
		<div class="span3">
			<?php $this->beginWidget('zii.widgets.CPortlet', array(
				'title'=>'Order Search/Filter',
			)); ?>
			<div class="search-formx">
				<?php $this->renderPartial('_search',array(
					'model'=>$order,
					'orderStatus' => $orderStatus,
				)); ?>
			</div><!-- search-form -->	
			<?php $this->endWidget(); ?>
		</div>
		<div class="span9">
		<?php
			Yii::app()->getClientScript()->registerScript("orderSelect", "
				var alertFromCallsJS = function(id){
					var selectedOrderId = parseInt($.fn.yiiGridView.getSelection('orders-grid'));
					$.ajax({
							type: 'GET',
							url:'" . Yii::app()->createUrl('admin/order/ajaxView') . "',
							success:function(result){
								$('#po-header').html(result);
							},
							data:{id: selectedOrderId}
						});	

					$.ajax({
							type: 'GET',
							url:'" . Yii::app()->createUrl('admin/order/ajaxItems') . "',
							success:function(result){
								$('#po-items').html(result);
							},
							data:{id: selectedOrderId}
						});			

					$.ajax({
							type: 'GET',
							url:'" . Yii::app()->createUrl('admin/order/ajaxPayments') . "',
							success:function(result){
								$('#po-payments').html(result);
							},
							data:{id: selectedOrderId}
						});			
				};
			");

			$this->beginWidget('zii.widgets.CPortlet', array(
				'title'=>'Purchase Orders',
			)); 

			?>
	
			<?php $this->renderPartial(
						'_list',
						array(
							'order'=>$order,
						)
					); 	

			$this->endWidget(); 
		?>	
		</div>
	</div>
</div>

<!--
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
			<div id="po-items">
				<?php
				$orderDetails = Orderdetails::model()->with('product', 'orderDetailStatus')->findAll('orderId = :orderId', array(':orderId' => 0));			
				
				$this->renderPartial(
					'_items', array(
						'orderId' => $order->id,
						'orderStatus' => $order->orderStatusId,
						'orderDetails' => $orderDetails,
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
			<div id="po-payments">
				<?php
				$payments = Payments::model()->with('user', 'paymentType')->findAll('orderId = :orderId', array(':orderId' => 0));			
				
				$this->renderPartial(
					'_payments', array(
						'orderId' => $order->id,
						'orderStatus' => $orderStatus,
						'payments' => $payments,
					)
				);
				?>
			</div>		
		<?php $this->endWidget(); ?>
	</div>
</div> !-->
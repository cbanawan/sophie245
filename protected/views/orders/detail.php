<?php 
$this->breadcrumbs=array(
	'Orders'=>array('admin'),
	'Details',
);

$this->menu=array(
	array('label'=>'Create New Order', 'url'=>array('create')),
	array('label'=>'Manage Orders', 'url'=>array('admin')),
);

?>

<div class="row">
	<h3>Sales Order # BC245<?php echo str_pad($order->id, 10, "0", STR_PAD_LEFT); ?></h3>

	<?php $this->widget('zii.widgets.CDetailView', array(
		'data'=>$order,
		'attributes'=>array(
			array(
				'label' => 'Member',
				'type' => 'raw',
				'value' => $order->member->codeName,
			),
			// 'id',
			'dateCreated',
			// 'dateLastModified',
			/*array(
				'label' => 'Received By',
				'type' => 'raw',
				'value' => $order->user->username,
			),*/
			array(
				'label' => 'Order Status',
				'type' => 'raw',
				'value' => $order->orderStatus->description,
			),
		),
	));
	?>
</div>
<br />
<div class="row pull-right">
	<?php if(!in_array($order->orderStatus->status, array('served', 'cancelled'))): ?>
		<div class="btn-group">
		  <button type="button" class="btn btn-small dropdown-toggle" data-toggle="dropdown">
			Change Order Status  <span class="caret"></span>
		  </button>
		  <ul class="dropdown-menu" role="menu">
			<?php if(in_array($order->orderStatus->status, array('paid'))): ?>
				<li><?php echo CHtml::link('Served', $this->createUrl('/orders/updateStatus', array('id' => $order->id, 'statusId' => '4'))); ?></li>
			<?php endif; ?>
			<?php if(!in_array($order->orderStatus->status, array('paid', 'served', 'cancelled'))): ?>
				<li><?php echo CHtml::link('Cancel Order', $this->createUrl('/orders/updateStatus', array('id' => $order->id, 'statusId' => '5'))); ?></li>
			<?php endif; ?>
		  </ul>
		</div>	
	<?php endif; ?>
	<div class="btn-group">
	  <button type="button" class="btn btn-small" data-toggle="dropdown">
		<span class="icon-print"></span> Print
	  </button>
	</div>
</div>
<br />

<?php
	Yii::app()->clientScript->registerScript('order', "
		$('#myTab a').click(function (e) {
			e.preventDefault();
			$(this).tab('show');
		});

		$( document ).ready(function() {
			$('#addNewOrderItemLink').focus();
		});
	");
?>

<div class="row">
	<ul class="nav nav-tabs" id="myTab">
	  <li class="<?php if($activeNavItem == 'order_details') echo "active"; ?>"><a href="#order_details">Order Details</a></li>
	  <li class="<?php if($activeNavItem == 'payments') echo "active"; ?>"><a href="#payments">Payments</a></li>
	</ul>
	
	<div class="tab-content">
	  <div class="tab-pane <?php if($activeNavItem == 'order_details') echo "active"; ?>" id="order_details">
		<?php 
			if(!in_array($order->orderStatus->status, array('served', 'cancelled'))) 
			{
				echo CHtml::link('Add New Order Item', $this->createUrl('/orderdetails/create', array('orderId' => $order->id)), array('id' => 'addNewOrderItemLink', 'class' => 'btn btn-small')); 
			}

			$this->renderPartial(
					'_list',
					array(
						'order'=>$order,
					)
				); 
		?>
	  </div>
	  <div class="tab-pane <?php if($activeNavItem == 'payments') echo "active"; ?>" id="payments">
		<?php 
			if(!in_array($order->orderStatus->status, array('served', 'cancelled'))) 
			{
				echo CHtml::link('Add Payment', $this->createUrl('/payments/create', array('orderId' => $order->id)), array('class' => 'btn btn-small')); 
			}
			
			$this->renderPartial(
					'/payments/_list',
					array(
						'order'=>$order,
					)
				); 
		?>		  
	  </div>
	</div>
	
</div>




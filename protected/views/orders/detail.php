<?php 
$this->breadcrumbs=array(
	'Orders'=>array('index'),
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
			array(
				'label' => 'Received By',
				'type' => 'raw',
				'value' => $order->user->username,
			),
			array(
				'label' => 'Order Status',
				'type' => 'raw',
				'value' => $order->orderStatus->status,
			),
		),
	));
	?>
</div>
<br />
<div class="row pull-right">
	<?php echo CHtml::link(TbHtml::icon(TbHtml::ICON_PRINT), $this->createUrl('/orders/preview', array('id' => $order->id)), array('target'=>'_blank', 'class' => 'button')); ?>
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
	  <li class="<?php if($activeNavItem == 'summary') echo "active"; ?>"><a href="#summary">Summary</a></li>
	</ul>
	
	<div class="tab-content">
	  <div class="tab-pane <?php if($activeNavItem == 'order_details') echo "active"; ?>" id="order_details">
		<?php echo CHtml::link('Add New Order Item', $this->createUrl('/orderdetails/create', array('orderId' => $order->id)), array('id' => 'addNewOrderItemLink')); ?>
		<?php 
			$this->renderPartial(
					'_list',
					array(
						'orderDetails'=>$order->orderdetails,
					)
				); 
		?>
	  </div>
	  <div class="tab-pane <?php if($activeNavItem == 'payments') echo "active"; ?>" id="payments">
		<?php echo CHtml::link('Add Payment', $this->createUrl('/payments/create', array('orderId' => $order->id))); ?>
		<?php 
			$this->renderPartial(
					'/payments/_list',
					array(
						'order'=>$order,
					)
				); 
		?>		  
	  </div>
	  <div class="tab-pane <?php if($activeNavItem == 'summary') echo "active"; ?>" id="summary">...</div>
	</div>
	
</div>




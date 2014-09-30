<?php
/* @var $this OrderdetailsController */
/* @var $model Orderdetails */

$this->breadcrumbs=array(
	'Orderdetails'=>array('index'),
	'New Order Detail',
);

$this->menu=array(
	// array('label'=>'List Orderdetails', 'url'=>array('index')),
	array('label'=>'Return to Order', 'url'=>$this->createUrl('orders/detail', array('id' => $order->id))),
);
?>

<h1>Create Orderdetails</h1>
<div class="row">
	<div class="span-8">
		<?php $this->renderPartial(
				'_form', 
				array(
					'model' => $model,
					'orderId' => $order->id,
				)
			); 
		?>
	</div>
	<div class="span-9">
		<h3>For Order #<?php echo $order->id; ?></h3>
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
</div>
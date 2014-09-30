<?php
/* @var $this PaymentsController */
/* @var $model Payments */

$this->breadcrumbs=array(
	'Payments'=>array('index'),
	'Create',
);

$this->menu=array(
	// array('label'=>'List Payments', 'url'=>array('index')),
	array('label'=>'Return to Order', 'url'=>$this->createUrl('orders/detail', array('id' => $model->orderId))),
);
?>

<h2>Add Payment</h2>

<div class="row">
	<div class="span-8">
	<?php 
		$this->renderPartial(
				'_form', 
				array(
					'model'=>$model, 
					'paymentTypes' => $paymentTypes
				)
			); 
	?>
	</div>
	<div class="span-9">
		<h3>P.O. # BC245<?php echo str_pad($order->id, 10, "0", STR_PAD_LEFT); ?></h3>
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
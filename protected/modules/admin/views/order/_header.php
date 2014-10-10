<?php
	echo CHtml::hiddenField('header-balance-due', $order->netAmount - $order->totalPayment, array('id' => 'header-balance-due'));
?>


<?php $this->widget('zii.widgets.CDetailView', array(
	'id' => 'po-header',
	'data'=>$order,
	'attributes'=>array(
		array(
			'label' => 'P.O. No.',
			'value' => 'BC245' . str_pad($order->id, 10, "0", STR_PAD_LEFT),
		),
		'dateCreated',
		'dateLastModified',
		'member.memberCode',
		array(
			'label' => 'Member Name',
			'value' => strtoupper(isset($order->member->fullName) ? $order->member->fullName : ''),
		),
		// 'user.username',
		array(
			'label' => 'Order Status',
			'value' => strtoupper(isset($order->orderStatus->description)? $order->orderStatus->description : ''),
		),
		'quantity',
		array(
			'label' => 'Gross Amount',
			'value' => 'Php ' . number_format($order->grossAmount, 2),
		),
		array(
			'label' => 'Min Required Deposit',
			'value' => 'Php ' . number_format($order->netAmount/2, 2),
		),
		array(
			'label' => 'Net Amount',
			'value' => 'Php ' . number_format($order->netAmount, 2),
		),
		array(
			'label' => 'Amount Paid',
			'value' => 'Php ' . number_format($order->totalPayment, 2),
		),
		array(
			'label' => 'Balance Due',
			'value' => 'Php ' . number_format($order->netAmount - $order->totalPayment, 2),
		),
	),
));
?>	
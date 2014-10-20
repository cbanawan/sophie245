<?php
	$totalAmountPaid = 0;
	foreach($payments as $payment)
	{
		$totalAmountPaid += $payment->amount;
	}

	$orderPayments = new CArrayDataProvider('Payments');
	$orderPayments->setData($payments);
	$gridColumns = array(
		array(
			'name' => 'dateCreated',
			'header' => 'Date Paid',
			'value' => 'date("d M Y H:i:s", strtotime($data->dateCreated))',
			'footer' => '<strong>TOTAL</strong>'
		),
		array(
			'name' => 'paymentType.description',
			'header' => 'Payment Type',
			'headerHtmlOptions'=>array('style'=>'text-align: center'),
			'value' => '$data->paymentType->description',
			'htmlOptions'=>array('style'=>'text-align: center'),
		),
		array(
			'name' => 'userId',
			'header' => 'Received By',
			'headerHtmlOptions'=>array('style'=>'text-align: center'),
			'value' => '$data->user->username',
			'htmlOptions'=>array('style'=>'text-align: center'),
		),
		array(
			'name' => 'amount',
			'header' => 'Amount Paid',
			'headerHtmlOptions'=>array('style'=>'text-align: right'),
			'value' => 'number_format($data->amount, 2)',
			'htmlOptions'=>array('style'=>'text-align: right'),
			'footer' => '<strong>' . number_format($totalAmountPaid, 2) . '</strong>',
			'footerHtmlOptions'=>array('class' => 'text-right'),
		),
		array(
			'name' => 'remarks',
			'header' => 'Remarks',
			'value' => '$data->remarks',
		),
	);	
	
	$this->widget(
		'booster.widgets.TbGridView',
		array(
			'id' => 'order-payments-grid',
			'type' => 'condensed',
			'dataProvider' => $orderPayments,
			'template' => '{items}',
			'columns' => $gridColumns,
		)
	);	
?>

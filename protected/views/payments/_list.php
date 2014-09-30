<?php 
$dataProvider = new CArrayDataProvider('Payments');
$dataProvider->setData($order->payments);

$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'payments-grid',
	'summaryText' => 'Total ({count}) payments made',
	'dataProvider'=>$dataProvider,
	// 'filter'=>$model,
	'columns'=>array(
		// 'paymentId',
		array(
			'name' => 'dateCreated',
			'header' => 'Date',
			'value' => 'date("d-M-Y", strtotime($data->dateCreated))',
			'footer' => '<strong>TOTAL:</strong>'
		),
		array(
			'name' => 'Payment Type',
			'value' => 'ucfirst($data->paymentType->name)',
			'htmlOptions'=>array('style'=>'text-align: center'),
		),
		array(
			'name' => 'Last Modified By',
			'value' => '$data->userId',
			'htmlOptions'=>array('style'=>'text-align: center'),
		),
		array(
			'name' => 'Amount Paid',
			'value' => 'number_format($data->amount, 2)',
			'htmlOptions'=>array('style'=>'text-align: right'),
			'footer' => '<strong>' . number_format($order->totalPayment, 2) . '</strong>',
			'footerHtmlOptions' => array('class'=>'text-right'),
		),
		array(
			'class'=>'CButtonColumn',
			'viewButtonUrl' => 'Yii::app()->controller->createUrl("payments/view", array("id" => $data->id))',
		),
	),
)); 

$orderDetailSummary = $order->orderDetailSummary;
?>

<div class="summary">
	<p class="text-right">
		<?php echo 'Amount Due: <strong>Php ' . number_format($orderDetailSummary['net'], 2) . '</strong>'; ?>
	   <br />
		<?php echo 'Total Payment: <strong>Php ' . number_format($order->totalPayment, 2) . '</strong>'; ?>
	   <br />
		<?php echo 'Balance Due: <strong>Php ' . number_format($orderDetailSummary['net'] - $order->totalPayment, 2) . '</strong>'; ?>
	</p>
</div>
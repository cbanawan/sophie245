<?php
$orderDetails = $order->orderdetails;

$totalAmount = 0;
$totalCatalogAmount = 0;
$quantity = 0;
foreach($orderDetails as $orderDetail)
{
	$quantity += $orderDetail->quantity;
	
	$amount = $orderDetail->product->catalogPrice * ( 1 - ( $orderDetail->discount / 100 ) );
	$amount *= $orderDetail->quantity;

	$totalCatalogAmount += $orderDetail->product->catalogPrice * $orderDetail->quantity;
	$totalAmount += $amount;
}

$requiredDeposit = $totalCatalogAmount / 2;
$balanceDue = $totalAmount - $requiredDeposit;

$dataProvider = new CArrayDataProvider('Orderdetails');
$dataProvider->setData($orderDetails);

$columns = array(
		array(
			'name' => 'Reference Code',
			'value' => '$data->product->code',
			'footer' => '<strong>TOTALS:</strong>'
		),
		array(
			'name' => 'Description',
			'value' => '$data->product->description',
		),
		array(
			'name' => 'Catalog Price',
			'value' => 'number_format($data->product->catalogPrice, 2)',
			'htmlOptions'=>array('style'=>'text-align: right'),
			'footer' => '<strong>' . number_format($totalCatalogAmount, 2) . '</strong>',
			'footerHtmlOptions'=>array('class' => 'text-right'),
		),
		array(
			'name' => 'Discount',
			'value' => '$data->discount',
			'htmlOptions'=>array('style'=>'text-align: right'),
		),
		array(
			'name' => 'Net Price',
			'value' => 'number_format($data->product->catalogPrice * ( 1 - ( $data->discount / 100 ) ), 2)',
			'htmlOptions'=>array('style'=>'text-align: right'),
		),
		array(
			'name' => 'Quantity',
			'value' => '$data->quantity',
			'htmlOptions'=>array('style'=>'text-align: center'),
			'footer' => '<strong>' . $quantity . '</strong>',
			'footerHtmlOptions'=>array('class' => 'text-center'),
		),
		array(
			'name' => 'Amount',
			'value' => 'number_format(( $data->product->catalogPrice * ( 1 - ( $data->discount / 100 ) ) ) * $data->quantity, 2 )',
			'htmlOptions'=>array('style'=>'text-align: right'),
			'footer' => '<strong>' . number_format($totalAmount, 2) . '</strong>',
			'footerHtmlOptions'=>array('class' => 'text-right'),
		),
		array(
			'name' => 'Status',
			'type' => 'raw',
			'value' => 'CHtml::link($data->orderDetailStatus->description, Yii::app()->controller->createUrl("/orderdetails/updateStatus", array("id" => $data->id)))',
		)
	);
if(!in_array($order->orderStatus->status, array('served', 'cancelled')))
{
	$columns[] = array(
			'class'=>'CButtonColumn',
			'template'=>'{delete}',
			'deleteButtonUrl' => 'Yii::app()->controller->createUrl("orderdetails/delete", array("id" => $data->id))',				
		);
}

$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'orders-grid',
	'enablePagination' => false,
	'summaryText' => 'Total ({count}) orders',
	'dataProvider'=>$dataProvider,
	// 'filter'=>$orderDetails,
	'columns'=> $columns,
)); 
?>

<div class="summary">
	<p class="text-right">
		<?php echo 'Required Deposit (50%): <strong>Php ' . number_format($requiredDeposit, 2) . '</strong>'; ?>
	   <br />
		<?php echo 'Balance (20%): <strong>Php ' . number_format($balanceDue, 2) . '</strong>'; ?>
	</p>
</div>
<?php
$orderDetails = $order->orderdetails;

$totalAmount = 0;
$totalCatalogAmount = 0;
$quantity = 0;
foreach($orderDetails as $orderDetail)
{
	if($orderDetail->orderDetailStatus->_active)
	{
		$quantity += $orderDetail->quantity;

		$amount = $orderDetail->product->catalogPrice * ( 1 - ( $orderDetail->discount / 100 ) );
		$amount *= $orderDetail->quantity;

		$totalCatalogAmount += $orderDetail->product->catalogPrice * $orderDetail->quantity;
		$totalAmount += $amount;
	}
}

$requiredDeposit = $totalCatalogAmount / 2;
$balanceDue = $totalAmount - $requiredDeposit;

$dataProvider = new CArrayDataProvider('Orderdetails');
$dataProvider->setData($orderDetails);

$columns = array(
		array(
			'name' => 'Reference Code',
			'type' => 'raw',
			'value' => '(!$data->orderDetailStatus->_active?"<del>":"") . $data->product->code . (!$data->orderDetailStatus->_active?"</del>":"")',
			'footer' => '<strong>TOTALS:</strong>'
		),
		array(
			'name' => 'Description',
			'type' => 'raw',
			'value' => '(!$data->orderDetailStatus->_active?"<del>":"") . $data->product->description . (!$data->orderDetailStatus->_active?"</del>":"") ',
		),
		array(
			'name' => 'Catalog Price',
			'type' => 'raw',
			'value' => '(!$data->orderDetailStatus->_active?"<del>":"") . number_format($data->product->catalogPrice, 2) . (!$data->orderDetailStatus->_active?"</del>":"")',
			'htmlOptions'=>array('style'=>'text-align: right'),
			'footer' => '<strong>' . number_format($totalCatalogAmount, 2) . '</strong>',
			'footerHtmlOptions'=>array('class' => 'text-right'),
		),
		array(
			'name' => 'Discount',
			'type' => 'raw',
			'value' => '(!$data->orderDetailStatus->_active?"<del>":"") . $data->discount . (!$data->orderDetailStatus->_active?"</del>":"")',
			'htmlOptions'=>array('style'=>'text-align: right'),
		),
		array(
			'name' => 'Net Price',
			'type' => 'raw',
			'value' => '(!$data->orderDetailStatus->_active?"<del>":"") . number_format($data->product->catalogPrice * ( 1 - ( $data->discount / 100 ) ), 2) . (!$data->orderDetailStatus->_active?"</del>":"")',
			'htmlOptions'=>array('style'=>'text-align: right'),
		),
		array(
			'name' => 'Quantity',
			'type' => 'raw',
			'value' => '(!$data->orderDetailStatus->_active?"<del>":"") . $data->quantity . (!$data->orderDetailStatus->_active?"</del>":"")',
			'htmlOptions'=>array('style'=>'text-align: center'),
			'footer' => '<strong>' . $quantity . '</strong>',
			'footerHtmlOptions'=>array('class' => 'text-center'),
		),
		array(
			'name' => 'Amount',
			'type' => 'raw',
			'value' => '(!$data->orderDetailStatus->_active?"<del>":"") . number_format(( $data->product->catalogPrice * ( 1 - ( $data->discount / 100 ) ) ) * $data->quantity, 2 ) . (!$data->orderDetailStatus->_active?"</del>":"")',
			'htmlOptions'=>array('style'=>'text-align: right'),
			'footer' => '<strong>' . number_format($totalAmount, 2) . '</strong>',
			'footerHtmlOptions'=>array('class' => 'text-right'),
		),
		array(
			'name' => 'Status',
			'type' => 'raw',
			'htmlOptions'=>array('style'=>'text-align: center'),
			'value' => '(!$data->orderDetailStatus->_active?"<del>".$data->orderDetailStatus->description."</del>":"")',
		)
	);
if(!in_array($order->orderStatus->status, array('served', 'cancelled')))
{
	$columns[] = array(
			'class'=>'CButtonColumn',
			'template'=>'{cancel}&nbsp;&nbsp;{out}',
			// 'deleteButtonUrl' => 'Yii::app()->controller->createUrl("orderdetails/delete", array("id" => $data->id))',
		    'buttons'=>array
			(
				'cancel' => array
				(
					'label' => 'Cancel',
					'imageUrl' => Yii::app()->request->baseUrl.'/images/icons/remove.png',
					'url' => 'Yii::app()->controller->createUrl("orderdetails/delete", array("id" => $data->id))',
					// 'visible'=>'$data->orderDetailStatus->_active',
				),
				'out' => array
				(
					'label'=>'[oos]',
					'imageUrl' => Yii::app()->request->baseUrl.'/images/icons/out-of-stock.png',
					'url' => 'Yii::app()->createUrl("orderdetails/updateStatus", array("id" => $data->id, "statusId" => 6))',
					'visible'=>'$data->orderDetailStatus->_active',
				),
			),
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
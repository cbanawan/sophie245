<?php
	$totalAmount = 0;
	foreach($orderDetails as $orderItem)
	{
		if($orderItem->orderDetailStatus->_active)
		{
			$totalAmount += ($orderItem->product->catalogPrice - ($orderItem->product->catalogPrice * ($orderItem->discount / 100 ))) * $orderItem->quantity;
		}
	}
	
	$orderItems = new CArrayDataProvider('Orderdetails');
	$orderItems->setData($orderDetails);
	$gridColumns = array(
		array('name' => 'dateCreated', 'header' => 'Date Created'),
		array('name' => 'product.codeName', 'header' => 'Item Description'),
		array(
			'name' => 'product.catalogPrice', 
			'header' => 'Catalog Price',
			'headerHtmlOptions'=>array('style'=>'text-align: right'),
			'value' => 'number_format($data->product->catalogPrice, 2)',
			'htmlOptions'=>array('style'=>'text-align: right'),
		),
		array(
			'name' => 'discount', 
			'header' => 'Discount',
			'headerHtmlOptions'=>array('style'=>'text-align: center'),
			'htmlOptions'=>array('style'=>'text-align: center'),
		),
		array(
			'name' => 'quantity', 
			'header' => 'Quantity',
			'headerHtmlOptions'=>array('style'=>'text-align: center'),
			'htmlOptions'=>array('style'=>'text-align: center'),
		),
		array(
			'name' => 'amount',
			'header' => 'Amount',
			'headerHtmlOptions'=>array('style'=>'text-align: right'),
			'value' => 'number_format(($data->product->catalogPrice - ($data->product->catalogPrice * ($data->discount / 100))) * $data->quantity, 2)',
			'htmlOptions'=>array('style'=>'text-align: right'),
			'footer' => '<strong> Php ' . number_format($totalAmount, 2) . '</strong>',
			'footerHtmlOptions' => array('style'=>'text-align: right'),
		),
		array(
			'name' => 'orderDetailStatus.description', 
			'header' => 'Order Status',
			'headerHtmlOptions'=>array('style'=>'text-align: center'),
			'htmlOptions'=>array('style'=>'text-align: center'),
		),
	);	
	
	if(!in_array($orderStatus, array('cancelled')))
	{
		$gridColumns[] = array(
			'header' => 'Action',
			'headerHtmlOptions' => array('style'=>'text-align: center'),
			'htmlOptions' => array('nowrap'=>'nowrap', 'style'=>'text-align: center', 'class' => 'action-button'),
			'class' => 'booster.widgets.TbButtonColumn',
			'template' => '{delete}',
			'deleteButtonUrl' => 'Yii::app()->createUrl("order/ajaxDeleteOrderItem", array("id" => $data->id))',
		);
	}
	
	$this->widget(
		'booster.widgets.TbGridView',
		array(
			'id' => 'order-items-grid',
			'type' => 'condensed',
			'dataProvider' => $orderItems,
			'template' => '{items}',
			'columns' => $gridColumns,
		)
	);	
?>

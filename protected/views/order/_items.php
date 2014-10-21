<?php
	$totalAmount = 0;
	$quantity = 0;
	foreach($orderDetails as $orderItem)
	{
		if($orderItem->orderDetailStatus->_active)
		{
			$totalAmount += ($orderItem->product->catalogPrice - ($orderItem->product->catalogPrice * ($orderItem->discount / 100 ))) * $orderItem->quantity;
			$quantity += $orderItem->quantity;
		}
	}
	
	$orderItems = new CArrayDataProvider('Orderdetails');
	$orderItems->setData($orderDetails);
	$gridColumns = array(
		array('name' => 'dateCreated', 'header' => 'Date Created',
				'type' => 'raw',
				'value' => '
						($data->orderDetailStatus->_active) ? $data->dateCreated
															: "<del>$data->dateCreated</del>"
					',
				'footer' => '<strong>TOTAL</strong>',
			),
		array('name' => 'product.codeName', 'header' => 'Item Description',
				'type' => 'raw',
				'value' => '
						($data->orderDetailStatus->_active) ? $data->product->codeName
															: "<del>" . $data->product->codeName. "</del>"
					'			
		),
		array(
			'name' => 'product.catalogPrice', 
			'header' => 'Catalog Price',
			'headerHtmlOptions'=>array('style'=>'text-align: right'),
			// 'value' => 'number_format($data->product->catalogPrice, 2)',
			'type' => 'raw',
			'value' => '
					($data->orderDetailStatus->_active) ? number_format($data->product->catalogPrice, 2)
														: "<del>" . number_format($data->product->catalogPrice, 2) . "</del>"
				',
			'htmlOptions'=>array('style'=>'text-align: right'),
		),
		array(
			'name' => 'discount', 
			'header' => 'Discount',
			'headerHtmlOptions'=>array('style'=>'text-align: center'),
			'htmlOptions'=>array('style'=>'text-align: center'),
			'type' => 'raw',
			'value' => '
					($data->orderDetailStatus->_active) ? $data->discount
														: "<del>" . $data->discount . "</del>"
				',
		),
		array(
			'name' => 'quantity', 
			'header' => 'Quantity',
			'headerHtmlOptions'=>array('style'=>'text-align: center'),
			'htmlOptions'=>array('style'=>'text-align: center'),
			'type' => 'raw',
			'value' => '
					($data->orderDetailStatus->_active) ? $data->quantity
														: "<del>" . $data->quantity . "</del>"
				',
			'footer' => '<strong>' . $quantity . '</strong>',
			'footerHtmlOptions' => array('style'=>'text-align: center'),
		),
		array(
			'name' => 'amount',
			'header' => 'Amount',
			'headerHtmlOptions'=>array('style'=>'text-align: right'),
			// 'value' => 'number_format(($data->product->catalogPrice - ($data->product->catalogPrice * ($data->discount / 100))) * $data->quantity, 2)',
			'type' => 'raw',
			'value' => '
					($data->orderDetailStatus->_active) ? number_format(($data->product->catalogPrice - ($data->product->catalogPrice * ($data->discount / 100))) * $data->quantity, 2)
														: "<del>" . number_format(($data->product->catalogPrice - ($data->product->catalogPrice * ($data->discount / 100))) * $data->quantity, 2) . "</del>"
				',
			'htmlOptions'=>array('style'=>'text-align: right'),
			'footer' => '<strong> Php ' . number_format($totalAmount, 2) . '</strong>',
			'footerHtmlOptions' => array('style'=>'text-align: right'),
		),
		array(
			'name' => 'orderDetailStatus.description', 
			'header' => 'Order Status',
			'headerHtmlOptions'=>array('style'=>'text-align: center'),
			'htmlOptions'=>array('style'=>'text-align: center'),
			'type' => 'raw',
			'value' => '
					($data->orderDetailStatus->_active) ? $data->orderDetailStatus->description
														: "<del>" . $data->orderDetailStatus->description . "</del>"
				',
		),
	);	
	
	if(!in_array($orderStatus, array('cancelled')))
	{
		$gridColumns[] = array(
			'header' => 'Action',
			'headerHtmlOptions' => array('style'=>'text-align: center'),
			'htmlOptions' => array('nowrap'=>'nowrap', 'style'=>'text-align: center', 'class' => 'action-button'),
			'class' => 'booster.widgets.TbButtonColumn',
			'template' => '{delete}&nbsp;&nbsp;{out}',
			'deleteButtonUrl' => 'Yii::app()->createUrl("order/ajaxDeleteOrderItem", array("id" => $data->id))',
			// 'viewButtonUrl' => 'Yii::app()->createUrl("order/ajaxDeleteOrderItem", array("id" => $data->id))',
			'buttons' => array(
				'out' => array(
					'url' => 'Yii::app()->createUrl("order/ajaxDeleteOrderItem", array("id" => $data->id))',
					'htmlOptions' => array(
						// '' => 'alert("xxxx"); return false;',
					)
				)
			)
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

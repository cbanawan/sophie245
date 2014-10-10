<?php 

Yii::app()->getClientScript()->registerCss("orderSelect", "
	.grid-view {
		padding: 0px;
	}
");

Yii::app()->getClientScript()->registerScript("icon-actions", "
	$('.remove-item-link').live('click', function() {
		// alert(this.href);
		
		var url = this.href;
		var action = (this.name == 'cancel') ? 'Delete Order Item' : 'Update Order Item Status';
		$('<div></div>').appendTo('body')
			.html('<div><h6>Are you sure?</h6></div>')
			.dialog({
				modal: true,
				title: action,
				zIndex: 10000,
				autoOpen: true,
				width: 'auto',
				resizable: false,
				buttons: {
					Yes: function () {
						// $(obj).removeAttr('onclick');                                
						// $(obj).parents('.Parent').remove();
						
						$.ajax({
						  type: 'GET',
						  url: url,
						})
						  .done(function( msg ) {
							$.fn.yiiGridView.update('orderdetails-grid');
						  });

						$(this).dialog('close');
					},
					No: function () {
						$(this).dialog('close');
					}
				},
				close: function (event, ui) {
					$(this).remove();
				}
			});
		return false;
	});
");
				
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

$dataProvider = new CArrayDataProvider('Orderdetails');
$dataProvider->setData($orderDetails);

$columns = array(
		array(
			'name' => 'dateCreated',
			'header' => 'Date Created',
			'type' => 'raw',
			'value' => '
				(!$data->orderDetailStatus->_active)
					?  "<del>" . date("d M Y", strtotime($data->dateCreated)) . "</del>"
					: date("d M Y", strtotime($data->dateCreated))
			',
			'footer' => '<strong>TOTALS:</strong>'
		),
		array(
			'name' => 'product.description',
			'header' => 'Description',
			'type' => 'raw',
			'value' => '
				(!$data->orderDetailStatus->_active)
					?  "<del>" . $data->product->codename . "</del>"
					: $data->product->codename
			',
		),
		array(
			'name' => 'quantity',
			'header' => 'Quantity',
			'type' => 'raw',
			'value' => '
				(!$data->orderDetailStatus->_active)
					?  "<del>" . $data->quantity . "</del>"
					: $data->quantity
			',
			'htmlOptions'=>array('style'=>'text-align: center'),
			'footer' => '<strong>' . $quantity . '</strong>',
			'footerHtmlOptions'=>array('class' => 'text-center'),
		),
		array(
			'name' => 'catalogPrice',
			'header' => 'Catalog Price',
			'type' => 'raw',
			'value' => '
				(!$data->orderDetailStatus->_active)
					?  "<del>" . number_format($data->product->catalogPrice, 2) . "</del>"
					: number_format($data->product->catalogPrice, 2)
			',
			'htmlOptions'=>array('style'=>'text-align: right'),
			'footer' => '<strong>' . number_format($totalCatalogAmount, 2) . '</strong>',
			'footerHtmlOptions'=>array('class' => 'text-right'),
		),
		array(
			'name' => 'discount',
			'header' => 'Discount',
			'htmlOptions'=>array('style'=>'text-align: center'),
			'type' => 'raw',
			'value' => '
				(!$data->orderDetailStatus->_active)
					?  "<del>" . $data->discount . "</del>"
					: $data->discount
			',
		),
		array(
			'name' => 'netPrice',
			'header' => 'Net Price',
			'htmlOptions'=>array('style'=>'text-align: right'),
			'type' => 'raw',
			'value' => '
				(!$data->orderDetailStatus->_active)
					?  "<del>" . number_format($data->product->catalogPrice - ($data->product->catalogPrice * ($data->discount / 100)), 2) . "</del>"
					: number_format($data->product->catalogPrice - ($data->product->catalogPrice * ($data->discount / 100)), 2)
			',
		),
		array(
			'name' => 'amount',
			'header' => 'Amount',
			'htmlOptions'=>array('style'=>'text-align: right'),
			'type' => 'raw',
			'value' => '
				(!$data->orderDetailStatus->_active)
					?  "<del>" . number_format(($data->product->catalogPrice - ($data->product->catalogPrice * ($data->discount / 100))) * $data->quantity, 2) . "</del>"
					: number_format(($data->product->catalogPrice - ($data->product->catalogPrice * ($data->discount / 100))) * $data->quantity, 2)
			',
			'footer' => '<strong>' . number_format($totalAmount, 2) . '</strong>',
			'footerHtmlOptions'=>array('class' => 'text-right'),
		),
		array(
			'name' => 'status',
			'header' => 'Status',
			'htmlOptions'=>array('style'=>'text-align: center'),
			'type' => 'raw',
			'value' => '
				($data->orderDetailStatus->status == "outOfStock")
					?  "<del>" . $data->orderDetailStatus->description . "</del>"
					: $data->orderDetailStatus->description
			',
		),
	);

if(!in_array($orderStatus, array('served', 'cancelled', 'ordered')))
{
	$columns[] = array(
			'class'=>'CButtonColumn',
			'template'=>'{cancel}&nbsp;&nbsp;{out}',
		    'buttons'=>array
			(
				'cancel' => array
				(
					'label' => 'Cancel',
					'name' => 'cancel',
					'imageUrl' => Yii::app()->request->baseUrl.'/images/icons/remove.png',
					'url' => 'Yii::app()->createUrl("admin/order/ajaxDeleteOrderItem", array("id" => $data->id))',
					'visible'=>'$data->orderDetailStatus->status != "served"',
					'options' => array(
						'class' => 'remove-item-link',
						// 'onclick' => 'return false;',
					),
				),
				'out' => array
				(
					'label'=>'Out Of Stock',
					'name' => 'out-of-stock',
					'imageUrl' => Yii::app()->request->baseUrl.'/images/icons/out-of-stock.png',
					'url' => 'Yii::app()->createUrl("admin/order/ajaxUpdateOrderItemStatus", array("id" => $data->id))',
					'visible'=>'$data->orderDetailStatus->status != "served"',
					'options' => array(
						'class' => 'remove-item-link',
					)
				),
			),
		);
}

$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'orderdetails-grid',
	'dataProvider' => $dataProvider,
	'emptyText' => 'There are NO added Products on this Order.',
	'template' => '{items}{pager}', 
	// 'filter'=>$model,
	'columns' => $columns,

)); 
?>


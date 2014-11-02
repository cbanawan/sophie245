<?php
$gridColumns = array(
	'id',
	'code',
	'description',
	'catalogPrice',
	'netPrice',
	'quantity',
	'status'
	/*array(
		'name' => 'description',
		'header' => 'Description',
	),
	array(
		'name' => 'quantity',
		'header' => 'Quantity',
	),*/
);

	$bulkActions = array(
		'actionButtons' => array(
			array(
				'id' => 'btnCheckProducts',
				'buttonType' => 'button',
				'context' => 'primary',
				'size' => 'small',
				'label' => 'Mark Items Out-Of-Stock',
				'click' => "js:function(values){
					// alert(values); return false;
					var data = {
						poId: " . $pOrder->id . ",
						data: values
					};
					// $.fn.yiiGridView.update('order-items-grid');
					$.ajax({
						url: '" . Yii::app()->createUrl('admin/purchaseOrder/ajaxOrderOutOfStock') . "',
						dataType: 'json',
						data: data,
						type: 'POST',
						success: function (result) {
							$.fn.yiiGridView.update('po-products-grid');
						},
					});								
				}"
			)
		),
		// if grid doesn't have a checkbox column type, it will attach
		// one and this configuration will be part of it
		'checkBoxColumnConfig' => array(
			'name' => 'id',
			'id' => 'products',
		),
	);

$products = new CArrayDataProvider('ProductOrders');
$products->setData($productOrders);		
// var_dump($products);

$this->widget('booster.widgets.TbExtendedGridView', array(
	'id' => 'po-products-grid',
	'type' => 'striped bordered',
	'selectableRows' => 2,
	'dataProvider' => $products,
	'template' => "{items}",
	'bulkActions' => in_array($pOrder->orderStatus->status, array('ordered', 'delivered')) ? array() : $bulkActions,
	'columns' => $gridColumns,
));	
?>
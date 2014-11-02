<?php
	$gridColumns = array(
		array(
			'name' => 'id',
			'header' => 'Order ID',
		),
		array(
			'name' => 'dateCreated',
			'header' => 'Date Created',
		),
		array(
			'name' => 'member.codeName',
			'header' => 'Member',
		),
		array(
			'name' => 'netAmount',
			'header' => 'Total Amount',
		),
		array(
			'name' => 'totalPayment',
			'header' => 'Amount Paid',
		),
		array(
			'name' => 'orderStatus.description',
			'header' => 'Status',
		),
	);
	
	$bulkActions = array(
			'actionButtons' => array(
				array(
					'id' => 'btnCheck',
					'buttonType' => 'button',
					'context' => 'primary',
					'size' => 'small',
					'label' => 'Remove Selected From P.O.',
					'visible' => 'false',
					'click' => "js:function(values){
						var data = {
							data: values
						};
						// $.fn.yiiGridView.update('order-items-grid');
						$.ajax({
							url: '" . Yii::app()->createUrl('admin/purchaseOrder/ajaxDeleteOrder') . "',
							dataType: 'json',
							data: data,
							type: 'POST',
							success: function (result) {
								$.fn.yiiGridView.update('po-orders-grid');
							},
						});	
					}"
				)
			),
				// if grid doesn't have a checkbox column type, it will attach
				// one and this configuration will be part of it
			'checkBoxColumnConfig' => array(
				'name' => 'id',
				'id' => 'orders',
			),
		);

	$orderItems = new CArrayDataProvider('Orders');
	$orderItems->setData($pOrder->orders);		

	$this->widget('booster.widgets.TbExtendedGridView', array(
		'id' => 'po-orders-grid',
		'type' => 'striped bordered',
		'dataProvider' => $orderItems,
		'template' => "{items}",
		'selectableRows' => 1,
		'bulkActions' => in_array($pOrder->orderStatus->status, array('ordered', 'delivered')) ? array() : $bulkActions,
		'columns' => $gridColumns,
	));	
	?>
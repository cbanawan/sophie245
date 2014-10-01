<?php
/* @var $this OrdersController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Orders',
);

$this->menu=array(
	array('label'=>'Create New Order', 'url'=>array('create')),
	// array('label'=>'Manage Orders', 'url'=>array('index')),
);
?>

<h3>Orders</h3>

<?php 
	$dataProvider = new CArrayDataProvider('Orders');
	$dataProvider->setData($orders);
	
	$this->widget('zii.widgets.grid.CGridView', array(
		'id'=>'orders-grid',
		'dataProvider'=>$dataProvider,
		'columns'=>array(
			// 'id',
			array(
				'name' => 'dateCreated',
				'header' => 'Date',
				'value' => 'date("m/d/Y", strtotime($data->dateCreated))',
			),
			// 'dateLastModified',
			array(
				'name' => 'memberCode',
				'header' => 'Member Code',
				'value' => '$data->member->memberCode'
			),
			array(
				'name' => 'Member',
				'value' => '$data->member->lastName . ", " . $data->member->firstName'
			),
			// 'user.username',
			array(
				'name' => 'Status',
				'value' => '$data->orderStatus->status'
			),
			array(
				'name' => 'Total Items',
				'type' => 'raw',
				'value' => '$data->orderDetailSummary["items"]',
				'htmlOptions' => array(
					'class' => 'text-center'
				)
			),
			array(
				'name' => 'Gross Amount',
				'type' => 'raw',
				'value' => 'number_format($data->orderDetailSummary["gross"], 2)',
				'htmlOptions' => array(
					'class' => 'text-right'
				)
			),
			array(
				'name' => 'Net Amount',
				'type' => 'raw',
				'value' => 'number_format($data->orderDetailSummary["net"], 2)',
				'htmlOptions' => array(
					'class' => 'text-right'
				)
			),
			array(
				'name' => 'Amount Paid',
				'type' => 'raw',
				'value' => 'number_format($data->totalPayment, 2)',
				'htmlOptions' => array(
					'class' => 'text-right'
				)
			),
			array(
				'class'=>'CButtonColumn',
				'template'=>'{view}',
				'viewButtonUrl' => 'Yii::app()->controller->createUrl("detail", array("id" => $data->id))',
			),
		),
	)); 
?>

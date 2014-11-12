<?php
/* @var $this OrderController */

	$this->breadcrumbs=array(
		'Sales Order' => array('order/index'),
		'New Order',
	);
?>

<?php $this->beginWidget(
	'booster.widgets.TbPanel',
	array(
		'title' => 'New Order Form',
		'headerIcon' => 'list-alt',
		'htmlOptions' => array('class' => 'bootstrap-widget-table'),
	)
); ?>

	<?php $this->renderPartial('_orderForm', 
		array(
			'orderModel' => $orderModel,
			'memberModel' => $memberModel,
			'memberDataProvider' => $memberDataProvider
		)); ?>

<?php $this->endWidget(); ?>

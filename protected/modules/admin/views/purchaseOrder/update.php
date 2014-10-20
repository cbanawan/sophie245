<?php
/* @var $this PurchaseOrderController */
/* @var $model PurchaseOrders */

$this->breadcrumbs=array(
	'Purchase Orders'=>array('admin'),
	'Update Purchase Order',
);

$this->menu=array(
	array('label'=>'List PurchaseOrders', 'url'=>array('index')),
	array('label'=>'Manage PurchaseOrders', 'url'=>array('admin')),
);
?>

<h3>Update PurchaseOrders</h3>

<?php 
	$this->widget('zii.widgets.CDetailView', array(
		'data'=>$model,
		'attributes'=>array(
			'id',
			'dateCreated',
			'dateLastModified',
			'dateOrdered',
			'userId',
			'orderStatusId',
		),
	));

	$this->renderPartial('_form', array('model'=>$model, 'orders' => $orders)); 
?>
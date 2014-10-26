<?php
/* @var $this PurchaseOrderController */
/* @var $model PurchaseOrders */

$this->breadcrumbs=array(
	'Purchase Orders'=>array('admin'),
	'Create New Purchase Order',
);

$this->menu=array(
	array('label'=>'List PurchaseOrders', 'url'=>array('index')),
	array('label'=>'Manage PurchaseOrders', 'url'=>array('admin')),
);
?>

<?php $this->renderPartial('_form', array('model'=>$model, 'orders' => $orders)); ?>
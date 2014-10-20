<?php
/* @var $this ProductController */
/* @var $model Products */

$this->breadcrumbs=array(
	'Products'=>array('admin'),
	$model->id,
	'Update'=>array('update', 'id' => $model->id),
);

$this->menu=array(
	array('label'=>'List Products', 'url'=>array('index')),
	array('label'=>'Create Products', 'url'=>array('create')),
	array('label'=>'Update Products', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Products', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Products', 'url'=>array('admin')),
);
?>

<h3><?php echo $model->description . ' (' . $model->code . ')'; ?></h3>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'code',
		'description',
		'catalogPrice',
		'netPriceDiscount',
		'stocksOnHand',
		'productGroupId',
		'catalogId',
		'_outOfStocksUp',
	),
)); ?>

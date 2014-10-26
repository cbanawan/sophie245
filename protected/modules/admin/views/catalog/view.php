<?php
/* @var $this CatalogController */
/* @var $model Catalogs */

$this->breadcrumbs=array(
	'Catalogs' => array('admin'),
	$model->name,
	'Upload Catalog Products' => array('/admin/product/upload', 'catId' => $model->id),
);

$this->menu=array(
	array('label'=>'List Catalogs', 'url'=>array('index')),
	array('label'=>'Create Catalogs', 'url'=>array('create')),
	array('label'=>'Update Catalogs', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Catalogs', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Catalogs', 'url'=>array('admin')),
);
?>

<h1>View Catalogs #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'dateReleased',
		'dateCreated',
		'dateLastModified',
		'name',
		'_current',
	),
)); ?>

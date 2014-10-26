<?php
/* @var $this CatalogController */
/* @var $model Catalogs */

$this->breadcrumbs=array(
	'Catalogs'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Catalogs', 'url'=>array('index')),
	array('label'=>'Manage Catalogs', 'url'=>array('admin')),
);
?>

<h1>Create Catalogs</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
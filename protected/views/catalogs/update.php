<?php
/* @var $this CatalogsController */
/* @var $model Catalogs */

$this->breadcrumbs=array(
	'Catalogs'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Catalogs', 'url'=>array('index')),
	array('label'=>'Create Catalogs', 'url'=>array('create')),
	array('label'=>'View Catalogs', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Catalogs', 'url'=>array('admin')),
);
?>

<h1>Update Catalogs <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
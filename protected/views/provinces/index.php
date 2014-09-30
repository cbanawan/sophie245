<?php
/* @var $this ProvincesController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Provinces',
);

$this->menu=array(
	array('label'=>'Create Provinces', 'url'=>array('create')),
	array('label'=>'Manage Provinces', 'url'=>array('admin')),
);
?>

<h1>Provinces</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>

<?php
/* @var $this OrderstatusController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Orderstatuses',
);

$this->menu=array(
	array('label'=>'Create Orderstatus', 'url'=>array('create')),
	array('label'=>'Manage Orderstatus', 'url'=>array('admin')),
);
?>

<h1>Orderstatuses</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>

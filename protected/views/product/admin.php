<?php
/* @var $this ProductController */
/* @var $model Products */

$this->breadcrumbs=array(
	'Manage',
	'Search' => array('search'),
	'Update Critical' => array('updateCritical')
);

Yii::app()->clientScript->registerScript('search', "
	$('.search-button').click(function(){
		$('.search-form').toggle();
		return false;
	});
	$('.search-form form').submit(function(){
		$('#products-grid').yiiGridView('update', {
			data: $(this).serialize()
		});
		return false;
	});
");
?>

<h3>Manage Products</h3>

<p class="alert alert-info">
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('booster.widgets.TbGridView', array(
	'id'=>'products-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'code',
		'description',
		'catalogPrice',
		'netPriceDiscount',
		'stocksOnHand',
		array(
			'name' => '_active',
			'value' => '$data->_active ? "Yes" : "No"',
		),
		/*
		'productGroupId',
		'catalogId',
		'_outOfStocksUp',
		*/
		array(
			'class' => 'booster.widgets.TbButtonColumn',
			'template'=>'{view}&nbsp;&nbsp;{update}'
		),
	),
)); ?>

<?php
/* @var $this OrderController */

	$this->breadcrumbs=array(
		'Sales Order' => array('order/index'),
		'New Order',
	);

	$this->menu = array(
		array(
			'label' => 'Manage Orders',
			'url' => Yii::app()->createUrl('admin/order'),
		),
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
				'model'=>$model,
				'members'=>$members,
				'users'=>$users,
				'orderStatus'=>$orderStatus,
				'catalogs'=>$catalogs,
			)); ?>
<?php $this->endWidget(); ?>

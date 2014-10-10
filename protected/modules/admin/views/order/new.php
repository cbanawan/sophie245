<?php
/* @var $this OrderController */

	$this->breadcrumbs=array(
		'Admin' => array('default/index'),
		'Purchase Order' => array('order/index'),
		'New Order',
	);

	$this->menu = array(
		array(
			'label' => 'Manage Orders',
			'url' => Yii::app()->createUrl('admin/order'),
		),
	);
?>
<div class="row">
	<div class="span12">
	<?php $this->beginWidget('zii.widgets.CPortlet', array(
			'title'=>'New Order Form',
		));?>
			<?php $this->renderPartial('_form', 
				array(
					'model'=>$model,
					'members'=>$members,
					'users'=>$users,
					'orderStatus'=>$orderStatus,
				)); ?>
	<?php $this->endWidget(); ?>
	</div>
</div>

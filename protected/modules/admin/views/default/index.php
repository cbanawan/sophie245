<?php
	$this->menu = array(
		array(
			'label' => 'Purchase Order',
			'url' => Yii::app()->createUrl('admin/order/index'),
		),
		array(
			'label' => 'Members',
			'url' => '#',
		),
		array(
			'label' => 'Products',
			'url' => Yii::app()->createUrl('admin/product/index'),
		),
		array(
			'label' => 'Reports',
			'url' => '#',
		),
	);
?>

<h1>Sophie Paris Mactan BC 245</h1>
<h3>Sophie Ordering System</h3>

<?php $this->beginWidget('zii.widgets.CPortlet', array(
		'title'=>'Test Portlet',
	)); ?>	


<?php $this->endWidget(); ?>
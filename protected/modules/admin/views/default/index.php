<?php
	$this->menu = array(
		array(
			'label' => 'Purchase Order',
			'url' => Yii::app()->createUrl('admin/order/index'),
		),
		array(
			'label' => 'Members',
			'url' => Yii::app()->createUrl('admin/member/admin'),
		),
		array(
			'label' => 'Products',
			'url' => '#',
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
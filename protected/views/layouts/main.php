<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body style="padding-top: 70px;">

<?php
	$this->widget(
		'booster.widgets.TbNavbar',
		array(
			'brand' => '<strong>Sophie BC 245</strong>',
			'fixed' => 'top',
			'fluid' => true,
			'items' => array(
				array(
					'class' => 'booster.widgets.TbMenu',
					'type' => 'navbar',
					'items' => array(
						array('label'=>'Dashboard', 'url'=>array('/site/index')),
						array('label'=>'Sales Order', 'url'=>array('/order/index'), 'visible'=>!Yii::app()->user->isGuest),
						array('label'=>'Purchase Order', 'url'=>array('/admin/purchaseOrder/admin'), 'visible'=>!Yii::app()->user->isGuest),
						array('label'=>'Delivery', 'url'=>array('/admin/delivery/admin'), 'visible'=>!Yii::app()->user->isGuest),
						array('label'=>'Member', 'url'=>array('/member/admin'), 'visible'=>!Yii::app()->user->isGuest),
						array('label'=>'Product', 'url'=>array('/product/admin'), 'visible'=>!Yii::app()->user->isGuest),
						// array('label'=>'About', 'url'=>array('/site/page', 'view'=>'about')),
						// array('label'=>'Contact', 'url'=>array('/site/contact')),
						array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
						array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest)
					)
				)
			)
		)
	);	
?>
<div class="container-fluid">	
	<?php $this->widget('ext.widgets.loading.LoadingWidget'); ?>
	<div id="breadCrumb">
	<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('booster.widgets.TbBreadcrumbs', array(
				'links'=>$this->breadcrumbs,
			)); ?><!-- breadcrumbs -->
	<?php endif?>
	</div>
	
	<?php echo $content; ?>

	<div class="clear"></div>

	<div id="footer">
		Copyright &copy; <?php echo date('Y'); ?> by My Company.<br/>
		All Rights Reserved.<br/>
		<?php echo Yii::powered(); ?>
	</div><!-- footer -->

</div><!-- page -->

</body>
</html>

<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
?>

<h1>Welcome to <i><?php echo CHtml::encode(Yii::app()->name); ?></i></h1>

<p>Please select a transaction:</p>
<ul>
	<li><?php echo CHtml::link('Manage Orders', $this->createUrl('/orders/admin')); ?></li>
	<li><?php echo CHtml::link('Manage Members', $this->createUrl('/members/admin')); ?></li>
</ul>
<?php
/* @var $this ProductController */
/* @var $data Products */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('code')); ?>:</b>
	<?php echo CHtml::encode($data->code); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('description')); ?>:</b>
	<?php echo CHtml::encode($data->description); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('catalogPrice')); ?>:</b>
	<?php echo CHtml::encode($data->catalogPrice); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('netPriceDiscount')); ?>:</b>
	<?php echo CHtml::encode($data->netPriceDiscount); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('stocksOnHand')); ?>:</b>
	<?php echo CHtml::encode($data->stocksOnHand); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('productGroupId')); ?>:</b>
	<?php echo CHtml::encode($data->productGroupId); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('catalogId')); ?>:</b>
	<?php echo CHtml::encode($data->catalogId); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('_outOfStocksUp')); ?>:</b>
	<?php echo CHtml::encode($data->_outOfStocksUp); ?>
	<br />

	*/ ?>

</div>
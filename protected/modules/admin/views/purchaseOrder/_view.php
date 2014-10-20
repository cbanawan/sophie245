<?php
/* @var $this PurchaseOrderController */
/* @var $data PurchaseOrders */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('dateCreated')); ?>:</b>
	<?php echo CHtml::encode($data->dateCreated); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('dateLastModified')); ?>:</b>
	<?php echo CHtml::encode($data->dateLastModified); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('dateOrdered')); ?>:</b>
	<?php echo CHtml::encode($data->dateOrdered); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('userId')); ?>:</b>
	<?php echo CHtml::encode($data->userId); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('orderStatusId')); ?>:</b>
	<?php echo CHtml::encode($data->orderStatusId); ?>
	<br />


</div>
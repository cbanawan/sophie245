<?php
/* @var $this DeliveryController */
/* @var $data Deliveries */
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

	<b><?php echo CHtml::encode($data->getAttributeLabel('dateDelivered')); ?>:</b>
	<?php echo CHtml::encode($data->dateDelivered); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('purchaseOrderId')); ?>:</b>
	<?php echo CHtml::encode($data->purchaseOrderId); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('receivedBy')); ?>:</b>
	<?php echo CHtml::encode($data->receivedBy); ?>
	<br />


</div>
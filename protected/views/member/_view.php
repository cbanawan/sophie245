<?php
/* @var $this MemberController */
/* @var $data Members */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('memberCode')); ?>:</b>
	<?php echo CHtml::encode($data->memberCode); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('firstName')); ?>:</b>
	<?php echo CHtml::encode($data->firstName); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('lastName')); ?>:</b>
	<?php echo CHtml::encode($data->lastName); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('middleName')); ?>:</b>
	<?php echo CHtml::encode($data->middleName); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sponsorId')); ?>:</b>
	<?php echo CHtml::encode($data->sponsorId); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('_active')); ?>:</b>
	<?php echo CHtml::encode($data->_active); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('homePhone')); ?>:</b>
	<?php echo CHtml::encode($data->homePhone); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('mobilePhone')); ?>:</b>
	<?php echo CHtml::encode($data->mobilePhone); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('emailAddress')); ?>:</b>
	<?php echo CHtml::encode($data->emailAddress); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('address1')); ?>:</b>
	<?php echo CHtml::encode($data->address1); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('address2')); ?>:</b>
	<?php echo CHtml::encode($data->address2); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cityId')); ?>:</b>
	<?php echo CHtml::encode($data->cityId); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('dateJoined')); ?>:</b>
	<?php echo CHtml::encode($data->dateJoined); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sponsorCode')); ?>:</b>
	<?php echo CHtml::encode($data->sponsorCode); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('position')); ?>:</b>
	<?php echo CHtml::encode($data->position); ?>
	<br />

	*/ ?>

</div>
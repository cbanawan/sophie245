<?php
/* @var $this DeliveryController */
/* @var $model Deliveries */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'dateCreated'); ?>
		<?php echo $form->textField($model,'dateCreated'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'dateLastModified'); ?>
		<?php echo $form->textField($model,'dateLastModified'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'dateDelivered'); ?>
		<?php echo $form->textField($model,'dateDelivered'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'purchaseOrderId'); ?>
		<?php echo $form->textField($model,'purchaseOrderId'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'receivedBy'); ?>
		<?php echo $form->textField($model,'receivedBy'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
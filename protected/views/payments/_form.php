<?php
/* @var $this PaymentsController */
/* @var $model Payments */
/* @var $form CActiveForm */
?>

<?php 
	Yii::app()->getClientScript()->registerCoreScript('jquery.ui');
	Yii::app()->clientScript->registerCssFile(
		Yii::app()->clientScript->getCoreScriptUrl().
		'/jui/css/base/jquery-ui.css'
	);
	
	Yii::app()->getClientScript()->registerScript("dateCreated", "
		$(function() {
			$('#dateCreated').datepicker({dateFormat: 'yy-mm-dd'});
		});		
		
		$( document ).ready(function() {
			$('#amount').focus();
		});
	");	
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'payments-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>
	
	<?php echo $form->hiddenField($model,'orderId'); ?>
	<?php echo $form->hiddenField($model,'userId'); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'dateCreated'); ?>
		<?php echo $form->textField($model,'dateCreated',array('id'=>'dateCreated', 'class'=>'span-3')); ?>
		<?php echo $form->error($model,'dateCreated'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'amount'); ?>
		<?php echo $form->textField($model,'amount', array('id'=>'amount','class'=>'span-3 text-right')); ?>
		<?php echo $form->error($model,'amount'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'paymentTypeId'); ?>
		<?php echo $form->dropDownList($model,'paymentTypeId', $paymentTypes); ?>
		<?php echo $form->error($model,'paymentTypeId'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'remarks'); ?>
		<?php echo $form->textArea($model,'remarks'); ?>
		<?php echo $form->error($model,'remarks'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
		<?php echo CHtml::button('Cancel', array('submit' => $this->createUrl('orders/detail', array('id' => $model->orderId, 'navItem' => 'payments')))); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
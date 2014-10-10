<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'payments-form',
	'method'=>'post',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	// 'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model); ?>
	
	<?php echo $form->hiddenField($model,'orderId'); ?>
	<?php echo $form->hiddenField($model,'userId'); ?>

	<!--
	<div class="row">
		<?php echo $form->labelEx($model,'paymentTypeId'); ?>
		<?php echo $form->dropDownList($model,'paymentTypeId', $paymentTypes); ?>
		<?php echo $form->error($model,'paymentTypeId'); ?>
	</div>
	//-->

	<div class="row">
		<?php echo $form->labelEx($model,'amount'); ?>
		<?php echo $form->textField($model,'amount', array('id'=>'amount','class'=>'span-4 text-right input-small')); ?>
		<p class="help-block">Balance Due: Php <span id="balance-due"></span></p>
		<?php echo $form->error($model,'amount'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'dateCreated'); ?>
		<?php // echo $form->textField($model,'dateCreated',array('id'=>'dateCreated', 'class'=>'span-3')); ?>
		<?php // echo $form->error($model,'dateCreated'); ?>
		<?php
			$this->widget('zii.widgets.jui.CJuiDatePicker',array(
				'name'=>'dateCreated',
				// additional javascript options for the date picker plugin
				'value'=>date('Y-m-d'),
				'options'=>array(
					'showAnim'=>'fold',
				),
				'htmlOptions'=>array(
					'style' => 'height:20px;',
					'class' => 'span-4'
				),
			));	
		?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'remarks'); ?>
		<?php echo $form->textArea($model,'remarks'); ?>
		<?php echo $form->error($model,'remarks'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Submit', array('class' => 'btn btn-mini')); ?>
		<?php echo CHtml::resetButton('Clear', array('id' => 'btnClearPayment', 'class' => 'btn btn-mini')); ?>
		<?php echo CHtml::Button('Close', array('id' => 'btnClose', 'onclick'=>'$("#payment-dialog").dialog("close"); return false;', 'class' => 'btn btn-mini')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
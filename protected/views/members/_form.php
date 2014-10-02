<?php
/* @var $this MembersController */
/* @var $model Members */
/* @var $form CActiveForm */
?>

<?php 
	Yii::app()->getClientScript()->registerCoreScript('jquery.ui');
	Yii::app()->clientScript->registerCssFile(
		Yii::app()->clientScript->getCoreScriptUrl().
		'/jui/css/base/jquery-ui.css'
	);

	Yii::app()->getClientScript()->registerScript("dateJoined", "
		$( document ).ready(function() {
			$('#dateJoined').datepicker({dateFormat: 'yy-mm-dd'});
			$('#memberCode').focus();
		});		
	");
?>	

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'members-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php 
		echo $form->errorSummary($model); 
		echo $form->hiddenField($model,'sponsorId', array('value' => '1'));
		
	?>

	<div class="row">
		<div class="span-6">
			<div class="row">
				<?php echo $form->labelEx($model,'memberCode'); ?>
				<?php echo $form->textField($model,'memberCode',array('id' => 'memberCode', 'size'=>10,'maxlength'=>10)); ?>
				<?php echo $form->error($model,'memberCode'); ?>
			</div>

			<div class="row">
				<?php echo $form->labelEx($model,'firstName'); ?>
				<?php echo $form->textField($model,'firstName',array('size'=>45,'maxlength'=>45)); ?>
				<?php echo $form->error($model,'firstName'); ?>
			</div>

			<div class="row">
				<?php echo $form->labelEx($model,'lastName'); ?>
				<?php echo $form->textField($model,'lastName',array('size'=>45,'maxlength'=>45)); ?>
				<?php echo $form->error($model,'lastName'); ?>
			</div>

			<div class="row">
				<?php echo $form->labelEx($model,'sponsorCode'); ?>
				<?php echo $form->textField($model,'sponsorCode'); ?>
				<?php echo $form->error($model,'sponsorCode'); ?>
			</div>
			<div class="row buttons">
				<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
				<?php echo CHtml::button('Cancel', array('submit' => $this->createUrl('members/admin'))); ?>
			</div>			
		</div>
		<div class="span-6">		
			<div class="row">
				<?php echo $form->labelEx($model,'homePhone'); ?>
				<?php echo $form->textField($model,'homePhone',array('size'=>13,'maxlength'=>13)); ?>
				<?php echo $form->error($model,'homePhone'); ?>
			</div>

			<div class="row">
				<?php echo $form->labelEx($model,'mobilePhone'); ?>
				<?php echo $form->textField($model,'mobilePhone',array('size'=>13,'maxlength'=>13)); ?>
				<?php echo $form->error($model,'mobilePhone'); ?>
			</div>

			<div class="row">
				<?php echo $form->labelEx($model,'emailAddress'); ?>
				<?php echo $form->textField($model,'emailAddress',array('size'=>60,'maxlength'=>100)); ?>
				<?php echo $form->error($model,'emailAddress'); ?>
			</div>

			<div class="row">
				<?php echo $form->labelEx($model,'dateJoined'); ?>
				<?php echo $form->textField($model,'dateJoined',array('id' => 'dateJoined', 'class'=>'span-3')); ?>
				<?php echo $form->error($model,'dateJoined'); ?>
			</div>
		</div>
	</div>


<?php $this->endWidget(); ?>

</div><!-- form -->
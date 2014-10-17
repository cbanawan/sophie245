<?php
/* @var $this MemberController */
/* @var $model Members */
/* @var $form CActiveForm */
?>

<?php $this->beginWidget('zii.widgets.CPortlet', array(
	'title'=>$title,
)); ?>

<div class="form container-fluid">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'members-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<div class="span12">
			<div class="span4">
				<?php echo $form->labelEx($model,'memberCode'); ?>
				<?php echo $form->textField($model,'memberCode',array('size'=>10,'maxlength'=>10)); ?>
				<?php echo $form->error($model,'memberCode'); ?>

				<?php echo $form->labelEx($model,'firstName'); ?>
				<?php echo $form->textField($model,'firstName',array('maxlength'=>255)); ?>
				<?php echo $form->error($model,'firstName'); ?>

				<?php echo $form->labelEx($model,'lastName'); ?>
				<?php echo $form->textField($model,'lastName',array('maxlength'=>255)); ?>
				<?php echo $form->error($model,'lastName'); ?>

				<?php echo $form->labelEx($model,'middleName'); ?>
				<?php echo $form->textField($model,'middleName',array('maxlength'=>255)); ?>
				<?php echo $form->error($model,'middleName'); ?>
			</div>
			<div class="span4">
				<?php echo $form->labelEx($model,'dateJoined'); ?>
				<?php // echo $form->textField($model,'dateJoined'); ?>
				<?php
				$this->widget('zii.widgets.jui.CJuiDatePicker',array(
					'name'=>'dateJoined',
					'model'=>$model,
					// additional javascript options for the date picker plugin
					'options'=>array(
						'showAnim'=>'fold',
					),
					'htmlOptions'=>array(
						'style'=>'height:20px;'
					),
				));	?>			
				<?php echo $form->error($model,'dateJoined'); ?>

				<?php echo $form->labelEx($model,'sponsorCode'); ?>
				<?php echo $form->textField($model,'sponsorCode',array('size'=>45,'maxlength'=>45)); ?>
				<?php echo $form->error($model,'sponsorCode'); ?>
			</div>
			<div class="span4">
				<?php echo $form->labelEx($model,'homePhone'); ?>
				<?php echo $form->textField($model,'homePhone',array('size'=>13,'maxlength'=>13)); ?>
				<?php echo $form->error($model,'homePhone'); ?>

				<?php echo $form->labelEx($model,'mobilePhone'); ?>
				<?php echo $form->textField($model,'mobilePhone',array('size'=>13,'maxlength'=>13)); ?>
				<?php echo $form->error($model,'mobilePhone'); ?>

				<?php echo $form->labelEx($model,'emailAddress'); ?>
				<?php echo $form->textField($model,'emailAddress',array('size'=>60,'maxlength'=>100)); ?>
				<?php echo $form->error($model,'emailAddress'); ?>				
			</div>
		</div>
	</div>

	<hr />

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

<?php $this->endWidget(); ?>
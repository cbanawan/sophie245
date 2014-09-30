<?php
/* @var $this ProductsController */
/* @var $model Products */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'products-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'code'); ?>
		<?php echo $form->textField($model,'code',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'code'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php echo $form->textField($model,'description',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'description'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'catalogPrice'); ?>
		<?php echo $form->textField($model,'catalogPrice'); ?>
		<?php echo $form->error($model,'catalogPrice'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'netPriceDiscount'); ?>
		<?php echo $form->textField($model,'netPriceDiscount'); ?>
		<?php echo $form->error($model,'netPriceDiscount'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'stocksOnHand'); ?>
		<?php echo $form->textField($model,'stocksOnHand'); ?>
		<?php echo $form->error($model,'stocksOnHand'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'productGroupId'); ?>
		<?php echo $form->textField($model,'productGroupId'); ?>
		<?php echo $form->error($model,'productGroupId'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'catalogId'); ?>
		<?php echo $form->textField($model,'catalogId'); ?>
		<?php echo $form->error($model,'catalogId'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'_outOfStocksUp'); ?>
		<?php echo $form->textField($model,'_outOfStocksUp'); ?>
		<?php echo $form->error($model,'_outOfStocksUp'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
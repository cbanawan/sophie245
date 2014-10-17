<?php
/* @var $this ProductController */
/* @var $model Products */
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
		<?php echo $form->label($model,'code'); ?>
		<?php echo $form->textField($model,'code',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'description'); ?>
		<?php echo $form->textField($model,'description',array('size'=>60,'maxlength'=>225)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'catalogPrice'); ?>
		<?php echo $form->textField($model,'catalogPrice'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'netPriceDiscount'); ?>
		<?php echo $form->textField($model,'netPriceDiscount'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'stocksOnHand'); ?>
		<?php echo $form->textField($model,'stocksOnHand'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'productGroupId'); ?>
		<?php echo $form->textField($model,'productGroupId'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'catalogId'); ?>
		<?php echo $form->textField($model,'catalogId'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'_outOfStocksUp'); ?>
		<?php echo $form->textField($model,'_outOfStocksUp'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
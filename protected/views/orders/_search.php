<?php
/* @var $this OrdersController */
/* @var $model Orders */
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
	");	
?>
<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id', array('class' => 'span-3')); ?>
	</div>
	
	<div class="row">
		<?php echo $form->label($model,'dateCreated'); ?>
		<?php 
			echo $form->textField(
					$model,
					'dateCreated',
					array(
						'id'=>'dateCreated',
						'class'=>'span-3'
					)
				); 
		?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'memberCode'); ?>
		<?php echo $form->textField($model,'memberCode', array('class' => 'span-3')); ?>
	</div>
	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
		<?php echo CHtml::resetButton('Clear'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
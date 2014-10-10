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
<div class="form">

	<?php $form=$this->beginWidget('CActiveForm', array(
		'action'=>Yii::app()->createUrl($this->route),
		'method'=>'get',
	)); ?>

	<div class="row">
		<div class="span6">
			<?php echo $form->label($model,'id'); ?>
			<?php echo $form->textField($model,'id', array('class' => 'span3')); ?>
		</div>
	</div>
	<div class="row">
		<div class="span2">
			<?php echo $form->label($model,'memberCode'); ?>
			<?php echo $form->textField($model,'memberCode', array('class' => 'span-2')); ?>
		</div>
		<div class="span4">
			<?php echo $form->label($model,'memberName'); ?>
			<?php echo $form->textField($model,'memberName'); ?>
		</div>
	</div>
	<div class="row">
		<div class="span6">
			<?php echo $form->label($model,'dateCreated'); ?>
			<?php 
				echo $form->textField(
						$model,
						'dateCreated',
						array(
							'id'=>'dateCreated',
							'class' => 'span3',
						)
					); 
				?>
			</div>
	</div>
	<div class="row">
		<div class="span6">
			<?php echo $form->label($model,'orderStatusId'); ?>
			<?php echo $form->dropDownList($model,'orderStatusId', $orderStatus, array('empty' => '(Select an order status)')); ?>
		</div>
	</div>
	<div class="row">
		<?php echo CHtml::submitButton('Search'); ?>
		<?php echo CHtml::resetButton('Clear'); ?>
	</div>

	<?php $this->endWidget(); ?>

</div><!-- search-form -->
<?php
/* @var $this OrdersController */
/* @var $model Orders */
/* @var $form CActiveForm */
?>

<div class="form">
	
	<div class="row">
		<?php echo CHtml::label('Find Member', 'memberSearch'); ?>
		<?php $this->widget('bootstrap.widgets.TbTypeAhead', array(
			'name' => 'memberSearch',
			'source' => array_values(CHtml::listData(Members::model()->findAll(), 'id', 'codename')),
			'htmlOptions' => array(
				// 'prepend' => TbHtml::icon(TbHtml::ICON_GLOBE),
				'placeholder' => 'Enter Member Code or Name',
				'class' => 'span4',
			),
		)); ?>		
	</div>
	
	<?php
		Yii::app()->clientScript->registerScript("memberSearch", "
				$('#memberSearch').keypress(function( event ) {
					if ( event.which == 13 ) {
						$('#btnSubmit').focus();
					}
				});	
				
				$('#memberSearch').focusout(function( event ) {
					// Fetch object data through ajax
					member = $(this).val();
					mem = member.split(' ');

					$.getJSON('". $this->createUrl('/members/getMember&code=') . "' + mem[0],function(member){
						// alert(result.id);
						$('#Orders_memberId').val(member.id);
						$('#memberCode').val(member.memberCode);
						$('#memberName').val(member.fullName);
					});

					// Change focus to discount field		
				});
				
				$( document ).ready(function() {
					$('#dateCreated').datepicker({dateFormat: 'yy-mm-dd'});
					$('#memberSearch').focus();
				});
			");
	?>
	
	<?php 
		Yii::app()->getClientScript()->registerCoreScript('jquery.ui');
		Yii::app()->clientScript->registerCssFile(
			Yii::app()->clientScript->getCoreScriptUrl().
			'/jui/css/base/jquery-ui.css'
		);

		/*Yii::app()->getClientScript()->registerScript("dateCreated", "
			$(function() {
				$('#dateCreated').datepicker({dateFormat: 'yy-mm-dd', defaultDate: '2014-09-30'});
			});		
		");	*/
	?>	
			
	<hr />

	<?php $form=$this->beginWidget('CActiveForm', array(
		'id'=>'orders-form',
		// Please note: When you enable ajax validation, make sure the corresponding
		// controller action is handling ajax validation correctly.
		// There is a call to performAjaxValidation() commented in generated controller code.
		// See class documentation of CActiveForm for details on this.
		'enableAjaxValidation'=>false,
	)); ?>

	<?php echo $form->errorSummary($model); ?>
	
	<?php 
		echo $form->hiddenField($model, 'memberId'); 

		// TODO: Must be in controller
		echo $form->hiddenField($model, 'orderStatusId', array('value' => 1)); 
		echo $form->hiddenField($model, 'userId', array('value' => 1)); 
	?>

	<div class="row well">
		<div class="row">
			<div class="span12">
				<div class="span2">
				<?php
					echo CHtml::label('Member Code', 'memberCode'); 
					echo CHtml::textField('memberCode', '', array('disabled' => true, 'class' => 'span-3'));
				?>
				</div>
				<div class="span10">
				<?php
					echo CHtml::label('Name', 'memberName'); 
					echo CHtml::textField('memberName', '', array('disabled' => true,'class'=>'span6'));
				?>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="span12">
			<?php

				echo CHtml::label('Transaction Date', 'dateCreated'); 
				echo $form->textField($model, 'dateCreated', array('id' => 'dateCreated', 'value' => date('Y-m-d'), 'class' => 'span2'));
				// echo CHtml::textField('dateCreated', '', array('disabled' => false,'class'=>'span-3'));			
			?>
			</div>
		</div>
	</div>
	
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('id' => 'btnSubmit')); ?>
		<?php echo CHtml::button('Cancel', array('submit' => $this->createUrl('order/index'))); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
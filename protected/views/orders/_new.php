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
				'placeholder' => 'Enter member code/name',
				'class' => 'span-10',
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
					$('#memberSearch').focus();
				});
			");
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

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row well">
		<?php 
			echo $form->hiddenField($model, 'memberId'); 
			
			// TODO: Must be in controller
			echo $form->hiddenField($model, 'orderStatusId', array('value' => 4)); 
			echo $form->hiddenField($model, 'userId', array('value' => 1)); 

			echo CHtml::label('Member Code', 'memberCode'); 
			echo CHtml::textField('memberCode', '', array('disabled' => true,'class'=>'span-3'));

			echo CHtml::label('Name', 'memberName'); 
			echo CHtml::textField('memberName', '', array('disabled' => true,'class'=>'span-10'));
		?>
	</div>
	
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('id' => 'btnSubmit')); ?>
		<?php echo CHtml::button('Cancel', array('submit' => $this->createUrl('orders/index'))); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
<?php
/* @var $this OrdersController */
/* @var $model Orders */
/* @var $form CActiveForm */
?>

<div class="form">
	<div class="row">
		<?php echo CHtml::label('Find Member', 'memberSearch'); ?>
		<?php $this->widget('booster.widgets.TbTypeAhead', array(
			'id' => 'memberSearch',
			'name' => 'memberSearch',
			'datasets' => array(
				'source' => $members,
			),
			'htmlOptions' => array(
				'placeholder' => 'Enter product code/name',
				'class' => 'span-10'
			),
			'options' => array(
				'hint' => true,
				'highlight' => true,
				'minLength' => 1
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

	?>	
			
	<hr />

	<?php $form = $this->beginWidget(
			'booster.widgets.TbActiveForm',
			array(
				'id' => 'orders-form',
				'method' => 'post',
				'action'=>Yii::app()->createUrl($this->route),
			)
	); ?>

	<?php echo $form->errorSummary($model); ?>
	
	<?php 
		echo $form->hiddenField($model, 'memberId'); 

		// TODO: Must be in controller
		echo $form->hiddenField($model, 'orderStatusId', array('value' => 1)); 
		echo $form->hiddenField($model, 'userId', array('value' => 1)); 
	?>
	
	<div class="row">
	<?php
		echo CHtml::label('Member Code', 'memberCode'); 
		echo CHtml::textField('memberCode', '', array('disabled' => true, 'class' => 'form-control span-4'));
	?>
	</div>
	<div class="row">
	<?php
		echo CHtml::label('Name', 'memberName'); 
		echo CHtml::textField('memberName', '', array('disabled' => true,'class'=>'form-control span-10'));
	?>
	</div>
	<div class="row">
		<div class="span-3">
		<?php
			// echo CHtml::label('Transaction Date', 'dateCreated'); 
			echo $form->datePickerGroup(
				$model,
				'dateCreated',
				array(
					'widgetOptions' => array(
						'options' => array(
							'language' => 'es',
						),
					),
					'wrapperHtmlOptions' => array(
						'class' => 'col-sm-5',
					),
					'prepend' => '<i class="glyphicon glyphicon-calendar"></i>'
				)
			);
		?>		
		</div>
	</div>
	
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('id' => 'btnSubmit', 'class' => 'btn btn-primary')); ?>
		<?php echo CHtml::button('Cancel', array('submit' => $this->createUrl('order/index'), 'class' => 'btn')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
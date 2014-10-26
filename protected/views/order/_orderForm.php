<?php
/* @var $this OrdersController */
/* @var $model Orders */
/* @var $form CActiveForm */
?>

<div class="container-fluid">
	<div class="row-fluid">
		<?php echo CHtml::label('Find Member', 'memberSearch'); ?>
		<?php $this->widget('booster.widgets.TbTypeAhead', array(
			'id' => 'memberSearch',
			'name' => 'memberSearch',
			'datasets' => array(
				'source' => $members,
			),
			'htmlOptions' => array(
				'placeholder' => 'Enter product code/name',
				'class' => 'span-10',
			),
			'options' => array(
				'hint' => true,
				'highlight' => true,
				'minLength' => 1,
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
					
					if(mem != '')
					{
						$.getJSON('". $this->createUrl('/member/ajaxGetMemberByCode&code=') . "' + mem[0],function(member){
							// alert(result.id);
							$('#Orders_memberId').val(member.id);
							$('#Orders_memberCode').val(member.memberCode);
							$('#Orders_memberName').val(member.fullName);
						});
					}

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
				// 'type'=> 'horizontal',
				'method' => 'post',
				'action'=>Yii::app()->createUrl($this->route),
			)
	); ?>

	<?php // echo $form->errorSummary($model); ?>
	
	<?php 
		echo $form->hiddenField($model, 'memberId'); 

		// TODO: Must be in controller
		echo $form->hiddenField($model, 'orderStatusId', array('value' => 1)); 
		echo $form->hiddenField($model, 'userId', array('value' => 1)); 
	?>
	
	<div class="row-fluid">
		<div class="col-xs-12">
			<div class="col-xs-3">
			<?php
				echo $form->textFieldGroup(
					$model,
					'memberCode',
					array(
						'wrapperHtmlOptions' => array(
							'class' => 'col-sm-3',
						),
						'widgetOptions' => array(
							'htmlOptions' => array('disabled' => true)
						)
						// 'hint' => 'In addition to freeform text, any HTML5 text-based input appears like so.'
					)
				); 
			?>
			</div>
		</div>
		<div class="col-xs-12">
			<div class="col-xs-6">
			<?php
			echo $form->textFieldGroup(
				$model,
				'memberName',
				array(
					'wrapperHtmlOptions' => array(
						'class' => 'col-sm-5',
					),
					'widgetOptions' => array(
						'htmlOptions' => array('disabled' => true)
					)
					// 'hint' => 'In addition to freeform text, any HTML5 text-based input appears like so.'
				)
			);
			?>
			</div>
		</div>
		<div class="col-xs-12">
			<div class="col-xs-3">
			<?php
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
						'class' => 'col-sm-3',
					),
					'prepend' => '<i class="glyphicon glyphicon-calendar"></i>'
				)
			);		
			?>
			</div>
		</div>
		<?php if(count($catalogs) == 1): ?>
		<?php echo $form->hiddenField($model, 'catalogId', array('value' => key($catalogs))); ?>
		<?php else: ?>
		<div class="col-xs-12">
			<div class="col-xs-3">
			<?php
				echo $form->dropDownListGroup(
					$model,
					'catalogId',
					array(
						'label' => 'Catalog',
						'wrapperHtmlOptions' => array(
							'class' => 'col-sm-5',
						),
						'widgetOptions' => array(
							'data' => $catalogs,
							// 'htmlOptions' => array('multiple' => true),
						),
					)
				);			
			?>
			</div>
		</div>		
		<?php endif; ?>
		<div class="col-xs-12">
			<div class="col-xs-3">
				<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('id' => 'btnSubmit', 'class' => 'btn btn-primary')); ?>
				<?php echo CHtml::button('Cancel', array('submit' => $this->createUrl('order/index'), 'class' => 'btn')); ?>
			</div>		
		</div>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
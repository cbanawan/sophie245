<?php
/* @var $this CatalogController */
/* @var $model Catalogs */
/* @var $form CActiveForm */
?>

<div class="container-fluid">

<?php $form=$this->beginWidget('booster.widgets.TbActiveForm', array(
	'id'=>'catalogs-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>
	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>
	<div class="row">
		<div class="col-sm-2">
		<?php 
			echo $form->textFieldGroup(
				$model,
				'id',
				array(
					'label' => 'Catalog No.',
					'wrapperHtmlOptions' => array(
						'class' => 'col-sm-2',
					),
					// 'hint' => 'In addition to freeform text, any HTML5 text-based input appears like so.'
				)
			);		
		?>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-6">
		<?php 
			echo $form->textFieldGroup(
				$model,
				'name',
				array(
					'wrapperHtmlOptions' => array(
						'class' => 'col-sm-5',
					),
					// 'hint' => 'In addition to freeform text, any HTML5 text-based input appears like so.'
				)
			);		
		?>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-3">
		<?php 
			echo $form->datePickerGroup(
				$model,
				'dateReleased',
				array(
					'widgetOptions' => array(
						'options' => array(
							'language' => 'es',
							'format' => 'yyyy-m-d'
						),
					),
					'wrapperHtmlOptions' => array(
						'class' => 'col-sm-3',
					),
					// 'hint' => 'Click inside! This is a super cool date field.',
					'prepend' => '<i class="glyphicon glyphicon-calendar"></i>'
				)
			);		
		?>
		</div>
	</div>

	<div class="row">
		<div class="col-sm-6">
		<?php 
			echo $form->checkboxGroup(
				$model,
				'_current',
				array(
					'widgetOptions' => array(
						'htmlOptions' => array(
							// 'disabled' => true
						)
					)
				)
			);
		?>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-6">
		<?php 
			$this->widget(
					'booster.widgets.TbButton',
					array(
						'label' => $model->isNewRecord ? 'Create' : 'Save',
						'buttonType' => 'submit',
						'context' => 'primary',
					)
				);
			// echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); 
		?>
		</div>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
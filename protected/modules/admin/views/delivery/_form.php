<?php
/* @var $this DeliveryController */
/* @var $model Deliveries */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('booster.widgets.TbActiveForm', array(
	'id'=>'deliveries-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>
	
	<?php $this->beginWidget(
		'booster.widgets.TbPanel',
		array(
			'title' => 'Delivery Form',
			'headerIcon' => 'barcode',
			'headerButtons' => array(
				array(
					'class' => 'booster.widgets.TbButtonGroup',
					'size' => 'medium',
					'buttons' => array(
						array(
							'label' => $model->isNewRecord ? 'Create' : 'Save',
							'icon' => 'save',
							// 'url' => Yii::app()->createUrl('/admin/purchaseOrder/udpate'),
							'htmlOptions' => array(
								'id' => 'print',
								'type' => 'submit',
							)
						),
					),
				),
			)
		)
	); ?>	

	<div class="container-fluid">
		<p class="note">Fields with <span class="required">*</span> are required.</p>

		<?php // echo $form->errorSummary($model); ?>

		<div class="row">
			<div class="col-sm-3">
			<?php echo $form->dropDownListGroup(
				$model,
				'purchaseOrderId',
				array(
					'wrapperHtmlOptions' => array(
						'class' => 'col-sm-5',
					),
					'widgetOptions' => array(
						'data' => $pOrders,
						'htmlOptions' => array(),
					)
				)
			); ?>
			</div>
		</div>

		<div class="row">
			<div class="col-sm-3">
			<?php
				echo $form->textFieldGroup(
					$model,
					'deliveryNo',
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
						'dateDelivered',
						array(
							'widgetOptions' => array(
								'options' => array(
									'language' => 'es',
									'format' => 'yyyy-mm-dd',
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

		<?php $this->endWidget(); ?>

		<div class="row buttons">
			<?php 
				/*$this->widget(
					'booster.widgets.TbButton',
					array(
						'label' => $model->isNewRecord ? 'Create' : 'Save',
						'buttonType' => 'submit',
					)
				);*/
			?>
		</div>
	</div>
<?php $this->endWidget(); ?>

</div><!-- form -->
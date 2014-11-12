<?php
/* @var $this OrdersController */
/* @var $model Orders */
/* @var $form CActiveForm */
?>


<div class="container-fluid">
	<div class="row-fluid">
		<div class="col-sm-6">
		<?php
			$this->renderPartial(
						'_orderFormSearch',
						array(
							'model' => $memberModel,
							'memberDataProvider' => $memberDataProvider
						)
					);
		?>
		</div>
		<div class="col-sm-6 well">
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
				echo $form->hiddenField($orderModel, 'memberId'); 

				// TODO: Must be in controller
				echo $form->hiddenField($orderModel, 'orderStatusId', array('value' => 1)); 
				echo $form->hiddenField($orderModel, 'userId', array('value' => 1)); 
			?>

				<div class="row">
					<div class="col-sm-3">
					<?php
						echo $form->textFieldGroup(
							$orderModel,
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
				<div class="row">
					<div class="col-sm-5">
					<?php
					echo $form->textFieldGroup(
						$orderModel,
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
				<div class="row">
					<div class="col-sm-3">
					<?php
					echo $form->datePickerGroup(
						$orderModel,
						'dateOrdered',
						array(
							'widgetOptions' => array(
								'options' => array(
									'language' => 'es',
									'format' => 'yyyy-m-d',
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
				<div class="row">
					<div class="col-sm-12">
						<?php echo CHtml::submitButton($orderModel->isNewRecord ? 'Create' : 'Save', array('id' => 'btnSubmit', 'class' => 'btn btn-primary')); ?>
						<?php echo CHtml::button('Cancel', array('submit' => $this->createUrl('order/index'), 'class' => 'btn')); ?>
					</div>		
				</div>

			<?php $this->endWidget(); ?>			
		</div>
	</div>
</div>
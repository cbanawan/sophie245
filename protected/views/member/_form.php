<?php $this->beginWidget(
    'booster.widgets.TbPanel',
    array(
        'title' => 'Member Form',
        'headerIcon' => 'user',
		'padContent' => false,
        'htmlOptions' => array('class' => 'bootstrap-widget-table'),
		'headerButtons' => array(
            /*array(
                'class' => 'booster.widgets.TbButton',
				'label' => 'Add Order Item',
				'icon' => 'plus-sign',
				'size' => 'medium',
				'htmlOptions' => array(
					'id' => 'add-order-item-button',
					'title' => 'Add Order Item',
					'data-toggle' => 'modal',
					'data-target' => '#order-item-dialog',
				),	
				'visible' => (!in_array($order->orderStatus->status, array('cancelled')))
            ),*/
        )		
    )
); ?>

<?php $form=$this->beginWidget('booster.widgets.TbActiveForm', array(
	'id'=>'members-form',
	'type'=> 'horizontal',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

<div class="container-fluid">
	<div class="row-fluid">
		<blockquote class="blockquote-reverse">
		<p>Fields with <span class="required">*</span> are required.</p>
		</blockquote>
	</div>
	<div class="row-fluid">
		<div class="col-xs-12">
			<div class="col-xs-6">
				<?php 
					echo $form->textFieldGroup(
						$model,
						'memberCode',
						array(
							'wrapperHtmlOptions' => array(
								'class' => 'col-sm-5',
							),
							// 'hint' => 'In addition to freeform text, any HTML5 text-based input appears like so.'
						)
					);
					echo $form->textFieldGroup(
						$model,
						'firstName',
						array(
							'wrapperHtmlOptions' => array(
								'class' => 'col-sm-8',
							),
							// 'hint' => 'In addition to freeform text, any HTML5 text-based input appears like so.'
						)
					);
					echo $form->textFieldGroup(
						$model,
						'lastName',
						array(
							'wrapperHtmlOptions' => array(
								'class' => 'col-sm-8',
							),
							// 'hint' => 'In addition to freeform text, any HTML5 text-based input appears like so.'
						)
					);
					echo $form->textFieldGroup(
						$model,
						'middleName',
						array(
							'wrapperHtmlOptions' => array(
								'class' => 'col-sm-8',
							),
							// 'hint' => 'In addition to freeform text, any HTML5 text-based input appears like so.'
						)
					);
					echo $form->textFieldGroup(
						$model,
						'sponsorCode',
						array(
							'wrapperHtmlOptions' => array(
								'class' => 'col-sm-5',
							),
							// 'hint' => 'In addition to freeform text, any HTML5 text-based input appears like so.'
						)
					);
				?>
			</div>
			<div class="col-xs-6">
				<?php
					echo $form->datePickerGroup(
						$model,
						'dateJoined',
						array(
							'widgetOptions' => array(
								'options' => array(
									'language' => 'es',
									'format' => 'yyyy-m-d'
								),
							),
							'wrapperHtmlOptions' => array(
								'class' => 'col-sm-5',
							),
							'hint' => '<em>Click field to select a date</em>',
							'prepend' => '<i class="glyphicon glyphicon-calendar"></i>'
						)
					);
					echo $form->textFieldGroup(
						$model,
						'homePhone',
						array(
							'wrapperHtmlOptions' => array(
								'class' => 'col-sm-5',
							),
							// 'hint' => 'In addition to freeform text, any HTML5 text-based input appears like so.'
						)
					);
					echo $form->textFieldGroup(
						$model,
						'mobilePhone',
						array(
							'wrapperHtmlOptions' => array(
								'class' => 'col-sm-5',
							),
							// 'hint' => 'In addition to freeform text, any HTML5 text-based input appears like so.'
						)
					);
					echo $form->textFieldGroup(
						$model,
						'emailAddress',
						array(
							'wrapperHtmlOptions' => array(
								'class' => 'col-sm-7',
							),
							// 'hint' => 'In addition to freeform text, any HTML5 text-based input appears like so.'
							'prepend' => '<i class="glyphicon glyphicon-envelope"></i>'
						)
					);
				?>
			</div>
		</div>
	</div>
	<div class="row-fluid">
		<?php 
			$this->widget(
				'booster.widgets.TbButton',
				array(
					'label' => ($model->isNewRecord ? "Save" : "Update"),
					'buttonType' => 'submit',
				)
			); 
		?>
	</div>

</div><!-- form -->
<?php $this->endWidget(); unset($form); ?>


<?php $this->endWidget(); ?>
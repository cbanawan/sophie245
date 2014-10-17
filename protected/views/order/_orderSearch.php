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

	$form = $this->beginWidget(
			'booster.widgets.TbActiveForm',
			array(
				'id' => 'order-search-form',
				'action'=>Yii::app()->createUrl($this->route),
			)
	); 

		echo '<fieldset>';
		
?>

		<div class="container-fluid">
			<div class="row-fluid">
				<div class="span-12">
				<?php
						echo $form->textFieldGroup(
							$model,
							'id',
							array(
								'class' => 'span-6'
							)
						);

						echo $form->textFieldGroup(
							$model,
							'memberCode',
							array(
								'wrapperHtmlOptions' => array(
									'class' => 'col-sm-5',
								),
							)
						);

						echo $form->textFieldGroup(
							$model,
							'memberName',
							array(
								'label' => 'Lastname',
								'wrapperHtmlOptions' => array(
									'class' => 'col-sm-5',
								),
							)
						);				
				?>
				</div>
				<div class="span-12">
				<?php
						echo $form->dateRangeGroup(
							$model,
							'dateCreated',
							array(
								'widgetOptions' => array(
									'callback' => 'js:function(start, end){console.log(start.toString("MMMM d, yyyy") + " - " + end.toString("MMMM d, yyyy"));}'
								), 
								'wrapperHtmlOptions' => array(
									'class' => 'col-sm-5',
								),
								'prepend' => '<i class="glyphicon glyphicon-calendar"></i>'
							)
						);		

						echo $form->dropDownListGroup(
							$model,
							'orderStatusId',
							array(
								'wrapperHtmlOptions' => array(
									'class' => 'col-sm-5',
								),
								'widgetOptions' => array(
									'data' => $orderStatus,
									'htmlOptions' => array('multiple' => true),
								)
							)
						);	
				?>
				</div>
			</div>
		</div>

<?php
		echo '</fieldset>';

		$this->widget(
			'booster.widgets.TbButton',
			array(
				'buttonType' => 'submit',
				'label' => 'Primary',
				'context' => 'primary',
			)
		);

		echo ' ';

		$this->widget(
			'booster.widgets.TbButton',
			array(
				'buttonType' => 'reset',
				'label' => 'Clear',
				'context' => 'default',
			)
		);
	
	$this->endWidget(); 
?>


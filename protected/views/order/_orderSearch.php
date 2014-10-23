<?php 
	Yii::app()->getClientScript()->registerScript("submit-search", "
		$('#order-search-form').submit(function(){
			$('#orders-grid').yiiGridView('update', {
				data: $(this).serialize()
			});
			
			return false;
		});
	");	

	$form = $this->beginWidget(
			'booster.widgets.TbActiveForm',
			array(
				'id' => 'order-search-form',
				'method' => 'get',
				'action'=>Yii::app()->createUrl($this->route),
			)
	); 

		echo '<fieldset>';
		
?>

		<div class="container">
			<div class="row">
				<div class="span-6">
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
				<div class="span-3">&nbsp;</div>
				<div class="span-6">
				<?php
						echo $form->dateRangeGroup(
							$model,
							'dateCreatedRange',
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
						
						echo $form->checkboxListGroup(
							$model,
							'orderStatusId',
							array(
								'widgetOptions' => array(
									'data' => $orderStatus,
								),
								// 'hint' => '<strong>Note:</strong> Labels surround all the options for much larger click areas.'
							)
						);						
				?>
				</div>
			</div>
		</div>

<?php
		$this->widget(
			'booster.widgets.TbButton',
			array(
				'buttonType' => 'submit',
				'label' => 'Search',
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
		
	echo '</fieldset>';
	
	$this->endWidget(); 
?>


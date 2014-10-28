<?php 
	Yii::app()->getClientScript()->registerScript("submit-search", "
		$('#order-search-form').submit(function(){
			$('#orders-grid').yiiGridView('update', {
				data: $(this).serialize()
			});
			
			return false;
		});
		
		$('.search-button').click(function(){
			$('.search-form').toggle();
			return false;
		});
		
		$('.form-control').click(function(){
			$(this).val('');
			// return false;
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
		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-2">
				<?php
					echo $form->textFieldGroup(
						$model,
						'id',
						array(
							'class' => 'span-6',
							'prepend' => '<i class="glyphicon glyphicon-search"></i>',
						)
					);
				?>
				</div>
				<div class="col-sm-4">
				<?php
					echo $form->textFieldGroup(
						$model,
						'memberName',
						array(
							'label' => 'Search Lastname',
							'class' => 'span-8',
							'prepend' => '<i class="glyphicon glyphicon-user"></i>',
						)
					);
				?>
				</div>
			</div>
			<div class="row">
				<?php 
					echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); 
					/*$this->widget(
						'booster.widgets.TbButton',
						array(
							'label' => 'Advance Search',
							'context' => 'link',
							'htmlOptions' => array(
								'class' => 'search-button',
							)
						)
					);*/
				?>
			</div>
		</div>

		<div class="search-form" style="display:none">		
			<div class="container-fluid">
			
				<div class="row">
					<div class="span-6">
					<?php
							echo $form->textFieldGroup(
								$model,
								'memberCode',
								array(
									'wrapperHtmlOptions' => array(
										'class' => 'col-sm-5',
									),
								)
							);
							
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

							/*echo $form->textFieldGroup(
								$model,
								'memberName',
								array(
									'label' => 'Lastname',
									'wrapperHtmlOptions' => array(
										'class' => 'col-sm-5',
									),
								)
							);	*/			
					?>
					</div>
					<div class="span-3">&nbsp;</div>
					<div class="span-6">
					<?php
							/*echo $form->dateRangeGroup(
								$model,
								'dateLastModifiedRange',
								array(
									'widgetOptions' => array(
										'callback' => 'js:function(start, end){console.log(start.toString("MMMM d, yyyy") + " - " + end.toString("MMMM d, yyyy"));}'
									), 
									'wrapperHtmlOptions' => array(
										'class' => 'col-sm-5',
									),
									'prepend' => '<i class="glyphicon glyphicon-calendar"></i>'
								)
							);	*/	

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
		</div>

		<div>
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
		?>
		</div>
		</fieldset>
	
<?php $this->endWidget(); ?>


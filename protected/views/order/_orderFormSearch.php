<?php
	Yii::app()->getClientScript()->registerScript("submit-search", "
		$('#member-search-form').submit(function(){
			$('#members-grid').yiiGridView('update', {
				data: $(this).serialize()
			});
			
			return false;
		});
		
		$('#Members_searchCriteria').click(function(){
			$(this).val('');
		});
	");


	$form = $this->beginWidget(
			'booster.widgets.TbActiveForm',
			array(
				'id' => 'member-search-form',
				'method' => 'get',
				'action'=>Yii::app()->createUrl($this->route),
			)
	);	

	echo $form->textFieldGroup(
		$model,
		'searchCriteria',
		array(
			'class' => 'span-6',
			'prepend' => '<i class="glyphicon glyphicon-search"></i>',
		)
	);
	
	$this->renderPartial(
				'_orderFormMemberGrid',
				array(
					'dataProvider' => $memberDataProvider
				)
			);
	/*$this->widget('booster.widgets.TbGridView', array(
		'id'=>'members-grid',
		'template' => '{items}{pager}', 
		'dataProvider' => $model->search(),
		'columns'=>array(
			'memberCode',
			'lastName',
			'firstName',
			'middleName',
		),
	));*/ 			

	$this->endWidget();
?>
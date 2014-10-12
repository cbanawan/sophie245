<?php 
	$form = $this->beginWidget(
			'CActiveForm', 
			array( 
				'id'=>'registration-form', 
				'enableAjaxValidation'=>false, 
				'htmlOptions' => array('enctype' => 'multipart/form-data'), 
			)
		);

	echo $form->labelEx($model,'csv_file');
	echo $form->fileField($model,'csv_file');
	echo $form->error($model, 'csv_file'); 

	echo CHtml::submitButton('Upload CSV',array("class"=>"")); ?> <?php echo $form->errorSummary($model);

	$this->endWidget(); 
?>
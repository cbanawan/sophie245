<?php
/* @var $this OrderController */

	$this->breadcrumbs=array(
		'Product' => array('product/admin'),
		'Update Critical Stocks',
	);
?>
<?php 
	$form = $this->beginWidget(
			'booster.widgets.TbActiveForm', 
			array( 
				'id'=>'registration-form', 
				'enableAjaxValidation'=>false, 
				'htmlOptions' => array('enctype' => 'multipart/form-data'), 
			)
		);

	/*echo $form->labelEx($model,'csv_file');
	echo $form->fileField($model,'csv_file');
	echo $form->error($model, 'csv_file'); */
	
	echo $form->fileFieldGroup($model, 'csv_file',
			array(
				'wrapperHtmlOptions' => array(
					'class' => 'col-sm-5',
				),
			)
		);

	echo CHtml::submitButton('Upload CSV',array("class"=>"btn btn-primary")); ?> <?php echo $form->errorSummary($model);

	$this->endWidget(); 
?>
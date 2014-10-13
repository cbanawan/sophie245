<?php
/* @var $this OrderController */

	$this->breadcrumbs=array(
		'Admin' => array('default/index'),
		'Product' => array('product/index'),
		'Update Critical Stocks',
	);

	$this->menu = array(
		array(
			'label' => 'Search Product',
			'url' => $this->createUrl('product/search'),
		),
	);
?>
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
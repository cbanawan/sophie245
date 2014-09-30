<?php
/* @var $this OrderdetailsController */
/* @var $model Orderdetails */
/* @var $form CActiveForm */
?>

<div class="form">

	<div class="row">
		<?php echo CHtml::label('Product', 'product'); ?>
		<?php $this->widget('bootstrap.widgets.TbTypeAhead', array(
			'name' => 'product',
			'source' => array_values(CHtml::listData(Products::model()->findAll(), 'id', 'codename')),
			'htmlOptions' => array(
				// 'prepend' => TbHtml::icon(TbHtml::ICON_GLOBE),
				'placeholder' => 'Enter product code/name',
			),
		)); ?>		
	</div>
	
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'orderdetails-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>	

	<div class="row">
		<p class="note">Fields with <span class="required">*</span> are required.</p>

		<?php echo $form->errorSummary($model); ?>

		<?php echo $form->hiddenField($model,'orderId', array('value' => $orderId)); ?>
		<?php echo $form->hiddenField($model,'productId'); ?>		
	</div>
	
	<div class="row">
		<div class="span-3">
			<?php echo $form->labelEx($model,'discount'); ?>
			<?php echo $form->textField($model,'discount', array('class'=>'span-3 text-right')); ?>
			<?php echo $form->error($model,'discount'); ?>

			<?php echo $form->labelEx($model,'quantity'); ?>
			<?php echo $form->textField($model,'quantity', array('class'=>'span-3 text-right')); ?>
			<?php echo $form->error($model,'quantity'); ?>
		</div>	

		<div class="span-3">
			<?php echo CHtml::label('Catalog Price', 'catalogPrice'); ?>
			<?php echo CHtml::textField('catalogPrice', '', array('disabled' => true,'class'=>'span-3 text-right')) ?>

			<?php echo CHtml::label('Discounted Price', 'netPrice'); ?>
			<?php echo CHtml::textField('netPrice', '', array('disabled' => true,'class'=>'span-3 text-right')) ?>

			<?php echo CHtml::label('Amount', 'amount'); ?>
			<?php echo CHtml::textField('amount', '', array('disabled' => true, 'class'=>'span-3 text-right')) ?>
		</div>	
	</div>	

	<div class="row buttons">
		<div class="span-1">
			<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
		</div>
		<div class="span-1">
			<?php echo CHtml::button('Cancel', array('submit' => $this->createUrl('orders/detail', array('id' => $orderId)))); ?>
		</div>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

<script>
	$("#product").keypress(function( event ) {
		if ( event.which == 13 ) {
			$("#Orderdetails_quantity").focus();
		}
	});
	
	$("#product").focusout(function( event ) {
		// Fetch object data through ajax
		product = $(this).val();
		prod = product.split(" ");
			
		$.getJSON("http://localhost/index.php?r=products/getProduct&id=" + prod[0],function(result){
			// alert(result.id);
			$("#Orderdetails_productId").val(result.id);
			$("#Orderdetails_discount").val(result.netPriceDiscount);
			$("#catalogPrice").val(result.catalogPrice);
		});
		  
		// Change focus to discount field		
	});
	
	$("#Orderdetails_quantity").keyup(function( event ) {
		// if ( event.which == 13 ) {
			var netPrice = Number($("#catalogPrice").val()) * ( 1 - ( Number($("#Orderdetails_discount").val()) / 100 ) );
			$("#netPrice").val(netPrice);
			$("#amount").val(netPrice * Number($(this).val()));

			$("#btnSave").focus();
		// }
	});
	
	$("#Orderdetails_discount").keyup(function( event ) {
		// if ( event.which == 13 ) {
			var netPrice = Number($("#catalogPrice").val()) * ( 1 - ( Number($("#Orderdetails_discount").val()) / 100 ) );
			$("#netPrice").val(netPrice);
			$("#amount").val(netPrice * Number($(this).val()));

			$("#btnSave").focus();
		// }
	});
</script>
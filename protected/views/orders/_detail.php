<?php
/* @var $this OrdersController */
/* @var $model Orders */
/* @var $form CActiveForm */
?>

<div class="form">
	<div class="row">

	<?php $form=$this->beginWidget('CActiveForm', array(
		'id'=>'order-detail-form',
		// Please note: When you enable ajax validation, make sure the corresponding
		// controller action is handling ajax validation correctly.
		// There is a call to performAjaxValidation() commented in generated controller code.
		// See class documentation of CActiveForm for details on this.
		'enableAjaxValidation'=>false,
	)); ?>
	
		<p class="note">Fields with <span class="required">*</span> are required.</p>

		<?php echo $form->errorSummary($model); ?>
	</div>
	<div class="row">
		<div class="span-8">
			<?php echo CHtml::label('Product', 'product'); ?>
			<?php $this->widget('bootstrap.widgets.TbTypeAhead', array(
				'name' => 'product',
				'source' => $products,
				'htmlOptions' => array(
					// 'prepend' => TbHtml::icon(TbHtml::ICON_GLOBE),
					'placeholder' => 'Enter a code or name',
					'class' => 'span-8'
				),
			)); ?>		
			<?php echo CHtml::hiddenField('productId') ?>
		</div>
	</div>
	<div class="row">
		<div class="span-4">
			<?php echo CHtml::label('Discount', 'discount'); ?>
			<?php echo CHtml::textField('discount', '', array('class'=>'span-3 text-right')) ?>

			<?php echo CHtml::label('Quantity', 'quantity'); ?>
			<?php echo CHtml::textField('quantity', '', array('class'=>'span-3 text-right')) ?>
		</div>	

		<div class="span-4">
			<?php echo CHtml::label('Catalog Price', 'catalogPrice'); ?>
			<?php echo CHtml::textField('catalogPrice', '', array('disabled' => true,'class'=>'span-3 text-right')) ?>

			<?php echo CHtml::label('Net Discounted Price', 'netPrice'); ?>
			<?php echo CHtml::textField('netPrice', '', array('disabled' => true,'class'=>'span-3 text-right')) ?>

			<?php echo CHtml::label('Amount', 'amount'); ?>
			<?php echo CHtml::textField('amount', '', array('disabled' => true, 'class'=>'span-3 text-right')) ?>
		</div>	
	</div>
	<?php $this->endWidget(); ?>
		
</div><!-- form -->

<script>
	$("#product").keypress(function( event ) {
		if ( event.which == 13 ) {
			// Fetch object data through ajax
			product = $(this).val();
			prod = product.split(" ");
			
			$.getJSON("http://localhost/index.php?r=products/getProduct&id=" + prod[0],function(result){
				$("#productId").val(result.id);
				$("#discount").val(result.netPriceDiscount);
				$("#catalogPrice").val(result.catalogPrice);
			});
		  
			// Change focus to discount field
			$("#quantity").focus();
		}
	});
	
	$("#quantity").keypress(function( event ) {
		if ( event.which == 13 ) {
			var netPrice = Number($("#catalogPrice").val()) * ( 1 - ( Number($("#discount").val()) / 100 ) );
			$("#netPrice").val(netPrice);
			$("#amount").val(netPrice * Number($(this).val()));

			$("#btnSave").focus();
		}
	});
</script>
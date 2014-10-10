<?php
	Yii::app()->getClientScript()->registerScript("dateCreated", "
		$( document ).ready(function() {
			$('#product').focus();
			
			$('#btnClear').click(function(){
				$('#product').val('');
				$('#product').focus();
			});			
		});
	");
?>

<div class="form">
	<div class="row">

			<?php echo CHtml::label('Find a Product', 'product'); ?>
			<?php $this->widget('bootstrap.widgets.TbTypeAhead', array(
				'name' => 'product',
				'source' => array_values(CHtml::listData(Products::model()->findAll(), 'id', 'codename')),
				'htmlOptions' => array(
					// 'prepend' => TbHtml::icon(TbHtml::ICON_GLOBE),
					'placeholder' => 'Enter product code/name',
					'class' => 'span-10',
				),
			)); ?>		

	</div>
	<hr />	
	<?php $form=$this->beginWidget('CActiveForm', array(
		'action'=>Yii::app()->createUrl($this->route),
		'method'=>'post',
	)); ?>

	<?php 
		echo $form->hiddenField($model,'orderId'); 
		echo $form->hiddenField($model,'productId'); 
	?>
	
	<div class="row">
		<?php echo CHtml::label('Selected Product', 'productDesc'); ?>
		<?php echo CHtml::textField('productDesc', '', array('disabled' => true, 'class' => 'span-10')); ?>

		<?php echo $form->label($model,'discount'); ?>
		<?php echo $form->textField($model,'discount', array('class' => 'span-2 text-right')); ?>

		<?php echo $form->label($model,'quantity'); ?>
		<?php echo $form->textField($model,'quantity', array('class' => 'span-2 text-right')); ?>
	</div>
	
	<div class="row buttons">
		<?php echo CHtml::submitButton('Save', array('id' => 'btnSave')); ?>
		<?php echo CHtml::resetButton('Clear', array('id' => 'btnClear')); ?>
		<?php echo CHtml::Button('Close', array('id' => 'btnClose', 'onclick'=>'$("#order-item-dialog").dialog("close"); return false;')); ?>
	</div>

	<?php $this->endWidget(); ?>

</div><!-- search-form -->

<script>
	$("#product").keypress(function( event ) {
		if ( event.which == 13 ) {
			$("#Orderdetails_quantity").focus();
			if($(this).val() == '')
			{
				$('#order-item-dialog').dialog('close');
			}
		}
	});
	
	$("#product").focusout(function( event ) {
		// Fetch object data through ajax
		if($(this).val() != '')
		{
			product = $(this).val();
			prod = product.split(" ");

			$.getJSON("<?php echo Yii::app()->createUrl('products/getProduct&id='); ?>" + prod[0],function(result){
				// alert(result.id);
				$("#Orderdetails_productId").val(result.id);
				$("#Orderdetails_discount").val(result.netPriceDiscount);
				$("#productDesc").val(result.code + ' ' + result.description);
			});
		}
		// Change focus to discount field		
	});
</script>
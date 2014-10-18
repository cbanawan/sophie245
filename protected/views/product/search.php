<?php
/* @var $this OrderController */

	$this->breadcrumbs=array(
		'Product' => array('product/admin'),
		'Search for Products'
	);
?>

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
		<div class="span-12">
		<?php echo CHtml::label('Find a Product', 'product'); ?>
		<?php $this->widget('booster.widgets.TbTypeAhead', array(
			'id' => 'product',
			'name' => 'product',
			'datasets' => array(
				'source' => array_values(CHtml::listData(Products::model()->findAll(), 'id', 'codename')),
			),
			'htmlOptions' => array(
				// 'prepend' => TbHtml::icon(TbHtml::ICON_GLOBE),
				'placeholder' => 'Enter product code/name',
				'class' => 'form-control',
			),
		)); ?>		
		</div>
	</div>
	<hr />	
	<?php $form=$this->beginWidget('booster.widgets.TbActiveForm', array(
		'action'=>Yii::app()->createUrl($this->route),
		'method'=>'post',
	)); ?>

	<div class="row">
		<?php echo CHtml::label('Selected Product', 'productDesc'); ?>
		<?php echo CHtml::textField('productDesc', '', array('disabled' => true, 'class' => 'span-12 form-control')); ?>
	</div>
	<div class="row">
		<?php echo CHtml::label('Stock Status', 'stockStatus'); ?>
		<?php echo CHtml::textField('stockStatus', '', array('disabled' => true, 'class' => 'span-6 form-control')); ?>
	</div>
	<div class="row">
		<?php echo CHtml::label('Catalog Price', 'catalogPrice'); ?>
		<?php echo CHtml::textField('catalogPrice', '', array('disabled' => true, 'class' => 'span-3 form-control')); ?>
	</div>
	<div class="row">
		<?php echo CHtml::label('Discount', 'discount'); ?>
		<?php echo CHtml::textField('discount', '', array('disabled' => true, 'class' => 'span-3 form-control')); ?>
	</div>
	<div class="row">
		<?php echo CHtml::label('Net Price', 'netPrice'); ?>
		<?php echo CHtml::textField('netPrice', '', array('disabled' => true, 'class' => 'span-3 form-control')); ?>
	</div>
	
	<div class="row buttons">
		<?php echo CHtml::resetButton('Clear', array('id' => 'btnClear', 'class' => 'btn btn-primary')); ?>
	</div>

	<?php $this->endWidget(); ?>

</div><!-- search-form -->

<script>
	$("#product").keypress(function( event ) {
		if ( event.which == 13 ) {
			$("#btnClear").focus();
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
				$("#productDesc").val(result.code + ' ' + result.description);
				catalogPrice = Number(result.catalogPrice);
				$("#catalogPrice").val(catalogPrice.toFixed(2));
				netPriceDiscount = Number(result.netPriceDiscount);
				$("#discount").val(netPriceDiscount);
				$("#netPrice").val(Number(catalogPrice - (catalogPrice * (netPriceDiscount / 100))).toFixed(2));
				stockStatus = 'Available';
				if(result._outOfStocksUp == 0)
				{
					stockStatus = 'Out Of Stock';
				}
				else if(result._outOfStocksUp > 0)
				{
					stockStatus = 'Critical Stock (' + result._outOfStocksUp + ')';
				}
				$("#stockStatus").val(stockStatus);
			});
		}
		// Change focus to discount field		
	});
</script>
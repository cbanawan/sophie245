<?php
	Yii::app()->getClientScript()->registerScript("dateCreated", "
		$( document ).ready(function() {
			$('#product').click(function() {
				$(this).val('');
			});

			$('#btnClear').click(function(){
				$('#product').val('');
				$('#product').focus();
			});
		});
	");

	
	Yii::app()->clientScript->registerScript('item', "
		$('#order-item-form').submit(function(){
			$.ajax({
			  type: 'POST',
			  url: '" . Yii::app()->createUrl('order/ajaxAddOrderItem') . "',
			  data: $(this).serialize()
			})
			  .done(function( msg ) {
				  $.fn.yiiGridView.update('order-items-grid');
				  $.ajax({
						url: '" . Yii::app()->createUrl('order/ajaxView', array('id' => $order->id)) . "',
						type: 'GET',
						dataType: 'html',
						success: function (result) {
							$('#order-details').html(result);
						},
					});	
			});

			$('#btnClear').click();	

			return false;
		});
	");
?>	

<?php $this->beginWidget(
    'booster.widgets.TbModal',
    array(
		'id' => 'order-item-dialog',
	)
); ?>

    <div class="modal-header">
        <a class="close" data-dismiss="modal">&times;</a>
        <h4>Add New Order Item</h4>
    </div>

    <div class="modal-body">
		<div class="form">
			<div class="row">
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

			<legend></legend>

			<div class="row">
			<?php $form = $this->beginWidget('booster.widgets.TbActiveForm', array(
				'id' => 'order-item-form',
				'action' => Yii::app()->createUrl($this->route),
				'method' => 'post',
			)); ?>

				<fieldset>

				<?php
					echo CHtml::hiddenField('orderId', $order->id);
					echo CHtml::hiddenField('productId', '');
				?>

				<div class="row">
					<?php echo CHtml::label('Selected Product', 'productDesc'); ?>
					<?php echo CHtml::textField('productDesc', '', array('disabled' => true, 'class' => 'form-control')); ?>
				</div>
				<div class="row">
					<?php echo CHtml::label('Stock Status', 'stockStatus'); ?>
					<?php echo CHtml::textField('stockStatus', '', array('disabled' => true, 'class' => 'form-control span-6')); ?>
				</div>
				<div class="row">
					<?php echo CHtml::label('Discount', 'discount'); ?>
					<?php echo CHtml::textField('discount', '', array('class' => 'text-right form-control span-3')); ?>
				</div>
				<div class="row">
					<?php echo CHtml::label('Quantity', 'quantity'); ?>
					<?php echo CHtml::textField('quantity', '', array('class' => 'text-right form-control span-3')); ?>
				</div>
			   <div class="modal-footer">
					<?php 
						$this->widget(
							'booster.widgets.TbButton',
							array(
								'id' => 'btnSave',
								'context' => 'primary',
								'label' => 'Save',
								'url' => '#',
								'htmlOptions' => array(
									'type' => 'submit',
								),
							)
						); 

						$this->widget(
							'booster.widgets.TbButton',
							array(
								'label' => 'Clear',
								'url' => '#',
								'htmlOptions' => array(
									// 'data-dismiss' => 'modal',
									'id' => 'btnClear',
									'type' => 'reset',
									// 'onclick' => '$("#product").val("");',
								),
							)
						); 

						$this->widget(
							'booster.widgets.TbButton',
							array(
								'id' => 'btnClose',
								'label' => 'Close',
								'url' => '#',
								'htmlOptions' => array(
									'data-dismiss' => 'modal',
									'onclick' => '$("#btnClear").click();',
								),
							)
						); 
					?>
				</div>					

				</fieldset>

			<?php $this->endWidget(); ?>
			</div>

		</div>
    </div>
 
<?php $this->endWidget(); ?>

<script>
	$("#product").keypress(function( event ) {
		if ( event.which == 13 ) {
			$("#quantity").focus();
			if($(this).val() == '')
			{
				$('#btnClose').click();
			}
			//if($(this).val() != '')
			else {
				product = $(this).val();
				prod = product.split(" ");

				$.getJSON("<?php echo Yii::app()->createUrl('products/getProduct&id='); ?>" + prod[0],function(result){
					// alert(result.id);
					$("#productId").val(result.id);
					$("#discount").val(result.netPriceDiscount);
					$("#productDesc").val(result.code + ' ' + result.description);
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
		}
	});
</script>
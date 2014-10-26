<?php
	Yii::app()->clientScript->registerScript('payment', "
		$('#order-payment-form').submit(function(){
			$.ajax({
			  type: 'POST',
			  url: '" . Yii::app()->createUrl('order/ajaxAddOrderPayment') . "',
			  data: $(this).serialize()
			})
			  .done(function( msg ) {
				  $.fn.yiiGridView.update('order-payments-grid');
				  $.ajax({
						url: '" . Yii::app()->createUrl('order/ajaxView', array('id' => $order->id)) . "',
						type: 'GET',
						dataType: 'html',
						success: function (result) {
							$('#order-details').html(result);
						},
					});				  
			});

			$('#btnPaymentClose').click();	

			return false;
		});
	");
	
	Yii::app()->clientScript->registerCss('payment', "
		.modal-content {
			{width: 350px;}
		}
	");
?>	

<?php $this->beginWidget(
    'booster.widgets.TbModal',
    array(
		'id' => 'order-payment-dialog',
	)
); ?>

    <div class="modal-header">
        <a class="close" data-dismiss="modal">&times;</a>
        <h4>Add Order Payment</h4>
    </div>

    <div class="modal-body">
		<div class="form">
		<?php $form = $this->beginWidget('booster.widgets.TbActiveForm', array(
			'id' => 'order-payment-form',
			'action' => Yii::app()->createUrl($this->route),
			'method' => 'post',
		)); 

		echo CHtml::hiddenField('orderId', $order->id);
		?>

			<div class="container-fluid">
				<div class="row-fluid">
					<div class="col-md-6">
					<strong>Payment Details</strong>
						<table class="table-striped table-condensed">
							<tr>
								<td class="text-right">Gross Amount:</td>
								<td class="text-right"><strong>Php <span id="grossAmount"></span></strong></td>
							</tr>
							<tr>
								<td class="text-right">Minimum Deposit:</td>
								<td class="text-right"><strong>Php <span id="requiredDeposit"></span></strong></td>
							</tr>
							<tr>
								<td class="text-right">&nbsp;</td>
								<td class="text-right">&nbsp;</td>
							</tr>
							<tr>
								<td class="text-right">Net Amount:</td>
								<td class="text-right"><strong>Php <span id="amountDue"></span></strong></td>
							</tr>
							<tr>
								<td class="text-right">Total Paid:</td>
								<td class="text-right"><strong>Php <span id="totalPayment"></span></strong></td>
							</tr>
							<tr>
								<td class="text-right">Balance Due:</td>
								<td class="text-right"><strong>Php <span id="balanceDue"></span></strong></td>
							</tr>
						</table>
					</div>
					<div class="col-md-6 well">
						<div class="row">
							<?php echo CHtml::label('Amount Paid', 'amount'); ?>
							<?php echo CHtml::textField('amount', '', array('class' => 'form-control span-3 text-right', 'onclick' => '$(this).val("")')); ?>
						</div>
						<div class="row">
							<?php echo CHtml::label('Remarks', 'remarks'); ?>
							<?php echo CHtml::textArea('remarks', '', array('class' => 'form-control')); ?>
						</div>
					</div>
				</div>
				<div class="row">
				   <div class="modal-footer">
						<?php 
							$this->widget(
								'booster.widgets.TbButton',
								array(
									'id' => 'btnPaymentSave',
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
										'onclick' => '$("#amount").focus();',
									),
								)
							); 

							$this->widget(
								'booster.widgets.TbButton',
								array(
									'id' => 'btnPaymentClose',
									'label' => 'Close',
									'url' => '#',
									'htmlOptions' => array(
										'data-dismiss' => 'modal',
										// 'onclick' => '$("#order-payment-form").reset();',
									),
								)
							); 
						?>
					</div>
				</div>
			<?php $this->endWidget(); ?>
			</div>
		</div>
    </div>

<?php $this->endWidget(); ?>
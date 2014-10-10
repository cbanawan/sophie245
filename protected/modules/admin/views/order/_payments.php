<?php 
$dataProvider = new CArrayDataProvider('Payments');
$dataProvider->setData($payments);

$totalAmountPaid = 0;
foreach($payments as $payment)
{
	$totalAmountPaid += $payment->amount;
}

$columns = array(
		array(
			'name' => 'dateCreated',
			'header' => 'Date Created',
			'value' => 'date("d M Y", strtotime($data->dateCreated))',
			'footer' => '<strong>TOTALS:</strong>'
		),
		array(
			'name' => 'paymentType.description',
			'header' => 'Payment Type',
			'htmlOptions'=>array('style'=>'text-align: center'),
			'value' => '$data->paymentType->description',
		),
		array(
			'name' => 'userId',
			'header' => 'Processed By',
			'htmlOptions'=>array('style'=>'text-align: center'),
			'value' => '$data->user->username',
		),
		array(
			'name' => 'amount',
			'header' => 'Amount Paid',
			'value' => 'number_format($data->amount, 2)',
			'htmlOptions'=>array('style'=>'text-align: right'),
			'footer' => '<strong>' . number_format($totalAmountPaid, 2) . '</strong>',
			'footerHtmlOptions'=>array('class' => 'text-right'),
		),
		array(
			'name' => 'remarks',
			'header' => 'Remarks',
			'value' => '$data->remarks',
		),
	);

if(!in_array($orderStatus, array('served', 'cancelled', 'ordered')))
{
	$columns[] = array(
			'class'=>'CButtonColumn',
			'template'=>'{cancel}',
		    'buttons'=>array
			(
				'cancel' => array
				(
					'label' => 'Cancel',
					'name' => 'cancel',
					'imageUrl' => Yii::app()->request->baseUrl.'/images/icons/remove.png',
					'url' => 'Yii::app()->createUrl("admin/order/ajaxDeletePayment", array("id" => $data->id))',
					'options' => array(
						'class' => 'remove-item-link',
						// 'onclick' => 'return false;',
					)
				),

			),	
		);
}
		
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'orderpayments-grid',
	'dataProvider' => $dataProvider,
	'emptyText' => 'NO payment has been made for this Order yet.',
	'template' => '{items}{pager}', 
	// 'filter'=>$model,
	'columns' => $columns,
)); 

Yii::app()->getClientScript()->registerScript("icon-actions", "
	$('.remove-item-link').live('click', function() {
		// alert(this.href);
		
		var url = this.href;
		var action = (this.name == 'cancel') ? 'Delete Order Item' : 'Update Order Item Status';
		
		$('<div></div>').appendTo('body')
			.html('<div><h6>Are you sure?</h6></div>')
			.dialog({
				modal: true,
				title: action,
				zIndex: 10000,
				autoOpen: true,
				width: 'auto',
				resizable: false,
				buttons: {
					Yes: function () {
						// $(obj).removeAttr('onclick');                                
						// $(obj).parents('.Parent').remove();
						
						$.ajax({
						  type: 'GET',
						  url: url,
						})
						  .done(function( msg ) {
							$.fn.yiiGridView.update('orderpayments-grid');
							$.fn.yiiGridView.update('orderdetails-grid');
							$.ajax({
							  type: 'GET',
							  url: '" . Yii::app()->createUrl('admin/order/ajaxView', array('id' => $orderId)) . "',
							})
							  .success(function( result ) {
									$('#po-header').html(result);
							  });							
						  });

						$(this).dialog('close');
					},
					No: function () {
						$(this).dialog('close');
					}
				},
				close: function (event, ui) {
					$(this).remove();
				}
			});
		return false;
	});
");
?>


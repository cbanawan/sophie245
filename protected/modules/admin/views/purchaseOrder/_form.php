<?php
/* @var $this PurchaseOrderController */
/* @var $model PurchaseOrders */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'purchase-orders-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>
	<br />
	<p class="note">
		Please select the <strong>Sales Order</strong> to be included in your <strong>Purchase Order</strong>.
	</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
	<?php
	$gridColumns = array(
		array(
			'name' => 'id',
			'header' => 'Order ID',
		),
		array(
			'name' => 'dateCreated',
			'header' => 'Date Created',
		),
		array(
			'name' => 'member.codeName',
			'header' => 'Member',
		),
		array(
			'name' => 'netAmount',
			'header' => 'Total Amount',
		),
		array(
			'name' => 'totalPayment',
			'header' => 'Amount Paid',
		),
		array(
			'name' => 'orderStatus.description',
			'header' => 'Status',
		),
	);

	$this->widget('booster.widgets.TbExtendedGridView', array(
		'type' => 'striped bordered',
		'dataProvider' => $orders,
		'template' => "{items}",
		'selectableRows' => 2,
		'bulkActions' => array(
		'actionButtons' => array(
			/*array(
				'id' => 'btnCheck',
				'buttonType' => 'button',
				'context' => 'primary',
				'size' => 'small',
				'label' => 'Testing Primary Bulk Actions',
				'click' => 'js:function(values){console.log(values);}'
				)*/
			),
			// if grid doesn't have a checkbox column type, it will attach
			// one and this configuration will be part of it
			'checkBoxColumnConfig' => array(
				'name' => 'id',
				'id' => 'orders',
			),
		),
		'columns' => $gridColumns,
	));	
	?>
	</div>
	<div class="row buttons pull-right">
		<?php 
			$this->widget(
				'booster.widgets.TbButton',
				array(
					'label' => $model->isNewRecord ? 'Create' : 'Save',
					'htmlOptions' => array(
						'type' => 'submit',
						'class' => 'primary',
					),
				)
			);
		
		?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
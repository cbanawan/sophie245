<?php
/* @var $this DeliveryController */
/* @var $model Deliveries */

$this->breadcrumbs=array(
	'Deliveries'=>array('admin'),
	$model->id,
	'Create New Delivery' => array('create'),
);

$this->menu=array(
	array('label'=>'List Deliveries', 'url'=>array('index')),
	array('label'=>'Create Deliveries', 'url'=>array('create')),
	array('label'=>'Update Deliveries', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Deliveries', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Deliveries', 'url'=>array('admin')),
);
?>

<?php $this->beginWidget(
    'booster.widgets.TbPanel',
    array(
        'title' => 'Delivery Details',
        'headerIcon' => 'barcode',
		'headerButtons' => array(
            array(
				'class' => 'booster.widgets.TbButtonGroup',
				'size' => 'medium',
				'buttons' => array(
					array(
						'label' => 'Refresh',
						'icon' => 'refresh',
						'htmlOptions' => array(
							'id' => 'refresh-po',
							'onclick' => 'js:window.location.reload()',
						)
					),
					/*array(
						'label' => 'Update Delivery Details',
						'icon' => 'edit',
						'htmlOptions' => array(
							'id' => 'update-po',
							//'onclick' => 'window.location.href="' . Yii::app()->createUrl('/admin/purchaseOrder/update', array('id' => $model->id)) . '"',
						)
					),*/
					array(
						'label' => 'Change Delivery Status',
						'icon' => 'cog',
						'items' => array(
							array(
								'label' => 'Confirm Delivery', 
								//'url' => Yii::app()->createUrl('/admin/purchaseOrder/updateStatus', array('id' => $model->id, 'status' => 'cancelled')),
								'visible' => !$model->deliveryConfirmed,
							),
							/*array(
								'label' => 'Temporary', 
								//'url' => Yii::app()->createUrl('/admin/purchaseOrder/updateStatus', array('id' => $model->id, 'status' => 'temp')),
								//'visible' => !in_array($model->orderStatus->status, array('temp', 'delivered')),
							),*/
						)
					),
				),
            ),
		)		
    )
); ?>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'dateCreated',
		'dateLastModified',
		'dateDelivered',
		'purchaseOrderId',
		'user.username',
		array(
			'name' => 'deliveryConfirmed',
			'value' => $model->deliveryConfirmed ? "Yes" : "No",
		),
	),
)); ?>

<?php $this->endWidget(); ?>

<?php
	$this->renderPartial(
				'_productList',
				array(
					'model' => $model
				)
			);
?>

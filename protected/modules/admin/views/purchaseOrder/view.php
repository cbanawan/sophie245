<?php
/* @var $this PurchaseOrderController */
/* @var $model PurchaseOrders */

	$this->breadcrumbs=array(
		'Purchase Orders'=>array('admin'),
		$model->id,
		'Export to CSV'=>array('export', 'id' => $model->id),
	);

	$this->menu=array(
		array('label'=>'List PurchaseOrders', 'url'=>array('index')),
		array('label'=>'Create PurchaseOrders', 'url'=>array('create')),
		array('label'=>'Update PurchaseOrders', 'url'=>array('update', 'id'=>$model->id)),
		array('label'=>'Delete PurchaseOrders', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
		array('label'=>'Manage PurchaseOrders', 'url'=>array('admin')),
	);

 
	/*Yii::app()->getClientScript()->registerScript("po-order-actions", "
		$('#add-po-order-btn').click(function(){
			$('#orders-grid').yiiGridView('update', {
				data: $(this).serialize()
			});
			
			return false;
		});
	");	*/
?>

<?php
	$this->widget('booster.widgets.TbAlert', array(
		'fade' => true,
		'closeText' => '&times;', // false equals no close link
		'events' => array(),
		'htmlOptions' => array(),
		'userComponentId' => 'user',
		'alerts' => array( // configurations per alert type
			// success, info, warning, error or danger
			'success' => array('closeText' => '&times;'),
			'info', // you don't need to specify full config
			'warning' => array('closeText' => false),
			'error' => array('closeText' => 'AAARGHH!!')
		),
	));
?>

<?php $this->beginWidget(
    'booster.widgets.TbPanel',
    array(
        'title' => 'Purchase Order Header',
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
							'onclick' => 'window.location.href="' . Yii::app()->createUrl('/admin/purchaseOrder/view', array('id' => $model->id)) . '"',
						)
					),
					array(
						'label' => 'Update P.O.',
						'icon' => 'edit',
						'htmlOptions' => array(
							'id' => 'update-po',
							'onclick' => 'window.location.href="' . Yii::app()->createUrl('/admin/purchaseOrder/update', array('id' => $model->id)) . '"',
						)
					),
					array(
						'label' => 'Change Order Status',
						'icon' => 'cog',
						'items' => array(
							array(
								'label' => 'Cancel', 
								'url' => Yii::app()->createUrl('/admin/purchaseOrder/updateStatus', array('id' => $model->id, 'status' => 'cancelled')),
								'visible' => !in_array($model->orderStatus->status, array('cancelled')),
							),
							array(
								'label' => 'Temporary', 
								'url' => Yii::app()->createUrl('/admin/purchaseOrder/updateStatus', array('id' => $model->id, 'status' => 'temp')),
								'visible' => !in_array($model->orderStatus->status, array('temp', 'delivered')),
							),
							array(
								'label' => 'Submitted/Confirmed', 
								'url' => Yii::app()->createUrl('/admin/purchaseOrder/updateStatus', array('id' => $model->id, 'status' => 'ordered')),
								'visible' => !in_array($model->orderStatus->status, array('ordered')),
							),
							array(
								'label' => 'Delivered', 
								'url' => Yii::app()->createUrl('/admin/purchaseOrder/updateStatus', array('id' => $model->id, 'status' => 'delivered')),
								'visible' => in_array($model->orderStatus->status, array('ordered')),
							),
							/*'---',
							array(
								'label' => 'Print Sales Order', 
								'url' => Yii::app()->createUrl('order/print', array('id' => $order->id)),
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
		'dateOrdered',
		'dateExpected',
		'orderConfirmationNo',
		array(
			'name' => 'totalAmount',
			'value' => 'Php ' . number_format($model->totalAmount, 2),
		),
		'user.username',
		'orderStatus.description',
	),
)); 
?>

<?php $this->endWidget(); ?>

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
		'name' => 'member.memberCode',
		'header' => 'Member Code',
	),
);
?>

<?php $collapse = $this->beginWidget('booster.widgets.TbCollapse'); ?>
<div class="panel-group" id="accordion">
  <div class="panel panel-default">
    <div class="panel-heading">
		<span class="glyphicon glyphicon-list"></span>
		<h3 class="panel-title" style="display: inline;">
			<a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
				Order List
			</a>
		</h3>
    </div>
    <div id="collapseOne" class="panel-collapse collapse in">
      <div class="panel-body">
		  <?php
			/*echo CHtml::link(
					'Add Order',
					array('update', 'id' => $model->id)
				);	*/	  
		  
			$this->renderPartial(
						'_orderList',
						array(
							'pOrder' => $model,
						)
					);
		  ?>
      </div>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading">
		<span class="glyphicon glyphicon-barcode"></span>
		<h3 class="panel-title" style="display: inline;">
			<a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
				Product List
			</a>
		</h3>
    </div>
    <div id="collapseTwo" class="panel-collapse collapse">
      <div class="panel-body">
		<?php
			echo CHtml::link(
				'Export to CSV',
				array('export', 'id' => $model->id),
				array('class' => 'btn btn-default')
			);
			
			$this->renderPartial(
				'_productList',
				array(
					'pOrder' => $model,
					'productOrders' => $productOrders,
				)
			);
	  ?>
      </div>
    </div>
  </div>
</div>
<?php $this->endWidget(); ?>


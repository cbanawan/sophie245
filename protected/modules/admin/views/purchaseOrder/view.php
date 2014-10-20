<?php
/* @var $this PurchaseOrderController */
/* @var $model PurchaseOrders */

	$this->breadcrumbs=array(
		'Purchase Orders'=>array('index'),
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

<h1>View PurchaseOrders #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'dateCreated',
		'dateLastModified',
		'dateOrdered',
		'userId',
		'orderStatusId',
	),
)); 

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
			echo CHtml::link(
					'Add Order',
					array('update', 'id' => $model->id)
				);		  
		  
			$this->renderPartial(
						'_orderList',
						array(
							'orders' => $model->orders,
						)
					);
			$model->orders;
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
				array('export', 'id' => $model->id)
			);
			
			$this->renderPartial(
				'_productList',
				array(
					'poOrderId' => $model->id,
					'productOrders' => $productOrders,
				)
			);
	  ?>
      </div>
    </div>
  </div>
</div>
<?php $this->endWidget(); ?>


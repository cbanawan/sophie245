<?php
	$this->breadcrumbs=array(
		'Sales Order',
		'Create New Order' => array('order/create'),
	);
?>

<?php $collapse = $this->beginWidget('booster.widgets.TbCollapse'); ?>
<div class="panel-group" id="accordion">
  <div class="panel panel-default">
	<div class="panel-heading">
	  <h4 class="panel-title">
		<a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
			<span class="glyphicon glyphicon-search"></span>
			Search Order Filter
		</a>
	  </h4>
	</div>
	<div id="collapseOne" class="panel-collapse collapse">
	  <div class="panel-body">
		<?php
			$this->renderPartial('_orderSearch',array(
					'model'=>$orders,
					'orderStatus' => $orderStatus,
				));
		?>
	  </div>
	</div>
  </div>
</div>
<?php $this->endWidget(); ?>

<?php 
	Yii::app()->getClientScript()->registerScript("dateCreated", "
		$('#export-order-item-button').on('click',function() {
			window.location = '". $this->createUrl('export')  . "' + '&export=true&' + $('#order-search-form').serialize();
		});
		
		/*$.fn.yiiGridView.export = function() {
			alert('xxyy');
			$.fn.yiiGridView.update('orders-grid',{ 
				success: function() {
					$('#orders-grid').removeClass('grid-view-loading');
					window.location = '". $this->createUrl('export')  . "' + '&export=true&' + $('#order-search-form').serialize();
				},
				data: $('#order-search-form').serialize() + '&export=true'
			});
		}*/
	");	
?>

<?php $this->beginWidget(
    'booster.widgets.TbPanel',
    array(
        'title' => 'Sales Order Items',
        'headerIcon' => 'list-alt',
		'padContent' => false,
        'htmlOptions' => array('class' => 'bootstrap-widget-table'),
		'headerButtons' => array(
            array(
                'class' => 'booster.widgets.TbButton',
				'label' => 'Export to CSV',
				'icon' => 'plus-sign',
				'size' => 'medium',
				'htmlOptions' => array(
					'id' => 'export-order-item-button',
					'title' => 'Export to CSV',
				),	
				// 'visible' => (!in_array($order->orderStatus->status, array('cancelled')))
            ),
        )		
    )
); ?>

<?php
	$this->renderPartial(
				'_list',
				array(
					'orders'=>$orders,
				)
			);
?>			

<?php $this->endWidget(); ?>
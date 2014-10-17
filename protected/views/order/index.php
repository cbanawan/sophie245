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

<?php $this->beginWidget(
    'booster.widgets.TbPanel',
    array(
        'title' => 'Sales Orders',
        'headerIcon' => 'barcode'
	)
);?>

<?php
	$this->renderPartial(
				'_list',
				array(
					'orders'=>$orders,
				)
			);
?>			

<?php $this->endWidget(); ?>
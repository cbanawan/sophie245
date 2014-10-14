<?php $this->beginWidget(
    'booster.widgets.TbPanel',
    array(
        'title' => 'Sales Order #' . $order->id,
        'headerIcon' => 'list-alt',
        // 'content' => 'My Basic Content (you can use renderPartial here too :))'
    )
); ?>
	<div id='order-details'>
	<?php 
		$orderDetails = $order->attributes;
		$orderDetails['memberName'] = $order->member->codeName;
		$orderDetails['orderStatus'] = $order->orderStatus->description;
		$this->renderPartial(
				'_detail',
				array(
					'order' => $orderDetails,
				)
			); 		
	?>
	</div>
	<div id="order-items" class="well text-right">
		<div id="order-buttons">
		<?php
			$this->widget(
				'booster.widgets.TbButtonGroup',
				array(
					'size' => 'medium',
					'buttons' => array(
						array(
							'label' => 'Change Order Status',
							'icon' => 'cog',
							'items' => array(
								array(
									'label' => 'Cancel Order', 
									'url' => '#'
								),
								array(
									'label' => 'For Order Placement', 
									'url' => '#'
								),
								array(
									'label' => 'Items Delivered', 
									'url' => '#'
								),
								array(
									'label' => 'Order Served', 
									'url' => '#'
								),
							)
						),
					),
				)
			);	
			?>
			<div class="btn-group">
			<?php 
			$this->widget(
				'booster.widgets.TbButton',
				array(
					'label' => 'Add Order Payment',
					'icon' => 'plus-sign',
					'size' => 'medium',
					'htmlOptions' => array(
						'data-toggle' => 'tooltip',
						'title' => 'Add Order Payment'
					),
				)
			);
			?>
			</div>
			<div class="btn-group">
			<?php
			$this->widget(
				'booster.widgets.TbButton',
				array(
					'label' => 'Add New Order Item',
					'icon' => 'plus-sign',
					'size' => 'medium',
					'htmlOptions' => array(
						'data-toggle' => 'tooltip',
						'title' => 'Add New Order Item'
					),
				)
			);
			?>
			</div>
		</div>
	<?php
		$this->renderPartial(
				'_items',
				array(
					'orderDetails' => $order->orderdetails,
				)
			); 		
	?>
	</div>
<?php $this->endWidget(); ?>
	 
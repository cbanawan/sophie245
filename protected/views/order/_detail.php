<?php
	$this->widget(
		'booster.widgets.TbDetailView',
		array(
			'data' => $order,
			'attributes' => array(
				array('name' => 'id', 'label' => 'Sales Order ID'),
				array('name' => 'memberName', 'label' => 'Ordered By'),
				array('name' => 'dateCreated', 'label' => 'Date Created'),
				array('name' => 'orderStatus', 'label' => 'Order Status'),
			),
		)
	);
?>
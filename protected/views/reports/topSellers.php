<?php
	// echo '<pre>';
	// var_dump($dataProvider); exit;

	$this->widget(
		'booster.widgets.TbGridView',
		array(
			'type' => 'striped bordered condensed',
			'dataProvider' => $dataProvider,
			'template' => "{items}",
			'columns' => array(
				array(
					'name' => 'id',
					'type' => 'raw',
					'value' => 'CHtml::encode($data["id"])',
				),
				array(
					'name' => 'memberCode',
					'type' => 'raw',
					'value' => 'CHtml::encode($data["memberCode"])',
				),
				array(
					'name' => 'lastname',
					'type' => 'raw',
					'value' => 'CHtml::encode($data["lastname"])',
				),
				array(
					'name' => 'firstname',
					'type' => 'raw',
					'value' => 'CHtml::encode($data["firstname"])',
				),
				array(
					'name' => 'grossAmount',
					'type' => 'raw',
					'value' => 'CHtml::encode(number_format($data["grossAmount"], 2))',
					'htmlOptions' => array('style'=>'text-align: right'),
				),
			),
		)
	);
?>

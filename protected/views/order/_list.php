<?php $this->widget('booster.widgets.TbGridView', array(
	'id'=>'orders-grid',
	'template' => '{items}{pager}', 
	'dataProvider'=>$orders->search(),
	'columns'=>array(
		'id',
		array(
			'name' => 'dateCreated',
			'value' => 'date("m/d/Y H:i:s", strtotime($data->dateCreated))'
		),
		array(
			'name' => 'dateLastModified',
			'value' => 'date("m/d/Y H:i:s", strtotime($data->dateLastModified))'
		),
		// 'dateLastModified',
		// 'memberId',
		array(
			'name' => 'memberCode',
			'value' => '$data->memberMemberCode',
			// 'filter'=> CHtml::activeTextField($model, 'memberCode'),
		),
		array(
			'name' => 'memberName',
			'value' => '$data->memberFullName',
			// 'filter'=> CHtml::activeTextField($model, 'memberCode'),
		),
		// 'user.username',
		array(
			'name' => 'P.O. Amount',
			'value' => 'number_format($data->orderDetailSummary["net"], 2)',
			'htmlOptions' => array('class' => 'text-right'),
		),
		array(
			'name' => 'Amount Paid',
			'value' => 'number_format($data->totalPayment, 2)',
			'htmlOptions' => array('class' => 'text-right'),
		),
		array(
			'name' => 'status',
			'value' => '$data->orderStatusDesc',
			'htmlOptions' => array('class' => 'text-center'),
		),
		array(
			'class'=>'CButtonColumn',
			'template'=>'{view}',
			'viewButtonUrl' => 'Yii::app()->controller->createUrl("order/view", array("id" => $data->id))',
			'buttons' => array(
				'view' => array(
					'htmlOptions' => array(
						'_target' => '_blank'
					)
				)
			),
		),
	),
)); ?>
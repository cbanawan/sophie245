<?php $this->widget('booster.widgets.TbGridView', array(
	'id'=>'orders-grid',
	'template' => '{items}{pager}', 
	'dataProvider'=>$orders->search(),
	'columns'=>array(
		array(
			'name' => 'id',
			'header' => 'S.O. No.'
		),
		array(
			'name' => 'dateCreated',
			'value' => 'date("m/d/Y", strtotime($data->dateCreated))'
		),
		array(
			'name' => 'dateLastModified',
			'value' => 'date("m/d/Y", strtotime($data->dateLastModified))'
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
			'name' => 'catalogId',
			'value' => '$data->catalog->name',
			'htmlOptions' => array('class' => 'text-center'),
		),
		array(
			'class' => 'booster.widgets.TbButtonColumn',
			'template'=>'{view}',
			'viewButtonUrl' => 'Yii::app()->controller->createUrl("order/view", array("id" => $data->id))',
			'buttons' => array(
				'view' => array(
					'icon' => 'zoom-in',
					'htmlOptions' => array(
						'_target' => '_blank'
					)
				)
			),
		),
	),
)); ?>
<?php
/* @var $this MemberController */
/* @var $model Members */

$this->breadcrumbs=array(
	'Member',
	'Create New Member' => array('create'),
	'Upload Members from CSV' => array('/admin/member/upload'),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#members-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<?php $this->beginWidget(
    'booster.widgets.TbPanel',
    array(
        'title' => 'Manage Members',
        'headerIcon' => 'user',
		// 'padContent' => false,
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

<?php // echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('booster.widgets.TbGridView', array(
	'id'=>'members-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'dateJoined',
		'memberCode',
		'lastName',
		'firstName',
		'middleName',
		'sponsorCode',
		/*
		'_active',
		'homePhone',
		'mobilePhone',
		'emailAddress',
		'address1',
		'address2',
		'cityId',
		'dateJoined',
		'sponsorCode',
		'position',
		*/
		array(
			'class' => 'booster.widgets.TbButtonColumn',
			'template' => '{view}&nbsp;&nbsp;{update}',
			'buttons' => array(
				'view' => array(
					'icon' => 'edit',
				),
			)
		),
	),
)); ?>

<?php $this->endWidget(); ?>

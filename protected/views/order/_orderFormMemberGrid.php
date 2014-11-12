<?php
	Yii::app()->getClientScript()->registerScript("order-form-member-grid", "
		//
	");

	$this->widget('booster.widgets.TbGridView', array(
		'id'=>'members-grid',
		'template' => '{items}{pager}', 
		'dataProvider' => $dataProvider,
		'columns'=>array(
			array(
				'name' => 'memberCode',
				'header' => 'Member Code'
			),
			array(
				'name' => 'lastName',
				'header' => 'Lastname'
			),
			array(
				'name' => 'firstName',
				'header' => 'Firstname'
			),
			array(
				'name' => 'middleName',
				'header' => 'Middlename'
			),
		),
		'selectionChanged'=>"function(id){ 
			var memberId = $.fn.yiiGridView.getSelection(id);
			  $.ajax({
					url: '" . Yii::app()->createUrl('member/view&id=') . "' + memberId,
					type: 'GET',
					dataType: 'json',
					success: function (result) {
						$('#Orders_memberId').val(result.id);
						$('#Orders_memberCode').val(result.memberCode);
						$('#Orders_memberName').val(result.lastName + ', ' + result.firstName);
					},
				});			
		}",
	));
?>

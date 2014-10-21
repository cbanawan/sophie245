<?php
/* @var $this PurchaseOrderController */
/* @var $model PurchaseOrders */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget(
		'booster.widgets.TbActiveForm', 
		array(
			'id' => 'purchase-orders-form',
			// Please note: When you enable ajax validation, make sure the corresponding
			// controller action is handling ajax validation correctly.
			// There is a call to performAjaxValidation() commented in generated controller code.
			// See class documentation of CActiveForm for details on this.
			'enableAjaxValidation'=>false,
		)); ?>

	<?php echo $form->errorSummary($model); ?>
	
	<?php $this->beginWidget(
		'booster.widgets.TbPanel',
		array(
			'title' => 'Purchase Order Header',
			'headerIcon' => 'barcode',
			'headerButtons' => array(
				array(
					'class' => 'booster.widgets.TbButtonGroup',
					'size' => 'medium',
					'buttons' => array(
						array(
							'label' => 'Save',
							'icon' => 'save',
							// 'url' => Yii::app()->createUrl('/admin/purchaseOrder/udpate'),
							'htmlOptions' => array(
								'id' => 'print',
								'type' => 'submit',
							)
						),
					),
				),
			)
		)
	); ?>
	<div id="po-header-detail-view">
		<?php 
			$this->widget('zii.widgets.CDetailView', array(
				'data'=>$model,
				'attributes'=>array(
					'id',
					'dateCreated',
					'dateLastModified',
					'dateOrdered',
					array(
						'name' => 'totalAmount',
						'value' => 'Php ' . number_format($model->totalAmount, 2),
					),
					'user.username',
					'orderStatus.description',
				),
			));
		?>
	</div>
	<br />
	<div class="well" id="po-header-detail-form">
		<div class="row">
			<div class="span-3">
			<?php
				echo $form->datePickerGroup(
						$model,
						'dateOrdered',
						array(
							'widgetOptions' => array(
								'options' => array(
									'language' => 'es',
								),
							),
							'wrapperHtmlOptions' => array(
								'class' => 'col-sm-3',
							),
							// 'hint' => 'Click inside! This is a super cool date field.',
							'prepend' => '<i class="glyphicon glyphicon-calendar"></i>'
						)
					);
			?>
			</div>
		</div>
		<div class="row">
			<div class="span-3">
			<?php
				echo $form->datePickerGroup(
						$model,
						'dateExpected',
						array(
							'widgetOptions' => array(
								'options' => array(
									'language' => 'es',
								),
							),
							'wrapperHtmlOptions' => array(
								'class' => 'col-sm-3',
							),
							// 'hint' => 'Click inside! This is a super cool date field.',
							'prepend' => '<i class="glyphicon glyphicon-calendar"></i>'
						)
					);
			?>
			</div>
		</div>
		<div class="row">
			<div class="span-6">
			<?php
				echo $form->textFieldGroup(
					$model,
					'orderConfirmationNo',
					array(
						'wrapperHtmlOptions' => array(
							'class' => 'col-sm-5',
						),
						// 'hint' => 'In addition to freeform text, any HTML5 text-based input appears like so.'
					)
				);			
			?>
			</div>
		</div>
	</div>

	<?php $this->endWidget(); ?>
	
	<?php $collapse = $this->beginWidget('booster.widgets.TbCollapse'); ?>
	<div class="panel-group" id="accordion">
	  <div class="panel panel-default">
		<div class="panel-heading">
			<span class="glyphicon glyphicon-list"></span>
			<h3 class="panel-title" style="display: inline;">
				<a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
					Select Orders
				</a>
			</h3>
		</div>
		<div id="collapseOne" class="panel-collapse collapse in">
		  <div class="panel-body">
			<?php
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
						'name' => 'member.codeName',
						'header' => 'Member',
					),
					array(
						'name' => 'netAmount',
						'header' => 'Total Amount',
					),
					array(
						'name' => 'totalPayment',
						'header' => 'Amount Paid',
					),
					array(
						'name' => 'orderStatus.description',
						'header' => 'Status',
					),
				);

				$this->widget('booster.widgets.TbExtendedGridView', array(
					'type' => 'striped bordered',
					'dataProvider' => $orders,
					'template' => "{items}",
					'selectableRows' => 2,
					'bulkActions' => array(
					'actionButtons' => array(
						/*array(
							'id' => 'btnCheck',
							'buttonType' => 'button',
							'context' => 'primary',
							'size' => 'small',
							'label' => 'Testing Primary Bulk Actions',
							'click' => 'js:function(values){console.log(values);}'
							)*/
						),
						// if grid doesn't have a checkbox column type, it will attach
						// one and this configuration will be part of it
						'checkBoxColumnConfig' => array(
							'name' => 'id',
							'id' => 'orders',
						),
					),
					'columns' => $gridColumns,
				));	
				?>
		  </div>
		</div>
	  </div>
	</div>
	<?php $this->endWidget(); ?>	
	
	<div class="row buttons pull-right">
		<?php 
			$this->widget(
				'booster.widgets.TbButton',
				array(
					'label' => $model->isNewRecord ? 'Create' : 'Save',
					'htmlOptions' => array(
						'type' => 'submit',
						'class' => 'primary',
					),
				)
			);
		
		?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
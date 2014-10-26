<?php
/* @var $this OrderController */

	$this->breadcrumbs=array(
		'Product' => array('/product/admin'),
		'Update Critical Stocks',
	);
?>
<?php 
	$form = $this->beginWidget(
			'booster.widgets.TbActiveForm', 
			array( 
				'id'=>'member-upload-form', 
				'enableAjaxValidation'=>false, 
				'htmlOptions' => array('enctype' => 'multipart/form-data'), 
			)
		);

		echo $form->fileFieldGroup($model, 'csv_file',
				array(
					'wrapperHtmlOptions' => array(
						'class' => 'col-sm-5',
					),
				)
			);

		$this->widget(
			'booster.widgets.TbButton',
			array(
				'label' => 'Upload',
				'icon' => 'globe',
				'htmlOptions' => array(
					'id' => 'post-submit-btn',
					'onclick'=>'javascript: send();'
				)
			)
		);

	$this->endWidget(); 
?>
<br />
<div id="upload-result">
	
</div>

<?php $this->beginWidget(
    'booster.widgets.TbModal',
    array('id' => 'please-wait-modal')
); ?>

	<div class="modal-header">
		<h3>Processing...</h3>
	</div>
	<div class="modal-body">
		<?php 
		$this->widget(
			'booster.widgets.TbProgress',
			array(
				'context' => 'success', // 'success', 'info', 'warning', or 'danger'
				'percent' => 100,
				'striped' => true,
				'animated' => true,
				'context' => 'primary'
			)
		);
		?>
	</div>
<?php $this->endWidget(); ?>

<script type="text/javascript">
// this script for collecting the form data and pass to the controller action and doing the on success validations
function send(){
    var formData = new FormData($("#member-upload-form")[0]);
    $.ajax({
        url: '<?php echo Yii::app()->createUrl("/admin/product/updateCritical"); ?>',
        type: 'POST',
        data: formData,
        datatype:'json',
        // async: false,
        beforeSend: function() {
            // do some loading options
			$("#upload-result").html('Starting update on critical stocks... Please wait!<br />');
        },
        success: function (data) {
			$("#upload-result").append('Critical stocks update: ' + data.critical + '<br />');
			$("#upload-result").append('Out-of-stocks update: ' + data.outOfStock + '<br />');
        },
 
        complete: function() {
            // success alerts
			$("#upload-result").append('Update complete!');
        },
 
        error: function (data) {
            alert("There may a error on uploading. Try again later")
        },
        cache: false,
        contentType: false,
        processData: false
    });
 
    return false;
}
</script>
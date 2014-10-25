<?php
/* @var $this OrderController */

	$this->breadcrumbs=array(
		'Member' => array('/member/admin'),
		'Upload Members from CSV',
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
		// echo CHtml::submitButton('Upload CSV',array("class"=>"btn btn-primary"));
		/*echo CHtml::htmlButton('Upload',array(
                'onclick'=>'javascript: send();', // on submit call JS send() function
                'id'=> 'post-submit-btn', // button id
                'class'=>'post_submit btn btn-primary',
			    // 'data-toggle' => 'modal',
				// 'data-target' => '#please-wait-modal',
            ));
*/
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
        url: '<?php echo Yii::app()->createUrl("/admin/member/upload"); ?>',
        type: 'POST',
        data: formData,
        datatype:'json',
        // async: false,
        beforeSend: function() {
            // do some loading options
			$("#upload-result").html('Starting upload...<br />');
        },
        success: function (data) {
            // on success do some validation or refresh the content div to display the uploaded images 
            // jQuery("#list-of-post").load("<?php echo Yii::app()->createUrl('//forumPost/forumPostDisplay'); ?>");
			$("#upload-result").append('Validatng results...<br />');
        },
 
        complete: function() {
            // success alerts
			$("#upload-result").append('Upload complete...<br />');
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
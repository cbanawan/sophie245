<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main2'); ?>
<div class="row-fluid">
	<div class="span2">
		<div id="sidebar">
			<?php
				$this->beginWidget('zii.widgets.CPortlet', array(
					'title'=>'Operations',
				));
				$this->widget('zii.widgets.CMenu', array(
					'items'=>$this->menu,
					'htmlOptions'=>array('class'=>'operations'),
				));
				$this->endWidget();
			?>		
		</div><!-- sidebar -->
	</div>
	<div class="span10">
		<div id="content">
			<?php echo $content; ?>
		</div><!-- content -->
	</div>
</div>
<?php $this->endContent(); ?>
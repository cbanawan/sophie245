<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<?php Yii::app()->bootstrap->register(); ?>		
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
	
	<?php
	
		Yii::app()->clientScript->registerScript('printReady', "
			jQuery(window).load(function() {
				window.print();
				window.close();
			});
		");

		Yii::app()->clientScript->registerCss('receipt', "
			#body {
				min-height: 200px;
				overflow: hidden;
			}
			
		    html *
			{
			   font-size: 10px !important;
			   color: #000 !important;
			   font-family: 'Courier New' !important;
			}
			
			.table-condensed th, .table-condensed td {
				padding: 0px;
				border: 0;
			}
			
			.table-condensed thead {
				border-bottom:1px solid #EEE;
			}

			.table-condensed tfoot {
				border-top:1px solid #EEE;
			}
			
			.well {
				padding: 2px 15px;
			}

		");
	?>	
</head>

<body>
<div id="page" class="container-fluid">
	<?php echo $content; ?>	
</div>
	
</body>
</html>
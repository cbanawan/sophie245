<?php
/* @var $this OrderController */

	$this->breadcrumbs=array(
		'Admin' => array('default/index'),
		'Product'
	);

	$this->menu = array(
		array(
			'label' => 'Upload New Critical',
			'url' => $this->createUrl('product/updateCritical'),
		),
		array(
			'label' => 'Search Product',
			'url' => $this->createUrl('product/search'),
		),
	);
?>

<?php
/* @var $this ProductController */

$this->breadcrumbs=array(
	'Product',
);
?>
<h1><?php echo $this->id . '/' . $this->action->id; ?></h1>

<p>
	You may change the content of this page by modifying
	the file <tt><?php echo __FILE__; ?></tt>.
</p>

<?php
//protected/components/UploadCsv.php

class UploadCsv
{
	private $model = null;
	public $csvFile = null;
	
	public function __construct($model) 
	{
		$this->model = new $model();
	}
	
}

?>

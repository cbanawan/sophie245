<?php
class Csv extends CFormModel
{
    public $csv_file;
	
	public function rules() 
	{ 
		return array();
		/*	'csv_file', 
			'file', 
			'types' => 'csv', 
			'maxSize'=>5242880, 
			'allowEmpty' => true, 
			'wrongType'=>'Only csv allowed.', 
			'tooLarge'=>'File too large! 5MB is the limit'
		);*/
	} 
	
	public function attributeLabels() 
	{ 
		return array(
			'csv_file'=>'Select a CSV file to Upload'
		);
	}	
}
?>
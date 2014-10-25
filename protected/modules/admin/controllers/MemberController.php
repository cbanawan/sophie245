<?php

class MemberController extends Controller
{
	public function filters() {
		return array(
			//... probably other filter specifications ...
			array('booster.filters.BoosterFilter')
		);
	}
	
	public function actionUpload()
	{
		$model = new Csv();
		
		if(Yii::app()->request->getParam('Csv'))
		{
			$model->attributes = Yii::app()->request->getParam('Csv');
			
			if($file = CUploadedFile::getInstance($model,'csv_file'))
			{
				$fp = fopen($file->tempName, 'r');
				if($fp)
				{
					$headers = array();
					
					$first_time = true;
					while( ($lineArray = fgetcsv($fp, 1000, ",")) != FALSE)
					{
						if ($first_time == true) 
						{
							foreach($lineArray as $headerName)
							{
								$headers[] = $this->trimUTF8BOM($headerName);
							}
							
							var_dump($headers);
							
							$first_time = false;
							continue;
						}
						
						$tmpData = array();
						foreach($lineArray as $idx => $value)
						{
							$tmpData[$headers[$idx]] = $value;
						}
						
						var_dump($tmpData);
						
						// Must have a member code to proceed
						// var_dump($tmpData['memberCode']);
 						if(!isset($tmpData['memberCode']) || empty($tmpData['memberCode']))
						{
							continue;
						}
						
						$member = Members::model()->find('memberCode = :memberCode', array(':memberCode' => $tmpData['memberCode']));
						if(!$member)
						{
							$member = new Members();
						}
						
						$member->attributes = $tmpData;
						if($member->save())
						{
							var_dump('Saved : ', $tmpData['memberCode']);
						}
						else
						{
							var_dump('Failed : ', $tmpData['memberCode']);
						}
						
						unset($member);
					}
				}
			}
		}
		
		if (Yii::app()->getRequest()->getIsAjaxRequest())
		{
			Yii::app()->end();
		}
		
		$this->render(
				'upload',
				array(
					'model' => $model,
				)
			);
	}
	
	private function trimUTF8BOM($data){ 
		if(substr($data, 0, 3) == pack('CCC', 239, 187, 191)) {
			return substr($data, 3);
		}
		return $data;
	}
	
	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}
<?php

class ProductController extends Controller
{
	public function actionIndex()
	{
		$this->render('index');
	}
	
	public function actionUpdateCritical()
	{
		$model = new Csv();
		
		//$file = CUploadedFile::getInstance($model,'csv_file');
		if(isset($_POST['Csv']))
		{
			$model->attributes=$_POST['Csv'];
			
			if($file = CUploadedFile::getInstance($model,'csv_file'))
			{
				$fp = fopen($file->tempName, 'r');
				if($fp)
				{
					// Reset count
					Products::model()->updateAll(array('_outOfStocksUp' => -1));
					
					//  $line = fgetcsv($fp, 1000, ",");
					//  print_r($line); exit;
					$first_time = true;
					while( ($line = fgetcsv($fp, 1000, ";")) != FALSE)
					{
						if ($first_time == true) 
						{
							$first_time = false;
							continue;
						}
							/*$model = new Registration;
							$model->firstname = $line[0];
							$model->lastname  = $line[1];

							$model->save();*/
							$lineArray = explode(',', $line[0]);
							Products::model()->updateAll(
										array('_outOfStocksUp' => $lineArray[5]),
										'code = :code',
										array(':code' => $lineArray[0])
									);
							
							var_dump('Updating.... ', $lineArray[0], $lineArray[5]);
							echo '<br />';

					}
					// $this->redirect('././index');

				}
				//    echo   $content = fread($fp, filesize($file->tempName));

			}



		}
		
		$this->render('updateCritical', array('model' => new Csv()));
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
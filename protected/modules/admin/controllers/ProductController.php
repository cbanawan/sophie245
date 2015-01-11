<?php

class ProductController extends Controller
{
	public function filters() {
		return array(
			//... probably other filter specifications ...
			array('booster.filters.BoosterFilter')
		);
	}
	
	public function actionIndex()
	{
		$this->render('index');
	}
	
	public function actionUpload($catId = null)
	{
		$model = new Csv();
                
                var_dump($catId);
		
		$catalog = null;
		// Fetch the catalog from params
		if($catId)
		{
			$catalog = Catalogs::model()->findByPk($catId);
		}
		// Fetch latest is no catalog id from params
		if(!$catalog)
		{
			$catalog = Catalogs::model()->find('_current = 1');
		}		
		
		$report = array(
			'summary' => array(
				'success' => array(
					'insert' => 0,
					'updated' => 0
				),
				'failure' => 0,
			),
			'failure' => array(),
		);
		
		if(Yii::app()->request->getParam('Csv'))
		{
			$model->attributes = Yii::app()->request->getParam('Csv');
			
			if($file = CUploadedFile::getInstance($model,'csv_file'))
			{
				$fp = fopen($file->tempName, 'r');
				if($fp)
				{
					$headers = array();
					$productGroup = CHtml::listData(ProductGroups::model()->findAll(), 'name', 'id');
					
					$first_time = true;
					while( ($lineArray = fgetcsv($fp, 1000, ",")) != FALSE)
					{
						if ($first_time == true) 
						{
							foreach($lineArray as $headerName)
							{
								$headers[] = $this->trimUTF8BOM($headerName);
							}
							
							// var_dump($headers);
							
							$first_time = false;
							continue;
						}
						
						$tmpData = array();
						foreach($lineArray as $idx => $value)
						{
							$tmpData[$headers[$idx]] = $value;
						}
						
						// Set the Catalog product belongs into
						$tmpData['catalogId'] = $catalog->id;
						
						// Set initial stocks to available
						$tmpData['_outOfStocksUp'] = -1;
						
						// Assign product group id
                                                if(isset($tmpData['group']))
                                                {
                                                    $tmpData['group'] = strtolower($tmpData['group']);
                                                    $tmpData['group'] = str_replace(' ', '_', $tmpData['group']);
                                                }
                                                else
                                                {
                                                    $tmpData['group'] = 'other';
                                                }
						if(isset($productGroup[$tmpData['group']]))
						{
							$tmpData['productGroupId'] = $productGroup[$tmpData['group']];	
						}
						else
						{
							$tmpData['productGroupId'] = $productGroup['other'];
						}
						
						
						// var_dump($tmpData);
						
						// Must have a member code to proceed
						// var_dump($tmpData['memberCode']);
 						if(!isset($tmpData['code']) || empty($tmpData['code']))
						{
							continue;
						}
						
						$criteria = new CDbCriteria();
						$criteria->addCondition('catalogId = :catalogId')
							 ->addCondition('code = :code');
						$criteria->params = array(
							':catalogId' => $catalog->id,
							':code' => $tmpData['code'],
						);
						$product = Products::model()->find($criteria);
						if(!$product)
						{
							$product = new Products();
						}
						
						$product->attributes = $tmpData;
						if($product->save())
						{
							$criteria = new CDbCriteria();
							$criteria->addCondition('code = :code')
									 ->addCondition('catalogId <> :catalogId');
							$criteria->params = array(
											':code' => $tmpData['code'],
											':catalogId' => $catalog->id,
										);
							Products::model()->updateAll(array('_active' => 0) , $criteria);
							
							// var_dump('Saved : ', $product->attributes);
							if($product->isNewRecord)
							{
								$report['summary']['success']['insert'] += 1;
							}
							else
							{
								$report['summary']['success']['updated'] += 1;
							}
						}
						else
						{
							$report['summary']['failure'] += 1;
							$report['failure'][] = array(
									'data' => $product->attributes,
									'error' => $product->getErrors()
								);
						}
						
						unset($product);
					}
				}
			}
		}
		
		if (Yii::app()->getRequest()->getIsAjaxRequest())
		{
			$this->renderJSON($report);
		}
		
		$this->render(
				'upload',
				array(
					'model' => $model,
					'catalog' => $catalog,
				)
			);
	}
	
	private function trimUTF8BOM($data){ 
		if(substr($data, 0, 3) == pack('CCC', 239, 187, 191)) {
			return substr($data, 3);
		}
		return $data;
	}
	
	public function actionUpdateCritical()
	{
		$model = new Csv();
		
		if (Yii::app()->getRequest()->getIsAjaxRequest())
		{
			$report = array(
				'critical' => 0,
				'outOfStock' => 0,
			);
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
						$currentCatalog = Catalogs::model()->findAll('_current = 1');
                                                $catalogIds = array();
                                                foreach($currentCatalog as $catalog)
                                                {
                                                    array_push($catalogIds, $catalog->id);
                                                }

						// Update all as inactive with zero stocks
						Products::model()->updateAll(
								array('_outOfStocksUp' => 0), 
								'catalogId NOT IN (' . implode(',', $catalogIds) . ')' 
								// array(':catalogId' => $currentCatalog->id)
							);
						
						// Update all products in current catalog as available
						Products::model()->updateAll(
								array('_outOfStocksUp' => -1), 
								'catalogId IN (' . implode(',', $catalogIds) . ')'  
								// array(':catalogId' => $currentCatalog->id)
							);

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

								$report[($lineArray[5] ? 'critical' : 'outOfStock')] += 1;
								
								// var_dump('Updating.... ', $lineArray[0], $lineArray[5]);
								// echo '<br />';

						}
					}
				}
			}
			
			$this->renderJSON($report);
			Yii::app()->end();			
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
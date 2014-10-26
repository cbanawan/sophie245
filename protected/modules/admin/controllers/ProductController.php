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
						$tmpData['group'] = strtolower($tmpData['group']);
						$tmpData['group'] = str_replace(' ', '_', $tmpData['group']);
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
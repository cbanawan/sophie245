<?php

class OrderController extends Controller
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
	
	public function actionView($id)
	{
		$order = Orders::model()->with('orderdetails', 'member', 'user')->findByPk($id);
		
		$this->render(
				'view',
				array(
					'order' => $order,
				)
			);
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
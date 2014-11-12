<?php

class DeliveryController extends Controller
{
	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
			array('booster.filters.BoosterFilter')
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update', 'ajaxUpdateQuantity', 'confirm'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$delivery = Deliveries::model()->with('products')->findByPk($id);
		
		$this->render(
				'view',
				array(
					'model'=>$delivery,
				)
			);
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Deliveries;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Deliveries']))
		{
			$model->attributes = $_POST['Deliveries'];
			
			// TODO: Based on login
			$model->receivedBy = 1;
			
			if($model->dateDelivered)
			{
				$model->dateDelivered = date('Y-m-d', strtotime($model->dateDelivered));
			}
			
			if($model->save())
			{
				// Update status of PO
				$purchaseOrder = PurchaseOrders::model()->with('orders')->findByPk($model->purchaseOrderId);
				if($purchaseOrder)
				{
					// Get order statuses
					$orderStatus = CHtml::listData(Orderstatus::model()->findAll(), 'status', 'id');

					// Update the PO status
					if(isset($orderStatus['delivered']))
					{
						$purchaseOrder->orderStatusId = $orderStatus['delivered'];
						$purchaseOrder->save();
					}
					
					$products = array();
					foreach($purchaseOrder->orders as $order)
					{
						// Update order status
						if(!in_array($order->orderStatusId, array(4, 5)))
						{
							if(isset($orderStatus['delivered']))
							{
								$order->orderStatusId = $orderStatus['delivered'];
								$order->save();
							}
						}
						
						// Gather all products in all order in this PO
						foreach($order->orderdetails as $orderDetail)
						{
							if(!$orderDetail->orderDetailStatus->_active)
							{
								continue;
							}
							
							if(!isset($products[$orderDetail->product->code]))
							{
								$products[$orderDetail->product->code] = array(
									'deliveryId' => $model->id,
									'productId' => $orderDetail->product->code,
									'ordered' => 0, // $orderDetail->quantity
								);
							}

							$products[$orderDetail->product->code]['ordered'] += $orderDetail->quantity;
						}
					}
					
					// Insert products to delivery details for initial product list
					foreach($products as $product)
					{
						$product['delivered'] = $product['ordered'];
						
						$dProduct = new DeliveryProducts();
						$dProduct->attributes = $product;
						$dProduct->save();
					}
				}
				
				
				
				$this->redirect(array('view','id'=>$model->id));
			}
		}
		
		$model->dateDelivered = date('Y-m-d');
		
		$pOrders = CHtml::listData(PurchaseOrders::model()->findAll('orderStatusId = 8'), 'id', 'orderConfirmationNo');
		
		if($pOrders)
		{
			$user = Yii::app()->getComponent('user');
			$user->setFlash(
				'error',
				'There are NO confirmed Orders pending for Delivery!'
			);
		}

		$this->render('create',array(
			'model' => $model,
			'pOrders' => $pOrders,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Deliveries']))
		{
			$model->attributes=$_POST['Deliveries'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}
		
		$pOrders = CHtml::listData(PurchaseOrders::model()->findAll('orderStatusId = 8'), 'id', 'orderConfirmationNo');

		$this->render('update',array(
			'model' => $model,
			'pOrders' => $pOrders,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Deliveries');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Deliveries('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Deliveries']))
			$model->attributes=$_GET['Deliveries'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}
	
	public function actionConfirm($id)
	{
		$model = $this->loadModel($id);
		if($model)
		{
			$model->deliveryConfirmed = 1;
			$model->save();
			
			$this->redirect(array('view','id' => $model->id));
		}
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Deliveries the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Deliveries::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Deliveries $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='deliveries-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	public function actionAjaxUpdateQuantity()
	{
		
		if(Yii::app()->getRequest()->getIsAjaxRequest())
		{
			$pDelivery = DeliveryProducts::model()->findByPk(Yii::app()->getRequest()->getParam('pk'));
			if($pDelivery)
			{
				if(Yii::app()->getRequest()->getParam('name'))
				{
					$data = array(Yii::app()->getRequest()->getParam('name') => Yii::app()->getRequest()->getParam('value'));
					$pDelivery->attributes = $data;
					$pDelivery->save();
				}
			}
			
			Yii::app()->end();
		}
	}
}

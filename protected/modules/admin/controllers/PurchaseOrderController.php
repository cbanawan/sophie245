<?php

class PurchaseOrderController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	// public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
			array('booster.filters.BoosterFilter'),
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
				'actions'=>array('create','update', 'ajaxDeleteOrder', 'ajaxOrderOutOfStock', 'export', 'updateStatus'),
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
		$purchaseOrder = PurchaseOrders::model()->with('orders')->findByPk($id);
		
		$productOrders = array();
		foreach($purchaseOrder->orders as $order)
		{
			foreach($order->orderdetails as $orderDetail)
			{
				if(!isset($productOrders[$orderDetail->productId]))
				{
					$productOrders[$orderDetail->productId] = $orderDetail->product->attributes;
					$productOrders[$orderDetail->productId]['netPrice'] = $orderDetail->product->catalogPrice - ($orderDetail->product->catalogPrice * ($orderDetail->discount / 100));
					$productOrders[$orderDetail->productId]['quantity'] = 0;
					$productOrders[$orderDetail->productId]['_availabe'] = $orderDetail->orderDetailStatus->_active;
					$productOrders[$orderDetail->productId]['status'] = $orderDetail->orderDetailStatus->description;
				}
				
				$productOrders[$orderDetail->productId]['quantity'] += $orderDetail->quantity;
			}
		}
		$productOrders = array_values($productOrders);
		
		/*$orderItems = new CArrayDataProvider('Orders');
		$orderItems->setData($purchaseOrder);*/
		
		$this->render('view',array(
			'model' => $purchaseOrder,
			'productOrders' => $productOrders,
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model = new PurchaseOrders;
		
		if(isset($_POST['orders']))
		{
			$orderIds = $_POST['orders'];
			if(is_array($orderIds) && count($orderIds))
			{
				$model->userId = 1;
				$model->orderStatusId = 1;
				$model->dateCreated = date('Y-m-d H:i:s');
				$model->dateLastModified = $model->dateCreated;
				
				if($model->save())
				{
					$forOrderStatus = Orderstatus::model()->find('status = :status', array(':status' => 'inOrder'));
					foreach($orderIds as $orderId)
					{
						$poOrder = new PurchaseOrderOrders();
						
						$poOrder->purchaseOrderId = $model->id;
						$poOrder->orderId = $orderId;
						$poOrder->dateCreated = date('Y-m-d H:i:s');
						$poOrder->dateLastModified = $poOrder->dateCreated;
						if($poOrder->save())
						{
							$order = Orders::model()->with('orderdetails')->findByPk($orderId);
							$order->orderStatusId = $forOrderStatus->id;
							if($order->save())
							{
								$orderDetailStatuses = CHtml::listData(Orderdetailstatus::model()->findAll(), 'status', 'id');
								foreach($order->orderdetails as $orderDetail)
								{
									if($orderDetail->orderDetailStatusId == $orderDetailStatuses['valid'])
									{
										continue;
									}
									
									$productStatus = $orderDetail->product->_outOfStocksUp;
									if($productStatus >  0)
									{
										$orderDetail->orderDetailStatusId = $orderDetailStatuses['critical'];
									}
									else //if($productStatus == 0)
									{
										$orderDetail->orderDetailStatusId = $orderDetailStatuses['outOfStock'];
									}
									/*else
									{
										 $orderDetail->orderDetailStatusId = $orderDetailStatuses['valid'];
									}*/
									
									$orderDetail->save();
								}
							}
						}
						
						unset($poOrder);
					}
					
					$this->redirect(array('view','id'=>$model->id));
				}
			}
		}
		
		// $forOrderStatus = Orderstatus::model()->find('status = :status', array(':status' => 'forOrder'));
		$orders = Orders::model()->with('orderdetails', 'member')->findAll(
				"orderStatusId in (SELECT id FROM Orderstatus WHERE status in ('partial', 'full'))"
			);
		
		$orderItems = new CArrayDataProvider('Orders');
		$orderItems->setData($orders);		

		$this->render('create',array(
			'model'=>$model,
			'orders' => $orderItems,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$purchaseOrder = PurchaseOrders::model()->with('orders')->findByPk($id);
		
		if(isset($_POST['PurchaseOrders']))
		{
			$purchaseOrder->attributes = $_POST['PurchaseOrders'];
			$purchaseOrder->dateOrdered = date('Y-m-d H:i:s', strtotime($purchaseOrder->dateOrdered));
			$purchaseOrder->dateExpected = date('Y-m-d H:i:s', strtotime($purchaseOrder->dateExpected));
			$purchaseOrder->dateLastModified = date('Y-m-d H:i:s');
			
			if($purchaseOrder->save())
			{
				if(isset($_POST['orders']))
				{
					$orderIds = $_POST['orders'];
					if(is_array($orderIds) && count($orderIds))
					{
						$forOrderStatus = Orderstatus::model()->find('status = :status', array(':status' => 'inOrder'));
						foreach($orderIds as $orderId)
						{
							$poOrder = new PurchaseOrderOrders();

							$poOrder->purchaseOrderId = $purchaseOrder->id;
							$poOrder->orderId = $orderId;
							$poOrder->dateCreated = date('Y-m-d H:i:s');
							$poOrder->dateLastModified = $poOrder->dateCreated;
							if($poOrder->save())
							{
								$order = Orders::model()->with('orderdetails')->findByPk($orderId);
								$order->orderStatusId = $forOrderStatus->id;
								if($order->save())
								{
									$orderDetailStatuses = CHtml::listData(Orderdetailstatus::model()->findAll(), 'status', 'id');
									foreach($order->orderdetails as $orderDetail)
									{
										if($orderDetail->orderDetailStatusId == $orderDetailStatuses['valid'])
										{
											continue;
										}

										$productStatus = $orderDetail->product->_outOfStocksUp;
										if($productStatus >  0)
										{
											$orderDetail->orderDetailStatusId = $orderDetailStatuses['critical'];
										}
										else //if($productStatus == 0)
										{
											$orderDetail->orderDetailStatusId = $orderDetailStatuses['outOfStock'];
										}
										/*else
										{
											 $orderDetail->orderDetailStatusId = $orderDetailStatuses['valid'];
										}*/

										$orderDetail->save();
									}
								}
							}

							unset($poOrder);
						}
					}
				}				
			}
			$this->redirect(array('view','id' => $purchaseOrder->id));
		}
		
		// $forOrderStatus = Orderstatus::model()->find('status = :status', array(':status' => 'forOrder'));
		$orders = Orders::model()->with('orderdetails', 'member')->findAll(
				array(
					'condition' => "orderStatusId in (SELECT id FROM Orderstatus WHERE status in ('partial', 'paid'))",
					'order' => 't.dateCreated DESC'
				)
			);
		
		$orderItems = new CArrayDataProvider('Orders');
		$orderItems->setData($orders);		

		$this->render('update',array(
			'model' => $purchaseOrder,
			'orders' => $orderItems,
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
		$dataProvider=new CActiveDataProvider('PurchaseOrders');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model = new PurchaseOrders('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['PurchaseOrders']))
		{
			$model->attributes=$_GET['PurchaseOrders'];
		}

		$this->render(
			'admin',
			array(
				'model' => $model,
			)
		);
	}
	
	public function actionExport($id)
	{
		Yii::import('ext.ECSVExport');
		
		$purchaseOrder = PurchaseOrders::model()->with('orders')->findByPk($id);
		
		$productOrders = array();
		foreach($purchaseOrder->orders as $order)
		{
			foreach($order->orderdetails as $orderDetail)
			{
				if(!isset($productOrders[$orderDetail->productId]))
				{
					$productOrders[$orderDetail->productId] = $orderDetail->product->attributes;
					$productOrders[$orderDetail->productId]['netPrice'] = $orderDetail->product->catalogPrice - ($orderDetail->product->catalogPrice * ($orderDetail->discount / 100));
					$productOrders[$orderDetail->productId]['quantity'] = 0;
					$productOrders[$orderDetail->productId]['_availabe'] = $orderDetail->orderDetailStatus->_active;
					$productOrders[$orderDetail->productId]['status'] = $orderDetail->orderDetailStatus->description;
				}
				
				$productOrders[$orderDetail->productId]['quantity'] += $orderDetail->quantity;
			}
		}
		$productOrders = array_values($productOrders);
		
		$filename = 'po_' . $purchaseOrder->id . '_products_' . date('mdYHis') . '.csv';
		
		$csv = new ECSVExport($productOrders);
		$content = $csv->toCSV();                   
		Yii::app()->getRequest()->sendFile($filename, $content, "text/csv", false);		
		exit;		
	}
	
	public function actionUpdateStatus($id, $status)
	{
		$purchaseOrder = PurchaseOrders::model()->findByPk($id);
		if($purchaseOrder)
		{
			$orderStatus = Orderstatus::model()->find('status = :status', array(':status' => $status));
			if($orderStatus)
			{
				$purchaseOrder->orderStatusId = $orderStatus->id;
				$purchaseOrder->dateLastModified = new CDbExpression('NOW()');
				$purchaseOrder->save();
			}
		}
		
		$this->redirect(array('view','id'=>$id));			
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return PurchaseOrders the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=PurchaseOrders::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param PurchaseOrders $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='purchase-orders-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	public function actionAjaxDeleteOrder()
	{
		if(isset($_POST['data']) && is_array($_POST['data']))
		{
			$forOrderStatus = Orderstatus::model()->find('status = :status', array(':status' => 'forOrder'));
			foreach($_POST['data'] as $orderId)
			{
				$poOrder = PurchaseOrderOrders::model()->find('orderId = :orderId', array(':orderId' => $orderId));
				if($poOrder)
				{
					if($poOrder->delete())
					{
						$order = Orders::model()->findByPk($orderId);
						if($order)
						{
							$order->orderStatusId = $forOrderStatus->id;
							$order->save();
						}
					}
				}
			}
		}
		Yii::app()->end();
	}
	
	public function actionAjaxOrderOutOfStock()
	{
		// Do only if purchase order Id is set
		if(isset($_POST['poId']))
		{
			// Check if purchase order id is valid
			$pOrder = PurchaseOrders::model()->with('orders')->findByPk($_POST['poId']);
			if($pOrder)
			{
				// Make sure product id list is an array
				$productList = is_array($_POST['data']) ? $_POST['data'] : array($_POST['data']);
				// List of order detail statuses				
				$orderDetailStatuses = CHtml::listData(Orderdetailstatus::model()->findAll(), 'status', 'id');
				
				// Process orders in p.o.
				foreach($pOrder->orders as $poOrder)
				{
					foreach($poOrder->orderdetails as $orderDetail)
					{
						// Product on the order is on the list of out of stock items
						if(in_array($orderDetail->productId, $productList))
						{
							// Update the order detail and save
							$orderDetail->orderDetailStatusId = $orderDetailStatuses['outOfStock'];
							$orderDetail->save();
						}
					}
				}

				// Update product to out of stock
				$criteria = new CDbCriteria();
				$criteria->addInCondition('id', $productList);
				Products::model()->updateAll(array('_outOfStocksUp' => 0), $criteria);
			}
		}
		Yii::app()->end();
	}
}

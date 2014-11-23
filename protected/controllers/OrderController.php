<?php

class OrderController extends Controller
{
	// public $layout='//layouts/column2';
	
	public function filters() {
		return array(
			//... probably other filter specifications ...
			array('booster.filters.BoosterFilter')
		);
	}
	
	public function actionIndex()
	{
		if(Yii::app()->request->getParam('export')) {
			$this->actionExport();
			Yii::app()->end();
		}

		$orders = new Orders('search');
		$orders->unsetAttributes();  // clear any default values
		
		if(isset($_GET['Orders']))
		{
			$orders->attributes=$_GET['Orders'];
		}
		
		$orderStatus = CHtml::listData(Orderstatus::model()->findAll(), 'id', 'description');
		
		if (Yii::app()->getRequest()->getIsAjaxRequest())
		{
			$this->renderPartial('index',array(
				'orders' => $orders,
				'orderStatus' => $orderStatus,
			));	
			
			Yii::app()->end();
		}

		$this->render('index',array(
			'orders' => $orders,
			'orderStatus' => $orderStatus,
		));
	}
	
	public function actionExport()
	{
		Yii::import('ext.ECSVExport');
		
		$criteria = new CDbCriteria;
		$criteria->with = array(
			'orderdetails' => array(),
            'member' => array(),
			'payments' => array(),
			'orderStatus' => array(),
        );
		
		$orders = $_GET['Orders'];
		
		$criteria->compare('t.id',$orders['id']);
		$criteria->compare('memberCode',$orders['memberCode']);		
		$criteria->compare('lastName',$orders['memberName'], 1);	
		
		if(!empty($orders['dateCreatedRange']))
		{
			$dateCreatedRange = explode('-', $orders['dateCreatedRange']);
			$startDate = date('Y-m-d 00:00:00', strtotime($dateCreatedRange[0]));
			$endDate = date('Y-m-d 23:59:00', strtotime($dateCreatedRange[1]));
			
			$criteria->addBetweenCondition('t.dateCreated', $startDate, $endDate);
			// $criteria->params=array('dateCreated' => $startDate, ':endDate' => $endDate);
		}
		
		if(is_array($orders['orderStatusId']))
		{
			$criteria->addInCondition('orderStatusId', $orders['orderStatusId']);
		}
		
		$orders = array();
		$salesOrders = Orders::model()->findAll($criteria);
		foreach($salesOrders as $salesOrder)
		{
			$orders[] = array(
				'poId' => $salesOrder->id,
				'dateCreated' => $salesOrder->dateCreated,
				'dateLastModified' => $salesOrder->dateLastModified,
				'memberCode' => $salesOrder->member-> memberCode,
				'name' => $salesOrder->member->fullName,
				'amountDue' => $salesOrder->netAmount,
				'amountPaid' => $salesOrder->totalPayment,
				'status' => $salesOrder->orderStatus->description,   
			);
		}
		
		// var_dump($salesOrders);
		$csv = new ECSVExport($orders);
		$content = $csv->toCSV();                   
		Yii::app()->getRequest()->sendFile('report_' . date('YmdHis') . '.csv', $content, "text/csv", false);
		exit;			
	}
	
	public function actionView($id)
	{
		$order = Orders::model()->with(
			array(
				'orderdetails' => array(
					'order' => 'orderdetails.dateCreated DESC'
				), 
				'member', 
				'user',
				'catalog',
				'payments' => array(
					'order' => 'payments.dateCreated DESC'
				),
			)
		)->findByPk($id);
		
		if (Yii::app()->getRequest()->getIsAjaxRequest())
		{
			if(Yii::app()->getRequest()->getParam('ajax') == 'order-items-grid')
			{
				$this->renderPartial(
						'_items',
						array(
							'orderStatus' => $order->orderStatus->status,
							'orderDetails' => $order->orderdetails,
						)
					); 				
			}
			elseif(Yii::app()->getRequest()->getParam('ajax') == 'order-payments-grid')
			{
				$this->renderPartial(
						'_payments',
						array(
							'payments' => $order->payments,
						)
					); 				
			}
			Yii::app()->end();
		}
		
		$this->render(
				'view',
				array(
					'order' => $order,
				)
			);
	}
	
	public function actionPrint($id)
	{
		$this->layout = '//layouts/receipt';
		
		$order = Orders::model()->with('member', 'user', 'orderStatus', 'orderdetails','payments')->findByPk($id);
		
		$this->render('print',array(
			'order'=>$order,
		));		
	}		
	
	public function actionCreate()
	{
		$memberDataProvider = new CArrayDataProvider(array());
		
		// Prepare Members		
		$memberModel = new Members();
		if(isset($_GET['Members']['searchCriteria']))
		{
			$memberModel->searchCriteria = $_GET['Members']['searchCriteria'];
			
			$criteria=new CDbCriteria;
			if($memberModel->searchCriteria)
			{
				$criteria->compare('memberCode', $memberModel->searchCriteria, true, 'OR');
				$criteria->compare('lastName', $memberModel->searchCriteria, true, 'OR');
				$criteria->compare('firstName', $memberModel->searchCriteria, true, 'OR');
			}

			$memberDataProvider = new CActiveDataProvider($memberModel, array(
				'criteria' => $criteria,
			));			
		}
		
		// Render only the grid if an ajax call
		if (Yii::app()->getRequest()->getIsAjaxRequest())
		{
			$this->renderPartial(
					'_orderFormMemberGrid',
					array(
						'dataProvider' => $memberDataProvider
					)
				);
			
			Yii::app()->end();
		}
		
		// Process Order		
		$orderModel = new Orders();
		$orderModel->dateOrdered = date("Y-m-d");

		if(isset($_POST['Orders']))
		{
			$orderModel->attributes = $_POST['Orders'];
			if($orderModel->save())
			{
				$this->redirect(array('view','id' => $orderModel->id));
			}
		}
		
		$this->render(
				'create',
				array(
					'orderModel' => $orderModel,
					'memberModel' => $memberModel,
					'memberDataProvider' => $memberDataProvider
				));	
	}
	
	public function actionChangeStatus($id, $status)
	{
		$orderStatus = Orderstatus::model()->find('status = :status', array(':status' => $status));
		if($orderStatus)
		{
			$order = Orders::model()->with('orderdetails')->findByPk($id);
			$order->orderStatusId = $orderStatus->id;
			$order->dateLastModified = new CDbExpression('NOW()');
			if($order->save())
			{
				foreach($order->orderdetails as $orderDetail)
				{
					if(in_array($order->orderStatus->status, array('cancelled')))
					{
						$orderDetailStatus = Orderdetailstatus::model()->find('status = :status', array(':status' => $order->orderStatus->status));
						if($orderDetailStatus)
						{
							$orderDetail->orderDetailStatusId = $orderDetailStatus->id;
							$orderDetail->save();
						}
					}
				}
			}
		}
		
		$this->redirect(array('view','id'=>$id));			
	}	
	
	public function actionDelete($id)
	{
		$order = Orders::model()->findByPk($id);
		if($order)
		{
			$order->delete();
		}
		
		$this->redirect(array('order/index'));
	}
	
	/**
	 * Ajax functions
	 */
	
	public function actionAjaxAddOrderItem()
	{
		if (Yii::app()->getRequest()->getIsAjaxRequest()) 
		{		
			$orderDetail = new Orderdetails();

			if(isset($_POST))
			{
				$orderDetail->attributes = $_POST;

				$product = Products::model()->findByPk($orderDetail->productId);
				// var_dump($product->outOfStock, $product->criticalStock);
				if($product->outOfStock)
				{
					$orderDetailStatus = Orderdetailstatus::model()->find('status = :status', array(':status' => 'outOfStock'));
					$orderDetail->orderDetailStatusId = $orderDetailStatus->id;
				}
				elseif($product->criticalStock)
				{
					$orderDetailStatus = Orderdetailstatus::model()->find('status = :status', array(':status' => 'critical'));
					$orderDetail->orderDetailStatusId = $orderDetailStatus->id;
				}
			}

			// var_dump($orderDetail->attributes);

			$orderDetail->save();
		}
		Yii::app()->end();
	}	
	
	public function actionAjaxDeleteOrderItem($id)
	{
		if (Yii::app()->getRequest()->getIsAjaxRequest()) 
		{
			$orderItem = Orderdetails::model()->findByPk($id);
			if($orderItem)
			{
				$orderItem->delete();
			}
		}
		Yii::app()->end();
	}
	
	public function actionAjaxAddOrderPayment()
	{
		if (Yii::app()->getRequest()->getIsAjaxRequest()) 
		{		
			$payment = new Payments();

			if(isset($_POST))
			{
				$payment->attributes = $_POST;
				
				$order = Orders::model()->with('orderdetails')->findByPk($payment->orderId);
				if($order)
				{
					$paymentType = (($order->totalPayment + $payment->amount) < $order->netAmount) ? 'deposit' : 'full';
					$paymentTypeModel = Paymenttypes::model()->find('name = :name', array(':name' => $paymentType));
					$payment->paymentTypeId = $paymentTypeModel->id;	
					
					// TODO: Must be dynamic
					$payment->userId = 1;
					// $payment->dateCreated = date("Y-m-d H:i:s");
					// $payment->dateLastModified = date("Y-m-d H:i:s");
	
					if($payment->save())
					{
						if(!in_array($order->orderStatus->status, array('inOrder', 'delivered')))
						{
							if($order->totalPayment + $payment->amount < $order->netAmount)
							{
								$orderStatus = Orderstatus::model()->find('status = :status', array(':status' => 'partial'));
								$order->orderStatusId = $orderStatus->id;
							}
							else
							{
								$orderStatus = Orderstatus::model()->find('status = :status', array(':status' => 'paid'));
								$order->orderStatusId = $orderStatus->id;
							}

							$order->save();
						}
					}
				}
			}
		}
		Yii::app()->end();
	}	
	
	public function actionAjaxGetOrder($id)
	{
		$order = new Orders();
		
		if (Yii::app()->getRequest()->getIsAjaxRequest()) 
		{
			header('Content-Type: application/json');
			$order = Orders::model()->findByPk($id);
		}
		
		$orderDetail = $order->attributes;
		$orderDetail['grossAmount'] = $order->grossAmount;
		$orderDetail['netAmount'] = $order->netAmount;
		$orderDetail['totalPayment'] = $order->totalPayment;
		$orderDetail['amountDue'] = $order->netAmount - $order->totalPayment;
		
		echo json_encode($orderDetail);
		Yii::app()->end();
	}
	
	public function actionAjaxView($id)
	{
		$order = new Orders();
		
		if (Yii::app()->getRequest()->getIsAjaxRequest()) 
		{
			header('Content-Type: application/json');
			$order = Orders::model()->findByPk($id);
		}
		
		/*$orderDetails = $order->attributes;
		$orderDetails['memberName'] = $order->member->codeName;
		$orderDetails['orderStatus'] = $order->orderStatus->description;*/
		$this->renderPartial(
				'_detailWithButtons',
				array(
					'order' => $order,
				)
			); 	
		
		Yii::app()->end();		
	}
	
	public function actionAjaxItemChangeStatus($id, $status)
	{
		if (Yii::app()->getRequest()->getIsAjaxRequest()) 
		{
			$orderItem = Orderdetails::model()->findByPk($id);
			if($orderItem)
			{
				$itemOrderStatus = Orderdetailstatus::model()->find('status = :status', array(':status' => $status));
				if($itemOrderStatus)
				{
					$orderItem->orderDetailStatusId = $itemOrderStatus->id;
					$orderItem->save();
				}
			}
		}
		
		Yii::app()->end();
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
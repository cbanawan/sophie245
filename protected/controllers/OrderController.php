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
		$orders = new Orders('search');
		$orders->unsetAttributes();  // clear any default values
		
		if(isset($_GET['Orders']))
		{
			$orders->attributes=$_GET['Orders'];
		}
		
		$orderStatus = CHtml::listData(Orderstatus::model()->findAll(), 'id', 'description');
		
		$this->render('index',array(
			'orders' => $orders,
			'orderStatus' => $orderStatus,
		));
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
				'payments' => array(
					'order' => 'payments.dateCreated DESC'
				),
			)
		)->findByPk($id);
		
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
		$model = new Orders;
		$model->dateCreated = date("m/d/Y");

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		
		if(isset($_POST['Orders']))
		{
			$model->attributes = $_POST['Orders'];
			$model->dateCreated = date("Y-m-d ", strtotime($model->dateCreated)); 
			
			if($model->save())
			{
				$this->redirect(array('view','id'=>$model->id));
			}
		}
		
		$members = CHtml::listData(Members::model()->findAll(), 'id', 'codename');
		$users = CHtml::listData(Users::model()->findAll(), 'id', 'username');
		$orderStatus = CHtml::listData(Orderstatus::model()->findAll(), 'id', 'status');

		$this->render('create',array(
			'members'=>$members,
			'users'=>$users,
			'orderStatus'=>$orderStatus,
			'model'=>$model,
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
					
					$payment->userId = 1;
					$payment->dateCreated = date("Y-m-d H:i:s");
					$payment->dateLastModified = date("Y-m-d H:i:s");
				}	
				var_dump($payment->attributes);	
				if($payment->save())
				{
									
					$order = Orders::model()->with('orderdetails')->findByPk($payment->orderId);
					if($order->totalPayment < $order->netAmount)
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
		
		$orderDetails = $order->attributes;
		$orderDetails['memberName'] = $order->member->codeName;
		$orderDetails['orderStatus'] = $order->orderStatus->description;
		$this->renderPartial(
				'_detail',
				array(
					'order' => $orderDetails,
				)
			); 	
		
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
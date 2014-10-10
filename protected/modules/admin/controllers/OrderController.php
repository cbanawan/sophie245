<?php

class OrderController extends Controller
{
	public $layout='//layouts/column2_2';
	
	public function actionIndex()
	{
		$model = new Orders('search');
		$model->unsetAttributes();  // clear any default values
		
		if(isset($_GET['Orders']))
		{
			$model->attributes=$_GET['Orders'];
		}
		
		$orderStatus = CHtml::listData(Orderstatus::model()->findAll(), 'id', 'description');
		
		$this->render('index',array(
			'order'=>$model,
			'orderStatus'=>$orderStatus,
		));
	}
	
	public function actionNew()
	{
		$model = new Orders;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Orders']))
		{
			$model->attributes=$_POST['Orders'];
			if($model->save())
			{
				$this->redirect(array('details','id'=>$model->id));
			}
		}
		
		$members = CHtml::listData(Members::model()->findAll(), 'id', 'codename');
		$users = CHtml::listData(Users::model()->findAll(), 'id', 'username');
		$orderStatus = CHtml::listData(Orderstatus::model()->findAll(), 'id', 'status');

		$this->render('new',array(
			'members'=>$members,
			'users'=>$users,
			'orderStatus'=>$orderStatus,
			'model'=>$model,
		));		
	}
	
	public function actionDetails($id)
	{
		$order = Orders::model()->with('orderdetails', 'member', 'user', 'orderStatus', 'payments')->findByPk($id);
		
		$this->render('details',array(
			'order'=>$order,
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
		
		$this->redirect(array('details','id'=>$id));			
	}
	
	/******************
	 * AJAX Functions
	 ******************/
	
	public function actionAjaxView($id)
	{
		$model = Orders::model()->with('member', 'user', 'orderStatus')->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		
	   $this->renderPartial('_header',array(
			'order' => $model,
		));
	}
	
	public function actionAjaxItems($id)
	{
		$orderDetails = Orderdetails::model()->with('product', 'orderDetailStatus')->findAll('orderId = :orderId', array(':orderId' => $id));

		$this->renderPartial('_items',array(
			'orderDetails'=>$orderDetails,
		));		
	}

	public function actionAjaxPayments($id)
	{
		$payments = Payments::model()->with('user', 'paymentType')->findAll('orderId = :orderId', array(':orderId' => $id));

		$this->renderPartial('_payments',array(
			'payments'=>$payments,
		));		
	}
	
	public function actionAjaxAddOrderItem()
	{
		$orderDetail = new Orderdetails();
		
		if(isset($_POST['Orderdetails']))
		{
			$orderDetail->attributes = $_POST['Orderdetails'];
		}
		
		$orderDetail->save();
	}

	public function actionAjaxAddOrderPayment()
	{
		$payment = new Payments();
		
		if(isset($_POST['Payments']))
		{	
			$_POST['Payments']['dateCreated'] = $_POST['dateCreated'];
			$payment->attributes = $_POST['Payments'];
			
			$order = Orders::model()->with('orderdetails')->findByPk($payment->orderId);
			if($order)
			{
				$paymentType = (($order->totalPayment + $payment->amount) < $order->netAmount) ? 'deposit' : 'full';
				$paymentTypeModel = Paymenttypes::model()->find('name = :name', array(':name' => $paymentType));
				$payment->paymentTypeId = $paymentTypeModel->id;				
			}			
		}
		
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
	
	public function actionAjaxDeleteOrderItem($id)
	{
		$orderDetail = Orderdetails::model()->findByPk($id);
		if($orderDetail)
		{
			$orderDetail->delete();
		}
	}
	
	public function actionAjaxDeletePayment($id)
	{
		$payment = Payments::model()->findByPk($id);
		if($payment)
		{
			$order = Orders::model()->with('orderdetails')->findByPk($payment->orderId);
			if($payment->delete())
			{
				if($order->totalPayment < $order->orderDetailSummary['net'])
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
	
	public function actionAjaxUpdateOrderItemStatus($id)
	{
		$orderDetail = Orderdetails::model()->with('orderDetailStatus')->findByPk($id);
		if($orderDetail->orderDetailStatus->status == 'outOfStock')
		{
			$orderDetailStatus = Orderdetailstatus::model()->find('status = :status', array(':status' => 'valid'));
			if($orderDetailStatus)
			{
				$orderDetail->orderDetailStatusId = $orderDetailStatus->id;
			}
		}
		else
		{
			$orderDetailStatus = Orderdetailstatus::model()->find('status = :status', array(':status' => 'outOfStock'));
			if($orderDetailStatus)
			{
				$orderDetail->orderDetailStatusId = $orderDetailStatus->id;
			}
		}
		$orderDetail->save();
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
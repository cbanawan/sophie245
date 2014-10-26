<?php

/**
 * This is the model class for table "orders".
 *
 * The followings are the available columns in table 'orders':
 * @property integer $id
 * @property string $dateCreated
 * @property string $dateLastModified
 * @property integer $memberId
 * @property integer $userId
 * @property integer $orderStatusId
 * @property integer $catalogId
 * 
 * @property string $memberCode
 *
 * The followings are the available model relations:
 * @property Orderdetails[] $orderdetails
 * @property Members $member
 * @property Users $user
 * @property Orderstatus $orderStatus
 * @property Orderstatushistory[] $orderstatushistories
 * @property Payments[] $payments
 * @property Uporders[] $uporders
 */
class Orders extends CActiveRecord
{
	public $memberCode;
	public $memberName;
	public $status;
	public $dateCreatedRange;
	// public $dateLastModifiedRange;
	
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'orders';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('memberId, userId, orderStatusId', 'required'),
			array('memberId, userId, orderStatusId, catalogId', 'numerical', 'integerOnly'=>true),
			array('dateCreated', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, dateCreated, dateCreatedRange, dateLastModified, memberId, userId, orderStatusId, memberCode, memberName', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'orderdetails' => array(self::HAS_MANY, 'Orderdetails', 'orderId', 'with' => array('product', 'orderDetailStatus') ),
			'member' => array(self::BELONGS_TO, 'Members', 'memberId'),
			'user' => array(self::BELONGS_TO, 'Users', 'userId'),
			'orderStatus' => array(self::BELONGS_TO, 'Orderstatus', 'orderStatusId'),
			'catalog' => array(self::BELONGS_TO, 'Catalogs', 'catalogId'),
			'orderstatushistories' => array(self::HAS_MANY, 'Orderstatushistory', 'orderId'),
			'payments' => array(self::HAS_MANY, 'Payments', 'orderId', 'with' => 'paymentType'),
			'uporders' => array(self::MANY_MANY, 'Uporders', 'upordersorders(orderId, upOrderId)'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'Sales Order Number',
			'dateCreated' => 'Date Created',
			'dateLastModified' => 'Date Last Modified',
			'memberId' => 'Member',
			'userId' => 'User',
			'orderStatusId' => 'Order Status',
			'catalogId' => 'Catalog',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;
		$criteria->with = array(
			'orderdetails' => array(),
            'member' => array(),
			'payments' => array(),
			'orderStatus' => array(),
        );
		
		$criteria->compare('t.id',$this->id);
		$criteria->compare('t.dateCreated', $this->dateCreated,true);
		$criteria->compare('dateLastModified',$this->dateLastModified,true);
		$criteria->compare('memberId',$this->memberId);
		$criteria->compare('userId',$this->userId);
		$criteria->compare('orderStatusId',$this->orderStatusId);
		$criteria->compare('memberCode',$this->memberCode);		
		$criteria->compare('lastName',$this->memberName, 1);	
		
		if(!empty($this->dateCreatedRange))
		{
			$dateCreatedRange = explode('-', $this->dateCreatedRange);
			$startDate = date('Y-m-d 00:00:00', strtotime($dateCreatedRange[0]));
			$endDate = date('Y-m-d 23:59:00', strtotime($dateCreatedRange[1]));
			
			$criteria->addBetweenCondition('t.dateCreated', $startDate, $endDate);
			// $criteria->params=array('dateCreated' => $startDate, ':endDate' => $endDate);
		}

		/*if(!empty($this->dateLastModifiedRange))
		{
			var_dump($this->dateLastModifiedRange);
			$dateLastModifiedRange = explode('-', $this->dateLastModifiedRange);
			$startDate = date('Y-m-d 00:00:00', strtotime($dateLastModifiedRange[0]));
			$endDate = date('Y-m-d 23:59:00', strtotime($dateLastModifiedRange[1]));
			
			$criteria->addBetweenCondition('dateLastModified', $startDate, $endDate);
			// $criteria->params=array('dateCreated' => $startDate, ':endDate' => $endDate);
		}*/
		
		if(is_array($this->orderStatusId))
		{
			$criteria->addInCondition('orderStatusId', $this->orderStatusId);
		}

		$sort = new CSort;
        $sort->attributes = array(
            /*  if (account_description is null)
                then (sort by client_surname, client_name1...), 
                else (sort by account_description) */
            'memberCode' => array(
                'asc' => 'memberCode',
                'desc' => 'memberCode desc',
            ),
			'memberName' => array(
                'asc' => 'lastName',
                'desc' => 'lastName desc',
			),
			'status' => array(
                'asc' => 'orderStatus.description',
                'desc' => 'orderStatus.description desc',
			),
            '*',
        );		

		/* Default Sort Order*/
        $sort->defaultOrder= array(
            'dateLastModified'=>CSort::SORT_DESC,
        );

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
			'sort' => $sort,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Orders the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	public function beforeSave() 
	{
		if ($this->isNewRecord)
		{
			// var_dump($this->dateCreated); exit;
			if(!isset($this->dateCreated))
			{
				$this->dateCreated = new CDbExpression('NOW()');
			}
			else
			{
				$this->dateCreated .= date(' H:i:s');
			}
		}

		$this->dateLastModified = new CDbExpression('NOW()');
		
		return parent::beforeSave();
	}
	
	public function beforeDelete()
	{
		// Delete order details
		foreach($this->orderdetails as $orderDetail)
		{
			$orderDetail->delete();
		}
		
		// Delete all payments
		foreach($this->payments as $payment)
		{
			$payment->delete();
		}
		
		return parent::beforeDelete();
	}	
	
	public function getGrossAmount()
	{
		return $this->orderDetailSummary['gross'];
	}
	
	public function getNetAmount()
	{
		return $this->orderDetailSummary['net'];
	}
	
	public function getQuantity()
	{
		return $this->orderDetailSummary['items'];
	}
	
	public function getOrderDetailSummary()
	{
		$gross = 0;
		$net = 0;
		$items = 0;
		$orderDetails = $this->orderdetails;
		foreach($orderDetails as $orderDetail)
		{
			if($orderDetail->orderDetailStatus->_active)
			{
				$gross += $orderDetail->product->catalogPrice * $orderDetail->quantity;
				$discount = 1 - ($orderDetail->discount / 100);
				$net += $orderDetail->product->catalogPrice * $discount * $orderDetail->quantity;
				$items += $orderDetail->quantity;
			}
		}
		
		return array(
					'gross' => $gross,
					'net' => $net,
					'items' => $items,
				);
	}
	
	public function getTotalPayment()
	{
		$paymentTotal = 0;
		foreach($this->payments as $payment)
		{
			$paymentTotal += $payment->amount;
		}
		
		return $paymentTotal;
	}
	
	public function getMemberMemberCode()
	{
		return $this->member->memberCode;
	}
	
	public function getMemberFullName()
	{
		return $this->member->lastName . ', ' . $this->member->firstName;
	}
	
	public function getOrderStatusDesc()
	{
		return $this->orderStatus->description;
	}
}

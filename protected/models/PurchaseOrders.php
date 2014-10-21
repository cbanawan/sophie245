<?php

/**
 * This is the model class for table "purchaseorders".
 *
 * The followings are the available columns in table 'purchaseorders':
 * @property integer $id
 * @property string $dateCreated
 * @property string $dateLastModified
 * @property string $dateOrdered
 * @property integer $userId
 * @property integer $orderStatusId
 *
 * The followings are the available model relations:
 * @property Purchaseorderorders[] $purchaseorderorders
 * @property Users $user
 * @property Orderstatus $orderStatus
 */
class PurchaseOrders extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'purchaseorders';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('userId, orderStatusId', 'required'),
			array('userId, orderStatusId', 'numerical', 'integerOnly'=>true),
			array('dateCreated, dateLastModified, dateOrdered', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, dateCreated, dateLastModified, dateOrdered, userId, orderStatusId', 'safe', 'on'=>'search'),
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
			'orders' =>  array(self::MANY_MANY, 'Orders', 'Purchaseorderorders(purchaseOrderId, orderId)', 'with' => 'orderdetails'),
			// array(self::HAS_MANY, 'Purchaseorderorders', 'purchaseOrderId'),
			'user' => array(self::BELONGS_TO, 'Users', 'userId'),
			'orderStatus' => array(self::BELONGS_TO, 'Orderstatus', 'orderStatusId'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'dateCreated' => 'Date Created',
			'dateLastModified' => 'Date Last Modified',
			'dateOrdered' => 'Date Ordered',
			'userId' => 'User',
			'orderStatusId' => 'Order Status',
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

		$criteria = new CDbCriteria;

		$criteria->with = array(
						'orders' => array(),
						'orderStatus' => array(),
					);
		
		$criteria->compare('id',$this->id);
		$criteria->compare('dateCreated',$this->dateCreated,true);
		$criteria->compare('dateLastModified',$this->dateLastModified,true);
		$criteria->compare('dateOrdered',$this->dateOrdered,true);
		$criteria->compare('userId',$this->userId);
		$criteria->compare('orderStatusId',$this->orderStatusId);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return PurchaseOrders the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	public function getTotalAmount()
	{
		$totalAmount = 0;
		foreach($this->orders as $order)
		{
			$totalAmount += $order->netAmount;
		}
		
		return $totalAmount;
	}
}

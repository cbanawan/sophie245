<?php

/**
 * This is the model class for table "orderdetails".
 *
 * The followings are the available columns in table 'orderdetails':
 * @property integer $id
 * @property integer $orderId
 * @property string $dateCreated
 * @property string $dateLastModified
 * @property integer $productId
 * @property integer $quantity
 * @property integer $orderDetailStatusId
 * @property double $discount
 *
 * The followings are the available model relations:
 * @property Orders $order
 * @property Products $product
 * @property Orderdetailstatus $orderDetailStatus
 */
class Orderdetails extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'orderdetails';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('orderId, productId', 'required'),
			array('orderId, productId, quantity', 'numerical', 'integerOnly'=>true),
			array('discount', 'numerical'),
			array('orderDetailStatusId', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, orderId, dateCreated, dateLastModified, productId, quantity, orderDetailStatusId, discount', 'safe', 'on'=>'search'),
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
			'order' => array(self::BELONGS_TO, 'Orders', 'orderId'),
			'product' => array(self::BELONGS_TO, 'Products', 'productId'),
			'orderDetailStatus' => array(self::BELONGS_TO, 'Orderdetailstatus', 'orderDetailStatusId'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'orderId' => 'Order',
			'dateCreated' => 'Date Created',
			'dateLastModified' => 'Date Last Modified',
			'productId' => 'Product',
			'quantity' => 'Quantity',
			'orderDetailStatusId' => 'Order Detail Status',
			'discount' => 'Discount',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('orderId',$this->orderId);
		$criteria->compare('dateCreated',$this->dateCreated,true);
		$criteria->compare('dateLastModified',$this->dateLastModified,true);
		$criteria->compare('productId',$this->productId);
		$criteria->compare('quantity',$this->quantity);
		$criteria->compare('orderDetailStatusId',$this->orderDetailStatusId);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Orderdetails the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	public function beforeSave() 
	{
		if ($this->isNewRecord)
		{
			$this->dateCreated = new CDbExpression('NOW()');
			if(!isset($this->orderDetailStatusId))
			{
				$this->orderDetailStatusId = 1;
			}
		}

		$this->dateLastModified = new CDbExpression('NOW()');
		
		return parent::beforeSave();
	} 
	
	public function afterSave()
	{
		if($this->orderId)
		{
			$order = Orders::model()->findByPk($this->orderId);
			if($order)
			{
				$order->dateLastModified =  new CDbExpression('NOW()');
				$order->save();
			}
		}
		
		return parent::afterSave();
	}
}

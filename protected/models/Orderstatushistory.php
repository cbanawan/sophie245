<?php

/**
 * This is the model class for table "orderstatushistory".
 *
 * The followings are the available columns in table 'orderstatushistory':
 * @property integer $id
 * @property string $dateCreated
 * @property string $dateLastModified
 * @property integer $orderId
 * @property integer $orderStatusId
 * @property integer $userId
 *
 * The followings are the available model relations:
 * @property Orders $order
 * @property Orderstatus $orderStatus
 * @property Users $user
 */
class Orderstatushistory extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'orderstatushistory';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('orderId, orderStatusId, userId', 'required'),
			array('orderId, orderStatusId, userId', 'numerical', 'integerOnly'=>true),
			array('dateCreated, dateLastModified', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, dateCreated, dateLastModified, orderId, orderStatusId, userId', 'safe', 'on'=>'search'),
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
			'orderStatus' => array(self::BELONGS_TO, 'Orderstatus', 'orderStatusId'),
			'user' => array(self::BELONGS_TO, 'Users', 'userId'),
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
			'orderId' => 'Order',
			'orderStatusId' => 'Order Status',
			'userId' => 'User',
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
		$criteria->compare('dateCreated',$this->dateCreated,true);
		$criteria->compare('dateLastModified',$this->dateLastModified,true);
		$criteria->compare('orderId',$this->orderId);
		$criteria->compare('orderStatusId',$this->orderStatusId);
		$criteria->compare('userId',$this->userId);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Orderstatushistory the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}

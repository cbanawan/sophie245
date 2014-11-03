<?php

/**
 * This is the model class for table "deliveryproducts".
 *
 * The followings are the available columns in table 'deliveryproducts':
 * @property integer $id
 * @property integer $deliveryId
 * @property integer $productId
 * @property integer $ordered
 * @property integer $delivered
 *
 * The followings are the available model relations:
 * @property Deliveries $delivery
 * @property Products $product
 */
class DeliveryProducts extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'deliveryproducts';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('deliveryId, productId', 'required'),
			array('deliveryId, productId, ordered, delivered', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, deliveryId, productId, ordered, delivered', 'safe', 'on'=>'search'),
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
			'delivery' => array(self::BELONGS_TO, 'Deliveries', 'deliveryId'),
			'product' => array(self::BELONGS_TO, 'Products', 'productId'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'deliveryId' => 'Delivery',
			'productId' => 'Product',
			'ordered' => 'Ordered',
			'delivered' => 'Delivered',
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
		$criteria->compare('deliveryId',$this->deliveryId);
		$criteria->compare('productId',$this->productId);
		$criteria->compare('ordered',$this->ordered);
		$criteria->compare('delivered',$this->delivered);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return DeliveryProducts the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}

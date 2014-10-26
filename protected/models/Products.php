<?php

/**
 * This is the model class for table "products".
 *
 * The followings are the available columns in table 'products':
 * @property integer $id
 * @property string $code
 * @property string $description
 * @property double $catalogPrice
 * @property double $netPriceDiscount
 * @property integer $stocksOnHand
 * @property integer $productGroupId
 * @property integer $catalogId
 * @property integer $_outOfStocksUp
 *
 * The followings are the available model relations:
 * @property Orderdetails[] $orderdetails
 * @property Productgroups $productGroup
 * @property Catalogs $catalog
 */
class Products extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'products';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('code, productGroupId, catalogId', 'required'),
			array('stocksOnHand, productGroupId, catalogId, _outOfStocksUp', 'numerical', 'integerOnly'=>true),
			array('catalogPrice, netPriceDiscount', 'numerical'),
			array('code, description', 'length', 'max'=>255),
			array('_outOfStocksUp, catalogId', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, code, description, catalogPrice, netPriceDiscount, stocksOnHand, productGroupId, catalogId, _outOfStocksUp', 'safe', 'on'=>'search'),
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
			'orderdetails' => array(self::HAS_MANY, 'Orderdetails', 'productId'),
			'productGroup' => array(self::BELONGS_TO, 'Productgroups', 'productGroupId'),
			'catalog' => array(self::BELONGS_TO, 'Catalogs', 'catalogId'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'code' => 'Code',
			'description' => 'Description',
			'catalogPrice' => 'Catalog Price',
			'netPriceDiscount' => 'Net Price Discount',
			'stocksOnHand' => 'Stocks On Hand',
			'productGroupId' => 'Product Group',
			'catalogId' => 'Catalog',
			'_outOfStocksUp' => 'Out Of Stocks Up',
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
		$criteria->compare('code',$this->code,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('catalogPrice',$this->catalogPrice);
		$criteria->compare('netPriceDiscount',$this->netPriceDiscount);
		$criteria->compare('stocksOnHand',$this->stocksOnHand);
		$criteria->compare('productGroupId',$this->productGroupId);
		$criteria->compare('catalogId',$this->catalogId);
		$criteria->compare('_outOfStocksUp',$this->_outOfStocksUp);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Products the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	public function getCodeName()
	{
		return $this->code . ' ' . $this->description;
	}
	
	public function getOutOfStock()
	{
		return ($this->_outOfStocksUp == 0);
	}
	
	public function getCriticalStock()
	{
		return ($this->_outOfStocksUp > 0);
	}
}

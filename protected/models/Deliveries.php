<?php

/**
 * This is the model class for table "deliveries".
 *
 * The followings are the available columns in table 'deliveries':
 * @property integer $id
 * @property string $dateCreated
 * @property string $dateLastModified
 * @property string $dateDelivered
 * @property integer $purchaseOrderId
 * @property integer $receivedBy
 * @property string $deliveryNo
 * @property integer $deliveryConfirmed
 *
 * The followings are the available model relations:
 * @property Purchaseorders $purchaseOrder
 * @property Users $receivedBy0
 * @property Deliveryproducts[] $deliveryproducts
 */
class Deliveries extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'deliveries';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('purchaseOrderId, dateDelivered, deliveryNo', 'required'),
			array('purchaseOrderId, receivedBy, deliveryConfirmed', 'numerical', 'integerOnly'=>true),
			array('dateCreated, dateLastModified, dateDelivered', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, dateCreated, dateLastModified, dateDelivered, purchaseOrderId, receivedBy, deliveryNo', 'safe', 'on'=>'search'),
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
			'purchaseOrder' => array(self::BELONGS_TO, 'Purchaseorders', 'purchaseOrderId'),
			'receivedBy0' => array(self::BELONGS_TO, 'Users', 'receivedBy'),
			'products' => array(self::HAS_MANY, 'Deliveryproducts', 'deliveryId', 'with' => 'product'),
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
			'dateDelivered' => 'Date Delivered',
			'purchaseOrderId' => 'Purchase Order',
			'receivedBy' => 'Received By',
			'deliveryNo' => 'Delivery Receipt No',
			'deliveryConfirmed' => 'Confirmed?',
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
		$criteria->compare('dateDelivered',$this->dateDelivered,true);
		$criteria->compare('purchaseOrderId',$this->purchaseOrderId);
		$criteria->compare('receivedBy',$this->receivedBy);
		$criteria->compare('deliveryNo',$this->deliveryNo);
		
		$sort = new CSort;
		
		/* Default Sort Order*/
        $sort->defaultOrder= array(
            'dateCreated'=>CSort::SORT_DESC,
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
	 * @return Deliveries the static model class
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
}

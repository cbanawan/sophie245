<?php

/**
 * This is the model class for table "members".
 *
 * The followings are the available columns in table 'members':
 * @property integer $id
 * @property string $memberCode
 * @property string $firstName
 * @property string $lastName
 * @property string $middleName
 * @property integer $sponsorId
 * @property integer $_active
 * @property string $homePhone
 * @property string $mobilePhone
 * @property string $emailAddress
 * @property string $address1
 * @property string $address2
 * @property integer $cityId
 * @property integer $fullName
 * @property string $sponsorCode
 * @property string $position
 * @property string $dateJoined
 *
 * The followings are the available model relations:
 * @property Members $sponsor
 * @property Members[] $members
 * @property Cities $city
 * @property Positions[] $positions
 * @property Orders[] $orders
 * @property Users[] $users
 */
class Members extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'members';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('memberCode, firstName, lastName, dateJoined', 'required'),
			array('memberCode', 'unique'),
			array('memberCode', 'length', 'max'=>10),
            array('sponsorCode, dateJoined, middleName, homePhone, mobilePhone', 'safe'),
			// array('firstName, lastName, middleName, address1, address2', 'length', 'max'=>45),
			// array('homePhone, mobilePhone', 'length', 'max'=>13),
			// array('emailAddress', 'length', 'max'=>100),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, memberCode, firstName, lastName, middleName, sponsorId, sponsorCode, position, _active, homePhone, mobilePhone, emailAddress, address1, address2, cityId', 'safe', 'on'=>'search'),
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
			'sponsor' => array(self::BELONGS_TO, 'Members', 'sponsorId'),
			'members' => array(self::HAS_MANY, 'Members', 'sponsorId'),
			'city' => array(self::BELONGS_TO, 'Cities', 'cityId'),
			'positions' => array(self::MANY_MANY, 'Positions', 'memberspositions(memberId, positionId)'),
			'orders' => array(self::HAS_MANY, 'Orders', 'memberId'),
			'users' => array(self::MANY_MANY, 'Users', 'usersmembers(memberId, userId)'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'memberCode' => 'Member Code',
			'firstName' => 'First Name',
			'lastName' => 'Last Name',
			'middleName' => 'Middle Name',
			'sponsorId' => 'Sponsor',
			'_active' => 'Active',
			'homePhone' => 'Home Phone',
			'mobilePhone' => 'Mobile Phone',
			'emailAddress' => 'Email Address',
			'address1' => 'Address1',
			'address2' => 'Address2',
			'cityId' => 'City',
			'fullName' => 'Full Name',
			'sponsorCode' => 'Sponsor Code',
			'position' => 'Position',
			'dateJoined' => 'Date Joined'
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

		$criteria->compare('memberCode',$this->memberCode,true);
		$criteria->compare('firstName',$this->firstName,true);
		$criteria->compare('lastName',$this->lastName,true);
		$criteria->compare('middleName',$this->middleName,true);
		$criteria->compare('homePhone',$this->homePhone,true);
		$criteria->compare('mobilePhone',$this->mobilePhone,true);
		$criteria->compare('emailAddress',$this->emailAddress,true);
		$criteria->compare('address1',$this->address1,true);
		$criteria->compare('address2',$this->address2,true);
		$criteria->compare('cityId',$this->cityId);
        $criteria->compare('sponsorCode',$this->sponsorCode);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Members the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	public function getCodeName()
	{
		return $this->memberCode . ' ' . $this->getFullName();
	}
	
	public function getFullName()
	{
		return $this->lastName . ', ' . $this->firstName;
	}
	
}

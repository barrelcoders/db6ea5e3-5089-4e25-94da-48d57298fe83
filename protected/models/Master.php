<?php

/**
 * This is the model class for table "tbl_master".
 *
 * The followings are the available columns in table 'tbl_master':
 * @property string $ID
 * @property string $OFFICE_NAME
 * @property string $OFFICE_ADDRESS
 * @property string $DEPT_NAME
 * @property string $DEPT_HEAD_EMPLOYEE
 * @property string $DEPT_ADMIN_EMPLOYEE
 * @property string $OFFICE_NAME_HINDI
 * @property string $OFFICE_ADDRESS_HINDI
 * @property string $DEPT_NAME_HINDI
 *
 * The followings are the available model relations:
 * @property TblEmployee $dEPTHEADEMPLOYEE
 * @property TblEmployee $dEPTADMINEMPLOYEE
 */
class Master extends CActiveRecord
{
	public $FINANCIAL_YEAR;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_master';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('OFFICE_NAME, OFFICE_ADDRESS, DEPT_NAME, DEPT_HEAD_EMPLOYEE, DEPT_ADMIN_EMPLOYEE, OFFICE_NAME_HINDI, OFFICE_ADDRESS_HINDI, DEPT_NAME_HINDI', 'required'),
			array('OFFICE_NAME, OFFICE_NAME_HINDI, HOO_OFFICE_NAME, HOO_OFFICE_NAME_HINDI', 'length', 'max'=>200),
			array('OFFICE_ADDRESS, OFFICE_ADDRESS_HINDI', 'length', 'max'=>500),
			array('DEPT_NAME, DEPT_NAME_HINDI', 'length', 'max'=>100),
			array('DEPT_HEAD_EMPLOYEE, DEPT_ADMIN_EMPLOYEE', 'length', 'max'=>10),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('ID, OFFICE_NAME, OFFICE_ADDRESS, DEPT_NAME, DEPT_HEAD_EMPLOYEE, DEPT_ADMIN_EMPLOYEE, OFFICE_NAME_HINDI, OFFICE_ADDRESS_HINDI, DEPT_NAME_HINDI', 'safe', 'on'=>'search'),
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
			'dEPTHEADEMPLOYEE' => array(self::BELONGS_TO, 'TblEmployee', 'DEPT_HEAD_EMPLOYEE'),
			'dEPTADMINEMPLOYEE' => array(self::BELONGS_TO, 'TblEmployee', 'DEPT_ADMIN_EMPLOYEE'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ID' => 'ID',
			'OFFICE_NAME' => 'Office Name',
			'OFFICE_ADDRESS' => 'Office Address',
			'DEPT_NAME' => 'Department Name',
			'DEPT_HEAD_EMPLOYEE' => 'Department Head',
			'DEPT_ADMIN_EMPLOYEE' => 'Department Administrator',
			'OFFICE_NAME_HINDI' => 'Office Name (Hindi)',
			'OFFICE_ADDRESS_HINDI' => 'Office Address (Hindi)',
			'DEPT_NAME_HINDI' => 'Department Name (Hindi)',
			'HOO_OFFICE_NAME'=> 'Head of Office Name',
			'HOO_OFFICE_NAME_HINDI'=> 'Head of Office Name (Hindi)',
			'FINANCIAL_YEAR'=>'Current Financial Year'
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

		$criteria->compare('ID',$this->ID,true);
		$criteria->compare('OFFICE_NAME',$this->OFFICE_NAME,true);
		$criteria->compare('OFFICE_ADDRESS',$this->OFFICE_ADDRESS,true);
		$criteria->compare('DEPT_NAME',$this->DEPT_NAME,true);
		$criteria->compare('DEPT_HEAD_EMPLOYEE',$this->DEPT_HEAD_EMPLOYEE,true);
		$criteria->compare('DEPT_ADMIN_EMPLOYEE',$this->DEPT_ADMIN_EMPLOYEE,true);
		$criteria->compare('OFFICE_NAME_HINDI',$this->OFFICE_NAME_HINDI,true);
		$criteria->compare('OFFICE_ADDRESS_HINDI',$this->OFFICE_ADDRESS_HINDI,true);
		$criteria->compare('DEPT_NAME_HINDI',$this->DEPT_NAME_HINDI,true);
		$criteria->compare('HOO_OFFICE_NAME',$this->HOO_OFFICE_NAME,true);
		$criteria->compare('HOO_OFFICE_NAME_HINDI',$this->HOO_OFFICE_NAME_HINDI,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Master the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}

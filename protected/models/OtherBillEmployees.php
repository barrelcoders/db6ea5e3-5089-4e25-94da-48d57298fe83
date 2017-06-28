<?php

/**
 * This is the model class for table "tbl_other_bill_employees".
 *
 * The followings are the available columns in table 'tbl_other_bill_employees':
 * @property string $ID
 * @property string $BILL_ID
 * @property string $EMPLOYEE_ID
 */
class OtherBillEmployees extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_other_bill_employees';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('BILL_ID, EMPLOYEE_ID', 'required'),
			array('BILL_ID', 'length', 'max'=>10),
			array('EMPLOYEE_ID', 'length', 'max'=>200),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('ID, BILL_ID, EMPLOYEE_ID', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ID' => 'ID',
			'BILL_ID' => 'Bill',
			'EMPLOYEE_ID' => 'Employee',
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
		$criteria->compare('BILL_ID',$this->BILL_ID,true);
		$criteria->compare('EMPLOYEE_ID',$this->EMPLOYEE_ID,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return OtherBillEmployees the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}

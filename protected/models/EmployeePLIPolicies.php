<?php

/**
 * This is the model class for table "tbl_employee_pli_policies".
 *
 * The followings are the available columns in table 'tbl_employee_pli_policies':
 * @property string $ID
 * @property string $EMPLOYEE_ID_FK
 * @property string $POLICY_NO
 * @property string $AMOUNT
 * @property integer $STATUS
 */
class EmployeePLIPolicies extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_employee_pli_policies';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('EMPLOYEE_ID_FK, POLICY_NO, STATUS', 'required'),
			array('STATUS', 'numerical', 'integerOnly'=>true),
			array('EMPLOYEE_ID_FK, POLICY_NO, AMOUNT', 'length', 'max'=>10),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('ID, EMPLOYEE_ID_FK, POLICY_NO, AMOUNT, STATUS', 'safe', 'on'=>'search'),
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
			'EMPLOYEE_ID_FK' => 'Employee Id Fk',
			'POLICY_NO' => 'Policy No',
			'AMOUNT' => 'Amount',
			'STATUS' => 'Status',
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
		$criteria->compare('EMPLOYEE_ID_FK',$this->EMPLOYEE_ID_FK,true);
		$criteria->compare('POLICY_NO',$this->POLICY_NO,true);
		$criteria->compare('AMOUNT',$this->AMOUNT,true);
		$criteria->compare('STATUS',$this->STATUS);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return EmployeePLIPolicies the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}

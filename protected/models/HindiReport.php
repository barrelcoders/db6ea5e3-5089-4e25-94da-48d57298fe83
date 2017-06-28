<?php

/**
 * This is the model class for table "tbl_hindi_report".
 *
 * The followings are the available columns in table 'tbl_hindi_report':
 * @property string $ID
 * @property string $QUARTER
 * @property string $DATE
 * @property string $EMPLOYEE_ID
 * @property string $EMPLOYEE_ID_TYPE
 * @property string $COL_1_1
 */
class HindiReport extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_hindi_report';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('QUARTER, DATE, EMPLOYEE_ID, EMPLOYEE_ID_TYPE, COL_1_1', 'required'),
			array('QUARTER, EMPLOYEE_ID, COL_1_1', 'length', 'max'=>10),
			array('EMPLOYEE_ID_TYPE', 'length', 'max'=>50),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('ID, QUARTER, DATE, EMPLOYEE_ID, EMPLOYEE_ID_TYPE, COL_1_1', 'safe', 'on'=>'search'),
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
			'QUARTER' => 'Quarter',
			'DATE' => 'Date',
			'EMPLOYEE_ID' => 'Employee',
			'EMPLOYEE_ID_TYPE' => 'Employee Id Type',
			'COL_1_1' => 'Col 1 1',
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
		$criteria->compare('QUARTER',$this->QUARTER,true);
		$criteria->compare('DATE',$this->DATE,true);
		$criteria->compare('EMPLOYEE_ID',$this->EMPLOYEE_ID,true);
		$criteria->compare('EMPLOYEE_ID_TYPE',$this->EMPLOYEE_ID_TYPE,true);
		$criteria->compare('COL_1_1',$this->COL_1_1,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return HindiReport the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}

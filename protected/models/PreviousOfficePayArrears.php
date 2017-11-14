<?php

/**
 * This is the model class for table "tbl_previous_office_pay_arrears".
 *
 * The followings are the available columns in table 'tbl_previous_office_pay_arrears':
 * @property string $ID
 * @property string $EMPLOYEE_ID_FK
 * @property string $MONTH
 * @property string $YEAR
 * @property string $BASIC
 * @property string $PP_SP
 * @property string $TA
 * @property string $HRA
 * @property string $DA
 * @property string $TOTAL
 * @property string $CGEGIS
 * @property string $CGHS
 * @property string $CPF
 * @property string $PT
 * @property string $IT
 * @property string $PLI
 * @property string $LIC
 */
class PreviousOfficePayArrears extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_previous_office_pay_arrears';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('EMPLOYEE_ID_FK, MONTH, YEAR', 'required'),
			array('EMPLOYEE_ID_FK, MONTH, YEAR, BASIC, PP_SP, TA, HRA, DA, TOTAL, CGEGIS, CGHS, CPF, PT, IT, PLI, LIC', 'length', 'max'=>10),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('ID, EMPLOYEE_ID_FK, MONTH, YEAR, BASIC, PP_SP, TA, HRA, DA, TOTAL, CGEGIS, CGHS, CPF, PT, IT, PLI, LIC', 'safe', 'on'=>'search'),
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
			'MONTH' => 'Month',
			'YEAR' => 'Year',
			'BASIC' => 'Basic',
			'PP_SP' => 'Pp Sp',
			'TA' => 'Ta',
			'HRA' => 'Hra',
			'DA' => 'Da',
			'TOTAL' => 'Total',
			'CGEGIS' => 'Cgegis',
			'CGHS' => 'Cghs',
			'CPF' => 'Cpf',
			'PT' => 'Pt',
			'IT' => 'It',
			'PLI' => 'Pli',
			'LIC' => 'Lic',
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
		$criteria->compare('MONTH',$this->MONTH,true);
		$criteria->compare('YEAR',$this->YEAR,true);
		$criteria->compare('BASIC',$this->BASIC,true);
		$criteria->compare('PP_SP',$this->PP_SP,true);
		$criteria->compare('TA',$this->TA,true);
		$criteria->compare('HRA',$this->HRA,true);
		$criteria->compare('DA',$this->DA,true);
		$criteria->compare('TOTAL',$this->TOTAL,true);
		$criteria->compare('CGEGIS',$this->CGEGIS,true);
		$criteria->compare('CGHS',$this->CGHS,true);
		$criteria->compare('CPF',$this->CPF,true);
		$criteria->compare('PT',$this->PT,true);
		$criteria->compare('IT',$this->IT,true);
		$criteria->compare('PLI',$this->PLI,true);
		$criteria->compare('LIC',$this->LIC,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return PreviousOfficePayArrears the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}

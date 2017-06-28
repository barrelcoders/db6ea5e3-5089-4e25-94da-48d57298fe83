<?php

/**
 * This is the model class for table "tbl_pao_expenditure".
 *
 * The followings are the available columns in table 'tbl_pao_expenditure':
 * @property string $ID
 * @property string $SALARY
 * @property string $MEDICAL
 * @property string $DTE
 * @property string $OE
 * @property string $RRT
 * @property string $IT_SAL
 * @property string $IT_ECSS
 * @property string $IT_HCESS
 * @property string $MONTH
 * @property string $YEAR
 */
class PAOExpenditure extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_pao_expenditure';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('SALARY, MEDICAL, DTE, OE, RRT, IT_SAL, IT_ECSS, IT_HCESS, MONTH, YEAR, DATE, IT_NON_SAL', 'length', 'max'=>10),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('ID, SALARY, MEDICAL, DTE, OE, RRT, IT_SAL, IT_ECSS, IT_HCESS, MONTH, YEAR, DATE, IT_NON_SAL', 'safe', 'on'=>'search'),
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
			'SALARY' => 'SALARY',
			'MEDICAL' => 'MEDICAL',
			'DTE' => 'DTE',
			'OE' => 'OE',
			'RRT' => 'RRT',
			'IT_SAL' => 'IT SALARY',
			'IT_ECSS' => 'IT E. CESS',
			'IT_HCESS' => 'IT H. CESS',
			'MONTH' => 'Month',
			'YEAR' => 'Year',
			'DATE' => 'DATE',
			'IT_NON_SAL'=>'IT NON SALARY'
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
		$criteria->compare('SALARY',$this->SALARY,true);
		$criteria->compare('MEDICAL',$this->MEDICAL,true);
		$criteria->compare('DTE',$this->DTE,true);
		$criteria->compare('OE',$this->OE,true);
		$criteria->compare('RRT',$this->RRT,true);
		$criteria->compare('IT_SAL',$this->IT_SAL,true);
		$criteria->compare('IT_ECSS',$this->IT_ECSS,true);
		$criteria->compare('IT_HCESS',$this->IT_HCESS,true);
		$criteria->compare('MONTH',$this->MONTH,true);
		$criteria->compare('YEAR',$this->YEAR,true);
		$criteria->compare('DATE',$this->DATE,true);
		$criteria->compare('IT_NON_SAL',$this->IT_NON_SAL,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return PAOExpenditure the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}

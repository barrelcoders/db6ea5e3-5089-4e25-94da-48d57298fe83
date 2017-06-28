<?php

/**
 * This is the model class for table "tbl_appropiation_register".
 *
 * The followings are the available columns in table 'tbl_appropiation_register':
 * @property string $id
 * @property string $BILL_NO_FK
 * @property string $BILL_AMOUNT
 * @property string $EXPENDITURE_INC_BILL
 * @property string $BALANCE
 *
 * The followings are the available model relations:
 * @property TblBill $bILLNOFK
 */
class AppropiationRegister extends CActiveRecord
{
	public $OPERATION, $AMOUNT;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_appropiation_register';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('BILL_NO, BILL_AMOUNT, EXPENDITURE_INC_BILL, BALANCE', 'required'),
			array('BILL_NO', 'length', 'max'=>10),
			array('BILL_AMOUNT, EXPENDITURE_INC_BILL, BALANCE', 'length', 'max'=>30),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, BILL_NO, BILL_AMOUNT, EXPENDITURE_INC_BILL, BALANCE, UPDATION_DATE', 'safe', 'on'=>'search'),
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
			'BILL_NO' => 'Bill No',
			'BILL_AMOUNT' => 'Bill Amount',
			'EXPENDITURE_INC_BILL' => 'Expenditure Inc Bill',
			'BALANCE' => 'Balance',
			'UPDATION_DATE' => 'Updation Date'
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
		$criteria->compare('BILL_NO',$this->BILL_NO,true);
		$criteria->compare('BILL_AMOUNT',$this->BILL_AMOUNT,true);
		$criteria->compare('EXPENDITURE_INC_BILL',$this->EXPENDITURE_INC_BILL,true);
		$criteria->compare('BALANCE',$this->BALANCE,true);
		$criteria->compare('UPDATION_DATE',$this->BALANCE,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return AppropiationRegister the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}

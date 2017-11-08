<?php

/**
 * This is the model class for table "tbl_bill".
 *
 * The followings are the available columns in table 'tbl_bill':
 * @property string $id
 * @property string $BILL_NO
 * @property string $PT_DED_BILL_NO
 * @property string $LIC_DED_BILL_NO
 * @property string $NILL_BILL_NO
 * @property string $MONTH
 * @property string $YEAR
 * @property string $CREATION_DATE
 * @property string $BILL_TYPE
 * @property string $BILL_AMOUNT
 * @property string $EXPENDITURE_INC_BILL
 * @property string $APPROPIATION_BALANCE
 * @property string $PFMS_BILL_NO
 * @property string $FILE_NO
 * @property string $BILL_TITLE
 * @property string $CER_NO
 * @property string $PFMS_STATUS
 * @property string $BILL_SUB_TYPE
 *
 * The followings are the available model relations:
 * @property TblAppropiationRegister[] $tblAppropiationRegisters
 * @property TblBillType $bILLTYPE
 * @property TblBillSubType $bILLSUBTYPE
 */
class Bill extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	 
	public $OE_IT_DED, $OE_NET_AMOUNT, $CLAIM_GROSS_AMOUNT, $CLAIM_ADVANCE_AMOUNT;
	public function tableName()
	{
		return 'tbl_bill';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('BILL_NO, MONTH, YEAR, MONTH_END, YEAR_END, CREATION_DATE, BILL_TYPE, BILL_TITLE, PFMS_STATUS', 'required'),
			array('BILL_NO, PT_DED_BILL_NO, LIC_DED_BILL_NO, NILL_BILL_NO, PFMS_BILL_NO, FILE_NO', 'length', 'max'=>100),
			array('BILL_TITLE', 'length', 'max'=>500),
			array('BILL_TYPE, BILL_SUB_TYPE, VENDOR_ID', 'length', 'max'=>10),
			array('BILL_AMOUNT, EXPENDITURE_INC_BILL, APPROPIATION_BALANCE', 'length', 'max'=>100),
			array('CER_NO, UA_PERIOD', 'length', 'max'=>50),
			array('IS_ARREAR_BILL, IS_CEA_BILL, IS_BONUS_BILL, IS_UA_BILL, IS_LTC_ADVANCE_BILL, IS_LTC_CLAIM_BILL, IS_EL_ENCASHMENT_BILL, IS_RECOVERY_BILL, IS_DA_ARREAR_BILL, IS_MULTIPLE_MONTH', 'length', 'max'=>3),
			array('PFMS_STATUS, MONTH, YEAR', 'length', 'max'=>45),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('ID, BILL_NO, PT_DED_BILL_NO, LIC_DED_BILL_NO, NILL_BILL_NO, MONTH, YEAR, CREATION_DATE, BILL_TYPE, BILL_AMOUNT, EXPENDITURE_INC_BILL, APPROPIATION_BALANCE, PFMS_BILL_NO, FILE_NO, 
			BILL_TITLE, CER_NO, PFMS_STATUS, BILL_SUB_TYPE, IS_ARREAR_BILL, IS_CEA_BILL, IS_BONUS_BILL, IS_UA_BILL, UA_PERIOD, IS_DA_ARREAR_BILL, IS_MULTIPLE_MONTH, MONTH_END, YEAR_END', 'safe', 'on'=>'search'),
			
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
			'bILLTYPE' => array(self::BELONGS_TO, 'TblBillType', 'BILL_TYPE'),
			'bILLSUBTYPE' => array(self::BELONGS_TO, 'TblBillSubType', 'BILL_SUB_TYPE'),
		);
	}
	
	public function getIS_SALARY_HEAD_PAY_BILL()
    {
      return (($this->BILL_TYPE == 1 ||  $this->BILL_TYPE == 2) && ($this->IS_ARREAR_BILL == 0 && $this->IS_DA_ARREAR_BILL == 0 && $this->IS_CEA_BILL == 0 && $this->IS_BONUS_BILL == 0 && 
			$this->IS_UA_BILL == 0 && $this->IS_LTC_CLAIM_BILL == 0 && $this->IS_LTC_ADVANCE_BILL == 0 && $this->IS_EL_ENCASHMENT_BILL == 0 && $this->IS_RECOVERY_BILL == 0));
    }
	
	public function getIS_OPS_PAY_BILL()
    {
      return (($this->BILL_TYPE == 1) && ($this->IS_ARREAR_BILL == 0 && $this->IS_DA_ARREAR_BILL == 0 && $this->IS_CEA_BILL == 0 && $this->IS_BONUS_BILL == 0 && 
			$this->IS_UA_BILL == 0 && $this->IS_LTC_CLAIM_BILL == 0 && $this->IS_LTC_ADVANCE_BILL == 0 && $this->IS_EL_ENCASHMENT_BILL == 0 && $this->IS_RECOVERY_BILL == 0));
    }
	
	public function getIS_NPS_PAY_BILL()
    {
      return (($this->BILL_TYPE == 2) && ($this->IS_ARREAR_BILL == 0 && $this->IS_DA_ARREAR_BILL == 0 && $this->IS_CEA_BILL == 0 && $this->IS_BONUS_BILL == 0 && 
			$this->IS_UA_BILL == 0 && $this->IS_LTC_CLAIM_BILL == 0 && $this->IS_LTC_ADVANCE_BILL == 0 && $this->IS_EL_ENCASHMENT_BILL == 0 && $this->IS_RECOVERY_BILL == 0));
    }
	
	public function getIS_SALARY_HEAD_OTHER_BILL()
    {
      return (($this->BILL_TYPE == 1 ||  $this->BILL_TYPE == 2) && ($this->IS_ARREAR_BILL == 1 || $this->IS_DA_ARREAR_BILL == 1 || $this->IS_CEA_BILL == 1 || $this->IS_BONUS_BILL == 1 || 
			$this->IS_UA_BILL == 1 || $this->IS_LTC_CLAIM_BILL == 1 ||  $this->IS_LTC_ADVANCE_BILL == 1 || $this->IS_EL_ENCASHMENT_BILL == 1 || $this->IS_RECOVERY_BILL == 1));
    }
	
	public function getIS_WAGES_HEAD_PAY_BILL()
    {
       return (($this->BILL_TYPE == 8) && ($this->IS_ARREAR_BILL == 0 && $this->IS_DA_ARREAR_BILL == 0 && $this->IS_CEA_BILL == 0 && $this->IS_BONUS_BILL == 0 && 
			$this->IS_UA_BILL == 0 && $this->IS_LTC_CLAIM_BILL == 0 && $this->IS_LTC_ADVANCE_BILL == 0 && $this->IS_EL_ENCASHMENT_BILL == 0 && $this->IS_RECOVERY_BILL == 0));
    }
	
	public function getIS_WAGES_HEAD_OTHER_BILL()
    {
      return  (($this->BILL_TYPE == 8) && ($this->IS_ARREAR_BILL == 1 || $this->IS_DA_ARREAR_BILL == 1 || $this->IS_CEA_BILL == 1 || $this->IS_BONUS_BILL == 1 || 
			$this->IS_UA_BILL == 1 || $this->IS_LTC_CLAIM_BILL == 1 ||  $this->IS_LTC_ADVANCE_BILL == 1 || $this->IS_EL_ENCASHMENT_BILL == 1 || $this->IS_RECOVERY_BILL == 1));
    }
	
	public function getIS_SALARY_HEAD_PAY_ARREAR_BILL(){
		return (($this->BILL_TYPE == 1 ||  $this->BILL_TYPE == 2) && ($this->IS_ARREAR_BILL == 1));
	}
	
	public function getIS_SALARY_HEAD_DA_ARREAR_BILL(){
		return (($this->BILL_TYPE == 1 ||  $this->BILL_TYPE == 2) && ($this->IS_DA_ARREAR_BILL == 1));
	}
	
	public function getIS_NPS_DA_ARREAR_BILL(){
		return ($this->BILL_TYPE == 2 && $this->BILL_SUB_TYPE == 50 && $this->IS_DA_ARREAR_BILL == 1);
	}
	public function getIS_OPS_DA_ARREAR_BILL(){
		return ($this->BILL_TYPE == 1 && $this->BILL_SUB_TYPE == 49 && $this->IS_DA_ARREAR_BILL == 1);
	}
	
	public function GetBillSubType($id)
	{
		$data=BillSubType::model()->findAll('TYPE=:TYPE', array(':TYPE'=>(int) $id));
 
		return CHtml::listData($data,'ID','SUB_TYPE');
		
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ID' => 'ID',
			'BILL_NO' => 'Bill No',
			'PT_DED_BILL_NO' => 'Professional Tax Deduction Bill No',
			'LIC_DED_BILL_NO' => 'LIC & CCS Deduction Bill No',
			'NILL_BILL_NO' => 'Nill Bill No',
			'MONTH' => 'Month',
			'YEAR' => 'Year',
			'CREATION_DATE' => 'Creation Date',
			'BILL_TYPE' => 'Bill Type',
			'BILL_AMOUNT' => 'Bill Amount',
			'EXPENDITURE_INC_BILL' => 'Expenditure Including Bill',
			'APPROPIATION_BALANCE' => 'Appropiation Balance',
			'PFMS_BILL_NO' => 'PFMS Bill No',
			'FILE_NO' => 'File No',
			'BILL_TITLE' => 'Bill Title',
			'CER_NO' => 'CER No',
			'PFMS_STATUS' => 'PFMS Status',
			'BILL_SUB_TYPE' => 'Bill Sub Type',
			'VENDOR_ID'=> 'VENDOR',
			'IS_ARREAR_BILL'=>'Arrear Bill',
			'IS_CEA_BILL'=>'Children Education Allowance Bill',
			'IS_BONUS_BILL'=>'Bonus Bill',
			'IS_UA_BILL'=>'Uniform Allowance Bill',
			'IS_LTC_HTC_BILL'=>'LTC/HTC Advances & Claims Bill',
			'IS_LTC_ADVANCE_BILL'=>'LTC/HTC Advance Bill',
			'IS_LTC_CLAIM_BILL'=>'LTC/HTC Claims Bill', 
			'IS_EL_ENCASHMENT_BILL'=>'EL Encashment Bill', 
			'IS_RECOVERY_BILL'=>'Recovery Bill', 
			'OE_IT_DED'=>'Income Tax Deduction',
			'OE_NET_AMOUNT'=>'Net Bill Amount',
			'UA_PERIOD'=>'Uniform Allowance Period',
			'IS_DA_ARREAR_BILL'=>'Arrear(DA/TA) Bill',
			'IS_MULTIPLE_MONTH'=>'Multiple Month Bill', 
			'MONTH_END'=>'MONTH END',
			'YEAR_END'=>'YEAR END',
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
	 
	public function GetSalaryDetails()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('BILL_ID_FK',$this->ID,true);
		$criteria->compare('MONTH',$this->MONTH,true);
		$criteria->compare('YEAR',$this->YEAR,true);

		return new CActiveDataProvider(SalaryDetails::model(), array(
			'criteria'=>$criteria,
		));
	}

	public function search($data)
	{
		//print_r($data);exit;
		// @todo Please modify the following code to remove attributes that should not be searched.
		$criteria=new CDbCriteria;
		$criteria->compare('ID',$this->ID,true);
		$criteria->compare('BILL_NO',$this->BILL_NO,true);
		$criteria->compare('PT_DED_BILL_NO',$this->PT_DED_BILL_NO,true);
		$criteria->compare('LIC_DED_BILL_NO',$this->LIC_DED_BILL_NO,true);
		$criteria->compare('NILL_BILL_NO',$this->NILL_BILL_NO,true);
		$criteria->compare('MONTH',isset($data['MONTH']) ? $data['MONTH'] : $this->MONTH,true);
		$criteria->compare('YEAR',isset($data['YEAR']) ? $data['YEAR']: $this->YEAR,true);
		$criteria->compare('CREATION_DATE',$this->CREATION_DATE,true);
		$criteria->compare('BILL_TYPE',$this->BILL_TYPE,true);
		$criteria->compare('BILL_AMOUNT',$this->BILL_AMOUNT,true);
		$criteria->compare('EXPENDITURE_INC_BILL',$this->EXPENDITURE_INC_BILL,true);
		$criteria->compare('APPROPIATION_BALANCE',$this->APPROPIATION_BALANCE,true);
		$criteria->compare('PFMS_BILL_NO',$this->PFMS_BILL_NO,true);
		$criteria->compare('FILE_NO',$this->FILE_NO,true);
		$criteria->compare('BILL_TITLE',$this->BILL_TITLE,true);
		$criteria->compare('CER_NO',$this->CER_NO,true);
		$criteria->compare('PFMS_STATUS',$this->PFMS_STATUS,true);
		$criteria->compare('BILL_SUB_TYPE',$this->BILL_SUB_TYPE,true);
		$criteria->compare('VENDOR_ID',$this->VENDOR_ID,true);
		$criteria->compare('UA_PERIOD',$this->UA_PERIOD,true);
		$criteria->compare('IS_ARREAR_BILL',$this->IS_ARREAR_BILL,true);
		$criteria->compare('IS_CEA_BILL',$this->IS_ARREAR_BILL,true);
		$criteria->compare('IS_BONUS_BILL',$this->IS_ARREAR_BILL,true);
		$criteria->compare('IS_UA_BILL',$this->IS_ARREAR_BILL,true);
		$criteria->compare('IS_LTC_ADVANCE_BILL',$this->IS_LTC_ADVANCE_BILL,true);
		$criteria->compare('IS_LTC_CLAIM_BILL',$this->IS_LTC_CLAIM_BILL,true);
		$criteria->compare('IS_EL_ENCASHMENT_BILL',$this->IS_EL_ENCASHMENT_BILL,true);
		$criteria->compare('IS_RECOVERY_BILL',$this->IS_RECOVERY_BILL,true);
		$criteria->compare('IS_DA_ARREAR_BILL',$this->IS_DA_ARREAR_BILL,true);
		$criteria->compare('IS_MULTIPLE_MONTH',$this->IS_MULTIPLE_MONTH,true);
		$criteria->compare('PASSED_DATE', isset($data['PASSED_DATE']) ? date('Y-m-d', strtotime($data['PASSED_DATE'])) : "" ,true);
		$criteria->compare('MONTH_END',$this->MONTH_END,true);
		$criteria->compare('YEAR_END',$this->YEAR_END,true);
		$criteria->order = 'CREATION_DATE DESC';
		
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination'=>false, 
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Bill the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}

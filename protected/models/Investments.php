<?php

/**
 * This is the model class for table "tbl_investments".
 *
 * The followings are the available columns in table 'tbl_investments':
 * @property string $ID
 * @property string $FINANCIAL_YEAR_ID_FK
 * @property string $EMPLOYEE_ID
 * @property string $HRA
 * @property string $MEDICAL_INSURANCE
 * @property string $DONATION
 * @property string $DISABILITY_MED_EXP
 * @property string $EDU_LOAD_INT
 * @property string $SELF_DISABILITY
 * @property string $HOME_LOAN_INT
 * @property string $HOME_LOAD_EXCESS_2013_14
 * @property string $INSURANCE_LIC_OTHER
 * @property string $TUITION_FESS_EXEMPTION
 * @property string $PPF_NSC
 * @property string $HOME_LOAD_PR
 * @property string $PLI_ULIP
 * @property string $TERM_DEPOSIT_ABOVE_5
 * @property string $MUTUAL_FUND
 * @property string $PENSION_FUND
 * @property string $CPF
 */
class Investments extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_investments';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('FINANCIAL_YEAR_ID_FK, EMPLOYEE_ID', 'required'),
			array('OTHER_INCOME, HOUSE_INCOME, BONUS, CEA,EL_ENCASH, LTC_HTC, UNIFORM, DA_TA_ARREAR_CPF, DA_TA_ARREAR, OTA_HONORANIUM, FINANCIAL_YEAR_ID_FK, EMPLOYEE_ID, HRA, MEDICAL_INSURANCE, DONATION, DISABILITY_MED_EXP, EDU_LOAD_INT, SELF_DISABILITY, HOME_LOAN_INT, 
			HOME_LOAD_EXCESS_2013_14, REGISTRY_STAMP, INSURANCE_LIC_OTHER, TUITION_FESS_EXEMPTION, PPF_NSC, HOME_LOAD_PR, PLI_ULIP, TERM_DEPOSIT_ABOVE_5, MUTUAL_FUND, PENSION_FUND, CPF', 'length', 'max'=>10),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('BONUS, ID, FINANCIAL_YEAR_ID_FK, EMPLOYEE_ID, HRA, MEDICAL_INSURANCE, DONATION, DISABILITY_MED_EXP, EDU_LOAD_INT, SELF_DISABILITY, HOME_LOAN_INT, HOME_LOAD_EXCESS_2013_14, REGISTRY_STAMP,
			INSURANCE_LIC_OTHER, TUITION_FESS_EXEMPTION, PPF_NSC, HOME_LOAD_PR, PLI_ULIP, TERM_DEPOSIT_ABOVE_5, MUTUAL_FUND, PENSION_FUND, CPF', 'safe', 'on'=>'search'),
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
			'FINANCIAL_YEAR_ID_FK' => 'Financial Year',
			'EMPLOYEE_ID' => 'Employee Name',
			'HRA' => 'HRA',
			'MEDICAL_INSURANCE' => 'Medical Insurance',
			'DONATION' => 'Donation',
			'DISABILITY_MED_EXP' => 'Disability Medical Expenses',
			'EDU_LOAD_INT' => 'Education Loan Interest',
			'SELF_DISABILITY' => 'Self Disability',
			'HOME_LOAN_INT' => 'Home Loan Interest',
			'HOME_LOAD_EXCESS_2013_14' => 'Home Loan Excess 2013 14',
			'INSURANCE_LIC_OTHER' => 'Insurance/LIC/Other',
			'TUITION_FESS_EXEMPTION' => 'Tuition Fees Exemption',
			'PPF_NSC' => 'PPF/NSC',
			'HOME_LOAD_PR' => 'Home Loan Principal',
			'PLI_ULIP' => 'PLI/ULIP',
			'TERM_DEPOSIT_ABOVE_5' => 'Term Deposit > 5 Year',
			'MUTUAL_FUND' => 'Mutual Fund',
			'PENSION_FUND' => 'Pension Fund',
			'CPF' => 'CPF',
			'REGISTRY_STAMP'=>'REGISTRY STAMP',
			'DA_TA_ARREAR'=>'DA/TA ARREAR',
			'OTA_HONORANIUM'=>'OTA/HONORANIUM' ,
			'UNIFORM'=>'UNIFORM ALLOWANCE',
			'DA_TA_ARREAR_CPF'=>'DA/TA ARREAR CPF',
			'EL_ENCASH'=>'Leavse Encashment',
			'LTC_HTC'=>'LTC/HTC Advance/Claim',
			'CEA' => 'CEA',
			'BONUS'=>'BONUS', 
			'OTHER_INCOME'=>'OTHER INCOME', 
			'HOUSE_INCOME'=>'HOUSE INCOME', 
			'NPS_UNDER_80CCD_1B'=>'NPS under 80CCD(1B) Income', 
			'BANK_INTEREST_DED_80TTA'=>'Bank Interest Deduction 80TTA', 
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
		$criteria->compare('FINANCIAL_YEAR_ID_FK',$this->FINANCIAL_YEAR_ID_FK,true);
		$criteria->compare('EMPLOYEE_ID',$this->EMPLOYEE_ID,true);
		$criteria->compare('HRA',$this->HRA,true);
		$criteria->compare('MEDICAL_INSURANCE',$this->MEDICAL_INSURANCE,true);
		$criteria->compare('DONATION',$this->DONATION,true);
		$criteria->compare('DISABILITY_MED_EXP',$this->DISABILITY_MED_EXP,true);
		$criteria->compare('EDU_LOAD_INT',$this->EDU_LOAD_INT,true);
		$criteria->compare('SELF_DISABILITY',$this->SELF_DISABILITY,true);
		$criteria->compare('HOME_LOAN_INT',$this->HOME_LOAN_INT,true);
		$criteria->compare('HOME_LOAD_EXCESS_2013_14',$this->HOME_LOAD_EXCESS_2013_14,true);
		$criteria->compare('INSURANCE_LIC_OTHER',$this->INSURANCE_LIC_OTHER,true);
		$criteria->compare('TUITION_FESS_EXEMPTION',$this->TUITION_FESS_EXEMPTION,true);
		$criteria->compare('PPF_NSC',$this->PPF_NSC,true);
		$criteria->compare('HOME_LOAD_PR',$this->HOME_LOAD_PR,true);
		$criteria->compare('PLI_ULIP',$this->PLI_ULIP,true);
		$criteria->compare('TERM_DEPOSIT_ABOVE_5',$this->TERM_DEPOSIT_ABOVE_5,true);
		$criteria->compare('MUTUAL_FUND',$this->MUTUAL_FUND,true);
		$criteria->compare('PENSION_FUND',$this->PENSION_FUND,true);
		$criteria->compare('CPF',$this->CPF,true);
		$criteria->compare('REGISTRY_STAMP',$this->REGISTRY_STAMP,true);
		$criteria->compare('DA_TA_ARREAR',$this->DA_TA_ARREAR,true);
		$criteria->compare('OTA_HONORANIUM',$this->OTA_HONORANIUM,true);
		$criteria->compare('UNIFORM',$this->UNIFORM,true);
		$criteria->compare('DA_TA_ARREAR_CPF',$this->DA_TA_ARREAR_CPF,true);
		$criteria->compare('EL_ENCASH',$this->DA_TA_ARREAR_CPF,true);
		$criteria->compare('LTC_HTC',$this->DA_TA_ARREAR_CPF,true);
		$criteria->compare('CEA',$this->DA_TA_ARREAR_CPF,true);
		$criteria->compare('BONUS',$this->BONUS,true);
		$criteria->compare('OTHER_INCOME',$this->OTHER_INCOME,true);
		$criteria->compare('HOUSE_INCOME',$this->HOUSE_INCOME,true);
		$criteria->compare('NPS_UNDER_80CCD_1B',$this->NPS_UNDER_80CCD_1B,true);
		$criteria->compare('BANK_INTEREST_DED_80TTA',$this->BANK_INTEREST_DED_80TTA,true);
		
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Investments the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}

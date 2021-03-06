<?php

/**
 * This is the model class for table "tbl_salary_details".
 *
 * The followings are the available columns in table 'tbl_salary_details':
 * @property string $ID
 * @property string $BILL_ID_FK
 * @property string $EMPLOYEE_ID_FK
 * @property string $BASIC
 * @property string $SP
 * @property string $PP
 * @property string $CCA
 * @property string $HRA
 * @property string $DA
 * @property string $TA
 * @property string $IT
 * @property string $CGHS
 * @property string $LF
 * @property string $CGEGIS
 * @property string $CPF_TIER_I
 * @property string $CPF_TIER_II
 * @property string $HBA_EMI
 * @property string $MCA_EMI
 * @property string $COMP_EMI
 * @property string $FLOOD_EMI
 * @property string $CYCLE_EMI
 * @property string $PLI
 * @property string $MISC
 * @property string $PT
 * @property string $FEST_EMI
 * @property string $HBA_TOTAL
 * @property string $MCA_TOTAL
 * @property string $FLOOD_TOTAL
 * @property string $CYCLE_TOTAL
 * @property string $FEST_TOTAL
 * @property string $HBA_INST
 * @property string $MCA_INST
 * @property string $FLOOD_INST
 * @property string $CYCLE_INST
 * @property string $FEST_INST
 * @property string $HBA_BAL
 * @property string $MCA_BAL
 * @property string $FLOOD_BAL
 * @property string $CYCLE_BAL
 * @property integer $FEST_BAL
 * @property string $WA
 * @property string $CCS
 * @property string $LIC
 * @property string $ASSOSC_SUB
 * @property string $REMARKS
 * @property string $COMP_TOTAL
 * @property string $COMP_INST
 * @property string $COMP_BAL
 *
 * The followings are the available model relations:
 * @property TblEmployee $eMPLOYEEIDFK
 */
class SalaryDetails extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_salary_details';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('BILL_ID_FK, EMPLOYEE_ID_FK, BASIC, SP, PP, CCA, HRA, DA, TA, IT, CGHS, LF, CGEGIS, CPF_TIER_I, CPF_TIER_II, HBA_EMI, MCA_EMI, COMP_EMI, FLOOD_EMI, CYCLE_EMI, PLI, MISC, PT, FEST_EMI, 
			HBA_TOTAL, MCA_TOTAL, FLOOD_TOTAL, CYCLE_TOTAL, FEST_TOTAL, HBA_INST, MCA_INST, FLOOD_INST, CYCLE_INST, FEST_INST, HBA_BAL, MCA_BAL, FLOOD_BAL, CYCLE_BAL, FEST_BAL, WA, CCS, LIC, ASSOSC_SUB, 
			REMARKS, COMP_TOTAL, COMP_INST, COMP_BAL, IS_SALARY_BILL', 'required'),
			array('FEST_BAL', 'numerical', 'integerOnly'=>true),
			array('BILL_ID_FK, EMPLOYEE_ID_FK, BASIC, SP, PP, CCA, HRA, DA, TA, IT, CGHS, LF, CGEGIS, CPF_TIER_I, CPF_TIER_II, HBA_EMI, MCA_EMI, COMP_EMI, FLOOD_EMI, CYCLE_EMI, PLI, MISC, PT, FEST_EMI, 
			HBA_TOTAL, MCA_TOTAL, FLOOD_TOTAL, CYCLE_TOTAL, FEST_TOTAL, HBA_BAL, MCA_BAL, FLOOD_BAL, CYCLE_BAL, WA, CCS, LIC, ASSOSC_SUB, 
			COMP_TOTAL, COMP_BAL, OTHER_DED, AMOUNT_BANK, MAINT_MADIWALA, MAINT_JAYAMAHAL, CEA_TUITION, CEA_OTHER', 'length', 'max'=>10),
			array('HBA_INST, MCA_INST, FLOOD_INST, CYCLE_INST, FEST_INST, COMP_INST, REMARKS, COURT_ATTACHMENT, EL_ENCASH_DAYS, EL_ENCASH_LEAVE_APPLIED, 
			PREVIOUS_EL_ENCASH_DAYS, EL_ENCASH_BEFORE_THIS, BLOCK_YEAR', 'length', 'max'=>45),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('ID, BILL_ID_FK, EMPLOYEE_ID_FK, BASIC, SP, PP, CCA, HRA, DA, TA, IT, CGHS, LF, CGEGIS, CPF_TIER_I, CPF_TIER_II, HBA_EMI, MCA_EMI, COMP_EMI, 
			FLOOD_EMI, CYCLE_EMI, PLI, MISC, PT, FEST_EMI, HBA_TOTAL, MCA_TOTAL, FLOOD_TOTAL, CYCLE_TOTAL, FEST_TOTAL, HBA_INST, MCA_INST, FLOOD_INST, CYCLE_INST, FEST_INST, 
			HBA_BAL, MCA_BAL, FLOOD_BAL, CYCLE_BAL, FEST_BAL, WA, CCS, LIC, ASSOSC_SUB, REMARKS, COMP_TOTAL, COMP_INST, COMP_BAL, MONTH, YEAR, GP, GROSS, NET, DED, OTHER_DED, AMOUNT_BANK, IS_SALARY_BILL,
			IS_FEST_RECOVERY, IS_HBA_RECOVERY, IS_MCA_RECOVERY, IS_FLOOD_RECOVERY, IS_CYCLE_RECOVERY, IS_COMP_RECOVERY, MAINT_MADIWALA, MAINT_JAYAMAHAL, COURT_ATTACHMENT,
			CEA_TUITION, CEA_OTHER, EL_ENCASH_DAYS, EL_ENCASH_LEAVE_APPLIED, PREVIOUS_EL_ENCASH_DAYS, EL_ENCASH_BEFORE_THIS, BLOCK_YEAR', 'safe', 'on'=>'search'),
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
			'eMPLOYEEIDFK' => array(self::BELONGS_TO, 'TblEmployee', 'EMPLOYEE_ID_FK'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ID' => 'ID',
			'BILL_ID_FK' => 'Bill ID',
			'EMPLOYEE_ID_FK' => 'Employee ID',
			'BASIC' => 'Basic',
			'SP' => 'SP',
			'PP' => 'PP',
			'CCA' => 'CCA',
			'HRA' => 'HRA',
			'DA' => 'DA',
			'TA' => 'TA',
			'IT' => 'IT',
			'CGHS' => 'CGHS',
			'LF' => 'LF',
			'CGEGIS' => 'CGEGIS',
			'CPF_TIER_I' => 'CPF Tier I',
			'CPF_TIER_II' => 'CPF Tier Ii',
			'HBA_EMI' => 'HBA EMI',
			'MCA_EMI' => 'MCA EMI',
			'COMP_EMI' => 'COMPUTER EMI',
			'FLOOD_EMI' => 'Flood EMI',
			'CYCLE_EMI' => 'Cycle EMI',
			'PLI' => 'PLI',
			'MISC' => 'MISC',
			'PT' => 'PT',
			'FEST_EMI' => 'FEST EMI',
			'HBA_TOTAL' => 'HBA TOTAL',
			'MCA_TOTAL' => 'MCA TOTAL',
			'FLOOD_TOTAL' => 'Flood TOTAL',
			'CYCLE_TOTAL' => 'Cycle TOTAL',
			'FEST_TOTAL' => 'FEST TOTAL',
			'HBA_INST' => 'HBA INSTALLMENT',
			'MCA_INST' => 'MCA INSTALLMENT',
			'FLOOD_INST' => 'Flood INSTALLMENT',
			'CYCLE_INST' => 'Cycle INSTALLMENT',
			'FEST_INST' => 'FEST INSTALLMENT',
			'HBA_BAL' => 'HBA BALANCE',
			'MCA_BAL' => 'MCA BALANCE',
			'FLOOD_BAL' => 'Flood BALANCE',
			'CYCLE_BAL' => 'Cycle BALANCE',
			'FEST_BAL' => 'Fest BALANCE',
			'WA' => 'WA',
			'CCS' => 'CCS',
			'LIC' => 'LIC',
			'ASSOSC_SUB' => 'Association Subscription',
			'REMARKS' => 'Remarks',
			'COMP_TOTAL' => 'COMPUTER ADV TOTAL',
			'COMP_INST' => 'COMPUTER ADV INSTALLMENT',
			'COMP_BAL' => 'COMPUTER ADV BALANCE',
			'MONTH'=>'MONTH',
			'YEAR'=>'YEAR',
			'GP'=>'Grade Pay',
			'GROSS'=>'GROSS',
			'NET'=>'NET',
			'DED'=>'DEDUCTION',
			'OTHER_DED'=>'OTHER DEDUCTION',
			'AMOUNT_BANK'=>'AMOUNT BANK',
			'IS_SALARY_BILL'=>'SALARY BILL',
			'IS_FEST_RECOVERY'=>'FEST PRINCIPAL/INTEREST', 
			'IS_HBA_RECOVERY'=>'HBA PRINCIPAL/INTEREST', 
			'IS_MCA_RECOVERY'=>'MCA PRINCIPAL/INTEREST', 
			'IS_FLOOD_RECOVERY'=>'FLOOD PRINCIPAL/INTEREST', 
			'IS_CYCLE_RECOVERY'=>'CYCLE PRINCIPAL/INTEREST', 
			'IS_COMP_RECOVERY'=>'COMPUTER PRINCIPAL/INTEREST',
			'MAINT_MADIWALA'=>'MADIWALA',
			'MAINT_JAYAMAHAL'=>'JAYAMAHAL',
			'COURT_ATTACHMENT'=>'COURT ATTACHMENT',
			'LTC_HTC_GROSS'=>'LTC GROSS',
			'LTC_HTC_ADVANCE'=>'LTC ADVANCE',
			'LTC_HTC'=>'LTC NET',
			'CEA_TUITION'=>'CEA (TUTITON)',
			'CEA_OTHER'=>'CEA (OTHER)',
			'EL_ENCASH_DAYS'=>'No. of Days for which  Encashment applied ',
			'EL_ENCASH_LEAVE_APPLIED'=>'No. of days for which Earned leave applied/ sanctioned',
			'EL_ENCASH_LEAVE_BALANCE_BEFORE'=>'Leave at credit before encashment',
			'PREVIOUS_EL_ENCASH_DAYS'=>'No. of days Enchased before this',
			'BLOCK_YEAR'=>'BLOCK YEAR'
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
		$criteria->compare('BILL_ID_FK',$this->BILL_ID_FK,true);
		$criteria->compare('EMPLOYEE_ID_FK',$this->EMPLOYEE_ID_FK,true);
		$criteria->compare('BASIC',$this->BASIC,true);
		$criteria->compare('SP',$this->SP,true);
		$criteria->compare('PP',$this->PP,true);
		$criteria->compare('CCA',$this->CCA,true);
		$criteria->compare('HRA',$this->HRA,true);
		$criteria->compare('DA',$this->DA,true);
		$criteria->compare('TA',$this->TA,true);
		$criteria->compare('IT',$this->IT,true);
		$criteria->compare('CGHS',$this->CGHS,true);
		$criteria->compare('LF',$this->LF,true);
		$criteria->compare('CGEGIS',$this->CGEGIS,true);
		$criteria->compare('CPF_TIER_I',$this->CPF_TIER_I,true);
		$criteria->compare('CPF_TIER_II',$this->CPF_TIER_II,true);
		$criteria->compare('HBA_EMI',$this->HBA_EMI,true);
		$criteria->compare('MCA_EMI',$this->MCA_EMI,true);
		$criteria->compare('COMP_EMI',$this->COMP_EMI,true);
		$criteria->compare('FLOOD_EMI',$this->FLOOD_EMI,true);
		$criteria->compare('CYCLE_EMI',$this->CYCLE_EMI,true);
		$criteria->compare('PLI',$this->PLI,true);
		$criteria->compare('MISC',$this->MISC,true);
		$criteria->compare('PT',$this->PT,true);
		$criteria->compare('FEST_EMI',$this->FEST_EMI,true);
		$criteria->compare('HBA_TOTAL',$this->HBA_TOTAL,true);
		$criteria->compare('MCA_TOTAL',$this->MCA_TOTAL,true);
		$criteria->compare('FLOOD_TOTAL',$this->FLOOD_TOTAL,true);
		$criteria->compare('CYCLE_TOTAL',$this->CYCLE_TOTAL,true);
		$criteria->compare('FEST_TOTAL',$this->FEST_TOTAL,true);
		$criteria->compare('HBA_INST',$this->HBA_INST,true);
		$criteria->compare('MCA_INST',$this->MCA_INST,true);
		$criteria->compare('FLOOD_INST',$this->FLOOD_INST,true);
		$criteria->compare('CYCLE_INST',$this->CYCLE_INST,true);
		$criteria->compare('FEST_INST',$this->FEST_INST,true);
		$criteria->compare('HBA_BAL',$this->HBA_BAL,true);
		$criteria->compare('MCA_BAL',$this->MCA_BAL,true);
		$criteria->compare('FLOOD_BAL',$this->FLOOD_BAL,true);
		$criteria->compare('CYCLE_BAL',$this->CYCLE_BAL,true);
		$criteria->compare('FEST_BAL',$this->FEST_BAL);
		$criteria->compare('WA',$this->WA,true);
		$criteria->compare('CCS',$this->CCS,true);
		$criteria->compare('LIC',$this->LIC,true);
		$criteria->compare('ASSOSC_SUB',$this->ASSOSC_SUB,true);
		$criteria->compare('REMARKS',$this->REMARKS,true);
		$criteria->compare('COMP_TOTAL',$this->COMP_TOTAL,true);
		$criteria->compare('COMP_INST',$this->COMP_INST,true);
		$criteria->compare('COMP_BAL',$this->COMP_BAL,true);
		$criteria->compare('MONTH',$this->MONTH,true);
		$criteria->compare('YEAR',$this->YEAR,true);
		$criteria->compare('GP',$this->GP,true);
		$criteria->compare('GROSS',$this->GROSS,true);
		$criteria->compare('NET',$this->NET,true);
		$criteria->compare('DED',$this->DED,true);
		$criteria->compare('IS_SALARY_BILL',$this->IS_SALARY_BILL,true);
		$criteria->compare('IS_FEST_RECOVERY',$this->IS_FEST_RECOVERY,true);
		$criteria->compare('IS_HBA_RECOVERY',$this->IS_HBA_RECOVERY,true);
		$criteria->compare('IS_MCA_RECOVERY',$this->IS_MCA_RECOVERY,true);
		$criteria->compare('IS_FLOOD_RECOVERY',$this->IS_FLOOD_RECOVERY,true);
		$criteria->compare('IS_CYCLE_RECOVERY',$this->IS_CYCLE_RECOVERY,true);
		$criteria->compare('IS_COMP_RECOVERY',$this->IS_COMP_RECOVERY,true);
		$criteria->compare('MAINT_MADIWALA',$this->MAINT_MADIWALA,true);
		$criteria->compare('MAINT_JAYAMAHAL',$this->MAINT_JAYAMAHAL,true);
		$criteria->compare('COURT_ATTACHMENT',$this->COURT_ATTACHMENT,true);
		$criteria->compare('LTC_HTC_GROSS',$this->LTC_HTC_GROSS,true);
		$criteria->compare('LTC_HTC_ADVANCE',$this->LTC_HTC_ADVANCE,true);
		$criteria->compare('LTC_HTC',$this->LTC_HTC,true);
		$criteria->compare('CEA_TUITION',$this->CEA_TUITION,true);
		$criteria->compare('CEA_OTHER',$this->CEA_OTHER,true);
		$criteria->compare('EL_ENCASH_DAYS',$this->EL_ENCASH_DAYS,true);
		$criteria->compare('EL_ENCASH_LEAVE_APPLIED',$this->EL_ENCASH_LEAVE_APPLIED,true);
		$criteria->compare('PREVIOUS_EL_ENCASH_DAYS',$this->PREVIOUS_EL_ENCASH_DAYS,true);
		$criteria->compare('EL_ENCASH_BEFORE_THIS',$this->EL_ENCASH_BEFORE_THIS,true);
		$criteria->compare('BLOCK_YEAR',$this->BLOCK_YEAR,true);
		
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return SalaryDetails the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}

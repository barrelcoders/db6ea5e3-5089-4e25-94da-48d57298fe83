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
 * @property string $FAN_EMI
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
 * @property string $FAN_TOTAL
 * @property string $FAN_INST
 * @property string $FAN_BAL
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
			array('BILL_ID_FK, EMPLOYEE_ID_FK, BASIC, SP, PP, CCA, HRA, DA, TA, IT, CGHS, LF, CGEGIS, CPF_TIER_I, CPF_TIER_II, HBA_EMI, MCA_EMI, FAN_EMI, FLOOD_EMI, CYCLE_EMI, PLI, MISC, PT, FEST_EMI, 
			HBA_TOTAL, MCA_TOTAL, FLOOD_TOTAL, CYCLE_TOTAL, FEST_TOTAL, HBA_INST, MCA_INST, FLOOD_INST, CYCLE_INST, FEST_INST, HBA_BAL, MCA_BAL, FLOOD_BAL, CYCLE_BAL, FEST_BAL, WA, CCS, LIC, ASSOSC_SUB, 
			REMARKS, FAN_TOTAL, FAN_INST, FAN_BAL, IS_SALARY_BILL', 'required'),
			array('FEST_BAL', 'numerical', 'integerOnly'=>true),
			array('BILL_ID_FK, EMPLOYEE_ID_FK, BASIC, SP, PP, CCA, HRA, DA, TA, IT, CGHS, LF, CGEGIS, CPF_TIER_I, CPF_TIER_II, HBA_EMI, MCA_EMI, FAN_EMI, FLOOD_EMI, CYCLE_EMI, PLI, MISC, PT, FEST_EMI, 
			HBA_TOTAL, MCA_TOTAL, FLOOD_TOTAL, CYCLE_TOTAL, FEST_TOTAL, HBA_BAL, MCA_BAL, FLOOD_BAL, CYCLE_BAL, WA, CCS, LIC, ASSOSC_SUB, REMARKS, FAN_TOTAL, FAN_BAL, OTHER_DED, AMOUNT_BANK', 'length', 'max'=>10),
			array('HBA_INST, MCA_INST, FLOOD_INST, CYCLE_INST, FEST_INST, FAN_INST', 'length', 'max'=>45),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('ID, BILL_ID_FK, EMPLOYEE_ID_FK, BASIC, SP, PP, CCA, HRA, DA, TA, IT, CGHS, LF, CGEGIS, CPF_TIER_I, CPF_TIER_II, HBA_EMI, MCA_EMI, FAN_EMI, 
			FLOOD_EMI, CYCLE_EMI, PLI, MISC, PT, FEST_EMI, HBA_TOTAL, MCA_TOTAL, FLOOD_TOTAL, CYCLE_TOTAL, FEST_TOTAL, HBA_INST, MCA_INST, FLOOD_INST, CYCLE_INST, FEST_INST, 
			HBA_BAL, MCA_BAL, FLOOD_BAL, CYCLE_BAL, FEST_BAL, WA, CCS, LIC, ASSOSC_SUB, REMARKS, FAN_TOTAL, FAN_INST, FAN_BAL, MONTH, YEAR, GP, GROSS, NET, DED, OTHER_DED, AMOUNT_BANK, IS_SALARY_BILL,
			IS_FEST_RECOVERY, IS_HBA_RECOVERY, IS_MCA_RECOVERY, IS_FLOOD_RECOVERY, IS_CYCLE_RECOVERY, IS_FAN_RECOVERY', 'safe', 'on'=>'search'),
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
			'BILL_ID_FK' => 'Bill Id Fk',
			'EMPLOYEE_ID_FK' => 'Employee Id Fk',
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
			'MCA_EMI' => 'Mca EMI',
			'FAN_EMI' => 'Fan EMI',
			'FLOOD_EMI' => 'Flood EMI',
			'CYCLE_EMI' => 'Cycle EMI',
			'PLI' => 'PLI',
			'MISC' => 'MISC',
			'PT' => 'PT',
			'FEST_EMI' => 'FEST EMI',
			'HBA_TOTAL' => 'HBA Total',
			'MCA_TOTAL' => 'MCA Total',
			'FLOOD_TOTAL' => 'Flood Total',
			'CYCLE_TOTAL' => 'Cycle Total',
			'FEST_TOTAL' => 'FEST Total',
			'HBA_INST' => 'Hba INST',
			'MCA_INST' => 'Mca INST',
			'FLOOD_INST' => 'Flood INST',
			'CYCLE_INST' => 'Cycle INST',
			'FEST_INST' => 'FEST INST',
			'HBA_BAL' => 'Hba BAL',
			'MCA_BAL' => 'Mca BAL',
			'FLOOD_BAL' => 'Flood BAL',
			'CYCLE_BAL' => 'Cycle Bal',
			'FEST_BAL' => 'Fest Bal',
			'WA' => 'WA',
			'CCS' => 'CCS',
			'LIC' => 'LIC',
			'ASSOSC_SUB' => 'ASSOC SUB',
			'REMARKS' => 'Remarks',
			'FAN_TOTAL' => 'FAN Total',
			'FAN_INST' => 'FAN Inst',
			'FAN_BAL' => 'FAN Bal',
			'MONTH'=>'MONTH',
			'YEAR'=>'YEAR',
			'GP'=>'Grade Pay',
			'GROSS'=>'GROSS',
			'NET'=>'NET',
			'DED'=>'Deduction',
			'OTHER_DED'=>'Other Deduction',
			'AMOUNT_BANK'=>'Amount Credit to Bank',
			'IS_SALARY_BILL'=>'IS SALARY BILL',
			'IS_FEST_RECOVERY'=>'IS_FEST_RECOVERY', 
			'IS_HBA_RECOVERY'=>'IS_HBA_RECOVERY', 
			'IS_MCA_RECOVERY'=>'IS_HBA_RECOVERY', 
			'IS_FLOOD_RECOVERY'=>'IS_FLOOD_RECOVERY', 
			'IS_CYCLE_RECOVERY'=>'IS_CYCLE_RECOVERY', 
			'IS_FAN_RECOVERY'=>'IS_FAN_RECOVERY'
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
		$criteria->compare('FAN_EMI',$this->FAN_EMI,true);
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
		$criteria->compare('FAN_TOTAL',$this->FAN_TOTAL,true);
		$criteria->compare('FAN_INST',$this->FAN_INST,true);
		$criteria->compare('FAN_BAL',$this->FAN_BAL,true);
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
		$criteria->compare('IS_FAN_RECOVERY',$this->IS_FAN_RECOVERY,true);
		

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

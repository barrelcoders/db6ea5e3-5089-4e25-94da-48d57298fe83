<?php

/**
 * This is the model class for table "tbl_supplementary_salary_details".
 *
 * The followings are the available columns in table 'tbl_supplementary_salary_details':
 * @property string $ID
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
 * @property string $FEST_BAL
 * @property string $WA
 * @property string $CCS
 * @property string $LIC
 * @property string $ASSOSC_SUB
 * @property string $REMARKS
 * @property string $COMP_TOTAL
 * @property string $COMP_INST
 * @property string $COMP_BAL
 * @property string $MONTH
 * @property string $YEAR
 * @property string $GP
 * @property integer $GROSS
 * @property integer $DED
 * @property integer $NET
 * @property integer $OTHER_DED
 * @property integer $AMOUNT_BANK
 * @property integer $IS_FEST_RECOVERY
 * @property integer $IS_HBA_RECOVERY
 * @property integer $IS_MCA_RECOVERY
 * @property integer $IS_FLOOD_RECOVERY
 * @property integer $IS_CYCLE_RECOVERY
 * @property integer $IS_COMP_RECOVERY
 * @property integer $MAINT_MADIWALA
 * @property integer $MAINT_JAYAMAHAL
 * @property string $COURT_ATTACHMENT
 * @property string $EL_ENCASHMENT
 */
class SupplementarySalaryDetails extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_supplementary_salary_details';
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
			array('GROSS, DED, NET, OTHER_DED, AMOUNT_BANK, IS_FEST_RECOVERY, IS_HBA_RECOVERY, IS_MCA_RECOVERY, IS_FLOOD_RECOVERY, IS_CYCLE_RECOVERY, IS_COMP_RECOVERY, MAINT_MADIWALA, MAINT_JAYAMAHAL, FINANCIAL_YEAR_ID_FK', 'numerical', 'integerOnly'=>true),
			array('EMPLOYEE_ID_FK, BASIC, SP, PP, CCA, HRA, DA, TA, IT, CGHS, LF, CGEGIS, CPF_TIER_I, CPF_TIER_II, HBA_EMI, MCA_EMI, COMP_EMI, FLOOD_EMI, CYCLE_EMI, PLI, MISC, PT, FEST_EMI, HBA_TOTAL, 
			MCA_TOTAL, FLOOD_TOTAL, CYCLE_TOTAL, FEST_TOTAL, HBA_BAL, MCA_BAL, FLOOD_BAL, CYCLE_BAL, WA, CCS, LIC, ASSOSC_SUB, COMP_TOTAL, COMP_BAL, MONTH, YEAR, GP, COURT_ATTACHMENT, EL_ENCASHMENT, FINANCIAL_YEAR_ID_FK', 'length', 'max'=>10),
			array('HBA_INST, MCA_INST, FLOOD_INST, CYCLE_INST, FEST_INST, COMP_INST', 'length', 'max'=>45),
			array('FEST_BAL', 'length', 'max'=>11),
			array('REMARKS', 'length', 'max'=>200),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('ID, EMPLOYEE_ID_FK, BASIC, SP, PP, CCA, HRA, DA, TA, IT, CGHS, LF, CGEGIS, CPF_TIER_I, CPF_TIER_II, HBA_EMI, MCA_EMI, COMP_EMI, FLOOD_EMI, CYCLE_EMI, PLI, MISC, PT, FEST_EMI, HBA_TOTAL, MCA_TOTAL, FLOOD_TOTAL, CYCLE_TOTAL, FEST_TOTAL, HBA_INST, MCA_INST, FLOOD_INST, CYCLE_INST, 
			FEST_INST, HBA_BAL, MCA_BAL, FLOOD_BAL, CYCLE_BAL, FEST_BAL, WA, CCS, LIC, ASSOSC_SUB, REMARKS, COMP_TOTAL, COMP_INST, COMP_BAL, MONTH, YEAR, GP, GROSS, DED, NET,
			OTHER_DED, AMOUNT_BANK, IS_FEST_RECOVERY, IS_HBA_RECOVERY, IS_MCA_RECOVERY, IS_FLOOD_RECOVERY, IS_CYCLE_RECOVERY, IS_COMP_RECOVERY, MAINT_MADIWALA, MAINT_JAYAMAHAL,
			COURT_ATTACHMENT, EL_ENCASHMENT, FINANCIAL_YEAR_ID_FK', 'safe', 'on'=>'search'),
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
			'BASIC' => 'Basic',
			'SP' => 'Sp',
			'PP' => 'Pp',
			'CCA' => 'Cca',
			'HRA' => 'Hra',
			'DA' => 'Da',
			'TA' => 'Ta',
			'IT' => 'It',
			'CGHS' => 'Cghs',
			'LF' => 'Lf',
			'CGEGIS' => 'Cgegis',
			'CPF_TIER_I' => 'Cpf Tier I',
			'CPF_TIER_II' => 'Cpf Tier Ii',
			'HBA_EMI' => 'Hba Emi',
			'MCA_EMI' => 'Mca Emi',
			'COMP_EMI' => 'Fan Emi',
			'FLOOD_EMI' => 'Flood Emi',
			'CYCLE_EMI' => 'Cycle Emi',
			'PLI' => 'Pli',
			'MISC' => 'Misc',
			'PT' => 'Pt',
			'FEST_EMI' => 'Fest Emi',
			'HBA_TOTAL' => 'Hba Total',
			'MCA_TOTAL' => 'Mca Total',
			'FLOOD_TOTAL' => 'Flood Total',
			'CYCLE_TOTAL' => 'Cycle Total',
			'FEST_TOTAL' => 'Fest Total',
			'HBA_INST' => 'Hba Inst',
			'MCA_INST' => 'Mca Inst',
			'FLOOD_INST' => 'Flood Inst',
			'CYCLE_INST' => 'Cycle Inst',
			'FEST_INST' => 'Fest Inst',
			'HBA_BAL' => 'Hba Bal',
			'MCA_BAL' => 'Mca Bal',
			'FLOOD_BAL' => 'Flood Bal',
			'CYCLE_BAL' => 'Cycle Bal',
			'FEST_BAL' => 'Fest Bal',
			'WA' => 'Wa',
			'CCS' => 'Ccs',
			'LIC' => 'Lic',
			'ASSOSC_SUB' => 'Assosc Sub',
			'REMARKS' => 'Remarks',
			'COMP_TOTAL' => 'Fan Total',
			'COMP_INST' => 'Fan Inst',
			'COMP_BAL' => 'Fan Bal',
			'MONTH' => 'Month',
			'YEAR' => 'Year',
			'GP' => 'Gp',
			'GROSS' => 'Gross',
			'DED' => 'Ded',
			'NET' => 'Net',
			'OTHER_DED' => 'Other Ded',
			'AMOUNT_BANK' => 'Amount Bank',
			'IS_FEST_RECOVERY' => 'Is Fest Recovery',
			'IS_HBA_RECOVERY' => 'Is Hba Recovery',
			'IS_MCA_RECOVERY' => 'Is Mca Recovery',
			'IS_FLOOD_RECOVERY' => 'Is Flood Recovery',
			'IS_CYCLE_RECOVERY' => 'Is Cycle Recovery',
			'IS_COMP_RECOVERY' => 'Is Computer Recovery',
			'MAINT_MADIWALA' => 'Maint Madiwala',
			'MAINT_JAYAMAHAL' => 'Maint Jayamahal',
			'COURT_ATTACHMENT' => 'Court Attachment',
			'EL_ENCASHMENT' => 'El Encashment',
			'FINANCIAL_YEAR_ID_FK' =>'FINANCIAL YEAR'
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
		$criteria->compare('FEST_BAL',$this->FEST_BAL,true);
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
		$criteria->compare('GROSS',$this->GROSS);
		$criteria->compare('DED',$this->DED);
		$criteria->compare('NET',$this->NET);
		$criteria->compare('OTHER_DED',$this->OTHER_DED);
		$criteria->compare('AMOUNT_BANK',$this->AMOUNT_BANK);
		$criteria->compare('IS_FEST_RECOVERY',$this->IS_FEST_RECOVERY);
		$criteria->compare('IS_HBA_RECOVERY',$this->IS_HBA_RECOVERY);
		$criteria->compare('IS_MCA_RECOVERY',$this->IS_MCA_RECOVERY);
		$criteria->compare('IS_FLOOD_RECOVERY',$this->IS_FLOOD_RECOVERY);
		$criteria->compare('IS_CYCLE_RECOVERY',$this->IS_CYCLE_RECOVERY);
		$criteria->compare('IS_COMP_RECOVERY',$this->IS_COMP_RECOVERY);
		$criteria->compare('MAINT_MADIWALA',$this->MAINT_MADIWALA);
		$criteria->compare('MAINT_JAYAMAHAL',$this->MAINT_JAYAMAHAL);
		$criteria->compare('COURT_ATTACHMENT',$this->COURT_ATTACHMENT,true);
		$criteria->compare('EL_ENCASHMENT',$this->EL_ENCASHMENT,true);
		$criteria->compare('FINANCIAL_YEAR_ID_FK',$this->FINANCIAL_YEAR_ID_FK,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return SupplementarySalaryDetails the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}

<?php

/**
 * This is the model class for table "tbl_employee".
 *
 * The followings are the available columns in table 'tbl_employee':
 * @property string $ID
 * @property string $NAME
 * @property string $JOIN_DATE
 * @property string $DESIGNATION_ID_FK
 * @property string $GRADE_PAY_ID_FK
 * @property string $DOI
 * @property string $PENSION_ACC_NO
 * @property string $FOLIO_NO
 * @property string $GROUP_ID_FK
 * @property string $RELIEF_DATE
 * @property string $DOB
 * @property string $NAME_HINDI
 *
 * The followings are the available model relations:
 * @property TblDesignations $dESIGNATIONIDFK
 * @property TblPaybands $gRADEPAYIDFK
 * @property TblGroups $gROUPIDFK
 * @property TblEmployeeBankAccount[] $tblEmployeeBankAccounts
 * @property TblMaster[] $tblMasters
 * @property TblMaster[] $tblMasters1
 * @property TblSalaryDetails[] $tblSalaryDetails
 */
class Employee extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_employee';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('NAME, DESIGNATION_ID_FK, GRADE_PAY_ID_FK, PAY_MATRIX_ID_FK, PENSION_ACC_NO, GROUP_ID_FK, NAME_HINDI, PERMISSION', 'required'),
			array('NAME, NAME_HINDI', 'length', 'max'=>100),
			array('LPC_REMARKS', 'length', 'max'=>10000),
			array('DESIGNATION_ID_FK, GRADE_PAY_ID_FK, PAY_MATRIX_ID_FK, GROUP_ID_FK, JOIN_DESIGNATION_ID_FK, POSTING_ID_FK', 'length', 'max'=>10),
			array('IS_SUSPENDED, IS_PERMANENT, STATUS, IS_TRANSFERRED, IS_RETIRED', 'length', 'max'=>3),
			array('PENSION_ACC_NO, PENSION_TYPE, MICR, ACCOUNT_NO, IFSC, PAN, CATEGORY, GENDER, ORG_JOIN_TIME, DEPT_RELIEF_TIME, DEPT_JOIN_TIME, PERMISSION, SERVICE_BOOK_VOL', 'length', 'max'=>45),
			array('DEPT_JOIN_DATE, DEPT_RELIEF_DATE, ORG_JOIN_DATE, PRESENT_PROMOTION_DATE', 'date', 'format'=>'yyyy-MM-dd', 'allowEmpty'=>true),
			array('DEPT_JOIN_DATE, DEPT_RELIEF_DATE, ORG_JOIN_DATE', 'default', 'setOnEmpty'=>true, 'value'=>'' ),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('ID, NAME, DEPT_JOIN_DATE, DEPT_RELIEF_DATE, ORG_JOIN_DATE, ORG_RETIRE_DATE, LPC_REMARKS, DESIGNATION_ID_FK, GRADE_PAY_ID_FK, PAY_MATRIX_ID_FK, DOI, PENSION_ACC_NO, FOLIO_NO, GROUP_ID_FK, DOB, NAME_HINDI, 
			PENSION_TYPE, MICR, ACCOUNT_NO, IFSC, PAN, IS_PERMANENT, STATUS, CATEGORY, IS_TRANSFERRED, IS_RETIRED, POSTING_ID_FK, GENDER, PERMISSION, SUSPENSION_ORDER, SUSPENSION_DATE', 'safe', 'on'=>'search'),
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
			'dESIGNATIONIDFK' => array(self::BELONGS_TO, 'TblDesignations', 'DESIGNATION_ID_FK'),
			'gRADEPAYIDFK' => array(self::BELONGS_TO, 'TblPaybands', 'GRADE_PAY_ID_FK'),
			'gROUPIDFK' => array(self::BELONGS_TO, 'TblGroups', 'GROUP_ID_FK'),
			'tblEmployeeBankAccounts' => array(self::HAS_MANY, 'TblEmployeeBankAccount', 'EMPLOYEE_ID_FK'),
			'tblMasters' => array(self::HAS_MANY, 'TblMaster', 'DEPT_HEAD_EMPLOYEE'),
			'tblMasters1' => array(self::HAS_MANY, 'TblMaster', 'DEPT_ADMIN_EMPLOYEE'),
			'tblSalaryDetails' => array(self::HAS_MANY, 'TblSalaryDetails', 'EMPLOYEE_ID_FK'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ID' => 'ID',
			'NAME' => 'Name',
			'DESIGNATION_ID_FK' => 'Designation',
			'GRADE_PAY_ID_FK' => 'Grade Pay',
			'PAY_MATRIX_ID_FK' => 'Pay Matrix',
			'DOI' => 'DOI',
			'PENSION_ACC_NO' => 'Pension Account No',
			'FOLIO_NO' => 'Folio No',
			'GROUP_ID_FK' => 'Group',
			'DOB' => 'DOB',
			'NAME_HINDI' => 'Name Hindi',
			'PENSION_TYPE'=>'PENSION TYPE',
			'MICR'=>'MICR',
			'ACCOUNT_NO'=>'ACCOUNT NO',
			'IFSC'=>'IFSC',
			'PAN'=>'PAN',
			'DEPT_RELIEF_DATE'=>'Commissionerate Relief Date',
			'DEPT_JOIN_DATE'=>'Commissionerate Joining Date', 
			'ORG_JOIN_DATE'=>'CBEC Joining Date', 
			'ORG_RETIRE_DATE'=>'CBEC Retire Date', 
			'IS_PERMANENT'=>'Permanent', 
			'STATUS'=>'Status', 
			'CATEGORY'=>'Category',
			'TRANSFERED_TO'=>'Transfered To',
			'TRANSFER_ORDER'=>'Transfer Order',
			'JOIN_DESIGNATION_ID_FK'=>'Joined Designation',
			'PRESENT_PROMOTION_DATE'=>'Present Designation Promotion Date',
			'GENDER'=>'Gender',
			'IS_TRANSFERRED'=>'Transfered',
			'IS_RETIRED'=>'Retired',
			'ORG_JOIN_TIME'=>'CBEC Joining Time', 
			'DEPT_RELIEF_TIME'=>'Commissionerate Relief Time', 
			'DEPT_JOIN_TIME'=>'Commissionerate Joining Time',
			'PERMISSION'=>'Permission',
			'SERVICE_BOOK_VOL'=>'Service Book Volumn',
			'UA_ELIGIBLE'=>'Elligible for Uniform Allowance',
			'BONUS_ELIGIBLE'=>'Elligible for Bonus',
			'IS_SUSPENDED'=>'Supended',
			'SUSPENSION_ORDER'=>'Suspend/Revoke Order No.',
			'SUSPENSION_DATE'=>'Suspend/Revoke Date',
			'POSTING_ID_FK'=>'Place of Posting',
			'LPC_REMARKS'=>'LPC REMARKS'
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
		$criteria->compare('NAME',$this->NAME,true);
		$criteria->compare('DESIGNATION_ID_FK',$this->DESIGNATION_ID_FK,true);
		$criteria->compare('GRADE_PAY_ID_FK',$this->GRADE_PAY_ID_FK,true);
		$criteria->compare('PAY_MATRIX_ID_FK',$this->PAY_MATRIX_ID_FK,true);
		$criteria->compare('DOI',$this->DOI,true);
		$criteria->compare('PENSION_ACC_NO',$this->PENSION_ACC_NO,true);
		$criteria->compare('FOLIO_NO',$this->FOLIO_NO,true);
		$criteria->compare('GROUP_ID_FK',$this->GROUP_ID_FK,true);
		$criteria->compare('DOB',$this->DOB,true);
		$criteria->compare('NAME_HINDI',$this->NAME_HINDI,true);
		$criteria->compare('PENSION_TYPE',$this->PENSION_TYPE,true);
		$criteria->compare('MICR',$this->MICR,true);
		$criteria->compare('ACCOUNT_NO',$this->ACCOUNT_NO,true);
		$criteria->compare('IFSC',$this->IFSC,true);
		$criteria->compare('PAN',$this->PAN,true);
		$criteria->compare('DEPT_JOIN_DATE',$this->DEPT_JOIN_DATE,true);
		$criteria->compare('DEPT_RELIEF_DATE',$this->DEPT_RELIEF_DATE,true);
		$criteria->compare('ORG_JOIN_DATE',$this->ORG_JOIN_DATE,true);
		$criteria->compare('ORG_RETIRE_DATE',$this->ORG_RETIRE_DATE,true);
		$criteria->compare('IS_PERMANENT',$this->IS_PERMANENT,true);
		$criteria->compare('STATUS',$this->STATUS,true);
		$criteria->compare('CATEGORY',$this->CATEGORY,true);
		$criteria->compare('TRANSFERED_TO',$this->TRANSFERED_TO,true);
		$criteria->compare('TRANSFER_ORDER',$this->TRANSFER_ORDER,true);
		$criteria->compare('JOIN_DESIGNATION_ID_FK',$this->JOIN_DESIGNATION_ID_FK,true);
		$criteria->compare('PRESENT_PROMOTION_DATE',$this->PRESENT_PROMOTION_DATE,true);
		$criteria->compare('GENDER',$this->GENDER,true);
		$criteria->compare('IS_TRANSFERRED',$this->IS_TRANSFERRED,true);
		$criteria->compare('IS_RETIRED',$this->IS_RETIRED,true);
		$criteria->compare('ORG_JOIN_TIME',$this->ORG_JOIN_TIME,true);
		$criteria->compare('DEPT_RELIEF_TIME',$this->DEPT_RELIEF_TIME,true);
		$criteria->compare('DEPT_JOIN_TIME',$this->DEPT_JOIN_TIME,true);
		$criteria->compare('PERMISSION',$this->PERMISSION,true);
		$criteria->compare('SERVICE_BOOK_VOL',$this->SERVICE_BOOK_VOL,true);
		$criteria->compare('IS_SUSPENDED',$this->IS_SUSPENDED,true);
		$criteria->compare('SUSPENSION_ORDER',$this->SUSPENSION_ORDER,true);
		$criteria->compare('SUSPENSION_DATE',$this->SUSPENSION_DATE,true);
		$criteria->compare('POSTING_ID_FK',$this->POSTING_ID_FK,true);
		$criteria->compare('LPC_REMARKS',$this->LPC_REMARKS,true);
		
		$criteria->order = 'DESIGNATION_ID_FK DESC';
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination'=>false, 
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Employee the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}

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
 * @property string $NEXT_INCREMENT_DATE
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
	
	public function beforeSave() {
		/*
		if ($this->isNewRecord) {
			$this->insertDate = new CDbExpression('NOW()');
		} else {
			$this->updateDate = new CDbExpression('NOW()');
		}
		*/

		$this->GOVT_SERVICE_ENTRY_DATE = (bool)strtotime($this->GOVT_SERVICE_ENTRY_DATE) ? $this->GOVT_SERVICE_ENTRY_DATE : NULL;
		$this->CONTROLLER_JOIN_DATE = (bool)strtotime($this->CONTROLLER_JOIN_DATE) ? $this->CONTROLLER_JOIN_DATE : NULL;
		$this->CURRENT_OFFICE_JOIN_DATE = (bool)strtotime($this->CURRENT_OFFICE_JOIN_DATE) ? $this->CURRENT_OFFICE_JOIN_DATE : NULL;
		$this->CURRENT_POST_JOIN_DATE = (bool)strtotime($this->CURRENT_POST_JOIN_DATE) ? $this->CURRENT_POST_JOIN_DATE : NULL;
		$this->CURRENT_OFFICE_RELIEF_DATE = (bool)strtotime($this->CURRENT_OFFICE_RELIEF_DATE) ? $this->CURRENT_OFFICE_RELIEF_DATE : NULL;
		$this->CONTROLLER_RELIEF_DATE = (bool)strtotime($this->CONTROLLER_RELIEF_DATE) ? $this->CONTROLLER_RELIEF_DATE : NULL;
		$this->GOVT_SERVICE_EXIT_DATE = (bool)strtotime($this->GOVT_SERVICE_EXIT_DATE) ? $this->GOVT_SERVICE_EXIT_DATE : NULL;
		$this->NEXT_INCREMENT_DATE = (bool)strtotime($this->NEXT_INCREMENT_DATE) ? $this->NEXT_INCREMENT_DATE : NULL;
		$this->PAY_WEF_DATE = (bool)strtotime($this->PAY_WEF_DATE) ? $this->PAY_WEF_DATE : NULL;
		$this->DOB = (bool)strtotime($this->DOB) ? $this->DOB : NULL;
		$this->CGEGIS_MEMBER_DATE = (bool)strtotime($this->CGEGIS_MEMBER_DATE) ? $this->CGEGIS_MEMBER_DATE : NULL;
			
		return parent::beforeSave();
		
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('NAME, SALUTATION_CODE, FIRST_NAME, MIDDLE_NAME, LAST_NAME, DESIGNATION_ID_FK, GRADE_PAY_ID_FK, PAY_MATRIX_ID_FK, PENSION_ACC_NO, GROUP_ID_FK, 
			NAME_HINDI, PERMISSION, HRA_SLAB_ID_FK, IS_QUARTER_ALLOCATED, CITY_CLASS_CODE, EMPLOYEE_CODE, EMPLOYEE_NAME_AND_CODE, POSTING_MODE_CODE, PAY_COMMISSION, 
			FOLIO_NO', 'required'),
			array('NAME, NAME_HINDI, FIRST_NAME, MIDDLE_NAME, LAST_NAME, EMPLOYEE_CODE, EMPLOYEE_NAME_AND_CODE, AADHAR_NO, EMAIL_ID', 'length', 'max'=>100),
			array('LPC_REMARKS', 'length', 'max'=>10000),
			array('SALUTATION_CODE, DESIGNATION_ID_FK, GRADE_PAY_ID_FK, PAY_MATRIX_ID_FK, GROUP_ID_FK, JOIN_DESIGNATION_ID_FK, POSTING_ID_FK, HRA_SLAB_ID_FK,
			GPF_SUBSCRIPTION', 'length', 'max'=>10),
			array('IS_SUSPENDED, IS_PERMANENT, STATUS, IS_TRANSFERRED, IS_RETIRED, IS_QUARTER_ALLOCATED, IS_CGHS_CARD_HOLDER, IS_EX_SERVICE', 'length', 'max'=>3),
			array('PENSION_ACC_NO, PENSION_TYPE, MICR, ACCOUNT_NO, IFSC, PAN, CATEGORY, GENDER, 
			GOVT_SERVICE_ENTRY_TIME, CONTROLLER_JOIN_TIME, CURRENT_OFFICE_JOIN_TIME, CURRENT_POST_JOIN_TIME, CURRENT_OFFICE_RELIEF_TIME, CONTROLLER_RELIEF_TIME,
			PERMISSION, SERVICE_BOOK_VOL, CITY_CLASS_CODE, CGEGIS_APPLICABLE_CODE, CGEGIS_GROUP_CODE, CGHS_CARD_NO ,EMPLOYEE_CODE_BY_EMPLOYER, MOBILE_NO', 'length', 'max'=>45),
			array('GOVT_SERVICE_ENTRY_DATE, CONTROLLER_JOIN_DATE, CURRENT_OFFICE_JOIN_DATE, CURRENT_POST_JOIN_DATE, CURRENT_OFFICE_RELIEF_DATE, CONTROLLER_RELIEF_DATE,
			GOVT_SERVICE_EXIT_DATE, CGEGIS_MEMBER_DATE', 'date', 'format'=>'yyyy-MM-dd', 'allowEmpty'=>true),
			array('CURRENT_OFFICE_JOIN_DATE, CURRENT_OFFICE_RELIEF_DATE, CONTROLLER_JOIN_DATE, CURRENT_POST_JOIN_DATE, GOVT_SERVICE_ENTRY_DATE, CONTROLLER_RELIEF_DATE,
			GOVT_SERVICE_EXIT_DATE, CGEGIS_MEMBER_DATE', 'default', 'setOnEmpty'=>true, 'value'=>'' ),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('ID, NAME, FIRST_NAME, MIDDLE_NAME, LAST_NAME, SALUTATION_CODE, HRA_SLAB_ID_FK, IS_QUARTER_ALLOCATED, 
			LPC_REMARKS, DESIGNATION_ID_FK, GRADE_PAY_ID_FK, PAY_MATRIX_ID_FK, NEXT_INCREMENT_DATE, PENSION_ACC_NO, FOLIO_NO, GROUP_ID_FK, DOB, NAME_HINDI, 
			PENSION_TYPE, MICR, ACCOUNT_NO, IFSC, PAN, IS_PERMANENT, STATUS, CATEGORY, IS_TRANSFERRED, IS_RETIRED, POSTING_ID_FK, GENDER, PERMISSION, SUSPENSION_ORDER, 
			SUSPENSION_DATE, EMPLOYEE_CODE, EMPLOYEE_NAME_AND_CODE, POSTING_MODE_CODE, PAY_COMMISSION, CGEGIS_APPLICABLE_CODE, CGEGIS_GROUP_CODE,
			CGHS_CARD_NO ,EMPLOYEE_CODE_BY_EMPLOYER, MOBILE_NO, AADHAR_NO, EMAIL_ID, IS_CGHS_CARD_HOLDER, IS_EX_SERVICE, GPF_SUBSCRIPTION', 'safe', 'on'=>'search'),
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
			'FIRST_NAME' => 'First Name',
			'MIDDLE_NAME' => 'Middle Name',
			'LAST_NAME' => 'Last Name',
			'SALUTATION_CODE' => 'Salutation',
			'DESIGNATION_ID_FK' => 'Designation',
			'GRADE_PAY_ID_FK' => 'Grade Pay',
			'PAY_MATRIX_ID_FK' => 'Pay Matrix',
			'NEXT_INCREMENT_DATE' => 'Next Increment Date',
			'PAY_WEF_DATE'=>'Pay W.E.F. Date',
			'PENSION_ACC_NO' => 'GPF/PRAN Number',
			'FOLIO_NO' => 'Folio No',
			'GROUP_ID_FK' => 'Group',
			'DOB' => 'DOB',
			'NAME_HINDI' => 'Name Hindi',
			'PENSION_TYPE'=>'PENSION TYPE',
			'MICR'=>'MICR',
			'ACCOUNT_NO'=>'ACCOUNT NO',
			'IFSC'=>'IFSC',
			'PAN'=>'PAN',
			'CURRENT_OFFICE_RELIEF_DATE'=>'Current Office Relief Date',
			'CURRENT_OFFICE_JOIN_DATE'=>'Current Office Joining Date', 
			'CONTROLLER_JOIN_DATE'=>'Controller Joining Date', 
			'IS_PERMANENT'=>'Permanent', 
			'STATUS'=>'Status', 
			'CATEGORY'=>'Category',
			'TRANSFERED_TO'=>'Transfered To',
			'TRANSFER_ORDER'=>'Transfer Order',
			'JOIN_DESIGNATION_ID_FK'=>'Joined Designation',
			'CURRENT_POST_JOIN_DATE'=>'Current Post Joining Date',
			'GENDER'=>'Gender',
			'IS_TRANSFERRED'=>'Transfered',
			'IS_RETIRED'=>'Retired',
			'CONTROLLER_JOIN_TIME'=>'Controller Joining Time', 
			'CURRENT_OFFICE_RELIEF_TIME'=>'Current Office Relief Time', 
			'CURRENT_OFFICE_JOIN_TIME'=>'Current Office Joining Time',
			'PERMISSION'=>'Permission',
			'SERVICE_BOOK_VOL'=>'Service Book Volumn',
			'UA_ELIGIBLE'=>'Elligible for Uniform Allowance',
			'BONUS_ELIGIBLE'=>'Elligible for Bonus',
			'IS_SUSPENDED'=>'Supended',
			'SUSPENSION_ORDER'=>'Suspend/Revoke Order No.',
			'SUSPENSION_DATE'=>'Suspend/Revoke Date',
			'POSTING_ID_FK'=>'Place of Posting',
			'LPC_REMARKS'=>'LPC REMARKS',
			'HRA_SLAB_ID_FK'=>'HRA SLAB',
			'IS_QUARTER_ALLOCATED'=>'Quarter Allocated',
			'GOVT_SERVICE_ENTRY_DATE'=>'Govt. Service Entry Date',
			'GOVT_SERVICE_ENTRY_TIME'=>'Govt. Service Entry Time',
			'CURRENT_POST_JOIN_TIME'=>'Current Post Joining Date',
			'CONTROLLER_RELIEF_DATE'=>'Controller Relief Date',
			'CONTROLLER_RELIEF_TIME'=>'Controller Relief Time',
			'GOVT_SERVICE_EXIT_DATE'=>'Govt. Service Exit Date',
			'CITY_CLASS_CODE'=>'City Class',
			'EMPLOYEE_CODE'=>'Employee Code',
			'EMPLOYEE_NAME_AND_CODE'=>'Employee Name & Code',
			'POSTING_MODE_CODE'=>'Posting Mode Code',
			'PAY_COMMISSION'=>'Pay Commission',
			'CGEGIS_APPLICABLE_CODE'=>'CGEGIS Applicable Code', 
			'CGEGIS_GROUP_CODE'=>'CGEGIS Group Code',
			'CGHS_CARD_NO'=>'CGHS Card No.', 
			'EMPLOYEE_CODE_BY_EMPLOYER'=>'Employee Code (By Employer )', 
			'MOBILE_NO'=>'Mobile No', 
			'AADHAR_NO'=>'Aadhar No', 
			'EMAIL_ID'=>'Email ID', 
			'IS_CGHS_CARD_HOLDER'=>'CGHS Card Holder', 
			'IS_EX_SERVICE'=>'Ex Serviceman', 
			'CGEGIS_MEMBER_DATE'=>'CGEGIS Membership Date',
			'GPF_SUBSCRIPTION'=>'GPF SUBSCRIPTION'
			
		);
	}
	
	public function scopes() {
		return array(
			'ByDesignation' => array('order' => 'DESIGNATION_ID_FK DESC'),
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
		$criteria->compare('FIRST_NAME',$this->FIRST_NAME,true);
		$criteria->compare('MIDDLE_NAME',$this->MIDDLE_NAME,true);
		$criteria->compare('LAST_NAME',$this->LAST_NAME,true);
		$criteria->compare('SALUTATION_CODE',$this->SALUTATION_CODE,true);
		$criteria->compare('DESIGNATION_ID_FK',$this->DESIGNATION_ID_FK,true);
		$criteria->compare('GRADE_PAY_ID_FK',$this->GRADE_PAY_ID_FK,true);
		$criteria->compare('PAY_MATRIX_ID_FK',$this->PAY_MATRIX_ID_FK,true);
		$criteria->compare('NEXT_INCREMENT_DATE',$this->NEXT_INCREMENT_DATE,true);
		$criteria->compare('PAY_WEF_DATE',$this->PAY_WEF_DATE,true);
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
		$criteria->compare('CURRENT_OFFICE_JOIN_DATE',$this->CURRENT_OFFICE_JOIN_DATE,true);
		$criteria->compare('CURRENT_OFFICE_RELIEF_DATE',$this->CURRENT_OFFICE_RELIEF_DATE,true);
		$criteria->compare('CONTROLLER_JOIN_DATE',$this->CONTROLLER_JOIN_DATE,true);
		$criteria->compare('IS_PERMANENT',$this->IS_PERMANENT,true);
		$criteria->compare('STATUS',$this->STATUS,true);
		$criteria->compare('CATEGORY',$this->CATEGORY,true);
		$criteria->compare('TRANSFERED_TO',$this->TRANSFERED_TO,true);
		$criteria->compare('TRANSFER_ORDER',$this->TRANSFER_ORDER,true);
		$criteria->compare('JOIN_DESIGNATION_ID_FK',$this->JOIN_DESIGNATION_ID_FK,true);
		$criteria->compare('CURRENT_POST_JOIN_DATE',$this->CURRENT_POST_JOIN_DATE,true);
		$criteria->compare('GENDER',$this->GENDER,true);
		$criteria->compare('IS_TRANSFERRED',$this->IS_TRANSFERRED,true);
		$criteria->compare('IS_RETIRED',$this->IS_RETIRED,true);
		$criteria->compare('CONTROLLER_JOIN_TIME',$this->CONTROLLER_JOIN_TIME,true);
		$criteria->compare('CURRENT_OFFICE_RELIEF_TIME',$this->CURRENT_OFFICE_RELIEF_TIME,true);
		$criteria->compare('CURRENT_OFFICE_JOIN_TIME',$this->CURRENT_OFFICE_JOIN_TIME,true);
		$criteria->compare('PERMISSION',$this->PERMISSION,true);
		$criteria->compare('SERVICE_BOOK_VOL',$this->SERVICE_BOOK_VOL,true);
		$criteria->compare('IS_SUSPENDED',$this->IS_SUSPENDED,true);
		$criteria->compare('SUSPENSION_ORDER',$this->SUSPENSION_ORDER,true);
		$criteria->compare('SUSPENSION_DATE',$this->SUSPENSION_DATE,true);
		$criteria->compare('POSTING_ID_FK',$this->POSTING_ID_FK,true);
		$criteria->compare('LPC_REMARKS',$this->LPC_REMARKS,true);
		$criteria->compare('HRA_SLAB_ID_FK',$this->HRA_SLAB_ID_FK,true);
		$criteria->compare('IS_QUARTER_ALLOCATED',$this->IS_QUARTER_ALLOCATED,true);
		$criteria->compare('GOVT_SERVICE_ENTRY_DATE',$this->GOVT_SERVICE_ENTRY_DATE,true);
		$criteria->compare('GOVT_SERVICE_ENTRY_TIME',$this->GOVT_SERVICE_ENTRY_TIME,true);
		$criteria->compare('CONTROLLER_RELIEF_DATE',$this->CONTROLLER_RELIEF_DATE,true);
		$criteria->compare('CONTROLLER_RELIEF_TIME',$this->CONTROLLER_RELIEF_TIME,true);
		$criteria->compare('CITY_CLASS_CODE',$this->CITY_CLASS_CODE,true);
		$criteria->compare('EMPLOYEE_CODE',$this->EMPLOYEE_CODE,true);
		$criteria->compare('EMPLOYEE_NAME_AND_CODE',$this->EMPLOYEE_CODE,true);
		$criteria->compare('POSTING_MODE_CODE',$this->POSTING_MODE_CODE,true);
		$criteria->compare('PAY_COMMISSION',$this->PAY_COMMISSION,true);
		$criteria->compare('CGEGIS_APPLICABLE_CODE',$this->CGEGIS_APPLICABLE_CODE,true);
		$criteria->compare('CGEGIS_GROUP_CODE',$this->CGEGIS_GROUP_CODE,true);
		$criteria->compare('CGHS_CARD_NO',$this->CGHS_CARD_NO,true);
		$criteria->compare('EMPLOYEE_CODE_BY_EMPLOYER',$this->EMPLOYEE_CODE_BY_EMPLOYER,true);
		$criteria->compare('MOBILE_NO',$this->MOBILE_NO,true);
		$criteria->compare('AADHAR_NO',$this->AADHAR_NO,true);
		$criteria->compare('EMAIL_ID',$this->EMAIL_ID,true);
		$criteria->compare('IS_CGHS_CARD_HOLDER',$this->IS_CGHS_CARD_HOLDER,true);
		$criteria->compare('IS_EX_SERVICE',$this->IS_EX_SERVICE,true);
		$criteria->compare('CGEGIS_MEMBER_DATE',$this->CGEGIS_MEMBER_DATE,true);
		$criteria->compare('GPF_SUBSCRIPTION',$this->GPF_SUBSCRIPTION,true);
		
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

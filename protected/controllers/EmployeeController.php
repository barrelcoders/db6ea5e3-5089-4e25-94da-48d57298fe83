<?php

class EmployeeController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/contentLayout';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view','create','update','admin','delete','Generic', 'generateTransferedLPC', 'GenerateRetiredLPC', 'LPC', 'LICPolicyChange', 'PLIPolicyStatusChange',
				'OPSSalaryBillEmployees', 'NPSSalaryBillEmployees', 'OtherBillEmployees', 'WagesBillEmployees'),
				'users'=>array('*'),
			),
		);
	}
	
	public function actionSetEmployeeMatrix(){
		if(isset($_POST['matrix']) && isset($_POST['emp_id'])){
			$model = Employee::model()->findByPK($_POST['emp_id']);
			$model->PAY_MATRIX_ID_FK = $_POST['matrix'];
			if($model->save(false)){
				echo "SUCCESS|".PayMatrix::model()->findByPK($_POST['matrix'])->TEXT;exit;
			}
			else{
				echo "ERROR";exit;
			}	
		}
	}
		
	public function actionSetPosting(){
		if(isset($_POST['posting']) && isset($_POST['emp_id'])){
			$model = Employee::model()->findByPK($_POST['emp_id']);
			$model->POSTING_ID_FK = $_POST['posting'];
			if($model->save(false)){
				echo "SUCCESS|".Posting::model()->findByPK($_POST['posting'])->PLACE;exit;
			}
			else{
				echo "ERROR";exit;
			}	
		}
	}
	public function actionSetFolio(){
		if(isset($_POST['folio']) && isset($_POST['emp_id'])){
			$model = Employee::model()->findByPK($_POST['emp_id']);
			$model->FOLIO_NO = $_POST['folio'];
			if($model->save(false)){
				echo "SUCCESS|".$model->FOLIO_NO;exit;
			}
			else{
				echo "ERROR";exit;
			}	
		}
	}
	
	
	public function actionView($id)
	{
		if(Yii::app()->User->EMPLOYEE_ID != $id && Yii::app()->User->TYPE !='ADMINISTRATION'){
			$this->redirect(Yii::app()->createUrl('Employee/view', array('id'=>Yii::app()->User->EMPLOYEE_ID)));
		}
		
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}
	
	public function actionOtherBillEmployees($BILL_ID){
		$OtherBillEmployeesIDs = explode(",", OtherBillEmployees::model()->findByAttributes(array('BILL_ID'=>$BILL_ID))->EMPLOYEE_ID);
		$result = array();
		foreach($OtherBillEmployeesIDs as $id){
			$employee = Employee::model()->findByPk($id);
			array_push($result, array('id'=>$employee->ID, 'value'=>$employee->ID, 'label'=>$employee->NAME));
		}
		echo json_encode($result);exit;
	}
	
	public function actionWagesBillEmployees($BILL_ID){
		$OtherBillEmployeesIDs = explode(",", OtherBillEmployees::model()->findByAttributes(array('BILL_ID'=>$BILL_ID))->EMPLOYEE_ID);
		$result = array();
		foreach($OtherBillEmployeesIDs as $id){
			$employee = Employee::model()->findByPk($id);
			array_push($result, array('id'=>$employee->ID, 'value'=>$employee->ID, 'label'=>$employee->NAME));
		}
		echo json_encode($result);exit;
	}
	
	public function actionOPSSalaryBillEmployees(){
		$employees = Employee::model()->findAllByAttributes(array('PENSION_TYPE'=>'OPS', 'IS_TRANSFERRED'=>0, 'IS_RETIRED'=>0, 'IS_PERMANENT'=>1, 'IS_SUSPENDED'=>0));
		$result = array();
		foreach($employees as $employee){
			array_push($result, array('id'=>$employee->ID, 'value'=>$employee->ID, 'label'=>$employee->NAME));
		}
		echo json_encode($result);exit;
	}
	
	public function actionNPSSalaryBillEmployees(){
		$employees = Employee::model()->findAllByAttributes(array('PENSION_TYPE'=>'NPS', 'IS_TRANSFERRED'=>0, 'IS_RETIRED'=>0, 'IS_PERMANENT'=>1, 'IS_SUSPENDED'=>0));
		$result = array();
		foreach($employees as $employee){
			array_push($result, array('id'=>$employee->ID, 'value'=>$employee->ID, 'label'=>$employee->NAME));
		}
		echo json_encode($result);exit;
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		//echo Yii::app()->Security->Encrypt("umang");exit;
		$model=new Employee;
		$licModel=new EmployeeLICPolicies;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		if(isset($_POST['Employee']))
		{
			//echo "<pre>";print_r($_POST);echo "</pre>";exit;
			$model->attributes=$_POST['Employee'];
			$model->DEPT_JOIN_DATE = ($_POST['Employee']['DEPT_JOIN_DATE'] != "") ? $_POST['Employee']['DEPT_JOIN_DATE'] : NULL;
			$model->DEPT_RELIEF_DATE = ($_POST['Employee']['DEPT_RELIEF_DATE'] != "") ? $_POST['Employee']['DEPT_RELIEF_DATE'] : NULL;
			$model->ORG_JOIN_DATE = ($_POST['Employee']['ORG_JOIN_DATE'] != "") ? $_POST['Employee']['ORG_JOIN_DATE'] : NULL;
			$model->ORG_RETIRE_DATE = ($_POST['Employee']['ORG_RETIRE_DATE'] != "") ? $_POST['Employee']['ORG_RETIRE_DATE'] : NULL;
			$model->PRESENT_PROMOTION_DATE = ($_POST['Employee']['PRESENT_PROMOTION_DATE'] != "") ? $_POST['Employee']['PRESENT_PROMOTION_DATE'] : NULL;
			$model->DOB = ($_POST['Employee']['DOB'] != "") ? $_POST['Employee']['DOB'] : NULL;
			$model->DOI = ($_POST['Employee']['DOI'] != "") ? $_POST['Employee']['DOI'] : NULL;
			
			if(!Employee::model()->exists("NAME='".$model->NAME."'")){
				if($model->save(false)){
					$lic_policies = $_POST['Employee']['LIC'];
					foreach($lic_policies as $policy){
						if($policy['POLICY_NO'] != ""){
							$EmployeeLICPolicies = new EmployeeLICPolicies;
							$EmployeeLICPolicies->EMPLOYEE_ID_FK = $model->ID;
							$EmployeeLICPolicies->POLICY_NO = $policy['POLICY_NO'];
							$EmployeeLICPolicies->AMOUNT = $policy['AMOUNT'];
							$EmployeeLICPolicies->STATUS = $policy['STATUS'];
							$EmployeeLICPolicies->save(false);
						}
					}
					
					$pli_policies = $_POST['Employee']['PLI'];
					foreach($pli_policies as $policy){
						if($policy['POLICY_NO'] != ""){
							$EmployeePLIPolicies = new EmployeePLIPolicies;
							$EmployeePLIPolicies->EMPLOYEE_ID_FK = $model->ID;
							$EmployeePLIPolicies->POLICY_NO = $policy['POLICY_NO'];
							$EmployeePLIPolicies->AMOUNT = $policy['AMOUNT'];
							$EmployeePLIPolicies->STATUS = $policy['STATUS'];
							$EmployeePLIPolicies->save(false);
						}
					}
					
					$Users = new Users;
					$array = explode(" ",$model->NAME);
					$username = strtolower($array[count($array)-1]);
					$Users->USERNAME = $username;
					$Users->PASSWORD = Yii::app()->Security->Encrypt($username);
					$Users->TYPE = $_POST['Employee']['PERMISSION'];
					$Users->EMPLOYEE_ID = $model->ID;
					$Users->save(false);
					echo "<script type='text/javascript'>alert('".$model->NAME.", ".Designations::model()->findByPk($model->DESIGNATION_ID_FK)->DESIGNATION." details added Successfully');</script>";
					//$this->redirect(array('create'));
				}
			}
			else{
				echo "<script type='text/javascript'>alert('".$model->NAME.", ".Designations::model()->findByPk($model->DESIGNATION_ID_FK)->DESIGNATION." details already exists');</script>";
			}
		}

		$this->render('create',array(
			'model'=>$model,
			'licModel'=>$licModel,
		));
	}
	
	public function actionGenerateTransferedLPC(){
		$model=new Employee;
		
		if(isset($_POST['Employee']))
		{
			$model=$this->loadModel($_POST['Employee']['ID']);
			$model->IS_TRANSFERRED = 1;
			$model->DEPT_RELIEF_DATE = $_POST['Employee']['DEPT_RELIEF_DATE'] ? $_POST['Employee']['DEPT_RELIEF_DATE'] : NULL;
			$model->DEPT_RELIEF_TIME = $_POST['Employee']['DEPT_RELIEF_TIME'] ? $_POST['Employee']['DEPT_RELIEF_TIME'] : NULL;
			$model->TRANSFERED_TO = $_POST['Employee']['TRANSFERED_TO'];
			$model->TRANSFER_ORDER = $_POST['Employee']['TRANSFER_ORDER'];
			$model->LPC_REMARKS = $_POST['Employee']['LPC_REMARKS'];
			

			if($model->save(false)){
				echo "<script type='text/javascript'>alert('Employee relieved Successfully');</script>";
			}
		}
		$this->render('generateTransferedLPC',array(
			'model'=>$model,
		));
	}
	
	public function actionGenerateRetiredLPC(){
		$model=new Employee;
		
		if(isset($_POST['Employee']))
		{
			$model=$this->loadModel($_POST['Employee']['ID']);
			$model->IS_RETIRED = 1;
			$model->ORG_RETIRE_DATE = $_POST['Employee']['ORG_RETIRE_DATE'] ? $_POST['Employee']['ORG_RETIRE_DATE'] : NULL;
			$model->LPC_REMARKS = $_POST['Employee']['LPC_REMARKS'];

			if($model->save(false)){
				echo "<script type='text/javascript'>alert('Employee retired Successfully');</script>";
			}
		}
		$this->render('generateRetiredLPC',array(
			'model'=>$model,
		));
	}
	
	
	public function actionSuspendEmployee(){
		$model=new Employee;
		
		if(isset($_POST['Employee']))
		{
			$model=$this->loadModel($_POST['Employee']['ID']);
			if($_POST['Employee']['ACTION'] == "SUSPEND"){
				if(Employee::model()->exists('IS_SUSPENDED=1 AND ID='.$model->ID)){
					echo "<script type='text/javascript'>alert('".$model->NAME.", ".Designations::model()->findByPK($model->DESIGNATION_ID_FK)->DESIGNATION." already suspended');</script>";
				}
				else{
					$model->IS_SUSPENDED = 1;
					$model->SUSPENSION_DATE = $_POST['Employee']['SUSPENSION_DATE'] ? $_POST['Employee']['SUSPENSION_DATE'] : NULL;
					$model->SUSPENSION_ORDER = $_POST['Employee']['SUSPENSION_ORDER'];
					if($model->save(false)){
						echo "<script type='text/javascript'>alert('".$model->NAME.", ".Designations::model()->findByPK($model->DESIGNATION_ID_FK)->DESIGNATION." suspended successfully');</script>";
					}
				}
			}
			else if($_POST['Employee']['ACTION'] == "REVOKE"){
				if(Employee::model()->exists('IS_SUSPENDED=0 AND ID='.$model->ID)){
					echo "<script type='text/javascript'>alert('".$model->NAME.", ".Designations::model()->findByPK($model->DESIGNATION_ID_FK)->DESIGNATION." suspension already revoked');</script>";
				}
				else{
					$model->IS_SUSPENDED = 0;
					$model->SUSPENSION_DATE = $_POST['Employee']['SUSPENSION_DATE'] ? $_POST['Employee']['SUSPENSION_DATE'] : NULL;
					$model->SUSPENSION_ORDER = $_POST['Employee']['SUSPENSION_ORDER'];
					if($model->save(false)){
						echo "<script type='text/javascript'>alert('".$model->NAME.", ".Designations::model()->findByPK($model->DESIGNATION_ID_FK)->DESIGNATION." suspension revoked successfully');</script>";
					}
				}
			}
		}
		$this->render('suspendEmployee',array(
			'model'=>$model,
		));
	}
	
	public function actionLPC_Transfered($id){
		$this->layout='//layouts/column1';
		$model=$this->loadModel($id);
		
		$this->render('LPC_Transfered',array(
			'model'=>$model,
		));
	}
	
	public function actionLPC_Retired($id){
		$this->layout='//layouts/column1';
		$model=$this->loadModel($id);
		
		$this->render('LPC_Retired',array(
			'model'=>$model,
		));
	}
	
	public function actionLPCCover($id){
		$this->layout='//layouts/column1';
		$model=$this->loadModel($id);
		
		$this->render('LPC_CoverLetter',array(
			'model'=>$model,
		));
	}

	public function actionChangePassword($id){
		$this->layout = '//layouts/contentLayout';
		$model=new Users;
		
		if(Yii::app()->User->EMPLOYEE_ID != $id){
			$this->redirect(Yii::app()->createUrl('Employee/changePassword', array('id'=>Yii::app()->User->EMPLOYEE_ID)));
		}
		
		if(isset($_POST['Users'])){
			if($_POST['Users']['PASSWORD'] == "" || $_POST['Users']['CONFIRM_PWD'] == "" ){
				echo "<script>alert('Please fill password & confirm password field.');</script>";
			}
			else if($_POST['Users']['PASSWORD'] != $_POST['Users']['CONFIRM_PWD']){
				echo "<script>alert('password & confirm password should match.');</script>";
			}
			else if($_POST['Users']['PASSWORD'] == Yii::app()->Security->Decrypt(Yii::app()->User->PASSWORD)){
				echo "<script>alert('current password and new password could not be same.');</script>";
			}
			else{
				$employee = Users::model()->find('EMPLOYEE_ID='.$id);
				$employee->PASSWORD = Yii::app()->Security->Encrypt($_POST['Users']['PASSWORD']);
				$employee->save(false);
				echo "<script>alert('Password changed successfully. Please sign-in again to continue.');</script>";
			}
		}
		
		$this->render('changePassword',array(
			'model'=>$model,
			'id'=>$id
		));
	}
	
	public function actionGeneric()
	{
		$model=new Employee;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Employee']))
		{
			$this->layout='';
			$this->render('genericReport',array(
				'list'=>$_POST['Employee']['Attributes'],
				'custom_1'=>$_POST['Employee']['Custom_attr_1'],
				'custom_2'=>$_POST['Employee']['Custom_attr_2'],
				'custom_3'=>$_POST['Employee']['Custom_attr_3'],
				'designations'=>isset($_POST['Employee']['Designations']) ? $_POST['Employee']['Designations'] : array(),
				'pension'=>isset($_POST['Employee']['PENSION']) ? $_POST['Employee']['PENSION'] : array(),
				'uniform'=>isset($_POST['Employee']['UA']) ? $_POST['Employee']['UA'] : array(),
				'bonus'=>isset($_POST['Employee']['BONUS']) ? $_POST['Employee']['BONUS'] : array(),
				'gender'=>isset($_POST['Employee']['GENDER']) ? $_POST['Employee']['GENDER'] : array(),
				'permanent'=>isset($_POST['Employee']['IS_PERMANENT']) ? $_POST['Employee']['IS_PERMANENT'] : array(),
				'transfered'=>isset($_POST['Employee']['IS_TRANSFERRED']) ? $_POST['Employee']['IS_TRANSFERRED'] : array(),
				'retired'=>isset($_POST['Employee']['IS_RETIRED']) ? $_POST['Employee']['IS_RETIRED'] : array(),
				'suspended'=>isset($_POST['Employee']['IS_SUSPENDED']) ? $_POST['Employee']['IS_SUSPENDED'] : array(),
				'quarter'=>isset($_POST['Employee']['QUARTER_ALLOCATE']) ? $_POST['Employee']['QUARTER_ALLOCATE'] : array(),
				'hra_slab'=>isset($_POST['Employee']['HRA_SLAB']) ? $_POST['Employee']['HRA_SLAB'] : array(),
			));
		}
		else{
		
			$this->render('generic',array(
				'model'=>$model,
			));	
			
		}
	}
	
	public function actionGenericSalaries()
	{
		$model=new Employee;
		$salaryModel=new SalaryDetails;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Employee']))
		{
			$this->layout='';
			$this->render('genericSalariesReport',array(
				'START_MONTH'=>isset($_POST['Employee']['START_MONTH']) ? $_POST['Employee']['START_MONTH'] : '',
				'END_MONTH'=>isset($_POST['Employee']['END_MONTH']) ? $_POST['Employee']['END_MONTH'] : '',
				'START_YEAR'=>isset($_POST['Employee']['START_YEAR']) ? $_POST['Employee']['START_YEAR'] : '',
				'END_YEAR'=>isset($_POST['Employee']['END_YEAR']) ? $_POST['Employee']['END_YEAR'] : '',
				'employee_ids'=>isset($_POST['Employee']['ID']) ? $_POST['Employee']['ID'] : array(),
				'designations'=>isset($_POST['Employee']['Designations']) ? $_POST['Employee']['Designations'] : array(),
				'pension'=>isset($_POST['Employee']['PENSION']) ? $_POST['Employee']['PENSION'] : array(),
				'uniform'=>isset($_POST['Employee']['UA']) ? $_POST['Employee']['UA'] : array(),
				'bonus'=>isset($_POST['Employee']['BONUS']) ? $_POST['Employee']['BONUS'] : array(),
				'gender'=>isset($_POST['Employee']['GENDER']) ? $_POST['Employee']['GENDER'] : array(),
				'permanent'=>isset($_POST['Employee']['IS_PERMANENT']) ? $_POST['Employee']['IS_PERMANENT'] : array(),
				'transfered'=>isset($_POST['Employee']['IS_TRANSFERRED']) ? $_POST['Employee']['IS_TRANSFERRED'] : array(),
				'retired'=>isset($_POST['Employee']['IS_RETIRED']) ? $_POST['Employee']['IS_RETIRED'] : array(),
				'suspended'=>isset($_POST['Employee']['IS_SUSPENDED']) ? $_POST['Employee']['IS_SUSPENDED'] : array(),
				'quarter'=>isset($_POST['Employee']['QUARTER_ALLOCATE']) ? $_POST['Employee']['QUARTER_ALLOCATE'] : array(),
				'hra_slab'=>isset($_POST['Employee']['HRA_SLAB']) ? $_POST['Employee']['HRA_SLAB'] : array(),
			));
		}
		else{
		
			$this->render('genericSalaries',array(
				'model'=>$model,
				'salaryModel'=>$salaryModel,
			));	
			
		}
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
	
			
		if(isset($_POST['Employee']))
		{
			//echo "<pre>";print_r($_POST);echo "</pre>";exit;/
			$model->attributes=$_POST['Employee'];
			$model->DEPT_JOIN_DATE = $_POST['Employee']['DEPT_JOIN_DATE'] ? $_POST['Employee']['DEPT_JOIN_DATE'] : NULL;
			$model->DEPT_RELIEF_DATE = $_POST['Employee']['DEPT_RELIEF_DATE'] ? $_POST['Employee']['DEPT_RELIEF_DATE'] : NULL;
			$model->ORG_JOIN_DATE = $_POST['Employee']['ORG_JOIN_DATE'] ? $_POST['Employee']['ORG_JOIN_DATE'] : NULL;
			$model->ORG_RETIRE_DATE = $_POST['Employee']['ORG_RETIRE_DATE'] ? $_POST['Employee']['ORG_RETIRE_DATE'] : NULL;
			$model->PRESENT_PROMOTION_DATE = $_POST['Employee']['PRESENT_PROMOTION_DATE'] ? $_POST['Employee']['PRESENT_PROMOTION_DATE'] : NULL;
			$model->DOB = $_POST['Employee']['DOB'] ? $_POST['Employee']['DOB'] : NULL;
			$model->DOI = $_POST['Employee']['DOI'] ? $_POST['Employee']['DOI'] : NULL;
			if($model->save(false)){
				$lic_policies = $_POST['Employee']['LIC'];
				foreach($lic_policies as $policy){
					if($policy['POLICY_NO'] != ""){
						$EmployeeLICPolicies = new EmployeeLICPolicies;
						$EmployeeLICPolicies->EMPLOYEE_ID_FK = $model->ID;
						$EmployeeLICPolicies->POLICY_NO = $policy['POLICY_NO'];
						$EmployeeLICPolicies->AMOUNT = $policy['AMOUNT'];
						$EmployeeLICPolicies->STATUS = $policy['STATUS'];
						$EmployeeLICPolicies->save(false);
					}
				}
				
				$pli_policies = $_POST['Employee']['PLI'];
				foreach($pli_policies as $policy){
					if($policy['POLICY_NO'] != ""){
						$EmployeePLIPolicies = new EmployeePLIPolicies;
						$EmployeePLIPolicies->EMPLOYEE_ID_FK = $model->ID;
						$EmployeePLIPolicies->POLICY_NO = $policy['POLICY_NO'];
						$EmployeePLIPolicies->AMOUNT = $policy['AMOUNT'];
						$EmployeePLIPolicies->STATUS = $policy['STATUS'];
						$EmployeePLIPolicies->save(false);
					}
				}
					
				echo "<script type='text/javascript'>alert('".$model->NAME.", ".Designations::model()->findByPk($model->DESIGNATION_ID_FK)->DESIGNATION." details updated Successfully');</script>";
				//$this->redirect(Yii::app()->createUrl('Employee/update', array('id'=>$id)));
			}
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	
	public function actionLICPolicyChange($id, $number, $amount, $status)
	{
		$EmployeeLICPolicies = EmployeeLICPolicies::model()->findByPk($id);
		$EmployeeLICPolicies->POLICY_NO = $number;
		$EmployeeLICPolicies->AMOUNT = $amount;
		$EmployeeLICPolicies->STATUS = $status;
		if($EmployeeLICPolicies->save(false)){
			echo "SUCCESS";exit;
		}
		else{
			echo "FAIL";exit;
		}
	}
	
	public function actionPLIPolicyChange($id, $number, $amount, $status)
	{
		$EmployeePLIPolicies = EmployeePLIPolicies::model()->findByPk($id);
		$EmployeePLIPolicies->POLICY_NO = $number;
		$EmployeePLIPolicies->AMOUNT = $amount;
		$EmployeePLIPolicies->STATUS = $status;
		if($EmployeePLIPolicies->save(false)){
			echo "SUCCESS";exit;
		}
		else{
			echo "FAIL";exit;
		}
	}
	public function actionDeleteLICPolicy($id)
	{
		$EmployeeLICPolicies = EmployeeLICPolicies::model()->findByPk($id);
		if($EmployeeLICPolicies->delete()){
			echo "SUCCESS";exit;
		}
		else{
			echo "FAIL";exit;
		}
	}
	public function actionDeletePLIPolicy($id)
	{
		$EmployeePLIPolicies = EmployeePLIPolicies::model()->findByPk($id);
		if($EmployeePLIPolicies->delete()){
			echo "SUCCESS";exit;
		}
		else{
			echo "FAIL";exit;
		}
	}
	
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Employee');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Employee('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Employee']))
			$model->attributes=$_GET['Employee'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Employee the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Employee::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Employee $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='employee-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}

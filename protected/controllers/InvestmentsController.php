<?php

class InvestmentsController extends Controller
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
				'actions'=>array('index','view', 'showInvestments', 'create','update', 'admin','delete'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array(),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array(),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}


	public function actionShowInvestments()
	{
		$model=new Investments;
		$this->render('showInvestments',array(
			'model'=>$model,
		));
	}	
	
	public function actionGetInvestments($fy, $emp_id){
		$investment=Investments::model()->find('FINANCIAL_YEAR_ID_FK='.FinancialYears::model()->find("NAME='".$fy."'")->ID.' AND EMPLOYEE_ID='.$emp_id);
		$investmentsArray = array();
		if($investment){
			array_push($investmentsArray, array(
				"HRA"=>$investment->HRA,
				"MEDICAL_INSURANCE"=>$investment->MEDICAL_INSURANCE,
				"DONATION"=>$investment->DONATION,
				"DISABILITY_MED_EXP"=>$investment->DISABILITY_MED_EXP,
				"EDU_LOAD_INT"=>$investment->EDU_LOAD_INT,
				"SELF_DISABILITY"=>$investment->SELF_DISABILITY,
				"HOME_LOAN_INT"=>$investment->HOME_LOAN_INT,
				"HOME_LOAD_EXCESS_2013_14"=>$investment->HOME_LOAD_EXCESS_2013_14,
				"INSURANCE_LIC_OTHER"=>$investment->INSURANCE_LIC_OTHER,
				"TUITION_FESS_EXEMPTION"=>$investment->TUITION_FESS_EXEMPTION,
				"PPF_NSC"=>$investment->PPF_NSC,
				"HOME_LOAD_PR"=>$investment->HOME_LOAD_PR,
				"PLI_ULIP"=>$investment->PLI_ULIP,
				"TERM_DEPOSIT_ABOVE_5"=>$investment->TERM_DEPOSIT_ABOVE_5,
				"MUTUAL_FUND"=>$investment->MUTUAL_FUND,
				"PENSION_FUND"=>$investment->PENSION_FUND,
				"CPF"=>$investment->CPF,
				"REGISTRY_STAMP"=>$investment->REGISTRY_STAMP,
				));
		}
		else{
			array_push($investmentsArray, array(
				"HRA"=>0,
				"MEDICAL_INSURANCE"=>0,
				"DONATION"=>0,
				"DISABILITY_MED_EXP"=>0,
				"EDU_LOAD_INT"=>0,
				"SELF_DISABILITY"=>0,
				"HOME_LOAN_INT"=>0,
				"HOME_LOAD_EXCESS_2013_14"=>0,
				"INSURANCE_LIC_OTHER"=>0,
				"TUITION_FESS_EXEMPTION"=>0,
				"PPF_NSC"=>0,
				"HOME_LOAD_PR"=>0,
				"PLI_ULIP"=>0,
				"TERM_DEPOSIT_ABOVE_5"=>0,
				"MUTUAL_FUND"=>0,
				"PENSION_FUND"=>0,
				"CPF"=>0,
				"REGISTRY_STAMP"=>0,
				));
		}
		echo json_encode($investmentsArray);exit;
	}
	
	public function actionSaveInvestments(){
		$model=new Investments;
		
		if(isset($_POST['Investments'])){
			$emp_id = $_POST['Investments']['EMPLOYEE_ID'];
			if($emp_id !=0){
				if(Investments::model()->exists('EMPLOYEE_ID='.$emp_id)){
					$investment = Investments::model()->find('EMPLOYEE_ID='.$emp_id.' AND FINANCIAL_YEAR_ID_FK='.FinancialYears::model()->find('IS_TRANSFERRED=0 AND IS_RETIRED=0')->ID);
					$investment->HRA =  $_POST['Investments']['HRA'];
					$investment->MEDICAL_INSURANCE = $_POST['Investments']['MEDICAL_INSURANCE'];
					$investment->DONATION = $_POST['Investments']['DONATION'];
					$investment->DISABILITY_MED_EXP = $_POST['Investments']['DISABILITY_MED_EXP'];
					$investment->EDU_LOAD_INT = $_POST['Investments']['EDU_LOAD_INT'];
					$investment->SELF_DISABILITY = $_POST['Investments']['SELF_DISABILITY'];
					$investment->HOME_LOAN_INT = $_POST['Investments']['HOME_LOAN_INT'];
					$investment->HOME_LOAD_EXCESS_2013_14 = $_POST['Investments']['HOME_LOAD_EXCESS_2013_14'];
					$investment->INSURANCE_LIC_OTHER = $_POST['Investments']['INSURANCE_LIC_OTHER'];
					$investment->TUITION_FESS_EXEMPTION = $_POST['Investments']['TUITION_FESS_EXEMPTION'];
					$investment->PPF_NSC = $_POST['Investments']['PPF_NSC'];
					$investment->HOME_LOAD_PR = $_POST['Investments']['HOME_LOAD_PR'];
					$investment->PLI_ULIP = $_POST['Investments']['PLI_ULIP'];
					$investment->TERM_DEPOSIT_ABOVE_5 = $_POST['Investments']['TERM_DEPOSIT_ABOVE_5'];
					$investment->MUTUAL_FUND = $_POST['Investments']['MUTUAL_FUND'];
					$investment->PENSION_FUND = $_POST['Investments']['PENSION_FUND'];
					$investment->CPF = $_POST['Investments']['CPF'];
					$investment->REGISTRY_STAMP = $_POST['Investments']['REGISTRY_STAMP'];
					$investment->save(false);
				}
				else{
					$investment = new Investments;
					$investment->HRA =  $_POST['Investments']['HRA'];
					$investment->MEDICAL_INSURANCE = $_POST['Investments']['MEDICAL_INSURANCE'];
					$investment->DONATION = $_POST['Investments']['DONATION'];
					$investment->DISABILITY_MED_EXP = $_POST['Investments']['DISABILITY_MED_EXP'];
					$investment->EDU_LOAD_INT = $_POST['Investments']['EDU_LOAD_INT'];
					$investment->SELF_DISABILITY = $_POST['Investments']['SELF_DISABILITY'];
					$investment->HOME_LOAN_INT = $_POST['Investments']['HOME_LOAN_INT'];
					$investment->HOME_LOAD_EXCESS_2013_14 = $_POST['Investments']['HOME_LOAD_EXCESS_2013_14'];
					$investment->INSURANCE_LIC_OTHER = $_POST['Investments']['INSURANCE_LIC_OTHER'];
					$investment->TUITION_FESS_EXEMPTION = $_POST['Investments']['TUITION_FESS_EXEMPTION'];
					$investment->PPF_NSC = $_POST['Investments']['PPF_NSC'];
					$investment->HOME_LOAD_PR = $_POST['Investments']['HOME_LOAD_PR'];
					$investment->PLI_ULIP = $_POST['Investments']['PLI_ULIP'];
					$investment->TERM_DEPOSIT_ABOVE_5 = $_POST['Investments']['TERM_DEPOSIT_ABOVE_5'];
					$investment->MUTUAL_FUND = $_POST['Investments']['MUTUAL_FUND'];
					$investment->PENSION_FUND = $_POST['Investments']['PENSION_FUND'];
					$investment->CPF = $_POST['Investments']['CPF'];
					$investment->REGISTRY_STAMP = $_POST['Investments']['REGISTRY_STAMP'];
					$investment->EMPLOYEE_ID = $_POST['Investments']['EMPLOYEE_ID'];
					$investment->FINANCIAL_YEAR_ID_FK = FinancialYears::model()->find('STATUS=1')->ID;
					$investment->save(false);
				}
				echo "<script>alert('Investments saved successfully for ".Employee::model()->findByPk($_POST['Investments']['EMPLOYEE_ID'])->NAME." for F.Y. ".FinancialYears::model()->find('STATUS=1')->NAME."');</script>";
			}
			else{
				echo "<script>alert('Please select employee');</script>";
			}
		}
		$this->render('showInvestments',array(
			'model'=>$model,
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Investments;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Investments']))
		{
			$model->attributes=$_POST['Investments'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->ID));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=Investments::model()->find('FINANCIAL_YEAR_ID_FK='.FinancialYears::model()->find("STATUS=1")->ID.' AND EMPLOYEE_ID='.$id);
		
		if(!$model){
			$model=new Investments;
		}
		
		if(isset($_GET['msg']) && $_GET['msg'] == 1){
			echo "<script>alert('Investment saved successfully');</script>";
		}
		
		if(isset($_POST['Investments']))
		{
			$model->attributes = $_POST['Investments'];
			$model->EMPLOYEE_ID = $id;
			$model->FINANCIAL_YEAR_ID_FK = FinancialYears::model()->find("STATUS=1")->ID;
			if($model->save(false)){
				$this->redirect(array('update','id'=>$id, 'msg'=>1));
			}
		}

		$this->render('update',array(
			'model'=>$model, 
			'id'=>$id
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
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
		$dataProvider=new CActiveDataProvider('Investments');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Investments('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Investments']))
			$model->attributes=$_GET['Investments'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Investments the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Investments::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Investments $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='investments-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}

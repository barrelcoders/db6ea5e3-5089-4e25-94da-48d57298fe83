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
		
		if(isset($_POST['Investment'])){
			$emp_id = $_POST['Investment']['Employee'][0];
			$this->redirect(array('Update','id'=>$emp_id));
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
		$financial_year = isset(Yii::app()->session['FINANCIAL_YEAR']) ? Yii::app()->session['FINANCIAL_YEAR'] : 
											FinancialYears::model()->find('STATUS=1')->ID;
		$model=Investments::model()->find('FINANCIAL_YEAR_ID_FK='.$financial_year.' AND EMPLOYEE_ID='.$id);
		
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
			$model->FINANCIAL_YEAR_ID_FK = isset(Yii::app()->session['FINANCIAL_YEAR']) ? Yii::app()->session['FINANCIAL_YEAR'] : 
											FinancialYears::model()->find('STATUS=1')->ID;
			if($model->save(false)){
				$arrears = $_POST['Employee']['ARREAR'];
				foreach($arrears as $arrear){
					if(!($arrear['BASIC'] == 0 && $arrear['PP_SP'] == 0 && $arrear['TA'] == 0 && $arrear['HRA'] == 0 &&
					$arrear['DA'] == 0 && $arrear['TOTAL'] == 0 && $arrear['CGEGIS'] == 0 && $arrear['CGHS'] == 0 &&
					$arrear['CPF'] == 0 && $arrear['PT'] == 0 && $arrear['IT'] == 0 && $arrear['PLI'] == 0 && 
					$arrear['LIC'] == 0)){
						$PreviousOfficePayArrears = new PreviousOfficePayArrears;
						$PreviousOfficePayArrears->EMPLOYEE_ID_FK = $id;
						$PreviousOfficePayArrears->MONTH = $arrear['MONTH'];
						$PreviousOfficePayArrears->YEAR = $arrear['YEAR'];
						$PreviousOfficePayArrears->BASIC = $arrear['BASIC'];
						$PreviousOfficePayArrears->PP_SP = $arrear['PP_SP'];
						$PreviousOfficePayArrears->TA = $arrear['TA'];
						$PreviousOfficePayArrears->HRA = $arrear['HRA'];
						$PreviousOfficePayArrears->DA = $arrear['DA'];
						$PreviousOfficePayArrears->TOTAL = $arrear['TOTAL'];
						$PreviousOfficePayArrears->CGEGIS = $arrear['CGEGIS'];
						$PreviousOfficePayArrears->CGHS = $arrear['CGHS'];
						$PreviousOfficePayArrears->CPF = $arrear['CPF'];
						$PreviousOfficePayArrears->PT = $arrear['PT'];
						$PreviousOfficePayArrears->IT = $arrear['IT'];
						$PreviousOfficePayArrears->PLI = $arrear['PLI'];
						$PreviousOfficePayArrears->LIC = $arrear['LIC'];
						$PreviousOfficePayArrears->save(false);
					}
				}
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

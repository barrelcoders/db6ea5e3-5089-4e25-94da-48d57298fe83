<?php

class AppropiationRegisterController extends Controller
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
				'actions'=>array('index','view','create','update','admin','delete'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array(),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array(),
				'users'=>array(),
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

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new AppropiationRegister;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['AppropiationRegister']))
		{
			$model->attributes=$_POST['AppropiationRegister'];
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
	public function actionUpdate()
	{
		$model=new AppropiationRegister;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['AppropiationRegister']))
		{
			$BUDGET_ID = $_POST['AppropiationRegister']['BUDGET_ID'];
			$AMOUNT = $_POST['AppropiationRegister']['AMOUNT'];
			$Appropiation = AppropiationRegister::model()->findAll(array(
				"condition" => "t.BUDGET_ID = $BUDGET_ID",
				"order" => "t.ID DESC",
				"limit" => 1,
			));
			if($_POST['AppropiationRegister']['OPERATION'] == "ADD"){
				$model->BILL_NO = 0;
				$model->BILL_AMOUNT = 0;
				$model->EXPENDITURE_INC_BILL = $Appropiation[0]->EXPENDITURE_INC_BILL;
				$model->BALANCE = $Appropiation[0]->BALANCE + $AMOUNT;
				$model->BUDGET_ID = $BUDGET_ID;
				$model->UPDATION_DATE = $_POST['AppropiationRegister']['UPDATION_DATE'];
				if($model->save(false)){
					$budgetModel = Budget::model()->findByPK($BUDGET_ID);
					$budgetModel->AMOUNT = $budgetModel->AMOUNT + $AMOUNT;
					$budgetModel->save(false);
				}
			}
			else if($_POST['AppropiationRegister']['OPERATION'] == "REMOVE"){
				$model->BILL_NO = 0;
				$model->BILL_AMOUNT = 0;
				$model->EXPENDITURE_INC_BILL = $Appropiation[0]->EXPENDITURE_INC_BILL;
				$model->BALANCE = $Appropiation[0]->BALANCE - $AMOUNT;
				$model->BUDGET_ID = $BUDGET_ID;
				$model->UPDATION_DATE = $_POST['AppropiationRegister']['UPDATION_DATE'];
				if($model->save(false)){
					$budgetModel = Budget::model()->findByPK($BUDGET_ID);
					$budgetModel->AMOUNT = $budgetModel->AMOUNT - $AMOUNT;
					$budgetModel->save(false);
				}
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
		$dataProvider=new CActiveDataProvider('AppropiationRegister');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new AppropiationRegister('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['AppropiationRegister']))
			$model->attributes=$_GET['AppropiationRegister'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return AppropiationRegister the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=AppropiationRegister::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param AppropiationRegister $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='appropiation-register-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}

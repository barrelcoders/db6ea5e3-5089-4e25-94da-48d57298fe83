<?php

class SupplementarySalaryDetailsController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2', $ID;

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
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
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

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new SupplementarySalaryDetails;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['SupplementarySalaryDetails']))
		{
			echo "<pre>";print_r($_POST['SupplementarySalaryDetails']);echo "</pre>";exit;
		
			$model->attributes=$_POST['SupplementarySalaryDetails'];
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
		$this->layout='//layouts/contentLayout';
		$model = new SupplementarySalaryDetails;
		$this->ID = $id;
		
		if(isset($_GET['msg']) && $_GET['msg'] == 1){
			echo "<script>alert('Salary saved successfully');</script>";
		}
		
		if(isset($_POST['SupplementarySalaryDetails']))
		{
			$records = $_POST['SupplementarySalaryDetails'];
			foreach($records as $key=>$value){
				$attributes = $_POST['SupplementarySalaryDetails'][$key];
				if(SupplementarySalaryDetails::model()->exists('MONTH='.$attributes['MONTH'].' AND EMPLOYEE_ID_FK='.$this->ID)){
					$salaryModel = SupplementarySalaryDetails::model()->find('MONTH='.$attributes['MONTH'].' AND EMPLOYEE_ID_FK='.$this->ID);
					$salaryModel->attributes = $attributes;
					$salaryModel->EMPLOYEE_ID_FK = $this->ID;
					$salaryModel->FINANCIAL_YEAR_ID_FK = FinancialYears::model()->find('STATUS=1')->ID;
					$salaryModel->save(false);
				}
				else{
					$salaryModel = new SupplementarySalaryDetails;
					$salaryModel->attributes = $attributes;
					$salaryModel->EMPLOYEE_ID_FK = $this->ID;
					$salaryModel->FINANCIAL_YEAR_ID_FK = FinancialYears::model()->find('STATUS=1')->ID;
					$salaryModel->save(false);
				}
			}
			
			$this->redirect(array('update','id'=>$this->ID, 'msg'=>1));
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
		$dataProvider=new CActiveDataProvider('SupplementarySalaryDetails');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new SupplementarySalaryDetails('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['SupplementarySalaryDetails']))
			$model->attributes=$_GET['SupplementarySalaryDetails'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return SupplementarySalaryDetails the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=SupplementarySalaryDetails::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param SupplementarySalaryDetails $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='supplementary-salary-details-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}

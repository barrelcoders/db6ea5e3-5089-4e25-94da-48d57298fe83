<?php

class PayBillTasksController extends Controller
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
			//'postOnly + delete', // we only allow deletion via POST request
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
		$model=new PayBillTasks;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['PayBillTasks']))
		{
			$start    = (new DateTime($_POST['PayBillTasks']['START_YEAR']."-".$_POST['PayBillTasks']['START_MONTH']."-01"));
			$end      = (new DateTime($_POST['PayBillTasks']['END_YEAR']."-".$_POST['PayBillTasks']['END_MONTH']."-01"));
			$interval = DateInterval::createFromDateString('1 month');
			$period   = new DatePeriod($start, $interval, $end);
			$PERIODS = array();
			foreach ($period as $dt) {
				array_push($PERIODS, array('MONTH'=>$dt->format("m"), 'YEAR'=>$dt->format("Y")));
			}
			array_push($PERIODS, array('MONTH'=>$_POST['PayBillTasks']['END_MONTH'], 'YEAR'=>$_POST['PayBillTasks']['END_YEAR']));
			
			foreach($PERIODS as $period){
				$model=new PayBillTasks;
				$month = $period['MONTH'];
				$year = $period['YEAR'];
				$model->MONTH = $month;
				$model->YEAR = $year;
				$model->TASK = $_POST['PayBillTasks']['TASK'];
				$model->EMPLOYEE_ID_FK = $_POST['PayBillTasks']['EMPLOYEE_ID_FK'];
				if($model->save(false)){
					echo "<script>alert('A task of ".Employee::model()->findByPk($_POST['PayBillTasks']['EMPLOYEE_ID_FK'])->NAME." for ".date('M-Y', strtotime($year.'-'.$month.'-01'))." saved successfully ');</script>";
				}
			}
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
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['PayBillTasks']))
		{
			$model->attributes=$_POST['PayBillTasks'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->ID));
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
		$dataProvider=new CActiveDataProvider('PayBillTasks');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new PayBillTasks('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['PayBillTasks']))
			$model->attributes=$_GET['PayBillTasks'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return PayBillTasks the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=PayBillTasks::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param PayBillTasks $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='pay-bill-tasks-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}

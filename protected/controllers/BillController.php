<?php

class BillController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/contentLayout', $amountInWords, $amountLessthanInWords, $Month, $Year, $ID, $list;

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
				'actions'=>array('index','view', 'GetSubType', 'create', 'update', 'admin','delete', 'OESanctionOrder', 'OEFVCBackPage', 'SalaryDetails',
				'FontSheetInnerFirst', 'FontSheetInnerLast', 'CGHS', 'ChangeStatus'),
				'users'=>array('*'),
			),
		);
	}
	public function actionPaySlipSelectEmployee($Month, $Year, $id)
	{
		$this->layout='//layouts/contentLayout';
		$model = $this->loadModel($id);
		$this->ID = $id;
		$this->Month = $Month;
		$this->Year = $Year;
		
		if(isset($_POST['Bill']['submit'])){
			$this->layout='//layouts/column1';
			$this->list = $_POST['Bill']['Employee'];
			$this->render('PAY/SelectedPaySlipDetail',array(
				'model'=>$model,
			));exit;
		}
		
		$this->render('PAY/SelectEmployeesForPaySlip',array(
			'model'=>$model,
		));
	}
	
	
	public function actionSelectedPaySlipDetail()
	{
		$model = $this->loadModel($this->ID);
		$this->render('PAY/SelectedPaySlipDetail',array(
			'model'=>$model,
		));
	}
	
	public function actionChangeStatus(){
		if(isset($_POST['status']) && isset($_POST['bill_id']) && isset($_POST['date'])){
			$model = Bill::model()->findByPK($_POST['bill_id']);
			$model->PFMS_STATUS = $_POST['status'];
			$model->PASSED_DATE = date('Y-m-d', strtotime($_POST['date']));
			if($model->save(false)){
				echo "SUCCESS";exit;
			}
			else{
				echo "ERROR";exit;
			}	
		}
	}
	
	public function actionGetSubType()
	{
		$data=BillSubType::model()->findAll('TYPE=:TYPE', array(':TYPE'=>(int) $_POST['Bill']['BILL_TYPE']));
 
		$data=CHtml::listData($data,'ID','SUB_TYPE');
		foreach($data as $value=>$name)
		{
			echo CHtml::tag('option',
					   array('value'=>$value),CHtml::encode($name),true);
		}
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
	
	public function actionOESanctionOrder($id)
	{
		$this->layout='//layouts/column1';
		$model = $this->loadModel($id);
		$this->amountInWords = $this->amountToWord($model->BILL_AMOUNT);
		$this->render('OE/SanctionOrder',array(
			'model'=>$model,
		));
	}
	
	
	public function actionOEFVCFrontPage($id)
	{
		$this->layout='//layouts/column1';
		$model = $this->loadModel($id);
		$this->amountInWords = $this->amountToWord($model->BILL_AMOUNT);
		$this->amountLessthanInWords = $this->amountToWord($model->BILL_AMOUNT + 1, true);
		$this->render('OE/FVCFrontPage',array(
			'model'=>$model,
		));
	}
	
	
	public function actionOEFVCBackPage($id)
	{
		$this->layout='//layouts/column1';
		$model = $this->loadModel($id);
		$this->amountInWords = $this->amountToWord($model->BILL_AMOUNT);
		$this->amountLessthanInWords = $this->amountToWord($model->BILL_AMOUNT + 1, true);
		$this->render('OE/FVCBackPage',array(
			'model'=>$model,
		));
	}
	
	public function actionPaySlipDetail($Month, $Year, $id)
	{
		$this->layout='//layouts/column1';
		$model = new Bill;
		$this->Month = $Month;
		$this->Year = $Year;
		$this->ID = $id;
		$this->render('PAY/PaySlipDetail',array(
			'model'=>$model,
		));
	}
	
	
	public function actionNillBillToMail($id)
	{
		$this->layout='//layouts/column1';
		$model = new Bill;
		$model = $this->loadModel($id);
		$this->render('PAY/NillBillToMail',array(
			'model'=>$model,
		));
	}
	
	
	public function actionSalaryDetails($id)
	{
		$model = $this->loadModel($id);
		//echo "<pre>";print_r($_POST['SalaryDetails']);echo "</pre>";exit;
		if(isset($_POST['SalaryDetails']['save']) && isset($_POST['SalaryDetails']) && isset($_POST['SalaryInfo'])){
			//echo "<pre>";print_r($_POST['SalaryDetails']);echo "</pre>";exit;
			$month = $_POST['SalaryInfo']['MONTH'];
			$year = $_POST['SalaryInfo']['YEAR'];
			$bill_id = $_POST['SalaryInfo']['BILL_ID'];
			$salaries = $_POST['SalaryDetails'];
			
			foreach($salaries as $salary){
				if(isset($salary['GROSS']) && isset($salary['NET']) && isset($salary['DED'])){
					$SalaryDetails = array();
					if(SalaryDetails::model()->exists('BILL_ID_FK='.$bill_id.' AND EMPLOYEE_ID_FK='.$salary['EMP_ID'])){
						$SalaryDetails = SalaryDetails::model()->findByAttributes(array('EMPLOYEE_ID_FK'=>$salary['EMP_ID'], 'BILL_ID_FK'=>$bill_id));
					}
					else{
						$SalaryDetails = new SalaryDetails;
					}
					$SalaryDetails->attributes = $salary;
					$SalaryDetails->EMPLOYEE_ID_FK = $salary['EMP_ID'];
					$SalaryDetails->BILL_ID_FK = $bill_id;
					$SalaryDetails->MONTH = $month;
					$SalaryDetails->YEAR = $year;
					$SalaryDetails->GROSS = $salary['GROSS'];
					$SalaryDetails->NET = $salary['NET'];
					$SalaryDetails->DED = $salary['DED'];
					$SalaryDetails->IS_SALARY_BILL = $_POST['SalaryDetails']['IS_SALARY_BILL'];
					$SalaryDetails->IS_HBA_RECOVERY = isset($salary['IS_HBA_RECOVERY']) ? $salary['IS_HBA_RECOVERY'] : 0;
					$SalaryDetails->IS_MCA_RECOVERY = isset($salary['IS_MCA_RECOVERY']) ? $salary['IS_MCA_RECOVERY'] : 0;
					$SalaryDetails->IS_FEST_RECOVERY = isset($salary['IS_FEST_RECOVERY']) ? $salary['IS_FEST_RECOVERY'] : 0;
					$SalaryDetails->IS_CYCLE_RECOVERY = isset($salary['IS_CYCLE_RECOVERY']) ? $salary['IS_CYCLE_RECOVERY'] : 0;
					$SalaryDetails->IS_FLOOD_RECOVERY = isset($salary['IS_FLOOD_RECOVERY']) ? $salary['IS_FLOOD_RECOVERY'] : 0;
					$SalaryDetails->IS_FAN_RECOVERY = isset($salary['IS_FAN_RECOVERY']) ? $salary['IS_FAN_RECOVERY'] : 0;
					if(isset($_POST['SalaryDetails'][$salary['EMP_ID']]['UA'])){
						$SalaryDetails->UA = $_POST['SalaryDetails'][$salary['EMP_ID']]['UA'];
					}
					if(isset($_POST['SalaryDetails'][$salary['EMP_ID']]['BONUS'])){
						$SalaryDetails->BONUS = $_POST['SalaryDetails'][$salary['EMP_ID']]['BONUS'];
					}
					
					if(isset($_POST['SalaryDetails'][$salary['EMP_ID']]['CEA'])){
						$SalaryDetails->CEA = $_POST['SalaryDetails'][$salary['EMP_ID']]['CEA'];
					}
					
					if(isset($_POST['SalaryDetails'][$salary['EMP_ID']]['LTC_HTC'])){
						$SalaryDetails->LTC_HTC_GROSS = isset($_POST['SalaryDetails'][$salary['EMP_ID']]['LTC_HTC_GROSS']) ? $_POST['SalaryDetails'][$salary['EMP_ID']]['LTC_HTC_GROSS'] : 0;
						$SalaryDetails->LTC_HTC_ADVANCE = isset($_POST['SalaryDetails'][$salary['EMP_ID']]['LTC_HTC_ADVANCE']) ? $_POST['SalaryDetails'][$salary['EMP_ID']]['LTC_HTC_ADVANCE'] : 0;
						$SalaryDetails->LTC_HTC = $_POST['SalaryDetails'][$salary['EMP_ID']]['LTC_HTC'];
					}
					
					$SalaryDetails->save(false);	
				}
			}
			
			$this->redirect(array('SalaryDetails','id'=> $bill_id));
		}
		
		if(isset($_POST['SalaryDetails']['submit']) && isset($_POST['SalaryDetails']) && isset($_POST['SalaryInfo'])){
			$month = $_POST['SalaryInfo']['MONTH'];
			$year = $_POST['SalaryInfo']['YEAR'];
			$bill_id = $_POST['SalaryInfo']['BILL_ID'];
			$salaries = $_POST['SalaryDetails'];
			if(Bill::model()->findByPK(SalaryDetails::model()->find('BILL_ID_FK='.$bill_id)->BILL_ID_FK)->BILL_TYPE == 8){
				$BUDGET_ID = 7;
			}
			else{
				$BUDGET_ID = 1;
			}
			$attribs = array('BUDGET_ID'=>$BUDGET_ID, 'BILL_NO='.$bill_id);
			$SalaryGROSS = null;
			if($model->BILL_SUB_TYPE == 29 || $model->BILL_SUB_TYPE == 30){				
				$SalaryGROSS = Yii::app()->db->createCommand()->select('SUM(AMOUNT_BANK) as GROSS')
								->from('tbl_salary_details t')
								->where('BILL_ID_FK=:BILL_ID_FK', array(':BILL_ID_FK'=>$bill_id))
								->queryRow();
			}
			else{
				$SalaryGROSS = Yii::app()->db->createCommand()->select('SUM(GROSS) as GROSS')
								->from('tbl_salary_details t')
								->where('BILL_ID_FK=:BILL_ID_FK', array(':BILL_ID_FK'=>$bill_id))
								->queryRow();
			}
			$BILL_NO = $bill_id;
			$BILL_AMOUNT = $SalaryGROSS['GROSS'];
			$EXPENDITURE_INC_BILL = 0;
			$BALANCE = 0;
			
			$appropiations = Yii::app()->db->createCommand("SELECT * FROM tbl_appropiation_register WHERE BUDGET_ID = $BUDGET_ID ORDER BY ID DESC")->queryAll();
			$isExists = false;
			$i = 0;
			
			for($j=0; $j < count($appropiations)-1; $j++){
				if($appropiations[$j]['BILL_NO'] == $bill_id){
					$isExists = true;
					$i = $j;
				}
			}
			
			if($isExists){
				$previousAppropiation = $appropiations[$i+1];
				$EXPENDITURE_INC_BILL = $previousAppropiation['EXPENDITURE_INC_BILL'] + $BILL_AMOUNT;
				$BALANCE = $previousAppropiation['BALANCE'] - $BILL_AMOUNT;
				
				$AppropiationRegister = AppropiationRegister::model()->findByAttributes(array('BILL_NO'=>$bill_id));
				$AppropiationRegister->BILL_AMOUNT = $BILL_AMOUNT;
				$AppropiationRegister->EXPENDITURE_INC_BILL = $EXPENDITURE_INC_BILL;
				$AppropiationRegister->BALANCE = $BALANCE;
				$AppropiationRegister->BUDGET_ID = $BUDGET_ID;
				$AppropiationRegister->save(false);
			}
			else{
				$previousAppropiation = $appropiations[0];
				$EXPENDITURE_INC_BILL = $previousAppropiation['EXPENDITURE_INC_BILL'] + $BILL_AMOUNT;
				$BALANCE = $previousAppropiation['BALANCE'] - $BILL_AMOUNT;
				
				$AppropiationRegister = new AppropiationRegister;
				$AppropiationRegister->BILL_NO = $BILL_NO;
				$AppropiationRegister->BILL_AMOUNT = $BILL_AMOUNT;
				$AppropiationRegister->EXPENDITURE_INC_BILL = $EXPENDITURE_INC_BILL;
				$AppropiationRegister->BALANCE = $BALANCE;
				$AppropiationRegister->BUDGET_ID = $BUDGET_ID;
				$AppropiationRegister->save(false);
			}
			
			$model->EXPENDITURE_INC_BILL = $EXPENDITURE_INC_BILL;
			$model->APPROPIATION_BALANCE = $BALANCE;
			$model->BILL_AMOUNT = $BILL_AMOUNT;
			$model->save(false);
			
			$this->redirect(array('SalaryDetails','id'=> $bill_id));
		}
		
		$this->render('PAY/SalaryDetails',array(
			'model'=>$model,
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{	
		$model=new Bill;
		if(isset($_POST['Bill']))
		{
			//echo "<pre>";print_r($_POST['Bill']);echo "</pre>";exit;
			$model->attributes=$_POST['Bill'];
			if(isset($_POST['Bill']['BILL_TYPE']) && ( $_POST['Bill']['BILL_TYPE'] == 1 || $_POST['Bill']['BILL_TYPE'] == 2 || $_POST['Bill']['BILL_TYPE'] == 8)){
				if($model->save(false)){
					if(isset($_POST['Bill']['IS_ARREAR_BILL']) && $_POST['Bill']['IS_ARREAR_BILL'] == 1){
						$OtherBillEmployees = new OtherBillEmployees;
						$OtherBillEmployees->BILL_ID = $model->ID;
						if($_POST['Bill']['BILL_TYPE'] == 1 )
							$OtherBillEmployees->EMPLOYEE_ID = implode(",", $_POST['Bill']['Employee']['OPS']);
						if($_POST['Bill']['BILL_TYPE'] == 2 )
							$OtherBillEmployees->EMPLOYEE_ID = implode(",", $_POST['Bill']['Employee']['NPS']);
						$OtherBillEmployees->save(false);
					}
					if(isset($_POST['Bill']['IS_CEA_BILL']) && $_POST['Bill']['IS_CEA_BILL'] == 1){
						$OtherBillEmployees = new OtherBillEmployees;
						$OtherBillEmployees->BILL_ID = $model->ID;
						if($_POST['Bill']['BILL_TYPE'] == 1 )
							$OtherBillEmployees->EMPLOYEE_ID = implode(",", $_POST['Bill']['Employee']['OPS']);
						if($_POST['Bill']['BILL_TYPE'] == 2 )
							$OtherBillEmployees->EMPLOYEE_ID = implode(",", $_POST['Bill']['Employee']['NPS']);
						$OtherBillEmployees->save(false);
						
						$CEADetails = $_POST['Bill']['CEA_BILLS'];
						foreach($CEADetails as $CEADetail){
							$CEAModel = new CEABillDetails;
							$CEAModel->NAME = $CEADetail['NAME'];
							//$CEAModel->DOB = date('Y-m-d', strtotime($CEADetail['DOB']));
							$CEAModel->CLASS = $CEADetail['CLASS'];
							$CEAModel->SCHOOL = $CEADetail['SCHOOL'];
							$CEAModel->REMARKS = $CEADetail['REMARKS'];
							$CEAModel->AMOUNT = $CEADetail['AMOUNT'];
							$CEAModel->BILL_ID = $model->ID;
							$CEAModel->save(false);
						}
					}
					if(isset($_POST['Bill']['IS_BONUS_BILL']) && $_POST['Bill']['IS_BONUS_BILL'] == 1){
						$OtherBillEmployees = new OtherBillEmployees;
						$OtherBillEmployees->BILL_ID = $model->ID;
						if($_POST['Bill']['BILL_TYPE'] == 1 )
							$OtherBillEmployees->EMPLOYEE_ID = implode(",", $_POST['Bill']['Employee']['OPS_BONUS']);
						if($_POST['Bill']['BILL_TYPE'] == 2 )
							$OtherBillEmployees->EMPLOYEE_ID = implode(",", $_POST['Bill']['Employee']['NPS_BONUS']);
						$OtherBillEmployees->save(false);
					}
					if(isset($_POST['Bill']['IS_UA_BILL']) && $_POST['Bill']['IS_UA_BILL'] == 1){
						$OtherBillEmployees = new OtherBillEmployees;
						$OtherBillEmployees->BILL_ID = $model->ID;
						$OtherBillEmployees->EMPLOYEE_ID = implode(",", $_POST['Bill']['Employee']['UA']);
						$OtherBillEmployees->save(false);
					}
					if(isset($_POST['Bill']['IS_LTC_ADVANCE_BILL']) && $_POST['Bill']['IS_LTC_ADVANCE_BILL'] == 1){
						$OtherBillEmployees = new OtherBillEmployees;
						$OtherBillEmployees->BILL_ID = $model->ID;
						if($_POST['Bill']['BILL_TYPE'] == 1 )
							$OtherBillEmployees->EMPLOYEE_ID = implode(",", $_POST['Bill']['Employee']['OPS']);
						if($_POST['Bill']['BILL_TYPE'] == 2 )
							$OtherBillEmployees->EMPLOYEE_ID = implode(",", $_POST['Bill']['Employee']['NPS']);
						$OtherBillEmployees->save(false);
					}
					if(isset($_POST['Bill']['IS_LTC_CLAIM_BILL']) && $_POST['Bill']['IS_LTC_CLAIM_BILL'] == 1){
						$OtherBillEmployees = new OtherBillEmployees;
						$OtherBillEmployees->BILL_ID = $model->ID;
						if($_POST['Bill']['BILL_TYPE'] == 1 )
							$OtherBillEmployees->EMPLOYEE_ID = implode(",", $_POST['Bill']['Employee']['OPS']);
						if($_POST['Bill']['BILL_TYPE'] == 2 )
							$OtherBillEmployees->EMPLOYEE_ID = implode(",", $_POST['Bill']['Employee']['NPS']);
						$OtherBillEmployees->save(false);
					}
					if(isset($_POST['Bill']['IS_EL_ENCASHMENT_BILL']) && $_POST['Bill']['IS_EL_ENCASHMENT_BILL'] == 1){
						$OtherBillEmployees = new OtherBillEmployees;
						$OtherBillEmployees->BILL_ID = $model->ID;
						if($_POST['Bill']['BILL_TYPE'] == 1 )
							$OtherBillEmployees->EMPLOYEE_ID = implode(",", $_POST['Bill']['Employee']['OPS']);
						if($_POST['Bill']['BILL_TYPE'] == 2 )
							$OtherBillEmployees->EMPLOYEE_ID = implode(",", $_POST['Bill']['Employee']['NPS']);
						$OtherBillEmployees->save(false);
					}
					if(isset($_POST['Bill']['IS_RECOVERY_BILL']) && $_POST['Bill']['IS_RECOVERY_BILL'] == 1){
						$OtherBillEmployees = new OtherBillEmployees;
						$OtherBillEmployees->BILL_ID = $model->ID;
						if($_POST['Bill']['BILL_TYPE'] == 1 )
							$OtherBillEmployees->EMPLOYEE_ID = implode(",", $_POST['Bill']['Employee']['OPS']);
						if($_POST['Bill']['BILL_TYPE'] == 2 )
							$OtherBillEmployees->EMPLOYEE_ID = implode(",", $_POST['Bill']['Employee']['NPS']);
						$OtherBillEmployees->save(false);
					}
					if(isset($_POST['Bill']['BILL_TYPE']) && $_POST['Bill']['BILL_TYPE'] == 8){
						$OtherBillEmployees = new OtherBillEmployees;
						$OtherBillEmployees->BILL_ID = $model->ID;
						$OtherBillEmployees->EMPLOYEE_ID = implode(",", $_POST['Bill']['Employee']['WAGES']);
						$OtherBillEmployees->save(false);
					}
					/*if(isset($_POST['Bill']['BILL_ENTRY_COUNT'])){
						$entry_count = intVal($_POST['Bill']['BILL_ENTRY_COUNT']);
						for($i=1; $i<=$entry_count; $i++){
							$BillRegister = new BillRegister;
							$BillRegister->BILL_ID = $model->ID;
							$BillRegister->save(false);
						}
					}*/
					$this->redirect(array('SalaryDetails','id'=> $model->ID));
				}
			}
			if(isset($_POST['Bill']['BILL_TYPE']) && $_POST['Bill']['BILL_TYPE'] == 3){
				if(Bill::model()->exists('BILL_TITLE LIKE "%'.$model->BILL_TITLE.'%" AND BILL_AMOUNT='.$model->BILL_AMOUNT)){
					echo "<script>alert('This bill has already been created. Navigate Bill->Manage to Search Bill');</script>";
					
				}
				else{
					if($model->save(false)){
						$OEBills = $_POST['Bill']['OE_BILL'];
						foreach($OEBills as $OEBill){
							$OEBillsModel = new OEBills;
							$OEBillsModel->NUMBER = $OEBill['BILL_NO'];
							$OEBillsModel->AMOUNT = $OEBill['BILL_AMOUNT'];
							$OEBillsModel->DATE = date('Y-m-d', strtotime($OEBill['BILL_DATE']));
							$OEBillsModel->BILL_ID = $model->ID;
							$OEBillsModel->save(false);
						}
						
						$OEBillsDetailsModel = new OEBillDetails;
						$OEBillsDetailsModel->BILL_ID_FK = $model->ID;
						$OEBillsDetailsModel->IT_DED = $_POST['Bill']['OE_IT_DED'];
						$OEBillsDetailsModel->NET_AMOUNT = $_POST['Bill']['OE_NET_AMOUNT'];
						$OEBillsDetailsModel->save(false);
						
						$BUDGET_ID = 2;
						$attribs = array('BUDGET_ID'=>$BUDGET_ID);
						$criteria = new CDbCriteria(array('order'=>'ID DESC','limit'=>1));
						$appropiation = AppropiationRegister::model()->findByAttributes($attribs, $criteria);
						
						$BILL_NO = $model->ID;
						$BILL_AMOUNT = $model->BILL_AMOUNT;
						$EXPENDITURE_INC_BILL = $appropiation->EXPENDITURE_INC_BILL + $model->BILL_AMOUNT;
						$BALANCE = $appropiation->BALANCE - $model->BILL_AMOUNT;
						
						$AppropiationRegister = new AppropiationRegister;
						$AppropiationRegister->BILL_NO = $BILL_NO;
						$AppropiationRegister->BILL_AMOUNT = $BILL_AMOUNT;
						$AppropiationRegister->EXPENDITURE_INC_BILL = $EXPENDITURE_INC_BILL;
						$AppropiationRegister->BALANCE = $BALANCE;
						$AppropiationRegister->BUDGET_ID = $BUDGET_ID;
						if($AppropiationRegister->save(false)){
							$model->EXPENDITURE_INC_BILL = $EXPENDITURE_INC_BILL;
							$model->APPROPIATION_BALANCE = $BALANCE;
							$model->save(false);
							
							/*if(isset($_POST['Bill']['BILL_ENTRY_COUNT'])){
								$entry_count = intVal($_POST['Bill']['BILL_ENTRY_COUNT']);
								for($i=1; $i<=$entry_count; $i++){
									$BillRegister = new BillRegister;
									$BillRegister->BILL_ID = $model->ID;
									$BillRegister->save(false);
								}
							}*/
							$this->redirect(array('update','id'=> $BILL_NO));
						}
					}
				}
			}
			if(isset($_POST['Bill']['BILL_TYPE']) && $_POST['Bill']['BILL_TYPE'] == 4){
				if($model->save(false)){
					$OtherBillEmployees = new OtherBillEmployees;
					$OtherBillEmployees->BILL_ID = $model->ID;
					$OtherBillEmployees->EMPLOYEE_ID = implode(",", $_POST['Bill']['Employee']['DTE']);
					$OtherBillEmployees->save(false);
					
					if(isset($_POST['Bill']['BILL_SUB_TYPE']) && ($_POST['Bill']['BILL_SUB_TYPE'] == 35 || $_POST['Bill']['BILL_SUB_TYPE'] == 36)){
						$DTEBillsDetailsModel = new DTEBillDetails;
						$DTEBillsDetailsModel->BILL_ID_FK = $model->ID;
						$DTEBillsDetailsModel->GROSS = $_POST['Bill']['CLAIM_GROSS_AMOUNT'];
						$DTEBillsDetailsModel->ADVANCE = $_POST['Bill']['CLAIM_ADVANCE_AMOUNT'];
						$DTEBillsDetailsModel->save(false);
					}
					
					$BUDGET_ID = 3;
					$attribs = array('BUDGET_ID'=>$BUDGET_ID);
					$criteria = new CDbCriteria(array('order'=>'ID DESC','limit'=>1));
					$appropiation = AppropiationRegister::model()->findByAttributes($attribs, $criteria);
					
					$BILL_NO = $model->ID;
					$BILL_AMOUNT = $model->BILL_AMOUNT;
					$EXPENDITURE_INC_BILL = $appropiation->EXPENDITURE_INC_BILL + $model->BILL_AMOUNT;
					$BALANCE = $appropiation->BALANCE - $model->BILL_AMOUNT;
					
					$AppropiationRegister = new AppropiationRegister;
					$AppropiationRegister->BILL_NO = $BILL_NO;
					$AppropiationRegister->BILL_AMOUNT = $BILL_AMOUNT;
					$AppropiationRegister->EXPENDITURE_INC_BILL = $EXPENDITURE_INC_BILL;
					$AppropiationRegister->BALANCE = $BALANCE;
					$AppropiationRegister->BUDGET_ID = $BUDGET_ID;
					if($AppropiationRegister->save(false)){
						$model->EXPENDITURE_INC_BILL = $EXPENDITURE_INC_BILL;
						$model->APPROPIATION_BALANCE = $BALANCE;
						$model->save(false);
						
						/*if(isset($_POST['Bill']['BILL_ENTRY_COUNT'])){
							$entry_count = intVal($_POST['Bill']['BILL_ENTRY_COUNT']);
							for($i=1; $i<=$entry_count; $i++){
								$BillRegister = new BillRegister;
								$BillRegister->BILL_ID = $model->ID;
								$BillRegister->save(false);
							}
							$this->redirect(array('update','id'=> $BILL_NO));
						}*/
						$this->redirect(array('update','id'=> $BILL_NO));
					}
				}
			}
			if(isset($_POST['Bill']['BILL_TYPE']) && $_POST['Bill']['BILL_TYPE'] == 6){
				if($model->save(false)){
					$OtherBillEmployees = new OtherBillEmployees;
					$OtherBillEmployees->BILL_ID = $model->ID;
					$OtherBillEmployees->EMPLOYEE_ID = implode(",", $_POST['Bill']['Employee']['MEDICAL']);
					$OtherBillEmployees->save(false);
					
					$BUDGET_ID = 5;
					$attribs = array('BUDGET_ID'=>$BUDGET_ID);
					$criteria = new CDbCriteria(array('order'=>'ID DESC','limit'=>1));
					$appropiation = AppropiationRegister::model()->findByAttributes($attribs, $criteria);
					
					$BILL_NO = $model->ID;
					$BILL_AMOUNT = $model->BILL_AMOUNT;
					$EXPENDITURE_INC_BILL = $appropiation->EXPENDITURE_INC_BILL + $model->BILL_AMOUNT;
					$BALANCE = $appropiation->BALANCE - $model->BILL_AMOUNT;
					
					$AppropiationRegister = new AppropiationRegister;
					$AppropiationRegister->BILL_NO = $BILL_NO;
					$AppropiationRegister->BILL_AMOUNT = $BILL_AMOUNT;
					$AppropiationRegister->EXPENDITURE_INC_BILL = $EXPENDITURE_INC_BILL;
					$AppropiationRegister->BALANCE = $BALANCE;
					$AppropiationRegister->BUDGET_ID = $BUDGET_ID;
					if($AppropiationRegister->save(false)){
						$model->EXPENDITURE_INC_BILL = $EXPENDITURE_INC_BILL;
						$model->APPROPIATION_BALANCE = $BALANCE;
						$model->save(false);
						/*if(isset($_POST['Bill']['BILL_ENTRY_COUNT'])){
							$entry_count = intVal($_POST['Bill']['BILL_ENTRY_COUNT']);
							for($i=1; $i<=$entry_count; $i++){
								$BillRegister = new BillRegister;
								$BillRegister->BILL_ID = $model->ID;
								$BillRegister->save(false);
							}
						}*/
						$this->redirect(array('update','id'=> $BILL_NO));
					}
					
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
	public function actionUpdate($id, $isSalaryHead=false)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Bill']))
		{
			$model->attributes=$_POST['Bill'];
			//, PFMS_STATUS="'.$_POST['Bill']['PFMS_STATUS'].'"
			$command = Yii::app()->db->createCommand('UPDATE tbl_bill SET PFMS_BILL_NO="'.$_POST['Bill']['PFMS_BILL_NO'].'"  WHERE ID='.$_REQUEST['id']);

			if($command->execute()){
				if($isSalaryHead){ 
					$this->redirect(array('SalaryDetails', 'id'=> $model->ID));
				}
				else{
					$this->redirect(array('update', 'id'=> $model->ID));
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
		$dataProvider=new CActiveDataProvider('Bill');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Bill('search');
		$model->unsetAttributes();
		if(isset($_GET['Bill'])){
			$data = array();
			if(isset($_GET['Bill']['MONTH'])){
				$data['MONTH'] = $_GET['Bill']['MONTH'];
			}
			if(isset($_GET['Bill']['YEAR'])){
				$data['YEAR'] = $_GET['Bill']['YEAR'];
			}
			$model=new Bill('search', $data);
			$model->unsetAttributes();
			$model->attributes=$_GET['Bill'];
			$model->PASSED_DATE = $_GET['Bill']['PASSED_DATE'];
			$model->BILL_NO = $_GET['Bill']['BILL_NO'];
			$model->MONTH = $_GET['Bill']['MONTH'];
			$model->CER_NO = $_GET['Bill']['CER_NO'];
			$model->BILL_AMOUNT = $_GET['Bill']['BILL_AMOUNT'];
			$model->PFMS_BILL_NO = $_GET['Bill']['PFMS_BILL_NO'];
		}

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Bill the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Bill::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Bill $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='bill-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	public function amountToWord($number, $isBelow = false){
		$no = round($number);
		$point = round($number - $no, 2) * 100;
		$hundred = null;
		$digits_1 = strlen($no);
		$i = 0;
		$str = array();
		$words = array('0' => '', '1' => 'One', '2' => 'Two',
		'3' => 'Three', '4' => 'Four', '5' => 'Five', '6' => 'Six',
		'7' => 'Seven', '8' => 'Eight', '9' => 'Nine',
		'10' => 'Ten', '11' => 'Eleven', '12' => 'Twelve',
		'13' => 'Thirteen', '14' => 'Fourteen',
		'15' => 'Fifteen', '16' => 'Sixteen', '17' => 'Seventeen',
		'18' => 'Eighteen', '19' =>'Nineteen', '20' => 'Twenty',
		'30' => 'Thirty', '40' => 'Forty', '50' => 'Fifty',
		'60' => 'Sixty', '70' => 'Seventy',
		'80' => 'Eighty', '90' => 'Ninety');
		$digits = array('', 'hundred', 'thousand', 'lakh', 'crore');
		while ($i < $digits_1) {
		 $divider = ($i == 2) ? 10 : 100;
		 $number = floor($no % $divider);
		 $no = floor($no / $divider);
		 $i += ($divider == 10) ? 1 : 2;
		 if ($number) {
			$plural = (($counter = count($str)) && $number > 9) ? 's' : null;
			$hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
			$str [] = ($number < 21) ? $words[$number] .
				" " . $digits[$counter] . $plural . " " . $hundred
				:
				$words[floor($number / 10) * 10]
				. " " . $words[$number % 10] . " "
				. $digits[$counter] . $plural . " " . $hundred;
		 } else $str[] = null;
		}
		$str = array_reverse($str);
		$result = implode('', $str);
		if($number == 0)
			$result	= "Zero";
		
		$points = ($point) ?
		"." . $words[$point / 10] . " " . 
			  $words[$point = $point % 10] : '';
		if($isBelow){
			return  "(Below rupees ".$result . " Only)";
		}
		return  "(Rupees ".$result . " Only)";
	}
	
	public function actionEmployeeBillFront($id){$this->layout='//layouts/column1';$model = $this->loadModel($id);$this->render('PAY/EmployeeBillFront',array('model'=>$model,));}
	public function actionEmployeeBillInner($id){$this->layout='//layouts/column1';$model = $this->loadModel($id);$this->amountInWords = $this->amountToWord($model->BILL_AMOUNT);$this->render('PAY/EmployeeBillInner',array('model'=>$model,));}
	public function actionEmployeeBillPart1($id){$this->layout='//layouts/column1';$model = $this->loadModel($id);$this->amountInWords = $this->amountToWord($model->BILL_AMOUNT);$this->render('PAY/EmployeeBillPart1',array('model'=>$model,));}
	public function actionCEAEmployeeBillPart1($id){$this->layout='//layouts/column1';$model = $this->loadModel($id);$this->amountInWords = $this->amountToWord($model->BILL_AMOUNT);$this->render('PAY/CEABillPart1',array('model'=>$model,));}
	public function actionCEASanctionOrder($id){$this->layout='//layouts/column1';$model = $this->loadModel($id);$this->amountInWords = $this->amountToWord($model->BILL_AMOUNT);$this->render('PAY/CEASanctionOrder',array('model'=>$model,));}
	public function actionEmployeeBillPart2($id){$this->layout='//layouts/column1';$model = $this->loadModel($id);$this->render('PAY/EmployeeBillPart2',array('model'=>$model,));}
	public function actionDAArrearBillPart1($id){$this->layout='//layouts/column1';$model = $this->loadModel($id);$this->render('PAY/DAArrearBillPart1',array('model'=>$model,));}
	public function actionBonusEmployeeBillPart1($id){$this->layout='//layouts/column1';$model = $this->loadModel($id);$this->amountInWords = $this->amountToWord($model->BILL_AMOUNT);$this->render('PAY/BonusEmployeeBillPart1',array('model'=>$model,));}
	public function actionUAEmployeeBillPart1($id){$this->layout='//layouts/column1';$model = $this->loadModel($id);$this->amountInWords = $this->amountToWord($model->BILL_AMOUNT);$this->render('PAY/UAEmployeeBillPart1',array('model'=>$model,));}
	public function actionUANoteSheet($id){$this->layout='//layouts/column1';$model = $this->loadModel($id);$this->amountInWords = $this->amountToWord($model->BILL_AMOUNT);$this->render('PAY/UANoteSheet',array('model'=>$model,));}	
	public function actionUASanctionOrder($id){$this->layout='//layouts/column1';$model = $this->loadModel($id);$this->amountInWords = $this->amountToWord($model->BILL_AMOUNT);$this->render('PAY/UASanctionOrder',array('model'=>$model,));}
	public function actionELEncashEmployeeBillPart1($id){$this->layout='//layouts/column1';$model = $this->loadModel($id);$this->amountInWords = $this->amountToWord($model->BILL_AMOUNT);$this->render('PAY/ELEncashEmployeeBillPart1',array('model'=>$model,));}
	public function actionNillBillFront($id){$this->layout='//layouts/column1';$model = $this->loadModel($id);$this->render('PAY/NillBillFront',array('model'=>$model,));}
	public function actionNillBillCPF($id){$this->layout='//layouts/column1';$model = $this->loadModel($id);$this->render('PAY/NillBillCPF',array('model'=>$model,));}
	public function actionNillBillInner($id){$this->layout='//layouts/column1';$model = $this->loadModel($id);$this->render('PAY/NillBillInner',array('model'=>$model,));}
	public function actionNillBillPart1($id){$this->layout='//layouts/column1';$model = $this->loadModel($id);$this->render('PAY/NillBillPart1',array('model'=>$model,));}
	public function actionNillBillPart2($id){$this->layout='//layouts/column1';$model = $this->loadModel($id);$this->render('PAY/NillBillPart2',array('model'=>$model,));}
	public function actionPTBillFront($id){$this->layout='//layouts/column1';$model = $this->loadModel($id);$this->render('PAY/PTBillFront',array('model'=>$model,));}
	public function actionReconsilationPT($id){$this->layout='//layouts/column1';$model = $this->loadModel($id);$this->render('PAY/ReconsilationPT',array('model'=>$model,));}
	public function actionCCSLICBillFront($id){$this->layout='//layouts/column1';$model = $this->loadModel($id);$this->render('PAY/CCSLICBillFront',array('model'=>$model,));}
	public function actionBackSheet($id){$this->layout='//layouts/column1';$model = $this->loadModel($id);$this->render('PAY/BackSheet',array('model'=>$model,));}
	public function actionCGHS($id){$this->layout='//layouts/column1';$model = $this->loadModel($id);$this->render('PAY/CGHS',array('model'=>$model,));}
	public function actionCYCLE($id){$this->layout='//layouts/column1';$model = $this->loadModel($id);$this->render('PAY/CYCLE',array('model'=>$model,));}
	public function actionCGEGIS($id){$this->layout='//layouts/column1';$model = $this->loadModel($id);$this->render('PAY/CGEGIS',array('model'=>$model,));}
	public function actionIT($id){$this->layout='//layouts/column1';$model = $this->loadModel($id);$this->render('PAY/IT',array('model'=>$model,));}
	public function actionCPF($id){$this->layout='//layouts/column1';$model = $this->loadModel($id);$this->render('PAY/CPF',array('model'=>$model,));}
	public function actionGPF($id){$this->layout='//layouts/column1';$model = $this->loadModel($id);$this->render('PAY/GPF',array('model'=>$model,));}
	public function actionLF($id){$this->layout='//layouts/column1';$model = $this->loadModel($id);$this->render('PAY/LF',array('model'=>$model,));}
	public function actionHBA($id){$this->layout='//layouts/column1';$model = $this->loadModel($id);$this->render('PAY/HBA',array('model'=>$model,));}
	public function actionFAN($id){$this->layout='//layouts/column1';$model = $this->loadModel($id);$this->render('PAY/FAN',array('model'=>$model,));}
	public function actionFLOOD($id){$this->layout='//layouts/column1';$model = $this->loadModel($id);$this->render('PAY/FLOOD',array('model'=>$model,));}
	public function actionFEST($id){$this->layout='//layouts/column1';$model = $this->loadModel($id);$this->render('PAY/FEST',array('model'=>$model,));}
	public function actionMCA($id){$this->layout='//layouts/column1';$model = $this->loadModel($id);$this->render('PAY/MCA',array('model'=>$model,));}
	public function actionMISC($id){$this->layout='//layouts/column1';$model = $this->loadModel($id);$this->render('PAY/MISC',array('model'=>$model,));}
	public function actionPT($id){$this->layout='//layouts/column1';$model = $this->loadModel($id);$this->render('PAY/PT',array('model'=>$model,));}
	public function actionCCS($id){$this->layout='//layouts/column1';$model = $this->loadModel($id);$this->render('PAY/CCS',array('model'=>$model,));}
	public function actionLIC($id){$this->layout='//layouts/column1';$model = $this->loadModel($id);$this->render('PAY/LIC',array('model'=>$model,));}
	public function actionPLI($id){$this->layout='//layouts/column1';$model = $this->loadModel($id);$this->render('PAY/PLI',array('model'=>$model,));}
	public function actionPTCCSLIC($id){$this->layout='//layouts/column1';$model = $this->loadModel($id);$this->render('PAY/PTCCSLIC',array('model'=>$model,));}
	public function actionEPAY($id){$this->layout='//layouts/column1';$model = $this->loadModel($id);$this->render('PAY/EPAY',array('model'=>$model,));}
	public function actionReconsilationLICCCS($id){$this->layout='//layouts/column1';$model = $this->loadModel($id);$this->render('PAY/ReconsilationLICCCS',array('model'=>$model,));}
	public function actionLTCClaimFront($id){$this->layout='//layouts/column1';$model = $this->loadModel($id);$this->render('PAY/LTCClaimFront',array('model'=>$model,));}
	public function actionLTCClaimBack($id){$this->layout='//layouts/column1';$model = $this->loadModel($id);$this->render('PAY/LTCClaimBack',array('model'=>$model,));}
	public function actionLTCAdvanceFront($id){$this->layout='//layouts/column1';$model = $this->loadModel($id);$this->render('PAY/LTCAdvanceFront',array('model'=>$model,));}
	public function actionLTCAdvanceBack($id){$this->layout='//layouts/column1';$model = $this->loadModel($id);$this->render('PAY/LTCAdvanceBack',array('model'=>$model,));}
	public function actionMedicalBill($id){$this->layout='//layouts/column1';$model = $this->loadModel($id);$this->render('MEDICAL/Medical',array('model'=>$model,));}
	public function actionDTEClaimFront($id){$this->layout='//layouts/column1';$model = $this->loadModel($id);$this->render('DTE/DTEClaimFront',array('model'=>$model,));}
	public function actionDTEClaimBack($id){$this->layout='//layouts/column1';$model = $this->loadModel($id);$this->render('DTE/DTEClaimBack',array('model'=>$model,));}
	public function actionDTEAdvanceFront($id){$this->layout='//layouts/column1';$model = $this->loadModel($id);$this->render('DTE/DTEAdvanceFront',array('model'=>$model,));}
	public function actionDTEAdvanceBack($id){$this->layout='//layouts/column1';$model = $this->loadModel($id);$this->render('DTE/DTEAdvanceBack',array('model'=>$model,));}
	public function actionCasualPayBillBackPage($id){$this->layout='//layouts/column1';$model = $this->loadModel($id);$this->render('PAY/CasualPayBillBackPage',array('model'=>$model,));}
	public function actionCasualPayBillFrontPage($id){$this->layout='//layouts/column1';$model = $this->loadModel($id);$this->render('PAY/CasualPayBillFrontPage',array('model'=>$model,));}
	public function actionCasualPTBillFrontPage($id){$this->layout='//layouts/column1';$model = $this->loadModel($id);$this->render('PAY/CasualPTBillFrontPage',array('model'=>$model,));}
	public function actionCasualPTBillBackPage($id){$this->layout='//layouts/column1';$model = $this->loadModel($id);$this->render('PAY/CasualPTBillBackPage',array('model'=>$model,));}
	public function actionCasualPayBillSanctionOrder($id){$this->layout='//layouts/column1';$model = $this->loadModel($id);$this->render('PAY/CasualPayBillSanctionOrder',array('model'=>$model,));}
	public function actionCasualPayBillInner($id){$this->layout='//layouts/column1';$model = $this->loadModel($id);$this->render('PAY/CasualPayBillInner',array('model'=>$model,));}
	public function actionCasualPayBillPT($id){$this->layout='//layouts/column1';$model = $this->loadModel($id);$this->render('PAY/CasualPayBillPT',array('model'=>$model,));}
	public function actionHBA_INTEREST($id){$this->layout='//layouts/column1';$model = $this->loadModel($id);$this->render('PAY/HBA_INTEREST',array('model'=>$model,));}
	public function actionFAN_INTEREST($id){$this->layout='//layouts/column1';$model = $this->loadModel($id);$this->render('PAY/FAN_INTEREST',array('model'=>$model,));}
	public function actionFLOOD_INTEREST($id){$this->layout='//layouts/column1';$model = $this->loadModel($id);$this->render('PAY/FLOOD_INTEREST',array('model'=>$model,));}
	public function actionFEST_INTEREST($id){$this->layout='//layouts/column1';$model = $this->loadModel($id);$this->render('PAY/FEST_INTEREST',array('model'=>$model,));}
	public function actionMCA_INTEREST($id){$this->layout='//layouts/column1';$model = $this->loadModel($id);$this->render('PAY/MCA_INTEREST',array('model'=>$model,));}
	public function actionCYCLE__INTEREST($id){$this->layout='//layouts/column1';$model = $this->loadModel($id);$this->render('PAY/CYCLE__INTEREST',array('model'=>$model,));}
	public function actionLIC_PREMIUM($id){$this->layout='//layouts/column1';$model = $this->loadModel($id);$this->render('PAY/LIC_PREMIUM',array('model'=>$model,));}
	public function actionLIC_PREMIUM_COVER($id){$this->layout='//layouts/column1';$model = $this->loadModel($id);$this->render('PAY/LIC_PREMIUM_COVER',array('model'=>$model,));}
	public function actionMADIWALA($id){$this->layout='//layouts/column1';$model = $this->loadModel($id);$this->render('PAY/MADIWALA',array('model'=>$model,));}
	public function actionJAYAMAHAL($id){$this->layout='//layouts/column1';$model = $this->loadModel($id);$this->render('PAY/JAYAMAHAL',array('model'=>$model,));}
	public function actionCOURT($id){$this->layout='//layouts/column1';$model = $this->loadModel($id);$this->render('PAY/COURT',array('model'=>$model,));}
	public function actionASSOCIATION($id){$this->layout='//layouts/column1';$model = $this->loadModel($id);$this->render('PAY/ASSOCIATION',array('model'=>$model,));}

}

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
				'FontSheetInnerFirst', 'FontSheetInnerLast', 'CGHS', 'ChangeStatus', 'SaveSalaryDetailAjax'),
				'users'=>array('*'),
			),
		);
	}
	public function actionTaxCalculate()
	{
		$this->layout = '//layouts/column1';
        $this->render('TaxCalculate');
    }
	public function actionPayBillListByMonthAndYear($month, $year)
	{
        $bills = Bill::model()->findAll('MONTH='.$month.' AND YEAR='.$year.' AND IS_SALARY_BILL=1');
        $data = array();
        foreach($bills as $bill){
            array_push($data, array('ID'=>$bill->ID, 'TITLE'=>$bill->BILL_TITLE));
        }
        
        echo json_encode($data);exit;
    }
    public function actionGetPayBillLICValuesById($id)
	{
        $salaries = SalaryDetails::model()->findAll('BILL_ID_FK='.$id);
        $data = array();
        foreach($salaries as $salary){
            array_push($data, array('ID'=>$salary->EMPLOYEE_ID_FK, 
                                    'NAME'=>Employee::model()->findByPK($salary->EMPLOYEE_ID_FK)->NAME, 'CODE'=>Employee::model()->findByPK($salary->EMPLOYEE_ID_FK)->EIS_CODE, 'AMOUNT'=>$salary->LIC));
        }
        
        echo json_encode($data);exit;
    }
    public function actionGetPayBillCCSValuesById($id)
	{
        $salaries = SalaryDetails::model()->findAll('BILL_ID_FK='.$id);
        $data = array();
        foreach($salaries as $salary){
            array_push($data, array('ID'=>$salary->EMPLOYEE_ID_FK, 
                                    'NAME'=>Employee::model()->findByPK($salary->EMPLOYEE_ID_FK)->NAME, 'CODE'=>Employee::model()->findByPK($salary->EMPLOYEE_ID_FK)->EIS_CODE, 'AMOUNT'=>$salary->CCS));
        }
        
        echo json_encode($data);exit;
    }
    public function actionGetPayBillPTValuesById($id)
	{
        $salaries = SalaryDetails::model()->findAll('BILL_ID_FK='.$id);
        $data = array();
        foreach($salaries as $salary){
            array_push($data, array('ID'=>$salary->EMPLOYEE_ID_FK, 
                                    'NAME'=>Employee::model()->findByPK($salary->EMPLOYEE_ID_FK)->NAME, 'CODE'=>Employee::model()->findByPK($salary->EMPLOYEE_ID_FK)->EIS_CODE, 'AMOUNT'=>$salary->PT));
        }
        
        echo json_encode($data);exit;
    }
    public function actionGetPayBillCourtValuesById($id)
	{
        $salaries = SalaryDetails::model()->findAll('BILL_ID_FK='.$id);
        $data = array();
        foreach($salaries as $salary){
            array_push($data, array('ID'=>$salary->EMPLOYEE_ID_FK, 
                                    'NAME'=>Employee::model()->findByPK($salary->EMPLOYEE_ID_FK)->NAME, 'CODE'=>Employee::model()->findByPK($salary->EMPLOYEE_ID_FK)->EIS_CODE, 'AMOUNT'=>$salary->COURT_ATTACHMENT));
        }
        
        echo json_encode($data);exit;
    }
    public function actionGetPayBillITValuesById($id)
	{
        $salaries = SalaryDetails::model()->findAll('BILL_ID_FK='.$id);
        $data = array();
        foreach($salaries as $salary){
			if(Yii::app()->session['FINANCIAL_YEAR'] == 1){
				array_push($data, array('ID'=>$salary->EMPLOYEE_ID_FK, 
                                    'NAME'=>Employee::model()->findByPK($salary->EMPLOYEE_ID_FK)->NAME, 'CODE'=>Employee::model()->findByPK($salary->EMPLOYEE_ID_FK)->EIS_CODE, 'AMOUNT'=>round(($salary->IT * 100)/103)));
			}
            else{
				array_push($data, array('ID'=>$salary->EMPLOYEE_ID_FK, 
                                    'NAME'=>Employee::model()->findByPK($salary->EMPLOYEE_ID_FK)->NAME, 'CODE'=>Employee::model()->findByPK($salary->EMPLOYEE_ID_FK)->EIS_CODE, 'AMOUNT'=>round(($salary->IT * 100)/104)));
			}
        }
        
        echo json_encode($data);exit;
    }
	
	public function is_exists($array, $key, $val) {
		foreach ($array as $item)
			if (isset($item[$key]) && $item[$key] == $val)
				return true;
		return false;
	}

	public function actionCSSImport($id)
	{
		//echo "hi";exit;
		$model = $this->loadModel($id);
		$content = "";
		$all_employees = Employee::model()->findAll("IS_TRANSFERRED = 0 AND IS_RETIRED = 0 AND IS_SUSPENDED = 0 AND IS_PERMANENT = 1 ORDER BY NAME");
		$allEmployeesContent = "<select onchange='setCCSValueForNotFound(this)'>";
		foreach($all_employees as $emp){
			$allEmployeesContent .= "<option value='".$emp->ID."'>".$emp->NAME."</option>";
		}
		$allEmployeesContent .="</select>";
		if(isset($_POST['Bill']))
		{
			$UploadFile = CUploadedFile::getInstance($model, 'CSS_FILE');
			if($UploadFile !== null){
				$FileExt=$UploadFile->getExtensionName();
				if(strtolower($FileExt)=="xls" || strtolower($FileExt)=="xlsx"){
					$fileName = "ccs_files/".uniqid().".xlsx";
					$FileNewName = Yii::getPathOfAlias("webroot")."/".$fileName;
					$UploadFile->saveAs($FileNewName);
					$sheet_array = Yii::app()->yexcel->readActiveSheet($FileNewName);
					$dataArray = array();
					foreach( $sheet_array as $row ) {
						array_push($dataArray, array('NAME'=>$row['A'], 'AMOUNT'=>$row['B']));
					}
					
					$records = array();
					
					foreach( $dataArray as $row ) {
						$names = explode(' ', $row['NAME']);
						$nameArray  = array();
						foreach($names as $name){
							if(strlen($name) > 2){
								array_push($nameArray, $name);
							}
						}
						
						$fetched_records = array();
						foreach($nameArray as $name){
							$employees = Yii::app()->db->createCommand("SELECT ID, NAME, IS_TRANSFERRED, IS_RETIRED,
							IS_SUSPENDED, IS_PERMANENT FROM tbl_employee WHERE NAME LIKE '%".ucwords($name)."%'")->queryAll();
							foreach($employees as $employee){
								if($employee){
									if(!$this->is_exists($fetched_records, 'ID', $employee['ID'])){
										if($employee['IS_TRANSFERRED']){
											array_push($fetched_records, array('ID'=>$employee['ID'], 'RECORD_NAME'=>$employee['NAME'], 'AMOUNT'=> 0, 'STATUS'=>'TRANSFERRED'));
										}
										else if($employee['IS_RETIRED']){
											array_push($fetched_records, array('ID'=>$employee['ID'], 'RECORD_NAME'=>$employee['NAME'], 'AMOUNT'=> 0, 'STATUS'=>'RETIRED'));
										}
										else if($employee['IS_SUSPENDED']){
											array_push($fetched_records, array('ID'=>$employee['ID'], 'RECORD_NAME'=>$employee['NAME'], 'AMOUNT'=> 0, 'STATUS'=>'SUSPENDED'));
										}
										else if(!$employee['IS_PERMANENT']){
											array_push($fetched_records, array('ID'=>$employee['ID'], 'RECORD_NAME'=>$employee['NAME'], 'AMOUNT'=> 0, 'STATUS'=>'TEMPORARY'));
										}
										else{
											array_push($fetched_records, array('ID'=>$employee['ID'], 'RECORD_NAME'=>$employee['NAME'], 'AMOUNT'=> $row['AMOUNT'], 'STATUS'=>'FOUND'));
										}
									}
								}
								else{
									array_push($fetched_records, array('ID'=>0, 'RECORD_NAME'=>null, 'AMOUNT'=>0, 'STATUS'=>'NOT FOUND'));
								}
							}
						}
						array_push($records, array('NAME'=>$row['NAME'], 'AMOUNT'=>$row['AMOUNT'], 'FETCH_RECORDS'=>$fetched_records));
						
					}
					
					//echo "<pre>";print_r($records);echo "</pre>";exit;
					$content .= "<table class='table table-bordered table-hover' id='ccs-import-table'><tr><th>S. No.</th><th>Name in CCS Sheet</th><th>Name in Records</th></tr>";
					$content .="<tr><td>Total</td><td><input type='text' id='ccs-total'/><input type='button' onclick='calculateCCSTotal();' value='Calculate'/></td></tr>";
					$i=1;
					foreach( $records as $record ) {
						$content .="<tr>";
							$content .="<td style='vertical-align: top;'>";
								$content .= $i;
							$content .="</td>";
							$content .="<td style='vertical-align: top;'>";
								$content .= $record['NAME'];
							$content .="</td>";
							$content .="<td class='td-parent'>";
								$content .="<table class='table table-bordered table-hover'>";
									if(count($record['FETCH_RECORDS'])>0){
										foreach($record['FETCH_RECORDS'] as $record_fetched ) {
											$content .="<tr>";
												$content .="<td>";
													if($record_fetched['STATUS'] == 'FOUND'){
														$content .= "<div>".$record_fetched['RECORD_NAME']."<br>";
														$content .="<input type='hidden' name='Import[".$record_fetched['ID']."][EMPLOYEE_ID_FK]' value='".$record_fetched['ID']."'>";
														$content .="<input type='text' class='ccs-amount' name='Import[".$record_fetched['ID']."][CCS]' value='".$record_fetched['AMOUNT']."'>";
														$content .="<span style='display:none;'>";
														$content .= $allEmployeesContent."<br>";
														$content .="</span>";
														$content .="<button type='button' class='not-found-btn' style='width: 25px;'><i class='fa fa-user'></i></button><button type='button' onclick='removeParent(this);' style='width: 25px;'><i class='fa fa-check'></i></button></div>";
													}
													else if($record_fetched['STATUS'] == 'TRANSFERRED' || $record_fetched['STATUS'] == 'RETIRED' || 
													$record_fetched['STATUS'] == 'SUSPENDED' || $record_fetched['STATUS'] == 'TEMPORARY'){
														$content .= "<div><span style='color: #f00;'>".$record_fetched['RECORD_NAME']." is ".$record_fetched['STATUS'].".</span><br><button type='button' onclick='removeParent(this);' style='width: 25px;'><i class='fa fa-check'></i></button></div>";
													}
													else if($record_fetched['STATUS'] == 'NOT FOUND'){
														$content .= "<div>";
														$content .="<input type='hidden' id='EMPLOYEE_ID_FK' name='Import[".$record_fetched['ID']."][EMPLOYEE_ID_FK]' value=''>";
														$content .= $allEmployeesContent."<br>";
														$content .="<input type='text' class='ccs-amount' name='Import[".$record_fetched['ID']."][CCS]' value='".$record_fetched['AMOUNT']."'>";
														$content .="</div>";
													}
												$content .="</td>";
											$content .="</tr>";
										}
									}
									else{
										$content .="<tr>";
											$content .="<td>";
												$content .= "<div>";
												$content .="<input type='hidden' name='' value=''>";
												$content .= "<select onchange='setCCSValue(this)'>";
												foreach($all_employees as $emp){
													$content .= "<option value='".$emp->ID."'>".$emp->NAME."</option>";
												}
												$content .= "</select><br>";
												$content .="<input type='text' class='ccs-amount' name='' value='".$record['AMOUNT']."'>";
												$content .="</div>";
											$content .="</td>";
										$content .="</tr>";	
									}
								$content .="</table>";	
							$content .="</td>";
						$content .="</tr>";
						$i++;
					}
					$content .="</table><br><br><br>";
					$content .="<input type='submit' value='Submit' class='btn btn-inline' onclick='return validate();'/>";
				}
				else{
					echo "<script>alert('Select only allowed file extensions.');</script>";
				}
			}			
		}

		if(isset($_POST['Import']))
		{	echo "hi";exit;
			$employees = $_POST['Import'];
			$this->AllCCSToBeZero($model->ID);
			foreach($employees as $employee){
				if($employee['CCS'] && $employee['EMPLOYEE_ID_FK']){
					Yii::app()->db->createCommand("UPDATE tbl_salary_details SET CCS = ".$employee['CCS']." WHERE EMPLOYEE_ID_FK = ".$employee['EMPLOYEE_ID_FK']." AND BILL_ID_FK=".$model->ID.";")->execute();
					Yii::app()->db->createCommand("UPDATE tbl_salary_details SET GROSS = (BASIC + HRA  + DA  + TA  + SP + PP) WHERE EMPLOYEE_ID_FK = ".$employee['EMPLOYEE_ID_FK']." AND BILL_ID_FK=".$model->ID.";")->execute();
					Yii::app()->db->createCommand("UPDATE tbl_salary_details SET DED = (IT  + CGHS  + LF  + CGEGIS  + CPF_TIER_I  + CPF_TIER_II + MISC + PLI + COURT_ATTACHMENT + HBA_EMI + MCA_EMI + COMP_EMI) WHERE EMPLOYEE_ID_FK = ".$employee['EMPLOYEE_ID_FK']." AND BILL_ID_FK=".$model->ID.";")->execute();
					Yii::app()->db->createCommand("UPDATE tbl_salary_details SET OTHER_DED = (LIC + CCS + ASSOSC_SUB + MAINT_JAYAMAHAL + MAINT_MADIWALA) WHERE EMPLOYEE_ID_FK = ".$employee['EMPLOYEE_ID_FK']." AND BILL_ID_FK=".$model->ID.";")->execute();
					Yii::app()->db->createCommand("UPDATE tbl_salary_details SET NET = (GROSS - DED) WHERE EMPLOYEE_ID_FK = ".$employee['EMPLOYEE_ID_FK']." AND BILL_ID_FK=".$model->ID.";")->execute();
					Yii::app()->db->createCommand("UPDATE tbl_salary_details SET AMOUNT_BANK = (GROSS - DED - OTHER_DED - PT) WHERE EMPLOYEE_ID_FK = ".$employee['EMPLOYEE_ID_FK']." AND BILL_ID_FK=".$model->ID.";")->execute();
				}
			}
			
			echo "<script>alert('Data uploaded Successfully');</script>";
		}
			
		$this->render('ccs_import',array(
			'model'=>$model,
			'content'=>$content
		));
	}
	
	public function AllCCSToBeZero($id)
	{
		$salaries = SalaryDetails::model()->findAll('BILL_ID_FK='.$id);
		foreach($salaries as $salary){
			$emp_id =  $salary->EMPLOYEE_ID_FK;
			Yii::app()->db->createCommand("UPDATE tbl_salary_details SET CCS = 0 WHERE EMPLOYEE_ID_FK = ".$emp_id." AND BILL_ID_FK=".$id.";")->execute();
			Yii::app()->db->createCommand("UPDATE tbl_salary_details SET GROSS = (BASIC + HRA  + DA  + TA  + SP + PP) WHERE EMPLOYEE_ID_FK = ".$emp_id." AND BILL_ID_FK=".$id.";")->execute();
			Yii::app()->db->createCommand("UPDATE tbl_salary_details SET DED = (IT  + CGHS  + LF  + CGEGIS  + CPF_TIER_I  + CPF_TIER_II + MISC + PLI + COURT_ATTACHMENT + HBA_EMI + MCA_EMI + COMP_EMI) WHERE EMPLOYEE_ID_FK = ".$emp_id." AND BILL_ID_FK=".$id.";")->execute();
			Yii::app()->db->createCommand("UPDATE tbl_salary_details SET OTHER_DED = (LIC + CCS + ASSOSC_SUB + MAINT_JAYAMAHAL + MAINT_MADIWALA) WHERE EMPLOYEE_ID_FK = ".$emp_id." AND BILL_ID_FK=".$id.";")->execute();
			Yii::app()->db->createCommand("UPDATE tbl_salary_details SET NET = (GROSS - DED) WHERE EMPLOYEE_ID_FK = ".$emp_id." AND BILL_ID_FK=".$id.";")->execute();
			Yii::app()->db->createCommand("UPDATE tbl_salary_details SET AMOUNT_BANK = (GROSS - DED - OTHER_DED - PT) WHERE EMPLOYEE_ID_FK = ".$emp_id." AND BILL_ID_FK=".$id.";")->execute();
		}
	}
	
	
	public function actionAllITToBeZero($id)
	{
		$salaries = SalaryDetails::model()->findAll('BILL_ID_FK='.$id);
		
		foreach($salaries as $salary){
			$emp_id =  $salary->EMPLOYEE_ID_FK;
			Yii::app()->db->createCommand("UPDATE tbl_salary_details SET IT = 0 WHERE EMPLOYEE_ID_FK = ".$emp_id." AND BILL_ID_FK=".$id.";")->execute();
			Yii::app()->db->createCommand("UPDATE tbl_salary_details SET GROSS = (BASIC + HRA  + DA  + TA  + SP + PP) WHERE EMPLOYEE_ID_FK = ".$emp_id." AND BILL_ID_FK=".$id.";")->execute();
			Yii::app()->db->createCommand("UPDATE tbl_salary_details SET DED = (IT  + CGHS  + LF  + CGEGIS  + CPF_TIER_I  + CPF_TIER_II + MISC + PLI + COURT_ATTACHMENT + HBA_EMI + MCA_EMI + COMP_EMI) WHERE EMPLOYEE_ID_FK = ".$emp_id." AND BILL_ID_FK=".$id.";")->execute();
			Yii::app()->db->createCommand("UPDATE tbl_salary_details SET OTHER_DED = (LIC + CCS + ASSOSC_SUB + MAINT_JAYAMAHAL + MAINT_MADIWALA) WHERE EMPLOYEE_ID_FK = ".$emp_id." AND BILL_ID_FK=".$id.";")->execute();
			Yii::app()->db->createCommand("UPDATE tbl_salary_details SET NET = (GROSS - DED) WHERE EMPLOYEE_ID_FK = ".$emp_id." AND BILL_ID_FK=".$id.";")->execute();
			Yii::app()->db->createCommand("UPDATE tbl_salary_details SET AMOUNT_BANK = (GROSS - DED - OTHER_DED - PT) WHERE EMPLOYEE_ID_FK = ".$emp_id." AND BILL_ID_FK=".$id.";")->execute();
		
		}
		$this->redirect(array('Bill/SalaryDetails', 'id'=>$id));
	}
	
	
	public function actionNPSDATAIncrese($id)
	{
		$model = $this->loadModel($id);
		if($model->IS_NPS_PAY_BILL){
			$salaries = SalaryDetails::model()->findAll('BILL_ID_FK='.$id);
			foreach($salaries as $salary){
				$emp_id =  $salary->EMPLOYEE_ID_FK;
				Yii::app()->db->createCommand("UPDATE tbl_salary_details SET DA = ROUND(BASIC*0.07), CPF_TIER_I = ROUND((BASIC + ROUND(BASIC*0.07))*0.1) WHERE EMPLOYEE_ID_FK = ".$emp_id." AND BILL_ID_FK=".$id.";")->execute();
				Yii::app()->db->createCommand("UPDATE tbl_salary_details SET TA = ROUND((TA * 107)/105)  WHERE EMPLOYEE_ID_FK = ".$emp_id." AND BILL_ID_FK=".$id." AND TA != 0;")->execute();
				Yii::app()->db->createCommand("UPDATE tbl_salary_details SET GROSS = (BASIC + HRA  + DA  + TA  + SP + PP) WHERE EMPLOYEE_ID_FK = ".$emp_id." AND BILL_ID_FK=".$id.";")->execute();
				Yii::app()->db->createCommand("UPDATE tbl_salary_details SET DED = (IT  + CGHS  + LF  + CGEGIS  + CPF_TIER_I  + CPF_TIER_II + MISC + PLI + COURT_ATTACHMENT + HBA_EMI + MCA_EMI + COMP_EMI) WHERE EMPLOYEE_ID_FK = ".$emp_id." AND BILL_ID_FK=".$id.";")->execute();
				Yii::app()->db->createCommand("UPDATE tbl_salary_details SET OTHER_DED = (LIC + CCS + ASSOSC_SUB + MAINT_JAYAMAHAL + MAINT_MADIWALA) WHERE EMPLOYEE_ID_FK = ".$emp_id." AND BILL_ID_FK=".$id.";")->execute();
				Yii::app()->db->createCommand("UPDATE tbl_salary_details SET NET = (GROSS - DED) WHERE EMPLOYEE_ID_FK = ".$emp_id." AND BILL_ID_FK=".$id.";")->execute();
				Yii::app()->db->createCommand("UPDATE tbl_salary_details SET AMOUNT_BANK = (GROSS - DED - OTHER_DED - PT) WHERE EMPLOYEE_ID_FK = ".$emp_id." AND BILL_ID_FK=".$id.";")->execute();
			}
			echo "DA Increase applied Successfully";exit;
		}
		else{
			echo "This is not NPS Pay Bill";exit;
		}
	}
	
	
	public function actionOPSDATAIncrese($id)
	{
		$model = $this->loadModel($id);
		if($model->IS_OPS_PAY_BILL){
			$salaries = SalaryDetails::model()->findAll('BILL_ID_FK='.$id);
			foreach($salaries as $salary){
				$emp_id =  $salary->EMPLOYEE_ID_FK;
				Yii::app()->db->createCommand("UPDATE tbl_salary_details SET DA = ROUND(BASIC*0.07) WHERE EMPLOYEE_ID_FK = ".$emp_id." AND BILL_ID_FK=".$id.";")->execute();
				Yii::app()->db->createCommand("UPDATE tbl_salary_details SET TA = ROUND((TA * 107)/105) WHERE EMPLOYEE_ID_FK = ".$emp_id." AND BILL_ID_FK=".$id." AND TA != 0;")->execute();
				Yii::app()->db->createCommand("UPDATE tbl_salary_details SET GROSS = (BASIC + HRA  + DA  + TA  + SP + PP) WHERE EMPLOYEE_ID_FK = ".$emp_id." AND BILL_ID_FK=".$id.";")->execute();
				Yii::app()->db->createCommand("UPDATE tbl_salary_details SET DED = (IT  + CGHS  + LF  + CGEGIS  + CPF_TIER_I  + CPF_TIER_II + MISC + PLI + COURT_ATTACHMENT + HBA_EMI + MCA_EMI + COMP_EMI) WHERE EMPLOYEE_ID_FK = ".$emp_id." AND BILL_ID_FK=".$id.";")->execute();
				Yii::app()->db->createCommand("UPDATE tbl_salary_details SET OTHER_DED = (LIC + CCS + ASSOSC_SUB + MAINT_JAYAMAHAL + MAINT_MADIWALA) WHERE EMPLOYEE_ID_FK = ".$emp_id." AND BILL_ID_FK=".$id.";")->execute();
				Yii::app()->db->createCommand("UPDATE tbl_salary_details SET NET = (GROSS - DED) WHERE EMPLOYEE_ID_FK = ".$emp_id." AND BILL_ID_FK=".$id.";")->execute();
				Yii::app()->db->createCommand("UPDATE tbl_salary_details SET AMOUNT_BANK = (GROSS - DED - OTHER_DED - PT) WHERE EMPLOYEE_ID_FK = ".$emp_id." AND BILL_ID_FK=".$id.";")->execute();
			}
			echo "DA Increase applied Successfully";exit;
		}
		else{
			echo "This is not OPS Pay Bill";exit;
		}
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
		$data=BillSubType::model()->findAll(array("condition" => "TYPE = ".(int) $_POST['Bill']['BILL_TYPE'] ,"order" => "SUB_TYPE"));
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
	
	public function actionReGenerate($id){
		$model = Bill::model()->findByPK($id);
		$model->PFMS_STATUS = "Generated";
		$model->PASSED_DATE = NULL;
		$model->save(false);
		
		$model=new Bill('search');
		$model->unsetAttributes();
		
		$this->redirect(array('Bill/admin'));
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
	
	public function getBillPeriods($id){
		$bill = Bill::model()->findByPK($id);
		$periods = array();
		
		if($bill->IS_MULTIPLE_MONTH){
			$start    = (new DateTime($bill->YEAR.'-'.$bill->MONTH.'-01'))->modify('first day of this month');
			$end      = (new DateTime($bill->YEAR_END.'-'.$bill->MONTH_END.'-01'))->modify('last day of this month');
			$interval = DateInterval::createFromDateString('1 month');
			$intervals   = new DatePeriod($start, $interval, $end);

			foreach ($intervals as $int) {
				array_push($periods, array('FORMAT'=> $int->format("M-Y"), 'MONTH'=>$int->format("n"), 'YEAR'=>$int->format("Y")));
			}
		}
		else{
			$int    = (new DateTime($bill->YEAR.'-'.$bill->MONTH.'-01'))->modify('first day of this month');
			array_push($periods, array('FORMAT'=> $int->format("M-Y"), 'MONTH'=>$int->format("n"), 'YEAR'=>$int->format("Y")));
		}
		
		return $periods;
	}
	
	public function actionSalaryDetails($id)
	{
		$model = $this->loadModel($id);
		
		$this->SaveSalaryDetail($id);
		
		$this->render('PAY/SalaryDetails',array(
			'model'=>$model,
		));
	}
	
	public function actionSalaryDetailsTabular($id)
	{
		$model = $this->loadModel($id);
		
		$this->SaveSalaryDetail($id);
		
		$this->render('PAY/SalaryDetailsTabular',array(
			'model'=>$model,
		));
	}
	
	public function actionSaveSalaryDetailAjax(){
		$bill_id = $_POST['BILL_ID_FK'];
		$SalaryDetails = null;
		if(SalaryDetails::model()->exists('BILL_ID_FK='.$_POST['BILL_ID_FK'].' AND EMPLOYEE_ID_FK='.$_POST['EMPLOYEE_ID_FK'].' AND MONTH='.$_POST['MONTH'].' AND YEAR='.$_POST['YEAR'])){
			$SalaryDetails = SalaryDetails::model()->find('BILL_ID_FK='.$_POST['BILL_ID_FK'].' AND EMPLOYEE_ID_FK='.$_POST['EMPLOYEE_ID_FK'].' AND MONTH='.$_POST['MONTH'].' AND YEAR='.$_POST['YEAR']);
		}
		else{
			$SalaryDetails = new SalaryDetails;
		}
		
		$SalaryDetails->IS_SALARY_BILL = $_POST['IS_SALARY_BILL'];
		$SalaryDetails->EMPLOYEE_ID_FK = $_POST['EMPLOYEE_ID_FK'];
		$SalaryDetails->BILL_ID_FK = $_POST['BILL_ID_FK'];
		$SalaryDetails->attributes = $_POST;
		$SalaryDetails->GROSS = isset($_POST['GROSS']) ? $_POST['GROSS'] : 0;
		$SalaryDetails->NET = isset($_POST['NET']) ? $_POST['NET'] : 0;
		$SalaryDetails->DED = isset($_POST['DED']) ? $_POST['DED'] : 0;
		$SalaryDetails->MONTH = $_POST['MONTH'];
		$SalaryDetails->YEAR = $_POST['YEAR'];
		$SalaryDetails->IS_HBA_RECOVERY = isset($_POST['IS_HBA_RECOVERY']) ? $_POST['IS_HBA_RECOVERY'] : 0;
		$SalaryDetails->IS_MCA_RECOVERY = isset($_POST['IS_MCA_RECOVERY']) ? $_POST['IS_MCA_RECOVERY'] : 0;
		$SalaryDetails->IS_FEST_RECOVERY = isset($_POST['IS_FEST_RECOVERY']) ? $_POST['IS_FEST_RECOVERY'] : 0;
		$SalaryDetails->IS_CYCLE_RECOVERY = isset($_POST['IS_CYCLE_RECOVERY']) ? $_POST['IS_CYCLE_RECOVERY'] : 0;
		$SalaryDetails->IS_FLOOD_RECOVERY = isset($_POST['IS_FLOOD_RECOVERY']) ? $_POST['IS_FLOOD_RECOVERY'] : 0;
		$SalaryDetails->IS_COMP_RECOVERY = isset($_POST['IS_COMP_RECOVERY']) ? $_POST['IS_COMP_RECOVERY'] : 0;
		if($SalaryDetails->save(false)){
			echo json_encode(array("message"=>"SUCCESS"));exit;
		}
		else{
			echo json_encode(array("message"=>"FAIL"));exit;
		}
	}
	
	public function SaveSalaryDetail($id){
		//echo "<pre>";print_r($_POST['SalaryDetails']);echo "</pre>";exit;
		$model = $this->loadModel($id);
		if(isset($_POST['SalaryDetails']['save']) && isset($_POST['SalaryDetails']) && isset($_POST['SalaryInfo'])){
			//echo "<pre>";print_r($_POST['SalaryDetails']);echo "</pre>";exit;
			$bill_id = Bill::model()->findByPK($_POST['SalaryInfo']['BILL_ID'])->ID;
			$periods = $this->getBillPeriods($id);
			$salaries = $_POST['SalaryDetails'];
			
			foreach($salaries as $salary){
				if(isset($salary['EMP_ID'])){
					$EMPLOYEE_ID = $salary['EMP_ID'];
					foreach($periods as $period){
						$MONTH = $period['MONTH'];
						$YEAR = $period['YEAR'];
					
						if(isset($salary[$YEAR][$MONTH])){
							$SalaryDetails = null;
							$PAY_DETAILS = $salary[$YEAR][$MONTH];
							if(SalaryDetails::model()->exists('BILL_ID_FK='.$bill_id.' AND EMPLOYEE_ID_FK='.$EMPLOYEE_ID.' AND MONTH='.$MONTH.' AND YEAR='.$YEAR)){
								$SalaryDetails = SalaryDetails::model()->find('BILL_ID_FK='.$bill_id.' AND EMPLOYEE_ID_FK='.$EMPLOYEE_ID.' AND MONTH='.$MONTH.' AND YEAR='.$YEAR);
							}
							else{
								$SalaryDetails = new SalaryDetails;
							}
							
							$SalaryDetails->IS_SALARY_BILL = $_POST['SalaryDetails']['IS_SALARY_BILL'];
							$SalaryDetails->EMPLOYEE_ID_FK = $EMPLOYEE_ID;
							$SalaryDetails->BILL_ID_FK = $bill_id;
							$SalaryDetails->attributes = $PAY_DETAILS;
							$SalaryDetails->GROSS = isset($PAY_DETAILS['GROSS']) ? $PAY_DETAILS['GROSS'] : 0;
							$SalaryDetails->NET = isset($PAY_DETAILS['NET']) ? $PAY_DETAILS['NET'] : 0;
							$SalaryDetails->DED = isset($PAY_DETAILS['DED']) ? $PAY_DETAILS['DED'] : 0;
							$SalaryDetails->MONTH = $MONTH;
							$SalaryDetails->YEAR = $YEAR;
							$SalaryDetails->IS_HBA_RECOVERY = isset($PAY_DETAILS['IS_HBA_RECOVERY']) ? $PAY_DETAILS['IS_HBA_RECOVERY'] : 0;
							$SalaryDetails->IS_MCA_RECOVERY = isset($PAY_DETAILS['IS_MCA_RECOVERY']) ? $PAY_DETAILS['IS_MCA_RECOVERY'] : 0;
							$SalaryDetails->IS_FEST_RECOVERY = isset($PAY_DETAILS['IS_FEST_RECOVERY']) ? $PAY_DETAILS['IS_FEST_RECOVERY'] : 0;
							$SalaryDetails->IS_CYCLE_RECOVERY = isset($PAY_DETAILS['IS_CYCLE_RECOVERY']) ? $PAY_DETAILS['IS_CYCLE_RECOVERY'] : 0;
							$SalaryDetails->IS_FLOOD_RECOVERY = isset($PAY_DETAILS['IS_FLOOD_RECOVERY']) ? $PAY_DETAILS['IS_FLOOD_RECOVERY'] : 0;
							$SalaryDetails->IS_COMP_RECOVERY = isset($PAY_DETAILS['IS_COMP_RECOVERY']) ? $PAY_DETAILS['IS_COMP_RECOVERY'] : 0;
							
							if(isset($PAY_DETAILS['UA'])){
								$SalaryDetails->UA = $PAY_DETAILS['UA'];
							}
							if(isset($PAY_DETAILS['BONUS'])){
								$SalaryDetails->BONUS = $PAY_DETAILS['BONUS'];
							}
							if(isset($PAY_DETAILS['CEA'])){
								$SalaryDetails->CEA = $PAY_DETAILS['CEA'];
							}
							if(isset($PAY_DETAILS['LTC_HTC'])){
								$SalaryDetails->LTC_HTC_GROSS = isset($PAY_DETAILS['LTC_HTC_GROSS']) ? $PAY_DETAILS['LTC_HTC_GROSS'] : 0;
								$SalaryDetails->LTC_HTC_ADVANCE = isset($PAY_DETAILS['LTC_HTC_ADVANCE']) ? $PAY_DETAILS['LTC_HTC_ADVANCE'] : 0;
								$SalaryDetails->LTC_HTC = $PAY_DETAILS['LTC_HTC'];
							}
							if(isset($PAY_DETAILS['EL_ENCASHMENT'])){
								$SalaryDetails->EL_ENCASHMENT = $PAY_DETAILS['EL_ENCASHMENT'];
								$SalaryDetails->BLOCK_YEAR = $PAY_DETAILS['BLOCK_YEAR'];
								$SalaryDetails->EL_ENCASH_DAYS = $PAY_DETAILS['EL_ENCASH_DAYS'];
								$SalaryDetails->EL_ENCASH_LEAVE_APPLIED = $PAY_DETAILS['EL_ENCASH_LEAVE_APPLIED'];
								$SalaryDetails->EL_ENCASH_LEAVE_BALANCE_BEFORE = $PAY_DETAILS['EL_ENCASH_LEAVE_BALANCE_BEFORE'];
								$SalaryDetails->PREVIOUS_EL_ENCASH_DAYS = $PAY_DETAILS['PREVIOUS_EL_ENCASH_DAYS'];
							}
							
							$SalaryDetails->save(false);
						}
					}
				}
			}
			
		}
		
		if(isset($_POST['SalaryDetails']['submit']) && isset($_POST['SalaryDetails']) && isset($_POST['SalaryInfo'])){
			$bill_id = Bill::model()->findByPK($_POST['SalaryInfo']['BILL_ID'])->ID;
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
		}
		
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
			//echo Yii::app()->session['FINANCIAL_YEAR'];exit;
			//echo "<pre>";print_r($_POST['Bill']);echo "</pre>";exit;
			$model->attributes=$_POST['Bill'];
			$model->FINANCIAL_YEAR_ID_FK = isset(Yii::app()->session['FINANCIAL_YEAR']) ? Yii::app()->session['FINANCIAL_YEAR'] : 
											FinancialYears::model()->find('STATUS=1')->ID;

			if(isset($_POST['Bill']['CONNECTED_LTC_ADVANCE_BILL'])){
				$model->RELATED_BILL_ID = $_POST['Bill']['CONNECTED_LTC_ADVANCE_BILL'];
			}
			if(isset($_POST['Bill']['CONNECTED_TOUR_TA_ADVANCE_BILL'])){
				$model->RELATED_BILL_ID = $_POST['Bill']['CONNECTED_TOUR_TA_ADVANCE_BILL'];
			}
			if(isset($_POST['Bill']['CONNECTED_TRANSFER_TA_ADVANCE_BILL'])){
				$model->RELATED_BILL_ID = $_POST['Bill']['CONNECTED_TRANSFER_TA_ADVANCE_BILL'];
			}
			if(isset($_POST['Bill']['CONNECTED_MEDICAL_ADVANCE_BILL'])){
				$model->RELATED_BILL_ID = $_POST['Bill']['CONNECTED_MEDICAL_ADVANCE_BILL'];
			}

			if(isset($_POST['Bill']['BILL_TYPE']) && ( $_POST['Bill']['BILL_TYPE'] == 1 || $_POST['Bill']['BILL_TYPE'] == 2 || $_POST['Bill']['BILL_TYPE'] == 8)){
				if($model->save(false)){
					if(isset($_POST['Bill']['BILL_TYPE']) && ( $_POST['Bill']['BILL_TYPE'] == 1 || $_POST['Bill']['BILL_TYPE'] == 2)){
						if(isset($_POST['Bill']['IS_SALARY_BILL']) && $_POST['Bill']['IS_SALARY_BILL'] == 1){
							$BillEmployees = new BillEmployees;
							$BillEmployees->BILL_ID = $model->ID;
							if($_POST['Bill']['BILL_TYPE'] == 1 )
								$BillEmployees->EMPLOYEE_ID = implode(",", $_POST['Bill']['Employee']['OPS']);
							if($_POST['Bill']['BILL_TYPE'] == 2 )
								$BillEmployees->EMPLOYEE_ID = implode(",", $_POST['Bill']['Employee']['NPS']);
							$BillEmployees->save(false);
						}
						if(isset($_POST['Bill']['IS_ARREAR_BILL']) && $_POST['Bill']['IS_ARREAR_BILL'] == 1){
							$BillEmployees = new BillEmployees;
							$BillEmployees->BILL_ID = $model->ID;
							if($_POST['Bill']['BILL_TYPE'] == 1 )
								$BillEmployees->EMPLOYEE_ID = implode(",", $_POST['Bill']['Employee']['OPS']);
							if($_POST['Bill']['BILL_TYPE'] == 2 )
								$BillEmployees->EMPLOYEE_ID = implode(",", $_POST['Bill']['Employee']['NPS']);
							$BillEmployees->save(false);
						}
						if(isset($_POST['Bill']['IS_DA_ARREAR_BILL']) && $_POST['Bill']['IS_DA_ARREAR_BILL'] == 1){
							$BillEmployees = new BillEmployees;
							$BillEmployees->BILL_ID = $model->ID;
							if($_POST['Bill']['BILL_TYPE'] == 1 )
								$BillEmployees->EMPLOYEE_ID = implode(",", $_POST['Bill']['Employee']['OPS']);
							if($_POST['Bill']['BILL_TYPE'] == 2 )
								$BillEmployees->EMPLOYEE_ID = implode(",", $_POST['Bill']['Employee']['NPS']);
							$BillEmployees->save(false);
						}
						if(isset($_POST['Bill']['IS_CEA_BILL']) && $_POST['Bill']['IS_CEA_BILL'] == 1){
							$BillEmployees = new BillEmployees;
							$BillEmployees->BILL_ID = $model->ID;
							if($_POST['Bill']['BILL_TYPE'] == 1 )
								$BillEmployees->EMPLOYEE_ID = implode(",", $_POST['Bill']['Employee']['OPS']);
							if($_POST['Bill']['BILL_TYPE'] == 2 )
								$BillEmployees->EMPLOYEE_ID = implode(",", $_POST['Bill']['Employee']['NPS']);
							$BillEmployees->save(false);
							
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
						if(isset($_POST['Bill']['IS_BONUS_BILL']) && $_POST['Bill']['IS_BONUS_BILL'] == 1 && ($_POST['Bill']['BILL_TYPE'] == 1 || $_POST['Bill']['BILL_TYPE'] == 2)){
							$BillEmployees = new BillEmployees;
							$BillEmployees->BILL_ID = $model->ID;
							if($_POST['Bill']['BILL_TYPE'] == 1 )
								$BillEmployees->EMPLOYEE_ID = implode(",", $_POST['Bill']['Employee']['OPS_BONUS']);
							if($_POST['Bill']['BILL_TYPE'] == 2 )
								$BillEmployees->EMPLOYEE_ID = implode(",", $_POST['Bill']['Employee']['NPS_BONUS']);
							$BillEmployees->save(false);
						}
						if(isset($_POST['Bill']['IS_UA_BILL']) && $_POST['Bill']['IS_UA_BILL'] == 1){
							$BillEmployees = new BillEmployees;
							$BillEmployees->BILL_ID = $model->ID;
							$BillEmployees->EMPLOYEE_ID = implode(",", $_POST['Bill']['Employee']['UA']);
							$BillEmployees->save(false);
						}
						if(isset($_POST['Bill']['IS_LTC_ADVANCE_BILL']) && $_POST['Bill']['IS_LTC_ADVANCE_BILL'] == 1){
							$BillEmployees = new BillEmployees;
							$BillEmployees->BILL_ID = $model->ID;
							if($_POST['Bill']['BILL_TYPE'] == 1 )
								$BillEmployees->EMPLOYEE_ID = implode(",", $_POST['Bill']['Employee']['OPS']);
							if($_POST['Bill']['BILL_TYPE'] == 2 )
								$BillEmployees->EMPLOYEE_ID = implode(",", $_POST['Bill']['Employee']['NPS']);
							$BillEmployees->save(false);
						}
						if(isset($_POST['Bill']['IS_LTC_CLAIM_BILL']) && $_POST['Bill']['IS_LTC_CLAIM_BILL'] == 1){
							$BillEmployees = new BillEmployees;
							$BillEmployees->BILL_ID = $model->ID;
							if($_POST['Bill']['BILL_TYPE'] == 1 )
								$BillEmployees->EMPLOYEE_ID = implode(",", $_POST['Bill']['Employee']['OPS']);
							if($_POST['Bill']['BILL_TYPE'] == 2 )
								$BillEmployees->EMPLOYEE_ID = implode(",", $_POST['Bill']['Employee']['NPS']);
							$BillEmployees->save(false);
						}
						if(isset($_POST['Bill']['IS_EL_ENCASHMENT_BILL']) && $_POST['Bill']['IS_EL_ENCASHMENT_BILL'] == 1){
							$BillEmployees = new BillEmployees;
							$BillEmployees->BILL_ID = $model->ID;
							if($_POST['Bill']['BILL_TYPE'] == 1 )
								$BillEmployees->EMPLOYEE_ID = implode(",", $_POST['Bill']['Employee']['OPS']);
							if($_POST['Bill']['BILL_TYPE'] == 2 )
								$BillEmployees->EMPLOYEE_ID = implode(",", $_POST['Bill']['Employee']['NPS']);
							$BillEmployees->save(false);
						}
						if(isset($_POST['Bill']['IS_RECOVERY_BILL']) && $_POST['Bill']['IS_RECOVERY_BILL'] == 1){
							$BillEmployees = new BillEmployees;
							$BillEmployees->BILL_ID = $model->ID;
							if($_POST['Bill']['BILL_TYPE'] == 1 )
								$BillEmployees->EMPLOYEE_ID = implode(",", $_POST['Bill']['Employee']['OPS']);
							if($_POST['Bill']['BILL_TYPE'] == 2 )
								$BillEmployees->EMPLOYEE_ID = implode(",", $_POST['Bill']['Employee']['NPS']);
							$BillEmployees->save(false);
						}
					}
					if(isset($_POST['Bill']['BILL_TYPE']) && $_POST['Bill']['BILL_TYPE'] == 8){
						$BillEmployees = new BillEmployees;
						$BillEmployees->BILL_ID = $model->ID;
						if(isset($_POST['Bill']['IS_SALARY_BILL']) && $_POST['Bill']['IS_SALARY_BILL'] == 1){
							$BillEmployees->EMPLOYEE_ID = implode(",", $_POST['Bill']['Employee']['WAGES']);
						}
						if(isset($_POST['Bill']['IS_BONUS_BILL']) && $_POST['Bill']['IS_BONUS_BILL'] == 1){
							$BillEmployees->EMPLOYEE_ID = implode(",", $_POST['Bill']['Employee']['WAGES_BONUS']);
						}
						if(isset($_POST['Bill']['IS_DA_ARREAR_BILL']) && $_POST['Bill']['IS_DA_ARREAR_BILL'] == 1){
							$BillEmployees->EMPLOYEE_ID = implode(",", $_POST['Bill']['Employee']['WAGES']);
						}
						$BillEmployees->save(false);
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
					$BillEmployees = new BillEmployees;
					$BillEmployees->BILL_ID = $model->ID;
					$BillEmployees->EMPLOYEE_ID = implode(",", $_POST['Bill']['Employee']['DTE']);
					$BillEmployees->save(false);
					
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
					$BillEmployees = new BillEmployees;
					$BillEmployees->BILL_ID = $model->ID;
					$BillEmployees->EMPLOYEE_ID = implode(",", $_POST['Bill']['Employee']['MEDICAL']);
					$BillEmployees->save(false);
					
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

	public function actionPayBillValidate($id){
		$model = $this->loadModel($id);
		$this->amountInWords = $this->amountToWord($model->BILL_AMOUNT);
		
		if(isset($_POST['Employee'])){
			$employee_ids = $_POST['Employee']['ID'];
			foreach($employee_ids as $emp_id){
				$id = $model->ID;
				Yii::app()->db->createCommand("UPDATE tbl_salary_details SET GROSS = (BASIC + HRA  + DA  + TA  + SP + PP) WHERE EMPLOYEE_ID_FK = ".$emp_id." AND BILL_ID_FK=".$id.";")->execute();
				Yii::app()->db->createCommand("UPDATE tbl_salary_details SET DED = (IT  + CGHS  + LF  + CGEGIS  + CPF_TIER_I  + CPF_TIER_II + MISC + PLI + COURT_ATTACHMENT + HBA_EMI + MCA_EMI + COMP_EMI) WHERE EMPLOYEE_ID_FK = ".$emp_id." AND BILL_ID_FK=".$id.";")->execute();
				Yii::app()->db->createCommand("UPDATE tbl_salary_details SET OTHER_DED = (LIC + CCS + ASSOSC_SUB + MAINT_JAYAMAHAL + MAINT_MADIWALA) WHERE EMPLOYEE_ID_FK = ".$emp_id." AND BILL_ID_FK=".$id.";")->execute();
				Yii::app()->db->createCommand("UPDATE tbl_salary_details SET NET = (GROSS - DED) WHERE EMPLOYEE_ID_FK = ".$emp_id." AND BILL_ID_FK=".$id.";")->execute();
				Yii::app()->db->createCommand("UPDATE tbl_salary_details SET AMOUNT_BANK = (GROSS - DED - OTHER_DED - PT) WHERE EMPLOYEE_ID_FK = ".$emp_id." AND BILL_ID_FK=".$id.";")->execute();
			}
		}
		$this->render('PAY/PayBillValidate',array('model'=>$model));
	}
	
	
	public function actionPayBillChanges($id){
		$this->layout = '//layouts/layouts/column1';
		$model = $this->loadModel($id);

		$salaries = Yii::app()->db->createCommand("SELECT * FROM tbl_salary_details WHERE BILL_ID_FK=".$model->ID)->queryAll();
		$changes = array();

		foreach($salaries as $salary){
			$employee = Employee::model()->findByPk($salary['EMPLOYEE_ID_FK']);
			$MONTH = $salary['MONTH'];
			$YEAR = $salary['YEAR'];
			$CURRENT_SALARY = $salary;
			$LAST_SALARY = null;
			if(SalaryDetails::model()->exists('IS_SALARY_BILL = 1 AND EMPLOYEE_ID_FK='.$employee->ID.' AND YEAR='.(($MONTH ==1) ? ($YEAR - 1 ) : $YEAR).' AND MONTH='.(($MONTH ==1) ? 12 : ($MONTH - 1)))){
				$LAST_SALARY = Yii::app()->db->createCommand("SELECT * FROM tbl_salary_details WHERE IS_SALARY_BILL = 1 AND EMPLOYEE_ID_FK=".$employee->ID." AND YEAR=".(($MONTH ==1) ? ($YEAR - 1 ) : $YEAR)." AND MONTH=".(($MONTH ==1) ? 12 : ($MONTH - 1)))->queryRow();
			}
			else if(SupplementarySalaryDetails::model()->exists('EMPLOYEE_ID_FK='.$employee->ID.' AND YEAR='.(($MONTH ==1) ? ($YEAR - 1 ) : $YEAR).' AND MONTH='.(($MONTH ==1) ? 12 : ($MONTH - 1)))){
				$LAST_SALARY = Yii::app()->db->createCommand("SELECT * FROM tbl_supplementary_salary_details WHERE EMPLOYEE_ID_FK=".$employee->ID." AND YEAR=".(($MONTH ==1) ? ($YEAR - 1 ) : $YEAR)." AND MONTH=".(($MONTH ==1) ? 12 : ($MONTH - 1)))->queryRow();
			}
			if(count($LAST_SALARY) > 0 && count($CURRENT_SALARY) > 0)
			$change = $this->calculateChanges($CURRENT_SALARY, $LAST_SALARY, $employee->PENSION_TYPE);
			if($change){
				$message = "<b style='font-weight: bold;'>".$employee->NAME.", ".Designations::model()->findByPk($employee->DESIGNATION_ID_FK)->DESIGNATION. "</b>: ".$change;
				array_push($changes, $message);
			}
		}
	
		$this->render('PAY/PayBillChanges',array('model'=>$model,'changes'=>$changes));
	}
	
	public function actionPayBillTasks($id){
		$this->layout = '//layouts/layouts/column1';
		$model = $this->loadModel($id);
		$month = $model->MONTH;
		$year = $model->YEAR;
		$paybill_tasks = array();
		
		$salaries = SalaryDetails::model()->findAll('BILL_ID_FK='.$id);
		
		foreach($salaries as $salary){
			$task = PayBillTasks::model()->find('EMPLOYEE_ID_FK='.$salary->EMPLOYEE_ID_FK.' AND MONTH='.$month.' AND YEAR='.$year);
			if($task){
				$employee = Employee::model()->findByPK($salary->EMPLOYEE_ID_FK);
				$message = "<b style='font-weight: bold;'>".$employee->NAME.", ".Designations::model()->findByPk($employee->DESIGNATION_ID_FK)->DESIGNATION. "</b>: ".$task->TASK;
				array_push($paybill_tasks, $message);
			}
			
		}
		
		$this->render('PAY/PayBillTasks',array('model'=>$model,'changes'=>$paybill_tasks));
	}
	
	
	
	public function actionPayBillChangesNotified($bill_id, $change_id){
		$change = Changes::model()->find("BILL_ID_FK=".$bill_id." AND ID=".$change_id);
		$change->STATUS = 1;
		$change->save(false);
		$this->redirect(Yii::app()->createUrl('Bill/PayBillChanges', array('id'=>$bill_id)));	
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
	public function calculateChanges($newArray, $oldArray, $pensionType){
		$length = count($newArray);
		$result = array();
		foreach($newArray as $key=>$value){
			if($key != "MONTH" && $key != "YEAR" && $key != "ID" && $key != "BILL_ID_FK" && $key != "EMPLOYEE_ID_FK" && $key != "WA" && $key != "GROSS" 
			&& $key != "DED" && $key != "NET" && $key != "OTHER_DED" && $key != "AMOUNT_BANK" && $key != "CEA" && $key != "UA" && $key != "BONUS" && 
			$key != "LTC_HTC" && $key != "IS_SALARY_BILL" && $key != "RECOVERY" && $key != "EL_ENCASHMENT" && $key != "LTC_HTC_GROSS" && $key != "LTC_HTC_ADVANCE" &&
			$key != "CEA_TUITION" && $key != "CEA_OTHER" && $key != "EL_ENCASH_DAYS" && $key != "EL_ENCASH_LEAVE_APPLIED" && $key != "EL_ENCASH_LEAVE_BALANCE_BEFORE" && 
			$key != "EL_ENCASH_LEAVE_BALANCE_BEFORE" && $key != "PREVIOUS_EL_ENCASH_DAYS" && $key != "BLOCK_YEAR"){
				 if($oldArray[$key] != $newArray[$key]){
					 $salaryModel = SalaryDetails::model();
					 $oldValue = "";
					 $newValue = "";
					 $attributeLabel = "";
					 
					 if($key == "IS_HBA_RECOVERY" || $key == "IS_MCA_RECOVERY" || $key == "IS_COMP_RECOVERY" || $key == "IS_FEST_RECOVERY" || $key == "IS_CYCLE_RECOVERY"){
						$oldValue = ($oldArray[$key] == 1) ? "INTEREST" : "PRINCIPAL";
						$newValue = ($newArray[$key] == 1) ? "INTEREST" : "PRINCIPAL";
					 }
					 else{
						$oldValue = $oldArray[$key];
						$newValue = $newArray[$key];
					 }
					 
					 if($key == "CPF_TIER_I"){
						$attributeLabel = ($pensionType == "OPS") ? "GPFC" : "CPF TIER I";
					 }
					 else if($key == "CPF_TIER_I"){
						$attributeLabel = ($pensionType == "NPS") ? "GPFR" : "CPF TIER II";
					 }
					 else{
						$attributeLabel = $salaryModel->getAttributeLabel($key);
					 }
					 
					 array_push($result, $attributeLabel." changes from ". $oldValue." to ".$newValue);
				 }
				 
			 }
		}
		
		return implode(",", $result);
	}
	
	public function actionEmployeeBillFront($id){$this->layout='//layouts/column1';$model = $this->loadModel($id);$this->render('PAY/EmployeeBillFront',array('model'=>$model,));}
	public function actionEmployeeBillInner($id){$this->layout='//layouts/column1';$model = $this->loadModel($id);$this->amountInWords = $this->amountToWord($model->BILL_AMOUNT);$this->render('PAY/EmployeeBillInner',array('model'=>$model,));}
	public function actionEmployeeBillPart1($id){$this->layout='//layouts/column1';$model = $this->loadModel($id);$this->amountInWords = $this->amountToWord($model->BILL_AMOUNT);$this->render('PAY/EmployeeBillPart1',array('model'=>$model,));}
	public function actionEmployeeCEABillInner($id){$this->layout='//layouts/column1';$model = $this->loadModel($id);$this->amountInWords = $this->amountToWord($model->BILL_AMOUNT);$this->render('PAY/EmployeeCEABillInner',array('model'=>$model,));}
	public function actionCEASanctionOrder($id){$this->layout='//layouts/column1';$model = $this->loadModel($id);$this->amountInWords = $this->amountToWord($model->BILL_AMOUNT);$this->render('PAY/CEASanctionOrder',array('model'=>$model,));}
	public function actionEmployeeBillPart2($id){$this->layout='//layouts/column1';$model = $this->loadModel($id);$this->render('PAY/EmployeeBillPart2',array('model'=>$model,));}
	public function actionEmployeeTADABillInner($id){$this->layout='//layouts/column1';$model = $this->loadModel($id);$this->amountInWords = $this->amountToWord($model->BILL_AMOUNT);$this->render('PAY/EmployeeTADABillInner',array('model'=>$model,));}
	public function actionEmployeeBonusBillInner($id){$this->layout='//layouts/column1';$model = $this->loadModel($id);$this->amountInWords = $this->amountToWord($model->BILL_AMOUNT);$this->render('PAY/EmployeeBonusBillInner',array('model'=>$model,));}
	public function actionEmployeeUABillInner($id){$this->layout='//layouts/column1';$model = $this->loadModel($id);$this->amountInWords = $this->amountToWord($model->BILL_AMOUNT);$this->render('PAY/EmployeeUABillInner',array('model'=>$model,));}
	public function actionUANoteSheet($id){$this->layout='//layouts/column1';$model = $this->loadModel($id);$this->amountInWords = $this->amountToWord($model->BILL_AMOUNT);$this->render('PAY/UANoteSheet',array('model'=>$model,));}	
	public function actionUASanctionOrder($id){$this->layout='//layouts/column1';$model = $this->loadModel($id);$this->amountInWords = $this->amountToWord($model->BILL_AMOUNT);$this->render('PAY/UASanctionOrder',array('model'=>$model,));}
	public function actionEmployeeELEncashBillInner($id){$this->layout='//layouts/column1';$model = $this->loadModel($id);$this->amountInWords = $this->amountToWord($model->BILL_AMOUNT);$this->render('PAY/EmployeeELEncashBillInner',array('model'=>$model,));}
	public function actionElEncashSanctionOrder($id){$this->layout='//layouts/column1';$model = $this->loadModel($id);$this->amountInWords = $this->amountToWord($model->BILL_AMOUNT);$this->render('PAY/ElEncashSanctionOrder',array('model'=>$model,));}
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
	public function actionCOMPUTER($id){$this->layout='//layouts/column1';$model = $this->loadModel($id);$this->render('PAY/COMPUTER',array('model'=>$model,));}
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
	public function actionMedicalBillFront($id){$this->layout='//layouts/column1';$model = $this->loadModel($id);$this->render('MEDICAL/MedicalFront',array('model'=>$model,));}
	public function actionMedicalBillBack($id){$this->layout='//layouts/column1';$model = $this->loadModel($id);$this->render('MEDICAL/MedicalBack',array('model'=>$model,));}
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
	public function actionCasualBonusBillInner($id){$this->layout='//layouts/column1';$model = $this->loadModel($id);$this->render('PAY/CasualBonusBillInner',array('model'=>$model,));}
	public function actionCasualPayBillPT($id){$this->layout='//layouts/column1';$model = $this->loadModel($id);$this->render('PAY/CasualPayBillPT',array('model'=>$model,));}
	public function actionHBA_INTEREST($id){$this->layout='//layouts/column1';$model = $this->loadModel($id);$this->render('PAY/HBA_INTEREST',array('model'=>$model,));}
	public function actionCOMPUTER_INTEREST($id){$this->layout='//layouts/column1';$model = $this->loadModel($id);$this->render('PAY/COMPUTER_INTEREST',array('model'=>$model,));}
	public function actionFLOOD_INTEREST($id){$this->layout='//layouts/column1';$model = $this->loadModel($id);$this->render('PAY/FLOOD_INTEREST',array('model'=>$model,));}
	public function actionFEST_INTEREST($id){$this->layout='//layouts/column1';$model = $this->loadModel($id);$this->render('PAY/FEST_INTEREST',array('model'=>$model,));}
	public function actionMCA_INTEREST($id){$this->layout='//layouts/column1';$model = $this->loadModel($id);$this->render('PAY/MCA_INTEREST',array('model'=>$model,));}
	public function actionCYCLE__INTEREST($id){$this->layout='//layouts/column1';$model = $this->loadModel($id);$this->render('PAY/CYCLE__INTEREST',array('model'=>$model,));}
	public function actionLIC_PREMIUM($id){$this->layout='//layouts/column1';$model = $this->loadModel($id);$this->render('PAY/LIC_PREMIUM',array('model'=>$model,));}
	public function actionPLI_PREMIUM($id){$this->layout='//layouts/column1';$model = $this->loadModel($id);$this->render('PAY/PLI_PREMIUM',array('model'=>$model,));}
	public function actionLIC_PREMIUM_COVER($id){$this->layout='//layouts/column1';$model = $this->loadModel($id);$this->render('PAY/LIC_PREMIUM_COVER',array('model'=>$model,));}
	public function actionMADIWALA($id){$this->layout='//layouts/column1';$model = $this->loadModel($id);$this->render('PAY/MADIWALA',array('model'=>$model,));}
	public function actionJAYAMAHAL($id){$this->layout='//layouts/column1';$model = $this->loadModel($id);$this->render('PAY/JAYAMAHAL',array('model'=>$model,));}
	public function actionCOURT($id){$this->layout='//layouts/column1';$model = $this->loadModel($id);$this->render('PAY/COURT',array('model'=>$model,));}
	public function actionASSOCIATION($id){$this->layout='//layouts/column1';$model = $this->loadModel($id);$this->render('PAY/ASSOCIATION',array('model'=>$model,));}

}

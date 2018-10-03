<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/oneadmin.css" rel="stylesheet">
<?php $master = Master::model()->findByPK(1); ?>
<?php
	
	$monthName = array('1'=>'JAN', '2'=>'FEB', '3'=>'MAR', '4'=>'APR', '5'=>'MAY', '6'=>'JUN', '7'=>'JUL', '8'=>'AUG', '9'=>'SEP', '10'=>'OCT', '11'=>'NOV', '12'=>'DEC');
	$master = Master::model()->findByPK(1);
	$financialYear = FinancialYears::model()->findByPk(Yii::app()->session['FINANCIAL_YEAR']);
	$StartYear = date('Y', strtotime($financialYear->START_DATE));
	$EndYear = date('Y', strtotime($financialYear->END_DATE));
	$CurrentFinancialYearPeriods = array('3-'.$StartYear,'4-'.$StartYear,'5-'.$StartYear,'6-'.$StartYear, '7-'.$StartYear, '8-'.$StartYear, '9-'.$StartYear, '10-'.$StartYear, '11-'.$StartYear, '12-'.$StartYear,'1-'.$EndYear, '2-'.$EndYear);
	$OTA_BILL_TYPE = 5;
	$HONORIUM_BILL_TYPE = 12;
	
	$TAX_SLABS_I_MIN = 0;
	$TAX_SLABS_I_MAX = 250000;
	$TAX_SLABS_I_RATE = 0;
	
	$TAX_SLABS_II_MIN = 250000;
	$TAX_SLABS_II_MAX = 500000;
	$TAX_SLABS_II_RATE = 5;
	
	$TAX_SLABS_III_MIN = 500000;
	$TAX_SLABS_III_MAX = 1000000;
	$TAX_SLABS_III_RATE = 20;
	
	$TAX_SLABS_IV_MIN = 1000000;
	$TAX_SLABS_IV_MAX = 10000000000;
	$TAX_SLABS_IV_RATE = 30;
	
	$employeeIds = $list;
	
	$IS_AJAX_REQUEST = isset($_GET['ajax']) ? true : false;
	
?>
<style>
	*{font-size: 10px;}
	table.full{width: 100%;height:100%;page-break-after:always }
	table {border-collapse: collapse;}
	tr, td{border: 1px solid #000;border-collapse: collapse;}
	td{text-align: center;}
	.no-bottom-border {border-bottom: none;}
	.no-border {border: none;}
	.no-right-border {border-right: none;}
	.left-text {text-align: left;padding-left: 10px;}
	.right-text {text-align: right;padding-right: 10px;}
</style>
<table class="one-table">
<?php 
	foreach($employeeIds as $id){
		$employee = Employee::model()->findByPK($id);
		$investment = Investments::model()->find('EMPLOYEE_ID = '.$employee->ID.' AND FINANCIAL_YEAR_ID_FK = '.$financialYear->ID);
		$SALARIES = array();
		$TOTAL_SALARIES = array();
		$DA_TA_ARREAR = 0;
		$i=0;
		$j=0;
		$k=0;
		$JoinZeroSalaryIndex = -1;
		$JoinSalaryCreditPeriod = isset($employee->CURRENT_OFFICE_JOIN_DATE) ? 
				date('n-Y', strtotime($employee->CURRENT_OFFICE_JOIN_DATE)) : '';
				
		$ExitZeroSalaryIndex = -1;
		$ExitSalaryCreditPeriod = isset($employee->CURRENT_OFFICE_RELIEF_DATE) ? 
				date('n-Y', strtotime($employee->CURRENT_OFFICE_RELIEF_DATE)) : '';
		
		if($JoinSalaryCreditPeriod){
			foreach($CurrentFinancialYearPeriods as $period){
				if($JoinSalaryCreditPeriod == $period){
					$JoinZeroSalaryIndex = $k - 1;
				}
				else{
					$k++;
				}
			}
		}
		
		
		
		
		if($ExitSalaryCreditPeriod){
			foreach($CurrentFinancialYearPeriods as $period){
				if($ExitSalaryCreditPeriod == $period){
					$ExitZeroSalaryIndex = $j + 1;
				}
				else{
					$j++;
				}
			}
		}
		
		if($ExitZeroSalaryIndex <= -1){
			$ExitZeroSalaryIndex = 12;
		}
		
		//echo $JoinZeroSalaryIndex." | ".$ExitZeroSalaryIndex;exit;
		foreach($CurrentFinancialYearPeriods as $period){
			$MONTH = explode('-', $period)[0];
			$YEAR = explode('-', $period)[1];
			
			
			if($i <= $JoinZeroSalaryIndex || $i >= $ExitZeroSalaryIndex){
				array_push($SALARIES, array(
					'MONTH'=>$MONTH,
					'YEAR'=>$YEAR,
					'PERIOD'=>$monthName[$MONTH].'-'.$YEAR,
					'BASIC'=>0,
					'PP_SP'=>0,
					'TA'=>0,
					'HRA'=>0,
					'DA'=>0,
					'TOTAL'=>0,
					'CGEGIS'=>0,
					'CGHS'=>0,
					'CPF'=>0,
					'PT'=>0,
					'IT'=>0,
					'PLI'=>0,
					'LIC'=>0,
					'MISC'=>0,
					'TYPE'=>'SALARY'
				));
			}
			else{
				if(SalaryDetails::model()->exists('EMPLOYEE_ID_FK='.$id.' AND MONTH='.$MONTH.' AND YEAR='.$YEAR.' AND IS_SALARY_BILL=1')){
					$salary = SalaryDetails::model()->find('EMPLOYEE_ID_FK='.$id.' AND MONTH='.$MONTH.' AND YEAR='.$YEAR.' AND IS_SALARY_BILL=1');
					array_push($SALARIES, array(
						'MONTH'=>$MONTH,
						'YEAR'=>$YEAR,
						'PERIOD'=>$monthName[$salary->MONTH].'-'.$salary->YEAR,
						'BASIC'=>$salary->BASIC,
						'PP_SP'=>($salary->PP+$salary->SP),
						'TA'=>$salary->TA,
						'HRA'=>$salary->HRA,
						'DA'=>$salary->DA,
						'TOTAL'=>($salary->BASIC+$salary->PP+$salary->SP+$salary->TA+$salary->HRA+$salary->DA),
						'CGEGIS'=>$salary->CGEGIS,
						'CGHS'=>$salary->CGHS,
						'CPF'=>($salary->CPF_TIER_I),
						'PT'=>$salary->PT,
						'IT'=>$salary->IT,
						'PLI'=>$salary->PLI,
						'LIC'=>$salary->LIC,
						'MISC'=>$salary->MISC,
						'TYPE'=>'SALARY'
					));
				}
				else if(SupplementarySalaryDetails::model()->exists('EMPLOYEE_ID_FK='.$id.' AND MONTH='.$MONTH.' AND YEAR='.$YEAR)){
					$salary = SupplementarySalaryDetails::model()->find('EMPLOYEE_ID_FK='.$id.' AND MONTH='.$MONTH.' AND YEAR='.$YEAR);
					array_push($SALARIES, array(
						'MONTH'=>$MONTH,
						'YEAR'=>$YEAR,
						'PERIOD'=>$monthName[$salary->MONTH].'-'.$salary->YEAR,
						'BASIC'=>$salary->BASIC,
						'PP_SP'=>($salary->PP+$salary->SP),
						'TA'=>$salary->TA,
						'HRA'=>$salary->HRA,
						'DA'=>$salary->DA,
						'TOTAL'=>($salary->BASIC+$salary->PP+$salary->SP+$salary->TA+$salary->HRA+$salary->DA),
						'CGEGIS'=>$salary->CGEGIS,
						'CGHS'=>$salary->CGHS,
						'CPF'=>($salary->CPF_TIER_I),
						'PT'=>$salary->PT,
						'IT'=>$salary->IT,
						'PLI'=>$salary->PLI,
						'LIC'=>$salary->LIC,
						'MISC'=>$salary->MISC,
						'TYPE'=>'SALARY'
					));
				}
				else if(findLastMonthSalary($SALARIES, $i)){
					$salary = findLastMonthSalary($SALARIES, $i);
					$salary['MONTH'] = $MONTH;
					$salary['YEAR'] = $YEAR;
					$salary['PERIOD'] = $monthName[$MONTH].'-'.$YEAR;
					$salary['IT'] = 0;
					array_push($SALARIES, $salary);
				}
				else{
					array_push($SALARIES, array(
						'MONTH'=>$MONTH,
						'YEAR'=>$YEAR,
						'PERIOD'=>$monthName[$MONTH].'-'.$YEAR,
						'BASIC'=>0,
						'PP_SP'=>0,
						'TA'=>0,
						'HRA'=>0,
						'DA'=>0,
						'TOTAL'=>0,
						'CGEGIS'=>0,
						'CGHS'=>0,
						'CPF'=>0,
						'PT'=>0,
						'IT'=>0,
						'PLI'=>0,
						'LIC'=>0,
						'MISC'=>0,
						'TYPE'=>'SALARY'
					));
				}
				
			}
			$bills = Bill::model()->findAll('PFMS_STATUS="Passed" AND MONTH='.$MONTH.' AND YEAR='.$YEAR.' AND IS_ARREAR_BILL=1');
			$arr_bills = array(); foreach($bills as $bill) array_push($arr_bills, $bill->ID);
			if(count($arr_bills) > 0){
				$salary = SalaryDetails::model()->find('EMPLOYEE_ID_FK='.$id.' AND MONTH='.$MONTH.' AND YEAR='.$YEAR.' AND BILL_ID_FK IN ('.implode(',', $arr_bills).')');
				if($salary){
					array_push($SALARIES, array(
						'MONTH'=>$MONTH,
						'YEAR'=>$YEAR,
						'PERIOD'=>'Arr '.$monthName[$salary->MONTH].'-'.$salary->YEAR,
						'BASIC'=>$salary->BASIC,
						'PP_SP'=>($salary->PP+$salary->SP),
						'TA'=>$salary->TA,
						'HRA'=>$salary->HRA,
						'DA'=>$salary->DA,
						'TOTAL'=>($salary->BASIC+$salary->PP+$salary->SP+$salary->TA+$salary->HRA+$salary->DA),
						'CGEGIS'=>$salary->CGEGIS,
						'CGHS'=>$salary->CGHS,
						'CPF'=>$salary->CPF_TIER_I,
						'PT'=>$salary->PT,
						'IT'=>$salary->IT,
						'PLI'=>$salary->PLI,
						'LIC'=>$salary->LIC,
						'MISC'=>$salary->MISC,
						'TYPE'=>'ARREAR',
					));
				}
			}
			$previous_office_arrear = PreviousOfficePayArrears::model()->find('EMPLOYEE_ID_FK='.$id.' AND MONTH='.$MONTH.' AND YEAR='.$YEAR);
				if($previous_office_arrear){
					$salary = $previous_office_arrear;
					array_push($SALARIES, array(
						'MONTH'=>$MONTH,
						'YEAR'=>$YEAR,
						'PERIOD'=>'Arr '.$monthName[$salary->MONTH].'-'.$salary->YEAR,
						'BASIC'=>$salary->BASIC,
						'PP_SP'=>($salary->PP_SP),
						'TA'=>$salary->TA,
						'HRA'=>$salary->HRA,
						'DA'=>$salary->DA,
						'TOTAL'=>($salary->BASIC+$salary->PP_SP+$salary->TA+$salary->HRA+$salary->DA),
						'CGEGIS'=>$salary->CGEGIS,
						'CGHS'=>$salary->CGHS,
						'CPF'=>$salary->CPF,
						'PT'=>$salary->PT,
						'IT'=>$salary->IT,
						'PLI'=>$salary->PLI,
						'LIC'=>$salary->LIC,
						'MISC'=>0,
						'TYPE'=>'ARREAR',
					));
				}
			
			$i++;
		}
		$TOTAL_SALARIES = getSalaryTotal($SALARIES);
		
		$bills = Bill::model()->findAll('PFMS_STATUS="Passed" AND FINANCIAL_YEAR_ID_FK='.$financialYear->ID.' AND IS_DA_ARREAR_BILL=1');
		$da_arr_bills = array(); foreach($bills as $bill) array_push($da_arr_bills, $bill->ID);
		$DA_TA_ARREAR_CURRENT_OFFICE=0;
		if(count($da_arr_bills)>0){
			$DA_TA_ARREAR_CURRENT_OFFICE = Yii::app()->db->createCommand("SELECT SUM(DA) + SUM(TA) AS TOTAL FROM tbl_salary_details WHERE EMPLOYEE_ID_FK=".$id." AND BILL_ID_FK IN (".implode(",", $da_arr_bills).")")->queryRow()['TOTAL'];
		}
		
		$DA_TA_ARREAR_PREVIOUS_OFFICE =  isset($investment->DA_TA_ARREAR) ? $investment->DA_TA_ARREAR : 0;
		$TOTAL_DA_TA_ARREAR = $DA_TA_ARREAR_CURRENT_OFFICE + $DA_TA_ARREAR_PREVIOUS_OFFICE;		
		
		$DA_TA_ARREAR_CPF_CURRENT_OFFICE=0;
		if(count($da_arr_bills)>0){
			$DA_TA_ARREAR_CPF_CURRENT_OFFICE = Yii::app()->db->createCommand("SELECT SUM(CPF_TIER_I) AS TOTAL FROM tbl_salary_details WHERE EMPLOYEE_ID_FK=".$id." AND BILL_ID_FK IN (".implode(",", $da_arr_bills).")")->queryRow()['TOTAL'];
		}
		$DA_TA_ARREAR_CPF_PREVIOUS_OFFICE = isset($investment->DA_TA_ARREAR_CPF) ? $investment->DA_TA_ARREAR_CPF : 0;
		$TOTAL_DA_TA_ARREAR_CPF = $DA_TA_ARREAR_CPF_CURRENT_OFFICE + $DA_TA_ARREAR_CPF_PREVIOUS_OFFICE;	
		
		$bills = Bill::model()->findAll('PFMS_STATUS="Passed" AND FINANCIAL_YEAR_ID_FK='.$financialYear->ID.' AND BILL_TYPE='.$OTA_BILL_TYPE.' OR BILL_TYPE='.$HONORIUM_BILL_TYPE);
		$ota_honorium_bills = array(); 
		$OTA_HONORIUM_CURRENT_OFFICE = 0;
		foreach($bills as $bill){
			$BillEmployees = explode(",", BillEmployees::model()->find('BILL_ID='.$bill->ID)->EMPLOYEE_ID);
			if(in_array($id, $BillEmployees)){
				$OTA_HONORIUM_CURRENT_OFFICE += $bill->AMOUNT;
			}
		}
		$OTA_HONORIUM_PREVIOUS_OFFICE = isset($investment->OTA_HONORANIUM) ? $investment->OTA_HONORANIUM : 0;
		$TOTAL_OTA_HONORIUM = $OTA_HONORIUM_CURRENT_OFFICE + $OTA_HONORIUM_PREVIOUS_OFFICE;
		
		$bills = Bill::model()->findAll('PFMS_STATUS="Passed" AND FINANCIAL_YEAR_ID_FK='.$financialYear->ID.' AND IS_BONUS_BILL=1');
		$BONUS_CURRENT_OFFICE = 0;
		foreach($bills as $bill){
			$BillEmployees = explode(",", BillEmployees::model()->find('BILL_ID='.$bill->ID)->EMPLOYEE_ID);
			if(in_array($id, $BillEmployees)){
				$BONUS_CURRENT_OFFICE = Yii::app()->db->createCommand("SELECT SUM(BONUS) AS TOTAL FROM tbl_salary_details WHERE EMPLOYEE_ID_FK=".$id." AND BILL_ID_FK=".$bill->ID)->queryRow()['TOTAL'];
			}
		}
		$BONUS_PREVIOUS_OFFICE = isset($investment->BONUS) ? $investment->BONUS : 0;
		$TOTAL_BONUS = $BONUS_CURRENT_OFFICE + $BONUS_PREVIOUS_OFFICE;
		
		
		//$bills = Bill::model()->findAll('PFMS_STATUS="Passed" AND FINANCIAL_YEAR_ID_FK='.$financialYear->ID.' AND IS_UA_BILL=1');
		//$UA_CURRENT_OFFICE = 0;
		//foreach($bills as $bill){
		//	$BillEmployees = explode(",", BillEmployees::model()->find('BILL_ID='.$bill->ID)->EMPLOYEE_ID);
		//	if(in_array($id, $BillEmployees)){
		//		$UA_CURRENT_OFFICE = Yii::app()->db->createCommand("SELECT SUM(UA) AS TOTAL FROM tbl_salary_details WHERE EMPLOYEE_ID_FK=".$id." AND BILL_ID_FK=".$bill->ID)->queryRow()['TOTAL'];
		//	}
		//}
		//$UA_PREVIOUS_OFFICE = isset($investment->UNIFORM) ? $investment->UNIFORM : 0;
		//$TOTAL_UA = $UA_CURRENT_OFFICE + $UA_PREVIOUS_OFFICE;
		$TOTAL_UA = 0;
		
		
		$bills = Bill::model()->findAll('PFMS_STATUS="Passed" AND FINANCIAL_YEAR_ID_FK='.$financialYear->ID.' AND IS_CEA_BILL=1');
		$CEA_CURRENT_OFFICE = 0;
		foreach($bills as $bill){
			$BillEmployees = explode(",", BillEmployees::model()->find('BILL_ID='.$bill->ID)->EMPLOYEE_ID);
			if(in_array($id, $BillEmployees)){
				$CEA_CURRENT_OFFICE = Yii::app()->db->createCommand("SELECT SUM(CEA) AS TOTAL FROM tbl_salary_details WHERE EMPLOYEE_ID_FK=".$id." AND BILL_ID_FK=".$bill->ID)->queryRow()['TOTAL'];
			}
		}
		
		$CEA_PREVIOUS_OFFICE = isset($investment->CEA_TUITION) ? $investment->CEA_TUITION : 0;
		$TOTAL_CEA = $CEA_CURRENT_OFFICE + $CEA_PREVIOUS_OFFICE;
		
		
		
		//$bills = Bill::model()->findAll('PFMS_STATUS="Passed" AND FINANCIAL_YEAR_ID_FK='.$financialYear->ID.' AND (IS_LTC_ADVANCE_BILL=1 OR IS_LTC_CLAIM_BILL=1)');
		//$LTC_HTC_CURRENT_OFFICE = 0;
		//foreach($bills as $bill){
		//	$BillEmployees = explode(",", BillEmployees::model()->find('BILL_ID='.$bill->ID)->EMPLOYEE_ID);
		//	if(in_array($id, $BillEmployees)){
		//		$LTC_HTC_CURRENT_OFFICE = Yii::app()->db->createCommand("SELECT SUM(LTC_HTC) AS TOTAL FROM tbl_salary_details WHERE EMPLOYEE_ID_FK=".$id." AND BILL_ID_FK=".$bill->ID)->queryRow()['TOTAL'];
		//	}
		//}
		//$LTC_HTC_PREVIOUS_OFFICE = isset($investment->LTC_HTC) ? $investment->LTC_HTC : 0;
		//$TOTAL_LTC_HTC = $LTC_HTC_CURRENT_OFFICE + $LTC_HTC_PREVIOUS_OFFICE;
		$TOTAL_LTC_HTC = 0;
		
		$bills = Bill::model()->findAll('PFMS_STATUS="Passed" AND FINANCIAL_YEAR_ID_FK='.$financialYear->ID.' AND IS_EL_ENCASHMENT_BILL=1');
		$EL_ENCASH_CURRENT_OFFICE = 0;
		foreach($bills as $bill){
			$BillEmployees = explode(",", BillEmployees::model()->find('BILL_ID='.$bill->ID)->EMPLOYEE_ID);
			if(in_array($id, $BillEmployees)){
				$EL_ENCASH_CURRENT_OFFICE = Yii::app()->db->createCommand("SELECT SUM(EL_ENCASHMENT) AS TOTAL FROM tbl_salary_details WHERE EMPLOYEE_ID_FK=".$id." AND BILL_ID_FK=".$bill->ID)->queryRow()['TOTAL'];
			}
		}
		$EL_ENCASH_PREVIOUS_OFFICE = isset($investment->EL_ENCASH) ? $investment->EL_ENCASH : 0;
		$TOTAL_EL_ENCASH = $EL_ENCASH_CURRENT_OFFICE + $EL_ENCASH_PREVIOUS_OFFICE;
		
		$TOTAL_MISC = $TOTAL_SALARIES[0]['MISC'];
		$TOTAL_SALARY_WITHOUT_MISC = $TOTAL_SALARIES[0]['TOTAL'] - $TOTAL_MISC; 
		$TOTAL_INCOME_FROM_SALARY = $TOTAL_SALARY_WITHOUT_MISC + $TOTAL_DA_TA_ARREAR + $TOTAL_OTA_HONORIUM + $TOTAL_BONUS + $TOTAL_UA + $TOTAL_CEA + 
		$TOTAL_LTC_HTC + $TOTAL_EL_ENCASH;
		
		$RENT_PAID = isset($investment->HRA) ? $investment->HRA : 0;
		$ACTUAL_HRA = $TOTAL_SALARIES[0]['HRA'];
		
		$TOTAL_VALID_BASIC_FOR_HRA_CALCULATION = ValidBasicTotalforHRACalculation($SALARIES);
		$TOTAL_VALID_DA_FOR_HRA_CALCULATION = ValidDATotalforHRACalculation($SALARIES);
		
		$RENT_PAID_EXCESS_OF_TEN_PERCENT = max(0, round($RENT_PAID - (0.1*($TOTAL_VALID_BASIC_FOR_HRA_CALCULATION + $TOTAL_VALID_DA_FOR_HRA_CALCULATION))));
		$FOURTY_PERCENT_OF_SALARY = round(0.4*($TOTAL_VALID_BASIC_FOR_HRA_CALCULATION + $TOTAL_VALID_DA_FOR_HRA_CALCULATION));
		$TOTAL_RENT = min ($ACTUAL_HRA, $RENT_PAID_EXCESS_OF_TEN_PERCENT, $FOURTY_PERCENT_OF_SALARY);
		
		$TOTAL_OTHER_INCOME = isset($investment->OTHER_INCOME) ? $investment->OTHER_INCOME : 0;
		$TOTAL_HOUSE_INCOME = isset($investment->HOUSE_INCOME) ? $investment->HOUSE_INCOME : 0;
		
		$MANDATORY_CPF_CONTRIBUTION = $TOTAL_SALARIES[0]['CPF'];
		$TOTAL_CPF_EMPLOYEE = $TOTAL_DA_TA_ARREAR_CPF + $TOTAL_SALARIES[0]['CPF'];
		$TOTAL_CPF_GOVT = $TOTAL_CPF_EMPLOYEE;
		
		$GROSS_INCOME = 0;
		if($employee->PENSION_TYPE == "OPS"){
			$GROSS_INCOME = $TOTAL_INCOME_FROM_SALARY - $TOTAL_RENT + $TOTAL_OTHER_INCOME + $TOTAL_HOUSE_INCOME;
		}
		if($employee->PENSION_TYPE == "NPS"){
			$GROSS_INCOME = $TOTAL_INCOME_FROM_SALARY - $TOTAL_RENT + $TOTAL_OTHER_INCOME + $TOTAL_CPF_GOVT + $TOTAL_HOUSE_INCOME;
		}
		
		
		$TA_ALLOWED = min($TOTAL_SALARIES[0]['TA'], (getTotalTAMonths($SALARIES) * 1600));
		$INCOME_AFTER_DEDUCTION = $GROSS_INCOME - $TOTAL_SALARIES[0]['PT'] - $TA_ALLOWED;
		
		$TOTAL_CGHS = $TOTAL_SALARIES[0]['CGHS'];
		$MEDICAL_INSURANCE = isset($investment->MEDICAL_INSURANCE) ? $investment->MEDICAL_INSURANCE : 0;
		if($MEDICAL_INSURANCE > 0){
			$MEDICAL_INSURANCE = (($MEDICAL_INSURANCE + $TOTAL_CGHS) > 25000) ? (25000 - $TOTAL_CGHS) : $MEDICAL_INSURANCE;
		}
		$MEDICAL_INSURANCE_PARENTS = isset($investment->MEDICAL_INSURANCE_PARENTS) ? min($investment->MEDICAL_INSURANCE_PARENTS,25000) : 0;
		$DONATION = isset($investment->DONATION) ? $investment->DONATION : 0;
		$DISABILITY_MED_EXP = isset($investment->DISABILITY_MED_EXP) ? $investment->DISABILITY_MED_EXP : 0;
		$EDU_LOAD_INT = isset($investment->EDU_LOAD_INT) ? $investment->EDU_LOAD_INT : 0;
		$SELF_DISABILITY = isset($investment->SELF_DISABILITY) ? $investment->SELF_DISABILITY : 0;
		$HOME_LOAN_YEAR = isset($investment->LOAN_YEAR) ? $investment->LOAN_YEAR : '';
		
		
		$bills = Bill::model()->findAll('PFMS_STATUS="Passed" AND FINANCIAL_YEAR_ID_FK='.$financialYear->ID);
		$HBA_PRINCIPAL_CURRENT_OFFICE = 0;
		$HBA_INTEREST_CURRENT_OFFICE = 0;
		$BillIdsForHBA = array();
		foreach($bills as $bill){
			array_push($BillIdsForHBA, $bill->ID);
		}
		if(count($BillIdsForHBA) > 0){
			$HBA_PRINCIPAL_CURRENT_OFFICE += Yii::app()->db->createCommand("SELECT SUM(HBA_EMI) AS TOTAL FROM tbl_salary_details WHERE EMPLOYEE_ID_FK=".$id." 
			AND IS_HBA_RECOVERY=0 AND BILL_ID_FK IN (".implode("," , $BillIdsForHBA).")")->queryRow()['TOTAL'];
			$HBA_INTEREST_CURRENT_OFFICE += Yii::app()->db->createCommand("SELECT SUM(HBA_EMI) AS TOTAL FROM tbl_salary_details WHERE EMPLOYEE_ID_FK=".$id." AND 
			IS_HBA_RECOVERY=1 AND BILL_ID_FK IN (".implode("," , $BillIdsForHBA).")")->queryRow()['TOTAL'];
		}
		
		$HBA_PRINCIPAL_PREVIOUS_OFFICE = 0;
		$HBA_INTEREST_PREVIOUS_OFFICE = 0;	
		foreach($CurrentFinancialYearPeriods as $period){
			$month = explode("-", $period)[0];
			$year = explode("-", $period)[1];
			$HBA_PRINCIPAL = Yii::app()->db->createCommand("SELECT HBA_EMI AS HBA_EMI FROM tbl_supplementary_salary_details WHERE EMPLOYEE_ID_FK=".$id." AND IS_HBA_RECOVERY=0 AND MONTH=".$month." AND YEAR=".$year)->queryRow()['HBA_EMI'];
			$HBA_PRINCIPAL_PREVIOUS_OFFICE += $HBA_PRINCIPAL;
			$HBA_INTEREST = Yii::app()->db->createCommand("SELECT HBA_EMI AS HBA_EMI FROM tbl_supplementary_salary_details WHERE EMPLOYEE_ID_FK=".$id." AND IS_HBA_RECOVERY=1 AND MONTH=".$month." AND YEAR=".$year)->queryRow()['HBA_EMI'];
			$HBA_INTEREST_PREVIOUS_OFFICE += $HBA_INTEREST;
		}
		
		$ACTUAL_HOME_LOAN_INT = isset($investment->HOME_LOAN_INT) ? $investment->HOME_LOAN_INT : 0;
		$HOME_LOAN_INT = $ACTUAL_HOME_LOAN_INT + $HBA_INTEREST_CURRENT_OFFICE + $HBA_INTEREST_PREVIOUS_OFFICE;
		$MIN_HOME_LOAN_INT = min($HOME_LOAN_INT,200000);
		$HOME_LOAN_AMOUNT_FOR_80_EE_REBATE = ($HOME_LOAN_INT - $MIN_HOME_LOAN_INT);
		$HOME_LOAN_80_EE_REBATE = 0;
		
		if($HOME_LOAN_YEAR == "2013-14" || $HOME_LOAN_YEAR == "2014-15"){
			//$HOME_LOAN_80_EE_REBATE = ($HOME_LOAN_AMOUNT_FOR_80_EE_REBATE >=100000) ? 100000 : $HOME_LOAN_AMOUNT_FOR_80_EE_REBATE;
			$HOME_LOAN_80_EE_REBATE = 0;
		}
		if($HOME_LOAN_YEAR == "2016-17" || $HOME_LOAN_YEAR == "2017-18" || $HOME_LOAN_YEAR == "2018-19"){
			$HOME_LOAN_80_EE_REBATE = ($HOME_LOAN_AMOUNT_FOR_80_EE_REBATE >=50000) ? 50000 : $HOME_LOAN_AMOUNT_FOR_80_EE_REBATE;
			//$HOME_LOAN_80_EE_REBATE = ($HOME_LOAN_AMOUNT_FOR_80_EE_REBATE >=100000) ? 100000 : $HOME_LOAN_AMOUNT_FOR_80_EE_REBATE;
		}
		
		//$HOME_LOAD_EXCESS_2013_14 = min((($HOME_LOAN_INT >= 250001) ? ($HOME_LOAN_INT - $MIN_HOME_LOAN_INT) : 0 ), 100000);
		//$HOME_LOAD_EXCESS_2013_14_ADDTIONAL = ($HOME_LOAN_INT < 250001) ? min(($HOME_LOAN_INT - $MIN_HOME_LOAN_INT), 100000) : 0;
		$BANK_INTEREST_DED_80TTA = isset($investment->BANK_INTEREST_DED_80TTA) ? $investment->BANK_INTEREST_DED_80TTA : 0;
		$NPS_UNDER_80CCD_1B = 0;
		$CPF_AFTER_81CCD_1B = 0;
		
		if($employee->PENSION_TYPE == "NPS"){
			$NPS_UNDER_80CCD_1B = isset($investment->NPS_UNDER_80CCD_1B) ? $investment->NPS_UNDER_80CCD_1B : 0;
			$INVESTMENT_NEEDED_IN_80CCB = 0;
			if($NPS_UNDER_80CCD_1B == 0){
				$INVESTMENT_NEEDED_IN_80CCB = min(50000, $TOTAL_CPF_EMPLOYEE);
			}
			else if($NPS_UNDER_80CCD_1B > 0 && $NPS_UNDER_80CCD_1B < 50000) {
				$INVESTMENT_NEEDED_IN_80CCB = (50000 - $NPS_UNDER_80CCD_1B);
			}
			else if($NPS_UNDER_80CCD_1B == 50000){
				$INVESTMENT_NEEDED_IN_80CCB = 0;
			}
			
			if($INVESTMENT_NEEDED_IN_80CCB > 0){
				if($INVESTMENT_NEEDED_IN_80CCB > $TOTAL_CPF_EMPLOYEE){
					$INVESTMENT_NEEDED_IN_80CCB = $TOTAL_CPF_EMPLOYEE;
				}
			}
				
			$NPS_UNDER_80CCD_1B += $INVESTMENT_NEEDED_IN_80CCB;
			$CPF_AFTER_81CCD_1B = $TOTAL_CPF_EMPLOYEE - $INVESTMENT_NEEDED_IN_80CCB;
		}
		if($employee->PENSION_TYPE == "OPS"){
			$NPS_UNDER_80CCD_1B = isset($investment->NPS_UNDER_80CCD_1B) ? $investment->NPS_UNDER_80CCD_1B : 0;
		}
		$TOTAL_EXEMPTION = $TOTAL_CGHS+$MEDICAL_INSURANCE+$MEDICAL_INSURANCE_PARENTS+$DONATION+$DISABILITY_MED_EXP+$EDU_LOAD_INT+$SELF_DISABILITY+
		$MIN_HOME_LOAN_INT+$HOME_LOAN_80_EE_REBATE+$NPS_UNDER_80CCD_1B+$BANK_INTEREST_DED_80TTA;	
		
		$TOTAL_CPF = ($employee->PENSION_TYPE == "OPS") ? $TOTAL_CPF_EMPLOYEE : ($TOTAL_CPF_EMPLOYEE + $TOTAL_CPF_GOVT);
		$TOTAL_CPF_FOR_SAVING = ($employee->PENSION_TYPE == "OPS") ? $TOTAL_CPF_EMPLOYEE : $CPF_AFTER_81CCD_1B;
		
		$TOTAL_CGEGIS = $TOTAL_SALARIES[0]['CGEGIS'];
		
		$POSTAL_LIC_FROM_SALARY = $TOTAL_SALARIES[0]['PLI'];
		$LIC_FROM_SALARY = $TOTAL_SALARIES[0]['LIC'];
		$LIC_FROM_INVESTMENTS = isset($investment->INSURANCE_LIC_OTHER) ? $investment->INSURANCE_LIC_OTHER : 0;
		$INSURANCE_LIC_OTHER = $POSTAL_LIC_FROM_SALARY + $LIC_FROM_SALARY + $LIC_FROM_INVESTMENTS;
		
		$TUITION_FESS_EXEMPTION = isset($investment->TUITION_FESS_EXEMPTION) ? $investment->TUITION_FESS_EXEMPTION : 0;
		
		$PPF_NSC = isset($investment->PPF_NSC) ? $investment->PPF_NSC : 0;
		
		$ACTUAL_HOME_LOAN_PR = isset($investment->HOME_LOAN_PR) ? $investment->HOME_LOAN_PR : 0;
		$HOME_LOAN_PR = $ACTUAL_HOME_LOAN_PR + $HBA_PRINCIPAL_CURRENT_OFFICE + $HBA_PRINCIPAL_PREVIOUS_OFFICE;
		$PLI_ULIP = isset($investment->PLI_ULIP) ? $investment->PLI_ULIP : 0;
		$TERM_DEPOSIT_ABOVE_5 = isset($investment->TERM_DEPOSIT_ABOVE_5) ? $investment->TERM_DEPOSIT_ABOVE_5 : 0;
		$MUTUAL_FUND = isset($investment->MUTUAL_FUND) ? $investment->MUTUAL_FUND : 0;
		$PENSION_FUND = isset($investment->PENSION_FUND) ? $investment->PENSION_FUND : 0;
		$CPF_809CCD = isset($investment->CPF) ? $investment->CPF : 0;
		$REGISTRY_STAMP = isset($investment->REGISTRY_STAMP) ? $investment->REGISTRY_STAMP : 0;
		$TOTAL_SAVING_80C = $TOTAL_CPF_FOR_SAVING+$TOTAL_CGEGIS+$INSURANCE_LIC_OTHER+$TUITION_FESS_EXEMPTION+$PPF_NSC+$HOME_LOAN_PR+$PLI_ULIP+$TERM_DEPOSIT_ABOVE_5
							+$MUTUAL_FUND+$PENSION_FUND+$CPF_809CCD+$REGISTRY_STAMP;
		$MIN_SAVING_80C = min($TOTAL_SAVING_80C,150000);
		$NET_SAVING_80C = ($employee->PENSION_TYPE == "OPS") ? $MIN_SAVING_80C : ($MIN_SAVING_80C + $TOTAL_CPF_GOVT);
		
		$TOTAL_DEDUCTIONS = $TOTAL_EXEMPTION+$NET_SAVING_80C;
		$TOTAL_TAXABLE_INCOME = $INCOME_AFTER_DEDUCTION-$TOTAL_DEDUCTIONS;
		$TOTAL_TAXABLE_INCOME_ROUNDED = round($INCOME_AFTER_DEDUCTION-$TOTAL_DEDUCTIONS, -1);
		
		$TAXABLE_INCOME = 0;
		
		$FIRST_SLAB_INCOME = 250000;
		$FIRST_SLAB_TAX = 0;
		
		$SECOND_SLAB_INCOME = MIN((($TOTAL_TAXABLE_INCOME_ROUNDED>=$TAX_SLABS_II_MIN) ? ($TOTAL_TAXABLE_INCOME_ROUNDED - $TAX_SLABS_II_MIN) : 0 ), $TAX_SLABS_II_MIN);
		$SECOND_SLAB_TAX = round(($SECOND_SLAB_INCOME *  $TAX_SLABS_II_RATE )/100);
		
		$THIRD_SLAB_INCOME = MIN((($TOTAL_TAXABLE_INCOME_ROUNDED>=$TAX_SLABS_III_MIN) ? ($TOTAL_TAXABLE_INCOME_ROUNDED - $TAX_SLABS_III_MIN) : 0 ), $TAX_SLABS_III_MIN);
		$THIRD_SLAB_TAX = round(($THIRD_SLAB_INCOME *  $TAX_SLABS_III_RATE )/100);
		
		$FOURTH_SLAB_INCOME = ($TOTAL_TAXABLE_INCOME_ROUNDED>=$TAX_SLABS_IV_MIN) ? ($TOTAL_TAXABLE_INCOME_ROUNDED - $TAX_SLABS_IV_MIN) : 0;
		$FOURTH_SLAB_TAX = round(($FOURTH_SLAB_INCOME *  $TAX_SLABS_IV_RATE )/100);
		
		$TOTAL_SLAB_INCOME = $FIRST_SLAB_INCOME + $SECOND_SLAB_INCOME + $THIRD_SLAB_INCOME + $FOURTH_SLAB_INCOME;
		$TOTAL_SLAB_TAX = $FIRST_SLAB_TAX + $SECOND_SLAB_TAX + $THIRD_SLAB_TAX + $FOURTH_SLAB_TAX;
		
		$TAX_REBATE_UNDER_87 = ($TOTAL_TAXABLE_INCOME<350001)? (MIN($TOTAL_SLAB_TAX,2500)) : 0;
		
		$TOTAL_TAX_AFTER_REBATE = $TOTAL_SLAB_TAX - $TAX_REBATE_UNDER_87;
		if(Yii::app()->session['FINANCIAL_YEAR'] == 1){
			$TOTAL_TAX_AFTER_REBATE_WITH_CESS = round(0.03 * $TOTAL_TAX_AFTER_REBATE);
		}
		else{
			$TOTAL_TAX_AFTER_REBATE_WITH_CESS = round(0.04 * $TOTAL_TAX_AFTER_REBATE);
		}
		$GROSS_TAX_PAYABLE = $TOTAL_TAX_AFTER_REBATE + $TOTAL_TAX_AFTER_REBATE_WITH_CESS;
		
		$TAX_PAID_FROM_SALARY = $TOTAL_SALARIES[0]['IT'];
		$TAX_REMAINING = $GROSS_TAX_PAYABLE - $TAX_PAID_FROM_SALARY;
		$TAX_REMAINING_TEXT = ($TAX_REMAINING < 0 ) ? "NET TAX REFUNDABLE":"NET TAX PAYABLE";
		
		$PAN_NUMBER = $employee->PAN;
		
		//$REMAINING_MONTHS = remainingMonthsForIT($CurrentFinancialYearPeriods, $id);
		$REMAINING_MONTHS = remainingMonthsForIT($CurrentFinancialYearPeriods, $ExitZeroSalaryIndex);
		if($TAX_REMAINING <= 0){
			$IT_FOR_REMAINING_MONTHS = getNilParts($REMAINING_MONTHS);
		}
		else{
			//$REMAINING_MONTHS = ($REMAINING_MONTHS == 0) ? 1 : $REMAINING_MONTHS;
			$IT_FOR_REMAINING_MONTHS = getParts($TAX_REMAINING, $REMAINING_MONTHS);
		}
		
		for($i=(count($SALARIES) - $REMAINING_MONTHS),$j=0; $i<count($SALARIES); $i++){
			if($SALARIES[$i]['BASIC'] != 0){
				$SALARIES[$i]['IT'] = $IT_FOR_REMAINING_MONTHS[$j];
			}
			$j++;
		}
		
		//echo "<pre>";print_r($IT_FOR_REMAINING_MONTHS);echo "</pre>";exit;
		$TOTAL_SALARIES = getSalaryTotal($SALARIES);
		$TAX_PAID_FROM_SALARY = $TOTAL_SALARIES[0]['IT'];
		$TAX_REMAINING = $GROSS_TAX_PAYABLE - $TAX_PAID_FROM_SALARY;
		$TAX_REMAINING_TEXT = (($GROSS_TAX_PAYABLE - $TAX_PAID_FROM_SALARY) < 0 ) ? "NET TAX REFUNDABLE":"NET TAX PAYABLE";
		
		if($IS_AJAX_REQUEST){
			echo "[JSON]".json_encode($SALARIES)."[/JSON]";exit;
		}
		include ($employee->PENSION_TYPE == "OPS") ? "Form16_OPS.php" : "Form16_NPS.php";
	}
?>
</table>
<?php

function getTotalTAMonths($salaries){
	$total = 0;
	for($i=0;$i<=count($salaries)-1;$i++){
		if($salaries[$i]['TA'] != 0 && $salaries[$i]['TYPE']=='SALARY'){
			$total++;
		}
	}
	return $total;
}
function getSalaryTotal($salaries){
	$total = array();
	$BASIC = 0;
	$PP_SP = 0;
	$TA = 0;
	$HRA = 0;
	$DA = 0;
	$TOTAL = 0;
	$CGEGIS = 0;
	$CGHS = 0;
	$CPF = 0;
	$PT = 0;
	$IT = 0;
	$PLI = 0;
	$LIC = 0;
	$MISC = 0;
	
	for($i=0;$i<=count($salaries)-1;$i++){
		$BASIC += $salaries[$i]['BASIC'];
		$PP_SP += $salaries[$i]['PP_SP'];
		$TA += $salaries[$i]['TA'];
		$HRA += $salaries[$i]['HRA'];
		$DA += $salaries[$i]['DA'];
		$TOTAL += $salaries[$i]['TOTAL'];
		$CGEGIS += $salaries[$i]['CGEGIS'];
		$CGHS += $salaries[$i]['CGHS'];
		$CPF += $salaries[$i]['CPF'];
		$PT += $salaries[$i]['PT'];
		$IT += $salaries[$i]['IT'];
		$PLI += $salaries[$i]['PLI'];
		$LIC += $salaries[$i]['LIC'];
		$MISC += $salaries[$i]['MISC'];
	}
	array_push($total, array(
		'MONTH'=>'',
		'YEAR'=>'',
		'PERIOD'=>'TOTAL',
		'BASIC'=>$BASIC,
		'PP_SP'=>$PP_SP,
		'TA'=>$TA,
		'HRA'=>$HRA,
		'DA'=>$DA,
		'TOTAL'=>$TOTAL,
		'CGEGIS'=>$CGEGIS,
		'CGHS'=>$CGHS,
		'CPF'=>$CPF,
		'PT'=>$PT,
		'IT'=>$IT,
		'PLI'=>$PLI,
		'LIC'=>$LIC,
		'MISC'=>$MISC,
	));
	
	return $total;
}
//function remainingMonthsForIT($periods, $emp_id, $lastSalaryIndex){
function remainingMonthsForIT($periods, $lastSalaryIndex){
	//$count = 0;
	//$SalaryFoundForMonths = 0;
	/*foreach($periods as $period){
		$MONTH = explode('-', $period)[0];
		$YEAR = explode('-', $period)[1];
		if(SalaryDetails::model()->exists('EMPLOYEE_ID_FK='.$emp_id.' AND MONTH='.$MONTH.' AND YEAR='.$YEAR.' AND IS_SALARY_BILL=1') ||
			SupplementarySalaryDetails::model()->exists('EMPLOYEE_ID_FK='.$emp_id.' AND MONTH='.$MONTH.' AND YEAR='.$YEAR)){
			$SalaryFoundForMonths++;
		}
		$count = $totalMonths - $SalaryFoundForMonths;
	}*/
	
	$totalMonths = count($periods);
	$remainingMonths = (($totalMonths - 1) - $lastSalaryIndex);
	
	if($remainingMonths < 0){
		$remainingMonths = 0;
	}
	
	return $remainingMonths;
	
	//return $count;
}
function getParts($tot, $n){
	$values = array();
	if($n != 0){
		$values = array_fill( 0, $n-1, round( $tot/$n) );
		$values[ $n-1 ] = round( $tot - array_sum( $values ),2 );
	}
	else{
		$values[0] = $tot;
	}
	return $values;
}
function getNilParts($months){
	$values = array();
	for($i=0; $i<=$months-1;$i++)
		array_push($values, 0);
	
	return $values;
}
function findLastMonthSalary($array, $index){
	$result = null;
	for($j=$index; $j>=0; $j--){
		if(isset($array[$j]) && $array[$j]['TYPE'] == "SALARY"){
			$result = $array[$j];
			break;
		}
	}
	
	return $result;
}
function ValidBasicTotalforHRACalculation($salaries){
	$TOTAL_BASIC = 0;
	foreach($salaries as $salary){
		if($salary['HRA'] > 0){
			$TOTAL_BASIC += $salary['BASIC'];
		}
	}
	return $TOTAL_BASIC;
}
function ValidDATotalforHRACalculation($salaries){
	$TOTAL_DA = 0;
	foreach($salaries as $salary){
		if($salary['HRA'] > 0){
			$TOTAL_DA += $salary['DA'];
		}
	}
	return $TOTAL_DA;
}

?>
<?php if($type == "Screen") { ?>
<script type="text/javascript">//window.onload = function() { window.print(); }</script>
<?php } ?>
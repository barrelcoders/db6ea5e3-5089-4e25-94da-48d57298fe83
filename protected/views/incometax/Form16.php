<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/oneadmin.css" rel="stylesheet">
<?php if($type == "Screen") { ?>
<script type="text/javascript">//window.onload = function() { window.print(); }</script>
<?php } ?>
<?php $master = Master::model()->findByPK(1); ?>
<?php
	
	$monthName = array('1'=>'JAN', '2'=>'FEB', '3'=>'MAR', '4'=>'APR', '5'=>'MAY', '6'=>'JUN', '7'=>'JUL', '8'=>'AUG', '9'=>'SEP', '10'=>'OCT', '11'=>'NOV', '12'=>'DEC');
	$periods = array('3-2017','4-2017','5-2017','6-2017','7-2017','8-2017','9-2017','10-2017','11-2017', '12-2017','1-2018', '2-2018');
	$master = Master::model()->findByPK(1);
	$financialYear = FinancialYears::model()->find('STATUS=1');
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
		foreach($periods as $period){
			$MONTH = explode('-', $period)[0];
			$YEAR = explode('-', $period)[1];
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
					'CPF'=>($salary->CPF_TIER_I + $salary->CPF_TIER_II),
					'PT'=>$salary->PT,
					'IT'=>$salary->IT,
					'PLI'=>$salary->PLI,
					'LIC'=>$salary->LIC,
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
					'CPF'=>($salary->CPF_TIER_I + $salary->CPF_TIER_II),
					'PT'=>$salary->PT,
					'IT'=>$salary->IT,
					'PLI'=>$salary->PLI,
					'LIC'=>$salary->LIC,
					'TYPE'=>'SALARY'
				));
			}
			else{
				if(isset($SALARIES[$i-1])){
					$salary = $SALARIES[$i-1];
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
					));
				}
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
			$OtherBillEmployees = explode(",", OtherBillEmployees::model()->find('BILL_ID='.$bill->ID)->EMPLOYEE_ID);
			if(in_array($id, $OtherBillEmployees)){
				$OTA_HONORIUM_CURRENT_OFFICE += $bill->AMOUNT;
			}
		}
		$OTA_HONORIUM_PREVIOUS_OFFICE = isset($investment->OTA_HONORANIUM) ? $investment->OTA_HONORANIUM : 0;
		$TOTAL_OTA_HONORIUM = $OTA_HONORIUM_CURRENT_OFFICE + $OTA_HONORIUM_PREVIOUS_OFFICE;
		
		$bills = Bill::model()->findAll('PFMS_STATUS="Passed" AND FINANCIAL_YEAR_ID_FK='.$financialYear->ID.' AND IS_BONUS_BILL=1');
		$BONUS_CURRENT_OFFICE = 0;
		foreach($bills as $bill){
			$OtherBillEmployees = explode(",", OtherBillEmployees::model()->find('BILL_ID='.$bill->ID)->EMPLOYEE_ID);
			if(in_array($id, $OtherBillEmployees)){
				$BONUS_CURRENT_OFFICE = Yii::app()->db->createCommand("SELECT SUM(BONUS) AS TOTAL FROM tbl_salary_details WHERE EMPLOYEE_ID_FK=".$id." AND BILL_ID_FK=".$bill->ID)->queryRow()['TOTAL'];
			}
		}
		$BONUS_PREVIOUS_OFFICE = isset($investment->BONUS) ? $investment->BONUS : 0;
		$TOTAL_BONUS = $BONUS_CURRENT_OFFICE + $BONUS_PREVIOUS_OFFICE;
		
		
		$bills = Bill::model()->findAll('PFMS_STATUS="Passed" AND FINANCIAL_YEAR_ID_FK='.$financialYear->ID.' AND IS_UA_BILL=1');
		$UA_CURRENT_OFFICE = 0;
		foreach($bills as $bill){
			$OtherBillEmployees = explode(",", OtherBillEmployees::model()->find('BILL_ID='.$bill->ID)->EMPLOYEE_ID);
			if(in_array($id, $OtherBillEmployees)){
				$UA_CURRENT_OFFICE = Yii::app()->db->createCommand("SELECT SUM(UA) AS TOTAL FROM tbl_salary_details WHERE EMPLOYEE_ID_FK=".$id." AND BILL_ID_FK=".$bill->ID)->queryRow()['TOTAL'];
			}
		}
		$UA_PREVIOUS_OFFICE = isset($investment->UNIFORM) ? $investment->UNIFORM : 0;
		$TOTAL_UA = $UA_CURRENT_OFFICE + $UA_PREVIOUS_OFFICE;
		
		$bills = Bill::model()->findAll('PFMS_STATUS="Passed" AND FINANCIAL_YEAR_ID_FK='.$financialYear->ID.' AND IS_CEA_BILL=1');
		$CEA_CURRENT_OFFICE = 0;
		foreach($bills as $bill){
			$OtherBillEmployees = explode(",", OtherBillEmployees::model()->find('BILL_ID='.$bill->ID)->EMPLOYEE_ID);
			if(in_array($id, $OtherBillEmployees)){
				$CEA_CURRENT_OFFICE = Yii::app()->db->createCommand("SELECT SUM(CEA) AS TOTAL FROM tbl_salary_details WHERE EMPLOYEE_ID_FK=".$id." AND BILL_ID_FK=".$bill->ID)->queryRow()['TOTAL'];
			}
		}
		$CEA_PREVIOUS_OFFICE = isset($investment->CEA) ? $investment->CEA : 0;
		$TOTAL_CEA = $CEA_CURRENT_OFFICE + $CEA_PREVIOUS_OFFICE;
		
		$bills = Bill::model()->findAll('PFMS_STATUS="Passed" AND FINANCIAL_YEAR_ID_FK='.$financialYear->ID.' AND (IS_LTC_ADVANCE_BILL=1 OR IS_LTC_CLAIM_BILL=1)');
		$LTC_HTC_CURRENT_OFFICE = 0;
		foreach($bills as $bill){
			$OtherBillEmployees = explode(",", OtherBillEmployees::model()->find('BILL_ID='.$bill->ID)->EMPLOYEE_ID);
			if(in_array($id, $OtherBillEmployees)){
				$LTC_HTC_CURRENT_OFFICE = Yii::app()->db->createCommand("SELECT SUM(LTC_HTC) AS TOTAL FROM tbl_salary_details WHERE EMPLOYEE_ID_FK=".$id." AND BILL_ID_FK=".$bill->ID)->queryRow()['TOTAL'];
			}
		}
		$LTC_HTC_PREVIOUS_OFFICE = isset($investment->LTC_HTC) ? $investment->LTC_HTC : 0;
		$TOTAL_LTC_HTC = $LTC_HTC_CURRENT_OFFICE + $LTC_HTC_PREVIOUS_OFFICE;
		
		$bills = Bill::model()->findAll('PFMS_STATUS="Passed" AND FINANCIAL_YEAR_ID_FK='.$financialYear->ID.' AND IS_EL_ENCASHMENT_BILL=1');
		$EL_ENCASH_CURRENT_OFFICE = 0;
		foreach($bills as $bill){
			$OtherBillEmployees = explode(",", OtherBillEmployees::model()->find('BILL_ID='.$bill->ID)->EMPLOYEE_ID);
			if(in_array($id, $OtherBillEmployees)){
				$EL_ENCASH_CURRENT_OFFICE = Yii::app()->db->createCommand("SELECT SUM(EL_ENCASHMENT) AS TOTAL FROM tbl_salary_details WHERE EMPLOYEE_ID_FK=".$id." AND BILL_ID_FK=".$bill->ID)->queryRow()['TOTAL'];
			}
		}
		$EL_ENCASH_PREVIOUS_OFFICE = isset($investment->EL_ENCASH) ? $investment->EL_ENCASH : 0;
		$TOTAL_EL_ENCASH = $EL_ENCASH_CURRENT_OFFICE + $EL_ENCASH_PREVIOUS_OFFICE;
		
		$TOTAL_INCOME_FROM_SALARY = $TOTAL_SALARIES[0]['TOTAL'] + $TOTAL_DA_TA_ARREAR + $TOTAL_OTA_HONORIUM + $TOTAL_BONUS + $TOTAL_UA + $TOTAL_CEA + $TOTAL_LTC_HTC + $TOTAL_EL_ENCASH;
		
		$RENT_PAID = isset($investment->HRA) ? $investment->HRA : 0;
		$ACTUAL_HRA = $TOTAL_SALARIES[0]['HRA'];
		$RENT_PAID_EXCESS_OF_TEN_PERCENT = max(0, round($RENT_PAID - (0.1*($TOTAL_SALARIES[0]['BASIC'] + $TOTAL_SALARIES[0]['DA']))));
		$FOURTY_PERCENT_OF_SALARY = round(0.4*($TOTAL_SALARIES[0]['BASIC'] + $TOTAL_SALARIES[0]['DA']));
		$TOTAL_RENT = min ($ACTUAL_HRA, $RENT_PAID_EXCESS_OF_TEN_PERCENT, $FOURTY_PERCENT_OF_SALARY);
		
		$TOTAL_OTHER_INCOME = isset($investment->OTHER_INCOME) ? $investment->OTHER_INCOME : 0;
		$TOTAL_HOUSE_INCOME = isset($investment->HOUSE_INCOME) ? $investment->HOUSE_INCOME : 0;
		
		$TOTAL_CPF_EMPLOYEE = $TOTAL_DA_TA_ARREAR_CPF + $TOTAL_SALARIES[0]['CPF'];
		
		$GROSS_INCOME = 0;
		if($employee->PENSION_TYPE == "OPS"){
			$GROSS_INCOME = $TOTAL_INCOME_FROM_SALARY - $TOTAL_RENT - $TOTAL_OTHER_INCOME - $TOTAL_HOUSE_INCOME;
		}
		if($employee->PENSION_TYPE == "NPS"){
			$GROSS_INCOME = $TOTAL_INCOME_FROM_SALARY - $TOTAL_RENT + $TOTAL_CPF_EMPLOYEE - $TOTAL_HOUSE_INCOME;
		}
		
		$TA_ALLOWED = min($TOTAL_SALARIES[0]['TA'], 19200);
		$INCOME_AFTER_DEDUCTION = $GROSS_INCOME - $TOTAL_SALARIES[0]['PT'] - $TA_ALLOWED;
		
		$TOTAL_CGHS = $TOTAL_SALARIES[0]['CGHS'];
		$MEDICAL_INSURANCE = isset($investment->MEDICAL_INSURANCE) ? $investment->MEDICAL_INSURANCE : 0;
		$DONATION = isset($investment->DONATION) ? $investment->DONATION : 0;
		$DISABILITY_MED_EXP = isset($investment->DISABILITY_MED_EXP) ? $investment->DISABILITY_MED_EXP : 0;
		$EDU_LOAD_INT = isset($investment->EDU_LOAD_INT) ? $investment->EDU_LOAD_INT : 0;
		$SELF_DISABILITY = isset($investment->SELF_DISABILITY) ? $investment->SELF_DISABILITY : 0;
		$HOME_LOAN_INT = isset($investment->HOME_LOAN_INT) ? $investment->HOME_LOAN_INT : 0;
		$MIN_HOME_LOAN_INT = min($HOME_LOAN_INT,200000);
		$HOME_LOAD_EXCESS_2013_14 = min((($HOME_LOAN_INT >= 250001) ? ($HOME_LOAN_INT - $MIN_HOME_LOAN_INT) : 0 ), 100000);
		$HOME_LOAD_EXCESS_2013_14_ADDTIONAL = ($HOME_LOAN_INT < 250001) ? min(($HOME_LOAN_INT - $MIN_HOME_LOAN_INT), 100000) : 0;
		$NPS_UNDER_80CCD_1B = isset($investment->NPS_UNDER_80CCD_1B) ? $investment->NPS_UNDER_80CCD_1B : 0;
		$BANK_INTEREST_DED_80TTA = isset($investment->BANK_INTEREST_DED_80TTA) ? $investment->BANK_INTEREST_DED_80TTA : 0;
		$TOTAL_EXEMPTION = $TOTAL_CGHS+$MEDICAL_INSURANCE+$DONATION+$DISABILITY_MED_EXP+$EDU_LOAD_INT+$SELF_DISABILITY+
		$MIN_HOME_LOAN_INT+$HOME_LOAD_EXCESS_2013_14+$NPS_UNDER_80CCD_1B+$BANK_INTEREST_DED_80TTA;
		
		//$TOTAL_EXEMPTION = $TOTAL_CGHS+$MEDICAL_INSURANCE+$DONATION+$DISABILITY_MED_EXP+$EDU_LOAD_INT+$SELF_DISABILITY+ $HOME_LOAN_INT+$MIN_HOME_LOAN_INT+$HOME_LOAD_EXCESS_2013_14+$NPS_UNDER_80CCD_1B+$BANK_INTEREST_DED_80TTA;		
		
		
		$TOTAL_CPF = ($employee->PENSION_TYPE == "OPS") ? $TOTAL_CPF_EMPLOYEE : ($TOTAL_CPF_EMPLOYEE * 2);
		$TOTAL_CPF_FOR_SAVING = ($employee->PENSION_TYPE == "OPS") ? $TOTAL_CPF_EMPLOYEE : $TOTAL_CPF_EMPLOYEE;
		
		$TOTAL_CGEGIS = $TOTAL_SALARIES[0]['CGEGIS'];
		
		$POSTAL_LIC_FROM_SALARY = $TOTAL_SALARIES[0]['PLI'];
		$LIC_FROM_SALARY = $TOTAL_SALARIES[0]['LIC'];
		$LIC_FROM_INVESTMENTS = isset($investment->INSURANCE_LIC_OTHER) ? $investment->INSURANCE_LIC_OTHER : 0;
		$INSURANCE_LIC_OTHER = $POSTAL_LIC_FROM_SALARY + $LIC_FROM_SALARY + $LIC_FROM_INVESTMENTS;
		
		$TUITION_FESS_EXEMPTION = isset($investment->TUITION_FESS_EXEMPTION) ? $investment->TUITION_FESS_EXEMPTION : 0;
		$PPF_NSC = isset($investment->PPF_NSC) ? $investment->PPF_NSC : 0;
		$HOME_LOAD_PR = isset($investment->HOME_LOAD_PR) ? $investment->HOME_LOAD_PR : 0;
		$PLI_ULIP = isset($investment->PLI_ULIP) ? $investment->PLI_ULIP : 0;
		$TERM_DEPOSIT_ABOVE_5 = isset($investment->TERM_DEPOSIT_ABOVE_5) ? $investment->TERM_DEPOSIT_ABOVE_5 : 0;
		$MUTUAL_FUND = isset($investment->MUTUAL_FUND) ? $investment->MUTUAL_FUND : 0;
		$PENSION_FUND = isset($investment->PENSION_FUND) ? $investment->PENSION_FUND : 0;
		$CPF_809CCD = isset($investment->CPF) ? $investment->CPF : 0;
		$REGISTRY_STAMP = isset($investment->REGISTRY_STAMP) ? $investment->REGISTRY_STAMP : 0;
		$TOTAL_SAVING_80C = $TOTAL_CPF_FOR_SAVING+$TOTAL_CGEGIS+$INSURANCE_LIC_OTHER+$TUITION_FESS_EXEMPTION+$PPF_NSC+$HOME_LOAD_PR+$PLI_ULIP+$TERM_DEPOSIT_ABOVE_5+$MUTUAL_FUND
							+$PENSION_FUND+$CPF_809CCD+$REGISTRY_STAMP;
		$MIN_SAVING_80C = min($TOTAL_SAVING_80C,150000);
		$NET_SAVING_80C = ($employee->PENSION_TYPE == "OPS") ? $MIN_SAVING_80C : ($MIN_SAVING_80C + $TOTAL_CPF_FOR_SAVING);
		
		$TOTAL_DEDUCTIONS = $TOTAL_EXEMPTION+$NET_SAVING_80C;
		$TOTAL_TAXABLE_INCOME = $INCOME_AFTER_DEDUCTION-$TOTAL_DEDUCTIONS;
		$TOTAL_TAXABLE_INCOME_ROUNDED = round($INCOME_AFTER_DEDUCTION-$TOTAL_DEDUCTIONS, -1);
		
		$TAXABLE_INCOME = 0;
		$TAX_REBATE_UNDER_87 = ($TOTAL_TAXABLE_INCOME<500001)? (MIN($TAXABLE_INCOME,5000)) : 0;
		
		$FIRST_SLAB_INCOME = 250000;
		$FIRST_SLAB_TAX = 0;
		
		$SECOND_SLAB_INCOME = MIN((($TOTAL_TAXABLE_INCOME_ROUNDED>=$TAX_SLABS_II_MIN) ? ($TOTAL_TAXABLE_INCOME_ROUNDED - $TAX_SLABS_II_MIN) : 0 ), $TAX_SLABS_II_MIN);
		$SECOND_SLAB_TAX = round(($SECOND_SLAB_INCOME *  $TAX_SLABS_II_RATE )/100);
		
		$THIRD_SLAB_INCOME = MIN((($TOTAL_TAXABLE_INCOME_ROUNDED>=$TAX_SLABS_III_MIN) ? ($TOTAL_TAXABLE_INCOME_ROUNDED - $TAX_SLABS_III_MIN) : 0 ), $TAX_SLABS_III_MIN);
		$THIRD_SLAB_TAX = round(($THIRD_SLAB_INCOME *  $TAX_SLABS_III_RATE )/100);
		
		$FOURTH_SLAB_INCOME = MIN((($TOTAL_TAXABLE_INCOME_ROUNDED>=$TAX_SLABS_IV_MIN) ? ($TOTAL_TAXABLE_INCOME_ROUNDED - $TAX_SLABS_IV_MIN) : 0 ), $TAX_SLABS_IV_MIN);
		$FOURTH_SLAB_TAX = round(($FOURTH_SLAB_INCOME *  $TAX_SLABS_IV_RATE )/100);
		
		$TOTAL_SLAB_INCOME = $FIRST_SLAB_INCOME + $SECOND_SLAB_INCOME + $THIRD_SLAB_INCOME + $FOURTH_SLAB_INCOME;
		$TOTAL_SLAB_TAX = $FIRST_SLAB_TAX + $SECOND_SLAB_TAX + $THIRD_SLAB_TAX + $FOURTH_SLAB_TAX;
		
		$TOTAL_SLAB_TAX_WITH_CESS = round(0.03 * $TOTAL_SLAB_TAX);
		$GROSS_TAX_PAYABLE = $TOTAL_SLAB_TAX + $TOTAL_SLAB_TAX_WITH_CESS;
		
		$TAX_PAID_FROM_SALARY = $TOTAL_SALARIES[0]['IT'];
		$TAX_REMAINING = $GROSS_TAX_PAYABLE - $TAX_PAID_FROM_SALARY;
		$TAX_REMAINING_TEXT = (($GROSS_TAX_PAYABLE - $TAX_PAID_FROM_SALARY) < 0 ) ? "NET TAX REFUNDABLE":"NET TAX PAYABLE";
		
		$PAN_NUMBER = $employee->PAN;
		
		$REMAINING_MONTHS = remainingMonthsForIT($periods, $id);
		if($TAX_REMAINING <= 0){
			$IT_FOR_REMAINING_MONTHS = getNilParts($REMAINING_MONTHS);
		}
		else{
			$IT_FOR_REMAINING_MONTHS = getParts($TAX_REMAINING, $REMAINING_MONTHS);
		}
		
		for($i=(count($SALARIES) - $REMAINING_MONTHS),$j=0; $i<count($SALARIES); $i++){
			$SALARIES[$i]['IT'] = $IT_FOR_REMAINING_MONTHS[$j];
			$j++;
		}
		
		
		$TOTAL_SALARIES = getSalaryTotal($SALARIES);
		$TAX_PAID_FROM_SALARY = $TOTAL_SALARIES[0]['IT'];
		$TAX_REMAINING = $GROSS_TAX_PAYABLE - $TAX_PAID_FROM_SALARY;
		$TAX_REMAINING_TEXT = (($GROSS_TAX_PAYABLE - $TAX_PAID_FROM_SALARY) < 0 ) ? "NET TAX REFUNDABLE":"NET TAX PAYABLE";
		
		
		include ($employee->PENSION_TYPE == "OPS") ? "Form16_OPS.php" : "Form16_NPS.php";
	}
?>
</table>
<?php
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
	));
	
	return $total;
}
function remainingMonthsForIT($periods, $emp_id){
	$count = 0;
	
	foreach($periods as $period){
		$MONTH = explode('-', $period)[0];
		$YEAR = explode('-', $period)[1];
		if(!SalaryDetails::model()->exists('EMPLOYEE_ID_FK='.$emp_id.' AND MONTH='.$MONTH.' AND YEAR='.$YEAR.' AND IS_SALARY_BILL=1') && !SupplementarySalaryDetails::model()->exists('EMPLOYEE_ID_FK='.$emp_id.' AND MONTH='.$MONTH.' AND YEAR='.$YEAR)){
			$count++;
		}
	}
	return $count;
}
function getParts($tot, $n){
	$values = array_fill( 0, $n-1, round( $tot/$n) );
	$values[ $n-1 ] = round( $tot - array_sum( $values ),2 );
	return $values;
}
function getNilParts($months){
	$values = array();
	for($i=0; $i<=$months-1;$i++)
		array_push($values, 0);
	
	return $values;
}
?>
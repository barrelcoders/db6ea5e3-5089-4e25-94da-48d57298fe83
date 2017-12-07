<?php 
	$id=0;
	if(isset($_GET)){
		$id=$_GET['id'];
	}
	$master = Master::model()->findByPK(1);
	$employee = Employee::model()->findByPK($id);
	if($employee->IS_RETIRED !=0){
?>
<style>td {text-align: center;}.one-table.small td, .one-table.small th{font-size: 10px;}</style>

<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/oneadmin.css" rel="stylesheet">
<?php
	
	$monthName = array('1'=>'January', '2'=>'February', '3'=>'March', '4'=>'April', '5'=>'May', '6'=>'June', '7'=>'July', '8'=>'August', '9'=>'September', '10'=>'October', '11'=>'November', '12'=>'December');
	$monthNameHindi = array('1'=>'जनवरी', '2'=>'फ़रवरी', '3'=>'मार्च', '4'=>'अप्रैल', '5'=>'मई', '6'=>'जून', '7'=>'जुलाई', '8'=>'अगस्त', '9'=>'सितंबर', '10'=>'अक्टूबर', '11'=>'नवंबर', '12'=>'दिसंबर'); 
	
?>
<p style="font-size: 20px;text-align: center;font-weight: bold;">अंतिम वेतन प्रमाण पत्र /LAST PAY CERTIFICATE</p>
<p style="font-size: 15px;text-align: center;font-weight: bold;">[ See Rule 11(4) and 80 of the Central Government Account, Receipts Payments Rules, 1983 ]</p>
<br><br>
<ol type="1">
<li style="font-size: 15px;">Last Pay Certificate of <b><?php echo Employee::model()->findByPK($id)->NAME_HINDI; ?>/ 
<?php echo Employee::model()->findByPK($id)->NAME?>, <?php echo Designations::model()->findByPK(Employee::model()->findByPK($id)->DESIGNATION_ID_FK)->DESIGNATION; ?></b>, Bangalore. of 
Ministry / Department / Office  <b><?php echo $master->OFFICE_NAME_HINDI;?>/<?php echo $master->OFFICE_NAME;?></b>
 proceeding on retirement</b>. He has been retired on <?php echo date('d-M-Y', strtotime(Employee::model()->findByPK($id)->ORG_RETIRE_DATE));?>.</li>
<br>
<table class="one-table" cellmargin="10" style="display: block; clear: both;width: 300px;">
	<tbody>
		<tr>
			<td>MICR CODE</td>
			<td><?php echo Employee::model()->findByPK($id)->MICR; ?></td>
		</tr>
		<tr>
			<td>Bank Account No.</td>
			<td><?php echo Employee::model()->findByPK($id)->ACCOUNT_NO; ?></td>
		</tr>
		<tr>
			<td>PAN NO.</td>
			<td><?php echo Employee::model()->findByPK($id)->PAN; ?></td>
		</tr>
		<tr>
			<td>IFSC CODE</td>
			<td><?php echo Employee::model()->findByPK($id)->IFSC; ?></td>
		</tr>
	</tbody>
</table>
<li>He has been paid upto and at the following rates for 
<?php 

	$salary = Yii::app()->db->createCommand("SELECT ID, MONTH, YEAR, EMPLOYEE_ID_FK FROM tbl_salary_details WHERE EMPLOYEE_ID_FK=$id ORDER BY ID DESC")->queryRow();
	echo $monthName[$salary['MONTH']]."-".$salary['YEAR'];
	$salaryDetails = SalaryDetails::model()->find(array('condition'=>'EMPLOYEE_ID_FK='.$salary['EMPLOYEE_ID_FK'].' AND IS_SALARY_BILL=1', 'order'=>'ID DESC'));
	
?></li>
<table class="one-table" cellmargin="10" style="display: block; clear: both;width: 500px;">
	<tbody>
		<tr>
			<td>BASIC</td>
			<td><?php echo $salaryDetails->BASIC; ?></td>
			<td>GPFC</td>
			<td><?php echo $salaryDetails->CPF_TIER_I; ?></td>
			<td>HBA</td>
			<td><?php echo $salaryDetails->HBA_EMI; ?></td>
		</tr>
		<tr>
			<td>GRADE PAY</td>
			<td><?php echo $salaryDetails->GP; ?></td>
			<td>GPFR</td>
			<td><?php echo $salaryDetails->CPF_TIER_II; ?></td>
			<td>Festival Adv</td>
			<td><?php echo $salaryDetails->FEST_EMI; ?></td>
		</tr>
		<tr>
			<td>FPA</td>
			<td><?php //echo $salaryDetails->FEST_EMI; ?>0</td>
			<td>CGEGIS</td>
			<td><?php echo $salaryDetails->CGEGIS; ?></td>
			<td>OMCA</td>
			<td><?php echo $salaryDetails->MCA_EMI; ?></td>
		</tr>
		<tr>
			<td>CGHS</td>
			<td><?php echo $salaryDetails->CGHS; ?></td>
			<td>Special Pay</td>
			<td><?php echo $salaryDetails->SP; ?></td>
			<td>Cycle Adv.</td>
			<td><?php echo $salaryDetails->CYCLE_EMI; ?></td>
		</tr>
		<tr>
			<td>DA @4%</td>
			<td><?php echo $salaryDetails->DA; ?></td>
			<td>Income Tax</td>
			<td><?php echo round(($salaryDetails->IT*100)/103); ?></td>
			<td>Flood Ad.</td>
			<td><?php echo $salaryDetails->FLOOD_EMI; ?></td>
		</tr>
		<tr>
			<td>CCA</td>
			<td><?php echo $salaryDetails->CCA; ?></td>
			<td>EDU.CESS</td>
			<td><?php echo round(($salaryDetails->IT*2)/103); ?></td>
			<td>Computer Adv.</td>
			<td><?php echo $salaryDetails->COMP_EMI; ?></td>
		</tr>
		<tr>
			<td>HRA</td>
			<td><?php echo $salaryDetails->HRA; ?></td>
			<td>H. EDU.CESS</td>
			<td><?php echo round(($salaryDetails->IT*1)/103); ?></td>
			<td>PT</td>
			<td><?php echo $salaryDetails->PT; ?></td>
		</tr>
		<tr>
			<td>TA</td>
			<td><?php echo $salaryDetails->TA; ?></td>
			<td>LICENCE FEES</td>
			<td><?php echo $salaryDetails->LF; ?></td>
			<td>Credit Co. So.</td>
			<td><?php echo $salaryDetails->CCS; ?></td>
		</tr>
		<tr>
			<td>Other</td>
			<td>0</td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td>GROSS</td>
			<td><?php echo $salaryDetails->GROSS; ?></td>
			<td>Deductions</td>
			<td><?php echo $salaryDetails->DED; ?></td>
			<td>Net Pay</td>
			<td><?php echo $salaryDetails->NET; ?></td>
		</tr>
	</tbody>
</table>
<br>
<li> His/Her GPF Account NO. <?php if(Employee::model()->findByPK($id)->PENSION_TYPE == "OPS") echo "BGR/CCE/".Employee::model()->findByPK($id)->PENSION_ACC_NO; else echo Employee::model()->findByPK($id)->PENSION_ACC_NO; ?>  is maintained by PAO,C.Ex, Bangalore.</li>
<li> He/She made over charge of the Office/Post of <?php echo Designations::model()->findByPK(Employee::model()->findByPK($id)->DESIGNATION_ID_FK)->DESIGNATION; ?> of <?php echo $master->OFFICE_NAME;?>, <?php echo (Employee::model()->findByPK($id)->POSTING_ID_FK != 0) ? Posting::model()->findByPK(Employee::model()->findByPK($id)->POSTING_ID_FK)->PLACE : "";?> 
in the <?php echo Employee::model()->findByPK($id)->DEPT_RELIEF_TIME;?> of <?php echo date('d-M-Y', strtotime(Employee::model()->findByPK($id)->DEPT_RELIEF_DATE));?></li>
<li>Recoveries are to be made from the pay of the Government Servent as detailed below.</li>
<li> He/She is also entitled to joining time     for as Admissible days.</li>
<li> He/She has been sanctioned leave preceding joining time   for As Admissible days.</li>
<li>* [ Reduntant - Not printed ]</li>
<li> PLI Policy Details.</li>
<table class="one-table" cellmargin="10" style="display: block; clear: both;width: 300px;">
	<tbody>
		<tr>
			<th>Policy No</th>
			<th>Amt</th>
		</tr>
		<?php 
			$lic_polices = EmployeePLIPolicies::model()->findAll('EMPLOYEE_ID_FK='.$id.' AND STATUS=1');
			$total = 0;
			foreach($lic_polices as $policy){
				$total = $total + $policy->AMOUNT;
				?>
				<tr>
					<td><?php echo $policy->POLICY_NO; ?></td>
					<td><?php echo $policy->AMOUNT; ?></td>
				</tr>
				<?php
			}
		?>
		<tr>
			<th>TOTAL</th>
			<th><?php echo $total;?></th>
		</tr>
	</tbody>
</table>
<li> Details of Income Tax recovered up to the date from the begining of the current financial year are noted in the annexure</li>
<li> Service for the period <?php echo date('M-Y', strtotime(Employee::model()->findByPK($id)->DEPT_JOIN_DATE));?> to 
<?php echo date('M-Y', strtotime(Employee::model()->findByPK($id)->DEPT_RELIEF_DATE));?> ( during his/her stay in this office ) has been verified.</li>
<?php
	$bills = Bill::model()->findAll('PFMS_STATUS="Passed" AND FINANCIAL_YEAR_ID_FK='.$financialYear->ID.' AND IS_DA_ARREAR_BILL=1');
	
	foreach($bills as $bill){
		if(SalaryDetails::model()->exists('EMPLOYEE_ID_FK='.$id.' AND BILL_ID_FK = '.$bill->ID)){
			$TOTAL_DA_TA_ARREAR = Yii::app()->db->createCommand("SELECT SUM(DA) + SUM(TA) AS TOTAL FROM tbl_salary_details WHERE EMPLOYEE_ID_FK=".$id." AND BILL_ID_FK = ".$bill->ID)->queryRow()['TOTAL'];
			$TOTAL_DA_TA_ARREAR_CPF = Yii::app()->db->createCommand("SELECT SUM(CPF_TIER_I) AS TOTAL FROM tbl_salary_details WHERE EMPLOYEE_ID_FK=".$id." AND BILL_ID_FK = ".$bill->ID)->queryRow()['TOTAL'];
		?>
			<li> He/She has received DA/TA arrear of Rs.<?php echo $TOTAL_DA_TA_ARREAR;?>/- <?php ($TOTAL_DA_TA_ARREAR_CPF == 0) ? "": ", and CPF: ".$TOTAL_DA_TA_ARREAR_CPF;?>. against Bill No. <?php echo $bill->BILL_NO;?></li>
		<?php
				
		}
	}
?>
<li><b style="font-weight: bold;">Remarks:</b> <?php echo Employee::model()->findByPK($id)->LPC_REMARKS; ?></li>
<br>
<li style="font-size: 15px;font-weight: bold;">वसूली का विवरण/Details of recoveries</p>
<br>
<li>1)  GPF Adv ; Rs…….….., drawn in  ………. Rs……….../- recoverable in ……………. Installments of Rs……….. Each.</li>
<li>2) Transfer TA  advance of ---- has been drawn and paid vide Bill No</li>
<li>3) Professional Tax at the rate of Rs. 200/- has been recovered upto <?php echo $monthName[$salary['MONTH']]."-".$salary['YEAR'];?>. </li>
<?php
	$BILL_TYPE = 1;
	$BILL_SUB_TYPE = 0;
	if(Employee::model()->findByPK($id)->PENSION_TYPE == "NPS"){
		$BILL_TYPE = 2;
	}
	
	if($BILL_TYPE == 1){
		$BILL_SUB_TYPE = 17;
	}
	else{
		$BILL_SUB_TYPE = 18;
	}
	$da_bills = Bill::model()->findAll('BILL_TYPE='.$BILL_TYPE.' AND BILL_SUB_TYPE='.$BILL_SUB_TYPE);
	$DA_Arrear=0;
	$DA_Arrear_Bills_Array=array();
	foreach($da_bills as $bill){
		if(SalaryDetails::model()->exists('EMPLOYEE_ID_FK='.$employee->ID.' AND BILL_ID_FK='.$bill->ID)){			
			$DA_Arrear += SalaryDetails::model()->find('EMPLOYEE_ID_FK='.$employee->ID.' AND BILL_ID_FK='.$bill->ID)->DA;
			array_push($DA_Arrear_Bills_Array, $bill->BILL_NO);	
		}
	}
	if($DA_Arrear > 0){
		?>
			<li>DA Arrear of Rs.<?php echo $DA_Arrear;?>/- has been paid vide Bill No. (<?php echo implode(",", $DA_Arrear_Bills_Array)?>).</li>
		<?php
	}
?>
<?php if($salaryDetails->HBA_EMI) { ?>
<li>Out of HBA Interest of Rs.<?php echo $salaryDetails->HBA_TOTAL?>/-, an amount of Rs.<?php echo $salaryDetails->HBA_EMI * intVal($salaryDetails->HBA_TOTAL/$salaryDetails->HBA_EMI)?>/- 
has been recovered in <?php echo intVal($salaryDetails->HBA_TOTAL/$salaryDetails->HBA_EMI)?> monthly installments of Rs.<?php echo $salaryDetails->HBA_EMI?>/- each. 
The balance of Rs.<?php echo ($salaryDetails->HBA_TOTAL - ( $salaryDetails->HBA_EMI * intVal($salaryDetails->HBA_TOTAL/$salaryDetails->HBA_EMI)))?>/- may be recovered
 in <?php echo ($salaryDetails->HBA_TOTAL - ( $salaryDetails->HBA_EMI * intVal($salaryDetails->HBA_TOTAL/$salaryDetails->HBA_EMI))) < $salaryDetails->HBA_EMI ? 1 : 0; ?> 
 monthly installments of Rs.<?php echo ($salaryDetails->HBA_TOTAL - ( $salaryDetails->HBA_EMI * intVal($salaryDetails->HBA_TOTAL/$salaryDetails->HBA_EMI)))?>/- each w.e.f. 
 the salary of May-2016 onwards.</li>
<?php } ?>
<?php if($salaryDetails->MCA_EMI) { ?>
<li>Out of MCA Interest of Rs.<?php echo $salaryDetails->MCA_TOTAL?>/-, an amount of Rs.
<?php echo $salaryDetails->MCA_EMI * intVal($salaryDetails->MCA_TOTAL/$salaryDetails->MCA_EMI)?>/- has to be recovered in 
<?php echo intVal($salaryDetails->MCA_TOTAL/$salaryDetails->MCA_EMI)?> monthly installments of Rs.<?php echo $salaryDetails->MCA_EMI?>/- each. The balance of Rs.
<?php echo ($salaryDetails->MCA_TOTAL - ( $salaryDetails->MCA_EMI * intVal($salaryDetails->MCA_TOTAL/$salaryDetails->MCA_EMI)))?>/- may be recovered in 
<?php echo ($salaryDetails->MCA_TOTAL - ( $salaryDetails->MCA_EMI * intVal($salaryDetails->MCA_TOTAL/$salaryDetails->MCA_EMI))) < $salaryDetails->MCA_EMI ? 1 : 0; ?> 
monthly installments of Rs.<?php echo ($salaryDetails->MCA_TOTAL - ( $salaryDetails->MCA_EMI * intVal($salaryDetails->MCA_TOTAL/$salaryDetails->MCA_EMI)))?>/- 
each w.e.f. the salary of Feb-2017 onwards.</li>
<?php } ?>
<li style="font-size: 15px;font-weight: bold;">आयकर के लिए वेतन का विवरण /Salary Details for Income Tax</li>

<table class="one-table small" cellmargin="10" style="display: block; clear: both; font-size: 10px;">
	<tbody>
		<tr>
			<th>Month</th>
			<th>BASIC</th>
			<th>Grade Pay</th>
			<th>PP</th>
			<th>SP</th>
			<th>DA</th>
			<th>FPA</th>
			<th>HRA</th>
			<th>TA</th>
			<th>Gross</th>
			<th>CGEGIS</th>
			<th>GPFC</th>
			<th>GPFR</th>
			<th>CGHS</th>
			<th>IT</th>
			<th>E. Cess</th>
			<th>H.E. Cess</th>
			<th>DED</th>
			<th>NET</th>
			<th>PT</th>
			<th>OTHER DED</th>
			<th>AMOUNT TO BANK</th>
		</tr>
<?php
	$financialYear = FinancialYears::model()->find('STATUS=1');
	$salaries = YII::app()->db->createCommand("SELECT * FROM tbl_salary_details a, tbl_bill b WHERE b.ID = a.BILL_ID_FK AND a.EMPLOYEE_ID_FK=$id AND
 a.IS_SALARY_BILL=1 AND b.FINANCIAL_YEAR_ID_FK=".$financialYear->ID.";")->queryAll();
	foreach ($salaries as $salary) {
	?>
	<tr>
		<td style="text-align: center;"><?php echo$monthName[$salary['MONTH']]."-".$salary['YEAR'];?></td>
		<td style="text-align: center;"><?php echo $salary['BASIC'];?></td>
		<td style="text-align: center;"><?php echo $salary['GP'];?></td>
		<td style="text-align: center;"><?php echo $salary['PP'];?></td>
		<td style="text-align: center;"><?php echo $salary['SP'];?></td>
		<td style="text-align: center;"><?php echo $salary['DA'];?></td>
		<td style="text-align: center;"><?php echo 0;?></td>
		<td style="text-align: center;"><?php echo $salary['HRA'];?></td>
		<td style="text-align: center;"><?php echo $salary['TA'];?></td>
		<td style="text-align: center;"><?php echo $salary['GROSS'];?></td>
		<td style="text-align: center;"><?php echo $salary['CGEGIS'];?></td>
		<td style="text-align: center;"><?php echo $salary['CPF_TIER_I'];?></td>
		<td style="text-align: center;"><?php echo $salary['CPF_TIER_II'];?></td>
		<td style="text-align: center;"><?php echo $salary['CGHS'];?></td>
		<td style="text-align: center;"><?php echo round(($salary['IT']*100)/103); ?></td>
		<td style="text-align: center;"><?php echo round(($salary['IT']*2)/103); ?></td>
		<td style="text-align: center;"><?php echo round(($salary['IT']*1)/103); ?></td>
		<td style="text-align: center;"><?php echo $salary['DED'];?></td>
		<td style="text-align: center;"><?php echo $salary['NET'];?></td>
		<td style="text-align: center;"><?php echo $salary['PT'];?></td>
		<td style="text-align: center;"><?php echo $salary['OTHER_DED'];?></td>
		<td style="text-align: center;"><?php echo $salary['AMOUNT_BANK'];?></td>
	</tr>
	<?php
	}
?>
	</tbody>
</table>
<li style="font-size: 15px;font-weight: bold;">LIC Policy Details</li>
<table class="one-table" cellmargin="10" style="display: block; clear: both;width: 300px;">
	<tbody>
		<tr>
			<th>Policy No</th>
			<th>Amt</th>
		</tr>
		<?php 
			$lic_polices = EmployeeLICPolicies::model()->findAll('EMPLOYEE_ID_FK='.$id.' AND STATUS=1');
			$total = 0;
			foreach($lic_polices as $policy){
				$total = $total + $policy->AMOUNT;
				?>
				<tr>
					<td><?php echo $policy->POLICY_NO; ?></td>
					<td><?php echo $policy->AMOUNT; ?></td>
				</tr>
				<?php
			}
		?>
		<tr>
			<th>TOTAL</th>
			<th><?php echo $total;?></th>
		</tr>
	</tbody>
</table>
</ol>
<br><br>
<div style="font-weight: bold; width:400px; float: right;text-align:center; margin-top:20px;margin-right:-10px;">
	<p>(<?php echo Employee::model()->findByPK($master['DEPT_ADMIN_EMPLOYEE'])->NAME;?>)</p>
	<p><?php echo Designations::model()->findByPK(Employee::model()->findByPK($master['DEPT_ADMIN_EMPLOYEE'])->DESIGNATION_ID_FK)->DESIGNATION;?></p>
	<p><?php echo $master['DEPT_NAME']?></p>
</div>
<script type="text/javascript">window.onload = function() { window.print(); }</script><style>
<?php	
	}
	else{
		echo "<script>alert('LPC for $employee->NAME is not available. he is currently working in $master->OFFICE_NAME');</script>";
	}
?>
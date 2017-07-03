<?php 
	$id=0;
	if(isset($_GET)){
		$id=$_GET['id'];
	}
	$master = Master::model()->findByPK(1);
	$employee = Employee::model()->findByPK($id);
	if($employee->IS_TRANSFERRED !=0 && $employee->TRANSFERED_TO !='' && $employee->TRANSFER_ORDER != ''){
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
<p style="font-size: 15px;">1. Last Pay Certificate of <b><?php echo Employee::model()->findByPK($id)->NAME_HINDI; ?>/ 
<?php echo Employee::model()->findByPK($id)->NAME?>, <?php echo Designations::model()->findByPK(Employee::model()->findByPK($id)->DESIGNATION_ID_FK)->DESIGNATION; ?></b>, Bangalore. of 
Ministry / Department / Office  <b><?php echo $master->OFFICE_NAME_HINDI;?>/<?php echo $master->OFFICE_NAME;?></b>
 proceeding on  transfer to  <b><?php echo Employee::model()->findByPK($id)->TRANSFERED_TO;?></b> with reference to  Order <b><?php echo Employee::model()->findByPK($id)->TRANSFER_ORDER;?></b>. 
 He has been relieved on A/F of <?php echo date('d-M-Y', strtotime(Employee::model()->findByPK($id)->DEPT_RELIEF_DATE));?>.</p>
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
<p>2. He has been paid upto and at the following rates for 
<?php 

	$salary = Yii::app()->db->createCommand("SELECT ID, MONTH, YEAR, EMPLOYEE_ID_FK FROM tbl_salary_details WHERE EMPLOYEE_ID_FK=$id ORDER BY ID DESC")->queryRow();
	echo $monthName[$salary['MONTH']]."-".$salary['YEAR'];
	$salaryDetails = SalaryDetails::model()->find(array('condition'=>'EMPLOYEE_ID_FK='.$salary['EMPLOYEE_ID_FK'], 'order'=>'ID DESC'));
	
?></p>
<table class="one-table" cellmargin="10" style="display: block; clear: both;width: 500px;">
	<tbody>
		<tr>
			<td>BASIC</td>
			<td><?php echo $salaryDetails->BASIC; ?></td>
			<td>GPF</td>
			<td><?php echo $salaryDetails->CPF_TIER_I; ?></td>
			<td>HBA</td>
			<td><?php echo $salaryDetails->HBA_EMI; ?></td>
		</tr>
		<tr>
			<td>GRADE PAY</td>
			<td><?php echo $salaryDetails->GP; ?></td>
			<td>CGEGIS</td>
			<td><?php echo $salaryDetails->CGEGIS; ?></td>
			<td>Festival Adv</td>
			<td><?php echo $salaryDetails->FEST_EMI; ?></td>
		</tr>
		<tr>
			<td>FPA</td>
			<td><?php //echo $salaryDetails->FEST_EMI; ?>0</td>
			<td>LICENCE FEES</td>
			<td><?php echo $salaryDetails->LF; ?></td>
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
			<td>FAN Ad.</td>
			<td><?php echo $salaryDetails->FAN_EMI; ?></td>
		</tr>
		<tr>
			<td>HRA@30%</td>
			<td><?php echo $salaryDetails->HRA; ?></td>
			<td>H. EDU.CESS</td>
			<td><?php echo round(($salaryDetails->IT*1)/103); ?></td>
			<td>PT</td>
			<td><?php echo $salaryDetails->PT; ?></td>
		</tr>
		<tr>
			<td>TA</td>
			<td><?php echo $salaryDetails->TA; ?></td>
			<td>Comp Adv</td>
			<td>0</td>
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
<p>3. His/Her GPF Account NO. <?php if(Employee::model()->findByPK($id)->PENSION_TYPE == "OPS") echo "BGR/CCE/".Employee::model()->findByPK($id)->PENSION_ACC_NO; else echo Employee::model()->findByPK($id)->PENSION_ACC_NO; ?>  is maintained by PAO,C.Ex, Bangalore.</p>
<p>4. He/She made over charge of the Office/Post of <?php echo Designations::model()->findByPK(Employee::model()->findByPK($id)->DESIGNATION_ID_FK)->DESIGNATION; ?> of <?php echo $master->OFFICE_NAME;?>  in the after noon of <?php echo date('d-M-Y', strtotime(Employee::model()->findByPK($id)->DEPT_JOIN_DATE));?></p>
<p>5.Recoveries are to be made from the pay of the Government Servent as detailed below.</p>
<p>6. He/She is also entitled to joining time     for as Admissible days.</p>
<p>7. He/She has been sanctioned leave preceding joining time   for As Admissible days.</p>
<p>8.* [ Reduntant - Not printed ]</p>
<p>9. Details for PLI recovery through paybill. PLI Policy No.                   Amount Rs.</p>
<p>10. Details of Income Tax recovered up to the date from the begining of the current financial year are noted in the annexure</p>
<p>11.Service for the period <?php echo date('M-Y', strtotime(Employee::model()->findByPK($id)->DEPT_JOIN_DATE));?> to <?php echo date('M-Y', strtotime(Employee::model()->findByPK($id)->DEPT_RELIEF_DATE));?> ( during his/her stay in this office ) has been verified.</p>
<br>
<p style="font-size: 15px;font-weight: bold;">वसूली का विवरण/Details of recoveries</p>
<br>
<p>1)  GPF Adv ; Rs…….….., drawn in  ………. Rs……….../- recoverable in ……………. Installments of Rs……….. Each.</p>
<p>2) Transfer TA  advance of ---- has been drawn and paid vide Bill No</p>
<p>3) Professional Tax at the rate of Rs. 200/- has been recovered upto <?php echo $monthName[$salary['MONTH']]."-".$salary['YEAR'];?>. </p>
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
		$DA_Arrear += SalaryDetails::model()->find('EMPLOYEE_ID_FK='.$employee->ID.' AND BILL_ID_FK='.$bill->ID)->DA;
		array_push($DA_Arrear_Bills_Array, $bill->BILL_NO);
	}
?>
<p>4) DA Arrear of Rs.<?php echo $DA_Arrear;?>/- has been paid vide Bill No. (<?php echo implode(",", $DA_Arrear_Bills_Array)?>).</p>
<?php if($salaryDetails->HBA_EMI) { ?>
<p>5) Out of HBA Interest of Rs.<?php echo $salaryDetails->HBA_TOTAL?>/-, an amount of Rs.<?php echo $salaryDetails->HBA_EMI * intVal($salaryDetails->HBA_TOTAL/$salaryDetails->HBA_EMI)?>/- has been recovered in <?php echo intVal($salaryDetails->HBA_TOTAL/$salaryDetails->HBA_EMI)?> monthly installments of Rs.<?php echo $salaryDetails->HBA_EMI?>/- each. The balance of Rs.<?php echo ($salaryDetails->HBA_TOTAL - ( $salaryDetails->HBA_EMI * intVal($salaryDetails->HBA_TOTAL/$salaryDetails->HBA_EMI)))?>/- may be recovered in <?php echo ($salaryDetails->HBA_TOTAL - ( $salaryDetails->HBA_EMI * intVal($salaryDetails->HBA_TOTAL/$salaryDetails->HBA_EMI))) < $salaryDetails->HBA_EMI ? 1 : 0; ?> monthly installments of Rs.<?php echo ($salaryDetails->HBA_TOTAL - ( $salaryDetails->HBA_EMI * intVal($salaryDetails->HBA_TOTAL/$salaryDetails->HBA_EMI)))?>/- each w.e.f. the salary of May-2016 onwards.</p>
<?php } ?>
<?php if($salaryDetails->MCA_EMI) { ?>
<p>5) Out of MCA Interest of Rs.<?php echo $salaryDetails->MCA_TOTAL?>/-, an amount of Rs.<?php echo $salaryDetails->MCA_EMI * intVal($salaryDetails->MCA_TOTAL/$salaryDetails->MCA_EMI)?>/- has to be recovered in <?php echo intVal($salaryDetails->MCA_TOTAL/$salaryDetails->MCA_EMI)?> monthly installments of Rs.<?php echo $salaryDetails->MCA_EMI?>/- each. The balance of Rs.<?php echo ($salaryDetails->MCA_TOTAL - ( $salaryDetails->MCA_EMI * intVal($salaryDetails->MCA_TOTAL/$salaryDetails->MCA_EMI)))?>/- may be recovered in <?php echo ($salaryDetails->MCA_TOTAL - ( $salaryDetails->MCA_EMI * intVal($salaryDetails->MCA_TOTAL/$salaryDetails->MCA_EMI))) < $salaryDetails->MCA_EMI ? 1 : 0; ?> monthly installments of Rs.<?php echo ($salaryDetails->MCA_TOTAL - ( $salaryDetails->MCA_EMI * intVal($salaryDetails->MCA_TOTAL/$salaryDetails->MCA_EMI)))?>/- each w.e.f. the salary of Feb-2017 onwards.</p>
<?php } ?>
<p style="font-size: 15px;font-weight: bold;">आयकर के लिए वेतन का विवरण /Salary Details for Income Tax</p>

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
			<th>GPF</th>
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

	$salaries = YII::app()->db->createCommand("SELECT * FROM tbl_salary_details a, tbl_bill b WHERE b.ID = a.BILL_ID_FK AND a.EMPLOYEE_ID_FK=$id AND
 b.IS_ARREAR_BILL=0 AND b.IS_CEA_BILL=0 AND b.IS_BONUS_BILL=0 AND b.IS_UA_BILL=0 AND b.IS_LTC_HTC_BILL=0
ORDER BY a.ID DESC LIMIT 4;")->queryAll();
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
<p style="font-size: 15px;font-weight: bold;">LIC Policy Details</p>
<table class="one-table" cellmargin="10" style="display: block; clear: both;width: 300px;">
	<tbody>
		<tr>
			<th>Policy No</th>
			<th>Amt</th>
		</tr>
		<tr>
			<td></td>
			<td></td>
		</tr>
	</tbody>
</table>
<br><br>
<div style="font-weight: bold; width:400px; float: right;text-align:center; margin-top:20px;margin-right:-10px;">
	<p><?php echo Employee::model()->findByPK($master['DEPT_ADMIN_EMPLOYEE'])->NAME;?></p>
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
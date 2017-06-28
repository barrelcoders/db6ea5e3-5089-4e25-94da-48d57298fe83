<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/oneadmin.css" rel="stylesheet"><?php
	$monthName = array('1'=>'January',
						'2'=>'February',
						'3'=>'March',
						'4'=>'April',
						'5'=>'May',
						'6'=>'June',
						'7'=>'July',
						'8'=>'August',
						'9'=>'September',
						'10'=>'October',
						'11'=>'November',
						'12'=>'December');
	$monthNameHindi = array('1'=>'जनवरी',
						'2'=>'फ़रवरी',
						'3'=>'मार्च',
						'4'=>'अप्रैल',
						'5'=>'मई',
						'6'=>'जून',
						'7'=>'जुलाई',
						'8'=>'अगस्त',
						'9'=>'सितंबर',
						'10'=>'अक्टूबर',
						'11'=>'नवंबर',
						'12'=>'दिसंबर');
?>
<script type="text/javascript">window.onload = function() { window.print(); }</script>
<style>
	.one-header{
		position: relative;
	}
	.one-header > div {
		text-align: right;
		font-weight: bold;
		float: right;
		position: static;
	}
	table{
		display: block;
		width: 656px;
		margin: 0 auto;
		margin-bottom: 80px;
		border-spacing: 0;
	}
	td{
		border: 1px solid #666;
		border-spacing: 0;
	}
	.one-header {
		border: none;
	}
	.one-header > img {
		height: 110px;
		margin-top: 1px;
	}
	.one-header > div {
		padding-right: 7px;
		padding-top: 10px;
	}
	@media print {
		tr.info {background: #CCC;}
	}
</style>
<?php 
 $master = Master::model()->findByPK(1);
 $employee = Employee::model()->findByPK($id);
 
 $salaries = SalaryDetails::model()->findAllByAttributes(array('EMPLOYEE_ID_FK'=>$id, 'IS_SALARY_BILL'=>1));
	foreach($salaries as $salary){
		if(isset($salary)){
?>
	<table style="margin-bottom: 100px;">
		<tr>
			<td colspan="6">
				<div class="one-header">
					<img src='images/logo.jpg'/>	
					<div>
						<p>भारत सरकार । वित्त मंत्रालय । राजस्व विभाग । </p>
						<p>Government of India | Ministry of Finance | Department of Revenue</p>
						<p><?php echo $master->OFFICE_NAME_HINDI;?></p>
						<p><?php echo $master->OFFICE_NAME;?></p>
						<p><?php echo $master->OFFICE_ADDRESS_HINDI;?></p>
						<p><?php echo $master->OFFICE_ADDRESS;?></p>
						<p><br/></p>
						<p><b><?php echo "(".$employee->PENSION_TYPE.")"?></b></p>
					</div>
				</div>
			</td>
		</tr>
		<tr class="info">
			<td colspan="3"><b>PAY SLIP FOR THE MONTH OF </b><span><?php echo $monthName[$salary->MONTH]?>-<?php echo $salary->YEAR?></span></td>
			<td colspan="2"><b>GROUP </b><span><?php echo Groups::model()->findByPK($employee->GROUP_ID_FK)->GROUP_NAME;?></span></td>
			<td><b>FOLIO NO</b><span><?php echo $employee->FOLIO_NO;?></span></td>
		</tr>
		<tr>
			<td colspan="3"><b>NAME </b><span><?php echo $employee->NAME."<br>(".$employee->NAME_HINDI.")";?></span></td>
			<td colspan="2"><b>DESIGNATION </b><span style="text-align: right;"><?php echo Designations::model()->findByPK($employee->DESIGNATION_ID_FK)->ABBREVIATIONS."<br/>(".Designations::model()->findByPK($employee->DESIGNATION_ID_FK)->DESIGNATION_HINDI.")";?></span></td>
			<td><b>PAN </b><span><?php echo $employee->PAN;?></span></td>
		</tr>
		
		<tr>
			<td><b>PAY </b><span><?php echo $salary->BASIC;?></span></td>
			<td><b>GP </b><span><?php echo $salary->GP;?></span></td>
			<td><b>TOTAL </b><span><?php echo $salary->GP+$salary->BASIC;?></span></td>
			<td><b>SP </b><span><?php echo $salary->SP;?></span></td>
			<td><b>PP </b><span><?php echo $salary->PP;?></span></td>
			<td rowspan="2"><b>GROSS </b><br><?php echo $salary->GROSS;?></span></td>
		</tr>
		<tr>
			<td><b>HRA </b><span><?php echo $salary->HRA;?></span></td>
			<td><b>DA </b><span><?php echo $salary->DA;?></span></td>
			<td><b>TA </b><span><?php echo $salary->TA;?></span></td>
			<td><b>CCA </b><span><?php echo $salary->CCA;?></span></td>
			<td><b>WA </b><span><?php echo $salary->WA;?></span></td>
		</tr>
		<tr>
			<td colspan="5"><span style="height:20px;display:block;"></span></td>
			<td rowspan="2"><b>NET </b><br><?php echo $salary->NET;?></td>
		</tr>
		<tr>
			<td><b>IT </b><span><?php echo $salary->IT;?></span></td>
			<td><b>CGHS </b><span><?php echo $salary->CGHS;?></span></td>
			<td><b>LF </b><span><?php echo $salary->LF;?></span></td>
			<td><b>CGEGIS </b><span><?php echo $salary->CGEGIS;?></span></td>
			<td><b><?php echo $employee->PENSION_TYPE == 'OPS' ? 'GPFS' : 'CPF TIER I'?></b><span><?php echo $salary->CPF_TIER_I;?></span></td>
		</tr>
		<tr>
			<td><b><?php echo $employee->PENSION_TYPE == 'OPS' ? 'GPFR' : 'CPF TIER II'?> </b><span><?php echo $salary->CPF_TIER_II;?></span></td>
			<td><b>HBA </b><span><?php echo $salary->HBA_EMI;?></span></td>
			<td><b>MCA </b><span><?php echo $salary->MCA_EMI;?></span></td>
			<td><b>FAN </b><span><?php echo $salary->FAN_EMI;?></span></td>
			<td><b>CYCLE </b><span><?php echo $salary->CYCLE_EMI;?></span></td>
			<td rowspan="2"><b>OTHER DEDUCTION </b><br/><?php echo $salary->OTHER_DED;?></td>
		</tr>
		<tr>
			<td><b>PLI </b><span><?php echo $salary->PLI;?></span></td>
			<td><b>MISC </b><span><?php echo $salary->MISC;?></span></td>
			<td><b>FLOOD </b><span><?php echo $salary->FLOOD_EMI;?></span></td>
			<td><b>FEST </b><span><?php echo $salary->FEST_EMI;?></span></td>
			<td><b>PAY ADV </b><span><?php echo 0;?></span></td>
		</tr>
		<tr>
			<td><b>CREDIT CO. </b><span><?php echo $salary->CCS;?></span></td>
			<td><b>LIC </b><span><?php echo $salary->LIC;?></span></td>
			<td><b>RD </b><span><?php echo 0;?></span></td>
			<td><b>CONS.SO.</b><span><?php echo 0;?></span></td>
			<td><b>COURT </b><span><?php echo 0;?></span></td>
			<td rowspan="2"><b>AMT. CR. TO BANK</b><br><?php echo $salary->AMOUNT_BANK;?></td>
		</tr>
		<tr>
			<td><b>WATER </b><span><?php echo 0;?></span></td>
			<td><b>MAINT. </b><span><?php echo 0;?></span></td>
			<td><b>PT</b><span><?php echo $salary->PT;?></span></td>
			<td><b>ASSOC.</b><span><?php echo $salary->ASSOSC_SUB;?></span></td>
			<td><b>STRIKE</b><span><?php echo 0;?></span></td>
		</tr>
		<tr>
			<td colspan="6"><b>REMARK</b><span><?php if($salary->REMARKS) echo $salary->REMARKS;?></span></td>
		</tr>
		<tr>
			<td colspan="6">
				<div style="font-weight: bold; width:400px; float: right;text-align:center; margin-top:40px;margin-right:-10px;">
					<p><?php echo Employee::model()->findByPK($master['DEPT_ADMIN_EMPLOYEE'])->NAME;?></p>
					<p><?php echo Designations::model()->findByPK(Employee::model()->findByPK($master['DEPT_ADMIN_EMPLOYEE'])->DESIGNATION_ID_FK)->DESIGNATION;?></p>
					<p><?php echo $master['DEPT_NAME']?></p>
				</div>
			</td>
		</tr>
	</table>
<?php }
	} ?>
<style>
	b{font-weight: bold;margin-right: 5px;}
	td{padding-left:5px !important;border-collapse: collapse;}
	span{float: right;margin-right: 5px;}
</style>
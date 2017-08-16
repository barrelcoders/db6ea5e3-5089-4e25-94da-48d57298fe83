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
		margin-bottom: 40px;
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
		height: 90px;
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
<?php $master = Master::model()->findByPK(1); ?>
<?php $employees = Employee::model()->findAll();?>
<?php foreach($employees as $employee){?>
<?php $salary = SalaryDetails::model()->findByAttributes(array( 'EMPLOYEE_ID_FK'=>$employee->ID, 'BILL_ID_FK'=>$this->ID )); 
	if(isset($salary)){
?>
	<div>
		<table>
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
			<tr style="background:#e2e2e2;">
				<td colspan="3"><b>PAY SLIP FOR THE MONTH OF </b><span><?php echo $monthName[$this->Month]?>-<?php echo $this->Year?></span></td>
				<td colspan="3"><b>BILL NO </b><span><?php echo Bill::model()->findByPK($salary->BILL_ID_FK)->BILL_NO;?></span></td>
			</tr>
			<tr style="background:#e2e2e2;">
				<td colspan="3"><b>NAME </b><span><?php echo $employee->NAME."<br>(".$employee->NAME_HINDI.")";?></span></td>
				<td colspan="2"><b>DESIGNATION </b><span style="text-align: right;"><?php echo Designations::model()->findByPK($employee->DESIGNATION_ID_FK)->ABBREVIATIONS."<br/>(".Designations::model()->findByPK($employee->DESIGNATION_ID_FK)->DESIGNATION_HINDI.")";?></span></td>
				<td><b>GROUP </b><span><?php echo Groups::model()->findByPK($employee->GROUP_ID_FK)->GROUP_NAME;?></span></td>
			</tr>
			<tr style="background:#e2e2e2;">
				<td colspan="3"><b>ACCOUT NO </b><span><?php echo $employee->ACCOUNT_NO;?></span></td>
				<td colspan="2"><b>IFSC </b><span><?php echo $employee->IFSC;?></span></td>
				<td colspan="1"><b>PAN </b><span><?php echo $employee->PAN;?></span></td>
			</tr>
			<tr>
				<td><b>BASIC </b><span><?php echo $salary->BASIC;?></span></td>
				<td><b>SP </b><span><?php echo $salary->SP;?></span></td>
				<td><b>PP </b><span><?php echo $salary->PP;?></span></td>
				<td><b>HRA </b><span><?php echo $salary->HRA;?></span></td>
				<td><b>DA </b><span><?php echo $salary->DA;?></span></td>
				<td rowspan="2"><b>GROSS </b><br><?php echo $salary->GROSS;?></span></td>
			</tr>
			<tr>
				<td><b>TA </b><span><?php echo $salary->TA;?></span></td>
				<td><b>CCA </b><span><?php echo $salary->CCA;?></span></td>
				<td><b>WA </b><span><?php echo $salary->WA;?></span></td>
				<td colspan="2"></td>
			</tr>
			<tr>
				<td><b>IT </b><span><?php echo $salary->IT;?></span></td><!--DED-->
				<td><b>CGHS </b><span><?php echo $salary->CGHS;?></span></td><!--DED-->
				<td><b>LF </b><span><?php echo $salary->LF;?></span></td><!--DED-->
				<td><b>CGEGIS </b><span><?php echo $salary->CGEGIS;?></span></td><!--DED-->
				<td><b><?php echo $employee->PENSION_TYPE == 'OPS' ? 'GPFS' : 'CPF TIER I'?></b><span><?php echo $salary->CPF_TIER_I;?></span></td><!--DED-->
				<td rowspan="4"><b>NET </b><br><?php echo $salary->NET;?></td>
			</tr>
			<tr>
				<td><b><?php echo $employee->PENSION_TYPE == 'OPS' ? 'GPFR' : 'CPF TIER II'?> </b><span><?php echo $salary->CPF_TIER_II;?></span></td><!--DED-->
				<td><b>HBA </b><span><?php echo $salary->HBA_EMI;?></span></td><!--DED-->
				<td><b>MCA </b><span><?php echo $salary->MCA_EMI;?></span></td><!--DED-->
				<td><b>FAN </b><span><?php echo $salary->FAN_EMI;?></span></td><!--DED-->
				<td><b>CYCLE </b><span><?php echo $salary->CYCLE_EMI;?></span></td><!--DED-->
			</tr>
			<tr>
				<td><b>PLI </b><span><?php echo $salary->PLI;?></span></td><!--DED-->
				<td><b>MISC </b><span><?php echo $salary->MISC;?></span></td><!--DED-->
				<td><b>FLOOD </b><span><?php echo $salary->FLOOD_EMI;?></span></td><!--DED-->
				<td><b>FEST </b><span><?php echo $salary->FEST_EMI;?></span></td><!--DED-->
				<td><b>PAY ADV </b><span><?php echo 0;?></span></td><!--DED-->
			</tr>
			<tr>
				<td><b>COURT </b><span><?php echo $salary->COURT_ATTACHMENT;?></span></td><!--DED-->
				<td colspan="4"><b>TOTAL SALARY DEDUCTION </b><span><?php echo $salary->DED;?></span></td>
			</tr>
			<tr>
				<td colspan="2"><b>CREDIT CO. </b><span><?php echo $salary->CCS;?></span></td><!-- OTHER DED-->
				<td><b>LIC </b><span><?php echo $salary->LIC;?></span></td><!-- OTHER DED-->
				<td><b>MAINT. </b><span><?php echo $salary->MAINT_MADIWALA+$salary->MAINT_JAYAMAHAL;?></span></td><!-- OTHER DED-->
				<td><b>PT</b><span><?php echo $salary->PT;?></span></td><!-- OTHER DED-->
				<td rowspan="3"><b>AMT. CR. TO BANK</b><br><?php echo $salary->AMOUNT_BANK;?></td>
			</tr>
			<tr>
				<td colspan="2"><b>ASSOC.</b><span><?php echo $salary->ASSOSC_SUB;?></span></td><!-- OTHER DED-->
				<td colspan="3"><b>TOTAL SUBSIDIARY DEDUCTION </b><span><?php echo $salary->OTHER_DED + $salary->PT;?></span></td>
			</tr>
			<tr>
				<td colspan="5"><b>REMARK</b><span><?php if($salary->REMARKS) echo $salary->REMARKS;?></span></td>
			</tr>
			
			<tr>
				<td colspan="6">
					<div style="font-weight: bold; width:400px; float: right;text-align:center; margin-top:100px;margin-right:-10px;">
					<?php
						if(Employee::model()->findByPK($salary->EMPLOYEE_ID_FK)->DESIGNATION_ID_FK > 14){
					?>
						<p>(<?php echo Employee::model()->findByPK($master['DEPT_ADMIN_EMPLOYEE'])->NAME;?>)</p>
						<p><?php echo Designations::model()->findByPK(Employee::model()->findByPK($master['DEPT_ADMIN_EMPLOYEE'])->DESIGNATION_ID_FK)->DESIGNATION;?></p>
						<p><?php echo $master['DEPT_NAME']?></p>
					<?php
						}
					?>
					</div>
				</td>
			</tr>
		</table>
	</div>
	<br>
<?php 
	}
} ?>
<style>
	b{font-weight: bold;margin-right: 5px;}
	td{padding-left:5px !important;border-collapse: collapse;}
	span{float: right;margin-right: 5px;}
</style>
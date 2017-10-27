<style>
	@media print {
	  table { /* Or specify a table class */
		max-height: 100%;
		overflow: hidden;
		page-break-after: always;
	  }
	}
</style>
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
							<p><?php echo $master->OFFICE_NAME_HINDI;?><br></p>
							<p><?php echo $master->OFFICE_NAME;?><br></p>
							<p><?php echo $master->OFFICE_ADDRESS_HINDI;?><br></p>
							<p><?php echo $master->OFFICE_ADDRESS;?><br><br></p>
							<p style="text-align: right;" ><br/><?php echo ($employee->PENSION_TYPE == "OPS") ? "<b>पुरानी पेंशन योजना<br><br/>OLD PENSION SYSTEM</b>": "<b>नई पेंशन योजना<br><br/>NEW PENSION SYSTEM</b>"; ?></p>
						</div>
					</div>
				</td>
			</tr>
			<tr style="background:#e2e2e2;">
				<td colspan="4"><b>वेतन पर्ची का माह<br>PAY SLIP FOR THE MONTH OF</b><span><?php echo $monthName[$this->Month]?>-<?php echo $this->Year?></span></td>
				<td colspan="2"><b>बिल संख्या<br>BILL NO</b><span><?php echo Bill::model()->findByPK($salary->BILL_ID_FK)->BILL_NO;?></span></td>
			</tr>
			<tr style="background:#e2e2e2;">
				<td colspan="3"><b>नाम<br>NAME</b><span><?php echo $employee->NAME."<br>(".$employee->NAME_HINDI.")";?></span></td>
				<td colspan="2"><b>पदनाम<br>DESIGNATION</b><span style="text-align: right;"><?php echo Designations::model()->findByPK($employee->DESIGNATION_ID_FK)->ABBREVIATIONS."<br/>(".Designations::model()->findByPK($employee->DESIGNATION_ID_FK)->DESIGNATION_HINDI.")";?></span></td>
				<td><b>समूह<br>GROUP</b><span><?php echo Groups::model()->findByPK($employee->GROUP_ID_FK)->GROUP_NAME;?></span></td>
			</tr>
			<tr style="background:#e2e2e2;">
				<td colspan="3"><b>तैनाती<br>POSTING</b><span><?php echo ($employee->POSTING_ID_FK != 0 ) ? Posting::model()->findByPK($employee->POSTING_ID_FK)->PLACE : '';?></span></td>
				<td colspan="3"><b>पृष्ठ संख्या<br>FOLIO NO</b><span style="text-align: right;"><?php echo $employee->FOLIO_NO;?></span></td>
			</tr>
			<tr style="background:#e2e2e2;">
				<td colspan="3"><b>खाता क्रमांक<br>ACCOUNT NO</b><span><?php echo $employee->ACCOUNT_NO;?></span></td>
				<td colspan="2"><b>आई एफ एस सी<br>IFSC</b><span><?php echo $employee->IFSC;?></span></td>
				<td colspan="1"><b>पैन नंबर<br>PAN</b><span><?php echo $employee->PAN;?></span></td>
			</tr>
			<tr>
				<td><b>मूलभूत वेतन<br>BASIC PAY</b><span><?php echo $salary->BASIC;?></span></td>
				<td><b>विशेष वेतन<br>SP</b><span><?php echo $salary->SP;?></span></td>
				<td><b>व्यक्तिगत वेतन<br>PP</b><span><?php echo $salary->PP;?></span></td>
				<td><b>घर किराया भत्ता<br>HRA</b><span><?php echo $salary->HRA;?></span></td>
				<td><b>महंगाई भत्ता<br>DA</b><span><?php echo $salary->DA;?></span></td>
				<td rowspan="2" style="text-align: center;"><b>सकल वेतन<br>GROSS PAY</b><br><?php echo $salary->GROSS;?></span></td>
			</tr>
			<tr>
				<td><b>यात्रा भत्ता<br>TA</b><span><?php echo $salary->TA;?></span></td>
				<td><b>क्षतिपूर्ति शहर भत्ता<br>CCA</b><span><?php echo $salary->CCA;?></span></td>
				<td><b>धुलाई  भत्ता<br>WA</b><span><?php echo $salary->WA;?></span></td>
				<td colspan="2"></td>
			</tr>
			<tr>
				<td><b>आयकर<br>IT</b><span><?php echo $salary->IT;?></span></td><!--DED-->
				<td><b>सी जी एच एस<br>CGHS</b><span><?php echo $salary->CGHS;?></span></td><!--DED-->
				<td><b>लाइसेंस शुल्क<br>LF</b><span><?php echo $salary->LF;?></span></td><!--DED-->
				<td><b>सी जी ई जी आई एस<br>CGEGIS</b><span><?php echo $salary->CGEGIS;?></span></td><!--DED-->
				<td><b><?php echo $employee->PENSION_TYPE == 'OPS' ? 'जी पी एफ एस<br>GPFS' : 'सीपीएफ़ टीयर प्रथम<br>CPF TIER I'?></b><span><?php echo $salary->CPF_TIER_I;?></span></td><!--DED-->
				<td rowspan="4" style="text-align: center;"><b>कुल  वेतन<br>NET PAY</b><br><?php echo $salary->NET;?></td>
			</tr>
			<tr>
				<td><b><?php echo $employee->PENSION_TYPE == 'OPS' ? 'जी पी एफ आर<br>GPFR' : 'सीपीएफ़ टीयर द्वितीय<br>CPF TIER II'?> </b><span><?php echo $salary->CPF_TIER_II;?></span></td><!--DED-->
				<td><b>एच बी ए<br>HBA</b><span><?php echo $salary->HBA_EMI;?></span></td><!--DED-->
				<td><b>एम सी ए<br>MCA</b><span><?php echo $salary->MCA_EMI;?></span></td><!--DED-->
				<td><b>कंप्यूटर  ए<br>COMP ADV</b><span><?php echo $salary->COMP_EMI;?></span></td><!--DED-->
				<td><b>साइकिल अग्रिम<br>CYCLE</b><span><?php echo $salary->CYCLE_EMI;?></span></td><!--DED-->
			</tr>
			<tr>
				<td><b>डाक जीवन बीमा<br>PLI</b><span><?php echo $salary->PLI;?></span></td><!--DED-->
				<td><b>विविध<br>MISC</b><span><?php echo $salary->MISC;?></span></td><!--DED-->
				<td><b>बाढ़ अग्रिम<br>FLOOD</b><span><?php echo $salary->FLOOD_EMI;?></span></td><!--DED-->
				<td><b>त्यौहार अग्रिम<br>FEST</b><span><?php echo $salary->FEST_EMI;?></span></td><!--DED-->
				<td><b>अग्रिम भुगतान<br>PAY ADV</b><span><?php echo 0;?></span></td><!--DED-->
			</tr>
			<tr>
				<td colspan="2"><b>कोर्ट अटैचमेंट<br>COURT ATTACH</b><span><?php echo $salary->COURT_ATTACHMENT;?></span></td><!--DED-->
				<td colspan="3"><b>कुल वेतन कटौती<br>TOTAL SALARY DEDUCTION</b><span><?php echo $salary->DED;?></span></td>
			</tr>
			<tr>
				<td colspan="2"><b>क्रेडिट सहकारी समिति<br>CREDIT CO. So.</b><span><?php echo $salary->CCS;?></span></td><!-- OTHER DED-->
				<td><b>जीवन बीमा<br>LIC</b><span><?php echo $salary->LIC;?></span></td><!-- OTHER DED-->
				<td><b>रखरखाव<br>MAINT.</b><span><?php echo $salary->MAINT_MADIWALA+$salary->MAINT_JAYAMAHAL;?></span></td><!-- OTHER DED-->
				<td><b>वृत्ति कर<br>PT</b><span><?php echo $salary->PT;?></span></td><!-- OTHER DED-->
				<td rowspan="3" style="text-align: center;"><b>बैंक में जमा राशि<br>AMT. CR. TO BANK</b><br><?php echo $salary->AMOUNT_BANK;?></td>
			</tr>
			<tr>
				<td colspan="2"><b>संघ सदस्यता<br>ASSOC. SUB.</b><span><?php echo $salary->ASSOSC_SUB;?></span></td><!-- OTHER DED-->
				<td colspan="3"><b>कुल अतिरिक्त कटौती<br>TOTAL SUBSIDIARY DEDUCTION</b><span><?php echo $salary->OTHER_DED + $salary->PT;?></span></td>
			</tr>
			<tr>
				<td colspan="5"><b>टिप्पणी<br>REMARK</b><br><span><?php if($salary->REMARKS) echo $salary->REMARKS;?></span></td>
			</tr>
			
			<tr>
				<td colspan="6">
					<div style="font-weight: bold; width:500px; float: right;text-align:center; margin-top:140;margin-right:-10px;">
					<?php
						if(Employee::model()->findByPK($salary->EMPLOYEE_ID_FK)->DESIGNATION_ID_FK > 14){
					?>
						<p>(<?php echo Employee::model()->findByPK($master['DEPT_ADMIN_EMPLOYEE'])->NAME_HINDI;?>/<?php echo Employee::model()->findByPK($master['DEPT_ADMIN_EMPLOYEE'])->NAME;?>)</p>
						<p><?php echo Designations::model()->findByPK(Employee::model()->findByPK($master['DEPT_ADMIN_EMPLOYEE'])->DESIGNATION_ID_FK)->DESIGNATION_HINDI;?><?php echo Designations::model()->findByPK(Employee::model()->findByPK($master['DEPT_ADMIN_EMPLOYEE'])->DESIGNATION_ID_FK)->DESIGNATION;?></p>
						<p><?php echo $master['DEPT_NAME_HINDI']?><br><?php echo $master['DEPT_NAME']?></p>
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
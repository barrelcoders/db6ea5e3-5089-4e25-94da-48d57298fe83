<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/oneadmin.css" rel="stylesheet">
<?php $master = Master::model()->findByPK(1);
$monthName = array('1'=>'January', '2'=>'February', '3'=>'March', '4'=>'April', '5'=>'May', '6'=>'June', '7'=>'July', '8'=>'August', '9'=>'September', '10'=>'October', '11'=>'November', '12'=>'December');
	 ?>
<style>
	td{
		padding: 10px;
		min-height:300px;
	}
</style>
<p style="font-weight: bold;text-align: left ;font-size: 15px;">G.A.R.-23 (See rule 91)</p>
<p style="font-weight: bold;text-align: left ;font-size: 12px;">T.R. 27-A (See Rule 281-A)</p>
<p style="font-weight: bold;text-align: center;font-size: 15px;">MEDICAL CHARGES REIMBURSEMENT BILL</p>
<br>
<br>
<p style="font-weight: bold;text-align: center;font-size: 15px;"><b><span style="font-weight: bold;">Bill No: </span><span style="text-decoration:underline;"><?php echo $model->BILL_NO;?></span></b></p>
<br><br>
<p style="font-weight: bold;text-align: left;font-size: 12px;">Ministry/Department/Office of<br><span style="text-decoration: underline;"><?php echo $master->DEPT_NAME; ?></span></p> 
<br><p style="font-weight: bold;text-align: left;font-size: 12px;">for the month year <span style="text-decoration: underline"><?php echo $monthName[$model->MONTH]."-".$model->YEAR;?></span></p>
<br><p style="font-weight: bold;text-align: left;font-size: 12px;">HEAD of Accounts <span style="text-decoration: underline">MH 2038 UED (1.06) MEDICAL EXPENSES</span></p>
<br/>
<br/>
<table class="one-table">
	<tr>
		<th style="width: 20%;">Sl. No.</th>
		<th style="width: 40%;">Section of Establishment and name of the incumbent</th>
		<th style="width: 30%;">Gross Claim</th>
		<th  style="width: 10%;">Recovery of<br> Adv</th>
		<th  style="width: 10%;">Net. Amt. <br> Payable</th>
		<th  style="width: 10%;">Remarks</th>
	</tr>
	<?php 
		$i = 1;	
		$employees = Yii::app()->db->createCommand("SELECT EMPLOYEE_ID FROM tbl_other_bill_employees WHERE BILL_ID=".$model->ID)->queryAll();
		foreach($employees as $employee){
	?>
		<tr>
		<td style="vertical-align: top;"><?php echo $i; ?></td>
		<td style="vertical-align: top;">
			<p style="font-weight: bold;text-align: left ;font-size: 12px;text-decoration: underline;">Cheqe may be issued in f/o</p><br><br>
			<?php echo Employee::model()->findByPK($employee['EMPLOYEE_ID'])->NAME."(".Employee::model()->findByPK($employee['EMPLOYEE_ID'])->NAME_HINDI.")"; ?>
			<br><br>
			<table class="one-table">
				<tr>
					<td>A/C No.:- </td>
					<td><?php echo Employee::model()->findByPK($employee['EMPLOYEE_ID'])->ACCOUNT_NO;?></td>
				</tr>
				<tr>
					<td>MICR CODE:- </td>
					<td><?php echo Employee::model()->findByPK($employee['EMPLOYEE_ID'])->MICR;?></td>
				</tr>
				<tr>
					<td>IFSC CODE:- </td>
					<td><?php echo Employee::model()->findByPK($employee['EMPLOYEE_ID'])->IFSC;?></td>
				</tr>
			</table>
		</td>
		<td style="vertical-align: top;"><?php echo $model->BILL_AMOUNT; ?></td>
		<td style="vertical-align: top;"></td>
		<td style="vertical-align: top;"><?php echo $model->BILL_AMOUNT; ?></td>
		<td style="vertical-align: top;"></td>
		
	</tr>
	<?php } ?>
	<tr>
		<td style="vertical-align: top;"></td>
		<td style="vertical-align: top;">TOTAL</td>
		<td style="vertical-align: top;"><?php echo $model->BILL_AMOUNT; ?></td>
		<td style="vertical-align: top;"></td>
		<td style="vertical-align: top;"><?php echo $model->BILL_AMOUNT; ?></td>
		<td style="vertical-align: top;"></td>
	</tr>
</table>
<br>
<p>Net Amount required for payment (In words) <span style="text-decoration: underline"><?php echo $this->amountToWord($model->BILL_AMOUNT)?></span> </p><br><br>
<p>1) Certified that I have satisfied myself that the amounts included in bills drawn
1months/2months/3months previous to this date, with the exception of those detailed
below (of which the total amount has been refunded by deduction from this bill) their
receipts taken in the office copy of the bill or in separate acquittance roll. </p>
<br/>
<p><span style="text-align:left; width:200px;">2)Details of Medical Charges refunded</span><span style="display:inline-block;text-align:right; width:200px;">Period</span><span style="display:inline-block;text-align:right;width:200px;">Amount</span></p>
<br/>
<p><span style="text-align:left; width:200px;">Section of establishment and name of incumbent</span><span style="display:inline-block;text-align:right; width:170px;"></span><span style="display:inline-block;text-align:right;width:150px;">Rs. <?php echo $model->BILL_AMOUNT;?>/-</span></p>
<br/>
<p style="text-align:left;">3)Certified that Essentially Certificates, receipts, etc are appended</p><br>
<br/>

<p style="text-align:right;">Received Payment</p><br><br><br>
<p style="text-align:right;font-weight:bold;">Signature:.................................</p><br>
<p style="text-align:right;font-weight:bold;">D.D.O.:CHIEF ACCOUNTS OFFICER</p><br>

<script type="text/javascript">window.onload = function() { window.print(); }</script><style>

                                                                                                                   
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
<p style="font-weight: bold;text-align: left;font-size: 12px;">T.R. 25</p>
<p style="font-weight: bold;    position: absolute;top:0px;right: 10px;font-size: 15px;">CENTRAL</p>
<p style="font-weight: bold;text-align: left;font-size: 12px;">G.A.R.-14(See rule 66(1) and 90(1)(i))</p>
<p style="font-weight: bold;text-align: center;font-size: 15px;">CONSOLIDATED TRAVELLING ALLOWANCE BILL</p>
<br>
<p>Ministry/Department/Office of <span style="text-decoration: underline">  <?php echo $master->DEPT_NAME; ?></span> for the month year <span style="text-decoration: underline"><?php echo $monthName[$model->MONTH]."-".$model->YEAR;?></span></p>
<p>(Separate form should be used in case of establishments in which TA is chargeable to different heads of account)</p>
<br>
<p><b>1. Bill No. & Date: <span style="text-decoration:underline;"><?php echo $model->BILL_NO;?> ( <?php echo $model->PFMS_BILL_NO;?> )</span></b></p><br>
<p style="text-align: left;"><b>2. Token No. & Date: ....................................</b></p>
<p style="text-align: right;"><b>3. Voucher No. & Date: ....................................</b></p>
<p style="font-weight: bold;font-size: 15px;">HEAD OF ACCOUNT</p>
<br/>
<div style="display: inline-block;float: left;">
  <div>
    <p>Grant No</p>
    <table class="one-table" style="width: 100px;">
       <tbody><tr>
        <td></td>
        <td></td>
        <td></td>
      </tr>
    </tbody></table>
  </div>
</div>
<div style="display: inline-block;float: left;margin-left: 5%;">
  <div>
    <p>M.H. Serial</p>
    <table class="one-table" style="width: 100px;">
       <tbody><tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
      </tr>
    </tbody></table>
  </div>
</div>
<div style="display: inline-block;float: left;margin-left: 5%;">
  <div>
    <p>SCCD</p>
    <table class="one-table" style="width: 100px;">
       <tbody><tr>
        <td></td>
        <td></td>
        <td></td>
      </tr>
    </tbody></table>
  </div>
</div>
<div style="display: inline-block;float: left;margin-left: 5%;">
  <div>
    <p>SIGN +/-</p>
    <table class="one-table" style="width: 50px;">
       <tbody><tr>
        <td></td>
      </tr>
    </tbody></table>
  </div>
</div>
<div style="display: inline-block;float: left;margin-left: 5%;">
  <div>
    <p><span style="margin-left:20px;">AMOUNT</span> <br>Rs. <span style="margin-left:60px;">P.</span></p>
    <table class="one-table" style="width: 100px;">
       <tbody><tr>
        <td><?php echo $model->BILL_AMOUNT; ?></td>
        <td>0</td>
        <td>0</td>
      </tr>
    </tbody></table>
  </div>
</div>
<div style="clear: both;"></div>
<br>
<table class="one-table">
	<tr>
		<th style="width: 10%;">Sl. No.</th>
		<th style="width: 10%;">Sub-bill No.</th>
		<th style="width: 30%;">Name & Designation of Govt. Servant</th>
		<th style="width: 15%;">Gross Claim</th>
		<th  style="width: 10%;">Advance adjustable</th>
		<th  style="width: 15%;">Net. Amt. <br> Payable</th>
		<th  style="width: 10%;">Remarks</th>
	</tr>
	<tr>
		<td style="vertical-align: top;text-align: center;">1</td>
		<td style="vertical-align: top;text-align: center;">2</td>
		<td style="vertical-align: top;text-align: center;">3</td>
		<td style="vertical-align: top;text-align: center;">4</td>
		<td style="vertical-align: top;text-align: center;">5</td>
		<td style="vertical-align: top;text-align: center;">6</td>
		<td style="vertical-align: top;text-align: center;">7</td>
	</tr>
	<?php 
		$i = 1;	
		$employees = Yii::app()->db->createCommand("SELECT EMPLOYEE_ID FROM tbl_bill_employees WHERE BILL_ID=".$model->ID)->queryAll();
		foreach($employees as $employee){
	?>
		<tr>
		<td style="vertical-align: top;"><?php echo $i; ?></td>
		<td style="vertical-align: top;"></td>
		<td style="vertical-align: top;">
		<?php echo $model->BILL_TITLE; ?>
		</td>
		<td style="vertical-align: top;">Rs. <?php echo $model->CLAIM_GROSS_AMOUNT; ?></td>
		<td style="vertical-align: top;">Rs. <?php echo $model->CLAIM_ADVANCE_AMOUNT; ?></td>
		<td style="vertical-align: top;">Rs. <?php echo $model->BILL_AMOUNT; ?></td>
		<td style="vertical-align: top;"></td>
		
	</tr>
	<?php } ?>
	<tr>
		<td style="vertical-align: top;"></td>
		<td style="vertical-align: top;"></td>
		<td style="vertical-align: top;"></td>
		<td style="vertical-align: top;"></td>
		<td style="vertical-align: top;"></td>
		<td style="vertical-align: top;"></td>
		<td style="vertical-align: top;"></td>
	</tr>
	<tr>
		<td style="vertical-align: top;"></td>
		<td style="vertical-align: top;"></td>
		<td style="vertical-align: top;"></td>
		<td style="vertical-align: top;"></td>
		<td style="vertical-align: top;"></td>
		<td style="vertical-align: top;"></td>
		<td style="vertical-align: top;"></td>
	</tr>
	<tr>
		<td style="vertical-align: top;"></td>
		<td style="vertical-align: top;"></td>
		<td style="vertical-align: top;">TOTAL [A]</td>
		<td style="vertical-align: top;">Rs. <?php echo $model->CLAIM_GROSS_AMOUNT; ?></td>
		<td style="vertical-align: top;">Rs. <?php echo $model->CLAIM_ADVANCE_AMOUNT; ?></td>
		<td style="vertical-align: top;">Rs. <?php echo $model->BILL_AMOUNT; ?></td>
		<td style="vertical-align: top;"></td>
	</tr>
</table>
<br>
<p>Deduction undisbursed traveling allowance refunded (as per details below):[B]* </p>
<p style="font-weight: bold;"><b>Net sum required for payment by [A—B]:</b></p>
<p style="padding-left:50px;">(i)   E-Payment for self Rs. <span style="text-decoration: underline"><?php echo $this->amountToWord($model->BILL_AMOUNT); ?></span></p>
<p style="padding-left:50px;">(ii)   Cheque in favour of Officers as indicated in Remarks Col. Rs. ........................................................</p>
<p style="padding-left:50px;">(iii)   E-Payment in favour of <span style="text-decoration: underline">Individual</span>........................................................................................Rs.<span style="text-decoration: underline"><?php echo $model->BILL_AMOUNT; ?></span></p>
<br>
<p style="padding-left:300px;">Appropriation for 2017-18 <span style="margin-left:165px;">Rs</span><span style="text-decoration: underline"><?php echo Budget::model()->findByPK(3)->AMOUNT?></span></p>
<p style="padding-left:300px;">Expenditure including this bill: <span style="margin-left:136px;">Rs</span><span style="text-decoration: underline"><?php //echo $model->EXPENDITURE_INC_BILL;?></span></p>
<p style="padding-left:300px;">Balance available: <span style="margin-left:203px;">Rs</span><span style="text-decoration: underline"><?php //echo $model->APPROPIATION_BALANCE;?></span></p>
<div style="width: 200px;margin-top: -50px;">
	<p style="font-weight: bold;">E-payment Details</p>
	<p style="font-weight: bold;">Account No: <?php echo Employee::model()->findByPK($employee['EMPLOYEE_ID'])->ACCOUNT_NO;?></p>
	<p style="font-weight: bold;">MICR: <?php echo Employee::model()->findByPK($employee['EMPLOYEE_ID'])->MICR;?></p>
	<p style="font-weight: bold;">IFSC: <?php echo Employee::model()->findByPK($employee['EMPLOYEE_ID'])->IFSC;?></p>
</div>
<br/>
<p>Passed for payment Rs. (In figures) <span style="text-decoration: underline"> <?php echo $model->BILL_AMOUNT; ?></span> (Rs. in words)<span style="text-decoration: underline"><?php echo $this->amountToWord($model->BILL_AMOUNT)?></span> </p>
<p>Certified that the claims included in the bill have not already been paid and office copies of the sub-bills have been suitably cancelled to avoid double payment.</p>
<br/><p>Received Contents.</p>
<br/><br/><p>Drawing and Disbursing Officer</p>


<p style="text-align: right;">Drawing and Disbursing Officer</p><br>
<p style="font-weight: bold;text-align: center;font-size: 15px;">Details of undisbursed T.A. refunded</p>
<br/>
<table class="one-table" style="width: 100%;">
	<tr>
		<th style="width: 20%;">Bill. No.</th>
		<th style="width: 30%;">Sub-bill No. & date</th>
		<th style="width: 40%;">Name & Designation of Govt. Servant</th>
		<th  style="width: 10%;">Amount</th>
	</tr>
	<tr>
		<th style="width: 20%;"></th>
		<th style="width: 30%;"></th>
		<th style="width: 40%;"></th>
		<th  style="width: 10%;">Rs.</th>
	</tr>
	<tr>
		<th style="width: 20%;"><p>&nbsp;</p></th>
		<th style="width: 30%;"></th>
		<th style="width: 40%;"></th>
		<th  style="width: 10%;"></th>
	</tr>
	<tr>
		<th style="width: 20%;"></th>
		<th style="width: 30%;"></th>
		<th style="width: 40%;">TOTAL [B]</th>
		<th  style="width: 10%;"></th>
	</tr>
</table>
<br>
<div style="display: inline-block;float: left;">
  <div>
    <p>DDO CODE</p>
    <table class="one-table" style="width: 100px;">
       <tbody><tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
      </tr>
    </tbody></table>
  </div>
</div><div style="display: inline-block;float: left;margin-left: 5%;">
  <div>
    <p>BANK CODE</p>
    <table class="one-table" style="width: 100px;">
       <tbody><tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
      </tr>
    </tbody></table>
  </div>
</div>

<p style="text-align: right;">Drawing and Disbursing Officer</p><br>
<script type="text/javascript">window.onload = function() { window.print(); }</script>

                                                                                                                   
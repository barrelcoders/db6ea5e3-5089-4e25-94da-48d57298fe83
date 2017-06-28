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
<p style="font-weight: bold;text-align: center;font-size: 15px;">G.A.R.-23</p>
<p style="font-weight: bold;text-align: center;font-size: 15px;">(See rule 91)</p>
<p style="font-weight: bold;text-align: center;font-size: 15px;">MEDICAL CHARGES REIMBURSEMENT BILL</p>
<br>
<br>
<p><b>Bill No. & Date: <span style="text-decoration:underline;"><?php echo $model->BILL_NO;?></span></b></p>
<p style="text-align: right;"><b>Token No. & Date: ....................................</b></p>
<br><br>
<p>Ministry/Department/Office of<br><span style="text-decoration: underline"><?php echo $master->DEPT_NAME; ?></span> for the month year <span style="text-decoration: underline"><?php echo $monthName[$model->MONTH]."-".$model->YEAR;?></span></p>
<br/>
<br/>
<div style="display: inline-block;float: left;">
  <div>
    <p>Grant No</p>
    <table class="one-table" style="width: 100px;">
       <tbody><tr>
        <td>0</td>
        <td>4</td>
        <td>8</td>
      </tr>
    </tbody></table>
  </div>
</div>
<div style="display: inline-block;float: left;margin-left: 10%;">
  <div>
    <p>DDO Code</p>
    <table class="one-table" style="width: 100px;">
       <tbody><tr>
        <td>1</td>
        <td>4</td>
        <td>8</td>
  		<td>0</td>
        <td>0</td>
        <td>1</td>
      </tr>
    </tbody></table>
  </div>
</div><div style="display: inline-block;float: left;margin-left: 5%;">
  <div>
    <p>Treasury Code</p>
    <table class="one-table" style="width: 100px;">
       <tbody><tr>
        <td></td><td></td><td></td><td></td>
        <td></td>
        <td></td>
      </tr>
    </tbody></table>
  </div>
</div>
<div style="display: inline-block;float: left;margin-left: 5%;">
  <div>
    <p>Bank Code</p>
    <table class="one-table" style="width: 100px;">
       <tbody><tr>
        <td></td>
        <td></td>
        <td></td>
      </tr>
    </tbody></table>
  </div>
</div><br><br><br><br><div style="display: inline-block;float: left;">
  <div>
    <p>Category</p>
    <table class="one-table" style="width: 100px;">
       <tbody><tr>
        <td style="width:100px">1</td>
      </tr>
    </tbody></table>
  </div>
</div><div style="display: inline-block;float: left;margin-left: 5%;">
  <div>
    <p>Head of Accounts</p>
    <table class="one-table" style="width: 300px;">
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
    <p>AMOUNT Rs.</p>
    <table class="one-table" style="width: 100px;">
       <tbody><tr>
        <td><?php echo $model->BILL_AMOUNT; ?></td>
      </tr>
    </tbody></table>
  </div>
</div><br><br><br><br><br><br>

<table class="one-table">
	<tr>
		<th style="width: 20%;">Sl. No.</th>
		<th style="width: 40%;">Section of Establishment and name of the incumbent</th>
		<th style="width: 30%;">Gross Claim</th>
		<th  style="width: 10%;">Recovery of<br> Adv</th>
		<th  style="width: 10%;">Net. Amt. <br> Payable</th>
		<th  style="width: 10%;">Remarks</th>
	</tr>
	<tr>
		<td style="vertical-align: top;">1</td>
		<td style="vertical-align: top;">2</td>
		<td style="vertical-align: top;">3</td>
		<td style="vertical-align: top;">4</td>
		<td style="vertical-align: top;">5</td>
		<td style="vertical-align: top;">6</td>
	</tr>
	<?php 
		$i = 1;	
		$employees = Yii::app()->db->createCommand("SELECT EMPLOYEE_ID FROM tbl_other_bill_employees WHERE BILL_ID=".$model->ID)->queryAll();
		foreach($employees as $employee){
	?>
		<tr>
		<td style="vertical-align: top;"><?php echo $i; ?></td>
		<td style="vertical-align: top;">
		<?php echo Employee::model()->findByPK($employee['EMPLOYEE_ID'])->NAME."(".Employee::model()->findByPK($employee['EMPLOYEE_ID'])->NAME_HINDI.")"; ?>
		</td>
		<td style="vertical-align: top;"><?php echo $model->BILL_AMOUNT; ?></td>
		<td style="vertical-align: top;"></td>
		<td style="vertical-align: top;"><?php echo $model->BILL_AMOUNT; ?></td>
		<td style="vertical-align: top;"></td>
		
	</tr>
	<?php } ?>
	<tr>
		<td style="vertical-align: top;"></td>
		<td style="vertical-align: top;">E-payment Details</td>
		<td style="vertical-align: top;"></td>
		<td style="vertical-align: top;"></td>
		<td style="vertical-align: top;"></td>
		<td style="vertical-align: top;"></td>
	</tr>
	<tr>
		<td style="vertical-align: top;"></td>
		<td style="vertical-align: top;">Account No: <?php echo Employee::model()->findByPK($employee['EMPLOYEE_ID'])->ACCOUNT_NO;?></td>
		<td style="vertical-align: top;"></td>
		<td style="vertical-align: top;"></td>
		<td style="vertical-align: top;"></td>
		<td style="vertical-align: top;"></td>
	</tr>
	<tr>
		<td style="vertical-align: top;"></td>
		<td style="vertical-align: top;">MICR: <?php echo Employee::model()->findByPK($employee['EMPLOYEE_ID'])->MICR;?></td>
		<td style="vertical-align: top;"></td>
		<td style="vertical-align: top;"></td>
		<td style="vertical-align: top;"></td>
		<td style="vertical-align: top;"></td>
	</tr>
	<tr>
		<td style="vertical-align: top;"></td>
		<td style="vertical-align: top;">IFSC: <?php echo Employee::model()->findByPK($employee['EMPLOYEE_ID'])->IFSC;?></td>
		<td style="vertical-align: top;"></td>
		<td style="vertical-align: top;"></td>
		<td style="vertical-align: top;"></td>
		<td style="vertical-align: top;"></td>
	</tr>
	<tr>
		<td style="vertical-align: top;"></td>
		<td style="vertical-align: top;">TOTAL</td>
		<td style="vertical-align: top;"><?php echo $model->BILL_AMOUNT; ?></td>
		<td style="vertical-align: top;"></td>
		<td style="vertical-align: top;"><?php echo $model->BILL_AMOUNT; ?></td>
		<td style="vertical-align: top;"></td>
	</tr>
</table>
<br><br><br>
<p>Net Amount required for payment (In words) <span style="text-decoration: underline"><?php echo $this->amountToWord($model->BILL_AMOUNT)?></span> </p><br><br>
<p>Passed for Rs <span style="text-decoration: underline"><?php $model->BILL_AMOUNT?> <span style="text-decoration: underline">/-<?php echo $this->amountToWord($model->BILL_AMOUNT)?></span> </p>
<br/><br/>
<p style="text-align: right;">Signature of DDO</p><br>
<p style="font-weight: bold;text-align: center;font-size: 15px;">FOR USE IN TREASURY OFFICE / PAY AND ACCOUONTS OFFICE(Pre Check)</p>
<br/>

<p>Passed for payment of Rs............................(Rupees........................................................................................)</p>
<p>Payment throught Cheque No ............................</p><br>

<p style="text-decoration: underline">Appropriation</p><br>
<p>Expenditure including this bill: <span style="text-decoration: underline"><?php echo $model->EXPENDITURE_INC_BILL;?></span></p><br>
<p>Amount of work bill annexed: <span style="text-decoration: underline"><?php echo $model->BILL_AMOUNT;?></span></p>	<br>
<p>Balance available: <span style="text-decoration: underline"><?php echo $model->APPROPIATION_BALANCE;?></span></p><br>
<script type="text/javascript">window.onload = function() { window.print(); }</script><style>

                                                                                                                   
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
<p style="font-weight: bold;text-align: left;font-size: 12px;">G.A.R.-37 [See rule 165(1)]</p>
<p style="font-weight: bold;text-align: left;font-size: 12px;">T.R. 27 B [See rule 669]</p>
<p style="font-weight: bold;text-align: center;font-size: 15px;">BILL FOR SHORT TERM ADVANCES</p>
<br>
<p>Ministry/Department/Office of <span style="text-decoration: underline">  <?php echo $master->DEPT_NAME; ?></span> for the month of<span style="text-decoration: underline"><?php echo $monthName[$model->MONTH]?> 20 <span style="text-decoration: underline"><?php echo $model->YEAR;?></span></p>
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
</div>
<div style="display: inline-block;float: left;margin-left: 5%;">
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
      </tr>
    </tbody></table>
  </div>
</div>
<div style="display: inline-block;float: right;">
	<p><b>Bill No. & Date: <span style="text-decoration:underline;"><?php echo $model->BILL_NO;?> <br> (<?php echo $model->PFMS_BILL_NO;?> )</span></b></p>
	<p style="text-align: left;"><b>Type of Advance: ....................................</b></p>
	<p style="text-align: left;"><b>Minor Head: ....................................</b></p>
	<p style="text-align: left;"><b>Sub Head: ....................................</b></p>
</div>
<p style="font-weight: bold;font-size: 15px;">HEAD OF ACCOUNT</p>
<br/>
<div style="display: inline-block;float: left;">
  <div>
    <p>Grant No</p>
    <table class="one-table" style="width: 100px;">
       <tbody><tr>
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
<div style="display: inline-block;float: left;">
  <div>
    <table class="one-table" style="width: 100px;">
       <tbody><tr>
        <td></td>
        <td></td>
      </tr>
    </tbody></table>
  </div>
</div>
<div style="display: inline-block;float: left;margin-left: 1%;">Amount is adjustable by other Accounts Officer:</div>
<div style="clear: both;"></div>
<br>
<div style="display: inline-block;float: left;">
  <div>
    <p>P.A.O. CODE</p>
    <table class="one-table" style="width: 100px;">
       <tbody><tr>
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
    <p>&nbsp;</p>
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
    <p>&nbsp;</p>
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
    <p>&nbsp;</p>
    <table class="one-table" style="width: 50px;">
       <tbody><tr>
        <td></td>
      </tr>
    </tbody></table>
  </div>
</div>
<div style="display: inline-block;float: left;margin-left: 5%;">
  <div>
    <p>&nbsp;</p>
    <table class="one-table" style="width: 100px;">
       <tbody><tr>
        <td></td>
        <td></td>
        <td></td>
      </tr>
    </tbody></table>
  </div>
</div>
<div style="clear: both;"></div>
<br>


<table class="one-table">
	<tr>
		<th style="width: 10%;">Sl. No.</th>
		<th style="width: 30%;">Section of Establishment and name of incumbent with PBR folio number</th>
		<th style="width: 20%;">Whether permanent. Quasi-permanent or Temporary</th>
		<th style="width: 10%;">Pay</th>
		<th  style="width: 15%;">Whether Surety taken</th>
		<th  style="width: 15%;">Amount of Advance</th>
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
		<td style="vertical-align: top;"><?php echo $model->BILL_TITLE; ?></td>
		<td style="vertical-align: top;"></td>
		<td style="vertical-align: top;"></td>
		<td style="vertical-align: top;"></td>
		<td style="vertical-align: top;">Rs. <?php echo $model->BILL_AMOUNT; ?></td>
		<td style="vertical-align: top;"></td>
		
	</tr>
	<?php } ?>
	<tr>
		<td style="vertical-align: top;"></td>
		<td style="vertical-align: top;"></td>
		<td style="vertical-align: top;"></td>
		<td style="vertical-align: top;"></td>
		<td style="vertical-align: top;">TOTAL [A]</td>
		<td style="vertical-align: top;">Rs. <?php echo $model->BILL_AMOUNT; ?></td>
		<td style="vertical-align: top;"></td>
	</tr>
</table>
<br>
<p>Certified that entries have been made <br> in respective P.B.R. folios.</p>
<br><br><br><br>
<p>Countersigned</p>
<br><br><br>
<div style="width: 200px;display: inline-block;float: left;">
	<p style="font-weight: bold;">E-payment Details</p>
	<p style="font-weight: bold;">Account No: <?php echo Employee::model()->findByPK($employee['EMPLOYEE_ID'])->ACCOUNT_NO;?></p>
	<p style="font-weight: bold;">MICR: <?php echo Employee::model()->findByPK($employee['EMPLOYEE_ID'])->MICR;?></p>
	<p style="font-weight: bold;">IFSC: <?php echo Employee::model()->findByPK($employee['EMPLOYEE_ID'])->IFSC;?></p>
</div>
<div style="display: inline-block;float: right;margin-top: -50px;">
	<p style="font-weight: bold;"><b>Total Amount required for payment <br/>Rupees (in words) 
	<br><span style="text-decoration:underline"><?php echo $this->amountToWord($model->BILL_AMOUNT); ?></span><br>Received Payment</b></p>
</div>
<div style="clear: both;"></div>
<br>
<div style="display: inline-block;float: left;">
	<p style="font-weight: bold;"><b>Signature<br/>Designation<br/>Date:</b></p>
</div>
<div style="display: inline-block;float: right;width:320px;">
	<p style="font-weight: bold;text-align:left;"><b>Signature<br/>Designation of Drawing Officer<br/>Date:</b></p>
</div>
<!--
<p style="padding-left:300px;">Appropriation for 2017-18 <span style="margin-left:165px;">Rs</span><span style="text-decoration: underline"><?php echo Budget::model()->findByPK(3)->AMOUNT?></span></p>
<p style="padding-left:300px;">Expenditure including this bill: <span style="margin-left:136px;">Rs</span><span style="text-decoration: underline"><?php //echo $model->EXPENDITURE_INC_BILL;?></span></p>
<p style="padding-left:300px;">Balance available: <span style="margin-left:203px;">Rs</span><span style="text-decoration: underline"><?php //echo $model->APPROPIATION_BALANCE;?></span></p>
-->

<script type="text/javascript">window.onload = function() { window.print(); }</script>

                                                                                                                   
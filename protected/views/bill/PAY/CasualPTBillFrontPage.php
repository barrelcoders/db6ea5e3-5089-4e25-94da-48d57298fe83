<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/oneadmin.css" rel="stylesheet">
<?php
	$monthName = array('1'=>'January', '2'=>'February', '3'=>'March', '4'=>'April', '5'=>'May', '6'=>'June', '7'=>'July', '8'=>'August', '9'=>'September', '10'=>'October', '11'=>'November', '12'=>'December');
	$monthNameHindi = array('1'=>'जनवरी', '2'=>'फ़रवरी', '3'=>'मार्च', '4'=>'अप्रैल', '5'=>'मई', '6'=>'जून', '7'=>'जुलाई', '8'=>'अगस्त', '9'=>'सितंबर', '10'=>'अक्टूबर', '11'=>'नवंबर', '12'=>'दिसंबर'); 
	$master = Master::model()->findByPK(1);
?>
<style>
	td{
		padding: 10px;
		min-height:300px;
	}
</style>
<div style="position: relative;height: 50px;">
	<div style="position: absolute;left: 0;">
		<p>G.A.R. 29</p>	
		<p>T.R. 30</p>
	</div>
	<div style="position: absolute;right: 0;">CENTRAL</div>
</div>
<div style="text-align: center;font-weight: bold;"><h1>FULLY VOUCHED CONTINGENT BILL</h1></div>
<div style="text-align: center;">[See Rules 113, 114, 115(2) & 126(2) of Central Government Account (Receipts & Paymnts) Rules)]</div>
<div style="text-align: center;">Account (Receipts & Payments) Rules</div>
<div style="text-align: center;">[See Rules 306 of Central treasury Rules]</div>
<br><br>
<div style="text-align: center;"><span style="font-weight: bold;">BILL NO: </span><span style="text-decoration: underline"><?php echo $model->BILL_NO;?></span></div>		
<br><br>
<div><span style="font-weight: bold;">Ministry/Department/ Office of:  </span><span style="text-decoration: underline"><?php echo $master->OFFICE_NAME;?></span></div>	<br>
<div ><span style="font-weight: bold;">Detailed Bill of Contigent Charges for the month of </span><span style="text-decoration: underline"><?php echo date('M-Y', strtotime($model->CREATION_DATE));?></span></div>	<br>
<div><span style="font-weight: bold;">Head of Account  </span><span style="text-decoration: underline"><?php echo BillType::model()->findByPK($model->BILL_TYPE)->TYPE;?></span></div><br>
<style>
table.mandate{width: 100%;height:100%;border-collapse: collapse;}
.mandate tr, .mandate td{border: 1px solid #000;border-collapse: collapse;}
.mandate td{text-align: center;}
</style>
<table class="one-table">
	<tr>
		<th style="width: 20%;">Number of <br>Sub - Voucher </th>
		<th style="width: 70%;">Description of charges nd number and date of authority for all charges requiring special sanction</th>
		<th  style="width: 10%;" colspan="2">Amount<br> Rs. &nbsp;&nbsp;&nbsp;P.</th>
	</tr>
	<tr>
		<td style="vertical-align: top; height: 500px;">
		<h3>Wages</h3>
		</td>
		<td style="vertical-align: top;position:relative">Towards deduction of Professional Tax from <?php echo $model->BILL_TITLE;?>.
		The details are enclosed with this bill.
		<br/><br/>
		<?php $PT = Yii::app()->db->createCommand("SELECT SUM(PT) as PT FROM tbl_salary_details WHERE BILL_ID_FK = $model->ID;")->queryRow()['PT'];?>
		<b><?php echo $this->amountToWord($PT);?></b><br><br>
		<table class="mandate">
			<tr>
				<th>NAME</th>
				<th>DESIGNATION</th>
				<th>PT</th>
			</tr>
		<?php 
			$employees = explode(",", OtherBillEmployees::model()->find('BILL_ID='.$model->ID)->EMPLOYEE_ID);
			foreach($employees as $id){
				?>
				<tr>
					<td><?php echo Employee::model()->findByPK($id)->NAME;?></td>
					<td><?php echo Designations::model()->findByPK(Employee::model()->findByPK($id)->DESIGNATION_ID_FK)->DESIGNATION;?></td>
					<td><?php echo Yii::app()->db->createCommand("SELECT PT FROM tbl_salary_details WHERE EMPLOYEE_ID_FK=".$id." AND BILL_ID_FK = $model->ID;")->queryRow()['PT'];?></td>
				</tr>
				<?php
			}
		
		?>
		</table>
		<br><p>Cheque may be issued in favor of : <?php echo Vendors::model()->findByPK(13)->NAME;?></p>
		<span style="position: absolute;right: 10px;top: 310px;"><b>Amount Payable</b></span>
		<span style="position: absolute;right: 10px;bottom: 10px;"><b>Carried Over...</b></span>
		</td>
		<td style="vertical-align: top;position:relative">
			<?php echo $PT;?>
			<span style="display: block;margin-top: 285px;"><?php echo $PT;?>
			
			<span style="border-bottom: 1px solid;width: 180px;position: absolute;transform: rotate(111deg);top: 115px;left: -46px;"></span>
			<span style="border-bottom: 1px solid;width: 80px;position: absolute;top: 300px;left: 0px;"></span>
			<span style="border-bottom: 1px solid;width: 80px;position: absolute;top: 335px;left: 0px;"></span>
		</td>
		<td style="vertical-align: top;position:relative">00<span  style="display: block;margin-top: 285px;">00</span>
		</td>
	</tr>
</table>
<p style="text-align:right"></p>
<script type="text/javascript">window.onload = function() { window.print(); }</script><style>

<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/oneadmin.css" rel="stylesheet">
<script type="text/javascript">window.onload = function() { window.print(); }</script>
<?php $master = Master::model()->findByPK(1); ?>
<?php $salaries = SalaryDetails::model()->findAll('BILL_ID_FK='.$model->ID); 
	foreach($salaries as $salary){
		$employee=Employee::model()->findByPK($salary->EMPLOYEE_ID_FK);
		$basic = PayMatrix::model()->findByPK($employee->PAY_MATRIX_ID_FK)->BASIC;
		$da = round($basic * 0.05, 0);
		
?>
<div class="one-header">
	<img src='images/logo.jpg'/>	
	<div>
		<p>भारत सरकार । वित्त मंत्रालय । राजस्व विभाग । </p>
		<p>Government of India | Ministry of Finance | Department of Revenue</p>
		<p><?php echo $master->OFFICE_NAME_HINDI;?></p>
		<p><?php echo $master->OFFICE_NAME;?></p>
		<p><?php echo $master->OFFICE_ADDRESS_HINDI;?></p>
		<p><?php echo $master->OFFICE_ADDRESS;?></p>
	</div>
</div>
<div style="clear:both; height: 20px;position: relative; font-weight: bold;">
	<span class="left"><b>सी.सं./File No.<?php echo $model->FILE_NO;?></b></span>
	<span style="position: absolute;left: 50%;margin-left: -50px; font-weight: bold;"><b><?php echo $model->CER_NO;?></b></span>
	<span style="position: absolute; right: 0;"><b>दिनांक/Date: <?php echo date('d/m/Y', strtotime($model->CREATION_DATE));?></b></span>
</div>
<br>
<div style="text-align: center;">
	<h4><b>मंजुरी आदेश./SANCTION ORDER</b></h4>
</div>
<br>
<div style="text-align: center;">
	<p>Sub:- Accts. –Sanction of Leave Encashment of EL- reg.</p>
	<p>* * * *</p>
</div>
<br>
<br>
<p style="margin-bottom: 4px;">
	In terms of Rule 38 –A read with Rule 39 (2) (b) of CCS (Leave) Rules, 1972, as amended from time to time, 
	an amount of Rs.<?php echo $model->BILL_AMOUNT;?>/- <?php echo $this->amountToWord($model->BILL_AMOUNT);?> is sanctioned to the following officer(s)
	being Encashment of Earned leave for availing LTC during the Block Year  <?php echo $salary->BLOCK_YEAR;?>  as under:-
</p>
<br>
<br>
<table class="one-table" cellmargin="10" style="display: block; clear: both;">
	<thead>
		<tr>
			<th>Name & Designation of the Officer</th>
			<th><?php echo $employee->NAME.", ".Designations::model()->findByPK($employee->DESIGNATION_ID_FK)->DESIGNATION;?></th>
		</tr>
	</thead>
	<tbody>
	<tr>
		<td>No. of Days for which  Encashment applied </td>
		<td style="text-align: center;"><?php echo $salary->EL_ENCASH_DAYS ? $salary->EL_ENCASH_DAYS : '';?></td>
	</tr>
	<tr>
		<td>No. of days for which Earned leave applied/ sanctioned</td>
		<td style="text-align: center;"><?php echo $salary->EL_ENCASH_LEAVE_APPLIED ? $salary->EL_ENCASH_LEAVE_APPLIED : '';?></td>
	</tr>
	<tr>
		<td>Leave at credit before encashment</td>
		<td style="text-align: center;"><?php echo $salary->EL_ENCASH_LEAVE_BALANCE_BEFORE ? $salary->EL_ENCASH_LEAVE_BALANCE_BEFORE : '';?></td>
	</tr>
	<tr>
		<td>No. of days Enchased before this</td>
		<td style="text-align: center;"><?php echo $salary->PREVIOUS_EL_ENCASH_DAYS ? $salary->PREVIOUS_EL_ENCASH_DAYS : 0;?></td>
	</tr>
	<?php
	?>
	<tr>
		<td>Basic Pay </td>
		<td style="text-align: center;">Rs. <?php echo $basic;?>/-</td>
	</tr>
	<tr>
		<td>DA </td>
		<td style="text-align: center;">Rs. <?php echo $da;?>/-</td>
	</tr>
	<tr>
		<td>Total </td>
		<td style="text-align: center;">Rs. <?php echo $basic + $da;?>/-</td>
	</tr>
	<tr>
		<td>Leave Encashment – amt. </td>
		<td style="text-align: center;">Rs. <?php echo $model->BILL_AMOUNT;?>/-</td>
	</tr>
	<tr>
		<td colspan="2" style="text-align: right;"><?php echo $this->amountToWord($model->BILL_AMOUNT);?></td>
	</tr>
	</tbody>
</table>
<br><br>
<div style="font-weight: bold;clear: both;">
	<div style="float:right;margin-right: 50px;text-align:center;width:250px;margin-bottom:10px;">
		<p>(<?php echo Employee::model()->findByPK($master->DEPT_ADMIN_EMPLOYEE)->NAME;?>)</p>
		<p><?php echo Designations::model()->findByPK(Employee::model()->findByPK($master->DEPT_ADMIN_EMPLOYEE)->DESIGNATION_ID_FK)->DESIGNATION;?> </p>
		<p><?php echo $master->DEPT_NAME;?></p>
	</div>
</div>
<?php } ?>
<style>
th, td {padding-left: 10px;padding-right: 10px;}
</style>
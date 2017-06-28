<style>td, th {text-align: center;}</style>
<link href="/oneadmin/css/oneadmin.css" rel="stylesheet">
<?php 
	$id=0;
	if(isset($_GET)){
		$id=$_GET['id'];
	}
	$master = Master::model()->findByPK(1);
	$employee = Employee::model()->findByPK($id);
	if($employee->IS_TRANSFERRED!=0 && $employee->TRANSFERED_TO !='' && $employee->TRANSFER_ORDER != ''){
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
	<span class="left"><b>सी.सं./C. No.II/39/07/2016 Admn	</b></span>
	<span style="position: absolute; right: 0;"><b>दिनांक/Date: <?php echo date('d/m/Y', strtotime('22-06-2017'));?></b></span>
</div>

<br><br><br><br>
<div>
	<p>To,</p>
	<p>The Chief Account Officer</p>
	<p><?php echo Employee::model()->findByPK($id)->TRANSFERED_TO;?></p>
	<br><br>
	<p>महोदय/ Sir,</p>
</div>
<div style="padding-left:100px;">
	<p>Subject: Forwarding of LPC & Service Book in respect of Shri. <?php echo $employee->NAME; ?>, <?php echo Designations::model()->findByPK(Employee::model()->findByPK($id)->DESIGNATION_ID_FK)->DESIGNATION;?>- Reg.</p>
	<p style="text-align: center;">*****</p>
</div>
<br><br>
<div>Consequent to transfer and posting vide Establishment Order No. <?php echo Employee::model()->findByPK($id)->TRANSFER_ORDER;?> the LPC and service book alongwith personal file and leave account of Shri <?php echo $employee->NAME; ?>, <?php echo Designations::model()->findByPK(Employee::model()->findByPK($id)->DESIGNATION_ID_FK)->DESIGNATION;?>
 is enclosed herewith. Receipt of Service book may please be acknowledged.</div>
<br><br>
<div>
	Encl:  Annexture-2
</div>
<div style="font-weight: bold; width:400px; float: right;text-align:center; margin-top:100px;margin-right:-10px;">
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
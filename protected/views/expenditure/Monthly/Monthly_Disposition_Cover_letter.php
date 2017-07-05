<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/oneadmin.css" rel="stylesheet">
<script type="text/javascript">window.onload = function() { window.print(); }</script>
<?php $master = Master::model()->findByPK(1); ?>
<?php
	$monthName = array('1'=>'January', '2'=>'February', '3'=>'March', '4'=>'April', '5'=>'May', '6'=>'June', '7'=>'July', '8'=>'August', '9'=>'September', '10'=>'October', '11'=>'November', '12'=>'December');
	$monthNameHindi = array('1'=>'जनवरी', '2'=>'फ़रवरी', '3'=>'मार्च', '4'=>'अप्रैल', '5'=>'मई', '6'=>'जून', '7'=>'जुलाई', '8'=>'अगस्त', '9'=>'सितंबर', '10'=>'अक्टूबर', '11'=>'नवंबर', '12'=>'दिसंबर'); 
	$master = Master::model()->findByPK(1); ?>
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
	<span class="left"><b>सी.सं./C. No.II/39/03/2015 Admn	</b></span>
	<span style="position: absolute; right: 0;"><b>दिनांक/Date: <?php echo date('d/m/Y');?></b></span>
</div>
<br><br><br><br>
<div>
	<p>To,</p>
	<p>The Deputy Commissioner (P&V)</p>
	<p>HQRS B-IV,</p>
	<p>Bangalore</p>
	<br><br>
	<p>महोदय/ Sir,</p>
</div>
<div style="padding-left:100px;">
	<p>Subject: Request for sending Monthly Disposition of Officers in various caders - Reg.</p>
	<p style="text-align: center;">*****</p>
</div>
<br><br>
<div>Please refer to your letter C.No. II/27/2/2017 Estt B-IV dated 04.01.2017 on the above subject the particulars of the Officers working in <?php echo $master->DEPT_NAME;?> for the month of <?php echo $monthName[$this->Month];?>-<?php echo $this->Year;?> are enclosed in the Annexure -2.
 </div>
<br><br>
<div>
	Encl:  Annexture-2
</div>
<div style="font-weight: bold; width:400px; float: right;text-align:center; margin-top:100px;margin-right:-10px;">
	<p><?php echo Designations::model()->findByPK(Employee::model()->findByPK($master['DEPT_HEAD_EMPLOYEE'])->DESIGNATION_ID_FK)->DESIGNATION;?></p>
	<p><?php echo $master['DEPT_NAME']?></p>
</div>
<style>
	th, td{text-align: center;}
</style>

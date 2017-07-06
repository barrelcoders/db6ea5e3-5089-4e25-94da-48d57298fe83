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
	<span class="left"><b>सी.सं./C. No.III/02/2/2015 Admn	</b></span>
	<span style="position: absolute; right: 0;"><b>दिनांक/Date: <?php echo date('d/m/Y');?></b></span>
</div>
<br><br><br><br>
<div>
	<p>सेवा में / To,</p>
	<p>निजी प्रबंधक/ The Personal Manager</p>
	<p>बएलआईसी मंडल कार्यालय -द्वितीय,/ LIC Divisional Office II,</p>
	<p>वेतन बचत योजना/ Salary Saving Scheme</p>
	<p>614, रेजीडेंसी रोड,/ 614, Residency Road</p>
	<p>बंगलौर-25/Bangalore-25</p>
	<br><br>
	<p>महोदय/Sir,</p>
</div>
<div style="padding-left:100px;">
	<p>विषय :  <?php echo $monthNameHindi[$model->MONTH];?> -<?php echo $model->YEAR;?> माह के लिए एल.आई.सी. प्रीमियम की वसूली- के बारे में </p>
	<p style="margin-left: 200px;">*****</p>
	<p>Subject: Remittance list of LIC premium for the month of <?php echo $monthName[$model->MONTH];?> -<?php echo $model->YEAR;?> - reg</p>
</div>
<br><br>
<div>The L.I.C. premium for the month of <?php echo $monthName[$model->MONTH];?> -<?php echo $model->YEAR;?> is deducted against the policy no. details of the officers working in 
<?php echo $master->OFFICE_NAME;?> from their salary as per the list enclosed.
<br><br>
A sum of Rs.<?php $LIC = Yii::app()->db->createCommand("SELECT SUM(LIC) as LIC FROM tbl_salary_details WHERE BILL_ID_FK = $model->ID;")->queryRow()['LIC']; echo $LIC;?>/- 
<?php echo $this->amountToWord($LIC);?> has been authorized by PAO C.Excise, Bangalore vide E-Payment 
<!--ID Nos S031701232602 dated 01-04-2017 for Rs.1389/- and S031701232619 dated 01-04-2017 for Rs.7429/-. -->
<br><br>
 Kindly acknowledge the receipt.

</div>

<div style="font-weight: bold; width:400px; float: right;text-align:center; margin-top:100px;margin-right:-10px;">
	<p>भवदीया  /  Yours faithfully,</p>
</div>
<br><br>
<div>
	संल्ग्न / Encl:  यथोपरि / As above
</div>
<div style="font-weight: bold; width:400px; float: right;text-align:center; margin-top:100px;margin-right:-10px;">
	<p><?php echo Employee::model()->findByPK($master['DEPT_ADMIN_EMPLOYEE'])->NAME;?></p>
	<p><?php echo Designations::model()->findByPK(Employee::model()->findByPK($master['DEPT_ADMIN_EMPLOYEE'])->DESIGNATION_ID_FK)->DESIGNATION;?></p>
	<p><?php echo $master['DEPT_NAME']?></p>
</div>
<style>
	th, td{text-align: center;}
</style>

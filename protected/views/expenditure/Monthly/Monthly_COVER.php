<?php require_once "/../../../../include/ExpenditureReportInclude.php";?>
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
	<p> मुख्य लेखा अधिकारी / The Chief Accounts Officer,</p>
	<p>बेंग्लुरु-IV आयुक्तालय / Bangalore IV Commissionerate,</p>
	<p>बेंग्लुरु-560 032 / Bangalore-560 032</p>
	<br><br>
	<p>महोदया / Madam,</p>
</div>
<div style="padding-left:100px;">
	<p>विषय :  <?php echo $monthNameHindi[$this->Month];?> -<?php echo $this->Year;?> के महीने के लिए व्यय विवरण - के विषय में </p>
	<p style="text-align: center;">*****</p>
	<p>Subject: Expenditure Statement for the month of  <?php echo $monthName[$this->Month];?> -<?php echo $this->Year;?> - reg</p>
</div>
<br><br>
<div><?php echo $monthNameHindi[$this->Month];?> -<?php echo $this->Year;?>  के महीने के लिए मासिक व्यय विवरण अनुबंध I, Iए, II, IIए, और III में आगे की आवश्यक कार्रवाई के लिए संलग्नित हैं।</div>
<div>Please find enclosed monthly expenditure statement for the month of <?php echo $monthName[$this->Month];?> -<?php echo $this->Year;?>  in Annexure I, IA, II, IIA and III for favour of further necessary action.</div>
<br><br>

<div style="font-weight: bold; width:400px; float: right;text-align:center; margin-top:100px;margin-right:-10px;">
	<p>भवदीया  /  Yours faithfully,</p>
</div>
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

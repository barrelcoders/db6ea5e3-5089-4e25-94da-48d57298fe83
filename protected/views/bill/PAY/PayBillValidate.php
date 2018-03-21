<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/oneadmin.css" rel="stylesheet">
<form method="post" action="<?php echo Yii::app()->createUrl('bill/PayBillValidate', array('id'=>$model->ID))?>">
<table class="table table-bordered table-hover" style="margin-bottom: 10px;">
	<tr>
		<td colspan="3">
			<a href="<?php echo Yii::app()->createUrl('bill/update', array('id'=>$model->ID))?>"><?php echo $model->BILL_TITLE; ?></a>
		</td>
		<td colspan="2">
			<input type="submit" class="btn btn-inline" value="Auto Validate"/>
		</td>
		<td colspan="3">
			<span style="float: right;"><?php echo $model->BILL_NO; ?></span>
		</td>
	</tr>
</table>
			<?php
	$salaries = Yii::app()->db->createCommand("SELECT b.ID AS ID, b.NAME AS NAME,
(a.BASIC  + a.HRA  + a.DA  + a.TA  + a.SP  + a.PP) AS ACTUAL_GROSS ,
a.GROSS AS BILL_GROSS,
(a.IT  + a.CGHS  + a.LF  + a.CGEGIS  + a.CPF_TIER_I  + a.CPF_TIER_II + a.MISC + a.PLI + a.COURT_ATTACHMENT + a.HBA_EMI + a.MCA_EMI + a.COMP_EMI) AS ACTUAL_DED,
a.DED AS BILL_DED,
(a.LIC + a.CCS + a.ASSOSC_SUB + a.MAINT_JAYAMAHAL + a.MAINT_MADIWALA) AS ACTUAL_OTHER_DED,
a.OTHER_DED AS BILL_OTHER_DED,
(a.GROSS-a.DED) AS ACTUAL_NET,
a.NET AS BILL_NET,
(a.GROSS-a.DED-a.OTHER_DED-a.PT) AS ACTUAL_AMOUNT_BANK,
a.AMOUNT_BANK AS BILL_AMOUNT_BANK
FROM tbl_salary_details a, tbl_employee b
WHERE a.EMPLOYEE_ID_FK = b.ID AND a.BILL_ID_FK=".$model->ID." AND
((a.BASIC  + a.HRA  + a.DA  + a.TA  + a.SP  + a.PP) != a.GROSS OR
(a.IT  + a.CGHS  + a.LF  + a.CGEGIS  + a.CPF_TIER_I  + a.CPF_TIER_II + a.MISC + a.PLI + a.COURT_ATTACHMENT + a.HBA_EMI + a.MCA_EMI + a.COMP_EMI) != a.DED OR
(a.LIC + a.CCS + a.ASSOSC_SUB + a.MAINT_JAYAMAHAL + a.MAINT_MADIWALA) != a.OTHER_DED OR
(a.GROSS-a.DED) != a.NET OR
(a.GROSS-a.DED-a.OTHER_DED-a.PT) != a.AMOUNT_BANK )")->queryAll();
?>


 <table class="table table-bordered table-hover" style="margin-bottom: 10px;">
	<tr>
		<th>NAME</th>
		<th>Gross (In Bill)</th>
		<th>Gross (Actual)</th>
		<th>Deduction (In Bill)</th>
		<th>Deduction (Actual)</th>
		<th>Other Deduction (In Bill)</th>
		<th>Other Deduction (Actual)</th>
		<th>Net (In Bill)</th>
		<th>Net (Actual)</th>
		<th>Amount Bank (In Bill)</th>
		<th>Amount Bank (Actual)</th>
	</tr>
	<?php foreach($salaries as $salary){?>
	<tr>
		<td><input type="hidden" value="<?php echo $salary['ID'];?>" name="Employee[ID][]"/><?php echo $salary['NAME'];?></td>
		<td><?php echo $salary['ACTUAL_GROSS'];?></td>
		<td><?php echo $salary['BILL_GROSS'];?></td>
		<td><?php echo $salary['ACTUAL_DED'];?></td>
		<td><?php echo $salary['BILL_DED'];?></td>
		<td><?php echo $salary['ACTUAL_OTHER_DED'];?></td>
		<td><?php echo $salary['BILL_OTHER_DED'];?></td>
		<td><?php echo $salary['ACTUAL_NET'];?></td>
		<td><?php echo $salary['BILL_NET'];?></td>
		<td><?php echo $salary['ACTUAL_AMOUNT_BANK'];?></td>
		<td><?php echo $salary['BILL_AMOUNT_BANK'];?></td>
	</tr>
	<?php } ?>
	</table>
</form>
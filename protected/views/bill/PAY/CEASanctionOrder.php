<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/oneadmin.css" rel="stylesheet">
<?php $master = Master::model()->findByPK(1); ?>
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
<br><br><br><br>
<div style="text-align: center;">
	<h4><b>मंजुरी आदेश./SANCTION ORDER</b></h4>
</div><br><br>

<div style="text-align: center;">
	<p>Subject: Re-imbursement of Children Education Allowance-Reg,</p>
</div><br>
<br>
<p style="margin-bottom: 4px;">
	As per the provisions contained vide O.M. No. 12011/03/2008 (Allowance) dated 2nd September 2008 of the Depratment of Personal and Training received under letter Government of India, Ministry of Personal, Public Grievance and Pensions, the 
	<?php echo $master->OFFICE_NAME;?> is pleased to sanction Re-imbursement of Children Education Allowance to the following Officer.
</p>
<br>
<table class="one-table" cellmargin="10" style="display: block; clear: both;">
	<thead>
		<tr>
			<th>Sl .No.</th>
			<th>Name & Designation of the Officer (Shri/Smt)</th>
			<th>Name, Age and Class of the Child in respect of whom CEA is sanctioned</th>
			<th>Name of the School</th>
			<th>Amount Sanctioned &<br>Academic Year</th>
		</tr>
	</thead>
	<tbody>
		
		
	<?php
		$i=0;
		$CEABillDetails = CEABillDetails::model()->findAllByAttributes(array('BILL_ID'=>$model->ID));
		foreach($CEABillDetails as $bill){
			$i++;
			?>
			<tr>
				<td><?php echo $i;?></td>	
				<td style="text-align: center;" rowspan="<?php echo BillEmployees::model()->count('BILL_ID='.$model->ID);?>"><?php 
					$empID = BillEmployees::model()->find('BILL_ID='.$model->ID)->EMPLOYEE_ID;
					$empName = Employee::model()->findByPK($empID)->NAME;
					$empDesign = Designations::model()->findByPK(Employee::model()->findByPK($empID)->DESIGNATION_ID_FK)->DESIGNATION;
					echo $empName."<br>".$empDesign;?></td>
				<td style="text-align: center;"><?php echo $bill->NAME.'<br>Standrad: '.$bill->CLASS // DOB: '.date('d-m-Y',strtotime($bill->DOB)).'<br>?></td>
				<td style="text-align: center;"><?php echo $bill->SCHOOL;?></td>
				<td style="text-align: center;"><?php echo 'Rs. '.$bill->AMOUNT."/-<br>".$bill->REMARKS;?></td>
			
			</tr>
			<?php
		}
	?>	
	</tbody>
</table>
<br>
<p style="text-align: center;"><b><?php echo $this->amountToWord($model->BILL_AMOUNT);?></b></p>

<div style="font-weight: bold;clear: both;">
	<div style="float:right;margin-right: 50px;text-align:center;width:250px;margin-top:100px;margin-bottom:10px;">
		<p>(<?php echo Employee::model()->findByPK($master->DEPT_ADMIN_EMPLOYEE)->NAME_HINDI;?>)</p>
		<p><?php echo Designations::model()->findByPK(Employee::model()->findByPK($master->DEPT_ADMIN_EMPLOYEE)->DESIGNATION_ID_FK)->DESIGNATION_HINDI;?> </p>
		<p><?php echo $master->DEPT_NAME_HINDI;?></p>
	</div>
</div><script type="text/javascript">window.onload = function() { window.print(); }</script>
<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/oneadmin.css" rel="stylesheet">
<?php $master = Master::model()->findByPK(1); ?>
<table class="one-table" >
	<tr>
		<th>PAO Code</th>
		<th>DDO Code</th>
		<th>Employee Code</th>
		<th>Employee Type</th>
		<th>Salutation Code</th>
		<th>First Name</th>
		<th>Middle Name</th>
		<th>Last Name</th>
		<th>Gender</th>
		<th>Date of Birth</th>
		<th>Date of Entry in Govt. Service</th>
		<th>Controller Code</th>
		<th>Date of Joining in Controller</th>
		<th>City Class Code</th>
		<th>Date of Joining in Current Office</th>
		<th>Date of Joining in Current Post</th>
		<th>Posting Mode Code</th>
		<th>Pay Commission Code</th>
		<th>Pay Scale Code</th>
		<th>Pay Level</th>
		<th>Basic Pay</th>
		<th>Pay WEF Date</th>
		<th>Next Increment Date</th>
		<th>Pan No</th>
		<th>Pf  Type</th>
		<th>GPF No</th>
		<th>PPAN No</th>
		<th>GPF Subcription</th>
		<th>GIS Applicable Code</th>
		<th>GIS Group Code</th>
		<th>GIS Membership Date</th>
		<th>CGHS Card Holder</th>
		<th>CGHS Card No</th>
		<th>Caste Category Code</th>
		<th>Ex-Serviceman</th>
		<th>Aadhar Card No</th>
		<th>Employee  Code by Employer</th>
		<th>Mobile No</th>
		<th>Email-ID</th>
		<th>Emp Name and Code</th>
	</tr>
	<?php
		foreach($employees as $employee){
	?>
		<tr>
			<td><?php echo $master->PAO_CODE;?></td>
			<td><?php echo $master->DDO_CODE;?></td>
			<td><?php echo $employee->EMPLOYEE_CODE;?></td>
			<td><?php echo ($employee->PENSION_TYPE == 'OPS') ? 'PF' : 'NP';?></td>
			<td><?php echo $employee->SALUTATION_CODE;?></td>
			<td><?php echo $employee->FIRST_NAME;?></td>
			<td><?php echo $employee->MIDDLE_NAME;?></td>
			<td><?php echo $employee->LAST_NAME;?></td>
			<td><?php echo $employee->GENDER;?></td>
			<td><?php echo date('n/j/Y', strtotime($employee->DOB));?></td>
			<td><?php echo date('n/j/Y', strtotime($employee->GOVT_SERVICE_ENTRY_DATE));?></td>
			<td><?php echo $master->CONTROLLER_CODE;?></td>
			<td><?php echo date('n/j/Y', strtotime($employee->CONTROLLER_JOIN_DATE));?></td>
			<td><?php echo $employee->CITY_CLASS_CODE;?></td>
			<td><?php echo date('n/j/Y', strtotime($employee->CURRENT_OFFICE_JOIN_DATE));?></td>
			<td><?php echo date('n/j/Y', strtotime($employee->CURRENT_POST_JOIN_DATE));?></td>
			<td><?php echo $employee->POSTING_MODE_CODE;?></td>
			<td><?php echo $employee->PAY_COMMISSION;?></td>
			<td><?php echo $employee->PAY_COMMISSION.str_pad(intVal(PayMatrix::model()->findByPK($employee->PAY_MATRIX_ID_FK)->LEVEL), 2, '0', STR_PAD_LEFT);?></td>
			<td><?php echo PayMatrix::model()->findByPK($employee->PAY_MATRIX_ID_FK)->LEVEL;?></td>
			<td><?php echo PayMatrix::model()->findByPK($employee->PAY_MATRIX_ID_FK)->BASIC;?></td>
			<td><?php echo date('n/j/Y', strtotime($employee->PAY_WEF_DATE));?></td>
			<td><?php echo date('n/j/Y', strtotime($employee->NEXT_INCREMENT_DATE));?></td>
			<td><?php echo $employee->PAN;?></td>
			<td><?php echo ($employee->PENSION_TYPE == 'OPS') ? 'G' : 'D';?></td>
			<td><?php echo ($employee->PENSION_TYPE == 'OPS') ? $employee->PENSION_ACC_NO : '';?></td>
			<td><?php echo ($employee->PENSION_TYPE == 'OPS') ? '' : $employee->PENSION_ACC_NO;?></td>
			<td><?php echo $employee->GPF_SUBSCRIPTION;?></td>
			<td><?php echo $employee->CGEGIS_APPLICABLE_CODE;?></td>
			<td><?php echo $employee->CGEGIS_GROUP_CODE;?></td>
			<td><?php echo date('n/j/Y', strtotime($employee->CGEGIS_MEMBER_DATE));?></td>
			<td><?php echo $employee->IS_CGHS_CARD_HOLDER;?></td>
			<td><?php echo $employee->CGHS_CARD_NO;?></td>
			<td><?php echo $employee->CATEGORY;?></td>
			<td><?php echo $employee->IS_EX_SERVICE;?></td>
			<td><?php echo $employee->AADHAR_NO;?></td>
			<td><?php echo $employee->EMPLOYEE_CODE_BY_EMPLOYER;?></td>
			<td><?php echo $employee->MOBILE_NO;?></td>
			<td><?php echo $employee->EMAIL_ID;?></td>
			<td><?php echo $employee->EMPLOYEE_NAME_AND_CODE;?></td>
		</tr>
	<?php		
		}
	?>
</table>

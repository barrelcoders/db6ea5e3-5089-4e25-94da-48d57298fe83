<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/oneadmin.css" rel="stylesheet">
<style>
	h1{font-size: 20px;font-weight: bold;}
	th,h1{text-align: center;}
	th{font-weight: bold;}
	.one-table tr, .one-table td, .one-table th {width: auto;}
</style>
<?php $master = Master::model()->findByPK(1); ?>
<h1>Monthly Disposition of Officers in various caders for <?php echo date('M');?>-<?php echo date('Y');?> <br> (Annexure - 2) in R/O <br/><?php echo $master->DEPT_NAME;?><br>(<?php echo $master->DEPT_NAME_HINDI;?>)</h1>
<br><br>
<table border="1" style="margin: 0 auto;" class="one-table">
	<thead>
		<tr>
			
			<th>Name</th>
			<th>Date of Birth</th>
			<th>Category</th>
			<th>Designation</th>
			<th>Present Place of Posting</th>
			<th>Date of Present<br>Place of Posting</th>
		</tr>
	</thead>
	<?php $employees = Employee::model()->findAll(array("condition"=>"IS_TRANSFERRED=0 AND IS_RETIRED=0","order"=>"DESIGNATION_ID_FK DESC")); ?>
	<tbody>
		<?php $i=1;
			foreach($employees as $employee){  ?>
			<tr>
				<td><?php echo $employee->NAME;?></td>
				<td style="text-align: center;"><?php echo date('d-m-Y', strtotime($employee->DOB));?></td>
				<td style="text-align: center;"><?php echo $employee->CATEGORY;?></td>
				<td style="text-align: center;"><?php echo Designations::model()->findByPK($employee->DESIGNATION_ID_FK)->ABBREVIATIONS;?></td>
				<td style="text-align: center;">Yelahanka Service Tax Division</td>
				<td style="text-align: center;"><?php echo date('d-m-Y', strtotime($employee->CURRENT_OFFICE_JOIN_DATE));?></td>
				
			</tr>
		<?php $i++;  } ?>
	</tbody>
</table>
<div style="font-weight: bold; width:400px; float: right;text-align:center; margin-top:50px;margin-right:-10px;">
	<p><?php echo Designations::model()->findByPK(Employee::model()->findByPK($master['DEPT_HEAD_EMPLOYEE'])->DESIGNATION_ID_FK)->DESIGNATION;?></p>
	<p><?php echo $master['DEPT_NAME']?></p>
</div>
<script type="text/javascript">window.onload = function() { window.print(); }</script><style>
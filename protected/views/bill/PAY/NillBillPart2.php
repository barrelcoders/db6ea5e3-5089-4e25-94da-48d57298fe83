<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/oneadmin.css" rel="stylesheet">
<script type="text/javascript">window.onload = function() { window.print(); }</script>
<?php
	$master = Master::model()->findByPK(1);
?>
<h2 style="text-transform: uppercase;text-align:center;">PAY BILL IN RESPECT OF <?php echo ($model->BILL_TYPE == 1)? "OPS":"NPS"; ?> STAFF OF  <?php echo $master->DEPT_NAME?>FOR THE MONTH OF <?php echo date('M-Y', strtotime($model->CREATION_DATE))?></h2>
<h2 style="text-transform: uppercase;text-align: center">BILL NO: <?php echo $model->BILL_NO; ?></h2>
<table class="pay-schedule-table">
	<thead>
		<tr>
			<th class="small-xxx right-br">S.No.</th>
			<th class="small-xx">IT</th>
			<th class="small-xx">CGHS</th>
			<th class="small-xx">LF</th>
			<th class="small-xx">CGEGIS</th>
			<th class="small-xx">Govt. Contrib. TIER I</th>
			<th class="small-xx">HBA</th>
			<th class="small-xx">MCA</th>
			<th class="small-xx">FAN</th>
			<th class="small-xx">FLOOD</th>
			<th class="small-xx">CYCLE</th>
			<th class="small-xx">FEST</th>
			<th class="small-xx">MISC</th>
			<th class="small-xx">PLI</th>
			<th class="small-xx right-br left-br">DEDUCTION</th>
			<th class="small-xx right-br">NET</th>
		</tr>
	</thead>
	<?php 
		$i = 1;	
		$employees = Yii::app()->db->createCommand("SELECT ID FROM tbl_employee ORDER BY DESIGNATION_ID_FK DESC")->queryAll();
		$employeesIds = array();
		foreach($employees as $employee) array_push($employeesIds, $employee['ID']);
		$criteria=new CDbCriteria;
		$criteria->order="FIELD(EMPLOYEE_ID_FK, ".implode( ", ", $employeesIds ).")";
		$criteria->condition = "BILL_ID_FK=$model->ID AND YEAR=$model->YEAR AND $model->MONTH";
		$criteria->addInCondition('EMPLOYEE_ID_FK', $employeesIds);
		$salaries = SalaryDetails::model()->findAll($criteria);
	?>
	<tbody>
		<?php foreach ($salaries as $salary) { ?>
		<tr>
			<td class="small-xxx right-br"><?php echo $i; ?></td>
			<td class="small-xx"></td>
			<td class="small-xx"></td>
			<td class="small-xx"></td>
			<td class="small-xx"></td>
			<td class="small-xx"><?php echo $salary->CPF_TIER_I; ?></td>
			<td class="small-xx"></td>
			<td class="small-xx"></td>
			<td class="small-xx"></td>
			<td class="small-xx"></td>
			<td class="small-xx"></td>
			<td class="small-xx"></td>
			<td class="small-xx"></td>
			<td class="small-xx"></td>
			<td class="small-xx right-br left-br"><?php echo $salary->CPF_TIER_I; ?></td>
			<td class="small-xx right-br">0</td>
		</tr>
		<?php 
			$i++;
		} ?>
	</tbody>
	<tfoot>
		<th class="small-xxx right-br"></th>
		<th class="small-xx"></th>
		<th class="small-xx"></th>
		<th class="small-xx"></th>
		<th class="small-xx"></th>
		<th class="small-xx"><?php echo Yii::app()->db->createCommand("SELECT SUM(CPF_TIER_I) as CPF_TIER_I FROM tbl_salary_details WHERE BILL_ID_FK = $model->ID AND YEAR = $model->YEAR AND MONTH = $model->MONTH;")->queryRow()['CPF_TIER_I'];?></th>
		<th class="small-xx"></th>
		<th class="small-xx"></th>
		<th class="small-xx"></th>
		<th class="small-xx"></th>
		<th class="small-xx"></th>
		<th class="small-xx"></th>
		<th class="small-xx"></th>
		<th class="small-xx"></th>
		<th class="small-xx right-br left-br"><?php echo Yii::app()->db->createCommand("SELECT SUM(CPF_TIER_I) as CPF_TIER_I FROM tbl_salary_details WHERE BILL_ID_FK = $model->ID AND YEAR = $model->YEAR AND MONTH = $model->MONTH;")->queryRow()['CPF_TIER_I'];?></th>
		<th class="small-xx right-br "></th>
	</tfoot>
</table>

<h4 style="text-align:center;margin-top: 50px;">(RUPEES NIL ONLY)</h4>
<div style="text-align:center; font-weight: bold; width:400px; margin:0 auto;">"Certified that monthly Contribution under Central Government Employees Insurance Scheme has been recovered from persons who are covered under the Scheme"</div>
<div style="font-weight: bold; width:400px; float: right;text-align:center; margin-top:100px;margin-right:-10px;">
	<p><?php echo Employee::model()->findByPK($master['DEPT_ADMIN_EMPLOYEE'])->NAME;?></p>
	<p><?php echo Designations::model()->findByPK(Employee::model()->findByPK($master['DEPT_ADMIN_EMPLOYEE'])->DESIGNATION_ID_FK)->DESIGNATION;?></p>
	<p><?php echo $master['DEPT_NAME']?></p>
</div>


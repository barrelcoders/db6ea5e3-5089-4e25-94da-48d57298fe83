<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/oneadmin.css" rel="stylesheet">
<script type="text/javascript">window.onload = function() { window.print(); }</script>
<?php $master = Master::model()->findByPK(1); ?>
<h3 style="text-transform: uppercase;text-align:center;">SCHEDULE SHOWING THE RECOVERY OF FAN IN R/O <?php echo ($model->BILL_TYPE == 1)? "OPS":"NPS"; ?> STAFF OF  <?php echo $master->DEPT_NAME?>FOR THE MONTH OF <?php echo date('M-Y', strtotime($model->CREATION_DATE))?></h3>
<h3 style="text-transform: uppercase;text-align: center">BILL NO: <?php echo $model->BILL_NO; ?></h3>
<table class="pay-schedule-table small">
	<thead>
		<tr>
			<th class="small-xxx right-br">S.No.</th>
			<th class="small right-br">NAME</th>
			<th class="small right-br">DESIGNATION</th>
			<th class="small-xx">FAN</th>
			<th class="small-xx">TOTAL</th>
			<th class="small-xx">INSTALL. NO.</th>
			<th class="small-xx">BALANCE</th>
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
			<td class="small right-br"><b><?php echo Employee::model()->findByPK($salary->EMPLOYEE_ID_FK)->NAME.'<br/>('.Employee::model()->findByPK($salary->EMPLOYEE_ID_FK)->NAME_HINDI.')';?></b></td>
			<td class="small right-br"><b><?php echo Designations::model()->findByPK(Employee::model()->findByPK($salary->EMPLOYEE_ID_FK)->DESIGNATION_ID_FK)->DESIGNATION.'<br/>('.Designations::model()->findByPK(Employee::model()->findByPK($salary->EMPLOYEE_ID_FK)->DESIGNATION_ID_FK)->DESIGNATION_HINDI.')';?></b></td>
			<td class="small-xx"><?php echo !$salary->IS_FAN_RECOVERY ? $salary->FAN_EMI : 0; ?></td>
			<td class="small-xx"><?php echo !$salary->IS_FAN_RECOVERY ? $salary->FAN_TOTAL : 0; ?></td>
			<td class="small-xx"><?php echo !$salary->IS_FAN_RECOVERY ? $salary->FAN_INST : 0; ?></td>
			<td class="small-xx"><?php echo !$salary->IS_FAN_RECOVERY ? $salary->FAN_BAL : 0; ?></td>
		</tr>
		<?php 
			$i++;
		} ?>
	</tbody>
	<tfoot>
		<th class="small-xxx right-br"></th>
		<th class="small right-br"></th>
		<th class="small right-br"></th>
		<th class="small-xx"><?php $FAN_EMI = Yii::app()->db->createCommand("SELECT SUM(FAN_EMI) as FAN_EMI FROM tbl_salary_details WHERE BILL_ID_FK = $model->ID AND IS_FAN_RECOVERY = 0;")->queryRow()['FAN_EMI']; echo $FAN_EMI;?></th>
		<th class="small-xx"><?php $FAN_TOTAL = Yii::app()->db->createCommand("SELECT SUM(FAN_TOTAL) as FAN_TOTAL FROM tbl_salary_details WHERE BILL_ID_FK = $model->ID AND IS_FAN_RECOVERY = 0;")->queryRow()['FAN_TOTAL']; echo $FAN_TOTAL;?></th>
		<th class="small-xx"></th>
		<th class="small-xx"><?php $FAN_BAL = Yii::app()->db->createCommand("SELECT SUM(FAN_BAL) as FAN_BAL FROM tbl_salary_details WHERE BILL_ID_FK = $model->ID AND IS_FAN_RECOVERY = 0;")->queryRow()['FAN_BAL']; echo $FAN_BAL; ?></th>
	</tfoot>
</table>

<p style="text-align: center; margin-top: 50px;"><b><?php echo $this->amountToWord($FAN_EMI);?><b></p>

<div style="font-weight: bold; width:400px; float: right;text-align:center; margin-top:50px;margin-right:-10px;">
	<p><?php echo Employee::model()->findByPK($master['DEPT_ADMIN_EMPLOYEE'])->NAME;?></p>
	<p><?php echo Designations::model()->findByPK(Employee::model()->findByPK($master['DEPT_ADMIN_EMPLOYEE'])->DESIGNATION_ID_FK)->DESIGNATION;?></p>
	<p><?php echo $master['DEPT_NAME']?></p>
</div>
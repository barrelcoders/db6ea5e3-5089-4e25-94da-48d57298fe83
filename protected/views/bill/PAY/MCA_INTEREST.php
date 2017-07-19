<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/oneadmin.css" rel="stylesheet">
<script type="text/javascript">window.onload = function() { window.print(); }</script>
<?php $master = Master::model()->findByPK(1); ?>
<h3 style="text-transform: uppercase;text-align:center;">SCHEDULE SHOWING THE RECOVERY OF OMCA INTEREST IN R/O <?php echo ($model->BILL_TYPE == 1)? "OPS":"NPS"; ?> STAFF OF  <?php echo $master->DEPT_NAME?>FOR THE MONTH OF <?php echo date('M-Y', strtotime($model->CREATION_DATE))?></h3>
<h3 style="text-transform: uppercase;text-align: center">BILL NO: <?php echo $model->BILL_NO; ?></h3>
<table class="pay-schedule-table small">
	<thead>
		<tr>
			<th class="small-xxx right-br">S.No.</th>
			<th class="small right-br">NAME</th>
			<th class="small right-br">DESIGNATION</th>
			<th class="small-xx">MCA</th>
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
		$criteria->condition = "BILL_ID_FK=$model->ID AND YEAR=$model->YEAR AND $model->MONTH AND MCA_EMI > 0 AND IS_MCA_RECOVERY = 1";
		$criteria->addInCondition('EMPLOYEE_ID_FK', $employeesIds);
		$salaries = SalaryDetails::model()->findAll($criteria);
	?>
	<tbody>
		<?php foreach ($salaries as $salary) { ?>
		<tr>
			<td class="small-xxx right-br"><?php echo $i; ?></td>
			<td class="small right-br"><b><?php echo Employee::model()->findByPK($salary->EMPLOYEE_ID_FK)->NAME.'<br/>('.Employee::model()->findByPK($salary->EMPLOYEE_ID_FK)->NAME_HINDI.')';?></b></td>
			<td class="small right-br"><b><?php echo Designations::model()->findByPK(Employee::model()->findByPK($salary->EMPLOYEE_ID_FK)->DESIGNATION_ID_FK)->DESIGNATION.'<br/>('.Designations::model()->findByPK(Employee::model()->findByPK($salary->EMPLOYEE_ID_FK)->DESIGNATION_ID_FK)->DESIGNATION_HINDI.')';?></b></td>
			<td class="small-xx"><?php echo $salary->IS_MCA_RECOVERY ? $salary->MCA_EMI : 0; ?></td>
			<td class="small-xx"><?php echo $salary->IS_MCA_RECOVERY ? $salary->MCA_TOTAL : 0; ?></td>
			<td class="small-xx"><?php echo $salary->IS_MCA_RECOVERY ? $salary->MCA_INST : 0; ?></td>
			<td class="small-xx"><?php echo $salary->IS_MCA_RECOVERY ? $salary->MCA_BAL : 0; ?></td>
		</tr>
		<?php 
			$i++;
		} ?>
	</tbody>
	<tfoot>
		<th class="small-xxx right-br"></th>
		<th class="small right-br"></th>
		<th class="small right-br"></th>
		<th class="small-xx"><?php $MCA_EMI = Yii::app()->db->createCommand("SELECT SUM(MCA_EMI) as MCA_EMI FROM tbl_salary_details WHERE BILL_ID_FK = $model->ID AND IS_MCA_RECOVERY=1;")->queryRow()['MCA_EMI']; echo $MCA_EMI;?></th>
		<th class="small-xx"><?php $MCA_TOTAL = Yii::app()->db->createCommand("SELECT SUM(MCA_TOTAL) as MCA_TOTAL FROM tbl_salary_details WHERE BILL_ID_FK = $model->ID AND IS_MCA_RECOVERY=1;")->queryRow()['MCA_TOTAL']; echo $MCA_TOTAL;?></th>
		<th class="small-xx"></th>
		<th class="small-xx"><?php $MCA_BAL = Yii::app()->db->createCommand("SELECT SUM(MCA_BAL) as MCA_BAL FROM tbl_salary_details WHERE BILL_ID_FK = $model->ID AND IS_MCA_RECOVERY=1;")->queryRow()['MCA_BAL']; echo $MCA_BAL; ?></th>
	</tfoot>
</table>

<p style="text-align: center; margin-top: 0px;"><b><?php echo $this->amountToWord($MCA_EMI);?><b></p>

<div style="font-weight: bold; width:400px; float: right;text-align:center; margin-top:0px;margin-right:-10px;">
	<p><?php echo Employee::model()->findByPK($master['DEPT_ADMIN_EMPLOYEE'])->NAME;?></p>
	<p><?php echo Designations::model()->findByPK(Employee::model()->findByPK($master['DEPT_ADMIN_EMPLOYEE'])->DESIGNATION_ID_FK)->DESIGNATION;?></p>
	<p><?php echo $master['DEPT_NAME']?></p>
</div>
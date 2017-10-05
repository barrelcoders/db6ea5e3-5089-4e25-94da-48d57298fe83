<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/oneadmin.css" rel="stylesheet">
<style>*{font-size: 15px;}</style>
<script type="text/javascript">window.onload = function() { window.print(); }</script>
<?php
	$master = Master::model()->findByPK(1);
	$periods = $this->getBillPeriods($model->ID);
	$total_months = count($periods);
?>
<h2 style="text-transform: uppercase;text-align:center;"><?php echo $model->BILL_TITLE; ?></h2>
<h2 style="text-transform: uppercase;text-align: center">BILL NO: <?php echo $model->BILL_NO; ?></h2>
<table class="pay-schedule-table">
	<thead>
		<tr>
			<th class="small-xxx right-br">S.No.</th>
			<th class="small right-br">NAME</th>
			<th class="small right-br">DESIGNATION</th>
			<?php if($model->IS_MULTIPLE_MONTH) {?>
			<th class="small right-br">MONTH</th>
			<?php } ?>
			<th class="small-xx">PT</th>
		</tr>
	</thead>
	<?php 
		$i = 1;	
		
		$criteria = new CDbCriteria();
		$criteria->select = 't.EMPLOYEE_ID_FK';
		$criteria->condition = 't.BILL_ID_FK='.$model->ID.' AND t.PT > 0';
		$criteria->group = 't.EMPLOYEE_ID_FK';
		$criteria->join='INNER JOIN tbl_employee e ON e.ID = t.EMPLOYEE_ID_FK';
		$criteria->order = 'e.DESIGNATION_ID_FK DESC';
		$employeesInSalary = SalaryDetails::model()->findAll($criteria);
	?>
	<tbody>
		<?php 
			foreach ($employeesInSalary as $employee) {
				$j=1;
				foreach($periods as $period){
					$salary = SalaryDetails::model()->find("t.EMPLOYEE_ID_FK=".$employee->EMPLOYEE_ID_FK." AND t.BILL_ID_FK=".$model->ID." AND t.MONTH=".$period['MONTH']." AND t.YEAR=".$period['YEAR']);
					if($model->IS_MULTIPLE_MONTH) {
						if($j==1){
							?>
							<tr>
								<td rowspan="<?php echo $total_months;?>" class="small-xxx right-br"><?php echo $i; ?></td>
								<td rowspan="<?php echo $total_months;?>" class="small right-br"><b><?php echo Employee::model()->findByPK($salary->EMPLOYEE_ID_FK)->NAME.'<br/>('.Employee::model()->findByPK($salary->EMPLOYEE_ID_FK)->NAME_HINDI.')';?></b></td>
								<td rowspan="<?php echo $total_months;?>" class="small right-br"><b><?php echo Designations::model()->findByPK(Employee::model()->findByPK($salary->EMPLOYEE_ID_FK)->DESIGNATION_ID_FK)->DESIGNATION.'<br/>('.Designations::model()->findByPK(Employee::model()->findByPK($salary->EMPLOYEE_ID_FK)->DESIGNATION_ID_FK)->DESIGNATION_HINDI.')';?></b></td>
								<td class="small-xx right-br"><?php echo $period['FORMAT']; ?></td>
								<td class="small-xx"><?php echo $salary->PT; ?></td>
							</tr>
							<?php
						}
						else{
							?>
							<tr>
								<td class="small-xx right-br"><?php echo $period['FORMAT']; ?></td>
								<td class="small-xx"><?php echo $salary->PT; ?></td>
							</tr>
							<?php
						}
					}
					else{
						?>
							<tr>
								<td class="small-xxx right-br"><?php echo $i; ?></td>
								<td class="small right-br"><b><?php echo Employee::model()->findByPK($salary->EMPLOYEE_ID_FK)->NAME.'<br/>('.Employee::model()->findByPK($salary->EMPLOYEE_ID_FK)->NAME_HINDI.')';?></b></td>
								<td class="small right-br"><b><?php echo Designations::model()->findByPK(Employee::model()->findByPK($salary->EMPLOYEE_ID_FK)->DESIGNATION_ID_FK)->DESIGNATION.'<br/>('.Designations::model()->findByPK(Employee::model()->findByPK($salary->EMPLOYEE_ID_FK)->DESIGNATION_ID_FK)->DESIGNATION_HINDI.')';?></b></td>
								<td class="small-xx"><?php echo $salary->PT; ?></td>
							</tr>
						<?php
					}
					$j++;
				}
				$i++; 
			}
		?>
	</tbody>
	<tfoot>
		<th class="small-xxx right-br"></th>
		<th class="small right-br"></th>
		<th class="small right-br"></th>
		<?php if($model->IS_MULTIPLE_MONTH) {?>
		<th class="small-x right-br"></th>
		<?php } ?>
		<th class="small-xx"><?php echo Yii::app()->db->createCommand("SELECT SUM(PT) as PT FROM tbl_salary_details WHERE BILL_ID_FK = $model->ID;")->queryRow()['PT'];?></th>
	</tfoot>
</table>

<h4 style="text-align:center;margin-top: 50px;"><?php echo $this->amountToWord(Yii::app()->db->createCommand("SELECT SUM(PT) as PT FROM tbl_salary_details WHERE BILL_ID_FK = $model->ID;")->queryRow()['PT']);?></h4>
<!--
<div style="width: 400px; margin: 0 auto; font-size: 20px; margin-top:100px;">
	<?php $appropiations = Yii::app()->db->createCommand("SELECT * FROM tbl_appropiation_register WHERE BILL_NO = $model->ID")->queryRow(); ?>
	<h4 style="text-decoration: underline;">Appropiation</h4>
	<p><b>Budget: </b>Rs. <?php echo Budget::model()->findByPK($appropiations['BUDGET_ID'])->AMOUNT;?>/-</p>
	<p><b>Bill Amount: </b>Rs. <?php echo $appropiations['BILL_AMOUNT'];?>/-</p>
	<p><b>Expenditure Including Bill: </b>Rs. <?php echo $appropiations['EXPENDITURE_INC_BILL'];?>/-</p>
	<p><b>Balance: </b>Rs. <?php echo $appropiations['BALANCE'];?>/-</p>
</div>
-->
<div style="font-weight: bold; width:400px; float: right;text-align:center; margin-top:100px;margin-right:-10px;">
	<p>(<?php echo Employee::model()->findByPK($master['DEPT_ADMIN_EMPLOYEE'])->NAME;?>)</p>
	<p><?php echo Designations::model()->findByPK(Employee::model()->findByPK($master['DEPT_ADMIN_EMPLOYEE'])->DESIGNATION_ID_FK)->DESIGNATION;?></p>
	<p><?php echo $master['DEPT_NAME']?></p>
</div>


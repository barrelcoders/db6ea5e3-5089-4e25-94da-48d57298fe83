<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/oneadmin.css" rel="stylesheet">
<script type="text/javascript">window.onload = function() { window.print(); }</script>
<?php 
	$master = Master::model()->findByPK(1);
	$periods = $this->getBillPeriods($model->ID);
	$total_months = count($periods); 
?>
<h2 style="text-transform: uppercase;text-align:center;"><?php echo $model->BILL_TITLE; ?> FOR THE MONTH OF <?php echo date('M-Y', strtotime($model->CREATION_DATE))?></h2>
<h2 style="text-transform: uppercase;text-align: center">BILL NO: <?php echo $model->BILL_NO; ?></h2>
<table class="pay-schedule-table">
	<thead>
		<tr>
			<th class="small-xxx right-br">S.No.</th>
			<th class="small right-br">NAME</th>
			<th class="small right-br">DESIGNATION</th>
			<th class="small right-br">BASIC</th>
			<th class="small right-br">DA</th>
			<th class="small-xx">BONUS</th>
			<th class="small-xx">GROSS</th>
			<th class="small-xx right-br left-br">DEDUCTION</th>
			<th class="small-xx right-br">NET</th>
			<th class="small-xx ">AMOUNT CREDIT TO BANK</th>
		</tr>
	</thead>

	<tbody>
	<?php 
		$i = 1;	
		$criteria = new CDbCriteria();
		$criteria->select = 't.EMPLOYEE_ID_FK';
		$criteria->condition = 't.BILL_ID_FK='.$model->ID;
		$criteria->group = 't.EMPLOYEE_ID_FK';
		$criteria->join='INNER JOIN tbl_employee e ON e.ID = t.EMPLOYEE_ID_FK';
		$criteria->order = 'e.FOLIO_NO ASC';
		$employeesInSalary = SalaryDetails::model()->findAll($criteria);
		
		foreach ($employeesInSalary as $employee) {
			foreach($periods as $period){
				$salary = SalaryDetails::model()->find("t.EMPLOYEE_ID_FK=".$employee->EMPLOYEE_ID_FK." AND t.BILL_ID_FK=".$model->ID." AND t.MONTH=".$period['MONTH']." AND t.YEAR=".$period['YEAR']);
				$basic = PayMatrix::model()->findByPK(Employee::model()->findByPK($salary->EMPLOYEE_ID_FK)->PAY_MATRIX_ID_FK)->BASIC;
				$da = round($basic * 0.05);
				?>
					<tr>
						<td class="small-xxx right-br"><?php echo $i; ?></td>
						<td class="small right-br"><b><?php echo Employee::model()->findByPK($salary->EMPLOYEE_ID_FK)->NAME;?></b></td>
						<td class="small right-br"><b><?php echo Designations::model()->findByPK(Employee::model()->findByPK($salary->EMPLOYEE_ID_FK)->DESIGNATION_ID_FK)->DESIGNATION;?></b></td>
						<td class="small-xx right-br"><?php echo $basic; ?></td>
						<td class="small-xx right-br"><?php echo $da; ?></td>
						<td class="small-xx"><?php echo $salary->BONUS; ?></td>
						<td class="small-xx"><?php echo $salary->GROSS; ?></td>
						<td class="small-xx right-br left-br"><?php echo $salary->DED; ?></td>
						<td class="small-xx right-br"><?php echo $salary->NET; ?></td>
						<td class="small-xx "><?php echo $salary->AMOUNT_BANK; ?></td>
					</tr>
				<?php
			}
			$i++;
		}
	?>
	</tbody>
	<tfoot>
		<th class="small-xxx right-br"></th>
		<th class="small right-br"></th>
		<th class="small right-br"></th>
		<th class="small right-br"></th>
		<th class="small right-br"></th>
		<th class="small-xx"><?php $BONUS = Yii::app()->db->createCommand("SELECT SUM(BONUS) as BONUS FROM tbl_salary_details WHERE BILL_ID_FK = $model->ID AND YEAR = $model->YEAR AND MONTH = $model->MONTH;")->queryRow()['BONUS'];echo $BONUS;?></th>
		<th class="small-xx"><?php echo Yii::app()->db->createCommand("SELECT SUM(GROSS) as GROSS FROM tbl_salary_details WHERE BILL_ID_FK = $model->ID AND YEAR = $model->YEAR AND MONTH = $model->MONTH;")->queryRow()['GROSS'];?></th>
		<th class="small-xx"><?php echo Yii::app()->db->createCommand("SELECT SUM(DED) as DED FROM tbl_salary_details WHERE BILL_ID_FK = $model->ID AND YEAR = $model->YEAR AND MONTH = $model->MONTH;")->queryRow()['DED'];?></th>
		<th class="small-xx"><?php echo Yii::app()->db->createCommand("SELECT SUM(NET) as NET FROM tbl_salary_details WHERE BILL_ID_FK = $model->ID AND YEAR = $model->YEAR AND MONTH = $model->MONTH;")->queryRow()['NET'];?></th>
		<th class="small-xxx"><?php $AMOUNT_BANK = Yii::app()->db->createCommand("SELECT SUM(AMOUNT_BANK) as AMOUNT_BANK FROM tbl_salary_details WHERE BILL_ID_FK = $model->ID AND YEAR = $model->YEAR AND MONTH = $model->MONTH;")->queryRow()['AMOUNT_BANK']; echo $AMOUNT_BANK;?></th>
	</tfoot>
</table>
<h4 style="text-align:center;margin-top: 50px;"><?php echo $this->amountToWord($AMOUNT_BANK);?></h4>
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

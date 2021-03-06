<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/oneadmin.css" rel="stylesheet">
<script type="text/javascript">window.onload = function() { window.print(); }</script>
<?php
	$master = Master::model()->findByPK(1); 
	$periods = $this->getBillPeriods($model->ID);
	$total_months = count($periods); 
?>
<h3 style="text-transform: uppercase;text-align:center;">SCHEDULE SHOWING THE RECOVERY OF HBA INTEREST IN R/O <?php echo ($model->BILL_TYPE == 1)? "OPS":"NPS"; ?> STAFF OF  <?php echo $master->DEPT_NAME?>FOR THE MONTH OF <?php echo date('M-Y', strtotime($model->CREATION_DATE))?></h3>
<h3 style="text-transform: uppercase;text-align: center">BILL NO: <?php echo $model->BILL_NO; ?></h3>
<table class="pay-schedule-table small">
	<thead>
		<tr>
			<th class="small-xxx right-br">S.No.</th>
			<th class="small right-br">NAME</th>
			<th class="small right-br">DESIGNATION</th>
			<?php if($model->IS_MULTIPLE_MONTH) {?>
			<th class="small right-br">MONTH</th>
			<?php } ?>
			<th class="small-xx">HBA</th>
			<th class="small-xx">TOTAL</th>
			<th class="small-xx">INSTALL. NO.</th>
			<th class="small-xx">BALANCE</th>
		</tr>
	</thead>
	<?php 
		$i = 1;	
		$criteria = new CDbCriteria();
		$criteria->select = 't.EMPLOYEE_ID_FK';
		$criteria->condition = 't.BILL_ID_FK='.$model->ID.' AND t.HBA_EMI > 0 AND t.IS_HBA_RECOVERY = 1';;
		$criteria->group = 't.EMPLOYEE_ID_FK';
		$criteria->join='INNER JOIN tbl_employee e ON e.ID = t.EMPLOYEE_ID_FK';
		$criteria->order = 'e.FOLIO_NO ASC';
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
									<td  rowspan="<?php echo $total_months;?>" class="small-xxx right-br"><?php echo $i; ?></td>
									<td  rowspan="<?php echo $total_months;?>" class="small right-br"><b><?php echo Employee::model()->findByPK($salary->EMPLOYEE_ID_FK)->NAME;?></b></td>
									<td  rowspan="<?php echo $total_months;?>" class="small right-br"><b><?php echo Designations::model()->findByPK(Employee::model()->findByPK($salary->EMPLOYEE_ID_FK)->DESIGNATION_ID_FK)->DESIGNATION;?></b></td>
									<td class="small-xx"><?php echo $period['FORMAT']; ?></td>
									<td class="small-xx"><?php echo $salary->IS_HBA_RECOVERY ? $salary->HBA_EMI : 0; ?></td>
									<td class="small-xx"><?php echo $salary->IS_HBA_RECOVERY ? $salary->HBA_TOTAL : 0; ?></td>
									<td class="small-xx"><?php echo $salary->IS_HBA_RECOVERY ? $salary->HBA_INST : 0; ?></td>
									<td class="small-xx"><?php echo $salary->IS_HBA_RECOVERY ? $salary->HBA_BAL : 0; ?></td>
								</tr>
							<?php
						}
						else{
							?>
								<tr>
									<td class="small-xx"><?php echo $salary->IS_HBA_RECOVERY ? $salary->HBA_EMI : 0; ?></td>
									<td class="small-xx"><?php echo $salary->IS_HBA_RECOVERY ? $salary->HBA_TOTAL : 0; ?></td>
									<td class="small-xx"><?php echo $salary->IS_HBA_RECOVERY ? $salary->HBA_INST : 0; ?></td>
									<td class="small-xx"><?php echo $salary->IS_HBA_RECOVERY ? $salary->HBA_BAL : 0; ?></td>
								</tr>
							<?php
						}
					}
					else{
						?>
							<tr>
								<td class="small-xxx right-br"><?php echo $i; ?></td>
								<td class="small right-br"><b><?php echo Employee::model()->findByPK($salary->EMPLOYEE_ID_FK)->NAME;?></b></td>
								<td class="small right-br"><b><?php echo Designations::model()->findByPK(Employee::model()->findByPK($salary->EMPLOYEE_ID_FK)->DESIGNATION_ID_FK)->DESIGNATION;?></b></td>
								<td class="small-xx"><?php echo $salary->IS_HBA_RECOVERY ? $salary->HBA_EMI : 0; ?></td>
								<td class="small-xx"><?php echo $salary->IS_HBA_RECOVERY ? $salary->HBA_TOTAL : 0; ?></td>
								<td class="small-xx"><?php echo $salary->IS_HBA_RECOVERY ? $salary->HBA_INST : 0; ?></td>
								<td class="small-xx"><?php echo $salary->IS_HBA_RECOVERY ? $salary->HBA_BAL : 0; ?></td>
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
		<th class="small right-br"></th>
		<?php } ?>
		<th class="small-xx"><?php $HBA_EMI = Yii::app()->db->createCommand("SELECT SUM(HBA_EMI) as HBA_EMI FROM tbl_salary_details WHERE BILL_ID_FK = $model->ID AND IS_HBA_RECOVERY=1;")->queryRow()['HBA_EMI']; echo $HBA_EMI;?></th>
		<th class="small-xx"><?php $HBA_TOTAL = Yii::app()->db->createCommand("SELECT SUM(HBA_TOTAL) as HBA_TOTAL FROM tbl_salary_details WHERE BILL_ID_FK = $model->ID AND IS_HBA_RECOVERY=1;")->queryRow()['HBA_TOTAL']; echo $HBA_TOTAL;?></th>
		<th class="small-xx"></th>
		<th class="small-xx"><?php $HBA_BAL = Yii::app()->db->createCommand("SELECT SUM(HBA_BAL) as HBA_BAL FROM tbl_salary_details WHERE BILL_ID_FK = $model->ID AND IS_HBA_RECOVERY=1;")->queryRow()['HBA_BAL']; echo $HBA_BAL; ?></th>
	</tfoot>
</table>

<p style="text-align: center; margin-top: 50px;"><b><?php echo $this->amountToWord($HBA_EMI);?><b></p>

<div style="font-weight: bold; width:400px; float: right;text-align:center; margin-top:100px;margin-right:-10px;">
	<p>(<?php echo Employee::model()->findByPK($master['DEPT_ADMIN_EMPLOYEE'])->NAME;?>)</p>
	<p><?php echo Designations::model()->findByPK(Employee::model()->findByPK($master['DEPT_ADMIN_EMPLOYEE'])->DESIGNATION_ID_FK)->DESIGNATION;?></p>
	<p><?php echo $master['DEPT_NAME']?></p>
</div>
<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/oneadmin.css" rel="stylesheet">
<script type="text/javascript">window.onload = function() { window.print(); }</script>
<?php 
	$master = Master::model()->findByPK(1);
	$periods = $this->getBillPeriods($model->ID);
	$total_months = count($periods);
?>
<h3 style="text-transform: uppercase;text-align:center;">SCHEDULE SHOWING THE RECOVERY OF GPF IN R/O <?php echo ($model->BILL_TYPE == 1)? "OPS":"NPS"; ?> STAFF OF  <?php echo $master->DEPT_NAME?>FOR THE MONTH OF <?php echo date('M-Y', strtotime($model->CREATION_DATE))?></h3>
<h3 style="text-transform: uppercase;text-align: center">BILL NO: <?php echo $model->BILL_NO; ?></h3>
<table class="pay-schedule-table">
	<thead>
		<?php
			if($model->IS_NPS_PAY_BILL || $model->IS_NPS_DA_ARREAR_BILL){
				?>
					<tr>
						<th class="small-xxx right-br">S.No.</th>
						<th class="small right-br">NPS ACCOUNT NO</th>
						<th class="small right-br">NAME</th>
						<th class="small right-br">DESIGNATION</th>
						<?php if($model->IS_MULTIPLE_MONTH) {?>
						<th class="small right-br">MONTH</th>
						<?php } ?>
						<th class="small-xx">PAY</th>
						<th class="small-xx">GP</th>
						<th class="small-xx">DA</th>
						<th class="small-xx">CPF TIER I</th>
						<th class="small-xx">CPF TIER II</th>
						<th class="small-xx left-br">TOTAL</th>
					</tr>
				<?php
			}
			else if($model->IS_OPS_PAY_BILL || $model->IS_OPS_DA_ARREAR_BILL){
				?>
					<tr>
						<th class="small-xxx right-br">S.No.</th>
						<th class="small right-br">GPF NO</th>
						<th class="small right-br">NAME</th>
						<th class="small right-br">DESIGNATION</th>
						<?php if($model->IS_MULTIPLE_MONTH) {?>
						<th class="small right-br">MONTH</th>
						<?php } ?>
						<th class="small-xx">PAY</th>
						<th class="small-xx">GP</th>
						<th class="small-xx">DA</th>
						<th class="small-xx">GPFC</th>
						<th class="small-xx">GPFR</th>
						<th class="small-xx left-br">TOTAL</th>
					</tr>
				<?php
			}
		?>
	</thead>
	<?php 
		$i = 1;	
		
		$criteria = new CDbCriteria();
		$criteria->select = 't.EMPLOYEE_ID_FK';
		$criteria->condition = 't.BILL_ID_FK='.$model->ID;
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
					if($salary->CPF_TIER_I || $salary->CPF_TIER_II){
						if($model->IS_MULTIPLE_MONTH) { 
							if($j==1){
								?>
									<tr>
										<td  rowspan="<?php echo $total_months;?>" class="small-xxx right-br"><?php echo $i; ?></td>
										<td  rowspan="<?php echo $total_months;?>" class="small right-br"><b><?php echo Employee::model()->findByPK($salary->EMPLOYEE_ID_FK)->PENSION_ACC_NO;?></b></td>
										<td  rowspan="<?php echo $total_months;?>" class="small right-br"><b><?php echo Employee::model()->findByPK($salary->EMPLOYEE_ID_FK)->NAME;?></b></td>
										<td  rowspan="<?php echo $total_months;?>" class="small right-br"><b><?php echo Designations::model()->findByPK(Employee::model()->findByPK($salary->EMPLOYEE_ID_FK)->DESIGNATION_ID_FK)->DESIGNATION;?></b></td>
										<td class="small-xx right-br"><?php echo $period['FORMAT']; ?></td>
										<td class="small-xx"><?php echo $salary->BASIC; ?></td>
										<td class="small-xx"><?php echo $salary->GP; ?></td>
										<td class="small-xx"><?php echo $salary->DA; ?></td>
										<td class="small-xx"><?php echo $salary->CPF_TIER_I; ?></td>
										<td class="small-xx"><?php echo $salary->CPF_TIER_II; ?></td>
										<td class="small-xx left-br"><?php echo $salary->CPF_TIER_I + $salary->CPF_TIER_II; ?></td>
									</tr>
								
								<?php
							}
							else{
								?>
									<tr>
										<td class="small-xx right-br"><?php echo $period['FORMAT']; ?></td>
										<td class="small-xx"><?php echo $salary->BASIC; ?></td>
										<td class="small-xx"><?php echo $salary->GP; ?></td>
										<td class="small-xx"><?php echo $salary->DA; ?></td>
										<td class="small-xx"><?php echo $salary->CPF_TIER_I; ?></td>
										<td class="small-xx"><?php echo $salary->CPF_TIER_II; ?></td>
										<td class="small-xx left-br"><?php echo $salary->CPF_TIER_I + $salary->CPF_TIER_II; ?></td>
									</tr>
								<?php
							}
						}
						else{
							?>
								<tr>
									<td class="small-xxx right-br"><?php echo $i; ?></td>
									<td class="small right-br"><b><?php echo Employee::model()->findByPK($salary->EMPLOYEE_ID_FK)->PENSION_ACC_NO;?></b></td>
									<td class="small right-br"><b><?php echo Employee::model()->findByPK($salary->EMPLOYEE_ID_FK)->NAME;?></b></td>
									<td class="small right-br"><b><?php echo Designations::model()->findByPK(Employee::model()->findByPK($salary->EMPLOYEE_ID_FK)->DESIGNATION_ID_FK)->DESIGNATION;?></b></td>
									<td class="small-xx"><?php echo $salary->BASIC; ?></td>
									<td class="small-xx"><?php echo $salary->GP; ?></td>
									<td class="small-xx"><?php echo $salary->DA; ?></td>
									<td class="small-xx"><?php echo $salary->CPF_TIER_I; ?></td>
									<td class="small-xx"><?php echo $salary->CPF_TIER_II; ?></td>
									<td class="small-xx left-br"><?php echo $salary->CPF_TIER_I + $salary->CPF_TIER_II; ?></td>
								</tr>
							<?php
						}
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
		<th class="small right-br"></th>
		<?php if($model->IS_MULTIPLE_MONTH) {?>
		<th class="small right-br"></th>
		<?php } ?>
		<th class="small-xx"><?php echo Yii::app()->db->createCommand("SELECT SUM(BASIC) as BASIC FROM tbl_salary_details WHERE BILL_ID_FK = $model->ID AND YEAR = $model->YEAR AND MONTH = $model->MONTH;")->queryRow()['BASIC'];?></th>
		<th class="small-xx"><?php echo Yii::app()->db->createCommand("SELECT SUM(GP) as GP FROM tbl_salary_details WHERE BILL_ID_FK = $model->ID AND YEAR = $model->YEAR AND MONTH = $model->MONTH;")->queryRow()['GP'];?></th>
		<th class="small-xx"><?php echo Yii::app()->db->createCommand("SELECT SUM(DA) as DA FROM tbl_salary_details WHERE BILL_ID_FK = $model->ID AND YEAR = $model->YEAR AND MONTH = $model->MONTH;")->queryRow()['DA'];?></th>
		<th class="small-xx">
			<?php 		
				$CPF_TIER_I = Yii::app()->db->createCommand("SELECT SUM(CPF_TIER_I) as CPF_TIER_I FROM tbl_salary_details WHERE BILL_ID_FK = $model->ID AND YEAR = $model->YEAR AND MONTH = $model->MONTH;")->queryRow()['CPF_TIER_I']; 
				$CPF_TIER_II = Yii::app()->db->createCommand("SELECT SUM(CPF_TIER_II) as CPF_TIER_II FROM tbl_salary_details WHERE BILL_ID_FK = $model->ID AND YEAR = $model->YEAR AND MONTH = $model->MONTH;")->queryRow()['CPF_TIER_II']; 
				
				echo $CPF_TIER_I;
			?>
		</th>
		<th class="small-xx">
			<?php 
		
			echo $CPF_TIER_II;
			?>
		</th>
		<th class="small-xx left-br">
			<?php 
		
			echo $CPF_TIER_I+$CPF_TIER_II;
			?>
		</th>
	</tfoot>
</table>

<p style="text-align: center; margin-top: 50px;"><b><?php echo $this->amountToWord($CPF_TIER_I+$CPF_TIER_II);?><b></p>
<div style="font-weight: bold; width:400px; float: right;text-align:center; margin-top:100px;margin-right:-10px;">
	<p>(<?php echo Employee::model()->findByPK($master['DEPT_ADMIN_EMPLOYEE'])->NAME;?>)</p>
	<p><?php echo Designations::model()->findByPK(Employee::model()->findByPK($master['DEPT_ADMIN_EMPLOYEE'])->DESIGNATION_ID_FK)->DESIGNATION;?></p>
	<p><?php echo $master['DEPT_NAME']?></p>
</div>
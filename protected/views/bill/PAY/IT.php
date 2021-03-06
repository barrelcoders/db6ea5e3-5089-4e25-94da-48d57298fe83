<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/oneadmin.css" rel="stylesheet">
<script type="text/javascript">window.onload = function() { window.print(); }</script>
<?php 
	$master = Master::model()->findByPK(1); 
	$periods = $this->getBillPeriods($model->ID);
	$total_months = count($periods); 
?>
<h3 style="text-transform: uppercase;text-align:center;">SCHEDULE SHOWING THE RECOVERY OF INCOME TAX IN R/O <?php echo ($model->BILL_TYPE == 1)? "OPS":"NPS"; ?> STAFF OF  <?php echo $master->DEPT_NAME?>FOR THE MONTH OF <?php echo date('M-Y', strtotime($model->CREATION_DATE))?></h3>
<h3 style="text-transform: uppercase;text-align: center">BILL NO: <?php echo $model->BILL_NO; ?></h3>
<table class="pay-schedule-table">
	<thead>
		<tr>
			<th class="small-xxx right-br">S.No.</th>
			<th class="small right-br">NAME</th>
			<th class="small right-br">DESIGNATION</th>
			<?php if($model->IS_MULTIPLE_MONTH) {?>
			<th class="small right-br">MONTH</th>
			<?php } ?>
			<th class="small-xx">IT</th>
			<th class="small-xx">IT</th>
			<th class="small-xx">Cess</th>
			<th class="small-xx">Higher Edu. Cess</th>
		</tr>
	</thead>
	<?php 
		$i = 1;	
		$criteria = new CDbCriteria();
		$criteria->select = 't.EMPLOYEE_ID_FK';
		$criteria->condition = 't.BILL_ID_FK='.$model->ID.' AND t.IT > 0';
		$criteria->group = 't.EMPLOYEE_ID_FK';
		$criteria->join='INNER JOIN tbl_employee e ON e.ID = t.EMPLOYEE_ID_FK';
		$criteria->order = 'e.FOLIO_NO ASC';
		$employeesInSalary = SalaryDetails::model()->findAll($criteria);
	?>
	<tbody>
		<?php 
			$TOTAL_ONLY_IT=0;
			$TOTAL_ONLY_ECESS=0;
			$TOTAL_ONLY_HECESS=0;
			
			foreach ($employeesInSalary as $employee) {
				$j=1;
				foreach($periods as $period){
					$salary = SalaryDetails::model()->find("t.EMPLOYEE_ID_FK=".$employee->EMPLOYEE_ID_FK." AND t.BILL_ID_FK=".$model->ID." AND t.MONTH=".$period['MONTH']." AND t.YEAR=".$period['YEAR']);
					if(Yii::app()->session['FINANCIAL_YEAR'] == 1){
						$ONLY_IT = round(($salary->IT / 103) * 100);
						$ONLY_ECESS = round(($salary->IT / 103) * 2);
						$ONLY_HECESS = round(($salary->IT / 103) * 1);
					}
					else{
						$ONLY_IT = round(($salary->IT / 104) * 100);
						$ONLY_ECESS = round(($salary->IT / 104) * 2);
						$ONLY_HECESS = round(($salary->IT / 104) * 2);
					}
					
					
					if($model->IS_MULTIPLE_MONTH) { 
						if($j==1){
							?>
								<tr>
									<td rowspan="<?php echo $total_months;?>" class="small-xxx right-br"><?php echo $i; ?></td>
									<td rowspan="<?php echo $total_months;?>" class="small right-br"><b><?php echo Employee::model()->findByPK($salary->EMPLOYEE_ID_FK)->NAME;?></b></td>
									<td rowspan="<?php echo $total_months;?>" class="small right-br"><b><?php echo Designations::model()->findByPK(Employee::model()->findByPK($salary->EMPLOYEE_ID_FK)->DESIGNATION_ID_FK)->DESIGNATION;?></b></td>
									<td class="small-xx right-br"><?php echo $period['FORMAT']; ?></td>
									<td class="small-xx"><?php echo $salary->IT; ?></td>
									<td class="small-xx"><?php echo $ONLY_IT; ?></td>
									<td class="small-xx"><?php echo $ONLY_ECESS; ?></td>
									<td class="small-xx"><?php echo $ONLY_HECESS; ?></td>
								</tr>
							<?php
						}
						else{
							?>
								<tr>
									<td class="small-xx right-br"><?php echo $period['FORMAT']; ?></td>
									<td class="small-xx"><?php echo $salary->IT; ?></td>
									<td class="small-xx"><?php echo $ONLY_IT; ?></td>
									<td class="small-xx"><?php echo $ONLY_ECESS; ?></td>
									<td class="small-xx"><?php echo $ONLY_HECESS; ?></td>
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
								<td class="small-xx"><?php echo $salary->IT; ?></td>
									<td class="small-xx"><?php echo $ONLY_IT; ?></td>
									<td class="small-xx"><?php echo $ONLY_ECESS; ?></td>
									<td class="small-xx"><?php echo $ONLY_HECESS; ?></td>
							</tr>
						<?php
					}
					$j++;
					
					$TOTAL_ONLY_IT+=$ONLY_IT;
					$TOTAL_ONLY_ECESS+=$ONLY_ECESS;
					$TOTAL_ONLY_HECESS+=$ONLY_HECESS;
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
		<th class="small-xx"><?php $IT = Yii::app()->db->createCommand("SELECT SUM(IT) as IT FROM tbl_salary_details WHERE BILL_ID_FK = $model->ID;")->queryRow()['IT']; echo $IT ;?></th>
		<th class="small-xx"><?php echo $TOTAL_ONLY_IT;?></th>
		<th class="small-xx"><?php echo $TOTAL_ONLY_ECESS;?></th>
		<th class="small-xx"><?php echo $TOTAL_ONLY_HECESS;?></th>
	</tfoot>
</table>

<p style="text-align: center"><b><?php echo $this->amountToWord($IT);?><b></p>

<div style="font-weight: bold; width:400px; float: right;text-align:center; margin-top:100px;margin-right:-10px;">
	<p>(<?php echo Employee::model()->findByPK($master['DEPT_ADMIN_EMPLOYEE'])->NAME;?>)</p>
	<p><?php echo Designations::model()->findByPK(Employee::model()->findByPK($master['DEPT_ADMIN_EMPLOYEE'])->DESIGNATION_ID_FK)->DESIGNATION;?></p>
	<p><?php echo $master['DEPT_NAME']?></p>
</div>
<style>
	table td:nth-child(4), table th:nth-child(4){ }
</style>
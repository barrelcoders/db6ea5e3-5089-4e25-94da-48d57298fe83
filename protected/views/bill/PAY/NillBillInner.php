<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/oneadmin.css" rel="stylesheet">
<script type="text/javascript">window.onload = function() { window.print(); }</script>
<style>*{font-size: 15px;}.pay-schedule-table tr, .pay-schedule-table th, .pay-schedule-table td {	text-align: center;height: 60px; page-break-inside: avoid;}
.pay-schedule-table thead th{font-size: 14px;}</style>
<?php 
	$master = Master::model()->findByPK(1);
	$periods = $this->getBillPeriods($model->ID);
	$total_months = count($periods); 
?>
<h2 style="text-transform: uppercase;text-align:center;">NILL BILL(GOVT. CONTR.) OF <?php echo ($model->BILL_TYPE == 1)? "OPS":"NPS"; ?> STAFF OF  <?php echo $master->DEPT_NAME?>FOR THE MONTH OF <?php echo date('M-Y', strtotime($model->CREATION_DATE))?></h2>
<h2 style="text-transform: uppercase;text-align: center">BILL NO: <?php echo $model->NILL_BILL_NO; ?></h2>
<p>( 8342 : [ 20.02 ]     Government's Contribution Tier-I )</p><br/>

<table class="pay-schedule-table">
	<thead>
		<tr>
			<th class="small-xxx right-br">S.No.</th>
			<th class="small right-br">NAME</th>
			<th class="small right-br">DESIGNATION</th>
			<?php if($model->IS_MULTIPLE_MONTH) {?>
			<th class="small right-br">MONTH</th>
			<?php } ?>
			<th class="small-xx right-br">BASIC</th>
			<th class="small-xxx">DA</th>
			<th class="small-x">Govt. Servant Contrib.</th>
			<th class="small-xx">Govt. Contrib. TIER I</th>
			<th class="small-xx right-br left-br">DEDUCTION</th>
		</tr>
	</thead>
	<?php 
		$i = 1;	
		$criteria = new CDbCriteria();
		$criteria->select = 't.EMPLOYEE_ID_FK';
		$criteria->condition = 't.BILL_ID_FK='.$model->ID.'';
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
									<td class="small-xx  right-br"><?php echo $period['FORMAT']; ?></td>
									<td class="small-xx"><?php echo $salary->BASIC; ?></td>
									<td class="small-xxx"><?php echo $salary->DA; ?></td>
									<td class="small-xx"><?php echo $salary->CPF_TIER_I; ?></td>
									<td class="small-xx"><?php echo $salary->CPF_TIER_I; ?></td>
									<td class="small-xx right-br left-br"><?php echo $salary->CPF_TIER_I; ?></td>
								</tr>
							<?php
						}
						else{
							?>
								<tr>
									<td class="small-xx"><?php echo $period['FORMAT']; ?></td>
									<td class="small-xx  right-br"><?php echo $salary->BASIC; ?></td>
									<td class="small-xxx"><?php echo $salary->DA; ?></td>
									<td class="small-xx"><?php echo $salary->CPF_TIER_I; ?></td>
									<td class="small-xx"><?php echo $salary->CPF_TIER_I; ?></td>
									<td class="small-xx right-br left-br"><?php echo $salary->CPF_TIER_I; ?></td>
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
								<td class="small-xx right-br"><?php echo $salary->BASIC; ?></td>
								<td class="small-xxx"><?php echo $salary->DA; ?></td>
								<td class="small-xx"><?php echo $salary->CPF_TIER_I; ?></td>
								<td class="small-xx"><?php echo $salary->CPF_TIER_I; ?></td>
								<td class="small-xx right-br left-br"><?php echo $salary->CPF_TIER_I; ?></td>
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
		<th class="small-xx right-br"><?php $BASIC = Yii::app()->db->createCommand("SELECT SUM(BASIC) as BASIC FROM tbl_salary_details WHERE BILL_ID_FK = $model->ID AND YEAR = $model->YEAR AND MONTH = $model->MONTH;")->queryRow()['BASIC'];echo $BASIC;?></th>
		<th class="small-xxx"><?php echo Yii::app()->db->createCommand("SELECT SUM(DA) as DA FROM tbl_salary_details WHERE BILL_ID_FK = $model->ID AND YEAR = $model->YEAR AND MONTH = $model->MONTH;")->queryRow()['DA'];?></th>
		<th class="small-xx"><?php echo Yii::app()->db->createCommand("SELECT SUM(CPF_TIER_I) as CPF_TIER_I FROM tbl_salary_details WHERE BILL_ID_FK = $model->ID AND YEAR = $model->YEAR AND MONTH = $model->MONTH;")->queryRow()['CPF_TIER_I'];?></th>
		<th class="small-xx"><?php echo Yii::app()->db->createCommand("SELECT SUM(CPF_TIER_I) as CPF_TIER_I FROM tbl_salary_details WHERE BILL_ID_FK = $model->ID AND YEAR = $model->YEAR AND MONTH = $model->MONTH;")->queryRow()['CPF_TIER_I'];?></th>
		<th class="small-xx right-br left-br"><?php echo Yii::app()->db->createCommand("SELECT SUM(CPF_TIER_I) as CPF_TIER_I FROM tbl_salary_details WHERE BILL_ID_FK = $model->ID AND YEAR = $model->YEAR AND MONTH = $model->MONTH;")->queryRow()['CPF_TIER_I'];?></th>
	</tfoot>
</table>

<div style="width: 400px; margin: 0 auto; font-size: 20px; margin-top:100px;">
	<?php $appropiations = Yii::app()->db->createCommand("SELECT * FROM tbl_appropiation_register WHERE BILL_NO = $model->ID")->queryRow(); ?>
	<h4 style="text-decoration: underline;">Appropiation</h4>
	<p><b>Budget: </b>Rs. <?php echo Budget::model()->findByPK($appropiations['BUDGET_ID'])->AMOUNT;?>/-</p>
	<p><b>Bill Amount: </b>Rs. <?php echo $appropiations['BILL_AMOUNT'];?>/-</p>
	<p><b>Expenditure Including Bill: </b>Rs. <?php echo $appropiations['EXPENDITURE_INC_BILL'];?>/-</p>
	<p><b>Balance: </b>Rs. <?php echo $appropiations['BALANCE'];?>/-</p>
</div>


<h4 style="text-align:center;margin-top: 50px;">(RUPEES NIL ONLY)</h4><br>
<div style="text-align:center; font-weight: bold; width:400px; margin:0 auto;">"Certified that monthly Contribution under Central Government Employees Insurance Scheme has been recovered from persons who are covered under the Scheme"</div>
<div style="font-weight: bold; width:400px; float: right;text-align:center; margin-top:100px;margin-right:-10px;">
	<p>(<?php echo Employee::model()->findByPK($master['DEPT_ADMIN_EMPLOYEE'])->NAME;?>)</p>
	<p><?php echo Designations::model()->findByPK(Employee::model()->findByPK($master['DEPT_ADMIN_EMPLOYEE'])->DESIGNATION_ID_FK)->DESIGNATION;?></p>
	<p><?php echo $master['DEPT_NAME']?></p>
</div>


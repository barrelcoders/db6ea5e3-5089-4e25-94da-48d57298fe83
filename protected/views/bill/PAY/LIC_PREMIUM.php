<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/oneadmin.css" rel="stylesheet">
<script type="text/javascript">window.onload = function() { window.print(); }</script>
<?php 
	$monthName = array('1'=>'January', '2'=>'February', '3'=>'March', '4'=>'April', '5'=>'May', '6'=>'June', '7'=>'July', '8'=>'August', '9'=>'September', '10'=>'October', '11'=>'November', '12'=>'December');
	$monthNameHindi = array('1'=>'जनवरी', '2'=>'फ़रवरी', '3'=>'मार्च', '4'=>'अप्रैल', '5'=>'मई', '6'=>'जून', '7'=>'जुलाई', '8'=>'अगस्त', '9'=>'सितंबर', '10'=>'अक्टूबर', '11'=>'नवंबर', '12'=>'दिसंबर'); 
	$master = Master::model()->findByPK(1); 
?>
<h3 style="text-transform: uppercase;text-align:center;">OFFICE OF THE <?php echo $master->OFFICE_NAME?></h3>
<br>
<h3 style="text-transform: uppercase;text-align: center">LIC PREMIUM RECOVERED FROM THE PAY OF THE OFFICERS /STAFF FOR THE MONTH OF <?php echo $monthName[$model->MONTH]."-".$model->YEAR; ?></h3>
<br>
<p style="text-align: right">BRANCH CODE: 614</p>
<p style="text-align: right">P.A. Code No.: 0533261 </p>
<br>
<table class="one-table small">
	<thead>
		<tr>
			<th>S.No.</th>
			<th>Name of the Officer Shri./Smt.</th>
			<th>Designation</th>
			<th style="text-align: center;">Policy No.</th>
			<th style="text-align: center;">Premium Amount</th>
			<th style="text-align: center;">Total</th>
			<th>Remarks</th>
		</tr>
	</thead>
	<?php 
		$PENSION_TYPE = 'NPS';
		if($model->BILL_TYPE == 1){
			$PENSION_TYPE = 'OPS';
		}
		$i = 1;	
		$employees = Yii::app()->db->createCommand("SELECT ID FROM tbl_employee WHERE PENSION_TYPE='$PENSION_TYPE' ORDER BY DESIGNATION_ID_FK DESC")->queryAll();
		$employeesIds = array();
		foreach($employees as $employee) array_push($employeesIds, $employee['ID']);
		$criteria=new CDbCriteria;
		$criteria->order="FIELD(EMPLOYEE_ID_FK, ".implode( ", ", $employeesIds ).")";
		$criteria->condition = "BILL_ID_FK=$model->ID";
		$criteria->addInCondition('EMPLOYEE_ID_FK', $employeesIds);
		$salaries = SalaryDetails::model()->findAll($criteria);
	?>
	<tbody>
		<?php foreach ($salaries as $salary) { 
			if($salary->LIC > 0){
		?>
		<tr>
			<td><?php echo $i; ?></td>
			<td><b><?php echo Employee::model()->findByPK($salary->EMPLOYEE_ID_FK)->NAME.'<br/>('.Employee::model()->findByPK($salary->EMPLOYEE_ID_FK)->NAME_HINDI.')';?></b></td>
			<td><b><?php echo Designations::model()->findByPK(Employee::model()->findByPK($salary->EMPLOYEE_ID_FK)->DESIGNATION_ID_FK)->DESIGNATION.'<br/>('.Designations::model()->findByPK(Employee::model()->findByPK($salary->EMPLOYEE_ID_FK)->DESIGNATION_ID_FK)->DESIGNATION_HINDI.')';?></b></td>
			<?php $policies = EmployeeLICPolicies::model()->findAll('EMPLOYEE_ID_FK='.$salary->EMPLOYEE_ID_FK.' AND STATUS=1'); ?>
			<td>
				<table>
					<?php 
						$j=1;
						foreach($policies as $policy){ 
							if($j==count($policies)){
								?>
								<tr><td style="border: none;text-align: center;"><?php echo $policy->POLICY_NO; ?></td></tr>
								<?php
							} else {
								?>
								<tr><td style="border: none;border-bottom: 1px solid #000;text-align: center;"><?php echo $policy->POLICY_NO; ?></td></tr>
								<?php
							}
							$j++;
						} 
					?>
				</table>
			</td>
			<td>
				<table>
					<?php 
						$j=1;
						foreach($policies as $policy){ 
							if($j==count($policies)){
								?>
								<tr><td style="border: none;text-align: center;"><?php echo $policy->AMOUNT; ?></td></tr>
								<?php
							} else {
								?>
								<tr><td style="border: none;border-bottom: 1px solid #000;text-align: center;"><?php echo $policy->AMOUNT; ?></td></tr>
								<?php
							}
							$j++;
						} 
					?>
				</table>
			</td>
			<td style="text-align: center">
				<?php echo $salary->LIC; ?>
			</td>
			<td></td>
		</tr>
		<?php 
				$i++;
			}
		}
		?>
	</tbody>
	<tfoot>
		<tr>
			<td colspan="4"></td>
			<td style="text-align: center;"><?php $LIC = Yii::app()->db->createCommand("SELECT SUM(LIC) as LIC FROM tbl_salary_details WHERE BILL_ID_FK = $model->ID;")->queryRow()['LIC']; echo $LIC;?></td>
			<td style="text-align: center;"><?php echo $LIC;?></td>
			<td></td>
		</tr>
	</tfoot>
</table>

<p style="text-align: center; margin-top: 50px;"><b><?php echo $this->amountToWord($LIC);?><b></p>

<div style="font-weight: bold; width:400px; float: right;text-align:center; margin-top:50px;margin-right:-10px;">
	<p><?php echo Employee::model()->findByPK($master['DEPT_ADMIN_EMPLOYEE'])->NAME;?></p>
	<p><?php echo Designations::model()->findByPK(Employee::model()->findByPK($master['DEPT_ADMIN_EMPLOYEE'])->DESIGNATION_ID_FK)->DESIGNATION;?></p>
	<p><?php echo $master['DEPT_NAME']?></p>
</div>
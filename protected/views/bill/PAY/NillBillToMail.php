<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/oneadmin.css" rel="stylesheet">
<script type="text/javascript">window.onload = function() { window.print(); }</script>
<?php $master = Master::model()->findByPK(1); ?>
<table class="pay-schedule-table" style="margin-top:0;">
	<thead>
		<tr>
			<td colspan="1">292251</td>
			<td colspan="3"><?php echo $master->DEPT_NAME ."(".$master->DEPT_NAME_HINDI.")";?></td>
		</tr>
		<tr>
			<th class="small-xxx left-br right-br">S.No.</th>
			<th class="small right-br">Pension A/C No.</th>
			<th class="small right-br">Name</th>
			<th class="small right-br">CPF-Tier.I</th>
		</tr>
	</thead>
	<?php 
		$i = 1;	
		$employees = Yii::app()->db->createCommand("SELECT ID FROM tbl_employee ORDER BY DESIGNATION_ID_FK DESC")->queryAll();
		$employeesIds = array();
		foreach($employees as $employee) array_push($employeesIds, $employee['ID']);
		$criteria=new CDbCriteria;
		$criteria->order="FIELD(EMPLOYEE_ID_FK, ".implode( ", ", $employeesIds ).")";
		$criteria->condition = "BILL_ID_FK=$model->ID";
		$criteria->addInCondition('EMPLOYEE_ID_FK', $employeesIds);
		$salaries = SalaryDetails::model()->findAll($criteria);
	?>
	<tbody>
		<?php foreach ($salaries as $salary) { ?>
		<tr>
			<td class="small-xxx left-br right-br"><?php echo $i; ?></td>
			<td class="small right-br"><b><?php echo Employee::model()->findByPK($salary->EMPLOYEE_ID_FK)->PENSION_ACC_NO;?></b></td>
			<td class="small right-br"><b><?php echo Employee::model()->findByPK($salary->EMPLOYEE_ID_FK)->NAME;?></b></td>
			<td class="small right-br"><b><?php echo $salary->CPF_TIER_I;?></b></td>
		</tr>
		<?php 
			$i++;
		} ?>
	</tbody>
	<tfoot>
		<tr>
			<th class="small-xxx left-br right-br"></th>
			<th class="small right-br"></th>
			<th class="small right-br">Total</th>
			<th class="small right-br">
				<?php 		
					$CPF_TIER_I = Yii::app()->db->createCommand("SELECT SUM(CPF_TIER_I) as CPF_TIER_I FROM tbl_salary_details WHERE BILL_ID_FK = $model->ID AND YEAR = $model->YEAR AND MONTH = $model->MONTH;")->queryRow()['CPF_TIER_I']; 
					echo $CPF_TIER_I;
				?>
			</th>
		</tr>
		<tr>
			<td colspan="4"><?php echo $this->amountToWord($CPF_TIER_I);?></td>
		</tr>
	</tfoot>
</table>

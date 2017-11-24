<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/oneadmin.css" rel="stylesheet">
<?php $master = Master::model()->findByPK(1); ?>
<table class="pay-schedule-table" style="margin-top:0;" id="nillbilltomail">
	<thead>
		<tr>
			<td colspan="4" id="GenerateExcel" style="cursor: pointer;text-align: center;"><?php echo $master->DEPT_NAME ."<br>(".$master->DEPT_NAME_HINDI.")";?></td>
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
				?>
					<tr>
						<td class="small-xxx left-br right-br"><?php echo $i; ?></td>
						<td class="small right-br"><b><?php echo Employee::model()->findByPK($employee->EMPLOYEE_ID_FK)->PENSION_ACC_NO;?></b></td>
						<td class="small right-br"><b><?php echo Employee::model()->findByPK($employee->EMPLOYEE_ID_FK)->NAME;?></b></td>
						<td class="small-xx">
							<?php echo Yii::app()->db->createCommand("SELECT SUM(CPF_TIER_I) as CPF_TIER_I FROM tbl_salary_details WHERE 
							BILL_ID_FK = $model->ID AND EMPLOYEE_ID_FK=".$employee->EMPLOYEE_ID_FK)->queryRow()['CPF_TIER_I']; ?></td>
					</tr>
				<?php
				$i++;
			}
		?>
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
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/lib/jquery/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.table2excel.min"></script>
<script>
	$(document).ready(function() {
		$("#GenerateExcel").click(function(){			
			$("#nillbilltomail").table2excel({
				name: "NPS",
				exclude: ".noExl",
				filename: "CPF CONTRIBUTION",
				fileext: ".xlsx",
				exclude_img: true,
				exclude_links: true,
				exclude_inputs: true
					
					
			});
		});
	});
</script>
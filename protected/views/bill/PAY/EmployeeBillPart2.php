<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/oneadmin.css" rel="stylesheet">
<style>*{font-size: 15px;}.pay-schedule-table tr, .pay-schedule-table th, .pay-schedule-table td {	text-align: center;line-height: 35px;}</style>
<script type="text/javascript">window.onload = function() { window.print(); }</script>
<?php
	$master = Master::model()->findByPK(1);
?>
<h2 style="text-transform: uppercase;text-align:center;"><?php echo $model->BILL_TITLE;?></h2>
<h2 style="text-transform: uppercase;text-align: center">BILL NO: <?php echo $model->BILL_NO; ?></h2>
<table class="pay-schedule-table">
	<thead>
		<tr>
			<th class="small-xxx right-br">S.No.</th>
			<th class="small-xx">CGHS</th>
			<th class="small-xx">LF</th>
			<th class="small-xx">CGEGIS</th>
			<th class="small-xx"><?php echo ($model->BILL_TYPE == 1) ? "GPF<br>Contrib" : "CPF TIER I"?></th>
			<th class="small-xx"><?php echo ($model->BILL_TYPE == 1) ? "GPF<br>Sub" : "CPF TIER II"?></th>
			<th class="small-xx">HBA</th>
			<th class="small-xx">MCA</th>
			<th class="small-xx">FAN</th>
			<th class="small-xx">FLOOD</th>
			<th class="small-xx">FEST</th>
			<th class="small-xx">MISC</th>
			<th class="small-xx">PLI</th>
			<th class="small-xx right-br left-br">DEDUCTION</th>
			<th class="small-xx right-br">NET</th>
			<th class="small-xx">PT</th>
			<th class="small-xx">OTHER DEDUCTION</th>
			<th class="small-xx left-br">AMOUNT CREDIT TO BANK</th>
		</tr>
	</thead>
	<?php 
		$i = 1;	
		$employees = Yii::app()->db->createCommand("SELECT ID FROM db_oneadmin.tbl_employee ORDER BY DESIGNATION_ID_FK DESC")->queryAll();
		$employeesIds = array();
		foreach($employees as $employee) array_push($employeesIds, $employee['ID']);
		$criteria=new CDbCriteria;
		$criteria->order="FIELD(EMPLOYEE_ID_FK, ".implode( ", ", $employeesIds ).")";
		$criteria->condition = "BILL_ID_FK=$model->ID AND YEAR=$model->YEAR AND $model->MONTH";
		$criteria->addInCondition('EMPLOYEE_ID_FK', $employeesIds);
		$salaries = SalaryDetails::model()->findAll($criteria);
	?>
	<tbody>
		<?php foreach ($salaries as $salary) { ?>
		<tr>
			<td class="small-xxx right-br"><?php echo $i; ?></td>
			<td class="small-xx"><b><?php echo $salary->CGHS;?></b></td>
			<td class="small-xx"><b><?php echo $salary->LF;?></b></td>
			<td class="small-xx"><?php echo $salary->CGEGIS; ?></td>
			<td class="small-xx"><?php echo $salary->CPF_TIER_I; ?></td>
			<td class="small-xx"><?php echo $salary->CPF_TIER_II; ?></td>
			<td class="small-xx"><?php echo $salary->HBA_EMI; ?></td>
			<td class="small-xx"><?php echo $salary->MCA_EMI; ?></td>
			<td class="small-xx"><?php echo $salary->FAN_EMI; ?></td>
			<td class="small-xx"><?php echo $salary->FLOOD_EMI; ?></td>
			<td class="small-xx"><?php echo $salary->FEST_EMI; ?></td>
			<td class="small-xx"><?php echo $salary->MISC; ?></td>
			<td class="small-xx"><?php echo $salary->PLI; ?></td>
			<td class="small-xx right-br left-br"><?php echo $salary->DED; ?></td>
			<td class="small-xx right-br"><?php echo $salary->NET; ?></td>
			<td class="small-xx"><?php echo $salary->PT; ?></td>
			<td class="small-xx"><?php echo $salary->OTHER_DED; ?></td>
			<td class="small-xx left-br"><?php echo $salary->AMOUNT_BANK; ?></td>
		</tr>
		<?php 
			$i++;
		} ?>
	</tbody>
	<tfoot>
		<th class="small-xxx right-br"></th>
		<th class="small-xx"><?php echo Yii::app()->db->createCommand("SELECT SUM(CGHS) as CGHS FROM tbl_salary_details WHERE BILL_ID_FK = $model->ID;")->queryRow()['CGHS'];?></th>
		<th class="small-xx"><?php echo Yii::app()->db->createCommand("SELECT SUM(LF) as LF FROM tbl_salary_details WHERE BILL_ID_FK = $model->ID;")->queryRow()['LF'];?></th>
		<th class="small-xx"><?php echo Yii::app()->db->createCommand("SELECT SUM(CGEGIS) as CGEGIS FROM tbl_salary_details WHERE BILL_ID_FK = $model->ID;")->queryRow()['CGEGIS'];?></th>
		<th class="small-xx"><?php echo Yii::app()->db->createCommand("SELECT SUM(CPF_TIER_I) as CPF_TIER_I FROM tbl_salary_details WHERE BILL_ID_FK = $model->ID;")->queryRow()['CPF_TIER_I'];?></th>
		<th class="small-xx"><?php echo Yii::app()->db->createCommand("SELECT SUM(CPF_TIER_II) as CPF_TIER_II FROM tbl_salary_details WHERE BILL_ID_FK = $model->ID;")->queryRow()['CPF_TIER_II'];?></th>
		<th class="small-xx"><?php echo Yii::app()->db->createCommand("SELECT SUM(HBA_EMI) as HBA_EMI FROM tbl_salary_details WHERE BILL_ID_FK = $model->ID;")->queryRow()['HBA_EMI'];?></th>
		<th class="small-xx"><?php echo Yii::app()->db->createCommand("SELECT SUM(MCA_EMI) as MCA_EMI FROM tbl_salary_details WHERE BILL_ID_FK = $model->ID;")->queryRow()['MCA_EMI'];?></th>
		<th class="small-xx"><?php echo Yii::app()->db->createCommand("SELECT SUM(FAN_EMI) as FAN_EMI FROM tbl_salary_details WHERE BILL_ID_FK = $model->ID;")->queryRow()['FAN_EMI'];?></th>
		<th class="small-xx"><?php echo Yii::app()->db->createCommand("SELECT SUM(FLOOD_EMI) as FLOOD_EMI FROM tbl_salary_details WHERE BILL_ID_FK = $model->ID;")->queryRow()['FLOOD_EMI'];?></th>
		<th class="small-xx"><?php echo Yii::app()->db->createCommand("SELECT SUM(FEST_EMI) as FEST_EMI FROM tbl_salary_details WHERE BILL_ID_FK = $model->ID;")->queryRow()['FEST_EMI'];?></th>
		<th class="small-xx"><?php echo Yii::app()->db->createCommand("SELECT SUM(MISC) as MISC FROM tbl_salary_details WHERE BILL_ID_FK = $model->ID;")->queryRow()['MISC'];?></th>
		<th class="small-xx"><?php echo Yii::app()->db->createCommand("SELECT SUM(PLI) as PLI FROM tbl_salary_details WHERE BILL_ID_FK = $model->ID;")->queryRow()['PLI'];?></th>
		<th class="small-xx right-br left-br"><?php echo Yii::app()->db->createCommand("SELECT SUM(DED) as DED FROM tbl_salary_details WHERE BILL_ID_FK = $model->ID;")->queryRow()['DED'];?></th>
		<th class="small-xx right-br"><?php echo Yii::app()->db->createCommand("SELECT SUM(NET) as NET FROM tbl_salary_details WHERE BILL_ID_FK = $model->ID;")->queryRow()['NET'];?></th>
		<th class="small-xx"><?php echo Yii::app()->db->createCommand("SELECT SUM(PT) as PT FROM tbl_salary_details WHERE BILL_ID_FK = $model->ID;")->queryRow()['PT'];?></th>
		<th class="small-xx"><?php echo Yii::app()->db->createCommand("SELECT SUM(OTHER_DED) as OTHER_DED FROM tbl_salary_details WHERE BILL_ID_FK = $model->ID;")->queryRow()['OTHER_DED'];?></th>
		<th class="small-xx left-br"><?php $AMOUNT_BANK = Yii::app()->db->createCommand("SELECT SUM(AMOUNT_BANK) as AMOUNT_BANK FROM tbl_salary_details WHERE BILL_ID_FK = $model->ID;")->queryRow()['AMOUNT_BANK']; echo $AMOUNT_BANK; ?></th>
	</tfoot>
</table>

<h4 style="text-align:center;margin-top: 50px;"><?php echo $this->amountToWord($AMOUNT_BANK);?></h4>
<div style="text-align:center; font-weight: bold; width:400px; margin:0 auto;">"Certified that monthly Contribution under Central Government Employees Insurance Scheme has been recovered from persons who are covered under the Scheme"</div>
<div style="font-weight: bold; width:400px; float: right;text-align:center; margin-top:100px;margin-right:-10px;">
	<p><?php echo Employee::model()->findByPK($master['DEPT_ADMIN_EMPLOYEE'])->NAME;?></p>
	<p><?php echo Designations::model()->findByPK(Employee::model()->findByPK($master['DEPT_ADMIN_EMPLOYEE'])->DESIGNATION_ID_FK)->DESIGNATION;?></p>
	<p><?php echo $master['DEPT_NAME']?></p>
</div>


<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/oneadmin.css" rel="stylesheet">
<style>*{font-size: 15px;}</style>
<script type="text/javascript">window.onload = function() { window.print(); }</script>
<?php
	$master = Master::model()->findByPK(1);
?>
<h2 style="text-transform: uppercase;text-align:center;"><?php echo $model->BILL_TITLE; ?></h2>
<h2 style="text-transform: uppercase;text-align: center">BILL NO: <?php echo $model->BILL_NO; ?></h2>
<table class="pay-schedule-table">
	<thead>
		<tr>
			<th class="small-xxx right-br">S.No.</th>
			<th class="small right-br">NAME</th>
			<th class="small right-br">DESIGNATION</th>
			<th class="small-xx">Pay in PB</th>
			<th class="small-xx">GP</th>
			<th class="small-xx right-br left-br">BASIC</th>
			<th class="small-xx">SP</th>
			<th class="small-xx">PP</th>
			<th class="small-xx">CCA</th>
			<th class="small-xxx">HRA</th>
			<th class="small-xxx">DA</th>
			<th class="small-xxx">TA</th>
			<th class="small-xxx">WA</th>
			<th class="small-xxx right-br left-br">GROSS</th>
			<th class="small-xxx">IT</th>
		</tr>
	</thead>
	<?php 
		$i = 1;	
		$employees = Yii::app()->db->createCommand("SELECT ID FROM tbl_employee ORDER BY DESIGNATION_ID_FK DESC")->queryAll();
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
			<td class="small right-br"><b><?php echo Employee::model()->findByPK($salary->EMPLOYEE_ID_FK)->NAME.'<br/>('.Employee::model()->findByPK($salary->EMPLOYEE_ID_FK)->NAME_HINDI.')';?></b></td>
			<td class="small right-br"><b><?php echo Designations::model()->findByPK(Employee::model()->findByPK($salary->EMPLOYEE_ID_FK)->DESIGNATION_ID_FK)->DESIGNATION.'<br/>('.Designations::model()->findByPK(Employee::model()->findByPK($salary->EMPLOYEE_ID_FK)->DESIGNATION_ID_FK)->DESIGNATION_HINDI.')';?></b></td>
			<td class="small-xx"><?php echo $salary->BASIC; ?></td>
			<td class="small-xx"><?php echo $salary->GP; ?></td>
			<td class="small-xx right-br left-br"><?php echo $salary->BASIC + $salary->GP; ?></td>
			<td class="small-xx"><?php echo $salary->SP; ?></td>
			<td class="small-xx"><?php echo $salary->PP; ?></td>
			<td class="small-xx"><?php echo $salary->CCA; ?></td>
			<td class="small-xxx"><?php echo $salary->HRA; ?></td>
			<td class="small-xxx"><?php echo $salary->DA; ?></td>
			<td class="small-xxx"><?php echo $salary->TA; ?></td>
			<td class="small-xxx"><?php echo $salary->WA; ?></td>
			<td class="small-xxx right-br left-br"><?php echo $salary->GROSS; ?></td>
			<td class="small-xxx"><?php echo $salary->IT; ?></td>
		</tr>
		<?php 
			$i++;
		} ?>
	</tbody>
	<tfoot>
		<th class="small-xxx right-br"></th>
		<th class="small right-br"></th>
		<th class="small right-br"></th>
		<th class="small-xx"><?php $BASIC = Yii::app()->db->createCommand("SELECT SUM(BASIC) as BASIC FROM tbl_salary_details WHERE BILL_ID_FK = $model->ID;")->queryRow()['BASIC'];echo $BASIC;?></th>
		<th class="small-xx"><?php $GP = Yii::app()->db->createCommand("SELECT SUM(GP) as GP FROM tbl_salary_details WHERE BILL_ID_FK = $model->ID;")->queryRow()['GP'];echo $GP;?></th>
		<th class="small-xx right-br left-br"><?php echo $BASIC + $GP;?></th>
		<th class="small-xx"><?php echo Yii::app()->db->createCommand("SELECT SUM(SP) as SP FROM tbl_salary_details WHERE BILL_ID_FK = $model->ID;")->queryRow()['SP'];?></th>
		<th class="small-xx"><?php echo Yii::app()->db->createCommand("SELECT SUM(PP) as PP FROM tbl_salary_details WHERE BILL_ID_FK = $model->ID;")->queryRow()['PP'];?></th>
		<th class="small-xx"><?php echo Yii::app()->db->createCommand("SELECT SUM(CCA) as CCA FROM tbl_salary_details WHERE BILL_ID_FK = $model->ID;")->queryRow()['CCA'];?></th>
		<th class="small-xxx"><?php echo Yii::app()->db->createCommand("SELECT SUM(HRA) as HRA FROM tbl_salary_details WHERE BILL_ID_FK = $model->ID;")->queryRow()['HRA'];?></th>
		<th class="small-xxx"><?php echo Yii::app()->db->createCommand("SELECT SUM(DA) as DA FROM tbl_salary_details WHERE BILL_ID_FK = $model->ID;")->queryRow()['DA'];?></th>
		<th class="small-xxx"><?php echo Yii::app()->db->createCommand("SELECT SUM(TA) as TA FROM tbl_salary_details WHERE BILL_ID_FK = $model->ID;")->queryRow()['TA'];?></th>
		<th class="small-xxx"><?php echo Yii::app()->db->createCommand("SELECT SUM(WA) as WA FROM tbl_salary_details WHERE BILL_ID_FK = $model->ID;")->queryRow()['WA'];?></th>
		<th class="small-xxx right-br left-br"><?php echo Yii::app()->db->createCommand("SELECT SUM(GROSS) as GROSS FROM tbl_salary_details WHERE BILL_ID_FK = $model->ID;")->queryRow()['GROSS'];?></th>
		<th class="small-xxx"><?php echo Yii::app()->db->createCommand("SELECT SUM(IT) as IT FROM tbl_salary_details WHERE BILL_ID_FK = $model->ID;")->queryRow()['IT'];?></th>
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

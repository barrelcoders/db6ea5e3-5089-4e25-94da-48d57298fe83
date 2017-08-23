<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/oneadmin.css" rel="stylesheet">
<style>*{font-size: 15px;}</style>
<script type="text/javascript">window.onload = function() { window.print(); }</script>
<?php
	$master = Master::model()->findByPK(1);
?>
<h2 style="text-transform: uppercase;text-align:center;"><?php echo $model->BILL_TITLE; ?> FOR THE MONTH OF <?php echo date('M-Y', strtotime($model->CREATION_DATE))?></h2>
<h2 style="text-transform: uppercase;text-align: center">BILL NO: <?php echo $model->BILL_NO; ?></h2>
<table class="pay-schedule-table">
	<thead>
		<tr>
			<th class="small-xxx right-br">S.No.</th>
			<th class="small right-br">NAME</th>
			<th class="small right-br">DESIGNATION</th>
			<th class="small-xx">CEA</th>
			<th class="small-xxx right-br left-br">TOTAL</th>
			<th class="small-xxx right-br">AMOUNT TO BANK</th>
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
			<td class="small-xx"><?php echo $salary->CEA; ?></td>
			<td class="small-xxx right-br left-br"><?php echo $salary->GROSS; ?></td>
			<td class="small-xxx right-br"><?php echo $salary->AMOUNT_BANK; ?></td>
		</tr>
		<?php 
			$i++;
		} ?>
	</tbody>
	<tfoot>
		<th class="small-xxx right-br"></th>
		<th class="small right-br"></th>
		<th class="small right-br"></th>
		<th class="small-xx"><?php $BASIC = Yii::app()->db->createCommand("SELECT SUM(CEA) as CEA FROM tbl_salary_details WHERE BILL_ID_FK = $model->ID AND YEAR = $model->YEAR AND MONTH = $model->MONTH;")->queryRow()['CEA'];echo $BASIC;?></th>
		<th class="small-xxx right-br left-br"><?php echo Yii::app()->db->createCommand("SELECT SUM(GROSS) as GROSS FROM tbl_salary_details WHERE BILL_ID_FK = $model->ID AND YEAR = $model->YEAR AND MONTH = $model->MONTH;")->queryRow()['GROSS'];?></th>
		<th class="small-xxx right-br"><?php $AMOUNT_BANK = Yii::app()->db->createCommand("SELECT SUM(AMOUNT_BANK) as AMOUNT_BANK FROM tbl_salary_details WHERE BILL_ID_FK = $model->ID AND YEAR = $model->YEAR AND MONTH = $model->MONTH;")->queryRow()['AMOUNT_BANK']; echo $AMOUNT_BANK;?></th>
	</tfoot>
</table>
<h4 style="text-align:center;margin-top: 50px;"><?php echo $this->amountToWord($AMOUNT_BANK);?></h4>
<div style="text-align:center;margin-top: 20px;">
	<p>Certified that the amount claimed in this</p>
	<p>Bill has not been drawn and paid previously</p>
</div>
<!--
<div style="width: 400px; margin: 0 auto; font-size: 20px; margin-top:100px;float: left;margin-left: 100px;">
	<?php $appropiations = Yii::app()->db->createCommand("SELECT * FROM tbl_appropiation_register WHERE BILL_NO = $model->ID")->queryRow(); ?>
	<h4 style="text-decoration: underline;">Appropiation</h4>
	<p><b>Budget: </b>Rs. <?php echo Budget::model()->findByPK($appropiations['BUDGET_ID'])->AMOUNT;?>/-</p>
	<p><b>Bill Amount: </b>Rs. <?php echo $appropiations['BILL_AMOUNT'];?>/-</p>
	<p><b>Expenditure Including Bill: </b>Rs. <?php echo $appropiations['EXPENDITURE_INC_BILL'];?>/-</p>
	<p><b>Balance: </b>Rs. <?php echo $appropiations['BALANCE'];?>/-</p>
</div>-->
<div style="margin-top: 100px;float: left;margin-right: 100px;">
	<p>Enclousre</p>
	<p>1. Original Claim</p>
	<p>2. Sanction Order</p>
	<p>2. Mandate Form</p>
	<p>4. Worksheet</p>
</div>
<div style="font-weight: bold; width:400px; float: right;text-align:center; margin-top:250px;margin-right:-10px;">
	<p>(<?php echo Employee::model()->findByPK($master['DEPT_ADMIN_EMPLOYEE'])->NAME;?>)</p>
	<p><?php echo Designations::model()->findByPK(Employee::model()->findByPK($master['DEPT_ADMIN_EMPLOYEE'])->DESIGNATION_ID_FK)->DESIGNATION;?></p>
	<p><?php echo $master['DEPT_NAME']?></p>
</div>

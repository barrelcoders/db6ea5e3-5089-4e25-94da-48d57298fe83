<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/oneadmin.css" rel="stylesheet">
<script type="text/javascript">window.onload = function() { window.print(); }</script>
<style>*{font-size: 19px;}</style>
<?php
	$master = Master::model()->findByPK(1);
?>
<br>
<h2 style="text-transform: uppercase;text-align:center;font-weight: bold;"><?php echo $model->BILL_TITLE; ?> FOR THE MONTH OF <?php echo date('M-Y', strtotime($model->CREATION_DATE))?></h2>
<br><h2 style="text-transform: uppercase;text-align:center;font-weight: bold;">AS PER DEPARTMENT OF EXPENDITURE OM Dt. 30.03.2017</h2>
<br><h2 style="text-transform: uppercase;text-align: center;font-weight: bold;">BILL NO: <?php echo $model->BILL_NO; ?></h2>
<table class="pay-schedule-table">
	<thead>
		<tr>
			<th class="small-xxx right-br">S.No.</th>
			<th class="small right-br">NAME</th>
			<th class="small right-br">DESIGNATION</th>
			<th class="small right-br">PERIOD</th>
			<th class="small right-br">BASIC</th>
			<th class="small right-br">GP</th>
			<th class="small right-br">TOTAL</th>
			<th class="small-xx right-br">DUE DA (4%)</th>
			<th class="small-xx right-br">DRAWN DA (2%)</th>
			<th class="small-xx right-br">DIFF DA</th>
			<th class="small-xx right-br">TOTAL <br/> DIFF DA</th>
			<th class="small-xx right-br">TA at<br/> DA 4 %</th>
			<th class="small-xx right-br">TA at<br/> DA 2 %</th>
			<th class="small-xx right-br">DIFF <br/> TA </th>
			<th class="small-xx right-br">TOTAL <br/> DIFF TA</th>
			<?php if($model->BILL_TYPE == 2){ ?>
				<th class="small-xx right-br">CPF at<br/> DA 4 %</th>
				<th class="small-xx right-br">CPF at<br/> DA 2 %</th>
				<th class="small-xx right-br">DIFF <br/> CPF </th>
				<th class="small-xx right-br">TOTAL <br/> DIFF CPF </th>
				<th class="small-xx right-br">NET AMT<br/> PAYABLE</th>
			<?php } ?>
			<?php if($model->BILL_TYPE == 1){ ?>
				<th class="small-xx right-br">NET AMT<br/> PAYABLE</th>
			<?php } ?>
			
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
			<td rowspan="3" class="small-xxx right-br"><?php echo $i; ?></td>
			<td rowspan="3" class="small right-br"><b><?php echo Employee::model()->findByPK($salary->EMPLOYEE_ID_FK)->NAME.'<br/>('.Employee::model()->findByPK($salary->EMPLOYEE_ID_FK)->NAME_HINDI.')';?></b></td>
			<td rowspan="3" class="small right-br"><b><?php echo Designations::model()->findByPK(Employee::model()->findByPK($salary->EMPLOYEE_ID_FK)->DESIGNATION_ID_FK)->DESIGNATION.'<br/>('.Designations::model()->findByPK(Employee::model()->findByPK($salary->EMPLOYEE_ID_FK)->DESIGNATION_ID_FK)->DESIGNATION_HINDI.')';?></b></td>
			<td class="small-xx right-br">Jan-17</td>
			<td class="small-xx right-br"><?php echo ($salary->DA/3)*50; ?></td>
			<td class="small-xx right-br">0</td>
			<td class="small-xx right-br"><?php echo ($salary->DA/3)*50; ?></td>
			<td class="small-xx right-br"><?php echo ($salary->DA/3)*2; ?></td>
			<td class="small-xx right-br"><?php echo ($salary->DA/3); ?></td>
			<td class="small-xx right-br"><?php echo ($salary->DA/3); ?></td>
			<td rowspan="3" class="small-xx right-br"><?php echo $salary->DA; ?></td>
			<td class="small-xx right-br"></td>
			<td class="small-xx right-br"></td>
			<td class="small-xx right-br"0></td>
			<td rowspan="3" class="small-xx right-br">0</td>
			<?php if($model->BILL_TYPE == 2){ ?>
				<td class="small-xx right-br"><?php echo ((($salary->DA/3)*50)+(($salary->DA/3)*2))*0.1; ?></td>
				<td class="small-xx right-br"><?php echo ((($salary->DA/3)*50)+(($salary->DA/3)))*0.1; ?></td>
				<td class="small-xx right-br"><?php echo round((((($salary->DA/3)*50)+(($salary->DA/3)*2))*0.1) - (((($salary->DA/3)*50)+(($salary->DA/3)))*0.1),1); ?></td>
				<td rowspan="3" class="small-xx right-br"><?php echo $salary->CPF_TIER_I; ?></td>
				<td rowspan="3" class="small-xx right-br"><?php echo $salary->AMOUNT_BANK; ?></td>
			<?php } ?>
			<?php if($model->BILL_TYPE == 1){ ?>
				<td rowspan="3" class="small-xx right-br"><?php echo $salary->DA; ?></td>
			<?php } ?>
		</tr>
		<tr>
			<td class="small-xx right-br">Feb-17</td>
			<td class="small-xx right-br"><?php echo ($salary->DA/3)*50; ?></td>
			<td class="small-xx right-br">0</td>
			<td class="small-xx right-br"><?php echo ($salary->DA/3)*50; ?></td>
			<td class="small-xx right-br"><?php echo ($salary->DA/3)*2; ?></td>
			<td class="small-xx right-br"><?php echo ($salary->DA/3); ?></td>
			<td class="small-xx right-br"><?php echo ($salary->DA/3); ?></td>
			<td class="small-xx right-br"></td>
			<td class="small-xx right-br"></td>
			<td class="small-xx right-br">0</td>
			<?php if($model->BILL_TYPE == 2){ ?>
				<td class="small-xx right-br"><?php echo ((($salary->DA/3)*50)+(($salary->DA/3)*2))*0.1; ?></td>
				<td class="small-xx right-br"><?php echo ((($salary->DA/3)*50)+(($salary->DA/3)))*0.1; ?></td>
				<td class="small-xx right-br"><?php echo round((((($salary->DA/3)*50)+(($salary->DA/3)*2))*0.1) - (((($salary->DA/3)*50)+(($salary->DA/3)))*0.1),1); ?></td>
			<?php } ?>
		</tr>
		<tr>
			<td class="small-xx right-br">Mar-17</td>
			<td class="small-xx right-br"><?php echo ($salary->DA/3)*50; ?></td>
			<td class="small-xx right-br">0</td>
			<td class="small-xx right-br"><?php echo ($salary->DA/3)*50; ?></td>
			<td class="small-xx right-br"><?php echo ($salary->DA/3)*2; ?></td>
			<td class="small-xx right-br"><?php echo ($salary->DA/3); ?></td>
			<td class="small-xx right-br"><?php echo ($salary->DA/3); ?></td>
			<td class="small-xx right-br"></td>
			<td class="small-xx right-br"></td>
			<td class="small-xx right-br">0</td>
			<?php if($model->BILL_TYPE == 2){ ?>
				<td class="small-xx right-br"><?php echo ((($salary->DA/3)*50)+(($salary->DA/3)*2))*0.1; ?></td>
				<td class="small-xx right-br"><?php echo ((($salary->DA/3)*50)+(($salary->DA/3)))*0.1; ?></td>
				<td class="small-xx right-br"><?php echo round((((($salary->DA/3)*50)+(($salary->DA/3)*2))*0.1) - (((($salary->DA/3)*50)+(($salary->DA/3)))*0.1),1); ?></td>
			<?php } ?>
		</tr>
		<?php 
			$i++;
		} ?>
	</tbody>
	<tfoot>
		<th class="small-xxx right-br"></th>
		<th class="small right-br"></th>
		<th class="small right-br"></th>
		<th class="small-xx"></th>
		<th class="small-xx"></th>
		<th class="small-xx"></th>
		<th class="small-xx"></th>
		<th class="small-xx"></th>
		<th class="small-xx"></th>
		<th class="small-xx"></th>
		<?php if($model->BILL_TYPE == 2){ ?>
			<th class="small-xx"></th>
			<th class="small-xx"></th>
			<th class="small-xx"></th>
			<th class="small-xx"></th>
			<th class="small-xx"></th>
			<th class="small-xx"></th>
			<th class="small-xx"></th>
			<th class="small-xx"></th>
			<td class="small-xx right-br"><?php $CPF_TIER_I = Yii::app()->db->createCommand("SELECT SUM(CPF_TIER_I) as CPF_TIER_I FROM tbl_salary_details WHERE BILL_ID_FK = $model->ID AND YEAR = $model->YEAR AND MONTH = $model->MONTH;")->queryRow()['CPF_TIER_I'];echo $CPF_TIER_I;?></td>
			<th class="small-xx"><?php $AMOUNT_BANK = Yii::app()->db->createCommand("SELECT SUM(AMOUNT_BANK) as AMOUNT_BANK FROM tbl_salary_details WHERE BILL_ID_FK = $model->ID AND YEAR = $model->YEAR AND MONTH = $model->MONTH;")->queryRow()['AMOUNT_BANK'];echo $AMOUNT_BANK;?></th>
		<?php } ?>
		<?php if($model->BILL_TYPE == 1){ ?>
		<th class="small-xx"></th>
		<th class="small-xx"></th>
		<th class="small-xx"></th>
		<th class="small-xx"></th>
		<th class="small-xx"></th>
		<th class="small-xx"><?php $AMOUNT_BANK = Yii::app()->db->createCommand("SELECT SUM(AMOUNT_BANK) as AMOUNT_BANK FROM tbl_salary_details WHERE BILL_ID_FK = $model->ID AND YEAR = $model->YEAR AND MONTH = $model->MONTH;")->queryRow()['AMOUNT_BANK'];echo $AMOUNT_BANK;?></th>
		<?php } ?>
	</tfoot>
</table>

<div style="width: 400px; margin: 0 auto; font-size: 20px; margin-top:50px;">
	<?php $appropiations = Yii::app()->db->createCommand("SELECT * FROM tbl_appropiation_register WHERE BILL_NO = $model->ID")->queryRow(); ?>
	<h4 style="text-decoration: underline;">Appropiation</h4>
	<p><b>Budget: </b>Rs. <?php echo Budget::model()->findByPK($appropiations['BUDGET_ID'])->AMOUNT;?>/-</p>
	<p><b>Bill Amount: </b>Rs. <?php echo $appropiations['BILL_AMOUNT'];?>/-</p>
	<p><b>Expenditure Including Bill: </b>Rs. <?php echo $appropiations['EXPENDITURE_INC_BILL'];?>/-</p>
	<p><b>Balance: </b>Rs. <?php echo $appropiations['BALANCE'];?>/-</p>
</div>

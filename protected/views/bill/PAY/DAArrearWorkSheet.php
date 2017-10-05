<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/oneadmin.css" rel="stylesheet">
<script type="text/javascript">window.onload = function() { window.print(); }</script>
<style>*{font-size: 19px;}</style>
<?php
	$master = Master::model()->findByPK(1);
	$periods = $this->getBillPeriods($model->ID);
	$total_months = count($periods);
?>
<br>
<h2 style="text-transform: uppercase;text-align:center;font-weight: bold;"><?php echo $model->BILL_TITLE; ?> FOR THE MONTH OF <?php echo date('M-Y', strtotime($model->CREATION_DATE))?></h2>
<br><h2 style="text-transform: uppercase;text-align: center;font-weight: bold;">BILL NO: <?php echo $model->BILL_NO; ?></h2>
<table class="pay-schedule-table">
	<thead>
		<tr>
			<th class="small-xxx right-br">S.No.</th>
			<th class="small right-br">NAME</th>
			<th class="small right-br">DESIGNATION</th>
			<?php if($model->IS_MULTIPLE_MONTH) {?>
			<th class="small-xx right-br">PERIOD</th>
			<?php } ?>
			<th class="small right-br">BASIC</th>
			<th class="small-xx right-br">DUE DA (5%)</th>
			<th class="small-xx right-br">DRAWN DA (4%)</th>
			<th class="small-xx right-br">DIFF DA</th>
			<th class="small-xx right-br">TOTAL <br/> DIFF DA</th>
			<th class="small-xx right-br">TA at<br/> DA 5 %</th>
			<th class="small-xx right-br">TA at<br/> DA 4 %</th>
			<th class="small-xx right-br">DIFF <br/> TA </th>
			<th class="small-xx right-br">TOTAL <br/> DIFF TA</th>
			<?php if($model->BILL_TYPE == 2){ ?>
				<th class="small-xx right-br">CPF at<br/> DA 5 %</th>
				<th class="small-xx right-br">CPF at<br/> DA 4 %</th>
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

		$criteria = new CDbCriteria();
		$criteria->select = 't.EMPLOYEE_ID_FK';
		$criteria->condition = 't.BILL_ID_FK='.$model->ID;
		$criteria->group = 't.EMPLOYEE_ID_FK';
		$criteria->join='INNER JOIN tbl_employee e ON e.ID = t.EMPLOYEE_ID_FK';
		$criteria->order = 'e.DESIGNATION_ID_FK DESC';
		$employeesInSalary = SalaryDetails::model()->findAll($criteria);
	?>
	<tbody>
		<?php foreach ($employeesInSalary as $employee) {
				$j=1;
				foreach($periods as $period){
					$salary = SalaryDetails::model()->find("t.EMPLOYEE_ID_FK=".$employee->EMPLOYEE_ID_FK." AND t.BILL_ID_FK=".$model->ID." AND t.MONTH=".$period['MONTH']." AND t.YEAR=".$period['YEAR']);
					if($model->IS_MULTIPLE_MONTH) { 
						if($j==1){ ?>
							<tr>
								<td rowspan="<?php echo $total_months;?>" class="small-xxx left-br right-br"><?php echo $i; ?></td>
								<td rowspan="<?php echo $total_months;?>" class="small-x right-br"><b><?php echo Employee::model()->findByPK($salary->EMPLOYEE_ID_FK)->NAME.'<br/>('.Employee::model()->findByPK($salary->EMPLOYEE_ID_FK)->NAME_HINDI.')';?></b></td>
								<td rowspan="<?php echo $total_months;?>" class="small-x right-br"><b><?php echo Designations::model()->findByPK(Employee::model()->findByPK($salary->EMPLOYEE_ID_FK)->DESIGNATION_ID_FK)->DESIGNATION.'<br/>('.Designations::model()->findByPK(Employee::model()->findByPK($salary->EMPLOYEE_ID_FK)->DESIGNATION_ID_FK)->DESIGNATION_HINDI.')';?></b></td>
								<td class="small-xx right-br"><?php echo $period['FORMAT']; ?></td>
								<td class="small-xx right-br"><?php $BASIC = Yii::app()->db->createCommand("SELECT BASIC as BASIC FROM tbl_salary_details WHERE IS_SALARY_BILL=1 AND YEAR=".$period['YEAR']." AND MONTH=".$period['MONTH'].";")->queryRow()['BASIC']; echo $BASIC;?></td>
								<td class="small-xx right-br"><?php $DUE_DA = round($BASIC*0.05); echo $DUE_DA; ?></td>
								<td class="small-xx right-br"><?php $DRAWN_DA = Yii::app()->db->createCommand("SELECT DA as DA FROM tbl_salary_details WHERE IS_SALARY_BILL=1 AND YEAR=".$period['YEAR']." AND MONTH=".$period['MONTH'].";")->queryRow()['DA']; echo $DRAWN_DA; ?></td>
								<td class="small-xx right-br"><?php $DA_DIFF = ($DUE_DA - $DRAWN_DA); echo $DA_DIFF; ?></td>
								<td class="small-xx right-br"></td>
								<td class="small-xx right-br"><?php $DUE_TA = Yii::app()->db->createCommand("SELECT TA as TA FROM tbl_salary_details WHERE IS_SALARY_BILL=1 AND YEAR=".$period['YEAR']." AND MONTH=".$period['MONTH'].";")->queryRow()['TA']; echo $DUE_TA; ?></td>
								<td class="small-xx right-br"><?php $DRAWN_TA = Yii::app()->db->createCommand("SELECT TA as TA FROM tbl_salary_details WHERE IS_SALARY_BILL=1 AND YEAR=".$period['YEAR']." AND MONTH=".$period['MONTH'].";")->queryRow()['TA']; echo $DRAWN_TA; ?></td>
								<td class="small-xx right-br"><?php $TA_DIFF = ($DUE_TA - $DRAWN_TA); echo $TA_DIFF;; ?></td>
								<td class="small-xx right-br"></td>
								<?php if($model->BILL_TYPE == 2){ ?>
									<td class="small-xx right-br"><?php $CPF_DUE = round(($BASIC + $DUE_DA) * 0.1); echo $CPF_DUE; ?></td>
									<td class="small-xx right-br"><?php $CPF_DRAWN = round(($BASIC + $DRAWN_DA) * 0.1); echo $CPF_DRAWN;  ?></td>
									<td class="small-xx right-br"><?php $CPF_DIFF = ($CPF_DUE - $CPF_DRAWN); echo $CPF_DIFF;?></td>
									<td class="small-xx right-br"></td>
									<td class="small-xx right-br"><?php echo ($DA_DIFF - $CPF_DIFF)?></td>
								<?php } ?>
								<?php if($model->BILL_TYPE == 1){ ?>
									<td class="small-xx right-br"><?php echo $DA_DIFF?></td>
								<?php } ?>
							</tr>
						<?php } else { ?>
							<tr>
								<td class="small-xx right-br"><?php echo $period['FORMAT']; ?></td>
								<td class="small-xx right-br"><?php $BASIC = Yii::app()->db->createCommand("SELECT BASIC as BASIC FROM tbl_salary_details WHERE IS_SALARY_BILL=1 AND YEAR=".$period['YEAR']." AND MONTH=".$period['MONTH'].";")->queryRow()['BASIC']; echo $BASIC;?></td>
								<td class="small-xx right-br"><?php $DUE_DA = round($BASIC*0.05); echo $DUE_DA; ?></td>
								<td class="small-xx right-br"><?php $DRAWN_DA = Yii::app()->db->createCommand("SELECT DA as DA FROM tbl_salary_details WHERE IS_SALARY_BILL=1 AND YEAR=".$period['YEAR']." AND MONTH=".$period['MONTH'].";")->queryRow()['DA']; echo $DRAWN_DA; ?></td>
								<td class="small-xx right-br"><?php $DA_DIFF = ($DUE_DA - $DRAWN_DA); echo $DA_DIFF; ?></td>
								<td class="small-xx right-br"></td>
								<td class="small-xx right-br"><?php $DUE_TA = Yii::app()->db->createCommand("SELECT TA as TA FROM tbl_salary_details WHERE IS_SALARY_BILL=1 AND YEAR=".$period['YEAR']." AND MONTH=".$period['MONTH'].";")->queryRow()['TA']; echo $DUE_TA; ?></td>
								<td class="small-xx right-br"><?php $DRAWN_TA = Yii::app()->db->createCommand("SELECT TA as TA FROM tbl_salary_details WHERE IS_SALARY_BILL=1 AND YEAR=".$period['YEAR']." AND MONTH=".$period['MONTH'].";")->queryRow()['TA']; echo $DRAWN_TA; ?></td>
								<td class="small-xx right-br"><?php $TA_DIFF = ($DUE_TA - $DRAWN_TA); echo $TA_DIFF;; ?></td>
								<td class="small-xx right-br"></td>
								<?php if($model->BILL_TYPE == 2){ ?>
									<td class="small-xx right-br"><?php $CPF_DUE = round(($BASIC + $DUE_DA) * 0.1); echo $CPF_DUE; ?></td>
									<td class="small-xx right-br"><?php $CPF_DRAWN = round(($BASIC + $DRAWN_DA) * 0.1); echo $CPF_DRAWN;  ?></td>
									<td class="small-xx right-br"><?php $CPF_DIFF = ($CPF_DUE - $CPF_DRAWN); echo $CPF_DIFF;?></td>
									<td class="small-xx right-br"></td>
									<td class="small-xx right-br"><?php echo ($DA_DIFF - $CPF_DIFF)?></td>
								<?php } ?>
								<?php if($model->BILL_TYPE == 1){ ?>
									<td class="small-xx right-br"><?php echo $DA_DIFF?></td>
								<?php } ?>
							</tr>
							<?php
						}
						$j++;
					}?>
			<?php } ?>
		<?php  $i++; 
		} ?>
	</tbody>
</table>

<div style="width: 400px; margin: 0 auto; font-size: 20px; margin-top:50px;">
	<?php $appropiations = Yii::app()->db->createCommand("SELECT * FROM tbl_appropiation_register WHERE BILL_NO = $model->ID")->queryRow(); ?>
	<h4 style="text-decoration: underline;">Appropiation</h4>
	<p><b>Budget: </b>Rs. <?php echo Budget::model()->findByPK($appropiations['BUDGET_ID'])->AMOUNT;?>/-</p>
	<p><b>Bill Amount: </b>Rs. <?php echo $appropiations['BILL_AMOUNT'];?>/-</p>
	<p><b>Expenditure Including Bill: </b>Rs. <?php echo $appropiations['EXPENDITURE_INC_BILL'];?>/-</p>
	<p><b>Balance: </b>Rs. <?php echo $appropiations['BALANCE'];?>/-</p>
</div>

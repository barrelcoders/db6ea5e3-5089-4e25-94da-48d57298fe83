<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/oneadmin.css" rel="stylesheet">
<script type="text/javascript">window.onload = function() { window.print(); }</script>
<?php $master = Master::model()->findByPK(1); ?>
<br>
<div style="margin-left: 150px;">
	<div style="height: 100%;border-left-width: 4px;padding: 10px;margin-top: -15px;border-left-style: double;border-color: #F00;">
		<p>In terms of provisions contained in the Ministry’s Order F No. A-26017/22/2008-Ad II A(pt) dated 28.09.10, the Dress Allowance 
		(Annual Replacement Allowance) in respect of following officers of
		<?php echo $master->DEPT_NAME;?> is to be drawn for the year <?php echo $model->UA_PERIOD; ?> as mentioned below :-</p>
		<br><br>
		<table class="one-table">
			<thead>
				<tr>
					<th class="small-xxx right-br">S.No.</th>
					<th class="small right-br">NAME</th>
					<th class="small right-br">DESIGNATION</th>
					<th class="small-xx">Dress Allowance</th>
					<th class="small-xx">DEDUCTION</th>
					<th class="small-xx left-br">AMOUNT CREDIT TO BANK</th>
				</tr>
			</thead>
			<?php 
				$i = 1;	
				$employees = Yii::app()->db->createCommand("SELECT ID FROM tbl_employee ORDER BY FOLIO_NO ASC")->queryAll();
				$employeesIds = array();
				foreach($employees as $employee) array_push($employeesIds, $employee['ID']);
				$criteria=new CDbCriteria;
				$criteria->order="FIELD(EMPLOYEE_ID_FK, ".implode( ", ", $employeesIds ).")";
				$criteria->condition = "BILL_ID_FK=$model->ID AND YEAR=$model->YEAR AND $model->MONTH";
				$criteria->addInCondition('EMPLOYEE_ID_FK', $employeesIds);
				$salaries = SalaryDetails::model()->findAll($criteria);
				$intialEquipmentAllowance = array();
				$annualDressAllowance = array();
				foreach($salaries as $salary){
					if($salary->UA == 4500){
						array_push($intialEquipmentAllowance, $salary);
					}
					else{
						array_push($annualDressAllowance, $salary);
					}
				}
			?>
			<tbody>
				<tr><td colspan="6" style="text-align: center">Annual Dress Allowance</td></tr>
				<?php foreach ($annualDressAllowance as $salary) { ?>
				<tr>
					<td class="small-xxx right-br" style="text-align: center"><?php echo $i; ?></td>
					<td class="small right-br" style="text-align: center;"><b><?php echo Employee::model()->findByPK($salary->EMPLOYEE_ID_FK)->NAME.'<br/>('.Employee::model()->findByPK($salary->EMPLOYEE_ID_FK)->NAME_HINDI.')';?></b></td>
					<td class="small right-br" style="text-align: center;"><b><?php echo Designations::model()->findByPK(Employee::model()->findByPK($salary->EMPLOYEE_ID_FK)->DESIGNATION_ID_FK)->DESIGNATION.'<br/>('.Designations::model()->findByPK(Employee::model()->findByPK($salary->EMPLOYEE_ID_FK)->DESIGNATION_ID_FK)->DESIGNATION_HINDI.')';?></b></td>
					<td class="small-xx" style="text-align: center"><?php echo $salary->UA; ?></td>
					<td class="small-xx" style="text-align: center">0</td>
					<td class="small-xx left-br" style="text-align: center"><?php echo $salary->AMOUNT_BANK; ?></td>
				</tr>
				<?php 
					$i++;
				} ?>
				<?php if(count($intialEquipmentAllowance) > 0){ ?>
				<tr><td colspan="6" style="text-align: center">Initial Equipment Allowance</td></tr>
				<?php } ?>
				<?php foreach ($intialEquipmentAllowance as $salary) { ?>
				<tr>
					<td class="small-xxx right-br" style="text-align: center"><?php echo $i; ?></td>
					<td class="small right-br" style="text-align: center;"><b><?php echo Employee::model()->findByPK($salary->EMPLOYEE_ID_FK)->NAME.')';?></b></td>
					<td class="small right-br" style="text-align: center;"><b><?php echo Designations::model()->findByPK(Employee::model()->findByPK($salary->EMPLOYEE_ID_FK)->DESIGNATION_ID_FK)->DESIGNATION.')';?></b></td>
					<td class="small-xx" style="text-align: center"><?php echo $salary->UA; ?></td>
					<td class="small-xx" style="text-align: center">0</td>
					<td class="small-xx left-br" style="text-align: center"><?php echo $salary->AMOUNT_BANK; ?></td>
				</tr>
				<?php 
					$i++;
				} ?>
			</tbody>
			<tfoot>
				<th class="small-xxx right-br"></th>
				<th class="small right-br"></th>
				<th class="small right-br"></th>
				<th class="small-xx"><?php $UA = Yii::app()->db->createCommand("SELECT SUM(UA) as UA FROM tbl_salary_details WHERE BILL_ID_FK = $model->ID AND YEAR = $model->YEAR AND MONTH = $model->MONTH;")->queryRow()['UA'];echo $UA;?></th>
				<th class="small-xx">0</th>
				<th class="small-xxx"><?php $AMOUNT_BANK = Yii::app()->db->createCommand("SELECT SUM(AMOUNT_BANK) as AMOUNT_BANK FROM tbl_salary_details WHERE BILL_ID_FK = $model->ID AND YEAR = $model->YEAR AND MONTH = $model->MONTH;")->queryRow()['AMOUNT_BANK']; echo $AMOUNT_BANK;?></th>
			</tfoot>
		</table>
		<br>
		<p>The Joint Commissioner (P&V) being the sanctioning authority may like to accord sanction for 
		drawl & disbursement of Rs.<?php echo $AMOUNT_BANK;?> <?php echo $this->amountToWord($AMOUNT_BANK);?> 
		towards the Dress Allowance for the period <?php echo $model->UA_PERIOD; ?> to the above mentioned officers. </p><br><br><br>
		<div style="margin-top:100px;">
			<span style="display:inline-block;float:left;">Tax Assistant</span>
			<span style="display:inline-block;margin:0 auto;position: absolute;left: 50%;margin-left: -100px;">Chief Accounts Officer</span>
			<span style="display:inline-block;float:right;">Joint Commissioner</span>
		</div>
	</div>
<div>
<style>
body{background: #f1ffdb;}
div.line()
</style>
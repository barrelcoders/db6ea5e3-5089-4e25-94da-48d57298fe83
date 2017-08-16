<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/oneadmin.css" rel="stylesheet">
<script type="text/javascript">window.onload = function() { window.print(); }</script>
<?php $master = Master::model()->findByPK(1); ?>
<br>
<div class="one-header">
	<img src='images/logo.jpg'/>	
	<div>
		<p>भारत सरकार । वित्त मंत्रालय । राजस्व विभाग । </p>
		<p>Government of India | Ministry of Finance | Department of Revenue</p>
		<p><?php echo $master->OFFICE_NAME_HINDI;?></p>
		<p><?php echo $master->OFFICE_NAME;?></p>
		<p><?php echo $master->OFFICE_ADDRESS_HINDI;?></p>
		<p><?php echo $master->OFFICE_ADDRESS;?></p>
	</div>
</div>
<div style="clear:both; height: 20px;position: relative; font-weight: bold;">
	<span class="left"><b>सी.सं./File No.<?php echo $model->FILE_NO;?></b></span>
	<span style="position: absolute;left: 50%;margin-left: -50px; font-weight: bold;"><b><?php echo $model->CER_NO;?></b></span>
	<span style="position: absolute; right: 0;"><b>दिनांक/Date: <?php echo date('d/m/Y', strtotime($model->CREATION_DATE));?></b></span>
</div>
<br>
<div style="text-align: center;">
	<h4><b>मंजुरी आदेश./SANCTION ORDER</b></h4>
</div><br>
<p>In terms of provisions contained in the Ministry’s Order F No. A-26017/22/2008-Ad II A(pt) dated 28.09.10, the following officers of <?php echo $master->DEPT_NAME;?> have submitted the uniform allowance certificate for drawl of Annual replacement allowance and request for payment of Initial Equipment Allowance. is to be drawn for the year <?php echo $model->UA_PERIOD; ?> as detailed below :-</p>
<br><br>
<table class="one-table">
	<thead>
		<tr>
			<th class="small-xxx right-br">S.No.</th>
			<th class="small right-br">NAME</th>
			<th class="small right-br">DESIGNATION</th>
			<th class="small-xx">Uniform Allowance</th>
			<th class="small-xx">DEDUCTION</th>
			<th class="small-xx left-br">AMOUNT CREDIT TO BANK</th>
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
		$intialEquipmentAllowance = array();
		$annualuniformAllowance = array();
		foreach($salaries as $salary){
			if($salary->UA == 4500){
				array_push($intialEquipmentAllowance, $salary);
			}
			else{
				array_push($annualuniformAllowance, $salary);
			}
		}
	?>
	<tbody>
		<tr><td colspan="6" style="text-align: center">Annual Uniform Allowance</td></tr>
		<?php foreach ($annualuniformAllowance as $salary) { ?>
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
			<td class="small right-br" style="text-align: center;"><b><?php echo Employee::model()->findByPK($salary->EMPLOYEE_ID_FK)->NAME.'<br/>('.Employee::model()->findByPK($salary->EMPLOYEE_ID_FK)->NAME_HINDI.')';?></b></td>
			<td class="small right-br" style="text-align: center;"><b><?php echo Designations::model()->findByPK(Employee::model()->findByPK($salary->EMPLOYEE_ID_FK)->DESIGNATION_ID_FK)->DESIGNATION.'<br/>('.Designations::model()->findByPK(Employee::model()->findByPK($salary->EMPLOYEE_ID_FK)->DESIGNATION_ID_FK)->DESIGNATION_HINDI.')';?></b></td>
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
<p style="text-align: center;"><?php echo $this->amountToWord($AMOUNT_BANK);?></p>
<br>
<p>The above expenditure is to be debited under head ‘SALARIES’ for the Financial Year-<?php echo FinancialYears::model()->find('STATUS=1')->NAME;?>.</p>
<div style="font-weight: bold; width:400px; float: right;text-align:center; margin-top:100px;margin-right:-10px;">
	<p>(<?php echo Employee::model()->findByPK($master['DEPT_ADMIN_EMPLOYEE'])->NAME;?>)</p>
	<p><?php echo Designations::model()->findByPK(Employee::model()->findByPK($master['DEPT_ADMIN_EMPLOYEE'])->DESIGNATION_ID_FK)->DESIGNATION;?></p>
	<p><?php echo $master['DEPT_NAME']?></p>
</div>

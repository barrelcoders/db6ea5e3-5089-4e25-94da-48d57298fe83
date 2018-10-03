<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/oneadmin.css" rel="stylesheet">
<script type="text/javascript">window.onload = function() { window.print(); }</script>
<?php $master = Master::model()->findByPK(1); ?>
<?php
	
	$monthName = array('1'=>'JAN', '2'=>'FEB', '3'=>'MAR', '4'=>'APR', '5'=>'MAY', '6'=>'JUN', '7'=>'JUL', '8'=>'AUG', '9'=>'SEP', '10'=>'OCT', '11'=>'NOV', '12'=>'DEC');
	$monthNameHindi = array('1'=>'?????', '2'=>'??????', '3'=>'?????', '4'=>'??????', '5'=>'??', '6'=>'???', '7'=>'?????', '8'=>'?????', '9'=>'??????', '10'=>'???????', '11'=>'?????', '12'=>'??????'); 
	$master = Master::model()->findByPK(1);
	$months = array($startMonth, $startMonth + 1, $endMonth);
	$financialYear = FinancialYears::model()->findByPk(Yii::app()->session['FINANCIAL_YEAR']); 
	$employees = Employee::model()->findAll(array('order'=>'DESIGNATION_ID_FK DESC'));
	$I_GROSS_TOTAL = 0;
	$II_GROSS_TOTAL = 0;
	$III_GROSS_TOTAL = 0;
	$I_IT_TOTAL = 0;
	$II_IT_TOTAL = 0;
	$III_IT_TOTAL = 0;
	$I_ECESS_TOTAL = 0;
	$II_ECESS_TOTAL = 0;
	$III_ECESS_TOTAL = 0;
	$I_HCESS_TOTAL = 0;
	$II_HCESS_TOTAL = 0;
	$III_HCESS_TOTAL = 0;
	$I_TDS_TOTAL = 0;
	$II_TDS_TOTAL = 0;
	$III_TDS_TOTAL = 0;
	
?>
<style>
	td{text-align: center;}
	*{font-size: 12px;}
</style>
<p>Quarterly Income Tax Report-<?php echo $master->OFFICE_NAME;?></p>
<p>(आयकर त्रैमासिक रिपोर्ट-<?php echo $master->OFFICE_NAME_HINDI;?>)</p><br>
<p>TAN: 	BLRY1267A</p>
<p>TDS on Salaries 24Q details for Financial Year <?php echo $financialYear->NAME; ?> Quarter (<?php echo $monthName[strVal($months[0])]?> - <?php echo $monthName[strVal($months[2])]?> <?php echo $Year;?>)</p><br>		
<table class="one-table">
	<tr>
		<th>Sl. No.</th>
		<th>Employee Name</th>
		<th>Designation</th>
		<th>PAN</th>
		<th colspan="5"><?php echo $monthName[strVal($months[0])]?></th>
		<th colspan="5"><?php echo $monthName[strVal($months[1])]?></th>
		<th colspan="5"><?php echo $monthName[strVal($months[2])]?></th>
	</tr>
	<tr>
		<th></th>
		<th></th>
		<th></th>
		<th></th>
		<th>GROSS</th>
		<th>IT</th>
		<th>E CESS</th>
		<th>H CESS</th>
		<th>TOTAL TDS</th>
		<th>GROSS</th>
		<th>IT</th>
		<th>E CESS</th>
		<th>H CESS</th>
		<th>TOTAL TDS</th>
		<th>GROSS</th>
		<th>IT</th>
		<th>E CESS</th>
		<th>H CESS</th>
		<th>TOTAL TDS</th>
	</tr>
<?php 
	$i=1;
	foreach($employees as $employee){
		?>
			<tr>
				<td><?php echo $i;?></td>
				<td><?php echo $employee->NAME;?></td>
				<td><?php echo Designations::model()->findByPK($employee->DESIGNATION_ID_FK)->DESIGNATION;?></td>
				<td><?php echo $employee->PAN;?></td>
				<?php 
					$firstbillsArray = array();
					$firstMonthbills = Bill::model()->findAll('MONTH(PASSED_DATE) = '.$months[0].' AND YEAR(PASSED_DATE) = '.$Year.' AND PFMS_STATUS="Passed" AND (IS_ARREAR_BILL = 1 OR 
IS_CEA_BILL = 1 OR IS_BONUS_BILL = 1 OR IS_EL_ENCASHMENT_BILL = 1 OR IS_RECOVERY_BILL = 1 OR IS_DA_ARREAR_BILL = 1 OR IS_SALARY_BILL = 1)');
					foreach($firstMonthbills as $bill) array_push($firstbillsArray, $bill->ID);
					
					if(count($firstbillsArray) > 0){
						$firstMonthSalary = Yii::app()->db->createCommand("SELECT SUM(BASIC) AS BASIC, SUM(IT) AS IT FROM tbl_salary_details WHERE BILL_ID_FK IN (".implode(",", $firstbillsArray).") 
						AND EMPLOYEE_ID_FK = ".$employee->ID)->queryRow();
						
					}
					else{
						$firstMonthSalary = null;
					}
					
					if($firstMonthSalary){
				?>
					<td><?php $I_GROSS_TOTAL = $I_GROSS_TOTAL + $firstMonthSalary['BASIC']; echo $firstMonthSalary['BASIC'];?></td>
					<td><?php $I_IT_TOTAL = $I_IT_TOTAL + round(($firstMonthSalary['IT']/103)*100); echo round(($firstMonthSalary['IT']/103)*100);?></td>
					<td><?php $I_ECESS_TOTAL = $I_ECESS_TOTAL + round(($firstMonthSalary['IT']/103)*2); echo round(($firstMonthSalary['IT']/103)*2);?></td>
					<td><?php $I_HCESS_TOTAL = $I_HCESS_TOTAL + round(($firstMonthSalary['IT']/103)*1); echo round(($firstMonthSalary['IT']/103)*1);?></td>
					<td><?php $I_TDS_TOTAL = $I_TDS_TOTAL + $firstMonthSalary['IT']; echo $firstMonthSalary['IT'];?></td>
				<?php
				}
				else{
				?>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
				<?php
				}
				?>
				<?php 
					$secondbillsArray = array();
					$secondMonthBills = Bill::model()->findAll('MONTH(PASSED_DATE) = '.$months[1].' AND YEAR(PASSED_DATE) = '.$Year.' AND PFMS_STATUS="Passed" AND (IS_ARREAR_BILL = 1 OR 
IS_CEA_BILL = 1 OR IS_BONUS_BILL = 1 OR IS_EL_ENCASHMENT_BILL = 1 OR IS_RECOVERY_BILL = 1 OR IS_DA_ARREAR_BILL = 1 OR IS_SALARY_BILL = 1)');
					foreach($secondMonthBills as $bill) array_push($secondbillsArray, $bill->ID);
				
					
					if(count($secondbillsArray) > 0){
						$secondMonthSalary = Yii::app()->db->createCommand("SELECT SUM(BASIC) AS BASIC, SUM(IT) AS IT FROM tbl_salary_details WHERE BILL_ID_FK IN (".implode(",", $secondbillsArray).") 
						AND EMPLOYEE_ID_FK = ".$employee->ID)->queryRow();
						
					}
					else{
						$secondMonthSalary = null;
					}
					if($secondMonthSalary){
				?>
					<td><?php $II_GROSS_TOTAL = $II_GROSS_TOTAL + $secondMonthSalary['BASIC']; echo $secondMonthSalary['BASIC'];?></td>
					<td><?php $II_IT_TOTAL = $II_IT_TOTAL + round(($secondMonthSalary['IT']/103)*100); echo round(($secondMonthSalary['IT']/103)*100);?></td>
					<td><?php $II_ECESS_TOTAL = $II_ECESS_TOTAL + round(($secondMonthSalary['IT']/103)*2); echo round(($secondMonthSalary['IT']/103)*2);?></td>
					<td><?php $II_HCESS_TOTAL = $II_HCESS_TOTAL + round(($secondMonthSalary['IT']/103)*1); echo round(($secondMonthSalary['IT']/103)*1);?></td>
					<td><?php $II_TDS_TOTAL = $II_TDS_TOTAL + $secondMonthSalary['IT']; echo $secondMonthSalary['IT'];?></td>
				<?php
				}
				else{
				?>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
				<?php
				}
				?>
				<?php 
					$thirdbillsArray = array();
					$thirdMonthbills = Bill::model()->findAll('MONTH(PASSED_DATE) = '.$months[2].' AND YEAR(PASSED_DATE) = '.$Year.' AND PFMS_STATUS="Passed" AND (IS_ARREAR_BILL = 1 OR 
IS_CEA_BILL = 1 OR IS_BONUS_BILL = 1 OR IS_EL_ENCASHMENT_BILL = 1 OR IS_RECOVERY_BILL = 1 OR IS_DA_ARREAR_BILL = 1 OR IS_SALARY_BILL = 1)');
					foreach($thirdMonthbills as $bill) array_push($thirdbillsArray, $bill->ID);
				
					if(count($thirdbillsArray) > 0){
						$thirdMonthSalary = Yii::app()->db->createCommand("SELECT SUM(BASIC) AS BASIC, SUM(IT) AS IT FROM tbl_salary_details WHERE BILL_ID_FK IN (".implode(",", $thirdbillsArray).") 
						AND EMPLOYEE_ID_FK = ".$employee->ID)->queryRow();
							
					}
					else{
						$thirdMonthSalary = null;
					}
					if($thirdMonthSalary){
				?>
					<td><?php $III_GROSS_TOTAL = $III_GROSS_TOTAL + $thirdMonthSalary['BASIC']; echo $thirdMonthSalary['BASIC'];?></td>
					<td><?php $III_IT_TOTAL = $III_IT_TOTAL + round(($thirdMonthSalary['IT']/103)*100); echo round(($thirdMonthSalary['IT']/103)*100);?></td>
					<td><?php $III_ECESS_TOTAL = $III_ECESS_TOTAL + round(($thirdMonthSalary['IT']/103)*2); echo round(($thirdMonthSalary['IT']/103)*2);?></td>
					<td><?php $III_HCESS_TOTAL = $III_HCESS_TOTAL + round(($thirdMonthSalary['IT']/103)*1); echo round(($thirdMonthSalary['IT']/103)*1);?></td>
					<td><?php $III_TDS_TOTAL = $III_TDS_TOTAL + $thirdMonthSalary['IT']; echo $thirdMonthSalary['IT'];?></td>
				<?php
				}
				else{
				?>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
				<?php
				}
				?>
			</tr>
				
			<?php
			?>
		<?php
		$i++;
	}
?>
	<tr>
		<th colspan="4">TOTAL</th>
		<th><?php echo $I_GROSS_TOTAL;?></th>
		<th><?php echo $I_IT_TOTAL;?></th>
		<th><?php echo $I_ECESS_TOTAL;?></th>
		<th><?php echo $I_HCESS_TOTAL;?></th>
		<th><?php echo $I_TDS_TOTAL;?></th>
		<th><?php echo $II_GROSS_TOTAL;?></th>
		<th><?php echo $II_IT_TOTAL;?></th>
		<th><?php echo $II_ECESS_TOTAL;?></th>
		<th><?php echo $II_HCESS_TOTAL;?></th>
		<th><?php echo $II_TDS_TOTAL;?></th>
		<th><?php echo $III_GROSS_TOTAL;?></th>
		<th><?php echo $III_IT_TOTAL;?></th>
		<th><?php echo $III_ECESS_TOTAL;?></th>
		<th><?php echo $III_HCESS_TOTAL;?></th>
		<th><?php echo $III_TDS_TOTAL;?></th>
	</tr>
	<tr>
		<th colspan="4">As per PAO</th>
		<?php 
			$firstMonthPAOExp = PAOExpenditure::model()->find("MONTH=".$months[0]." AND YEAR=".$Year);
			if($firstMonthPAOExp){
				?>
				<th></th>
				<th><?php echo $firstMonthPAOExp->IT_SAL;?></th>
				<th><?php echo $firstMonthPAOExp->IT_ECSS;?></th>
				<th><?php echo $firstMonthPAOExp->IT_HCESS;?></th>
				<th><?php echo $firstMonthPAOExp->IT_SAL + $firstMonthPAOExp->IT_ECSS + $firstMonthPAOExp->IT_HCESS;?></th>
				<?php
				
			}
			else{
				?>
					<th></th>
					<th></th>
					<th></th>
					<th></th>
					<th></th>
				<?php
			}
		?>
		
		<?php 
			$secondMonthPAOExp = PAOExpenditure::model()->find("MONTH=".$months[1]." AND YEAR=".$Year);
			if($secondMonthPAOExp){
				?>
					<th></th>
					<th><?php echo $secondMonthPAOExp->IT_SAL;?></th>
					<th><?php echo $secondMonthPAOExp->IT_ECSS;?></th>
					<th><?php echo $secondMonthPAOExp->IT_HCESS;?></th>
					<th><?php echo $secondMonthPAOExp->IT_SAL + $secondMonthPAOExp->IT_ECSS + $secondMonthPAOExp->IT_HCESS;?></th>
				<?php
			}
			else{
				?>
					<th></th>
					<th></th>
					<th></th>
					<th></th>
					<th></th>
				<?php
			}
		?>
		
		<?php 
			$thirdMonthPAOExp = PAOExpenditure::model()->find("MONTH=".$months[2]." AND YEAR=".$Year);
			if($thirdMonthPAOExp){
				?>
					<th></th>
					<th><?php echo $thirdMonthPAOExp->IT_SAL;?></th>
					<th><?php echo $thirdMonthPAOExp->IT_ECSS;?></th>
					<th><?php echo $thirdMonthPAOExp->IT_HCESS;?></th>
					<th><?php echo $thirdMonthPAOExp->IT_SAL + $thirdMonthPAOExp->IT_ECSS + $thirdMonthPAOExp->IT_HCESS;?></th>
				<?php
			}
			else{
				?>
					<th></th>
					<th></th>
					<th></th>
					<th></th>
					<th></th>
				<?php
			}
		?>
	</tr>
	<tr>
		<td colspan="4">
		<?php 
			if($firstMonthPAOExp){
				?>
					<th></th>
					<th><?php echo $I_IT_TOTAL - $firstMonthPAOExp->IT_SAL;?></th>
					<th><?php echo $I_ECESS_TOTAL - $firstMonthPAOExp->IT_ECSS;?></th>
					<th><?php echo $I_HCESS_TOTAL - $firstMonthPAOExp->IT_HCESS;?></th>
					<th><?php echo $I_TDS_TOTAL - ($firstMonthPAOExp->IT_SAL + $firstMonthPAOExp->IT_ECSS + $firstMonthPAOExp->IT_HCESS);?></th>
				<?php
			}
			else{
				?>
					<th></th>
					<th></th>
					<th></th>
					<th></th>
					<th></th>
				<?php
			}
		?>
		<?php 
			if($secondMonthPAOExp){
				?>
					<th></th>
					<th><?php echo $II_IT_TOTAL - $secondMonthPAOExp->IT_SAL;?></th>
					<th><?php echo $II_ECESS_TOTAL - $secondMonthPAOExp->IT_ECSS;?></th>
					<th><?php echo $II_HCESS_TOTAL - $secondMonthPAOExp->IT_HCESS;?></th>
					<th><?php echo $II_TDS_TOTAL - ($secondMonthPAOExp->IT_SAL + $secondMonthPAOExp->IT_ECSS + $secondMonthPAOExp->IT_HCESS);?></th>
				<?php
			}
			else{
				?>
					<th></th>
					<th></th>
					<th></th>
					<th></th>
					<th></th>
				<?php
			}
		?>
		
		<?php 
			if($thirdMonthPAOExp){
				?>
					<th></th>
					<th><?php echo $III_IT_TOTAL - $thirdMonthPAOExp->IT_SAL;?></th>
					<th><?php echo $III_ECESS_TOTAL - $thirdMonthPAOExp->IT_ECSS;?></th>
					<th><?php echo $III_HCESS_TOTAL - $thirdMonthPAOExp->IT_HCESS;?></th>
					<th><?php echo $III_TDS_TOTAL - ($thirdMonthPAOExp->IT_SAL + $thirdMonthPAOExp->IT_ECSS + $thirdMonthPAOExp->IT_HCESS);?></th>
				<?php
			}
			else{
				?>
					<th></th>
					<th></th>
					<th></th>
					<th></th>
					<th></th>
				<?php
			}
		?>
	</tr>
</table>
<div style="font-weight: bold; width:400px; float: right;text-align:center; margin-top:20px;margin-right:-10px;">
	<p>(<?php echo Employee::model()->findByPK($master['DEPT_ADMIN_EMPLOYEE'])->NAME;?>)</p>
	<p><?php echo Designations::model()->findByPK(Employee::model()->findByPK($master['DEPT_ADMIN_EMPLOYEE'])->DESIGNATION_ID_FK)->DESIGNATION;?></p>
	<p><?php echo $master['DEPT_NAME']?></p>
</div>
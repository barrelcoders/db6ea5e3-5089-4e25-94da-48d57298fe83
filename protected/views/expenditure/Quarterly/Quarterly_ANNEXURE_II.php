<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/oneadmin.css" rel="stylesheet">
<script type="text/javascript">window.onload = function() { window.print(); }</script>
<?php $master = Master::model()->findByPK(1); ?>
<?php
	$monthName = array('1'=>'January',
						'2'=>'February',
						'3'=>'March',
						'4'=>'April',
						'5'=>'May',
						'6'=>'June',
						'7'=>'July',
						'8'=>'August',
						'9'=>'September',
						'10'=>'October',
						'11'=>'November',
						'12'=>'December');
	$monthNameHindi = array('1'=>'जनवरी',
						'2'=>'फ़रवरी',
						'3'=>'मार्च',
						'4'=>'अप्रैल',
						'5'=>'मई',
						'6'=>'जून',
						'7'=>'जुलाई',
						'8'=>'अगस्त',
						'9'=>'सितंबर',
						'10'=>'अक्टूबर',
						'11'=>'नवंबर',
						'12'=>'दिसंबर');
?><?php $master = Master::model()->findByPK(1); 
			$financialYear = FinancialYears::model()->find('STATUS=1');?>
<p style="font-size: 15px;text-align: center;font-weight: bold;">III	वेतन एवं अन्य भत्तों पर खर्च/EXPENDITURE ON PAY AND VARIOUS ALLOWANCES 	</p>
<span style="font-size: 15px;font-weight: bold;"></span>
<br><br>
<table class="one-table" style="table-layout: fixed;width: 600px;display: block;margin: 0 auto;">
	<tbody>
		<tr>
			<td colspan="3"> शीर्ष/HEAD</td>
			<td><?php echo $this->QuarterEnd; ?>/<?php echo $this->Year; ?> के तिमाही के दौरान / During the quarter <?php echo $this->QuarterEnd; ?>/<?php echo $this->Year; ?></td>
			<td>वित्तीय वर्ष  <?php echo $financialYear->NAME; ?> के तिमाही <?php echo $this->QuarterEnd; ?>/<?php echo $this->Year; ?> के अंत तक/During the Financial Year <?php echo $financialYear->NAME; ?> till end of the Quarter <?php echo $this->QuarterEnd; ?>/<?php echo $this->Year; ?></td>
		</tr>
		<?php 
			$employees = Yii::app()->db->createCommand("SELECT ID FROM tbl_employee WHERE DESIGNATION_ID_FK > 14")->queryAll();
			$OfficersEmployeesIds = array();
			foreach($employees as $employee) array_push($OfficersEmployeesIds, $employee['ID']);
			
			$employees = Yii::app()->db->createCommand("SELECT ID FROM tbl_employee WHERE DESIGNATION_ID_FK <= 14")->queryAll();
			$EstdemployeesIds = array();
			foreach($employees as $employee) array_push($EstdemployeesIds, $employee['ID']);
		?>
		<?php
				$criteria=new CDbCriteria;
				$criteria->condition = "MONTH(PASSED_DATE) >= ".$this->QuarterStart." AND MONTH(PASSED_DATE) <= ".$this->QuarterEnd;
				$criteria->condition = "YEAR(PASSED_DATE)=".$this->Year;
				$criteria->compare("PFMS_STATUS",'Passed');
				$criteria->addInCondition("BILL_TYPE",array(1,2));
				$bills = Bill::model()-> findAll($criteria);
				$QuraterlySalaryBillsArray = array();
				foreach($bills as $bill)
					array_push($QuraterlySalaryBillsArray, $bill->ID);
				
				$criteria=new CDbCriteria;
				$criteria->condition = "MONTH(PASSED_DATE) >= ".$this->QuarterStart." AND MONTH(PASSED_DATE) <= ".$this->QuarterEnd;
				$criteria->condition = "YEAR(PASSED_DATE)=".$this->Year;
				$criteria->compare("PFMS_STATUS",'Passed');
				$criteria->addInCondition("BILL_TYPE",array(6));
				$bills = Bill::model()-> findAll($criteria);
				$QuraterlyMedicalBillsArray = array();
				foreach($bills as $bill)
					array_push($QuraterlyMedicalBillsArray, $bill->ID);
					
				$criteria=new CDbCriteria;
				$criteria->condition = "MONTH(PASSED_DATE) >= ".$this->QuarterStart." AND MONTH(PASSED_DATE) <= ".$this->QuarterEnd;
				$criteria->condition = "YEAR(PASSED_DATE)=".$this->Year;
				$criteria->compare("PFMS_STATUS",'Passed');
				$criteria->addInCondition("BILL_TYPE",array(4));
				$bills = Bill::model()-> findAll($criteria);
				$QuraterlyDomesticTravalBillsArray = array();
				foreach($bills as $bill)
					array_push($QuraterlyDomesticTravalBillsArray, $bill->ID);
					
				$criteria=new CDbCriteria;
				$criteria->condition = "MONTH(PASSED_DATE) >= ".$this->QuarterStart." AND MONTH(PASSED_DATE) <= ".$this->QuarterEnd;
				$criteria->condition = "YEAR(PASSED_DATE)=".$this->Year;
				$criteria->compare("PFMS_STATUS",'Passed');
				$criteria->addInCondition("BILL_TYPE",array(5));
				$bills = Bill::model()-> findAll($criteria);
				$QuraterlyOtherTravalBillsArray = array();
				foreach($bills as $bill)
					array_push($QuraterlyOtherTravalBillsArray, $bill->ID);
				
				$criteria=new CDbCriteria;
				$criteria->condition = "PASSED_DATE >= '".date('Y-m-d', strtotime($financialYear->START_DATE))."' AND PASSED_DATE <= '".date('Y-m-d', strtotime($financialYear->END_DATE))."'";
				$criteria->compare("PFMS_STATUS",'Passed');
				$criteria->addInCondition("BILL_TYPE",array(1,2));
				$bills = Bill::model()-> findAll($criteria);
				$YearlySalaryBillsArray = array();
				foreach($bills as $bill)
					array_push($YearlySalaryBillsArray, $bill->ID);
				
				$criteria=new CDbCriteria;
				$criteria->condition = "PASSED_DATE >= '".date('Y-m-d', strtotime($financialYear->START_DATE))."' AND PASSED_DATE <= '".date('Y-m-d', strtotime($financialYear->END_DATE))."'";
				$criteria->compare("PFMS_STATUS",'Passed');
				$criteria->addInCondition("BILL_TYPE",array(6));
				$bills = Bill::model()-> findAll($criteria);
				$YearlyMedicalBillsArray = array();
				foreach($bills as $bill)
					array_push($YearlyMedicalBillsArray, $bill->ID);
					
				$criteria=new CDbCriteria;
				$criteria->condition = "PASSED_DATE >= '".date('Y-m-d', strtotime($financialYear->START_DATE))."' AND PASSED_DATE <= '".date('Y-m-d', strtotime($financialYear->END_DATE))."'";
				$criteria->compare("PFMS_STATUS",'Passed');
				$criteria->addInCondition("BILL_TYPE",array(4));
				$bills = Bill::model()-> findAll($criteria);
				$YearlyDomesticTravalBillsArray = array();
				foreach($bills as $bill)
					array_push($YearlyDomesticTravalBillsArray, $bill->ID);
					
				$criteria=new CDbCriteria;
				$criteria->condition = "PASSED_DATE >= '".date('Y-m-d', strtotime($financialYear->START_DATE))."' AND PASSED_DATE <= '".date('Y-m-d', strtotime($financialYear->END_DATE))."'";
				$criteria->compare("PFMS_STATUS",'Passed');
				$criteria->addInCondition("BILL_TYPE",array(5));
				$bills = Bill::model()-> findAll($criteria);
				$YearlyOtherTravalBillsArray = array();
				foreach($bills as $bill)
					array_push($YearlyOtherTravalBillsArray, $bill->ID);
				
		?>
		<tr>
			<td>1</td>
			<td colspan="2"><b>Pay of Gazetted Officers</b></td>
			<td><?php 							
				$salary = Yii::app()->db->createCommand("SELECT SUM(BASIC) AS BASIC FROM tbl_salary_details WHERE BILL_ID_FK IN (".implode(",", $QuraterlySalaryBillsArray).") AND EMPLOYEE_ID_FK IN (".implode(",", $OfficersEmployeesIds).")")->queryRow();							
				if(!isset($salary['BASIC']))$salary['BASIC'] = 0;
				echo $salary['BASIC'];
			?></td>
			<td><?php 							
				$salary = Yii::app()->db->createCommand("SELECT SUM(BASIC) AS BASIC FROM tbl_salary_details WHERE BILL_ID_FK IN (".implode(",", $YearlySalaryBillsArray).") AND  EMPLOYEE_ID_FK IN (".implode(",", $OfficersEmployeesIds).")")->queryRow();							
				if(!isset($salary['BASIC']))$salary['BASIC'] = 0;
				echo $salary['BASIC'];
			?></td>
		</tr>
		<tr>
			<td>2</td>
			<td colspan="2">Pay of Non-Gazetted Officers</td>
			<td><?php 							
				$salary = Yii::app()->db->createCommand("SELECT SUM(BASIC) AS BASIC FROM tbl_salary_details WHERE BILL_ID_FK IN (".implode(",", $QuraterlySalaryBillsArray).") AND  EMPLOYEE_ID_FK IN (".implode(",", $EstdemployeesIds).")")->queryRow();							
				if(!isset($salary['BASIC']))$salary['BASIC'] = 0;
				echo $salary['BASIC'];
			?></td>
			<td><?php 							
				$salary = Yii::app()->db->createCommand("SELECT SUM(BASIC) AS BASIC FROM tbl_salary_details WHERE BILL_ID_FK IN (".implode(",", $YearlySalaryBillsArray).") AND  EMPLOYEE_ID_FK IN (".implode(",", $EstdemployeesIds).")")->queryRow();							
				if(!isset($salary['BASIC']))$salary['BASIC'] = 0;
				echo $salary['BASIC'];
			?></td>
		</tr>
		<tr>
			<td>3</td>
			<td colspan="2">Non-Practising Allowance</td>
			<td>0</td>
			<td>0</td>
		</tr>
		<tr>
			<td></td>
			<td colspan="2"><b>Sub Total (1 to 3)</b></td>
			<td><?php 							
				$salary = Yii::app()->db->createCommand("SELECT SUM(BASIC) AS BASIC FROM tbl_salary_details WHERE BILL_ID_FK IN (".implode(",", $QuraterlySalaryBillsArray).")")->queryRow();							
				if(!isset($salary['BASIC']))$salary['BASIC'] = 0;
				echo $salary['BASIC'];
			?></td>
			<td><?php 							
				$salary = Yii::app()->db->createCommand("SELECT SUM(BASIC) AS BASIC FROM tbl_salary_details WHERE BILL_ID_FK IN (".implode(",", $YearlySalaryBillsArray).")")->queryRow();							
				if(!isset($salary['BASIC']))$salary['BASIC'] = 0;
				echo $salary['BASIC'];
			?></td>
		</tr>
		<tr>
			<td>4</td>
			<td colspan="2">Dearness Allowance</td>
			<td><?php 							
				$salary = Yii::app()->db->createCommand("SELECT SUM(DA) AS DA FROM tbl_salary_details WHERE BILL_ID_FK IN (".implode(",", $QuraterlySalaryBillsArray).")")->queryRow();							
				if(!isset($salary['DA']))$salary['DA'] = 0;
				echo $salary['DA'];
			?></td>
			<td><?php 							
				$salary = Yii::app()->db->createCommand("SELECT SUM(DA) AS DA FROM tbl_salary_details WHERE BILL_ID_FK IN (".implode(",", $YearlySalaryBillsArray).")")->queryRow();							
				if(!isset($salary['DA']))$salary['DA'] = 0;
				echo $salary['DA'];
			?></td>
		</tr>
		<tr>
			<td>5</td>
			<td colspan="2">House Rent Allowance</td>
			<td><?php 							
				$salary = Yii::app()->db->createCommand("SELECT SUM(HRA) AS HRA FROM tbl_salary_details WHERE BILL_ID_FK IN (".implode(",", $QuraterlySalaryBillsArray).")")->queryRow();							
				if(!isset($salary['HRA']))$salary['HRA'] = 0;
				echo $salary['HRA'];
			?></td>
			<td><?php 							
				$salary = Yii::app()->db->createCommand("SELECT SUM(HRA) AS HRA FROM tbl_salary_details WHERE BILL_ID_FK IN (".implode(",", $YearlySalaryBillsArray).")")->queryRow();							
				if(!isset($salary['HRA']))$salary['HRA'] = 0;
				echo $salary['HRA'];
			?></td>
		</tr>
		<tr>
			<td>6</td>
			<td colspan="2">Over Time Allowance</td>
			<td>0</td>
			<td>0</td>
		</tr>
		<tr>
			<td>7</td>
			<td colspan="2">Family Planning Allowance</td>
			<td>0</td>
			<td>0</td>
		</tr>
		<tr>
			<td>8</td>
			<td colspan="2">(a) Special Pay</td>
			<td><?php 							
				$salary = Yii::app()->db->createCommand("SELECT SUM(SP) AS SP FROM tbl_salary_details WHERE BILL_ID_FK IN (".implode(",", $QuraterlySalaryBillsArray).")")->queryRow();							
				if(!isset($salary['SP']))$salary['SP'] = 0;
				echo $salary['SP'];
			?></td>
			<td><?php 							
				$salary = Yii::app()->db->createCommand("SELECT SUM(SP) AS SP FROM tbl_salary_details WHERE BILL_ID_FK IN (".implode(",", $YearlySalaryBillsArray).")")->queryRow();							
				if(!isset($salary['SP']))$salary['SP'] = 0;
				echo $salary['SP'];
			?></td>
		</tr>
		<tr>
			<td></td>
			<td colspan="2">(b) Deptn.(Duty) & Central Deptn. Allowance</td>
			<td>0</td>
			<td>0</td>
		</tr>
		<tr>
			<td>9</td>
			<td colspan="2">Transport Allowance</td>
			<td><?php 							
				$salary = Yii::app()->db->createCommand("SELECT SUM(TA) AS TA FROM tbl_salary_details WHERE BILL_ID_FK IN (".implode(",", $QuraterlySalaryBillsArray).")")->queryRow();							
				if(!isset($salary['TA']))$salary['TA'] = 0;
				echo $salary['TA'];
			?></td>
			<td><?php 							
				$salary = Yii::app()->db->createCommand("SELECT SUM(TA) AS TA FROM tbl_salary_details WHERE BILL_ID_FK IN (".implode(",", $YearlySalaryBillsArray).")")->queryRow();							
				if(!isset($salary['TA']))$salary['TA'] = 0;
				echo $salary['TA'];
			?></td>
		</tr>
		<tr>
			<td>10</td>
			<td colspan="2">Composite Hill Compensatory Allowance</td>
			<td>0</td>
			<td>0</td>
		</tr>
		<tr>
			<td>11</td>
			<td colspan="2">(a) Children Education Allowance (CEA)</td>
			<td><?php 							
				$salary = Yii::app()->db->createCommand("SELECT SUM(CEA) AS CEA FROM tbl_salary_details WHERE BILL_ID_FK IN (".implode(",", $QuraterlySalaryBillsArray).")")->queryRow();							
				if(!isset($salary['CEA']))$salary['CEA'] = 0;
				echo $salary['CEA'];
			?></td>
			<td><?php 							
				$salary = Yii::app()->db->createCommand("SELECT SUM(CEA) AS CEA FROM tbl_salary_details WHERE BILL_ID_FK IN (".implode(",", $YearlySalaryBillsArray).")")->queryRow();							
				if(!isset($salary['CEA']))$salary['CEA'] = 0;
				echo $salary['CEA'];
			?></td>
		</tr>
		<tr>
			<td></td>
			<td colspan="2">(b) Hostel Subsidy</td>
			<td>0</td>
			<td>0</td>
		</tr>
		<tr>
			<td>12</td>
			<td colspan="2">Leave Travel Concession (LTC)</td>
			<td><?php 							
				$salary = Yii::app()->db->createCommand("SELECT SUM(LTC_HTC) AS LTC_HTC FROM tbl_salary_details WHERE BILL_ID_FK IN (".implode(",", $QuraterlySalaryBillsArray).")")->queryRow();							
				if(!isset($salary['LTC_HTC']))$salary['LTC_HTC'] = 0;
				echo $salary['LTC_HTC'];
			?></td>
			<td><?php 							
				$salary = Yii::app()->db->createCommand("SELECT SUM(LTC_HTC) AS LTC_HTC FROM tbl_salary_details WHERE BILL_ID_FK IN (".implode(",", $YearlySalaryBillsArray).")")->queryRow();							
				if(!isset($salary['LTC_HTC']))$salary['LTC_HTC'] = 0;
				echo $salary['LTC_HTC'];
			?></td>
		</tr>
		<tr>
			<td>13</td>
			<td colspan="2">Encashment of EL for LTC</td>
			<td>0</td>
			<td>0</td>
		</tr>
		<tr>
			<td>14</td>
			<td colspan="2">Reimbursemnt of Medical Charges</td>
			<td><?php
				if(count($QuraterlyMedicalBillsArray) > 0){
					$bill = Yii::app()->db->createCommand("SELECT SUM(BILL_AMOUNT) AS BILL_AMOUNT FROM tbl_bill WHERE ID IN (".implode(",", $QuraterlyMedicalBillsArray).")")->queryRow();							
					if(!isset($bill['BILL_AMOUNT']))$bill['BILL_AMOUNT'] = 0;
					echo $bill['BILL_AMOUNT'];
				}
				
			?></td>
			<td><?php 					
				if(count($YearlyMedicalBillsArray) > 0){
					$bill = Yii::app()->db->createCommand("SELECT SUM(BILL_AMOUNT) AS BILL_AMOUNT FROM tbl_bill WHERE ID IN (".implode(",", $YearlyMedicalBillsArray).")")->queryRow();							
					if(!isset($bill['BILL_AMOUNT']))$bill['BILL_AMOUNT'] = 0;
					echo $bill['BILL_AMOUNT'];
				}
			?></td>
		</tr>
		<tr>
			<td>15</td>
			<td colspan="2">(a) Special(Duty) Allowance for NE Region & Ladakh</td>
			<td>0</td>
			<td>0</td>
		</tr>
		<tr>
			<td></td>
			<td colspan="2">(b) Island Special (Duty) Allowance for A &N & Lakshadweep</td>
			<td>0</td>
			<td>0</td>
		</tr>
		<tr>
			<td>16</td>
			<td colspan="2">Special Compensatory Allowances</td>
			<td>0</td>
			<td>0</td>
		</tr>
		<tr>
			<td></td>
			<td colspan="2">(a) Hill Area To (e)</td>
			<td>0</td>
			<td>0</td>
		</tr>
		<tr>
			<td></td>
			<td colspan="2">(f) Washing Allowance</td>
			<td><?php 							
				$salary = Yii::app()->db->createCommand("SELECT SUM(WA) AS WA FROM tbl_salary_details WHERE BILL_ID_FK IN (".implode(",", $QuraterlySalaryBillsArray).")")->queryRow();							
				if(!isset($salary['WA']))$salary['WA'] = 0;
				echo $salary['WA'];
			?></td>
			<td><?php 							
				$salary = Yii::app()->db->createCommand("SELECT SUM(WA) AS WA FROM tbl_salary_details WHERE BILL_ID_FK IN (".implode(",", $YearlySalaryBillsArray).")")->queryRow();							
				if(!isset($salary['WA']))$salary['WA'] = 0;
				echo $salary['WA'];
			?></td>
		</tr>
		<tr>
			<td></td>
			<td colspan="2">(g) to (u)</td>
			<td>0</td>
			<td>0</td>
		</tr>
		<tr>
			<td></td>
			<td colspan="2">(v) Uniform Allowance</td>
			<td><?php 							
				$salary = Yii::app()->db->createCommand("SELECT SUM(UA) AS UA FROM tbl_salary_details WHERE BILL_ID_FK IN (".implode(",", $QuraterlySalaryBillsArray).")")->queryRow();							
				if(!isset($salary['UA']))$salary['UA'] = 0;
				echo $salary['UA'];
			?></td>
			<td><?php 							
				$salary = Yii::app()->db->createCommand("SELECT SUM(UA) AS UA FROM tbl_salary_details WHERE BILL_ID_FK IN (".implode(",", $YearlySalaryBillsArray).")")->queryRow();							
				if(!isset($salary['UA']))$salary['UA'] = 0;
				echo $salary['UA'];
			?></td>
		</tr>
		<tr>
			<td>17</td>
			<td colspan="2">Others (if any, Specify)</td>
			<td>0</td>
			<td>0</td>
		</tr>
		<tr>
			<td>18</td>
			<td colspan="2">LTC Advance</td>
			<td>0</td>
			<td>0</td>
		</tr>
		<tr>
			<td>(ii)</td>
			<td colspan="2"><b style="display: block;text-align: center;font-weight: bold;">Subtotal</b></td>
			<td>0</td>
			<td>0</td>
		</tr>
		<tr>
			<td>(iii)</td>
			<td colspan="2"><b style="display: block;text-align: center;font-weight: bold;">Grand Total</b></td>
			<td>0</td>
			<td>0</td>
		</tr>
		<tr>
			<td>18</td>
			<td colspan="2">Travel Expenses</td>
			<td>0</td>
			<td>0</td>
		</tr>
		<tr>
			<td>(a)</td>
			<td colspan="2">(i) Domestic Travel Expenses (DTE)</td>
			<td><?php 							
				$salary = Yii::app()->db->createCommand("SELECT SUM(BILL_AMOUNT) AS BILL_AMOUNT FROM tbl_bill WHERE ID IN (".implode(",", $QuraterlyDomesticTravalBillsArray).") AND BILL_TYPE=4")->queryRow();							
				$Q_DTE = $salary['BILL_AMOUNT'] ? $salary['BILL_AMOUNT'] : 0;
				echo $Q_DTE;
			?></td>
			<td><?php 							
				$salary = Yii::app()->db->createCommand("SELECT SUM(BILL_AMOUNT) AS BILL_AMOUNT FROM tbl_bill WHERE ID IN (".implode(",", $QuraterlyDomesticTravalBillsArray).") AND BILL_TYPE=4")->queryRow();							
				$Y_DTE = $salary['BILL_AMOUNT'] ? $salary['BILL_AMOUNT'] : 0;
				echo $Y_DTE;
			?></td>
		</tr>
		<tr>
			<td></td>
			<td colspan="2">(ii) Foreign Travel Expenses (FTE)</td>
			<td>0</td>
			<td>0</td>
		</tr>
		<tr>
			<td>(b)</td>
			<td colspan="2">Transfers</td>
			<td>0</td>
			<td>0</td>
		</tr>
		<tr>
			<td></td>
			<td colspan="2">TOTAL (a) + (b)</td>
			<td><?php echo $Q_DTE; ?></td>
			<td><?php echo $Y_DTE; ?></td>
		</tr>
		<tr>
			<td>19</td>
			<td colspan="2">BONUS(ADHOC BONUS)</td>
			<td><?php 							
				$salary = Yii::app()->db->createCommand("SELECT SUM(BONUS) AS BONUS FROM tbl_salary_details WHERE BILL_ID_FK IN (".implode(",", $QuraterlySalaryBillsArray).")")->queryRow();							
				if(!isset($salary['BONUS']))$salary['BONUS'] = 0;
				echo $salary['BONUS'];
			?></td>
			<td><?php 							
				$salary = Yii::app()->db->createCommand("SELECT SUM(BONUS) AS BONUS FROM tbl_salary_details WHERE BILL_ID_FK IN (".implode(",", $YearlySalaryBillsArray).")")->queryRow();							
				if(!isset($salary['BONUS']))$salary['BONUS'] = 0;
				echo $salary['BONUS'];
			?></td>
		</tr>
		<tr>
			<td>20</td>
			<td colspan="2">Honorarium</td>
			<td>0</td>
			<td>0</td>
		</tr>
		<tr>
			<td>21</td>
			<td colspan="2">Encashment of E.L. on Superannuation/VRS</td>
			<td>0</td>
			<td>0</td>
		</tr>
		<tr>
			<td>22</td>
			<td colspan="2">Expensiture on HRA</td>
			<td>0</td>
			<td>0</td>
		</tr>
		<tr>
			<td></td>
			<td>Class of cities</td>
			<td>Number of Cities</td>
			<td>0</td>
			<td>0</td>
		</tr>
		<tr>
			<td></td>
			<td>X</td>
			<td>1</td>
			<td><?php 							
				$salary = Yii::app()->db->createCommand("SELECT SUM(HRA) AS HRA FROM tbl_salary_details WHERE BILL_ID_FK IN (".implode(",", $QuraterlySalaryBillsArray).")")->queryRow();							
				if(!isset($salary['HRA']))$salary['HRA'] = 0;
				echo $salary['HRA'];
			?></td>
			<td><?php 							
				$salary = Yii::app()->db->createCommand("SELECT SUM(HRA) AS HRA FROM tbl_salary_details WHERE BILL_ID_FK IN (".implode(",", $YearlySalaryBillsArray).")")->queryRow();							
				if(!isset($salary['HRA']))$salary['HRA'] = 0;
				echo $salary['HRA'];
			?></td>
		</tr>
		<tr>
			<td></td>
			<td>Y</td>
			<td></td>
			<td>0</td>
			<td>0</td>
		</tr>
		<tr>
			<td></td>
			<td>Z</td>
			<td></td>
			<td>0</td>
			<td>0</td>
		</tr>
		<tr>
			<td></td>
			<td>TOTAL</td>
			<td>1</td><td><?php 							
				$salary = Yii::app()->db->createCommand("SELECT SUM(HRA) AS HRA FROM tbl_salary_details WHERE BILL_ID_FK IN (".implode(",", $QuraterlySalaryBillsArray).")")->queryRow();							
				if(!isset($salary['HRA']))$salary['HRA'] = 0;
				echo $salary['HRA'];
			?></td>
			<td><?php 							
				$salary = Yii::app()->db->createCommand("SELECT SUM(HRA) AS HRA FROM tbl_salary_details WHERE BILL_ID_FK IN (".implode(",", $YearlySalaryBillsArray).")")->queryRow();							
				if(!isset($salary['HRA']))$salary['HRA'] = 0;
				echo $salary['HRA'];
			?></td>
		</tr>
	</tbody>
</table>
<div style="font-weight: bold; width:400px; float: right;text-align:center; margin-top:100px;margin-right:-10px;">
	<p><?php echo Employee::model()->findByPK($master['DEPT_ADMIN_EMPLOYEE'])->NAME;?></p>
	<p><?php echo Designations::model()->findByPK(Employee::model()->findByPK($master['DEPT_ADMIN_EMPLOYEE'])->DESIGNATION_ID_FK)->DESIGNATION;?></p>
	<p><?php echo $master['DEPT_NAME']?></p>
</div>
<style>
	th, td{text-align: center;}
	td:first-child{width: 50px;}
	td:nth-child(2){text-align: left; padding-left: 5px;}
</style>
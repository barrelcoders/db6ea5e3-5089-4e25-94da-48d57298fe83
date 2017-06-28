<?php 
	require_once "/../../../../include/ExpenditureReportInclude.php";
	$monthName = array('1'=>'January', '2'=>'February', '3'=>'March', '4'=>'April', '5'=>'May', '6'=>'June', '7'=>'July', '8'=>'August', '9'=>'September', '10'=>'October', '11'=>'November', '12'=>'December');
	$monthNameHindi = array('1'=>'जनवरी', '2'=>'फ़रवरी', '3'=>'मार्च', '4'=>'अप्रैल', '5'=>'मई', '6'=>'जून', '7'=>'जुलाई', '8'=>'अगस्त', '9'=>'सितंबर', '10'=>'अक्टूबर', '11'=>'नवंबर', '12'=>'दिसंबर'); 
	$master = Master::model()->findByPK(1); 
?>
<p style="font-size: 20px;text-align: center;font-weight: bold;">अनुबंध-III/ANNEXURE -III</p>
<p style="font-size: 15px;font-weight: bold;text-align: center;"><?php echo $master->DEPT_NAME_HINDI;?>/<?php echo $master->DEPT_NAME;?></p>
<div style="float: right;font-weight: bold;">
	<p>MAJOR HEAD : 2038 Union Excise Duties</p>
	<p>MINOR HEAD : B.2(2) Other Offices.</p>
</div>
<p style="font-size: 15px;text-align: center;font-weight: bold;"><?php echo $monthNameHindi[$this->Month]?> -<?php echo $this->Year?> माह के लिए मासिक व्यय विवरण/MONTHLY EXPENDITURE STATEMENT FOR THE MONTH OF - <?php echo $monthName[$this->Month]?> <?php echo $this->Year?></p>
<br><br>
<table class="one-table" >
	<thead>
		<tr>
			<th></th>
			<th>लेखा का शीर्ष/ Head of Account</th>
			<th>Revised Sanctioned Grant for 2016-17</th>
			<th>Actual Expenditure during the month of <?php echo $this->Month?>/<?php echo $this->Year?></th>	
			<th>Amount Recredited</th>	
			<th>Net Expenditure during the month <?php echo $this->Month?>/<?php echo $this->Year?></th>	
			<th>Total Expenditure upto end of month <?php echo $this->Month?>/<?php echo $this->Year?></th>	
			<th>टिपण्णी/Remarks</th>	
		</tr>
		<tr>
			<th>1</th>
			<th>2</th>
			<th>3</th>
			<th>4</th>
			<th>5</th>
			<th>6</th>
			<th>7</th>
			<th>8</th>
		</tr>
	</thead>
	<?php
		$criteria=new CDbCriteria;        
		$criteria->condition = "MONTH(PASSED_DATE)=".$this->Month." AND YEAR(PASSED_DATE)=".$this->Year;
		$criteria->compare("PFMS_STATUS",'Passed');
		$Bills = Bill::model()-> findAll($criteria);
		$monthlyBillsArray = array(); 
		$i=1;
		foreach($Bills as $bill)
			array_push($monthlyBillsArray, $bill->ID);
			
		$financialYear = FinancialYears::model()->find('STATUS=1');
		
		$criteria=new CDbCriteria;        
		$criteria->condition = "PASSED_DATE >= '".date('Y-m-d', strtotime($financialYear->START_DATE))."' AND PASSED_DATE <= '".date_create($this->Year."-".($this->Month+1)." last day of last month")->format('Y-m-d')."'";
		$criteria->compare("PFMS_STATUS",'Passed');
		$Bills = Bill::model()-> findAll($criteria);
		$yearlyBillsArray = array(); 
		$i=1;
		foreach($Bills as $bill)
			array_push($yearlyBillsArray, $bill->ID);
	?>
	<tbody>
		<tr>
			<td>1</td>
			<td><b>वेतन/ SALARIES</b></td>
			<td><b><?php echo Budget::model()->findByPK(1)->AMOUNT;?></b></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
				<?php
					$employees = Yii::app()->db->createCommand("SELECT ID FROM tbl_employee WHERE DESIGNATION_ID_FK > 14 AND IS_PERMANENT = 1")->queryAll();
					$OfficersEmployeesIds = array();
					foreach($employees as $employee) array_push($OfficersEmployeesIds, $employee['ID']);
				?>
				<?php
					$employees = Yii::app()->db->createCommand("SELECT ID FROM tbl_employee WHERE DESIGNATION_ID_FK <= 14 AND IS_PERMANENT = 1")->queryAll();
					$EstEmployeesIds = array();
					foreach($employees as $employee) array_push($EstEmployeesIds, $employee['ID']);
				?>
				<?php
					$employees = Yii::app()->db->createCommand("SELECT ID FROM tbl_employee WHERE IS_PERMANENT = 1")->queryAll();
					$AllEmployeesIds = array();
					foreach($employees as $employee) array_push($AllEmployeesIds, $employee['ID']);
				?>
		<tr>
			<td>i)</td>
			<td>Pay of Officer's</td>
			<td></td>
			<td><?php 
					$salary = Yii::app()->db->createCommand("SELECT SUM(BASIC) AS BASIC FROM tbl_salary_details WHERE BILL_ID_FK IN (".implode(",", $monthlyBillsArray).") AND EMPLOYEE_ID_FK IN (".implode(",", $OfficersEmployeesIds).")")->queryRow();							
					if(!isset($salary['BASIC']))$salary['BASIC'] = 0;
					echo $salary['BASIC'];
				?></td>
			<td>0</td>
			<td><?php 
					$salary = Yii::app()->db->createCommand("SELECT SUM(BASIC) AS BASIC FROM tbl_salary_details WHERE BILL_ID_FK IN (".implode(",", $monthlyBillsArray).") AND EMPLOYEE_ID_FK IN (".implode(",", $OfficersEmployeesIds).")")->queryRow();							
					if(!isset($salary['BASIC']))$salary['BASIC'] = 0;
					echo $salary['BASIC'];
				?></td>
			<td><?php 
					$salary = Yii::app()->db->createCommand("SELECT SUM(BASIC) AS BASIC FROM tbl_salary_details WHERE BILL_ID_FK IN (".implode(",", $yearlyBillsArray).") AND EMPLOYEE_ID_FK IN (".implode(",", $OfficersEmployeesIds).")")->queryRow();							
					if(!isset($salary['BASIC']))$salary['BASIC'] = 0;
					echo $salary['BASIC'];
				?></td>
			<td></td>
		</tr>
		<tr>
			<td>ii)</td>
			<td>Pay of Estt.</td>
			<td></td>
			<td><?php 
					$salary = Yii::app()->db->createCommand("SELECT SUM(BASIC) AS BASIC FROM tbl_salary_details WHERE BILL_ID_FK IN (".implode(",", $monthlyBillsArray).") AND EMPLOYEE_ID_FK IN (".implode(",", $EstEmployeesIds).")")->queryRow();							
					if(!isset($salary['BASIC']))$salary['BASIC'] = 0;
					echo $salary['BASIC'];
				?></td>
			<td>0</td>
			<td><?php 
					$salary = Yii::app()->db->createCommand("SELECT SUM(BASIC) AS BASIC FROM tbl_salary_details WHERE BILL_ID_FK IN (".implode(",", $monthlyBillsArray).") AND EMPLOYEE_ID_FK IN (".implode(",", $EstEmployeesIds).")")->queryRow();							
					if(!isset($salary['BASIC']))$salary['BASIC'] = 0;
					echo $salary['BASIC'];
				?></td>
			<td><?php 
					$salary = Yii::app()->db->createCommand("SELECT SUM(BASIC) AS BASIC FROM tbl_salary_details WHERE BILL_ID_FK IN (".implode(",", $yearlyBillsArray).") AND EMPLOYEE_ID_FK IN (".implode(",", $EstEmployeesIds).")")->queryRow();							
					if(!isset($salary['BASIC']))$salary['BASIC'] = 0;
					echo $salary['BASIC'];
				?></td>
			<td></td>
		</tr>
		<tr>
			<td>iii)</td>
			<td>Grade PAY</td>
			<td></td>
			<td><?php 
					$salary = Yii::app()->db->createCommand("SELECT SUM(GP) AS GP FROM tbl_salary_details WHERE BILL_ID_FK IN (".implode(",", $monthlyBillsArray).")")->queryRow();							
					if(!isset($salary['GP']))$salary['GP'] = 0;
					echo $salary['GP'];
				?></td>
			<td>0</td>
			<td><?php 
					$salary = Yii::app()->db->createCommand("SELECT SUM(GP) AS GP FROM tbl_salary_details WHERE BILL_ID_FK IN (".implode(",", $monthlyBillsArray).")")->queryRow();							
					if(!isset($salary['GP']))$salary['GP'] = 0;
					echo $salary['GP'];
				?></td>
			<td><?php 
					$salary = Yii::app()->db->createCommand("SELECT SUM(GP) AS GP FROM tbl_salary_details WHERE BILL_ID_FK IN (".implode(",", $yearlyBillsArray).")")->queryRow();							
					if(!isset($salary['GP']))$salary['GP'] = 0;
					echo $salary['GP'];
				?></td>
			<td></td>
		</tr>
		<tr>
			<td>iv)</td>
			<td>Dearness Allowance</td>
			<td></td>
			<td><?php 
					$salary = Yii::app()->db->createCommand("SELECT SUM(DA) AS DA FROM tbl_salary_details WHERE BILL_ID_FK IN (".implode(",", $monthlyBillsArray).")")->queryRow();							
					if(!isset($salary['DA']))$salary['DA'] = 0;
					echo $salary['DA'];
				?></td>
			<td>0</td>
			<td><?php 
					$salary = Yii::app()->db->createCommand("SELECT SUM(DA) AS DA FROM tbl_salary_details WHERE BILL_ID_FK IN (".implode(",", $monthlyBillsArray).")")->queryRow();							
					if(!isset($salary['DA']))$salary['DA'] = 0;
					echo $salary['DA'];
				?></td>
			<td><?php 
					$salary = Yii::app()->db->createCommand("SELECT SUM(DA) AS DA FROM tbl_salary_details WHERE BILL_ID_FK IN (".implode(",", $yearlyBillsArray).")")->queryRow();							
					if(!isset($salary['DA']))$salary['DA'] = 0;
					echo $salary['DA'];
				?></td>
			<td></td>
		</tr>
		<tr>
			<td>v)</td>
			<td>Other Allowances <br>(HRA+CCA+TA+RTF+WA+BONUS)</td>
			<td></td>
			<td><?php 							
				$salary = Yii::app()->db->createCommand("SELECT SUM(HRA) + SUM(CCA) + SUM(TA) + SUM(WA) + SUM(BONUS) AS TOTAL FROM tbl_salary_details WHERE BILL_ID_FK IN (".implode(",", $monthlyBillsArray).")")->queryRow();
				if(!isset($salary['TOTAL']))$salary['TOTAL'] = 0;
				echo $salary['TOTAL'];
			?></td>
			<td>0</td>
			<td><?php 
					$salary = Yii::app()->db->createCommand("SELECT SUM(HRA) + SUM(CCA) + SUM(TA) + SUM(WA) + SUM(BONUS) AS TOTAL FROM tbl_salary_details WHERE BILL_ID_FK IN (".implode(",", $monthlyBillsArray).")")->queryRow();
					if(!isset($salary['TOTAL']))$salary['TOTAL'] = 0;
					echo $salary['TOTAL'];
				?></td>
			<td><?php 
					$salary = Yii::app()->db->createCommand("SELECT SUM(HRA) + SUM(CCA) + SUM(TA) + SUM(WA) + SUM(BONUS) AS TOTAL FROM tbl_salary_details WHERE BILL_ID_FK IN (".implode(",", $yearlyBillsArray).")")->queryRow();
				if(!isset($salary['TOTAL']))$salary['TOTAL'] = 0;
					echo $salary['TOTAL'];
				?></td>
			<td></td>
		</tr>
		<tr>
			<td>vi)</td>
			<td>S.S./P.P</td>
			<td></td>
			<td><?php 							
				$salary = Yii::app()->db->createCommand("SELECT SUM(SP) + SUM(PP) AS TOTAL FROM tbl_salary_details WHERE BILL_ID_FK IN (".implode(",", $monthlyBillsArray).")")->queryRow();
				if(!isset($salary['TOTAL']))$salary['TOTAL'] = 0;
				echo $salary['TOTAL'];
			?></td>
			<td>0</td>
			<td><?php 
					$salary = Yii::app()->db->createCommand("SELECT SUM(SP) + SUM(PP) AS TOTAL FROM tbl_salary_details WHERE BILL_ID_FK IN (".implode(",", $monthlyBillsArray).")")->queryRow();
					if(!isset($salary['TOTAL']))$salary['TOTAL'] = 0;
					echo $salary['TOTAL'];
				?></td>
			<td><?php 
					$salary = Yii::app()->db->createCommand("SELECT SUM(SP) + SUM(PP) AS TOTAL FROM tbl_salary_details WHERE BILL_ID_FK IN (".implode(",", $yearlyBillsArray).")")->queryRow();
				if(!isset($salary['TOTAL']))$salary['TOTAL'] = 0;
					echo $salary['TOTAL'];
				?></td>
			<td></td>
		</tr>
		<tr>
			<td>vii)</td>
			<td>Festival Advance</td>
			<td></td>
			<td><?php 							
				$salary = Yii::app()->db->createCommand("SELECT SUM(FEST_EMI) AS TOTAL FROM tbl_salary_details WHERE BILL_ID_FK IN (".implode(",", $monthlyBillsArray).")")->queryRow();
				if(!isset($salary['TOTAL']))$salary['TOTAL'] = 0;
				echo $salary['TOTAL'];
			?></td>
			<td>0</td>
			<td><?php 
					$salary = Yii::app()->db->createCommand("SELECT SUM(FEST_EMI) AS TOTAL FROM tbl_salary_details WHERE BILL_ID_FK IN (".implode(",", $monthlyBillsArray).")")->queryRow();
					if(!isset($salary['TOTAL']))$salary['TOTAL'] = 0;
					echo $salary['TOTAL'];
				?></td>
			<td><?php 
					$salary = Yii::app()->db->createCommand("SELECT SUM(FEST_EMI) AS TOTAL FROM tbl_salary_details WHERE BILL_ID_FK IN (".implode(",", $yearlyBillsArray).")")->queryRow();
				if(!isset($salary['TOTAL']))$salary['TOTAL'] = 0;
					echo $salary['TOTAL'];
				?></td>
			<td></td>
		</tr>
		<tr>
			<td></td>
			<td><b>GROSS SALARIES</b></td>
			<td><b><?php echo Budget::model()->findByPK(1)->AMOUNT;?></b></td>
			<td><b><?php 							
				$salary = Yii::app()->db->createCommand("SELECT SUM(FEST_EMI) + SUM(BASIC) + SUM(GP) + SUM(DA) + SUM(SP) + SUM(PP) + SUM(HRA) + SUM(CCA) + SUM(TA) + SUM(WA) + SUM(BONUS) AS TOTAL FROM tbl_salary_details WHERE BILL_ID_FK IN (".implode(",", $monthlyBillsArray).")")->queryRow();
				if(!isset($salary['TOTAL']))$salary['TOTAL'] = 0;
				echo $salary['TOTAL'];
			?></b></td>
			<td><b>0</b></td>
			<td><b><?php 
					$salary = Yii::app()->db->createCommand("SELECT SUM(FEST_EMI) + SUM(BASIC) + SUM(GP) + SUM(DA) + SUM(SP) + SUM(PP) + SUM(HRA) + SUM(CCA) + SUM(TA) + SUM(WA) + SUM(BONUS) AS TOTAL FROM tbl_salary_details WHERE BILL_ID_FK IN (".implode(",", $monthlyBillsArray).")")->queryRow();
					if(!isset($salary['TOTAL']))$salary['TOTAL'] = 0;
					echo $salary['TOTAL'];
				?></b></td>
			<td><b><?php 
					$salary = Yii::app()->db->createCommand("SELECT SUM(FEST_EMI) + SUM(BASIC) + SUM(GP) + SUM(DA) + SUM(SP) + SUM(PP) + SUM(HRA) + SUM(CCA) + SUM(TA) + SUM(WA) + SUM(BONUS) AS TOTAL FROM tbl_salary_details WHERE BILL_ID_FK IN (".implode(",", $yearlyBillsArray).")")->queryRow();
				if(!isset($salary['TOTAL']))$salary['TOTAL'] = 0;
					echo $salary['TOTAL'];
				?></b></td>
			<td></td>
		</tr>
		<tr>
			<td></td>
			<td>Recovery of Festival Adv./OP</td>
			<td></td>
			<td><?php 							
				$salary = Yii::app()->db->createCommand("SELECT SUM(MISC) AS TOTAL FROM tbl_salary_details WHERE BILL_ID_FK IN (".implode(",", $monthlyBillsArray).")")->queryRow();
				if(!isset($salary['TOTAL']))$salary['TOTAL'] = 0;
				echo $salary['TOTAL'];
			?></td>
			<td>0</td>
			<td><?php 
					$salary = Yii::app()->db->createCommand("SELECT SUM(MISC) AS TOTAL FROM tbl_salary_details WHERE BILL_ID_FK IN (".implode(",", $monthlyBillsArray).")")->queryRow();
					if(!isset($salary['TOTAL']))$salary['TOTAL'] = 0;
					echo $salary['TOTAL'];
				?></td>
			<td><?php 
					$salary = Yii::app()->db->createCommand("SELECT SUM(MISC) AS TOTAL FROM tbl_salary_details WHERE BILL_ID_FK IN (".implode(",", $yearlyBillsArray).")")->queryRow();
				if(!isset($salary['TOTAL']))$salary['TOTAL'] = 0;
					echo $salary['TOTAL'];
				?></td>
			<td></td>
		</tr>
		<tr>
			<td></td>
			<td><b>कुल वेतन/ Total Salaries</b></td>
			<td></td>
			<td><b><?php 							
				$salary = Yii::app()->db->createCommand("SELECT SUM(FEST_EMI) + SUM(BASIC) + SUM(GP) + SUM(DA) + SUM(SP) + SUM(PP) + SUM(HRA) + SUM(CCA) + SUM(TA) + SUM(WA) + SUM(BONUS) - SUM(MISC) AS TOTAL FROM tbl_salary_details WHERE BILL_ID_FK IN (".implode(",", $monthlyBillsArray).")")->queryRow();
				if(!isset($salary['TOTAL']))$salary['TOTAL'] = 0;
				echo $salary['TOTAL'];
			?></b></td>
			<td><b>0</b></td>
			<td><b><?php 
					$salary = Yii::app()->db->createCommand("SELECT SUM(FEST_EMI) + SUM(BASIC) + SUM(GP) + SUM(DA) + SUM(SP) + SUM(PP) + SUM(HRA) + SUM(CCA) + SUM(TA) + SUM(WA) + SUM(BONUS) - SUM(MISC) AS TOTAL FROM tbl_salary_details WHERE BILL_ID_FK IN (".implode(",", $monthlyBillsArray).")")->queryRow();
					if(!isset($salary['TOTAL']))$salary['TOTAL'] = 0;
					echo $salary['TOTAL'];
				?></b></td>
			<td><b><?php 
					$salary = Yii::app()->db->createCommand("SELECT SUM(FEST_EMI) + SUM(BASIC) + SUM(GP) + SUM(DA) + SUM(SP) + SUM(PP) + SUM(HRA) + SUM(CCA) + SUM(TA) + SUM(WA) + SUM(BONUS) - SUM(MISC) AS TOTAL FROM tbl_salary_details WHERE BILL_ID_FK IN (".implode(",", $yearlyBillsArray).")")->queryRow();
				if(!isset($salary['TOTAL']))$salary['TOTAL'] = 0;
					echo $salary['TOTAL'];
				?></b></td>
			<td></td>
		</tr>
		<tr>
			<td>2</td>
			<td><b>चिकित्सा/ MEDICAL</b></td>
			<td><b><?php echo Budget::model()->findByPK(5)->AMOUNT;?></b></td>
			<td>
				<b>
				<?php 							
					$salary = Yii::app()->db->createCommand("SELECT SUM(BILL_AMOUNT) AS TOTAL FROM tbl_bill WHERE ID IN (".implode(",", $monthlyBillsArray).") AND BILL_TYPE=6 ")->queryRow();
					if(!isset($salary['TOTAL']))$salary['TOTAL'] = 0;
					echo $salary['TOTAL'];
				?>
				</b>
			</td>
			<td><b>0</b></td>
			<td>
				<b>
				<?php 
					$salary = Yii::app()->db->createCommand("SELECT SUM(BILL_AMOUNT) AS TOTAL FROM tbl_bill WHERE ID IN (".implode(",", $monthlyBillsArray).") AND  BILL_TYPE=6 ")->queryRow();
					if(!isset($salary['TOTAL']))$salary['TOTAL'] = 0;
					echo $salary['TOTAL'];
				?>
				</b>
			</td>
			<td>
				<b>
				<?php 
					$salary = Yii::app()->db->createCommand("SELECT SUM(BILL_AMOUNT) AS TOTAL FROM tbl_bill WHERE  ID IN (".implode(",", $yearlyBillsArray).") AND  BILL_TYPE=6")->queryRow();
					if(!isset($salary['TOTAL']))$salary['TOTAL'] = 0;
						echo $salary['TOTAL'];
				?>
				</b>
			</td>
			<td></td>
		</tr>
		<tr>
			<td>3</td>
			<td>Wages</td>
			<td><b><?php echo Budget::model()->findByPK(7)->AMOUNT;?></b></td>
				<td><b><?php 							
				$salary = Yii::app()->db->createCommand("SELECT SUM(BILL_AMOUNT) AS TOTAL FROM tbl_bill WHERE ID IN (".implode(",", $monthlyBillsArray).") AND BILL_TYPE=8 ")->queryRow();
				if(!isset($salary['TOTAL']))$salary['TOTAL'] = 0;
				echo $salary['TOTAL'];
			?></b></td>
			<td>0</td>
			<td><b><?php 
					$salary = Yii::app()->db->createCommand("SELECT SUM(BILL_AMOUNT) AS TOTAL FROM tbl_bill WHERE  ID IN (".implode(",", $monthlyBillsArray).") AND BILL_TYPE=8 ")->queryRow();
					if(!isset($salary['TOTAL']))$salary['TOTAL'] = 0;
					echo $salary['TOTAL'];
				?></b></td>
			<td><b><?php 
					$salary = Yii::app()->db->createCommand("SELECT SUM(BILL_AMOUNT) AS TOTAL FROM tbl_bill WHERE  ID IN (".implode(",", $yearlyBillsArray).") AND BILL_TYPE=8 ")->queryRow();
				if(!isset($salary['TOTAL']))$salary['TOTAL'] = 0;
					echo $salary['TOTAL'];
				?></b></td>
			<td></td>
		</tr>
		<tr>
			<td>4</td>
			<td><b>Travelling Expenses(DTE)</b></td>
			<td><b><?php echo Budget::model()->findByPK(3)->AMOUNT;?></b></td>
				<td><b><?php 							
				$salary = Yii::app()->db->createCommand("SELECT SUM(BILL_AMOUNT) AS TOTAL FROM tbl_bill WHERE ID IN (".implode(",", $monthlyBillsArray).") AND BILL_TYPE=4 ")->queryRow();
				if(!isset($salary['TOTAL']))$salary['TOTAL'] = 0;
				echo $salary['TOTAL'];
			?></b></td>
			<td><b>0</b></td>
			<td><b><?php 
					$salary = Yii::app()->db->createCommand("SELECT SUM(BILL_AMOUNT) AS TOTAL FROM tbl_bill WHERE  ID IN (".implode(",", $monthlyBillsArray).") AND BILL_TYPE=4 ")->queryRow();
					if(!isset($salary['TOTAL']))$salary['TOTAL'] = 0;
					echo $salary['TOTAL'];
				?></b></td>		
			<td><b><?php 
					$salary = Yii::app()->db->createCommand("SELECT SUM(BILL_AMOUNT) AS TOTAL FROM tbl_bill WHERE  ID IN (".implode(",", $yearlyBillsArray).") AND BILL_TYPE=4 ")->queryRow();
				if(!isset($salary['TOTAL']))$salary['TOTAL'] = 0;
					echo $salary['TOTAL'];
				?></b></td>	
			<td></td>
		</tr>
		<tr>
			<td>5</td>
			<td><b>कार्यालय व्यय/ Office Expenses</b></td>
			<td><b><?php echo Budget::model()->findByPK(2)->AMOUNT;?></b></td>
			<td>
				<b>
				<?php 							
				$salary = Yii::app()->db->createCommand("SELECT SUM(BILL_AMOUNT) AS TOTAL FROM tbl_bill WHERE ID IN (".implode(",", $monthlyBillsArray).") AND BILL_TYPE=3 ")->queryRow();
				if(!isset($salary['TOTAL']))$salary['TOTAL'] = 0;
				echo $salary['TOTAL'];
				?>
				</b>
			</td>
			<td><b>0</b></td>
			<td>
				<b>
				<?php 
					$salary = Yii::app()->db->createCommand("SELECT SUM(BILL_AMOUNT) AS TOTAL FROM tbl_bill WHERE ID IN (".implode(",", $monthlyBillsArray).") AND  BILL_TYPE=3 ")->queryRow();
					if(!isset($salary['TOTAL']))$salary['TOTAL'] = 0;
					echo $salary['TOTAL'];
				?>
				</b>
			</td>
			<td>
			<b><?php 
					$salary = Yii::app()->db->createCommand("SELECT SUM(BILL_AMOUNT) AS TOTAL FROM tbl_bill WHERE ID IN (".implode(",", $yearlyBillsArray).") AND  BILL_TYPE=3 ")->queryRow();
				if(!isset($salary['TOTAL']))$salary['TOTAL'] = 0;
					echo $salary['TOTAL'];
				?></b>
			</td>
			<td></td>
		</tr>
		<tr>
			<td>6</td>
			<td><b>सुचना तकनीकी/ Information Technology</b></td>
			<td>0</td>
			<td>0</td>
			<td>0</td>
			<td>0</td>
			<td>0</td>
			<td></td>
		</tr>
		<tr>
			<td>7</td>
			<td>Prof.Spl.Service(law charges)</td>
			<td>0</td>
			<td>0</td>
			<td>0</td>
			<td>0</td>
			<td>0</td>
			<td></td>
		</tr>
		<tr>
			<td>8</td>
			<td><b>आर.आर. टी./ Rent Rate & Taxes</b></td>
			<td>0</td>
			<td>0</td>
			<td>0</td>
			<td>0</td>
			<td>0</td>
			<td></td>
		</tr>
		<tr>
			<td>9</td>
			<td>Secret Service Expr. (Other Charges)</td>
			<td>0</td>
			<td>0</td>
			<td>0</td>
			<td>0</td>
			<td>0</td>
			<td></td>
		</tr>
		<tr>
			<td>10</td>
			<td><b>O T A</b></td>
			<td><b>0</b></td>
			<td><b>0</b></td>
			<td><b>0</b></td>
			<td><b>0</b></td>
			<td><b>0</b></td>
			<td></td>
		</tr>
		<tr>
			<td></td>
			<td>TOTAL OF 3 TO 10</td>
			<td><b><?php echo Budget::model()->findByPK(3)->AMOUNT + Budget::model()->findByPK(4)->AMOUNT;?></b></td>
			<?php $t2 = 0;$t3 = 0;?>
			<td><b><?php 							
				$salary = Yii::app()->db->createCommand("SELECT SUM(BILL_AMOUNT) AS TOTAL FROM tbl_bill WHERE ID IN (".implode(",", $monthlyBillsArray).") AND BILL_TYPE IN (3,4,8)")->queryRow();
				if(!isset($salary['TOTAL']))$salary['TOTAL'] = 0;
				$t2 = $salary['TOTAL']; 
				echo $salary['TOTAL'];
			?></b></td>
			<td><b>0</b></td>
			<td><b><?php 
					$salary = Yii::app()->db->createCommand("SELECT SUM(BILL_AMOUNT) AS TOTAL FROM tbl_bill WHERE ID IN (".implode(",", $monthlyBillsArray).") AND BILL_TYPE IN (3,4,8)")->queryRow();
					if(!isset($salary['TOTAL']))$salary['TOTAL'] = 0;
					echo $salary['TOTAL'];
				?></b></td>
			<td><b><?php 
					$salary = Yii::app()->db->createCommand("SELECT SUM(BILL_AMOUNT) AS TOTAL FROM tbl_bill WHERE ID IN (".implode(",", $yearlyBillsArray).") AND BILL_TYPE IN (3,4,8)")->queryRow();
				if(!isset($salary['TOTAL']))$salary['TOTAL'] = 0;
					$t3 = $salary['TOTAL'];
					echo $salary['TOTAL'];
				?></b></td>
			<td></td>
		</tr>
		<tr>
			<td></td>
			<td><b>GRAND TOTAL</b></td>
			<td><b><?php echo Budget::model()->findByPK(1)->AMOUNT + Budget::model()->findByPK(2)->AMOUNT + Budget::model()->findByPK(3)->AMOUNT + Budget::model()->findByPK(4)->AMOUNT + Budget::model()->findByPK(5)->AMOUNT + Budget::model()->findByPK(7)->AMOUNT;?></b></td>
			<td><b><?php 	
				$total1 = Yii::app()->db->createCommand("SELECT SUM(FEST_EMI) + SUM(BASIC) + SUM(GP) + SUM(DA) + SUM(SP) + SUM(PP) + SUM(HRA) + SUM(CCA) + SUM(TA) + SUM(WA) + SUM(BONUS) - SUM(MISC) AS TOTAL FROM tbl_salary_details WHERE BILL_ID_FK IN (".implode(",", $monthlyBillsArray).")")->queryRow()['TOTAL'];
				$total2 = $t2; 
				echo $total1 + $total2;
			?></b></td>
			<td><b>0</b></td>
			<td><b><?php 	
				echo $total1 + $total2;
			?></b></td>
			<td><b><?php 	
				$total3 = Yii::app()->db->createCommand("SELECT SUM(FEST_EMI) + SUM(BASIC) + SUM(GP) + SUM(DA) + SUM(SP) + SUM(PP) + SUM(HRA) + SUM(CCA) + SUM(TA) + SUM(WA) + SUM(BONUS) - SUM(MISC) AS TOTAL FROM tbl_salary_details WHERE BILL_ID_FK IN (".implode(",", $yearlyBillsArray).")")->queryRow()['TOTAL'];
				echo $total3 + $total2;
			?></b></td>
			<td></td>
		</tr>
		<tr>
			<td></td>
			<td><b>Total after recovery of FA/OP</b></td>
			<td><b><?php echo Budget::model()->findByPK(1)->AMOUNT + Budget::model()->findByPK(2)->AMOUNT + Budget::model()->findByPK(3)->AMOUNT + Budget::model()->findByPK(5)->AMOUNT;?></b></td>
			<td><b><?php 	
				echo $total1 + $total2;
			?></b></td>
			<td><b>0</b></td>
			<td><b><?php 	
				echo $total1 + $total2;
			?></b></td>
			<td><b><?php 	
				echo $total3 + $total2;
			?></b></td>
			<td></td>
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
</style>

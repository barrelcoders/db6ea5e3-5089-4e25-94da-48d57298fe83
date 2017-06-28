<?php require_once "/../../../../include/ExpenditureReportInclude.php";?>
<?php
	
	$monthName = array('1'=>'January', '2'=>'February', '3'=>'March', '4'=>'April', '5'=>'May', '6'=>'June', '7'=>'July', '8'=>'August', '9'=>'September', '10'=>'October', '11'=>'November', '12'=>'December');
	$monthNameHindi = array('1'=>'जनवरी', '2'=>'फ़रवरी', '3'=>'मार्च', '4'=>'अप्रैल', '5'=>'मई', '6'=>'जून', '7'=>'जुलाई', '8'=>'अगस्त', '9'=>'सितंबर', '10'=>'अक्टूबर', '11'=>'नवंबर', '12'=>'दिसंबर'); 
	$master = Master::model()->findByPK(1);
?>
<p style="font-size: 20px;text-align: center;font-weight: bold;">अनुबंध-१/ANNEXURE - I	</p>
<span style="font-size: 15px;font-weight: bold;"><?php echo $master->OFFICE_NAME_HINDI;?><br><?php echo $master->OFFICE_NAME;?></span>
<div style="float: right;font-weight: bold;">
	<p>MAJOR HEAD : 2038 Union Excise Duties</p>
	<p>MINOR HEAD : B.2(2) Other Offices.</p>
</div>
<p style="font-size: 15px;text-align: center;font-weight: bold;"><?php echo $monthNameHindi[$this->Month]?> -<?php echo $this->Year?> माह के लिए मासिक व्यय विवरण/MONTHLY EXPENDITURE STATEMENT FOR THE MONTH OF - <?php echo $monthName[$this->Month]?> <?php echo $this->Year?></p>
<br><br>
<table class="one-table" >
	<thead>
		<tr>
			<th>Sl.NO</th>
			<th>बिल सं. एवं दिनांक/ Bill No. and Date</th>
			<th>अधिकारी का वेतन/Pay of Officers</th>
			<th>Pay of Establishment</th>
			<th>सवंर्ग वेतन/GRADE  PAY</th>
			<th>महंगाई भत्ता/ Dearness Allowances</th>
			<th>म.की.भ./ H.R.A.</th>
			<th>C.C.A</th>
			<th>यात्रा भत्ता/ T.A</th>
			<th>CEA(Tuition Fee)</th>
			<th>वर्दी भत्ता/Uniform allowance/ IEA</th>
			<th>धुलाई भत्ता/ Washing Allowance</th>
			<th>बोनस/  Bonus</th>
			<th>LTC / HTC</th>
			<th>Any other allowances PP/SP</th>
			<th>TOTAL OTHER ALLOWANCE</th>
			<th>Festival Advances</th>
			<th>कुल वेतन/ GROSS SALARIES</th>
			<th>Recovery of FA / Overpayment .................Etc</th>
			<th>TOTAL OF SALARIES</th>
		</tr>
	</thead>
	<tbody>
		<?php
			$criteria=new CDbCriteria;        
			$criteria->compare("MONTH(PASSED_DATE)",$this->Month);
			$criteria->compare("YEAR(PASSED_DATE)",$this->Year);
			$criteria->compare("PFMS_STATUS",'Passed');
			$criteria->addInCondition("BILL_TYPE",array(1,2));
			$salaryBills = Bill::model()-> findAll($criteria);
			$i=1;
			$billsArray = array();
				foreach($salaryBills as $bill){
					array_push($billsArray, $bill->ID);
					if(count($billsArray) > 0) {
						if(!$bill->IS_ARREAR_BILL && !$bill->IS_BONUS_BILL && !$bill->IS_UA_BILL && !$bill->IS_LTC_HTC_BILL && !$bill->IS_CEA_BILL){ ?>
								<tr>
									<td rowspan="2"><?php echo $i;?></td>
									<td rowspan="2"><?php echo $bill->BILL_NO;?></td>
									<?php
										$employees = Yii::app()->db->createCommand("SELECT ID FROM tbl_employee WHERE DESIGNATION_ID_FK > 14")->queryAll();
										$OfficersEmployeesIds = array();
										foreach($employees as $employee) array_push($OfficersEmployeesIds, $employee['ID']);
									?>
									<td>
									<?php 
										$salary = Yii::app()->db->createCommand("SELECT SUM(BASIC) AS BASIC FROM tbl_salary_details WHERE BILL_ID_FK=$bill->ID AND EMPLOYEE_ID_FK IN (".implode(",", $OfficersEmployeesIds).")")->queryRow();							
										if(!isset($salary['BASIC']))$salary['BASIC'] = 0;
										echo $salary['BASIC'];
									?>
									</td>
									<td></td>
									<td><?php 							
										$salary = Yii::app()->db->createCommand("SELECT SUM(GP) AS GP FROM tbl_salary_details WHERE BILL_ID_FK=$bill->ID AND EMPLOYEE_ID_FK IN (".implode(",", $OfficersEmployeesIds).")")->queryRow();							
										if(!isset($salary['GP']))$salary['GP'] = 0;
										echo $salary['GP'];
									?></td>
									<td><?php 							
										$salary = Yii::app()->db->createCommand("SELECT SUM(DA) AS DA FROM tbl_salary_details WHERE BILL_ID_FK=$bill->ID AND EMPLOYEE_ID_FK IN (".implode(",", $OfficersEmployeesIds).")")->queryRow();							
										if(!isset($salary['DA']))$salary['DA'] = 0;
										echo $salary['DA'];
									?></td>
									<td><?php 							
										$salary = Yii::app()->db->createCommand("SELECT SUM(HRA) AS HRA FROM tbl_salary_details WHERE BILL_ID_FK=$bill->ID AND EMPLOYEE_ID_FK IN (".implode(",", $OfficersEmployeesIds).")")->queryRow();							
										if(!isset($salary['HRA']))$salary['HRA'] = 0;
										echo $salary['HRA'];
									?></td>
									<td><?php 							
										$salary = Yii::app()->db->createCommand("SELECT SUM(CCA) AS CCA FROM tbl_salary_details WHERE BILL_ID_FK=$bill->ID AND EMPLOYEE_ID_FK IN (".implode(",", $OfficersEmployeesIds).")")->queryRow();							
										if(!isset($salary['CCA']))$salary['CCA'] = 0;
										echo $salary['CCA'];
									?></td>
									<td><?php 							
										$salary = Yii::app()->db->createCommand("SELECT SUM(TA) AS TA FROM tbl_salary_details WHERE BILL_ID_FK=$bill->ID AND EMPLOYEE_ID_FK IN (".implode(",", $OfficersEmployeesIds).")")->queryRow();							
										if(!isset($salary['TA']))$salary['TA'] = 0;
										echo $salary['TA'];
									?></td>
									<td></td>
									<td></td>
									<td><?php 							
										$salary = Yii::app()->db->createCommand("SELECT SUM(WA) AS WA FROM tbl_salary_details WHERE BILL_ID_FK=$bill->ID AND EMPLOYEE_ID_FK IN (".implode(",", $OfficersEmployeesIds).")")->queryRow();							
										if(!isset($salary['WA']))$salary['WA'] = 0;
										echo $salary['WA'];
									?></td>
									<td></td>
									<td></td>
									<td><?php 							
										$salary = Yii::app()->db->createCommand("SELECT SUM(SP) + SUM(PP) AS PP FROM tbl_salary_details WHERE BILL_ID_FK=$bill->ID AND EMPLOYEE_ID_FK IN (".implode(",", $OfficersEmployeesIds).")")->queryRow();							
										if(!isset($salary['PP']))$salary['PP'] = 0;
										echo $salary['PP'];
									?></td>
									<td><?php 							
										$salary = Yii::app()->db->createCommand("SELECT SUM(HRA) + SUM(CCA) + SUM(TA) + SUM(WA) + SUM(PP) + SUM(SP) AS TOTAL FROM tbl_salary_details WHERE BILL_ID_FK=$bill->ID AND EMPLOYEE_ID_FK IN (".implode(",", $OfficersEmployeesIds).")")->queryRow();
										if(!isset($salary['TOTAL']))$salary['TOTAL'] = 0;
										echo $salary['TOTAL'];
									?></td>
									<td><?php 							
										$salary = Yii::app()->db->createCommand("SELECT SUM(FEST_EMI) AS FEST FROM tbl_salary_details WHERE BILL_ID_FK=$bill->ID AND EMPLOYEE_ID_FK IN (".implode(",", $OfficersEmployeesIds).")")->queryRow();
										if(!isset($salary['FEST']))$salary['FEST'] = 0;
										echo $salary['FEST'];
									?></td>
									<td><?php 	
										$total = 0;
										$salary = Yii::app()->db->createCommand("SELECT SUM(BASIC) + SUM(GP) + SUM(DA) + SUM(HRA) + SUM(CCA) + SUM(TA) + SUM(WA) + SUM(PP) + SUM(SP) AS TOTAL FROM tbl_salary_details WHERE BILL_ID_FK=$bill->ID AND EMPLOYEE_ID_FK IN (".implode(",", $OfficersEmployeesIds).")")->queryRow();
										$total = $salary['TOTAL'];
										echo $total;
									?></td>
									<td><?php 							
										$salary = Yii::app()->db->createCommand("SELECT SUM(MISC) AS MISC FROM tbl_salary_details WHERE BILL_ID_FK=$bill->ID AND EMPLOYEE_ID_FK IN (".implode(",", $OfficersEmployeesIds).")")->queryRow();							
										if(!isset($salary['MISC']))$salary['MISC'] = 0;
										echo $salary['MISC'];
									?></td>
									<td><?php echo $total - $salary['MISC'];?></td>
								</tr>
								<tr>
									<td></td>
									<td>
									<?php
										$employees = Yii::app()->db->createCommand("SELECT ID FROM tbl_employee WHERE DESIGNATION_ID_FK <= 14")->queryAll();
										$EstdemployeesIds = array();
										foreach($employees as $employee) array_push($EstdemployeesIds, $employee['ID']);
									?>
									<?php 							
										$salary = Yii::app()->db->createCommand("SELECT SUM(BASIC) AS BASIC FROM tbl_salary_details WHERE BILL_ID_FK=$bill->ID AND EMPLOYEE_ID_FK IN (".implode(",", $EstdemployeesIds).")")->queryRow();							
										if(!isset($salary['BASIC']))$salary['BASIC'] = 0;
										echo $salary['BASIC'];
									?></td>
									<td><?php 	
										$salary = Yii::app()->db->createCommand("SELECT SUM(GP) AS GP FROM tbl_salary_details WHERE BILL_ID_FK=$bill->ID AND EMPLOYEE_ID_FK IN (".implode(",", $EstdemployeesIds).")")->queryRow();							
										if(!isset($salary['GP']))$salary['GP'] = 0;
										echo $salary['GP'];
									?></td>
									<td><?php 	
										$salary = Yii::app()->db->createCommand("SELECT SUM(DA) AS DA FROM tbl_salary_details WHERE BILL_ID_FK=$bill->ID AND EMPLOYEE_ID_FK IN (".implode(",", $EstdemployeesIds).")")->queryRow();							
										if(!isset($salary['DA']))$salary['DA'] = 0;
										echo $salary['DA'];
									?></td>
									<td><?php 							
										$salary = Yii::app()->db->createCommand("SELECT SUM(HRA) AS HRA FROM tbl_salary_details WHERE BILL_ID_FK=$bill->ID AND EMPLOYEE_ID_FK IN (".implode(",", $EstdemployeesIds).")")->queryRow();							
										if(!isset($salary['HRA']))$salary['HRA'] = 0;
										echo $salary['HRA'];
									?></td>
									<td><?php 							
										$salary = Yii::app()->db->createCommand("SELECT SUM(CCA) AS CCA FROM tbl_salary_details WHERE BILL_ID_FK=$bill->ID AND EMPLOYEE_ID_FK IN (".implode(",", $EstdemployeesIds).")")->queryRow();							
										if(!isset($salary['CCA']))$salary['CCA'] = 0;
										echo $salary['CCA'];
									?></td>
									<td><?php 							
										$salary = Yii::app()->db->createCommand("SELECT SUM(TA) AS TA FROM tbl_salary_details WHERE BILL_ID_FK=$bill->ID AND EMPLOYEE_ID_FK IN (".implode(",", $EstdemployeesIds).")")->queryRow();							
										if(!isset($salary['TA']))$salary['TA'] = 0;
										echo $salary['TA'];
									?></td>
									<td></td>
									<td></td>
									<td><?php 							
										$salary = Yii::app()->db->createCommand("SELECT SUM(WA) AS WA FROM tbl_salary_details WHERE BILL_ID_FK=$bill->ID AND EMPLOYEE_ID_FK IN (".implode(",", $EstdemployeesIds).")")->queryRow();							
										if(!isset($salary['WA']))$salary['WA'] = 0;
										echo $salary['WA'];
									?></td>
									<td></td>
									<td></td>
									<td><?php
										$salary = Yii::app()->db->createCommand("SELECT SUM(SP) + SUM(PP) AS SP FROM tbl_salary_details WHERE BILL_ID_FK=$bill->ID AND EMPLOYEE_ID_FK IN (".implode(",", $EstdemployeesIds).")")->queryRow();							
										if(!isset($salary['SP']))$salary['SP'] = 0;
										echo $salary['SP'];
									?></td>
									<td><?php 							
										$salary = Yii::app()->db->createCommand("SELECT SUM(HRA) + SUM(CCA) + SUM(TA) + SUM(WA) + SUM(PP) + SUM(SP) AS TOTAL FROM tbl_salary_details WHERE BILL_ID_FK=$bill->ID AND EMPLOYEE_ID_FK IN (".implode(",", $EstdemployeesIds).")")->queryRow();
										if(!isset($salary['TOTAL']))$salary['TOTAL'] = 0;
										echo $salary['TOTAL'];
									?></td>
									<td><?php 							
										$salary = Yii::app()->db->createCommand("SELECT SUM(FEST_EMI) AS FEST FROM tbl_salary_details WHERE BILL_ID_FK=$bill->ID AND EMPLOYEE_ID_FK IN (".implode(",", $EstdemployeesIds).")")->queryRow();
										if(!isset($salary['FEST']))$salary['FEST'] = 0;
										echo $salary['FEST'];
									?></td>
									<td><?php
										$total = 0;
										$salary = Yii::app()->db->createCommand("SELECT SUM(BASIC) + SUM(GP) + SUM(DA) + SUM(HRA) + SUM(CCA) + SUM(TA) + SUM(WA) + SUM(PP) + SUM(SP) AS TOTAL FROM tbl_salary_details WHERE BILL_ID_FK=$bill->ID AND EMPLOYEE_ID_FK IN (".implode(",", $EstdemployeesIds).")")->queryRow();
										$total = $salary['TOTAL'];
										echo $total;
									?></td>
									<td><?php 							
										$salary = Yii::app()->db->createCommand("SELECT SUM(MISC) AS MISC FROM tbl_salary_details WHERE BILL_ID_FK=$bill->ID AND EMPLOYEE_ID_FK IN (".implode(",", $EstdemployeesIds).")")->queryRow();							
										if(!isset($salary['MISC']))$salary['MISC'] = 0;
										echo $salary['MISC'];
									?></td>
									<td><?php 							
										echo $total - $salary['MISC'];
									?></td>
								</tr>
							<?php
						}
						else {
							$EmployeesIds = array();
							$employees = explode(",", Yii::app()->db->createCommand("SELECT EMPLOYEE_ID FROM tbl_other_bill_employees WHERE BILL_ID=$bill->ID")->queryRow()['EMPLOYEE_ID']);
							foreach($employees as $id){
								array_push($EmployeesIds, $id);
							}
							if(count($EmployeesIds) > 0) { ?>
								<tr>
									<td ><?php echo $i;?></td>
									<td ><?php echo $bill->BILL_NO;?></td>
									
									<td>
									<?php 
										$salary = Yii::app()->db->createCommand("SELECT SUM(BASIC) AS BASIC FROM tbl_salary_details WHERE BILL_ID_FK=$bill->ID")->queryRow();							
										if(!isset($salary['BASIC']))$salary['BASIC'] = 0;
										echo $salary['BASIC'];
									?>
									</td>
									<td></td>
									<td><?php 							
										$salary = Yii::app()->db->createCommand("SELECT SUM(GP) AS GP FROM tbl_salary_details WHERE BILL_ID_FK=$bill->ID")->queryRow();							
										if(!isset($salary['GP']))$salary['GP'] = 0;
										echo $salary['GP'];
									?></td>
									<td><?php 							
										$salary = Yii::app()->db->createCommand("SELECT SUM(DA) AS DA FROM tbl_salary_details WHERE BILL_ID_FK=$bill->ID")->queryRow();							
										if(!isset($salary['DA']))$salary['DA'] = 0;
										echo $salary['DA'];
									?></td>
									<td><?php 							
										$salary = Yii::app()->db->createCommand("SELECT SUM(HRA) AS HRA FROM tbl_salary_details WHERE BILL_ID_FK=$bill->ID")->queryRow();							
										if(!isset($salary['HRA']))$salary['HRA'] = 0;
										echo $salary['HRA'];
									?></td>
									<td><?php 							
										$salary = Yii::app()->db->createCommand("SELECT SUM(CCA) AS CCA FROM tbl_salary_details WHERE BILL_ID_FK=$bill->ID")->queryRow();							
										if(!isset($salary['CCA']))$salary['CCA'] = 0;
										echo $salary['CCA'];
									?></td>
									<td><?php 							
										$salary = Yii::app()->db->createCommand("SELECT SUM(TA) AS TA FROM tbl_salary_details WHERE BILL_ID_FK=$bill->ID")->queryRow();							
										if(!isset($salary['TA']))$salary['TA'] = 0;
										echo $salary['TA'];
									?></td>
									<td><?php 							
										$salary = Yii::app()->db->createCommand("SELECT SUM(CEA) AS CEA FROM tbl_salary_details WHERE BILL_ID_FK=$bill->ID")->queryRow();							
										if(!isset($salary['CEA']))$salary['CEA'] = 0;
										echo $salary['CEA'];
									?></td>
									<td><?php 							
										$salary = Yii::app()->db->createCommand("SELECT SUM(UA) AS UA FROM tbl_salary_details WHERE BILL_ID_FK=$bill->ID")->queryRow();							
										if(!isset($salary['UA']))$salary['UA'] = 0;
										echo $salary['UA'];
									?></td>
									<td><?php 							
										$salary = Yii::app()->db->createCommand("SELECT SUM(WA) AS WA FROM tbl_salary_details WHERE BILL_ID_FK=$bill->ID")->queryRow();							
										if(!isset($salary['WA']))$salary['WA'] = 0;
										echo $salary['WA'];
									?></td>
									<td><?php 							
										$salary = Yii::app()->db->createCommand("SELECT SUM(BONUS) AS BONUS FROM tbl_salary_details WHERE BILL_ID_FK=$bill->ID")->queryRow();							
										if(!isset($salary['BONUS']))$salary['BONUS'] = 0;
										echo $salary['BONUS'];
									?></td>
									<td><?php 							
										$salary = Yii::app()->db->createCommand("SELECT SUM(LTC_HTC) AS LTC_HTC FROM tbl_salary_details WHERE BILL_ID_FK=$bill->ID")->queryRow();							
										if(!isset($salary['LTC_HTC']))$salary['LTC_HTC'] = 0;
										echo $salary['LTC_HTC'];
									?></td>
									<td><?php 							
										$salary = Yii::app()->db->createCommand("SELECT SUM(SP) + SUM(PP) AS PP FROM tbl_salary_details WHERE BILL_ID_FK=$bill->ID")->queryRow();							
										if(!isset($salary['PP']))$salary['PP'] = 0;
										echo $salary['PP'];
									?></td>
									<td><?php 							
										$salary = Yii::app()->db->createCommand("SELECT SUM(HRA) + SUM(CCA) + SUM(TA) + SUM(CEA) + SUM(UA) + SUM(WA) + SUM(BONUS) + SUM(LTC_HTC) + SUM(PP) + SUM(SP) AS TOTAL FROM tbl_salary_details WHERE BILL_ID_FK=$bill->ID")->queryRow();
										if(!isset($salary['TOTAL']))$salary['TOTAL'] = 0;
										echo $salary['TOTAL'];
									?></td>
									<td><?php 							
										$salary = Yii::app()->db->createCommand("SELECT SUM(FEST_EMI) AS FEST FROM tbl_salary_details WHERE BILL_ID_FK=$bill->ID")->queryRow();
										if(!isset($salary['FEST']))$salary['FEST'] = 0;
										echo $salary['FEST'];
									?></td>
									<td><?php 	
										$total = 0;
										$salary = Yii::app()->db->createCommand("SELECT SUM(BASIC) + SUM(GP) + SUM(DA) + SUM(HRA) + SUM(CCA) + SUM(TA) + SUM(CEA) + SUM(UA) + SUM(WA) + SUM(BONUS) + SUM(LTC_HTC) + SUM(PP) + SUM(SP) AS TOTAL FROM tbl_salary_details WHERE BILL_ID_FK=$bill->ID")->queryRow();
										$total = $salary['TOTAL'];
										echo $total;
									?></td>
									<td><?php 							
										$salary = Yii::app()->db->createCommand("SELECT SUM(MISC) AS MISC FROM tbl_salary_details WHERE BILL_ID_FK=$bill->ID")->queryRow();							
										if(!isset($salary['MISC']))$salary['MISC'] = 0;
										echo $salary['MISC'];
									?></td>
									<td><?php echo $total - $salary['MISC'];?></td>
								</tr>
							<?php
							}
						}
					}
					$i++;
				}
			
		?>
		<?php if(count($billsArray) > 0) { ?>
			<tr>
				<td colspan="2">कुल/ TOTAL</td>
				<?php
					$employees = Yii::app()->db->createCommand("SELECT ID FROM tbl_employee WHERE DESIGNATION_ID_FK > 14")->queryAll();
					$OfficersEmployeesIds = array();
					foreach($employees as $employee) array_push($OfficersEmployeesIds, $employee['ID']);
				?>
				<?php
					$employees = Yii::app()->db->createCommand("SELECT ID FROM tbl_employee WHERE DESIGNATION_ID_FK <= 14")->queryAll();
					$EstEmployeesIds = array();
					foreach($employees as $employee) array_push($EstEmployeesIds, $employee['ID']);
				?>
				<?php
					$employees = Yii::app()->db->createCommand("SELECT ID FROM tbl_employee")->queryAll();
					$AllEmployeesIds = array();
					foreach($employees as $employee) array_push($AllEmployeesIds, $employee['ID']);
				?>
				<td>
				<?php 
				
					$salary = Yii::app()->db->createCommand("SELECT SUM(BASIC) AS BASIC FROM tbl_salary_details WHERE BILL_ID_FK IN (".implode($billsArray, ',').") AND EMPLOYEE_ID_FK IN (".implode(",", $OfficersEmployeesIds).")")->queryRow();							
					if(!isset($salary['BASIC']))$salary['BASIC'] = 0;
					echo $salary['BASIC'];
				?>
				</td>
				<td>
				<?php 
					$salary = Yii::app()->db->createCommand("SELECT SUM(BASIC) AS BASIC FROM tbl_salary_details WHERE BILL_ID_FK IN (".implode($billsArray, ',').") AND EMPLOYEE_ID_FK IN (".implode(",", $EstEmployeesIds).")")->queryRow();							
					if(!isset($salary['BASIC']))$salary['BASIC'] = 0;
					echo $salary['BASIC'];
				?></td>
				<td><?php 							
					$salary = Yii::app()->db->createCommand("SELECT SUM(GP) AS GP FROM tbl_salary_details WHERE BILL_ID_FK IN (".implode($billsArray, ',').")")->queryRow();							
					if(!isset($salary['GP']))$salary['GP'] = 0;
					echo $salary['GP'];
				?></td>
				<td><?php 							
					$salary = Yii::app()->db->createCommand("SELECT SUM(DA) AS DA FROM tbl_salary_details WHERE BILL_ID_FK IN (".implode($billsArray, ',').")")->queryRow();							
					if(!isset($salary['DA']))$salary['DA'] = 0;
					echo $salary['DA'];
				?></td>
				<td><?php 							
					$salary = Yii::app()->db->createCommand("SELECT SUM(HRA) AS HRA FROM tbl_salary_details WHERE BILL_ID_FK IN (".implode($billsArray, ',').")")->queryRow();							
					if(!isset($salary['HRA']))$salary['HRA'] = 0;
					echo $salary['HRA'];
				?></td>
				<td><?php 							
					$salary = Yii::app()->db->createCommand("SELECT SUM(CCA) AS CCA FROM tbl_salary_details WHERE BILL_ID_FK IN (".implode($billsArray, ',').")")->queryRow();							
					if(!isset($salary['CCA']))$salary['CCA'] = 0;
					echo $salary['CCA'];
				?></td>
				<td><?php 							
					$salary = Yii::app()->db->createCommand("SELECT SUM(TA) AS TA FROM tbl_salary_details WHERE BILL_ID_FK IN (".implode($billsArray, ',').")")->queryRow();							
					if(!isset($salary['TA']))$salary['TA'] = 0;
					echo $salary['TA'];
				?></td>
				<td><?php 							
					$salary = Yii::app()->db->createCommand("SELECT SUM(CEA) AS CEA FROM tbl_salary_details WHERE BILL_ID_FK IN (".implode($billsArray, ',').")")->queryRow();							
					if(!isset($salary['CEA']))$salary['CEA'] = 0;
					echo $salary['CEA'];
				?></td>
				<td><?php 							
					$salary = Yii::app()->db->createCommand("SELECT SUM(UA) AS UA FROM tbl_salary_details WHERE BILL_ID_FK IN (".implode($billsArray, ',').")")->queryRow();							
					if(!isset($salary['UA']))$salary['UA'] = 0;
					echo $salary['UA'];
				?></td>
				<td><?php 							
					$salary = Yii::app()->db->createCommand("SELECT SUM(WA) AS WA FROM tbl_salary_details WHERE BILL_ID_FK IN (".implode($billsArray, ',').")")->queryRow();							
					if(!isset($salary['WA']))$salary['WA'] = 0;
					echo $salary['WA'];
				?></td>
				<td><?php 							
					$salary = Yii::app()->db->createCommand("SELECT SUM(BONUS) AS BONUS FROM tbl_salary_details WHERE BILL_ID_FK IN (".implode($billsArray, ',').")")->queryRow();							
					if(!isset($salary['BONUS']))$salary['BONUS'] = 0;
					echo $salary['BONUS'];
				?></td>
				<td><?php 							
					$salary = Yii::app()->db->createCommand("SELECT SUM(LTC_HTC) AS LTC_HTC FROM tbl_salary_details WHERE BILL_ID_FK IN (".implode($billsArray, ',').")")->queryRow();							
					if(!isset($salary['LTC_HTC']))$salary['LTC_HTC'] = 0;
					echo $salary['LTC_HTC'];
				?></td>
				<td><?php 							
					$salary = Yii::app()->db->createCommand("SELECT SUM(SP) + SUM(PP) AS PP FROM tbl_salary_details WHERE BILL_ID_FK IN (".implode($billsArray, ',').")")->queryRow();							
					if(!isset($salary['PP']))$salary['PP'] = 0;
					echo $salary['PP'];
				?></td>
				<td><?php 							
					$salary = Yii::app()->db->createCommand("SELECT SUM(HRA) + SUM(CCA) + SUM(TA) + SUM(CEA) + SUM(UA) + SUM(WA) + SUM(BONUS) + SUM(LTC_HTC) + SUM(PP) + SUM(SP) AS TOTAL FROM tbl_salary_details WHERE BILL_ID_FK IN (".implode($billsArray, ',').")")->queryRow();
					if(!isset($salary['TOTAL']))$salary['TOTAL'] = 0;
					echo $salary['TOTAL'];
				?></td>
				<td><?php 							
					$salary = Yii::app()->db->createCommand("SELECT SUM(FEST_EMI) AS FEST FROM tbl_salary_details WHERE BILL_ID_FK IN (".implode($billsArray, ',').")")->queryRow();
					if(!isset($salary['FEST']))$salary['FEST'] = 0;
					echo $salary['FEST'];
				?></td>
				<td><?php 	
					$total = 0;
					$salary = Yii::app()->db->createCommand("SELECT SUM(BASIC) + SUM(GP) + SUM(DA) + SUM(HRA) + SUM(CCA) + SUM(TA) + SUM(CEA) + SUM(UA) + SUM(WA) + SUM(BONUS) + SUM(LTC_HTC) + SUM(PP) + SUM(SP) AS TOTAL FROM tbl_salary_details WHERE BILL_ID_FK IN (".implode($billsArray, ',').")")->queryRow();
					$total = $salary['TOTAL'];
					echo $total;
				?></td>
				<td><?php 							
					$salary = Yii::app()->db->createCommand("SELECT SUM(MISC) AS MISC FROM tbl_salary_details WHERE BILL_ID_FK IN (".implode($billsArray, ',').")")->queryRow();							
					if(!isset($salary['MISC']))$salary['MISC'] = 0;
					echo $salary['MISC'];
				?></td>
				<td><?php echo $total - $salary['MISC'];?></td>
			</tr>
			<tr>
				<td colspan="2">Amount Re-Credited</td>
				<td>0</td>
				<td>0</td>
				<td>0</td>
				<td>0</td>
				<td>0</td>
				<td>0</td>
				<td>0</td>
				<td>0</td>
				<td>0</td>
				<td>0</td>
				<td>0</td>
				<td>0</td>
				<td>0</td>
				<td>0</td>
				<td>0</td>
				<td>0</td>
				<td>0</td>
				<td>0</td>
			</tr>
			<tr>
				<td colspan="2">NET TOTAL</td>
				<?php
					$employees = Yii::app()->db->createCommand("SELECT ID FROM tbl_employee WHERE DESIGNATION_ID_FK > 14")->queryAll();
					$OfficersEmployeesIds = array();
					foreach($employees as $employee) array_push($OfficersEmployeesIds, $employee['ID']);
				?>
				<?php
					$employees = Yii::app()->db->createCommand("SELECT ID FROM tbl_employee WHERE DESIGNATION_ID_FK <= 14")->queryAll();
					$EstEmployeesIds = array();
					foreach($employees as $employee) array_push($EstEmployeesIds, $employee['ID']);
				?>
				<?php
					$employees = Yii::app()->db->createCommand("SELECT ID FROM tbl_employee")->queryAll();
					$AllEmployeesIds = array();
					foreach($employees as $employee) array_push($AllEmployeesIds, $employee['ID']);
				?>
				<td>
				<?php 
					$salary = Yii::app()->db->createCommand("SELECT SUM(BASIC) AS BASIC FROM tbl_salary_details WHERE BILL_ID_FK IN (".implode($billsArray, ',').") AND EMPLOYEE_ID_FK IN (".implode(",", $OfficersEmployeesIds).")")->queryRow();							
					if(!isset($salary['BASIC']))$salary['BASIC'] = 0;
					echo $salary['BASIC'];
				?>
				</td>
				<td>
				<?php 
					$salary = Yii::app()->db->createCommand("SELECT SUM(BASIC) AS BASIC FROM tbl_salary_details WHERE BILL_ID_FK IN (".implode($billsArray, ',').") AND EMPLOYEE_ID_FK IN (".implode(",", $EstEmployeesIds).")")->queryRow();							
					if(!isset($salary['BASIC']))$salary['BASIC'] = 0;
					echo $salary['BASIC'];
				?></td>
				<td><?php 							
					$salary = Yii::app()->db->createCommand("SELECT SUM(GP) AS GP FROM tbl_salary_details WHERE BILL_ID_FK IN (".implode($billsArray, ',').")")->queryRow();							
					if(!isset($salary['GP']))$salary['GP'] = 0;
					echo $salary['GP'];
				?></td>
				<td><?php 							
					$salary = Yii::app()->db->createCommand("SELECT SUM(DA) AS DA FROM tbl_salary_details WHERE BILL_ID_FK IN (".implode($billsArray, ',').")")->queryRow();							
					if(!isset($salary['DA']))$salary['DA'] = 0;
					echo $salary['DA'];
				?></td>
				<td><?php 							
					$salary = Yii::app()->db->createCommand("SELECT SUM(HRA) AS HRA FROM tbl_salary_details WHERE BILL_ID_FK IN (".implode($billsArray, ',').")")->queryRow();							
					if(!isset($salary['HRA']))$salary['HRA'] = 0;
					echo $salary['HRA'];
				?></td>
				<td><?php 							
					$salary = Yii::app()->db->createCommand("SELECT SUM(CCA) AS CCA FROM tbl_salary_details WHERE BILL_ID_FK IN (".implode($billsArray, ',').")")->queryRow();							
					if(!isset($salary['CCA']))$salary['CCA'] = 0;
					echo $salary['CCA'];
				?></td>
				<td><?php 							
					$salary = Yii::app()->db->createCommand("SELECT SUM(TA) AS TA FROM tbl_salary_details WHERE BILL_ID_FK IN (".implode($billsArray, ',').")")->queryRow();							
					if(!isset($salary['TA']))$salary['TA'] = 0;
					echo $salary['TA'];
				?></td>
				<td><?php 							
					$salary = Yii::app()->db->createCommand("SELECT SUM(CEA) AS CEA FROM tbl_salary_details WHERE BILL_ID_FK IN (".implode($billsArray, ',').")")->queryRow();							
					if(!isset($salary['CEA']))$salary['CEA'] = 0;
					echo $salary['CEA'];
				?></td>
				<td><?php 	
					$salary = Yii::app()->db->createCommand("SELECT SUM(UA) AS UA FROM tbl_salary_details WHERE BILL_ID_FK IN (".implode($billsArray, ',').")")->queryRow();							
					if(!isset($salary['UA']))$salary['UA'] = 0;
					echo $salary['UA'];
				?></td>
				<td><?php 							
					$salary = Yii::app()->db->createCommand("SELECT SUM(WA) AS WA FROM tbl_salary_details WHERE BILL_ID_FK IN (".implode($billsArray, ',').")")->queryRow();							
					if(!isset($salary['WA']))$salary['WA'] = 0;
					echo $salary['WA'];
				?></td>
				<td><?php 							
					$salary = Yii::app()->db->createCommand("SELECT SUM(BONUS) AS BONUS FROM tbl_salary_details WHERE BILL_ID_FK IN (".implode($billsArray, ',').")")->queryRow();							
					if(!isset($salary['BONUS']))$salary['BONUS'] = 0;
					echo $salary['BONUS'];
				?></td>
				<td><?php 							
					$salary = Yii::app()->db->createCommand("SELECT SUM(LTC_HTC) AS LTC_HTC FROM tbl_salary_details WHERE BILL_ID_FK IN (".implode($billsArray, ',').")")->queryRow();							
					if(!isset($salary['LTC_HTC']))$salary['LTC_HTC'] = 0;
					echo $salary['LTC_HTC'];
				?></td>
				<td><?php 							
					$salary = Yii::app()->db->createCommand("SELECT SUM(SP) + SUM(PP) AS PP FROM tbl_salary_details WHERE BILL_ID_FK IN (".implode($billsArray, ',').")")->queryRow();							
					if(!isset($salary['PP']))$salary['PP'] = 0;
					echo $salary['PP'];
				?></td>
				<td><?php 							
					$salary = Yii::app()->db->createCommand("SELECT SUM(HRA) + SUM(CCA) + SUM(TA) + SUM(CEA) + SUM(UA) + SUM(WA) + SUM(BONUS) + SUM(LTC_HTC) + SUM(PP) + SUM(SP) AS TOTAL FROM tbl_salary_details WHERE BILL_ID_FK IN (".implode($billsArray, ',').")")->queryRow();
					if(!isset($salary['TOTAL']))$salary['TOTAL'] = 0;
					echo $salary['TOTAL'];
				?></td>
				<td><?php 							
					$salary = Yii::app()->db->createCommand("SELECT SUM(FEST_EMI) AS FEST FROM tbl_salary_details WHERE BILL_ID_FK IN (".implode($billsArray, ',').")")->queryRow();
					if(!isset($salary['FEST']))$salary['FEST'] = 0;
					echo $salary['FEST'];
				?></td>
				<td><?php 	
					$total = 0;
					$salary = Yii::app()->db->createCommand("SELECT SUM(BASIC) + SUM(GP) + SUM(DA) + SUM(HRA) + SUM(CCA) + SUM(TA) + SUM(CEA) + SUM(UA) + SUM(WA) + SUM(BONUS) + SUM(LTC_HTC) + SUM(PP) + SUM(SP) AS TOTAL FROM tbl_salary_details WHERE BILL_ID_FK IN (".implode($billsArray, ',').")")->queryRow();
					$total = $salary['TOTAL'];
					echo $total;
				?></td>
				<td><?php 							
					$salary = Yii::app()->db->createCommand("SELECT SUM(MISC) AS MISC FROM tbl_salary_details WHERE BILL_ID_FK IN (".implode($billsArray, ',').")")->queryRow();							
					if(!isset($salary['MISC']))$salary['MISC'] = 0;
					echo $salary['MISC'];
				?></td>
				<td><?php echo $total - $salary['MISC'];?></td>
			</tr>
			
		<?php } ?>	
			<?php
				$financialYear = FinancialYears::model()->find('STATUS=1');
				$criteria=new CDbCriteria;
				$criteria->condition = "PASSED_DATE >= '".date('Y-m-d', strtotime($financialYear->START_DATE))."' AND PASSED_DATE <= '".date_create($this->Year."-".$this->Month." last day of last month")->format('Y-m-d')."'";
				$criteria->compare("PFMS_STATUS",'Passed');
				$criteria->addInCondition("BILL_TYPE",array(1,2));
				$bills = Bill::model()-> findAll($criteria);
				$billsArray = array();
				foreach($bills as $bill)
					array_push($billsArray, $bill->ID);
				
				$queryCondition = "";
				if(count($billsArray) > 0){
					$queryCondition.="BILL_ID_FK IN (".implode($billsArray, ',').") AND ";
					?>
						
						<tr>
							<td colspan="2">Total upto Previous Month</td>
							<?php
								$employees = Yii::app()->db->createCommand("SELECT ID FROM tbl_employee WHERE DESIGNATION_ID_FK > 14")->queryAll();
								$OfficersEmployeesIds = array();
								foreach($employees as $employee) array_push($OfficersEmployeesIds, $employee['ID']);
							?>
							<?php
								$employees = Yii::app()->db->createCommand("SELECT ID FROM tbl_employee WHERE DESIGNATION_ID_FK <= 14")->queryAll();
								$EstEmployeesIds = array();
								foreach($employees as $employee) array_push($EstEmployeesIds, $employee['ID']);
							?>
							<?php
								$employees = Yii::app()->db->createCommand("SELECT ID FROM tbl_employee")->queryAll();
								$AllEmployeesIds = array();
								foreach($employees as $employee) array_push($AllEmployeesIds, $employee['ID']);
							?>
							<td>
							<?php 
								$salary = Yii::app()->db->createCommand("SELECT SUM(BASIC) AS BASIC FROM tbl_salary_details WHERE $queryCondition EMPLOYEE_ID_FK IN (".implode(",", $OfficersEmployeesIds).")")->queryRow();							
								if(!isset($salary['BASIC']))$salary['BASIC'] = 0;
								echo $salary['BASIC'];
							?>
							</td>
							<td>
							<?php 
								$salary = Yii::app()->db->createCommand("SELECT SUM(BASIC) AS BASIC FROM tbl_salary_details WHERE $queryCondition EMPLOYEE_ID_FK IN (".implode(",", $EstEmployeesIds).")")->queryRow();							
								if(!isset($salary['BASIC']))$salary['BASIC'] = 0;
								echo $salary['BASIC'];
							?></td>
							<td><?php 							
								$salary = Yii::app()->db->createCommand("SELECT SUM(GP) AS GP FROM tbl_salary_details WHERE BILL_ID_FK IN (".implode($billsArray, ',').")")->queryRow();							
								if(!isset($salary['GP']))$salary['GP'] = 0;
								echo $salary['GP'];
							?></td>
							<td><?php 							
								$salary = Yii::app()->db->createCommand("SELECT SUM(DA) AS DA FROM tbl_salary_details WHERE BILL_ID_FK IN (".implode($billsArray, ',').")")->queryRow();							
								if(!isset($salary['DA']))$salary['DA'] = 0;
								echo $salary['DA'];
							?></td>
							<td><?php 							
								$salary = Yii::app()->db->createCommand("SELECT SUM(HRA) AS HRA FROM tbl_salary_details WHERE BILL_ID_FK IN (".implode($billsArray, ',').")")->queryRow();							
								if(!isset($salary['HRA']))$salary['HRA'] = 0;
								echo $salary['HRA'];
							?></td>
							<td><?php 							
								$salary = Yii::app()->db->createCommand("SELECT SUM(CCA) AS CCA FROM tbl_salary_details WHERE BILL_ID_FK IN (".implode($billsArray, ',').")")->queryRow();							
								if(!isset($salary['CCA']))$salary['CCA'] = 0;
								echo $salary['CCA'];
							?></td>
							<td><?php 							
								$salary = Yii::app()->db->createCommand("SELECT SUM(TA) AS TA FROM tbl_salary_details WHERE BILL_ID_FK IN (".implode($billsArray, ',').")")->queryRow();							
								if(!isset($salary['TA']))$salary['TA'] = 0;
								echo $salary['TA'];
							?></td>
							<td><?php 							
								$salary = Yii::app()->db->createCommand("SELECT SUM(CEA) AS CEA FROM tbl_salary_details WHERE BILL_ID_FK IN (".implode($billsArray, ',').")")->queryRow();							
								if(!isset($salary['CEA']))$salary['CEA'] = 0;
								echo $salary['CEA'];
							?></td>
							<td><?php 							
								$salary = Yii::app()->db->createCommand("SELECT SUM(UA) AS UA FROM tbl_salary_details WHERE BILL_ID_FK IN (".implode($billsArray, ',').")")->queryRow();							
								if(!isset($salary['UA']))$salary['UA'] = 0;
								echo $salary['UA'];
							?></td>
							<td><?php 							
								$salary = Yii::app()->db->createCommand("SELECT SUM(WA) AS WA FROM tbl_salary_details WHERE BILL_ID_FK IN (".implode($billsArray, ',').")")->queryRow();							
								if(!isset($salary['WA']))$salary['WA'] = 0;
								echo $salary['WA'];
							?></td>
							<td><?php 							
								$salary = Yii::app()->db->createCommand("SELECT SUM(BONUS) AS BONUS FROM tbl_salary_details WHERE BILL_ID_FK IN (".implode($billsArray, ',').")")->queryRow();							
								if(!isset($salary['BONUS']))$salary['BONUS'] = 0;
								echo $salary['BONUS'];
							?></td>
							<td><?php 							
								$salary = Yii::app()->db->createCommand("SELECT SUM(LTC_HTC) AS LTC_HTC FROM tbl_salary_details WHERE BILL_ID_FK IN (".implode($billsArray, ',').")")->queryRow();							
								if(!isset($salary['LTC_HTC']))$salary['LTC_HTC'] = 0;
								echo $salary['LTC_HTC'];
							?></td>
							<td><?php 							
								$salary = Yii::app()->db->createCommand("SELECT SUM(SP) + SUM(PP) AS PP FROM tbl_salary_details WHERE BILL_ID_FK IN (".implode($billsArray, ',').")")->queryRow();							
								if(!isset($salary['PP']))$salary['PP'] = 0;
								echo $salary['PP'];
							?></td>
							<td><?php 							
								$salary = Yii::app()->db->createCommand("SELECT SUM(HRA) + SUM(CCA) + SUM(TA) + SUM(CEA) + SUM(UA) + SUM(WA) + SUM(BONUS) + SUM(LTC_HTC) + SUM(PP) + SUM(SP) AS TOTAL FROM tbl_salary_details WHERE BILL_ID_FK IN (".implode($billsArray, ',').")")->queryRow();
								if(!isset($salary['TOTAL']))$salary['TOTAL'] = 0;
								echo $salary['TOTAL'];
							?></td>
							<td><?php 							
								$salary = Yii::app()->db->createCommand("SELECT SUM(FEST_EMI) AS FEST FROM tbl_salary_details WHERE BILL_ID_FK IN (".implode($billsArray, ',').")")->queryRow();
								if(!isset($salary['FEST']))$salary['FEST'] = 0;
								echo $salary['FEST'];
							?></td>
							<td><?php 	
								$total = 0;
								$salary = Yii::app()->db->createCommand("SELECT SUM(BASIC) + SUM(GP) + SUM(DA) + SUM(HRA) + SUM(CCA) + SUM(TA) + SUM(CEA) + SUM(UA) + SUM(WA) + SUM(BONUS) + SUM(LTC_HTC) + SUM(PP) + SUM(SP) AS TOTAL FROM tbl_salary_details WHERE BILL_ID_FK IN (".implode($billsArray, ',').")")->queryRow();
								$total = $salary['TOTAL'];
								echo $total;
							?></td>
							<td><?php 							
								$salary = Yii::app()->db->createCommand("SELECT SUM(MISC) AS MISC FROM tbl_salary_details WHERE BILL_ID_FK IN (".implode($billsArray, ',').")")->queryRow();							
								if(!isset($salary['MISC']))$salary['MISC'] = 0;
								echo $salary['MISC'];
							?></td>
							<td><?php  echo $total - $salary['MISC'];?></td>
						</tr>
					<?php
				}
				else{
					?>
						
						<tr>
							<td colspan="2">Total upto Previous Month</td>
							<td>0</td>
							<td>0</td>
							<td>0</td>
							<td>0</td>
							<td>0</td>
							<td>0</td>
							<td>0</td>
							<td>0</td>
							<td>0</td>
							<td>0</td>
							<td>0</td>
							<td>0</td>
							<td>0</td>
							<td>0</td>
							<td>0</td>
							<td>0</td>
							<td>0</td>
							<td>0</td>
						</tr>
					<?php
				}
			?>
			
			<?php
				$d = new DateTime( $this->Year.'-'.$this->Month ); 
				$criteria=new CDbCriteria;        
				$criteria->condition = "PASSED_DATE >= '".date('Y-m-d', strtotime($financialYear->START_DATE))."' AND PASSED_DATE <= '".$d->format( 'Y-m-t' )."'";
				$criteria->compare("PFMS_STATUS",'Passed');
				$criteria->addInCondition("BILL_TYPE",array(1,2));
				$bills = Bill::model()-> findAll($criteria);
				$billsArray = array();
				foreach($bills as $bill)
					array_push($billsArray, $bill->ID);
					
				$queryCondition = "";
				if(count($billsArray) > 0){
					$queryCondition.="BILL_ID_FK IN (".implode($billsArray, ',').") AND ";
					?>
						<tr>
							<td colspan="2">Progressive Total</td>
							<?php
								$employees = Yii::app()->db->createCommand("SELECT ID FROM tbl_employee WHERE DESIGNATION_ID_FK > 14")->queryAll();
								$OfficersEmployeesIds = array();
								foreach($employees as $employee) array_push($OfficersEmployeesIds, $employee['ID']);
							?>
							<?php
								$employees = Yii::app()->db->createCommand("SELECT ID FROM tbl_employee WHERE DESIGNATION_ID_FK <= 14")->queryAll();
								$EstEmployeesIds = array();
								foreach($employees as $employee) array_push($EstEmployeesIds, $employee['ID']);
							?>
							<?php
								$employees = Yii::app()->db->createCommand("SELECT ID FROM tbl_employee")->queryAll();
								$AllEmployeesIds = array();
								foreach($employees as $employee) array_push($AllEmployeesIds, $employee['ID']);
							?>
							<td>
							<?php 
								$salary = Yii::app()->db->createCommand("SELECT SUM(BASIC) AS BASIC FROM tbl_salary_details WHERE $queryCondition EMPLOYEE_ID_FK IN (".implode(",", $OfficersEmployeesIds).")")->queryRow();							
								if(!isset($salary['BASIC']))$salary['BASIC'] = 0;
								echo $salary['BASIC'];
							?>
							</td>
							<td>
							<?php 
								$salary = Yii::app()->db->createCommand("SELECT SUM(BASIC) AS BASIC FROM tbl_salary_details WHERE $queryCondition EMPLOYEE_ID_FK IN (".implode(",", $EstEmployeesIds).")")->queryRow();							
								if(!isset($salary['BASIC']))$salary['BASIC'] = 0;
								echo $salary['BASIC'];
							?></td>
							<td><?php 							
								$salary = Yii::app()->db->createCommand("SELECT SUM(GP) AS GP FROM tbl_salary_details WHERE BILL_ID_FK IN (".implode($billsArray, ',').")")->queryRow();							
								if(!isset($salary['GP']))$salary['GP'] = 0;
								echo $salary['GP'];
							?></td>
							<td><?php 							
								$salary = Yii::app()->db->createCommand("SELECT SUM(DA) AS DA FROM tbl_salary_details WHERE BILL_ID_FK IN (".implode($billsArray, ',').")")->queryRow();							
								if(!isset($salary['DA']))$salary['DA'] = 0;
								echo $salary['DA'];
							?></td>
							<td><?php 							
								$salary = Yii::app()->db->createCommand("SELECT SUM(HRA) AS HRA FROM tbl_salary_details WHERE BILL_ID_FK IN (".implode($billsArray, ',').")")->queryRow();							
								if(!isset($salary['HRA']))$salary['HRA'] = 0;
								echo $salary['HRA'];
							?></td>
							<td><?php 							
								$salary = Yii::app()->db->createCommand("SELECT SUM(CCA) AS CCA FROM tbl_salary_details WHERE BILL_ID_FK IN (".implode($billsArray, ',').")")->queryRow();							
								if(!isset($salary['CCA']))$salary['CCA'] = 0;
								echo $salary['CCA'];
							?></td>
							<td><?php 							
								$salary = Yii::app()->db->createCommand("SELECT SUM(TA) AS TA FROM tbl_salary_details WHERE BILL_ID_FK IN (".implode($billsArray, ',').")")->queryRow();							
								if(!isset($salary['TA']))$salary['TA'] = 0;
								echo $salary['TA'];
							?></td>
							<td><?php 							
								$salary = Yii::app()->db->createCommand("SELECT SUM(CEA) AS CEA FROM tbl_salary_details WHERE BILL_ID_FK IN (".implode($billsArray, ',').")")->queryRow();							
								if(!isset($salary['CEA']))$salary['CEA'] = 0;
								echo $salary['CEA'];
							?></td>
							<td><?php 							
								$salary = Yii::app()->db->createCommand("SELECT SUM(UA) AS UA FROM tbl_salary_details WHERE BILL_ID_FK IN (".implode($billsArray, ',').")")->queryRow();							
								if(!isset($salary['UA']))$salary['UA'] = 0;
								echo $salary['UA'];
							?></td>
							<td><?php 							
								$salary = Yii::app()->db->createCommand("SELECT SUM(WA) AS WA FROM tbl_salary_details WHERE BILL_ID_FK IN (".implode($billsArray, ',').")")->queryRow();							
								if(!isset($salary['WA']))$salary['WA'] = 0;
								echo $salary['WA'];
							?></td>
							<td><?php 							
								$salary = Yii::app()->db->createCommand("SELECT SUM(BONUS) AS BONUS FROM tbl_salary_details WHERE BILL_ID_FK IN (".implode($billsArray, ',').")")->queryRow();							
								if(!isset($salary['BONUS']))$salary['BONUS'] = 0;
								echo $salary['BONUS'];
							?></td>
							<td><?php 							
								$salary = Yii::app()->db->createCommand("SELECT SUM(LTC_HTC) AS LTC_HTC FROM tbl_salary_details WHERE BILL_ID_FK IN (".implode($billsArray, ',').")")->queryRow();							
								if(!isset($salary['LTC_HTC']))$salary['LTC_HTC'] = 0;
								echo $salary['LTC_HTC'];
							?></td>
							<td><?php 							
								$salary = Yii::app()->db->createCommand("SELECT SUM(SP) + SUM(PP) AS PP FROM tbl_salary_details WHERE BILL_ID_FK IN (".implode($billsArray, ',').")")->queryRow();							
								if(!isset($salary['PP']))$salary['PP'] = 0;
								echo $salary['PP'];
							?></td>
							<td><?php 							
								$salary = Yii::app()->db->createCommand("SELECT SUM(HRA) + SUM(CCA) + SUM(TA) + SUM(CEA) + SUM(UA) + SUM(WA) + SUM(BONUS) + SUM(LTC_HTC) + SUM(PP) + SUM(SP) AS TOTAL FROM tbl_salary_details WHERE BILL_ID_FK IN (".implode($billsArray, ',').")")->queryRow();
								if(!isset($salary['TOTAL']))$salary['TOTAL'] = 0;
								echo $salary['TOTAL'];
							?></td>
							<td><?php 							
								$salary = Yii::app()->db->createCommand("SELECT SUM(FEST_EMI) AS FEST FROM tbl_salary_details WHERE BILL_ID_FK IN (".implode($billsArray, ',').")")->queryRow();
								if(!isset($salary['FEST']))$salary['FEST'] = 0;
								echo $salary['FEST'];
							?></td>
							<td><?php 	
								$total = 0;
								$salary = Yii::app()->db->createCommand("SELECT SUM(BASIC) + SUM(GP) + SUM(DA) + SUM(HRA) + SUM(CCA) + SUM(TA) + SUM(CEA) + SUM(UA) + SUM(WA) + SUM(BONUS) + SUM(LTC_HTC) + SUM(PP) + SUM(SP) AS TOTAL FROM tbl_salary_details WHERE BILL_ID_FK IN (".implode($billsArray, ',').")")->queryRow();
								$total = $salary['TOTAL'];
								echo $total;
							?></td>
							<td><?php 							
								$salary = Yii::app()->db->createCommand("SELECT SUM(MISC) AS MISC FROM tbl_salary_details WHERE BILL_ID_FK IN (".implode($billsArray, ',').")")->queryRow();							
								if(!isset($salary['MISC']))$salary['MISC'] = 0;
								echo $salary['MISC'];
							?></td>
							<td><?php echo $total - $salary['MISC'];?></td>
						</tr>
	
					<?php
				}
				else{
					?>
						<tr>
							<td colspan="2">Progressive Total</td>
							<td>0</td>
							<td>0</td>
							<td>0</td>
							<td>0</td>
							<td>0</td>
							<td>0</td>
							<td>0</td>
							<td>0</td>
							<td>0</td>
							<td>0</td>
							<td>0</td>
							<td>0</td>
							<td>0</td>
							<td>0</td>
							<td>0</td>
							<td>0</td>
							<td>0</td>
							<td>0</td>
						</tr>
					<?php
				}
			?>
	
			<tr>
				<td colspan="2">SANCTION GRANT</td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td><?php $budget = Budget::model()->findByPK(1)->AMOUNT; echo $budget;?></td>
			</tr>
			<tr>
				<td colspan="2">BALANCE OF APPROPRIATION</td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td><?php echo $budget - ($total - $salary['MISC']);?></td>
			</tr>
		
	</tbody>
</table>
<div style="font-weight: bold; width:400px; float: right;text-align:center; margin-top:20px;margin-right:-10px;">
	<p><?php echo Employee::model()->findByPK($master['DEPT_ADMIN_EMPLOYEE'])->NAME;?></p>
	<p><?php echo Designations::model()->findByPK(Employee::model()->findByPK($master['DEPT_ADMIN_EMPLOYEE'])->DESIGNATION_ID_FK)->DESIGNATION;?></p>
	<p><?php echo $master['DEPT_NAME']?></p>
</div>
<style>
	th, td{text-align: center;}
	td:first-child, th:first-child {width: 50px;}
</style>
<script>
	$(document).ready(function(){
		$('#btnSubmit').click(function(){debugger;
			var month = $('#MONTH').val(),
				year = $('#YEAR').val();
			
			$('#Monthly_ANNEXURE_I').attr('href', '<?php echo Yii::app()->createUrl('Expenditure/Monthly_ANNEXURE_I'); ?>'+'&Month='+month+'&Year='+year);
			$('#Monthly_ANNEXURE_II').attr('href', '<?php echo Yii::app()->createUrl('Expenditure/Monthly_ANNEXURE_II'); ?>'+'&Month='+month+'&Year='+year);
			$('#Monthly_ANNEXURE_IIA').attr('href', '<?php echo Yii::app()->createUrl('Expenditure/Monthly_ANNEXURE_IIA'); ?>'+'&Month='+month+'&Year='+year);
			$('#Monthly_ANNEXURE_III').attr('href', '<?php echo Yii::app()->createUrl('Expenditure/Monthly_ANNEXURE_III'); ?>'+'&Month='+month+'&Year='+year);
			$('#Monthly_MEDICAL').attr('href', '<?php echo Yii::app()->createUrl('Expenditure/Monthly_MEDICAL'); ?>'+'&Month='+month+'&Year='+year);
			$('#footer_action').show();
		});
		
	});
</script>

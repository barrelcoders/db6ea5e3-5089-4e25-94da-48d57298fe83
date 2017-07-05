<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/oneadmin.css" rel="stylesheet">
<script type="text/javascript">window.onload = function() { window.print(); }</script>
<?php $master = Master::model()->findByPK(1); ?>
<?php
	
	$monthName = array('1'=>'JAN', '2'=>'FEB', '3'=>'MAR', '4'=>'APR', '5'=>'MAY', '6'=>'JUN', '7'=>'JUL', '8'=>'AUG', '9'=>'SEP', '10'=>'OCT', '11'=>'NOV', '12'=>'DEC');
	$monthNameHindi = array('1'=>'?????', '2'=>'??????', '3'=>'?????', '4'=>'??????', '5'=>'??', '6'=>'???', '7'=>'?????', '8'=>'?????', '9'=>'??????', '10'=>'???????', '11'=>'?????', '12'=>'??????'); 
	$master = Master::model()->findByPK(1);
	$financialYear = FinancialYears::model()->find('STATUS=1'); 
	$employees = Employee::model()->findAll();
?>
<style>
	td{text-align: center;}
	*{font-size: 12px;}
	td.left{text-align: left;padding-left: 5px;}
	td.no-bottom-border { border-bottom: none;} 
</style>
<table class="one-table">
<?php 
	foreach($employees as $employee){
		$investment = Investments::model()->find('EMPLOYEE_ID = '.$employee->ID.' AND FINANCIAL_YEAR_ID_FK = '.$financialYear->ID);
		?>
			<tr>
				<td colspan="10">PROVISIONAL INCOME TAX CALCULATION  FOR THE YEAR <?php echo $financialYear->NAME?> <?php echo $employee->PENSION_TYPE?></td>
				<td colspan="4">Page No: 1</td>
			</tr>
			<tr>
				<td colspan="3">IN R/O OF SHRI./SMT/KUM</td>
				<td colspan="4"><?php echo $employee->NAME."<br>(".$employee->NAME_HINDI.")";?></td>
				<td colspan="2">DESGN.:</td>
				<td colspan="5"><?php echo Designations::model()->findByPK($employee->DESIGNATION_ID_FK)->DESIGNATION ."<br>(".Designations::model()->findByPK($employee->DESIGNATION_ID_FK)->DESIGNATION_HINDI.")";?></td>
			</tr>
			<tr>
				<td>MONTH</td>
				<td>BASIC</td>
				<td>GP</td>
				<td>PP/SP</td>
				<td>TA</td>
				<td>HRA</td>
				<td>DA</td>
				<td>TOTAL</td>
				<td>CGEGIS</td>
				<td>GPF(C)</td>
				<td>PT</td>
				<td>HomeLoan</td>
				<td>IT</td>
				<td>PLI</td>
			</tr>
			<?php 
			$start = new DateTime($financialYear->START_DATE);
			$start->modify('-1 month');
			$end = new DateTime($financialYear->END_DATE);
			$end->modify('-1 month');
			$bills = Bill::model()->findAll("PFMS_STATUS='Passed' AND PASSED_DATE >='".$start->format('Y-m-01')."' AND PASSED_DATE <='".$end->format('Y-m-t')."'");
			$billsArray = array();
			foreach ($bills as $bill)
				array_push($billsArray, $bill->ID);
				
			$salaries = SalaryDetails::model()->findAll("EMPLOYEE_ID_FK = $employee->ID AND IS_SALARY_BILL = 1 AND BILL_ID_FK IN (".implode(',',$billsArray).")");
			$i=1; $BASIC=0; $GP=0; $PP_SP=0; $TA=0; $HRA=0; $DA=0; $TOTAL=0; $CGEGIS=0; $CPF_TIER_I=0; $PT=0; $IT=0;
			$otherMonthSalaries = null;
			foreach($salaries as $salary){
			?>
				<tr>
					<td><?php echo $monthName[$salary->MONTH]."-".$salary->YEAR;?></td>
					<td><?php $BASIC = $BASIC + $salary->BASIC; echo $salary->BASIC;?></td>
					<td><?php $GP = $GP + $salary->GP; echo $salary->GP;?></td>
					<td><?php $PP_SP = $PP_SP + $salary->PP+$salary->SP; echo $salary->PP+$salary->SP;?></td>
					<td><?php $TA = $TA + $salary->TA; echo $salary->TA;?></td>
					<td><?php $HRA = $HRA + $salary->HRA; echo $salary->HRA;?></td>
					<td><?php $DA = $DA + $salary->DA; echo $salary->DA;?></td>
					<td><?php $TOTAL = $TOTAL + $salary->BASIC+$salary->GP+$salary->PP+$salary->SP+$salary->TA+$salary->HRA+$salary->DA; echo $salary->BASIC+$salary->GP+$salary->PP+$salary->SP+$salary->TA+$salary->HRA+$salary->DA;?></td>
					<td><?php $CGEGIS = $CGEGIS + $salary->CGEGIS; echo $salary->CGEGIS;?></td>
					<td><?php $CPF_TIER_I = $CPF_TIER_I + $salary->CPF_TIER_I; echo $salary->CPF_TIER_I;?></td>
					<td><?php $PT = $PT + $salary->PT; echo $salary->PT;?></td>
					<td></td>
					<td><?php $IT = $IT + $salary->IT; echo $salary->IT;?></td>
					<td></td>
				</tr>
			<?php
				if($i = count($salaries)){
					$otherMonthSalaries = $salary;
				}
				
				$i++;			
			}
			
			$month = intval($otherMonthSalaries['MONTH'])+1;
			$year = intval($otherMonthSalaries['YEAR']);
			for(;$i<12;$i++){
				?>
				<tr>
					<td><?php 
						if(($month == 12)){
							$month = 1;
							$year = $year + 1;
						}
						echo $monthName[$month]."-".$year;
							
					?></td>
					<td><?php $BASIC = $BASIC +  $otherMonthSalaries['BASIC']; echo $otherMonthSalaries['BASIC'];?></td>
					<td><?php $GP = $GP +  $otherMonthSalaries['GP']; echo $otherMonthSalaries['GP'];?></td>
					<td><?php $PP_SP = $PP_SP +   $otherMonthSalaries['PP']+$otherMonthSalaries['SP']; echo $otherMonthSalaries['PP']+$otherMonthSalaries['SP'];?></td>
					<td><?php $TA = $TA +  $otherMonthSalaries['TA']; echo $otherMonthSalaries['TA'];?></td>
					<td><?php $HRA = $HRA +  $otherMonthSalaries['HRA']; echo $otherMonthSalaries['HRA'];?></td>
					<td><?php $DA = $DA +  $otherMonthSalaries['DA']; echo $otherMonthSalaries['DA'];?></td>
					<td><?php $TOTAL = $TOTAL +  $otherMonthSalaries['BASIC']+$otherMonthSalaries['GP']+$otherMonthSalaries['PP']+$otherMonthSalaries['SP']+$otherMonthSalaries['TA']+$otherMonthSalaries['HRA']+$otherMonthSalaries['DA']; echo $otherMonthSalaries['BASIC']+$otherMonthSalaries['GP']+$otherMonthSalaries['PP']+$otherMonthSalaries['SP']+$otherMonthSalaries['TA']+$otherMonthSalaries['HRA']+$otherMonthSalaries['DA'];?></td>
					<td><?php $CGEGIS = $CGEGIS +  $otherMonthSalaries['CGEGIS']; echo $otherMonthSalaries['CGEGIS'];?></td>
					<td><?php $CPF_TIER_I = $CPF_TIER_I +  $otherMonthSalaries['CPF_TIER_I']; echo $otherMonthSalaries['CPF_TIER_I'];?></td>
					<td><?php $PT = $PT +  $otherMonthSalaries['PT']; echo $otherMonthSalaries['PT'];?></td>
					<td></td>
					<td><?php $IT = $IT +  $otherMonthSalaries['IT']; echo $otherMonthSalaries['IT'];?></td>
					<td></td>
				</tr>
				<?php
				$month += 1;
			}
			?>
			<tr>
				<td>TOTAL</td>
				<td><?php echo $BASIC;?></td>
				<td><?php echo $GP;?></td>
				<td><?php echo $PP_SP;?></td>
				<td><?php echo $TA;?></td>
				<td><?php echo $HRA;?></td>
				<td><?php echo $DA;?></td>
				<td><?php echo $TOTAL;?></td>
				<td><?php echo $CGEGIS;?></td>
				<td><?php echo $CPF_TIER_I;?></td>
				<td><?php echo $PT;?></td>
				<td>0</td>
				<td><?php echo $IT;?></td>
				<td>0</td>
			</tr>
				
			<?php
				$CEABills = Bill::model()->findAll("IS_CEA_BILL = 1 AND ID IN (".implode(',',$billsArray).")");
				$CEA = 0;
				foreach($CEABills as $bill){
					$billEmployees = explode(",", OtherBillEmployees::model()->find('BILL_ID='.$bill->ID)->EMPLOYEE_ID);
					if(in_array($employee->ID, $billEmployees)){
						$CEA = $CEA + $bill->BILL_AMOUNT;
					}
				}
			?>
			<tr>
				<td class="left" colspan="7">DA /TA ARREARS (1/16 to 3/16) ( ENTER MANUALLY)</td>
				<td></td>
				<td class="no-bottom-border"></td>
				<td class="left" colspan="4">* HRA Exemption (Least of the following)</td>
				<td></td>
			</tr>
			<tr>
				<td class="left" colspan="7">Other Pay Arrears</td>
				<td></td>
				<td class="no-bottom-border"></td>
				<td class="left" colspan="4">(i) Actual HRA</td>
				<td><?php echo $HRA;?></td>
			</tr>
			<tr>
				<td class="left" colspan="7">OTA, Honorarium, etc.,</td>
				<td></td>
				<td class="no-bottom-border"></td>
				<td class="left" colspan="4">(ii) Rent paid in excess of 10% of Salary</td>
				<td></td>
			</tr>
			<tr>
				<td colspan="7"><br/></td>
				<td></td>
				<td class="no-bottom-border"></td>
				<td colspan="4"></td>
				<td></td>
			</tr>
			<tr>
				<td class="left" colspan="7">Leave Encashment</td>
				<td></td>
				<td class="no-bottom-border"></td>
				<td class="left" colspan="4"></td>
				<td></td>
			</tr>
			<tr>
				<td class="left" colspan="7">Children Education Allowance</td>
				<td><?php echo $CEA;?></td>
				<td class="no-bottom-border"></td>
				<td class="left" colspan="4">(iii) 40% of Salary</td>
				<td></td>
			</tr>
			<tr>
				<td class="left" colspan="7">TOTAL INCOME (from Salary)</td>
				<td></td>
				<td class="no-bottom-border"></td>
				<td class="left" colspan="4">(Salary = Total Pay + DA)</td>
				<td></td>
			</tr>
			<tr>
				<td class="left" colspan="2">H.R.A.EXEMPTION</td>
				<td class="left" colspan="2">RENT per Annum :</td>
				<td class="left" colspan="2"><?php echo $investment->HRA;?></td>
				<td>(Minus)</td>
				<td></td>
				<td colspan="6"><?php echo ($employee->PENSION_TYPE == "NPS")? "NEW PENSION SCHEME" : "";?></td>
			</tr>
			<?php if($employee->PENSION_TYPE == "OPS") { ?>
			<tr>
				<td class="left" colspan="7">ANY OTHER INCOME (to be specified)</td>
				<td class="left" >0</td>
				<td colspan="6"></td>
			</tr>
			<?php } else { ?>
			<tr>
				<td class="left" colspan="7">Govt. Contribution towards CPF (equal to Govt. Servant's cont.)</td>
				<td class="left" ><?php echo $CPF_TIER_I; ?></td>
				<td></td>
				<td colspan="3">(1) Mandatory CPF cont.</td>
				<td ><?php echo $CPF_TIER_I; ?></td>
				<td></td>
			</tr>	
			<?php } ?>
			<tr>
				<td class="left" colspan="7">HOUSE INCOME**(Income from Saving Bank Intrest)</td>
				<td class="left">0</td>
				<td></td>
				<?php if($employee->PENSION_TYPE == "NPS") { ?>
				<td colspan="3">(2) CPF cont. from Arr.</td>
				<td>0</td>
				<td></td>
				<?php } else { ?>
				<td colspan="6"></td>
				<?php } ?>
			</tr>
			<tr>
				<td colspan="3">A</td>
				<td class="left" colspan="4">Gross Income</td>
				<td>0</td>
				<td></td>
				<?php if($employee->PENSION_TYPE == "NPS") { ?>
				<td colspan="3">Govt. CPF Cont. (1+2)</td>
				<td><?php echo $CPF_TIER_I; ?></td>
				<td></td>
				<?php } else { ?>
				<td colspan="6"></td>
				<?php } ?>
			</tr>
			<tr>
				<td colspan="3"></td>
				<td class="left" colspan="4">PROFESSIONAL TAX</td>
				<td><?php echo $PT;?></td>
				<td></td>
				<?php if($employee->PENSION_TYPE == "NPS") { ?>
				<td colspan="3">CPF</td>
				<td><?php echo $CPF_TIER_I * 2; ?></td>
				<td></td>
				<?php } else { ?>
				<td colspan="6"></td>
				<?php } ?>
			</tr>
			<tr>
				<td colspan="3"></td>
				<td class="left" colspan="4"> Tr. Allow (u/s. 10(14)</td>
				<td><?php echo min($TA, 19200);?></td>
				<td></td>
				<td colspan="6"></td>
			</tr>
			<tr>
				<td colspan="3"></td>
				<td class="left" colspan="4">Income after Deductions</td>
				<td>0</td>
				<td></td>
				<td colspan="6"></td>
			</tr>
		<?php
	}
?>
</table>

<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/oneadmin.css" rel="stylesheet">
<div class="container-fluid">
	<div class="box-typical box-typical-padding" style="min-height:800px;">
	<?php
	$master = Master::model()->findByPK(1);
	
	if(isset($_REQUEST['id'])){
		$bill = Bill::model()->findByPK($_REQUEST['id']);
		?>
		<script type="text/javascript">
		$(document).ready(function(){
			$('.tabcontent .basic-amount').change(function(){
				$tabContent = $(this).parents('.tabcontent'); 
				var IS_NPS_BILL = <?php echo ($bill->BILL_TYPE == 2) ? 1 : 0; ?>;
				$tabContent.find('.hra-amount').val(Math.round(parseInt($(this).val())*0.24));
				$tabContent.find('.da-amount').val(Math.round(parseInt($(this).val())*0.04));
				if(IS_NPS_BILL){
					$tabContent.find('.cpf-1-amount').val(Math.round(($tabContent.find('.da-amount').val() + $(this).val())*0.1));
				}
			});
			
		});
	</script>
			<table class="table">
				<tr>
					<td><b class="one-label">BILL No: </b><input type='text' style="width:80%;" readonly value='<?php echo $bill->BILL_NO; ?>' placeholder='BILL NO'></td>
				</tr>
				<tr>
					<td><b class="one-label">BILL Title: </b><input type='text' readonly value='<?php echo $bill->BILL_TITLE; ?>' placeholder='Bill TITLE' style="width:80%;"></td>
				</tr>
				<tr>
					<td><b class="one-label">BILL TYPE: </b><input type='text' readonly value='<?php echo BillType::model()->findByPK($bill->BILL_TYPE)->TYPE; ?>' placeholder='BILL TYPE' style="width:80%;"></td>
				</tr>
			</table>
			<form name="SalaryDetails" action="<?php echo Yii::app()->createUrl('Bill/SalaryDetails', array('id'=>$bill->ID))?>" method="post">
			<table >
			<tr>
				<td>
				<div>
					<div class="form-group row">
						<label class="col-sm-2 form-control-label"></label>
						<div class="col-sm-10">
							<p class="form-control-static">
								<input type="submit" name="SalaryDetails[submit]" class="btn btn-inline" value="Save">
							</p>
						</div>
					</div>
				</td>
				<td></td>
				<td></td>
			</tr>
			</table>
			<?php
			$employees = array();
			if($bill->IS_ARREAR_BILL == 1 || $bill->IS_CEA_BILL == 1 || $bill->IS_BONUS_BILL == 1 || $bill->IS_UA_BILL == 1 || $bill->IS_LTC_HTC_BILL == 1){
				$OtherBillEmployees = explode(",", OtherBillEmployees::model()->findByAttributes(array('BILL_ID'=>$model->ID))->EMPLOYEE_ID);
				$employees = Employee::model()->findAllByAttributes(array('ID'=>$OtherBillEmployees));
				?>
				<input type="hidden" name="SalaryDetails[IS_SALARY_BILL]" value="0"/>
				<?php
			}
			else if($bill->BILL_TYPE == 8){
				$OtherBillEmployees = explode(",", OtherBillEmployees::model()->findByAttributes(array('BILL_ID'=>$model->ID))->EMPLOYEE_ID);
				$employees = Employee::model()->findAllByAttributes(array('ID'=>$OtherBillEmployees));
				?>
				<input type="hidden" name="SalaryDetails[IS_SALARY_BILL]" value="1"/>
				<?php
			}
			else{
				?>
				<input type="hidden" name="SalaryDetails[IS_SALARY_BILL]" value="1"/>
				<?php
				if($bill->BILL_TYPE == 1){
					$salaries = SalaryDetails::model()->findAllByAttributes(array('BILL_ID_FK'=>$model->ID));
					if($salaries){
						$salaryBillEmployees = array();foreach($salaries as $salary){array_push($salaryBillEmployees, $salary->EMPLOYEE_ID_FK);}
						$criteria=new CDbCriteria;
						$criteria->compare("PENSION_TYPE",'OPS');
						$criteria->addInCondition('ID', $salaryBillEmployees);
						$employees = Employee::model()->findAll($criteria);
					}
					else{
						$employees = Employee::model()->findAllByAttributes(array('PENSION_TYPE'=>'OPS', 'IS_TRANSFERRED'=>0, 'IS_RETIRED'=>0, 'IS_PERMANENT'=>1));
					}
				}
				if($bill->BILL_TYPE == 2){
					$salaries = SalaryDetails::model()->findAllByAttributes(array('BILL_ID_FK'=>$model->ID));
					if($salaries){
						$salaryBillEmployees = array();foreach($salaries as $salary){array_push($salaryBillEmployees, $salary->EMPLOYEE_ID_FK);}
						$criteria=new CDbCriteria;
						$criteria->compare("PENSION_TYPE",'NPS');
						$criteria->addInCondition('ID', $salaryBillEmployees);
						$employees = Employee::model()->findAll($criteria);
					}
					else{
						$employees = Employee::model()->findAllByAttributes(array('PENSION_TYPE'=>'NPS', 'IS_TRANSFERRED'=>0, 'IS_RETIRED'=>0, 'IS_PERMANENT'=>1));
					}
				}
			}
			?>
			<div id="employee-container" style="position:relative;border: 1px solid #ccc;background-color: #f1f1f1;height: 50px;">
			<a href="javascript:void(0);" style="position: absolute;left: 0;width: 50px;height: 49px;background: #ccc;font-size: 30px;padding: 7px 10px;border: 1px solid #999;text-align: center;font-weight: bold;color: #000;" id="btn-prev"><i class="fa fa-angle-left"></i></a>
			<div style="position: absolute;right: 50px;left:50px;overflow:hidden;">
				<ul class="tab" id="tab" style="width:<?php echo count($employees)*200;?>px">    
				<?php 
					$i=0;
					foreach($employees as $employee){ 
						if($i == 0){
							?>
								<li><a href="javascript:void(0)" class="tablinks" onclick="openEmployeeSalaryDetails(event, <?php echo $employee->ID?>)" style="border-left: 1px solid #999;border-right: 1px solid #999;"><?php echo $employee->NAME?></a></li>
							<?php
						} else {
							?>
								<li><a href="javascript:void(0)" class="tablinks" onclick="openEmployeeSalaryDetails(event, <?php echo $employee->ID?>)" style="border-right: 1px solid #999;"><?php echo $employee->NAME?></a></li>
							<?php
						}
						$i++;
					} ?>
				</ul>
			</div>
			<a href="javascript:void(0);" style="position: absolute;right: 0;width: 50px;height: 49px;background: #ccc;font-size: 30px;padding: 7px 10px;border: 1px solid #999;text-align: center;font-weight: bold;color: #000;"  id="btn-next"><i class="fa  fa-angle-right"></i></a>
			</div>
			<?php
			foreach($employees as $employee){ ?>
				<div id="<?php echo $employee->ID?>" class="tabcontent" >
				  <h1 style='margin-top:10px;'><?php echo $employee->NAME_HINDI?>, <?php echo Designations::model()->findByPK($employee->DESIGNATION_ID_FK)->DESIGNATION_HINDI?></h1>
				  <table class="table">
					<tr>
						<td><b class="one-label">Designation: </b><input type='text' readonly value='<?php echo Designations::model()->findByPK($employee->DESIGNATION_ID_FK)->DESIGNATION; ?>' placeholder='DESIGNATION'></td>
						<td><b class="one-label">Group: </b><input type='text' readonly value='<?php echo Groups::model()->findByPK($employee->GROUP_ID_FK)->GROUP_NAME; ?>' placeholder='GROUP_NAME'></td>
						<td><b class="one-label">Grade Pay: </b><input type='text' readonly value='<?php echo PayBands::model()->findByPK($employee->GRADE_PAY_ID_FK)->DESCRIPTION; ?>' placeholder='GRADE PAY'></td>
					</tr>
					<tr>
						<td><b class="one-label">MICR: </b><input type='text' readonly value='<?php echo $employee->MICR?>' placeholder='MICR'></td>
						<td><b class="one-label">Account No: </b><input type='text' readonly value='<?php echo $employee->ACCOUNT_NO?>' placeholder='ACCOUNT NO'></td>
						<td><b class="one-label">IFSC: </b><input type='text' readonly value='<?php echo $employee->IFSC?>' placeholder='IFSC'></td>
					</tr>
					<tr>
						<td><b class="one-label">Pension Type: </b><input type='text' readonly value='<?php echo $employee->PENSION_TYPE?>' placeholder='PENSION TYPE'></td>
						<td><b class="one-label">Pension Account: </b><input type='text' readonly value='<?php echo $employee->PENSION_ACC_NO?>' placeholder='PENSION ACCOUNT NO'></td>
						<td><b class="one-label">DOI: </b><input type='text' readonly value='<?php echo $employee->DOI?>' placeholder='DOI'></td>
					</tr>
					</table>
				<?php 
				
				if($bill->IS_ARREAR_BILL == 1 || $bill->IS_CEA_BILL == 1 || $bill->IS_BONUS_BILL == 1 || $bill->IS_UA_BILL == 1 || $bill->IS_LTC_HTC_BILL == 1){
					if(SalaryDetails::model()->exists('EMPLOYEE_ID_FK='.$employee->ID.' AND BILL_ID_FK='.$bill->ID)){
						$salary = SalaryDetails::model()->findByAttributes(array('EMPLOYEE_ID_FK'=>$employee->ID, 'BILL_ID_FK'=>$bill->ID));
					}
					else{
						$salary = SalaryDetails::model();
					}
				}
				else if($bill->BILL_TYPE == 1 || $bill->BILL_TYPE == 2 || $bill->BILL_TYPE == 8){
					if(SalaryDetails::model()->exists('EMPLOYEE_ID_FK='.$employee->ID.' AND BILL_ID_FK='.$bill->ID. ' AND IS_SALARY_BILL = 1')){
						$salary = SalaryDetails::model()->findByAttributes(array('EMPLOYEE_ID_FK'=>$employee->ID, 'BILL_ID_FK'=>$bill->ID, 'IS_SALARY_BILL'=>1));
					}
					else if(SalaryDetails::model()->exists('IS_SALARY_BILL = 1 AND EMPLOYEE_ID_FK='.$employee->ID.' AND YEAR='.(($bill->MONTH==1) ? ($bill->YEAR - 1 ) : $bill->YEAR).' AND MONTH='.(($bill->MONTH==1) ? 12 : ($bill->MONTH - 1)))){
						$salary = SalaryDetails::model()->findByAttributes(array('EMPLOYEE_ID_FK'=>$employee->ID, 'MONTH'=>(($bill->MONTH==1) ? 12 : ($bill->MONTH - 1)), 'YEAR'=>(($bill->MONTH==1) ? ($bill->YEAR - 1 ) : $bill->YEAR), 'IS_SALARY_BILL'=>1));
					}
					else{
						$salary = SalaryDetails::model();
					}
				}					
				else{
					$salary = SalaryDetails::model();
				}
				
				?>
					<input type="hidden" value="<?php echo $bill->MONTH?>" name="SalaryInfo[MONTH]">
					<input type="hidden" value="<?php echo $bill->YEAR?>" name="SalaryInfo[YEAR]">
					<input type="hidden" value="<?php echo $bill->ID?>" name="SalaryInfo[BILL_ID]">
					<input type="hidden" value="<?php echo $employee->ID?>" name="SalaryDetails[<?php echo $employee->ID?>][EMP_ID]">
					<?php if(!$bill->IS_CEA_BILL && !$bill->IS_BONUS_BILL && !$bill->IS_UA_BILL && !$bill->IS_LTC_HTC_BILL) {?>
					<table class='gross-comp-<?php echo $employee->ID;?> table'>
						<tr>
							<td><b class="one-label">Basic: </b><input type='text' class="gross-inc-amount basic-amount" name="SalaryDetails[<?php echo $employee->ID?>][BASIC]" value='<?php echo $salary->BASIC ? $salary->BASIC : 0; ?>' placeholder='BASIC'></td>
							<td><b class="one-label">G.P.: </b><input type='text'  class="gross-inc-amount gp-amount" name="SalaryDetails[<?php echo $employee->ID?>][GP]" value='<?php echo $salary->GP ? $salary->GP : 0?>' placeholder='G.P.'></td>
							<td><b class="one-label">Total: </b><input type='text' id='total-amount' value='<?php echo $salary->BASIC + $salary->GP?>' placeholder='TOTAL'></td>
							<td><b class="one-label">S.P.: </b><input type='text'  class="gross-inc-amount" name="SalaryDetails[<?php echo $employee->ID?>][SP]" value='<?php echo $salary->SP ? $salary->SP : 0; ?>' placeholder='S.P.'></td>
							<td><b class="one-label">P.P.: </b><input type='text'  class="gross-inc-amount" name="SalaryDetails[<?php echo $employee->ID?>][PP]" value='<?php echo $salary->PP ? $salary->PP : 0;?>' placeholder='P.P.'></td>
						</tr>
						<tr>
							<td><b class="one-label">C.C.A.: </b><input type='text' class="gross-inc-amount" name="SalaryDetails[<?php echo $employee->ID?>][CCA]" value='<?php echo $salary->CCA ? $salary->CCA : 0?>' placeholder='C.C.A.'></td>
							<td><b class="one-label">H.R.A.: </b><input type='text' class="gross-inc-amount hra-amount" name="SalaryDetails[<?php echo $employee->ID?>][HRA]" value='<?php echo $salary->HRA ? $salary->HRA : 0?>' placeholder='H.R.A'></td>
							<td><b class="one-label">D.A.: </b><input type='text'   class="gross-inc-amount da-amount" name="SalaryDetails[<?php echo $employee->ID?>][DA]" value='<?php echo $salary->DA ? $salary->DA : 0?>' placeholder='D.A.'></td>
							<td><b class="one-label">T.A.: </b><input type='text'   class="gross-inc-amount" name="SalaryDetails[<?php echo $employee->ID?>][TA]" value='<?php echo $salary->TA ? $salary->TA : 0?>' placeholder='T.A.'></td>
							<td><b class="one-label">W.A.: </b><input type='text'   class="gross-inc-amount" name="SalaryDetails[<?php echo $employee->ID?>][WA]" value='<?php echo $salary->WA ? $salary->WA : 0?>' placeholder='W.A.'></td>
						</tr>
					</table>
					<table style="background:#ecebeb;" class='ded-comp-<?php echo $employee->ID;?> table'>
						<tr>
							<td><b class="one-label">I.T.: </b><input type='text' class="ded-inc-amount" name="SalaryDetails[<?php echo $employee->ID?>][IT]" value='<?php echo $salary->IT ? $salary->IT : 0?>' placeholder='I.T.'></td>
							<td><b class="one-label">C.G.H.S.: </b><input type='text' class="ded-inc-amount" name="SalaryDetails[<?php echo $employee->ID?>][CGHS]" value='<?php echo $salary->CGHS ? $salary->CGHS : 0?>' placeholder='C.G.H.S'></td>
							<td><b class="one-label">L.F.: </b><input type='text' class="ded-inc-amount" name="SalaryDetails[<?php echo $employee->ID?>][LF]" value='<?php echo $salary->LF ? $salary->LF : 0?>' placeholder='L.F.'></td>
							<td><b class="one-label">C.G.E.I.S.: </b><input type='text' class="ded-inc-amount" name="SalaryDetails[<?php echo $employee->ID?>][CGEGIS]" value='<?php echo $salary->CGEGIS ? $salary->CGEGIS : 0?>' placeholder='C.G.E.I.S.'></td>
							<td><b class="one-label">C.P.F. Tier I: </b><input type='text' class="ded-inc-amount cpf-1-amount" name="SalaryDetails[<?php echo $employee->ID?>][CPF_TIER_I]" value='<?php echo $salary->CPF_TIER_I ? $salary->CPF_TIER_I : 0?>' placeholder='C.P.F. Tier I'></td>
						</tr>
						<?php 
							$pli = 0;
							if($salary->BILL_ID_FK == $model->ID){									
								$pli = $salary->PLI;
							}
							else{
								$data = EmployeePLIPolicies::model()->findBySql('SELECT SUM(AMOUNT) as AMOUNT FROM tbl_employee_pli_policies WHERE STATUS=1 AND EMPLOYEE_ID_FK='.$employee->ID, array());
								$pli  = $data['AMOUNT'];
							}
						?>
						<tr>
							<td><b class="one-label">C.P.F. Tier II: </b><input type='text' class="ded-inc-amount" name="SalaryDetails[<?php echo $employee->ID?>][CPF_TIER_II]" value='<?php echo $salary->CPF_TIER_II ? $salary->CPF_TIER_II : 0?>' placeholder='C.P.F. Tier II'></td>
							<td><b class="one-label">P.L.I.: </b><input type='text' class="ded-inc-amount" name="SalaryDetails[<?php echo $employee->ID?>][PLI]" value='<?php echo $pli; ?>' placeholder='P.L.I.'></td>
							<td><b class="one-label">MISC.: </b><input type='text' class="ded-inc-amount" name="SalaryDetails[<?php echo $employee->ID?>][MISC]" value='<?php echo $salary->MISC ? $salary->MISC:0 ?>' placeholder='MISC.'></td>
							<td><b class="one-label">P.T.: </b><input type='text' id="pt-ded-inc-amount" name="SalaryDetails[<?php echo $employee->ID?>][PT]" value='<?php echo $salary->PT ? $salary->PT : 0?>' placeholder='P.T.'></td>
						</tr>
						<?php 
							$lic = 0;
							if($salary->BILL_ID_FK == $model->ID){
								$lic = $salary->LIC;
							} else {
								$data = EmployeeLICPolicies::model()->findBySql('SELECT SUM(AMOUNT) as AMOUNT FROM tbl_employee_lic_policies WHERE STATUS=1 AND EMPLOYEE_ID_FK='.$employee->ID, array());
								$lic  = $data['AMOUNT'];
							}
						?>
						<tr>
							<td><b class="one-label">L.I.C: </b><input type='text' class="other-ded-inc-amount" name="SalaryDetails[<?php echo $employee->ID?>][LIC]" value='<?php echo $lic; ?>' placeholder='L.I.C.'></td>
							<td><b class="one-label">C.C.S: </b><input type='text'  class="other-ded-inc-amount" name="SalaryDetails[<?php echo $employee->ID?>][CCS]" value='<?php echo $salary->CCS ? $salary->CCS : 0?>' placeholder='C.C.S.'></td>
							<td><b class="one-label">ASSOC SUB: </b><input type='text' class="other-ded-inc-amount" name="SalaryDetails[<?php echo $employee->ID?>][ASSOSC_SUB]" value='<?php echo $salary->ASSOSC_SUB ? $salary->ASSOSC_SUB : 0?>' placeholder='Association Subscription'></td>
							<td><b class="one-label">REMARKS: </b><textarea name="SalaryDetails[<?php echo $employee->ID?>][REMARKS]" value='<?php echo $salary->REMARKS ? $salary->REMARKS : 0?>' placeholder='REMARKS'></textarea></td>
						</tr>
					</table>
					<table class="table">
						<tr>
							<td><b class="one-label">GROSS: </b><input type='text' id='gross-components' name="SalaryDetails[<?php echo $employee->ID?>][GROSS]" value='<?php echo $salary->GROSS ? $salary->GROSS : 0?>' placeholder='GROSS'></td>
							<td><b class="one-label">Deduction: </b><input type='text' id='ded-components' name="SalaryDetails[<?php echo $employee->ID?>][DED]" value='<?php echo $salary->DED ? $salary->DED : 0?>' placeholder='Deduction'></td>
							<td><b class="one-label">NET: </b><input type='text' id='net-components' name="SalaryDetails[<?php echo $employee->ID?>][NET]" value='<?php echo $salary->NET ? $salary->NET : 0?>' placeholder='NET'></td>
						</tr>
						<tr>
							<td><b class="one-label">Other Deduction: </b><input type='text' id='other-ded-components' name="SalaryDetails[<?php echo $employee->ID?>][OTHER_DED]" value='<?php echo $salary->OTHER_DED ? $salary->OTHER_DED : 0?>' placeholder='OTHER DEUCTION'></td>
							<td><b class="one-label">Amount credit to Bank: </b><input type='text' id='credit-component' name="SalaryDetails[<?php echo $employee->ID?>][AMOUNT_BANK]" value='<?php echo $salary->AMOUNT_BANK ? $salary->AMOUNT_BANK : 0?>' placeholder='AMOUNT TO BANK'></td>
						</tr>
					</table>
					<div>
						<table class="table small-table">
							<tr><th style="text-align:center;">HOUSE BUILDING ADVANCE</th></tr>
							<tr><td><b class="one-label">INTEREST: </b><select name="SalaryDetails[<?php echo $employee->ID?>][HBA_RECOVERY]" ><option value="0" <?php echo ($salary->IS_HBA_RECOVERY == 0) ? "selected" : "";?>>NO</option><option value="1" <?php echo ($salary->IS_HBA_RECOVERY == 1) ? "selected" : "";?>>YES</option></select></td></tr>
							<tr><td><b class="one-label">TOTAL: </b><input type='text' name="SalaryDetails[<?php echo $employee->ID?>][HBA_TOTAL]" value='<?php echo $salary->HBA_TOTAL ? $salary->HBA_TOTAL : 0?>' placeholder='TOTAL'></td></tr>
							<tr><td><b class="one-label">INSTALLMENT NO: </b><input type='text' name="SalaryDetails[<?php echo $employee->ID?>][HBA_INST]" value='<?php echo $salary->HBA_INST ? $salary->HBA_INST : 0?>' placeholder='INSTALLMENT NO'></td></tr>
							<tr><td><b class="one-label">EMI: </b><input type='text' class="ded-inc-amount-dwn" name="SalaryDetails[<?php echo $employee->ID?>][HBA_EMI]" value='<?php echo $salary->HBA_EMI ? $salary->HBA_EMI : 0?>' placeholder='EMI'></td></tr>
							<tr><td><b class="one-label">BALANCE: </b><input type='text' name="SalaryDetails[<?php echo $employee->ID?>][HBA_BAL]" value='<?php echo $salary->HBA_BAL ? $salary->HBA_BAL : 0?>' placeholder='BALANCE'></td></tr>
						</table>
						<table class="table small-table">
							<tr><th style="text-align:center;">MOTOR CYCLE ADVANCE</th></tr>
							<tr><td><b class="one-label">INTEREST: </b><select name="SalaryDetails[<?php echo $employee->ID?>][MCA_RECOVERY]" ><option value="0" <?php echo ($salary->IS_MCA_RECOVERY == 0) ? "selected" : "";?>>NO</option><option value="1" <?php echo ($salary->IS_MCA_RECOVERY == 1) ? "selected" : "";?>>YES</option></select></td></tr>
							<tr><td><b class="one-label">TOTAL: </b><input type='text' name="SalaryDetails[<?php echo $employee->ID?>][MCA_TOTAL]" value='<?php echo $salary->MCA_TOTAL ? $salary->MCA_TOTAL: 0?>' placeholder='TOTAL'></td></tr>
							<tr><td><b class="one-label">INSTALLMENT NO: </b><input name="SalaryDetails[<?php echo $employee->ID?>][MCA_INST]" type='text' value='<?php echo $salary->MCA_INST ? $salary->MCA_INST : 0?>' placeholder='INSTALLMENT NO'></td></tr>
							<tr><td><b class="one-label">EMI: </b><input type='text' class="ded-inc-amount-dwn" name="SalaryDetails[<?php echo $employee->ID?>][MCA_EMI]" value='<?php echo $salary->MCA_EMI ? $salary->MCA_EMI : 0?>' placeholder='EMI'></td></tr>
							<tr><td><b class="one-label">BALANCE: </b><input type='text' name="SalaryDetails[<?php echo $employee->ID?>][MCA_BAL]" value='<?php echo $salary->MCA_BAL ? $salary->MCA_BAL :0?>' placeholder='BALANCE'></td></tr>
						</table>
						<table class="table small-table">
							<tr><th style="text-align:center;">FESTIVAL ADVANCE</th></tr>
							<tr><td><b class="one-label">INTEREST: </b><select name="SalaryDetails[<?php echo $employee->ID?>][FEST_RECOVERY]" ><option value="0" <?php echo ($salary->IS_FEST_RECOVERY == 0) ? "selected" : "";?>>NO</option><option value="1" <?php echo ($salary->IS_FEST_RECOVERY == 1) ? "selected" : "";?>>YES</option></select></td></tr>
							<tr><td><b class="one-label">TOTAL: </b><input type='text' name="SalaryDetails[<?php echo $employee->ID?>][FEST_TOTAL]" value='<?php echo $salary->FEST_TOTAL ? $salary->FEST_TOTAL : 0?>' placeholder='TOTAL'></td></tr>
							<tr><td><b class="one-label">INSTALLMENT NO: </b><input type='text' name="SalaryDetails[<?php echo $employee->ID?>][FEST_INST]" value='<?php echo $salary->FEST_INST ? $salary->FEST_INST : 0?>' placeholder='INSTALLMENT NO'></td></tr>
							<tr><td><b class="one-label">EMI: </b><input type='text' class="ded-inc-amount-dwn" name="SalaryDetails[<?php echo $employee->ID?>][FEST_EMI]" value='<?php echo $salary->FEST_EMI ? $salary->FEST_EMI : 0?>' placeholder='EMI'></td></tr>
							<tr><td><b class="one-label">BALANCE: </b><input type='text' name="SalaryDetails[<?php echo $employee->ID?>][FEST_BAL]" value='<?php echo $salary->FEST_BAL ? $salary->FEST_BAL :0?>' placeholder='BALANCE'></td></tr>
						</table>
						<table class="table small-table">
							<tr><th style="text-align:center;">CYCLE ADVANCE</th></tr>
							<tr><td><b class="one-label">INTEREST: </b><select name="SalaryDetails[<?php echo $employee->ID?>][CYCLE_RECOVERY]" ><option value="0" <?php echo ($salary->IS_CYCLE_RECOVERY == 0) ? "selected" : "";?>>NO</option><option value="1" <?php echo ($salary->IS_CYCLE_RECOVERY == 1) ? "selected" : "";?>>YES</option></select></td></tr>
							<tr><td><b class="one-label">TOTAL: </b><input type='text' name="SalaryDetails[<?php echo $employee->ID?>][CYCLE_TOTAL]" value='<?php echo $salary->CYCLE_TOTAL ? $salary->CYCLE_TOTAL :0?>' placeholder='TOTAL'></td></tr>
							<tr><td><b class="one-label">INSTALLMENT NO: </b><input type='text' name="SalaryDetails[<?php echo $employee->ID?>][CYCLE_INST]" value='<?php echo $salary->CYCLE_INST ? $salary->CYCLE_INST :0?>' placeholder='INSTALLMENT NO'></td></tr>
							<tr><td><b class="one-label">EMI: </b><input type='text' class="ded-inc-amount-dwn" name="SalaryDetails[<?php echo $employee->ID?>][CYCLE_EMI]" value='<?php echo $salary->CYCLE_EMI ? $salary->CYCLE_EMI : 0?>' placeholder='EMI'></td></tr>
							<tr><td><b class="one-label">BALANCE: </b><input type='text' name="SalaryDetails[<?php echo $employee->ID?>][CYCLE_BAL]" value='<?php echo $salary->CYCLE_BAL ? $salary->CYCLE_BAL :0?>' placeholder='BALANCE'></td></tr>
						</table>
						<table class="table small-table">
							<tr><th style="text-align:center;">FLOOD ADVANCE</th></tr>
							<tr><td><b class="one-label">INTEREST: </b><select name="SalaryDetails[<?php echo $employee->ID?>][FLOOD_RECOVERY]" ><option value="0" <?php echo ($salary->IS_FLOOD_RECOVERY == 0) ? "selected" : "";?>>NO</option><option value="1" <?php echo ($salary->IS_FLOOD_RECOVERY == 1) ? "selected" : "";?>>YES</option></select></td></tr>
							<tr><td><b class="one-label">TOTAL: </b><input type='text' name="SalaryDetails[<?php echo $employee->ID?>][FLOOD_TOTAL]" value='<?php echo $salary->FLOOD_TOTAL ? $salary->FLOOD_TOTAL : 0?>' placeholder='TOTAL'></td></tr>
							<tr><td><b class="one-label">INSTALLMENT NO: </b><input type='text' name="SalaryDetails[<?php echo $employee->ID?>][FLOOD_INST]" value='<?php echo $salary->FLOOD_INST ? $salary->FLOOD_INST :0?>' placeholder='INSTALLMENT NO'></td></tr>
							<tr><td><b class="one-label">EMI: </b><input type='text' class="ded-inc-amount-dwn" name="SalaryDetails[<?php echo $employee->ID?>][FLOOD_EMI]" value='<?php echo $salary->FLOOD_EMI ? $salary->FLOOD_EMI : 0?>' placeholder='EMI'></td></tr>
							<tr><td><b class="one-label">BALANCE: </b><input type='text' name="SalaryDetails[<?php echo $employee->ID?>][FLOOD_BAL]" value='<?php echo $salary->FLOOD_BAL ? $salary->FLOOD_BAL :0?>' placeholder='BALANCE'></td></tr>
						</table>
						<table class="table small-table">
							<tr><th style="text-align:center;">FAN ADVANCE</th></tr>
							<tr><td><b class="one-label">INTEREST: </b><select name="SalaryDetails[<?php echo $employee->ID?>][FAN_RECOVERY]" ><option value="0" <?php echo ($salary->IS_FAN_RECOVERY == 0) ? "selected" : "";?>>NO</option><option value="1" <?php echo ($salary->IS_FAN_RECOVERY == 1) ? "selected" : "";?>>YES</option></select></td></tr>
							<tr><td><b class="one-label">TOTAL: </b><input type='text' name="SalaryDetails[<?php echo $employee->ID?>][FAN_TOTAL]" value='<?php echo $salary->FAN_TOTAL ? $salary->FAN_TOTAL : 0?>' placeholder='TOTAL'></td></tr>
							<tr><td><b class="one-label">INSTALLMENT NO: </b><input type='text' name="SalaryDetails[<?php echo $employee->ID?>][FAN_INST]" value='<?php echo $salary->FAN_INST ? $salary->FAN_INST :0?>' placeholder='INSTALLMENT NO'></td></tr>
							<tr><td><b class="one-label">EMI: </b><input type='text' class="ded-inc-amount-dwn" name="SalaryDetails[<?php echo $employee->ID?>][FAN_EMI]" value='<?php echo $salary->FAN_EMI ? $salary->FAN_EMI : 0?>' placeholder='EMI'></td></tr>
							<tr><td><b class="one-label">BALANCE: </b><input type='text' name="SalaryDetails[<?php echo $employee->ID?>][FAN_BAL]" value='<?php echo $salary->FAN_BAL ? $salary->FAN_BAL :0?>' placeholder='BALANCE'></td></tr>
						</table>
					</div>
					<?php } ?>
					<?php if($bill->IS_BONUS_BILL) {?>
					<table class='gross-comp-<?php echo $employee->ID;?> table'>
						<tr>
							<td><b class="one-label">BONUS: </b><input type='text' class="gross-inc-amount" name="SalaryDetails[<?php echo $employee->ID?>][BONUS]" value='<?php echo $salary->BONUS ? $salary->BONUS : 0?>' placeholder='C.C.A.'></td>
						</tr>
					</table>
					<table class='gross-comp-<?php echo $employee->ID;?> table'>
						<tr>
							<td><b class="one-label">GROSS: </b><input type='text' id='gross-components' name="SalaryDetails[<?php echo $employee->ID?>][GROSS]" value='<?php echo $salary->GROSS ? $salary->GROSS : 0?>' placeholder='GROSS'></td>
							<td><b class="one-label">Deduction: </b><input type='text' class='ded-components' name="SalaryDetails[<?php echo $employee->ID?>][DED]" value='<?php echo $salary->DED ? $salary->DED : 0?>' placeholder='Deduction'></td>
							<td><b class="one-label">NET: </b><input type='text' id='net-components' name="SalaryDetails[<?php echo $employee->ID?>][NET]" value='<?php echo $salary->NET ? $salary->NET : 0?>' placeholder='NET'></td>
							<td><b class="one-label">Amount credit to Bank: </b><input type='text' id='credit-component' name="SalaryDetails[<?php echo $employee->ID?>][AMOUNT_BANK]" value='<?php echo $salary->AMOUNT_BANK ? $salary->AMOUNT_BANK : 0?>' placeholder='AMOUNT TO BANK'></td>
						</tr>
					</table>
					<?php } ?>
					<?php if($bill->IS_UA_BILL) {?>
					<table class='gross-comp-<?php echo $employee->ID;?> table'>
						<tr>
							<td><b class="one-label">Uniform Allowance: </b><input type='text' class="gross-inc-amount" name="SalaryDetails[<?php echo $employee->ID?>][UA]" value='<?php echo $salary->UA ? $salary->UA : 0?>' placeholder='C.C.A.'></td>
						</tr>
					</table>
					<table class='gross-comp-<?php echo $employee->ID;?> table'>
						<tr>
							<td><b class="one-label">GROSS: </b><input type='text' id='gross-components' name="SalaryDetails[<?php echo $employee->ID?>][GROSS]" value='<?php echo $salary->GROSS ? $salary->GROSS : 0?>' placeholder='GROSS'></td>
							<td><b class="one-label">Deduction: </b><input type='text' class='ded-components' name="SalaryDetails[<?php echo $employee->ID?>][DED]" value='<?php echo $salary->DED ? $salary->DED : 0?>' placeholder='Deduction'></td>
							<td><b class="one-label">NET: </b><input type='text' id='net-components' name="SalaryDetails[<?php echo $employee->ID?>][NET]" value='<?php echo $salary->NET ? $salary->NET : 0?>' placeholder='NET'></td>
							<td><b class="one-label">Amount credit to Bank: </b><input type='text' id='credit-component' name="SalaryDetails[<?php echo $employee->ID?>][AMOUNT_BANK]" value='<?php echo $salary->AMOUNT_BANK ? $salary->AMOUNT_BANK : 0?>' placeholder='AMOUNT TO BANK'></td>
						</tr>
					</table>
					<?php } ?>
					<?php if($bill->IS_CEA_BILL) {?>
					<table class='gross-comp-<?php echo $employee->ID;?> table'>
						<tr>
							<td><b class="one-label">Children Education Allowance: </b><input type='text' class="gross-inc-amount" name="SalaryDetails[<?php echo $employee->ID?>][CEA]" value='<?php echo $salary->CEA ? $salary->CEA : 0?>' placeholder='C.E.A.'></td>
						</tr>
					</table>
					<table class='gross-comp-<?php echo $employee->ID;?> table'>
						<tr>
							<td><b class="one-label">GROSS: </b><input type='text' id='gross-components' name="SalaryDetails[<?php echo $employee->ID?>][GROSS]" value='<?php echo $salary->GROSS ? $salary->GROSS : 0?>' placeholder='GROSS'></td>
							<td><b class="one-label">Deduction: </b><input type='text' class='ded-components' name="SalaryDetails[<?php echo $employee->ID?>][DED]" value='<?php echo $salary->DED ? $salary->DED : 0?>' placeholder='Deduction'></td>
							<td><b class="one-label">NET: </b><input type='text' id='net-components' name="SalaryDetails[<?php echo $employee->ID?>][NET]" value='<?php echo $salary->NET ? $salary->NET : 0?>' placeholder='NET'></td>
							<td><b class="one-label">Amount credit to Bank: </b><input type='text' id='credit-component' name="SalaryDetails[<?php echo $employee->ID?>][AMOUNT_BANK]" value='<?php echo $salary->AMOUNT_BANK ? $salary->AMOUNT_BANK : 0?>' placeholder='AMOUNT TO BANK'></td>
						</tr>
					</table>
					<?php } ?>
					<?php if($bill->IS_LTC_HTC_BILL) {?>
					<table class='gross-comp-<?php echo $employee->ID;?> table'>
						<tr>
							<td><b class="one-label">HTC/LTC: </b><input type='text' class="gross-inc-amount" name="SalaryDetails[<?php echo $employee->ID?>][LTC_HTC]" value='<?php echo $salary->LTC_HTC ? $salary->LTC_HTC : 0?>' placeholder='HTC/LTC'></td>
						</tr>
					</table>
					<table class='gross-comp-<?php echo $employee->ID;?> table'>
						<tr>
							<td><b class="one-label">GROSS: </b><input type='text' id='gross-components' name="SalaryDetails[<?php echo $employee->ID?>][GROSS]" value='<?php echo $salary->GROSS ? $salary->GROSS : 0?>' placeholder='GROSS'></td>
							<td><b class="one-label">Deduction: </b><input type='text' class='ded-components' name="SalaryDetails[<?php echo $employee->ID?>][DED]" value='<?php echo $salary->DED ? $salary->DED : 0?>' placeholder='Deduction'></td>
							<td><b class="one-label">NET: </b><input type='text' id='net-components' name="SalaryDetails[<?php echo $employee->ID?>][NET]" value='<?php echo $salary->NET ? $salary->NET : 0?>' placeholder='NET'></td>
							<td><b class="one-label">Amount credit to Bank: </b><input type='text' id='credit-component' name="SalaryDetails[<?php echo $employee->ID?>][AMOUNT_BANK]" value='<?php echo $salary->AMOUNT_BANK ? $salary->AMOUNT_BANK : 0?>' placeholder='AMOUNT TO BANK'></td>
						</tr>
					</table>
					<?php } ?>
				</div>
				<?php
			} ?>
			</form>
	<?php } ?>
	</div>
</div>

	<style>
		.one-label{
			width:140px;
			display: inline-block;
		}
		.table{
			width:100%;
			background:#ecebeb;
			border: 1px solid #ccc;
			margin: 10px 0;
		}
		.table td{
			padding-bottom: 5px;
			padding-right: 5px;
		}
		.table.small-table{
			width: 20%;
			float: left;
			display: inline-block;
			margin-top: 30px;
		}
		input{
			float: right;
		}
	</style>
	<script>
	$(document).ready(function(){
		$('#btn-prev').click(function(){
			var marginleft = parseInt(document.getElementById('tab').style.marginLeft),
				left = parseInt(marginleft ? marginleft : 0);
			//if(left > 100){
				document.getElementById('tab').style.marginLeft = (left + 100) + "px";
			//}
		});
		$('#btn-next').click(function(){
			var marginleft = document.getElementById('tab').style.marginLeft,
				left = parseInt(marginleft ? marginleft : 0);
			//if(left > 0){
				document.getElementById('tab').style.marginLeft = (left - 100) + "px";
			//}
		});
		$('.basic-amount').change(function(){
			var container = $(this).parents('table'), basic = 0;
			basic = parseInt($(container).find('.basic-amount').val());
			$(container).parent().find('#total-amount').val(basic);
		});
		
		$('.ded-components').change(function(){debugger;
			var container = $(this).parents('table'), total = 0,
				grossComponentElement = $(container).parent().find('#gross-components'),
				deductionComponentElement = $(this),
				netComponentElement = $(container).parent().find('#net-components'),
				creditComponentElement = $(container).parent().find('#credit-component'),
				ptDeductionComponentElement = $(container).parent().find('#pt-ded-inc-amount'),
				otherDeductionComponentElement = $(container).parent().find('#other-ded-components');
			
			netComponentElement.val(grossComponentElement.val() - getElementValue(deductionComponentElement));
			creditComponentElement.val(grossComponentElement.val() - getElementValue(ptDeductionComponentElement) - getElementValue(deductionComponentElement) - getElementValue(otherDeductionComponentElement));
		});
		
		$('.gross-inc-amount').change(function(){
			var container = $(this).parents('table'), total = 0,
				grossComponentElement = $(container).parent().find('#gross-components'),
				deductionComponentElement = $(container).parent().find('#ded-components'),
				ptDeductionComponentElement = $(container).parent().find('#pt-ded-inc-amount'),
				otherDeductionComponentElement = $(container).parent().find('#other-ded-components')
				netComponentElement = $(container).parent().find('#net-components'),
				creditComponentElement = $(container).parent().find('#credit-component');
				
			$(container).find('.gross-inc-amount').each(function (index, element) {
				total += parseInt($(element).val());
			});
			
			grossComponentElement.val(total);
			netComponentElement.val(grossComponentElement.val() - getElementValue(deductionComponentElement));
			creditComponentElement.val(grossComponentElement.val() - getElementValue(ptDeductionComponentElement) - getElementValue(deductionComponentElement) - getElementValue(otherDeductionComponentElement));
		});
		
		$('.ded-inc-amount').change(function(){
			var container = $(this).parents('table'), total = 0,
				grossComponentElement = $(container).parent().find('#gross-components'),
				deductionComponentElement = $(container).parent().find('#ded-components'),
				ptDeductionComponentElement = $(container).parent().find('#pt-ded-inc-amount'),
				otherDeductionComponentElement = $(container).parent().find('#other-ded-components'),
				netComponentElement = $(container).parent().find('#net-components'),
				creditComponentElement = $(container).parent().find('#credit-component');
				
			$(container).find('.ded-inc-amount').each(function (index, element) {
				total += parseInt($(element).val());
			});
			
			deductionComponentElement.val(total);
			netComponentElement.val(grossComponentElement.val() - getElementValue(deductionComponentElement));
			creditComponentElement.val(grossComponentElement.val() - getElementValue(ptDeductionComponentElement) - getElementValue(deductionComponentElement) - getElementValue(otherDeductionComponentElement));
		});

		$('.other-ded-inc-amount').change(function(){
			var container = $(this).parents('table'), total = 0,
				grossComponentElement = $(container).parent().find('#gross-components'),
				deductionComponentElement = $(container).parent().find('#ded-components'),
				ptDeductionComponentElement = $(container).parent().find('#pt-ded-inc-amount'),
				otherDeductionComponentElement = $(container).parent().find('#other-ded-components'),
				creditComponentElement = $(container).parent().find('#credit-component');
				
				
			$(container).find('.other-ded-inc-amount').each(function (index, element) {
				total += parseInt($(element).val());
			});
			
			otherDeductionComponentElement.val(total);
			creditComponentElement.val(grossComponentElement.val() - getElementValue(ptDeductionComponentElement) - getElementValue(deductionComponentElement) - getElementValue(otherDeductionComponentElement));
		});	
		
		$('.ded-inc-amount-dwn').change(function(){
			var tabContainer = $(this).parents('.tabcontent'), total = 0,
				grossComponentElement = $(tabContainer).find('#gross-components'),
				deductionComponentElement = $(tabContainer).find('#ded-components'),
				ptDeductionComponentElement = $(tabContainer).find('#pt-ded-inc-amount'),
				otherDeductionComponentElement = $(tabContainer).find('#other-ded-components'),
				netComponentElement = $(tabContainer).find('#net-components'),
				creditComponentElement = $(tabContainer).find('#credit-component');
				
			$(tabContainer).find('.ded-inc-amount').each(function (index, element) {
				total += parseInt($(element).val());
			});
			total = parseInt(total) + parseInt($(this).val());
			deductionComponentElement.val(total);
			netComponentElement.val(grossComponentElement.val() - getElementValue(deductionComponentElement));
			creditComponentElement.val(grossComponentElement.val() - getElementValue(ptDeductionComponentElement) - getElementValue(deductionComponentElement) - getElementValue(otherDeductionComponentElement));
		});
		
	});
	function getElementValue(element){
		if(element.length > 0){
			return element.val();
		}
		else{
			return 0;
		}
	}
	function openEmployeeSalaryDetails(evt, empID) {
		var i, tabcontent, tablinks;
		tabcontent = document.getElementsByClassName("tabcontent");
		for (i = 0; i < tabcontent.length; i++) {
			tabcontent[i].style.display = "none";
		}
		tablinks = document.getElementsByClassName("tablinks");
		for (i = 0; i < tablinks.length; i++) {
			tablinks[i].className = tablinks[i].className.replace(" active", "");
		}
		document.getElementById(empID).style.display = "block";
		evt.currentTarget.className += " active";
	}
	
	</script>

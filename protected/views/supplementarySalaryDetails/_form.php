<?php

	$financialYear = FinancialYears::model()->find('STATUS=1');
	$StartYear = date('Y', strtotime($financialYear->START_DATE));
	$EndYear = date('Y', strtotime($financialYear->END_DATE));
	$CurrentFinancialYearPeriods = array('3-'.$StartYear,'4-'.$StartYear,'5-'.$StartYear,'6-'.$StartYear, '7-'.$StartYear, '8-'.$StartYear, '9-'.$StartYear, '10-'.$StartYear, '11-'.$StartYear, '12-'.$StartYear,
										'1-'.$EndYear, '2-'.$EndYear);
	
	$STARTING_PERIOD_OF_SALARY = Yii::app()->db->createCommand("SELECT CONCAT(MONTH, '-', YEAR) AS PERIOD FROM db_oneadmin.tbl_salary_details WHERE EMPLOYEE_ID_FK=".$this->ID." ORDER BY BILL_ID_FK LIMIT 1")->queryRow()['PERIOD']; 
	$StartIndex = 0;
	$EndIndex = 0;
	
	if($STARTING_PERIOD_OF_SALARY){
		for($i=0; $i<=count($CurrentFinancialYearPeriods)-1;$i++){
			if($CurrentFinancialYearPeriods[$i] == $STARTING_PERIOD_OF_SALARY){
				$EndIndex = $i-1;
			}
		}	
	}
	else{
		$EndIndex = count($CurrentFinancialYearPeriods)-1;
	}
	
	$periods = array();
	for($i=$StartIndex; $i<=$EndIndex;$i++){
		array_push($periods, $CurrentFinancialYearPeriods[$i]);
	}
	
	$js_array = json_encode($periods);
	$monthNames = array('JAN', 'FEB', 'MAR', 'APR', 'MAY', 'JUN', 'JUL', 'AUG', 'SEP', 'OCT', 'NOV', 'DEC');
	$year = 2017;

	echo "<script>var periods = $js_array;</script>";
	
	$form=$this->beginWidget('CActiveForm', array(
		'id'=>'supplementary-salary-details-form',
		'enableAjaxValidation'=>false,
	)); ?>
	
	<div class="form-group">
		<div class="col-sm-12">
			<h3><?php echo Employee::model()->findByPK($this->ID)->NAME.", ".Designations::model()->findByPK(Employee::model()->findByPK($this->ID)->DESIGNATION_ID_FK)->DESIGNATION; ?></h3>
			<p class="form-control-static">
				<a class="btn btn-inline" href="<?php echo Yii::app()->createUrl('Investments/update', array('id'=>$this->ID))?>"><?php echo FinancialYears::model()->find("STATUS=1")->NAME ?> Investments</a>
				<a class="btn btn-inline" href="<?php echo Yii::app()->createUrl('IncomeTax/SelectEmployeesForForm16');?>" >Provisional Form-16 (<?php echo FinancialYears::model()->find('STATUS=1')->NAME;?>)</a>
				<?php 
					$startPeriod = $periods[0];
					$endPeriod = $periods[count($periods)-1];
					$startMonth = $monthNames[explode("-", $startPeriod)[0] - 1];
					$endMonth = $monthNames[explode("-", $endPeriod)[0] - 1];
					$startYear = explode("-", $startPeriod)[1];
					$endYear = explode("-", $endPeriod)[1];
					echo CHtml::submitButton('Save Salary '.$startMonth.'-'.$startYear.' to '.$endMonth.'-'.$endYear, array('class'=>'btn btn-inline')); ?>
			</p>
		</div>
	</div>
	<div class="form-group">
	<?php
		foreach($periods as $period){
			$month = explode("-",$period)[0];
			$year = explode("-",$period)[1];
			if(SupplementarySalaryDetails::model()->exists('EMPLOYEE_ID_FK='.$this->ID.' AND MONTH='.$month.' AND YEAR='.$year)){
				$salary = SupplementarySalaryDetails::model()->find('EMPLOYEE_ID_FK='.$this->ID.' AND MONTH='.$month.' AND YEAR='.$year);
			}
			else{
				$salary = SupplementarySalaryDetails::model();
			}
			?>
			<b><?php echo $monthNames[$month-1]."-".$year?></b>
			<input type="hidden" name="SupplementarySalaryDetails[<?php echo $month;?>][MONTH]" value="<?php echo $month?>"/>
			<input type="hidden" name="SupplementarySalaryDetails[<?php echo $month;?>][YEAR]" value="<?php echo $year?>"/>
			<table class="table table-bordered table-hover" style="margin-bottom: 10px;" id="<?php echo $month;?>">
				<tr>
					<td>BASIC: <input type="text" size="10" name="SupplementarySalaryDetails[<?php echo $month;?>][BASIC]" data-type="BASIC" class="gross-inc-amount basic-amount" value="<?php echo $salary->BASIC ? $salary->BASIC : 0;?>" placeholder="BASIC"/></td>
					<td>SP: <input type="text" size="10" name="SupplementarySalaryDetails[<?php echo $month;?>][SP]" data-type="SP" class="gross-inc-amount" value="<?php echo $salary->SP ? $salary->SP : 0;?>" placeholder="SP"/></td>
					<td>PP: <input type="text" size="10" name="SupplementarySalaryDetails[<?php echo $month;?>][PP]" data-type="PP" class="gross-inc-amount" value="<?php echo $salary->PP ? $salary->PP : 0;?>" placeholder="PP"/></td>
					<td>CCA: <input type="text" size="10" name="SupplementarySalaryDetails[<?php echo $month;?>][CCA]" data-type="CCA" class="gross-inc-amount" value="<?php echo $salary->CCA ? $salary->CCA : 0;?>" placeholder="CCA"/></td>
					<td>HRA: <input type="text" size="10" name="SupplementarySalaryDetails[<?php echo $month;?>][HRA]" data-type="HRA" class="gross-inc-amount hra-amount" value="<?php echo $salary->HRA ? $salary->HRA : 0;?>" placeholder="HRA"/></td>
					<td>DA: <input type="text" size="10" name="SupplementarySalaryDetails[<?php echo $month;?>][DA]" data-type="DA" class="gross-inc-amount da-amount" value="<?php echo $salary->DA ? $salary->DA : 0;?>" placeholder="DA"/></td>
					<td>TA: <input type="text" size="10" name="SupplementarySalaryDetails[<?php echo $month;?>][TA]" data-type="TA" class="gross-inc-amount" value="<?php echo $salary->TA ? $salary->TA : 0;?>" placeholder="TA"/></td>
					<td>WA: <input type="text" size="10" name="SupplementarySalaryDetails[<?php echo $month;?>][WA]" data-type="WA" class="gross-inc-amount" value="<?php echo $salary->WA ? $salary->WA : 0;?>" placeholder="WA"/></td>
				</tr>
				<tr>
					<td>IT: <input type="text" size="10" name="SupplementarySalaryDetails[<?php echo $month;?>][IT]" data-type="IT" class="ded-inc-amount" value="<?php echo $salary->IT ? $salary->IT : 0;?>" placeholder="IT"/></td>
					<td>CGHS: <input type="text" size="10" name="SupplementarySalaryDetails[<?php echo $month;?>][CGHS]" data-type="CGHS" class="ded-inc-amount" value="<?php echo $salary->CGHS ? $salary->CGHS : 0;?>" placeholder="CGHS"/></td>
					<td>LF: <input type="text" size="10" name="SupplementarySalaryDetails[<?php echo $month;?>][LF]" data-type="LF" class="ded-inc-amount" value="<?php echo $salary->LF ? $salary->LF : 0;?>" placeholder="LF"/></td>
					<td>CGEGIS: <input type="text" size="10" name="SupplementarySalaryDetails[<?php echo $month;?>][CGEGIS]" data-type="CGEGIS" class="ded-inc-amount" value="<?php echo $salary->CGEGIS ? $salary->CGEGIS : 0;?>" placeholder="CGEGIS"/></td>
					<td><?php echo ( Employee::model()->findByPK($this->ID)->PENSION_TYPE == 'OPS' ) ? "GPFC" : "CPF TIER I"; ?>: <input type="text" size="10" name="SupplementarySalaryDetails[<?php echo $month;?>][CPF_TIER_I]" data-type="CPF_TIER_I" class="ded-inc-amount  cpf-1-amount" value="<?php echo $salary->CPF_TIER_I ? $salary->CPF_TIER_I : 0;?>" placeholder="<?php echo ( Employee::model()->findByPK($this->ID)->PENSION_TYPE == 'OPS' ) ? "GPFC" : "CPF TIER I"; ?>"/></td>
					<td><?php echo ( Employee::model()->findByPK($this->ID)->PENSION_TYPE == 'OPS' ) ? "GPFR" : "CPF TIER II"; ?>: <input type="text" size="10" name="SupplementarySalaryDetails[<?php echo $month;?>][CPF_TIER_II]" data-type="CPF_TIER_II" class="ded-inc-amount" value="<?php echo $salary->CPF_TIER_II ? $salary->CPF_TIER_II : 0;?>" placeholder="<?php echo ( Employee::model()->findByPK($this->ID)->PENSION_TYPE == 'OPS' ) ? "GPFR" : "CPF TIER II"; ?>"/></td>
					<td>MISC: <input type="text" size="10" name="SupplementarySalaryDetails[<?php echo $month;?>][MISC]" data-type="MISC" class="ded-inc-amount" value="<?php echo $salary->MISC ? $salary->MISC : 0;?>" placeholder="MISC"/></td>
					<td>PLI: <input type="text" size="10" name="SupplementarySalaryDetails[<?php echo $month;?>][PLI]" data-type="PLI" class="ded-inc-amount" value="<?php echo $salary->PLI ? $salary->PLI : 0;?>" placeholder="PLI"/></td>
				</tr>
				<tr>
					<td>COURT: <input type="text" size="10" name="SupplementarySalaryDetails[<?php echo $month;?>][COURT]" data-type="COURT" class="ded-inc-amount" value="<?php echo $salary->COURT_ATTACHMENT ? $salary->COURT_ATTACHMENT : 0;?>" placeholder="COURT"/></td>
					<td>PT: <input type="text" size="10" name="SupplementarySalaryDetails[<?php echo $month;?>][PT]" data-type="PT" class="pt-ded-inc-amount" value="<?php echo $salary->PT ? $salary->PT : 0;?>" placeholder="PT"/></td>
					<td>CCS: <input type="text" size="10" name="SupplementarySalaryDetails[<?php echo $month;?>][CCS]" data-type="CCS" class="other-ded-inc-amount" value="<?php echo $salary->CCS ? $salary->CCS : 0;?>" placeholder="CCS"/></td>
					<td>LIC: <input type="text" size="10" name="SupplementarySalaryDetails[<?php echo $month;?>][LIC]" data-type="LIC" class="other-ded-inc-amount" value="<?php echo $salary->LIC ? $salary->LIC : 0;?>" placeholder="LIC"/></td>
					<td>ASSOSC SUB.: <input type="text" size="10" name="SupplementarySalaryDetails[<?php echo $month;?>][ASSOSC_SUB]" data-type="ASSOSC_SUB" class="other-ded-inc-amount" value="<?php echo $salary->ASSOSC_SUB ? $salary->ASSOSC_SUB : 0;?>" placeholder="ASSOSC SUB"/></td>
					<td>JAYAMAHAL: <input type="text" size="10" name="SupplementarySalaryDetails[<?php echo $month;?>][MAINT_JAYAMAHAL]" data-type="MAINT_JAYAMAHAL" class="other-ded-inc-amount" value="<?php echo $salary->MAINT_JAYAMAHAL ? $salary->MAINT_JAYAMAHAL : 0;?>" placeholder="MAINT. JAYAMAHAL"/></td>
					<td>MADIWALA: <input type="text" size="10" name="SupplementarySalaryDetails[<?php echo $month;?>][MAINT_MADIWALA]" data-type="MAINT_MADIWALA" class="other-ded-inc-amount" value="<?php echo $salary->MAINT_MADIWALA ? $salary->MAINT_MADIWALA : 0;?>" placeholder="MAINT. MADIWALA"/></td>				
					<td></td>
				</tr>
				<tr>
					<td>HBA</td>
					<td>
						<select name="SupplementarySalaryDetails[<?php echo $month?>][IS_HBA_RECOVERY]" >
							<option value="0" <?php echo ($salary->IS_HBA_RECOVERY && ($salary->IS_HBA_RECOVERY == 0)) ? "selected" : "";?>>PRINCIPAL</option>
							<option value="1" <?php echo ($salary->IS_HBA_RECOVERY && ($salary->IS_HBA_RECOVERY == 1)) ? "selected" : "";?>>INTEREST</option>
						</select>
					</td>
					<td>TOTAL: <input type="text" size="10" name="SupplementarySalaryDetails[<?php echo $month;?>][HBA_TOTAL]" data-type="HBA_TOTAL" value="<?php echo $salary->HBA_TOTAL ? $salary->HBA_TOTAL : 0;?>" placeholder="TOTAL" class="hba-total"/></td>
					<td>INSTALLMENT: <input type="text" size="10" name="SupplementarySalaryDetails[<?php echo $month;?>][HBA_INST]" data-type="HBA_INST" value="<?php echo $salary->HBA_INST ? $salary->HBA_INST : 0;?>" placeholder="INSTALLMENT" class="increment-field hba-inst"/></td>
					<td>EMI: <input type="text" size="10" name="SupplementarySalaryDetails[<?php echo $month;?>][HBA_EMI]" data-type="HBA_EMI" class="ded-inc-amount hba-emi" value="<?php echo $salary->HBA_EMI ? $salary->HBA_EMI : 0;?>" placeholder="EMI"/></td>
					<td>BALANCE: <input type="text" size="10" name="SupplementarySalaryDetails[<?php echo $month;?>][HBA_BAL]" data-type="HBA_BAL" value="<?php echo $salary->HBA_BAL ? $salary->HBA_BAL : 0;?>" placeholder="BALANCE" class="hba-bal non-populated-field"/></td>
					<td></td><td></td>
				</tr>
				<tr>
					<td>MCA</td>
					<td>
						<select name="SupplementarySalaryDetails[<?php echo $month?>][IS_MCA_RECOVERY]" >
							<option value="0" <?php echo ($salary->IS_MCA_RECOVERY == 0) ? "selected" : "";?>>PRINCIPAL</option>
							<option value="1" <?php echo ($salary->IS_MCA_RECOVERY == 1) ? "selected" : "";?>>INTEREST</option>
						</select>
					</td>
					<td>TOTAL: <input type="text" size="10" name="SupplementarySalaryDetails[<?php echo $month;?>][MCA_TOTAL]" data-type="MCA_TOTAL" value="<?php echo $salary->MCA_TOTAL ? $salary->MCA_TOTAL : 0;?>" placeholder="TOTAL" class="mca-total"/></td>
					<td>INSTALLMENT: <input type="text" size="10" name="SupplementarySalaryDetails[<?php echo $month;?>][MCA_INST]" data-type="MCA_INST" value="<?php echo $salary->MCA_INST ? $salary->MCA_INST : 0;?>" placeholder="INSTALLMENT" class="increment-field mca-inst"/></td>
					<td>EMI: <input type="text" size="10" name="SupplementarySalaryDetails[<?php echo $month;?>][MCA_EMI]" data-type="MCA_EMI" class="ded-inc-amount mca-emi" value="<?php echo $salary->MCA_EMI ? $salary->MCA_EMI : 0;?>" placeholder="EMI"/></td>
					<td>BALANCE: <input type="text" size="10" name="SupplementarySalaryDetails[<?php echo $month;?>][MCA_BAL]" data-type="MCA_BAL" value="<?php echo $salary->MCA_BAL ? $salary->MCA_BAL : 0;?>" placeholder="BALANCE" class="mca-bal non-populated-field"/></td>
					<td></td><td></td>
				</tr>
				<tr>
					<td>COMPUTER</td>
					<td>
						<select name="SupplementarySalaryDetails[<?php echo $month?>][IS_COMP_RECOVERY]" >
							<option value="0" <?php echo ($salary->IS_COMP_RECOVERY == 0) ? "selected" : "";?>>PRINCIPAL</option>
							<option value="1" <?php echo ($salary->IS_COMP_RECOVERY == 1) ? "selected" : "";?>>INTEREST</option>
						</select>
					</td>
					<td>TOTAL: <input type="text" size="10" name="SupplementarySalaryDetails[<?php echo $month;?>][COMP_TOTAL]" data-type="COMP_TOTAL" value="<?php echo $salary->COMP_TOTAL ? $salary->COMP_TOTAL : 0;?>" placeholder="TOTAL" class="comp-total"/></td>
					<td>INSTALLMENT: <input type="text" size="10" name="SupplementarySalaryDetails[<?php echo $month;?>][COMP_INST]" data-type="COMP_INST" value="<?php echo $salary->COMP_INST ? $salary->COMP_INST : 0;?>" placeholder="INSTALLMENT" class="increment-field comp-inst"/></td>
					<td>EMI: <input type="text" size="10" name="SupplementarySalaryDetails[<?php echo $month;?>][COMP_EMI]" data-type="COMP_EMI" class="ded-inc-amount comp-emi" value="<?php echo $salary->COMP_EMI ? $salary->COMP_EMI : 0;?>" placeholder="EMI"/></td>
					<td>BALANCE: <input type="text" size="10" name="SupplementarySalaryDetails[<?php echo $month;?>][COMP_BAL]" data-type="COMP_BAL" value="<?php echo $salary->COMP_BAL ? $salary->COMP_BAL : 0;?>" placeholder="BALANCE" class="comp-bal non-populated-field"/></td>
					<td></td><td></td>
				</tr>
				<tr>
					<td>GROSS: <input type="text" size="10" id='gross-components' name="SupplementarySalaryDetails[<?php echo $month;?>][GROSS]" value="<?php echo $salary->GROSS ? $salary->GROSS : 0;?>" placeholder="GROSS"/></td>
					<td>DED: <input type="text" size="10" id='ded-components' name="SupplementarySalaryDetails[<?php echo $month;?>][DED]" value="<?php echo $salary->DED ? $salary->DED : 0;?>" placeholder="DED"/></td>
					<td>NET: <input type="text" size="10" id='net-components' name="SupplementarySalaryDetails[<?php echo $month;?>][NET]" value="<?php echo $salary->NET ? $salary->NET : 0;?>" placeholder="NET"/></td>
					<td>OTHER DED: <input type="text" size="10" id='other-ded-components' name="SupplementarySalaryDetails[<?php echo $month;?>][OTHER_DED]" value="<?php echo $salary->OTHER_DED ? $salary->OTHER_DED : 0;?>" placeholder="OTHER DED"/></td>
					<td>AMT. BANK: <input type="text" size="10" id='credit-component' name="SupplementarySalaryDetails[<?php echo $month;?>][AMOUNT_BANK]" value="<?php echo $salary->AMOUNT_BANK ? $salary->AMOUNT_BANK : 0;?>" placeholder="AMOUNT BANK"/></td>
					<td></td><td></td><td></td>
				</tr>
			</table>
			
			<?php
		}
	?>
	</div>
<?php $this->endWidget(); ?>
<style>
	input[type=text]{float: right;}
</style>
<script>
$(document).ready(function(){
	$("[data-type]").keyup(function(){
		if($(this).hasClass('non-populated-field'))
			return;
		
		
		var attribute = $(this).attr('data-type');
		parent = $(this).parents('table').attr('id');
		
		var selectedElements = GetDependentSelector(attribute, parent);
			
		if($(this).hasClass('increment-field') && parseInt($(this).val()) != 0){
			var elementValue = parseInt($(this).val());
			for(var i=0; i<= selectedElements.length-1; i++){
				elementValue++;
				$(selectedElements[i]).val(elementValue);
			}
		}
		else{
			selectedString = selectedElements.join(",");
			$(selectedString).val($(this).val());
		}
		
		selfWithDependentSelector = GetSelftWithDependentSelector(attribute, parent);
		
		if($(this).hasClass('basic-amount')){
			$(selfWithDependentSelector).each(function(){
				BasicValueChange(this);
			});
		}
		if($(this).hasClass('gross-inc-amount')){
			$(selfWithDependentSelector).each(function(){
				GrossValueChange(this);
			});
		}
		if($(this).hasClass('ded-inc-amount')){
			$(selfWithDependentSelector).each(function(){
				DeductionValueChange(this);
			});
		}
		if($(this).hasClass('other-ded-inc-amount')){
			$(selfWithDependentSelector).each(function(){
				OtherDeductionValueChange(this);
			});
		}
		if($(this).hasClass('pt-ded-inc-amount')){
			$(selfWithDependentSelector).each(function(){
				PTDeductionChange(this);
			});
		}
		if($(this).hasClass('hba-total') || $(this).hasClass('hba-inst') || $(this).hasClass('hba-emi')){
			$(selfWithDependentSelector).each(function(){
				HBAValueChange(this);
			});
		}
		if($(this).hasClass('mca-total') || $(this).hasClass('mca-inst') || $(this).hasClass('mca-emi')){
			$(selfWithDependentSelector).each(function(){
				MCAValueChange(this);
			});
		}
		if($(this).hasClass('comp-total') || $(this).hasClass('comp-inst') || $(this).hasClass('comp-emi')){
			$(selfWithDependentSelector).each(function(){
				COMPValueChange(this);
			});
		}
	});
});
function getMonths(){
	var months = [];
	for(var i=0; i<=periods.length-1; i++){
		months[i] = periods[i].split('-')[0];
	}
	return months;
}
function GetDependentSelector(attribute, parent){
	selectedElements = [];
	
	var months = getMonths();
	for(var i=0; i<=months.length-1; i++){
		if(months[i] == parent){
			break;
		}
	}
	
	i=i+1;
	
	for(; i<=months.length-1; i++){
		selectedElements.push("table#"+months[i]+" [data-type="+attribute+"] ");
	}
	
	
	return selectedElements;
}
function GetSelftWithDependentSelector(attribute, parent){
	selectedElements = [];
	
	var months = getMonths();
	for(var i=0; i<=months.length-1; i++){
		if(months[i] == parent){
			break;
		}
	}
	
	for(; i<=months.length-1; i++){
		selectedElements.push("table#"+months[i]+" [data-type="+attribute+"] ");
	}
	
	selectedString = selectedElements.join(",");
	return selectedString;
}
function PTDeductionChange(field){
	var container = $(field).parents('table'), total = 0,
		grossComponentElement = $(container).parent().find('#gross-components'),
		deductionComponentElement = $(container).find('#ded-components'),
		netComponentElement = $(container).parent().find('#net-components'),
		creditComponentElement = $(container).parent().find('#credit-component'),
		ptDeductionComponentElement = $(container).parent().find('.pt-ded-inc-amount'),
		otherDeductionComponentElement = $(container).parent().find('#other-ded-components');
	creditComponentElement.val(grossComponentElement.val() - getElementValue(ptDeductionComponentElement) - getElementValue(deductionComponentElement) - getElementValue(otherDeductionComponentElement));
}
function GrossValueChange(field){
	var container = $(field).parents('table'), total = 0,
		grossComponentElement = $(container).find('#gross-components'),
		deductionComponentElement = $(container).find('#ded-components'),
		ptDeductionComponentElement = $(container).find('.pt-ded-inc-amount'),
		otherDeductionComponentElement = $(container).find('#other-ded-components')
		netComponentElement = $(container).find('#net-components'),
		creditComponentElement = $(container).find('#credit-component');
		
	$(container).find('.gross-inc-amount').each(function (index, element) {
		total += parseInt($(element).val());
	});
	
	grossComponentElement.val(total);
	netComponentElement.val(grossComponentElement.val() - getElementValue(deductionComponentElement));
	creditComponentElement.val(grossComponentElement.val() - getElementValue(ptDeductionComponentElement) - getElementValue(deductionComponentElement) - getElementValue(otherDeductionComponentElement));
}
function DeductionValueChange(field){
	var container = $(field).parents('table'), total = 0,
		grossComponentElement = $(container).find('#gross-components'),
		deductionComponentElement = $(container).find('#ded-components'),
		ptDeductionComponentElement = $(container).find('.pt-ded-inc-amount'),
		otherDeductionComponentElement = $(container).find('#other-ded-components'),
		netComponentElement = $(container).find('#net-components'),
		creditComponentElement = $(container).find('#credit-component');
		
	$(container).find('.ded-inc-amount').each(function (index, element) {
		total += parseInt($(element).val());
	});
	
	deductionComponentElement.val(total);
	netComponentElement.val(grossComponentElement.val() - getElementValue(deductionComponentElement));
	creditComponentElement.val(grossComponentElement.val() - getElementValue(ptDeductionComponentElement) - getElementValue(deductionComponentElement) - getElementValue(otherDeductionComponentElement));
}
function BasicValueChange(field){
	$tabContent = $(field).parents('table'); 
	var IS_NPS_BILL = <?php echo (Employee::model()->findByPK($this->ID)->PENSION_TYPE == "NPS") ? 1 : 0; ?>;
	$tabContent.find('.hra-amount').val(Math.round(parseInt($(field).val())*0.24));
	$tabContent.find('.da-amount').val(Math.round(parseInt($(field).val())*0.04));
	if(IS_NPS_BILL){
		$tabContent.find('.cpf-1-amount').val(Math.round((parseInt($tabContent.find('.da-amount').val()) + parseInt($(field).val()))*0.1));
	}
}
function OtherDeductionValueChange(field){
	var container = $(field).parents('table'), total = 0,
		grossComponentElement = $(container).find('#gross-components'),
		deductionComponentElement = $(container).find('#ded-components'),
		ptDeductionComponentElement = $(container).find('.pt-ded-inc-amount'),
		otherDeductionComponentElement = $(container).find('#other-ded-components'),
		creditComponentElement = $(container).find('#credit-component');
		
		
	$(container).find('.other-ded-inc-amount').each(function (index, element) {
		total += parseInt($(element).val());
	});
	
	otherDeductionComponentElement.val(total);
	creditComponentElement.val(grossComponentElement.val() - getElementValue(ptDeductionComponentElement) - getElementValue(deductionComponentElement) - getElementValue(otherDeductionComponentElement));
}
function HBAValueChange(field){
	var container = $(field).parents('table'), total = 0,
		totalElement = $(container).find('.hba-total'),
		installmentElement = $(container).find('.hba-inst'),
		emiElement = $(container).find('.hba-emi'),
		balanceElement = $(container).find('.hba-bal');
	
	if(parseInt(totalElement.val()) > 0 && parseInt(installmentElement.val()) > 0 && parseInt(emiElement.val()) > 0){
		balanceElement.val(getElementValue(totalElement) - (getElementValue(installmentElement) * getElementValue(emiElement)));
	}
}
function MCAValueChange(field){
	var container = $(field).parents('table'), total = 0,
		totalElement = $(container).find('.mca-total'),
		installmentElement = $(container).find('.mca-inst'),
		emiElement = $(container).find('.mca-emi'),
		balanceElement = $(container).find('.mca-bal');
	
	if(parseInt(totalElement.val()) > 0 && parseInt(installmentElement.val()) > 0 && parseInt(emiElement.val()) > 0){
		balanceElement.val(getElementValue(totalElement) - (getElementValue(installmentElement) * getElementValue(emiElement)));
	}
}

function COMPValueChange(field){
	var container = $(field).parents('table'), total = 0,
		totalElement = $(container).find('.comp-total'),
		installmentElement = $(container).find('.comp-inst'),
		emiElement = $(container).find('.comp-emi'),
		balanceElement = $(container).find('.comp-bal');
	
	if(parseInt(totalElement.val()) > 0 && parseInt(installmentElement.val()) > 0 && parseInt(emiElement.val()) > 0){
		balanceElement.val(getElementValue(totalElement) - (getElementValue(installmentElement) * getElementValue(emiElement)));
	}
}

function getElementValue(element){
	if(element.length > 0){
		return parseInt(element.val());
	}
	else{
		return 0;
	}
}
</script>
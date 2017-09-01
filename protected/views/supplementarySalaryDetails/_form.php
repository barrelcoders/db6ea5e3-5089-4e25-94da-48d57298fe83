<?php

	$months = array(3,4,5,6);
	$js_array = json_encode($months);
	$monthFields = array('JAN', 'FEB', 'MAR', 'APR', 'MAY', 'JUN', 'JUL', 'AUG', 'SEP', 'OCT', 'NOV', 'DEC');
	$year = 2017;

	echo "<script>var months = $js_array;</script>";
	
	$form=$this->beginWidget('CActiveForm', array(
		'id'=>'supplementary-salary-details-form',
		'enableAjaxValidation'=>false,
	)); ?>
	
	<div class="form-group">
		<div class="col-sm-12">
			<h3><?php echo Employee::model()->findByPK($this->ID)->NAME.", ".Designations::model()->findByPK(Employee::model()->findByPK($this->ID)->DESIGNATION_ID_FK)->DESIGNATION; ?></h3>
			<p class="form-control-static">
				<?php echo CHtml::submitButton('Save Salary '.$monthFields[$months[0]-1].'-'.$monthFields[$months[count($months)-1]-1].' '.$year, array('class'=>'btn btn-inline', 'style'=>'float:right;')); ?>
			</p>
		</div>
	</div>
	<div class="form-group">
	<?php
		foreach($months as $month){
			$salary = SupplementarySalaryDetails::model()->find('EMPLOYEE_ID_FK='.$this->ID.' AND MONTH='.$month.' AND YEAR='.$year);
			if($salary){
				?>
				<b><?php echo $monthFields[$month-1]."-".$year?></b>
				<input type="hidden" name="SupplementarySalaryDetails[<?php echo $month;?>][MONTH]" value="<?php echo $month?>"/>
				<input type="hidden" name="SupplementarySalaryDetails[<?php echo $month;?>][YEAR]" value="<?php echo $year?>"/>
				<table class="table table-bordered table-hover" style="margin-bottom: 10px;" id="<?php echo $month;?>">
					<tr>
						<td>BASIC: <input type="text" size="10" name="SupplementarySalaryDetails[<?php echo $month;?>][BASIC]" data-type="BASIC" class="gross-inc-amount basic-amount" value="<?php echo $salary->BASIC;?>" placeholder="BASIC"/></td>
						<td>SP: <input type="text" size="10" name="SupplementarySalaryDetails[<?php echo $month;?>][SP]" data-type="SP" class="gross-inc-amount" value="<?php echo $salary->SP;?>" placeholder="SP"/></td>
						<td>PP: <input type="text" size="10" name="SupplementarySalaryDetails[<?php echo $month;?>][PP]" data-type="PP" class="gross-inc-amount" value="<?php echo $salary->PP;?>" placeholder="PP"/></td>
						<td>CCA: <input type="text" size="10" name="SupplementarySalaryDetails[<?php echo $month;?>][CCA]" data-type="CCA" class="gross-inc-amount" value="<?php echo $salary->CCA;?>" placeholder="CCA"/></td>
						<td>HRA: <input type="text" size="10" name="SupplementarySalaryDetails[<?php echo $month;?>][HRA]" data-type="HRA" class="gross-inc-amount hra-amount" value="<?php echo $salary->HRA;?>" placeholder="HRA"/></td>
						<td>DA: <input type="text" size="10" name="SupplementarySalaryDetails[<?php echo $month;?>][DA]" data-type="DA" class="gross-inc-amount da-amount" value="<?php echo $salary->DA;?>" placeholder="DA"/></td>
						<td>TA: <input type="text" size="10" name="SupplementarySalaryDetails[<?php echo $month;?>][TA]" data-type="TA" class="gross-inc-amount" value="<?php echo $salary->TA;?>" placeholder="TA"/></td>
						<td>WA: <input type="text" size="10" name="SupplementarySalaryDetails[<?php echo $month;?>][WA]" data-type="WA" class="gross-inc-amount" value="<?php echo $salary->WA;?>" placeholder="WA"/></td>
					</tr>
					<tr>
						<td>IT: <input type="text" size="10" name="SupplementarySalaryDetails[<?php echo $month;?>][IT]" data-type="IT" class="ded-inc-amount" value="<?php echo $salary->IT;?>" placeholder="IT"/></td>
						<td>CGHS: <input type="text" size="10" name="SupplementarySalaryDetails[<?php echo $month;?>][CGHS]" data-type="CGHS" class="ded-inc-amount" value="<?php echo $salary->CGHS;?>" placeholder="CGHS"/></td>
						<td>LF: <input type="text" size="10" name="SupplementarySalaryDetails[<?php echo $month;?>][LF]" data-type="LF" class="ded-inc-amount" value="<?php echo $salary->LF;?>" placeholder="LF"/></td>
						<td>CGEGIS: <input type="text" size="10" name="SupplementarySalaryDetails[<?php echo $month;?>][CGEGIS]" data-type="CGEGIS" class="ded-inc-amount" value="<?php echo $salary->CGEGIS;?>" placeholder="CGEGIS"/></td>
						<td><?php echo ( Employee::model()->findByPK($this->ID)->PENSION_TYPE == 'OPS' ) ? "GPFC" : "CPF TIER I"; ?>: <input type="text" size="10" name="SupplementarySalaryDetails[<?php echo $month;?>][CPF_TIER_I]" data-type="CPF_TIER_I" class="ded-inc-amount  cpf-1-amount" value="<?php echo $salary->CPF_TIER_I;?>" placeholder="<?php echo ( Employee::model()->findByPK($this->ID)->PENSION_TYPE == 'OPS' ) ? "GPFC" : "CPF TIER I"; ?>"/></td>
						<td><?php echo ( Employee::model()->findByPK($this->ID)->PENSION_TYPE == 'OPS' ) ? "GPFR" : "CPF TIER II"; ?>: <input type="text" size="10" name="SupplementarySalaryDetails[<?php echo $month;?>][CPF_TIER_II]" data-type="CPF_TIER_II" class="ded-inc-amount" value="<?php echo $salary->CPF_TIER_II;?>" placeholder="<?php echo ( Employee::model()->findByPK($this->ID)->PENSION_TYPE == 'OPS' ) ? "GPFR" : "CPF TIER II"; ?>"/></td>
						<td>HBA: <input type="text" size="10" name="SupplementarySalaryDetails[<?php echo $month;?>][HBA_EMI]" data-type="HBA_EMI" class="ded-inc-amount" value="<?php echo $salary->HBA_EMI;?>" placeholder="HBA"/></td>
						<td>MCA: <input type="text" size="10" name="SupplementarySalaryDetails[<?php echo $month;?>][MCA_EMI]" data-type="MCA_EMI" class="ded-inc-amount" value="<?php echo $salary->MCA_EMI;?>" placeholder="MCA"/></td>
					</tr>
					<tr>
						<td>MISC: <input type="text" size="10" name="SupplementarySalaryDetails[<?php echo $month;?>][MISC]" data-type="MISC" class="ded-inc-amount" value="<?php echo $salary->MISC;?>" placeholder="MISC"/></td>
						<td>PLI: <input type="text" size="10" name="SupplementarySalaryDetails[<?php echo $month;?>][PLI]" data-type="PLI" class="ded-inc-amount" value="<?php echo $salary->PLI;?>" placeholder="PLI"/></td>
						<td>COURT: <input type="text" size="10" name="SupplementarySalaryDetails[<?php echo $month;?>][COURT]" data-type="COURT" class="ded-inc-amount" value="<?php echo $salary->COURT_ATTACHMENT;?>" placeholder="COURT"/></td>
						<td>PT: <input type="text" size="10" name="SupplementarySalaryDetails[<?php echo $month;?>][PT]" data-type="PT" class="pt-ded-inc-amount" value="<?php echo $salary->PT;?>" placeholder="PT"/></td>
						<td>CCS: <input type="text" size="10" name="SupplementarySalaryDetails[<?php echo $month;?>][CCS]" data-type="CCS" class="other-ded-inc-amount" value="<?php echo $salary->CCS;?>" placeholder="CCS"/></td>
						<td>LIC: <input type="text" size="10" name="SupplementarySalaryDetails[<?php echo $month;?>][LIC]" data-type="LIC" class="other-ded-inc-amount" value="<?php echo $salary->LIC;?>" placeholder="LIC"/></td>
						<td>ASSOSC SUB.: <input type="text" size="10" name="SupplementarySalaryDetails[<?php echo $month;?>][ASSOSC_SUB]" data-type="ASSOSC_SUB" class="other-ded-inc-amount" value="<?php echo $salary->ASSOSC_SUB;?>" placeholder="ASSOSC SUB"/></td>
					</tr>
					<tr>
						<td>GROSS: <input type="text" size="10" id='gross-components' name="SupplementarySalaryDetails[<?php echo $month;?>][GROSS]" value="<?php echo $salary->GROSS;?>" placeholder="GROSS"/></td>
						<td>DED: <input type="text" size="10" id='ded-components' name="SupplementarySalaryDetails[<?php echo $month;?>][DED]" value="<?php echo $salary->DED;?>" placeholder="DED"/></td>
						<td>NET: <input type="text" size="10" id='net-components' name="SupplementarySalaryDetails[<?php echo $month;?>][NET]" value="<?php echo $salary->NET;?>" placeholder="NET"/></td>
						<td>OTHER DED: <input type="text" size="10" id='other-ded-components' name="SupplementarySalaryDetails[<?php echo $month;?>][OTHER_DED]" value="<?php echo $salary->OTHER_DED;?>" placeholder="OTHER DED"/></td>
						<td>AMT. BANK: <input type="text" size="10" id='credit-component' name="SupplementarySalaryDetails[<?php echo $month;?>][AMOUNT_BANK]" value="<?php echo $salary->AMOUNT_BANK;?>" placeholder="AMOUNT BANK"/></td>
					</tr>
				</table>
				
				<?php
			}
			else{
				?>
				<b><?php echo $monthFields[$month-1]."-".$year?></b>
				<input type="hidden" name="SupplementarySalaryDetails[<?php echo $month;?>][MONTH]" value="<?php echo $month?>"/>
				<input type="hidden" name="SupplementarySalaryDetails[<?php echo $month;?>][YEAR]" value="<?php echo $year?>"/>
				<table class="table table-bordered table-hover" style="margin-bottom: 10px;" id="<?php echo $month;?>">
					<tr>
						<td>BASIC: <input type="text" size="10" name="SupplementarySalaryDetails[<?php echo $month;?>][BASIC]" data-type="BASIC" class="gross-inc-amount basic-amount" value="0" placeholder="BASIC"/></td>
						<td>SP: <input type="text" size="10" name="SupplementarySalaryDetails[<?php echo $month;?>][SP]" data-type="SP" class="gross-inc-amount" value="0" placeholder="SP"/></td>
						<td>PP: <input type="text" size="10" name="SupplementarySalaryDetails[<?php echo $month;?>][PP]" data-type="PP" class="gross-inc-amount" value="0" placeholder="PP"/></td>
						<td>CCA: <input type="text" size="10" name="SupplementarySalaryDetails[<?php echo $month;?>][CCA]" data-type="CCA" class="gross-inc-amount" value="0" placeholder="CCA"/></td>
						<td>HRA: <input type="text" size="10" name="SupplementarySalaryDetails[<?php echo $month;?>][HRA]" data-type="HRA" class="gross-inc-amount hra-amount" value="0" placeholder="HRA"/></td>
						<td>DA: <input type="text" size="10" name="SupplementarySalaryDetails[<?php echo $month;?>][DA]" data-type="DA" class="gross-inc-amount da-amount" value="0" placeholder="DA"/></td>
						<td>TA: <input type="text" size="10" name="SupplementarySalaryDetails[<?php echo $month;?>][TA]" data-type="TA" class="gross-inc-amount" value="0" placeholder="TA"/></td>
						<td>WA: <input type="text" size="10" name="SupplementarySalaryDetails[<?php echo $month;?>][WA]" data-type="WA" class="gross-inc-amount" value="0" placeholder="WA"/></td>
					</tr>
					<tr>
						<td>IT: <input type="text" size="10" name="SupplementarySalaryDetails[<?php echo $month;?>][IT]" data-type="IT" class="ded-inc-amount" value="0" placeholder="IT"/></td>
						<td>CGHS: <input type="text" size="10" name="SupplementarySalaryDetails[<?php echo $month;?>][CGHS]" data-type="CGHS" class="ded-inc-amount" value="0" placeholder="CGHS"/></td>
						<td>LF: <input type="text" size="10" name="SupplementarySalaryDetails[<?php echo $month;?>][LF]" data-type="LF" class="ded-inc-amount" value="0" placeholder="LF"/></td>
						<td>CGEGIS: <input type="text" size="10" name="SupplementarySalaryDetails[<?php echo $month;?>][CGEGIS]" data-type="CGEGIS" class="ded-inc-amount" value="0" placeholder="CGEGIS"/></td>
						<td><?php echo ( Employee::model()->findByPK($this->ID)->PENSION_TYPE == 'OPS' ) ? "GPFC" : "CPF TIER I"; ?>: <input type="text" size="10" name="SupplementarySalaryDetails[<?php echo $month;?>][CPF_TIER_I]" data-type="CPF_TIER_I" class="ded-inc-amount  cpf-1-amount" value="0" placeholder="<?php echo ( Employee::model()->findByPK($this->ID)->PENSION_TYPE == 'OPS' ) ? "GPFC" : "CPF TIER I"; ?>"/></td>
						<td><?php echo ( Employee::model()->findByPK($this->ID)->PENSION_TYPE == 'OPS' ) ? "GPFR" : "CPF TIER II"; ?>: <input type="text" size="10" name="SupplementarySalaryDetails[<?php echo $month;?>][CPF_TIER_II]" data-type="CPF_TIER_II" class="ded-inc-amount" value="0" placeholder="<?php echo ( Employee::model()->findByPK($this->ID)->PENSION_TYPE == 'OPS' ) ? "GPFR" : "CPF TIER II"; ?>"/></td>
						<td>HBA: <input type="text" size="10" name="SupplementarySalaryDetails[<?php echo $month;?>][HBA_EMI]" data-type="HBA_EMI" class="ded-inc-amount" value="0" placeholder="HBA"/></td>
						<td>MCA: <input type="text" size="10" name="SupplementarySalaryDetails[<?php echo $month;?>][MCA_EMI]" data-type="MCA_EMI" class="ded-inc-amount" value="0" placeholder="MCA"/></td>
					</tr>
					<tr>
						<td>MISC: <input type="text" size="10" name="SupplementarySalaryDetails[<?php echo $month;?>][MISC]" data-type="MISC" class="ded-inc-amount" value="0" placeholder="MISC"/></td>
						<td>PLI: <input type="text" size="10" name="SupplementarySalaryDetails[<?php echo $month;?>][PLI]" data-type="PLI" class="ded-inc-amount" value="0" placeholder="PLI"/></td>
						<td>COURT: <input type="text" size="10" name="SupplementarySalaryDetails[<?php echo $month;?>][COURT]" data-type="COURT" class="ded-inc-amount" class="ded-inc-amount" value="0" placeholder="COURT"/></td>
						<td>PT: <input type="text" size="10" name="SupplementarySalaryDetails[<?php echo $month;?>][PT]" data-type="PT" class="pt-ded-inc-amount" value="0" placeholder="PT"/></td>
						<td>CCS: <input type="text" size="10" name="SupplementarySalaryDetails[<?php echo $month;?>][CCS]" data-type="CCS" class="other-ded-inc-amount" value="0" placeholder="CCS"/></td>
						<td>LIC: <input type="text" size="10" name="SupplementarySalaryDetails[<?php echo $month;?>][LIC]" data-type="LIC" class="other-ded-inc-amount" value="0" placeholder="LIC"/></td>
						<td>ASSOSC SUB.: <input type="text" size="10" name="SupplementarySalaryDetails[<?php echo $month;?>][ASSOSC_SUB]" data-type="ASSOSC_SUB" class="other-ded-inc-amount" value="0" placeholder="ASSOSC SUB"/></td>
					</tr>
					<tr>
						<td>GROSS: <input type="text" size="10" id='gross-components' name="SupplementarySalaryDetails[<?php echo $month;?>][GROSS]" value="0" placeholder="GROSS"/></td>
						<td>DED: <input type="text" size="10" id='ded-components' name="SupplementarySalaryDetails[<?php echo $month;?>][DED]" value="0" placeholder="DED"/></td>
						<td>NET: <input type="text" size="10" id='net-components' name="SupplementarySalaryDetails[<?php echo $month;?>][NET]" value="0" placeholder="NET"/></td>
						<td>OTHER DED: <input type="text" size="10" id='other-ded-components' name="SupplementarySalaryDetails[<?php echo $month;?>][OTHER_DED]" value="0" placeholder="OTHER DED"/></td>
						<td>AMT. BANK: <input type="text" size="10" id='credit-component' name="SupplementarySalaryDetails[<?php echo $month;?>][AMOUNT_BANK]" value="0" placeholder="AMOUNT BANK"/></td>
					</tr>
				</table>
				<?php
			}
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
		var attribute = $(this).attr('data-type');
		parent = $(this).parents('table').attr('id');
		
		$(GetDependentSelector(attribute, parent)).val($(this).val());
		
		selfWithDependentSelector = GetSelftWithDependentSelector(attribute, parent);
		
		if($(this).hasClass('basic-amount')){
			$(GetSelftWithDependentSelector(attribute, parent)).each(function(){
				BasicValueChange(this);
			});
		}
		if($(this).hasClass('gross-inc-amount')){
			$(selfWithDependentSelector).each(function(){
				GrossValueChange(this);
			});
		}
		if($(this).hasClass('ded-inc-amount')){
			$(GetSelftWithDependentSelector(attribute, parent)).each(function(){
				DeductionValueChange(this);
			});
		}
		if($(this).hasClass('other-ded-inc-amount')){
			$(GetSelftWithDependentSelector(attribute, parent)).each(function(){
				OtherDeductionValueChange(this);
			});
		}
		if($(this).hasClass('pt-ded-inc-amount')){
			$(GetSelftWithDependentSelector(attribute, parent)).each(function(){
				PTDeductionChange(this);
			});
		}
	});
	
	
	/*$('.basic-amount').keyup(function(){
		BasicValueChange(this);
	});
	
	$('.gross-inc-amount').keyup(function(){
		GrossValueChange(this);
	});

	$('.ded-inc-amount').keyup(function(){
		DeductionValueChange(this);
	});
	
	$('.other-ded-inc-amount').keyup(function(){
		OtherDeductionValueChange(this);
	});	
	
	$('.pt-ded-inc-amount').keyup(function(){
		PTDeductionChange(this);
	});*/
		
});
function GetDependentSelector(attribute, parent){
	selectedElements = [];
	
	for(var i=0; i<=months.length-1; i++){
		if(months[i] == parent){
			break;
		}
	}
	
	i=i+1;
	
	for(; i<=months.length-1; i++){
		selectedElements.push("table#"+months[i]+" [data-type="+attribute+"] ");
	}
	
	selectedString = selectedElements.join(",");
	return selectedString;
}
function GetSelftWithDependentSelector(attribute, parent){
	selectedElements = [];
	
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
function getElementValue(element){
	if(element.length > 0){
		return element.val();
	}
	else{
		return 0;
	}
}
</script>
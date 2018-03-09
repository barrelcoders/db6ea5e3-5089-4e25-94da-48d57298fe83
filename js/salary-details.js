var startTab = 0,
	activeTab = 0,
	endTab = 0,
	unsaved = false;

window.onbeforeunload = unloadPage;

$(document).ready(function(){
	$((TABLE_FORMAT) ? "#data-table select": ".tabcontent select").change(function(){ //trigers change in all input fields including text type
		unsaved = true;
	});
	$((TABLE_FORMAT) ? "#data-table input[type=text]": ".tabcontent input[type=text]").keyup(function(){ //trigers change in all input fields including text type
		unsaved = true;
	});
	$('#btn-prev').click(function(){
		if(activeTab == startTab)
			return;
		
		var marginleft = parseInt(document.getElementById('tab').style.marginLeft),
			left = parseInt(marginleft ? marginleft : 0);
		//if(left > 100){
			document.getElementById('tab').style.marginLeft = (left + 400) + "px";
		//}
		if($("#tablink-"+activeTab).prev().length){
			$("#tablink-"+activeTab).prev().trigger('click');
		}
	});
	$('#btn-next').click(function(){
		if(activeTab == endTab)
			return;
		
		var marginleft = document.getElementById('tab').style.marginLeft,
			left = parseInt(marginleft ? marginleft : 0);
		//if(left > 0){
			document.getElementById('tab').style.marginLeft = (left - 400) + "px";
		//}
		
		if($("#tablink-"+activeTab).next().length){
			$("#tablink-"+activeTab).next().trigger('click');
		}
	});
	
	$("[data-type]").on('keyup', function(){
		if($(this).hasClass('non-populated-field'))
			return;
		
		var attribute = $(this).attr('data-type');
		monthParent = (TABLE_FORMAT) ? $(this).parents('tr').attr('id') : $(this).parents('table').attr('id'),
		employeeParent = (TABLE_FORMAT) ? $(this).parents('tr').find('#employee-id').val() : $(this).parents('div.tabcontent').attr('id');
		
		var selectedElements = GetDependentSelector(attribute, monthParent, employeeParent);
			
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
		
		selfWithDependentSelector = GetSelftWithDependentSelector(attribute, monthParent, employeeParent);
		
		if(IS_LTC_HTC_CLAIM_BILL || IS_LTC_ADVANCE_BILL){
			$(selfWithDependentSelector).each(function(){
				LTCValueChange(this);
			});
		}
		else{
			$(selfWithDependentSelector).each(function(){
				ValueChange(this);
			});
		}
	});
	
});

function saveSalaryAjax(emp_id, month, year, bill_id, name, format){
	var SALARY = {
		'IS_SALARY_BILL': 1,
		'EMPLOYEE_ID_FK': emp_id,
		'MONTH': month,
		'YEAR': year,
		'BILL_ID_FK': bill_id,
		'BASIC': $("#SAL-BASIC").val(),
		'SP': $("#SAL-SP").val(),
		'PP': $("#SAL-PP").val(),
		'CCA': $("#SAL-CCA").val(),
		'HRA': $("#SAL-HRA").val(),
		'DA': $("#SAL-DA").val(),
		'TA': $("#SAL-TA").val(),
		'WA': $("#SAL-WA").val(),
		'IT': $("#SAL-IT").val(),
		'CGHS': $("#SAL-CGHS").val(),
		'LF': $("#SAL-LF").val(),
		'CGEGIS': $("#SAL-CGEGIS").val(),
		'CPF_TIER_I': $("#SAL-CPF_TIER_I").val(),
		'CPF_TIER_II': $("#SAL-CPF_TIER_II").val(),
		'MISC': $("#SAL-MISC").val(),
		'PLI': $("#SAL-PLI").val(),
		'COURT_ATTACHMENT': $("#SAL-COURT_ATTACHMENT").val(),
		'PT': $("#SAL-PT").val(),
		'CCS': $("#SAL-CCS").val(),
		'LIC': $("#SAL-LIC").val(),
		'ASSOSC_SUB': $("#SAL-ASSOSC_SUB").val(),
		'MAINT_JAYAMAHAL': $("#SAL-MAINT_JAYAMAHAL").val(),
		'MAINT_MADIWALA': $("#SAL-MAINT_MADIWALA").val(),
		'IS_HBA_RECOVERY': $("#SAL-IS_HBA_RECOVERY").val(),
		'HBA_TOTAL': $("#SAL-HBA_TOTAL").val(),
		'HBA_INST': $("#SAL-HBA_INST").val(),
		'HBA_EMI': $("#SAL-HBA_EMI").val(),
		'HBA_BAL': $("#SAL-HBA_BAL").val(),
		'IS_MCA_RECOVERY': $("#SAL-IS_MCA_RECOVERY").val(),
		'MCA_TOTAL': $("#SAL-MCA_TOTAL").val(),
		'MCA_INST': $("#SAL-MCA_INST").val(),
		'MCA_EMI': $("#SAL-MCA_EMI").val(),
		'MCA_BAL': $("#SAL-MCA_BAL").val(),
		'IS_COMP_RECOVERY': $("#SAL-IS_COMP_RECOVERY").val(),
		'COMP_TOTAL': $("#SAL-COMP_TOTAL").val(),
		'COMP_INST': $("#SAL-COMP_INST").val(),
		'COMP_EMI': $("#SAL-COMP_EMI").val(),
		'COMP_BAL': $("#SAL-COMP_BAL").val(),
		'REMARKS': $("#SAL-REMARKS").val(),
		'GROSS': $("#gross-components").val(),
		'DED': $("#ded-components").val(),
		'NET': $("#net-components").val(),
		'OTHER_DED': $("#other-ded-components").val(),
		'AMOUNT_BANK': $("#credit-component").val(),
	};
	
	$.ajax({
		  type: 'POST',
		  url: SALARY_SAVE_URL,
		  data: SALARY,
		  dataType: "json",
		  success: function(result) { 
			if(result.message == "SUCCESS"){
				alert('Salary of '+name+' for '+format+' has been saved successfully');
			}
			else{
				alert('Problem saving salary, Please try again later');
			}
		  },
		  fail: function(resultData) { 
			alert('error');
		  }
	});
}

function getIncomeTaxAmount(emp_id, month, year, name, format){
	
	$.ajax({
		  type: 'GET',
		  url: SALARY_SAVE_URL,
		  data: {'id': emp_id, 'ajax': true},
		  dataType: "json",
		  success: function(data) { debugger;
			var salaries = JSON.parse(data);
			for(var salary in salaries){
				
			}
		  },
		  fail: function(resultData) { 
			 alert('Problem fetching the Income Tax value, Please try again later');
		  }
	});
}
function copyIncomeTaxValue(income_tax){
	$('#SAL-IT').val(income_tax);
}
	
function loadTabs (){ 
	$("ul.tab li:first").trigger('click');
	startTab = parseInt($("ul.tab li:first").attr('id').split('-')[1]);
	endTab = parseInt($("ul.tab li:last").attr('id').split('-')[1]);
	activeTab = startTab;
}
function tableSearch(){
	var input, filter;
	input = document.getElementById('textSearch');
	filter = input.value.toUpperCase();

	$('#data-table tr').find("td:first").each(function(evt, element){
		element = $(element), row = element.parent('tr'), content = element.html();
		if (content.toUpperCase().indexOf(filter) > -1) {
			row.show();
		} else {
			row.hide();
		}
	});
}
function search(){
	var input, filter, ul, li, a, i;
	input = document.getElementById('textSearch');
	filter = input.value.toUpperCase();
	ul = document.getElementById("tab");
	li = ul.getElementsByTagName('li');

	// Loop through all list items, and hide those who don't match the search query
	for (i = 0; i < li.length; i++) {
		a = li[i].getElementsByTagName("a")[0];
		if (a.innerHTML.toUpperCase().indexOf(filter) > -1) {
			li[i].style.display = "";
		} else {
			li[i].style.display = "none";
		}
	}
	
	$("#tab").css("marginLeft", "0px");
}
function getMonths(){
	return periods;
}
function GetDependentSelector(attribute, monthParent, employeeParent){
	selectedElements = [];
	
	var months = getMonths();
	if(TABLE_FORMAT){
		for(var i=0; i<=months.length-1; i++){
			if(employeeParent+"-"+months[i] == monthParent){
				break;
			}
		}
		
		i=i+1;
		
		for(; i<=months.length-1; i++){
			selectedElements.push("tr#"+employeeParent+"-"+months[i]+" [data-type="+attribute+"] ");
		}
	
	}
	else{
		
		for(var i=0; i<=months.length-1; i++){
			if(months[i] == monthParent){
				break;
			}
		}
		
		i=i+1;
		
		for(; i<=months.length-1; i++){
			selectedElements.push("div#"+employeeParent+" table#"+months[i]+" [data-type="+attribute+"] ");
		}
	}
	
	
	return selectedElements;
}
function GetSelftWithDependentSelector(attribute, monthParent, employeeParent){
	selectedElements = [];
	
	var months = getMonths();
	if(TABLE_FORMAT){
		for(var i=0; i<=months.length-1; i++){
			if(employeeParent+"-"+months[i] == monthParent){
				break;
			}
		}
		
		for(; i<=months.length-1; i++){
			selectedElements.push("tr#"+employeeParent+"-"+months[i]+" [data-type="+attribute+"] ");
		}
	}
	else{
		var months = getMonths();
		for(var i=0; i<=months.length-1; i++){
			if(months[i] == monthParent){
				break;
			}
		}
		
		for(; i<=months.length-1; i++){
			selectedElements.push("div#"+employeeParent+" table#"+months[i]+" [data-type="+attribute+"] ");
		}
	}
	
	selectedString = selectedElements.join(",");
	return selectedString;
}
function ValueChange(field){
	var container = (TABLE_FORMAT) ? $(field).parents('tr') : $(field).parents('table'),
	basicComponentElement = $(container).find('.basic-amount'),
	hraComponentElement = $(container).find('.hra-amount'),
	lfComponentElement = $(container).find('.licence-fee-amount'),
	daComponentElement = $(container).find('.da-amount'),
	
	ceaTuitionComponentElement = $(container).find('.cea-tuition-amount'),
	ceaOtherComponentElement = $(container).find('.cea-other-amount'),
	ceaTotalComponentElement = $(container).find('.cea-total-amount'),
	
	cpfComponentElement = $(container).find('.cpf-1-amount'),
	grossComponentElement = $(container).find('#gross-components'),
	deductionComponentElement = $(container).find('#ded-components'),
	ptDeductionComponentElement = $(container).find('.pt-ded-inc-amount'),
	otherDeductionComponentElement = $(container).find('#other-ded-components')
	netComponentElement = $(container).find('#net-components'),
	creditComponentElement = $(container).find('#credit-component'),
	
	hbaTotalElement = $(container).find('.hba-total'),
	hbaInstallmentElement = $(container).find('.hba-inst'),
	hbaEmiElement = $(container).find('.hba-emi'),
	hbaBalanceElement = $(container).find('.hba-bal'),
	
	mcaTotalElement = $(container).find('.mca-total'),
	mcaInstallmentElement = $(container).find('.mca-inst'),
	mcaEmiElement = $(container).find('.mca-emi'),
	mcaBalanceElement = $(container).find('.mca-bal'),
	
	compTotalElement = $(container).find('.comp-total'),
	compInstallmentElement = $(container).find('.comp-inst'),
	compEmiElement = $(container).find('.comp-emi'),
	compBalanceElement = $(container).find('.comp-bal'),
	
	HRA_RATE = parseInt($(container).find('#HRA_RATE').val()),
	QUARTER_ALLOCATED = (parseInt($(container).find('#QURTER_ALLOCATED').val()) == 1) ? true : false;
	
	var MIN_HRA = 5400,
	DA_RATE = 5,
	CPF_RATE = 10,
	GROSS_AMOUNT = 0,
	DED_AMOUNT = 0,
	OTHER_DED_AMOUNT = 0,
	PT_AMOUNT = 0,
	NET_AMOUNT = 0,
	CREDIT_AMOUNT = 0; 
	
	/*if(!IS_ARREAR_BILL){
		var DA_AMOUNT = Math.round(parseInt($(basicComponentElement).val())*(DA_RATE/100));
		if(!QUARTER_ALLOCATED){
			var HRA_AMOUNT = Math.round(parseInt($(basicComponentElement).val())*(HRA_RATE/100));
			
			hraComponentElement.val((HRA_AMOUNT < MIN_HRA) ? MIN_HRA : HRA_AMOUNT);
		}
		else{
			hraComponentElement.val(0);
		}
		
		if($(basicComponentElement).length > 0){
			daComponentElement.val(DA_AMOUNT);
		}
	}*/
	
	if($(hraComponentElement).length > 0 && $(lfComponentElement).length > 0 && parseInt($(hraComponentElement).val()) !=0 && parseInt($(lfComponentElement).val()) !=0){
		alert('Are you sure about filling both HRA and LF ?');
	}
	
	if(container.find("#PENSION_TYPE").val() == "NPS"){
		cpfComponentElement.val(Math.round((parseInt(getElementValue(daComponentElement)) + parseInt(getElementValue($(basicComponentElement)))) * (CPF_RATE/100)));
	}

	if(IS_CEA_BILL){
		ceaTotalComponentElement.val( parseInt(getElementValue(ceaTuitionComponentElement)) + parseInt(getElementValue(ceaOtherComponentElement)));
	}
	
	if($(field).hasClass('hba-total') || $(field).hasClass('hba-inst') || $(field).hasClass('hba-emi')){
		if(parseInt(hbaTotalElement.val()) > 0 && parseInt(hbaInstallmentElement.val()) > 0 && parseInt(hbaEmiElement.val()) > 0){
			hbaBalanceElement.val(getElementValue(hbaTotalElement) - (getElementValue(hbaInstallmentElement) * getElementValue(hbaEmiElement)));
		}
	}
	if($(field).hasClass('mca-total') || $(field).hasClass('mca-inst') || $(field).hasClass('mca-emi')){
		if(parseInt(mcaTotalElement.val()) > 0 && parseInt(mcaInstallmentElement.val()) > 0 && parseInt(mcaEmiElement.val()) > 0){
			mcaBalanceElement.val(getElementValue(mcaTotalElement) - (getElementValue(mcaInstallmentElement) * getElementValue(mcaEmiElement)));
		}
	}
	if($(field).hasClass('comp-total') || $(field).hasClass('comp-inst') || $(field).hasClass('comp-emi')){
		if(parseInt(compTotalElement.val()) > 0 && parseInt(compInstallmentElement.val()) > 0 && parseInt(compEmiElement.val()) > 0){
			compBalanceElement.val(getElementValue(compTotalElement) - (getElementValue(compInstallmentElement) * getElementValue(compEmiElement)));
		}
	}
		
	$(container).find('.gross-inc-amount').each(function (index, element) {
		GROSS_AMOUNT += parseInt($(element).val());
	});
	
	$(container).find('.ded-inc-amount').each(function (index, element) {
		DED_AMOUNT += parseInt($(element).val());
	});
	
	$(container).find('.other-ded-inc-amount').each(function (index, element) {
		OTHER_DED_AMOUNT += parseInt($(element).val());
	});
	
	PT_AMOUNT = getElementValue(ptDeductionComponentElement);
	NET_AMOUNT = GROSS_AMOUNT - DED_AMOUNT;
	CREDIT_AMOUNT = GROSS_AMOUNT - PT_AMOUNT - DED_AMOUNT - OTHER_DED_AMOUNT;
	
	grossComponentElement.val(GROSS_AMOUNT);
	deductionComponentElement.val(DED_AMOUNT);
	otherDeductionComponentElement.val(OTHER_DED_AMOUNT);
	netComponentElement.val(NET_AMOUNT);
	creditComponentElement.val(CREDIT_AMOUNT);
	
}
function LTCValueChange(field){
	var container = (TABLE_FORMAT) ? $(field).parents('tr') : $(field).parents('table'),
	grossComponentElement = $(container).find('#gross-components'),
	deductionComponentElement = $(container).find('#ded-components'),
	otherDeductionComponentElement = $(container).find('#other-ded-components')
	netComponentElement = $(container).find('#net-components'),
	ltcCreditComponentElement = $(container).find('#ltc-credit-component'),
	creditComponentElement = $(container).find('#credit-component');
	
	var GROSS_AMOUNT = 0,
	DED_AMOUNT = 0,
	OTHER_DED_AMOUNT = 0,
	PT_AMOUNT = 0,
	NET_AMOUNT = 0,
	CREDIT_AMOUNT = 0,
	LTC_DED = 0,
	LTC_CREDIT = 0; 
	
	$(container).find('.gross-inc-amount').each(function (index, element) {
		GROSS_AMOUNT += parseInt($(element).val());
	});
	
	$(container).find('.ltc-ded-inc-amount').each(function (index, element) {
		LTC_DED += parseInt($(element).val());
	});
	
	NET_AMOUNT = CREDIT_AMOUNT = LTC_CREDIT = GROSS_AMOUNT - LTC_DED;
	
	grossComponentElement.val(GROSS_AMOUNT);
	deductionComponentElement.val(LTC_DED);
	ltcCreditComponentElement.val(LTC_CREDIT);
	otherDeductionComponentElement.val(OTHER_DED_AMOUNT);
	netComponentElement.val(NET_AMOUNT);
	creditComponentElement.val(CREDIT_AMOUNT);
	
}
function openEmployeeSalaryDetails(empID) {
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
	$("#tablink-"+empID+" a").addClass("active");
	
	activeTab = parseInt(empID);
	$("#HDFORM16URL").val(FORM_16_URL + empID);
}
function openForm16(id){
	$("#HDFORM16URL").val(FORM_16_URL + id);
	$("#form-16-panel iframe").attr('src', $("#HDFORM16URL").val());
	$("#form-16-panel").toggle();  
}
document.onkeyup=function(e){
	var e = e || window.event; 
	//e.altKey && 
	//i key code 73
	if(e.which == 27) {
		$("#form-16-panel").toggle();  
	}
	if(e.which == 37) {
		$('#btn-prev').trigger('click');
		return false;
	}
	if(e.which == 39) {
		$('#btn-next').trigger('click');
	}
	if(e.which == 81) {
		if($("#HDFORM16URL").val() != ""){
			$("#form-16-panel iframe").attr('src', $("#HDFORM16URL").val());
			$("#form-16-panel").toggle();  
			$("#"+activeTab+" #income-tax").focus();
		}
		return false;
	}
}
function toggleColumns(checkbox, columnName){
	var columnIndex = $("#data-table tr th."+columnName).index();
	if($(checkbox).is(":checked")){
		$('#data-table tr th.'+columnName).show();
		$('#data-table tr td.'+columnName).show();
	}
	else{
		$('#data-table tr th.'+columnName).hide();
		$('#data-table tr td.'+columnName).hide();
	}
}
function toggleAllColumns(checkbox){
	if($(checkbox).is(":checked")){
		$('#data-table tr th.COL_ELEMENT, #data-table tr td.COL_ELEMENT').show();
		$('#option-menu input[type=checkbox].ATTRIBUTE_BTN').prop('checked',true);
	}
	else{
		$('#data-table tr th.COL_ELEMENT, #data-table tr td.COL_ELEMENT').hide();
		$('#option-menu input[type=checkbox].ATTRIBUTE_BTN').prop('checked',false);
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
function submitSalaryDetails(){
	var result = false;
	if(confirm('Are you sure wants to submit the bill, This will change the Appropiation Register')){
		if(unsaved){
			unsaved = false;
		} 
		result = true;
	}
	return result;
}

function unloadPage(){ 
    if(unsaved){
        return "You have unsaved changes. Do you want to leave this page and discard your changes or stay on this page?";
    }
}
var SALARY_OPS_BILL = 1,
	SALARY_NPS_BILL = 2
	OE_BILL = 3,
	DTE_BILL = 4,
	MEDICAL_BILL = 6,
	WAGES_BILL = 8,
	OPS_PAY_BILL = 15,
	NPS_PAY_BILL = 16,
	OPS_ARREAR_BILL = 17,
	NPS_ARREAR_BILL = 18,
	OPS_AD_BONUS_BILL = 19,
	NPS_AD_BONUS_BILL = 20,
	OPS_CEA_BILL = 21,
	NPS_CEA_BILL = 22,
	OPS_UA_BILL = 23,
	NPS_UA_BILL = 24,
	OPS_EL_ENCASHMENT_BILL = 25,
	NPS_EL_ENCASHMENT_BILL = 26,
	OPS_LTC_ADVANCE_BILL = 27,
	NPS_LTC_ADVANCE_BILL = 28,
	OPS_LTC_CLAIM_BILL = 29,
	NPS_LTC_CLAIM_BILL = 30,
	OPS_RECOVERY_BILL = 31,
	NPS_RECOVERY_BILL = 32,
	DTE_TOUR_TA_ADVANCE_BILL = 33,
	DTE_TRANSFER_TA_ADVANCE_BILL = 34,
	DTE_TOUR_TA_CLAIM_BILL = 35,
	DTE_TRANSFER_TA_CLAIM_BILL = 36,
	WAGES_PAY_BILL = 37,
	MEDICAL_ADVANCE = 38,
	MEDICAL_CLAIM = 39,
	OE_Postage_and_Telegrams = 1,
	OE_Furniture = 2,
	OE_Contingents_pay_House_keeping = 3,
	OE_Other_Office_Machineries = 4,
	OE_Office_Equipments = 5,
	OE_Water_Charges = 6,
	OE_Stationery_Local_Purchase = 7,
	OE_Purchase_of_Books_and_Publication = 8,
	OE_Perishable = 9,
	OE_Imprest = 10,
	OE_Diesel = 11,
	OE_Telephones = 12,
	OE_Electricity_Charges = 13,
	OE_Misc_Office_Expenses = 14;
	
	
	
$(document).ready(function(){
	resetBiilSelection();
	loadFormOnUpdate();
	$('body').on('change', '.bills_amount', function() {
		var total = 0;debugger;
		$('.bills_amount').each(function(index, element){
			total += parseInt($(element).val());
		});
		$('#Bill_BILL_AMOUNT').val(total);
	});
	
	$('body').on('change', '.cea_bills_amount', function() {
		var total = 0;debugger;
		$('.cea_bills_amount').each(function(index, element){
			total += parseInt($(element).val());
		});
		$('#Bill_BILL_AMOUNT').val(total);
	});
	
	$('#Bill_OE_IT_DED').on('keyup', function() {
		$('#Bill_OE_NET_AMOUNT').val($('#Bill_BILL_AMOUNT').val() - $('#Bill_OE_IT_DED').val())
	});
	
	$('#Bill_CLAIM_ADVANCE_AMOUNT').on('keyup', function() {
		$('#Bill_BILL_AMOUNT').val($('#Bill_CLAIM_GROSS_AMOUNT').val() - $('#Bill_CLAIM_ADVANCE_AMOUNT').val())
	});
	
	$('#slBillType').change(function(){
		resetBiilSelection();
	});
	
	$('#Bill_BILL_SUB_TYPE').change(function(){
		resetBiilSelection();
		var bill_type = parseInt($("#slBillType").val());
		var bill_sub_type = parseInt($(this).val());
		
		if(bill_type == SALARY_OPS_BILL){
			if(bill_sub_type == OPS_PAY_BILL){
				//var register_count = parseInt($("#BILL_REGISTER_COUNT").val());
				//$("#Bill_BILL_NO").val("P/"+zeroPad((register_count+1), 2)+"/"+FIANANCIAL_YEAR+" dt "+TODAY_DATE);
				//$("#Bill_PT_DED_BILL_NO").val("P/"+zeroPad((register_count+2), 2)+"/"+FIANANCIAL_YEAR+" dt "+TODAY_DATE);
				//$("#BILL_ENTRY_COUNT").val(2);
				//$("#Bill_NILL_BILL_NO").val("");
				
				$("#BILL_NO_SECTION").show();
				$("#PT_BILL_NO_SECTION").show();
				$("#BILL_TITLE_SECTION").show();
				$("#MONTH_SECTION").show();
				$("#YEAR_SECTION").show();
				$("#CREATION_DATE_SECTION").show();
				$('#txtBillTitle').val("PAY AND ALLOWANCE in R/O OPS Staff of "+DEPT_NAME+" (OLD PENSION SCHEME) for the month of "+MONTH_YEAR);
			}
			if(bill_sub_type == OPS_ARREAR_BILL){
				//var register_count = parseInt($("#BILL_REGISTER_COUNT").val());
				//$("#Bill_BILL_NO").val("Arr/"+zeroPad((register_count+1), 2)+"/"+FIANANCIAL_YEAR+" dt "+TODAY_DATE);
				
				$("#ops-emp").show();
				$("#BILL_NO_SECTION").show();
				$("#PT_BILL_NO_SECTION").show();
				$("#BILL_TITLE_SECTION").show();
				$("#MONTH_SECTION").show();
				$("#YEAR_SECTION").show();
				$("#CREATION_DATE_SECTION").show();
				$("#FILE_NO_SECTION").show();
				$("#PFMS_BILL_NO_SECTION").show();
				$("#IS_ARREAR_BILL").val(1);
				$('#txtBillTitle').val($("#Bill_BILL_SUB_TYPE option:selected").text()+" in R/O OPS Staff of "+DEPT_NAME+" (OLD PENSION SCHEME) for the month of "+MONTH_YEAR);
			}
			if(bill_sub_type == OPS_AD_BONUS_BILL){
				//var register_count = parseInt($("#BILL_REGISTER_COUNT").val());
				//$("#Bill_BILL_NO").val("Ad-Bonus/"+zeroPad((register_count+1), 2)+"/"+FIANANCIAL_YEAR+" dt "+TODAY_DATE);
				$("#bonus-ops-emp").show();
				$("#BILL_NO_SECTION").show();
				$("#BILL_TITLE_SECTION").show();
				$("#MONTH_SECTION").show();
				$("#YEAR_SECTION").show();
				$("#CREATION_DATE_SECTION").show();
				$("#FILE_NO_SECTION").show();
				$("#PFMS_BILL_NO_SECTION").show();
				$("#IS_BONUS_BILL").val(1);
				$('#txtBillTitle').val($("#Bill_BILL_SUB_TYPE option:selected").text()+" in R/O OPS Staff of "+DEPT_NAME);
			}
			if(bill_sub_type == OPS_UA_BILL){
				//var register_count = parseInt($("#BILL_REGISTER_COUNT").val());
				//$("#Bill_BILL_NO").val("UA/"+zeroPad((register_count+1), 2)+"/"+FIANANCIAL_YEAR+" dt "+TODAY_DATE);
				$("#ua-emp").show();
				$("#UA_PERIOD").show();
				$("#BILL_NO_SECTION").show();
				$("#BILL_TITLE_SECTION").show();
				$("#MONTH_SECTION").show();
				$("#YEAR_SECTION").show();
				$("#CREATION_DATE_SECTION").show();
				$("#FILE_NO_SECTION").show();
				$("#PFMS_BILL_NO_SECTION").show();
				$("#IS_UA_BILL").val(1);
				$('#txtBillTitle').val($("#Bill_BILL_SUB_TYPE option:selected").text()+" in R/O OPS Staff of "+DEPT_NAME);
			}
			if(bill_sub_type == OPS_CEA_BILL){
				//var register_count = parseInt($("#BILL_REGISTER_COUNT").val());
				//$("#Bill_BILL_NO").val("CEA/"+zeroPad((register_count+1), 2)+"/"+FIANANCIAL_YEAR+" dt "+TODAY_DATE);
				$("#ops-emp").show();
				$("#BILL_NO_SECTION").show();
				$("#BILL_TITLE_SECTION").show();
				$("#MONTH_SECTION").show();
				$("#YEAR_SECTION").show();
				$("#CREATION_DATE_SECTION").show();
				$("#CEA_BILLS_SECTION").show();
				$("#FILE_NO_SECTION").show();
				$("#PFMS_BILL_NO_SECTION").show();
				$("#IS_CEA_BILL").val(1);
				$('#txtBillTitle').val($("#Bill_BILL_SUB_TYPE option:selected").text()+" in R/O OPS Staff of "+DEPT_NAME);
			}
			if(bill_sub_type == OPS_LTC_ADVANCE_BILL){
				//var register_count = parseInt($("#BILL_REGISTER_COUNT").val());
				//$("#Bill_BILL_NO").val("LTC/"+zeroPad((register_count+1), 2)+"/"+FIANANCIAL_YEAR+" dt "+TODAY_DATE);
				$("#ops-emp").show();
				$("#BILL_NO_SECTION").show();
				$("#BILL_TITLE_SECTION").show();
				$("#MONTH_SECTION").show();
				$("#YEAR_SECTION").show();
				$("#CREATION_DATE_SECTION").show();
				$("#FILE_NO_SECTION").show();
				$("#PFMS_BILL_NO_SECTION").show();
				$("#IS_LTC_ADVANCE_BILL").val(1);
				$('#txtBillTitle').val($("#Bill_BILL_SUB_TYPE option:selected").text()+" in R/O OPS Staff of "+DEPT_NAME);
			}
			if(bill_sub_type == OPS_LTC_CLAIM_BILL){
				//var register_count = parseInt($("#BILL_REGISTER_COUNT").val());
				//$("#Bill_BILL_NO").val("LTC/"+zeroPad((register_count+1), 2)+"/"+FIANANCIAL_YEAR+" dt "+TODAY_DATE);
				$("#ops-emp").show();
				$("#BILL_NO_SECTION").show();
				$("#BILL_TITLE_SECTION").show();
				$("#MONTH_SECTION").show();
				$("#YEAR_SECTION").show();
				$("#CREATION_DATE_SECTION").show();
				$("#FILE_NO_SECTION").show();
				$("#PFMS_BILL_NO_SECTION").show();
				$("#IS_LTC_CLAIM_BILL").val(1);
				$('#txtBillTitle').val($("#Bill_BILL_SUB_TYPE option:selected").text()+" in R/O OPS Staff of "+DEPT_NAME);
			}
			if(bill_sub_type == OPS_EL_ENCASHMENT_BILL){
				//var register_count = parseInt($("#BILL_REGISTER_COUNT").val());
				//$("#Bill_BILL_NO").val("CEA/"+zeroPad((register_count+1), 2)+"/"+FIANANCIAL_YEAR+" dt "+TODAY_DATE);
				$("#ops-emp").show();
				$("#BILL_NO_SECTION").show();
				$("#BILL_TITLE_SECTION").show();
				$("#MONTH_SECTION").show();
				$("#YEAR_SECTION").show();
				$("#CREATION_DATE_SECTION").show();
				$("#FILE_NO_SECTION").show();
				$("#PFMS_BILL_NO_SECTION").show();
				$("#IS_EL_ENCASHMENT_BILL").val(1);
				$('#txtBillTitle').val($("#Bill_BILL_SUB_TYPE option:selected").text()+" in R/O OPS Staff of "+DEPT_NAME);
			}
			if(bill_sub_type == OPS_RECOVERY_BILL){
				//var register_count = parseInt($("#BILL_REGISTER_COUNT").val());
				//$("#Bill_BILL_NO").val("CEA/"+zeroPad((register_count+1), 2)+"/"+FIANANCIAL_YEAR+" dt "+TODAY_DATE);
				$("#ops-emp").show();
				$("#BILL_NO_SECTION").show();
				$("#BILL_TITLE_SECTION").show();
				$("#MONTH_SECTION").show();
				$("#YEAR_SECTION").show();
				$("#CREATION_DATE_SECTION").show();
				$("#FILE_NO_SECTION").show();
				$("#PFMS_BILL_NO_SECTION").show();
				$("#IS_RECOVERY_BILL").val(1);
				$('#txtBillTitle').val($("#Bill_BILL_SUB_TYPE option:selected").text()+" in R/O OPS Staff of "+DEPT_NAME);
			}
		}
		else if(bill_type == SALARY_NPS_BILL){
			if(bill_sub_type == NPS_PAY_BILL){
				//var register_count = parseInt($("#BILL_REGISTER_COUNT").val());
				//$("#Bill_BILL_NO").val("P/"+zeroPad((register_count+1), 2)+"/"+FIANANCIAL_YEAR+" dt "+TODAY_DATE);
				//$("#Bill_NILL_BILL_NO").val("P/"+zeroPad((register_count+2), 2)+"/"+FIANANCIAL_YEAR+" dt "+TODAY_DATE);
				//$("#Bill_LIC_DED_BILL_NO").val("P/"+zeroPad((register_count+3), 2)+"/"+FIANANCIAL_YEAR+" dt "+TODAY_DATE);
				//$("#Bill_PT_DED_BILL_NO").val("P/"+zeroPad((register_count+4), 2)+"/"+FIANANCIAL_YEAR+" dt "+TODAY_DATE);
				//$("#BILL_ENTRY_COUNT").val(4);
				
				$("#BILL_NO_SECTION").show();
				$("#PT_BILL_NO_SECTION").show();
				$("#NILL_BILL_NO_SECTION").show();
				$("#BILL_TITLE_SECTION").show();
				$("#MONTH_SECTION").show();
				$("#YEAR_SECTION").show();
				$("#CREATION_DATE_SECTION").show();
				$('#txtBillTitle').val("PAY AND ALLOWANCE in R/O NPS Staff of "+DEPT_NAME+" (NEW PENSION SCHEME) for the month of "+MONTH_YEAR);
			}
			if(bill_sub_type == NPS_ARREAR_BILL){
				//var register_count = parseInt($("#BILL_REGISTER_COUNT").val());
				//$("#Bill_BILL_NO").val("HRA Arr/"+zeroPad((register_count+1), 2)+"/"+FIANANCIAL_YEAR+" dt "+TODAY_DATE);
				//$("#Bill_BILL_NO").val("DA Arr/"+zeroPad((register_count+1), 2)+"/"+FIANANCIAL_YEAR+" dt "+TODAY_DATE);
				//$("#Bill_NILL_BILL_NO").val("DA Arr/"+zeroPad((register_count+2), 2)+"/"+FIANANCIAL_YEAR+" dt "+TODAY_DATE);
				//$("#Bill_BILL_NO").val("Arrear/"+zeroPad((register_count+1), 2)+"/"+FIANANCIAL_YEAR+" dt "+TODAY_DATE);
				//$("#Bill_NILL_BILL_NO").val("Arrear/"+zeroPad((register_count+2), 2)+"/"+FIANANCIAL_YEAR+" dt "+TODAY_DATE);
				
				$("#nps-emp").show();
				$("#BILL_NO_SECTION").show();
				$("#PT_BILL_NO_SECTION").show();
				$("#NILL_BILL_NO_SECTION").show();
				$("#BILL_TITLE_SECTION").show();
				$("#MONTH_SECTION").show();
				$("#YEAR_SECTION").show();
				$("#CREATION_DATE_SECTION").show();
				$("#FILE_NO_SECTION").show();
				$("#PFMS_BILL_NO_SECTION").show();
				$("#IS_ARREAR_BILL").val(1);
				$('#txtBillTitle').val($("#Bill_BILL_SUB_TYPE option:selected").text()+" in R/O NPS Staff of "+DEPT_NAME);
			}
			if(bill_sub_type == NPS_AD_BONUS_BILL){
				//var register_count = parseInt($("#BILL_REGISTER_COUNT").val());
				//$("#Bill_BILL_NO").val("Ad-Bonus/"+zeroPad((register_count+1), 2)+"/"+FIANANCIAL_YEAR+" dt "+TODAY_DATE);
				$("#bonus-nps-emp").show();
				$("#BILL_NO_SECTION").show();
				$("#BILL_TITLE_SECTION").show();
				$("#MONTH_SECTION").show();
				$("#YEAR_SECTION").show();
				$("#CREATION_DATE_SECTION").show();
				$("#FILE_NO_SECTION").show();
				$("#PFMS_BILL_NO_SECTION").show();
				$("#IS_BONUS_BILL").val(1);
				$('#txtBillTitle').val($("#Bill_BILL_SUB_TYPE option:selected").text()+" in R/O NPS Staff of "+DEPT_NAME);
			}
			if(bill_sub_type == NPS_UA_BILL){
				//var register_count = parseInt($("#BILL_REGISTER_COUNT").val());
				//$("#Bill_BILL_NO").val("UA/"+zeroPad((register_count+1), 2)+"/"+FIANANCIAL_YEAR+" dt "+TODAY_DATE);
				$("#ua-emp").show();
				$("#UA_PERIOD").show();
				$("#BILL_NO_SECTION").show();
				$("#BILL_TITLE_SECTION").show();
				$("#MONTH_SECTION").show();
				$("#YEAR_SECTION").show();
				$("#CREATION_DATE_SECTION").show();
				$("#FILE_NO_SECTION").show();
				$("#PFMS_BILL_NO_SECTION").show();
				$("#IS_UA_BILL").val(1);
				$('#txtBillTitle').val($("#Bill_BILL_SUB_TYPE option:selected").text()+" in R/O NPS Staff of "+DEPT_NAME);
			}
			if(bill_sub_type == NPS_CEA_BILL){
				//var register_count = parseInt($("#BILL_REGISTER_COUNT").val());
				//$("#Bill_BILL_NO").val("CEA/"+zeroPad((register_count+1), 2)+"/"+FIANANCIAL_YEAR+" dt "+TODAY_DATE);
				$("#nps-emp").show();
				$("#BILL_NO_SECTION").show();
				$("#BILL_TITLE_SECTION").show();
				$("#MONTH_SECTION").show();
				$("#YEAR_SECTION").show();
				$("#CREATION_DATE_SECTION").show();
				$("#CEA_BILLS_SECTION").show();
				$("#FILE_NO_SECTION").show();
				$("#PFMS_BILL_NO_SECTION").show();
				$("#IS_CEA_BILL").val(1);
				$('#txtBillTitle').val($("#Bill_BILL_SUB_TYPE option:selected").text()+" in R/O NPS Staff of "+DEPT_NAME);
			}
			if(bill_sub_type == NPS_LTC_ADVANCE_BILL){
				//var register_count = parseInt($("#BILL_REGISTER_COUNT").val());
				//$("#Bill_BILL_NO").val("LTC/"+zeroPad((register_count+1), 2)+"/"+FIANANCIAL_YEAR+" dt "+TODAY_DATE);
				$("#nps-emp").show();
				$("#BILL_NO_SECTION").show();
				$("#BILL_TITLE_SECTION").show();
				$("#MONTH_SECTION").show();
				$("#YEAR_SECTION").show();
				$("#CREATION_DATE_SECTION").show();
				$("#FILE_NO_SECTION").show();
				$("#PFMS_BILL_NO_SECTION").show();
				$("#IS_LTC_ADVANCE_BILL").val(1);
				$('#txtBillTitle').val($("#Bill_BILL_SUB_TYPE option:selected").text()+" in R/O NPS Staff of "+DEPT_NAME);
			}
			if(bill_sub_type == NPS_LTC_CLAIM_BILL){
				//var register_count = parseInt($("#BILL_REGISTER_COUNT").val());
				//$("#Bill_BILL_NO").val("LTC/"+zeroPad((register_count+1), 2)+"/"+FIANANCIAL_YEAR+" dt "+TODAY_DATE);
				$("#nps-emp").show();
				$("#BILL_NO_SECTION").show();
				$("#BILL_TITLE_SECTION").show();
				$("#MONTH_SECTION").show();
				$("#YEAR_SECTION").show();
				$("#CREATION_DATE_SECTION").show();
				$("#FILE_NO_SECTION").show();
				$("#PFMS_BILL_NO_SECTION").show();
				$("#CLAIM_GROSS_SECTION").show();
				$("#CLAIM_ADVANCE_SECTION").show();
				$("#IS_LTC_CLAIM_BILL").val(1);
				$('#txtBillTitle').val($("#Bill_BILL_SUB_TYPE option:selected").text()+" in R/O NPS Staff of "+DEPT_NAME);
			}
			if(bill_sub_type == NPS_EL_ENCASHMENT_BILL){
				//var register_count = parseInt($("#BILL_REGISTER_COUNT").val());
				//$("#Bill_BILL_NO").val("CEA/"+zeroPad((register_count+1), 2)+"/"+FIANANCIAL_YEAR+" dt "+TODAY_DATE);
				$("#nps-emp").show();
				$("#BILL_NO_SECTION").show();
				$("#BILL_TITLE_SECTION").show();
				$("#MONTH_SECTION").show();
				$("#YEAR_SECTION").show();
				$("#CREATION_DATE_SECTION").show();
				$("#FILE_NO_SECTION").show();
				$("#PFMS_BILL_NO_SECTION").show();
				$("#IS_EL_ENCASHMENT_BILL").val(1);
				$('#txtBillTitle').val($("#Bill_BILL_SUB_TYPE option:selected").text()+" in R/O NPS Staff of "+DEPT_NAME);
			}
			if(bill_sub_type == NPS_RECOVERY_BILL){
				//var register_count = parseInt($("#BILL_REGISTER_COUNT").val());
				//$("#Bill_BILL_NO").val("CEA/"+zeroPad((register_count+1), 2)+"/"+FIANANCIAL_YEAR+" dt "+TODAY_DATE);
				$("#nps-emp").show();
				$("#BILL_NO_SECTION").show();
				$("#BILL_TITLE_SECTION").show();
				$("#MONTH_SECTION").show();
				$("#YEAR_SECTION").show();
				$("#CREATION_DATE_SECTION").show();
				$("#FILE_NO_SECTION").show();
				$("#PFMS_BILL_NO_SECTION").show();
				$("#IS_RECOVERY_BILL").val(1);
				$('#txtBillTitle').val($("#Bill_BILL_SUB_TYPE option:selected").text()+" in R/O NPS Staff of "+DEPT_NAME);
			}
		}
		else if(bill_type == WAGES_BILL){
			if(bill_sub_type == WAGES_PAY_BILL){
				$('#txtBillTitle').val("Wages in respect of  "+DEPT_NAME+" for the month of "+MONTH_YEAR);
				//var register_count = parseInt($("#BILL_REGISTER_COUNT").val());
				//$("#Bill_BILL_NO").val("WPB/"+zeroPad((register_count+1), 2)+"/"+FIANANCIAL_YEAR+" dt "+TODAY_DATE);
				//$("#Bill_PT_DED_BILL_NO").val("WPB/"+zeroPad((register_count+2), 2)+"/"+FIANANCIAL_YEAR+" dt "+TODAY_DATE);
				//$("#BILL_ENTRY_COUNT").val(2);
				$("#wages-emp").show();
				$("#BILL_NO_SECTION").show();
				$("#PT_BILL_NO_SECTION").show();
				$("#BILL_TITLE_SECTION").show();
				$("#MONTH_SECTION").show();
				$("#YEAR_SECTION").show();
				$("#CREATION_DATE_SECTION").show();
				$("#FILE_NO_SECTION").show();
				$("#PFMS_BILL_NO_SECTION").show();
				$("#CER_NO_SECTION").show();
				$('#txtBillTitle').val($("#Bill_BILL_SUB_TYPE option:selected").text()+" in R/O OPS Staff of "+DEPT_NAME);
			}
		}
		else if(bill_type == OE_BILL){
			if(bill_sub_type == OE_Postage_and_Telegrams){
				//var register_count = parseInt($("#BILL_REGISTER_COUNT").val());
				//$("#Bill_BILL_NO").val("OE/"+zeroPad((register_count+1), 2)+"/"+FIANANCIAL_YEAR+" dt "+TODAY_DATE);
				//$("#BILL_ENTRY_COUNT").val(1);
				
				$("#BILL_NO_SECTION").show();
				$("#BILL_TITLE_SECTION").show();
				$("#BILL_AMOUNT_SECTION").show();
				$("#FILE_NO_SECTION").show();
				$("#OE_IT_DED_SECTION").show();
				$("#OE_NET_AMOUNT_SECTION").show();
				$("#VENDOR_ID_SECTION").show();
				$("#OE_BILLS_SECTION").show();
				$("#PFMS_BILL_NO_SECTION").show();
				$("#CER_NO_SECTION").show();
				$("#MONTH_SECTION").show();
				$("#YEAR_SECTION").show();
				$("#CREATION_DATE_SECTION").show();
				$('#txtBillTitle').val("Purchase of "+$("#Bill_BILL_SUB_TYPE option:selected").text()+" in R/O of "+DEPT_NAME);
			}
			else if(bill_sub_type == OE_Furniture){
				//var register_count = parseInt($("#BILL_REGISTER_COUNT").val());
				//$("#Bill_BILL_NO").val("OE/"+zeroPad((register_count+1), 2)+"/"+FIANANCIAL_YEAR+" dt "+TODAY_DATE);
				//$("#BILL_ENTRY_COUNT").val(1);
				
				$("#BILL_NO_SECTION").show();
				$("#BILL_TITLE_SECTION").show();
				$("#BILL_AMOUNT_SECTION").show();
				$("#FILE_NO_SECTION").show();
				$("#OE_IT_DED_SECTION").show();
				$("#OE_NET_AMOUNT_SECTION").show();
				$("#VENDOR_ID_SECTION").show();
				$("#OE_BILLS_SECTION").show();
				$("#PFMS_BILL_NO_SECTION").show();
				$("#CER_NO_SECTION").show();
				$("#MONTH_SECTION").show();
				$("#YEAR_SECTION").show();
				$("#CREATION_DATE_SECTION").show();
				$('#txtBillTitle').val("Purchase of "+$("#Bill_BILL_SUB_TYPE option:selected").text()+" in R/O of "+DEPT_NAME);
			}
			else if(bill_sub_type == OE_Contingents_pay_House_keeping){
				//var register_count = parseInt($("#BILL_REGISTER_COUNT").val());
				//$("#Bill_BILL_NO").val("OE/"+zeroPad((register_count+1), 2)+"/"+FIANANCIAL_YEAR+" dt "+TODAY_DATE);
				//$("#BILL_ENTRY_COUNT").val(1);
				
				$("#BILL_NO_SECTION").show();
				$("#BILL_TITLE_SECTION").show();
				$("#BILL_AMOUNT_SECTION").show();
				$("#FILE_NO_SECTION").show();
				$("#OE_IT_DED_SECTION").show();
				$("#OE_NET_AMOUNT_SECTION").show();
				$("#VENDOR_ID_SECTION").show();
				$("#OE_BILLS_SECTION").show();
				$("#PFMS_BILL_NO_SECTION").show();
				$("#CER_NO_SECTION").show();
				$("#MONTH_SECTION").show();
				$("#YEAR_SECTION").show();
				$("#CREATION_DATE_SECTION").show();
				$('#txtBillTitle').val("Payment of "+$("#Bill_BILL_SUB_TYPE option:selected").text()+" charges in R/O of "+DEPT_NAME);
			}
			else if(bill_sub_type == OE_Other_Office_Machineries){
				//var register_count = parseInt($("#BILL_REGISTER_COUNT").val());
				//$("#Bill_BILL_NO").val("OE/"+zeroPad((register_count+1), 2)+"/"+FIANANCIAL_YEAR+" dt "+TODAY_DATE);
				
				$("#BILL_NO_SECTION").show();
				$("#BILL_TITLE_SECTION").show();
				$("#BILL_AMOUNT_SECTION").show();
				$("#FILE_NO_SECTION").show();
				$("#OE_IT_DED_SECTION").show();
				$("#OE_NET_AMOUNT_SECTION").show();
				$("#VENDOR_ID_SECTION").show();
				$("#OE_BILLS_SECTION").show();
				$("#PFMS_BILL_NO_SECTION").show();
				$("#CER_NO_SECTION").show();
				$("#MONTH_SECTION").show();
				$("#YEAR_SECTION").show();
				$("#CREATION_DATE_SECTION").show();
				$('#txtBillTitle').val("Purchase of "+$("#Bill_BILL_SUB_TYPE option:selected").text()+" in R/O of "+DEPT_NAME);
			}
			else if(bill_sub_type == OE_Office_Equipments){
				//var register_count = parseInt($("#BILL_REGISTER_COUNT").val());
				//$("#Bill_BILL_NO").val("OE/"+zeroPad((register_count+1), 2)+"/"+FIANANCIAL_YEAR+" dt "+TODAY_DATE);
				
				$("#BILL_NO_SECTION").show();
				$("#BILL_TITLE_SECTION").show();
				$("#BILL_AMOUNT_SECTION").show();
				$("#FILE_NO_SECTION").show();
				$("#OE_IT_DED_SECTION").show();
				$("#OE_NET_AMOUNT_SECTION").show();
				$("#VENDOR_ID_SECTION").show();
				$("#OE_BILLS_SECTION").show();
				$("#PFMS_BILL_NO_SECTION").show();
				$("#CER_NO_SECTION").show();
				$("#MONTH_SECTION").show();
				$("#YEAR_SECTION").show();
				$("#CREATION_DATE_SECTION").show();
				$('#txtBillTitle').val("Purchase of "+$("#Bill_BILL_SUB_TYPE option:selected").text()+" in R/O of "+DEPT_NAME);
			}
			else if(bill_sub_type == OE_Water_Charges){
				//var register_count = parseInt($("#BILL_REGISTER_COUNT").val());
				//$("#Bill_BILL_NO").val("OE/"+zeroPad((register_count+1), 2)+"/"+FIANANCIAL_YEAR+" dt "+TODAY_DATE);
				
				$("#BILL_NO_SECTION").show();
				$("#BILL_TITLE_SECTION").show();
				$("#BILL_AMOUNT_SECTION").show();
				$("#FILE_NO_SECTION").show();
				$("#OE_IT_DED_SECTION").show();
				$("#OE_NET_AMOUNT_SECTION").show();
				$("#VENDOR_ID_SECTION").show();
				$("#OE_BILLS_SECTION").show();
				$("#PFMS_BILL_NO_SECTION").show();
				$("#CER_NO_SECTION").show();
				$("#MONTH_SECTION").show();
				$("#YEAR_SECTION").show();
				$("#CREATION_DATE_SECTION").show();
				$('#txtBillTitle').val("Payement of "+$("#Bill_BILL_SUB_TYPE option:selected").text()+" for the month of "+PREVIOUS_MONTH_YEAR+" in R/O of "+DEPT_NAME);
			}
			else if(bill_sub_type == OE_Stationery_Local_Purchase){
				//var register_count = parseInt($("#BILL_REGISTER_COUNT").val());
				//$("#Bill_BILL_NO").val("OE/"+zeroPad((register_count+1), 2)+"/"+FIANANCIAL_YEAR+" dt "+TODAY_DATE);
				
				$("#BILL_NO_SECTION").show();
				$("#BILL_TITLE_SECTION").show();
				$("#BILL_AMOUNT_SECTION").show();
				$("#FILE_NO_SECTION").show();
				$("#OE_IT_DED_SECTION").show();
				$("#OE_NET_AMOUNT_SECTION").show();
				$("#VENDOR_ID_SECTION").show();
				$("#OE_BILLS_SECTION").show();
				$("#PFMS_BILL_NO_SECTION").show();
				$("#CER_NO_SECTION").show();
				$("#MONTH_SECTION").show();
				$("#YEAR_SECTION").show();
				$("#CREATION_DATE_SECTION").show();
				$('#txtBillTitle').val("Purchase of "+$("#Bill_BILL_SUB_TYPE option:selected").text()+" in R/O of "+DEPT_NAME);
			}
			else if(bill_sub_type == OE_Purchase_of_Books_and_Publication){
				//var register_count = parseInt($("#BILL_REGISTER_COUNT").val());
				//$("#Bill_BILL_NO").val("OE/"+zeroPad((register_count+1), 2)+"/"+FIANANCIAL_YEAR+" dt "+TODAY_DATE);
				
				$("#BILL_NO_SECTION").show();
				$("#BILL_TITLE_SECTION").show();
				$("#BILL_AMOUNT_SECTION").show();
				$("#FILE_NO_SECTION").show();
				$("#OE_IT_DED_SECTION").show();
				$("#OE_NET_AMOUNT_SECTION").show();
				$("#VENDOR_ID_SECTION").show();
				$("#OE_BILLS_SECTION").show();
				$("#PFMS_BILL_NO_SECTION").show();
				$("#CER_NO_SECTION").show();
				$("#MONTH_SECTION").show();
				$("#YEAR_SECTION").show();
				$("#CREATION_DATE_SECTION").show();
				$('#txtBillTitle').val("Purchase of "+$("#Bill_BILL_SUB_TYPE option:selected").text()+" in R/O of "+DEPT_NAME);
			}
			else if(bill_sub_type == OE_Perishable){
				//var register_count = parseInt($("#BILL_REGISTER_COUNT").val());
				//$("#Bill_BILL_NO").val("OE/"+zeroPad((register_count+1), 2)+"/"+FIANANCIAL_YEAR+" dt "+TODAY_DATE);
				
				$("#BILL_NO_SECTION").show();
				$("#BILL_TITLE_SECTION").show();
				$("#BILL_AMOUNT_SECTION").show();
				$("#FILE_NO_SECTION").show();
				$("#OE_IT_DED_SECTION").show();
				$("#OE_NET_AMOUNT_SECTION").show();
				$("#VENDOR_ID_SECTION").show();
				$("#OE_BILLS_SECTION").show();
				$("#PFMS_BILL_NO_SECTION").show();
				$("#CER_NO_SECTION").show();
				$("#MONTH_SECTION").show();
				$("#YEAR_SECTION").show();
				$("#CREATION_DATE_SECTION").show();
				$('#txtBillTitle').val("Purchase of "+$("#Bill_BILL_SUB_TYPE option:selected").text()+" in R/O of "+DEPT_NAME);
			}
			else if(bill_sub_type == OE_Imprest){
				//var register_count = parseInt($("#BILL_REGISTER_COUNT").val());
				//$("#Bill_BILL_NO").val("OE/"+zeroPad((register_count+1), 2)+"/"+FIANANCIAL_YEAR+" dt "+TODAY_DATE);
				
				$("#BILL_NO_SECTION").show();
				$("#BILL_TITLE_SECTION").show();
				$("#BILL_AMOUNT_SECTION").show();
				$("#FILE_NO_SECTION").show();
				$("#OE_IT_DED_SECTION").show();
				$("#OE_NET_AMOUNT_SECTION").show();
				$("#VENDOR_ID_SECTION").show();
				$("#OE_BILLS_SECTION").show();
				$("#PFMS_BILL_NO_SECTION").show();
				$("#CER_NO_SECTION").show();
				$("#MONTH_SECTION").show();
				$("#YEAR_SECTION").show();
				$("#CREATION_DATE_SECTION").show();
				$('#txtBillTitle').val("Payment of "+$("#Bill_BILL_SUB_TYPE option:selected").text()+" in R/O of "+DEPT_NAME);
			}
			else if(bill_sub_type == OE_Diesel){
				//var register_count = parseInt($("#BILL_REGISTER_COUNT").val());
				//$("#Bill_BILL_NO").val("OE/"+zeroPad((register_count+1), 2)+"/"+FIANANCIAL_YEAR+" dt "+TODAY_DATE);
				
				$("#BILL_NO_SECTION").show();
				$("#BILL_TITLE_SECTION").show();
				$("#BILL_AMOUNT_SECTION").show();
				$("#FILE_NO_SECTION").show();
				$("#OE_IT_DED_SECTION").show();
				$("#OE_NET_AMOUNT_SECTION").show();
				$("#VENDOR_ID_SECTION").show();
				$("#OE_BILLS_SECTION").show();
				$("#PFMS_BILL_NO_SECTION").show();
				$("#CER_NO_SECTION").show();
				$("#MONTH_SECTION").show();
				$("#YEAR_SECTION").show();
				$("#CREATION_DATE_SECTION").show();
				$('#txtBillTitle').val("Payment of "+$("#Bill_BILL_SUB_TYPE option:selected").text()+" in R/O of "+DEPT_NAME);
			}
			else if(bill_sub_type == OE_Telephones){
				//var register_count = parseInt($("#BILL_REGISTER_COUNT").val());
				//$("#Bill_BILL_NO").val("OE/"+zeroPad((register_count+1), 2)+"/"+FIANANCIAL_YEAR+" dt "+TODAY_DATE);
				
				$("#BILL_NO_SECTION").show();
				$("#BILL_TITLE_SECTION").show();
				$("#BILL_AMOUNT_SECTION").show();
				$("#FILE_NO_SECTION").show();
				$("#OE_IT_DED_SECTION").show();
				$("#OE_NET_AMOUNT_SECTION").show();
				$("#VENDOR_ID_SECTION").show();
				$("#OE_BILLS_SECTION").show();
				$("#PFMS_BILL_NO_SECTION").show();
				$("#CER_NO_SECTION").show();
				$("#MONTH_SECTION").show();
				$("#YEAR_SECTION").show();
				$("#CREATION_DATE_SECTION").show();
				$('#txtBillTitle').val("Payment of "+$("#Bill_BILL_SUB_TYPE option:selected").text()+" charges for the month of "+PREVIOUS_MONTH_YEAR+" in R/O of "+DEPT_NAME);
			}
			else if(bill_sub_type == OE_Electricity_Charges){
				//var register_count = parseInt($("#BILL_REGISTER_COUNT").val());
				//$("#Bill_BILL_NO").val("OE/"+zeroPad((register_count+1), 2)+"/"+FIANANCIAL_YEAR+" dt "+TODAY_DATE);
				
				$("#BILL_NO_SECTION").show();
				$("#BILL_TITLE_SECTION").show();
				$("#BILL_AMOUNT_SECTION").show();
				$("#FILE_NO_SECTION").show();
				$("#OE_IT_DED_SECTION").show();
				$("#OE_NET_AMOUNT_SECTION").show();
				$("#VENDOR_ID_SECTION").show();
				$("#OE_BILLS_SECTION").show();
				$("#PFMS_BILL_NO_SECTION").show();
				$("#CER_NO_SECTION").show();
				$("#MONTH_SECTION").show();
				$("#YEAR_SECTION").show();
				$("#CREATION_DATE_SECTION").show();
				$('#txtBillTitle').val("Payment of "+$("#Bill_BILL_SUB_TYPE option:selected").text()+" for the month of "+PREVIOUS_MONTH_YEAR+" in R/O of "+DEPT_NAME);
			}
			else if(bill_sub_type == OE_Misc_Office_Expenses){
				//var register_count = parseInt($("#BILL_REGISTER_COUNT").val());
				//$("#Bill_BILL_NO").val("OE/"+zeroPad((register_count+1), 2)+"/"+FIANANCIAL_YEAR+" dt "+TODAY_DATE);
				
				$("#BILL_NO_SECTION").show();
				$("#BILL_TITLE_SECTION").show();
				$("#BILL_AMOUNT_SECTION").show();
				$("#FILE_NO_SECTION").show();
				$("#OE_IT_DED_SECTION").show();
				$("#OE_NET_AMOUNT_SECTION").show();
				$("#VENDOR_ID_SECTION").show();
				$("#OE_BILLS_SECTION").show();
				$("#PFMS_BILL_NO_SECTION").show();
				$("#CER_NO_SECTION").show();
				$("#MONTH_SECTION").show();
				$("#YEAR_SECTION").show();
				$("#CREATION_DATE_SECTION").show();
				$('#txtBillTitle').val("Payment of "+$("#Bill_BILL_SUB_TYPE option:selected").text()+" in R/O of "+DEPT_NAME);
			}
		}
		else if(bill_type == DTE_BILL){
			if(bill_sub_type == DTE_TOUR_TA_ADVANCE_BILL || bill_sub_type == DTE_TRANSFER_TA_ADVANCE_BILL){
				//var register_count = parseInt($("#BILL_REGISTER_COUNT").val());
				//$("#Bill_BILL_NO").val("DTE/"+zeroPad((register_count+1), 2)+"/"+FIANANCIAL_YEAR+" dt "+TODAY_DATE);
				//$("#BILL_ENTRY_COUNT").val(1);
				$("#dte-emp").show();
				$("#BILL_NO_SECTION").show();
				$("#BILL_TITLE_SECTION").show();
				$("#MONTH_SECTION").show();
				$("#YEAR_SECTION").show();
				$("#CREATION_DATE_SECTION").show();
				$("#BILL_AMOUNT_SECTION").show();
				$("#FILE_NO_SECTION").show();
				$("#PFMS_BILL_NO_SECTION").show();
				$("#CER_NO_SECTION").show();
				
				$('#txtBillTitle').val("Bill of "+$("#Bill_BILL_SUB_TYPE option:selected").text()+" in R/O staff of "+DEPT_NAME);
			}
			if(bill_sub_type == DTE_TOUR_TA_CLAIM_BILL || bill_sub_type == DTE_TRANSFER_TA_CLAIM_BILL){
				//var register_count = parseInt($("#BILL_REGISTER_COUNT").val());
				//$("#Bill_BILL_NO").val("DTE/"+zeroPad((register_count+1), 2)+"/"+FIANANCIAL_YEAR+" dt "+TODAY_DATE);
				//$("#BILL_ENTRY_COUNT").val(1);
				$("#dte-emp").show();
				$("#BILL_NO_SECTION").show();
				$("#BILL_TITLE_SECTION").show();
				$("#MONTH_SECTION").show();
				$("#YEAR_SECTION").show();
				$("#CREATION_DATE_SECTION").show();
				$("#BILL_AMOUNT_SECTION").show();
				$("#FILE_NO_SECTION").show();
				$("#PFMS_BILL_NO_SECTION").show();
				$("#CLAIM_GROSS_SECTION").show();
				$("#CLAIM_ADVANCE_SECTION").show();
				$("#CER_NO_SECTION").show();
				
				$('#txtBillTitle').val("Bill of "+$("#Bill_BILL_SUB_TYPE option:selected").text()+" in R/O staff of "+DEPT_NAME);
			}
		}
		else if(bill_type == MEDICAL_BILL){
			if(bill_sub_type == MEDICAL_CLAIM || bill_sub_type == MEDICAL_ADVANCE){
				//var register_count = parseInt($("#BILL_REGISTER_COUNT").val());
				//$("#Bill_BILL_NO").val("MED/"+zeroPad((register_count+1), 2)+"/"+FIANANCIAL_YEAR+" dt "+TODAY_DATE);
				//$("#BILL_ENTRY_COUNT").val(1);
				
				$("#medical-emp").show();
				$("#BILL_NO_SECTION").show();
				$("#BILL_TITLE_SECTION").show();
				$("#MONTH_SECTION").show();
				$("#YEAR_SECTION").show();
				$("#CREATION_DATE_SECTION").show();
				$("#BILL_AMOUNT_SECTION").show();
				$("#FILE_NO_SECTION").show();
				$("#PFMS_BILL_NO_SECTION").show();
				$("#CER_NO_SECTION").show();
				$('#txtBillTitle').val("Bill of "+$("#Bill_BILL_SUB_TYPE option:selected").text()+" in R/O staff of "+DEPT_NAME);
			}
		}
	});
	
	$('#ops-emp ul input[type=checkbox]').change(function(){
		if($(this).is(":checked")) {
			var empID = $(this).val(),
				empName = $(this).next('span').html();
			$('#txtBillTitle').val($("#Bill_BILL_SUB_TYPE option:selected").text()+" in R/O "+empName+" of "+DEPT_NAME);
		}
		else{
			$('#txtBillTitle').val($("#Bill_BILL_SUB_TYPE option:selected").text()+" in R/O OPS staff of "+DEPT_NAME);
		}
	});
	$('#nps-emp ul input[type=checkbox]').change(function(){
		if($(this).is(":checked")) {
			var empID = $(this).val(),
				empName = $(this).next('span').html();
			$('#txtBillTitle').val($("#Bill_BILL_SUB_TYPE option:selected").text()+" in R/O "+empName+" of "+DEPT_NAME);
		}
		else{
			$('#txtBillTitle').val($("#Bill_BILL_SUB_TYPE option:selected").text()+" in R/O NPS staff of "+DEPT_NAME);
		}
	});
	$('#bonus-ops-emp ul input[type=checkbox]').change(function(){
		if($(this).is(":checked")) {
			var empID = $(this).val(),
				empName = $(this).next('span').html();
			$('#txtBillTitle').val($("#Bill_BILL_SUB_TYPE option:selected").text()+" in R/O "+empName+" of "+DEPT_NAME);
		}
		else{
			$('#txtBillTitle').val($("#Bill_BILL_SUB_TYPE option:selected").text()+" in R/O OPS staff of "+DEPT_NAME);
		}
	});
	$('#bonus-nps-emp ul input[type=checkbox]').change(function(){
		if($(this).is(":checked")) {
			var empID = $(this).val(),
				empName = $(this).next('span').html();
			$('#txtBillTitle').val($("#Bill_BILL_SUB_TYPE option:selected").text()+" in R/O "+empName+" of "+DEPT_NAME);
		}
		else{
			$('#txtBillTitle').val($("#Bill_BILL_SUB_TYPE option:selected").text()+" in R/O NPS staff of "+DEPT_NAME);
		}
	});
	$('#ua-emp ul input[type=checkbox]').change(function(){
		if($(this).is(":checked")) {
			var empID = $(this).val(),
				empName = $(this).next('span').html();
			$('#txtBillTitle').val("Bill of "+$("#Bill_BILL_SUB_TYPE option:selected").text()+" in R/O "+empName+" of "+DEPT_NAME);
		}
		else{
			$('#txtBillTitle').val("Bill of "+$("#Bill_BILL_SUB_TYPE option:selected").text()+" in R/O staff of "+DEPT_NAME);
		}
	});
	$('#medical-emp ul input[type=checkbox]').change(function(){
		if($(this).is(":checked")) {
			var empID = $(this).val(),
				empName = $(this).next('span').html();
			$('#txtBillTitle').val("Bill of "+$("#Bill_BILL_SUB_TYPE option:selected").text()+" in R/O "+empName+" of "+DEPT_NAME);
		}
		else{
			$('#txtBillTitle').val("Bill of "+$("#Bill_BILL_SUB_TYPE option:selected").text()+" in R/O staff of "+DEPT_NAME);
		}
	});
	$('#dte-emp ul input[type=checkbox]').change(function(){
		if($(this).is(":checked")) {
			var empID = $(this).val(),
				empName = $(this).next('span').html();
			$('#txtBillTitle').val("Bill of "+$("#Bill_BILL_SUB_TYPE option:selected").text()+" in R/O "+empName+" of "+DEPT_NAME);
		}
		else{
			$('#txtBillTitle').val("Bill of "+$("#Bill_BILL_SUB_TYPE option:selected").text()+" in R/O staff of "+DEPT_NAME);
		}
	});
	$('#wages-emp ul input[type=checkbox]').change(function(){
		if($(this).is(":checked")) {
			var empID = $(this).val(),
				empName = $(this).next('span').html();
			$('#txtBillTitle').val("Wages in respect of "+empName+" of  "+DEPT_NAME+" for the month of ");
		}
		else{
			$('#txtBillTitle').val("Wages in respect of staff of "+DEPT_NAME+" for the month of ");
		}
	});
});

function loadFormOnUpdate(){
	if(CONTROLLER_ACTION == 'update'){
		$("#employee-selection-lists input").attr('disabled', 'disabled');
		if(CURRENT_BILL_TYPE == SALARY_OPS_BILL){
			if(CURRENT_BILL_SUB_TYPE == OPS_PAY_BILL){
				$("#BILL_NO_SECTION").show();
				$("#PT_BILL_NO_SECTION").show();
				$("#BILL_TITLE_SECTION").show();
				$("#MONTH_SECTION").show();
				$("#YEAR_SECTION").show();
				$("#CREATION_DATE_SECTION").show();
			}
			if(CURRENT_BILL_SUB_TYPE == OPS_ARREAR_BILL){
				$("#ops-emp").show();
				$("#BILL_NO_SECTION").show();
				$("#PT_BILL_NO_SECTION").show();
				$("#BILL_TITLE_SECTION").show();
				$("#MONTH_SECTION").show();
				$("#YEAR_SECTION").show();
				$("#CREATION_DATE_SECTION").show();
				$("#FILE_NO_SECTION").show();
				$("#PFMS_BILL_NO_SECTION").show();
				$("#IS_ARREAR_BILL").val(1);
			}
			if(CURRENT_BILL_SUB_TYPE == OPS_AD_BONUS_BILL){
				$("#bonus-ops-emp").show();
				$("#BILL_NO_SECTION").show();
				$("#BILL_TITLE_SECTION").show();
				$("#MONTH_SECTION").show();
				$("#YEAR_SECTION").show();
				$("#CREATION_DATE_SECTION").show();
				$("#FILE_NO_SECTION").show();
				$("#PFMS_BILL_NO_SECTION").show();
				$("#IS_BONUS_BILL").val(1);
			}
			if(CURRENT_BILL_SUB_TYPE == OPS_UA_BILL){
				$("#ua-emp").show();
				$("#UA_PERIOD").show();
				$("#BILL_NO_SECTION").show();
				$("#BILL_TITLE_SECTION").show();
				$("#MONTH_SECTION").show();
				$("#YEAR_SECTION").show();
				$("#CREATION_DATE_SECTION").show();
				$("#FILE_NO_SECTION").show();
				$("#PFMS_BILL_NO_SECTION").show();
				$("#IS_UA_BILL").val(1);
			}
			if(CURRENT_BILL_SUB_TYPE == OPS_CEA_BILL){
				$("#ops-emp").show();
				$("#BILL_NO_SECTION").show();
				$("#BILL_TITLE_SECTION").show();
				$("#MONTH_SECTION").show();
				$("#YEAR_SECTION").show();
				$("#CREATION_DATE_SECTION").show();
				$("#CEA_BILLS_SECTION").show();
				$("#FILE_NO_SECTION").show();
				$("#PFMS_BILL_NO_SECTION").show();
				$("#IS_CEA_BILL").val(1);
			}
			if(CURRENT_BILL_SUB_TYPE == OPS_LTC_ADVANCE_BILL){
				$("#ops-emp").show();
				$("#BILL_NO_SECTION").show();
				$("#BILL_TITLE_SECTION").show();
				$("#MONTH_SECTION").show();
				$("#YEAR_SECTION").show();
				$("#CREATION_DATE_SECTION").show();
				$("#FILE_NO_SECTION").show();
				$("#PFMS_BILL_NO_SECTION").show();
				$("#IS_LTC_ADVANCE_BILL").val(1);
			}
			if(CURRENT_BILL_SUB_TYPE == OPS_LTC_CLAIM_BILL){
				$("#ops-emp").show();
				$("#BILL_NO_SECTION").show();
				$("#BILL_TITLE_SECTION").show();
				$("#MONTH_SECTION").show();
				$("#YEAR_SECTION").show();
				$("#CREATION_DATE_SECTION").show();
				$("#FILE_NO_SECTION").show();
				$("#PFMS_BILL_NO_SECTION").show();
				$("#IS_LTC_CLAIM_BILL").val(1);
			}
			if(CURRENT_BILL_SUB_TYPE == OPS_EL_ENCASHMENT_BILL){
				$("#ops-emp").show();
				$("#BILL_NO_SECTION").show();
				$("#BILL_TITLE_SECTION").show();
				$("#MONTH_SECTION").show();
				$("#YEAR_SECTION").show();
				$("#CREATION_DATE_SECTION").show();
				$("#FILE_NO_SECTION").show();
				$("#PFMS_BILL_NO_SECTION").show();
				$("#IS_EL_ENCASHMENT_BILL").val(1);
			}
			if(CURRENT_BILL_SUB_TYPE == OPS_RECOVERY_BILL){
				$("#ops-emp").show();
				$("#BILL_NO_SECTION").show();
				$("#BILL_TITLE_SECTION").show();
				$("#MONTH_SECTION").show();
				$("#YEAR_SECTION").show();
				$("#CREATION_DATE_SECTION").show();
				$("#FILE_NO_SECTION").show();
				$("#PFMS_BILL_NO_SECTION").show();
				$("#IS_RECOVERY_BILL").val(1);
			}
		}
		else if(CURRENT_BILL_TYPE == SALARY_NPS_BILL){
			if(CURRENT_BILL_SUB_TYPE == NPS_PAY_BILL){
				$("#BILL_NO_SECTION").show();
				$("#PT_BILL_NO_SECTION").show();
				$("#NILL_BILL_NO_SECTION").show();
				$("#BILL_TITLE_SECTION").show();
				$("#MONTH_SECTION").show();
				$("#YEAR_SECTION").show();
				$("#CREATION_DATE_SECTION").show();
			}
			if(CURRENT_BILL_SUB_TYPE == NPS_ARREAR_BILL){
				$("#nps-emp").show();
				$("#BILL_NO_SECTION").show();
				$("#PT_BILL_NO_SECTION").show();
				$("#NILL_BILL_NO_SECTION").show();
				$("#BILL_TITLE_SECTION").show();
				$("#MONTH_SECTION").show();
				$("#YEAR_SECTION").show();
				$("#CREATION_DATE_SECTION").show();
				$("#FILE_NO_SECTION").show();
				$("#PFMS_BILL_NO_SECTION").show();
				$("#IS_ARREAR_BILL").val(1);
			}
			if(CURRENT_BILL_SUB_TYPE == NPS_AD_BONUS_BILL){
				$("#bonus-nps-emp").show();
				$("#BILL_NO_SECTION").show();
				$("#BILL_TITLE_SECTION").show();
				$("#MONTH_SECTION").show();
				$("#YEAR_SECTION").show();
				$("#CREATION_DATE_SECTION").show();
				$("#FILE_NO_SECTION").show();
				$("#PFMS_BILL_NO_SECTION").show();
				$("#IS_BONUS_BILL").val(1);
			}
			if(CURRENT_BILL_SUB_TYPE == NPS_UA_BILL){
				$("#ua-emp").show();
				$("#UA_PERIOD").show();
				$("#BILL_NO_SECTION").show();
				$("#BILL_TITLE_SECTION").show();
				$("#MONTH_SECTION").show();
				$("#YEAR_SECTION").show();
				$("#CREATION_DATE_SECTION").show();
				$("#FILE_NO_SECTION").show();
				$("#PFMS_BILL_NO_SECTION").show();
				$("#IS_UA_BILL").val(1);
			}
			if(CURRENT_BILL_SUB_TYPE == NPS_CEA_BILL){
				$("#nps-emp").show();
				$("#BILL_NO_SECTION").show();
				$("#BILL_TITLE_SECTION").show();
				$("#MONTH_SECTION").show();
				$("#YEAR_SECTION").show();
				$("#CREATION_DATE_SECTION").show();
				$("#CEA_BILLS_SECTION").show();
				$("#FILE_NO_SECTION").show();
				$("#PFMS_BILL_NO_SECTION").show();
				$("#IS_CEA_BILL").val(1);
			}
			if(CURRENT_BILL_SUB_TYPE == NPS_LTC_ADVANCE_BILL){
				$("#nps-emp").show();
				$("#BILL_NO_SECTION").show();
				$("#BILL_TITLE_SECTION").show();
				$("#MONTH_SECTION").show();
				$("#YEAR_SECTION").show();
				$("#CREATION_DATE_SECTION").show();
				$("#FILE_NO_SECTION").show();
				$("#PFMS_BILL_NO_SECTION").show();
				$("#IS_LTC_ADVANCE_BILL").val(1);
			}
			if(CURRENT_BILL_SUB_TYPE == NPS_LTC_CLAIM_BILL){
				$("#nps-emp").show();
				$("#BILL_NO_SECTION").show();
				$("#BILL_TITLE_SECTION").show();
				$("#MONTH_SECTION").show();
				$("#YEAR_SECTION").show();
				$("#CREATION_DATE_SECTION").show();
				$("#FILE_NO_SECTION").show();
				$("#PFMS_BILL_NO_SECTION").show();
				$("#IS_LTC_CLAIM_BILL").val(1);
			}
			if(CURRENT_BILL_SUB_TYPE == NPS_EL_ENCASHMENT_BILL){
				$("#nps-emp").show();
				$("#BILL_NO_SECTION").show();
				$("#BILL_TITLE_SECTION").show();
				$("#MONTH_SECTION").show();
				$("#YEAR_SECTION").show();
				$("#CREATION_DATE_SECTION").show();
				$("#FILE_NO_SECTION").show();
				$("#PFMS_BILL_NO_SECTION").show();
				$("#IS_EL_ENCASHMENT_BILL").val(1);
			}
			if(CURRENT_BILL_SUB_TYPE == NPS_RECOVERY_BILL){
				//var register_count = parseInt($("#BILL_REGISTER_COUNT").val());
				//$("#Bill_BILL_NO").val("CEA/"+zeroPad((register_count+1), 2)+"/"+FIANANCIAL_YEAR+" dt "+TODAY_DATE);
				$("#nps-emp").show();
				$("#BILL_NO_SECTION").show();
				$("#BILL_TITLE_SECTION").show();
				$("#MONTH_SECTION").show();
				$("#YEAR_SECTION").show();
				$("#CREATION_DATE_SECTION").show();
				$("#FILE_NO_SECTION").show();
				$("#PFMS_BILL_NO_SECTION").show();
				$("#IS_RECOVERY_BILL").val(1);
				$('#txtBillTitle').val($("#Bill_BILL_SUB_TYPE option:selected").text()+" in R/O NPS Staff of "+DEPT_NAME);
			}
		}
		else if(CURRENT_BILL_TYPE == WAGES_BILL){
			if(CURRENT_BILL_SUB_TYPE == WAGES_PAY_BILL){
				$("#wages-emp").show();
				$("#BILL_NO_SECTION").show();
				$("#PT_BILL_NO_SECTION").show();
				$("#BILL_TITLE_SECTION").show();
				$("#MONTH_SECTION").show();
				$("#YEAR_SECTION").show();
				$("#CREATION_DATE_SECTION").show();
				$("#FILE_NO_SECTION").show();
				$("#PFMS_BILL_NO_SECTION").show();
				$("#CER_NO_SECTION").show();
			}
		}
		else if(CURRENT_BILL_TYPE == OE_BILL){
			if(CURRENT_BILL_SUB_TYPE == OE_Postage_and_Telegrams){
				$("#BILL_NO_SECTION").show();
				$("#BILL_TITLE_SECTION").show();
				$("#BILL_AMOUNT_SECTION").show();
				$("#FILE_NO_SECTION").show();
				$("#OE_IT_DED_SECTION").show();
				$("#OE_NET_AMOUNT_SECTION").show();
				$("#VENDOR_ID_SECTION").show();
				$("#OE_BILLS_SECTION").show();
				$("#PFMS_BILL_NO_SECTION").show();
				$("#CER_NO_SECTION").show();
				$("#MONTH_SECTION").show();
				$("#YEAR_SECTION").show();
				$("#CREATION_DATE_SECTION").show();
			}
			else if(CURRENT_BILL_SUB_TYPE == OE_Furniture){
				$("#BILL_NO_SECTION").show();
				$("#BILL_TITLE_SECTION").show();
				$("#BILL_AMOUNT_SECTION").show();
				$("#FILE_NO_SECTION").show();
				$("#OE_IT_DED_SECTION").show();
				$("#OE_NET_AMOUNT_SECTION").show();
				$("#VENDOR_ID_SECTION").show();
				$("#OE_BILLS_SECTION").show();
				$("#PFMS_BILL_NO_SECTION").show();
				$("#CER_NO_SECTION").show();
				$("#MONTH_SECTION").show();
				$("#YEAR_SECTION").show();
				$("#CREATION_DATE_SECTION").show();
			}
			else if(CURRENT_BILL_SUB_TYPE == OE_Contingents_pay_House_keeping){
				$("#BILL_NO_SECTION").show();
				$("#BILL_TITLE_SECTION").show();
				$("#BILL_AMOUNT_SECTION").show();
				$("#FILE_NO_SECTION").show();
				$("#OE_IT_DED_SECTION").show();
				$("#OE_NET_AMOUNT_SECTION").show();
				$("#VENDOR_ID_SECTION").show();
				$("#OE_BILLS_SECTION").show();
				$("#PFMS_BILL_NO_SECTION").show();
				$("#CER_NO_SECTION").show();
				$("#MONTH_SECTION").show();
				$("#YEAR_SECTION").show();
				$("#CREATION_DATE_SECTION").show();
			}
			else if(CURRENT_BILL_SUB_TYPE == OE_Other_Office_Machineries){
				$("#BILL_NO_SECTION").show();
				$("#BILL_TITLE_SECTION").show();
				$("#BILL_AMOUNT_SECTION").show();
				$("#FILE_NO_SECTION").show();
				$("#OE_IT_DED_SECTION").show();
				$("#OE_NET_AMOUNT_SECTION").show();
				$("#VENDOR_ID_SECTION").show();
				$("#OE_BILLS_SECTION").show();
				$("#PFMS_BILL_NO_SECTION").show();
				$("#CER_NO_SECTION").show();
				$("#MONTH_SECTION").show();
				$("#YEAR_SECTION").show();
				$("#CREATION_DATE_SECTION").show();
			}
			else if(CURRENT_BILL_SUB_TYPE == OE_Office_Equipments){
				$("#BILL_NO_SECTION").show();
				$("#BILL_TITLE_SECTION").show();
				$("#BILL_AMOUNT_SECTION").show();
				$("#FILE_NO_SECTION").show();
				$("#OE_IT_DED_SECTION").show();
				$("#OE_NET_AMOUNT_SECTION").show();
				$("#VENDOR_ID_SECTION").show();
				$("#OE_BILLS_SECTION").show();
				$("#PFMS_BILL_NO_SECTION").show();
				$("#CER_NO_SECTION").show();
				$("#MONTH_SECTION").show();
				$("#YEAR_SECTION").show();
				$("#CREATION_DATE_SECTION").show();
			}
			else if(CURRENT_BILL_SUB_TYPE == OE_Water_Charges){
				$("#BILL_NO_SECTION").show();
				$("#BILL_TITLE_SECTION").show();
				$("#BILL_AMOUNT_SECTION").show();
				$("#FILE_NO_SECTION").show();
				$("#OE_IT_DED_SECTION").show();
				$("#OE_NET_AMOUNT_SECTION").show();
				$("#VENDOR_ID_SECTION").show();
				$("#OE_BILLS_SECTION").show();
				$("#PFMS_BILL_NO_SECTION").show();
				$("#CER_NO_SECTION").show();
				$("#MONTH_SECTION").show();
				$("#YEAR_SECTION").show();
				$("#CREATION_DATE_SECTION").show();
			}
			else if(CURRENT_BILL_SUB_TYPE == OE_Stationery_Local_Purchase){
				$("#BILL_NO_SECTION").show();
				$("#BILL_TITLE_SECTION").show();
				$("#BILL_AMOUNT_SECTION").show();
				$("#FILE_NO_SECTION").show();
				$("#OE_IT_DED_SECTION").show();
				$("#OE_NET_AMOUNT_SECTION").show();
				$("#VENDOR_ID_SECTION").show();
				$("#OE_BILLS_SECTION").show();
				$("#PFMS_BILL_NO_SECTION").show();
				$("#CER_NO_SECTION").show();
				$("#MONTH_SECTION").show();
				$("#YEAR_SECTION").show();
				$("#CREATION_DATE_SECTION").show();
			}
			else if(CURRENT_BILL_SUB_TYPE == OE_Purchase_of_Books_and_Publication){
				$("#BILL_NO_SECTION").show();
				$("#BILL_TITLE_SECTION").show();
				$("#BILL_AMOUNT_SECTION").show();
				$("#FILE_NO_SECTION").show();
				$("#OE_IT_DED_SECTION").show();
				$("#OE_NET_AMOUNT_SECTION").show();
				$("#VENDOR_ID_SECTION").show();
				$("#OE_BILLS_SECTION").show();
				$("#PFMS_BILL_NO_SECTION").show();
				$("#CER_NO_SECTION").show();
				$("#MONTH_SECTION").show();
				$("#YEAR_SECTION").show();
				$("#CREATION_DATE_SECTION").show();
			}
			else if(CURRENT_BILL_SUB_TYPE == OE_Perishable){
				$("#BILL_NO_SECTION").show();
				$("#BILL_TITLE_SECTION").show();
				$("#BILL_AMOUNT_SECTION").show();
				$("#FILE_NO_SECTION").show();
				$("#OE_IT_DED_SECTION").show();
				$("#OE_NET_AMOUNT_SECTION").show();
				$("#VENDOR_ID_SECTION").show();
				$("#OE_BILLS_SECTION").show();
				$("#PFMS_BILL_NO_SECTION").show();
				$("#CER_NO_SECTION").show();
				$("#MONTH_SECTION").show();
				$("#YEAR_SECTION").show();
				$("#CREATION_DATE_SECTION").show();
			}
			else if(CURRENT_BILL_SUB_TYPE == OE_Imprest){
				$("#BILL_NO_SECTION").show();
				$("#BILL_TITLE_SECTION").show();
				$("#BILL_AMOUNT_SECTION").show();
				$("#FILE_NO_SECTION").show();
				$("#OE_IT_DED_SECTION").show();
				$("#OE_NET_AMOUNT_SECTION").show();
				$("#VENDOR_ID_SECTION").show();
				$("#OE_BILLS_SECTION").show();
				$("#PFMS_BILL_NO_SECTION").show();
				$("#CER_NO_SECTION").show();
				$("#MONTH_SECTION").show();
				$("#YEAR_SECTION").show();
				$("#CREATION_DATE_SECTION").show();
			}
			else if(CURRENT_BILL_SUB_TYPE == OE_Diesel){
				$("#BILL_NO_SECTION").show();
				$("#BILL_TITLE_SECTION").show();
				$("#BILL_AMOUNT_SECTION").show();
				$("#FILE_NO_SECTION").show();
				$("#OE_IT_DED_SECTION").show();
				$("#OE_NET_AMOUNT_SECTION").show();
				$("#VENDOR_ID_SECTION").show();
				$("#OE_BILLS_SECTION").show();
				$("#PFMS_BILL_NO_SECTION").show();
				$("#CER_NO_SECTION").show();
				$("#MONTH_SECTION").show();
				$("#YEAR_SECTION").show();
				$("#CREATION_DATE_SECTION").show();
			}
			else if(CURRENT_BILL_SUB_TYPE == OE_Telephones){
				$("#BILL_NO_SECTION").show();
				$("#BILL_TITLE_SECTION").show();
				$("#BILL_AMOUNT_SECTION").show();
				$("#FILE_NO_SECTION").show();
				$("#OE_IT_DED_SECTION").show();
				$("#OE_NET_AMOUNT_SECTION").show();
				$("#VENDOR_ID_SECTION").show();
				$("#OE_BILLS_SECTION").show();
				$("#PFMS_BILL_NO_SECTION").show();
				$("#CER_NO_SECTION").show();
				$("#MONTH_SECTION").show();
				$("#YEAR_SECTION").show();
				$("#CREATION_DATE_SECTION").show();
			}
			else if(CURRENT_BILL_SUB_TYPE == OE_Electricity_Charges){
				$("#BILL_NO_SECTION").show();
				$("#BILL_TITLE_SECTION").show();
				$("#BILL_AMOUNT_SECTION").show();
				$("#FILE_NO_SECTION").show();
				$("#OE_IT_DED_SECTION").show();
				$("#OE_NET_AMOUNT_SECTION").show();
				$("#VENDOR_ID_SECTION").show();
				$("#OE_BILLS_SECTION").show();
				$("#PFMS_BILL_NO_SECTION").show();
				$("#CER_NO_SECTION").show();
				$("#MONTH_SECTION").show();
				$("#YEAR_SECTION").show();
				$("#CREATION_DATE_SECTION").show();
			}
			else if(CURRENT_BILL_SUB_TYPE == OE_Misc_Office_Expenses){
				$("#BILL_NO_SECTION").show();
				$("#BILL_TITLE_SECTION").show();
				$("#BILL_AMOUNT_SECTION").show();
				$("#FILE_NO_SECTION").show();
				$("#OE_IT_DED_SECTION").show();
				$("#OE_NET_AMOUNT_SECTION").show();
				$("#VENDOR_ID_SECTION").show();
				$("#OE_BILLS_SECTION").show();
				$("#PFMS_BILL_NO_SECTION").show();
				$("#CER_NO_SECTION").show();
				$("#MONTH_SECTION").show();
				$("#YEAR_SECTION").show();
				$("#CREATION_DATE_SECTION").show();
			}
		}
		else if(CURRENT_BILL_TYPE == DTE_BILL){
			if(CURRENT_BILL_SUB_TYPE == DTE_TOUR_TA_ADVANCE_BILL || CURRENT_BILL_SUB_TYPE == DTE_TRANSFER_TA_ADVANCE_BILL){
				$("#dte-emp").show();
				$("#BILL_NO_SECTION").show();
				$("#BILL_TITLE_SECTION").show();
				$("#MONTH_SECTION").show();
				$("#YEAR_SECTION").show();
				$("#CREATION_DATE_SECTION").show();
				$("#BILL_AMOUNT_SECTION").show();
				$("#FILE_NO_SECTION").show();
				$("#PFMS_BILL_NO_SECTION").show();
				$("#CER_NO_SECTION").show();
			}
			if(CURRENT_BILL_SUB_TYPE == DTE_TOUR_TA_CLAIM_BILL || CURRENT_BILL_SUB_TYPE == DTE_TRANSFER_TA_CLAIM_BILL){
				$("#dte-emp").show();
				$("#BILL_NO_SECTION").show();
				$("#BILL_TITLE_SECTION").show();
				$("#MONTH_SECTION").show();
				$("#YEAR_SECTION").show();
				$("#CREATION_DATE_SECTION").show();
				$("#BILL_AMOUNT_SECTION").show();
				$("#FILE_NO_SECTION").show();
				$("#PFMS_BILL_NO_SECTION").show();
				$("#CER_NO_SECTION").show();
				$("#CLAIM_GROSS_SECTION").show();
				$("#CLAIM_ADVANCE_SECTION").show();
			}
		}
		else if(CURRENT_BILL_TYPE == MEDICAL_BILL){
			if(CURRENT_BILL_SUB_TYPE == MEDICAL_CLAIM || CURRENT_BILL_SUB_TYPE == MEDICAL_ADVANCE){
				$("#medical-emp").show();
				$("#BILL_NO_SECTION").show();
				$("#BILL_TITLE_SECTION").show();
				$("#MONTH_SECTION").show();
				$("#YEAR_SECTION").show();
				$("#CREATION_DATE_SECTION").show();
				$("#BILL_AMOUNT_SECTION").show();
				$("#FILE_NO_SECTION").show();
				$("#PFMS_BILL_NO_SECTION").show();
				$("#CER_NO_SECTION").show();
			}
		}
	}
}
function resetBiilSelection(){
	$("#nps-emp").hide();
	$("#ops-emp").hide();
	$("#bonus-nps-emp").hide();
	$("#bonus-ops-emp").hide();
	$("#ua-emp").hide();
	$("#dte-emp").hide();
	$("#wages-emp").hide();
	$('#medical-emp').hide();
	$("#ceabills").hide();
	$("#oebills").hide();
	
	$("#IS_ARREAR_BILL").val(0);
	$("#IS_BONUS_BILL").val(0);
	$("#IS_UA_BILL").val(0);
	$("#IS_CEA_BILL").val(0);
	$("#IS_EL_ENCASHMENT_BILL").val(0);
	$("#IS_LTC_ADVANCE_BILL").val(0);
	$("#IS_LTC_CLAIM_BILL").val(0);
	$("#IS_RECOVERY_BILL").val(0);
	
	$("#BILL_NO_SECTION").hide();
	$("#NILL_BILL_NO_SECTION").hide();
	$("#PT_BILL_NO_SECTION").hide();
	$("#BILL_TITLE_SECTION").hide();
	$("#BILL_AMOUNT_SECTION").hide();
	$("#FILE_NO_SECTION").hide();
	$("#OE_IT_DED_SECTION").hide();
	$("#OE_NET_AMOUNT_SECTION").hide();
	$("#VENDOR_ID_SECTION").hide();
	$("#OE_BILLS_SECTION").hide();
	$("#CEA_BILLS_SECTION").hide();
	$("#MONTH_SECTION").hide();
	$("#YEAR_SECTION").hide();
	$("#CREATION_DATE_SECTION").hide();
	$("#EXPENDITURE_INC_BILL_SECTION").hide();
	$("#PFMS_BILL_NO_SECTION").hide();
	$("#CER_NO_SECTION").hide();
	$("#PFMS_STATUS_SECTION").hide();
	$("#APPROPIATION_BALANCE_SECTION").hide();
	$("#UA_PERIOD").hide();
	$("#CLAIM_GROSS_SECTION").hide();
	$("#CLAIM_ADVANCE_SECTION").hide();
	
}
function search(searchBox, list){
	var input, filter, ul, li, a, i;
	input = searchBox;
	filter = input.value.toUpperCase();
	ul = $("#"+list+" ul");
	li = ul.find('li');

	// Loop through all list items, and hide those who don't match the search query
	for (i = 0; i < li.length; i++) {
		span = li[i].getElementsByTagName("span")[0];
		if (span.innerHTML.toUpperCase().indexOf(filter) > -1) {
			li[i].style.display = "";
		} else {
			li[i].style.display = "none";
		}
	}
}
function selectList(list){
	var ul, li, i;
	ul = $("#"+list+" ul");
	li = ul.find('li');

	// Loop through all list items, and hide those who don't match the search query
	for (i = 0; i < li.length; i++) {
		checkbox = li[i].getElementsByTagName("input")[0];
		if (checkbox.checked) {
			checkbox.checked = false;
		} else {
			checkbox.checked = true;
		}
	}
}

function validateBillForm(){
	var bill_type = parseInt($("#slBillType").val());
	
	if(bill_type == 0){
		alert('Please select Bill Type');
		return false;
	}
	
	if(bill_type == OE_BILL){
		if($("#Bill_BILL_SUB_TYPE").val() == ""){
			alert('Please select Bill Sub Type');
			return false;
		}
		if($("#Bill_BILL_NO").val() == ""){
			alert('Please enter Bill Number');
			return false;
		}
		if($("#txtBillTitle").val() == ""){
			alert('Please enter Bill Title');
			return false;
		}
		if($("#Bill_BILL_AMOUNT").val() == "" || $("#Bill_BILL_AMOUNT").val() == 0){
			alert('Please enter Bill Amount');
			return false;
		}
		if($("#Bill_FILE_NO").val() == ""){
			alert('Please enter File Number');
			return false;
		}
		if($("#Bill_OE_IT_DED").val() == ""){
			alert('Please enter Income Tax Deduction');
			return false;
		}
		if($("#Bill_OE_NET_AMOUNT").val() == "" || $("#Bill_OE_NET_AMOUNT").val() == 0){
			alert('Please enter Bill Amount & IT Deduction to calculate Net Bill Amount');
			return false;
		}
		if($("#Bill_VENDOR_ID").val() == "" || $("#Bill_VENDOR_ID").val() == 0){
			alert('Please select Vendor');
			return false;
		}
		
		var sub_bills = $("#SubBillTable").find("input.bills_number"), total_bills = sub_bills.length, entered_bills = 0;
		sub_bills.each(function(){
			if($(this).val() != "" || $(this).val() != 0){
				entered_bills ++;
			}
		});
		
		if(entered_bills != total_bills){
			alert('Please fill all bill details');
			return false;
		}
		
		if($("#Bill_CER_NO").val() == ""){
			alert('Please enter Central Event Register number of bill');
			return false;
		}
	}
	
	return true;
}
function zeroPad(num, places){
  var zero = places - num.toString().length + 1;
  return Array(+(zero > 0 && zero)).join("0") + num;
}
function deleteCEARow(row){
	var i=row.parentNode.parentNode.rowIndex;
	document.getElementById('CEASubBillTable').deleteRow(i);
}
function insCEARow(){
	var x=document.getElementById('CEASubBillTable');
	var new_row = x.rows[1].cloneNode(true);
	var len = x.rows.length;
	
	var inp1 = new_row.cells[0].getElementsByTagName('input')[0];
	inp1.name = "Bill[CEA_BILLS]["+len+"][NAME]";
	inp1.value = '';
	//var inp2 = new_row.cells[1].getElementsByTagName('input')[0];
	//inp2.name = "Bill[CEA_BILLS]["+len+"][DOB]";
	//inp2.value = '';
	var inp3 = new_row.cells[1].getElementsByTagName('input')[0];
	inp3.name = "Bill[CEA_BILLS]["+len+"][CLASS]";
	inp3.value = '';
	var inp4 = new_row.cells[2].getElementsByTagName('input')[0];
	inp4.name = "Bill[CEA_BILLS]["+len+"][SCHOOL]";
	inp4.value = '';
	var inp5 = new_row.cells[3].getElementsByTagName('input')[0];
	inp5.name = "Bill[CEA_BILLS]["+len+"][AMOUNT]";
	inp5.classList.add("bills_amount");
	inp5.value = '';
	var inp6 = new_row.cells[4].getElementsByTagName('input')[0];
	inp6.name = "Bill[CEA_BILLS]["+len+"][REMARKS]";
	inp6.value = '2016-17';
	x.appendChild( new_row );
}
function deleteRow(row){
	var i=row.parentNode.parentNode.rowIndex;
	document.getElementById('SubBillTable').deleteRow(i);
}
function insRow(){
	var x=document.getElementById('SubBillTable');
	var new_row = x.rows[1].cloneNode(true);
	var len = x.rows.length;
	
	var inp1 = new_row.cells[0].getElementsByTagName('input')[0];
	inp1.name = "Bill[OE_BILL]["+len+"][BILL_NO]";
	inp1.classList.add("bills_number");
	inp1.value = '';
	var inp2 = new_row.cells[1].getElementsByTagName('input')[0];
	inp2.name = "Bill[OE_BILL]["+len+"][BILL_DATE]";
	inp2.value = '';
	var inp3 = new_row.cells[2].getElementsByTagName('input')[0];
	inp3.name = "Bill[OE_BILL]["+len+"][BILL_AMOUNT]";
	inp3.classList.add("bills_amount");
	inp3.value = '';
	x.appendChild( new_row );
}
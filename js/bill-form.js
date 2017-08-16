$(document).ready(function(){
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
	
	$('#Bill_OE_IT_DED').on('change', function() {
		$('#Bill_OE_NET_AMOUNT').val($('#Bill_BILL_AMOUNT').val() - $('#Bill_OE_IT_DED').val())
	});
	
	$('#chkIsArrearBill').change(function() {
		otherSalaryBillsReset();
		if($(this).is(":checked")) {
			var bill_type = parseInt($('#slBillType').val());
			if(bill_type == 1){
				$("#ops-emp").show();
			}
			if(bill_type == 2){
				$("#nps-emp").show();
			}
		}
	});

	$('#chkIsCEABill').change(function() {
		otherSalaryBillsReset();
		if($(this).is(":checked")) {
			var bill_type = parseInt($('#slBillType').val());
			if(bill_type == 1 || bill_type == 2){
				$("#cea-emp").show();
				$("#ceabills").show();
			}
		}
		else{
			$("#ceabills").hide();
		}
	});
	
	$('#chkIsBonusBill').change(function() {
		otherSalaryBillsReset();
		if($(this).is(":checked")) {
			var bill_type = parseInt($('#slBillType').val());
			if(bill_type == 1 || bill_type == 2){
				$("#bonus-emp").show();
				$('#txtBillTitle').val($("#Bill_BILL_SUB_TYPE option:selected").text()+" "+FIANANCIAL_YEAR+" in R/O Group B&C Employees of "+DEPT_NAME);
			}
		}
		else{
			$('#txtBillTitle').val("");
		}
	});
	
	$('#chkIsUABill').change(function() {
		otherSalaryBillsReset();
		if($(this).is(":checked")) {
			var bill_type = parseInt($('#slBillType').val());
			if(bill_type == 1 || bill_type == 2){
				$("#ua-emp").show();
				$('#txtBillTitle').val($("#Bill_BILL_SUB_TYPE option:selected").text()+" "+FIANANCIAL_YEAR+" in R/O Group B&C Employees of "+DEPT_NAME);
			}
		}
		else{
			$('#txtBillTitle').val("");
		}
	});
	
	$('#chkIsLTCHTCBill').change(function() {
		otherSalaryBillsReset();
		if($(this).is(":checked")) {
			var bill_type = parseInt($('#slBillType').val());
			if(bill_type == 1 || bill_type == 2){
				$("#ltc-htc-emp").show();
			}
		}
	});

	$('#slBillType').change(function(){
		otherSalaryBillsReset();
		$('#other-salary-bills').hide();
		var bill_type = parseInt($(this).val());
		if(bill_type == 1 || bill_type == 2){
			$('#other-salary-bills').show();
			$("#paybillinfo").show();
		}
		else if(bill_type == 6){
			$('#medical-emp').show();
			$("#paybillinfo").hide();
		}
		else if(bill_type == 4){
			$('#dte-emp').show();
			$("#paybillinfo").hide();
		}
		else if(bill_type == 8){
			$('#wages-emp').show();
			$("#paybillinfo").hide();
		}
		else{
			$("#paybillinfo").hide();
			$('#txtBillTitle').val('');
		}
	});
	
	$('#Bill_BILL_SUB_TYPE').change(function(){
		otherSalaryBillsReset();
		var bill_type = parseInt($("#slBillType").val());
		var bill_sub_type = parseInt($(this).val());
		$("#UA_PERIOD").hide();
		
		if(bill_type == 1){
			if(bill_sub_type == 21){
				$('#chkIsArrearBill').prop('checked', false);
				$('#chkIsCEABill').prop('checked', false);
				$('#chkIsBonusBill').prop('checked', false);
				$('#chkIsUABill').prop('checked', false);
				$('#chkIsLTCHTCBill').prop('checked', false);
				$('#txtBillTitle').val("PAY AND ALLOWANCE in R/O OPS Staff of "+DEPT_NAME+" (OLD PENSION SCHEME) for the month of "+MONTH_YEAR);
				//var register_count = parseInt($("#BILL_REGISTER_COUNT").val());
				//$("#Bill_BILL_NO").val("P/"+zeroPad((register_count+1), 2)+"/"+FIANANCIAL_YEAR+" dt "+TODAY_DATE);
				$("#Bill_NILL_BILL_NO").val("");
				//$("#Bill_LIC_DED_BILL_NO").val("P/"+zeroPad((register_count+2), 2)+"/"+FIANANCIAL_YEAR+" dt "+TODAY_DATE);
				//$("#Bill_PT_DED_BILL_NO").val("P/"+zeroPad((register_count+3), 2)+"/"+FIANANCIAL_YEAR+" dt "+TODAY_DATE);
				$("#BILL_ENTRY_COUNT").val(3);
				$("#paybillinfo").show();
			}
			if(bill_sub_type == 15 || bill_sub_type == 17 || bill_sub_type == 27){
				$('#chkIsArrearBill').prop('checked', true).change();
				$('#chkIsCEABill').prop('checked', false);
				$('#chkIsBonusBill').prop('checked', false);
				$('#chkIsUABill').prop('checked', false);
				$('#chkIsLTCHTCBill').prop('checked', false);
				$("#Bill_NILL_BILL_NO").val("");
				$("#Bill_LIC_DED_BILL_NO").val("");
				$("#Bill_PT_DED_BILL_NO").val("");
				$("#BILL_ENTRY_COUNT").val(1);
				$("#paybillinfo").hide();
				//var register_count = parseInt($("#BILL_REGISTER_COUNT").val());
				if(bill_sub_type == 15){
					//$("#Bill_BILL_NO").val("HRA Arr/"+zeroPad((register_count+1), 2)+"/"+FIANANCIAL_YEAR+" dt "+TODAY_DATE);
				}
				else if(bill_sub_type == 17){
					//$("#Bill_BILL_NO").val("DA Arr/"+zeroPad((register_count+1), 2)+"/"+FIANANCIAL_YEAR+" dt "+TODAY_DATE);
				}
				else if(bill_sub_type == 27){
					//$("#Bill_BILL_NO").val("Arrear/"+zeroPad((register_count+1), 2)+"/"+FIANANCIAL_YEAR+" dt "+TODAY_DATE);
				}
			}
			if(bill_sub_type == 19){
				$('#chkIsBonusBill').prop('checked', true).change();
				$('#chkIsArrearBill').prop('checked', false);
				$('#chkIsCEABill').prop('checked', false);
				$('#chkIsUABill').prop('checked', false);
				$('#chkIsLTCHTCBill').prop('checked', false);
				//var register_count = parseInt($("#BILL_REGISTER_COUNT").val());
				//$("#Bill_BILL_NO").val("Ad-Bonus/"+zeroPad((register_count+1), 2)+"/"+FIANANCIAL_YEAR+" dt "+TODAY_DATE);
				$("#Bill_NILL_BILL_NO").val("");
				$("#Bill_LIC_DED_BILL_NO").val("");
				$("#Bill_PT_DED_BILL_NO").val("");
				$("#BILL_ENTRY_COUNT").val(1);
				$("#paybillinfo").hide();
			}
			if(bill_sub_type == 23){
				$('#chkIsUABill').prop('checked', true).change();
				$('#chkIsArrearBill').prop('checked', false);
				$('#chkIsCEABill').prop('checked', false);
				$('#chkIsBonusBill').prop('checked', false);
				$('#chkIsLTCHTCBill').prop('checked', false);
				$("#UA_PERIOD").show();
				//var register_count = parseInt($("#BILL_REGISTER_COUNT").val());
				//$("#Bill_BILL_NO").val("UA/"+zeroPad((register_count+1), 2)+"/"+FIANANCIAL_YEAR+" dt "+TODAY_DATE);
				$("#Bill_NILL_BILL_NO").val("");
				$("#Bill_LIC_DED_BILL_NO").val("");
				$("#Bill_PT_DED_BILL_NO").val("");
				$("#BILL_ENTRY_COUNT").val(1);
				$("#paybillinfo").hide();
			}
			if(bill_sub_type == 25){
				$('#chkIsCEABill').prop('checked', true).change();
				$('#chkIsUABill').prop('checked', false);
				$('#chkIsArrearBill').prop('checked', false);
				$('#chkIsBonusBill').prop('checked', false);
				$('#chkIsLTCHTCBill').prop('checked', false);
				//var register_count = parseInt($("#BILL_REGISTER_COUNT").val());
				//$("#Bill_BILL_NO").val("CEA/"+zeroPad((register_count+1), 2)+"/"+FIANANCIAL_YEAR+" dt "+TODAY_DATE);
				$("#Bill_NILL_BILL_NO").val("");
				$("#Bill_LIC_DED_BILL_NO").val("");
				$("#Bill_PT_DED_BILL_NO").val("");
				$("#BILL_ENTRY_COUNT").val(1);
				$("#paybillinfo").hide();
			}
			if(bill_sub_type == 30){
				$('#chkIsLTCHTCBill').prop('checked', true).change();
				$('#chkIsUABill').prop('checked', false);
				$('#chkIsArrearBill').prop('checked', false);
				$('#chkIsBonusBill').prop('checked', false);
				$('#chkIsCEABill').prop('checked', false);
				//var register_count = parseInt($("#BILL_REGISTER_COUNT").val());
				//$("#Bill_BILL_NO").val("LTC/"+zeroPad((register_count+1), 2)+"/"+FIANANCIAL_YEAR+" dt "+TODAY_DATE);
				$("#Bill_NILL_BILL_NO").val("");
				$("#Bill_LIC_DED_BILL_NO").val("");
				$("#Bill_PT_DED_BILL_NO").val("");
				$("#BILL_ENTRY_COUNT").val(1);
				$("#paybillinfo").hide();
			}
		}
		else if(bill_type == 2){
			if(bill_sub_type == 22){
				$('#chkIsArrearBill').prop('checked', false);
				$('#chkIsCEABill').prop('checked', false);
				$('#chkIsBonusBill').prop('checked', false);
				$('#chkIsUABill').prop('checked', false);
				$('#chkIsLTCHTCBill').prop('checked', false);
				$('#txtBillTitle').val("PAY AND ALLOWANCE in R/O NPS Staff of "+DEPT_NAME+" (NEW PENSION SCHEME) for the month of "+MONTH_YEAR);
				//var register_count = parseInt($("#BILL_REGISTER_COUNT").val());
				//$("#Bill_BILL_NO").val("P/"+zeroPad((register_count+1), 2)+"/"+FIANANCIAL_YEAR+" dt "+TODAY_DATE);
				//$("#Bill_NILL_BILL_NO").val("P/"+zeroPad((register_count+2), 2)+"/"+FIANANCIAL_YEAR+" dt "+TODAY_DATE);
				//$("#Bill_LIC_DED_BILL_NO").val("P/"+zeroPad((register_count+3), 2)+"/"+FIANANCIAL_YEAR+" dt "+TODAY_DATE);
				//$("#Bill_PT_DED_BILL_NO").val("P/"+zeroPad((register_count+4), 2)+"/"+FIANANCIAL_YEAR+" dt "+TODAY_DATE);
				$("#BILL_ENTRY_COUNT").val(4);
				$("#paybillinfo").show();
				$("#npspaybillinfo").show();
			}
			if(bill_sub_type == 16 || bill_sub_type == 18 || bill_sub_type == 28){
				$('#chkIsArrearBill').prop('checked', true).change();
				$('#chkIsCEABill').prop('checked', false);
				$('#chkIsBonusBill').prop('checked', false);
				$('#chkIsUABill').prop('checked', false);
				$('#chkIsLTCHTCBill').prop('checked', false);
				//var register_count = parseInt($("#BILL_REGISTER_COUNT").val());
				$("#Bill_NILL_BILL_NO").val("");
				$("#Bill_LIC_DED_BILL_NO").val("");
				$("#Bill_PT_DED_BILL_NO").val("");
				$("#BILL_ENTRY_COUNT").val(1);
				$("#paybillinfo").hide();
				if(bill_sub_type == 16){
					//$("#Bill_BILL_NO").val("HRA Arr/"+zeroPad((register_count+1), 2)+"/"+FIANANCIAL_YEAR+" dt "+TODAY_DATE);
					$("#npspaybillinfo").hide();
				}
				else if(bill_sub_type == 18){
					//$("#Bill_BILL_NO").val("DA Arr/"+zeroPad((register_count+1), 2)+"/"+FIANANCIAL_YEAR+" dt "+TODAY_DATE);
					//$("#Bill_NILL_BILL_NO").val("DA Arr/"+zeroPad((register_count+2), 2)+"/"+FIANANCIAL_YEAR+" dt "+TODAY_DATE);
					$("#npspaybillinfo").show();
				}
				else if(bill_sub_type == 28){
					//$("#Bill_BILL_NO").val("Arrear/"+zeroPad((register_count+1), 2)+"/"+FIANANCIAL_YEAR+" dt "+TODAY_DATE);
					//$("#Bill_NILL_BILL_NO").val("Arrear/"+zeroPad((register_count+2), 2)+"/"+FIANANCIAL_YEAR+" dt "+TODAY_DATE);
					$("#npspaybillinfo").show();
				}
			}
			if(bill_sub_type == 20){
				$('#chkIsBonusBill').prop('checked', true).change();
				$('#chkIsArrearBill').prop('checked', false);
				$('#chkIsCEABill').prop('checked', false);
				$('#chkIsUABill').prop('checked', false);
				$('#chkIsLTCHTCBill').prop('checked', false);
				//var register_count = parseInt($("#BILL_REGISTER_COUNT").val());
				//$("#Bill_BILL_NO").val("Ad-Bonus/"+zeroPad((register_count+1), 2)+"/"+FIANANCIAL_YEAR+" dt "+TODAY_DATE);
				$("#Bill_NILL_BILL_NO").val("");
				$("#Bill_LIC_DED_BILL_NO").val("");
				$("#Bill_PT_DED_BILL_NO").val("");
				$("#BILL_ENTRY_COUNT").val(1);
				$("#paybillinfo").hide();
				$("#npspaybillinfo").hide();
			}
			if(bill_sub_type == 24){
				$('#chkIsUABill').prop('checked', true).change();
				$('#chkIsArrearBill').prop('checked', false);
				$('#chkIsCEABill').prop('checked', false);
				$('#chkIsBonusBill').prop('checked', false);
				$('#chkIsLTCHTCBill').prop('checked', false);
				$("#UA_PERIOD").show();
				//var register_count = parseInt($("#BILL_REGISTER_COUNT").val());
				//$("#Bill_BILL_NO").val("UA/"+zeroPad((register_count+1), 2)+"/"+FIANANCIAL_YEAR+" dt "+TODAY_DATE);
				$("#Bill_NILL_BILL_NO").val("");
				$("#Bill_LIC_DED_BILL_NO").val("");
				$("#Bill_PT_DED_BILL_NO").val("");
				$("#BILL_ENTRY_COUNT").val(1);
				$("#paybillinfo").hide();
				$("#npspaybillinfo").hide();
			}
			if(bill_sub_type == 26){
				$('#chkIsCEABill').prop('checked', true).change();
				$('#chkIsUABill').prop('checked', false);
				$('#chkIsArrearBill').prop('checked', false);
				$('#chkIsBonusBill').prop('checked', false);
				$('#chkIsLTCHTCBill').prop('checked', false);
				//var register_count = parseInt($("#BILL_REGISTER_COUNT").val());
				//$("#Bill_BILL_NO").val("CEA/"+zeroPad((register_count+1), 2)+"/"+FIANANCIAL_YEAR+" dt "+TODAY_DATE);
				$("#Bill_NILL_BILL_NO").val("");
				$("#Bill_LIC_DED_BILL_NO").val("");
				$("#Bill_PT_DED_BILL_NO").val("");
				$("#BILL_ENTRY_COUNT").val(1);
				$("#paybillinfo").hide();
				$("#npspaybillinfo").hide();
			}
			if(bill_sub_type == 31){
				$('#chkIsLTCHTCBill').prop('checked', true).change();
				$('#chkIsUABill').prop('checked', false);
				$('#chkIsArrearBill').prop('checked', false);
				$('#chkIsBonusBill').prop('checked', false);
				$('#chkIsCEABill').prop('checked', false);
				//var register_count = parseInt($("#BILL_REGISTER_COUNT").val());
				//$("#Bill_BILL_NO").val("LTC/"+zeroPad((register_count+1), 2)+"/"+FIANANCIAL_YEAR+" dt "+TODAY_DATE);
				$("#Bill_NILL_BILL_NO").val("");
				$("#Bill_LIC_DED_BILL_NO").val("");
				$("#Bill_PT_DED_BILL_NO").val("");
				$("#BILL_ENTRY_COUNT").val(1);
				$("#paybillinfo").hide();
				$("#npspaybillinfo").hide();
			}
		}
		else if(bill_type == 8){
			if(bill_sub_type == 32){
				$('#txtBillTitle').val("Wages in respect of  "+DEPT_NAME+" for the month of "+MONTH_YEAR);
				//var register_count = parseInt($("#BILL_REGISTER_COUNT").val());
				//$("#Bill_BILL_NO").val("WPB/"+zeroPad((register_count+1), 2)+"/"+FIANANCIAL_YEAR+" dt "+TODAY_DATE);
				//$("#Bill_PT_DED_BILL_NO").val("WPB/"+zeroPad((register_count+2), 2)+"/"+FIANANCIAL_YEAR+" dt "+TODAY_DATE);
				$("#Bill_NILL_BILL_NO").val("");
				$("#Bill_LIC_DED_BILL_NO").val("");
				$("#BILL_ENTRY_COUNT").val(2);
				$("#paybillinfo").show();
				$("#npspaybillinfo").hide();
			}
		}
		else if(bill_type == 3){
			if(bill_sub_type == 1){
				$('#txtBillTitle').val("Purchase of "+$("#Bill_BILL_SUB_TYPE option:selected").text()+" in R/O of "+DEPT_NAME);
					//var register_count = parseInt($("#BILL_REGISTER_COUNT").val());
					//$("#Bill_BILL_NO").val("OE/"+zeroPad((register_count+1), 2)+"/"+FIANANCIAL_YEAR+" dt "+TODAY_DATE);
					$("#Bill_NILL_BILL_NO").val("");
					$("#Bill_LIC_DED_BILL_NO").val("");
					$("#Bill_PT_DED_BILL_NO").val("");
					$("#BILL_ENTRY_COUNT").val(1);
					$("#paybillinfo").hide();
					$("#npspaybillinfo").hide();
			}
			else if(bill_sub_type == 2){
				$('#txtBillTitle').val("Purchase of "+$("#Bill_BILL_SUB_TYPE option:selected").text()+" in R/O of "+DEPT_NAME);
				//var register_count = parseInt($("#BILL_REGISTER_COUNT").val());
				//$("#Bill_BILL_NO").val("OE/"+zeroPad((register_count+1), 2)+"/"+FIANANCIAL_YEAR+" dt "+TODAY_DATE);
				$("#Bill_NILL_BILL_NO").val("");
				$("#Bill_LIC_DED_BILL_NO").val("");
				$("#Bill_PT_DED_BILL_NO").val("");
				$("#BILL_ENTRY_COUNT").val(1);
				$("#paybillinfo").hide();
				$("#npspaybillinfo").hide();
			}
			else if(bill_sub_type == 3){
				$('#txtBillTitle').val("Payment of "+$("#Bill_BILL_SUB_TYPE option:selected").text()+" charges in R/O of "+DEPT_NAME);
				//var register_count = parseInt($("#BILL_REGISTER_COUNT").val());
				//$("#Bill_BILL_NO").val("OE/"+zeroPad((register_count+1), 2)+"/"+FIANANCIAL_YEAR+" dt "+TODAY_DATE);
				$("#Bill_NILL_BILL_NO").val("");
				$("#Bill_LIC_DED_BILL_NO").val("");
				$("#Bill_PT_DED_BILL_NO").val("");
				$("#BILL_ENTRY_COUNT").val(1);
				$("#paybillinfo").hide();
				$("#npspaybillinfo").hide();
			}
			else if(bill_sub_type == 4){
				$('#txtBillTitle').val("Purchase of "+$("#Bill_BILL_SUB_TYPE option:selected").text()+" in R/O of "+DEPT_NAME);
				//var register_count = parseInt($("#BILL_REGISTER_COUNT").val());
				//$("#Bill_BILL_NO").val("OE/"+zeroPad((register_count+1), 2)+"/"+FIANANCIAL_YEAR+" dt "+TODAY_DATE);
				$("#Bill_NILL_BILL_NO").val("");
				$("#Bill_LIC_DED_BILL_NO").val("");
				$("#Bill_PT_DED_BILL_NO").val("");
				$("#BILL_ENTRY_COUNT").val(1);
				$("#paybillinfo").hide();
				$("#npspaybillinfo").hide();
			}
			else if(bill_sub_type == 5){
				$('#txtBillTitle').val("Purchase of "+$("#Bill_BILL_SUB_TYPE option:selected").text()+" in R/O of "+DEPT_NAME);
				//var register_count = parseInt($("#BILL_REGISTER_COUNT").val());
				//$("#Bill_BILL_NO").val("OE/"+zeroPad((register_count+1), 2)+"/"+FIANANCIAL_YEAR+" dt "+TODAY_DATE);
				$("#Bill_NILL_BILL_NO").val("");
				$("#Bill_LIC_DED_BILL_NO").val("");
				$("#Bill_PT_DED_BILL_NO").val("");
				$("#BILL_ENTRY_COUNT").val(1);
				$("#paybillinfo").hide();
				$("#npspaybillinfo").hide();
			}
			else if(bill_sub_type == 6){
				$('#txtBillTitle').val("Payement of "+$("#Bill_BILL_SUB_TYPE option:selected").text()+" for the month of "+PREVIOUS_MONTH_YEAR+" in R/O of "+DEPT_NAME);
				//var register_count = parseInt($("#BILL_REGISTER_COUNT").val());
				//$("#Bill_BILL_NO").val("OE/"+zeroPad((register_count+1), 2)+"/"+FIANANCIAL_YEAR+" dt "+TODAY_DATE);
				$("#Bill_NILL_BILL_NO").val("");
				$("#Bill_LIC_DED_BILL_NO").val("");
				$("#Bill_PT_DED_BILL_NO").val("");
				$("#BILL_ENTRY_COUNT").val(1);
				$("#paybillinfo").hide();
				$("#npspaybillinfo").hide();
			}
			else if(bill_sub_type == 7){
				$('#txtBillTitle').val("Purchase of "+$("#Bill_BILL_SUB_TYPE option:selected").text()+" in R/O of "+DEPT_NAME);
				//var register_count = parseInt($("#BILL_REGISTER_COUNT").val());
				//$("#Bill_BILL_NO").val("OE/"+zeroPad((register_count+1), 2)+"/"+FIANANCIAL_YEAR+" dt "+TODAY_DATE);
				$("#Bill_NILL_BILL_NO").val("");
				$("#Bill_LIC_DED_BILL_NO").val("");
				$("#Bill_PT_DED_BILL_NO").val("");
				$("#BILL_ENTRY_COUNT").val(1);
				$("#paybillinfo").hide();
				$("#npspaybillinfo").hide();
			}
			else if(bill_sub_type == 8){
				$('#txtBillTitle').val("Purchase of "+$("#Bill_BILL_SUB_TYPE option:selected").text()+" in R/O of "+DEPT_NAME);
				//var register_count = parseInt($("#BILL_REGISTER_COUNT").val());
				//$("#Bill_BILL_NO").val("OE/"+zeroPad((register_count+1), 2)+"/"+FIANANCIAL_YEAR+" dt "+TODAY_DATE);
				$("#Bill_NILL_BILL_NO").val("");
				$("#Bill_LIC_DED_BILL_NO").val("");
				$("#Bill_PT_DED_BILL_NO").val("");
				$("#BILL_ENTRY_COUNT").val(1);
				$("#paybillinfo").hide();
				$("#npspaybillinfo").hide();
			}
			else if(bill_sub_type == 9){
				$('#txtBillTitle').val("Purchase of "+$("#Bill_BILL_SUB_TYPE option:selected").text()+" in R/O of "+DEPT_NAME);
				//var register_count = parseInt($("#BILL_REGISTER_COUNT").val());
				//$("#Bill_BILL_NO").val("OE/"+zeroPad((register_count+1), 2)+"/"+FIANANCIAL_YEAR+" dt "+TODAY_DATE);
				$("#Bill_NILL_BILL_NO").val("");
				$("#Bill_LIC_DED_BILL_NO").val("");
				$("#Bill_PT_DED_BILL_NO").val("");
				$("#BILL_ENTRY_COUNT").val(1);
				$("#paybillinfo").hide();
				$("#npspaybillinfo").hide();
			}
			else if(bill_sub_type == 10){
				$('#txtBillTitle').val("Payment of "+$("#Bill_BILL_SUB_TYPE option:selected").text()+" in R/O of "+DEPT_NAME);
				//var register_count = parseInt($("#BILL_REGISTER_COUNT").val());
				//$("#Bill_BILL_NO").val("OE/"+zeroPad((register_count+1), 2)+"/"+FIANANCIAL_YEAR+" dt "+TODAY_DATE);
				$("#Bill_NILL_BILL_NO").val("");
				$("#Bill_LIC_DED_BILL_NO").val("");
				$("#Bill_PT_DED_BILL_NO").val("");
				$("#BILL_ENTRY_COUNT").val(1);
				$("#paybillinfo").hide();
				$("#npspaybillinfo").hide();
			}
			else if(bill_sub_type == 11){
				$('#txtBillTitle').val("Payment of "+$("#Bill_BILL_SUB_TYPE option:selected").text()+" in R/O of "+DEPT_NAME);
				//var register_count = parseInt($("#BILL_REGISTER_COUNT").val());
				//$("#Bill_BILL_NO").val("OE/"+zeroPad((register_count+1), 2)+"/"+FIANANCIAL_YEAR+" dt "+TODAY_DATE);
				$("#Bill_NILL_BILL_NO").val("");
				$("#Bill_LIC_DED_BILL_NO").val("");
				$("#Bill_PT_DED_BILL_NO").val("");
				$("#BILL_ENTRY_COUNT").val(1);
				$("#paybillinfo").hide();
				$("#npspaybillinfo").hide();
			}
			else if(bill_sub_type == 12){
				$('#txtBillTitle').val("Payment of "+$("#Bill_BILL_SUB_TYPE option:selected").text()+" charges for the month of "+PREVIOUS_MONTH_YEAR+" in R/O of "+DEPT_NAME);
				//var register_count = parseInt($("#BILL_REGISTER_COUNT").val());
				//$("#Bill_BILL_NO").val("OE/"+zeroPad((register_count+1), 2)+"/"+FIANANCIAL_YEAR+" dt "+TODAY_DATE);
				$("#Bill_NILL_BILL_NO").val("");
				$("#Bill_LIC_DED_BILL_NO").val("");
				$("#Bill_PT_DED_BILL_NO").val("");
				$("#BILL_ENTRY_COUNT").val(1);
				$("#paybillinfo").hide();
				$("#npspaybillinfo").hide();
			}
			else if(bill_sub_type == 13){
				$('#txtBillTitle').val("Payment of "+$("#Bill_BILL_SUB_TYPE option:selected").text()+" for the month of "+PREVIOUS_MONTH_YEAR+" in R/O of "+DEPT_NAME);
				//var register_count = parseInt($("#BILL_REGISTER_COUNT").val());
				//$("#Bill_BILL_NO").val("OE/"+zeroPad((register_count+1), 2)+"/"+FIANANCIAL_YEAR+" dt "+TODAY_DATE);
				$("#Bill_NILL_BILL_NO").val("");
				$("#Bill_LIC_DED_BILL_NO").val("");
				$("#Bill_PT_DED_BILL_NO").val("");
				$("#BILL_ENTRY_COUNT").val(1);
				$("#paybillinfo").hide();
				$("#npspaybillinfo").hide();
			}
			else if(bill_sub_type == 14){
				$('#txtBillTitle').val("Payment of "+$("#Bill_BILL_SUB_TYPE option:selected").text()+" in R/O of "+DEPT_NAME);
				//var register_count = parseInt($("#BILL_REGISTER_COUNT").val());
				//$("#Bill_BILL_NO").val("OE/"+zeroPad((register_count+1), 2)+"/"+FIANANCIAL_YEAR+" dt "+TODAY_DATE);
				$("#Bill_NILL_BILL_NO").val("");
				$("#Bill_LIC_DED_BILL_NO").val("");
				$("#Bill_PT_DED_BILL_NO").val("");
				$("#BILL_ENTRY_COUNT").val(1);
				$("#paybillinfo").hide();
				$("#npspaybillinfo").hide();
			}
		}
		else if(bill_type == 4){
			$("#dte-emp").show();
			if(bill_sub_type == 29){
				$('#txtBillTitle').val("Bill of "+$("#Bill_BILL_SUB_TYPE option:selected").text()+" in R/O staff of "+DEPT_NAME);
				//var register_count = parseInt($("#BILL_REGISTER_COUNT").val());
				//$("#Bill_BILL_NO").val("DTE/"+zeroPad((register_count+1), 2)+"/"+FIANANCIAL_YEAR+" dt "+TODAY_DATE);
				$("#Bill_NILL_BILL_NO").val("");
				$("#Bill_LIC_DED_BILL_NO").val("");
				$("#Bill_PT_DED_BILL_NO").val("");
				$("#BILL_ENTRY_COUNT").val(1);
			}
		}
		else if(bill_type == 6){
			$("#medical-emp").show();
			if(bill_sub_type == 33){
				$('#txtBillTitle').val("Bill of Reimbursement of "+$("#Bill_BILL_SUB_TYPE option:selected").text()+" in R/O staff of "+DEPT_NAME);
				//var register_count = parseInt($("#BILL_REGISTER_COUNT").val());
				//$("#Bill_BILL_NO").val("MED/"+zeroPad((register_count+1), 2)+"/"+FIANANCIAL_YEAR+" dt "+TODAY_DATE);
				$("#Bill_NILL_BILL_NO").val("");
				$("#Bill_LIC_DED_BILL_NO").val("");
				$("#Bill_PT_DED_BILL_NO").val("");
				$("#BILL_ENTRY_COUNT").val(1);
			}
		}
		else{
			$('#txtBillTitle').val('');
		}
	});
	
	$('#wages-emp input[type=checkbox], #ops-emp input[type=checkbox]').change(function(){
		if($(this).is(":checked")) {
			var empID = $(this).val(),
				empName = $(this).next('span').html();
			$('#txtBillTitle').val("Wages in respect of "+empName+" of  "+DEPT_NAME+" for the month of "+CURRENT_MONTH_YEAR);
		}
		else{
			$('#txtBillTitle').val("Wages in respect of staff of "+DEPT_NAME+" for the month of "+CURRENT_MONTH_YEAR);
		}
	});
	
	$('#nps-emp input[type=checkbox], #ops-emp input[type=checkbox]').change(function(){
		if($(this).is(":checked")) {
			var empID = $(this).val(),
				empName = $(this).next('span').html();
			$('#txtBillTitle').val($("#Bill_BILL_SUB_TYPE option:selected").text()+" in R/O "+empName+" of "+DEPT_NAME+" ");
		}
		else{
			$('#txtBillTitle').val($("#Bill_BILL_SUB_TYPE option:selected").text()+" in R/O staff of "+DEPT_NAME+" ");
		}
	});
	
	$('#ltc-htc-emp input[type=checkbox]').change(function(){
		if($(this).is(":checked")) {
			var empID = $(this).val(),
				empName = $(this).next('span').html();
			$('#txtBillTitle').val($("#Bill_BILL_SUB_TYPE option:selected").text()+" in R/O "+empName+" of "+DEPT_NAME+" for the Block Year");
		}
		else{
			$('#txtBillTitle').val($("#Bill_BILL_SUB_TYPE option:selected").text()+" in R/O staff of "+DEPT_NAME+" for the Block Year");
		}
	});
	
	$('#cea-emp input[type=checkbox]').change(function(){
		if($(this).is(":checked")) {
			var empID = $(this).val(),
				empName = $(this).next('span').html();
			$('#txtBillTitle').val("Bill of Reimbursement of "+$("#Bill_BILL_SUB_TYPE option:selected").text()+" in R/O "+empName+" of "+DEPT_NAME+" for the Academic Year ");
		}
		else{
			$('#txtBillTitle').val("Bill of Reimbursement of "+$("#Bill_BILL_SUB_TYPE option:selected").text()+" in R/O staff of "+DEPT_NAME+" for the Academic Year ");
		}
	});
	
	$('#medical-emp input[type=checkbox]').change(function(){
		if($(this).is(":checked")) {
			var empID = $(this).val(),
				empName = $(this).next('span').html();
			$('#txtBillTitle').val("Bill of Reimbursement of "+$("#Bill_BILL_SUB_TYPE option:selected").text()+" in R/O "+empName+" of "+DEPT_NAME+" for the Academic Year ");
		}
		else{
			$('#txtBillTitle').val("Bill of Reimbursement of "+$("#Bill_BILL_SUB_TYPE option:selected").text()+" in R/O staff of "+DEPT_NAME+" for the Academic Year ");
		}
	});
	
	$('#dte-emp input[type=checkbox]').change(function(){
		if($(this).is(":checked")) {
			var empID = $(this).val(),
				empName = $(this).next('span').html();
			$('#txtBillTitle').val("Bill of "+$("#Bill_BILL_SUB_TYPE option:selected").text()+" in R/O "+empName+" of "+DEPT_NAME);
		}
		else{
			$('#txtBillTitle').val("Bill of "+$("#Bill_BILL_SUB_TYPE option:selected").text()+" in R/O staff of "+DEPT_NAME);
		}
	});
	
	$('#ytchkIsBonusBill').change(function(){
		if($(this).is(":checked")) {
			var empID = $(this).val(),
				empName = $(this).next('span').html();
			
		}
		else{
			$('#txtBillTitle').val("");
		}
	});
	
});

function validateBillForm(){
	var bill_type = parseInt($("#slBillType").val());
	
	if(bill_type == 0){
		alert('Please select Bill Type');
		return false;
	}
	
	if(bill_type == 3){
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
	
function otherSalaryBillsReset(){
	$('#cea-emp').hide();
	$('#medical-emp').hide();
	$("#ltc-htc-emp").hide();
	$("#ua-emp").hide();
	$("#bonus-emp").hide();
	$("#nps-emp").hide();
	$("#ops-emp").hide();
	$("#dte-emp").hide();
}

function zeroPad(num, places) {
  var zero = places - num.toString().length + 1;
  return Array(+(zero > 0 && zero)).join("0") + num;
}

function deleteCEARow(row)
{
	var i=row.parentNode.parentNode.rowIndex;
	document.getElementById('CEASubBillTable').deleteRow(i);
}


function insCEARow()
{
	var x=document.getElementById('CEASubBillTable');
	var new_row = x.rows[1].cloneNode(true);
	var len = x.rows.length;
	
	var inp1 = new_row.cells[0].getElementsByTagName('input')[0];
	inp1.name = "Bill[CEA_BILLS]["+len+"][NAME]";
	inp1.value = '';
	var inp2 = new_row.cells[1].getElementsByTagName('input')[0];
	inp2.name = "Bill[CEA_BILLS]["+len+"][DOB]";
	inp2.value = '';
	var inp3 = new_row.cells[2].getElementsByTagName('input')[0];
	inp3.name = "Bill[CEA_BILLS]["+len+"][CLASS]";
	inp3.value = '';
	var inp4 = new_row.cells[3].getElementsByTagName('input')[0];
	inp4.name = "Bill[CEA_BILLS]["+len+"][SCHOOL]";
	inp4.value = '';
	var inp5 = new_row.cells[4].getElementsByTagName('input')[0];
	inp5.name = "Bill[CEA_BILLS]["+len+"][AMOUNT]";
	inp5.classList.add("bills_amount");
	inp5.value = '';
	var inp6 = new_row.cells[5].getElementsByTagName('input')[0];
	inp6.name = "Bill[CEA_BILLS]["+len+"][REMARKS]";
	inp6.value = '';
	x.appendChild( new_row );
}
function deleteRow(row)
{
	var i=row.parentNode.parentNode.rowIndex;
	document.getElementById('SubBillTable').deleteRow(i);
}


function insRow()
{
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
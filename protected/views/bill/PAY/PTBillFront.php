<?php require_once Yii::app()->request->baseUrl."/include/PayBillsFrontSheetInclude.php";?>
<div style="display: block;border-bottom: 1px solid #000;min-height: 70px;margin-bottom: 5px;position: relative;">
	<div style="display: inline-block;float: left;width: 50%;">
		<p style="margin-bottom:5px;font-size: 10px;"><b>DEDUCTION BILL IN R/O  <?php echo $master->DEPT_NAME; ?><?php echo ($model->BILL_TYPE == 1)? " (OLD PENSION SCHEME)":" (NEW PENSION SCHEME)"; ?></b></p>
		<p style="margin-bottom:5px;font-size: 10px;"><strong>NAME OF OFFICE :</strong><span style="border-bottom: 1px dotted #000;"> O/o the <?php echo $master->OFFICE_NAME; ?></span></p>
		<p style="margin-bottom:5px;font-size: 10px;"><strong>PERIOD OF PAYMENT :</strong><span style="border-bottom: 1px dotted #000;"><?php echo date('M-Y', strtotime($model->CREATION_DATE)); ?></span></p>
	</div>
	  <div style="display: inline-block;width: 111px;position: absolute;left: 65%;margin-left: -100px;text-align: center;font-weight: bold;">
		<h4 style="margin-bottom: 5px;font-weight: bold;">CENTRAL	</h4>
		<h2 style="margin-bottom: 0;font-weight: bold;">PAY BILL<p></p></h2>
	</div>
	  <div style="display: inline-block;float: right; width: 25%;">
	  <p style="margin-bottom:5px;font-size: 10px;"><strong>(i) Bill No and  Date:-	</strong><span style="border-bottom: 1px dotted #000;"><?php echo $model->PT_DED_BILL_NO; ?></span></p>
	  <p style="margin-bottom:5px;font-size: 10px;"><strong>(ii)Token No. and Date :</strong></p>
	  <p style="margin-bottom:5px;font-size: 10px;"><strong>(iii) Voucher no. and Date : <span style="border-bottom: 1px dotted #000;font-weight: bold;font-size: 13px;"></span></strong></p>
	</div>
</div>
<h4 style="text-align: center; font-size: 13px;font-weight: bold;margin-bottom: 5px;">ABSTRACT OF THE CLAIM AND OTHER PARTICULARS</h4>
<div style="width: 100%;position:relative;">
	<div style="border: 1px solid;height: 25px;position: absolute;width: 100%;right: 16px;top: 400px;"></div>
	<div style="width: 33%;min-height: 425px;display: inline-block;float: left;font-size: 10px;position: relative;">
		<div style="border: 1px solid;height: 425px;position: absolute;width: 74px;right: 5px;top: 0;"></div>
		<p>(a) Deductions/recoveries adjustable in the books  <br> of Payand Accocunts Officer.</p><br><br>
		<p><span style="font-weight: bold;font-size: 11px;">0021</span> <span style="font-weight: bold;font-size: 11px;"> TAXES ON INCOME	</span></p>
		<p><span style="font-weight: bold;font-size: 11px;">OTHER THAN CORPN. TAX</span><span style="font-size: 11px;float: right;margin-right: 10px;display: inline-block;width: 50%;">Income Tax:<span style="float: right;font-style: italic;"></span></span></p>
		<p><span style="font-size: 11px;float: right;margin-right: 10px;display: inline-block;width: 50%;">	CESS:<span style="float: right;font-style: italic;"></span></span></p>
		<p><span style="font-size: 11px;float: right;margin-right: 10px;display: inline-block;width: 50%;">	Higher Edn. Cess:<span style="float: right;font-style: italic;"></span></span></p>
		<p><span style="font-size: 12px;float: right;margin-right: 10px;display: inline-block;width: 50%;">	<span style="float: right;font-style: italic;font-weight: bold;"></span></span></p>
		<p><span style="font-weight: bold;font-size: 11px;">0049 INTEREST RECEIPTS</span><span style="float: right;margin-right: 10px;font-style: italic;"></span></p>
		<p>(i) Interest on House Building </p><br><br>
		<p>(ii) Interst on Motor Conveyance Advance</p>
		<p>(iii) Interest on Other Conveyance </p><br><br>
		<p>(iv)</p><br>
		<p>(v) </p>
		<p><span style="font-weight: bold;font-size: 11px;">0210 MEDICAL</span></p><br>
		<p>C.G.H.S Contribution <span style="float: right;font-weight: bold;margin-right: 10px;"></span></p><br>
		<p>HOUSING </p><br>
		<p>Licence Fee <span style="float: right;font-weight: bold;margin-right: 10px;"></span></p><br><br>
		
		<p><span style="font-weight: bold;font-size: 11px;">0235  SOCIAL SECURITY AND WELFARE</span></p><br>
		<p>C.G.E.G.I.S Contribution <span style="float: right;font-weight: bold;margin-right: 10px;"></span></p><br>
		
		<p><span style="font-weight: bold;font-size: 11px;">8342 :</span> <span style="font-weight: bold;font-size: 11px;"> [ 20.01 ]	</span></p>
		<?php 		
			$PT = Yii::app()->db->createCommand("SELECT SUM(PT) as PT FROM tbl_salary_details WHERE BILL_ID_FK = $model->ID AND YEAR = $model->YEAR AND MONTH = $model->MONTH;")->queryRow()['PT']; 
		?>
		<p style="font-weight: bold;font-size: 12px;">Government's Contribution : Tier-I <span style="float: right;font-weight: bold;margin-right: 10px;"></span></p><br><br>
		<p style="font-weight: bold;font-size: 10px;">Total C/o <span style="float: right;font-weight: bold;margin-right: 10px;"></span></p><br>
		
	</div>
	<div style="width: 33%;min-height: 425px;display: inline-block;float: left;position: relative;">
		<div style="border: 1px solid;height: 425px;position: absolute;width: 65px;right: 5px;top: 0;"></div>
		<p style="font-weight: bold;font-size: 11px;">Total B/F <span style="float: right;margin-right: 10px;font-style: italic"></span></p><br>
		<p><span style="font-weight: bold;font-size: 11px;">7610 LOANS TO GOVERNMENT SERVANTS, Etc.,</span></p>
		<p><span style="font-weight: bold;font-size: 11px;">LONG TERM ADVANCES</span></p><br>
		<p style="font-size: 11px;">(i) House Building Advance <span style="float: right;font-weight: bold;margin-right: 10px;"></span></p>
		<p><span style="font-size: 11px;">(ii) Advances for purchase of Motor </span><span style="font-weight: bold;font-size: 11px;float: right;margin-right: 10px;display: inline-block;width: 40%;">OMCA<span style="float: right;font-style: italic;"></span></span></p><br>
		<p><span style="font-weight: bold;font-size: 11px;">SHORT TERM ADVANCES</span></p>
		<p><span style="font-size: 11px;">(i) Advances for purchase of other Conveyance-</span><span style="font-weight: bold;font-size: 11px;float: right;margin-right: 10px;display: inline-block;width: 40%;">Cycl.Adv<span style="float: right;font-style: italic;"></span></span></p>
		<p><span style="font-size: 11px;">(ii) FAN Advance<span style="float: right;font-style: italic;margin-right: 10px;"></span></p>
		<p><span style="font-size: 11px;">(iii) Flood Advance<span style="float: right;font-style: italic;margin-right: 10px;"></span></p>
		<p><span style="font-size: 11px;">(iv) Other Advances<span style="float: right;font-style: italic;margin-right: 10px;"></span></p>
		<p><span style="font-size: 11px;">(v)</p>
		<p><span style="font-size: 11px;">(vi)</p>
		<p><span style="font-size: 11px;">(vii)</p><br>
		<p><span style="font-weight: bold;font-size: 11px;">MISCELLANEOUS RECOVERIES</span></p>
		<p style="font-size: 11px;">Overpayments made during the previous financial year(s)<span style="float: right;font-weight: bold;margin-right: 10px;"></span></p><br>
		<p><span style="font-weight: bold;font-size: 11px;">Classification of Expenditure.</span></p>
		<p style="font-size: 11px;">(To be filled in by the Drawing and Disbursing Officer)</p>
		<p style="font-size: 11px;">Demand No .</p>
		<p style="font-size: 11px;">Major Head</p>
		<p><span style="font-size: 11px;">Group Head.</span><span style="font-size: 11px;float: right;margin-right: 10px;display: inline-block;width: 75%;">(iv) Pay & Allowances of Staff/Officers</span></p>
		<p style="font-size: 11px;">Minor Head</p>
		<p><span style="font-size: 11px;">Sub - Head.</span><span style="font-size: 11px;float: right;margin-right: 10px;display: inline-block;width: 60%;text-align: center;">Salaries</span></p><br>
		<p><span style="font-weight: bold;font-size: 11px;">(A)</span> <span style="font-weight: bold;font-size: 11px;"> -- Total	</span><span style="float: right;margin-right: 10px;font-weight: bold;"></span></p>
		
	</div>
	<div style="width: 33%;min-height: 425px;display: inline-block;float: left;position: relative;">
		<div style="border: 1px solid;height: 425px;position: absolute;width: 73px;right: 5px;top: 0;"></div>
		<p><span style="font-weight: bold;font-size: 11px;">Detailed Heads</span></p><br>
		<p style="font-size: 11px;font-weight: bold;"><span style="font-size: 11px;float: right;margin-right: 10px;display: inline-block;width: 60%;">PT:-<span style="float: right;font-style: italic;">Rs.<?php echo $PT;?></span></span></p>
		<br><br>
		<p style="font-size: 11px;font-weight: bold;">Expenditure Awaiting Transfer :</p>
		<p style="font-size: 11px;font-weight: bold;">I. Grand Total :-<span style="font-size: 11px;float: right;margin-right: 10px;display: inline-block;width: 60%;"><span style="float: right;font-style: italic;">Rs.<?php echo $PT;?></span></span></p>
		<p style="font-size: 11px;">(a) LESS deductions/recoveries adjustable by Pay <br> and Accounts Officer as per details <span style="float: right;font-weight: bold;margin-right: 10px;"></span></p><br>
		<p style="font-size: 11px;">(b) LESS deduction/recoveries adjustable by other <br> Accounts Offices        (Salary Advance) <span style="float: right;font-weight: bold;margin-right: 10px;"></span></p><br>
		<p style="font-size: 11px;">8658  Suspence Accounts - Pay & Accounts Office  Suspence - Transactions adjustable with :</p>
		<p style="font-size: 11px;">(I) A.G.......................................................................</p>
		<p style="font-size: 11px;">(ii) P.A.O....................................................................</p>
		<p style="font-size: 11px;">(iii).........................................................................</p>
		<p style="font-size: 11px;">(iv)..........................................................................</p>
		<p style="font-size: 11px;">(v)...........................................................................</p>
		<p style="font-size: 11px;">Total          ........                .........               .........      </p>
		<p style="font-size: 11px;">*	(c) DEDUCT - Undisbursed amount(s)     ...................................</p>
		<p style="font-size: 11px;font-weight: bold;">II. Total deductions / recoveries <span style="float: right;font-weight: bold;margin-right: 10px;"></p><br>
		<p style="font-size: 11px;font-weight: bold;">III. NET amount (I minus II) required for payment by : <span style="float: right;font-weight: bold;margin-right: 10px;"></p><br>
		<p style="margin-bottom: 20px;"><span style="font-weight: bold;font-size: 11px;">(i) Cheque for self / s per detail given in the bill --</span><span style="font-size: 13px;float: right;margin-right: 10px;display: inline-block;width: 70%;font-weight: bold;"><span style="float: right;font-style: italic;"></span></span></p>
		<p style="margin-bottom: 20px;"><span style="font-weight: bold;font-size: 11px;">(ii) Demand Draft in favour of :</span><span style="font-size: 12px;float: right;margin-right: 10px;display: inline-block;width: 70%;font-weight: bold;"></span></p><br/>
		<p ><span style="font-weight: bold;font-size: 11px;"></span><span style="font-size: 13px;float: right;margin-right: 10px;display: inline-block;width: 70%;font-weight: bold;">Total :-<span style="font-weight: bold;font-size:12px;float: right;">Rs.<?php echo $PT;?></span></p>
	</div>
</div>
<p style="text-align: center;font-weight: bold;font-size:11px;"><?php echo $this->amountToWord($PT);?></p>
<div style="font-size: 10px;">
	<p>CERTIFIED THAT I HAVE SATISFIED MYSELF THAT --</p>
	<p>(a) the amounts claimed in the Bill are actually due to the persons concerned and the conditions attached to the payment of various allowances have been duly complied with in all cases ;</p>
	<p>(b) the claims have been made against sanctioned posts (details of cases, if any, where claims have been made in anticipatioon of sanction may be mentioned) and, whereever necesssary, snctions of competent autorities 
	have ben obtained as regards grant of increment, crossing of Efficiency Bar, fixation of pay, grant of leave, etc., and that these events have been properly noted in the related Service Books ;</p>
	<p>(c) the particulars of the various deductions/recoveries have been fully noted in the attached schedules and the totals shown in these schedules agree with those given in the bill ;</p>
	<p>(d) all emoluments included in bills drawn 1month/2 months / 3 months previous to this date with the exception of those detailed in the bill have been disbursed to the proper persons and that their acquittances have been taken
	 and filed in my office with receipt stamps duly cancelled  for every payment in excess of Rs.20/- ;</p>
	<p>(e) all persons whose names are omitted from, but whose pay has been drawn in this bill have actually been employed during the month, that full details of emoluments drawn for them working up to the total included in this 
	bill have duly shown in the Pay Bill have been duly shown in the Pay Bill Register and that the emoluments drawn are according to the relevant rules and orders.</p>
</div>
<br>
<div>
	<div style="font-weight: bold; width:400px; float: left;font-size: 10px;"><p><span>Station :</span> Bangalore</p><p><span>Date :</span> <?php echo date('d/m/Y', strtotime($model->CREATION_DATE));?></p></div>
	<div style="font-weight: bold; width:400px; float: right;text-align:center;font-size: 10px;">
	<p><?php echo Employee::model()->findByPK($master['DEPT_ADMIN_EMPLOYEE'])->NAME;?></p>
		<p><?php echo Designations::model()->findByPK(Employee::model()->findByPK($master['DEPT_ADMIN_EMPLOYEE'])->DESIGNATION_ID_FK)->DESIGNATION;?></p>
		<p><?php echo $master['DEPT_NAME']?></p>
	</div>
</div>
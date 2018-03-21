
<table class="full">
	<tr>
		<td colspan="10">PROVISIONAL INCOME TAX CALCULATION  FOR THE YEAR <?php echo $financialYear->NAME?> <?php echo $employee->PENSION_TYPE?></td>
		<td colspan="3">Page No: 1</td>
	</tr>
	<tr>
		<td colspan="2">IN R/O OF SHRI./SMT/KUM</td>
		<td colspan="5"><?php echo $employee->NAME."<br>(".$employee->NAME_HINDI.")";?></td>
		<td colspan="2">DESGN.:</td>
		<td colspan="4"><?php echo Designations::model()->findByPK($employee->DESIGNATION_ID_FK)->DESIGNATION .
		"<br>(".Designations::model()->findByPK($employee->DESIGNATION_ID_FK)->DESIGNATION_HINDI.")";?></td>
	</tr>
	<tr>
		<td>MONTH</td>
		<td>BASIC</td>
		<td>PP/SP</td>
		<td>TA</td>
		<td>HRA</td>
		<td>DA</td>
		<td>TOTAL</td>
		<td>CGEGIS</td>
		<td>CPF</td>
		<td>PT</td>
		<td>IT</td>
		<td>MISC</td>
		<td>PLI</td>
	</tr>
	<?php foreach($SALARIES as $SALARY){?>
		<tr>
			<td><?php echo $SALARY['PERIOD'];?></td>
			<td><?php echo $SALARY['BASIC'];?></td>
			<td><?php echo $SALARY['PP_SP'];?></td>
			<td><?php echo $SALARY['TA'];?></td>
			<td><?php echo $SALARY['HRA'];?></td>
			<td><?php echo $SALARY['DA'];?></td>
			<td><?php echo $SALARY['TOTAL'];?></td>
			<td><?php echo $SALARY['CGEGIS'];?></td>
			<td><?php echo $SALARY['CPF'];?></td>
			<td><?php echo $SALARY['PT'];?></td>
			<td><?php echo $SALARY['IT'];?></td>
			<td><?php echo $SALARY['MISC'];?></td>
			<td><?php echo $SALARY['PLI'];?></td>
		</tr>
	<?php } ?>
	<?php foreach($TOTAL_SALARIES as $SALARY){?>
		<tr>
			<td><?php echo $SALARY['PERIOD'];?></td>
			<td><?php echo $SALARY['BASIC'];?></td>
			<td><?php echo $SALARY['PP_SP'];?></td>
			<td><?php echo $SALARY['TA'];?></td>
			<td><?php echo $SALARY['HRA'];?></td>
			<td><?php echo $SALARY['DA'];?></td>
			<td><?php echo $SALARY['TOTAL'];?></td>
			<td><?php echo $SALARY['CGEGIS'];?></td>
			<td><?php echo $SALARY['CPF'];?></td>
			<td><?php echo $SALARY['PT'];?></td>
			<td><?php echo $SALARY['IT'];?></td>
			<td><?php echo $SALARY['MISC'];?></td>
			<td><?php echo $SALARY['PLI'];?></td>
		</tr>
	<?php } ?>
	<tr class="no-border">
		<td colspan="6" class="left-text">SALARY after Recovery of (Rs. <?php echo $TOTAL_MISC?>/-)</td>
		<td><?php echo $TOTAL_SALARY_WITHOUT_MISC?></td>
		<td class="no-border"></td>
		<td colspan="5" >* HRA Exemption (Least of the following)</td>
	</tr>
	<tr class="no-border">
		<td colspan="6" class="left-text">DA /TA ARREARS</td>
		<td><?php echo $TOTAL_DA_TA_ARREAR?></td>
		<td class="no-border"></td>
		<td colspan="5">
			<span style="float:left;padding-left: 10px;">(i) Actual HRA</span>
			<span style="float:right;padding-right: 10px;"> = <?php echo $ACTUAL_HRA?></span>
		</td>
	</tr>
	<tr class="no-border">
		<td colspan="6" class="left-text">OTA, Honorarium, etc.,</td>
		<td><?php echo $TOTAL_OTA_HONORIUM?></td>
		<td class="no-border"></td>
		<td colspan="5">
			<span style="float:left;padding-left: 10px;">(ii) Rent paid in excess of 10% of Salary</span>.
			<span style="float:right;padding-right: 10px;"> = <?php echo $RENT_PAID_EXCESS_OF_TEN_PERCENT; ?></span>
		</td>
	</tr>
	<tr class="no-border">
		<td colspan="6" class="left-text">AD-HOC BONUS</td>
		<td><?php echo $TOTAL_BONUS?></td>
		<td class="no-border"></td>
		<td colspan="5">
			<span style="float:left;padding-left: 10px;">(iii) 40% of Salary = </span>
			<span style="float:right;padding-right: 10px;"> = <?php echo $FOURTY_PERCENT_OF_SALARY;?></span>
		</td>
	</tr>
	<tr class="no-border">
		<td colspan="6" class="left-text">Leave Encashment</td>
		<td><?php echo $TOTAL_EL_ENCASH?></td>
		<td class="no-border"></td>
		<td colspan="5"></td>
	</tr>
	<tr class="no-border">
		<td colspan="6" class="left-text">Uniform Allowance</td>
		<td><?php echo $TOTAL_UA?></td>
		<td class="no-border"></td>
		<td colspan="5" class="left-text">(Salary = Total Pay + DA)</td>
	</tr>
	<tr class="no-border">
		<td colspan="6" class="left-text">Children Education Allowance</td>
		<td><?php echo $TOTAL_CEA?></td>
		<td class="no-border"></td>
	</tr>
	<tr>
		<td colspan="6" class="left-text">LTC/HTC</td>
		<td><?php echo $TOTAL_LTC_HTC?></td>
	</tr>
	<tr class="no-border">
		<td colspan="6" class="left-text">TOTAL INCOME (from Salary)</td>
		<td><?php echo $TOTAL_INCOME_FROM_SALARY?></td>
		<td class="no-border"></td>
		<td colspan="4">NEW PENSION</td>
	</tr>
	<tr class="no-border">
		<td colspan="2">H.R.A.EXEMPTION *</td>
		<td colspan="2">RENT per Annum</td>
		<td><?php echo $RENT_PAID;?></td>
		<td>(Minus)</td>
		<td><?php echo "-".$TOTAL_RENT;?></td>
		<td class="no-border"></td>
		<td colspan="2" class="left-text">(1) Mandatory CPF cont.</td>
		<td colspan="2"><?php echo $MANDATORY_CPF_CONTRIBUTION;?></td>
	</tr>
	<tr class="no-border">
		<td colspan="6" class="left-text">Govt. Contribution in CPF (equal to Govt. Servant's cont.)</td>
		<td><?php echo $TOTAL_CPF_GOVT?></td>
		<td class="no-border"></td>
		<td colspan="2" class="left-text">(2) CPF cont. from Arr.</td>
		<td colspan="2"><?php echo $TOTAL_DA_TA_ARREAR_CPF;?></td>
	</tr>
	<tr class="no-border">
		<td colspan="6" class="left-text">ANY OTHER INCOME (to be specified)</td>
		<td><?php echo $TOTAL_OTHER_INCOME?></td>
		<td class="no-border"></td>
		<td colspan="2" class="left-text">Govt. CPF Cont. (1+2)</td>
		<td colspan="2"><?php echo $TOTAL_CPF_GOVT;?></td>
	</tr>
	<tr class="no-border">
		<td colspan="6" class="left-text">HOUSE INCOME**</td>
		<td><?php echo $TOTAL_HOUSE_INCOME?></td>
		<td class="no-border"></td>
		<td colspan="2" class="left-text">CPF</td>
		<td colspan="2"><?php echo $TOTAL_CPF;?></td>
	</tr>
	<tr class="no-border">
		<td colspan="2" class="right-text no-border">A</td>
		<td colspan="4" class="left-text">GROSS INCOME</td>
		<td><?php echo $GROSS_INCOME?></td>
		<td class="no-border"></td>
	</tr>
	<tr class="no-border">
		<td colspan="2" class="no-border"></td>
		<td colspan="4" class="left-text">PROFESSIONAL TAX</td>
		<td><?php echo $TOTAL_SALARIES[0]['PT']?></td>
	</tr>
	<tr class="no-border">
		<td colspan="2" class="no-border"></td>
		<td colspan="4" class="left-text"> Tr. Allow (u/s. 10(14)</td>
		<td><?php echo $TA_ALLOWED?></td>
	</tr>
	<tr class="no-border">
		<td colspan="2" class="no-border"></td>
		<td colspan="4" class="left-text">Income after Deductions</td>
		<td><?php echo $INCOME_AFTER_DEDUCTION?></td>
	</tr>
	<tr class="no-border">
		<td colspan="8" class="no-border">&nbsp;</td>
		<td colspan="4">SAVINGS(max.1,50,000) U/s.80C</td>
	</tr>
	<tr class="no-border">
		<td colspan="2" class="left-text no-border">**[Form 12C u/s 192(2B)</td>
		<td class="left-text">PAN</td>
		<td colspan="4"><?php echo $PAN_NUMBER;?></td>
		<td class="no-border"></td>
		<td colspan="3" class="left-text">GPF/CPF</td>
		<td><?php echo $CPF_AFTER_81CCD_1B;?></td>
	</tr>
	<tr class="no-border">
		<td colspan="2" class="no-border"></td>
		<td colspan="5">EXEMPTIONS under Ch. VI- A</td>
		<td class="no-border"></td>
		<td colspan="3" class="left-text">CGEGIS</td>
		<td><?php echo $TOTAL_CGEGIS;?></td>
	</tr>
	<tr class="no-border">
		<td colspan="2" class="no-border"></td>
		<td colspan="4" class="left-text">i) 80-D (CGHS)</td>
		<td><?php echo $TOTAL_CGHS;?></td>
		<td class="no-border"></td>
		<td colspan="3" class="left-text">Insurances (LIC/others)</td>
		<td><?php echo $INSURANCE_LIC_OTHER;?></td>
	</tr>
	<tr class="no-border">
		<td colspan="2" class="no-border"></td>
		<td colspan="4" class="left-text">ii) 80-D (Medical Insurance - CGHS) up to Rs. 25000/- max.</td>
		<td><?php echo $MEDICAL_INSURANCE;?></td>
		<td class="no-border"></td>
		<td colspan="3" class="left-text">Tuition Fee for exemption</td>
		<td><?php echo $TUITION_FESS_EXEMPTION;?></td>
	</tr>
	<tr class="no-border">
		<td colspan="2" class="no-border"></td>
		<td colspan="4" class="left-text">ii) 80-D (Medical Insurance Parents)</td>
		<td><?php echo $MEDICAL_INSURANCE_PARENTS;?></td>
		<td class="no-border"></td>
		<td colspan="3" class="left-text">PPF/NSC</td>
		<td><?php echo $PPF_NSC;?></td>
	</tr>
	<tr class="no-border">
		<td colspan="2" class="no-border"></td>
		<td colspan="4" class="left-text">iv) 80-G (DONATIONS)</td>
		<td><?php echo $DONATION;?></td>
		<td class="no-border"></td>
		<td colspan="3" class="left-text">Home Loan (Principle)</td>
		<td><?php echo $HOME_LOAN_PR;?></td>
	</tr>
	<tr class="no-border">
		<td colspan="2" class="no-border"></td>
		<td colspan="4" class="left-text">v) 80-DD (Disability Med.Expn.)</td>
		<td><?php echo $DISABILITY_MED_EXP;?></td>
		<td class="no-border"></td>
		<td colspan="3" class="left-text">PLI/ULIP</td>
		<td><?php echo $PLI_ULIP;?></td>
	</tr>
	<tr class="no-border">
		<td colspan="2" class="no-border"></td>
		<td colspan="4" class="left-text">vi) 80-E (Education Loan INTR.)</td>
		<td><?php echo $EDU_LOAD_INT;?></td>
		<td class="no-border"></td>
		<td colspan="3" class="left-text">Term Deposit (above 5 yr)</td>
		<td><?php echo $TERM_DEPOSIT_ABOVE_5;?></td>
	</tr>
	<tr class="no-border">
		<td colspan="2" class="no-border"></td>
		<td colspan="4" class="left-text">vii) 80-U (Self Disability)</td>
		<td><?php echo $SELF_DISABILITY;?></td>
		<td class="no-border"></td>
		<td colspan="3" class="left-text">Mututal Fund</td>
		<td><?php echo $MUTUAL_FUND;?></td>
	</tr>
	<tr class="no-border">
		<td colspan="2" class="no-border"></td>
		<td colspan="4" class="left-text no-border-bottom">viii) Sec.24 (Home Loan-INTR.)**</td>
		<td><?php echo $HOME_LOAN_INT;?></td>
		<td class="no-border"></td>
		<td colspan="3" class="left-text">Pension fund (u/s 80-CCC)</td>
		<td><?php echo $PENSION_FUND;?></td>
	</tr>
	<tr class="no-border">
		<td colspan="2" class="no-border"></td>
		<td colspan="4" class="right-text no-border-bottom">(income/loss from house property)</td>
		<td><?php echo $MIN_HOME_LOAN_INT;?></td>
		<td class="no-border"></td>
		<td colspan="3" class="left-text">CPF (u/s/ 80CCD)</td>
		<td><?php echo $CPF_809CCD;?></td>
	</tr>
	<tr class="no-border">
		
		<td colspan="2" class="no-border"></td>
		<td colspan="4" class="left-text">ix) 80-EE (Housing Loans sanctioned during <?php echo $HOME_LOAN_YEAR;?>)</td>
		<td><?php echo $HOME_LOAN_80_EE_REBATE;?></td>
		<td class="no-border"></td>
		<td colspan="3" class="left-text">Stamp Duty/ Registration Charges</td>
		<td><?php echo $REGISTRY_STAMP;?></td>
	</tr>
	<tr class="no-border">
		<td colspan="2" class="no-border"></td>
		<td colspan="4" class="left-text no-border-bottom">x) Bank Interest deduction 80TTA</td>
		<td><?php echo $BANK_INTEREST_DED_80TTA;?></td>
		<td class="no-border"></td>
		<td colspan="3" class="left-text">Total</td>
		<td><?php echo $TOTAL_SAVING_80C;?></td>
	</tr>
	<tr class="no-border">
		<td colspan="2" class="no-border"></td>
		<td colspan="4" class="left-text">xi) Investment NPS under 80CCD(1B)</td>
		<td><?php echo $NPS_UNDER_80CCD_1B;?></td>
		<td class="no-border"></td>
		<td colspan="3" class="left-text">Savings (Rest.  to max)</td>
		<td><?php echo $MIN_SAVING_80C;?></td>
	</tr>
	<tr class="no-border">
		<td colspan="2" class="no-border right-text"></td>
		<td colspan="4" class="left-text">SAVINGS (U/s.80C)</td>
		<td><?php echo $NET_SAVING_80C;?></td>
		<td class="no-border"></td>
		<td colspan="3" class="left-text">Total Savings under VI-A</td>
		<td><?php echo $MIN_SAVING_80C;?></td>
	</tr>
	<tr class="no-border">
		<td colspan="2" class="no-border right-text">B</td>
		<td colspan="4" class="left-text">TOTAL DEDUCTIONS</td>
		<td ><?php echo $TOTAL_DEDUCTIONS;?></td>
		<td class="no-border"></td>
		<td class="no-border"></td>
	</tr>
	<tr class="no-border">
		<td colspan="2" class="no-border"></td>
		<td colspan="4" class="left-text no-border"></td>
		<td class="no-border"></td>
		<td class="no-border"></td>
		<td colspan="3" class="left-text">Govt. CPF contr. 80CCD(2)</td>
		<td><?php echo $TOTAL_CPF_GOVT;?></td>
	</tr>
	<tr class="no-border">
		<td colspan="2" class="no-border right-text">A-B</td>
		<td colspan="4" >TOTAL TAXABLE INCOME</td>
		<td><?php echo $TOTAL_TAXABLE_INCOME;?></td>
		<td class="no-border"></td>
		<td colspan="3" class="left-text">TOTAL - EXEMPTION</td>
		<td><?php echo $NET_SAVING_80C;?></td>
	</tr>
	<tr class="no-border">
		<td colspan="2" class="no-border"></td>
		<td colspan="4" >(Rounded off to nearest Ten Rupees)</td>
		<td><?php echo $TOTAL_TAXABLE_INCOME_ROUNDED;?></td>
		<td colspan="4" class="no-border"></td>
	</tr>
	<tr class="no-border">
		<td colspan="7" class="no-border">&nbsp;</td>
	</tr>
	<tr class="no-border">
		<td colspan="3" class="no-border"></td>
		<td colspan="3"  class="no-border"></td>
		<td class="no-border"></td>
		<td class="no-border"></td>
		<td colspan="3" class="left-text">Tax Rebate Under Sec 87</td>
		<td><?php echo $TAX_REBATE_UNDER_87;?></td>
	</tr>
	<tr class="no-border">
		<td colspan="7" class="no-border">&nbsp;</td>
	</tr>
	<tr class="no-border">
		<td colspan="5" class="left-text no-border">INCOME TAX RATES</td>
		<td colspan="2">IT</td>
	</tr>
	<tr class="no-border">
		<td colspan="2" class="left-text">Upto Rs.2,50,000/-</td>
		<td class="no-border"><?php echo $FIRST_SLAB_INCOME;?></td>
		<td class="no-border">x</td>
		<td class="no-border">NIL</td>
		<td colspan="2"><?php echo $FIRST_SLAB_TAX;?></td>
		<td class="no-border"></td>
		<td colspan="3" class="left-text">INCOME TAX PAYABLE</td>
		<td><?php echo $TOTAL_TAX_AFTER_REBATE;?></td>
	</tr>
	<tr class="no-border">
		<td colspan="2" class="left-text">2,50,001/- to 5,00,000/-</td>
		<td class="no-border"><?php echo $SECOND_SLAB_INCOME;?></td>
		<td class="no-border">x</td>
		<td class="no-border">5%</td>
		<td colspan="2"><?php echo $SECOND_SLAB_TAX;?></td>
		<td class="no-border"></td>
		<?php if(Yii::app()->session['FINANCIAL_YEAR'] == 1){ ?>
		<td colspan="3" class="left-text">3%  Education Cess</td>
		<?php } else {?>
		<td colspan="3" class="left-text">4%  Education Cess</td>
		<?php } ?>
		<td><?php echo $TOTAL_TAX_AFTER_REBATE_WITH_CESS;?></td>
	</tr>
	<tr class="no-border">
		<td colspan="2" class="left-text">5,00,001/- to 10,00,000/-</td>
		<td class="no-border"><?php echo $THIRD_SLAB_INCOME;?></td>
		<td class="no-border">x</td>
		<td class="no-border">20%</td>
		<td colspan="2"><?php echo $THIRD_SLAB_TAX;?></td>
		<td class="no-border"></td>
		<td colspan="3" class="left-text">Gross Tax Payable</td>
		<td><?php echo $GROSS_TAX_PAYABLE;?></td>
	</tr>
	<tr class="no-border">
		<td colspan="2" class="left-text">10,00,001/- & above</td>
		<td class="no-border"><?php echo $FOURTH_SLAB_INCOME;?></td>
		<td class="no-border">x</td>
		<td class="no-border">30%</td>
		<td colspan="2"><?php echo $FOURTH_SLAB_TAX;?></td>
	</tr>
	<tr class="no-border">
		<td colspan="2" class="left-text">Taxable Income :-</td>
		<td colspan="2" ><?php echo $TOTAL_SLAB_INCOME;?> IT:-</td>
		<td colspan="3" ><?php echo $TOTAL_SLAB_TAX;?></td>
	</tr>
	<tr class="no-border">
		<td colspan="6" class="no-border">&nbsp;</td>
		<td class="no-border"></td>
		<td class="no-border"></td>
		<td colspan="4" class="left-text">Note:-</td>
	</tr>
	<tr class="no-border">
		<td colspan="5" class="left-text">TOTAL TAX PAYABLE</td>
		<td><?php echo $GROSS_TAX_PAYABLE;?></td>
		<td class="no-border"></td>
		<td class="no-border"></td>
		<td colspan="4" class="left-text">1.The above calculations are provisional only</td>
	</tr>
	<tr class="no-border">
		<td colspan="5" class="left-text">TAX PAID FROM SALARY</td>
		<td><?php echo $TAX_PAID_FROM_SALARY;?></td>
		<td class="no-border"></td>
		<td class="no-border"></td>
		<td colspan="4" class="left-text">2. Discrepancies if any may be brought to the notice of the DDO immediately.</td>
	</tr>
	<tr class="no-border">
		<td colspan="5" class="left-text"><?php echo $TAX_REMAINING_TEXT;?></td>
		<td><?php echo $TAX_REMAINING;?></td>
		<td class="no-border"></td>
		<td class="no-border"></td>
		<td colspan="4" class="left-text">3. Claims for exemptions will not be considered without documentary evidence</td>
	</tr>
	<tr class="no-border">
		<td colspan="6" class="no-border"></td>
		<td colspan="2" class="no-border"></td>
	</tr>
</table>
<table>
</table>

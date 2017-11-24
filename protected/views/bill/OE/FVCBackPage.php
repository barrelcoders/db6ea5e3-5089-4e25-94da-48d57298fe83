<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/oneadmin.css" rel="stylesheet">
<?php $master = Master::model()->findByPK(1); ?>
<style>
	td{
		padding: 10px;
		min-height:300px;
	}
</style>

<table class="one-table">
	<tr>
		<th style="width: 20%;">Number of <br>Sub - Voucher </th>
		<th style="width: 70%;">Description of charges and number and date of authority for all charges requiring special sanction</th>
		<th  style="width: 10%;" colspan="2">Amount<br> Rs. &nbsp;&nbsp;&nbsp;P.</th>
	</tr>
	<tr>
		<td style="vertical-align: top; height: 100px;"></td>
		<td style="vertical-align: top;"></td>
		<td style="vertical-align: top;"></td>
		<td style="vertical-align: top;"></td>
	</tr>
</table>
<br>
<p>1) I certify that the expenditure charged in this bill could not, with due regard to the interests of the public service, be avoided. I 
certify that, to the best of my knowledge and belief, the payments entered in this bill have been duly made to the parties entitled to
 received them with the exceptions noted below, which exceed the balance of the permanent advance, and will be paid on receipt of
 the money drawn on this bill. Vouchers for all sums above Rs.</p>
<p>500 in amount are attached to this bill save those noted below, which will be forwarded as soon as the amounts have been paid. I 
have as far as possible obtained vouchers for other sums and am responsible that they have been so cancelled that they cannot be 
used again. All bills to be paid by book transfer are annexed.</p>
<p>I also certified that the amounts on account of pay and allowances of the Group 'D' Government servants drawn 1 mount/2 months/3 
months previous to this date with the execeptions of those detaioled below of which the total amount has veen refunded by 
deduction from this bill have been disbursed to the Government Servants concerned and their receipts taken.</p>

<p>2) Certified that all the articles detailed in the vouchers attached to the bill and in those retained in my officer have been accounted
 for in the stock register.</p>
<p>3) Certified that the purchases billed for have been received in good order, that their quatities are correct and their quality good and
 according to specifcation, theat the raise paid are not in excess of the accepted and the market rates and the suitable noted of 
payment have been recorded against the indents and invoices concerned to prevent doutile payments.</p>
<p>4) certified that-</p>
<p>   (a) The expenditur on conveyance hire included in this bill was actually incurred, as unavoidable and is within the scheduled 
scale of chargs for the conveyance used, and</p>
<p style="padding-bottom: 10px;border-bottom: 1px solid #000;">   (b) The Government servant concerned is not entitiled to draw travelling allowance under the ordinary rules for the journey, and is 
not granted any compensatory leave </p><br>

<p style="text-align: right;">Received Payment</p>
<?php
	$Appropriation = AppropiationRegister::model()->find('BILL_NO='.$model->ID);
?>
<p>Appropriation for the current year <span style="text-decoration: underline">Rs. <?php echo Budget::model()->findByPK(2)->AMOUNT;?>/-</span></p>
<p>Expenditure including this bill: <span style="text-decoration: underline">Rs. <?php echo "............................."; //echo $Appropriation->EXPENDITURE_INC_BILL;?>/-</span></p>
<p>Amount of work bill annexed: <span style="text-decoration: underline">Rs. <?php echo "............................."; //echo $model->BILL_AMOUNT;?>/-</span></p>	
<p>Balance available: <span style="text-decoration: underline">Rs. <?php echo "............................."; //echo $Appropriation->BALANCE;?>/-</span></p>
<p style="text-align: right;">Signature & Designation</p>
<p style="text-align: right;padding-bottom: 10px;border-bottom: 1px solid #000;">of the Drawing Officer</p>
<p style="padding-top:10px">Passed for the payment of Rs.<span style="text-decoration: underline"><?php echo $model->BILL_AMOUNT;?></span> Rupees <span style="text-decoration: underline"><?php echo $this->amountInWords?></span></p>

<p style="text-align: right;">Payment By</p>
<p style="text-align: right;">Cheque No. ..........................................</p>
<p style="text-align: right;">Pay and Account Officer</p>
<p style="text-align: right;">Cheque Drawing D. D. O.</p>
<p style="text-align: left;padding-bottom: 10px;border-bottom: 1px solid #000;">Date...............................................</p>
<p style="text-align: center;padding-top:10px"><b>For the use in Pay and Accounts Office<br>(Post - Check)</b></p>
<p style="text-align: left;">Admitted for Rs........................................</p>
<p style="text-align: left;">Objected to Rs..............................................</p>
<p style="text-align: left;">Reason of Objection ...............................................</p>
<div>
	<span style="text-align: left;">Jr. /Sr. Accountant</span>
	<span style="position: absolute;left: 50%;">Jr. A.O.</span>
	<span style="text-align: left;float: right;">Pay and Account Officer</span>
</div>
<script type="text/javascript">window.onload = function() { window.print(); }</script><style>

                                                                                                                   
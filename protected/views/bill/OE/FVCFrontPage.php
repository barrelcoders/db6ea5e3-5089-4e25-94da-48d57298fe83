<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/oneadmin.css" rel="stylesheet">
<?php $master = Master::model()->findByPK(1); ?>
<style>
	td{
		padding: 10px;
		min-height:300px;
	}
</style>
<div style="position: relative;height: 50px;">
	<div style="position: absolute;left: 0;">
		<p>G.A.R. 29</p>	
		<p>T.R. 30</p>
	</div>
	<div style="position: absolute;right: 0;">CENTRAL</div>
</div>
<div style="text-align: center;font-weight: bold;"><h1>FULLY VOUCHED CONTINGENT BILL</h1></div>
<div style="text-align: center;">[See Rules 113, 114, 115(2) & 126(2) of Central Government Account (Receipts & Paymnts) Rules)]</div>
<div style="text-align: center;">[See Rules 306 of Central treasury Rules]</div>
<br><br>
<div style="text-align: center;"><span style="font-weight: bold;">BILL NO: </span><span style="text-decoration: underline"><?php echo $model->PFMS_BILL_NO;?>	(<?php echo $model->BILL_NO;?>)</span></div>		
<br><br>
<div><span style="font-weight: bold;">Ministry/Department/ Office of:  </span><span style="text-decoration: underline"><?php echo $master->OFFICE_NAME;?></span></div>	<br>
<div ><span style="font-weight: bold;">Detailed Bill of Contigent Charges for the month of </span><span style="text-decoration: underline"><?php echo date('M-Y', strtotime($model->CREATION_DATE));?></span></div>	<br>
<div><span style="font-weight: bold;">Head of Account  </span><span style="text-decoration: underline"><?php echo BillType::model()->findByPK($model->BILL_TYPE)->TYPE;?></span></div><br>
<table class="one-table">
	<tr>
		<th style="width: 20%;">Number of <br>Sub - Voucher </th>
		<th style="width: 70%;">Description of charges nd number and date of authority for all charges requiring special sanction</th>
		<th  style="width: 10%;" colspan="2">Amount<br> Rs. &nbsp;&nbsp;&nbsp;P.</th>
	</tr>
	<tr>
		<td style="vertical-align: top; height: 500px;"><b>Bill Enclosed</b><br><br>
		<?php 
			$OEBills = OEBills::model()->findAllByAttributes(array('BILL_ID'=>$model->ID));
			foreach($OEBills as $bill)
				echo $bill->NUMBER. " dt. ". date('d/m/Y', strtotime($bill->DATE))."<br><br>";
		?>
		<p style="font-weight:bold;transform: rotate(90deg);     margin-top: 220px;"><?php echo $this->amountLessthanInWords;?></p>
		</td>
		<td style="vertical-align: top;position:relative">Payment being made towards <b><?php echo $model->BILL_TITLE;?></b><br/><br/>
		<b><?php echo $this->amountInWords;?></b><br/><br/><br/>
		Cheque may be issued in favor of : <b>M/S <?php echo Vendors::model()->findByPK($model->VENDOR_ID)->NAME;?></b>
		<?php if(OEBillDetails::model()->exists('BILL_ID_FK='.$model->ID)){ ?>
			<span style="position: absolute;right: 10px;top: 260px;"><b>IT@2%</b></span>
			<span style="position: absolute;right: 10px;top: 300px;"><b>Amount Payable</b></span>
			<span style="position: absolute;right: 10px;top: 340px;"><b>[<?php echo $this->amountToWord(OEBillDetails::model()->findByAttributes(array('BILL_ID_FK'=>$model->ID))->NET_AMOUNT)?>]</b></span>
		<?php }?>
		<span style="position: absolute;right: 10px;bottom: 10px;"><b>Carried Over...</b></span>
		</td>
		<td style="vertical-align: top;position:relative">
			<?php echo $model->BILL_AMOUNT;?><span style="display: block;margin-top: 200px;"><?php echo $model->BILL_AMOUNT;?>
			<?php if(OEBillDetails::model()->exists('BILL_ID_FK='.$model->ID)){ ?>
				<span style="display: block;margin-top: 20px;"></span><?php echo OEBillDetails::model()->findByAttributes(array('BILL_ID_FK'=>$model->ID))->IT_DED;?>
				<span style="display: block;margin-top: 20px;"></span><?php echo OEBillDetails::model()->findByAttributes(array('BILL_ID_FK'=>$model->ID))->NET_AMOUNT;?>
			<?php }?>
			
			<span style="border-bottom: 1px solid;width: 180px;position: absolute;transform: rotate(111deg);top: 115px;left: -46px;"></span>
			<span style="border-bottom: 1px solid;width: 80px;position: absolute;top: 209px;left: 0px;"></span>
			<span style="border-bottom: 1px solid;width: 80px;position: absolute;top: 254px;left: 0px;"></span>
		</td>
		<td style="vertical-align: top;position:relative">00<span  style="display: block;margin-top: 200px;">00</span>
			<?php if(OEBillDetails::model()->exists('BILL_ID_FK='.$model->ID)){ ?>
				<span style="display: block;margin-top: 20px;">00</span>
				<span style="display: block;margin-top: 20px;">00</span>
				<span style="border-bottom: 1px solid;width: 80px;position: absolute;top: 280px;left: -50px;"></span>
			<?php }?>
		</td>
	</tr>
</table>
<p style="text-align:right"></p>
<script type="text/javascript">window.onload = function() { window.print(); }</script><style>
	
		
	
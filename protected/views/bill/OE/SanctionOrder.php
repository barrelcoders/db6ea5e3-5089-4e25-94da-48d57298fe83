<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/oneadmin.css" rel="stylesheet">
<?php $master = Master::model()->findByPK(1); ?>
<div class="one-header">
	<img src='images/logo.jpg'/>	
	<div>
		<p>भारत सरकार । वित्त मंत्रालय । राजस्व विभाग । </p>
		<p>Government of India | Ministry of Finance | Department of Revenue</p>
		<p><?php echo $master->OFFICE_NAME_HINDI;?></p>
		<p><?php echo $master->OFFICE_NAME;?></p>
		<p><?php echo $master->OFFICE_ADDRESS_HINDI;?></p>
		<p><?php echo $master->OFFICE_ADDRESS;?></p>
	</div>
</div>
<div style="clear:both; height: 20px;position: relative; font-weight: bold;">
	<span class="left"><b>सी.सं./File No.<?php echo $model->FILE_NO;?></b></span>
	<span style="position: absolute;left: 50%;margin-left: -50px; font-weight: bold;"><b><?php echo $model->CER_NO;?></b></span>
	<span style="position: absolute; right: 0;"><b>दिनांक/Date: <?php echo date('d/m/Y', strtotime($model->CREATION_DATE));?></b></span>
</div>
<br>
<div style="text-align: center;">
	<h4><b>मंजुरी आदेश./SANCTION ORDER</b></h4>
</div>
<br>
<p style="margin-bottom: 4px;">1.      निम्नलिखित व्यय हेतु सहायक आयुक्त,येलाहंका सेवा कर मंडल ,बेंगलूर IV आयुक्तालय की मंजूरी एतद द्वारा सूचित की जाती है</p>
<p style="margin-bottom: 4px;">Sanction of the Assistant Commissioner of Yelahanka Service Tax Division, Bangalore-IV Commissionerate for an expenditure of <b>Rs.<?php echo $model->BILL_AMOUNT;?>/- <?php echo $this->amountInWords;?></b>
 is hereby conveyed being the charges towards  purchace of <b><?php echo $model->BILL_TITLE;?> in respect of Yelahanka Service Tax Division, Bangalore-IV Commissionerate</b>. </p>
<p style="margin-bottom: 4px;">2. वित्तीयशक्तियोंकाप्रत्यायोजननियम1978कानियम13(i)केअधीनप्रदत्तशक्तियों काप्रयोगकरतेहुएउपर्युक्त मंजूरीदीगईहै।</p>
<p style="margin-bottom: 4px;">The above sanction is issued in exercise of the powers vested in him/her under rule (14) of the Delegation of Financial power Rules, 1978.  </p>
<p style="margin-bottom: 4px;">3. वित्तीयशक्तियोंकाप्रत्यायोजननियम1978कीअनुसूचीV,कार्यालयप्रधानकीशक्तियोंकेअधीनप्रदत्तशक्तियोंकाप्रयोगकरतेहुएउपर्युक्तमंजूरीदीगईहै <br>(इसकार्यालयकाप्र.स्था.आ.सं.15/83दिनांक15.6.83,जिसकेद्वाराअपरआयुक्त (का.एवंसत.)का कार्यालयप्रधानबनानेकीघोषणाकीगईथी,कासंदर्भलें।</p>
<p style="margin-bottom: 4px;">The above sanction is issued in exercise of powers vested in him/her under Schedule V of the Delegation of Financial Power Rules, 1978, under the powers of Head of Office, 
(this office C.No. II/18/1/2014 Accts. BIV dated 16/04/2015, declaring Asst/Deputy Commissioner of Yelahanka Service Tax Division as Head of Office refers).</p>
<p style="margin-bottom: 4px;">4. भारतसरकार,वित्तमंत्रालय,राजस्वविभागकेपत्रएपसं.7/12/59समन्वय (169)केअधीनप्रदत्त शक्तियोंकाप्रयोगकरतेहुएउपर्युक्तमंजूरीदीगईहै।</p>
<p style="margin-bottom: 4px;">The above sanction is issued in exercise of the powers vested in him/her vide Govt. of India, Ministry of Finance, Department of Revenue’s letter F.No.7/12/59 Co-ord (169).</p>
<p style="margin-bottom: 4px;">5. उपर्युक्तव्ययकोमुख्यशीर्ष2038-युईडी,उपशीर्षमेंनामेडालनाहै।</p>
<p style="margin-bottom: 4px;">The above expenditure is debitable to the Major Head 2038–UED, under  sub-head</p>
<br>
<div style="text-align: center;">
	<h4><b>कार्यालय व्यय/Office Expense.</b></h4>
</div>	
<p style="margin-bottom: 4px;">बी.2(1)(1)(5)अन्य,चालूवित्तीयवर्षकेलिएमंजूरअनुदानकेअंदरहीखर्चकोनिपटानाहै।</p>
<p style="margin-bottom: 4px;">B. 2(1)(1)(5) Others and should be met within the sanctioned grants of the current financial year 2016-17</p>
<p style="margin-bottom: 4px;">6.केनामपरअकाउँटपेयीचैक/डिमांड ड्राफटकटवाएं।</p>
<p style="margin-bottom: 4px;">A/c payee Cheque / Demand Draft may be drawn in favourof: <b>M/s <?php echo Vendors::model()->findByPK($model->VENDOR_ID)->NAME;?></b>.</p>
<br>
<div style="text-align: center;">
	<h4><b>Mandate Form Enclosed.</b></h4>
</div>						
<p style="margin-bottom: 4px;">7.रकमआहरणकरकेनिम्नलिखितकोदें</p>
<p style="margin-bottom: 4px;">The amount may please be drawn and paid to:</p>

<div style="font-weight: bold;clear: both;">
	<div style="float:right;margin-right: 50px;text-align:center;width:250px;margin-bottom:10px;">
		<p>(<?php echo Employee::model()->findByPK($master->DEPT_ADMIN_EMPLOYEE)->NAME_HINDI;?>)</p>
		<p><?php echo Designations::model()->findByPK(Employee::model()->findByPK($master->DEPT_ADMIN_EMPLOYEE)->DESIGNATION_ID_FK)->DESIGNATION_HINDI;?> </p>
		<p><?php echo $master->DEPT_NAME_HINDI;?></p>
	</div>
</div>
<table class="one-table" cellmargin="10" style="display: block; clear: both;">
	<thead>
		<tr>
			<th>क्रमसं.<br>Sl .No.</th>
			<th>बिलसं.<br>Bill/Receipt No.</th>
			<th>बिलदिनांक<br>Bill Date</th>
			<th>रकम<br>Bill Amount </th>
		</tr>
	</thead>
	<tbody>
	<?php
		$i=0;
		$OEBills = OEBills::model()->findAllByAttributes(array('BILL_ID'=>$model->ID));
		foreach($OEBills as $bill){
			$i++;
			?>
			<tr>
				<td><?php echo $i;?></td>
				<td style="text-align: center;"><?php echo $bill->NUMBER;?></td>
				<td style="text-align: center;"><?php echo date('d/m/Y', strtotime($bill->DATE));?></td>
				<td style="text-align: center;"><?php echo $bill->AMOUNT;?></td>
			</tr>
			<?php
		}
		if(OEBillDetails::model()->find('BILL_ID_FK='.$model->ID)->IT_DED > 0){
			?>
				<tr>
					<td></td>
					<td style="text-align: center;"></td>
					<td style="text-align: center;">IT </td>
					<td style="text-align: center;"><?php echo OEBillDetails::model()->find('BILL_ID_FK='.$model->ID)->IT_DED;?></td>
				</tr>
			<?php
		}
	?>	
	<tr>
		<td colspan="3" style="text-align: right;padding-right: 50px;"><b>Total<b></td>
		<?php if(OEBillDetails::model()->find('BILL_ID_FK='.$model->ID)->IT_DED > 0){ ?>
		<td style="text-align: center;"><?php echo OEBillDetails::model()->find('BILL_ID_FK='.$model->ID)->NET_AMOUNT;?></td>
		<?php } else { ?>
		<td style="text-align: center;"><?php echo $model->BILL_AMOUNT;?></td>
		<?php } ?>
	</tr>
	</tbody>
</table>
<br>
<p style="text-align: center;"><b><?php echo $this->amountToWord(OEBillDetails::model()->find('BILL_ID_FK='.$model->ID)->NET_AMOUNT);?></b></p><script type="text/javascript">window.onload = function() { window.print(); }</script><style>

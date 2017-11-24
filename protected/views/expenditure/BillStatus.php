<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/oneadmin.css" rel="stylesheet">
<?php
	
	$monthName = array('1'=>'January', '2'=>'February', '3'=>'March', '4'=>'April', '5'=>'May', '6'=>'June', '7'=>'July', '8'=>'August', '9'=>'September', '10'=>'October', '11'=>'November', '12'=>'December');
	$monthNameHindi = array('1'=>'जनवरी', '2'=>'फ़रवरी', '3'=>'मार्च', '4'=>'अप्रैल', '5'=>'मई', '6'=>'जून', '7'=>'जुलाई', '8'=>'अगस्त', '9'=>'सितंबर', '10'=>'अक्टूबर', '11'=>'नवंबर', '12'=>'दिसंबर'); 
	$master = Master::model()->findByPK(1);
?>
<style>
	h1{font-size: 20px;font-weight: bold;}
	th,h1{text-align: center;}
	th{font-weight: bold;}
	.one-table tr, .one-table td, .one-table th {width: auto;}
	td{text-align: center;}
</style>
<?php $master = Master::model()->findByPK(1); ?>
<h1>Bill Status Summary in R/O <?php echo $master->DEPT_NAME;?>(<?php echo $master->DEPT_NAME_HINDI;?>) upto the month of <?php echo $monthName[strVal($this->Month)];?>-<?php echo $this->Year;?></h1>
<br><br>
<table class="one-table" cellmargin="10" style="display: block; clear: both;">
	<thead>
		<tr>
			<th>S.No</th>
			<th>Bill Number</th>
			<th>Bill Description</th>
			<th>Amount</th>
			<th>Status</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<th></th>
			<th>HEAD</th>
			<th>SALARIES</th>
			<th></th>
			<th></th>
		</tr>
		<?php
			$i=1;
			$financialYear = FinancialYears::model()->find('STATUS=1');
			$criteria=new CDbCriteria;
			$criteria->condition = "CREATION_DATE >= '".date('Y-m-d', strtotime($financialYear->START_DATE))."' AND CREATION_DATE <= '".date('Y-m-t',strtotime(date_create($this->Year."-".$this->Month)->format('Y-m-d')))."'";
			$criteria->compare("PFMS_STATUS",'Generated');
			$criteria->addInCondition("BILL_TYPE",array(1,2));
				
			$bills = Bill::model()->findAll($criteria);
			$total = 0;
			if(count($bills) > 0) {
				foreach($bills as $bill){
			?>
				<tr <?php if($bill->PFMS_STATUS == 'Generated') echo "style='background:#CCC;'"?>>
					<td width="5%"><?php echo $i;?></td>
					<td width="20%"><?php echo $bill->BILL_NO."<br/>".$bill->PFMS_BILL_NO;?></td>
					<td width="50%"><?php echo $bill->BILL_TITLE;?></td>
					<td width="10%"><?php echo $bill->BILL_AMOUNT;?></td>
					<td width="15%"><?php echo ($bill->IS_GENERATED) ? 'Pending' : 'Passed';?></td>
				</tr>
			<?php
				$total = $total + $bill->BILL_AMOUNT;
					$i++;
				}
			}
		?>
		<tr>
			<th></th>
			<th></th>
			<th>TOTAL</th>
			<th><?php echo $total;?></th>
			<th></th>
		</tr>
		<tr>
			<th>&nbsp;</th>
			<th></th>
			<th></th>
			<th></th>
			<th></th>
		</tr>
		<tr>
			<th></th>
			<th>HEAD</th>
			<th>OFFICE EXPENDITURE</th>
			<th></th>
			<th></th>
		</tr>
		<?php
			$i=1;
			$financialYear = FinancialYears::model()->find('STATUS=1');
			$criteria=new CDbCriteria;
			$criteria->condition = "CREATION_DATE >= '".date('Y-m-d', strtotime($financialYear->START_DATE))."' AND CREATION_DATE <= '".date('Y-m-t',strtotime(date_create($this->Year."-".$this->Month)->format('Y-m-d')))."'";
			$criteria->compare("PFMS_STATUS",'Generated');
			$criteria->addInCondition("BILL_TYPE",array(3));
			$bills = Bill::model()->findAll($criteria);
			$total = 0;
			if(count($bills) > 0) {
				foreach($bills as $bill){
			?>
				<tr>
					<td><?php echo $i;?></td>
					<td width="20%"><?php echo $bill->BILL_NO."<br/>".$bill->PFMS_BILL_NO;?></td>
					<td><?php echo $bill->BILL_TITLE;?></td>
					<td><?php echo $bill->BILL_AMOUNT;?></td>
					<td><?php echo ($bill->PFMS_STATUS == 'Generated') ? 'Pending' : 'Passed';?></td>
				</tr>
			<?php
					$total = $total + $bill->BILL_AMOUNT;
					$i++;
				}
			}
		?>
		<tr>
			<th></th>
			<th></th>
			<th>TOTAL</th>
			<th><?php echo $total;?></th>
			<th></th>
		</tr>
		<tr>
			<th>&nbsp;</th>
			<th></th>
			<th></th>
			<th></th>
			<th></th>
		</tr>
		<tr>
			<th></th>
			<th>HEAD</th>
			<th>DOMESTIC TRAVEL EXPENCE</th>
			<th></th>
			<th></th>
		</tr>
		<?php
			$i=1;
			
			$financialYear = FinancialYears::model()->find('STATUS=1');
			$criteria=new CDbCriteria;
			$criteria->condition = "CREATION_DATE >= '".date('Y-m-d', strtotime($financialYear->START_DATE))."' AND CREATION_DATE <= '".date('Y-m-t',strtotime(date_create($this->Year."-".$this->Month)->format('Y-m-d')))."'";
			$criteria->compare("PFMS_STATUS",'Generated');
			$criteria->addInCondition("BILL_TYPE",array(4));
			$bills = Bill::model()->findAll($criteria);
			$total = 0;
			if(count($bills) > 0) {
				foreach($bills as $bill){
			?>
				<tr>
					<td><?php echo $i;?></td>
					<td width="20%"><?php echo $bill->BILL_NO."<br/>".$bill->PFMS_BILL_NO;?></td>
					<td><?php echo $bill->BILL_TITLE;?></td>
					<td><?php echo $bill->BILL_AMOUNT;?></td>
					<td><?php echo ($bill->PFMS_STATUS == 'Generated') ? 'Pending' : 'Passed';?></td>
				</tr>
			<?php
					$total = $total + $bill->BILL_AMOUNT;
					$i++;
				}
			}
		?>
		<tr>
			<th></th>
			<th></th>
			<th>TOTAL</th>
			<th><?php echo $total;?></th>
			<th></th>
		</tr>
		<tr>
			<th>&nbsp;</th>
			<th></th>
			<th></th>
			<th></th>
			<th></th>
		</tr>
		<tr>
			<th></th>
			<th>HEAD</th>
			<th>MEDICAL</th>
			<th></th>
			<th></th>
		</tr>
		<?php
			$i=1;
			$financialYear = FinancialYears::model()->find('STATUS=1');
			$criteria=new CDbCriteria;
			$criteria->condition = "CREATION_DATE >= '".date('Y-m-d', strtotime($financialYear->START_DATE))."' AND CREATION_DATE <= '".date('Y-m-t',strtotime(date_create($this->Year."-".$this->Month)->format('Y-m-d')))."'";
			$criteria->compare("PFMS_STATUS",'Generated');
			$criteria->addInCondition("BILL_TYPE",array(6));
			$bills = Bill::model()->findAll($criteria);
			$total = 0;
			if(count($bills) > 0) {
				foreach($bills as $bill){
			?>
				<tr>
					<td><?php echo $i;?></td>
					<td width="20%"><?php echo $bill->BILL_NO."<br/>".$bill->PFMS_BILL_NO;?></td>
					<td><?php echo $bill->BILL_TITLE;?></td>
					<td><?php echo $bill->BILL_AMOUNT;?></td>
					<td><?php echo ($bill->PFMS_STATUS == 'Generated') ? 'Pending' : 'Passed';?></td>
				</tr>
			<?php
					$total = $total + $bill->BILL_AMOUNT;
					$i++;
				}
			}
		?>
		<tr>
			<th></th>
			<th></th>
			<th>TOTAL</th>
			<th><?php echo $total;?></th>
			<th></th>
		</tr>
		<tr>
			<th>&nbsp;</th>
			<th></th>
			<th></th>
			<th></th>
			<th></th>
		</tr>
		<tr>
			<th></th>
			<th>HEAD</th>
			<th>WAGES</th>
			<th></th>
			<th></th>
		</tr>
		<?php
			$i=1;
			$financialYear = FinancialYears::model()->find('STATUS=1');
			$criteria=new CDbCriteria;
			$criteria->condition = "CREATION_DATE >= '".date('Y-m-d', strtotime($financialYear->START_DATE))."' AND CREATION_DATE <= '".date('Y-m-t',strtotime(date_create($this->Year."-".$this->Month)->format('Y-m-d')))."'";
			$criteria->compare("PFMS_STATUS",'Generated');
			$criteria->addInCondition("BILL_TYPE",array(8));
			$bills = Bill::model()->findAll($criteria);
			$total = 0;
			if(count($bills) > 0) {
				foreach($bills as $bill){
			?>
				<tr>
					<td><?php echo $i;?></td>
					<td width="20%"><?php echo $bill->BILL_NO."<br/>".$bill->PFMS_BILL_NO;?></td>
					<td><?php echo $bill->BILL_TITLE;?></td>
					<td><?php echo $bill->BILL_AMOUNT;?></td>
					<td><?php echo ($bill->PFMS_STATUS == 'Generated') ? 'Pending' : 'Passed';?></td>
				</tr>
			<?php
					$total = $total + $bill->BILL_AMOUNT;
					$i++;
				}
			}
		?>
		<tr>
			<th></th>
			<th></th>
			<th>TOTAL</th>
			<th><?php echo $total;?></th>
			<th></th>
		</tr>
	</tbody>
</table>
<script type="text/javascript">window.onload = function() { window.print(); }</script><style>
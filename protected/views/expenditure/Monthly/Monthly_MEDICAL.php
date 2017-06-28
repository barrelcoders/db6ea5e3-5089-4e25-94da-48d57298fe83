<?php require_once "/../../../../include/ExpenditureReportInclude.php";?>
<?php
	$monthName = array('1'=>'January', '2'=>'February', '3'=>'March', '4'=>'April', '5'=>'May', '6'=>'June', '7'=>'July', '8'=>'August', '9'=>'September', '10'=>'October', '11'=>'November', '12'=>'December');
	$monthNameHindi = array('1'=>'जनवरी', '2'=>'फ़रवरी', '3'=>'मार्च', '4'=>'अप्रैल', '5'=>'मई', '6'=>'जून', '7'=>'जुलाई', '8'=>'अगस्त', '9'=>'सितंबर', '10'=>'अक्टूबर', '11'=>'नवंबर', '12'=>'दिसंबर'); 
	$master = Master::model()->findByPK(1); ?>
<p style="font-size: 20px;text-align: center;font-weight: bold;">अनुबंध - I ए चिकित्सा/ ANNEXURE - IA - MEDICAL</p>
<span style="font-size: 15px;font-weight: bold;"><?php echo $master->OFFICE_NAME_HINDI;?><br><?php echo $master->OFFICE_NAME;?></span>
<div style="float: right;font-weight: bold;">
	<p>MAJOR HEAD : 2038 Union Excise Duties</p>
	<p>MINOR HEAD : B.2(2) Other Offices.</p>
</div>
<p style="font-size: 15px;text-align: center;font-weight: bold;"><?php echo $monthNameHindi[$this->Month]?> -<?php echo $this->Year?> माह के लिए मासिक व्यय विवरण/MONTHLY EXPENDITURE STATEMENT FOR THE MONTH OF - <?php echo $monthName[$this->Month]?> <?php echo $this->Year?></p>
<br><br>
<table class="one-table" >
	<thead>
		<tr>
			<th>Sl.NO</th>
			<th>बिल सं. एवं दिनांक/ Bill No. and Date</th>
			<th>RE-IMB MEDICAL ALLOWANCE</th>
			<th>GROSS MEDICAL ALLOWANCE</th>
		</tr>
		<tr>
			<th>1</th>
			<th>2</th>
			<th>3</th>
			<th>4</th>
		</tr>
	</thead>
	
	<tbody>
		<?php 
		$criteria=new CDbCriteria;        
		$criteria->compare("MONTH(PASSED_DATE)",$this->Month);
		$criteria->compare("YEAR(PASSED_DATE)",$this->Year);
		$criteria->compare("PFMS_STATUS",'Passed');
		$criteria->addInCondition("BILL_TYPE",array(6));
		$Bills = Bill::model()-> findAll($criteria);
		$billsArray = array(); 
			$i=1;
		foreach($Bills as $bill){
				array_push($billsArray, $bill->ID); ?>
			<tr>
				<td><?php echo $i;?></td>
				<td><?php echo $bill->BILL_NO;?></td>
				<td><?php echo $bill->BILL_AMOUNT;?></td>
				<td><?php echo $bill->BILL_AMOUNT;?></td>
			</tr>
		<?php 
			$i++; 
		}
		if(count($billsArray) > 0){		
		?>
		<tr>
			<td colspan="2">TOTAL</td>
			<td><?php echo Yii::app()->db->createCommand("SELECT SUM(BILL_AMOUNT) AS TOTAL FROM tbl_bill WHERE ID IN (".implode($billsArray, ',').") AND BILL_TYPE=6")->queryRow()['TOTAL'];?></td>
			<td><?php echo Yii::app()->db->createCommand("SELECT SUM(BILL_AMOUNT) AS TOTAL FROM tbl_bill WHERE ID IN (".implode($billsArray, ',').") AND BILL_TYPE=6")->queryRow()['TOTAL'];?></td>
		</tr>
		<?php } else {?>
		<tr>
			<td colspan="2">TOTAL</td>
			<td>0</td>
			<td>0</td>
		</tr>
		<?php } ?>
		<tr>
			<td colspan="2">Amount Re-Credited</td>
			<td>0</td>
			<td>0</td>
		</tr>
		<?php if(count($billsArray) > 0){ ?>
		<tr>
			<td colspan="2">NET TOTAL</td>
			<td><?php echo Yii::app()->db->createCommand("SELECT SUM(BILL_AMOUNT) AS TOTAL FROM tbl_bill WHERE ID IN (".implode($billsArray, ',').") AND BILL_TYPE=6")->queryRow()['TOTAL'];?></td>
			<td><?php echo Yii::app()->db->createCommand("SELECT SUM(BILL_AMOUNT) AS TOTAL FROM tbl_bill WHERE ID IN (".implode($billsArray, ',').") AND BILL_TYPE=6")->queryRow()['TOTAL'];?></td>
		</tr>
		<?php } else {?>
		<tr>
			<td colspan="2">NET TOTAL</td>
			<td>0</td>
			<td>0</td>
		</tr>
		<?php } ?>
		
		<?php
			$financialYear = FinancialYears::model()->find('STATUS=1');
			$criteria=new CDbCriteria;
			$criteria->condition = "PASSED_DATE >= '".date('Y-m-d', strtotime($financialYear->START_DATE))."' AND PASSED_DATE <= '".date_create($this->Year."-".$this->Month." last day of last month")->format('Y-m-d')."'";
			$criteria->compare("PFMS_STATUS",'Passed');
			$criteria->addInCondition("BILL_TYPE",array(6));
			$bills = Bill::model()-> findAll($criteria);
			$tpmbillsArray = array();
			foreach($bills as $bill)
				array_push($tpmbillsArray, $bill->ID);
			
			$queryCondition = "";
			if(count($tpmbillsArray) > 0){
				$queryCondition.="ID IN (".implode($tpmbillsArray, ',').") AND ";
		?>
		<tr>
			<td colspan="2">Total upto Previous Month</td>
			<td><?php echo Yii::app()->db->createCommand("SELECT SUM(BILL_AMOUNT) AS TOTAL FROM tbl_bill WHERE $queryCondition BILL_TYPE=6")->queryRow()['TOTAL'];?></td>
			<td><?php echo Yii::app()->db->createCommand("SELECT SUM(BILL_AMOUNT) AS TOTAL FROM tbl_bill WHERE $queryCondition BILL_TYPE=6")->queryRow()['TOTAL'];?></td>
		</tr>
		<?php } else { ?>
		<tr>
			<td colspan="2">Total upto Previous Month</td>
			<td>0</td>
			<td>0</td>
		</tr>
		<?php } ?>
		<?php
			$d = new DateTime( $this->Year.'-'.$this->Month ); 
			$criteria=new CDbCriteria;        
			$criteria->condition = "PASSED_DATE >= '".date('Y-m-d', strtotime($financialYear->START_DATE))."' AND PASSED_DATE <= '".$d->format( 'Y-m-t' )."'";
			$criteria->compare("PFMS_STATUS",'Passed');
			$criteria->addInCondition("BILL_TYPE",array(6));
			$bills = Bill::model()-> findAll($criteria);
			$pbillsArray = array();
			foreach($bills as $bill)
				array_push($pbillsArray, $bill->ID);
			
			$queryCondition = "";
			if(count($pbillsArray) > 0){
				$queryCondition.="ID IN (".implode($pbillsArray, ',').") AND ";?>
		<tr>
			<td colspan="2">Progressive Total</td>
			<td><?php echo Yii::app()->db->createCommand("SELECT SUM(BILL_AMOUNT) AS TOTAL FROM tbl_bill WHERE $queryCondition BILL_TYPE=6")->queryRow()['TOTAL'];?></td>
			<td><?php echo Yii::app()->db->createCommand("SELECT SUM(BILL_AMOUNT) AS TOTAL FROM tbl_bill WHERE $queryCondition BILL_TYPE=6")->queryRow()['TOTAL'];?></td>
		</tr>
		<?php } else { ?>
		<tr>
			<td colspan="2">Progressive Total</td>
			<td>0</td>
			<td>0</td>
		</tr>
		<?php } ?>
		<?php 
			$budget = Budget::model()->findByPK(5)->AMOUNT;
			$billAmount = 0;
			if(count($billsArray) > 0){
				$billAmount = Yii::app()->db->createCommand("SELECT SUM(BILL_AMOUNT) AS TOTAL FROM tbl_bill WHERE ID IN (".implode($billsArray, ',').") AND BILL_TYPE=3")->queryRow()['TOTAL'];
			}
		?>
		<tr>
			<td colspan="2">SANCTION GRANT</td>
			<td></td>
			<td><?php echo $budget;?></td>
		</tr>
		<tr>
			<td colspan="2">BALANCE OF APPROPRIATION</td>
			<td>0</td>
			<td><?php echo $budget-$billAmount;?></td>
		</tr>
	</tbody>
</table>
<div style="font-weight: bold; width:400px; float: right;text-align:center; margin-top:100px;margin-right:-10px;">
	<p><?php echo Employee::model()->findByPK($master['DEPT_ADMIN_EMPLOYEE'])->NAME;?></p>
	<p><?php echo Designations::model()->findByPK(Employee::model()->findByPK($master['DEPT_ADMIN_EMPLOYEE'])->DESIGNATION_ID_FK)->DESIGNATION;?></p>
	<p><?php echo $master['DEPT_NAME']?></p>
</div>
<style>
	th, td{text-align: center;}
</style>

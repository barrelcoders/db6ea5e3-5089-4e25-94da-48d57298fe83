<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/oneadmin.css" rel="stylesheet">
<script type="text/javascript">window.onload = function() { window.print(); }</script>
<?php $master = Master::model()->findByPK(1); ?>
<?php
	$monthName = array('1'=>'January', '2'=>'February', '3'=>'March', '4'=>'April', '5'=>'May', '6'=>'June', '7'=>'July', '8'=>'August', '9'=>'September', '10'=>'October', '11'=>'November', '12'=>'December');
	$monthNameHindi = array('1'=>'जनवरी', '2'=>'फ़रवरी', '3'=>'मार्च', '4'=>'अप्रैल', '5'=>'मई', '6'=>'जून', '7'=>'जुलाई', '8'=>'अगस्त', '9'=>'सितंबर', '10'=>'अक्टूबर', '11'=>'नवंबर', '12'=>'दिसंबर'); 
	$master = Master::model()->findByPK(1);  ?>
<p style="font-size: 20px;text-align: center;font-weight: bold;">अनुबंध-II/ANNEXURE - II</p>
<p style="font-size: 15px;text-align: center;font-weight: bold;"><?php echo $monthNameHindi[$this->Month]?> -<?php echo $this->Year?> माह के लिए मासिक व्यय विवरण/MONTHLY EXPENDITURE STATEMENT FOR THE MONTH OF - <?php echo $monthName[$this->Month]?> <?php echo $this->Year?></p>
<br><p style="font-size: 20px;text-align: center;font-weight: bold;">कार्यालय व्यय/OFFICE EXPENSES</p>
<br><br>
<table class="one-table" >
	<thead>
		<tr>
			<th>Sl.NO</th>
			<th>बिल सं. एवं दिनांक/ Bill No. and Date</th>
			<th>Postage and Telegrams</th>
			<th>टेलीफ़ोन/Telephones</th>
			<th>Furniture</th>
			<th>Contin-gents pay/House-keeping</th>
			<th>Other Office Machineries</th>
			<th>Office Equipments</th>
			<th>विद्युत् व्यय/Electricity Charges</th>
			<th>Water Charges</th>
			<th>Stationery Local Purchase</th>
			<th>Purchase of Books and Publication</th>
			<th>Perishable</th>
			<th>Imprest</th>
			<th>Diesel</th>
			<th>विभिन्न खर्च/Misc Office Expenses</th>
			<th>कुल कार्यालय व्यय/ TOTAL OFFICE EXPENSES</th>
			<th>TOTAL Motor Vehicles</th>
		</tr>
	</thead>
	<tbody>
		<?php
		$criteria=new CDbCriteria;        
		$criteria->compare("MONTH(PASSED_DATE)",$this->Month);
		$criteria->compare("YEAR(PASSED_DATE)",$this->Year);
		$criteria->compare("PFMS_STATUS",'Passed');
		$criteria->addInCondition("BILL_TYPE",array(3));
		$Bills = Bill::model()-> findAll($criteria);
		$billsArray = array(); 
		$i=1;
		foreach($Bills as $bill)
			array_push($billsArray, $bill->ID);
		
		if(count($billsArray) > 0){
			foreach($Bills as $bill){ ?>
				<tr>
					<td><?php echo $i;?></td>
					<td><?php echo $bill->BILL_NO;?></td>
					<td><?php if($bill->BILL_SUB_TYPE == 1) echo $bill->BILL_AMOUNT?></td>
					<td><?php if($bill->BILL_SUB_TYPE == 12) echo $bill->BILL_AMOUNT?></td>
					<td><?php if($bill->BILL_SUB_TYPE == 2) echo $bill->BILL_AMOUNT?></td>
					<td><?php if($bill->BILL_SUB_TYPE == 3) echo $bill->BILL_AMOUNT?></td>
					<td><?php if($bill->BILL_SUB_TYPE == 4) echo $bill->BILL_AMOUNT?></td>
					<td><?php if($bill->BILL_SUB_TYPE == 5) echo $bill->BILL_AMOUNT?></td>
					<td><?php if($bill->BILL_SUB_TYPE == 13) echo $bill->BILL_AMOUNT?></td>
					<td><?php if($bill->BILL_SUB_TYPE == 6) echo $bill->BILL_AMOUNT?></td>
					<td><?php if($bill->BILL_SUB_TYPE == 7) echo $bill->BILL_AMOUNT?></td>
					<td><?php if($bill->BILL_SUB_TYPE == 8) echo $bill->BILL_AMOUNT?></td>
					<td><?php if($bill->BILL_SUB_TYPE == 9) echo $bill->BILL_AMOUNT?></td>
					<td><?php if($bill->BILL_SUB_TYPE == 10) echo $bill->BILL_AMOUNT?></td>
					<td><?php if($bill->BILL_SUB_TYPE == 11) echo $bill->BILL_AMOUNT?></td>
					<td><?php if($bill->BILL_SUB_TYPE == 14) echo $bill->BILL_AMOUNT?></td>
					<td><?php echo $bill->BILL_AMOUNT?></td>
					<td></td>
				</tr>
			<?php 
				$i++;
			} ?>
			<tr>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td colspan="2">TOTAL</td>
				<td><?php echo Yii::app()->db->createCommand("SELECT SUM(BILL_AMOUNT) AS TOTAL FROM tbl_bill WHERE ID IN (".implode($billsArray, ',').") AND BILL_SUB_TYPE=1")->queryRow()['TOTAL'];?></td>
				<td><?php echo Yii::app()->db->createCommand("SELECT SUM(BILL_AMOUNT) AS TOTAL FROM tbl_bill WHERE ID IN (".implode($billsArray, ',').") AND BILL_SUB_TYPE=12")->queryRow()['TOTAL'];?></td>
				<td><?php echo Yii::app()->db->createCommand("SELECT SUM(BILL_AMOUNT) AS TOTAL FROM tbl_bill WHERE ID IN (".implode($billsArray, ',').") AND BILL_SUB_TYPE=2")->queryRow()['TOTAL'];?></td>
				<td><?php echo Yii::app()->db->createCommand("SELECT SUM(BILL_AMOUNT) AS TOTAL FROM tbl_bill WHERE ID IN (".implode($billsArray, ',').") AND BILL_SUB_TYPE=3")->queryRow()['TOTAL'];?></td>
				<td><?php echo Yii::app()->db->createCommand("SELECT SUM(BILL_AMOUNT) AS TOTAL FROM tbl_bill WHERE ID IN (".implode($billsArray, ',').") AND BILL_SUB_TYPE=4")->queryRow()['TOTAL'];?></td>
				<td><?php echo Yii::app()->db->createCommand("SELECT SUM(BILL_AMOUNT) AS TOTAL FROM tbl_bill WHERE ID IN (".implode($billsArray, ',').") AND BILL_SUB_TYPE=5")->queryRow()['TOTAL'];?></td>
				<td><?php echo Yii::app()->db->createCommand("SELECT SUM(BILL_AMOUNT) AS TOTAL FROM tbl_bill WHERE ID IN (".implode($billsArray, ',').") AND BILL_SUB_TYPE=13")->queryRow()['TOTAL'];?></td>
				<td><?php echo Yii::app()->db->createCommand("SELECT SUM(BILL_AMOUNT) AS TOTAL FROM tbl_bill WHERE ID IN (".implode($billsArray, ',').") AND BILL_SUB_TYPE=6")->queryRow()['TOTAL'];?></td>
				<td><?php echo Yii::app()->db->createCommand("SELECT SUM(BILL_AMOUNT) AS TOTAL FROM tbl_bill WHERE ID IN (".implode($billsArray, ',').") AND BILL_SUB_TYPE=7")->queryRow()['TOTAL'];?></td>
				<td><?php echo Yii::app()->db->createCommand("SELECT SUM(BILL_AMOUNT) AS TOTAL FROM tbl_bill WHERE ID IN (".implode($billsArray, ',').") AND BILL_SUB_TYPE=8")->queryRow()['TOTAL'];?></td>
				<td><?php echo Yii::app()->db->createCommand("SELECT SUM(BILL_AMOUNT) AS TOTAL FROM tbl_bill WHERE ID IN (".implode($billsArray, ',').") AND BILL_SUB_TYPE=9")->queryRow()['TOTAL'];?></td>
				<td><?php echo Yii::app()->db->createCommand("SELECT SUM(BILL_AMOUNT) AS TOTAL FROM tbl_bill WHERE ID IN (".implode($billsArray, ',').") AND BILL_SUB_TYPE=10")->queryRow()['TOTAL'];?></td>
				<td><?php echo Yii::app()->db->createCommand("SELECT SUM(BILL_AMOUNT) AS TOTAL FROM tbl_bill WHERE ID IN (".implode($billsArray, ',').") AND BILL_SUB_TYPE=11")->queryRow()['TOTAL'];?></td>
				<td><?php echo Yii::app()->db->createCommand("SELECT SUM(BILL_AMOUNT) AS TOTAL FROM tbl_bill WHERE ID IN (".implode($billsArray, ',').") AND BILL_SUB_TYPE=14")->queryRow()['TOTAL'];?></td>
				<td><?php echo Yii::app()->db->createCommand("SELECT SUM(BILL_AMOUNT) AS TOTAL FROM tbl_bill WHERE ID IN (".implode($billsArray, ',').") AND BILL_TYPE=3")->queryRow()['TOTAL'];?></td>
				<td>0</td>
			</tr>
			<tr>
				<td colspan="2">Amount Re-credited</td>
				<td>0</td>
				<td>0</td>
				<td>0</td>
				<td>0</td>
				<td>0</td>
				<td>0</td>
				<td>0</td>
				<td>0</td>
				<td>0</td>
				<td>0</td>
				<td>0</td>
				<td>0</td>
				<td>0</td>
				<td>0</td>
				<td>0</td>
				<td>0</td>
			</tr>
			<tr>
				<td colspan="2">NET TOTAL</td>
				<td><?php echo Yii::app()->db->createCommand("SELECT SUM(BILL_AMOUNT) AS TOTAL FROM tbl_bill WHERE ID IN (".implode($billsArray, ',').") AND BILL_SUB_TYPE=1")->queryRow()['TOTAL'];?></td>
				<td><?php echo Yii::app()->db->createCommand("SELECT SUM(BILL_AMOUNT) AS TOTAL FROM tbl_bill WHERE ID IN (".implode($billsArray, ',').") AND BILL_SUB_TYPE=12")->queryRow()['TOTAL'];?></td>
				<td><?php echo Yii::app()->db->createCommand("SELECT SUM(BILL_AMOUNT) AS TOTAL FROM tbl_bill WHERE ID IN (".implode($billsArray, ',').") AND BILL_SUB_TYPE=2")->queryRow()['TOTAL'];?></td>
				<td><?php echo Yii::app()->db->createCommand("SELECT SUM(BILL_AMOUNT) AS TOTAL FROM tbl_bill WHERE ID IN (".implode($billsArray, ',').") AND BILL_SUB_TYPE=3")->queryRow()['TOTAL'];?></td>
				<td><?php echo Yii::app()->db->createCommand("SELECT SUM(BILL_AMOUNT) AS TOTAL FROM tbl_bill WHERE ID IN (".implode($billsArray, ',').") AND BILL_SUB_TYPE=4")->queryRow()['TOTAL'];?></td>
				<td><?php echo Yii::app()->db->createCommand("SELECT SUM(BILL_AMOUNT) AS TOTAL FROM tbl_bill WHERE ID IN (".implode($billsArray, ',').") AND BILL_SUB_TYPE=5")->queryRow()['TOTAL'];?></td>
				<td><?php echo Yii::app()->db->createCommand("SELECT SUM(BILL_AMOUNT) AS TOTAL FROM tbl_bill WHERE ID IN (".implode($billsArray, ',').") AND BILL_SUB_TYPE=13")->queryRow()['TOTAL'];?></td>
				<td><?php echo Yii::app()->db->createCommand("SELECT SUM(BILL_AMOUNT) AS TOTAL FROM tbl_bill WHERE ID IN (".implode($billsArray, ',').") AND BILL_SUB_TYPE=6")->queryRow()['TOTAL'];?></td>
				<td><?php echo Yii::app()->db->createCommand("SELECT SUM(BILL_AMOUNT) AS TOTAL FROM tbl_bill WHERE ID IN (".implode($billsArray, ',').") AND BILL_SUB_TYPE=7")->queryRow()['TOTAL'];?></td>
				<td><?php echo Yii::app()->db->createCommand("SELECT SUM(BILL_AMOUNT) AS TOTAL FROM tbl_bill WHERE ID IN (".implode($billsArray, ',').") AND BILL_SUB_TYPE=8")->queryRow()['TOTAL'];?></td>
				<td><?php echo Yii::app()->db->createCommand("SELECT SUM(BILL_AMOUNT) AS TOTAL FROM tbl_bill WHERE ID IN (".implode($billsArray, ',').") AND BILL_SUB_TYPE=9")->queryRow()['TOTAL'];?></td>
				<td><?php echo Yii::app()->db->createCommand("SELECT SUM(BILL_AMOUNT) AS TOTAL FROM tbl_bill WHERE ID IN (".implode($billsArray, ',').") AND BILL_SUB_TYPE=10")->queryRow()['TOTAL'];?></td>
				<td><?php echo Yii::app()->db->createCommand("SELECT SUM(BILL_AMOUNT) AS TOTAL FROM tbl_bill WHERE ID IN (".implode($billsArray, ',').") AND BILL_SUB_TYPE=11")->queryRow()['TOTAL'];?></td>
				<td><?php echo Yii::app()->db->createCommand("SELECT SUM(BILL_AMOUNT) AS TOTAL FROM tbl_bill WHERE ID IN (".implode($billsArray, ',').") AND BILL_SUB_TYPE=14")->queryRow()['TOTAL'];?></td>
				<td><?php echo Yii::app()->db->createCommand("SELECT SUM(BILL_AMOUNT) AS TOTAL FROM tbl_bill WHERE ID IN (".implode($billsArray, ',').") AND BILL_TYPE=3")->queryRow()['TOTAL'];?></td>
				<td>0</td>
			</tr>

		<?php
			}
		?>
		<?php
				$financialYear = FinancialYears::model()->find('STATUS=1');
				$criteria=new CDbCriteria;
				$criteria->condition = "PASSED_DATE >= '".date('Y-m-d', strtotime($financialYear->START_DATE))."' AND PASSED_DATE <= '".date_create($this->Year."-".$this->Month." last day of last month")->format('Y-m-d')."'";
				$criteria->compare("PFMS_STATUS",'Passed');
				$criteria->addInCondition("BILL_TYPE",array(3));
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
					<td><?php echo Yii::app()->db->createCommand("SELECT SUM(BILL_AMOUNT) AS TOTAL FROM tbl_bill WHERE $queryCondition BILL_SUB_TYPE=1")->queryRow()['TOTAL'];?></td>
					<td><?php echo Yii::app()->db->createCommand("SELECT SUM(BILL_AMOUNT) AS TOTAL FROM tbl_bill WHERE $queryCondition BILL_SUB_TYPE=12")->queryRow()['TOTAL'];?></td>
					<td><?php echo Yii::app()->db->createCommand("SELECT SUM(BILL_AMOUNT) AS TOTAL FROM tbl_bill WHERE $queryCondition BILL_SUB_TYPE=2")->queryRow()['TOTAL'];?></td>
					<td><?php echo Yii::app()->db->createCommand("SELECT SUM(BILL_AMOUNT) AS TOTAL FROM tbl_bill WHERE $queryCondition BILL_SUB_TYPE=3")->queryRow()['TOTAL'];?></td>
					<td><?php echo Yii::app()->db->createCommand("SELECT SUM(BILL_AMOUNT) AS TOTAL FROM tbl_bill WHERE $queryCondition BILL_SUB_TYPE=4")->queryRow()['TOTAL'];?></td>
					<td><?php echo Yii::app()->db->createCommand("SELECT SUM(BILL_AMOUNT) AS TOTAL FROM tbl_bill WHERE $queryCondition BILL_SUB_TYPE=5")->queryRow()['TOTAL'];?></td>
					<td><?php echo Yii::app()->db->createCommand("SELECT SUM(BILL_AMOUNT) AS TOTAL FROM tbl_bill WHERE $queryCondition BILL_SUB_TYPE=13")->queryRow()['TOTAL'];?></td>
					<td><?php echo Yii::app()->db->createCommand("SELECT SUM(BILL_AMOUNT) AS TOTAL FROM tbl_bill WHERE $queryCondition BILL_SUB_TYPE=6")->queryRow()['TOTAL'];?></td>
					<td><?php echo Yii::app()->db->createCommand("SELECT SUM(BILL_AMOUNT) AS TOTAL FROM tbl_bill WHERE $queryCondition BILL_SUB_TYPE=7")->queryRow()['TOTAL'];?></td>
					<td><?php echo Yii::app()->db->createCommand("SELECT SUM(BILL_AMOUNT) AS TOTAL FROM tbl_bill WHERE $queryCondition BILL_SUB_TYPE=8")->queryRow()['TOTAL'];?></td>
					<td><?php echo Yii::app()->db->createCommand("SELECT SUM(BILL_AMOUNT) AS TOTAL FROM tbl_bill WHERE $queryCondition BILL_SUB_TYPE=9")->queryRow()['TOTAL'];?></td>
					<td><?php echo Yii::app()->db->createCommand("SELECT SUM(BILL_AMOUNT) AS TOTAL FROM tbl_bill WHERE $queryCondition BILL_SUB_TYPE=10")->queryRow()['TOTAL'];?></td>
					<td><?php echo Yii::app()->db->createCommand("SELECT SUM(BILL_AMOUNT) AS TOTAL FROM tbl_bill WHERE $queryCondition BILL_SUB_TYPE=11")->queryRow()['TOTAL'];?></td>
					<td><?php echo Yii::app()->db->createCommand("SELECT SUM(BILL_AMOUNT) AS TOTAL FROM tbl_bill WHERE $queryCondition BILL_SUB_TYPE=14")->queryRow()['TOTAL'];?></td>
					<td><?php echo Yii::app()->db->createCommand("SELECT SUM(BILL_AMOUNT) AS TOTAL FROM tbl_bill WHERE $queryCondition BILL_TYPE=3")->queryRow()['TOTAL'];?></td>
					<td>0</td>
				</tr>
			<?php
				}
				else{
			?>
					<td colspan="2">Total upto Previous Month</td>
					<td>0</td>
					<td>0</td>
					<td>0</td>
					<td>0</td>
					<td>0</td>
					<td>0</td>
					<td>0</td>
					<td>0</td>
					<td>0</td>
					<td>0</td>
					<td>0</td>
					<td>0</td>
					<td>0</td>
					<td>0</td>
					<td>0</td>
					<td>0</td>
			<?php
				}
			?>
			<?php
				$d = new DateTime( $this->Year.'-'.$this->Month ); 
				$criteria=new CDbCriteria;        
				$criteria->condition = "PASSED_DATE >= '".date('Y-m-d', strtotime($financialYear->START_DATE))."' AND PASSED_DATE <= '".$d->format( 'Y-m-t' )."'";
				$criteria->compare("PFMS_STATUS",'Passed');
				$criteria->addInCondition("BILL_TYPE",array(3));
				$bills = Bill::model()-> findAll($criteria);
				$pbillsArray = array();
				foreach($bills as $bill)
					array_push($pbillsArray, $bill->ID);
				
				$queryCondition = "";
				if(count($pbillsArray) > 0){
					$queryCondition.="ID IN (".implode($pbillsArray, ',').") AND ";
					?>
						<tr>
							<td colspan="2">Progressive Total</td>
							<td><?php echo Yii::app()->db->createCommand("SELECT SUM(BILL_AMOUNT) AS TOTAL FROM tbl_bill WHERE $queryCondition BILL_SUB_TYPE=1")->queryRow()['TOTAL'];?></td>
							<td><?php echo Yii::app()->db->createCommand("SELECT SUM(BILL_AMOUNT) AS TOTAL FROM tbl_bill WHERE $queryCondition BILL_SUB_TYPE=12")->queryRow()['TOTAL'];?></td>
							<td><?php echo Yii::app()->db->createCommand("SELECT SUM(BILL_AMOUNT) AS TOTAL FROM tbl_bill WHERE $queryCondition BILL_SUB_TYPE=2")->queryRow()['TOTAL'];?></td>
							<td><?php echo Yii::app()->db->createCommand("SELECT SUM(BILL_AMOUNT) AS TOTAL FROM tbl_bill WHERE $queryCondition BILL_SUB_TYPE=3")->queryRow()['TOTAL'];?></td>
							<td><?php echo Yii::app()->db->createCommand("SELECT SUM(BILL_AMOUNT) AS TOTAL FROM tbl_bill WHERE $queryCondition BILL_SUB_TYPE=4")->queryRow()['TOTAL'];?></td>
							<td><?php echo Yii::app()->db->createCommand("SELECT SUM(BILL_AMOUNT) AS TOTAL FROM tbl_bill WHERE $queryCondition BILL_SUB_TYPE=5")->queryRow()['TOTAL'];?></td>
							<td><?php echo Yii::app()->db->createCommand("SELECT SUM(BILL_AMOUNT) AS TOTAL FROM tbl_bill WHERE $queryCondition BILL_SUB_TYPE=13")->queryRow()['TOTAL'];?></td>
							<td><?php echo Yii::app()->db->createCommand("SELECT SUM(BILL_AMOUNT) AS TOTAL FROM tbl_bill WHERE $queryCondition BILL_SUB_TYPE=6")->queryRow()['TOTAL'];?></td>
							<td><?php echo Yii::app()->db->createCommand("SELECT SUM(BILL_AMOUNT) AS TOTAL FROM tbl_bill WHERE $queryCondition BILL_SUB_TYPE=7")->queryRow()['TOTAL'];?></td>
							<td><?php echo Yii::app()->db->createCommand("SELECT SUM(BILL_AMOUNT) AS TOTAL FROM tbl_bill WHERE $queryCondition BILL_SUB_TYPE=8")->queryRow()['TOTAL'];?></td>
							<td><?php echo Yii::app()->db->createCommand("SELECT SUM(BILL_AMOUNT) AS TOTAL FROM tbl_bill WHERE $queryCondition BILL_SUB_TYPE=9")->queryRow()['TOTAL'];?></td>
							<td><?php echo Yii::app()->db->createCommand("SELECT SUM(BILL_AMOUNT) AS TOTAL FROM tbl_bill WHERE $queryCondition BILL_SUB_TYPE=10")->queryRow()['TOTAL'];?></td>
							<td><?php echo Yii::app()->db->createCommand("SELECT SUM(BILL_AMOUNT) AS TOTAL FROM tbl_bill WHERE $queryCondition BILL_SUB_TYPE=11")->queryRow()['TOTAL'];?></td>
							<td><?php echo Yii::app()->db->createCommand("SELECT SUM(BILL_AMOUNT) AS TOTAL FROM tbl_bill WHERE $queryCondition BILL_SUB_TYPE=14")->queryRow()['TOTAL'];?></td>
							<td><?php echo Yii::app()->db->createCommand("SELECT SUM(BILL_AMOUNT) AS TOTAL FROM tbl_bill WHERE $queryCondition BILL_TYPE=3")->queryRow()['TOTAL'];?></td>
							<td>0</td>
						</tr>
					<?php
				}
				else{
					?>
						<td colspan="2">Progressive Total</td>
						<td>0</td>
						<td>0</td>
						<td>0</td>
						<td>0</td>
						<td>0</td>
						<td>0</td>
						<td>0</td>
						<td>0</td>
						<td>0</td>
						<td>0</td>
						<td>0</td>
						<td>0</td>
						<td>0</td>
						<td>0</td>
						<td>0</td>
						<td>0</td>
					<?php
				}
			?>
			
			<?php 
				$budget = Budget::model()->findByPK(2)->AMOUNT;
				$billAmount = Yii::app()->db->createCommand("SELECT SUM(BILL_AMOUNT) AS TOTAL FROM tbl_bill WHERE $queryCondition BILL_TYPE=3")->queryRow()['TOTAL'];
			?>
			<tr>
				<td colspan="2">SANCTION GRANT</td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td><?php echo $budget;?></td>
			</tr>
			<tr>
				<td colspan="2">BALANCE OF APPROPRIATION</td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td><?php echo $budget-$billAmount;?></td>
			</tr>
		
	</tbody>
</table>
<div style="font-weight: bold; width:400px; float: right;text-align:center; margin-top:50px;margin-right:-10px;">
	<p>(<?php echo Employee::model()->findByPK($master['DEPT_ADMIN_EMPLOYEE'])->NAME;?>)</p>
	<p><?php echo Designations::model()->findByPK(Employee::model()->findByPK($master['DEPT_ADMIN_EMPLOYEE'])->DESIGNATION_ID_FK)->DESIGNATION;?></p>
	<p><?php echo $master['DEPT_NAME']?></p>
</div>
<style>
	th, td{text-align: center;}
</style>

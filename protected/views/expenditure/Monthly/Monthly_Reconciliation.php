<?php require_once "/../../../../include/ExpenditureReportInclude.php";?>
<?php
	$monthName = array('1'=>'January', '2'=>'February', '3'=>'March', '4'=>'April', '5'=>'May', '6'=>'June', '7'=>'July', '8'=>'August', '9'=>'September', '10'=>'October', '11'=>'November', '12'=>'December');
	$monthNameHindi = array('1'=>'जनवरी', '2'=>'फ़रवरी', '3'=>'मार्च', '4'=>'अप्रैल', '5'=>'मई', '6'=>'जून', '7'=>'जुलाई', '8'=>'अगस्त', '9'=>'सितंबर', '10'=>'अक्टूबर', '11'=>'नवंबर', '12'=>'दिसंबर'); 
	$master = Master::model()->findByPK(1); ?>
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
	<span class="left"><b>सी.सं./C. No.III/9/1/2016 Admn	</b></span>
	<span style="position: absolute; right: 0;"><b>दिनांक/Date: <?php echo date('d/m/Y');?></b></span>
</div>
<br><br><br><br>
<div>
	<p>सेवा में /To,</p>
	<p>वेतन एवं लेखा अधिकारी /The Pay and Accounts Officer,</p>
	<p>केन्द्रिय उत्पाद शुल्क एवं सीमा शुल्क /Central Excise and Customs,</p>
	<p>सी.आर. भवन, क्वींश रोड/C.R. Building, Queen’s Road</p>
	<p>बैंगलोर/Bangalore-560001</p>
	<br><br>
	<p>महोदय/ Sir,</p>
</div>
<div style="padding-left:100px;">
	<p>विषय/Sub: <?php echo $monthNameHindi[$this->Month];?>-<?php echo $this->Year;?>  माह  के लिए व्यय की सुलह.-के संदर्भ में |</p>
	<p>Reconciliation of Expenditure for the month of <?php echo $monthName[$this->Month];?>-<?php echo $this->Year;?>.- Reg.</p>
	<p style="text-align: center;">*****</p>
	<p><?php echo $monthNameHindi[$this->Month];?>-<?php echo $this->Year;?> के महीने के लिए इस कार्यालय द्वारा विभिन्न मदों में किए गए व्यय का वेतन एवं लेखा अधिकारी द्वारा जारी किया गया व्यय के आंकड़ो के रूप में नीचे विस्तृत है|</p>
</div>
<br><br>
<div>The expenditure incurred under various heads by this office against those booked by Pay and Accounts Officer up to the month of <?php echo $monthName[$this->Month];?>-<?php echo $this->Year;?> is detailed as below:</div>
<br><br>
<table class="one-table" >
	<thead>
		<tr>
			<th>Particulars</th>
			<th>SALARIES(01)</th>
			<th>MEDICAL(06)</th>
			<th>DTE(11)</th>
			<th>OE(13)</th>
			<th>RRT(14)</th>
			<th></th>
			<th>IT on Salaries</th>
			<th>E. Cess</th>
			<th>H.E.Cess</th>
			<th>IT on Non- Salaries</th>
		</tr>
		<tr>
			<th>1</th>
			<th>2</th>
			<th>3</th>
			<th>4</th>
			<th>5</th>
			<th>6</th>
			<th></th>
			<th>1</th>
			<th>2</th>
			<th>3</th>
			<th>4</th>
		</tr>
	</thead>
	<?php $financialYear = FinancialYears::model()->find('STATUS=1');?>
	<tbody>
		<tr>
			<th>SANCTION GRANT FOR <?php echo $financialYear->NAME;?></th>
			<th><?php echo Budget::model()->findByPK(1)->AMOUNT;?></th>
			<th><?php echo Budget::model()->findByPK(5)->AMOUNT;?></th>
			<th><?php echo Budget::model()->findByPK(3)->AMOUNT;?></th>
			<th><?php echo Budget::model()->findByPK(2)->AMOUNT;?></th>
			<th><?php echo Budget::model()->findByPK(6)->AMOUNT;?></th>
			<th></th>
			<th>-</th>
			<th>-</th>
			<th>-</th>
			<th>-</th>
		</tr>
		<?php 
			$PAOExpenditures = PAOExpenditure::model()->find('YEAR = '.$this->Year.' AND MONTH = '.$this->Month); 
			if($PAOExpenditures){	
		?>
		<tr>
			<th>PAO’s figures</th>
			<th><?php echo $PAOExpenditures->SALARY; ?></th>
			<th><?php echo $PAOExpenditures->MEDICAL; ?></th>
			<th><?php echo $PAOExpenditures->DTE; ?></th>
			<th><?php echo $PAOExpenditures->OE; ?></th>
			<th><?php echo $PAOExpenditures->RRT; ?></th>
			<th></th>
			<th><?php echo $PAOExpenditures->IT_SAL; ?></th>
			<th><?php echo $PAOExpenditures->IT_ECSS; ?></th>
			<th><?php echo $PAOExpenditures->IT_HCESS; ?></th>
			<th><?php echo $PAOExpenditures->IT_NON_SAL; ?></th>
		</tr>
		<?php } else { ?>
		<tr>
			<th>PAO’s figures</th>
			<th>0</th>
			<th>0</th>
			<th>0</th>
			<th>0</th>
			<th>0</th>
			<th></th>
			<th>0</th>
			<th>0</th>
			<th>0</th>
			<th>0</th>
		</tr>
		<?php } ?>
		
		<?php
			$bills = Yii::app()->db->createCommand("SELECT ID FROM tbl_bill WHERE PFMS_STATUS='Passed' AND MONTH(PASSED_DATE)=".$this->Month." AND YEAR(PASSED_DATE)=".$this->Year." ")->queryAll();
			$BillsIds = array(); 
			foreach($bills as $bill) array_push($BillsIds, $bill['ID']);
			if(count($BillsIds)>0){	
		?>
		<tr>
			<th>DDO’s figures</th>
			<th><?php $SALARY = Yii::app()->db->createCommand("SELECT  SUM(GROSS) - SUM(MISC) AS GROSS FROM tbl_salary_details WHERE BILL_ID_FK IN (".implode(",", $BillsIds).")")->queryRow(); echo $SALARY['GROSS']; ?></th>
			<th><?php $MEDICAL = Yii::app()->db->createCommand("SELECT IF(SUM(BILL_AMOUNT) IS NULL, 0, SUM(BILL_AMOUNT)) AS BILL_AMOUNT FROM tbl_bill WHERE BILL_TYPE=6 AND ID IN (".implode(",", $BillsIds).")")->queryRow(); echo $MEDICAL['BILL_AMOUNT'];?></th>
			<th><?php $DTE = Yii::app()->db->createCommand("SELECT IF(SUM(BILL_AMOUNT) IS NULL, 0, SUM(BILL_AMOUNT)) AS BILL_AMOUNT FROM tbl_bill WHERE BILL_TYPE=4 AND ID IN (".implode(",", $BillsIds).")")->queryRow(); echo $DTE['BILL_AMOUNT']; ?></th>
			<th><?php $OE = Yii::app()->db->createCommand("SELECT IF(SUM(BILL_AMOUNT) IS NULL, 0, SUM(BILL_AMOUNT)) AS BILL_AMOUNT FROM tbl_bill WHERE BILL_TYPE=3 AND ID IN (".implode(",", $BillsIds).")")->queryRow(); echo $OE['BILL_AMOUNT']; ?></th>
			<th><?php $RRT = Yii::app()->db->createCommand("SELECT IF(SUM(BILL_AMOUNT) IS NULL, 0, SUM(BILL_AMOUNT)) AS BILL_AMOUNT FROM tbl_bill WHERE BILL_TYPE=7 AND ID IN (".implode(",", $BillsIds).")")->queryRow(); echo $RRT['BILL_AMOUNT']; ?></th>
			<th></th>
			<?php $IT_TOTAL = Yii::app()->db->createCommand("SELECT SUM(IT) AS IT FROM tbl_salary_details WHERE BILL_ID_FK IN (".implode(",", $BillsIds).")")->queryRow(); ?>
			<th><?php $IT_SAL = round(($IT_TOTAL['IT']*100)/103); echo $IT_SAL;?></th>
			<th><?php $IT_ECESS = round(($IT_TOTAL['IT']*2)/103); echo $IT_ECESS;?></th>
			<th><?php $IT_HCESS = round(($IT_TOTAL['IT']*1)/103); echo $IT_HCESS;?></th>
			<?php  $IT_NON_SAL = Yii::app()->db->createCommand("SELECT SUM(a.IT_DED) AS IT_DED FROM tbl_oe_bill_details a, tbl_bill b WHERE a.BILL_ID_FK = b.ID AND a.BILL_ID_FK IN (".implode(",", $BillsIds).")")->queryRow()['IT_DED']; ?>
			<th><?php echo $IT_NON_SAL?></th>
		</tr>
		<?php } else { ?>
		<tr>
			<th>DDO’s figures</th>
			<th>0</th>
			<th>0</th>
			<th>0</th>
			<th>0</th>
			<th>0</th>
			<th></th>
			<th>0</th>
			<th>0</th>
			<th>0</th>
			<th>0</th>
		</tr>	
		<?php } ?>
		<?php if(count($BillsIds)>0){ ?>
		<tr>
			<th>DIFFERENCE for <?php echo $this->Month; ?>/<?php echo $this->Year; ?></th>
			<th><?php echo $PAOExpenditures->SALARY - $SALARY['GROSS'];?></th>
			<th><?php echo $PAOExpenditures->MEDICAL - $MEDICAL['BILL_AMOUNT'];?></th>
			<th><?php echo $PAOExpenditures->DTE - $DTE['BILL_AMOUNT'];?></th>
			<th><?php echo $PAOExpenditures->OE - $OE['BILL_AMOUNT'];?></th>
			<th><?php echo $PAOExpenditures->RRT - $RRT['BILL_AMOUNT'];?></th>
			<th></th>
			<th><?php echo $PAOExpenditures->IT_SAL - $IT_SAL;?></th>
			<th><?php echo $PAOExpenditures->IT_ECSS - $IT_ECESS;?></th>
			<th><?php echo $PAOExpenditures->IT_HCESS - $IT_HCESS;?></th>
			<th><?php echo $PAOExpenditures->IT_NON_SAL - $IT_NON_SAL;?></th>
		</tr>
		<?php } else { ?>
		<tr>
			<th>DIFFERENCE for <?php echo $this->Month; ?>/<?php echo $this->Year; ?></th>
			<th>0</th>
			<th>0</th>
			<th>0</th>
			<th>0</th>
			<th>0</th>
			<th></th>
			<th>0</th>
			<th>0</th>
			<th>0</th>
			<th>0</th>
		</tr>
		<?php } ?>
		<?php
			$T_PAOExpenditures = Yii::app()->db->createCommand("SELECT SUM(SALARY) AS SALARY, SUM(MEDICAL) AS MEDICAL, SUM(DTE) AS DTE, SUM(OE) AS OE, SUM(RRT) AS RRT, SUM(IT_SAL) AS IT_SAL, SUM(IT_ECSS) AS IT_ECSS,
													  SUM(IT_HCESS) AS IT_HCESS, SUM(IT_NON_SAL) AS IT_NON_SAL  FROM tbl_pao_expenditure WHERE DATE >= '".date('Y-m-d', strtotime($financialYear->START_DATE))."' AND DATE <= '".date_create($this->Year."-".($this->Month+1)." last day of last month")->format('Y-m-d')."'")->queryRow();
			if(count($T_PAOExpenditures)>0){
		?>
		<tr>
			<th>PAO’s Expenditure UPTO <?php echo $this->Month; ?>/<?php echo $this->Year; ?></th>
			<th><?php echo $T_PAOExpenditures['SALARY']; ?></th>
			<th><?php echo $T_PAOExpenditures['MEDICAL']; ?></th>
			<th><?php echo $T_PAOExpenditures['DTE']; ?></th>
			<th><?php echo $T_PAOExpenditures['OE']; ?></th>
			<th><?php echo $T_PAOExpenditures['RRT']; ?></th>
			<th></th>
			<th><?php echo $T_PAOExpenditures['IT_SAL']; ?></th>
			<th><?php echo $T_PAOExpenditures['IT_ECSS']; ?></th>
			<th><?php echo $T_PAOExpenditures['IT_HCESS']; ?></th>
			<th><?php echo $T_PAOExpenditures['IT_NON_SAL']; ?></th>
		</tr>
		<?php } else { ?>
			<tr>
			<th>PAO’s Expenditure UPTO <?php echo $this->Month; ?>/<?php echo $this->Year; ?></th>
			<th>0</th>
			<th>0</th>
			<th>0</th>
			<th>0</th>
			<th>0</th>
			<th></th>
			<th>0</th>
			<th>0</th>
			<th>0</th>
			<th>0</th>
		</tr>
        <?php } ?>
		<?php
			$financialYear = FinancialYears::model()->find('STATUS=1');
			$criteria=new CDbCriteria;
			$criteria->condition = "PASSED_DATE >= '".date('Y-m-d', strtotime($financialYear->START_DATE))."' AND PASSED_DATE <= '".date_create($this->Year."-".($this->Month+1)." last day of last month")->format('Y-m-d')."'";
			$criteria->compare("PFMS_STATUS",'Passed');
			$bills = Bill::model()-> findAll($criteria);
			$BillsIds = array();
			foreach($bills as $bill)
				array_push($BillsIds, $bill->ID);
			if(count($BillsIds) > 0){
		?>
		<tr>
			<th>DDO EXPENDITURE UPTO <?php echo $this->Month; ?>/<?php echo $this->Year; ?></th>
			<th><?php $T_SALARY = Yii::app()->db->createCommand("SELECT  SUM(GROSS) - SUM(MISC) AS GROSS FROM tbl_salary_details WHERE BILL_ID_FK IN (".implode(",", $BillsIds).")")->queryRow()['GROSS']; echo $T_SALARY; ?></th>
			<th><?php $T_MEDICAL = Yii::app()->db->createCommand("SELECT IF(SUM(BILL_AMOUNT) IS NULL, 0, SUM(BILL_AMOUNT)) AS BILL_AMOUNT FROM tbl_bill WHERE BILL_TYPE=6 AND ID IN (".implode(",", $BillsIds).")")->queryRow()['BILL_AMOUNT']; echo $T_MEDICAL;?></th>
			<th><?php $T_DTE = Yii::app()->db->createCommand("SELECT IF(SUM(BILL_AMOUNT) IS NULL, 0, SUM(BILL_AMOUNT)) AS BILL_AMOUNT FROM tbl_bill WHERE BILL_TYPE=4 AND ID IN (".implode(",", $BillsIds).")")->queryRow()['BILL_AMOUNT']; echo $T_DTE;?></th>
			<th><?php $T_OE = Yii::app()->db->createCommand("SELECT IF(SUM(BILL_AMOUNT) IS NULL, 0, SUM(BILL_AMOUNT)) AS BILL_AMOUNT FROM tbl_bill WHERE BILL_TYPE=3 AND ID IN (".implode(",", $BillsIds).")")->queryRow()['BILL_AMOUNT']; echo $T_OE; ?></th>
			<th><?php $T_RRT = Yii::app()->db->createCommand("SELECT IF(SUM(BILL_AMOUNT) IS NULL, 0, SUM(BILL_AMOUNT)) AS BILL_AMOUNT FROM tbl_bill WHERE BILL_TYPE=7 AND ID IN (".implode(",", $BillsIds).")")->queryRow()['BILL_AMOUNT']; echo $T_RRT;?></th>
			<th></th>
			<?php $T_IT_TOTAL = Yii::app()->db->createCommand("SELECT SUM(IT) AS IT FROM tbl_salary_details WHERE  BILL_ID_FK IN (".implode(",", $BillsIds).")")->queryRow()['IT'];?>
			<th><?php $T_IT_SAL = round(($T_IT_TOTAL*100)/103); echo $T_IT_SAL; ?></th>
			<th><?php $T_IT_ECESS = round(($T_IT_TOTAL*2)/103); echo $T_IT_ECESS; ?></th>
			<th><?php $T_IT_HCESS = round(($T_IT_TOTAL*1)/103); echo $T_IT_HCESS; ?></th>
			<?php  $T_IT_NON_SAL = Yii::app()->db->createCommand("SELECT SUM(a.IT_DED) AS IT_DED FROM tbl_oe_bill_details a, tbl_bill b WHERE a.BILL_ID_FK = b.ID AND a.BILL_ID_FK IN (".implode(",", $BillsIds).")")->queryRow()['IT_DED']; ?>
			<th><?php echo $T_IT_NON_SAL?></th>
		</tr>
		<?php  } else {?>
			<tr>
				<th>DDO EXPENDITURE UPTO <?php echo $this->Month; ?>/<?php echo $this->Year; ?></th>
				<th>0</th>
				<th>0</th>
				<th>0</th>
				<th>0</th>
				<th>0</th>
				<th></th>
				<th>0</th>
				<th>0</th>
				<th>0</th>
				<th>0</th>
			</tr>
		<?php } ?>
		<?php if(count($BillsIds)>0){ ?>
		<tr>
			<th>DIFFERENCE upto <?php echo $this->Month; ?>/<?php echo $this->Year; ?></th>
			<th><?php echo intVal($T_PAOExpenditures['SALARY']) - intVal($T_SALARY); ?></th>
			<th><?php echo intVal($T_PAOExpenditures['MEDICAL']) - intVal($T_MEDICAL); ?></th>
			<th><?php echo intVal($T_PAOExpenditures['DTE']) - intVal($T_DTE); ?></th>
			<th><?php echo intVal($T_PAOExpenditures['OE']) - intVal($T_OE); ?></th>
			<th><?php echo intVal($T_PAOExpenditures['RRT']) - intVal($T_RRT); ?></th>
			<th></th>
			<th><?php echo intVal($T_PAOExpenditures['IT_SAL']) - intVal($T_IT_SAL); ?></th>
			<th><?php echo intVal($T_PAOExpenditures['IT_ECSS']) - intVal($T_IT_ECESS); ?></th>
			<th><?php echo intVal($T_PAOExpenditures['IT_HCESS']) - intVal($T_IT_HCESS); ?></th>
			<th><?php echo intVal($T_PAOExpenditures['IT_NON_SAL']) - intVal($T_IT_NON_SAL); ?></th>
		</tr>
		<?php } else {?>
		<tr>
			<th>DIFFERENCE upto <?php echo $this->Month; ?>/<?php echo $this->Year; ?></th>
			<th>0</th>
			<th>0</th>
			<th>0</th>
			<th>0</th>
			<th>0</th>
			<th></th>
			<th>0</th>
			<th>0</th>
			<th>0</th>
			<th>0</th>
		</tr>
		<?php } ?>
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

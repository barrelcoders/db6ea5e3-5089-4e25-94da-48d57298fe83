<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/oneadmin.css" rel="stylesheet">
<?php
	$monthName = array('1'=>'JAN', '2'=>'FEB', '3'=>'MAR', '4'=>'APR', '5'=>'MAY', '6'=>'JUN', '7'=>'JUL', '8'=>'AUG', '9'=>'SEP', '10'=>'OCT', '11'=>'NOV', '12'=>'DEC');
	$monthNameHindi = array('1'=>'जनवरी', '2'=>'फ़रवरी', '3'=>'मार्च', '4'=>'अप्रैल', '5'=>'मई', '6'=>'जून', '7'=>'जुलाई', '8'=>'अगस्त', '9'=>'सितंबर', '10'=>'अक्टूबर', '11'=>'नवंबर', '12'=>'दिसंबर'); 
	$master = Master::model()->findByPK(1);
?>
<style>
	td, th {font-weight: normal !important;}
</style>
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
<br><br><br>
<p style="margin-bottom: 4px;font-size: 20px;">In exercise of the power vested under Schedule V of the Delegation of Financial Power Rules, 1978, the Joint Commissioner, Central Tax, Banaglore - North Commissionerate, Bangalore, is
pleased to sanction an expenditure of Rs. <?php echo $model->BILL_AMOUNT;?>/- <?php echo $this->amountToWord($model->BILL_AMOUNT);?> towards the <?php echo $model->BILL_TITLE;?> for 
<?php 
	$employees = explode(",", BillEmployees::model()->find('BILL_ID='.$model->ID)->EMPLOYEE_ID);
	$emp_names = array();
	foreach($employees as $id){
		array_push($emp_names, Employee::model()->findByPK($id)->NAME);
	}
?>
<?php echo implode(", ", $emp_names);?>, 
<?php echo Designations::model()->findByPK(Employee::model()->findByPK(BillEmployees::model()->find('BILL_ID='.$model->ID)->EMPLOYEE_ID)->DESIGNATION_ID_FK)->DESIGNATION; ?>
 in the month of <?php echo $monthName[$model->MONTH];?>-<?php echo $model->YEAR;?></p><br>
<p style="margin-bottom: 4px;font-size: 20px;">The above expenditure is debitable to the main head Wages and the expenditure should be met from within the Budget Grant for the year <?php $financialYear = FinancialYears::model()->find('STATUS=1'); echo $financialYear->NAME;?></p>
<br><br>
<table class="pay-schedule-table">
	<thead>
		<!--<tr>
			<td  colspan="13" style=" border-top:1px solid #000; border-bottom: none;"><?php echo $model->BILL_TITLE; ?></td>
		</tr>
		<tr>
			<td  colspan="13" style=" border-top:1px solid #000; border-bottom: none;text-align: left;">Pay Rs. 18000/- as on 01.01.2016</td>
		</tr>
		<tr>
			<td  colspan="13" style=" border-top:1px solid #000; border-bottom: none;text-align: left;">Pay Rs. 18500/- as on 01.07.2016</td>
		</tr>
		<tr>
			<td  colspan="13" style=" border-top:1px solid #000; border-bottom: none;text-align: left;">Pay Rs. 18500/- as on 15.03.2017</td>
		</tr>-->
		<tr style="">
			<th class="small-xxx right-br">Month</th>
			<th class="small-xx right-br">BASIC</th>
			<th class="small-xxx">DA</th>
			<th class="small-xxx">TA</th>
			<th class="small-xxx">HRA</th>
			<th class="small-xx right-br left-br">GROSS</th>
			<th class="small-xxx">CGEGIS</th>
			<th class="small-xxx">CPF</th>
			<th class="small-xx">DED.</th>
			<th class="small-xx left-br right-br">NET</th>
			<th class="small-xx">PT</th>
			<th class="small-xx">OTHER DED.</th>
			<th class="small-xx left-br">AMOUNT TO BANK</th>
		</tr>
	</thead>
	<?php 
		$i = 1;	
		$criteria=new CDbCriteria;
		$criteria->condition = "BILL_ID_FK=$model->ID";
		$salaries = SalaryDetails::model()->findAll($criteria);
	?>
	<tbody>
		<?php foreach ($salaries as $salary) { ?>
		<tr>
			<td class="small-xxx right-br"><?php echo $monthName[$model->MONTH]."-".$model->YEAR;?></td>
			<td class="small-xx right-br"><?php echo $salary->BASIC; ?></td>
			<td class="small-xx"><?php echo $salary->DA; ?></td>
			<td class="small-xx"><?php echo $salary->TA; ?></td>
			<td class="small-xxx"><?php echo $salary->HRA; ?></td>
			<td class="small-xx right-br left-br"><?php echo $salary->GROSS; ?></td>
			<td class="small-xxx"><?php echo $salary->CGEGIS; ?></td>
			<td class="small-xxx"><?php echo $salary->CPF_TIER_I; ?></td>
			<td class="small-xx"><?php echo $salary->DED; ?></td>
			<td class="small-xx left-br right-br"><?php echo $salary->NET; ?></td>
			<td class="small-xx"><?php echo $salary->PT; ?></td>
			<td class="small-xx"><?php echo $salary->OTHER_DED; ?></td>
			<td class="small-xx left-br"><?php echo $salary->AMOUNT_BANK; ?></td>
		</tr>
		<?php 
			$i++;
		} ?>
	</tbody>
	<tfoot>
		<th class="small-xxx right-br"></th>
		<th class="small-xx right-br"><?php $BASIC = Yii::app()->db->createCommand("SELECT SUM(BASIC) as BASIC FROM tbl_salary_details WHERE BILL_ID_FK = $model->ID;")->queryRow()['BASIC'];echo $BASIC;?></th>
		<th class="small-xx"><?php echo Yii::app()->db->createCommand("SELECT SUM(DA) as DA FROM tbl_salary_details WHERE BILL_ID_FK = $model->ID;")->queryRow()['DA'];?></th>
		<th class="small-xx"><?php echo Yii::app()->db->createCommand("SELECT SUM(TA) as TA FROM tbl_salary_details WHERE BILL_ID_FK = $model->ID;")->queryRow()['TA'];?></th>
		<th class="small-xxx"><?php echo Yii::app()->db->createCommand("SELECT SUM(HRA) as HRA FROM tbl_salary_details WHERE BILL_ID_FK = $model->ID;")->queryRow()['HRA'];?></th>
		<th class="small-xx right-br left-br"><?php echo Yii::app()->db->createCommand("SELECT SUM(GROSS) as GROSS FROM tbl_salary_details WHERE BILL_ID_FK = $model->ID;")->queryRow()['GROSS'];?></th>
		<th class="small-xxx"><?php echo Yii::app()->db->createCommand("SELECT SUM(CGEGIS) as CGEGIS FROM tbl_salary_details WHERE BILL_ID_FK = $model->ID;")->queryRow()['CGEGIS'];?></th>
		<th class="small-xxx"><?php echo Yii::app()->db->createCommand("SELECT SUM(CPF_TIER_I) as CPF_TIER_I FROM tbl_salary_details WHERE BILL_ID_FK = $model->ID;")->queryRow()['CPF_TIER_I'];?></th>
		<th class="small-xxx"><?php echo Yii::app()->db->createCommand("SELECT SUM(DED) as DED FROM tbl_salary_details WHERE BILL_ID_FK = $model->ID;")->queryRow()['DED'];?></th>
		<th class="small-xx left-br right-br"><?php echo Yii::app()->db->createCommand("SELECT SUM(NET) as NET FROM tbl_salary_details WHERE BILL_ID_FK = $model->ID;")->queryRow()['NET'];?></th>
		<th class="small-xx"><?php echo Yii::app()->db->createCommand("SELECT SUM(PT) as PT FROM tbl_salary_details WHERE BILL_ID_FK = $model->ID;")->queryRow()['PT'];?></th>
		<th class="small-xx"><?php echo Yii::app()->db->createCommand("SELECT SUM(OTHER_DED) as OTHER_DED FROM tbl_salary_details WHERE BILL_ID_FK = $model->ID;")->queryRow()['OTHER_DED'];?></th>
		<th class="small-xx left-br"><?php $AMOUNT_BANK = Yii::app()->db->createCommand("SELECT SUM(AMOUNT_BANK) as AMOUNT_BANK FROM tbl_salary_details WHERE BILL_ID_FK = $model->ID;")->queryRow()['AMOUNT_BANK']; echo $AMOUNT_BANK; ?></th>
	</tfoot>
</table>
<h4 style="text-align:center;margin-top: 50px;"><?php echo $this->amountToWord($model->BILL_AMOUNT);?></h4>
<br><br>
<br><br>
<div style="font-weight: bold;clear: both;">
	<div style="float:right;margin-right: 50px;text-align:center;width:250px;margin-bottom:10px;">
		<p>(<?php echo Employee::model()->findByPK($master->DEPT_ADMIN_EMPLOYEE)->NAME_HINDI;?>)</p>
		<p><?php echo Designations::model()->findByPK(Employee::model()->findByPK($master->DEPT_ADMIN_EMPLOYEE)->DESIGNATION_ID_FK)->DESIGNATION_HINDI;?> </p>
		<p><?php echo $master->DEPT_NAME_HINDI;?></p>
	</div>
</div>

<br>
<script type="text/javascript">window.onload = function() { window.print(); }</script><style>

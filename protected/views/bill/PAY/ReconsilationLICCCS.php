<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/oneadmin.css" rel="stylesheet">
<script type="text/javascript">window.onload = function() { window.print(); }</script>
<?php $master = Master::model()->findByPK(1); ?>
<h3 style="text-transform: uppercase;text-align:center;">DEDUCTION BILL IN R/O <?php echo ($model->BILL_TYPE == 1)? "OPS":"NPS"; ?> STAFF OF  <?php echo $master->DEPT_NAME?>FOR THE MONTH OF <?php echo date('M-Y', strtotime($model->CREATION_DATE))?></h3>
<h3 style="text-transform: uppercase;text-align: center">BILL NO: <?php echo $model->LIC_DED_BILL_NO; ?></h3>
<table class="pay-schedule-table">
	<thead>
		<tr>
			<th class="small-xxx right-br">S.No.</th>
			<th class="small right-br">SALARY BILL NO</th>
			<th class="small right-br">NET SALARY</th>
			<th class="small right-br">CREDIT CO-OP. SOCIETY</th>
			<th class="small-xx right-br">LIC </th>
			<th class="small-xx right-br">WATER CHARGES </th>
			<th class="small-xx right-br">MAINTENANCE CHARGES</th>
			<th class="small-xx right-br">CONSUMER SOCIETY</th>
			<th class="small-xx right-br">COURT ATTACHMENT</th>
			<th class="small-xx right-br">ASSN SUBSCRIPTION</th>
			<th class="small-xx right-br">TOTAL DEDUCTIONS</th>
			<th class="small-xx right-br">AMOUNT TO BE CREDITED TO BANK</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td class="small-xxx right-br">1</td>
			<td class="small right-br"><b><?php echo $model->BILL_NO;?></b></td>
			<td class="small right-br"><b><?php $NET = Yii::app()->db->createCommand("SELECT SUM(NET) as NET FROM tbl_salary_details WHERE BILL_ID_FK = $model->ID AND YEAR = $model->YEAR AND MONTH = $model->MONTH;")->queryRow()['NET']; echo $NET;?></b></td>
			<td class="small-xx right-br"><?php $CCS = Yii::app()->db->createCommand("SELECT SUM(CCS) as CCS FROM tbl_salary_details WHERE BILL_ID_FK = $model->ID AND YEAR = $model->YEAR AND MONTH = $model->MONTH;")->queryRow()['CCS']; echo $CCS;?></td>
			<td class="small-xx right-br"><?php $LIC = Yii::app()->db->createCommand("SELECT SUM(LIC) as LIC FROM tbl_salary_details WHERE BILL_ID_FK = $model->ID AND YEAR = $model->YEAR AND MONTH = $model->MONTH;")->queryRow()['LIC']; echo $LIC;?></td>
			<td class="small-xx right-br">0</td>
			<td class="small-xx right-br"></td>
			<td class="small-xx right-br">0</td>
			<td class="small-xx right-br">0</td>
			<td class="small-xx right-br"><?php $ASSOSC_SUB = Yii::app()->db->createCommand("SELECT SUM(ASSOSC_SUB) as ASSOSC_SUB FROM tbl_salary_details WHERE BILL_ID_FK = $model->ID AND YEAR = $model->YEAR AND MONTH = $model->MONTH;")->queryRow()['ASSOSC_SUB']; echo $ASSOSC_SUB;?></td>
			<td class="small-xx right-br"><?php echo $LIC + $CCS + $ASSOSC_SUB;?></td>
			<td class="small-xx right-br"><?php $AMOUNT_BANK = Yii::app()->db->createCommand("SELECT SUM(AMOUNT_BANK) as AMOUNT_BANK FROM tbl_salary_details WHERE BILL_ID_FK = $model->ID AND YEAR = $model->YEAR AND MONTH = $model->MONTH;")->queryRow()['AMOUNT_BANK']; echo $AMOUNT_BANK;?></td>
		</tr>
	</tbody>
	<tfoot>
		<th class="small-xxx right-br"></th>
		<th class="small right-br"></th>
		<th class="small right-br"><?php $NET = Yii::app()->db->createCommand("SELECT SUM(NET) as NET FROM tbl_salary_details WHERE BILL_ID_FK = $model->ID AND YEAR = $model->YEAR AND MONTH = $model->MONTH;")->queryRow()['NET']; echo $NET;?></th>
		<th class="small right-br"><?php $CCS = Yii::app()->db->createCommand("SELECT SUM(CCS) as CCS FROM tbl_salary_details WHERE BILL_ID_FK = $model->ID AND YEAR = $model->YEAR AND MONTH = $model->MONTH;")->queryRow()['CCS']; echo $CCS;?></th>
		<th class="small right-br"><?php $LIC = Yii::app()->db->createCommand("SELECT SUM(LIC) as LIC FROM tbl_salary_details WHERE BILL_ID_FK = $model->ID AND YEAR = $model->YEAR AND MONTH = $model->MONTH;")->queryRow()['LIC']; echo $LIC;?></th>
		<td class="small-xx right-br">0</td>
		<td class="small-xx right-br">0</td>
		<td class="small-xx right-br">0</td>
		<td class="small-xx right-br">0</td>
		<th class="small right-br"><?php $ASSOSC_SUB = Yii::app()->db->createCommand("SELECT SUM(ASSOSC_SUB) as ASSOSC_SUB FROM tbl_salary_details WHERE BILL_ID_FK = $model->ID AND YEAR = $model->YEAR AND MONTH = $model->MONTH;")->queryRow()['ASSOSC_SUB']; echo $ASSOSC_SUB;?></th>
		<td class="small-xx right-br"><?php echo $LIC + $CCS + $ASSOSC_SUB;?></td>
		<td class="small-xx right-br"><?php $AMOUNT_BANK = Yii::app()->db->createCommand("SELECT SUM(AMOUNT_BANK) as AMOUNT_BANK FROM tbl_salary_details WHERE BILL_ID_FK = $model->ID AND YEAR = $model->YEAR AND MONTH = $model->MONTH;")->queryRow()['AMOUNT_BANK']; echo $AMOUNT_BANK;?></td>
	</tfoot>
</table>

<p style="text-align: center; margin-top: 50px;"><b><?php echo $this->amountToWord($LIC + $CCS + $ASSOSC_SUB);?><b></p>
<br/><br/><br/><br/>
<p style="width: 80%;"><span style="font-size: 11px;float: right;margin-right: 10px;display: inline-block;width: 80%;">	1. E-Payment may be issued in the name of LIC of India (IFSC Code: IOBA0000268 and Account No: 026802000001098 ) for <span style="float: right;font-style: italic;">Rs.<?php echo $LIC;?></span></span></p>
<p style="width: 80%;"><span style="font-size: 11px;float: right;margin-right: 10px;display: inline-block;width: 80%;">	2. E-Payment may be issued in r/o Central Excise Credit Co-Operative Society Ltd (IFSC Code: CNRB0000431 and  Account No: 8415101000515) for Rs <span style="float: right;font-style: italic;">Rs.<?php echo $CCS;?></span></span></p>

<div style="font-weight: bold; width:400px; float: right;text-align:center; margin-top:50px;margin-right:-10px;">
	<p><?php echo Employee::model()->findByPK($master['DEPT_ADMIN_EMPLOYEE'])->NAME;?></p>
	<p><?php echo Designations::model()->findByPK(Employee::model()->findByPK($master['DEPT_ADMIN_EMPLOYEE'])->DESIGNATION_ID_FK)->DESIGNATION;?></p>
	<p><?php echo $master['DEPT_NAME']?></p>
</div>
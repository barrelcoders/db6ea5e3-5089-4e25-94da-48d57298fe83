<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/oneadmin.css" rel="stylesheet">
<style>*{font-size: 15px;}.pay-schedule-table tr, .pay-schedule-table th, .pay-schedule-table td {	text-align: center;height: 58px; page-break-inside: avoid;}</style>
<script type="text/javascript">window.onload = function() { window.print(); }</script>
<?php
	$master = Master::model()->findByPK(1);
?>
<!--<h3 style="text-transform: uppercase;text-align:center;"><?php echo $model->BILL_TITLE;?></h3>-->
<h2 style="text-transform: uppercase;text-align: center">BILL NO: <?php echo $model->BILL_NO; ?></h2><br>
<table class="pay-schedule-table">
	<thead>
		<tr>
			<th class="small-xxx right-br">S.No.</th>
			<th class="small-xxx">CGHS</th>
			<th class="small-xxx">LF</th>
			<th class="small-xxx">CGEGIS</th>
			<th class="small-xx"><?php echo ($model->BILL_TYPE == 1) ? "GPF<br>Contrib" : "CPF TIER I"?></th>
			<th class="small-xx"><?php echo ($model->BILL_TYPE == 1) ? "GPF<br>Sub" : "CPF TIER II"?></th>
			<th class="small-xxx">HBA</th>
			<th class="small-xxx">MCA</th>
			<th class="small-xxx">FAN</th>
			<th class="small-xxx">FLOOD</th>
			<th class="small-xxx">FEST</th>
			<th class="small-xxx">MISC</th>
			<th class="small-xxx">PLI</th>
			<th class="small-xx right-br left-br">DEDUCTION</th>
			<th class="small-xx right-br">NET</th>
			<th class="small-xxx">PT</th>
			<th class="small-xx">OTHER DED.</th>
			<th class="small-x left-br">AMOUNT BANK</th>
		</tr>
	</thead>
	<?php 
		$i = 1;	
		$employees = Yii::app()->db->createCommand("SELECT ID FROM tbl_employee ORDER BY DESIGNATION_ID_FK DESC")->queryAll();
		$employeesIds = array();
		foreach($employees as $employee) array_push($employeesIds, $employee['ID']);
		$criteria=new CDbCriteria;
		$criteria->order="FIELD(EMPLOYEE_ID_FK, ".implode( ", ", $employeesIds ).")";
		$criteria->condition = "BILL_ID_FK=$model->ID";
		$criteria->addInCondition('EMPLOYEE_ID_FK', $employeesIds);
		$salaries = SalaryDetails::model()->findAll($criteria);
	?>
	<tbody>
		<?php foreach ($salaries as $salary) { ?>
		<tr>
			<td class="small-xxx right-br"><?php echo $i; ?></td>
			<td class="small-xxx"><b><?php echo $salary->CGHS;?></b></td>
			<td class="small-xxx"><b><?php echo $salary->LF;?></b></td>
			<td class="small-xxx"><?php echo $salary->CGEGIS; ?></td>
			<td class="small-xx"><?php echo $salary->CPF_TIER_I; ?></td>
			<td class="small-xx"><?php echo $salary->CPF_TIER_II; ?></td>
			<td class="small-xxx"><?php echo $salary->HBA_EMI; ?></td>
			<td class="small-xxx"><?php echo $salary->MCA_EMI; ?></td>
			<td class="small-xxx"><?php echo $salary->FAN_EMI; ?></td>
			<td class="small-xxx"><?php echo $salary->FLOOD_EMI; ?></td>
			<td class="small-xxx"><?php echo $salary->FEST_EMI; ?></td>
			<td class="small-xxx"><?php echo $salary->MISC; ?></td>
			<td class="small-xxx"><?php echo $salary->PLI; ?></td>
			<td class="small-xx right-br left-br"><?php echo $salary->DED; ?></td>
			<td class="small-xx right-br"><?php echo $salary->NET; ?></td>
			<td class="small-xxx"><?php echo $salary->PT; ?></td>
			<td class="small-xx"><?php echo $salary->OTHER_DED; ?></td>
			<td class="small-x left-br"><?php echo $salary->AMOUNT_BANK; ?></td>
		</tr>
		<?php 
			$i++;
		} ?>
	</tbody>
	<tfoot>
		<th class="small-xxx right-br"></th>
		<th class="small-xxx"><?php echo Yii::app()->db->createCommand("SELECT SUM(CGHS) as CGHS FROM tbl_salary_details WHERE BILL_ID_FK = $model->ID;")->queryRow()['CGHS'];?></th>
		<th class="small-xxx"><?php echo Yii::app()->db->createCommand("SELECT SUM(LF) as LF FROM tbl_salary_details WHERE BILL_ID_FK = $model->ID;")->queryRow()['LF'];?></th>
		<th class="small-xxx"><?php echo Yii::app()->db->createCommand("SELECT SUM(CGEGIS) as CGEGIS FROM tbl_salary_details WHERE BILL_ID_FK = $model->ID;")->queryRow()['CGEGIS'];?></th>
		<th class="small-xx"><?php echo Yii::app()->db->createCommand("SELECT SUM(CPF_TIER_I) as CPF_TIER_I FROM tbl_salary_details WHERE BILL_ID_FK = $model->ID;")->queryRow()['CPF_TIER_I'];?></th>
		<th class="small-xx"><?php echo Yii::app()->db->createCommand("SELECT SUM(CPF_TIER_II) as CPF_TIER_II FROM tbl_salary_details WHERE BILL_ID_FK = $model->ID;")->queryRow()['CPF_TIER_II'];?></th>
		<th class="small-xxx"><?php echo Yii::app()->db->createCommand("SELECT SUM(HBA_EMI) as HBA_EMI FROM tbl_salary_details WHERE BILL_ID_FK = $model->ID;")->queryRow()['HBA_EMI'];?></th>
		<th class="small-xxx"><?php echo Yii::app()->db->createCommand("SELECT SUM(MCA_EMI) as MCA_EMI FROM tbl_salary_details WHERE BILL_ID_FK = $model->ID;")->queryRow()['MCA_EMI'];?></th>
		<th class="small-xxx"><?php echo Yii::app()->db->createCommand("SELECT SUM(FAN_EMI) as FAN_EMI FROM tbl_salary_details WHERE BILL_ID_FK = $model->ID;")->queryRow()['FAN_EMI'];?></th>
		<th class="small-xxx"><?php echo Yii::app()->db->createCommand("SELECT SUM(FLOOD_EMI) as FLOOD_EMI FROM tbl_salary_details WHERE BILL_ID_FK = $model->ID;")->queryRow()['FLOOD_EMI'];?></th>
		<th class="small-xxx"><?php echo Yii::app()->db->createCommand("SELECT SUM(FEST_EMI) as FEST_EMI FROM tbl_salary_details WHERE BILL_ID_FK = $model->ID;")->queryRow()['FEST_EMI'];?></th>
		<th class="small-xxx"><?php echo Yii::app()->db->createCommand("SELECT SUM(MISC) as MISC FROM tbl_salary_details WHERE BILL_ID_FK = $model->ID;")->queryRow()['MISC'];?></th>
		<th class="small-xxx"><?php echo Yii::app()->db->createCommand("SELECT SUM(PLI) as PLI FROM tbl_salary_details WHERE BILL_ID_FK = $model->ID;")->queryRow()['PLI'];?></th>
		<th class="small-xx right-br left-br"><?php echo Yii::app()->db->createCommand("SELECT SUM(DED) as DED FROM tbl_salary_details WHERE BILL_ID_FK = $model->ID;")->queryRow()['DED'];?></th>
		<th class="small-xx right-br"><?php echo Yii::app()->db->createCommand("SELECT SUM(NET) as NET FROM tbl_salary_details WHERE BILL_ID_FK = $model->ID;")->queryRow()['NET'];?></th>
		<th class="small-xxx"><?php echo Yii::app()->db->createCommand("SELECT SUM(PT) as PT FROM tbl_salary_details WHERE BILL_ID_FK = $model->ID;")->queryRow()['PT'];?></th>
		<th class="small-xx"><?php echo Yii::app()->db->createCommand("SELECT SUM(OTHER_DED) as OTHER_DED FROM tbl_salary_details WHERE BILL_ID_FK = $model->ID;")->queryRow()['OTHER_DED'];?></th>
		<th class="small-x left-br"><?php $AMOUNT_BANK = Yii::app()->db->createCommand("SELECT SUM(AMOUNT_BANK) as AMOUNT_BANK FROM tbl_salary_details WHERE BILL_ID_FK = $model->ID;")->queryRow()['AMOUNT_BANK']; echo $AMOUNT_BANK; ?></th>
	</tfoot>
</table>
<div style="width:900px;margin:10px auto 0 auto;">
	<table style="border: 1px solid #FFF;border-spacing:0px;">
		<tr>
			<td style="width:300px;">LIC OF INDIA</td>
			<td style="width:100px;text-align:center;">IOBA0000268</td>
			<td style="width:300px;text-align:center;">026802000001098</td>
			<td style="width:200px;">Rs. <?php echo Yii::app()->db->createCommand("SELECT SUM(LIC) as LIC FROM tbl_salary_details WHERE BILL_ID_FK = $model->ID;")->queryRow()['LIC'];?>/-</td>
		</tr>
		<tr>
			<td style="width:300px;">CREDIT CO-SOCIETY</td>
			<td style="width:100px;text-align:center;">CNRB0000431</td>
			<td style="width:300px;text-align:center;">8415101000515</td>
			<td style="width:200px;">Rs. <?php echo Yii::app()->db->createCommand("SELECT SUM(CCS) as CCS FROM tbl_salary_details WHERE BILL_ID_FK = $model->ID;")->queryRow()['CCS'];?>/-</td>
		</tr>
		<tr>
			<td style="width:300px;">WELFARE ASSOCIATION, MADIWAL</td>
			<td style="width:100px;text-align:center;">CBIN0282816</td>
			<td style="width:300px;text-align:center;">1213280013</td>
			<td style="width:200px;">Rs. <?php echo Yii::app()->db->createCommand("SELECT SUM(MAINT_MADIWALA) as MAINT_MADIWALA FROM tbl_salary_details WHERE BILL_ID_FK = $model->ID;")->queryRow()['MAINT_MADIWALA'];?>/-</td>
		</tr>
		<tr>
			<td style="width:300px;">WELFARE ASSOCIATION, JAYAMAHAL</td>
			<td style="width:100px;text-align:center;"></td>
			<td style="width:300px;text-align:center;"></td>
			<td style="width:200px;">Rs. <?php echo Yii::app()->db->createCommand("SELECT SUM(MAINT_JAYAMAHAL) as MAINT_JAYAMAHAL FROM tbl_salary_details WHERE BILL_ID_FK = $model->ID;")->queryRow()['MAINT_JAYAMAHAL'];?>/-</td>
		</tr>
		<tr>
			<td style="width:300px;">OFFICERS ASSOCIATION</td>
			<td style="width:100px;text-align:center;">CNRB0008415</td>
			<td style="width:300px;text-align:center;">8415101001367</td>
			<td style="width:200px;">Rs. <?php echo Yii::app()->db->createCommand("SELECT SUM(ASSOSC_SUB) as ASSOSC_SUB FROM tbl_salary_details WHERE BILL_ID_FK = $model->ID;")->queryRow()['ASSOSC_SUB'];?>/-</td>
		</tr>
	</table>
</div>
<h4 style="text-align:center;margin-top: 10px;">GRAND TOTAL AMOUNT CREADITED TO BANK (E-PAYMENT): Rs. <?php $AMOUNT_BANK = Yii::app()->db->createCommand("SELECT SUM(AMOUNT_BANK) + SUM(OTHER_DED) as TOTAL FROM tbl_salary_details WHERE BILL_ID_FK = $model->ID;")->queryRow()['TOTAL']; echo $AMOUNT_BANK;?>/-</h4>
<br><div style="text-align:center; font-weight: bold; width:400px; margin:0 auto;">"Certified that monthly Contribution under Central Government Employees Insurance Scheme has been recovered from persons who are covered under the Scheme"</div>
<div style="font-weight: bold; width:400px; float: right;text-align:center; margin-top:100px;margin-right:-10px;">
	<p>(<?php echo Employee::model()->findByPK($master['DEPT_ADMIN_EMPLOYEE'])->NAME;?>)</p>
	<p><?php echo Designations::model()->findByPK(Employee::model()->findByPK($master['DEPT_ADMIN_EMPLOYEE'])->DESIGNATION_ID_FK)->DESIGNATION;?></p>
	<p><?php echo $master['DEPT_NAME']?></p>
</div>


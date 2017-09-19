<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/oneadmin.css" rel="stylesheet">
<script type="text/javascript">window.onload = function() { window.print(); }</script>
<?php $master = Master::model()->findByPK(1); ?>
<h3 style="text-transform: uppercase;text-align:center;">BANK DETAILS WITH IFSC CODE IN RESPECT R/O <?php echo ($model->BILL_TYPE == 1)? "OPS":"NPS"; ?> STAFF OF  <?php echo $master->DEPT_NAME?>FOR THE MONTH OF <?php echo date('M-Y', strtotime($model->CREATION_DATE))?></h3>
<h3 style="text-transform: uppercase;text-align: center">BILL NO: <?php echo $model->BILL_NO; ?></h3>
<table class="pay-schedule-table">
	<thead>
		<tr>
			<th class="small-xxx right-br">S.No.</th>
			<!--<th class="small-xx right-br">MICR</th>-->
			<th class="small right-br">NAME</th>
			<th class="small-xx right-br">IFSC CODE</th>
			<th class="small-xx right-br">ACCOUNT NUMBER</th>
			<th class="small-xx">NET SALARY</th>
		</tr>
	</thead>
	<?php 
		$i = 1;	
		$employees = Yii::app()->db->createCommand("SELECT ID FROM tbl_employee ORDER BY DESIGNATION_ID_FK DESC")->queryAll();
		$employeesIds = array();
		foreach($employees as $employee) array_push($employeesIds, $employee['ID']);
		$criteria=new CDbCriteria;
		$criteria->order="FIELD(EMPLOYEE_ID_FK, ".implode( ", ", $employeesIds ).")";
		$criteria->condition = "BILL_ID_FK=$model->ID AND YEAR=$model->YEAR AND $model->MONTH";
		$criteria->addInCondition('EMPLOYEE_ID_FK', $employeesIds);
		$salaries = SalaryDetails::model()->findAll($criteria);
	?>
	<tbody>
		<?php foreach ($salaries as $salary) { ?>
		<tr>
			<td class="small-xxx right-br"><?php echo $i; ?></td>
			<!--<td class="small-xx right-br"><b><?php echo Employee::model()->findByPK($salary->EMPLOYEE_ID_FK)->MICR;?></b></td>-->
			<td class="small right-br"><b><?php echo Employee::model()->findByPK($salary->EMPLOYEE_ID_FK)->NAME;?></b></td>
			<td class="small-xx right-br"><b><?php echo Employee::model()->findByPK($salary->EMPLOYEE_ID_FK)->IFSC;?></b></td>
			<td class="small-xx right-br"><?php echo Employee::model()->findByPK($salary->EMPLOYEE_ID_FK)->ACCOUNT_NO; ?></td>
			<td class="small-xx"><?php echo $salary->AMOUNT_BANK; ?></td>
		</tr>
		<?php 
			$i++;
		} ?>
	</tbody>
	<tfoot>
		<th class="small-xxx right-br"></th>
		<!--<th class="small-xx right-br"></th>-->
		<th class="small right-br"></th>
		<th class="small-xx right-br"></th>
		<th class="small-xx right-br"></th>
		<th class="small-xx"><?php $AMOUNT_BANK = Yii::app()->db->createCommand("SELECT SUM(AMOUNT_BANK) as AMOUNT_BANK FROM tbl_salary_details WHERE BILL_ID_FK = $model->ID;")->queryRow()['AMOUNT_BANK']; echo $AMOUNT_BANK;?></th>
	</tfoot>
</table>

<p style="text-align: center; margin-top: 10px;"><b><?php echo $this->amountToWord($AMOUNT_BANK);?><b></p>

<div style="width:900px;margin:10px auto 0 auto;">
	<table style="border: 1px solid #FFF;border-spacing:0px;">
		<tr>
			<td style="width:300px;">LIC OF INDIA</td>
			<td style="width:100px;text-align:center;">ICIC0000002</td>
			<td style="width:300px;text-align:center;">000205026405</td>
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
		</tr
		<tr>
			<td style="width:300px;">&nbsp;</td>
			<td style="width:100px;text-align:center;"></td>
			<td style="width:300px;text-align:center;"></td>
			<td style="width:200px;"></td>
		</tr>
		<tr>
			<td style="width:300px;">OFFICERS ASSOCIATION</td>
			<td style="width:100px;text-align:center;">CNRB0008415</td>
			<td style="width:300px;text-align:center;">8415101001367</td>
			<td style="width:200px;">Rs. <?php echo Yii::app()->db->createCommand("SELECT SUM(ASSOSC_SUB) as ASSOSC_SUB FROM tbl_salary_details WHERE BILL_ID_FK = $model->ID AND EMPLOYEE_ID_FK IN (SELECT ID FROM tbl_employee WHERE DESIGNATION_ID_FK IN (9,10,16,17,18));")->queryRow()['ASSOSC_SUB'];?>/-</td>
		</tr>
		<tr>
			<td style="width:300px;">All India Association of Central Excise Gazetted Officers, Karnataka Unit</td>
			<td style="width:100px;text-align:center;">SBIN0040022</td>
			<td style="width:300px;text-align:center;">54044624904</td>
			<td style="width:200px;">Rs. <?php echo Yii::app()->db->createCommand("SELECT SUM(ASSOSC_SUB) as ASSOSC_SUB FROM tbl_salary_details WHERE BILL_ID_FK = $model->ID AND EMPLOYEE_ID_FK IN (SELECT ID FROM tbl_employee WHERE DESIGNATION_ID_FK=15);")->queryRow()['ASSOSC_SUB'];?>/-</td>
		</tr>
		<tr>
			<td style="width:300px;">Indian Revenue Service (Customs & Central Excise) Association</td>
			<td style="width:100px;text-align:center;">SBIN0000625</td>
			<td style="width:300px;text-align:center;">10314223042</td>
			<td style="width:200px;">Rs. <?php echo Yii::app()->db->createCommand("SELECT SUM(ASSOSC_SUB) as ASSOSC_SUB FROM tbl_salary_details WHERE BILL_ID_FK = $model->ID AND EMPLOYEE_ID_FK IN (SELECT ID FROM tbl_employee WHERE DESIGNATION_ID_FK>=20);")->queryRow()['ASSOSC_SUB'];?>/-</td>
		</tr>
	</table>
</div>
<div style="font-weight: bold; width:400px; float: right;text-align:center; margin-top:100px;margin-right:-10px;">
	<p>(<?php echo Employee::model()->findByPK($master['DEPT_ADMIN_EMPLOYEE'])->NAME;?>)</p>
	<p><?php echo Designations::model()->findByPK(Employee::model()->findByPK($master['DEPT_ADMIN_EMPLOYEE'])->DESIGNATION_ID_FK)->DESIGNATION;?></p>
	<p><?php echo $master['DEPT_NAME']?></p>
</div>
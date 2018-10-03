<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/oneadmin.css" rel="stylesheet">
<style>*{font-size: 15px;}.pay-schedule-table tr, .pay-schedule-table th, .pay-schedule-table td {	text-align: center;height: 60px; page-break-inside: avoid;}
.pay-schedule-table thead th{font-size: 14px;}</style>
<script type="text/javascript">window.onload = function() { window.print(); }</script>
<?php
	$master = Master::model()->findByPK(1);
	$periods = $this->getBillPeriods($model->ID);
	$total_months = count($periods);
?>
<h2 style="text-transform: uppercase;text-align:center;"><?php echo $model->BILL_TITLE; ?></h2>
<h2 style="text-transform: uppercase;text-align: center">BILL NO: <?php echo $model->BILL_NO; ?></h2><br>
<table class="pay-schedule-table">
	<thead>
		<tr>
			<th class="small-xxx left-br right-br">S.No.</th>
			<th class="small-x right-br">NAME</th>
			<th class="small-x right-br">DESIGNATION</th>
			<?php if($model->IS_MULTIPLE_MONTH) {?>
			<th class="small-xx right-br">MONTH</th>
			<?php } ?>
			<th class="small-x right-br">BASIC</th>
			<th class="small-xxx right-br">SP</th>
			<th class="small-xx right-br">HRA</th>
			<th class="small-xx right-br">DA</th>
			<th class="small-xx right-br">TA</th>
			<!--<th class="small-xxx right-br">WA</th>-->
			<th class="small-xx right-br">GROSS</th>
			<th class="small-xx right-br">IT</th>
			<th class="small-xxx right-br">CGHS</th>
			<th class="small-xxx right-br">LF</th>
			<th class="small-xxx right-br">CGEGIS</th>
			<th class="small-xx right-br"><?php echo ($model->BILL_TYPE == 1) ? "GPF<br>Cont." : "CPF TIER I"?></th>
			<th class="small-xx right-br"><?php echo ($model->BILL_TYPE == 1) ? "GPF<br>Rec." : "CPF TIER II"?></th>
			<th class="small-xxx right-br">HBA</th>
			<th class="small-xxx right-br">MCA</th>
			<th class="small-xxx right-br">COMP</th>
			<th class="small-xxx right-br">MISC</th>
			<th class="small-xxx right-br">COURT</th>
			<th class="small-xxx right-br">PLI</th>
			<th class="small-xx right-br">DEDUCTION</th>
			<th class="small-xx right-br">NET</th>
			<th class="small-xxx right-br">PT</th>
			<th class="small-xx right-br">OTHER DED.</th>
			<th class="small-x  right-br">AMOUNT BANK</th>
			<th class="small-x  right-br">REMARKS</th>
		</tr>
	</thead>
	<?php 
		$i = 1;	
		
		$criteria = new CDbCriteria();
		$criteria->select = 't.EMPLOYEE_ID_FK';
		$criteria->condition = 't.BILL_ID_FK='.$model->ID;
		$criteria->group = 't.EMPLOYEE_ID_FK';
		$criteria->join='INNER JOIN tbl_employee e ON e.ID = t.EMPLOYEE_ID_FK';
		$criteria->order = 'e.FOLIO_NO ASC';
		$employeesInSalary = SalaryDetails::model()->findAll($criteria);
	?>
	<tbody>
		<?php foreach ($employeesInSalary as $employee) {
				$j=1;
				foreach($periods as $period){
					$salary = SalaryDetails::model()->find("t.EMPLOYEE_ID_FK=".$employee->EMPLOYEE_ID_FK." AND t.BILL_ID_FK=".$model->ID." AND t.MONTH=".$period['MONTH']." AND t.YEAR=".$period['YEAR']);
					if($model->IS_MULTIPLE_MONTH) { 
						if($j==1){ ?>
							<tr>
								<td rowspan="<?php echo $total_months;?>" class="small-xxx left-br right-br"><?php echo $i; ?></td>
								<td rowspan="<?php echo $total_months;?>" class="small-x right-br"><b><?php echo Employee::model()->findByPK($salary->EMPLOYEE_ID_FK)->NAME;?></b></td>
								<td rowspan="<?php echo $total_months;?>" class="small-x right-br"><b><?php echo Designations::model()->findByPK(Employee::model()->findByPK($salary->EMPLOYEE_ID_FK)->DESIGNATION_ID_FK)->DESIGNATION;?></b></td>
								<td class="small-xx right-br"><?php echo $period['FORMAT']; ?></td>
								<td class="small-xx right-br"><?php echo $salary->BASIC; ?></td>
								<td class="small-xxx right-br"><?php echo $salary->SP; ?></td>
								<td class="small-xx right-br"><?php echo $salary->HRA; ?></td>
								<td class="small-xx right-br"><?php echo $salary->DA; ?></td>
								<td class="small-xx right-br"><?php echo $salary->TA; ?></td>
								<!--<td class="small-xxx right-br"><?php //echo $salary->WA; ?></td>-->
								<td class="small-xx right-br"><?php echo $salary->GROSS; ?></td>
								<td class="small-xx right-br"><?php echo $salary->IT; ?></td>
								<td class="small-xxx right-br"><b><?php echo $salary->CGHS;?></b></td>
								<td class="small-xxx right-br"><b><?php echo $salary->LF;?></b></td>
								<td class="small-xxx right-br"><?php echo $salary->CGEGIS; ?></td>
								<td class="small-xx right-br"><?php echo $salary->CPF_TIER_I; ?></td>
								<td class="small-xx right-br"><?php echo $salary->CPF_TIER_II; ?></td>
								<td class="small-xxx right-br"><?php echo $salary->HBA_EMI; ?></td>
								<td class="small-xxx right-br"><?php echo $salary->MCA_EMI; ?></td>
								<td class="small-xxx right-br"><?php echo $salary->COMP_EMI; ?></td>
								<td class="small-xxx right-br"><?php echo $salary->MISC; ?></td>
								<td class="small-xxx right-br"><?php echo $salary->COURT_ATTACHMENT; ?></td>
								<td class="small-xxx right-br"><?php echo $salary->PLI; ?></td>
								<td class="small-xx right-br"><?php echo $salary->DED; ?></td>
								<td class="small-xx right-br"><?php echo $salary->NET; ?></td>
								<td class="small-xxx right-br"><?php echo $salary->PT; ?></td>
								<td class="small-xx right-br"><?php echo $salary->OTHER_DED; ?></td>
								<td class="small-x right-br"><?php echo $salary->AMOUNT_BANK; ?></td>
								<td class="small-x right-br"><?php echo $salary->REMARKS; ?></td>
							</tr>
						<?php } else { ?>
							<tr>
								<td class="small-xx right-br"><?php echo $period['FORMAT']; ?></td>
								<td class="small-xx right-br"><?php echo $salary->BASIC; ?></td>
								<td class="small-xxx right-br"><?php echo $salary->SP; ?></td>
								<td class="small-xx right-br"><?php echo $salary->HRA; ?></td>
								<td class="small-xx right-br"><?php echo $salary->DA; ?></td>
								<td class="small-xx right-br"><?php echo $salary->TA; ?></td>
								<!--<td class="small-xxx right-br"><?php //echo $salary->WA; ?></td>-->
								<td class="small-xx right-br"><?php echo $salary->GROSS; ?></td>
								<td class="small-xx right-br"><?php echo $salary->IT; ?></td>
								<td class="small-xxx right-br"><b><?php echo $salary->CGHS;?></b></td>
								<td class="small-xxx right-br"><b><?php echo $salary->LF;?></b></td>
								<td class="small-xxx right-br"><?php echo $salary->CGEGIS; ?></td>
								<td class="small-xx right-br"><?php echo $salary->CPF_TIER_I; ?></td>
								<td class="small-xx right-br"><?php echo $salary->CPF_TIER_II; ?></td>
								<td class="small-xxx right-br"><?php echo $salary->HBA_EMI; ?></td>
								<td class="small-xxx right-br"><?php echo $salary->MCA_EMI; ?></td>
								<td class="small-xxx right-br"><?php echo $salary->COMP_EMI; ?></td>
								<td class="small-xxx right-br"><?php echo $salary->MISC; ?></td>
								<td class="small-xxx right-br"><?php echo $salary->COURT_ATTACHMENT; ?></td>
								<td class="small-xxx right-br"><?php echo $salary->PLI; ?></td>
								<td class="small-xx right-br"><?php echo $salary->DED; ?></td>
								<td class="small-xx right-br"><?php echo $salary->NET; ?></td>
								<td class="small-xxx right-br"><?php echo $salary->PT; ?></td>
								<td class="small-xx right-br"><?php echo $salary->OTHER_DED; ?></td>
								<td class="small-x right-br"><?php echo $salary->AMOUNT_BANK; ?></td>
								<td class="small-x right-br"><?php echo $salary->REMARKS; ?></td>
							</tr>
							<?php
						}
						$j++;
					} else { ?>
						<tr>
							<td class="small-xxx left-br right-br"><?php echo $i; ?></td>
							<td class="small-x right-br"><b><?php echo Employee::model()->findByPK($salary->EMPLOYEE_ID_FK)->NAME;?></b></td>
							<td class="small-x right-br"><b><?php echo Designations::model()->findByPK(Employee::model()->findByPK($salary->EMPLOYEE_ID_FK)->DESIGNATION_ID_FK)->DESIGNATION;?></b></td>
							<td class="small-xx right-br"><?php echo $salary->BASIC; ?></td>
							<td class="small-xxx right-br"><?php echo $salary->SP; ?></td>
							<td class="small-xx right-br"><?php echo $salary->HRA; ?></td>
							<td class="small-xx right-br"><?php echo $salary->DA; ?></td>
							<td class="small-xx right-br"><?php echo $salary->TA; ?></td>
							<!--<td class="small-xxx right-br"><?php //echo $salary->WA; ?></td>-->
							<td class="small-xx right-br"><?php echo $salary->GROSS; ?></td>
							<td class="small-xx right-br"><?php echo $salary->IT; ?></td>
							<td class="small-xxx right-br"><b><?php echo $salary->CGHS;?></b></td>
							<td class="small-xxx right-br"><b><?php echo $salary->LF;?></b></td>
							<td class="small-xxx right-br"><?php echo $salary->CGEGIS; ?></td>
							<td class="small-xx right-br"><?php echo $salary->CPF_TIER_I; ?></td>
							<td class="small-xx right-br"><?php echo $salary->CPF_TIER_II; ?></td>
							<td class="small-xxx right-br"><?php echo $salary->HBA_EMI; ?></td>
							<td class="small-xxx right-br"><?php echo $salary->MCA_EMI; ?></td>
							<td class="small-xxx right-br"><?php echo $salary->COMP_EMI; ?></td>
							<td class="small-xxx right-br"><?php echo $salary->MISC; ?></td>
							<td class="small-xxx right-br"><?php echo $salary->COURT_ATTACHMENT; ?></td>
							<td class="small-xxx right-br"><?php echo $salary->PLI; ?></td>
							<td class="small-xx right-br"><?php echo $salary->DED; ?></td>
							<td class="small-xx right-br"><?php echo $salary->NET; ?></td>
							<td class="small-xxx right-br"><?php echo $salary->PT; ?></td>
							<td class="small-xx right-br"><?php echo $salary->OTHER_DED; ?></td>
							<td class="small-x right-br"><?php echo $salary->AMOUNT_BANK; ?></td>
							<td class="small-x right-br"><?php echo $salary->REMARKS; ?></td>
						</tr>
					<?php }  ?>
			<?php } ?>
		<?php  $i++; 
		} ?>
	</tbody>
	<tfoot>
		<th class="small-xxx left-br right-br"></th>
		<th class="small-x right-br"></th>
		<th class="small-x right-br"></th>
		<?php if($model->IS_MULTIPLE_MONTH) {?>
		<th class="small-x right-br"></th>
		<?php } ?>
		<th class="small-xx right-br"><?php $BASIC = Yii::app()->db->createCommand("SELECT SUM(BASIC) as BASIC FROM tbl_salary_details WHERE BILL_ID_FK = $model->ID;")->queryRow()['BASIC'];echo $BASIC;?></th>
		<th class="small-xxx right-br"><?php echo Yii::app()->db->createCommand("SELECT SUM(SP) as SP FROM tbl_salary_details WHERE BILL_ID_FK = $model->ID;")->queryRow()['SP'];?></th>
		<th class="small-xx right-br"><?php echo Yii::app()->db->createCommand("SELECT SUM(HRA) as HRA FROM tbl_salary_details WHERE BILL_ID_FK = $model->ID;")->queryRow()['HRA'];?></th>
		<th class="small-xx right-br"><?php echo Yii::app()->db->createCommand("SELECT SUM(DA) as DA FROM tbl_salary_details WHERE BILL_ID_FK = $model->ID;")->queryRow()['DA'];?></th>
		<th class="small-xx right-br"><?php echo Yii::app()->db->createCommand("SELECT SUM(TA) as TA FROM tbl_salary_details WHERE BILL_ID_FK = $model->ID;")->queryRow()['TA'];?></th>
		<!--<th class="small-xxx right-br"><?php //echo Yii::app()->db->createCommand("SELECT SUM(WA) as WA FROM tbl_salary_details WHERE BILL_ID_FK = $model->ID;")->queryRow()['WA'];?></th>-->
		<th class="small-xx right-br"><?php echo Yii::app()->db->createCommand("SELECT SUM(GROSS) as GROSS FROM tbl_salary_details WHERE BILL_ID_FK = $model->ID;")->queryRow()['GROSS'];?></th>
		<th class="small-xx right-br"><?php echo Yii::app()->db->createCommand("SELECT SUM(IT) as IT FROM tbl_salary_details WHERE BILL_ID_FK = $model->ID;")->queryRow()['IT'];?></th>
		<th class="small-xxx right-br"><?php echo Yii::app()->db->createCommand("SELECT SUM(CGHS) as CGHS FROM tbl_salary_details WHERE BILL_ID_FK = $model->ID;")->queryRow()['CGHS'];?></th>
		<th class="small-xxx right-br"><?php echo Yii::app()->db->createCommand("SELECT SUM(LF) as LF FROM tbl_salary_details WHERE BILL_ID_FK = $model->ID;")->queryRow()['LF'];?></th>
		<th class="small-xxx right-br"><?php echo Yii::app()->db->createCommand("SELECT SUM(CGEGIS) as CGEGIS FROM tbl_salary_details WHERE BILL_ID_FK = $model->ID;")->queryRow()['CGEGIS'];?></th>
		<th class="small-xx right-br"><?php echo Yii::app()->db->createCommand("SELECT SUM(CPF_TIER_I) as CPF_TIER_I FROM tbl_salary_details WHERE BILL_ID_FK = $model->ID;")->queryRow()['CPF_TIER_I'];?></th>
		<th class="small-xx right-br"><?php echo Yii::app()->db->createCommand("SELECT SUM(CPF_TIER_II) as CPF_TIER_II FROM tbl_salary_details WHERE BILL_ID_FK = $model->ID;")->queryRow()['CPF_TIER_II'];?></th>
		<th class="small-xxx right-br"><?php echo Yii::app()->db->createCommand("SELECT SUM(HBA_EMI) as HBA_EMI FROM tbl_salary_details WHERE BILL_ID_FK = $model->ID;")->queryRow()['HBA_EMI'];?></th>
		<th class="small-xxx right-br"><?php echo Yii::app()->db->createCommand("SELECT SUM(MCA_EMI) as MCA_EMI FROM tbl_salary_details WHERE BILL_ID_FK = $model->ID;")->queryRow()['MCA_EMI'];?></th>
		<th class="small-xxx right-br"><?php echo Yii::app()->db->createCommand("SELECT SUM(COMP_EMI) as COMP_EMI FROM tbl_salary_details WHERE BILL_ID_FK = $model->ID;")->queryRow()['COMP_EMI'];?></th>
		<th class="small-xxx right-br"><?php echo Yii::app()->db->createCommand("SELECT SUM(MISC) as MISC FROM tbl_salary_details WHERE BILL_ID_FK = $model->ID;")->queryRow()['MISC'];?></th>
		<th class="small-xxx right-br"><?php echo Yii::app()->db->createCommand("SELECT SUM(COURT_ATTACHMENT) as COURT_ATTACHMENT FROM tbl_salary_details WHERE BILL_ID_FK = $model->ID;")->queryRow()['COURT_ATTACHMENT'];?></th>
		<th class="small-xxx right-br"><?php echo Yii::app()->db->createCommand("SELECT SUM(PLI) as PLI FROM tbl_salary_details WHERE BILL_ID_FK = $model->ID;")->queryRow()['PLI'];?></th>
		<th class="small-xx right-br"><?php echo Yii::app()->db->createCommand("SELECT SUM(DED) as DED FROM tbl_salary_details WHERE BILL_ID_FK = $model->ID;")->queryRow()['DED'];?></th>
		<th class="small-xx right-br"><?php echo Yii::app()->db->createCommand("SELECT SUM(NET) as NET FROM tbl_salary_details WHERE BILL_ID_FK = $model->ID;")->queryRow()['NET'];?></th>
		<th class="small-xxx right-br"><?php echo Yii::app()->db->createCommand("SELECT SUM(PT) as PT FROM tbl_salary_details WHERE BILL_ID_FK = $model->ID;")->queryRow()['PT'];?></th>
		<th class="small-xx right-br"><?php echo Yii::app()->db->createCommand("SELECT SUM(OTHER_DED) as OTHER_DED FROM tbl_salary_details WHERE BILL_ID_FK = $model->ID;")->queryRow()['OTHER_DED'];?></th>
		<th class="small-x right-br"><?php $AMOUNT_BANK = Yii::app()->db->createCommand("SELECT SUM(AMOUNT_BANK) as AMOUNT_BANK FROM tbl_salary_details WHERE BILL_ID_FK = $model->ID;")->queryRow()['AMOUNT_BANK']; echo $AMOUNT_BANK; ?></th>
		<th class="small-x right-br"></th>
	</tfoot>
</table>

<div style="width: 400px; margin: 0 auto; font-size: 20px; margin-top:100px;display:none;">
	<?php $appropiations = Yii::app()->db->createCommand("SELECT * FROM tbl_appropiation_register WHERE BILL_NO = $model->ID")->queryRow(); ?>
	<h4 style="text-decoration: underline;">Appropiation</h4>
	<p><b>Budget: </b>Rs. <?php echo Budget::model()->findByPK($appropiations['BUDGET_ID'])->AMOUNT;?>/-</p>
	<p><b>Bill Amount: </b>Rs. <?php echo $appropiations['BILL_AMOUNT'];?>/-</p>
	<p><b>Expenditure Including Bill: </b>Rs. <?php echo $appropiations['EXPENDITURE_INC_BILL'];?>/-</p>
	<p><b>Balance: </b>Rs. <?php echo $appropiations['BALANCE'];?>/-</p>
</div>
<br><br>

<div style="width:900px;margin:10px auto 0 auto;">
	<table style="border: 1px solid #FFF;border-spacing:0px;">
		<tr>
			<td style="width:300px;">LIC OF INDIA</td>
			<td style="width:100px;text-align:center;">UTIB0001028</td>
			<td style="width:300px;text-align:center;">917020077347447</td>
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
			<td style="width:300px;">MINISTRIAL OFFICERS ASSOCIATION</td>
			<td style="width:100px;text-align:center;">CNRB0008415</td>
			<td style="width:300px;text-align:center;">8415101200127</td>
			<td style="width:200px;">Rs. <?php echo Yii::app()->db->createCommand("SELECT SUM(ASSOSC_SUB) as ASSOSC_SUB FROM tbl_salary_details WHERE BILL_ID_FK = $model->ID AND EMPLOYEE_ID_FK IN (SELECT ID FROM tbl_employee WHERE DESIGNATION_ID_FK IN (8, 9,10,16,17,18));")->queryRow()['ASSOSC_SUB'];?>/-</td>
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
<br><br>
<h4 style="text-align:center;margin-top: 10px;">GRAND TOTAL AMOUNT CREADITED TO BANK (E-PAYMENT): Rs. <?php $AMOUNT_BANK = Yii::app()->db->createCommand("SELECT SUM(AMOUNT_BANK) + SUM(OTHER_DED) as TOTAL FROM tbl_salary_details WHERE BILL_ID_FK = $model->ID;")->queryRow()['TOTAL']; echo $AMOUNT_BANK;?>/-</h4>
<br><br><p style="text-align: center;font-weight: bold;font-size:16px;"><?php echo $this->amountToWord($AMOUNT_BANK);?></p>
<br><br><br><div style="text-align:center; font-weight: bold; width:400px; margin:0 auto;">"Certified that monthly Contribution under Central Government Employees Insurance Scheme has been recovered from persons who are covered under the Scheme"</div>

<br><br>
<!--
<div>
	<p style="font-weight: bold;">Remarks</p>
	<ol>
		<?php 
			$i=1;
			foreach ($employeesInSalary as $employee) {
				foreach($periods as $period){
					$salary = SalaryDetails::model()->find("t.EMPLOYEE_ID_FK=".$employee->EMPLOYEE_ID_FK." AND t.BILL_ID_FK=".$model->ID." AND t.MONTH=".$period['MONTH']." AND t.YEAR=".$period['YEAR']);
					if($salary->REMARKS !=""){
				?>
					<li>
						<p style="font-weight: bold;padding-left: 50px;margin-bottom:10px;"><?php echo $i.".  ";?><?php echo Employee::model()->findByPK($salary->EMPLOYEE_ID_FK)->NAME.", ".Designations::model()->findByPK(Employee::model()->findByPK($salary->EMPLOYEE_ID_FK)->DESIGNATION_ID_FK)->DESIGNATION;?></p>
						<p style="padding-left: 100px;margin-bottom:10px;"><?php echo $salary->REMARKS; ?></p>
					</li>
				<?php
					}
				}
			}
		?>
	</ol>
</div>
-->
<div style="font-weight: bold; width:400px; float: right;text-align:center; margin-top:100px;margin-right:-10px;">
	<p>(<?php echo Employee::model()->findByPK($master['DEPT_ADMIN_EMPLOYEE'])->NAME;?>)</p>
	<p><?php echo Designations::model()->findByPK(Employee::model()->findByPK($master['DEPT_ADMIN_EMPLOYEE'])->DESIGNATION_ID_FK)->DESIGNATION;?></p>
	<p><?php echo $master['DEPT_NAME']?></p>
</div>
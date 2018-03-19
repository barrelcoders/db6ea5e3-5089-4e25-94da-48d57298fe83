<?php
/* @var $this BillController */
/* @var $model Bill */

$this->breadcrumbs=array(
	'Bills'=>array('index'),
	$model->ID=>array('view','id'=>$model->ID),
	'Update',
);

$this->menu=array(
	array('label'=>'Manage Bill', 'url'=>array('admin')),
);

$id = 0;
if(isset($_REQUEST['id']) && $_REQUEST['id']){
	$id = intVal($_REQUEST['id']);
}
?>

<div class="container-fluid">
	<nav class="side-menu-additional" style="overflow-y: auto; padding: 0px; width: 250px;margin-left: 141px;">
		<div style="width: 230px; height: 700px;">
			<div class="" style="padding: 0px;margin-top: 100px; width: 230px;padding-top: 0px!important;">
				<ul class="side-menu-additional-list" style="padding-bottom: 30px;">
					<?php if($model->IS_SALARY_HEAD_PAY_BILL) {?>
						<?php 
							$HBA_COUNT = Yii::app()->db->createCommand("SELECT COUNT(ID) AS TOTAL FROM tbl_salary_details WHERE BILL_ID_FK = ".$model->ID." AND IS_HBA_RECOVERY = 0 AND HBA_EMI !=0 ")->queryRow()['TOTAL'];
							$HBA_INT_COUNT = Yii::app()->db->createCommand("SELECT COUNT(ID) AS TOTAL FROM tbl_salary_details WHERE BILL_ID_FK = ".$model->ID." AND IS_HBA_RECOVERY = 1 AND HBA_EMI !=0 ")->queryRow()['TOTAL'];
							$MCA_COUNT = Yii::app()->db->createCommand("SELECT COUNT(ID) AS TOTAL FROM tbl_salary_details WHERE BILL_ID_FK = ".$model->ID." AND IS_MCA_RECOVERY = 0 AND MCA_EMI !=0 ")->queryRow()['TOTAL'];
							$MCA_INT_COUNT = Yii::app()->db->createCommand("SELECT COUNT(ID) AS TOTAL FROM tbl_salary_details WHERE BILL_ID_FK = ".$model->ID." AND IS_MCA_RECOVERY = 1 AND MCA_EMI !=0 ")->queryRow()['TOTAL'];
							$COMP_COUNT = Yii::app()->db->createCommand("SELECT COUNT(ID) AS TOTAL FROM tbl_salary_details WHERE BILL_ID_FK = ".$model->ID." AND IS_COMP_RECOVERY = 0 AND COMP_EMI !=0 ")->queryRow()['TOTAL'];
							$COMP_INT_COUNT = Yii::app()->db->createCommand("SELECT COUNT(ID) AS TOTAL FROM tbl_salary_details WHERE BILL_ID_FK = ".$model->ID." AND IS_COMP_RECOVERY = 1 AND COMP_EMI !=0 ")->queryRow()['TOTAL'];
							$CCS_COUNT = Yii::app()->db->createCommand("SELECT COUNT(CCS) AS TOTAL FROM tbl_salary_details WHERE BILL_ID_FK = ".$model->ID." AND CCS !=0 ")->queryRow()['TOTAL'];
							$LIC_COUNT = Yii::app()->db->createCommand("SELECT COUNT(LIC) AS TOTAL FROM tbl_salary_details WHERE BILL_ID_FK = ".$model->ID." AND LIC !=0 ")->queryRow()['TOTAL'];
							$PLI_COUNT = Yii::app()->db->createCommand("SELECT COUNT(PLI) AS TOTAL FROM tbl_salary_details WHERE BILL_ID_FK = ".$model->ID." AND PLI !=0 ")->queryRow()['TOTAL'];
							$COURT_COUNT = Yii::app()->db->createCommand("SELECT COUNT(COURT_ATTACHMENT) AS TOTAL FROM tbl_salary_details WHERE BILL_ID_FK = ".$model->ID." AND COURT_ATTACHMENT !=0 ")->queryRow()['TOTAL'];
							$JAYAMAHAL_COUNT = Yii::app()->db->createCommand("SELECT COUNT(MAINT_JAYAMAHAL) AS TOTAL FROM tbl_salary_details WHERE BILL_ID_FK = ".$model->ID." AND MAINT_JAYAMAHAL !=0 ")->queryRow()['TOTAL'];
							$MADIWALA_COUNT = Yii::app()->db->createCommand("SELECT COUNT(MAINT_MADIWALA) AS TOTAL FROM tbl_salary_details WHERE BILL_ID_FK = ".$model->ID." AND MAINT_MADIWALA !=0 ")->queryRow()['TOTAL'];
							$ASSOSC_COUNT = Yii::app()->db->createCommand("SELECT COUNT(ASSOSC_SUB) AS TOTAL FROM tbl_salary_details WHERE BILL_ID_FK = ".$model->ID." AND ASSOSC_SUB !=0 ")->queryRow()['TOTAL'];
							$MISC_COUNT = Yii::app()->db->createCommand("SELECT COUNT(MISC) AS TOTAL FROM tbl_salary_details WHERE BILL_ID_FK = ".$model->ID." AND MISC !=0 ")->queryRow()['TOTAL'];
							$PT_COUNT = Yii::app()->db->createCommand("SELECT COUNT(PT) AS TOTAL FROM tbl_salary_details WHERE BILL_ID_FK = ".$model->ID." AND PT !=0 ")->queryRow()['TOTAL'];
							$LF_COUNT = Yii::app()->db->createCommand("SELECT COUNT(LF) AS TOTAL FROM tbl_salary_details WHERE BILL_ID_FK = ".$model->ID." AND LF !=0 ")->queryRow()['TOTAL'];
						?>
						
						<li><a href="<?php echo Yii::app()->createUrl("Bill/SalaryDetails",array("id"=>$id))?>"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">Salary Details</span></span></a></li>
						<li><a href="<?php echo Yii::app()->createUrl("Bill/SalaryDetailsTabular",array("id"=>$id))?>"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">Salary Details (Tabular)</span></span></a></li>
						<li><a href="<?php echo Yii::app()->createUrl("Bill/PayBillValidate",array("id"=>$id))?>"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">Validate Calculations</span></span></a></li>
						<li><a href="<?php echo Yii::app()->createUrl("Bill/PayBillChanges",array("id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">Validate Changes w.r.t Previous Bills</span></span></a></li>
						<li><a href="<?php echo Yii::app()->createUrl("Bill/PayBillTasks",array("id"=>$id))?>" ><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">Pay Bill Tasks</span></span></a></li>
						<li><a href="<?php echo Yii::app()->createUrl("Bill/CSSImport",array("id"=>$id))?>" ><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">CCS Import</span></span></a></li>
						
						<hr>
						
						<?php if($model->IS_NPS_PAY_BILL) {?>
							<h4 style="padding-left:10px;">NILL BILL</h4>
							<li><a href="<?php echo Yii::app()->createUrl("Bill/NillBillFront",array("id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">NILL BILL FRONT SHEET</span></span></a></li>
							<li><a href="<?php echo Yii::app()->createUrl("Bill/NillBillInner",array("id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">NILL BILL INNER</span></span></a></li>
							<li><a href="<?php echo Yii::app()->createUrl("Bill/NillBillPart1",array("id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">NILL BILL PART 1</span></span></a></li>
							<li><a href="<?php echo Yii::app()->createUrl("Bill/NillBillPart2",array("id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">NILL BILL PART 2</span></span></a></li>
							<li><a href="<?php echo Yii::app()->createUrl("Bill/NillBillCPF",array("id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">NILL BILL CPF</span></span></a></li>
							<li><a href="<?php echo Yii::app()->createUrl("Bill/BackSheet",array("id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">BACK SHEET</span></span></a></li>
							<li><a href="<?php echo Yii::app()->createUrl("Bill/NillBillToMail",array("id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">NILL BILL (MAIL)</span></span></a></li>
							<hr>
						<?php } ?>
						<!--<h4 style="padding-left:10px;">CCS & LIC </h4>
						<li><a href="<?php echo Yii::app()->createUrl("Bill/CCSLICBillFront",array("id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">CCS & LIC FRONT SHEET</span></span></a></li>
						<li><a href="<?php echo Yii::app()->createUrl("Bill/CCS",array("id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">CREDIT CO. SOCIETY SCHEDULE</span></span></a></li>
						<li><a href="<?php echo Yii::app()->createUrl("Bill/LIC",array("id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">LIC SCHEDULE</span></span></a></li>
						<li><a href="<?php echo Yii::app()->createUrl("Bill/MADIWALA",array("id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">MADIWALA MAINT. SCHEDULE</span></span></a></li>
						<li><a href="<?php echo Yii::app()->createUrl("Bill/JAYAMAHAL",array("id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">JAYAMAHAL MAINT. SCHEDULE</span></span></a></li>
						<li><a href="<?php echo Yii::app()->createUrl("Bill/ReconsilationLICCCS",array("id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">RECONSILATION LIC & CCS</span></span></a></li>
						<li><a href="<?php echo Yii::app()->createUrl("Bill/BackSheet",array("id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">BACK SHEET</span></span></a></li>
						<hr>-->
						<h4 style="padding-left:10px;">PROFESSION TAX</h4>
						<li><a href="<?php echo Yii::app()->createUrl("Bill/PTBillFront",array("id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">PT FRONT SHEET</span></span></a></li>
						<li><a href="<?php echo Yii::app()->createUrl("Bill/PT",array("id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">PT SCHEDULE</span></span></a></li>
						<li><a href="<?php echo Yii::app()->createUrl("Bill/ReconsilationPT",array("id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">INNER SHEET</span></span></a></li>
						<li><a href="<?php echo Yii::app()->createUrl("Bill/BackSheet",array("id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">BACK SHEET</span></span></a></li>
						<hr>
						<h4 style="padding-left:10px;">LIC & PLI DETAILS</h4>
						<li><a href="<?php echo Yii::app()->createUrl("Bill/LIC_PREMIUM",array("id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">LIC PREMIUM</span></span></a></li>
						<li><a href="<?php echo Yii::app()->createUrl("Bill/PLI_PREMIUM",array("id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">PLI PREMIUM</span></span></a></li>
						
						<!--<li><a href="<?php echo Yii::app()->createUrl("Bill/LIC_PREMIUM_COVER",array("id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">LIC PREMIUM COVER</span></span></a></li>-->
						<hr>
						<h4 style="padding-left:10px;">EMPLOYEE BILL</h4>
						<li><a href="<?php echo Yii::app()->createUrl("Bill/EmployeeBillFront",array("id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">EMPLOYEE BILL FRONT SHEET</span></span></a></li>
						<li><a href="<?php echo Yii::app()->createUrl("Bill/EmployeeBillInner",array("id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">INNER SHEET</span></span></a></li>
						<li><a href="<?php echo Yii::app()->createUrl("Bill/BackSheet",array("id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">BACK SHEET</span></span></a></li>
						<li><a href="<?php echo Yii::app()->createUrl("Bill/PaySlipSelectEmployee",array("Month"=>$model->MONTH, "Year"=>$model->YEAR, "id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">PAY SLIPS</span></span></a></li>
						<!--<li><a href="<?php echo Yii::app()->createUrl("Bill/PaySlipDetail",array("Month"=>$model->MONTH, "Year"=>$model->YEAR, "id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">PAY SLIPS</span></span></a></li>-->
						<li><a href="<?php echo Yii::app()->createUrl("Bill/IT",array("id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">IT</span></span></a></li>
						<li><a href="<?php echo Yii::app()->createUrl("Bill/CGHS",array("id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">CGHS</span></span></a></li>
						<li><a href="<?php echo Yii::app()->createUrl("Bill/CGEGIS",array("id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">CGEGIS</span></span></a></li>
						<li><a href="<?php echo Yii::app()->createUrl("Bill/GPF",array("id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption"><?php echo ($model->IS_NPS_PAY_BILL) ? "CPF": "GPF";?></span></span></a></li>
						<li>
							<a href="<?php echo Yii::app()->createUrl("Bill/LF",array("id"=>$id))?>" target="_blank">
								<span class="tbl-row">
									<span class="tbl-cell tbl-cell-caption">LICENCE FEES</span>
									<span class="counter <?php echo ($LF_COUNT > 0) ? "exists" : "not-exists"; ?>"><?php echo $LF_COUNT;?></span>
								</span>
							</a>
						</li>
						<li><a href="<?php echo Yii::app()->createUrl("Bill/HBA",array("id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">HBA</span>
						<span class="counter <?php echo ($HBA_COUNT > 0) ? "exists" : "not-exists"; ?>"><?php echo $HBA_COUNT;?></span>
						</span></a></li>
						<li><a href="<?php echo Yii::app()->createUrl("Bill/HBA_INTEREST",array("id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">HBA INTEREST</span>
						<span class="counter <?php echo ($HBA_INT_COUNT > 0) ? "exists" : "not-exists"; ?>"><?php echo $HBA_INT_COUNT;?></span>
						</span></a></li>
						<li><a href="<?php echo Yii::app()->createUrl("Bill/MCA",array("id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">MCA</span>
						<span class="counter <?php echo ($MCA_COUNT > 0) ? "exists" : "not-exists"; ?>"><?php echo $MCA_COUNT;?></span>
						</span></a></li>
						<li>
							<a href="<?php echo Yii::app()->createUrl("Bill/MCA_INTEREST",array("id"=>$id))?>" target="_blank">
								<span class="tbl-row">
									<span class="tbl-cell tbl-cell-caption">MCA INTEREST</span>
									<span class="counter <?php echo ($MCA_INT_COUNT > 0) ? "exists" : "not-exists"; ?>"><?php echo $MCA_INT_COUNT;?></span>
								</span>
							</a>
						</li>
						<li><a href="<?php echo Yii::app()->createUrl("Bill/COMPUTER",array("id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">COMPUTER ADV.</span>
						<span class="counter <?php echo ($COMP_COUNT > 0) ? "exists" : "not-exists"; ?>"><?php echo $COMP_COUNT;?></span>
						</span></a></li>
						<li><a href="<?php echo Yii::app()->createUrl("Bill/COMPUTER_INTEREST",array("id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">COMPUTER ADV. INTEREST</span>
						<span class="counter <?php echo ($COMP_INT_COUNT > 0) ? "exists" : "not-exists"; ?>"><?php echo $COMP_INT_COUNT;?></span>
						</span></a></li>
						<!--
						<li><a href="<?php echo Yii::app()->createUrl("Bill/CYCLE",array("id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">CYCLE ADV.</span></span></a></li>
						<li><a href="<?php echo Yii::app()->createUrl("Bill/CYCLE_INTEREST",array("id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">CYCLE ADV. INTEREST</span></span></a></li>
						<li><a href="<?php echo Yii::app()->createUrl("Bill/FLOOD",array("id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">FLOOD ADV.</span></span></a></li>
						<li><a href="<?php echo Yii::app()->createUrl("Bill/FLOOD_INTEREST",array("id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">FLOOD ADV. INTEREST</span></span></a></li>
						<li><a href="<?php echo Yii::app()->createUrl("Bill/FEST",array("id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">FEST</span></span></a></li>
						<li><a href="<?php echo Yii::app()->createUrl("Bill/FEST_INTEREST",array("id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">FEST INTEREST</span></span></a></li>
						-->
						<li>
							<a href="<?php echo Yii::app()->createUrl("Bill/MISC",array("id"=>$id))?>" target="_blank">
								<span class="tbl-row">
									<span class="tbl-cell tbl-cell-caption">MISC</span>
									<span class="counter <?php echo ($MISC_COUNT > 0) ? "exists" : "not-exists"; ?>"><?php echo $MISC_COUNT;?></span>
								</span>
							</a>
						</li>
						<li>
							<a href="<?php echo Yii::app()->createUrl("Bill/PT",array("id"=>$id))?>" target="_blank">
								<span class="tbl-row">
									<span class="tbl-cell tbl-cell-caption">PT</span>
									<span class="counter <?php echo ($PT_COUNT > 0) ? "exists" : "not-exists"; ?>"><?php echo $PT_COUNT;?></span>
								</span>
							</a>
						</li>
						<li>
							<a href="<?php echo Yii::app()->createUrl("Bill/CCS",array("id"=>$id))?>" target="_blank">
								<span class="tbl-row">
									<span class="tbl-cell tbl-cell-caption">CR. CO. SOCIETY</span>
									<span class="counter <?php echo ($CCS_COUNT > 0) ? "exists" : "not-exists"; ?>"><?php echo $CCS_COUNT;?></span>
								</span>
							</a>
						</li>
						<li>
							<a href="<?php echo Yii::app()->createUrl("Bill/LIC",array("id"=>$id))?>" target="_blank">
								<span class="tbl-row">
									<span class="tbl-cell tbl-cell-caption">LIC</span>
									<span class="counter <?php echo ($LIC_COUNT > 0) ? "exists" : "not-exists"; ?>"><?php echo $LIC_COUNT;?></span>
								</span>
							</a>
						</li>
						<li>
							<a href="<?php echo Yii::app()->createUrl("Bill/PLI",array("id"=>$id))?>" target="_blank">
								<span class="tbl-row">
									<span class="tbl-cell tbl-cell-caption">PLI</span>
									<span class="counter <?php echo ($PLI_COUNT > 0) ? "exists" : "not-exists"; ?>"><?php echo $PLI_COUNT;?></span>
								</span>
							</a>
						</li>
						<li>
							<a href="<?php echo Yii::app()->createUrl("Bill/MADIWALA",array("id"=>$id))?>" target="_blank">
								<span class="tbl-row">
									<span class="tbl-cell tbl-cell-caption">MADIWALA MAINT.</span>
									<span class="counter <?php echo ($MADIWALA_COUNT > 0) ? "exists" : "not-exists"; ?>"><?php echo $MADIWALA_COUNT;?></span>
								</span>
							</a>
						</li>
						<li>
							<a href="<?php echo Yii::app()->createUrl("Bill/JAYAMAHAL",array("id"=>$id))?>" target="_blank">
								<span class="tbl-row">
									<span class="tbl-cell tbl-cell-caption">JAYAMAHAL MAINT.</span>
									<span class="counter <?php echo ($JAYAMAHAL_COUNT > 0) ? "exists" : "not-exists"; ?>"><?php echo $JAYAMAHAL_COUNT;?></span>
								</span>
							</a>
						</li>
						<li>
							<a href="<?php echo Yii::app()->createUrl("Bill/ASSOCIATION",array("id"=>$id))?>" target="_blank">
								<span class="tbl-row">
									<span class="tbl-cell tbl-cell-caption">ASSOCIATION SUB.</span>
									<span class="counter <?php echo ($ASSOSC_COUNT > 0) ? "exists" : "not-exists"; ?>"><?php echo $ASSOSC_COUNT;?></span>
								</span>
							</a>
						</li>
						<li>
							<a href="<?php echo Yii::app()->createUrl("Bill/COURT",array("id"=>$id))?>" target="_blank">
								<span class="tbl-row">
									<span class="tbl-cell tbl-cell-caption">COURT</span>
									<span class="counter <?php echo ($COURT_COUNT > 0) ? "exists" : "not-exists"; ?>"><?php echo $COURT_COUNT;?></span>
								</span>
							</a>
						</li>
						<li><a href="<?php echo Yii::app()->createUrl("Bill/PTCCSLIC",array("id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">PT, CCS & LIC</span></span></a></li>
						<li><a href="<?php echo Yii::app()->createUrl("Bill/EPAY",array("id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">E PAYMENT</span></span></a></li>
					<?php } ?>
					<?php if($model->IS_SALARY_HEAD_OTHER_BILL) {?>
						<li><a href="<?php echo Yii::app()->createUrl("Bill/SalaryDetails",array("id"=>$id))?>"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">Salary Details</span></span></a></li>
						<li><a href="<?php echo Yii::app()->createUrl("Bill/SalaryDetailsTabular",array("id"=>$id))?>"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">Salary Details (Tabular)</span></span></a></li><hr>
						<?php if($model->IS_DA_ARREAR_BILL) {?>
							<li><a href="<?php echo Yii::app()->createUrl("Bill/PayBillValidate",array("id"=>$id))?>"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">Validate Calculations</span></span></a></li><hr>
							<?php if($model->IS_NPS_DA_ARREAR_BILL){?>
							<h4 style="padding-left:10px;">NILL BILL</h4>
							<li><a href="<?php echo Yii::app()->createUrl("Bill/NillBillFront",array("id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">NILL BILL FRONT SHEET</span></span></a></li>
							<li><a href="<?php echo Yii::app()->createUrl("Bill/NillBillInner",array("id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">NILL BILL INNER</span></span></a></li>
							<li><a href="<?php echo Yii::app()->createUrl("Bill/NillBillPart1",array("id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">NILL BILL PART 1</span></span></a></li>
							<li><a href="<?php echo Yii::app()->createUrl("Bill/NillBillPart2",array("id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">NILL BILL PART 2</span></span></a></li>
							<li><a href="<?php echo Yii::app()->createUrl("Bill/NillBillCPF",array("id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">NILL BILL CPF</span></span></a></li>
							<li><a href="<?php echo Yii::app()->createUrl("Bill/BackSheet",array("id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">BACK SHEET</span></span></a></li>
							<li><a href="<?php echo Yii::app()->createUrl("Bill/NillBillToMail",array("id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">NILL BILL (MAIL)</span></span></a></li>
							<hr>
							<?php } ?>
							<h4 style="padding-left:10px;">EMPLOYEE BILL</h4>
							<li><a href="<?php echo Yii::app()->createUrl("Bill/EmployeeBillFront",array("id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">EMPLOYEE BILL FRONT SHEET</span></span></a></li>
							<li><a href="<?php echo Yii::app()->createUrl("Bill/EmployeeTADABillInner",array("id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">INNER SHEET</span></span></a></li>
							<li><a href="<?php echo Yii::app()->createUrl("Bill/BackSheet",array("id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">BACK SHEET</span></span></a></li>
							<?php if($model->IS_NPS_DA_ARREAR_BILL){?>
							<li><a href="<?php echo Yii::app()->createUrl("Bill/GPF",array("id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">CPF</span></span></a></li>
							<?php } ?>
							<li><a href="<?php echo Yii::app()->createUrl("Bill/IT",array("id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">IT</span></span></a></li>
						<?php } ?>
						<?php if($model->IS_ARREAR_BILL) {?>
							<li><a href="<?php echo Yii::app()->createUrl("Bill/PayBillValidate",array("id"=>$id))?>"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">Validate Calculations</span></span></a></li><hr>
							<?php if($model->IS_NPS_ARREAR_BILL){?>
							<h4 style="padding-left:10px;">NILL BILL</h4>
							<li><a href="<?php echo Yii::app()->createUrl("Bill/NillBillFront",array("id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">NILL BILL FRONT SHEET</span></span></a></li>
							<li><a href="<?php echo Yii::app()->createUrl("Bill/NillBillInner",array("id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">NILL BILL INNER</span></span></a></li>
							<li><a href="<?php echo Yii::app()->createUrl("Bill/NillBillPart1",array("id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">NILL BILL PART 1</span></span></a></li>
							<li><a href="<?php echo Yii::app()->createUrl("Bill/NillBillPart2",array("id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">NILL BILL PART 2</span></span></a></li>
							<li><a href="<?php echo Yii::app()->createUrl("Bill/NillBillCPF",array("id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">NILL BILL CPF</span></span></a></li>
							<li><a href="<?php echo Yii::app()->createUrl("Bill/BackSheet",array("id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">BACK SHEET</span></span></a></li>
							<hr>
							<?php } ?>
							<h4 style="padding-left:10px;">PROFESSION TAX</h4>
							<li><a href="<?php echo Yii::app()->createUrl("Bill/PTBillFront",array("id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">PT FRONT SHEET</span></span></a></li>
							<li><a href="<?php echo Yii::app()->createUrl("Bill/PT",array("id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">PT SCHEDULE</span></span></a></li>
							<li><a href="<?php echo Yii::app()->createUrl("Bill/ReconsilationPT",array("id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">RECONSILATION PT</span></span></a></li>
							<li><a href="<?php echo Yii::app()->createUrl("Bill/BackSheet",array("id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">BACK SHEET</span></span></a></li>
							<hr>
							<h4 style="padding-left:10px;">EMPLOYEE BILL</h4>
							<li><a href="<?php echo Yii::app()->createUrl("Bill/EmployeeBillFront",array("id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">EMPLOYEE BILL FRONT SHEET</span></span></a></li>
							<li><a href="<?php echo Yii::app()->createUrl("Bill/EmployeeBillInner",array("id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">INNER SHEET</span></span></a></li>
							<li><a href="<?php echo Yii::app()->createUrl("Bill/BackSheet",array("id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">BACK SHEET</span></span></a></li>
							<!--<li><a href="<?php echo Yii::app()->createUrl("Bill/PaySlipDetail",array("Month"=>$model->MONTH, "Year"=>$model->YEAR, "id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">PAY SLIPS</span></span></a></li>-->
							<li><a href="<?php echo Yii::app()->createUrl("Bill/IT",array("id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">IT</span></span></a></li>
							<li><a href="<?php echo Yii::app()->createUrl("Bill/CGHS",array("id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">CGHS</span></span></a></li>
							<li><a href="<?php echo Yii::app()->createUrl("Bill/CGEGIS",array("id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">CGEGIS</span></span></a></li>
							<li><a href="<?php echo Yii::app()->createUrl("Bill/GPF",array("id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">GPF</span></span></a></li>
							<li><a href="<?php echo Yii::app()->createUrl("Bill/LF",array("id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">LICENCE FEES</span></span></a></li>
							<li><a href="<?php echo Yii::app()->createUrl("Bill/MISC",array("id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">MISC</span></span></a></li>
							<li><a href="<?php echo Yii::app()->createUrl("Bill/PT",array("id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">PT</span></span></a></li>
							<li><a href="<?php echo Yii::app()->createUrl("Bill/CCS",array("id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">CR. CO. SOCIETY</span></span></a></li>
							<li><a href="<?php echo Yii::app()->createUrl("Bill/LIC",array("id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">LIC</span></span></a></li>
							<li><a href="<?php echo Yii::app()->createUrl("Bill/PLI",array("id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">PLI</span></span></a></li>
							<li><a href="<?php echo Yii::app()->createUrl("Bill/MADIWALA",array("id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">MADIWALA MAINT.</span></span></a></li>
							<li><a href="<?php echo Yii::app()->createUrl("Bill/JAYAMAHAL",array("id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">JAYAMAHAL MAINT.</span></span></a></li>
							<li><a href="<?php echo Yii::app()->createUrl("Bill/ASSOCIATION",array("id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">ASSOCIATION SUB.</span></span></a></li>
							<li><a href="<?php echo Yii::app()->createUrl("Bill/COURT",array("id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">COURT</span></span></a></li>
							<li><a href="<?php echo Yii::app()->createUrl("Bill/PTCCSLIC",array("id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">PT, CCS & LIC</span></span></a></li>
							<li><a href="<?php echo Yii::app()->createUrl("Bill/EPAY",array("id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">E PAYMENT</span></span></a></li>
						<?php } ?>
						<?php if($model->IS_BONUS_BILL) {?>
							<li><a href="<?php echo Yii::app()->createUrl("Bill/EmployeeBillFront",array("id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">EMPLOYEE BILL FRONT SHEET</span></span></a></li>
							<li><a href="<?php echo Yii::app()->createUrl("Bill/EmployeeBonusBillInner",array("id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">INNER SHEET</span></span></a></li>
							<li><a href="<?php echo Yii::app()->createUrl("Bill/BackSheet",array("id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">BACK SHEET</span></span></a></li>
							<li><a href="<?php echo Yii::app()->createUrl("Bill/EPAY",array("id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">E PAYMENT</span></span></a></li>
						<?php } ?>
						<?php if($model->IS_UA_BILL) {?>
							<li><a href="<?php echo Yii::app()->createUrl("Bill/EmployeeBillFront",array("id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">EMPLOYEE BILL FRONT SHEET</span></span></a></li>
							<li><a href="<?php echo Yii::app()->createUrl("Bill/EmployeeUABillInner",array("id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">INNER SHEET</span></span></a></li>
							<li><a href="<?php echo Yii::app()->createUrl("Bill/UANoteSheet",array("id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">NOTE SHEET</span></span></a></li>
							<li><a href="<?php echo Yii::app()->createUrl("Bill/UASanctionOrder",array("id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">SANCTION ORDER</span></span></a></li>
							<li><a href="<?php echo Yii::app()->createUrl("Bill/BackSheet",array("id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">BACK SHEET</span></span></a></li>
						<?php } ?>
						<?php if($model->IS_CEA_BILL) {?>
							<li><a href="<?php echo Yii::app()->createUrl("Bill/EmployeeBillFront",array("id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">EMPLOYEE BILL FRONT SHEET</span></span></a></li>
							<li><a href="<?php echo Yii::app()->createUrl("Bill/EmployeeCEABillInner",array("id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">INNER SHEET</span></span></a></li>
							<li><a href="<?php echo Yii::app()->createUrl("Bill/CEASanctionOrder",array("id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">SANCTION ORDER</span></span></a></li>
							<li><a href="<?php echo Yii::app()->createUrl("Bill/BackSheet",array("id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">BACK SHEET</span></span></a></li>
						<?php } ?>
						<?php if($model->IS_LTC_ADVANCE_BILL) {?>
							<li><a href="<?php echo Yii::app()->createUrl("Bill/LTCAdvanceFront",array("id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">LTC/HTC Advance Front Sheet</span></span></a></li>
							<li><a href="<?php echo Yii::app()->createUrl("Bill/LTCAdvanceBack",array("id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">LTC/HTC Advance Back Sheet</span></span></a></li>
						<?php } ?>
						<?php if($model->IS_LTC_CLAIM_BILL) {?>
							<li><a href="<?php echo Yii::app()->createUrl("Bill/LTCClaimFront",array("id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">LTC/HTC Claim Front Sheet</span></span></a></li>
							<li><a href="<?php echo Yii::app()->createUrl("Bill/LTCClaimBack",array("id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">LTC/HTC Claim Back Sheet</span></span></a></li>
						<?php } ?>
						<?php if($model->IS_EL_ENCASHMENT_BILL) {?>
							<li><a href="<?php echo Yii::app()->createUrl("Bill/EmployeeBillFront",array("id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">EMPLOYEE BILL FRONT SHEET</span></span></a></li>
							<li><a href="<?php echo Yii::app()->createUrl("Bill/EmployeeELEncashBillInner",array("id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">INNER SHEET</span></span></a></li>
							<li><a href="<?php echo Yii::app()->createUrl("Bill/BackSheet",array("id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">BACK SHEET</span></span></a></li>
							<li><a href="<?php echo Yii::app()->createUrl("Bill/ElEncashSanctionOrder",array("id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">SANCTION ORDER</span></span></a></li>
						<?php } ?>
					<?php } ?>
					<?php if( $model->BILL_TYPE == 3 ) { ?>
					<li><a href="<?php echo Yii::app()->createUrl("Bill/OESanctionOrder",array("id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">Sanction Order</span></span></a></li>
					<li><a href="<?php echo Yii::app()->createUrl("Bill/OEFVCFrontPage",array("id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">FVC Front Page</span></span></a></li>
					<li><a href="<?php echo Yii::app()->createUrl("Bill/OEFVCBackPage",array("id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">FVC Back Page</span></span></a></li>
					<?php } ?>
					<?php if( $model->BILL_TYPE == 4 ) { ?>
						<?php if( $model->BILL_SUB_TYPE == 33 || $model->BILL_SUB_TYPE == 34) { ?>
							<li><a href="<?php echo Yii::app()->createUrl("Bill/DTEAdvanceFront",array("id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">DTE Advance Front Sheet</span></span></a></li>
							<li><a href="<?php echo Yii::app()->createUrl("Bill/DTEAdvanceBack",array("id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">DTE Advance Back Sheet</span></span></a></li>
						<?php } ?>
						<?php if( $model->BILL_SUB_TYPE == 35 || $model->BILL_SUB_TYPE == 36) { ?>
							<li><a href="<?php echo Yii::app()->createUrl("Bill/DTEClaimFront",array("id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">DTE Claim Front Sheet</span></span></a></li>
							<li><a href="<?php echo Yii::app()->createUrl("Bill/DTEClaimBack",array("id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">DTE Claim Back Sheet</span></span></a></li>
						<?php } ?>
					<?php } ?>
					<?php if( $model->BILL_TYPE == 6 ) { ?>
					<li><a href="<?php echo Yii::app()->createUrl("Bill/MedicalBillFront",array("id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">Medical Front Sheet</span></span></a></li>
					<li><a href="<?php echo Yii::app()->createUrl("Bill/MedicalBillBack",array("id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">Medical Back Sheet</span></span></a></li>
					<?php } ?>
					<?php if($model->IS_WAGES_HEAD_PAY_BILL) {?>
						<li><a href="<?php echo Yii::app()->createUrl("Bill/SalaryDetails",array("id"=>$id))?>"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">Salary Details</span></span></a></li>
						<li><a href="<?php echo Yii::app()->createUrl("Bill/SalaryDetailsTabular",array("id"=>$id))?>"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">Salary Details (Tabular)</span></span></a></li>
						<li><a href="<?php echo Yii::app()->createUrl("Bill/PayBillValidate",array("id"=>$id))?>"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">Validate Calculations</span></span></a></li>
						<li><a href="<?php echo Yii::app()->createUrl("Bill/CasualPayBillFrontPage",array("id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">Pay Bill FVC Front Sheet</span></span></a></li>
						<li><a href="<?php echo Yii::app()->createUrl("Bill/CasualPayBillInner",array("id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">Pay Details</span></span></a></li>
						<li><a href="<?php echo Yii::app()->createUrl("Bill/CasualPayBillBackPage",array("id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">Pay Bill FVC Back Sheet</span></span></a></li>
						<li><a href="<?php echo Yii::app()->createUrl("Bill/CasualPTBillFrontPage",array("id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">PT Bill FVC Front Sheet</span></span></a></li>
						<li><a href="<?php echo Yii::app()->createUrl("Bill/CasualPayBillPT",array("id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">PT Schedule</span></span></a></li>
						<li><a href="<?php echo Yii::app()->createUrl("Bill/CasualPTBillBackPage",array("id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">PT Bill FVC Back Sheet</span></span></a></li>
						<li><a href="<?php echo Yii::app()->createUrl("Bill/CasualPayBillSanctionOrder",array("id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">Sanction Order</span></span></a></li>
						<li><a href="<?php echo Yii::app()->createUrl("Bill/EPAY",array("id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">E PAYMENT</span></span></a></li>
						<li><a href="<?php echo Yii::app()->createUrl("Bill/PaySlipSelectEmployee",array("Month"=>$model->MONTH, "Year"=>$model->YEAR, "id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">PAY SLIPS</span></span></a></li>
					<?php } ?>
					<?php if($model->IS_WAGES_HEAD_OTHER_BILL) {?>
						<?php if($model->IS_BONUS_BILL) {?>
							<li><a href="<?php echo Yii::app()->createUrl("Bill/SalaryDetails",array("id"=>$id))?>"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">Salary Details</span></span></a></li>
							<li><a href="<?php echo Yii::app()->createUrl("Bill/SalaryDetailsTabular",array("id"=>$id))?>"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">Salary Details (Tabular)</span></span></a></li><hr>
							<li><a href="<?php echo Yii::app()->createUrl("Bill/CasualPayBillFrontPage",array("id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">FVC Front Sheet</span></span></a></li>
							<li><a href="<?php echo Yii::app()->createUrl("Bill/CasualBonusBillInner",array("id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">Bonus Detail</span></span></a></li>
							<li><a href="<?php echo Yii::app()->createUrl("Bill/CasualPayBillBackPage",array("id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">FVC Back Sheet</span></span></a></li>
							<li><a href="<?php echo Yii::app()->createUrl("Bill/CasualPayBillSanctionOrder",array("id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">Sanction Order</span></span></a></li>
							<li><a href="<?php echo Yii::app()->createUrl("Bill/EPAY",array("id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">E PAYMENT</span></span></a></li>
						<?php } ?>
						<?php if($model->IS_DA_ARREAR_BILL) {?>
							<li><a href="<?php echo Yii::app()->createUrl("Bill/SalaryDetails",array("id"=>$id))?>"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">Salary Details</span></span></a></li>
							<li><a href="<?php echo Yii::app()->createUrl("Bill/SalaryDetailsTabular",array("id"=>$id))?>"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">Salary Details (Tabular)</span></span></a></li>
							<li><a href="<?php echo Yii::app()->createUrl("Bill/PayBillValidate",array("id"=>$id))?>"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">Validate Calculations</span></span></a></li>
							<li><a href="<?php echo Yii::app()->createUrl("Bill/CasualPayBillFrontPage",array("id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">FVC Front Sheet</span></span></a></li>
							<li><a href="<?php echo Yii::app()->createUrl("Bill/CasualPayBillInner",array("id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">INNER SHEET</span></span></a></li>
							<li><a href="<?php echo Yii::app()->createUrl("Bill/CasualPayBillBackPage",array("id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">FVC Back Sheet</span></span></a></li>
							<li><a href="<?php echo Yii::app()->createUrl("Bill/CasualPayBillSanctionOrder",array("id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">Sanction Order</span></span></a></li>
							<li><a href="<?php echo Yii::app()->createUrl("Bill/EPAY",array("id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">E PAYMENT</span></span></a></li>
						<?php } ?>
					<?php } ?>
				</ul>
			</div>
		</div>
	</nav>
	<header class="section-header" style="margin-left: 225px;">
		<div class="tbl">
			<div class="tbl-row">
				<div class="tbl-cell">
					<h2>Bill No: <?php echo $model->BILL_NO; ?></h2>
					<div class="subtitle"></div>
				</div>
			</div>
		</div>
	</header>
	<div class="box-typical box-typical-padding" style="margin-left: 225px;">
		<?php $this->renderPartial('_form', array('model'=>$model)); ?>

	</div>
</div>
<style>
.counter{
	display: inline-block;
	width: 22px;
	height: 22px;
	color: #FFF;
	text-align: center;
	line-height: 16px;
	border-radius: 12px;
	font-size: 13px;
	padding-top: 3px;
	float: right;
	margin-top: 5px;
	margin-right: 10px;
}
.counter.exists{
	background: #208c20;
	color: #FFF;
}
.counter.not-exists{
	background: #F00;
	color: #FFF;
}
</style>
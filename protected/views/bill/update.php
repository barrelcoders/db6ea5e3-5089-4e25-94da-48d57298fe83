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
		<div style="width: 219px; height: 700px;">
			<div class="" style="padding: 0px;    margin-top: 100px; width: 219px;padding-top: 0px!important;">
				<ul class="side-menu-additional-list" style="padding-bottom: 30px;">
					<?php if( $model->BILL_TYPE == 1 ) { ?>
						<li><a href="<?php echo Yii::app()->createUrl("Bill/SalaryDetails",array("id"=>$id))?>"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">Salary Details</span></span></a></li><hr>
						<?php if(!$model->IS_CEA_BILL && !$model->IS_BONUS_BILL && !$model->IS_UA_BILL &&  !$model->IS_LTC_ADVANCE_BILL && !$model->IS_LTC_CLAIM_BILL && !$model->IS_EL_ENCASHMENT_BILL && !$model->IS_RECOVERY_BILL) {?>
							<h4 style="padding-left:10px;">PROFESSION TAX</h4>
							<li><a href="<?php echo Yii::app()->createUrl("Bill/PTBillFront",array("id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">PT FRONT SHEET</span></span></a></li>
							<li><a href="<?php echo Yii::app()->createUrl("Bill/PT",array("id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">PT SCHEDULE</span></span></a></li>
							<li><a href="<?php echo Yii::app()->createUrl("Bill/ReconsilationPT",array("id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">RECONSILATION PT</span></span></a></li>
							<li><a href="<?php echo Yii::app()->createUrl("Bill/BackSheet",array("id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">BACK SHEET</span></span></a></li>
							<hr>
							<h4 style="padding-left:10px;">LIC DETAILS</h4>
							<li><a href="<?php echo Yii::app()->createUrl("Bill/LIC_PREMIUM",array("id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">LIC PREMIUM</span></span></a></li>
							<li><a href="<?php echo Yii::app()->createUrl("Bill/LIC_PREMIUM_COVER",array("id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">LIC PREMIUM COVER</span></span></a></li>
							<hr>
							<h4 style="padding-left:10px;">EMPLOYEE BILL</h4>
							<li><a href="<?php echo Yii::app()->createUrl("Bill/EmployeeBillFront",array("id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">EMPLOYEE BILL FRONT SHEET</span></span></a></li>
							<li><a href="<?php echo Yii::app()->createUrl("Bill/EmployeeBillInner",array("id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">INNER SHEET</span></span></a></li>
							<li><a href="<?php echo Yii::app()->createUrl("Bill/BackSheet",array("id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">BACK SHEET</span></span></a></li>
							<li><a href="<?php echo Yii::app()->createUrl("Bill/PaySlipDetail",array("Month"=>$model->MONTH, "Year"=>$model->YEAR, "id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">PAY SLIPS</span></span></a></li>
							<li><a href="<?php echo Yii::app()->createUrl("Bill/IT",array("id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">IT</span></span></a></li>
							<li><a href="<?php echo Yii::app()->createUrl("Bill/CGHS",array("id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">CGHS</span></span></a></li>
							<li><a href="<?php echo Yii::app()->createUrl("Bill/CGEGIS",array("id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">CGEGIS</span></span></a></li>
							<li><a href="<?php echo Yii::app()->createUrl("Bill/GPF",array("id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">GPF</span></span></a></li>
							<li><a href="<?php echo Yii::app()->createUrl("Bill/LF",array("id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">LICENCE FEES</span></span></a></li>
							<li><a href="<?php echo Yii::app()->createUrl("Bill/HBA",array("id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">HBA</span></span></a></li>
							<li><a href="<?php echo Yii::app()->createUrl("Bill/HBA_INTEREST",array("id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">HBA INTEREST</span></span></a></li>
							<li><a href="<?php echo Yii::app()->createUrl("Bill/MCA",array("id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">MCA</span></span></a></li>
							<li><a href="<?php echo Yii::app()->createUrl("Bill/MCA_INTEREST",array("id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">MCA INTEREST</span></span></a></li>
							<li><a href="<?php echo Yii::app()->createUrl("Bill/CYCLE",array("id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">CYCLE ADV.</span></span></a></li>
							<li><a href="<?php echo Yii::app()->createUrl("Bill/CYCLE_INTEREST",array("id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">CYCLE ADV. INTEREST</span></span></a></li>
							<li><a href="<?php echo Yii::app()->createUrl("Bill/FAN",array("id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">FAN ADV.</span></span></a></li>
							<li><a href="<?php echo Yii::app()->createUrl("Bill/FAN_INTEREST",array("id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">FAN ADV. INTEREST</span></span></a></li>
							<li><a href="<?php echo Yii::app()->createUrl("Bill/FLOOD",array("id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">FLOOD ADV.</span></span></a></li>
							<li><a href="<?php echo Yii::app()->createUrl("Bill/FLOOD_INTEREST",array("id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">FLOOD ADV. INTEREST</span></span></a></li>
							<li><a href="<?php echo Yii::app()->createUrl("Bill/FEST",array("id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">FEST</span></span></a></li>
							<li><a href="<?php echo Yii::app()->createUrl("Bill/FEST_INTEREST",array("id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">FEST INTEREST</span></span></a></li>
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
							<li><a href="<?php echo Yii::app()->createUrl("Bill/BonusEmployeeBillPart1",array("id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">INNER SHEET PART 1</span></span></a></li>
							<li><a href="<?php echo Yii::app()->createUrl("Bill/BackSheet",array("id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">BACK SHEET</span></span></a></li>
						<?php } ?>
						<?php if($model->IS_UA_BILL) {?>
							<li><a href="<?php echo Yii::app()->createUrl("Bill/EmployeeBillFront",array("id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">EMPLOYEE BILL FRONT SHEET</span></span></a></li>
							<li><a href="<?php echo Yii::app()->createUrl("Bill/UAEmployeeBillPart1",array("id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">INNER SHEET PART 1</span></span></a></li>
							<li><a href="<?php echo Yii::app()->createUrl("Bill/UANoteSheet",array("id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">NOTE SHEET</span></span></a></li>
							<li><a href="<?php echo Yii::app()->createUrl("Bill/UASanctionOrder",array("id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">SANCTION ORDER</span></span></a></li>
							<li><a href="<?php echo Yii::app()->createUrl("Bill/BackSheet",array("id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">BACK SHEET</span></span></a></li>
						<?php } ?>
						<?php if($model->IS_CEA_BILL) {?>
							<li><a href="<?php echo Yii::app()->createUrl("Bill/EmployeeBillFront",array("id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">EMPLOYEE BILL FRONT SHEET</span></span></a></li>
							<li><a href="<?php echo Yii::app()->createUrl("Bill/CEAEmployeeBillPart1",array("id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">INNER SHEET PART 1</span></span></a></li>
							<li><a href="<?php echo Yii::app()->createUrl("Bill/CEASanctionOrder",array("id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">SANCTION ORDER</span></span></a></li>
							<li><a href="<?php echo Yii::app()->createUrl("Bill/BackSheet",array("id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">BACK SHEET</span></span></a></li>
						<?php } ?>
						<?php if($model->IS_LTC_ADVANCE_BILL || $model->IS_LTC_CLAIM_BILL) {?>
							<li><a href="<?php echo Yii::app()->createUrl("Bill/LTCFront",array("id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">LTC/HTC Front Sheet</span></span></a></li>
							<li><a href="<?php echo Yii::app()->createUrl("Bill/LTCBack",array("id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">LTC/HTC Back Sheet</span></span></a></li>
						<?php } ?>
						<?php if($model->IS_EL_ENCASHMENT_BILL) {?>
							<li><a href="<?php echo Yii::app()->createUrl("Bill/EmployeeBillFront",array("id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">EMPLOYEE BILL FRONT SHEET</span></span></a></li>
							<li><a href="<?php echo Yii::app()->createUrl("Bill/ELEncashEmployeeBillPart1",array("id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">INNER SHEET PART 1</span></span></a></li>
							<li><a href="<?php echo Yii::app()->createUrl("Bill/BackSheet",array("id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">BACK SHEET</span></span></a></li>
						<?php } ?>
					<?php } ?>
					<?php if( $model->BILL_TYPE == 2 ) { ?>
						<li><a href="<?php echo Yii::app()->createUrl("Bill/SalaryDetails",array("id"=>$id))?>"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">Salary Details</span></span></a></li><hr>
						<?php if(!$model->IS_CEA_BILL && !$model->IS_BONUS_BILL && !$model->IS_UA_BILL &&  !$model->IS_LTC_ADVANCE_BILL && !$model->IS_LTC_CLAIM_BILL && !$model->IS_EL_ENCASHMENT_BILL && !$model->IS_RECOVERY_BILL) {?>
							<h4 style="padding-left:10px;">NILL BILL</h4>
							<li><a href="<?php echo Yii::app()->createUrl("Bill/NillBillFront",array("id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">NILL BILL FRONT SHEET</span></span></a></li>
							<li><a href="<?php echo Yii::app()->createUrl("Bill/NillBillInner",array("id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">NILL BILL INNER</span></span></a></li>
							<li><a href="<?php echo Yii::app()->createUrl("Bill/NillBillPart1",array("id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">NILL BILL PART 1</span></span></a></li>
							<li><a href="<?php echo Yii::app()->createUrl("Bill/NillBillPart2",array("id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">NILL BILL PART 2</span></span></a></li>
							<li><a href="<?php echo Yii::app()->createUrl("Bill/NillBillCPF",array("id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">NILL BILL CPF</span></span></a></li>
							<li><a href="<?php echo Yii::app()->createUrl("Bill/BackSheet",array("id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">BACK SHEET</span></span></a></li>
							<h4 style="padding-left:10px;">PROFESSION TAX</h4>
							<li><a href="<?php echo Yii::app()->createUrl("Bill/PTBillFront",array("id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">PT FRONT SHEET</span></span></a></li>
							<li><a href="<?php echo Yii::app()->createUrl("Bill/PT",array("id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">PT SCHEDULE</span></span></a></li>
							<li><a href="<?php echo Yii::app()->createUrl("Bill/ReconsilationPT",array("id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">RECONSILATION PT</span></span></a></li>
							<li><a href="<?php echo Yii::app()->createUrl("Bill/BackSheet",array("id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">BACK SHEET</span></span></a></li>
							<hr>
							<h4 style="padding-left:10px;">LIC DETAILS</h4>
							<li><a href="<?php echo Yii::app()->createUrl("Bill/LIC_PREMIUM",array("id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">LIC PREMIUM</span></span></a></li>
							<li><a href="<?php echo Yii::app()->createUrl("Bill/LIC_PREMIUM_COVER",array("id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">LIC PREMIUM COVER</span></span></a></li>
							<hr>
							<h4 style="padding-left:10px;">EMPLOYEE BILL</h4>
							<li><a href="<?php echo Yii::app()->createUrl("Bill/EmployeeBillFront",array("id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">EMPLOYEE BILL FRONT SHEET</span></span></a></li>
							<li><a href="<?php echo Yii::app()->createUrl("Bill/EmployeeBillInner",array("id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">INNER SHEET</span></span></a></li>
							<li><a href="<?php echo Yii::app()->createUrl("Bill/BackSheet",array("id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">BACK SHEET</span></span></a></li>
							<li><a href="<?php echo Yii::app()->createUrl("Bill/PaySlipDetail",array("Month"=>$model->MONTH, "Year"=>$model->YEAR, "id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">PAY SLIPS</span></span></a></li>
							<li><a href="<?php echo Yii::app()->createUrl("Bill/IT",array("id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">IT</span></span></a></li>
							<li><a href="<?php echo Yii::app()->createUrl("Bill/CGHS",array("id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">CGHS</span></span></a></li>
							<li><a href="<?php echo Yii::app()->createUrl("Bill/CGEGIS",array("id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">CGEGIS</span></span></a></li>
								<li><a href="<?php echo Yii::app()->createUrl("Bill/CPF",array("id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">CPF</span></span></a></li>
							<li><a href="<?php echo Yii::app()->createUrl("Bill/LF",array("id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">LICENCE FEES</span></span></a></li>
							<li><a href="<?php echo Yii::app()->createUrl("Bill/HBA",array("id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">HBA</span></span></a></li>
							<li><a href="<?php echo Yii::app()->createUrl("Bill/HBA_INTEREST",array("id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">HBA INTEREST</span></span></a></li>
							<li><a href="<?php echo Yii::app()->createUrl("Bill/MCA",array("id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">MCA</span></span></a></li>
							<li><a href="<?php echo Yii::app()->createUrl("Bill/MCA_INTEREST",array("id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">MCA INTEREST</span></span></a></li>
							<li><a href="<?php echo Yii::app()->createUrl("Bill/CYCLE",array("id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">CYCLE ADV.</span></span></a></li>
							<li><a href="<?php echo Yii::app()->createUrl("Bill/CYCLE_INTEREST",array("id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">CYCLE ADV. INTEREST</span></span></a></li>
							<li><a href="<?php echo Yii::app()->createUrl("Bill/FAN",array("id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">FAN ADV.</span></span></a></li>
							<li><a href="<?php echo Yii::app()->createUrl("Bill/FAN_INTEREST",array("id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">FAN ADV. INTEREST</span></span></a></li>
							<li><a href="<?php echo Yii::app()->createUrl("Bill/FLOOD",array("id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">FLOOD ADV.</span></span></a></li>
							<li><a href="<?php echo Yii::app()->createUrl("Bill/FLOOD_INTEREST",array("id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">FLOOD ADV. INTEREST</span></span></a></li>
							<li><a href="<?php echo Yii::app()->createUrl("Bill/FEST",array("id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">FEST</span></span></a></li>
							<li><a href="<?php echo Yii::app()->createUrl("Bill/FEST_INTEREST",array("id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">FEST INTEREST</span></span></a></li>
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
							<li><a href="<?php echo Yii::app()->createUrl("Bill/BonusEmployeeBillPart1",array("id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">INNER SHEET PART 1</span></span></a></li>
							<li><a href="<?php echo Yii::app()->createUrl("Bill/BackSheet",array("id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">BACK SHEET</span></span></a></li>
						<?php } ?>
						<?php if($model->IS_UA_BILL) {?>
							<li><a href="<?php echo Yii::app()->createUrl("Bill/EmployeeBillFront",array("id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">EMPLOYEE BILL FRONT SHEET</span></span></a></li>
							<li><a href="<?php echo Yii::app()->createUrl("Bill/UAEmployeeBillPart1",array("id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">INNER SHEET PART 1</span></span></a></li>
							<li><a href="<?php echo Yii::app()->createUrl("Bill/UANoteSheet",array("id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">NOTE SHEET</span></span></a></li>
							<li><a href="<?php echo Yii::app()->createUrl("Bill/UASanctionOrder",array("id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">SANCTION ORDER</span></span></a></li>
							<li><a href="<?php echo Yii::app()->createUrl("Bill/BackSheet",array("id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">BACK SHEET</span></span></a></li>
						<?php } ?>
						<?php if($model->IS_CEA_BILL) {?>
							<li><a href="<?php echo Yii::app()->createUrl("Bill/EmployeeBillFront",array("id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">EMPLOYEE BILL FRONT SHEET</span></span></a></li>
							<li><a href="<?php echo Yii::app()->createUrl("Bill/CEAEmployeeBillPart1",array("id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">INNER SHEET PART 1</span></span></a></li>
							<li><a href="<?php echo Yii::app()->createUrl("Bill/CEASanctionOrder",array("id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">SANCTION ORDER</span></span></a></li>
							<li><a href="<?php echo Yii::app()->createUrl("Bill/BackSheet",array("id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">BACK SHEET</span></span></a></li>
						<?php } ?>
						<?php if($model->IS_LTC_ADVANCE_BILL || $model->IS_LTC_CLAIM_BILL) {?>
							<li><a href="<?php echo Yii::app()->createUrl("Bill/LTCFront",array("id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">LTC/HTC Front Sheet</span></span></a></li>
							<li><a href="<?php echo Yii::app()->createUrl("Bill/LTCBack",array("id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">LTC/HTC Back Sheet</span></span></a></li>
						<?php } ?>
						<?php if($model->IS_EL_ENCASHMENT_BILL) {?>
							<li><a href="<?php echo Yii::app()->createUrl("Bill/EmployeeBillFront",array("id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">EMPLOYEE BILL FRONT SHEET</span></span></a></li>
							<li><a href="<?php echo Yii::app()->createUrl("Bill/ELEncashEmployeeBillPart1",array("id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">INNER SHEET PART 1</span></span></a></li>
							<li><a href="<?php echo Yii::app()->createUrl("Bill/BackSheet",array("id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">BACK SHEET</span></span></a></li>
						<?php } ?>
					<?php } ?>
					<?php if( $model->BILL_TYPE == 3 ) { ?>
					<li><a href="<?php echo Yii::app()->createUrl("Bill/OESanctionOrder",array("id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">Sanction Order</span></span></a></li>
					<li><a href="<?php echo Yii::app()->createUrl("Bill/OEFVCFrontPage",array("id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">FVC Front Page</span></span></a></li>
					<li><a href="<?php echo Yii::app()->createUrl("Bill/OEFVCBackPage",array("id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">FVC Back Page</span></span></a></li>
					<?php } ?>
					<?php if( $model->BILL_TYPE == 4 ) { ?>
					<li><a href="<?php echo Yii::app()->createUrl("Bill/DTEFront",array("id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">DTE Front Sheet</span></span></a></li>
					<li><a href="<?php echo Yii::app()->createUrl("Bill/DTEBack",array("id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">DTE Back Sheet</span></span></a></li>
					<?php } ?>
					<?php if( $model->BILL_TYPE == 6 ) { ?>
					<li><a href="<?php echo Yii::app()->createUrl("Bill/MedicalBill",array("id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">Medical Bill</span></span></a></li>
					<?php } ?>
					<?php if( $model->BILL_TYPE == 8 ) { ?>
						<li><a href="<?php echo Yii::app()->createUrl("Bill/SalaryDetails",array("id"=>$id))?>"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">Salary Details</span></span></a></li>
						<li><a href="<?php echo Yii::app()->createUrl("Bill/CasualPayBillFrontPage",array("id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">Pay Bill FVC Front Sheet</span></span></a></li>
						<li><a href="<?php echo Yii::app()->createUrl("Bill/CasualPayBillInner",array("id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">Pay Details</span></span></a></li>
						<li><a href="<?php echo Yii::app()->createUrl("Bill/CasualPayBillBackPage",array("id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">Pay Bill FVC Back Sheet</span></span></a></li>
						<li><a href="<?php echo Yii::app()->createUrl("Bill/CasualPTBillFrontPage",array("id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">PT Bill FVC Front Sheet</span></span></a></li>
						<li><a href="<?php echo Yii::app()->createUrl("Bill/CasualPayBillPT",array("id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">PT Schedule</span></span></a></li>
						<li><a href="<?php echo Yii::app()->createUrl("Bill/CasualPTBillBackPage",array("id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">PT Bill FVC Back Sheet</span></span></a></li>
						<li><a href="<?php echo Yii::app()->createUrl("Bill/CasualPayBillSanctionOrder",array("id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">Sanction Order</span></span></a></li>
						<li><a href="<?php echo Yii::app()->createUrl("Bill/EPAY",array("id"=>$id))?>" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">E PAYMENT</span></span></a></li>
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

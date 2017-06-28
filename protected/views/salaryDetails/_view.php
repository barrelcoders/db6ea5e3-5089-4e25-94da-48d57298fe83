<?php
/* @var $this SalaryDetailsController */
/* @var $data SalaryDetails */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->ID), array('view', 'id'=>$data->ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('BILL_ID_FK')); ?>:</b>
	<?php echo CHtml::encode($data->BILL_ID_FK); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('EMPLOYEE_ID_FK')); ?>:</b>
	<?php echo CHtml::encode($data->EMPLOYEE_ID_FK); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('BASIC')); ?>:</b>
	<?php echo CHtml::encode($data->BASIC); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('SP')); ?>:</b>
	<?php echo CHtml::encode($data->SP); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('PP')); ?>:</b>
	<?php echo CHtml::encode($data->PP); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('CCA')); ?>:</b>
	<?php echo CHtml::encode($data->CCA); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('HRA')); ?>:</b>
	<?php echo CHtml::encode($data->HRA); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('DA')); ?>:</b>
	<?php echo CHtml::encode($data->DA); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('TA')); ?>:</b>
	<?php echo CHtml::encode($data->TA); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('IT')); ?>:</b>
	<?php echo CHtml::encode($data->IT); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('CGHS')); ?>:</b>
	<?php echo CHtml::encode($data->CGHS); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('LF')); ?>:</b>
	<?php echo CHtml::encode($data->LF); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('CGEGIS')); ?>:</b>
	<?php echo CHtml::encode($data->CGEGIS); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('CPF_TIER_I')); ?>:</b>
	<?php echo CHtml::encode($data->CPF_TIER_I); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('CPF_TIER_II')); ?>:</b>
	<?php echo CHtml::encode($data->CPF_TIER_II); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('HBA_EMI')); ?>:</b>
	<?php echo CHtml::encode($data->HBA_EMI); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('MCA_EMI')); ?>:</b>
	<?php echo CHtml::encode($data->MCA_EMI); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('FAN_EMI')); ?>:</b>
	<?php echo CHtml::encode($data->FAN_EMI); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('FLOOD_EMI')); ?>:</b>
	<?php echo CHtml::encode($data->FLOOD_EMI); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('CYCLE_EMI')); ?>:</b>
	<?php echo CHtml::encode($data->CYCLE_EMI); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('PLI')); ?>:</b>
	<?php echo CHtml::encode($data->PLI); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('MISC')); ?>:</b>
	<?php echo CHtml::encode($data->MISC); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('PT')); ?>:</b>
	<?php echo CHtml::encode($data->PT); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('FEST_EMI')); ?>:</b>
	<?php echo CHtml::encode($data->FEST_EMI); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('HBA_TOTAL')); ?>:</b>
	<?php echo CHtml::encode($data->HBA_TOTAL); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('MCA_TOTAL')); ?>:</b>
	<?php echo CHtml::encode($data->MCA_TOTAL); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('FLOOD_TOTAL')); ?>:</b>
	<?php echo CHtml::encode($data->FLOOD_TOTAL); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('CYCLE_TOTAL')); ?>:</b>
	<?php echo CHtml::encode($data->CYCLE_TOTAL); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('FEST_TOTAL')); ?>:</b>
	<?php echo CHtml::encode($data->FEST_TOTAL); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('HBA_INST')); ?>:</b>
	<?php echo CHtml::encode($data->HBA_INST); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('MCA_INST')); ?>:</b>
	<?php echo CHtml::encode($data->MCA_INST); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('FLOOD_INST')); ?>:</b>
	<?php echo CHtml::encode($data->FLOOD_INST); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('CYCLE_INST')); ?>:</b>
	<?php echo CHtml::encode($data->CYCLE_INST); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('FEST_INST')); ?>:</b>
	<?php echo CHtml::encode($data->FEST_INST); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('HBA_BAL')); ?>:</b>
	<?php echo CHtml::encode($data->HBA_BAL); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('MCA_BAL')); ?>:</b>
	<?php echo CHtml::encode($data->MCA_BAL); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('FLOOD_BAL')); ?>:</b>
	<?php echo CHtml::encode($data->FLOOD_BAL); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('CYCLE_BAL')); ?>:</b>
	<?php echo CHtml::encode($data->CYCLE_BAL); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('FEST_BAL')); ?>:</b>
	<?php echo CHtml::encode($data->FEST_BAL); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('WA')); ?>:</b>
	<?php echo CHtml::encode($data->WA); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('CCS')); ?>:</b>
	<?php echo CHtml::encode($data->CCS); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('LIC')); ?>:</b>
	<?php echo CHtml::encode($data->LIC); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ASSOSC_SUB')); ?>:</b>
	<?php echo CHtml::encode($data->ASSOSC_SUB); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('REMARKS')); ?>:</b>
	<?php echo CHtml::encode($data->REMARKS); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('FAN_TOTAL')); ?>:</b>
	<?php echo CHtml::encode($data->FAN_TOTAL); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('FAN_INST')); ?>:</b>
	<?php echo CHtml::encode($data->FAN_INST); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('FAN_BAL')); ?>:</b>
	<?php echo CHtml::encode($data->FAN_BAL); ?>
	<br />

	*/ ?>

</div>
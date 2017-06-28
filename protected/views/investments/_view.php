<?php
/* @var $this InvestmentsController */
/* @var $data Investments */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->ID), array('view', 'id'=>$data->ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('FINANCIAL_YEAR_ID_FK')); ?>:</b>
	<?php echo CHtml::encode($data->FINANCIAL_YEAR_ID_FK); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('EMPLOYEE_ID')); ?>:</b>
	<?php echo CHtml::encode($data->EMPLOYEE_ID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('HRA')); ?>:</b>
	<?php echo CHtml::encode($data->HRA); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('MEDICAL_INSURANCE')); ?>:</b>
	<?php echo CHtml::encode($data->MEDICAL_INSURANCE); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('DONATION')); ?>:</b>
	<?php echo CHtml::encode($data->DONATION); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('DISABILITY_MED_EXP')); ?>:</b>
	<?php echo CHtml::encode($data->DISABILITY_MED_EXP); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('EDU_LOAD_INT')); ?>:</b>
	<?php echo CHtml::encode($data->EDU_LOAD_INT); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('SELF_DISABILITY')); ?>:</b>
	<?php echo CHtml::encode($data->SELF_DISABILITY); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('HOME_LOAN_INT')); ?>:</b>
	<?php echo CHtml::encode($data->HOME_LOAN_INT); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('HOME_LOAD_EXCESS_2013_14')); ?>:</b>
	<?php echo CHtml::encode($data->HOME_LOAD_EXCESS_2013_14); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('INSURANCE_LIC_OTHER')); ?>:</b>
	<?php echo CHtml::encode($data->INSURANCE_LIC_OTHER); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('TUITION_FESS_EXEMPTION')); ?>:</b>
	<?php echo CHtml::encode($data->TUITION_FESS_EXEMPTION); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('PPF_NSC')); ?>:</b>
	<?php echo CHtml::encode($data->PPF_NSC); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('HOME_LOAD_PR')); ?>:</b>
	<?php echo CHtml::encode($data->HOME_LOAD_PR); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('PLI_ULIP')); ?>:</b>
	<?php echo CHtml::encode($data->PLI_ULIP); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('TERM_DEPOSIT_ABOVE_5')); ?>:</b>
	<?php echo CHtml::encode($data->TERM_DEPOSIT_ABOVE_5); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('MUTUAL_FUND')); ?>:</b>
	<?php echo CHtml::encode($data->MUTUAL_FUND); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('PENSION_FUND')); ?>:</b>
	<?php echo CHtml::encode($data->PENSION_FUND); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('CPF')); ?>:</b>
	<?php echo CHtml::encode($data->CPF); ?>
	<br />

	*/ ?>

</div>
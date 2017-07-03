<?php
/* @var $this EmployeeLICPoliciesController */
/* @var $data EmployeeLICPolicies */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->ID), array('view', 'id'=>$data->ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('EMPLOYEE_ID_FK')); ?>:</b>
	<?php echo CHtml::encode($data->EMPLOYEE_ID_FK); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('POLICY_NO')); ?>:</b>
	<?php echo CHtml::encode($data->POLICY_NO); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('AMOUNT')); ?>:</b>
	<?php echo CHtml::encode($data->AMOUNT); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('STATUS')); ?>:</b>
	<?php echo CHtml::encode($data->STATUS); ?>
	<br />


</div>
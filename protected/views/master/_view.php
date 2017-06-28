<?php
/* @var $this MasterController */
/* @var $data Master */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->ID), array('view', 'id'=>$data->ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('OFFICE_NAME')); ?>:</b>
	<?php echo CHtml::encode($data->OFFICE_NAME); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('OFFICE_ADDRESS')); ?>:</b>
	<?php echo CHtml::encode($data->OFFICE_ADDRESS); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('DEPT_NAME')); ?>:</b>
	<?php echo CHtml::encode($data->DEPT_NAME); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('DEPT_HEAD_EMPLOYEE')); ?>:</b>
	<?php echo CHtml::encode($data->DEPT_HEAD_EMPLOYEE); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('DEPT_ADMIN_EMPLOYEE')); ?>:</b>
	<?php echo CHtml::encode($data->DEPT_ADMIN_EMPLOYEE); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('CURRENT_FINANCIAL_YEAR')); ?>:</b>
	<?php echo CHtml::encode($data->CURRENT_FINANCIAL_YEAR); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('OFFICE_NAME_HINDI')); ?>:</b>
	<?php echo CHtml::encode($data->OFFICE_NAME_HINDI); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('OFFICE_ADDRESS_HINDI')); ?>:</b>
	<?php echo CHtml::encode($data->OFFICE_ADDRESS_HINDI); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('DEPT_NAME_HINDI')); ?>:</b>
	<?php echo CHtml::encode($data->DEPT_NAME_HINDI); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('HOO_OFFICE_NAME')); ?>:</b>
	<?php echo CHtml::encode($data->HOO_OFFICE_NAME); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('HOO_OFFICE_NAME_HINDI')); ?>:</b>
	<?php echo CHtml::encode($data->HOO_OFFICE_NAME_HINDI); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('FINANCIAL_YEAR_START')); ?>:</b>
	<?php echo CHtml::encode($data->FINANCIAL_YEAR_START); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('FINANCIAL_YEAR_END')); ?>:</b>
	<?php echo CHtml::encode($data->FINANCIAL_YEAR_END); ?>
	<br />

	*/ ?>

</div>
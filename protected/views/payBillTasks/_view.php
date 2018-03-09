<?php
/* @var $this PayBillTasksController */
/* @var $data PayBillTasks */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->ID), array('view', 'id'=>$data->ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('EMPLOYEE_ID_FK')); ?>:</b>
	<?php echo CHtml::encode($data->EMPLOYEE_ID_FK); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('MONTH')); ?>:</b>
	<?php echo CHtml::encode($data->MONTH); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('YEAR')); ?>:</b>
	<?php echo CHtml::encode($data->YEAR); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('TASK')); ?>:</b>
	<?php echo CHtml::encode($data->TASK); ?>
	<br />


</div>
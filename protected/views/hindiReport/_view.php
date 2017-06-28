<?php
/* @var $this HindiReportController */
/* @var $data HindiReport */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->ID), array('view', 'id'=>$data->ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('QUARTER')); ?>:</b>
	<?php echo CHtml::encode($data->QUARTER); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('DATE')); ?>:</b>
	<?php echo CHtml::encode($data->DATE); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('EMPLOYEE_ID')); ?>:</b>
	<?php echo CHtml::encode($data->EMPLOYEE_ID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('EMPLOYEE_ID_TYPE')); ?>:</b>
	<?php echo CHtml::encode($data->EMPLOYEE_ID_TYPE); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('COL_1_1')); ?>:</b>
	<?php echo CHtml::encode($data->COL_1_1); ?>
	<br />


</div>
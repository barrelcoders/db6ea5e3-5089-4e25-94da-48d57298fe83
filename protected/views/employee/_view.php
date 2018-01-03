<?php
/* @var $this EmployeeController */
/* @var $data Employee */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->ID), array('view', 'id'=>$data->ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('NAME')); ?>:</b>
	<?php echo CHtml::encode($data->NAME); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('JOIN_DATE')); ?>:</b>
	<?php echo CHtml::encode($data->JOIN_DATE); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('DESIGNATION_ID_FK')); ?>:</b>
	<?php echo CHtml::encode($data->DESIGNATION_ID_FK); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('PAY_MATRIX_ID_FK')); ?>:</b>
	<?php echo CHtml::encode($data->PAY_MATRIX_ID_FK); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('NEXT_INCREMENT_DATE')); ?>:</b>
	<?php echo CHtml::encode($data->NEXT_INCREMENT_DATE); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('PENSION_ACC_NO')); ?>:</b>
	<?php echo CHtml::encode($data->PENSION_ACC_NO); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('FOLIO_NO')); ?>:</b>
	<?php echo CHtml::encode($data->FOLIO_NO); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('GROUP_ID_FK')); ?>:</b>
	<?php echo CHtml::encode($data->GROUP_ID_FK); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('RELIEF_DATE')); ?>:</b>
	<?php echo CHtml::encode($data->RELIEF_DATE); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('DOB')); ?>:</b>
	<?php echo CHtml::encode($data->DOB); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('NAME_HINDI')); ?>:</b>
	<?php echo CHtml::encode($data->NAME_HINDI); ?>
	<br />

	*/ ?>

</div>
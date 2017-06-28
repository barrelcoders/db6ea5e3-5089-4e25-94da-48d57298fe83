<?php
/* @var $this FilesController */
/* @var $data Files */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->ID), array('view', 'id'=>$data->ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('NUMBER')); ?>:</b>
	<?php echo CHtml::encode($data->NUMBER); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('SUBJECT')); ?>:</b>
	<?php echo CHtml::encode($data->SUBJECT); ?>
	<br />


</div>
<?php
/* @var $this BudgetController */
/* @var $data Budget */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('HEAD')); ?>:</b>
	<?php echo CHtml::encode($data->HEAD); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('AMOUNT')); ?>:</b>
	<?php echo CHtml::encode($data->AMOUNT); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('YEAR')); ?>:</b>
	<?php echo CHtml::encode($data->YEAR); ?>
	<br />


</div>
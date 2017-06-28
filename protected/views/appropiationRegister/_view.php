<?php
/* @var $this AppropiationRegisterController */
/* @var $data AppropiationRegister */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->ID), array('view', 'id'=>$data->ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('BILL_NO')); ?>:</b>
	<?php echo CHtml::encode($data->BILL_NO); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('BILL_AMOUNT')); ?>:</b>
	<?php echo CHtml::encode($data->BILL_AMOUNT); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('EXPENDITURE_INC_BILL')); ?>:</b>
	<?php echo CHtml::encode($data->EXPENDITURE_INC_BILL); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('BALANCE')); ?>:</b>
	<?php echo CHtml::encode($data->BALANCE); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('BUDGET_ID')); ?>:</b>
	<?php echo CHtml::encode($data->BUDGET_ID); ?>
	<br />


</div>
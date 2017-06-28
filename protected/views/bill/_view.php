<?php
/* @var $this BillController */
/* @var $data Bill */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('BILL_NO')); ?>:</b>
	<?php echo CHtml::encode($data->BILL_NO); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('PT_DED_BILL_NO')); ?>:</b>
	<?php echo CHtml::encode($data->PT_DED_BILL_NO); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('LIC_DED_BILL_NO')); ?>:</b>
	<?php echo CHtml::encode($data->LIC_DED_BILL_NO); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('NILL_BILL_NO')); ?>:</b>
	<?php echo CHtml::encode($data->NILL_BILL_NO); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('MONTH')); ?>:</b>
	<?php echo CHtml::encode($data->MONTH); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('YEAR')); ?>:</b>
	<?php echo CHtml::encode($data->YEAR); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('CREATION_DATE')); ?>:</b>
	<?php echo CHtml::encode($data->CREATION_DATE); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('BILL_TYPE')); ?>:</b>
	<?php echo CHtml::encode($data->BILL_TYPE); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('BILL_AMOUNT')); ?>:</b>
	<?php echo CHtml::encode($data->BILL_AMOUNT); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('EXPENDITURE_INC_BILL')); ?>:</b>
	<?php echo CHtml::encode($data->EXPENDITURE_INC_BILL); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('APPROPIATION_BALANCE')); ?>:</b>
	<?php echo CHtml::encode($data->APPROPIATION_BALANCE); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('PFMS_BILL_NO')); ?>:</b>
	<?php echo CHtml::encode($data->PFMS_BILL_NO); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('FILE_NO')); ?>:</b>
	<?php echo CHtml::encode($data->FILE_NO); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('BILL_TITLE')); ?>:</b>
	<?php echo CHtml::encode($data->BILL_TITLE); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('CER_NO')); ?>:</b>
	<?php echo CHtml::encode($data->CER_NO); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('PFMS_STATUS')); ?>:</b>
	<?php echo CHtml::encode($data->PFMS_STATUS); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('BILL_SUB_TYPE')); ?>:</b>
	<?php echo CHtml::encode($data->BILL_SUB_TYPE); ?>
	<br />

	*/ ?>

</div>
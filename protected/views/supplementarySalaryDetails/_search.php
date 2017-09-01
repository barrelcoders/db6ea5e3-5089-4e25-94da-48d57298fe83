<?php
/* @var $this SupplementarySalaryDetailsController */
/* @var $model SupplementarySalaryDetails */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'ID'); ?>
		<?php echo $form->textField($model,'ID',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'EMPLOYEE_ID_FK'); ?>
		<?php echo $form->textField($model,'EMPLOYEE_ID_FK',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'BASIC'); ?>
		<?php echo $form->textField($model,'BASIC',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'SP'); ?>
		<?php echo $form->textField($model,'SP',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'PP'); ?>
		<?php echo $form->textField($model,'PP',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'CCA'); ?>
		<?php echo $form->textField($model,'CCA',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'HRA'); ?>
		<?php echo $form->textField($model,'HRA',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'DA'); ?>
		<?php echo $form->textField($model,'DA',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'TA'); ?>
		<?php echo $form->textField($model,'TA',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'IT'); ?>
		<?php echo $form->textField($model,'IT',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'CGHS'); ?>
		<?php echo $form->textField($model,'CGHS',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'LF'); ?>
		<?php echo $form->textField($model,'LF',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'CGEGIS'); ?>
		<?php echo $form->textField($model,'CGEGIS',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'CPF_TIER_I'); ?>
		<?php echo $form->textField($model,'CPF_TIER_I',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'CPF_TIER_II'); ?>
		<?php echo $form->textField($model,'CPF_TIER_II',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'HBA_EMI'); ?>
		<?php echo $form->textField($model,'HBA_EMI',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'MCA_EMI'); ?>
		<?php echo $form->textField($model,'MCA_EMI',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'FAN_EMI'); ?>
		<?php echo $form->textField($model,'FAN_EMI',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'FLOOD_EMI'); ?>
		<?php echo $form->textField($model,'FLOOD_EMI',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'CYCLE_EMI'); ?>
		<?php echo $form->textField($model,'CYCLE_EMI',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'PLI'); ?>
		<?php echo $form->textField($model,'PLI',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'MISC'); ?>
		<?php echo $form->textField($model,'MISC',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'PT'); ?>
		<?php echo $form->textField($model,'PT',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'FEST_EMI'); ?>
		<?php echo $form->textField($model,'FEST_EMI',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'HBA_TOTAL'); ?>
		<?php echo $form->textField($model,'HBA_TOTAL',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'MCA_TOTAL'); ?>
		<?php echo $form->textField($model,'MCA_TOTAL',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'FLOOD_TOTAL'); ?>
		<?php echo $form->textField($model,'FLOOD_TOTAL',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'CYCLE_TOTAL'); ?>
		<?php echo $form->textField($model,'CYCLE_TOTAL',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'FEST_TOTAL'); ?>
		<?php echo $form->textField($model,'FEST_TOTAL',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'HBA_INST'); ?>
		<?php echo $form->textField($model,'HBA_INST',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'MCA_INST'); ?>
		<?php echo $form->textField($model,'MCA_INST',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'FLOOD_INST'); ?>
		<?php echo $form->textField($model,'FLOOD_INST',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'CYCLE_INST'); ?>
		<?php echo $form->textField($model,'CYCLE_INST',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'FEST_INST'); ?>
		<?php echo $form->textField($model,'FEST_INST',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'HBA_BAL'); ?>
		<?php echo $form->textField($model,'HBA_BAL',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'MCA_BAL'); ?>
		<?php echo $form->textField($model,'MCA_BAL',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'FLOOD_BAL'); ?>
		<?php echo $form->textField($model,'FLOOD_BAL',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'CYCLE_BAL'); ?>
		<?php echo $form->textField($model,'CYCLE_BAL',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'FEST_BAL'); ?>
		<?php echo $form->textField($model,'FEST_BAL',array('size'=>11,'maxlength'=>11)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'WA'); ?>
		<?php echo $form->textField($model,'WA',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'CCS'); ?>
		<?php echo $form->textField($model,'CCS',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'LIC'); ?>
		<?php echo $form->textField($model,'LIC',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ASSOSC_SUB'); ?>
		<?php echo $form->textField($model,'ASSOSC_SUB',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'REMARKS'); ?>
		<?php echo $form->textField($model,'REMARKS',array('size'=>60,'maxlength'=>200)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'FAN_TOTAL'); ?>
		<?php echo $form->textField($model,'FAN_TOTAL',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'FAN_INST'); ?>
		<?php echo $form->textField($model,'FAN_INST',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'FAN_BAL'); ?>
		<?php echo $form->textField($model,'FAN_BAL',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'MONTH'); ?>
		<?php echo $form->textField($model,'MONTH',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'YEAR'); ?>
		<?php echo $form->textField($model,'YEAR',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'GP'); ?>
		<?php echo $form->textField($model,'GP',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'GROSS'); ?>
		<?php echo $form->textField($model,'GROSS'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'DED'); ?>
		<?php echo $form->textField($model,'DED'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'NET'); ?>
		<?php echo $form->textField($model,'NET'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'OTHER_DED'); ?>
		<?php echo $form->textField($model,'OTHER_DED'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'AMOUNT_BANK'); ?>
		<?php echo $form->textField($model,'AMOUNT_BANK'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'IS_SALARY_BILL'); ?>
		<?php echo $form->textField($model,'IS_SALARY_BILL'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'IS_FEST_RECOVERY'); ?>
		<?php echo $form->textField($model,'IS_FEST_RECOVERY'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'IS_HBA_RECOVERY'); ?>
		<?php echo $form->textField($model,'IS_HBA_RECOVERY'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'IS_MCA_RECOVERY'); ?>
		<?php echo $form->textField($model,'IS_MCA_RECOVERY'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'IS_FLOOD_RECOVERY'); ?>
		<?php echo $form->textField($model,'IS_FLOOD_RECOVERY'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'IS_CYCLE_RECOVERY'); ?>
		<?php echo $form->textField($model,'IS_CYCLE_RECOVERY'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'IS_FAN_RECOVERY'); ?>
		<?php echo $form->textField($model,'IS_FAN_RECOVERY'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'MAINT_MADIWALA'); ?>
		<?php echo $form->textField($model,'MAINT_MADIWALA'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'MAINT_JAYAMAHAL'); ?>
		<?php echo $form->textField($model,'MAINT_JAYAMAHAL'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'COURT_ATTACHMENT'); ?>
		<?php echo $form->textField($model,'COURT_ATTACHMENT',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'EL_ENCASHMENT'); ?>
		<?php echo $form->textField($model,'EL_ENCASHMENT',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
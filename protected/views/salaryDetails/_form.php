<?php
/* @var $this SalaryDetailsController */
/* @var $model SalaryDetails */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'salary-details-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'BILL_ID_FK'); ?>
		<?php echo $form->textField($model,'BILL_ID_FK',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'BILL_ID_FK'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'EMPLOYEE_ID_FK'); ?>
		<?php echo $form->textField($model,'EMPLOYEE_ID_FK',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'EMPLOYEE_ID_FK'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'BASIC'); ?>
		<?php echo $form->textField($model,'BASIC',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'BASIC'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'SP'); ?>
		<?php echo $form->textField($model,'SP',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'SP'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'PP'); ?>
		<?php echo $form->textField($model,'PP',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'PP'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'CCA'); ?>
		<?php echo $form->textField($model,'CCA',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'CCA'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'HRA'); ?>
		<?php echo $form->textField($model,'HRA',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'HRA'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'DA'); ?>
		<?php echo $form->textField($model,'DA',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'DA'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'TA'); ?>
		<?php echo $form->textField($model,'TA',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'TA'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'IT'); ?>
		<?php echo $form->textField($model,'IT',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'IT'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'CGHS'); ?>
		<?php echo $form->textField($model,'CGHS',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'CGHS'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'LF'); ?>
		<?php echo $form->textField($model,'LF',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'LF'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'CGEGIS'); ?>
		<?php echo $form->textField($model,'CGEGIS',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'CGEGIS'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'CPF_TIER_I'); ?>
		<?php echo $form->textField($model,'CPF_TIER_I',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'CPF_TIER_I'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'CPF_TIER_II'); ?>
		<?php echo $form->textField($model,'CPF_TIER_II',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'CPF_TIER_II'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'HBA_EMI'); ?>
		<?php echo $form->textField($model,'HBA_EMI',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'HBA_EMI'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'MCA_EMI'); ?>
		<?php echo $form->textField($model,'MCA_EMI',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'MCA_EMI'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'FAN_EMI'); ?>
		<?php echo $form->textField($model,'FAN_EMI',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'FAN_EMI'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'FLOOD_EMI'); ?>
		<?php echo $form->textField($model,'FLOOD_EMI',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'FLOOD_EMI'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'CYCLE_EMI'); ?>
		<?php echo $form->textField($model,'CYCLE_EMI',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'CYCLE_EMI'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'PLI'); ?>
		<?php echo $form->textField($model,'PLI',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'PLI'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'MISC'); ?>
		<?php echo $form->textField($model,'MISC',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'MISC'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'PT'); ?>
		<?php echo $form->textField($model,'PT',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'PT'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'FEST_EMI'); ?>
		<?php echo $form->textField($model,'FEST_EMI',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'FEST_EMI'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'HBA_TOTAL'); ?>
		<?php echo $form->textField($model,'HBA_TOTAL',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'HBA_TOTAL'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'MCA_TOTAL'); ?>
		<?php echo $form->textField($model,'MCA_TOTAL',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'MCA_TOTAL'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'FLOOD_TOTAL'); ?>
		<?php echo $form->textField($model,'FLOOD_TOTAL',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'FLOOD_TOTAL'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'CYCLE_TOTAL'); ?>
		<?php echo $form->textField($model,'CYCLE_TOTAL',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'CYCLE_TOTAL'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'FEST_TOTAL'); ?>
		<?php echo $form->textField($model,'FEST_TOTAL',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'FEST_TOTAL'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'HBA_INST'); ?>
		<?php echo $form->textField($model,'HBA_INST',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'HBA_INST'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'MCA_INST'); ?>
		<?php echo $form->textField($model,'MCA_INST',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'MCA_INST'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'FLOOD_INST'); ?>
		<?php echo $form->textField($model,'FLOOD_INST',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'FLOOD_INST'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'CYCLE_INST'); ?>
		<?php echo $form->textField($model,'CYCLE_INST',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'CYCLE_INST'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'FEST_INST'); ?>
		<?php echo $form->textField($model,'FEST_INST',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'FEST_INST'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'HBA_BAL'); ?>
		<?php echo $form->textField($model,'HBA_BAL',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'HBA_BAL'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'MCA_BAL'); ?>
		<?php echo $form->textField($model,'MCA_BAL',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'MCA_BAL'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'FLOOD_BAL'); ?>
		<?php echo $form->textField($model,'FLOOD_BAL',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'FLOOD_BAL'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'CYCLE_BAL'); ?>
		<?php echo $form->textField($model,'CYCLE_BAL',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'CYCLE_BAL'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'FEST_BAL'); ?>
		<?php echo $form->textField($model,'FEST_BAL'); ?>
		<?php echo $form->error($model,'FEST_BAL'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'WA'); ?>
		<?php echo $form->textField($model,'WA',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'WA'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'CCS'); ?>
		<?php echo $form->textField($model,'CCS',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'CCS'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'LIC'); ?>
		<?php echo $form->textField($model,'LIC',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'LIC'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ASSOSC_SUB'); ?>
		<?php echo $form->textField($model,'ASSOSC_SUB',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'ASSOSC_SUB'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'REMARKS'); ?>
		<?php echo $form->textField($model,'REMARKS',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'REMARKS'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'FAN_TOTAL'); ?>
		<?php echo $form->textField($model,'FAN_TOTAL',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'FAN_TOTAL'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'FAN_INST'); ?>
		<?php echo $form->textField($model,'FAN_INST',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'FAN_INST'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'FAN_BAL'); ?>
		<?php echo $form->textField($model,'FAN_BAL',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'FAN_BAL'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
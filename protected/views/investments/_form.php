<?php
/* @var $this InvestmentsController */
/* @var $model Investments */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'investments-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'FINANCIAL_YEAR_ID_FK'); ?>
		<?php echo $form->textField($model,'FINANCIAL_YEAR_ID_FK',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'FINANCIAL_YEAR_ID_FK'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'EMPLOYEE_ID'); ?>
		<?php echo $form->textField($model,'EMPLOYEE_ID',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'EMPLOYEE_ID'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'HRA'); ?>
		<?php echo $form->textField($model,'HRA',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'HRA'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'MEDICAL_INSURANCE'); ?>
		<?php echo $form->textField($model,'MEDICAL_INSURANCE',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'MEDICAL_INSURANCE'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'DONATION'); ?>
		<?php echo $form->textField($model,'DONATION',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'DONATION'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'DISABILITY_MED_EXP'); ?>
		<?php echo $form->textField($model,'DISABILITY_MED_EXP',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'DISABILITY_MED_EXP'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'EDU_LOAD_INT'); ?>
		<?php echo $form->textField($model,'EDU_LOAD_INT',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'EDU_LOAD_INT'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'SELF_DISABILITY'); ?>
		<?php echo $form->textField($model,'SELF_DISABILITY',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'SELF_DISABILITY'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'HOME_LOAN_INT'); ?>
		<?php echo $form->textField($model,'HOME_LOAN_INT',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'HOME_LOAN_INT'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'HOME_LOAD_EXCESS_2013_14'); ?>
		<?php echo $form->textField($model,'HOME_LOAD_EXCESS_2013_14',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'HOME_LOAD_EXCESS_2013_14'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'INSURANCE_LIC_OTHER'); ?>
		<?php echo $form->textField($model,'INSURANCE_LIC_OTHER',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'INSURANCE_LIC_OTHER'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'TUITION_FESS_EXEMPTION'); ?>
		<?php echo $form->textField($model,'TUITION_FESS_EXEMPTION',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'TUITION_FESS_EXEMPTION'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'PPF_NSC'); ?>
		<?php echo $form->textField($model,'PPF_NSC',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'PPF_NSC'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'HOME_LOAD_PR'); ?>
		<?php echo $form->textField($model,'HOME_LOAD_PR',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'HOME_LOAD_PR'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'PLI_ULIP'); ?>
		<?php echo $form->textField($model,'PLI_ULIP',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'PLI_ULIP'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'TERM_DEPOSIT_ABOVE_5'); ?>
		<?php echo $form->textField($model,'TERM_DEPOSIT_ABOVE_5',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'TERM_DEPOSIT_ABOVE_5'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'MUTUAL_FUND'); ?>
		<?php echo $form->textField($model,'MUTUAL_FUND',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'MUTUAL_FUND'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'PENSION_FUND'); ?>
		<?php echo $form->textField($model,'PENSION_FUND',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'PENSION_FUND'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'CPF'); ?>
		<?php echo $form->textField($model,'CPF',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'CPF'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
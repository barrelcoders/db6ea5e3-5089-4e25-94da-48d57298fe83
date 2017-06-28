<?php
/* @var $this InvestmentsController */
/* @var $model Investments */
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
		<?php echo $form->label($model,'FINANCIAL_YEAR_ID_FK'); ?>
		<?php echo $form->textField($model,'FINANCIAL_YEAR_ID_FK',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'EMPLOYEE_ID'); ?>
		<?php echo $form->textField($model,'EMPLOYEE_ID',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'HRA'); ?>
		<?php echo $form->textField($model,'HRA',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'MEDICAL_INSURANCE'); ?>
		<?php echo $form->textField($model,'MEDICAL_INSURANCE',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'DONATION'); ?>
		<?php echo $form->textField($model,'DONATION',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'DISABILITY_MED_EXP'); ?>
		<?php echo $form->textField($model,'DISABILITY_MED_EXP',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'EDU_LOAD_INT'); ?>
		<?php echo $form->textField($model,'EDU_LOAD_INT',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'SELF_DISABILITY'); ?>
		<?php echo $form->textField($model,'SELF_DISABILITY',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'HOME_LOAN_INT'); ?>
		<?php echo $form->textField($model,'HOME_LOAN_INT',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'HOME_LOAD_EXCESS_2013_14'); ?>
		<?php echo $form->textField($model,'HOME_LOAD_EXCESS_2013_14',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'INSURANCE_LIC_OTHER'); ?>
		<?php echo $form->textField($model,'INSURANCE_LIC_OTHER',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'TUITION_FESS_EXEMPTION'); ?>
		<?php echo $form->textField($model,'TUITION_FESS_EXEMPTION',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'PPF_NSC'); ?>
		<?php echo $form->textField($model,'PPF_NSC',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'HOME_LOAD_PR'); ?>
		<?php echo $form->textField($model,'HOME_LOAD_PR',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'PLI_ULIP'); ?>
		<?php echo $form->textField($model,'PLI_ULIP',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'TERM_DEPOSIT_ABOVE_5'); ?>
		<?php echo $form->textField($model,'TERM_DEPOSIT_ABOVE_5',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'MUTUAL_FUND'); ?>
		<?php echo $form->textField($model,'MUTUAL_FUND',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'PENSION_FUND'); ?>
		<?php echo $form->textField($model,'PENSION_FUND',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'CPF'); ?>
		<?php echo $form->textField($model,'CPF',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
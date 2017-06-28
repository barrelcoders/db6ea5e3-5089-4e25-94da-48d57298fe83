<?php
/* @var $this HindiReportController */
/* @var $model HindiReport */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'hindi-report-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'QUARTER'); ?>
		<?php echo $form->textField($model,'QUARTER',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'QUARTER'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'DATE'); ?>
		<?php echo $form->textField($model,'DATE'); ?>
		<?php echo $form->error($model,'DATE'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'EMPLOYEE_ID'); ?>
		<?php echo $form->textField($model,'EMPLOYEE_ID',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'EMPLOYEE_ID'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'EMPLOYEE_ID_TYPE'); ?>
		<?php echo $form->textField($model,'EMPLOYEE_ID_TYPE',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'EMPLOYEE_ID_TYPE'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'COL_1_1'); ?>
		<?php echo $form->textField($model,'COL_1_1',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'COL_1_1'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
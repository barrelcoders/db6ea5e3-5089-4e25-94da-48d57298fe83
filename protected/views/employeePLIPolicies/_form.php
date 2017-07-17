<?php
/* @var $this EmployeePLIPoliciesController */
/* @var $model EmployeePLIPolicies */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'employee-plipolicies-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'EMPLOYEE_ID_FK'); ?>
		<?php echo $form->textField($model,'EMPLOYEE_ID_FK',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'EMPLOYEE_ID_FK'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'POLICY_NO'); ?>
		<?php echo $form->textField($model,'POLICY_NO',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'POLICY_NO'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'AMOUNT'); ?>
		<?php echo $form->textField($model,'AMOUNT',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'AMOUNT'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'STATUS'); ?>
		<?php echo $form->textField($model,'STATUS'); ?>
		<?php echo $form->error($model,'STATUS'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
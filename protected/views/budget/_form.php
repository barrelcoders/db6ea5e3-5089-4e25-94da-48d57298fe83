<?php
/* @var $this BudgetController */
/* @var $model Budget */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'budget-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'HEAD'); ?>
		<?php echo $form->textField($model,'HEAD',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'HEAD'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'AMOUNT'); ?>
		<?php echo $form->textField($model,'AMOUNT',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'AMOUNT'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'YEAR'); ?>
		<?php echo $form->textField($model,'YEAR',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'YEAR'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
<?php
/* @var $this AppropiationRegisterController */
/* @var $model AppropiationRegister */
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
		<?php echo $form->label($model,'BILL_NO'); ?>
		<?php echo $form->textField($model,'BILL_NO',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'BILL_AMOUNT'); ?>
		<?php echo $form->textField($model,'BILL_AMOUNT',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'EXPENDITURE_INC_BILL'); ?>
		<?php echo $form->textField($model,'EXPENDITURE_INC_BILL',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'BALANCE'); ?>
		<?php echo $form->textField($model,'BALANCE',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'BUDGET_ID'); ?>
		<?php echo $form->textField($model,'BUDGET_ID',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
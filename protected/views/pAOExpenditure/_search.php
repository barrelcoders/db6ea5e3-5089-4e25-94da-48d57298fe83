<?php
/* @var $this PAOExpenditureController */
/* @var $model PAOExpenditure */
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
		<?php echo $form->label($model,'SALARY'); ?>
		<?php echo $form->textField($model,'SALARY',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'MEDICAL'); ?>
		<?php echo $form->textField($model,'MEDICAL',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'DTE'); ?>
		<?php echo $form->textField($model,'DTE',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'OE'); ?>
		<?php echo $form->textField($model,'OE',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'RRT'); ?>
		<?php echo $form->textField($model,'RRT',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'IT_SAL'); ?>
		<?php echo $form->textField($model,'IT_SAL',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'IT_ECSS'); ?>
		<?php echo $form->textField($model,'IT_ECSS',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'IT_HCESS'); ?>
		<?php echo $form->textField($model,'IT_HCESS',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'MONTH'); ?>
		<?php echo $form->textField($model,'MONTH',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'YEAR'); ?>
		<?php echo $form->textField($model,'YEAR',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
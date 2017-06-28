<?php
/* @var $this MasterController */
/* @var $model Master */
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
		<?php echo $form->label($model,'OFFICE_NAME'); ?>
		<?php echo $form->textField($model,'OFFICE_NAME',array('size'=>60,'maxlength'=>200)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'OFFICE_ADDRESS'); ?>
		<?php echo $form->textField($model,'OFFICE_ADDRESS',array('size'=>60,'maxlength'=>500)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'DEPT_NAME'); ?>
		<?php echo $form->textField($model,'DEPT_NAME',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'DEPT_HEAD_EMPLOYEE'); ?>
		<?php echo $form->textField($model,'DEPT_HEAD_EMPLOYEE',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'DEPT_ADMIN_EMPLOYEE'); ?>
		<?php echo $form->textField($model,'DEPT_ADMIN_EMPLOYEE',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'CURRENT_FINANCIAL_YEAR'); ?>
		<?php echo $form->textField($model,'CURRENT_FINANCIAL_YEAR',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'OFFICE_NAME_HINDI'); ?>
		<?php echo $form->textField($model,'OFFICE_NAME_HINDI',array('size'=>60,'maxlength'=>200)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'OFFICE_ADDRESS_HINDI'); ?>
		<?php echo $form->textField($model,'OFFICE_ADDRESS_HINDI',array('size'=>60,'maxlength'=>500)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'DEPT_NAME_HINDI'); ?>
		<?php echo $form->textField($model,'DEPT_NAME_HINDI',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'HOO_OFFICE_NAME'); ?>
		<?php echo $form->textField($model,'HOO_OFFICE_NAME',array('size'=>60,'maxlength'=>200)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'HOO_OFFICE_NAME_HINDI'); ?>
		<?php echo $form->textField($model,'HOO_OFFICE_NAME_HINDI',array('size'=>60,'maxlength'=>200)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'FINANCIAL_YEAR_START'); ?>
		<?php echo $form->textField($model,'FINANCIAL_YEAR_START'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'FINANCIAL_YEAR_END'); ?>
		<?php echo $form->textField($model,'FINANCIAL_YEAR_END'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
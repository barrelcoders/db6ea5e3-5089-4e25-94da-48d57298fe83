<?php
/* @var $this EmployeeController */
/* @var $model Employee */
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
		<?php echo $form->label($model,'NAME'); ?>
		<?php echo $form->textField($model,'NAME',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'JOIN_DATE'); ?>
		<?php echo $form->textField($model,'JOIN_DATE'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'DESIGNATION_ID_FK'); ?>
		<?php echo $form->textField($model,'DESIGNATION_ID_FK',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'GRADE_PAY_ID_FK'); ?>
		<?php echo $form->textField($model,'GRADE_PAY_ID_FK',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'DOI'); ?>
		<?php echo $form->textField($model,'DOI'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'PENSION_ACC_NO'); ?>
		<?php echo $form->textField($model,'PENSION_ACC_NO',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'FOLIO_NO'); ?>
		<?php echo $form->textField($model,'FOLIO_NO',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'GROUP_ID_FK'); ?>
		<?php echo $form->textField($model,'GROUP_ID_FK',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'RELIEF_DATE'); ?>
		<?php echo $form->textField($model,'RELIEF_DATE'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'DOB'); ?>
		<?php echo $form->textField($model,'DOB'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'NAME_HINDI'); ?>
		<?php echo $form->textField($model,'NAME_HINDI',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'files-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<div class="form-group row">
		<?php echo $form->labelEx($model,'NUMBER', array('class'=>'col-sm-2 form-control-label')); ?>
		<div class="col-sm-10">
			<p class="form-control-static">
				<?php echo $form->textField($model,'NUMBER',array('size'=>60,'maxlength'=>100, 'value'=>$model->NUMBER)); ?>
			</p>
		</div>
	</div>
	<div class="form-group row">
		<?php echo $form->labelEx($model,'SUBJECT', array('class'=>'col-sm-2 form-control-label')); ?>
		<div class="col-sm-10">
			<p class="form-control-static">
				<?php echo $form->textField($model,'SUBJECT',array('size'=>60,'maxlength'=>100, 'value'=>$model->SUBJECT)); ?>
			</p>
		</div>
	</div>
	
	<div class="form-group row">
		<?php echo $form->labelEx($model,'YEAR', array('class'=>'col-sm-2 form-control-label')); ?>
		<div class="col-sm-10">
			<p class="form-control-static">
				<?php echo $form->textField($model,'YEAR',array('size'=>60,'maxlength'=>100, 'value'=>$model->YEAR)); ?>
			</p>
		</div>
	</div>

	<div class="form-group row">
		<label class='col-sm-2 form-control-label'></label>
		<div class="col-sm-10">
			<p class="form-control-static">
				<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class'=>'btn btn-inline')); ?>
			</p>
		</div>
	</div>

<?php $this->endWidget(); ?>
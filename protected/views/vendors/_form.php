<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'vendors-form',
	'enableAjaxValidation'=>false,
)); ?>
	<div class="form-group row">
		<?php echo $form->labelEx($model,'NAME', array('class'=>'col-sm-2 form-control-label')); ?>
		<div class="col-sm-10">
			<p class="form-control-static">
				<?php echo $form->textField($model,'NAME',array('size'=>60,'maxlength'=>100, 'value'=>$model->NAME)); ?>
			</p>
		</div>
	</div>
	<div class="form-group row">
		<?php echo $form->labelEx($model,'ADDRESS', array('class'=>'col-sm-2 form-control-label')); ?>
		<div class="col-sm-10">
			<p class="form-control-static">
				<?php echo $form->textField($model,'ADDRESS',array('size'=>60,'maxlength'=>100, 'value'=>$model->ADDRESS)); ?>
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
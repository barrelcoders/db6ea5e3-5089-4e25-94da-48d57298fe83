<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="form-group row">
		<?php echo $form->labelEx($model,'QUARTER', array('class'=>'col-sm-2 form-control-label')); ?>
		<div class="col-sm-10">
			<p class="form-control-static">
				<?php echo $form->textField($model,'QUARTER',array('size'=>60,'maxlength'=>100, 'value'=>$model->QUARTER)); ?>
			</p>
		</div>
	</div>
	<div class="form-group row">
		<?php echo $form->labelEx($model,'QUARTER', array('class'=>'col-sm-2 form-control-label')); ?>
		<div class="col-sm-10">
			<p class="form-control-static">
				<?php echo $form->textField($model,'QUARTER',array('size'=>60,'maxlength'=>100, 'value'=>$model->QUARTER)); ?>
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

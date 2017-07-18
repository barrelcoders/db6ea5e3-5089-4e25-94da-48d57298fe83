<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<div class="col-sm-6">
			<div class="form-group row">
				<?php echo $form->labelEx($model,'NAME', array('class'=>'col-sm-2 form-control-label')); ?>
				<div class="col-sm-10">
					<p class="form-control-static">
						<?php echo $form->textField($model,'NAME',array('size'=>40,'maxlength'=>100, 'value'=>$model->NAME));?>
					</p>
				</div>
			</div>
		</div>
		<div class="col-sm-6">
			<div class="form-group row">
				<?php echo $form->labelEx($model,'DESIGNATION_ID_FK', array('class'=>'col-sm-2 form-control-label')); ?>
				<div class="col-sm-10">
					<p class="form-control-static">
						<?php echo $form->dropDownList($model,'DESIGNATION_ID_FK',CHtml::listData(Designations::model()->findAll(), 'ID', 'DESIGNATION') , array('empty'=>array('0'=>'Select Designation'),));	?>
					</p>
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-2 form-control-label"></label>
				<div class="col-sm-10">
					<p class="form-control-static">
						<?php echo CHtml::submitButton('Search', array('class'=>'btn btn-inline')); ?>
					</p>
				</div>
			</div>
		</div>
	</div>

<?php $this->endWidget(); ?>

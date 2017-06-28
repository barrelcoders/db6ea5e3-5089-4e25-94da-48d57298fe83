<?php 
	$monthName = array('1'=>'January', '2'=>'February', '3'=>'March', '4'=>'April', '5'=>'May', '6'=>'June', '7'=>'July', '8'=>'August', '9'=>'September', '10'=>'October', '11'=>'November', '12'=>'December');
	$yearName = array('2016'=>'2016', '2017'=>'2017', );
?>
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'paoexpenditure-form',
	'enableAjaxValidation'=>false,
)); ?>
	<div class="form-group row">
		<?php echo $form->labelEx($model,'DATE', array('class'=>'col-sm-2 form-control-label')); ?>
		<div class="col-sm-10">
			<p class="form-control-static">
				<?php 
					$this->widget('zii.widgets.jui.CJuiDatePicker',array(
						'model'=>$model,
						'attribute'=>'DATE',
						'options'=>array(
							'dateFormat'=>'yy-mm-dd',
							'showAnim'=>'fold',
						),
						'htmlOptions'=>array(
							'style'=>'height:20px;',
							'disabled'=>Yii::app()->controller->action->id == 'update'
						),
					));	?>
			</p>
		</div>
	</div>
	<div class="form-group row">
		<?php echo $form->labelEx($model,'MONTH', array('class'=>'col-sm-2 form-control-label')); ?>
		<div class="col-sm-10">
			<p class="form-control-static">
				<select name="PAOExpenditure[MONTH]" id="PAOExpenditure_MONTH">
					<?php
						foreach($monthName as $key=>$value){
							$selected = ($model->MONTH == $key) ? 'selected':'';
							echo "<option value='$key' ".$selected." >$value</option>";
						}
					?>
				</select>
			</p>
		</div>
	</div>
	<div class="form-group row">
		<?php echo $form->labelEx($model,'YEAR', array('class'=>'col-sm-2 form-control-label')); ?>
		<div class="col-sm-10">
			<p class="form-control-static">
				<select name="PAOExpenditure[YEAR]" id="PAOExpenditure_YEAR">
					<?php
						foreach($yearName as $key=>$value){
							$selected = ($model->YEAR == $key) ? 'selected':'';
							echo "<option value='$key' ".$selected." >$value</option>";
						}
					?>
				</select>
			</p>
		</div>
	</div>
	<div class="form-group row">
		<?php echo $form->labelEx($model,'SALARY', array('class'=>'col-sm-2 form-control-label')); ?>
		<div class="col-sm-10">
			<p class="form-control-static">
				<?php echo $form->textField($model,'SALARY',array('size'=>60,'maxlength'=>100, 'value'=>$model->SALARY)); ?>
			</p>
		</div>
	</div>
	<div class="form-group row">
		<?php echo $form->labelEx($model,'MEDICAL', array('class'=>'col-sm-2 form-control-label')); ?>
		<div class="col-sm-10">
			<p class="form-control-static">
				<?php echo $form->textField($model,'MEDICAL',array('size'=>60,'maxlength'=>100, 'value'=>$model->MEDICAL)); ?>
			</p>
		</div>
	</div>
	<div class="form-group row">
		<?php echo $form->labelEx($model,'DTE', array('class'=>'col-sm-2 form-control-label')); ?>
		<div class="col-sm-10">
			<p class="form-control-static">
				<?php echo $form->textField($model,'DTE',array('size'=>60,'maxlength'=>100, 'value'=>$model->DTE)); ?>
			</p>
		</div>
	</div>
	<div class="form-group row">
		<?php echo $form->labelEx($model,'OE', array('class'=>'col-sm-2 form-control-label')); ?>
		<div class="col-sm-10">
			<p class="form-control-static">
				<?php echo $form->textField($model,'OE',array('size'=>60,'maxlength'=>100, 'value'=>$model->OE)); ?>
			</p>
		</div>
	</div>
	<div class="form-group row">
		<?php echo $form->labelEx($model,'RRT', array('class'=>'col-sm-2 form-control-label')); ?>
		<div class="col-sm-10">
			<p class="form-control-static">
				<?php echo $form->textField($model,'RRT',array('size'=>60,'maxlength'=>100, 'value'=>$model->RRT)); ?>
			</p>
		</div>
	</div>
	<div class="form-group row">
		<?php echo $form->labelEx($model,'IT_SAL', array('class'=>'col-sm-2 form-control-label')); ?>
		<div class="col-sm-10">
			<p class="form-control-static">
				<?php echo $form->textField($model,'IT_SAL',array('size'=>60,'maxlength'=>100, 'value'=>$model->IT_SAL)); ?>
			</p>
		</div>
	</div>
	<div class="form-group row">
		<?php echo $form->labelEx($model,'IT_ECSS', array('class'=>'col-sm-2 form-control-label')); ?>
		<div class="col-sm-10">
			<p class="form-control-static">
				<?php echo $form->textField($model,'IT_ECSS',array('size'=>60,'maxlength'=>100, 'value'=>$model->IT_ECSS)); ?>
			</p>
		</div>
	</div>
	<div class="form-group row">
		<?php echo $form->labelEx($model,'IT_HCESS', array('class'=>'col-sm-2 form-control-label')); ?>
		<div class="col-sm-10">
			<p class="form-control-static">
				<?php echo $form->textField($model,'IT_HCESS',array('size'=>60,'maxlength'=>100, 'value'=>$model->IT_HCESS)); ?>
			</p>
		</div>
	</div>
	<div class="form-group row">
		<?php echo $form->labelEx($model,'IT_NON_SAL', array('class'=>'col-sm-2 form-control-label')); ?>
		<div class="col-sm-10">
			<p class="form-control-static">
				<?php echo $form->textField($model,'IT_NON_SAL',array('size'=>60,'maxlength'=>100, 'value'=>$model->IT_NON_SAL)); ?>
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
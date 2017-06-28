<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'appropiation-register-form',
	'enableAjaxValidation'=>false,
)); ?>

	<div class="form-group row">
		<?php echo $form->labelEx($model,'BILL_TYPE', array('class'=>'col-sm-2 form-control-label')); ?>
		<div class="col-sm-10">
			<p class="form-control-static">
				<?php echo $form->dropDownList($model,'BUDGET_ID',CHtml::listData(Budget::model()->findAll(), 'id', 'HEAD'), array('empty'=>array('0'=>'SELECT HEAD'))); ?>
			</p>
		</div>
	</div>
	<div class="form-group row">
		<?php echo $form->labelEx($model,'OPERATION', array('class'=>'col-sm-2 form-control-label')); ?>
		<div class="col-sm-10">
			<p class="form-control-static">
				<select name="AppropiationRegister[OPERATION]" id="AppropiationRegister_OPERATION">
					<option value=""></option>
					<option value="ADD">ADD AMOUNT</option>
					<option value="REMOVE">REMOVE AMOUNT</option>
				</select>
			</p>
		</div>
	</div>
	<div class="form-group row">
		<?php echo $form->labelEx($model,'AMOUNT', array('class'=>'col-sm-2 form-control-label')); ?>
		<div class="col-sm-10">
			<p class="form-control-static">
				<input size="60" maxlength="100" name="AppropiationRegister[AMOUNT]" id="AppropiationRegister_AMOUNT" type="text">
			</p>
		</div>
	</div>
	<div class="form-group row">
		<?php echo $form->labelEx($model,'UPDATION_DATE', array('class'=>'col-sm-2 form-control-label')); ?>
		<div class="col-sm-10">
			<p class="form-control-static">
				<?php 
					$this->widget('zii.widgets.jui.CJuiDatePicker',array(
						'model'=>$model,
						'attribute'=>'UPDATION_DATE',
						'options'=>array(
							'dateFormat'=>'yy-mm-dd',
							'showAnim'=>'fold',
						),
						'htmlOptions'=>array(
							'style'=>'height:20px;',
							'value'=>date('Y-m-d')
						),
					));	?>
			</p>
		</div>
	</div>
	<div class="form-group row">
		<label class="col-sm-2 form-control-label"></label>
		<div class="col-sm-10">
			<p class="form-control-static">
				<?php echo CHtml::submitButton($model->isNewRecord ? 'UPDATE REGISTER' : 'UPDATE REGISTER', array('class'=>'btn btn-inline')); ?>
			</p>
		</div>
	</div>
<?php $this->endWidget(); ?>
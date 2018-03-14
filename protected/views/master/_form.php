<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'master-form',
	'enableAjaxValidation'=>false,
)); ?>

	<div class="form-group row">
		<?php echo $form->labelEx($model,'OFFICE_NAME', array('class'=>'col-sm-2 form-control-label')); ?>
		<div class="col-sm-10">
			<p class="form-control-static">
				<?php echo $form->textField($model,'OFFICE_NAME',array('size'=>100,'maxlength'=>300, 'value'=>$model->OFFICE_NAME)); ?>
			</p>
		</div>
	</div>
	
	<div class="form-group row">
		<?php echo $form->labelEx($model,'OFFICE_NAME_HINDI', array('class'=>'col-sm-2 form-control-label')); ?>
		<div class="col-sm-10">
			<p class="form-control-static">
				<?php echo $form->textField($model,'OFFICE_NAME_HINDI',array('size'=>100,'maxlength'=>300, 'value'=>$model->OFFICE_NAME_HINDI)); ?>
			</p>
		</div>
	</div>
	
	<div class="form-group row">
		<?php echo $form->labelEx($model,'OFFICE_ADDRESS', array('class'=>'col-sm-2 form-control-label')); ?>
		<div class="col-sm-10">
			<p class="form-control-static">
				<?php echo $form->textField($model,'OFFICE_ADDRESS',array('size'=>100,'maxlength'=>300, 'value'=>$model->OFFICE_ADDRESS)); ?>
			</p>
		</div>
	</div>
	
	<div class="form-group row">
		<?php echo $form->labelEx($model,'OFFICE_ADDRESS_HINDI', array('class'=>'col-sm-2 form-control-label')); ?>
		<div class="col-sm-10">
			<p class="form-control-static">
				<?php echo $form->textField($model,'OFFICE_ADDRESS_HINDI',array('size'=>100,'maxlength'=>300, 'value'=>$model->OFFICE_ADDRESS_HINDI)); ?>
			</p>
		</div>
	</div>
	
	<div class="form-group row">
		<?php echo $form->labelEx($model,'DEPT_NAME', array('class'=>'col-sm-2 form-control-label')); ?>
		<div class="col-sm-10">
			<p class="form-control-static">
				<?php echo $form->textField($model,'DEPT_NAME',array('size'=>100,'maxlength'=>300, 'value'=>$model->DEPT_NAME)); ?>
			</p>
		</div>
	</div>
	
	<div class="form-group row">
		<?php echo $form->labelEx($model,'DEPT_NAME_HINDI', array('class'=>'col-sm-2 form-control-label')); ?>
		<div class="col-sm-10">
			<p class="form-control-static">
				<?php echo $form->textField($model,'DEPT_NAME_HINDI',array('size'=>100,'maxlength'=>300, 'value'=>$model->DEPT_NAME_HINDI)); ?>
			</p>
		</div>
	</div>
	
	<div class="form-group row">
		<?php echo $form->labelEx($model,'HOO_OFFICE_NAME', array('class'=>'col-sm-2 form-control-label')); ?>
		<div class="col-sm-10">
			<p class="form-control-static">
				<?php echo $form->textField($model,'HOO_OFFICE_NAME',array('size'=>100,'maxlength'=>300, 'value'=>$model->HOO_OFFICE_NAME)); ?>
			</p>
		</div>
	</div>
	
	<div class="form-group row">
		<?php echo $form->labelEx($model,'HOO_OFFICE_NAME_HINDI', array('class'=>'col-sm-2 form-control-label')); ?>
		<div class="col-sm-10">
			<p class="form-control-static">
				<?php echo $form->textField($model,'HOO_OFFICE_NAME_HINDI',array('size'=>100,'maxlength'=>300, 'value'=>$model->HOO_OFFICE_NAME_HINDI)); ?>
			</p>
		</div>
	</div>
	
	
	<div class="form-group row">
		<?php echo $form->labelEx($model,'DEPT_HEAD_EMPLOYEE', array('class'=>'col-sm-2 form-control-label')); ?>
		<div class="col-sm-10">
			<p class="form-control-static">
				<?php echo $form->dropDownList($model,'DEPT_HEAD_EMPLOYEE',CHtml::listData(Employee::model()->findAll(), 'ID', 'NAME'), array(
			'empty'=>array('0'=>'Select Department Head'),
			'options' => array("'".$model->DEPT_HEAD_EMPLOYEE."'" => array('selected'=>true)))); ?>
			</p>
		</div>
	</div>
	
	<div class="form-group row">
		<?php echo $form->labelEx($model,'DEPT_ADMIN_EMPLOYEE', array('class'=>'col-sm-2 form-control-label')); ?>
		<div class="col-sm-10">
			<p class="form-control-static">
				<?php echo $form->dropDownList($model,'DEPT_ADMIN_EMPLOYEE',CHtml::listData(Employee::model()->findAll(), 'ID', 'NAME'), array(
			'empty'=>array('0'=>'Select Department Administrator'),
			'options' => array("'".$model->DEPT_ADMIN_EMPLOYEE."'" => array('selected'=>true)))); ?>
			</p>
		</div>
	</div>
	<div class="form-group row">
		<?php echo $form->labelEx($model,'PAO_CODE', array('class'=>'col-sm-2 form-control-label')); ?>
		<div class="col-sm-10">
			<p class="form-control-static">
				<?php echo $form->textField($model,'PAO_CODE',array('size'=>100,'maxlength'=>300, 'value'=>$model->PAO_CODE)); ?>
			</p>
		</div>
	</div>
	
	<div class="form-group row">
		<?php echo $form->labelEx($model,'DDO_CODE', array('class'=>'col-sm-2 form-control-label')); ?>
		<div class="col-sm-10">
			<p class="form-control-static">
				<?php echo $form->textField($model,'DDO_CODE',array('size'=>100,'maxlength'=>300, 'value'=>$model->DDO_CODE)); ?>
			</p>
		</div>
	</div>
	<div class="form-group row">
		<?php echo $form->labelEx($model,'CONTROLLER_CODE', array('class'=>'col-sm-2 form-control-label')); ?>
		<div class="col-sm-10">
			<p class="form-control-static">
				<?php echo $form->textField($model,'CONTROLLER_CODE',array('size'=>100,'maxlength'=>300, 'value'=>$model->CONTROLLER_CODE)); ?>
			</p>
		</div>
	</div>
	
	<div class="form-group row">
		<?php echo $form->labelEx($model,'FINANCIAL_YEAR', array('class'=>'col-sm-2 form-control-label')); ?> 
		<div class="col-sm-10">
			<p class="form-control-static">
				<?php
					$currentFY = FinancialYears::model()->find('STATUS=1')->ID;
					$years = FinancialYears::model()->findAll();
				?>
				<select name="Master[FINANCIAL_YEAR]" id="Master_FINANCIAL_YEAR">
					<?php 
						foreach($years as $year){
							if($year->ID == $currentFY){
								?>
									<option value="<?php echo $year->ID;?>" selected><?php echo $year->NAME;?></option>
								<?php	
							}
							else{
								?>
									<option value="<?php echo $year->ID;?>"><?php echo $year->NAME;?></option>
								<?php	
							}
						}
					?>
				</select>
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

</div><!-- form -->
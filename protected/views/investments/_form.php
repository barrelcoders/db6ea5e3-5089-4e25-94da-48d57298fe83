<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'investments-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>
<div class="row">
	<div class="col-sm-12">
		<h3><?php echo Employee::model()->findByPK($id)->NAME.", ".Designations::model()->findByPK(Employee::model()->findByPK($id)->DESIGNATION_ID_FK)->DESIGNATION; ?></h3>
	</div>
	<div class="col-sm-6">
		<div class="form-group row">
			<?php echo $form->labelEx($model,'DA_TA_ARREAR', array('class'=>'col-sm-3 form-control-label')); ?>
			<div class="col-sm-9">
				<p class="form-control-static">
					<?php echo $form->textField($model,'DA_TA_ARREAR',array('size'=>40,'maxlength'=>100, 'value'=>$model->DA_TA_ARREAR, 'style'=>'text-transform: uppercase;')); ?>
				</p>
			</div>
		</div>
		<div class="form-group row">
			<?php echo $form->labelEx($model,'OTA_HONORANIUM', array('class'=>'col-sm-3 form-control-label')); ?>
			<div class="col-sm-9">
				<p class="form-control-static">
					<?php echo $form->textField($model,'OTA_HONORANIUM',array('size'=>40,'maxlength'=>100, 'value'=>$model->OTA_HONORANIUM, 'style'=>'text-transform: uppercase;')); ?>
				</p>
			</div>
		</div>
		<div class="form-group row">
			<?php echo $form->labelEx($model,'HRA', array('class'=>'col-sm-3 form-control-label')); ?>
			<div class="col-sm-9">
				<p class="form-control-static">
					<?php echo $form->textField($model,'HRA',array('size'=>40,'maxlength'=>100, 'value'=>$model->HRA, 'style'=>'text-transform: uppercase;')); ?>
				</p>
			</div>
		</div>
		<div class="form-group row">
			<?php echo $form->labelEx($model,'MEDICAL_INSURANCE', array('class'=>'col-sm-3 form-control-label')); ?>
			<div class="col-sm-9">
				<p class="form-control-static">
					<?php echo $form->textField($model,'MEDICAL_INSURANCE',array('size'=>40,'maxlength'=>100, 'value'=>$model->MEDICAL_INSURANCE, 'style'=>'text-transform: uppercase;')); ?>
				</p>
			</div>
		</div>
		<div class="form-group row">
			<?php echo $form->labelEx($model,'DONATION', array('class'=>'col-sm-3 form-control-label')); ?>
			<div class="col-sm-9">
				<p class="form-control-static">
					<?php echo $form->textField($model,'DONATION',array('size'=>40,'maxlength'=>100, 'value'=>$model->DONATION, 'style'=>'text-transform: uppercase;')); ?>
				</p>
			</div>
		</div>
		<div class="form-group row">
			<?php echo $form->labelEx($model,'DISABILITY_MED_EXP', array('class'=>'col-sm-3 form-control-label')); ?>
			<div class="col-sm-9">
				<p class="form-control-static">
					<?php echo $form->textField($model,'DISABILITY_MED_EXP',array('size'=>40,'maxlength'=>100, 'value'=>$model->DISABILITY_MED_EXP, 'style'=>'text-transform: uppercase;')); ?>
				</p>
			</div>
		</div>
		<div class="form-group row">
			<?php echo $form->labelEx($model,'EDU_LOAD_INT', array('class'=>'col-sm-3 form-control-label')); ?>
			<div class="col-sm-9">
				<p class="form-control-static">
					<?php echo $form->textField($model,'EDU_LOAD_INT',array('size'=>40,'maxlength'=>100, 'value'=>$model->EDU_LOAD_INT, 'style'=>'text-transform: uppercase;')); ?>
				</p>
			</div>
		</div>
		<div class="form-group row">
			<?php echo $form->labelEx($model,'SELF_DISABILITY', array('class'=>'col-sm-3 form-control-label')); ?>
			<div class="col-sm-9">
				<p class="form-control-static">
					<?php echo $form->textField($model,'SELF_DISABILITY',array('size'=>40,'maxlength'=>100, 'value'=>$model->SELF_DISABILITY, 'style'=>'text-transform: uppercase;')); ?>
				</p>
			</div>
		</div>
		<div class="form-group row">
			<?php echo $form->labelEx($model,'HOME_LOAN_INT', array('class'=>'col-sm-3 form-control-label')); ?>
			<div class="col-sm-9">
				<p class="form-control-static">
					<?php echo $form->textField($model,'HOME_LOAN_INT',array('size'=>40,'maxlength'=>100, 'value'=>$model->HOME_LOAN_INT, 'style'=>'text-transform: uppercase;')); ?>
				</p>
			</div>
		</div>
		<div class="form-group row">
			<label class='col-sm-1 form-control-label'></label>
			<div class="col-sm-11">
				<p class="form-control-static">
					<?php echo CHtml::submitButton('Save', array('class'=>'btn btn-inline')); ?>
				</p>
			</div>
		</div>
	</div>
	<div class="col-sm-6">
		<div class="form-group row">
			<?php echo $form->labelEx($model,'HOME_LOAD_EXCESS_2013_14', array('class'=>'col-sm-3 form-control-label')); ?>
			<div class="col-sm-9">
				<p class="form-control-static">
					<?php echo $form->textField($model,'HOME_LOAD_EXCESS_2013_14',array('size'=>40,'maxlength'=>100, 'value'=>$model->HOME_LOAD_EXCESS_2013_14, 'style'=>'text-transform: uppercase;')); ?>
				</p>
			</div>
		</div>
		<div class="form-group row">
			<?php echo $form->labelEx($model,'INSURANCE_LIC_OTHER', array('class'=>'col-sm-3 form-control-label')); ?>
			<div class="col-sm-9">
				<p class="form-control-static">
					<?php echo $form->textField($model,'INSURANCE_LIC_OTHER',array('size'=>40,'maxlength'=>100, 'value'=>$model->INSURANCE_LIC_OTHER, 'style'=>'text-transform: uppercase;')); ?>
				</p>
			</div>
		</div>
		<div class="form-group row">
			<?php echo $form->labelEx($model,'TUITION_FESS_EXEMPTION', array('class'=>'col-sm-3 form-control-label')); ?>
			<div class="col-sm-9">
				<p class="form-control-static">
					<?php echo $form->textField($model,'TUITION_FESS_EXEMPTION',array('size'=>40,'maxlength'=>100, 'value'=>$model->TUITION_FESS_EXEMPTION, 'style'=>'text-transform: uppercase;')); ?>
				</p>
			</div>
		</div>
		<div class="form-group row">
			<?php echo $form->labelEx($model,'PPF_NSC', array('class'=>'col-sm-3 form-control-label')); ?>
			<div class="col-sm-9">
				<p class="form-control-static">
					<?php echo $form->textField($model,'PPF_NSC',array('size'=>40,'maxlength'=>100, 'value'=>$model->PPF_NSC, 'style'=>'text-transform: uppercase;')); ?>
				</p>
			</div>
		</div>
		<div class="form-group row">
			<?php echo $form->labelEx($model,'HOME_LOAD_PR', array('class'=>'col-sm-3 form-control-label')); ?>
			<div class="col-sm-9">
				<p class="form-control-static">
					<?php echo $form->textField($model,'HOME_LOAD_PR',array('size'=>40,'maxlength'=>100, 'value'=>$model->HOME_LOAD_PR, 'style'=>'text-transform: uppercase;')); ?>
				</p>
			</div>
		</div>
		<div class="form-group row">
			<?php echo $form->labelEx($model,'PLI_ULIP', array('class'=>'col-sm-3 form-control-label')); ?>
			<div class="col-sm-9">
				<p class="form-control-static">
					<?php echo $form->textField($model,'PLI_ULIP',array('size'=>40,'maxlength'=>100, 'value'=>$model->PLI_ULIP, 'style'=>'text-transform: uppercase;')); ?>
				</p>
			</div>
		</div>
		<div class="form-group row">
			<?php echo $form->labelEx($model,'TERM_DEPOSIT_ABOVE_5', array('class'=>'col-sm-3 form-control-label')); ?>
			<div class="col-sm-9">
				<p class="form-control-static">
					<?php echo $form->textField($model,'TERM_DEPOSIT_ABOVE_5',array('size'=>40,'maxlength'=>100, 'value'=>$model->TERM_DEPOSIT_ABOVE_5, 'style'=>'text-transform: uppercase;')); ?>
				</p>
			</div>
		</div>
		<div class="form-group row">
			<?php echo $form->labelEx($model,'MUTUAL_FUND', array('class'=>'col-sm-3 form-control-label')); ?>
			<div class="col-sm-9">
				<p class="form-control-static">
					<?php echo $form->textField($model,'MUTUAL_FUND',array('size'=>40,'maxlength'=>100, 'value'=>$model->MUTUAL_FUND, 'style'=>'text-transform: uppercase;')); ?>
				</p>
			</div>
		</div>
		<div class="form-group row">
			<?php echo $form->labelEx($model,'PENSION_FUND', array('class'=>'col-sm-3 form-control-label')); ?>
			<div class="col-sm-9">
				<p class="form-control-static">
					<?php echo $form->textField($model,'PENSION_FUND',array('size'=>40,'maxlength'=>100, 'value'=>$model->PENSION_FUND, 'style'=>'text-transform: uppercase;')); ?>
				</p>
			</div>
		</div>
		<div class="form-group row">
			<?php echo $form->labelEx($model,'CPF', array('class'=>'col-sm-3 form-control-label')); ?>
			<div class="col-sm-9">
				<p class="form-control-static">
					<?php echo $form->textField($model,'CPF',array('size'=>40,'maxlength'=>100, 'value'=>$model->CPF, 'style'=>'text-transform: uppercase;')); ?>
				</p>
			</div>
		</div>
	</div>
</div>
<?php $this->endWidget(); ?>
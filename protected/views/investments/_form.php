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
		<?php echo CHtml::submitButton('Save', array('class'=>'btn btn-inline')); ?>
	</div>
	<div class="col-sm-12">
		<section id="blockui-element-container-default" class="card col-sm-12">
			<header class="card-header">
				Other Incomes
			</header>
			<div class="card-block display-table col-sm-12" style="min-height: 100px">
				<div class="col-sm-6">
					<div class="form-group row">
						<?php echo $form->labelEx($model,'OTHER_INCOME', array('class'=>'col-sm-8 form-control-label')); ?>
						<div class="col-sm-6">
							<p class="form-control-static">
								<?php echo $form->textField($model,'OTHER_INCOME',array('size'=>10,'maxlength'=>100, 'value'=>$model->OTHER_INCOME, 'style'=>'text-transform: uppercase;')); ?>
							</p>
						</div>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="form-group row">
						<?php echo $form->labelEx($model,'HOUSE_INCOME', array('class'=>'col-sm-8 form-control-label')); ?>
						<div class="col-sm-6">
							<p class="form-control-static">
								<?php echo $form->textField($model,'HOUSE_INCOME',array('size'=>10,'maxlength'=>100, 'value'=>$model->HOUSE_INCOME, 'style'=>'text-transform: uppercase;')); ?>
							</p>
						</div>
					</div>
				</div>
			</div>
		</section>
	</div>
	<div class="col-sm-12">
		<section id="blockui-element-container-default" class="card col-sm-4">
			<header class="card-header">
				Previous Office Amounts
			</header>
			<div class="card-block display-table col-sm-12" style="min-height: 300px">
				<div class="form-group row">
					<?php echo $form->labelEx($model,'DA_TA_ARREAR', array('class'=>'col-sm-8 form-control-label')); ?>
					<div class="col-sm-4">
						<p class="form-control-static">
							<?php echo $form->textField($model,'DA_TA_ARREAR',array('size'=>10,'maxlength'=>100, 'value'=>$model->DA_TA_ARREAR, 'style'=>'text-transform: uppercase;')); ?>
						</p>
					</div>
				</div>
				<?php if(Employee::model()->findByPK($id)->PENSION_TYPE == "NPS") {?>
				<div class="form-group row">
					<?php echo $form->labelEx($model,'DA_TA_ARREAR_CPF', array('class'=>'col-sm-8 form-control-label')); ?>
					<div class="col-sm-4">
						<p class="form-control-static">
							<?php echo $form->textField($model,'DA_TA_ARREAR_CPF',array('size'=>10,'maxlength'=>100, 'value'=>$model->DA_TA_ARREAR_CPF, 'style'=>'text-transform: uppercase;')); ?>
						</p>
					</div>
				</div>
				<?php } ?>
				<div class="form-group row">
					<?php echo $form->labelEx($model,'UNIFORM', array('class'=>'col-sm-8 form-control-label')); ?>
					<div class="col-sm-4">
						<p class="form-control-static">
							<?php echo $form->textField($model,'UNIFORM',array('size'=>10,'maxlength'=>100, 'value'=>$model->UNIFORM, 'style'=>'text-transform: uppercase;')); ?>
						</p>
					</div>
				</div>
				<div class="form-group row">
					<?php echo $form->labelEx($model,'OTA_HONORANIUM', array('class'=>'col-sm-8 form-control-label')); ?>
					<div class="col-sm-4">
						<p class="form-control-static">
							<?php echo $form->textField($model,'OTA_HONORANIUM',array('size'=>10,'maxlength'=>100, 'value'=>$model->OTA_HONORANIUM, 'style'=>'text-transform: uppercase;')); ?>
						</p>
					</div>
				</div>
				<div class="form-group row">
					<?php echo $form->labelEx($model,'EL_ENCASH', array('class'=>'col-sm-8 form-control-label')); ?>
					<div class="col-sm-4">
						<p class="form-control-static">
							<?php echo $form->textField($model,'EL_ENCASH',array('size'=>10,'maxlength'=>100, 'value'=>$model->EL_ENCASH, 'style'=>'text-transform: uppercase;')); ?>
						</p>
					</div>
				</div>
				<div class="form-group row">
					<?php echo $form->labelEx($model,'LTC_HTC', array('class'=>'col-sm-8 form-control-label')); ?>
					<div class="col-sm-4">
						<p class="form-control-static">
							<?php echo $form->textField($model,'LTC_HTC',array('size'=>10,'maxlength'=>100, 'value'=>$model->LTC_HTC, 'style'=>'text-transform: uppercase;')); ?>
						</p>
					</div>
				</div>
				<div class="form-group row">
					<?php echo $form->labelEx($model,'CEA', array('class'=>'col-sm-8 form-control-label')); ?>
					<div class="col-sm-4">
						<p class="form-control-static">
							<?php echo $form->textField($model,'CEA',array('size'=>10,'maxlength'=>100, 'value'=>$model->CEA, 'style'=>'text-transform: uppercase;')); ?>
						</p>
					</div>
				</div>
				<div class="form-group row">
					<?php echo $form->labelEx($model,'BONUS', array('class'=>'col-sm-8 form-control-label')); ?>
					<div class="col-sm-4">
						<p class="form-control-static">
							<?php echo $form->textField($model,'BONUS',array('size'=>10,'maxlength'=>100, 'value'=>$model->BONUS, 'style'=>'text-transform: uppercase;')); ?>
						</p>
					</div>
				</div>
			</div>
		</section>
		<section id="blockui-element-container-default" class="card col-sm-4">
			<header class="card-header">
				EXEMPTIONS under Ch. VI- A
			</header>
			<div class="card-block display-table col-sm-12" style="min-height: 300px">
				<div class="form-group row">
					<?php echo $form->labelEx($model,'HRA', array('class'=>'col-sm-8 form-control-label')); ?>
					<div class="col-sm-4">
						<p class="form-control-static">
							<?php echo $form->textField($model,'HRA',array('size'=>10,'maxlength'=>100, 'value'=>$model->HRA, 'style'=>'text-transform: uppercase;')); ?>
						</p>
					</div>
				</div>
				<div class="form-group row">
					<?php echo $form->labelEx($model,'MEDICAL_INSURANCE', array('class'=>'col-sm-8 form-control-label')); ?>
					<div class="col-sm-4">
						<p class="form-control-static">
							<?php echo $form->textField($model,'MEDICAL_INSURANCE',array('size'=>10,'maxlength'=>100, 'value'=>$model->MEDICAL_INSURANCE, 'style'=>'text-transform: uppercase;')); ?>
						</p>
					</div>
				</div>				
				<div class="form-group row">
					<?php echo $form->labelEx($model,'DONATION', array('class'=>'col-sm-8 form-control-label')); ?>
					<div class="col-sm-4">
						<p class="form-control-static">
							<?php echo $form->textField($model,'DONATION',array('size'=>10,'maxlength'=>100, 'value'=>$model->DONATION, 'style'=>'text-transform: uppercase;')); ?>
						</p>
					</div>
				</div>
				<div class="form-group row">
					<?php echo $form->labelEx($model,'DISABILITY_MED_EXP', array('class'=>'col-sm-8 form-control-label')); ?>
					<div class="col-sm-4">
						<p class="form-control-static">
							<?php echo $form->textField($model,'DISABILITY_MED_EXP',array('size'=>10,'maxlength'=>100, 'value'=>$model->DISABILITY_MED_EXP, 'style'=>'text-transform: uppercase;')); ?>
						</p>
					</div>
				</div>
				<div class="form-group row">
					<?php echo $form->labelEx($model,'EDU_LOAD_INT', array('class'=>'col-sm-8 form-control-label')); ?>
					<div class="col-sm-4">
						<p class="form-control-static">
							<?php echo $form->textField($model,'EDU_LOAD_INT',array('size'=>10,'maxlength'=>100, 'value'=>$model->EDU_LOAD_INT, 'style'=>'text-transform: uppercase;')); ?>
						</p>
					</div>
				</div>
				<div class="form-group row">
					<?php echo $form->labelEx($model,'SELF_DISABILITY', array('class'=>'col-sm-8 form-control-label')); ?>
					<div class="col-sm-4">
						<p class="form-control-static">
							<?php echo $form->textField($model,'SELF_DISABILITY',array('size'=>10,'maxlength'=>100, 'value'=>$model->SELF_DISABILITY, 'style'=>'text-transform: uppercase;')); ?>
						</p>
					</div>
				</div>
				<div class="form-group row">
					<?php echo $form->labelEx($model,'HOME_LOAN_INT', array('class'=>'col-sm-8 form-control-label')); ?>
					<div class="col-sm-4">
						<p class="form-control-static">
							<?php echo $form->textField($model,'HOME_LOAN_INT',array('size'=>10,'maxlength'=>100, 'value'=>$model->HOME_LOAN_INT, 'style'=>'text-transform: uppercase;')); ?>
						</p>
					</div>
				</div>
				<div class="form-group row">
					<?php echo $form->labelEx($model,'NPS_UNDER_80CCD_1B', array('class'=>'col-sm-8 form-control-label')); ?>
					<div class="col-sm-4">
						<p class="form-control-static">
							<?php echo $form->textField($model,'NPS_UNDER_80CCD_1B',array('size'=>10,'maxlength'=>100, 'value'=>$model->NPS_UNDER_80CCD_1B, 'style'=>'text-transform: uppercase;')); ?>
						</p>
					</div>
				</div>
				<div class="form-group row">
					<?php echo $form->labelEx($model,'BANK_INTEREST_DED_80TTA', array('class'=>'col-sm-8 form-control-label')); ?>
					<div class="col-sm-4">
						<p class="form-control-static">
							<?php echo $form->textField($model,'BANK_INTEREST_DED_80TTA',array('size'=>10,'maxlength'=>100, 'value'=>$model->BANK_INTEREST_DED_80TTA, 'style'=>'text-transform: uppercase;')); ?>
						</p>
					</div>
				</div>
			</div>
		</section>
		<section id="blockui-element-container-default" class="card col-sm-4">
			<header class="card-header">
				SAVINGS(max.1,50,000) U/s.80C
			</header>
			<div class="card-block display-table col-sm-12" style="min-height: 300px">
				<div class="form-group row">
					<?php echo $form->labelEx($model,'INSURANCE_LIC_OTHER', array('class'=>'col-sm-8 form-control-label')); ?>
					<div class="col-sm-4">
						<p class="form-control-static">
							<?php echo $form->textField($model,'INSURANCE_LIC_OTHER',array('size'=>10,'maxlength'=>100, 'value'=>$model->INSURANCE_LIC_OTHER, 'style'=>'text-transform: uppercase;')); ?>
						</p>
					</div>
				</div>
				<div class="form-group row">
					<?php echo $form->labelEx($model,'TUITION_FESS_EXEMPTION', array('class'=>'col-sm-8 form-control-label')); ?>
					<div class="col-sm-4">
						<p class="form-control-static">
							<?php echo $form->textField($model,'TUITION_FESS_EXEMPTION',array('size'=>10,'maxlength'=>100, 'value'=>$model->TUITION_FESS_EXEMPTION, 'style'=>'text-transform: uppercase;')); ?>
						</p>
					</div>
				</div>
				<div class="form-group row">
					<?php echo $form->labelEx($model,'PPF_NSC', array('class'=>'col-sm-8 form-control-label')); ?>
					<div class="col-sm-4">
						<p class="form-control-static">
							<?php echo $form->textField($model,'PPF_NSC',array('size'=>10,'maxlength'=>100, 'value'=>$model->PPF_NSC, 'style'=>'text-transform: uppercase;')); ?>
						</p>
					</div>
				</div>
				<div class="form-group row">
					<?php echo $form->labelEx($model,'HOME_LOAN_PR', array('class'=>'col-sm-8 form-control-label')); ?>
					<div class="col-sm-4">
						<p class="form-control-static">
							<?php echo $form->textField($model,'HOME_LOAN_PR',array('size'=>10,'maxlength'=>100, 'value'=>$model->HOME_LOAN_PR, 'style'=>'text-transform: uppercase;')); ?>
						</p>
					</div>
				</div>
				<div class="form-group row">
					<?php echo $form->labelEx($model,'PLI_ULIP', array('class'=>'col-sm-8 form-control-label')); ?>
					<div class="col-sm-4">
						<p class="form-control-static">
							<?php echo $form->textField($model,'PLI_ULIP',array('size'=>10,'maxlength'=>100, 'value'=>$model->PLI_ULIP, 'style'=>'text-transform: uppercase;')); ?>
						</p>
					</div>
				</div>
				<div class="form-group row">
					<?php echo $form->labelEx($model,'TERM_DEPOSIT_ABOVE_5', array('class'=>'col-sm-8 form-control-label')); ?>
					<div class="col-sm-4">
						<p class="form-control-static">
							<?php echo $form->textField($model,'TERM_DEPOSIT_ABOVE_5',array('size'=>10,'maxlength'=>100, 'value'=>$model->TERM_DEPOSIT_ABOVE_5, 'style'=>'text-transform: uppercase;')); ?>
						</p>
					</div>
				</div>
				<div class="form-group row">
					<?php echo $form->labelEx($model,'MUTUAL_FUND', array('class'=>'col-sm-8 form-control-label')); ?>
					<div class="col-sm-4">
						<p class="form-control-static">
							<?php echo $form->textField($model,'MUTUAL_FUND',array('size'=>10,'maxlength'=>100, 'value'=>$model->MUTUAL_FUND, 'style'=>'text-transform: uppercase;')); ?>
						</p>
					</div>
				</div>
				<div class="form-group row">
					<?php echo $form->labelEx($model,'PENSION_FUND', array('class'=>'col-sm-8 form-control-label')); ?>
					<div class="col-sm-4">
						<p class="form-control-static">
							<?php echo $form->textField($model,'PENSION_FUND',array('size'=>10,'maxlength'=>100, 'value'=>$model->PENSION_FUND, 'style'=>'text-transform: uppercase;')); ?>
						</p>
					</div>
				</div>
				<div class="form-group row">
					<?php echo $form->labelEx($model,'CPF', array('class'=>'col-sm-8 form-control-label')); ?>
					<div class="col-sm-4">
						<p class="form-control-static">
							<?php echo $form->textField($model,'CPF',array('size'=>10,'maxlength'=>100, 'value'=>$model->CPF, 'style'=>'text-transform: uppercase;')); ?>
						</p>
					</div>
				</div>
				<div class="form-group row">
					<?php echo $form->labelEx($model,'REGISTRY_STAMP', array('class'=>'col-sm-8 form-control-label')); ?>
					<div class="col-sm-4">
						<p class="form-control-static">
							<?php echo $form->textField($model,'REGISTRY_STAMP',array('size'=>10,'maxlength'=>100, 'value'=>$model->REGISTRY_STAMP, 'style'=>'text-transform: uppercase;')); ?>
						</p>
					</div>
				</div>
			</div>
		</section>
	</div>
</div>
<?php $this->endWidget(); ?>
<script>
	$('#Investments_DA_TA_ARREAR').on('keyup', function() {
		if($(this).val() != ""){
			$('#Investments_DA_TA_ARREAR_CPF').val(Math.round(parseInt($(this).val())*0.1));
		}
		else{
			$('#Investments_DA_TA_ARREAR_CPF').val(0);
		}
	});
</script>
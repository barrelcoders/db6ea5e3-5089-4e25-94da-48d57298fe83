<?php $master = Master::model()->findByPK(1); ?>
<style>
label{width: 20.666667%}
</style>
<header class="section-header" >
	<div class="tbl">
		<div class="tbl-row">
			<div class="tbl-cell">
				<h2>Investments</h2>
				<div class="subtitle"></div>
			</div>
		</div>
	</div>
</header>
<div class="container-fluid">
	<div class="box-typical box-typical-padding">
	<?php $form=$this->beginWidget('CActiveForm', array(
		'id'=>'exp-form',
		'enableAjaxValidation'=>false,
	)); ?>

	<div class="form-group row">
		<label class='col-sm-2 form-control-label'>Select Employee</label>
		<div class="col-sm-10">
			<p class="form-control-static">
				<?php echo $form->dropDownList($model,'EMPLOYEE_ID',CHtml::listData(Employee::model()->findAll(), 'ID', 'NAME'), array(
					'id'=>'slEmployee',
					'empty'=>array('0'=>'Select Employee'))); ?>
			</p>
		</div>
	</div>
	
	<?php $this->endWidget(); ?>
		<div>
			<?php $form=$this->beginWidget('CActiveForm', array(
				'id'=>'investments-form',
				'action'=>Yii::app()->createUrl('Investments/SaveInvestments'),
				'enableAjaxValidation'=>false,
			)); ?>
				<div class="row">
					<div class="col-sm-6">
						<div class="form-group row">
							<?php echo $form->labelEx($model,'FINANCIAL_YEAR_ID_FK', array('class'=>'col-sm-2 form-control-label')); ?>
							<div class="col-sm-10">
								<p class="form-control-static">
									<span id='FinancialYear'><?php echo FinancialYears::model()->find('STATUS=1')->NAME?></span>
								</p>
							</div>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group row">
							<?php echo $form->labelEx($model,'EMPLOYEE_ID', array('class'=>'col-sm-2 form-control-label')); ?>
							<div class="col-sm-10">
								<p class="form-control-static">
									<span id="Investments_EMPLOYEE_ID"></span>
									<input type="hidden" id="hdSelectedEmployeeID" name="Investments[EMPLOYEE_ID]" value="0"/>
								</p>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-6">
						<div class="form-group row">
							<?php echo $form->labelEx($model,'MEDICAL_INSURANCE', array('class'=>'col-sm-2 form-control-label')); ?>
							<div class="col-sm-10">
								<p class="form-control-static">
									<?php echo $form->textField($model,'MEDICAL_INSURANCE',array('size'=>30,'maxlength'=>10)); ?>
								</p>
							</div>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group row">
							<?php echo $form->labelEx($model,'INSURANCE_LIC_OTHER', array('class'=>'col-sm-2 form-control-label')); ?>
							<div class="col-sm-10">
								<p class="form-control-static">
									<?php echo $form->textField($model,'INSURANCE_LIC_OTHER',array('size'=>30,'maxlength'=>10)); ?>
								</p>
							</div>
						</div>
					</div>
				</div>	
				<div class="row">
					<div class="col-sm-6">
						<div class="form-group row">
							<?php echo $form->labelEx($model,'DONATION', array('class'=>'col-sm-2 form-control-label')); ?>
							<div class="col-sm-10">
								<p class="form-control-static">
									<?php echo $form->textField($model,'DONATION',array('size'=>30,'maxlength'=>10)); ?>
								</p>
							</div>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group row">
							<?php echo $form->labelEx($model,'TUITION_FESS_EXEMPTION', array('class'=>'col-sm-2 form-control-label')); ?>
							<div class="col-sm-10">
								<p class="form-control-static">
									<?php echo $form->textField($model,'TUITION_FESS_EXEMPTION',array('size'=>30,'maxlength'=>10)); ?>
								</p>
							</div>
						</div>
					</div>
				</div>	
				<div class="row">
					<div class="col-sm-6">
						<div class="form-group row">
							<?php echo $form->labelEx($model,'DISABILITY_MED_EXP', array('class'=>'col-sm-2 form-control-label')); ?>
							<div class="col-sm-10">
								<p class="form-control-static">
									<?php echo $form->textField($model,'DISABILITY_MED_EXP',array('size'=>30,'maxlength'=>10)); ?>
								</p>
							</div>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group row">
							<?php echo $form->labelEx($model,'PPF_NSC', array('class'=>'col-sm-2 form-control-label')); ?>
							<div class="col-sm-10">
								<p class="form-control-static">
									<?php echo $form->textField($model,'PPF_NSC',array('size'=>30,'maxlength'=>10)); ?>
								</p>
							</div>
						</div>
					</div>
				</div>	

				<div class="row">
					<div class="col-sm-6">
						<div class="form-group row">
							<?php echo $form->labelEx($model,'EDU_LOAD_INT', array('class'=>'col-sm-2 form-control-label')); ?>
							<div class="col-sm-10">
								<p class="form-control-static">
									<?php echo $form->textField($model,'EDU_LOAD_INT',array('size'=>30,'maxlength'=>10)); ?>
								</p>
							</div>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group row">
							<?php echo $form->labelEx($model,'HOME_LOAD_PR', array('class'=>'col-sm-2 form-control-label')); ?>
							<div class="col-sm-10">
								<p class="form-control-static">
									<?php echo $form->textField($model,'HOME_LOAD_PR',array('size'=>30,'maxlength'=>10)); ?>
								</p>
							</div>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-sm-6">
						<div class="form-group row">
							<?php echo $form->labelEx($model,'SELF_DISABILITY', array('class'=>'col-sm-2 form-control-label')); ?>
							<div class="col-sm-10">
								<p class="form-control-static">
									<?php echo $form->textField($model,'SELF_DISABILITY',array('size'=>30,'maxlength'=>10)); ?>
								</p>
							</div>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group row">
							<?php echo $form->labelEx($model,'PLI_ULIP', array('class'=>'col-sm-2 form-control-label')); ?>
							<div class="col-sm-10">
								<p class="form-control-static">
									<?php echo $form->textField($model,'PLI_ULIP',array('size'=>30,'maxlength'=>10)); ?>
								</p>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-6">
						<div class="form-group row">
							<?php echo $form->labelEx($model,'HOME_LOAN_INT', array('class'=>'col-sm-2 form-control-label')); ?>
							<div class="col-sm-10">
								<p class="form-control-static">
									<?php echo $form->textField($model,'HOME_LOAN_INT',array('size'=>30,'maxlength'=>10)); ?>
								</p>
							</div>
						</div>
					</div>
					
					<div class="col-sm-6">
						<div class="form-group row">
							<?php echo $form->labelEx($model,'TERM_DEPOSIT_ABOVE_5', array('class'=>'col-sm-2 form-control-label')); ?>
							<div class="col-sm-10">
								<p class="form-control-static">
									<?php echo $form->textField($model,'TERM_DEPOSIT_ABOVE_5',array('size'=>30,'maxlength'=>10)); ?>
								</p>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-6">
						<div class="form-group row">
							<?php echo $form->labelEx($model,'HOME_LOAD_EXCESS_2013_14', array('class'=>'col-sm-2 form-control-label')); ?>
							<div class="col-sm-10">
								<p class="form-control-static">
									<?php echo $form->textField($model,'HOME_LOAD_EXCESS_2013_14',array('size'=>30,'maxlength'=>10)); ?>
								</p>
							</div>
						</div>
					</div>
					
					<div class="col-sm-6">
						<div class="form-group row">
							<?php echo $form->labelEx($model,'MUTUAL_FUND', array('class'=>'col-sm-2 form-control-label')); ?>
							<div class="col-sm-10">
								<p class="form-control-static">
									<?php echo $form->textField($model,'MUTUAL_FUND',array('size'=>30,'maxlength'=>10)); ?>
								</p>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-6">
						<div class="form-group row">
							<?php echo $form->labelEx($model,'HRA', array('class'=>'col-sm-2 form-control-label')); ?>
							<div class="col-sm-10">
								<p class="form-control-static">
									<?php echo $form->textField($model,'HRA',array('size'=>30,'maxlength'=>10)); ?>
								</p>
							</div>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group row">
							<?php echo $form->labelEx($model,'PENSION_FUND', array('class'=>'col-sm-2 form-control-label')); ?>
							<div class="col-sm-10">
								<p class="form-control-static">
									<?php echo $form->textField($model,'PENSION_FUND',array('size'=>30,'maxlength'=>10)); ?>
								</p>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-6">
						<div class="form-group row">
							
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group row">
							<?php echo $form->labelEx($model,'CPF', array('class'=>'col-sm-2 form-control-label')); ?>
							<div class="col-sm-10">
								<p class="form-control-static">
									<?php echo $form->textField($model,'CPF',array('size'=>30,'maxlength'=>10)); ?>
								</p>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-6">
						<div class="form-group row">
							
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group row">
							<?php echo $form->labelEx($model,'REGISTRY_STAMP', array('class'=>'col-sm-2 form-control-label')); ?>
							<div class="col-sm-10">
								<p class="form-control-static">
									<?php echo $form->textField($model,'REGISTRY_STAMP',array('size'=>30,'maxlength'=>10)); ?>
								</p>
							</div>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-sm-6">
						<div class="form-group row">
							
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group row">
							<label></label>
							<div class="col-sm-10">
								<p class="form-control-static">
									<?php echo CHtml::submitButton('Save Investment', array('class'=>'btn btn-inline')); ?>
								</p>
							</div>
						</div>
					</div>
				</div>
			<?php $this->endWidget(); ?>

		</div>
	</div>
</div>
<script>
	$(document).ready(function(){
		$("#slEmployee").change(function(){
			$('#Investments_EMPLOYEE_ID').html($(this).find("option:selected").text());
			$("#hdSelectedEmployeeID").val($(this).find("option:selected").val());
			
			 $.post("<?php echo Yii::app()->createUrl('Investments/GetInvestments')?>&fy="+$('#FinancialYear').html()+"&emp_id="+$("#hdSelectedEmployeeID").val(),
				{},
               function(data){
				   data = JSON.parse(data)[0];
				   $('#Investments_HRA').val(data.HRA);
				   $('#Investments_MEDICAL_INSURANCE').val(data.MEDICAL_INSURANCE);
				   $('#Investments_DONATION').val(data.DONATION);
				   $('#Investments_DISABILITY_MED_EXP').val(data.DISABILITY_MED_EXP);
				   $('#Investments_EDU_LOAD_INT').val(data.EDU_LOAD_INT);
				   $('#Investments_SELF_DISABILITY').val(data.SELF_DISABILITY);
				   $('#Investments_HOME_LOAN_INT').val(data.HOME_LOAN_INT);
				   $('#Investments_HOME_LOAD_EXCESS_2013_14').val(data.HOME_LOAD_EXCESS_2013_14);
				   $('#Investments_INSURANCE_LIC_OTHER').val(data.INSURANCE_LIC_OTHER);
				   $('#Investments_TUITION_FESS_EXEMPTION').val(data.TUITION_FESS_EXEMPTION);
				   $('#Investments_PPF_NSC').val(data.PPF_NSC);
				   $('#Investments_HOME_LOAD_PR').val(data.HOME_LOAD_PR);
				   $('#Investments_PLI_ULIP').val(data.PLI_ULIP);
				   $('#Investments_TERM_DEPOSIT_ABOVE_5').val(data.TERM_DEPOSIT_ABOVE_5);
				   $('#Investments_MUTUAL_FUND').val(data.MUTUAL_FUND);
				   $('#Investments_PENSION_FUND').val(data.PENSION_FUND);
				   $('#Investments_REGISTRY_STAMP').val(data.REGISTRY_STAMP);
				   $('#Investments_CPF').val(data.CPF);
			   });
		});
	});
</script>
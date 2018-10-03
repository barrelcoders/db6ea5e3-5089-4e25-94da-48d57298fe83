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
		<h3><?php 
		echo Employee::model()->findByPK($id)->NAME.", ".Designations::model()->findByPK(Employee::model()->findByPK($id)->DESIGNATION_ID_FK)->DESIGNATION; ?></h3>
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
					<?php echo $form->labelEx($model,'CEA_TUITION', array('class'=>'col-sm-8 form-control-label')); ?>
					<div class="col-sm-4">
						<p class="form-control-static">
							<?php echo $form->textField($model,'CEA_TUITION',array('size'=>10,'maxlength'=>100, 'value'=>$model->CEA_TUITION, 'style'=>'text-transform: uppercase;')); ?>
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
					<?php echo $form->labelEx($model,'MEDICAL_INSURANCE_PARENTS', array('class'=>'col-sm-8 form-control-label')); ?>
					<div class="col-sm-4">
						<p class="form-control-static">
							<?php echo $form->textField($model,'MEDICAL_INSURANCE_PARENTS',array('size'=>10,'maxlength'=>100, 'value'=>$model->MEDICAL_INSURANCE_PARENTS, 'style'=>'text-transform: uppercase;')); ?>
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
					<?php echo $form->labelEx($model,'HOME_LOAN_INT', array('class'=>'col-sm-6 form-control-label')); ?>
					<div class="col-sm-6">
						<p class="form-control-static">
							<?php echo $form->textField($model,'HOME_LOAN_INT',array('size'=>10,'maxlength'=>100, 'value'=>$model->HOME_LOAN_INT, 'style'=>'text-transform: uppercase;')); ?>
							<select name="Investments[LOAN_YEAR]" id="Investments_LOAN_YEAR">
								<option></option>
								<option <?php echo ($model->LOAN_YEAR == '2013-14') ? "selected" :"";?>>2013-14</option>
								<option <?php echo ($model->LOAN_YEAR == '2014-15') ? "selected" :"";?>>2014-15</option>
								<option <?php echo ($model->LOAN_YEAR == '2015-16') ? "selected" :"";?>>2015-16</option>
								<option <?php echo ($model->LOAN_YEAR == '2016-17') ? "selected" :"";?>>2016-17</option>
								<option <?php echo ($model->LOAN_YEAR == '2017-18') ? "selected" :"";?>>2017-18</option>
								<option <?php echo ($model->LOAN_YEAR == '2018-19') ? "selected" :"";?>>2018-19</option>
							</select>
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
	<div class="col-sm-12">
		<section id="blockui-element-container-default" class="card col-sm-12">
			<header class="card-header">
				Previous Office Arrears
			</header>
			<div class="card-block display-table col-sm-12" style="min-height: 100px">
				<div class="form-group row">
				<style> #ArrearTable input[type=text] {width: 150px;} </style>
				<table id="ArrearTable" class="table table-bordered table-hover">
					<tr>
						<td>MONTH</td>
						<td>YEAR</td>
						<td>BASIC</td>
						<td>PP/SP</td>
						<td>TA</td>
						<td>HRA</td>
						<td>DA</td>
						<td>TOTAL</td>
						<td>CGEGIS</td>
						<td>CGHS</td>
						<td>CPF</td>
						<td>PT</td>
						<td>IT</td>
						<td>PLI</td>
						<td>LIC</td>
					</tr>
					<?php
						
						$arraers = PreviousOfficePayArrears::model()->findAllByAttributes(array('EMPLOYEE_ID_FK'=>$id));
						foreach($arraers as $arrear){
							?>
							<tr>
								<td>
									<input type="hidden" value="<?php echo $arrear->ID?>" class="arrear-id">
									<select class="arrear-month" disabled="true" >
										<option value="1" >JAN</option>
										<option value="2" <?php echo ($arrear->MONTH == 2) ? "selected" : "";?>>FEB</option>
										<option value="3" <?php echo ($arrear->MONTH == 3) ? "selected" : "";?>>MAR</option>
										<option value="4" <?php echo ($arrear->MONTH == 4) ? "selected" : "";?>>APR</option>
										<option value="5" <?php echo ($arrear->MONTH == 5) ? "selected" : "";?>>MAY</option>
										<option value="6" <?php echo ($arrear->MONTH == 6) ? "selected" : "";?>>JUN</option>
										<option value="7" <?php echo ($arrear->MONTH == 7) ? "selected" : "";?>>JUL</option>
										<option value="8" <?php echo ($arrear->MONTH == 8) ? "selected" : "";?>>AUG</option>
										<option value="9" <?php echo ($arrear->MONTH == 9) ? "selected" : "";?>>SEP</option>
										<option value="10" <?php echo ($arrear->MONTH == 10) ? "selected" : "";?>>OCT</option>
										<option value="11" <?php echo ($arrear->MONTH == 11) ? "selected" : "";?>>NOV</option>
										<option value="12" <?php echo ($arrear->MONTH == 12) ? "selected" : "";?>>DEC</option>
									</select>
								</td>
								<td>
									<select class="arrear-year" disabled="true" >
										<option value="2016" <?php echo ($arrear->YEAR == 2016) ? "selected" : "";?>>2016</option>
										<option value="2017" <?php echo ($arrear->YEAR == 2017) ? "selected" : "";?>>2017</option>
										<option value="2018" <?php echo ($arrear->YEAR == 2018) ? "selected" : "";?>>2018</option>
									</select>
								</td>
								<td>
									<input type="text" style="width:70px;"  value="<?php echo $arrear->BASIC; ?>" class="arrear-basic total-inc-amount" disabled="true"/>
								</td>
								<td>
									<input type="text" style="width:70px;"  value="<?php echo $arrear->PP_SP; ?>" class="arrear-pp-sp total-inc-amount" disabled="true"/>
								</td>
								<td>
									<input type="text" style="width:70px;"  value="<?php echo $arrear->TA; ?>" class="arrear-ta total-inc-amount" disabled="true"/>
								</td>
								<td>
									<input type="text" style="width:70px;"  value="<?php echo $arrear->HRA; ?>" class="arrear-hra total-inc-amount" disabled="true"/>
								</td>
								<td>
									<input type="text" style="width:70px;"  value="<?php echo $arrear->DA; ?>" class="arrear-da total-inc-amount" disabled="true"/>
								</td>
								<td>
									<input type="text" style="width:70px;"  value="<?php echo $arrear->TOTAL; ?>" class="arrear-total total-amount" disabled="true"/>
								</td>
								<td>
									<input type="text" style="width:70px;"  value="<?php echo $arrear->CGEGIS; ?>" class="arrear-cgegis" disabled="true"/>
								</td>
								<td>
									<input type="text" style="width:70px;"  value="<?php echo $arrear->CGHS; ?>" class="arrear-cghs" disabled="true"/>
								</td>
								<td>
									<input type="text" style="width:70px;"  value="<?php echo $arrear->CPF; ?>" class="arrear-cpf" disabled="true"/>
								</td>
								<td>
									<input type="text" style="width:70px;"  value="<?php echo $arrear->PT; ?>" class="arrear-pt" disabled="true"/>
								</td>
								<td>
									<input type="text" style="width:70px;"  value="<?php echo $arrear->IT; ?>" class="arrear-it" disabled="true"/>
								</td>
								<td>
									<input type="text" style="width:70px;"  value="<?php echo $arrear->PLI; ?>" class="arrear-pli" disabled="true"/>
								</td>
								<td>
									<input type="text" style="width:70px;"  value="<?php echo $arrear->LIC; ?>" class="arrear-lic" disabled="true"/>
								</td>
								<td>
									<input type="button" id="editSubBillbutton" class="btn btn-inline edit-btn" value="Edit" onclick="editArrearRow(this)"/>
									<input type="button" id="saveSubBillbutton" class="btn btn-inline save-btn" style="display:none;" value="Save" onclick="saveArrearRow(this)"/>
								</td>
								<td><input type="button" id="delSubBillbutton" class="btn btn-inline del-btn" value="Delete" onclick="delArrearRow(this)"/></td>
							</tr>
							<?php
						}
					?>
					<tr>
						<td>
							<select name="Employee[ARREAR][0][MONTH]">
								<option value="1">JAN</option>
								<option value="2">FEB</option>
								<option value="3">MAR</option>
								<option value="4">APR</option>
								<option value="5">MAY</option>
								<option value="6">JUN</option>
								<option value="7">JUL</option>
								<option value="8">AUG</option>
								<option value="9">SEP</option>
								<option value="10">OCT</option>
								<option value="11">NOV</option>
								<option value="12">DEC</option>
							</select>
						</td>
						<td>
							<select name="Employee[ARREAR][0][YEAR]" >
								<option value="2016" >2016</option>
								<option value="2017" >2017</option>
								<option value="2018" >2018</option>
							</select>
						</td>
						<td>
							<input type="text" style="width:70px;" value="0" class="total-inc-amount" name="Employee[ARREAR][0][BASIC]"/>
						</td>
						<td>
							<input type="text" style="width:70px;" value="0" class="total-inc-amount" name="Employee[ARREAR][0][PP_SP]"/>
						</td>
						<td>
							<input type="text" style="width:70px;" value="0" class="total-inc-amount" name="Employee[ARREAR][0][TA]"/>
						</td>
						<td>
							<input type="text" style="width:70px;" value="0" class="total-inc-amount" name="Employee[ARREAR][0][HRA]"/>
						</td>
						<td>
							<input type="text" style="width:70px;" value="0" class="total-inc-amount" name="Employee[ARREAR][0][DA]"/>
						</td>
						<td>
							<input type="text" style="width:70px;" value="0" class="total-amount" name="Employee[ARREAR][0][TOTAL]"/>
						</td>
						<td>
							<input type="text" style="width:70px;" value="0" name="Employee[ARREAR][0][CGEGIS]"/>
						</td>
						<td>
							<input type="text" style="width:70px;" value="0" name="Employee[ARREAR][0][CGHS]"/>
						</td>
						<td>
							<input type="text" style="width:70px;" value="0" name="Employee[ARREAR][0][CPF]"/>
						</td>
						<td>
							<input type="text" style="width:70px;" value="0" name="Employee[ARREAR][0][PT]"/>
						</td>
						<td>
							<input type="text" style="width:70px;" value="0" name="Employee[ARREAR][0][IT]"/>
						</td>
						<td>
							<input type="text" style="width:70px;" value="0" name="Employee[ARREAR][0][PLI]"/>
						</td>
						<td>
							<input type="text" style="width:70px;" value="0" name="Employee[ARREAR][0][LIC]"/>
						</td>
						<td><input type="button" id="delSubBillbutton" class="btn btn-inline" value="Delete" onclick="deleteArrearRow(this)"/></td>
						<td><input type="button" id="addSubBillbutton" class="btn btn-inline" value="Add Arrear" onclick="insArrearRow()"/></td>
					</tr>
				</table>
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
	$(".total-inc-amount").on('keyup', function() {
		var container = $(this).parents('tr'),
			totalComponentElement = $(container).find('.total-amount'),
			TOTAL_AMOUNT = 0;
		$(container).find('.total-inc-amount').each(function (index, element) {
			TOTAL_AMOUNT += parseInt($(element).val());
		});
		$(totalComponentElement).val(TOTAL_AMOUNT);
	});
	function deleteArrearRow(row) {
		var i=row.parentNode.parentNode.rowIndex;
		document.getElementById('ArrearTable').deleteRow(i);
	}
	function insArrearRow() {
		var x=document.getElementById('ArrearTable');
		var new_row = x.rows[1].cloneNode(true);
		var len = x.rows.length;
		
		var inp1 = new_row.cells[0].getElementsByTagName('select')[0];
		inp1.name = "Employee[ARREAR]["+len+"][MONTH]";
		inp1.value = '1';
		var inp2 = new_row.cells[1].getElementsByTagName('select')[0];
		inp2.name = "Employee[ARREAR]["+len+"][YEAR]";
		inp2.value = '2017';
		var inp3 = new_row.cells[2].getElementsByTagName('input')[0];
		inp3.name = "Employee[ARREAR]["+len+"][BASIC]";
		inp3.value = 0;
		var inp4 = new_row.cells[3].getElementsByTagName('input')[0];
		inp4.name = "Employee[ARREAR]["+len+"][PP_SP]";
		inp4.value = 0;
		var inp5 = new_row.cells[4].getElementsByTagName('input')[0];
		inp5.name = "Employee[ARREAR]["+len+"][TA]";
		inp5.value = 0;
		var inp6 = new_row.cells[5].getElementsByTagName('input')[0];
		inp6.name = "Employee[ARREAR]["+len+"][HRA]";
		inp6.value = 0;
		var inp7 = new_row.cells[6].getElementsByTagName('input')[0];
		inp7.name = "Employee[ARREAR]["+len+"][DA]";
		inp7.value = 0;
		var inp8 = new_row.cells[7].getElementsByTagName('input')[0];
		inp8.name = "Employee[ARREAR]["+len+"][TOTAL]";
		inp8.value = 0;
		var inp9 = new_row.cells[8].getElementsByTagName('input')[0];
		inp9.name = "Employee[ARREAR]["+len+"][CGEGIS]";
		inp9.value = 0;
		var inp10 = new_row.cells[9].getElementsByTagName('input')[0];
		inp10.name = "Employee[ARREAR]["+len+"][CGHS]";
		inp10.value = 0;
		var inp11 = new_row.cells[10].getElementsByTagName('input')[0];
		inp11.name = "Employee[ARREAR]["+len+"][CPF]";
		inp11.value = 0;
		var inp12 = new_row.cells[11].getElementsByTagName('input')[0];
		inp12.name = "Employee[ARREAR]["+len+"][PT]";
		inp12.value = 0;
		var inp13 = new_row.cells[12].getElementsByTagName('input')[0];
		inp13.name = "Employee[ARREAR]["+len+"][PLI]";
		inp13.value = 0;
		var inp14 = new_row.cells[13].getElementsByTagName('input')[0];
		inp14.name = "Employee[ARREAR]["+len+"][LIC]";
		inp14.value = 0;
		x.appendChild( new_row );
	}
	function editArrearRow(row){
		var tableRow = $(row.parentNode.parentNode),
			editBtn = tableRow.find(".edit-btn"),
			saveBtn = tableRow.find(".save-btn"),
			arrearMonth = tableRow.find(".arrear-month"),
			arrearYear = tableRow.find(".arrear-year"),
			arrearBasic = tableRow.find(".arrear-basic"),
			arrearPP_SP = tableRow.find(".arrear-pp-sp"),
			arrearTA = tableRow.find(".arrear-ta"),
			arrearHRA = tableRow.find(".arrear-hra"),
			arrearDA = tableRow.find(".arrear-da"),
			arrearTOTAL = tableRow.find(".arrear-total"),
			arrearCGEGIS = tableRow.find(".arrear-cgegis"),
			arrearCGHS = tableRow.find(".arrear-cghs"),
			arrearCPF = tableRow.find(".arrear-cpf"),
			arrearPT = tableRow.find(".arrear-pt"),
			arrearIT = tableRow.find(".arrear-it")
			arrearPLI = tableRow.find(".arrear-pli"),
			arrearLIC = tableRow.find(".arrear-lic");
		
		arrearMonth.prop( "disabled", false);
		arrearYear.prop( "disabled", false);
		arrearBasic.prop( "disabled", false);
		arrearPP_SP.prop( "disabled", false);
		arrearTA.prop( "disabled", false);
		arrearHRA.prop( "disabled", false);
		arrearDA.prop( "disabled", false);
		arrearTOTAL.prop( "disabled", false);
		arrearCGEGIS.prop( "disabled", false);
		arrearCGHS.prop( "disabled", false);
		arrearCPF.prop( "disabled", false);
		arrearPT.prop( "disabled", false);
		arrearIT.prop( "disabled", false);
		arrearPLI.prop( "disabled", false);
		arrearLIC.prop( "disabled", false);
		editBtn.hide();
		saveBtn.show();
	}
	
	function saveArrearRow(row){
		var tableRow = $(row.parentNode.parentNode),
			editBtn = tableRow.find(".edit-btn"),
			saveBtn = tableRow.find(".save-btn"),
			arrearId = tableRow.find(".arrear-id"),
			arrearMonth = tableRow.find(".arrear-month"),
			arrearYear = tableRow.find(".arrear-year"),
			arrearBasic = tableRow.find(".arrear-basic"),
			arrearPP_SP = tableRow.find(".arrear-pp-sp"),
			arrearTA = tableRow.find(".arrear-ta"),
			arrearHRA = tableRow.find(".arrear-hra"),
			arrearDA = tableRow.find(".arrear-da"),
			arrearTOTAL = tableRow.find(".arrear-total"),
			arrearCGEGIS = tableRow.find(".arrear-cgegis"),
			arrearCGHS = tableRow.find(".arrear-cghs"),
			arrearCPF = tableRow.find(".arrear-cpf"),
			arrearPT = tableRow.find(".arrear-pt"),
			arrearIT = tableRow.find(".arrear-it"),
			arrearPLI = tableRow.find(".arrear-pli"),
			arrearLIC = tableRow.find(".arrear-lic");
		
		var id = arrearId.val(),
			month = arrearMonth.val(),
			year = arrearYear.val(),
			basic = arrearBasic.val(),
			pp_sp = arrearPP_SP.val(),
			ta = arrearTA.val(),
			hra = arrearHRA.val(),
			da = arrearDA.val(),
			total = arrearTOTAL.val(),
			cgegis = arrearCGEGIS.val(),
			cghs = arrearCGHS.val(),
			cpf = arrearCPF.val(),
			pt = arrearPT.val(),
			it = arrearIT.val(),
			pli = arrearPLI.val(),
			lic = arrearLIC.val();
			
		$.post( '<?php echo Yii::app()->createUrl('Employee/PreviousOfficeArrearChange')?>&id='+id+
		'&month='+month+
		'&year='+year+
		'&basic='+basic+
		'&pp_sp='+pp_sp+
		'&ta='+ta+
		'&hra='+hra+
		'&da='+da+
		'&total='+total+
		'&cgegis='+cgegis+
		'&cghs='+cghs+
		'&cpf='+cpf+
		'&pt='+pt+
		'&it='+it+
		'&pli='+pli+
		'&lic='+lic, {}, function(result) {
			if(result == 'SUCCESS'){
				alert('Arrear saved successfully');
				arrearMonth.prop( "disabled", true);
				arrearYear.prop( "disabled", true);
				arrearBasic.prop( "disabled", true);
				arrearPP_SP.prop( "disabled", true);
				arrearTA.prop( "disabled", true);
				arrearHRA.prop( "disabled", true);
				arrearDA.prop( "disabled", true);
				arrearTOTAL.prop( "disabled", true);
				arrearCGEGIS.prop( "disabled", true);
				arrearCGHS.prop( "disabled", true);
				arrearCPF.prop( "disabled", true);
				arrearPT.prop( "disabled", true);
				arrearIT.prop( "disabled", true);
				arrearPLI.prop( "disabled", true);
				arrearLIC.prop( "disabled", true);
				editBtn.show();
				saveBtn.hide();
			}
			else{
				alert('Problem in updating Arrear, Please try again later');
			}
		});
	}
	
	function delArrearRow(row){
		var tableRow = $(row.parentNode.parentNode),
			arrearId = tableRow.find(".arrear-id");
		
		var id = arrearId.val();
		
		if(!confirm('Are you sure wants to delete this arrear'))
			return;
		
		$.post( '<?php echo Yii::app()->createUrl('Employee/DeletePreviousOfficeArrear')?>&id='+id, {}, function(result) {
			if(result == 'SUCCESS'){
				alert('Arrear deleted successfully');
				document.getElementById('ArrearTable').deleteRow(row.parentNode.parentNode.rowIndex);
			}
			else{
				alert('Problem in deleting arrear, Please try again later');
			}
		});
	}
	
</script>
	<script>
	var date = '<?php echo $model->DOB;?>';
	if(date != ''){
		dob = moment(date), retire_date = "";
		if(dob.date() == 1){
			retire_date = moment(dob.add(60, "years")).subtract(1,'months').endOf('month').format('YYYY-MM-DD');
		}
		else{
			retire_date = dob.add(60, "years").endOf('month').format('YYYY-MM-DD');
		}
		$("#Employee_GOVT_SERVICE_EXIT_DATE").val(retire_date);
	}
	$(document).ready(function(){
		<?php
			if($model->FIRST_NAME == ''){
		?>
				var name = '<?php echo $model->NAME?>',
					items = name.split(' ');
				
				if(items.length == 1){
					$("#Employee_FIRST_NAME").val(items[0]);
				}
				else if(items.length == 2){
					$("#Employee_FIRST_NAME").val(items[0]);
					$("#Employee_LAST_NAME").val(items[1]);
				}
				else if(items.length == 3){
					$("#Employee_FIRST_NAME").val(items[0]);
					$("#Employee_MIDDLE_NAME").val(items[1]);
					$("#Employee_LAST_NAME").val(items[2]);
				}
				else{
					$("#Employee_FIRST_NAME").val(items[0]);
					var remaining_name = [];
					for(var i=1; i<=items.length-2; i++){
						remaining_name.push(items[i]);
					}
					$("#Employee_MIDDLE_NAME").val(remaining_name.join(' '));
					$("#Employee_LAST_NAME").val(items[items.length-1]);
				}
		<?php		
			}
		?>
		$('#Employee_DOB').change(function(){
			dob = moment($(this).val()), retire_date = "";
			if(dob.date() == 1){
				retire_date = moment(dob.add(60, "years")).subtract(1,'months').endOf('month').format('YYYY-MM-DD');
			}
			else{
				retire_date = dob.add(60, "years").endOf('month').format('YYYY-MM-DD');
			}
			$("#Employee_GOVT_SERVICE_EXIT_DATE").val(retire_date);
			
		});
		
		$("#Employee_PENSION_TYPE").change(function(){debugger;
			var pension_type = $(this).val();
			if(pension_type == "OPS"){
				$("#gpf-sub-section").show();
			}
			else{
				$("#gpf-sub-section").hide();
			}
		});
	});
	
	function enablethisField(field){
		field.setAttribute('disabled', false);
	}
	
	function editLICRow(row){
		var tableRow = $(row.parentNode.parentNode),
			editBtn = tableRow.find(".edit-btn"),
			saveBtn = tableRow.find(".save-btn"),
			policyNo = tableRow.find(".policy-no"),
			policyAmount = tableRow.find(".policy-amount"),
			policyStatus = tableRow.find(".policy-status");
		
		policyNo.prop( "disabled", false);
		policyAmount.prop( "disabled", false);
		policyStatus.prop( "disabled", false);
		editBtn.hide();
		saveBtn.show();
	}
	
	function saveLICRow(row){
		var tableRow = $(row.parentNode.parentNode),
			editBtn = tableRow.find(".edit-btn"),
			saveBtn = tableRow.find(".save-btn"),
			policyId = tableRow.find(".policy-id"),
			policyNo = tableRow.find(".policy-no"),
			policyAmount = tableRow.find(".policy-amount"),
			policyStatus = tableRow.find(".policy-status");
		
		var id = policyId.val(),
			number = policyNo.val(),
			amount = policyAmount.val(),
			status = policyStatus.val();
		
		$.post( '<?php echo Yii::app()->createUrl('Employee/LICPolicyChange')?>&id='+id+'&number='+number+'&amount='+amount+'&status='+status, {}, function(result) {
			if(result == 'SUCCESS'){
				alert('Policy changed successfully');
				policyNo.prop( "disabled", true);
				policyAmount.prop( "disabled", true);
				policyStatus.prop( "disabled", true);
				editBtn.show();
				saveBtn.hide();
			}
			else{
				alert('Problem in updating policy, Please try again later');
			}
		});
	}
	
	function delLICRow(row){
		var tableRow = $(row.parentNode.parentNode),
			policyId = tableRow.find(".policy-id");
		
		var id = policyId.val();
		
		if(!confirm('Are you sure wants to delete this policy'))
			return;
		
		$.post( '<?php echo Yii::app()->createUrl('Employee/DeleteLICPolicy')?>&id='+id, {}, function(result) {
			if(result == 'SUCCESS'){
				alert('Policy deleted successfully');
				document.getElementById('LICTable').deleteRow(row.parentNode.parentNode.rowIndex);
			}
			else{
				alert('Problem in deleting policy, Please try again later');
			}
		});
	}
	
	
	function editPLIRow(row){
		var tableRow = $(row.parentNode.parentNode),
			editBtn = tableRow.find(".edit-btn"),
			saveBtn = tableRow.find(".save-btn"),
			policyNo = tableRow.find(".policy-no"),
			policyAmount = tableRow.find(".policy-amount"),
			policyStatus = tableRow.find(".policy-status");
		
		policyNo.prop( "disabled", false);
		policyAmount.prop( "disabled", false);
		policyStatus.prop( "disabled", false);
		editBtn.hide();
		saveBtn.show();
	}
	
	function savePLIRow(row){
		var tableRow = $(row.parentNode.parentNode),
			editBtn = tableRow.find(".edit-btn"),
			saveBtn = tableRow.find(".save-btn"),
			policyId = tableRow.find(".policy-id"),
			policyNo = tableRow.find(".policy-no"),
			policyAmount = tableRow.find(".policy-amount"),
			policyStatus = tableRow.find(".policy-status");
		
		var id = policyId.val(),
			number = policyNo.val(),
			amount = policyAmount.val(),
			status = policyStatus.val();
		
		$.post( '<?php echo Yii::app()->createUrl('Employee/PLIPolicyChange')?>&id='+id+'&number='+number+'&amount='+amount+'&status='+status, {}, function(result) {
			if(result == 'SUCCESS'){
				alert('Policy changed successfully');
				policyNo.prop( "disabled", true);
				policyAmount.prop( "disabled", true);
				policyStatus.prop( "disabled", true);
				editBtn.show();
				saveBtn.hide();
			}
			else{
				alert('Problem in updating policy amount, Please try again later');
			}
		});
	}
	
	


	function insLICRow()
	{
		var x=document.getElementById('LICTable');
		var new_row = x.rows[1].cloneNode(true);
		var len = x.rows.length;
		
		var inp1 = new_row.cells[0].getElementsByTagName('input')[0];
		inp1.name = "Employee[LIC]["+len+"][POLICY_NO]";
		inp1.value = '';
		var inp2 = new_row.cells[1].getElementsByTagName('input')[0];
		inp2.name = "Employee[LIC]["+len+"][AMOUNT]";
		inp2.value = '';
		var inp3 = new_row.cells[2].getElementsByTagName('select')[0];
		inp3.name = "Employee[LIC]["+len+"][STATUS]";
		inp3.value = '';
		x.appendChild( new_row );
	}
	
	function deletePLIRow(row)
	{
		var i=row.parentNode.parentNode.rowIndex;
		document.getElementById('PLITable').deleteRow(i);
	}


	function insPLIRow()
	{
		var x=document.getElementById('PLITable');
		var new_row = x.rows[1].cloneNode(true);
		var len = x.rows.length;
		
		var inp1 = new_row.cells[0].getElementsByTagName('input')[0];
		inp1.name = "Employee[PLI]["+len+"][POLICY_NO]";
		inp1.value = '';
		var inp2 = new_row.cells[1].getElementsByTagName('input')[0];
		inp2.name = "Employee[PLI]["+len+"][AMOUNT]";
		inp2.value = '';
		var inp3 = new_row.cells[2].getElementsByTagName('select')[0];
		inp3.name = "Employee[PLI]["+len+"][STATUS]";
		inp3.value = '';
		x.appendChild( new_row );
	}
	function setSalutationText(ddl) {
        document.getElementById('SALUTATION_CODE_TEXT').value = ddl.options[ddl.selectedIndex].text;
    }
	</script>
	<style>
		.tab-content {
			min-height: 1000px;
		}
		.eis-required-field{
			color: #F00;
		}
	</style>
	<?php 
	$form=$this->beginWidget('CActiveForm', array(
		'id'=>'employee-form',
		'enableAjaxValidation'=>false,
	)); 
	//'disabled'=>Yii::app()->controller->action->id == 'update',
	?>
	<section class="tabs-section">
		<div class="tabs-section-nav tabs-section-nav-icons">
			<div class="tbl">
				<ul class="nav" role="tablist">
					<li class="nav-item">
						<a class="nav-link active" href="#tabs-1-tab-1" role="tab" data-toggle="tab">
							<span class="nav-link-in">Basic Details</span>
						</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="#tabs-1-tab-2" role="tab" data-toggle="tab">
							<span class="nav-link-in">Account & Pension Details</span>
						</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="#tabs-1-tab-3" role="tab" data-toggle="tab">
							<span class="nav-link-in">Dates</span>
						</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="#tabs-1-tab-4" role="tab" data-toggle="tab">
							<span class="nav-link-in">LIC & PLI Policies</span>
						</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="#tabs-1-tab-5" role="tab" data-toggle="tab">
							<span class="nav-link-in">HRA Details</span>
						</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="#tabs-1-tab-6" role="tab" data-toggle="tab">
							<span class="nav-link-in">Status & Permissions</span>
						</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="#tabs-1-tab-7" role="tab" data-toggle="tab">
							<span class="nav-link-in">CGHS & CGCGIS</span>
						</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="#tabs-1-tab-8" role="tab" data-toggle="tab">
							<span class="nav-link-in">Personal Details</span>
						</a>
					</li>
				</ul>
			</div>
		</div><!--.tabs-section-nav-->
		<div class="tab-content">
			<div role="tabpanel" class="tab-pane fade in active" id="tabs-1-tab-1">
				<div class="col-sm-6">
					<div class="form-group row">
						<label class='col-sm-3 form-control-label'>Name</label>
						<div class="col-sm-9">
							<p class="form-control-static">
								<span><?php echo $model->NAME;?></span>
							</p>
						</div>
					</div>
					<div class="form-group row">
						<?php echo $form->labelEx($model,'SALUTATION_CODE', array('class'=>'col-sm-3 form-control-label eis-required-field')); ?>
						<div class="col-sm-9">
							<p class="form-control-static">
								<select name="Employee[SALUTATION_CODE]" id="SALUTATION_CODE" onchange="setSalutationText(this)">
									<option value="0" <?php echo ($model->SALUTATION_CODE == 0) ? 'selected': '';?>> Select Title</option>
									<option value="1" <?php echo ($model->SALUTATION_CODE == 1) ? 'selected': '';?>>Dr. ( Miss. )</option>
									<option value="2" <?php echo ($model->SALUTATION_CODE == 2) ? 'selected': '';?>>Dr. (Mrs)</option>
									<option value="3" <?php echo ($model->SALUTATION_CODE == 3) ? 'selected': '';?>>Miss.</option>
									<option value="4" <?php echo ($model->SALUTATION_CODE == 4) ? 'selected': '';?>>Mrs.</option>
									<option value="5" <?php echo ($model->SALUTATION_CODE == 5) ? 'selected': '';?>>Ms</option>
									<option value="6" <?php echo ($model->SALUTATION_CODE == 6) ? 'selected': '';?>>Smt.</option>
									<option value="7" <?php echo ($model->SALUTATION_CODE == 7) ? 'selected': '';?>>Dr.</option>
									<option value="8" <?php echo ($model->SALUTATION_CODE == 8) ? 'selected': '';?>>Mr.</option>
									<option value="9" <?php echo ($model->SALUTATION_CODE == 9) ? 'selected': '';?>>Prof.</option>
									<option value="10" <?php echo ($model->SALUTATION_CODE == 10) ? 'selected': '';?>>Shri.</option>
									<option value="11" <?php echo ($model->SALUTATION_CODE == 11) ? 'selected': '';?>>Captain</option>
									<option value="12" <?php echo ($model->SALUTATION_CODE == 12) ? 'selected': '';?>>Justice</option>
								</select>
								<input type="hidden" name="Employee[SALUTATION_CODE_TEXT]"  id="SALUTATION_CODE_TEXT">
							</p>
						</div>
					</div>
					<div class="form-group row">
						<?php echo $form->labelEx($model,'FIRST_NAME', array('class'=>'col-sm-3 form-control-label eis-required-field')); ?>
						<div class="col-sm-9">
							<p class="form-control-static">
								<?php echo $form->textField($model,'FIRST_NAME',array('size'=>40,'maxlength'=>1000, 'value'=>$model->FIRST_NAME)); ?>
							</p>
						</div>
					</div>
					<div class="form-group row">
						<?php echo $form->labelEx($model,'MIDDLE_NAME', array('class'=>'col-sm-3 form-control-label eis-required-field')); ?>
						<div class="col-sm-9">
							<p class="form-control-static">
								<?php echo $form->textField($model,'MIDDLE_NAME',array('size'=>40,'maxlength'=>1000, 'value'=>$model->MIDDLE_NAME)); ?>
							</p>
						</div>
					</div>
					<div class="form-group row">
						<?php echo $form->labelEx($model,'LAST_NAME', array('class'=>'col-sm-3 form-control-label eis-required-field')); ?>
						<div class="col-sm-9">
							<p class="form-control-static">
								<?php echo $form->textField($model,'LAST_NAME',array('size'=>40,'maxlength'=>1000, 'value'=>$model->LAST_NAME)); ?>
							</p>
						</div>
					</div>
					<div class="form-group row">
						<?php echo $form->labelEx($model,'NAME_HINDI', array('class'=>'col-sm-3 form-control-label')); ?>
						<div class="col-sm-9">
							<p class="form-control-static">
								<?php echo $form->textField($model,'NAME_HINDI',array('size'=>40,'maxlength'=>1000, 'value'=>$model->NAME_HINDI)); ?>
							</p>
						</div>
					</div>
					<div class="form-group row">
						<?php echo $form->labelEx($model,'GENDER', array('class'=>'col-sm-3 form-control-label eis-required-field')); ?>
						<div class="col-sm-9">
							<p class="form-control-static">
								<?php echo $form->dropDownList($model,'GENDER',array('M'=>'Male', 'F'=>'Female'), array('options'=>array($model->GENDER=>array('selected'=>true)))); ?>
							</p>
						</div>
					</div>
					<div class="form-group row">
						<?php echo $form->labelEx($model,'CATEGORY', array('class'=>'col-sm-3 form-control-label eis-required-field')); ?>
						<div class="col-sm-9">
							<p class="form-control-static">
								<?php echo $form->dropDownList($model,'CATEGORY',array(9=>'General', 8=>'OBC', 1=>'SC', 2=>'ST', ), array('options'=>array($model->CATEGORY=>array('selected'=>true)))); ?>
							</p>
						</div>
					</div>
					<div class="form-group row">
						<?php echo $form->labelEx($model,'PAN', array('class'=>'col-sm-3 form-control-label')); ?>
						<div class="col-sm-9">
							<p class="form-control-static">
								<?php echo $form->textField($model,'PAN',array('size'=>45,'maxlength'=>45, 'value'=>$model->PAN)); ?>
							</p>
						</div>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="form-group row">
						<?php echo $form->labelEx($model,'GROUP_ID_FK', array('class'=>'col-sm-3 form-control-label')); ?>
						<div class="col-sm-9">
							<p class="form-control-static">
								<?php echo $form->dropDownList($model,'GROUP_ID_FK',CHtml::listData(Groups::model()->findAll(), 'ID', 'GROUP_NAME'), array(
							'options' => array("'".$model->GROUP_ID_FK."'" => array('selected'=>true)),
							'disabled'=>Yii::app()->controller->action->id == 'update')); ?>
							</p>
						</div>
					</div>
					<div class="form-group row">
						<?php echo $form->labelEx($model,'DESIGNATION_ID_FK', array('class'=>'col-sm-3 form-control-label')); ?>
						<div class="col-sm-9">
							<p class="form-control-static">
								<?php echo $form->dropDownList($model,'DESIGNATION_ID_FK',CHtml::listData(Designations::model()->findAll(), 'ID', 'DESIGNATION'), array(
							'options' => array("'".$model->DESIGNATION_ID_FK."'" => array('selected'=>true)),
							'disabled'=>Yii::app()->controller->action->id == 'update')); ?>
							</p>
						</div>
					</div>
					<!--<div class="form-group row">
						<?php echo $form->labelEx($model,'GRADE_PAY_ID_FK', array('class'=>'col-sm-3 form-control-label')); ?>
						<div class="col-sm-9">
							<p class="form-control-static">
								<?php echo $form->dropDownList($model,'GRADE_PAY_ID_FK',CHtml::listData(Paybands::model()->findAll(), 'ID', 'DESCRIPTION'), array(
							'options' => array("'".$model->GRADE_PAY_ID_FK."'" => array('selected'=>true)),
							'disabled'=>Yii::app()->controller->action->id == 'update')); ?>
							</p>
						</div>
					</div>-->
					<div class="form-group row">
						<?php echo $form->labelEx($model,'PAY_COMMISSION', array('class'=>'col-sm-3 form-control-label eis-required-field')); ?>
						<div class="col-sm-9">
							<p class="form-control-static">
								<?php echo $form->dropDownList($model,'PAY_COMMISSION',array(
									'16'=>'7th Pay Commission(Central)',
								), array('options'=>array($model->PAY_COMMISSION=>array('selected'=>true)))); ?>
							</p>
						</div>
					</div>
					<div class="form-group row">
						<?php echo $form->labelEx($model,'PAY_MATRIX_ID_FK', array('class'=>'col-sm-3 form-control-label eis-required-field')); ?>
						<div class="col-sm-9">
							<p class="form-control-static">
								<select name="Employee[PAY_MATRIX_ID_FK]" id="Employee_PAY_MATRIX_ID_FK">
									<?php 
										$records=PayMatrix::model()->findAll();
										foreach($records as $record){
											?>
											<option <?php echo ($model->PAY_MATRIX_ID_FK == $record->ID) ? "selected" : "";?> value="<?php echo $record->ID; ?>"><?php echo $record->TEXT;?></option>
											<?php
										}
									?>
								</select>
							</p>
						</div>
					</div>
					<div class="form-group row">
						<?php echo $form->labelEx($model,'POSTING_ID_FK', array('class'=>'col-sm-3 form-control-label')); ?>
						<div class="col-sm-9">
							<p class="form-control-static">
								<select name="Employee[POSTING_ID_FK]" id="Employee_POSTING_ID_FK">
									<?php 
										$records=Posting::model()->findAll();
										foreach($records as $record){
											?>
											<option <?php echo ($model->POSTING_ID_FK == $record->ID) ? "selected" : "";?> value="<?php echo $record->ID; ?>"><?php echo $record->PLACE;?></option>
											<?php
										}
									?>
								</select>
							</p>
						</div>
					</div>
					<div class="form-group row">
						<?php echo $form->labelEx($model,'CITY_CLASS_CODE', array('class'=>'col-sm-3 form-control-label eis-required-field')); ?>
						<div class="col-sm-9">
							<p class="form-control-static">
								<?php echo $form->dropDownList($model,'CITY_CLASS_CODE',array('X'=>'CLASS X', 'Y'=>'CLASS Y', 'Z'=>'CLASS Z'), array('options'=>array($model->CITY_CLASS_CODE=>array('selected'=>true)))); ?>
							</p>
						</div>
					</div>
					<div class="form-group row">
						<?php echo $form->labelEx($model,'POSTING_MODE_CODE', array('class'=>'col-sm-3 form-control-label eis-required-field')); ?>
						<div class="col-sm-9">
							<p class="form-control-static">
								<?php echo $form->dropDownList($model,'POSTING_MODE_CODE',array(
									'722'=>'Absorption',
									'704'=>'As Per Transfer Act',
									'602'=>'Compassionate Ground',
									'720'=>'Deployment Of Service',
									'709'=>'Deputation In ( From CG / SG / IPS / Other)',
									'710'=>'Deputation Out ( To SG / Corpn )',
									'703'=>'General Transfer',
									'706'=>'Join New Services',
									'603'=>'Merger',
									'721'=>'New service after resigning from Prev Govt Service',
									'705'=>'One Step Promotion',
									'601'=>'Open Selection',
									'701'=>'Promotion(With Transfer)',
									'711'=>'Promotion(Without Transfer)',
									'604'=>'Re-appointment',
									'715'=>'Relieving of Deputation(In) Employees',
									'702'=>'Reversion(With Transfer)',
									'712'=>'Reversion(Without Transfer)',
									'707'=>'Transfer ( Ex Cadre Posting )',
								), array('options'=>array($model->POSTING_MODE_CODE=>array('selected'=>true)))); ?>
							</p>
						</div>
					</div>
					<div class="form-group row">
						<?php echo $form->labelEx($model,'FOLIO_NO', array('class'=>'col-sm-3 form-control-label')); ?>
						<div class="col-sm-9">
							<p class="form-control-static">
								<?php echo $form->textField($model,'FOLIO_NO',array('size'=>10,'maxlength'=>100, 'value'=>$model->FOLIO_NO)); ?>
							</p>
						</div>
					</div>
					<div class="form-group row">
						<label class='col-sm-3 form-control-label'></label>
						<div class="col-sm-9">
							<p class="form-control-static">
								<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class'=>'btn btn-inline')); ?>
							</p>
						</div>
					</div>
				</div>
			</div><!--.tab-pane-->
			<div role="tabpanel" class="tab-pane fade" id="tabs-1-tab-2">
				<div class="col-sm-6">
					<div class="form-group row">
						<?php echo $form->labelEx($model,'MICR', array('class'=>'col-sm-3 form-control-label eis-required-field')); ?>
						<div class="col-sm-9">
							<p class="form-control-static">
								<?php echo $form->textField($model,'MICR',array('size'=>45,'maxlength'=>45, 'value'=>$model->MICR)); ?>
							</p>
						</div>
					</div>
					<div class="form-group row">
						<?php echo $form->labelEx($model,'ACCOUNT_NO', array('class'=>'col-sm-3 form-control-label eis-required-field')); ?>
						<div class="col-sm-9">
							<p class="form-control-static">
								<?php echo $form->textField($model,'ACCOUNT_NO',array('size'=>45,'maxlength'=>45, 'value'=>$model->ACCOUNT_NO)); ?>
							</p>
						</div>
					</div>
					<div class="form-group row">
						<?php echo $form->labelEx($model,'IFSC', array('class'=>'col-sm-3 form-control-label eis-required-field')); ?>
						<div class="col-sm-9">
							<p class="form-control-static">
								<?php echo $form->textField($model,'IFSC',array('size'=>45,'maxlength'=>45, 'value'=>$model->IFSC)); ?>
							</p>
						</div>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="form-group row">
						<?php echo $form->labelEx($model,'PENSION_TYPE', array('class'=>'col-sm-3 form-control-label')); ?>
						<div class="col-sm-9">
							<p class="form-control-static">
								<?php echo $form->dropDownList($model,'PENSION_TYPE',array('OPS'=>'OPS', 'NPS'=>'NPS'), array('options'=>array($model->PENSION_TYPE=>array('selected'=>true)))); ?>
							</p>
						</div>
					</div>
					<div class="form-group row">
						<?php echo $form->labelEx($model,'PENSION_ACC_NO', array('class'=>'col-sm-3 form-control-label eis-required-field')); ?>
						<div class="col-sm-9">
							<p class="form-control-static">
								<?php echo $form->textField($model,'PENSION_ACC_NO',array('size'=>45,'maxlength'=>45, 'value'=>$model->PENSION_ACC_NO)); ?>
							</p>
						</div>
					</div>
					<?php 
						if(strtolower(Yii::app()->controller->action->id) == 'update'){
							
							if($model->PENSION_TYPE == 'OPS'){
								?>
								<div class="form-group row" id="gpf-sub-section">
									<?php echo $form->labelEx($model,'GPF_SUBSCRIPTION', array('class'=>'col-sm-3 form-control-label eis-required-field')); ?>
									<div class="col-sm-9">
										<p class="form-control-static">
											<?php echo $form->textField($model,'GPF_SUBSCRIPTION',array('size'=>45,'maxlength'=>45, 'value'=>$model->GPF_SUBSCRIPTION)); ?>
										</p>
									</div>
								</div>
								<?php
							}
						} else {
							?>
							<div class="form-group row" id="gpf-sub-section">
								<?php echo $form->labelEx($model,'GPF_SUBSCRIPTION', array('class'=>'col-sm-3 form-control-label eis-required-field')); ?>
								<div class="col-sm-9">
									<p class="form-control-static">
										<?php echo $form->textField($model,'GPF_SUBSCRIPTION',array('size'=>45,'maxlength'=>45, 'value'=>$model->GPF_SUBSCRIPTION)); ?>
									</p>
								</div>
							</div>
							<?php
						}
					?>
					
				</div>
			</div><!--.tab-pane-->
			<div role="tabpanel" class="tab-pane fade" id="tabs-1-tab-3">
				<div class="col-sm-6">
					<div class="form-group row">
						<?php echo $form->labelEx($model,'DOB', array('class'=>'col-sm-3 form-control-label eis-required-field')); ?>
						<div class="col-sm-9">
							<p class="form-control-static">
								<input value="<?php echo ($model->DOB == "") ? "" : date('Y-m-d', strtotime($model->DOB))?>" id="Employee_DOB" name="Employee[DOB]" type="date">
							</p>
						</div>
					</div>
					<div class="form-group row">
						<?php echo $form->labelEx($model,'PAY_WEF_DATE', array('class'=>'col-sm-3 form-control-label eis-required-field')); ?>
						<div class="col-sm-9">
							<p class="form-control-static">
								<input value="<?php echo ($model->PAY_WEF_DATE == "") ? "" : date('Y-m-d', strtotime($model->PAY_WEF_DATE))?>" id="Employee_PAY_WEF_DATE" name="Employee[PAY_WEF_DATE]" type="date">
							</p>
						</div>
					</div>
					<div class="form-group row">
						<?php echo $form->labelEx($model,'NEXT_INCREMENT_DATE', array('class'=>'col-sm-3 form-control-label eis-required-field')); ?>
						<div class="col-sm-9">
							<p class="form-control-static">
								<input value="<?php echo ($model->NEXT_INCREMENT_DATE == "") ? "" : date('Y-m-d', strtotime($model->NEXT_INCREMENT_DATE))?>" id="Employee_NEXT_INCREMENT_DATE" name="Employee[NEXT_INCREMENT_DATE]" type="date">
							</p>
						</div>
					</div>
					<div class="form-group row">
						<?php echo $form->labelEx($model,'GOVT_SERVICE_ENTRY_DATE', array('class'=>'col-sm-3 form-control-label eis-required-field')); ?>
						<div class="col-sm-9">
							<p class="form-control-static">
								<input value="<?php echo ($model->GOVT_SERVICE_ENTRY_DATE == "") ? "" : date('Y-m-d', strtotime($model->GOVT_SERVICE_ENTRY_DATE))?>" id="GOVT_SERVICE_ENTRY_DATE" name="Employee[GOVT_SERVICE_ENTRY_DATE]" type="date">
								<?php echo $form->dropDownList($model,'GOVT_SERVICE_ENTRY_TIME',array(''=>'', 'F/N'=>'F/N', 'A/N'=>'A/N'), array('options'=>array($model->GOVT_SERVICE_ENTRY_TIME=>array('selected'=>true)))); ?>
							</p>
						</div>
					</div>
					<div class="form-group row">
						<?php echo $form->labelEx($model,'CONTROLLER_JOIN_DATE', array('class'=>'col-sm-3 form-control-label eis-required-field')); ?>
						<div class="col-sm-9">
							<p class="form-control-static">
								<input value="<?php echo ($model->CONTROLLER_JOIN_DATE == "") ? "" : date('Y-m-d', strtotime($model->CONTROLLER_JOIN_DATE))?>" id="Employee_CONTROLLER_JOIN_DATE" name="Employee[CONTROLLER_JOIN_DATE]" type="date">
								<?php echo $form->dropDownList($model,'CONTROLLER_JOIN_TIME',array(''=>'', 'F/N'=>'F/N', 'A/N'=>'A/N'), array('options'=>array($model->CONTROLLER_JOIN_TIME=>array('selected'=>true)))); ?>
							</p>
						</div>
					</div>
					<div class="form-group row">
						<?php echo $form->labelEx($model,'CURRENT_OFFICE_JOIN_DATE', array('class'=>'col-sm-3 form-control-label eis-required-field')); ?>
						<div class="col-sm-9">
							<p class="form-control-static">
								<input value="<?php echo ($model->CURRENT_OFFICE_JOIN_DATE == "") ? "" : date('Y-m-d', strtotime($model->CURRENT_OFFICE_JOIN_DATE))?>" id="Employee_CURRENT_OFFICE_JOIN_DATE" name="Employee[CURRENT_OFFICE_JOIN_DATE]" type="date">
								<?php echo $form->dropDownList($model,'CURRENT_OFFICE_JOIN_TIME',array(''=>'', 'F/N'=>'F/N', 'A/N'=>'A/N'), array('options'=>array($model->CURRENT_OFFICE_JOIN_TIME=>array('selected'=>true)))); ?>
							</p>
						</div>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="form-group row">
						<?php echo $form->labelEx($model,'CURRENT_POST_JOIN_DATE', array('class'=>'col-sm-3 form-control-label eis-required-field')); ?>
						<div class="col-sm-9">
							<p class="form-control-static">
								<input value="<?php echo ($model->CURRENT_POST_JOIN_DATE == "") ? "" : date('Y-m-d', strtotime($model->CURRENT_POST_JOIN_DATE))?>" id="Employee_CURRENT_POST_JOIN_DATE" name="Employee[CURRENT_POST_JOIN_DATE]" type="date">
								<?php echo $form->dropDownList($model,'CURRENT_POST_JOIN_TIME',array(''=>'', 'F/N'=>'F/N', 'A/N'=>'A/N'), array('options'=>array($model->CURRENT_POST_JOIN_TIME=>array('selected'=>true)))); ?>
							</p>
						</div>
					</div>
					<div class="form-group row">
						<?php echo $form->labelEx($model,'JOIN_DESIGNATION_ID_FK', array('class'=>'col-sm-3 form-control-label')); ?>
						<div class="col-sm-9">
							<p class="form-control-static">
								<?php echo $form->dropDownList($model,'JOIN_DESIGNATION_ID_FK',CHtml::listData(Designations::model()->findAll(), 'ID', 'DESIGNATION'), array(
							'options' => array("'".$model->JOIN_DESIGNATION_ID_FK."'" => array('selected'=>true)),
							'disabled'=>Yii::app()->controller->action->id == 'update')); ?>
							</p>
						</div>
					</div>
					<div class="form-group row">
						<?php echo $form->labelEx($model,'CURRENT_OFFICE_RELIEF_DATE', array('class'=>'col-sm-3 form-control-label')); ?>
						<div class="col-sm-9">
							<p class="form-control-static">
								<input value="<?php echo ($model->CURRENT_OFFICE_RELIEF_DATE == "") ? "" : date('Y-m-d', strtotime($model->CURRENT_OFFICE_RELIEF_DATE))?>" id="Employee_CURRENT_OFFICE_RELIEF_DATE" name="Employee[CURRENT_OFFICE_RELIEF_DATE]" type="date">
								<?php echo $form->dropDownList($model,'CURRENT_OFFICE_RELIEF_TIME',array(''=>'', 'F/N'=>'F/N', 'A/N'=>'A/N'), array('options'=>array($model->CURRENT_OFFICE_RELIEF_TIME=>array('selected'=>true)))); ?>
							</p>
						</div>
					</div>
					<div class="form-group row">
						<?php echo $form->labelEx($model,'CONTROLLER_RELIEF_DATE', array('class'=>'col-sm-3 form-control-label')); ?>
						<div class="col-sm-9">
							<p class="form-control-static">
								<input value="<?php echo ($model->CONTROLLER_RELIEF_DATE == "") ? "" : date('Y-m-d', strtotime($model->CONTROLLER_RELIEF_DATE))?>" id="Employee_CONTROLLER_RELIEF_DATE" name="Employee[CONTROLLER_RELIEF_DATE]" type="date">
								<?php echo $form->dropDownList($model,'CONTROLLER_RELIEF_TIME',array(''=>'', 'F/N'=>'F/N', 'A/N'=>'A/N'), array('options'=>array($model->CONTROLLER_RELIEF_TIME=>array('selected'=>true)))); ?>
							</p>
						</div>
					</div>
					<div class="form-group row">
						<?php echo $form->labelEx($model,'GOVT_SERVICE_EXIT_DATE', array('class'=>'col-sm-3 form-control-label')); ?>
						<div class="col-sm-9">
							<p class="form-control-static">
								<input value="<?php echo ($model->GOVT_SERVICE_EXIT_DATE == "") ? "" : date('Y-m-d', strtotime($model->GOVT_SERVICE_EXIT_DATE))?>" id="Employee_GOVT_SERVICE_EXIT_DATE" name="Employee[GOVT_SERVICE_EXIT_DATE]" type="date">
							</p>
						</div>
					</div>
					<div class="form-group row">
						<?php echo $form->labelEx($model,'CGEGIS_MEMBER_DATE', array('class'=>'col-sm-3 form-control-label eis-required-field')); ?>
						<div class="col-sm-9">
							<p class="form-control-static">
								<input value="<?php echo ($model->CGEGIS_MEMBER_DATE == "") ? "" : date('Y-m-d', strtotime($model->CGEGIS_MEMBER_DATE))?>" id="Employee_CGEGIS_MEMBER_DATE" name="Employee[CGEGIS_MEMBER_DATE]" type="date">
							</p>
						</div>
					</div>
				</div>
			</div><!--.tab-pane-->
			<div role="tabpanel" class="tab-pane fade" id="tabs-1-tab-4">
				<?php  if(strtolower(Yii::app()->controller->action->id) == 'update'){ ?>
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group row">
								<label class="col-sm-2 form-control-label">LIC Policies</label>
								<style> #LICTable input[type=text] {width: 150px;} </style>
								<div class="col-sm-9">
									<table id="LICTable" class="table table-bordered table-hover">
										<tr>
											<td>Policy No</td>
											<td>Amount</td>
											<td>Status</td>
											<td></td>
											<td></td>
										</tr>
										<?php
											
											$EmployeeLICPolicies = new EmployeeLICPolicies;
											$policies = $EmployeeLICPolicies->findAllByAttributes(array('EMPLOYEE_ID_FK'=>$model->ID));
											foreach($policies as $policy){
												?>
												<tr>
													<td><input type="hidden" value="<?php echo $policy->ID?>" class="policy-id"><input type="text" size="10" value="<?php echo $policy->POLICY_NO; ?>" class="policy-no" disabled="true" /></td>
													<td><input type="text" size="10" value="<?php echo $policy->AMOUNT; ?>" class="policy-amount" disabled="true"/></td>
													<td><select class="policy-status" disabled="true" ><option value="1" <?php echo ($policy->STATUS == 1) ? "selected" : "";?>>ACTIVE</option><option value="0" <?php echo ($policy->STATUS == 0) ? "selected" : "";?>>IN ACTIVE</option></select></td>
													<td>
														<input type="button" id="editSubBillbutton" class="btn btn-inline edit-btn" value="Edit" onclick="editLICRow(this)"/>
														<input type="button" id="saveSubBillbutton" class="btn btn-inline save-btn" style="display:none;" value="Save" onclick="saveLICRow(this)"/>
													</td>
													<td><input type="button" id="delSubBillbutton" class="btn btn-inline del-btn" value="Delete" onclick="delLICRow(this)"/></td>
												</tr>
												<?php
											}
										?>
										<tr>
											<td><input type="text" size="10" name="Employee[LIC][0][POLICY_NO]"/></td>
											<td><input type="text" size="10" name="Employee[LIC][0][AMOUNT]"/></td>
											<td><select name="Employee[LIC][0][STATUS]"><option value="1">ACTIVE</option><option value="0">IN ACTIVE</option></select></td>
											<td><input type="button" id="delSubBillbutton" class="btn btn-inline" value="Delete" onclick="deleteLICRow(this)"/></td>
											<td><input type="button" id="addSubBillbutton" class="btn btn-inline" value="Add Policy" onclick="insLICRow()"/></td>
										</tr>
									</table>
								</div>
							</div>
						</div>
						<div class="col-sm-6"></div>
					</div>
					<div class="row">
					<div class="col-sm-6">
						<div class="form-group row">
							<label class="col-sm-2 form-control-label">PLI Policies</label>
							<style> #PLITable input[type=text] {width: 150px;} </style>
							<div class="col-sm-9">
								<table id="PLITable" class="table table-bordered table-hover">
									<tr>
										<td>Policy No</td>
										<td>Amount</td>
										<td>Status</td>
										<td></td>
										<td></td>
									</tr>
									<?php
										
										$EmployeePLIPolicies = new EmployeePLIPolicies;
										$policies = $EmployeePLIPolicies->findAllByAttributes(array('EMPLOYEE_ID_FK'=>$model->ID));
										foreach($policies as $policy){
											?>
											<tr>
												<td><input type="hidden" value="<?php echo $policy->ID?>" class="policy-id"><input type="text" size="10" value="<?php echo $policy->POLICY_NO; ?>" class="policy-no" disabled="true"/></td>
												<td><input type="text" size="10" value="<?php echo $policy->AMOUNT; ?>"  class="policy-amount" disabled="true"/></td>
												<td><select class="policy-status" disabled="true" ><option value="1" <?php echo ($policy->STATUS == 1) ? "selected" : "";?>>ACTIVE</option><option value="0" <?php echo ($policy->STATUS == 0) ? "selected" : "";?>>IN ACTIVE</option></select></td>
												<td>
													<input type="button" id="editSubBillbutton" class="btn btn-inline edit-btn" value="Edit" onclick="editPLIRow(this)"/>
													<input type="button" id="saveSubBillbutton" class="btn btn-inline save-btn" style="display:none;" value="Save" onclick="savePLIRow(this)"/>
												</td>
												<td><input type="button" id="delSubBillbutton" class="btn btn-inline del-btn" value="Delete" onclick="delPLIRow(this)"/></td>
											</tr>
											<?php
										}
									?>
									<tr>
										<td><input type="text" size="10" name="Employee[PLI][0][POLICY_NO]"/></td>
										<td><input type="text" size="10" name="Employee[PLI][0][AMOUNT]"/></td>
										<td><select name="Employee[PLI][0][STATUS]"><option value="1">ACTIVE</option><option value="0">IN ACTIVE</option></select></td>
										<td><input type="button" id="delSubBillbutton" class="btn btn-inline" value="Delete" onclick="deletePLIRow(this)"/></td>
										<td><input type="button" id="addSubBillbutton" class="btn btn-inline" value="Add Policy" onclick="insPLIRow()"/></td>
									</tr>
								</table>
							</div>
						</div>
					</div>
					<div class="col-sm-6"></div>
				</div>
				<?php  } else if(strtolower(Yii::app()->controller->action->id) == 'create'){ ?>	
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group row">
								<label class="col-sm-2 form-control-label">LIC POLICIES</label>
								<style> #LICTable input[type=text] {width: 150px;}</style>
								<div class="col-sm-9">
									<table id="LICTable" class="table table-bordered table-hover">
										<tr>
											<td>Policy No</td>
											<td>Amount</td>
											<td>Status</td>
											<td></td>
											<td></td>
										</tr>
										<tr>
											<td><input type="text" size="10" name="Employee[LIC][0][POLICY_NO]"/></td>
											<td><input type="text" size="10" name="Employee[LIC][0][AMOUNT]"/></td>
											<td><select name="Employee[LIC][0][STATUS]"><option value="1">ACTIVE</option><option value="0">IN ACTIVE</option></select></td>
											<td><input type="button" class="btn btn-inline" id="delSubBillbutton" value="Delete" onclick="deleteLICRow(this)"/></td>
											<td><input type="button" class="btn btn-inline" id="addSubBillbutton" value="Add Policy" onclick="insLICRow()"/></td>
										</tr>
									</table>
								</div>
							</div>
							
						</div>
						<div class="col-sm-6"></div>
					</div>
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group row">
								<label class="col-sm-2 form-control-label">PLI POLICIES</label>
								<style> #PLITable input[type=text] {width: 150px;}</style>
								<div class="col-sm-9">
									<table id="LICTable" class="table table-bordered table-hover">
										<tr>
											<td>Policy No</td>
											<td>Amount</td>
											<td>Status</td>
											<td></td>
											<td></td>
										</tr>
										<tr>
											<td><input type="text" size="10" name="Employee[PLI][0][POLICY_NO]"/></td>
											<td><input type="text" size="10" name="Employee[PLI][0][AMOUNT]"/></td>
											<td><select name="Employee[PLI][0][STATUS]"><option value="1">ACTIVE</option><option value="0">IN ACTIVE</option></select></td>
											<td><input type="button" class="btn btn-inline" id="delSubBillbutton" value="Delete" onclick="deletePLIRow(this)"/></td>
											<td><input type="button" class="btn btn-inline" id="addSubBillbutton" value="Add Policy" onclick="insPLIRow()"/></td>
										</tr>
									</table>
								</div>
							</div>
							
						</div>
						<div class="col-sm-6"></div>
					</div>
				<?php }  ?>
			</div><!--.tab-pane-->
			<div role="tabpanel" class="tab-pane fade" id="tabs-1-tab-5">
				<div class="col-sm-6">
					<div class="form-group row">
						<?php echo $form->labelEx($model,'IS_QUARTER_ALLOCATED', array('class'=>'col-sm-3 form-control-label')); ?>
						<div class="col-sm-9">
							<p class="form-control-static">
								<?php echo $form->dropDownList($model,'IS_QUARTER_ALLOCATED',array(0=>'No', 1=>'Yes'), array('options'=>array($model->IS_QUARTER_ALLOCATED=>array('selected'=>true)))); ?>
							</p>
						</div>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="form-group row">
						<?php echo $form->labelEx($model,'HRA_SLAB_ID_FK', array('class'=>'col-sm-3 form-control-label')); ?>
						<div class="col-sm-9">
							<p class="form-control-static">
								<?php echo $form->dropDownList($model,'HRA_SLAB_ID_FK',CHtml::listData(HRASlabs::model()->findAll(), 'ID', 'DESCRIPTION'), array(
							'options' => array("'".$model->HRA_SLAB_ID_FK."'" => array('selected'=>true)),
							'disabled'=>Yii::app()->controller->action->id == 'update')); ?>
							</p>
						</div>
					</div>
				</div>
			</div><!--.tab-pane-->
			<div role="tabpanel" class="tab-pane fade" id="tabs-1-tab-6">
				<div class="col-sm-6">
					<div class="form-group row">
						<?php echo $form->labelEx($model,'IS_PERMANENT', array('class'=>'col-sm-3 form-control-label')); ?>
						<div class="col-sm-9">
							<p class="form-control-static">
								<?php echo $form->dropDownList($model,'IS_PERMANENT',array(0=>'No', 1=>'Yes'), array('options'=>array($model->IS_PERMANENT=>array('selected'=>true)))); ?>
							</p>
						</div>
					</div>
					<div class="form-group row">
						<?php echo $form->labelEx($model,'IS_TRANSFERRED', array('class'=>'col-sm-3 form-control-label')); ?>
						<div class="col-sm-9">
							<p class="form-control-static">
								<?php echo $form->dropDownList($model,'IS_TRANSFERRED',array(0=>'No', 1=>'Yes'), array('options'=>array($model->IS_TRANSFERRED=>array('selected'=>true)))); ?>
							</p>
						</div>
					</div>
					<div class="form-group row">
						<?php echo $form->labelEx($model,'IS_RETIRED', array('class'=>'col-sm-3 form-control-label')); ?>
						<div class="col-sm-9">
							<p class="form-control-static">
								<?php echo $form->dropDownList($model,'IS_RETIRED',array(0=>'No', 1=>'Yes'), array('options'=>array($model->IS_RETIRED=>array('selected'=>true)))); ?>
							</p>
						</div>
					</div>
					<div class="form-group row">
						<?php echo $form->labelEx($model,'IS_EX_SERVICE', array('class'=>'col-sm-3 form-control-label eis-required-field')); ?>
						<div class="col-sm-9">
							<p class="form-control-static">
								<?php echo $form->dropDownList($model,'IS_EX_SERVICE',
								array('N'=>'No', 'Y'=>'Yes'),
								array('options'=>array($model->IS_EX_SERVICE=>array('selected'=>true)))); ?>
							</p>
						</div>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="form-group row">
						<?php echo $form->labelEx($model,'UA_ELIGIBLE', array('class'=>'col-sm-3 form-control-label')); ?>
						<div class="col-sm-9">
							<p class="form-control-static">
								<?php echo $form->dropDownList($model,'UA_ELIGIBLE',array(0=>'No', 1=>'Yes'), array('options'=>array($model->UA_ELIGIBLE=>array('selected'=>true)))); ?>
							</p>
						</div>
					</div>
					<div class="form-group row">
						<?php echo $form->labelEx($model,'BONUS_ELIGIBLE', array('class'=>'col-sm-3 form-control-label')); ?>
						<div class="col-sm-9">
							<p class="form-control-static">
								<?php echo $form->dropDownList($model,'BONUS_ELIGIBLE',array(0=>'No', 1=>'Yes'), array('options'=>array($model->BONUS_ELIGIBLE=>array('selected'=>true)))); ?>
							</p>
						</div>
					</div>
					<div class="form-group row">
						<?php echo $form->labelEx($model,'PERMISSION', array('class'=>'col-sm-3 form-control-label')); ?>
						<div class="col-sm-9">
							<p class="form-control-static">
								<?php echo $form->dropDownList($model,'PERMISSION',array('EMPLOYEE'=>'EMPLOYEE', 'ADMINISTRATION'=>'ADMINISTRATION'), array('options'=>array($model->PERMISSION=>array('selected'=>true)))); ?>
							</p>
						</div>
					</div>
				</div>
			</div><!--.tab-pane-->
			<div role="tabpanel" class="tab-pane fade" id="tabs-1-tab-7">
				<div class="col-sm-6">
					<div class="form-group row">
						<?php echo $form->labelEx($model,'IS_CGHS_CARD_HOLDER', array('class'=>'col-sm-3 form-control-label eis-required-field')); ?>
						<div class="col-sm-9">
							<p class="form-control-static">
								<?php echo $form->dropDownList($model,'IS_CGHS_CARD_HOLDER',
								array('N'=>'No', 'Y'=>'Yes'),
								array('options'=>array($model->IS_CGHS_CARD_HOLDER=>array('selected'=>true)))); ?>
							</p>
						</div>
					</div>
					<div class="form-group row">
						<?php echo $form->labelEx($model,'CGHS_CARD_NO', array('class'=>'col-sm-3 form-control-label eis-required-field')); ?>
						<div class="col-sm-9">
							<p class="form-control-static">
								<?php echo $form->textField($model,'CGHS_CARD_NO',array('size'=>40,'maxlength'=>100, 'value'=>$model->CGHS_CARD_NO)); ?>
							</p>
						</div>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="form-group row">
						<?php echo $form->labelEx($model,'CGEGIS_APPLICABLE_CODE', array('class'=>'col-sm-3 form-control-label eis-required-field')); ?>
						<div class="col-sm-9">
							<p class="form-control-static">
								<?php echo $form->dropDownList($model,'CGEGIS_APPLICABLE_CODE',
								array('6'=>'Central Govt. (CGEGIS)', '7'=>'CGEGIS (Old Scheme)', '8'=>'CGEIS (Old Rs 5)', '0'=>'Not Applicable'),
								array('options'=>array($model->CGEGIS_APPLICABLE_CODE=>array('selected'=>true)))); ?>
							</p>
						</div>
					</div>
					<div class="form-group row">
						<?php echo $form->labelEx($model,'CGEGIS_GROUP_CODE', array('class'=>'col-sm-3 form-control-label eis-required-field')); ?>
						<div class="col-sm-9">
							<p class="form-control-static">
								<?php echo $form->dropDownList($model,'CGEGIS_GROUP_CODE',
								array('1'=>'Group A', '2'=>'Group B', '4'=>'Group C', '5'=>'Group D'),
								array('options'=>array($model->CGEGIS_GROUP_CODE=>array('selected'=>true)))); ?>
							</p>
						</div>
					</div>
				</div>
			</div>
			<div role="tabpanel" class="tab-pane fade" id="tabs-1-tab-8">
				<div class="col-sm-6">
					<div class="form-group row">
						<?php echo $form->labelEx($model,'EMPLOYEE_CODE_BY_EMPLOYER', array('class'=>'col-sm-3 form-control-label eis-required-field')); ?>
						<div class="col-sm-9">
							<p class="form-control-static">
								<?php echo $form->textField($model,'EMPLOYEE_CODE_BY_EMPLOYER',array('size'=>40,'maxlength'=>100, 'value'=>$model->EMPLOYEE_CODE_BY_EMPLOYER)); ?>
							</p>
						</div>
					</div>
					<div class="form-group row">
						<?php echo $form->labelEx($model,'MOBILE_NO', array('class'=>'col-sm-3 form-control-label eis-required-field')); ?>
						<div class="col-sm-9">
							<p class="form-control-static">
								<?php echo $form->textField($model,'MOBILE_NO',array('size'=>40,'maxlength'=>100, 'value'=>$model->MOBILE_NO)); ?>
							</p>
						</div>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="form-group row">
						<?php echo $form->labelEx($model,'AADHAR_NO', array('class'=>'col-sm-3 form-control-label eis-required-field')); ?>
						<div class="col-sm-9">
							<p class="form-control-static">
								<?php echo $form->textField($model,'AADHAR_NO',array('size'=>40,'maxlength'=>100, 'value'=>$model->AADHAR_NO)); ?>
							</p>
						</div>
					</div>
					<div class="form-group row">
						<?php echo $form->labelEx($model,'EMAIL_ID', array('class'=>'col-sm-3 form-control-label eis-required-field')); ?>
						<div class="col-sm-9">
							<p class="form-control-static">
								<?php echo $form->textField($model,'EMAIL_ID',array('size'=>40,'maxlength'=>100, 'value'=>$model->EMAIL_ID)); ?>
							</p>
						</div>
					</div>
					<div class="form-group row">
						<?php echo $form->labelEx($model,'SERVICE_BOOK_VOL', array('class'=>'col-sm-3 form-control-label')); ?>
						<div class="col-sm-9">
							<p class="form-control-static">
								<?php echo $form->textField($model,'SERVICE_BOOK_VOL',array('size'=>10,'maxlength'=>100, 'value'=>$model->SERVICE_BOOK_VOL)); ?>
							</p>
						</div>
					</div>
				</div>
			</div>
		</div><!--.tab-content-->
	</section><!--.tabs-section-->
	<?php $this->endWidget(); ?>
	
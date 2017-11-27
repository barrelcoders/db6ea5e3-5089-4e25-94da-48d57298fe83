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
		$("#Employee_ORG_RETIRE_DATE").val(retire_date);
	}
	$(document).ready(function(){
		$('#Employee_DOB').change(function(){
			dob = moment($(this).val()), retire_date = "";
			if(dob.date() == 1){
				retire_date = moment(dob.add(60, "years")).subtract(1,'months').endOf('month').format('YYYY-MM-DD');
			}
			else{
				retire_date = dob.add(60, "years").endOf('month').format('YYYY-MM-DD');
			}
			$("#Employee_ORG_RETIRE_DATE").val(retire_date);
			
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
	
	function delPLIRow(row){
		var tableRow = $(row.parentNode.parentNode),
			policyId = tableRow.find(".policy-id");
		
		var id = policyId.val();
		
		if(!confirm('Are you sure wants to delete this policy'))
			return;
		
		$.post( '<?php echo Yii::app()->createUrl('Employee/DeletePLIPolicy')?>&id='+id, {}, function(result) {
			if(result == 'SUCCESS'){
				alert('Policy deleted successfully');
				document.getElementById('PLITable').deleteRow(row.parentNode.parentNode.rowIndex);
			}
			else{
				alert('Problem in deleting policy, Please try again later');
			}
		});
	}
	
	function deleteLICRow(row)
	{
		var i=row.parentNode.parentNode.rowIndex;
		document.getElementById('LICTable').deleteRow(i);
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
	</script>

	<?php 
	$form=$this->beginWidget('CActiveForm', array(
		'id'=>'employee-form',
		'enableAjaxValidation'=>false,
	)); 
	//'disabled'=>Yii::app()->controller->action->id == 'update',
	?>
	<div class="row">
		<div class="col-sm-6">
			<div class="form-group row">
				<?php echo $form->labelEx($model,'NAME', array('class'=>'col-sm-2 form-control-label')); ?>
				<div class="col-sm-10">
					<p class="form-control-static">
						<?php echo $form->textField($model,'NAME',array('size'=>40,'maxlength'=>100, 'value'=>$model->NAME)); ?>
					</p>
				</div>
			</div>
			<div class="form-group row">
				<?php echo $form->labelEx($model,'NAME_HINDI', array('class'=>'col-sm-2 form-control-label')); ?>
				<div class="col-sm-10">
					<p class="form-control-static">
						<?php echo $form->textField($model,'NAME_HINDI',array('size'=>40,'maxlength'=>100, 'value'=>$model->NAME_HINDI)); ?>
					</p>
				</div>
			</div>
			<div class="form-group row">
				<?php echo $form->labelEx($model,'GENDER', array('class'=>'col-sm-2 form-control-label')); ?>
				<div class="col-sm-10">
					<p class="form-control-static">
						<?php echo $form->dropDownList($model,'GENDER',array('Male'=>'Male', 'Female'=>'Female'), array('options'=>array($model->GENDER=>array('selected'=>true)))); ?>
					</p>
				</div>
			</div>
			<div class="form-group row">
				<?php echo $form->labelEx($model,'CATEGORY', array('class'=>'col-sm-2 form-control-label')); ?>
				<div class="col-sm-10">
					<p class="form-control-static">
						<?php echo $form->dropDownList($model,'CATEGORY',array('General'=>'General', 'SC'=>'SC', 'ST'=>'ST', 'OBC'=>'OBC'), array('options'=>array($model->CATEGORY=>array('selected'=>true)))); ?>
					</p>
				</div>
			</div>
			<div class="form-group row">
				<?php echo $form->labelEx($model,'GROUP_ID_FK', array('class'=>'col-sm-2 form-control-label')); ?>
				<div class="col-sm-10">
					<p class="form-control-static">
						<?php echo $form->dropDownList($model,'GROUP_ID_FK',CHtml::listData(Groups::model()->findAll(), 'ID', 'GROUP_NAME'), array(
					'options' => array("'".$model->GROUP_ID_FK."'" => array('selected'=>true)),
					'disabled'=>Yii::app()->controller->action->id == 'update')); ?>
					</p>
				</div>
			</div>
			<div class="form-group row">
				<?php echo $form->labelEx($model,'DESIGNATION_ID_FK', array('class'=>'col-sm-2 form-control-label')); ?>
				<div class="col-sm-10">
					<p class="form-control-static">
						<?php echo $form->dropDownList($model,'DESIGNATION_ID_FK',CHtml::listData(Designations::model()->findAll(), 'ID', 'DESIGNATION'), array(
					'options' => array("'".$model->DESIGNATION_ID_FK."'" => array('selected'=>true)),
					'disabled'=>Yii::app()->controller->action->id == 'update')); ?>
					</p>
				</div>
			</div>
			<div class="form-group row">
				<?php echo $form->labelEx($model,'GRADE_PAY_ID_FK', array('class'=>'col-sm-2 form-control-label')); ?>
				<div class="col-sm-10">
					<p class="form-control-static">
						<?php echo $form->dropDownList($model,'GRADE_PAY_ID_FK',CHtml::listData(Paybands::model()->findAll(), 'ID', 'DESCRIPTION'), array(
					'options' => array("'".$model->GRADE_PAY_ID_FK."'" => array('selected'=>true)),
					'disabled'=>Yii::app()->controller->action->id == 'update')); ?>
					</p>
				</div>
			</div>
			<div class="form-group row">
				<?php echo $form->labelEx($model,'PAY_MATRIX_ID_FK', array('class'=>'col-sm-2 form-control-label')); ?>
				<div class="col-sm-10">
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
				<?php echo $form->labelEx($model,'POSTING_ID_FK', array('class'=>'col-sm-2 form-control-label')); ?>
				<div class="col-sm-10">
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
				<?php echo $form->labelEx($model,'MICR', array('class'=>'col-sm-2 form-control-label')); ?>
				<div class="col-sm-10">
					<p class="form-control-static">
						<?php echo $form->textField($model,'MICR',array('size'=>45,'maxlength'=>45, 'value'=>$model->MICR)); ?>
					</p>
				</div>
			</div>
			<div class="form-group row">
				<?php echo $form->labelEx($model,'ACCOUNT_NO', array('class'=>'col-sm-2 form-control-label')); ?>
				<div class="col-sm-10">
					<p class="form-control-static">
						<?php echo $form->textField($model,'ACCOUNT_NO',array('size'=>45,'maxlength'=>45, 'value'=>$model->ACCOUNT_NO)); ?>
					</p>
				</div>
			</div>
			<div class="form-group row">
				<?php echo $form->labelEx($model,'IFSC', array('class'=>'col-sm-2 form-control-label')); ?>
				<div class="col-sm-10">
					<p class="form-control-static">
						<?php echo $form->textField($model,'IFSC',array('size'=>45,'maxlength'=>45, 'value'=>$model->IFSC)); ?>
					</p>
				</div>
			</div>
			<div class="form-group row">
				<?php echo $form->labelEx($model,'PAN', array('class'=>'col-sm-2 form-control-label')); ?>
				<div class="col-sm-10">
					<p class="form-control-static">
						<?php echo $form->textField($model,'PAN',array('size'=>45,'maxlength'=>45, 'value'=>$model->PAN)); ?>
					</p>
				</div>
			</div>
			<div class="form-group row">
				<?php echo $form->labelEx($model,'PENSION_ACC_NO', array('class'=>'col-sm-2 form-control-label')); ?>
				<div class="col-sm-10">
					<p class="form-control-static">
						<?php echo $form->textField($model,'PENSION_ACC_NO',array('size'=>45,'maxlength'=>45, 'value'=>$model->PENSION_ACC_NO)); ?>
					</p>
				</div>
			</div>
			<div class="form-group row">
				<?php echo $form->labelEx($model,'PENSION_TYPE', array('class'=>'col-sm-2 form-control-label')); ?>
				<div class="col-sm-10">
					<p class="form-control-static">
						<?php echo $form->dropDownList($model,'PENSION_TYPE',array('OPS'=>'OPS', 'NPS'=>'NPS'), array('options'=>array($model->PENSION_TYPE=>array('selected'=>true)))); ?>
					</p>
				</div>
			</div>
			<div class="form-group row">
				<?php echo $form->labelEx($model,'FOLIO_NO', array('class'=>'col-sm-2 form-control-label')); ?>
				<div class="col-sm-10">
					<p class="form-control-static">
						<?php echo $form->textField($model,'FOLIO_NO',array('size'=>10,'maxlength'=>10, 'value'=>$model->FOLIO_NO)); ?>
					</p>
				</div>
			</div>
			<div class="form-group row">
				<?php echo $form->labelEx($model,'IS_QUARTER_ALLOCATED', array('class'=>'col-sm-2 form-control-label')); ?>
				<div class="col-sm-10">
					<p class="form-control-static">
						<?php echo $form->dropDownList($model,'IS_QUARTER_ALLOCATED',array(1=>'Yes', 0=>'No'), array('options'=>array($model->IS_QUARTER_ALLOCATED=>array('selected'=>true)))); ?>
					</p>
				</div>
			</div>
			<div class="form-group row">
				<?php echo $form->labelEx($model,'HRA_SLAB_ID_FK', array('class'=>'col-sm-2 form-control-label')); ?>
				<div class="col-sm-10">
					<p class="form-control-static">
						<?php echo $form->dropDownList($model,'HRA_SLAB_ID_FK',CHtml::listData(HRASlabs::model()->findAll(), 'ID', 'DESCRIPTION'), array(
					'options' => array("'".$model->HRA_SLAB_ID_FK."'" => array('selected'=>true)),
					'disabled'=>Yii::app()->controller->action->id == 'update')); ?>
					</p>
				</div>
			</div>
		</div>
		<div class="col-sm-6">
			<div class="form-group row">
				<?php echo $form->labelEx($model,'SERVICE_BOOK_VOL', array('class'=>'col-sm-2 form-control-label')); ?>
				<div class="col-sm-10">
					<p class="form-control-static">
						<?php echo $form->textField($model,'SERVICE_BOOK_VOL',array('size'=>10,'maxlength'=>10, 'value'=>$model->SERVICE_BOOK_VOL)); ?>
					</p>
				</div>
			</div>
			<div class="form-group row">
				<?php echo $form->labelEx($model,'DOB', array('class'=>'col-sm-3 form-control-label')); ?>
				<div class="col-sm-9">
					<p class="form-control-static">
						<input value="<?php echo ($model->DOB == "") ? "" : date('Y-m-d', strtotime($model->DOB))?>" id="Employee_DOB" name="Employee[DOB]" type="date">
					</p>
				</div>
			</div>
			<div class="form-group row">
				<?php echo $form->labelEx($model,'DOI', array('class'=>'col-sm-3 form-control-label')); ?>
				<div class="col-sm-9">
					<p class="form-control-static">
						<input value="<?php echo ($model->DOI == "") ? "" : date('Y-m-d', strtotime($model->DOI))?>" id="Employee_DOI" name="Employee[DOI]" type="date">
					</p>
				</div>
			</div>
			<div class="form-group row">
				<?php echo $form->labelEx($model,'ORG_JOIN_DATE', array('class'=>'col-sm-3 form-control-label')); ?>
				<div class="col-sm-9">
					<p class="form-control-static">
						<input value="<?php echo ($model->ORG_JOIN_DATE == "") ? "" : date('Y-m-d', strtotime($model->ORG_JOIN_DATE))?>" id="Employee_ORG_JOIN_DATE" name="Employee[ORG_JOIN_DATE]" type="date">
						<?php echo $form->dropDownList($model,'ORG_JOIN_TIME',array(''=>'', 'F/N'=>'F/N', 'A/N'=>'A/N'), array('options'=>array($model->ORG_JOIN_TIME=>array('selected'=>true)))); ?>
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
				<?php echo $form->labelEx($model,'ORG_RETIRE_DATE', array('class'=>'col-sm-3 form-control-label')); ?>
				<div class="col-sm-9">
					<p class="form-control-static">
						<input value="<?php echo ($model->ORG_RETIRE_DATE == "") ? "" : date('Y-m-d', strtotime($model->ORG_RETIRE_DATE))?>" id="Employee_ORG_RETIRE_DATE" name="Employee[ORG_RETIRE_DATE]" type="date">
					</p>
				</div>
			</div>
			<div class="form-group row">
				<?php echo $form->labelEx($model,'DEPT_JOIN_DATE', array('class'=>'col-sm-3 form-control-label')); ?>
				<div class="col-sm-9">
					<p class="form-control-static">
						<input value="<?php echo ($model->DEPT_JOIN_DATE == "") ? "" : date('Y-m-d', strtotime($model->DEPT_JOIN_DATE))?>" id="Employee_DEPT_JOIN_DATE" name="Employee[DEPT_JOIN_DATE]" type="date">
						<?php echo $form->dropDownList($model,'DEPT_JOIN_TIME',array(''=>'', 'F/N'=>'F/N', 'A/N'=>'A/N'), array('options'=>array($model->DEPT_JOIN_TIME=>array('selected'=>true)))); ?>
					</p>
				</div>
			</div>
			<div class="form-group row">
				<?php echo $form->labelEx($model,'DEPT_RELIEF_DATE', array('class'=>'col-sm-3 form-control-label')); ?>
				<div class="col-sm-9">
					<p class="form-control-static">
						<input value="<?php echo ($model->DEPT_RELIEF_DATE == "") ? "" : date('Y-m-d', strtotime($model->DEPT_RELIEF_DATE))?>" id="Employee_DEPT_RELIEF_DATE" name="Employee[DEPT_RELIEF_DATE]" type="date">
						<?php echo $form->dropDownList($model,'DEPT_RELIEF_TIME',array(''=>'', 'F/N'=>'F/N', 'A/N'=>'A/N'), array('options'=>array($model->DEPT_RELIEF_TIME=>array('selected'=>true)))); ?>
					</p>
				</div>
			</div>
			<div class="form-group row">
				<?php echo $form->labelEx($model,'PRESENT_PROMOTION_DATE', array('class'=>'col-sm-3 form-control-label')); ?>
				<div class="col-sm-9">
					<p class="form-control-static">
						<input value="<?php echo ($model->PRESENT_PROMOTION_DATE == "") ? "" : date('Y-m-d', strtotime($model->PRESENT_PROMOTION_DATE))?>" id="Employee_PRESENT_PROMOTION_DATE" name="Employee[PRESENT_PROMOTION_DATE]" type="date">
					</p>
				</div>
			</div>
			<div class="form-group row">
				<?php echo $form->labelEx($model,'IS_PERMANENT', array('class'=>'col-sm-3 form-control-label')); ?>
				<div class="col-sm-9">
					<p class="form-control-static">
						<?php echo $form->dropDownList($model,'IS_PERMANENT',array(1=>'Yes', 0=>'No'), array('options'=>array($model->IS_PERMANENT=>array('selected'=>true)))); ?>
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
	</div>
	<?php  if(strtolower(Yii::app()->controller->action->id) == 'update'){ ?>
	<div class="row">
		<div class="col-sm-6">
			<div class="form-group row">
				<label class="col-sm-2 form-control-label">LIC Policies</label>
				<style> #LICTable input[type=text] {width: 150px;} </style>
				<div class="col-sm-10">
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
				<div class="col-sm-10">
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
					<div class="col-sm-10">
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
					<div class="col-sm-10">
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
	
	<div class="row">
		<div class="col-sm-6">
			<div class="form-group row">
				<label class='col-sm-2 form-control-label'></label>
				<div class="col-sm-10">
					<p class="form-control-static">
						<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class'=>'btn btn-inline')); ?>
					</p>
				</div>
			</div>
		</div>
		<div class="col-sm-16"></div>
	</div>
	<?php $this->endWidget(); ?>
	
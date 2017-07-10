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
	function deleteRow(row)
	{
		var i=row.parentNode.parentNode.rowIndex;
		document.getElementById('LICTable').deleteRow(i);
	}


	function insRow()
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
	</script>

	<?php $form=$this->beginWidget('CActiveForm', array(
		'id'=>'employee-form',
		// Please note: When you enable ajax validation, make sure the corresponding
		// controller action is handling ajax validation correctly.
		// There is a call to performAjaxValidation() commented in generated controller code.
		// See class documentation of CActiveForm for details on this.
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
						<?php echo $form->textField($model,'NAME',array('size'=>40,'maxlength'=>100, 'value'=>$model->NAME, 'style'=>'text-transform: uppercase;')); ?>
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
					'empty'=>array('0'=>'Select Group'),
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
					'empty'=>array('0'=>'Select Designation'),
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
					'empty'=>array('0'=>'Select Grade Pay'),
					'options' => array("'".$model->GRADE_PAY_ID_FK."'" => array('selected'=>true)),
					'disabled'=>Yii::app()->controller->action->id == 'update')); ?>
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
		</div>
		<div class="col-sm-6">
			<div class="form-group row">
				<?php echo $form->labelEx($model,'DOB', array('class'=>'col-sm-2 form-control-label')); ?>
				<div class="col-sm-10">
					<p class="form-control-static">
						<?php  
							$this->widget('zii.widgets.jui.CJuiDatePicker',array(
								'model'=>$model,
								'attribute'=>'DOB',
								'options'=>array(
									'dateFormat'=>'yy-mm-dd',
									'showAnim'=>'fold',
								),
								'htmlOptions'=>array(
									'value'=> ($model->DOB == "") ? "" : date('Y-m-d', strtotime($model->DOB))
								),
							));	?>
					</p>
				</div>
			</div>
			<div class="form-group row">
				<?php echo $form->labelEx($model,'DOI', array('class'=>'col-sm-2 form-control-label')); ?>
				<div class="col-sm-10">
					<p class="form-control-static">
						<?php 
							$this->widget('zii.widgets.jui.CJuiDatePicker',array(
								'model'=>$model,
								'attribute'=>'DOI',
								'options'=>array(
									'dateFormat'=>'yy-mm-dd',
									'showAnim'=>'fold',
								),
								'htmlOptions'=>array(
									'value'=> ($model->DOI == "") ? "" : date('Y-m-d', strtotime($model->DOI))
								),
							));	?>
					</p>
				</div>
			</div>
			<div class="form-group row">
				<?php echo $form->labelEx($model,'IS_PERMANENT', array('class'=>'col-sm-2 form-control-label')); ?>
				<div class="col-sm-10">
					<p class="form-control-static">
						<?php echo $form->dropDownList($model,'IS_PERMANENT',array(1=>'Permanent', 0=>'Contractor'), array('options'=>array($model->IS_PERMANENT=>array('selected'=>true)))); ?>
					</p>
				</div>
			</div>
			<div class="form-group row">
				<?php echo $form->labelEx($model,'ORG_JOIN_DATE', array('class'=>'col-sm-2 form-control-label')); ?>
				<div class="col-sm-10">
					<p class="form-control-static">
						<?php 
							$this->widget('zii.widgets.jui.CJuiDatePicker',array(
								'model'=>$model,
								'attribute'=>'ORG_JOIN_DATE',
								'options'=>array(
									'dateFormat'=>'yy-mm-dd',
									'showAnim'=>'fold',
								),
								'htmlOptions'=>array(
									'value'=> ($model->ORG_JOIN_DATE == "") ? "" : date('Y-m-d', strtotime($model->ORG_JOIN_DATE))
								),
							));	?>
							<?php echo $form->dropDownList($model,'ORG_JOIN_TIME',array(''=>'', 'F/N'=>'F/N', 'A/N'=>'A/N'), array('options'=>array($model->ORG_JOIN_TIME=>array('selected'=>true)))); ?>
					</p>
				</div>
				
			</div>
			<div class="form-group row">
				<?php echo $form->labelEx($model,'JOIN_DESIGNATION_ID_FK', array('class'=>'col-sm-2 form-control-label')); ?>
				<div class="col-sm-10">
					<p class="form-control-static">
						<?php echo $form->dropDownList($model,'JOIN_DESIGNATION_ID_FK',CHtml::listData(Designations::model()->findAll(), 'ID', 'DESIGNATION'), array(
					'empty'=>array('0'=>'Select Designation'),
					'options' => array("'".$model->JOIN_DESIGNATION_ID_FK."'" => array('selected'=>true)),
					'disabled'=>Yii::app()->controller->action->id == 'update')); ?>
					</p>
				</div>
			</div>
			<div class="form-group row">
				<?php echo $form->labelEx($model,'ORG_RETIRE_DATE', array('class'=>'col-sm-2 form-control-label')); ?>
				<div class="col-sm-10">
					<p class="form-control-static">
						<?php 
							$this->widget('zii.widgets.jui.CJuiDatePicker',array(
								'model'=>$model,
								'attribute'=>'ORG_RETIRE_DATE',
								'options'=>array(
									'dateFormat'=>'yy-mm-dd',
									'showAnim'=>'fold',
								),
								'htmlOptions'=>array(
									'value'=> ($model->ORG_RETIRE_DATE == "") ? "" : $model->ORG_RETIRE_DATE
								),
							));
							?>
					</p>
				</div>
			</div>
			<div class="form-group row">
				<?php echo $form->labelEx($model,'DEPT_JOIN_DATE', array('class'=>'col-sm-2 form-control-label')); ?>
				<div class="col-sm-10">
					<p class="form-control-static">
						<?php 
							$this->widget('zii.widgets.jui.CJuiDatePicker',array(
								'model'=>$model,
								'attribute'=>'DEPT_JOIN_DATE',
								'options'=>array(
									'dateFormat'=>'yy-mm-dd',
									'showAnim'=>'fold',
								),
								'htmlOptions'=>array(
									'value'=> ($model->DEPT_JOIN_DATE == "") ? "" : date('Y-m-d', strtotime($model->DEPT_JOIN_DATE))
								),
							));	?>
							<?php echo $form->dropDownList($model,'DEPT_JOIN_TIME',array(''=>'', 'F/N'=>'F/N', 'A/N'=>'A/N'), array('options'=>array($model->DEPT_JOIN_TIME=>array('selected'=>true)))); ?>
					</p>
				</div>
			</div>
			<div class="form-group row">
				<?php echo $form->labelEx($model,'DEPT_RELIEF_DATE', array('class'=>'col-sm-2 form-control-label')); ?>
				<div class="col-sm-10">
					<p class="form-control-static">
						<?php 
							$this->widget('zii.widgets.jui.CJuiDatePicker',array(
								'model'=>$model,
								'attribute'=>'DEPT_RELIEF_DATE',
								'options'=>array(
									'dateFormat'=>'yy-mm-dd',
									'showAnim'=>'fold',
								),
								'htmlOptions'=>array(
									'value'=> ($model->DEPT_RELIEF_DATE == "") ? "" : date('Y-m-d', strtotime($model->DEPT_RELIEF_DATE))
								),
							));	?>
							<?php echo $form->dropDownList($model,'DEPT_RELIEF_TIME',array(''=>'', 'F/N'=>'F/N', 'A/N'=>'A/N'), array('options'=>array($model->DEPT_RELIEF_TIME=>array('selected'=>true)))); ?>
					</p>
				</div>
			</div>
			<div class="form-group row">
				<?php echo $form->labelEx($model,'PRESENT_PROMOTION_DATE', array('class'=>'col-sm-2 form-control-label')); ?>
				<div class="col-sm-10">
					<p class="form-control-static">
						<?php 
							$this->widget('zii.widgets.jui.CJuiDatePicker',array(
								'model'=>$model,
								'attribute'=>'PRESENT_PROMOTION_DATE',
								'options'=>array(
									'dateFormat'=>'yy-mm-dd',
									'showAnim'=>'fold',
								),
								'htmlOptions'=>array(
									'value'=> ($model->PRESENT_PROMOTION_DATE == "") ? "" : date('Y-m-d', strtotime($model->PRESENT_PROMOTION_DATE))
								),
							));	?>
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
				<?php echo $form->labelEx($model,'IS_TRANSFERRED', array('class'=>'col-sm-2 form-control-label')); ?>
				<div class="col-sm-10">
					<p class="form-control-static">
						<?php echo $form->dropDownList($model,'IS_TRANSFERRED',array(0=>'No', 1=>'Yes'), array('options'=>array($model->IS_TRANSFERRED=>array('selected'=>true)))); ?>
					</p>
				</div>
			</div>
			<div class="form-group row">
				<?php echo $form->labelEx($model,'IS_RETIRED', array('class'=>'col-sm-2 form-control-label')); ?>
				<div class="col-sm-10">
					<p class="form-control-static">
						<?php echo $form->dropDownList($model,'IS_RETIRED',array(0=>'No', 1=>'Yes'), array('options'=>array($model->IS_RETIRED=>array('selected'=>true)))); ?>
					</p>
				</div>
			</div>
			<div class="form-group row">
				<?php echo $form->labelEx($model,'PERMISSION', array('class'=>'col-sm-2 form-control-label')); ?>
				<div class="col-sm-10">
					<p class="form-control-static">
						<?php echo $form->dropDownList($model,'PERMISSION',array('EMPLOYEE'=>'EMPLOYEE', 'ADMINISTRATION'=>'ADMINISTRATION'), array('options'=>array($model->PERMISSION=>array('selected'=>true)))); ?>
					</p>
				</div>
			</div>
		</div>
		<div class="form-group row">
			<?php echo $form->labelEx($model,'SERVICE_BOOK_VOL', array('class'=>'col-sm-2 form-control-label')); ?>
			<div class="col-sm-10">
				<p class="form-control-static">
					<?php echo $form->textField($model,'SERVICE_BOOK_VOL',array('size'=>10,'maxlength'=>10, 'value'=>$model->SERVICE_BOOK_VOL)); ?>
				</p>
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
					<table id="LICTable" border="1">
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
									<td><input type="text" size="10" value="<?php echo $policy->POLICY_NO; ?>" disabled /></td>
									<td><input type="text" size="10" value="<?php echo $policy->AMOUNT; ?>" disabled/></td>
									<td><select disabled><option value="1" <?php echo ($policy->STATUS == 1) ? "selected" : "";?>>ACTIVE</option><option value="0" <?php echo ($policy->STATUS == 0) ? "selected" : "";?>>IN ACTIVE</option></select></td>
									<td></td>
									<td></td>
								</tr>
								<?php
							}
						?>
						<tr>
							<td><input type="text" size="10" name="Employee[LIC][0][POLICY_NO]"/></td>
							<td><input type="text" size="10" name="Employee[LIC][0][AMOUNT]"/></td>
							<td><select name="Employee[LIC][0][STATUS]"><option value="1">ACTIVE</option><option value="0">IN ACTIVE</option></select></td>
							<td><input type="button" id="delSubBillbutton" value="Delete" onclick="deleteRow(this)"/></td>
							<td><input type="button" id="addSubBillbutton" value="Add Policy" onclick="insRow()"/></td>
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
						<table id="LICTable" border="1" class="form-control-static">
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
								<td><input type="button" id="delSubBillbutton" value="Delete" onclick="deleteRow(this)"/></td>
								<td><input type="button" id="addSubBillbutton" value="Add Policy" onclick="insRow()"/></td>
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
	
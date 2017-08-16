<?php $master = Master::model()->findByPK(1); ?>
<style> input[type=text], select { width: 400px; line-height:20px; line-height:20px;} input[type=checkbox]{margin-right: 5px;}</style>

	<?php $form=$this->beginWidget('CActiveForm', array('id'=>'bill-form','enableAjaxValidation'=>false,)); ?>
		<input type="hidden" id="BILL_REGISTER_COUNT" value="<?php $RESULT = Yii::app()->db->createCommand("SELECT ID FROM tbl_bill_register ORDER BY ID DESC LIMIT 1")->queryRow(); echo $RESULT['ID'] ? $RESULT['ID'] : 0 ;?>">
		<input type="hidden" id="BILL_ENTRY_COUNT" name="Bill[BILL_ENTRY_COUNT]" value="0">
		<div class="form-group row">
			<?php echo $form->labelEx($model,'BILL_TYPE', array('class'=>'col-sm-2 form-control-label')); ?>
			<div class="col-sm-10">
				<p class="form-control-static">
					<?php echo $form->dropDownList($model,'BILL_TYPE',CHtml::listData(BillType::model()->findAll(), 'ID', 'TYPE'), array(
						'id'=>'slBillType',
						'ajax' => array(
						'type'=>'POST', 
						'url'=>CController::createUrl('Bill/GetSubType'), 
						'success'=>'js:function(data) {
								var content = "<option></option>";
								$("#Bill_BILL_SUB_TYPE").html(content + data);
								var bill = parseInt($("#slBillType").val());
								var bill_sub_type = parseInt($("#Bill_BILL_SUB_TYPE").val());
								if(bill == 1 || bill == 2 || bill == 8){
									$("#paybillinfo").show();
								}
								else{
									$("#paybillinfo").hide();
								}
								
								if(bill == 2 ){
									$("#npspaybillinfo").show();
								}
								else{
									$("#npspaybillinfo").hide();
								}
								
								if(bill == 3 ){
									$("#officeexpence").show();
								}
								else{
									$("#officeexpence").hide();
								}
								
				
							}'
						),
						'empty'=>array('0'=>'Select Bill Type'),
						'options' => array("'".$model->ID."'" => array('selected'=>true), 
							5=>array('disabled'=>'disabled' ),
							7=>array('disabled'=>'disabled' ),
							9=>array('disabled'=>'disabled' ),
							10=>array('disabled'=>'disabled' ),
							11=>array('disabled'=>'disabled' ),
							12=>array('disabled'=>'disabled' ),
							13=>array('disabled'=>'disabled' ),
							14=>array('disabled'=>'disabled' ),
							15=>array('disabled'=>'disabled' )),
						'disabled'=>Yii::app()->controller->action->id == 'update')); ?>
				</p>
			</div>
		</div>
		<div class="form-group row">
			<?php echo $form->labelEx($model,'BILL_SUB_TYPE', array('class'=>'col-sm-2 form-control-label')); ?>
			<div class="col-sm-10">
				<p class="form-control-static">
					<?php if(Yii::app()->controller->action->id == 'create'){
						echo $form->dropDownList($model,'BILL_SUB_TYPE',array(), array('disabled'=>Yii::app()->controller->action->id == 'update'));	
					}
					else if(Yii::app()->controller->action->id == 'update'){
						echo $form->dropDownList($model,'BILL_SUB_TYPE',$model->GetBillSubType($model->BILL_TYPE), array('disabled'=>Yii::app()->controller->action->id == 'update'));	
					}?>
				</p>
			</div>
		</div>
		<div class="form-group row">
			<label class="col-sm-2 form-control-label"></label>
			<div class="col-sm-10">
					<div id="other-salary-bills" style="display:none;background: #333;color: #FFF;padding: 10px;" >
						<span><?php echo $form->checkBox($model,'IS_ARREAR_BILL', array('id'=>'chkIsArrearBill')); ?> Arrear Bill</span>
						<span><?php echo $form->checkBox($model,'IS_CEA_BILL', array('id'=>'chkIsCEABill')); ?> Children Education Allowance Bill</span>
						<span><?php echo $form->checkBox($model,'IS_BONUS_BILL', array('id'=>'chkIsBonusBill')); ?> Bonus Bill</span>
						<span><?php echo $form->checkBox($model,'IS_UA_BILL', array('id'=>'chkIsUABill')); ?> Uniform Allowance Bill</span>
						<span><?php echo $form->checkBox($model,'IS_LTC_HTC_BILL', array('id'=>'chkIsLTCHTCBill')); ?> LTC/HTC Advances & Claims Bill</span>
					</div>
					<div id="nps-emp" class="small-container"  style="display:none;background: #CCC;padding: 10px;height: 300px;overflow-y: scroll;">
						<?php
							$employees = Employee::model()->findAllByAttributes(array('PENSION_TYPE'=>'NPS', 'IS_PERMANENT'=>1, 'IS_TRANSFERRED'=>0));
							foreach($employees as $employee){
								?>
									<input type="checkBox" name="Bill[Employee][NPS][]" value="<?php echo $employee->ID;?>"><span><?php echo $employee->NAME.", ".Designations::model()->findByPK($employee->DESIGNATION_ID_FK)->DESIGNATION;?></span><br/>
								<?php
							}
						?>
					</div>
					<div id="ops-emp"  class="small-container"  style="display:none;background: #CCC;padding: 10px;height: 300px;overflow-y: scroll;">
						<?php
							$employees = Employee::model()->findAllByAttributes(array('PENSION_TYPE'=>'OPS', 'IS_PERMANENT'=>1, 'IS_TRANSFERRED'=>0));
							foreach($employees as $employee){
								?>
									<input type="checkBox" name="Bill[Employee][OPS][]" value="<?php echo $employee->ID;?>"><span><?php echo $employee->NAME.", ".Designations::model()->findByPK($employee->DESIGNATION_ID_FK)->DESIGNATION;?></span><br/>
								<?php
							}
						?>
					</div>
					<div id="cea-emp" class="small-container"  style="display:none;background: #CCC;padding: 10px;height: 300px;overflow-y: scroll;">
						<?php
							$employees = Employee::model()->findAllByAttributes(array('IS_PERMANENT'=>1, 'IS_TRANSFERRED'=>0, 'IS_RETIRED'=>0));
							foreach($employees as $employee){
								?>
									<input type="checkBox" name="Bill[Employee][CEA][]" value="<?php echo $employee->ID;?>"><span><?php echo $employee->NAME.", ".Designations::model()->findByPK($employee->DESIGNATION_ID_FK)->DESIGNATION;?></span><br/>
								<?php
							}
						?>
					</div>
					<div id="bonus-emp" class="small-container"  style="display:none;background: #CCC;padding: 10px;height: 300px;overflow-y: scroll;">
						<?php
							$employees = Employee::model()->findAllByAttributes(array('IS_PERMANENT'=>1, 'BONUS_ELIGIBLE'=>1, 'IS_TRANSFERRED'=>0));
							foreach($employees as $employee){
								?>
									<input type="checkBox" name="Bill[Employee][BONUS][]" value="<?php echo $employee->ID;?>" checked><span><?php echo $employee->NAME.", ".Designations::model()->findByPK($employee->DESIGNATION_ID_FK)->DESIGNATION;?></span><br/>
								<?php
							}
						?>
					</div>
					<div id="ua-emp" class="small-container"  style="display:none;background: #CCC;padding: 10px;height: 300px;overflow-y: scroll;">
						<?php
							$employees = Employee::model()->findAllByAttributes(array('IS_PERMANENT'=>1, 'IS_TRANSFERRED'=>0, 'IS_RETIRED'=>0, 'UA_ELIGIBLE'=>1));
							foreach($employees as $employee){
								?>
									<input type="checkBox" name="Bill[Employee][UA][]" value="<?php echo $employee->ID;?>" checked><span><?php echo $employee->NAME.", ".Designations::model()->findByPK($employee->DESIGNATION_ID_FK)->DESIGNATION;?></span><br/>
								<?php
							}
						?>
					</div>
					<div id="medical-emp" class="small-container"  style="display:none;background: #CCC;padding: 10px;height: 300px;overflow-y: scroll;">
						<?php
							$employees = Employee::model()->findAllByAttributes(array('IS_PERMANENT'=>1, 'IS_TRANSFERRED'=>0, 'IS_RETIRED'=>0));
							foreach($employees as $employee){
								?>
									<input type="checkBox" name="Bill[Employee][MEDICAL][]" value="<?php echo $employee->ID;?>"><span><?php echo $employee->NAME.", ".Designations::model()->findByPK($employee->DESIGNATION_ID_FK)->DESIGNATION;?></span><br/>
								<?php
							}
						?>
					</div>
					<div id="ltc-htc-emp" class="small-container"  style="display:none;background: #CCC;padding: 10px;height: 300px;overflow-y: scroll;">
						<?php
							$employees = Employee::model()->findAllByAttributes(array('IS_PERMANENT'=>1, 'IS_TRANSFERRED'=>0, 'IS_RETIRED'=>0));
							foreach($employees as $employee){
								?>
									<input type="checkBox" name="Bill[Employee][HTC_LTC][]" value="<?php echo $employee->ID;?>" ><span><?php echo $employee->NAME.", ".Designations::model()->findByPK($employee->DESIGNATION_ID_FK)->DESIGNATION;?></span><br/>
								<?php
							}
						?>
					</div>
					<div id="dte-emp" class="small-container"  style="display:none;background: #CCC;padding: 10px;height: 300px;overflow-y: scroll;">
						<?php
							$employees = Employee::model()->findAllByAttributes(array('IS_PERMANENT'=>1, 'IS_TRANSFERRED'=>0, 'IS_RETIRED'=>0));
							foreach($employees as $employee){
								?>
									<input type="checkBox" name="Bill[Employee][DTE][]" value="<?php echo $employee->ID;?>" ><span><?php echo $employee->NAME.", ".Designations::model()->findByPK($employee->DESIGNATION_ID_FK)->DESIGNATION;?></span><br/>
								<?php
							}
						?>
					</div>
					<div id="wages-emp" class="small-container"  style="display:none;background: #CCC;padding: 10px;height: 300px;overflow-y: scroll;">
						<?php
							$employees = Employee::model()->findAllByAttributes(array('IS_PERMANENT'=>0, 'IS_TRANSFERRED'=>0, 'IS_RETIRED'=>0));
							foreach($employees as $employee){
								?>
									<input type="checkBox" name="Bill[Employee][WAGES][]" value="<?php echo $employee->ID;?>" ><span><?php echo $employee->NAME.", ".Designations::model()->findByPK($employee->DESIGNATION_ID_FK)->DESIGNATION;?></span><br/>
								<?php
							}
						?>
					</div>
			</div>
		</div>
		
		<?php
			if($model->BILL_SUB_TYPE == 23 || $model->BILL_SUB_TYPE == 24){
				if(Yii::app()->controller->action->id == 'update'){ 
				?>
					<div class="form-group row" id="UA_PERIOD">
						<?php echo $form->labelEx($model,'UA_PERIOD', array('class'=>'col-sm-2 form-control-label')); ?>
						<div class="col-sm-10">
							<p class="form-control-static">
								<?php echo $form->textField($model,'UA_PERIOD',array('size'=>40,'maxlength'=>100, 'disabled'=>Yii::app()->controller->action->id == 'update', 'value'=>$model->UA_PERIOD)); ?>
							</p>
						</div>
					</div>
				<?php } else { ?>
				<div class="form-group row" id="UA_PERIOD" style="display:none;">
					<?php echo $form->labelEx($model,'UA_PERIOD', array('class'=>'col-sm-2 form-control-label')); ?>
					<div class="col-sm-10">
						<p class="form-control-static">
							<?php echo $form->textField($model,'UA_PERIOD',array('size'=>40,'maxlength'=>100, 'disabled'=>Yii::app()->controller->action->id == 'update')); ?>
						</p>
					</div>
				</div>
				<?php }
			}
		?>
		
		<div class="form-group row">
			<?php echo $form->labelEx($model,'BILL_NO', array('class'=>'col-sm-2 form-control-label')); ?>
			<div class="col-sm-10">
				<p class="form-control-static">
					<?php echo $form->textField($model,'BILL_NO',array('size'=>40,'maxlength'=>100, 'disabled'=>Yii::app()->controller->action->id == 'update')); ?>
				</p>
			</div>
		</div>
		<div id="npspaybillinfo" style="display:none;">
			<div class="form-group row">
				<?php echo $form->labelEx($model,'NILL_BILL_NO', array('class'=>'col-sm-2 form-control-label')); ?>
				<div class="col-sm-10">
					<p class="form-control-static">
						<?php echo $form->textField($model,'NILL_BILL_NO',array('size'=>40,'maxlength'=>100)); ?>
					</p>
				</div>
			</div>
		</div>
		<div id="paybillinfo" style="display:none;">
			<div class="form-group row">
				<?php echo $form->labelEx($model,'LIC_DED_BILL_NO', array('class'=>'col-sm-2 form-control-label')); ?>
				<div class="col-sm-10">
					<p class="form-control-static">
						<?php echo $form->textField($model,'LIC_DED_BILL_NO',array('size'=>40,'maxlength'=>100)); ?>
					</p>
				</div>
			</div>
			<div class="form-group row">
				<?php echo $form->labelEx($model,'PT_DED_BILL_NO', array('class'=>'col-sm-2 form-control-label')); ?>
				<div class="col-sm-10">
					<p class="form-control-static">
						<?php echo $form->textField($model,'PT_DED_BILL_NO',array('size'=>40,'maxlength'=>100)); ?>
					</p>
				</div>
			</div>
		</div>
		<div class="form-group row">
			<?php echo $form->labelEx($model,'BILL_TITLE', array('class'=>'col-sm-2 form-control-label')); ?>
			<div class="col-sm-10">
				<p class="form-control-static">
					<?php echo $form->textArea($model,'BILL_TITLE',array('rows'=>6, 'cols'=>50, 'maxlength'=>500, 'disabled'=>Yii::app()->controller->action->id == 'update', 'id'=>'txtBillTitle')); ?>
				</p>
			</div>
		</div>
		<div class="form-group row">
			<?php echo $form->labelEx($model,'BILL_AMOUNT', array('class'=>'col-sm-2 form-control-label')); ?>
			<div class="col-sm-10">
				<p class="form-control-static">
					<?php echo $form->textField($model,'BILL_AMOUNT',array('size'=>20,'maxlength'=>20, 'disabled'=>Yii::app()->controller->action->id == 'update')); ?>
				</p>
			</div>
		</div>
		<div class="form-group row">
			<?php echo $form->labelEx($model,'FILE_NO', array('class'=>'col-sm-2 form-control-label')); ?>
			<div class="col-sm-10">
				<p class="form-control-static">
					<?php echo $form->textField($model,'FILE_NO',array('size'=>40,'maxlength'=>100, 'disabled'=>Yii::app()->controller->action->id == 'update')); ?>
				</p>
			</div>
		</div>

		<div id="officeexpence" style="<?php
			if($model->BILL_TYPE == 3) echo "display:block;";
			else echo "display:none;";
		?>">
			
			<?php 
				if(Yii::app()->controller->action->id == 'update'){ 
					if($model->BILL_TYPE == 3){
			?>
				<div class="form-group row">
					<?php echo $form->labelEx($model,'OE_IT_DED', array('class'=>'col-sm-2 form-control-label')); ?>
					<div class="col-sm-10">
						<p class="form-control-static">
							<?php echo $form->textField($model,'OE_IT_DED',array('size'=>40,'maxlength'=>100, 'value'=>OEBillDetails::model()->find('BILL_ID_FK='.$model->ID)->IT_DED, 'disabled'=>true)); ?>
						</p>
					</div>
				</div>
				<div class="form-group row">
					<?php echo $form->labelEx($model,'OE_NET_AMOUNT', array('class'=>'col-sm-2 form-control-label')); ?>
					<div class="col-sm-10">
						<p class="form-control-static">
							<?php echo $form->textField($model,'OE_NET_AMOUNT',array('size'=>40,'maxlength'=>100, 'value'=>OEBillDetails::model()->find('BILL_ID_FK='.$model->ID)->NET_AMOUNT, 'disabled'=>true)); ?>
						</p>
					</div>
				</div>
				<div class="form-group row">
					<?php echo $form->labelEx($model,'VENDOR_ID', array('class'=>'col-sm-2 form-control-label')); ?>
					<div class="col-sm-10">
						<p class="form-control-static">
							<?php echo $form->dropDownList($model,'VENDOR_ID',CHtml::listData(Vendors::model()->findAll(), 'ID', 'NAME'), array('empty'=>array('0'=>'Select Vendor'), 'disabled'=>Yii::app()->controller->action->id == 'update')); ?>
						</p>
					</div>
					<?php echo $form->error($model,'VENDOR_ID'); ?>
				</div>
				<div class="form-group row">
					<label class="col-sm-2 form-control-label">Bills</label>
					<style> #SubBillTable input[type=text] {width: 150px;} </style>
					<div class="col-sm-10">
						<p class="form-control-static">
							<table id="SubBillTable" border="1">
								<tr>
									<td>Bill No</td>
									<td>Bill Date</td>
									<td>Amount</td>
								</tr>
								<?php
									$OEBills = new OEBills;
									$bills = $OEBills->findAllByAttributes(array('BILL_ID'=>$model->ID));
									foreach($bills as $bill){
										?>
										<tr>
											<td><input type="text" size="10" class="bills_number" value="<?php echo $bill->NUMBER; ?>" disabled="disabled"/></td>
											<td><input type="text" size="10" value="<?php echo date('Y-m-d', strtotime($bill->DATE)); ?>" disabled="disabled"/></td>
											<td><input type="text" size="10" class="bills_amount" value="<?php echo $bill->AMOUNT; ?>" disabled="disabled"/></td>
										</tr>
										<?php
									}
								?>
								
							</table>
						</p>
					</div>
				</div>
			<?php }
			} else {?>
				<div class="form-group row">
					<?php echo $form->labelEx($model,'OE_IT_DED', array('class'=>'col-sm-2 form-control-label')); ?>
					<div class="col-sm-10">
						<p class="form-control-static">
							<?php echo $form->textField($model,'OE_IT_DED',array('size'=>40,'maxlength'=>100)); ?>
						</p>
					</div>
				</div>
				<div class="form-group row">
					<?php echo $form->labelEx($model,'OE_NET_AMOUNT', array('class'=>'col-sm-2 form-control-label')); ?>
					<div class="col-sm-10">
						<p class="form-control-static">
							<?php echo $form->textField($model,'OE_NET_AMOUNT',array('size'=>40,'maxlength'=>100)); ?>
						</p>
					</div>
				</div>
				<div class="form-group row">
					<?php echo $form->labelEx($model,'VENDOR_ID', array('class'=>'col-sm-2 form-control-label')); ?>
					<div class="col-sm-10">
						<p class="form-control-static">
							<?php echo $form->dropDownList($model,'VENDOR_ID',CHtml::listData(Vendors::model()->findAll(), 'ID', 'NAME'), array('empty'=>array('0'=>'Select Vendor'), 'disabled'=>Yii::app()->controller->action->id == 'update')); ?>
						</p>
					</div>
				</div>
				<div class="form-group row">
					<label class="col-sm-2 form-control-label">Bills</label>
					<style> #SubBillTable input[type=text] {width: 150px;}</style>
					<div class="col-sm-10">
						<p class="form-control-static">
							<table id="SubBillTable" border="1">
								<tr>
									<td>Bill No</td>
									<td>Bill Date</td>
									<td>Amount</td>
								</tr>
								<tr>
									<td><input type="text" size="10" class="bills_number" name="Bill[OE_BILL][0][BILL_NO]"/></td>
									<td><input type="date" size="10" name="Bill[OE_BILL][0][BILL_DATE]"/></td>
									<td><input type="text" size="10" class="bills_amount" name="Bill[OE_BILL][0][BILL_AMOUNT]"/></td>
									<td><input type="button" id="delSubBillbutton" value="Delete" onclick="deleteRow(this)"/></td>
									<td><input type="button" id="addSubBillbutton" value="Add Bill" onclick="insRow()"/></td>
								</tr>
							</table>
						</p>
					</div>
				</div>
			<?php } 
			?>
		</div>
		<div id="ceabills" style="<?php
			if($model->IS_CEA_BILL == 1) echo "display:block;";
			else echo "display:none;";
		?>">
			
			<?php 
				if(Yii::app()->controller->action->id == 'update'){ 
					if($model->IS_CEA_BILL ==1){
					?>
				<div class="form-group row">
					<label class="col-sm-2 form-control-label">Details</label>
					<style> #CEASubBillTable input[type=text] {width: 150px;} </style>
					<div class="col-sm-10">
						<p class="form-control-static">
							<table id="CEASubBillTable" border="1">
								<tr>
									<td>Name of Child</td>
									<td>Date of Birth</td>
									<td>Class</td>
									<td>School</td>
									<td>Amount</td>
									<td>Remarks</td>
								</tr>
								<?php
									$CEABillDetails = new CEABillDetails;
									$bills = $CEABillDetails->findAllByAttributes(array('BILL_ID'=>$model->ID));
									foreach($bills as $bill){
										?>
										<tr>
											<td><input type="text" size="10" value="<?php echo $bill->NAME; ?>" disabled="disabled"/></td>
											<td><input type="text" size="10" value="<?php echo date('Y-m-d', strtotime($bill->DOB)); ?>" disabled="disabled"/></td>
											<td><input type="text" size="10" value="<?php echo $bill->CLASS; ?>" disabled="disabled"/></td>
											<td><input type="text" size="10" value="<?php echo $bill->SCHOOL; ?>" disabled="disabled"/></td>
											<td><input type="text" size="10" class="cea_bills_amount" value="<?php echo $bill->AMOUNT; ?>" disabled="disabled"/></td>
											<td><input type="text" size="10" value="<?php echo $bill->REMARKS; ?>" disabled="disabled"/></td>
										</tr>
										<?php
									}
								?>
								
							</table>
						</p>
					</div>
				</div>
			<?php 
					}
			} else{?>
				<div class="form-group row">
					<label class="col-sm-2 form-control-label">Bills</label>
					<style> #SubBillTable input[type=text] {width: 150px;}</style>
					<div class="col-sm-10">
						<p class="form-control-static">
							<table id="CEASubBillTable" border="1">
								<tr>
									<td>Name of Child</td>
									<td>Date of Birth</td>
									<td>Class</td>
									<td>School</td>
									<td>Amount</td>
									<td>Remarks</td>
								</tr>
								<tr>
									<td><input type="text" style="width:150px;" name="Bill[CEA_BILLS][0][NAME]"/></td>
									<td><input type="date" style="width:150px;" name="Bill[CEA_BILLS][0][DOB]"/></td>
									<td><input type="text" style="width:150px;" name="Bill[CEA_BILLS][0][CLASS]"/></td>
									<td><input type="text" style="width:150px;" name="Bill[CEA_BILLS][0][SCHOOL]"/></td>
									<td><input type="text" style="width:150px;" class="cea_bills_amount" name="Bill[CEA_BILLS][0][AMOUNT]"/></td>
									<td><input type="text" style="width:150px;" name="Bill[CEA_BILLS][0][REMARKS]"/></td>
									<td><input type="button" id="delSubBillbutton" value="Delete" onclick="deleteCEARow(this)"/></td>
									<td><input type="button" id="addSubBillbutton" value="Add Detail" onclick="insCEARow()"/></td>
								</tr>
							</table>
						</p>
					</div>
				</div>
			<?php } 
			?>
		</div>
		<div class="form-group row">
			<?php echo $form->labelEx($model,'MONTH', array('class'=>'col-sm-2 form-control-label')); ?>
			<div class="col-sm-10">
				<p class="form-control-static">
					<?php echo $form->dropDownList($model,'MONTH',array('1'=>'January',
																'2'=>'February',
																'3'=>'March',
																'4'=>'April',
																'5'=>'May',
																'6'=>'June',
																'7'=>'July',
																'8'=>'August',
																'9'=>'September',
																'10'=>'October',
																'11'=>'November',
																'12'=>'December',),
																array(
																	'options' => array(ltrim(date('m'), '0') => array('selected'=>true)),
																	'disabled'=>Yii::app()->controller->action->id == 'update'
																)); ?>
				</p>
			</div>
		</div>
		<div class="form-group row">
			<?php echo $form->labelEx($model,'YEAR', array('class'=>'col-sm-2 form-control-label')); ?>
			<div class="col-sm-10">
				<p class="form-control-static">
					<?php echo $form->dropDownList($model,'YEAR',array('2016'=>'2016', '2017'=>'2017', '2018'=>'2018', '2019'=>'2019', '2020'=>'2020', '2021'=>'2021'), array(
						'disabled'=>Yii::app()->controller->action->id == 'update',
						'options' => array(date('Y') => array('selected'=>true)))); ?>
				</p>
			</div>
		</div>
		<div class="form-group row">
			<?php echo $form->labelEx($model,'CREATION_DATE', array('class'=>'col-sm-2 form-control-label')); ?>
			<div class="col-sm-10">
				<p class="form-control-static">
					<?php 
						$this->widget('zii.widgets.jui.CJuiDatePicker',array(
							'model'=>$model,
							'attribute'=>'CREATION_DATE',
							'options'=>array(
								'dateFormat'=>'yy-mm-dd',
								'showAnim'=>'fold',
							),
							'htmlOptions'=>array(
								'style'=>'height:20px;',
								'disabled'=>Yii::app()->controller->action->id == 'update',
								'value'=>date('Y-m-d')
							),
						));	?>
				</p>
			</div>
		</div>
		
		<?php if(Yii::app()->controller->action->id == 'update') { ?>
		<div class="form-group row">
			<?php echo $form->labelEx($model,'EXPENDITURE_INC_BILL', array('class'=>'col-sm-2 form-control-label')); ?>
			<div class="col-sm-10">
				<p class="form-control-static">
					<?php if(AppropiationRegister::model()->exists('BILL_NO='.$model->ID)) { ?>
					<?php echo $form->textField($model,'EXPENDITURE_INC_BILL',array('size'=>20,'maxlength'=>20, 'disabled'=>'disabled', 'value'=>AppropiationRegister::model()->findByAttributes(array('BILL_NO'=>$model->ID))->EXPENDITURE_INC_BILL)); ?>
					<?php } else {?>
					<?php echo $form->textField($model,'EXPENDITURE_INC_BILL',array('size'=>20,'maxlength'=>20, 'disabled'=>'disabled', 'value'=>0)); ?>
					<?php } ?>
				</p>
			</div>
		</div>
		<div class="form-group row">
			<?php echo $form->labelEx($model,'APPROPIATION_BALANCE', array('class'=>'col-sm-2 form-control-label')); ?>
			<div class="col-sm-10">
				<p class="form-control-static">
					<?php if(AppropiationRegister::model()->exists('BILL_NO='.$model->ID)) { ?>
					<?php echo $form->textField($model,'APPROPIATION_BALANCE',array('size'=>20,'maxlength'=>20, 'disabled'=>'disabled', 'value'=>AppropiationRegister::model()->findByAttributes(array('BILL_NO'=>$model->ID))->BALANCE)); ?>
					<?php } else {?>
					<?php echo $form->textField($model,'APPROPIATION_BALANCE',array('size'=>20,'maxlength'=>20, 'disabled'=>'disabled', 'value'=>0)); ?>
					<?php } ?>
				</p>
			</div>
		</div>
		<?php } ?>
		<div class="form-group row">
			<?php echo $form->labelEx($model,'PFMS_BILL_NO', array('class'=>'col-sm-2 form-control-label')); ?>
			<div class="col-sm-10">
				<p class="form-control-static">
					<?php echo $form->textField($model,'PFMS_BILL_NO',array('size'=>40,'maxlength'=>100)); ?>
				</p>
			</div>
		</div>
		<div class="form-group row">
			<?php echo $form->labelEx($model,'CER_NO', array('class'=>'col-sm-2 form-control-label')); ?>
			<div class="col-sm-10">
				<p class="form-control-static">
					<?php echo $form->textField($model,'CER_NO',array('size'=>50,'maxlength'=>50, 'disabled'=>Yii::app()->controller->action->id == 'update')); ?>
				</p>
			</div>
		</div>
		<div class="form-group row">
			<?php echo $form->labelEx($model,'PFMS_STATUS', array('class'=>'col-sm-2 form-control-label')); ?>
			<div class="col-sm-10">
				<p class="form-control-static">
					<?php echo $form->dropDownList($model,'PFMS_STATUS',array('Generated'=>'Generated', 'Passed'=>'Passed',)); ?>
				</p>
			</div>
		</div>
		<div class="form-group row">
			<label class="col-sm-2 form-control-label"></label>
			<div class="col-sm-10">
				<p class="form-control-static">
					<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class'=>'btn btn-success', 'onsubmit'=>'return validateBillForm();', 'onclick'=>'return validateBillForm();')); ?>
					<?php echo CHtml::resetButton('Cancel', array('class'=>'btn btn-danger')); ?>
				</p>
			</div>
		</div>
	<?php $this->endWidget(); ?>
<script>
	var FIANANCIAL_YEAR = '<?php echo FinancialYears::model()->find('STATUS=1')->NAME; ?>',
		DEPT_NAME = '<?php echo $master->DEPT_NAME; ?>',
		MONTH_YEAR = '<?php echo date('M-Y', strtotime(date('Y-m'))); ?>',
		TODAY_DATE = '<?php echo date('d/m/Y')?>',
		PREVIOUS_MONTH_YEAR = '<?php echo date('M-Y', strtotime(date('Y-m')." -1 month")); ?>',
		CURRENT_MONTH_YEAR = '<?php echo date('M-Y'); ?>';
		
		
	
</script>
<script type="text/javascript" src="js/bill-form.js"></script>

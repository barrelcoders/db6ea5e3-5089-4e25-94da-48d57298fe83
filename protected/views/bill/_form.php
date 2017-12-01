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
					<input type="hidden" name="Bill[IS_SALARY_BILL]" id="IS_SALARY_BILL" value="0"/>
					<input type="hidden" name="Bill[IS_ARREAR_BILL]" id="IS_ARREAR_BILL" value="0"/>
					<input type="hidden" name="Bill[IS_DA_ARREAR_BILL]" id="IS_DA_ARREAR_BILL" value="0"/>
					<input type="hidden" name="Bill[IS_BONUS_BILL]" id="IS_BONUS_BILL" value="0"/>
					<input type="hidden" name="Bill[IS_UA_BILL]" id="IS_UA_BILL" value="0"/>
					<input type="hidden" name="Bill[IS_CEA_BILL]" id="IS_CEA_BILL" value="0"/>
					<input type="hidden" name="Bill[IS_EL_ENCASHMENT_BILL]" id="IS_EL_ENCASHMENT_BILL" value="0"/>
					<input type="hidden" name="Bill[IS_LTC_ADVANCE_BILL]"  id="IS_LTC_ADVANCE_BILL" value="0"/>
					<input type="hidden" name="Bill[IS_LTC_CLAIM_BILL]" id="IS_LTC_CLAIM_BILL" value="0"/>
					<input type="hidden" name="Bill[IS_RECOVERY_BILL]" id="IS_RECOVERY_BILL" value="0"/>
				</p>
			</div>
		</div>
		<div class="form-group row">
			<label class="col-sm-2 form-control-label"></label>
			<div class="col-sm-10" id="employee-selection-lists">
				<?php if(Yii::app()->controller->action->id == 'update'){?>
					<?php if($model->IS_NPS_PAY_BILL || $model->IS_NPS_ARREAR_BILL || $model->IS_NPS_DA_ARREAR_BILL || $model->IS_NPS_CEA_BILL || $model->IS_NPS_LTC_ADVANCE_BILL
						|| $model->IS_NPS_LTC_CLAIM_BILL || $model->IS_NPS_EL_ENCASHMENT_BILL || $model->IS_NPS_RECOVERY_BILL ){ ?>
						<div id="nps-emp" class="small-container"  style="display:none;">
							<div style="background: #333;padding: 5px;">
								<input type="text" class="nps-list-search" size="100" placeholder="SEARCH NAME" onkeyup="search(this, 'nps-emp');"/>
								<span style="float: right;color: #FFF;"><input type="checkBox" class="nps-select-all select-all" onchange="selectList(this, 'nps-emp');" checked> SELECT ALL</span>
							</div>
							<ul class="list">
							<?php
								$employees = Employee::model()->findAllByAttributes(array('PENSION_TYPE'=>'NPS', 'IS_PERMANENT'=>1));
								$BillEmployees = explode(",", BillEmployees::model()->findByAttributes(array('BILL_ID'=>$model->ID))->EMPLOYEE_ID);
								foreach($employees as $employee){
									$class="";
									$status="";
									$checkedString="";
									
									if (in_array($employee->ID, $BillEmployees)){
										$checkedString = "checked";
									}
									if($employee->IS_TRANSFERRED == 1){
										$class="TRANSFERRED";
										$status="TRANSFERRED on ".date("d-m-Y", strtotime($employee->DEPT_RELIEF_DATE))." to ".$employee->TRANSFERED_TO;
									}
									if($employee->IS_RETIRED == 1){
										$class="RETIRED";
										$status="RETIRED on ".date("d-m-Y", strtotime($employee->ORG_RETIRE_DATE));
									}
									if($employee->IS_SUSPENDED == 1){
										$class="SUSPENDED";
										$status="SUSPENDED on ".date("d-m-Y", strtotime($employee->SUSPENSION_DATE));
									}
									?>
										<li class="<?php echo $class;?>">
											<input type="checkBox" name="Bill[Employee][NPS][]" value="<?php echo $employee->ID;?>" <?php echo $checkedString;?>>
											<span><?php echo $employee->NAME.", ".Designations::model()->findByPK($employee->DESIGNATION_ID_FK)->DESIGNATION;?></span>
											<span class="status"><?php echo $status;?></span>
										</li>
									<?php
								}
							?>
							</ul>
						</div>
					<?php } ?>
					<?php if($model->IS_OPS_PAY_BILL || $model->IS_OPS_ARREAR_BILL || $model->IS_OPS_DA_ARREAR_BILL || $model->IS_OPS_CEA_BILL || $model->IS_OPS_LTC_ADVANCE_BILL
						|| $model->IS_OPS_LTC_CLAIM_BILL || $model->IS_OPS_EL_ENCASHMENT_BILL || $model->IS_OPS_RECOVERY_BILL ){ ?>
						<div id="ops-emp"  class="small-container"  style="display:none;">
							<div style="background: #333;padding: 5px;">
								<input type="text" class="ops-list-search" size="100" placeholder="SEARCH NAME" onkeyup="search(this, 'ops-emp');"/><span style="float: right;color: #FFF;"><input type="checkBox" class="ops-select-all select-all" onchange="selectList(this, 'ops-emp');"  checked> SELECT ALL</span>
							</div>
							<ul class="list">
							<?php
								$employees = Employee::model()->findAllByAttributes(array('PENSION_TYPE'=>'OPS', 'IS_PERMANENT'=>1));
								$BillEmployees = explode(",", BillEmployees::model()->findByAttributes(array('BILL_ID'=>$model->ID))->EMPLOYEE_ID);
								foreach($employees as $employee){
									$class="";
									$status="";
									$checkedString="";
									
									if (in_array($employee->ID, $BillEmployees)){
										$checkedString = "checked";
									}
									if($employee->IS_TRANSFERRED == 1){
										$class="TRANSFERRED";
										$status="TRANSFERRED on ".date("d-m-Y", strtotime($employee->DEPT_RELIEF_DATE))." to ".$employee->TRANSFERED_TO;
									}
									if($employee->IS_RETIRED == 1){
										$class="RETIRED";
										$status="RETIRED on ".date("d-m-Y", strtotime($employee->ORG_RETIRE_DATE));
									}
									if($employee->IS_SUSPENDED == 1){
										$class="SUSPENDED";
										$status="SUSPENDED on ".date("d-m-Y", strtotime($employee->SUSPENSION_DATE));
									}
									?>
										<li class="<?php echo $class;?>">
											<input type="checkBox" name="Bill[Employee][OPS][]" value="<?php echo $employee->ID;?>" <?php echo $checkedString;?>>
											<span><?php echo $employee->NAME.", ".Designations::model()->findByPK($employee->DESIGNATION_ID_FK)->DESIGNATION;?></span>
											<span class="status"><?php echo $status;?></span>
										</li>
									<?php
								}
							?>
							</ul>
						</div>
					<?php } ?>	
					<?php if($model->IS_NPS_BONUS_BILL){ ?>
						<div id="bonus-nps-emp" class="small-container"  style="display:none;">
							<div style="background: #333;padding: 5px;">
								<input type="text" class="bonus-nps-list-search" size="100" placeholder="SEARCH NAME" onkeyup="search(this, 'bonus-nps-emp');"/><span style="float: right;color: #FFF;"><input type="checkBox" class="bonus-nps-select-all select-all" onchange="selectList(this, 'bonus-nps-emp');"  checked> SELECT ALL</span>
							</div>
							<ul class="list">
							<?php
								$employees = Employee::model()->findAllByAttributes(array('PENSION_TYPE'=>'NPS', 'IS_PERMANENT'=>1, 'BONUS_ELIGIBLE'=>1));
								$BillEmployees = explode(",", BillEmployees::model()->findByAttributes(array('BILL_ID'=>$model->ID))->EMPLOYEE_ID);
								foreach($employees as $employee){
									$class="";
									$status="";
									$checkedString="";
									
									if (in_array($employee->ID, $BillEmployees)){
										$checkedString = "checked";
									}
									if($employee->IS_TRANSFERRED == 1){
										$class="TRANSFERRED";
										$status="TRANSFERRED on ".date("d-m-Y", strtotime($employee->DEPT_RELIEF_DATE))." to ".$employee->TRANSFERED_TO;
									}
									if($employee->IS_RETIRED == 1){
										$class="RETIRED";
										$status="RETIRED on ".date("d-m-Y", strtotime($employee->ORG_RETIRE_DATE));
									}
									if($employee->IS_SUSPENDED == 1){
										$class="SUSPENDED";
										$status="SUSPENDED on ".date("d-m-Y", strtotime($employee->SUSPENSION_DATE));
									}
									?>
										<li class="<?php echo $class;?>">
											<input type="checkBox" name="Bill[Employee][NPS_BONUS][]" value="<?php echo $employee->ID;?>" <?php echo $checkedString;?>>
											<span><?php echo $employee->NAME.", ".Designations::model()->findByPK($employee->DESIGNATION_ID_FK)->DESIGNATION;?></span>
											<span class="status"><?php echo $status;?></span>
										</li>
									<?php
								}
							?>
							</ul>
						</div>
					<?php } ?>	
					<?php if($model->IS_OPS_BONUS_BILL){ ?>
						<div id="bonus-ops-emp"  class="small-container"  style="display:none;">
							<div style="background: #333;padding: 5px;">
								<input type="text" class="bonus-ops-list-search" size="100" placeholder="SEARCH NAME" onkeyup="search(this, 'bonus-ops-emp');"/><span style="float: right;color: #FFF;"><input type="checkBox" class="bonus-ops-select-all select-al" onchange="selectList(this, 'bonus-ops-emp');"  checked> SELECT ALL</span>
							</div>
							<ul class="list">
							<?php
								$employees = Employee::model()->findAllByAttributes(array('PENSION_TYPE'=>'OPS', 'IS_PERMANENT'=>1, 'BONUS_ELIGIBLE'=>1));
								$BillEmployees = explode(",", BillEmployees::model()->findByAttributes(array('BILL_ID'=>$model->ID))->EMPLOYEE_ID);
								foreach($employees as $employee){
									$class="";
									$status="";
									$checkedString="";
									
									if (in_array($employee->ID, $BillEmployees)){
										$checkedString = "checked";
									}
									if($employee->IS_TRANSFERRED == 1){
										$class="TRANSFERRED";
										$status="TRANSFERRED on ".date("d-m-Y", strtotime($employee->DEPT_RELIEF_DATE))." to ".$employee->TRANSFERED_TO;
									}
									if($employee->IS_RETIRED == 1){
										$class="RETIRED";
										$status="RETIRED on ".date("d-m-Y", strtotime($employee->ORG_RETIRE_DATE));
									}
									if($employee->IS_SUSPENDED == 1){
										$class="SUSPENDED";
										$status="SUSPENDED on ".date("d-m-Y", strtotime($employee->SUSPENSION_DATE));
									}
									?>
										<li class="<?php echo $class;?>">
											<input type="checkBox" name="Bill[Employee][OPS_BONUS][]" value="<?php echo $employee->ID;?>" <?php echo $checkedString;?>>
											<span><?php echo $employee->NAME.", ".Designations::model()->findByPK($employee->DESIGNATION_ID_FK)->DESIGNATION;?></span>
											<span class="status"><?php echo $status;?></span>
										</li>
									<?php
								}
							?>
							</ul>
						</div>
					<?php } ?>
					<?php if($model->IS_UA_BILL){ ?>
						<div id="ua-emp" class="small-container"  style="display:none;">
							<div style="background: #333;padding: 5px;">
								<input type="text" class="ua-list-search" size="100" placeholder="SEARCH NAME" onkeyup="search(this, 'ua-emp');"/><span style="float: right;color: #FFF;"><input type="checkBox" class="ua-select-all select-al" onchange="selectList(this, 'ua-emp');"  checked> SELECT ALL</span>
							</div>
							<ul class="list">
							<?php
								$employees = Employee::model()->findAllByAttributes(array('IS_PERMANENT'=>1, 'UA_ELIGIBLE'=>1));
								$BillEmployees = explode(",", BillEmployees::model()->findByAttributes(array('BILL_ID'=>$model->ID))->EMPLOYEE_ID);
								foreach($employees as $employee){
									$class="";
									$status="";
									$status="";
									$checkedString="";
									
									if (in_array($employee->ID, $BillEmployees)){
										$checkedString = "checked";
									}
									if($employee->IS_TRANSFERRED == 1){
										$class="TRANSFERRED";
										$status="TRANSFERRED on ".date("d-m-Y", strtotime($employee->DEPT_RELIEF_DATE))." to ".$employee->TRANSFERED_TO;
									}
									if($employee->IS_RETIRED == 1){
										$class="RETIRED";
										$status="RETIRED on ".date("d-m-Y", strtotime($employee->ORG_RETIRE_DATE));
									}
									if($employee->IS_SUSPENDED == 1){
										$class="SUSPENDED";
										$status="SUSPENDED on ".date("d-m-Y", strtotime($employee->SUSPENSION_DATE));
									}
									?>
										<li class="<?php echo $class;?>">
											<input type="checkBox" name="Bill[Employee][UA][]" value="<?php echo $employee->ID;?>" <?php echo $checkedString;?>>
											<span><?php echo $employee->NAME.", ".Designations::model()->findByPK($employee->DESIGNATION_ID_FK)->DESIGNATION;?></span>
											<span class="status"><?php echo $status;?></span>
										</li>
									<?php
								}
							?>
							</ul>
						</div>
					<?php } ?>
					<?php if($model->IS_MEDICAL_BILL){ ?>
						<div id="medical-emp" class="small-container"  style="display:none;">
							<div style="background: #333;padding: 5px;">
								<input type="text" class="medical-list-search" size="100" placeholder="SEARCH NAME" onkeyup="search(this, 'medical-emp');"/><span style="float: right;color: #FFF;"><input type="checkBox" class="medical-select-all select-al" onchange="selectList(this, 'medical-emp');"  checked> SELECT ALL</span>
							</div>
							<ul class="list">
							<?php
								$employees = Employee::model()->findAllByAttributes(array('IS_PERMANENT'=>1));
								$BillEmployees = explode(",", BillEmployees::model()->findByAttributes(array('BILL_ID'=>$model->ID))->EMPLOYEE_ID);
								foreach($employees as $employee){
									$class="";
									$status="";
									$checkedString="";
									
									if (in_array($employee->ID, $BillEmployees)){
										$checkedString = "checked";
									}
									if($employee->IS_TRANSFERRED == 1){
										$class="TRANSFERRED";
										$status="TRANSFERRED on ".date("d-m-Y", strtotime($employee->DEPT_RELIEF_DATE))." to ".$employee->TRANSFERED_TO;
									}
									if($employee->IS_RETIRED == 1){
										$class="RETIRED";
										$status="RETIRED on ".date("d-m-Y", strtotime($employee->ORG_RETIRE_DATE));
									}
									if($employee->IS_SUSPENDED == 1){
										$class="SUSPENDED";
										$status="SUSPENDED on ".date("d-m-Y", strtotime($employee->SUSPENSION_DATE));
									}
									?>
										<li class="<?php echo $class;?>">
											<input type="checkBox" name="Bill[Employee][MEDICAL][]" value="<?php echo $employee->ID;?>" <?php echo $checkedString;?>>
											<span><?php echo $employee->NAME.", ".Designations::model()->findByPK($employee->DESIGNATION_ID_FK)->DESIGNATION;?></span>
											<span class="status"><?php echo $status;?></span>
										</li>
									<?php
								}
							?>
							</ul>
						</div>
					<?php } ?>
					<?php if($model->IS_DTE_BILL){ ?>
						<div id="dte-emp" class="small-container"  style="display:none;">
							<div style="background: #333;padding: 5px;">
								<input type="text" class="dte-list-search" size="100" placeholder="SEARCH NAME" onkeyup="search(this, 'dte-emp');"/><span style="float: right;color: #FFF;"><input type="checkBox" class="dte-select-all select-al" onchange="selectList(this, 'dte-emp');"  checked> SELECT ALL</span>
							</div>
							<ul class="list">
							<?php
								$employees = Employee::model()->findAllByAttributes(array('IS_PERMANENT'=>1));
								$BillEmployees = explode(",", BillEmployees::model()->findByAttributes(array('BILL_ID'=>$model->ID))->EMPLOYEE_ID);
								foreach($employees as $employee){
									$class="";
									$status="";
									$checkedString="";
									
									if (in_array($employee->ID, $BillEmployees)){
										$checkedString = "checked";
									}
									if($employee->IS_TRANSFERRED == 1){
										$class="TRANSFERRED";
										$status="TRANSFERRED on ".date("d-m-Y", strtotime($employee->DEPT_RELIEF_DATE))." to ".$employee->TRANSFERED_TO;
									}
									if($employee->IS_RETIRED == 1){
										$class="RETIRED";
										$status="RETIRED on ".date("d-m-Y", strtotime($employee->ORG_RETIRE_DATE));
									}
									if($employee->IS_SUSPENDED == 1){
										$class="SUSPENDED";
										$status="SUSPENDED on ".date("d-m-Y", strtotime($employee->SUSPENSION_DATE));
									}
									?>
										<li class="<?php echo $class;?>">
											<input type="checkBox" name="Bill[Employee][DTE][]" value="<?php echo $employee->ID;?>"  <?php echo $checkedString;?>>
											<span><?php echo $employee->NAME.", ".Designations::model()->findByPK($employee->DESIGNATION_ID_FK)->DESIGNATION;?></span>
											<span class="status"><?php echo $status;?></span>
										</li>
									<?php
								}
							?>
							</ul>
						</div>
					<?php } ?>
					<?php if($model->IS_WAGES_PAY_BILL || $model->IS_WAGES_ARREAR_BILL || $model->IS_WAGES_DA_ARREAR_BILL) {?>
						<div id="wages-emp" class="small-container"  style="display:none;">
							<div style="background: #333;padding: 5px;">
								<input type="text" class="wages-list-search" size="100" placeholder="SEARCH NAME" onkeyup="search(this, 'wages-emp');"/><span style="float: right;color: #FFF;"><input type="checkBox" class="wages-select-all select-al" onchange="selectList(this, 'wages-emp');"  checked> SELECT ALL</span>
							</div>
							<ul class="list">
							<?php
								$employees = Employee::model()->findAllByAttributes(array('IS_PERMANENT'=>0));
								$BillEmployees = explode(",", BillEmployees::model()->findByAttributes(array('BILL_ID'=>$model->ID))->EMPLOYEE_ID);
								foreach($employees as $employee){
									$class="";
									$status="";
									$checkedString="";
									
									if (in_array($employee->ID, $BillEmployees)){
										$checkedString = "checked";
									}
									if($employee->IS_TRANSFERRED == 1){
										$class="TRANSFERRED";
										$status="TRANSFERRED on ".date("d-m-Y", strtotime($employee->DEPT_RELIEF_DATE))." to ".$employee->TRANSFERED_TO;
									}
									if($employee->IS_RETIRED == 1){
										$class="RETIRED";
										$status="RETIRED on ".date("d-m-Y", strtotime($employee->ORG_RETIRE_DATE));
									}
									if($employee->IS_SUSPENDED == 1){
										$class="SUSPENDED";
										$status="SUSPENDED on ".date("d-m-Y", strtotime($employee->SUSPENSION_DATE));
									}
									?>
										<li class="<?php echo $class;?>">
											<input type="checkBox" name="Bill[Employee][WAGES][]" value="<?php echo $employee->ID;?>"  <?php echo $checkedString;?>>
											<span><?php echo $employee->NAME.", ".Designations::model()->findByPK($employee->DESIGNATION_ID_FK)->DESIGNATION;?></span>
											<span class="status"><?php echo $status;?></span>
										</li>
									<?php
								}
							?>
							</ul>
						</div>
					<?php } ?>
					<?php if($model->IS_WAGES_BONUS_BILL) {?>
						<div id="wages-bonus-emp" class="small-container"  style="display:none;">
							<div style="background: #333;padding: 5px;">
								<input type="text" class="wages-bonus-list-search" size="100" placeholder="SEARCH NAME" onkeyup="search(this, 'wages-bonus-emp');"/><span style="float: right;color: #FFF;"><input type="checkBox" class="wages-bonus-select-all select-al" onchange="selectList(this, 'wages-bonus-emp');"  checked> SELECT ALL</span>
							</div>
							<ul class="list">
							<?php
								$employees = Employee::model()->findAllByAttributes(array('IS_PERMANENT'=>0, 'BONUS_ELIGIBLE'=>1));
								$BillEmployees = explode(",", BillEmployees::model()->findByAttributes(array('BILL_ID'=>$model->ID))->EMPLOYEE_ID);
								foreach($employees as $employee){
									$class="";
									$status="";
									$checkedString="";
									
									if (in_array($employee->ID, $BillEmployees)){
										$checkedString = "checked";
									}
									if($employee->IS_TRANSFERRED == 1){
										$class="TRANSFERRED";
										$status="TRANSFERRED on ".date("d-m-Y", strtotime($employee->DEPT_RELIEF_DATE))." to ".$employee->TRANSFERED_TO;
									}
									if($employee->IS_RETIRED == 1){
										$class="RETIRED";
										$status="RETIRED on ".date("d-m-Y", strtotime($employee->ORG_RETIRE_DATE));
									}
									if($employee->IS_SUSPENDED == 1){
										$class="SUSPENDED";
										$status="SUSPENDED on ".date("d-m-Y", strtotime($employee->SUSPENSION_DATE));
									}
									?>
										<li>
											<input type="checkBox" name="Bill[Employee][WAGES_BONUS][]" value="<?php echo $employee->ID;?>" <?php echo $checkedString;?>>
											<span><?php echo $employee->NAME.", ".Designations::model()->findByPK($employee->DESIGNATION_ID_FK)->DESIGNATION;?></span>
											<span class="status"><?php echo $status;?></span>
										</li>
									<?php
								}
							?>
							</ul>
						</div>
					<?php } ?>	
				<?php } else {?>
						<div id="nps-emp" class="small-container"  style="display:none;">
							<div style="background: #333;padding: 5px;">
								<input type="text" class="nps-list-search" size="100" placeholder="SEARCH NAME" onkeyup="search(this, 'nps-emp');"/><span style="float: right;color: #FFF;"><input type="checkBox" class="nps-select-all select-al" onchange="selectList(this, 'nps-emp');"> SELECT ALL</span>
							</div>
							<ul class="list">
							<?php
								$employees = Employee::model()->findAllByAttributes(array('PENSION_TYPE'=>'NPS', 'IS_PERMANENT'=>1));
								foreach($employees as $employee){
									$class="";
									$status="";
									if($employee->IS_TRANSFERRED == 1){
										$class="TRANSFERRED";
										$status="TRANSFERRED on ".date("d-m-Y", strtotime($employee->DEPT_RELIEF_DATE))." to ".$employee->TRANSFERED_TO;
									}
									if($employee->IS_RETIRED == 1){
										$class="RETIRED";
										$status="RETIRED on ".date("d-m-Y", strtotime($employee->ORG_RETIRE_DATE));
									}
									if($employee->IS_SUSPENDED == 1){
										$class="SUSPENDED";
										$status="SUSPENDED on ".date("d-m-Y", strtotime($employee->SUSPENSION_DATE));
									}
									?>
										<li class="<?php echo $class;?>">
											<input type="checkBox" name="Bill[Employee][NPS][]" value="<?php echo $employee->ID;?>">
											<span><?php echo $employee->NAME.", ".Designations::model()->findByPK($employee->DESIGNATION_ID_FK)->DESIGNATION;?></span>
											<span class="status"><?php echo $status;?></span>
										</li>
									<?php
								}
							?>
							</ul>
						</div>
						<div id="ops-emp"  class="small-container"  style="display:none;">
							<div style="background: #333;padding: 5px;">
								<input type="text" class="ops-list-search" size="100" placeholder="SEARCH NAME" onkeyup="search(this, 'ops-emp');"/><span style="float: right;color: #FFF;"><input type="checkBox" class="ops-select-all select-al" onchange="selectList(this, 'ops-emp');"> SELECT ALL</span>
							</div>
							<ul class="list">
							<?php
								$employees = Employee::model()->findAllByAttributes(array('PENSION_TYPE'=>'OPS', 'IS_PERMANENT'=>1));
								foreach($employees as $employee){
									$class="";
									$status="";
									if($employee->IS_TRANSFERRED == 1){
										$class="TRANSFERRED";
										$status="TRANSFERRED on ".date("d-m-Y", strtotime($employee->DEPT_RELIEF_DATE))." to ".$employee->TRANSFERED_TO;
									}
									if($employee->IS_RETIRED == 1){
										$class="RETIRED";
										$status="RETIRED on ".date("d-m-Y", strtotime($employee->ORG_RETIRE_DATE));
									}
									if($employee->IS_SUSPENDED == 1){
										$class="SUSPENDED";
										$status="SUSPENDED on ".date("d-m-Y", strtotime($employee->SUSPENSION_DATE));
									}
									?>
										<li class="<?php echo $class;?>">
											<input type="checkBox" name="Bill[Employee][OPS][]" value="<?php echo $employee->ID;?>">
											<span><?php echo $employee->NAME.", ".Designations::model()->findByPK($employee->DESIGNATION_ID_FK)->DESIGNATION;?></span>
											<span class="status"><?php echo $status;?></span>
										</li>
									<?php
								}
							?>
							</ul>
						</div>
						<div id="bonus-nps-emp" class="small-container"  style="display:none;">
							<div style="background: #333;padding: 5px;">
								<input type="text" class="bonus-nps-list-search" size="100" placeholder="SEARCH NAME" onkeyup="search(this, 'bonus-nps-emp');"/><span style="float: right;color: #FFF;"><input type="checkBox" class="bonus-nps-select-all select-al" onchange="selectList(this, 'bonus-nps-emp');"> SELECT ALL</span>
							</div>
							<ul class="list">
							<?php
								$employees = Employee::model()->findAllByAttributes(array('PENSION_TYPE'=>'NPS', 'IS_PERMANENT'=>1, 'BONUS_ELIGIBLE'=>1));
								foreach($employees as $employee){
									$class="";
									$status="";
									if($employee->IS_TRANSFERRED == 1){
										$class="TRANSFERRED";
										$status="TRANSFERRED on ".date("d-m-Y", strtotime($employee->DEPT_RELIEF_DATE))." to ".$employee->TRANSFERED_TO;
									}
									if($employee->IS_RETIRED == 1){
										$class="RETIRED";
										$status="RETIRED on ".date("d-m-Y", strtotime($employee->ORG_RETIRE_DATE));
									}
									if($employee->IS_SUSPENDED == 1){
										$class="SUSPENDED";
										$status="SUSPENDED on ".date("d-m-Y", strtotime($employee->SUSPENSION_DATE));
									}
									?>
										<li class="<?php echo $class;?>">
											<input type="checkBox" name="Bill[Employee][NPS_BONUS][]" value="<?php echo $employee->ID;?>">
											<span><?php echo $employee->NAME.", ".Designations::model()->findByPK($employee->DESIGNATION_ID_FK)->DESIGNATION;?></span>
											<span class="status"><?php echo $status;?></span>
										</li>
									<?php
								}
							?>
							</ul>
						</div>
						<div id="bonus-ops-emp"  class="small-container"  style="display:none;">
							<div style="background: #333;padding: 5px;">
								<input type="text" class="bonus-ops-list-search" size="100" placeholder="SEARCH NAME" onkeyup="search(this, 'bonus-ops-emp');"/><span style="float: right;color: #FFF;"><input type="checkBox" class="bonus-ops-select-all select-al" onchange="selectList(this, 'bonus-ops-emp');"> SELECT ALL</span>
							</div>
							<ul class="list">
							<?php
								$employees = Employee::model()->findAllByAttributes(array('PENSION_TYPE'=>'OPS', 'IS_PERMANENT'=>1, 'BONUS_ELIGIBLE'=>1));
								foreach($employees as $employee){
									$class="";
									$status="";
									if($employee->IS_TRANSFERRED == 1){
										$class="TRANSFERRED";
										$status="TRANSFERRED on ".date("d-m-Y", strtotime($employee->DEPT_RELIEF_DATE))." to ".$employee->TRANSFERED_TO;
									}
									if($employee->IS_RETIRED == 1){
										$class="RETIRED";
										$status="RETIRED on ".date("d-m-Y", strtotime($employee->ORG_RETIRE_DATE));
									}
									if($employee->IS_SUSPENDED == 1){
										$class="SUSPENDED";
										$status="SUSPENDED on ".date("d-m-Y", strtotime($employee->SUSPENSION_DATE));
									}
									?>
										<li class="<?php echo $class;?>">
											<input type="checkBox" name="Bill[Employee][OPS_BONUS][]" value="<?php echo $employee->ID;?>">
											<span><?php echo $employee->NAME.", ".Designations::model()->findByPK($employee->DESIGNATION_ID_FK)->DESIGNATION;?></span>
											<span class="status"><?php echo $status;?></span>
										</li>
									<?php
								}
							?>
							</ul>
						</div>
						<div id="ua-emp" class="small-container"  style="display:none;">
							<div style="background: #333;padding: 5px;">
								<input type="text" class="ua-list-search" size="100" placeholder="SEARCH NAME" onkeyup="search(this, 'ua-emp');"/><span style="float: right;color: #FFF;"><input type="checkBox" class="ua-select-all select-al" onchange="selectList(this, 'ua-emp');"> SELECT ALL</span>
							</div>
							<ul class="list">
							<?php
								$employees = Employee::model()->findAllByAttributes(array('IS_PERMANENT'=>1, 'UA_ELIGIBLE'=>1));
								foreach($employees as $employee){
									$class="";
									$status="";
									if($employee->IS_TRANSFERRED == 1){
										$class="TRANSFERRED";
										$status="TRANSFERRED on ".date("d-m-Y", strtotime($employee->DEPT_RELIEF_DATE))." to ".$employee->TRANSFERED_TO;
									}
									if($employee->IS_RETIRED == 1){
										$class="RETIRED";
										$status="RETIRED on ".date("d-m-Y", strtotime($employee->ORG_RETIRE_DATE));
									}
									if($employee->IS_SUSPENDED == 1){
										$class="SUSPENDED";
										$status="SUSPENDED on ".date("d-m-Y", strtotime($employee->SUSPENSION_DATE));
									}
									?>
										<li class="<?php echo $class;?>">
											<input type="checkBox" name="Bill[Employee][UA][]" value="<?php echo $employee->ID;?>">
											<span><?php echo $employee->NAME.", ".Designations::model()->findByPK($employee->DESIGNATION_ID_FK)->DESIGNATION;?></span>
											<span class="status"><?php echo $status;?></span>
										</li>
									<?php
								}
							?>
							</ul>
						</div>
						<div id="medical-emp" class="small-container"  style="display:none;">
							<div style="background: #333;padding: 5px;">
								<input type="text" class="medical-list-search" size="100" placeholder="SEARCH NAME" onkeyup="search(this, 'medical-emp');"/><span style="float: right;color: #FFF;"><input type="checkBox" class="medical-select-all select-al" onchange="selectList(this, 'medical-emp');"> SELECT ALL</span>
							</div>
							<ul class="list">
							<?php
								$employees = Employee::model()->findAllByAttributes(array('IS_PERMANENT'=>1));
								foreach($employees as $employee){
									$class="";
									$status="";
									if($employee->IS_TRANSFERRED == 1){
										$class="TRANSFERRED";
										$status="TRANSFERRED on ".date("d-m-Y", strtotime($employee->DEPT_RELIEF_DATE))." to ".$employee->TRANSFERED_TO;
									}
									if($employee->IS_RETIRED == 1){
										$class="RETIRED";
										$status="RETIRED on ".date("d-m-Y", strtotime($employee->ORG_RETIRE_DATE));
									}
									if($employee->IS_SUSPENDED == 1){
										$class="SUSPENDED";
										$status="SUSPENDED on ".date("d-m-Y", strtotime($employee->SUSPENSION_DATE));
									}
									?>
										<li class="<?php echo $class;?>">
											<input type="checkBox" name="Bill[Employee][MEDICAL][]" value="<?php echo $employee->ID;?>">
											<span><?php echo $employee->NAME.", ".Designations::model()->findByPK($employee->DESIGNATION_ID_FK)->DESIGNATION;?></span>
											<span class="status"><?php echo $status;?></span>
										</li>
									<?php
								}
							?>
							</ul>
						</div>
						<div id="dte-emp" class="small-container"  style="display:none;">
							<div style="background: #333;padding: 5px;">
								<input type="text" class="dte-list-search" size="100" placeholder="SEARCH NAME" onkeyup="search(this, 'dte-emp');"/><span style="float: right;color: #FFF;"><input type="checkBox" class="dte-select-all select-al" onchange="selectList(this, 'dte-emp');"> SELECT ALL</span>
							</div>
							<ul class="list">
							<?php
								$employees = Employee::model()->findAllByAttributes(array('IS_PERMANENT'=>1));
								foreach($employees as $employee){
									$class="";
									$status="";
									if($employee->IS_TRANSFERRED == 1){
										$class="TRANSFERRED";
										$status="TRANSFERRED on ".date("d-m-Y", strtotime($employee->DEPT_RELIEF_DATE))." to ".$employee->TRANSFERED_TO;
									}
									if($employee->IS_RETIRED == 1){
										$class="RETIRED";
										$status="RETIRED on ".date("d-m-Y", strtotime($employee->ORG_RETIRE_DATE));
									}
									if($employee->IS_SUSPENDED == 1){
										$class="SUSPENDED";
										$status="SUSPENDED on ".date("d-m-Y", strtotime($employee->SUSPENSION_DATE));
									}
									?>
										<li class="<?php echo $class;?>">
											<input type="checkBox" name="Bill[Employee][DTE][]" value="<?php echo $employee->ID;?>" >
											<span><?php echo $employee->NAME.", ".Designations::model()->findByPK($employee->DESIGNATION_ID_FK)->DESIGNATION;?></span>
											<span class="status"><?php echo $status;?></span>
										</li>
									<?php
								}
							?>
							</ul>
						</div>
						<div id="wages-emp" class="small-container"  style="display:none;">
							<div style="background: #333;padding: 5px;">
								<input type="text" class="wages-list-search" size="100" placeholder="SEARCH NAME" onkeyup="search(this, 'wages-emp');"/><span style="float: right;color: #FFF;"><input type="checkBox" class="wages-select-all select-al" onchange="selectList(this, 'wages-emp');"> SELECT ALL</span>
							</div>
							<ul class="list">
							<?php
								$employees = Employee::model()->findAllByAttributes(array('IS_PERMANENT'=>0));
								foreach($employees as $employee){
									$class="";
									$status="";
									if($employee->IS_TRANSFERRED == 1){
										$class="TRANSFERRED";
										$status="TRANSFERRED on ".date("d-m-Y", strtotime($employee->DEPT_RELIEF_DATE))." to ".$employee->TRANSFERED_TO;
									}
									if($employee->IS_RETIRED == 1){
										$class="RETIRED";
										$status="RETIRED on ".date("d-m-Y", strtotime($employee->ORG_RETIRE_DATE));
									}
									if($employee->IS_SUSPENDED == 1){
										$class="SUSPENDED";
										$status="SUSPENDED on ".date("d-m-Y", strtotime($employee->SUSPENSION_DATE));
									}
									?>
										<li class="<?php echo $class;?>">
											<input type="checkBox" name="Bill[Employee][WAGES][]" value="<?php echo $employee->ID;?>" >
											<span><?php echo $employee->NAME.", ".Designations::model()->findByPK($employee->DESIGNATION_ID_FK)->DESIGNATION;?></span>
											<span class="status"><?php echo $status;?></span>
										</li>
									<?php
								}
							?>
							</ul>
						</div>
						<div id="wages-bonus-emp" class="small-container"  style="display:none;">
								<div style="background: #333;padding: 5px;">
									<input type="text" class="wages-bonus-list-search" size="100" placeholder="SEARCH NAME" onkeyup="search(this, 'wages-bonus-emp');"/><span style="float: right;color: #FFF;"><input type="checkBox" class="wages-bonus-select-all select-al" onchange="selectList(this, 'wages-bonus-emp');"> SELECT ALL</span>
								</div>
								<ul class="list">
								<?php
									$employees = Employee::model()->findAllByAttributes(array('IS_PERMANENT'=>0, 'BONUS_ELIGIBLE'=>1));
									foreach($employees as $employee){
										$class="";
										$status="";
										if($employee->IS_TRANSFERRED == 1){
											$class="TRANSFERRED";
											$status="TRANSFERRED on ".date("d-m-Y", strtotime($employee->DEPT_RELIEF_DATE))." to ".$employee->TRANSFERED_TO;
										}
										if($employee->IS_RETIRED == 1){
											$class="RETIRED";
											$status="RETIRED on ".date("d-m-Y", strtotime($employee->ORG_RETIRE_DATE));
										}
										if($employee->IS_SUSPENDED == 1){
											$class="SUSPENDED";
											$status="SUSPENDED on ".date("d-m-Y", strtotime($employee->SUSPENSION_DATE));
										}
										?>
											<li>
												<input type="checkBox" name="Bill[Employee][WAGES_BONUS][]" value="<?php echo $employee->ID;?>" >
												<span><?php echo $employee->NAME.", ".Designations::model()->findByPK($employee->DESIGNATION_ID_FK)->DESIGNATION;?></span>
												<span class="status"><?php echo $status;?></span>
											</li>
										<?php
									}
								?>
								</ul>
							</div>
				<?php } ?>
			</div>
		</div>
		<div class="form-group row">
			<label class="col-sm-2 form-control-label"></label>
			<div class="col-sm-10" id="bill-selection-lists">
				<div id="ltc-htc-advance-bill" class="small-container"  style="display:none;">
					<div style="background: #333;padding: 5px;">
						<input type="text" class="ltc-htc-advance-bill-search" size="100" placeholder="SEARCH LTC ADVANCE BILL" onkeyup="search(this, 'ltc-htc-advance-bill');"/>
					</div>
					<ul class="list">
					<?php
						$bills = Bill::model()->findAllByAttributes(array('IS_LTC_ADVANCE_BILL'=>1));
						foreach($bills as $bill){
							$class="";
							$status="";
							if($bill->IS_PASSED == 1){
								$class="PASSED";
								$status="PASSED on ".date("d-m-Y", strtotime($bill->PASSED_DATE));
							}
							?>
								<li class="<?php echo $class;?>">
									<input type="radio" name="Bill[CONNECTED_LTC_ADVANCE_BILL]" value="<?php echo $bill->ID;?>">
									<span><?php echo "<b>".$bill->BILL_NO.":</b> ".$bill->BILL_TITLE;?></span>
									<span class="status"><?php echo $status;?></span>
								</li>
							<?php
						}
					?>
					</ul>
				</div>
				<div id="tour-ta-advance-bill" class="small-container"  style="display:none;">
					<div style="background: #333;padding: 5px;">
						<input type="text" class="tour-ta-advance-bill-search" size="100" placeholder="SEARCH TOUR TA ADVANCE BILL" onkeyup="search(this, 'tour-ta-advance-bill');"/>
					</div>
					<ul class="list">
					<?php
						$bills = Bill::model()->findAllByAttributes(array('BILL_SUB_TYPE'=>33));
						foreach($bills as $bill){
							$class="";
							$status="";
							if($bill->IS_PASSED == 1){
								$class="PASSED";
								$status="PASSED on ".date("d-m-Y", strtotime($bill->PASSED_DATE));
							}
							?>
								<li class="<?php echo $class;?>">
									<input type="radio" name="Bill[CONNECTED_TOUR_TA_ADVANCE_BILL]" value="<?php echo $bill->ID;?>">
									<span><?php echo "<b>".$bill->BILL_NO.":</b> ".$bill->BILL_TITLE;?></span>
									<span class="status"><?php echo $status;?></span>
								</li>
							<?php
						}
					?>
					</ul>
				</div>
				<div id="transfer-ta-advance-bill" class="small-container"  style="display:none;">
					<div style="background: #333;padding: 5px;">
						<input type="text" class="transfer-ta-advance-bill-search" size="100" placeholder="SEARCH TRANSFER TA ADVANCE BILL" onkeyup="search(this, 'transfer-ta-advance-bill');"/>
					</div>
					<ul class="list">
					<?php
						$bills = Bill::model()->findAllByAttributes(array('BILL_SUB_TYPE'=>34));
						foreach($bills as $bill){
							$class="";
							$status="";
							if($bill->IS_PASSED == 1){
								$class="PASSED";
								$status="PASSED on ".date("d-m-Y", strtotime($bill->PASSED_DATE));
							}
							?>
								<li class="<?php echo $class;?>">
									<input type="radio" name="Bill[CONNECTED_TRANSFER_TA_ADVANCE_BILL]" value="<?php echo $bill->ID;?>">
									<span><?php echo "<b>".$bill->BILL_NO.":</b> ".$bill->BILL_TITLE;?></span>
									<span class="status"><?php echo $status;?></span>
								</li>
							<?php
						}
					?>
					</ul>
				</div>
				<div id="medical-advance-bill" class="small-container"  style="display:none;">
					<div style="background: #333;padding: 5px;">
						<input type="text" class="medical-advance-bill-search" size="100" placeholder="SEARCH MEDICAL ADVANCE BILL" onkeyup="search(this, 'medical-advance-bill');"/>
					</div>
					<ul class="list">
					<?php
						$bills = Bill::model()->findAllByAttributes(array('BILL_SUB_TYPE'=>38));
						foreach($bills as $bill){
							$class="";
							$status="";
							if($bill->IS_PASSED == 1){
								$class="PASSED";
								$status="PASSED on ".date("d-m-Y", strtotime($bill->PASSED_DATE));
							}
							?>
								<li class="<?php echo $class;?>">
									<input type="radio" name="Bill[CONNECTED_MEDICAL_ADVANCE_BILL]" value="<?php echo $bill->ID;?>">
									<span><?php echo "<b>".$bill->BILL_NO.":</b> ".$bill->BILL_TITLE;?></span>
									<span class="status"><?php echo $status;?></span>
								</li>
							<?php
						}
					?>
					</ul>
				</div>
			</div>
		</div>
		
		<?php
			if($model->IS_UA_BILL && Yii::app()->controller->action->id == 'update'){ ?>
				<div class="form-group row" id="UA_PERIOD">
					<?php echo $form->labelEx($model,'UA_PERIOD', array('class'=>'col-sm-2 form-control-label')); ?>
					<div class="col-sm-10">
						<p class="form-control-static">
							<?php echo $form->textField($model,'UA_PERIOD',array('size'=>40,'maxlength'=>100, 'disabled'=>Yii::app()->controller->action->id == 'update', 'value'=>$model->UA_PERIOD)); ?>
						</p>
					</div>
				</div>
				<?php } else { ?>
				<div class="form-group row" id="UA_PERIOD">
					<?php echo $form->labelEx($model,'UA_PERIOD', array('class'=>'col-sm-2 form-control-label')); ?>
					<div class="col-sm-10">
						<p class="form-control-static">
							<?php echo $form->textField($model,'UA_PERIOD',array('size'=>40,'maxlength'=>100, 'disabled'=>Yii::app()->controller->action->id == 'update')); ?>
						</p>
					</div>
				</div>
		<?php } ?>
		
		<div class="form-group row" id="BILL_NO_SECTION">
			<?php echo $form->labelEx($model,'BILL_NO', array('class'=>'col-sm-2 form-control-label')); ?>
			<div class="col-sm-10">
				<p class="form-control-static">
					<?php echo $form->textField($model,'BILL_NO',array('size'=>40,'maxlength'=>100, 'disabled'=>Yii::app()->controller->action->id == 'update')); ?>
				</p>
			</div>
		</div>
		<div class="form-group row" id="NILL_BILL_NO_SECTION">
			<?php echo $form->labelEx($model,'NILL_BILL_NO', array('class'=>'col-sm-2 form-control-label')); ?>
			<div class="col-sm-10">
				<p class="form-control-static">
					<?php echo $form->textField($model,'NILL_BILL_NO',array('size'=>40,'maxlength'=>100)); ?>
				</p>
			</div>
		</div>
		<div class="form-group row" id="PT_BILL_NO_SECTION">
				<?php echo $form->labelEx($model,'PT_DED_BILL_NO', array('class'=>'col-sm-2 form-control-label')); ?>
				<div class="col-sm-10">
					<p class="form-control-static">
						<?php echo $form->textField($model,'PT_DED_BILL_NO',array('size'=>40,'maxlength'=>100)); ?>
					</p>
				</div>
			</div>
		<div class="form-group row" id="BILL_TITLE_SECTION">
			<?php echo $form->labelEx($model,'BILL_TITLE', array('class'=>'col-sm-2 form-control-label')); ?>
			<div class="col-sm-10">
				<p class="form-control-static">
					<?php echo $form->textArea($model,'BILL_TITLE',array('rows'=>6, 'cols'=>50, 'maxlength'=>500, 'disabled'=>Yii::app()->controller->action->id == 'update', 'id'=>'txtBillTitle')); ?>
				</p>
			</div>
		</div>
		<?php if($model->IS_TOUR_OR_TRANSFER_TA_CLAIM_BILL && Yii::app()->controller->action->id == 'update'){ ?>
		<div class="form-group row" id="CLAIM_GROSS_SECTION">
			<?php echo $form->labelEx($model,'CLAIM_GROSS_AMOUNT', array('class'=>'col-sm-2 form-control-label')); ?>
			<div class="col-sm-10">
				<p class="form-control-static">
					<?php echo $form->textField($model,'CLAIM_GROSS_AMOUNT',array('size'=>20,'maxlength'=>20, 'value'=>DTEBillDetails::model()->find('BILL_ID_FK='.$model->ID)->GROSS, 'disabled'=>true)); ?>
				</p>
			</div>
		</div>
		<div class="form-group row" id="CLAIM_ADVANCE_SECTION">
			<?php echo $form->labelEx($model,'CLAIM_ADVANCE_AMOUNT', array('class'=>'col-sm-2 form-control-label')); ?>
			<div class="col-sm-10">
				<p class="form-control-static">
					<?php echo $form->textField($model,'CLAIM_ADVANCE_AMOUNT',array('size'=>20,'maxlength'=>20, 'value'=>DTEBillDetails::model()->find('BILL_ID_FK='.$model->ID)->ADVANCE, 'disabled'=>true)); ?>
				</p>
			</div>
		</div>
		<?php } else { ?>
		<div class="form-group row" id="CLAIM_GROSS_SECTION">
			<?php echo $form->labelEx($model,'CLAIM_GROSS_AMOUNT', array('class'=>'col-sm-2 form-control-label')); ?>
			<div class="col-sm-10">
				<p class="form-control-static">
					<?php echo $form->textField($model,'CLAIM_GROSS_AMOUNT',array('size'=>20,'maxlength'=>20, 'disabled'=>Yii::app()->controller->action->id == 'update')); ?>
				</p>
			</div>
		</div>
		<div class="form-group row" id="CLAIM_ADVANCE_SECTION">
			<?php echo $form->labelEx($model,'CLAIM_ADVANCE_AMOUNT', array('class'=>'col-sm-2 form-control-label')); ?>
			<div class="col-sm-10">
				<p class="form-control-static">
					<?php echo $form->textField($model,'CLAIM_ADVANCE_AMOUNT',array('size'=>20,'maxlength'=>20, 'disabled'=>Yii::app()->controller->action->id == 'update')); ?>
				</p>
			</div>
		</div>
		<?php } ?>
		<div class="form-group row" id="BILL_AMOUNT_SECTION">
			<?php echo $form->labelEx($model,'BILL_AMOUNT', array('class'=>'col-sm-2 form-control-label')); ?>
			<div class="col-sm-10">
				<p class="form-control-static">
					<?php echo $form->textField($model,'BILL_AMOUNT',array('size'=>20,'maxlength'=>20, 'disabled'=>Yii::app()->controller->action->id == 'update')); ?>
				</p>
			</div>
		</div>
		<div class="form-group row" id="FILE_NO_SECTION">
			<?php echo $form->labelEx($model,'FILE_NO', array('class'=>'col-sm-2 form-control-label')); ?>
			<div class="col-sm-10">
				<p class="form-control-static">
					<?php echo $form->textField($model,'FILE_NO',array('size'=>40,'maxlength'=>100, 'disabled'=>Yii::app()->controller->action->id == 'update')); ?>
				</p>
			</div>
		</div>
		<div class="form-group row" id="VENDOR_ID_SECTION">
			<?php echo $form->labelEx($model,'VENDOR_ID', array('class'=>'col-sm-2 form-control-label')); ?>
			<div class="col-sm-10">
				<p class="form-control-static">
					<?php echo $form->dropDownList($model,'VENDOR_ID',CHtml::listData(Vendors::model()->findAll(), 'ID', 'NAME'), array('empty'=>array('0'=>'Select Vendor'), 'disabled'=>Yii::app()->controller->action->id == 'update')); ?>
				</p>
			</div>
			<?php echo $form->error($model,'VENDOR_ID'); ?>
		</div>
		<div id="OE_BILLS_SECTION">
			<?php if($model->IS_OE_BILL && Yii::app()->controller->action->id == 'update'){  ?>
				<div class="form-group row" id="OE_IT_DED_SECTION">
					<?php echo $form->labelEx($model,'OE_IT_DED', array('class'=>'col-sm-2 form-control-label')); ?>
					<div class="col-sm-10">
						<p class="form-control-static">
							<?php echo $form->textField($model,'OE_IT_DED',array('size'=>40,'maxlength'=>100, 'value'=>OEBillDetails::model()->find('BILL_ID_FK='.$model->ID)->IT_DED, 'disabled'=>true)); ?>
						</p>
					</div>
				</div>
				<div class="form-group row" id="OE_NET_AMOUNT_SECTION">
					<?php echo $form->labelEx($model,'OE_NET_AMOUNT', array('class'=>'col-sm-2 form-control-label')); ?>
					<div class="col-sm-10">
						<p class="form-control-static">
							<?php echo $form->textField($model,'OE_NET_AMOUNT',array('size'=>40,'maxlength'=>100, 'value'=>OEBillDetails::model()->find('BILL_ID_FK='.$model->ID)->NET_AMOUNT, 'disabled'=>true)); ?>
						</p>
					</div>
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
			<?php } else { ?>
				<div class="form-group row" id="OE_IT_DED_SECTION">
					<?php echo $form->labelEx($model,'OE_IT_DED', array('class'=>'col-sm-2 form-control-label')); ?>
					<div class="col-sm-10">
						<p class="form-control-static">
							<?php echo $form->textField($model,'OE_IT_DED',array('size'=>40,'maxlength'=>100)); ?>
						</p>
					</div>
				</div>
				<div class="form-group row" id="OE_NET_AMOUNT_SECTION">
					<?php echo $form->labelEx($model,'OE_NET_AMOUNT', array('class'=>'col-sm-2 form-control-label')); ?>
					<div class="col-sm-10">
						<p class="form-control-static">
							<?php echo $form->textField($model,'OE_NET_AMOUNT',array('size'=>40,'maxlength'=>100)); ?>
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
			<?php } ?>
		</div>
		<div id="CEA_BILLS_SECTION">
			<?php  if($model->IS_CEA_BILL == 1 && Yii::app()->controller->action->id == 'update'){  ?>
				<div class="form-group row">
					<label class="col-sm-2 form-control-label">Details</label>
					<style> #CEASubBillTable input[type=text] {width: 150px;} </style>
					<div class="col-sm-10">
						<p class="form-control-static">
							<table id="CEASubBillTable" border="1">
								<tr>
									<td>Name of Child</td>
									<!--<td>Date of Birth</td>-->
									<td>Class</td>
									<td>School</td>
									<td>Amount</td>
									<td>Academmic Year</td>
								</tr>
								<?php
									$CEABillDetails = new CEABillDetails;
									$bills = $CEABillDetails->findAllByAttributes(array('BILL_ID'=>$model->ID));
									foreach($bills as $bill){
										?>
										<tr>
											<td><input type="text" size="10" value="<?php echo $bill->NAME; ?>" disabled="disabled"/></td>
											<!--<td><input type="text" size="10" value="<?php echo date('Y-m-d', strtotime($bill->DOB)); ?>" disabled="disabled"/></td>-->
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
			} else { ?>
				<div class="form-group row">
					<label class="col-sm-2 form-control-label">Bills</label>
					<style> #SubBillTable input[type=text] {width: 150px;}</style>
					<div class="col-sm-10">
						<p class="form-control-static">
							<table id="CEASubBillTable" border="1">
								<tr>
									<td>Name of Child</td>
									<!--<td>Date of Birth</td>-->
									<td>Class</td>
									<td>School</td>
									<td>Amount</td>
									<td>Academmic Year</td>
								</tr>
								<tr>
									<td><input type="text" style="width:150px;" name="Bill[CEA_BILLS][0][NAME]"/></td>
									<!--<td><input type="date" style="width:150px;" name="Bill[CEA_BILLS][0][DOB]"/></td>-->
									<td><input type="text" style="width:150px;" name="Bill[CEA_BILLS][0][CLASS]"/></td>
									<td><input type="text" style="width:150px;" name="Bill[CEA_BILLS][0][SCHOOL]"/></td>
									<td><input type="text" style="width:150px;" class="cea_bills_amount" name="Bill[CEA_BILLS][0][AMOUNT]"/></td>
									<td><input type="text" style="width:150px;" name="Bill[CEA_BILLS][0][REMARKS]" value="2016-17"/></td>
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
		<div class="form-group row" id="MONTH_SECTION">
			<label class="col-sm-2 form-control-label">MONTH/YEAR
			<p id="MULTI_MONTH_CHOICE"><input type="checkbox" id="IS_MULTIPLE_MONTH" name="Bill[IS_MULTIPLE_MONTH]"> Multiple</p>
			</label>
			<div class="col-sm-10">
				<?php 
					$months = array(''=>'', '1'=>'January','2'=>'February', '3'=>'March', '4'=>'April', '5'=>'May', '6'=>'June', '7'=>'July', '8'=>'August', '9'=>'September', '10'=>'October', '11'=>'November', '12'=>'December',);
					$years = array(''=>'', '2016'=>'2016', '2017'=>'2017', '2018'=>'2018', '2019'=>'2019', '2020'=>'2020', '2021'=>'2021');
				?>
				<p class="form-control-static">
					<?php 
						echo $form->dropDownList($model,'MONTH',$months, array('options' => array(ltrim(date('m'), '0') => array('selected'=>true)), 'disabled'=>Yii::app()->controller->action->id == 'update', 'style'=>'width: 150px;'));
						echo $form->dropDownList($model,'YEAR',$years, array('disabled'=>Yii::app()->controller->action->id == 'update','options' => array(date('Y') => array('selected'=>true)),'style'=>'width: 150px;'));
					?>
				</p>
			</div>
			<div class="col-sm-10" style="display:none;" id="MULTI_MONTH">
				<p class="form-control-static">
					<?php 
						echo $form->dropDownList($model,'MONTH_END',$months, array('options' => array(ltrim(date('m'), '0') => array('selected'=>true)), 'disabled'=>Yii::app()->controller->action->id == 'update', 'style'=>'width: 150px;'));
						echo $form->dropDownList($model,'YEAR_END', $years, array('options' => array(date('Y') => array('selected'=>true)), 'disabled'=>Yii::app()->controller->action->id == 'update','style'=>'width: 150px;'));
					?>
				</p>
			</div>
		</div>
		<div class="form-group row" id="CREATION_DATE_SECTION">
			<?php echo $form->labelEx($model,'CREATION_DATE', array('class'=>'col-sm-2 form-control-label')); ?>
			<div class="col-sm-10">
				<p class="form-control-static">
					<input type="date" name="Bill[CREATION_DATE]" id="Bill_CREATION_DATE" value="<?php echo (strtotime($model->CREATION_DATE) ? date('Y-m-d', strtotime($model->CREATION_DATE)) : date('Y-m-d'));?>" <?php echo (Yii::app()->controller->action->id == 'update') ? 'readonly':''; ?>>
				</p>
			</div>
		</div>
		
		<?php if(Yii::app()->controller->action->id == 'update') { ?>
		<div class="form-group row" id="EXPENDITURE_INC_BILL_SECTION">
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
		<div class="form-group row" id="APPROPIATION_BALANCE_SECTION">
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
		<div class="form-group row" id="PFMS_BILL_NO_SECTION">
			<?php echo $form->labelEx($model,'PFMS_BILL_NO', array('class'=>'col-sm-2 form-control-label')); ?>
			<div class="col-sm-10">
				<p class="form-control-static">
					<?php echo $form->textField($model,'PFMS_BILL_NO',array('size'=>40,'maxlength'=>100)); ?>
				</p>
			</div>
		</div>
		<div class="form-group row" id="CER_NO_SECTION">
			<?php echo $form->labelEx($model,'CER_NO', array('class'=>'col-sm-2 form-control-label')); ?>
			<div class="col-sm-10">
				<p class="form-control-static">
					<?php echo $form->textField($model,'CER_NO',array('size'=>50,'maxlength'=>50, 'disabled'=>Yii::app()->controller->action->id == 'update')); ?>
				</p>
			</div>
		</div>
		<div class="form-group row" id="PFMS_STATUS_SECTION">
			<?php echo $form->labelEx($model,'PFMS_STATUS', array('class'=>'col-sm-2 form-control-label')); ?>
			<div class="col-sm-10">
				<p class="form-control-static">
					<?php echo $form->dropDownList($model,'PFMS_STATUS',array('Generated'=>'Generated', 'Passed'=>'Passed',)); ?>
				</p>
			</div>
		</div>
		<?php if(!$model->IS_PASSED){ ?>
		<div class="form-group row">
			<label class="col-sm-2 form-control-label"></label>
			<div class="col-sm-10">
				<p class="form-control-static">
					<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class'=>'btn btn-success', 'onsubmit'=>'return validateBillForm();', 'onclick'=>'return validateBillForm();')); ?>
					<?php echo CHtml::resetButton('Cancel', array('class'=>'btn btn-danger')); ?>
				</p>
			</div>
		</div>
		<?php } ?>
	<?php $this->endWidget(); ?>
<script>
	var FIANANCIAL_YEAR = '<?php echo FinancialYears::model()->find('STATUS=1')->NAME; ?>',
		DEPT_NAME = '<?php echo $master->DEPT_NAME; ?>',
		MONTH_YEAR = '<?php echo date('M-Y', strtotime(date('Y-m'))); ?>',
		TODAY_DATE = '<?php echo date('d/m/Y')?>',
		PREVIOUS_MONTH_YEAR = '<?php echo date('M-Y', strtotime(date('Y-m')." -1 month")); ?>',
		CURRENT_MONTH_YEAR = '<?php echo date('M-Y'); ?>',
		CURRENT_BILL_TYPE = <?php echo $model->BILL_TYPE ? $model->BILL_TYPE : 0; ?>,
		CURRENT_BILL_SUB_TYPE = <?php echo $model->BILL_SUB_TYPE ? $model->BILL_SUB_TYPE : 0; ?>,
		CONTROLLER_ACTION = '<?php echo Yii::app()->controller->action->id; ?>'
		IS_BILL_PASSED = '<?php echo $model->IS_PASSED ? 1 : 0; ?>';
</script>
<script type="text/javascript" src="js/bill-form.js"></script>
<style>
	.TRANSFERRED, .RETIRED, .SUSPENDED {
		background: #fd9595;
	}
	ul.list{
		height: 300px;
		overflow-y: scroll;
		border-left: 1px Solid #ccc;
	}
	ul.list li{
		padding: 5px;
	}
	.status{
		font-size: 12px;
		float: right;
		line-height: 20px;
		color: #000;
	}
</style>
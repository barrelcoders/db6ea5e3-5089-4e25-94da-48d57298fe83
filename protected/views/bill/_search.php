

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<div class="col-sm-6">
			<div class="form-group row">
				<?php echo $form->labelEx($model,'BILL_NO', array('class'=>'col-sm-2 form-control-label')); ?>
				<div class="col-sm-10">
					<p class="form-control-static">
						<?php echo $form->textField($model,'BILL_NO',array('size'=>40,'maxlength'=>100, 'value'=>$model->BILL_NO));?>
					</p>
				</div>
			</div>
			<div class="form-group row">
				<label for="MONTH" class="col-sm-2 form-control-label">Select Month</label>
				<div class="col-sm-10">
					<p class="form-control-static">
						<?php echo $form->dropDownList($model,'MONTH',array(''=>'',
																'1'=>'January',
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
																'12'=>'December',)); ?>
					</p>
				</div>
			</div>
			<div class="form-group row">
				<label for="MONTH" class="col-sm-2 form-control-label">Select Year</label>
				<div class="col-sm-10">
					<p class="form-control-static">
							<?php echo $form->dropDownList($model,'YEAR',array(''=>'', '2017'=>'2017', '2018'=>'2018', '2019'=>'2019', '2020'=>'2020', '2021'=>'2021')); ?>
					</p>
				</div>
			</div>
			<div class="form-group row">
				<?php echo $form->labelEx($model,'CER_NO', array('class'=>'col-sm-2 form-control-label')); ?>
				<div class="col-sm-10">
					<p class="form-control-static">
						<?php echo $form->textField($model,'CER_NO',array('size'=>40,'maxlength'=>100, 'value'=>$model->CER_NO)); ?>
					</p>
				</div>
			</div>
			<div class="form-group row">
				<?php echo $form->labelEx($model,'PFMS_STATUS', array('class'=>'col-sm-2 form-control-label')); ?>
				<div class="col-sm-10">
					<p class="form-control-static">
						<?php echo $form->dropDownList($model,'PFMS_STATUS',array(''=>'', 'Generated'=>'Generated', 'Passed'=>'Passed',)); ?>
					</p>
				</div>
			</div>
		</div>
		<div class="col-sm-6">
			<div class="form-group row">
				<?php echo $form->labelEx($model,'PASSED_DATE', array('class'=>'col-sm-2 form-control-label')); ?>
				<div class="col-sm-10">
					<p class="form-control-static">
						<input type="date" name="Bill[PASSED_DATE]" id="Bill_PASSED_DATE" 
							value="<?php echo (strtotime($model->PASSED_DATE) ? date('Y-m-d', strtotime($model->PASSED_DATE)) : date('Y-m-d'));?>">
				
					</p>
				</div>
			</div>

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
								data  = "<option ></option>" + data;
								$("#Bill_BILL_SUB_TYPE").html(data);
								var bill = parseInt($("#slBillType").val());
								if(bill == 1 || bill == 2 ){
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
						'empty'=>array(''=>''),
						'options' => array("'".$model->ID."'" => array('selected'=>true)),
						'disabled'=>Yii::app()->controller->action->id == 'update')); ?>
					</p>
				</div>
			</div>

			<div class="form-group row">
				<?php echo $form->labelEx($model,'BILL_SUB_TYPE', array('class'=>'col-sm-2 form-control-label')); ?>
				<div class="col-sm-10">
					<p class="form-control-static">
						<?php echo $form->dropDownList($model,'BILL_SUB_TYPE',$model->GetBillSubType($model->BILL_TYPE));	?>
					</p>
				</div>
			</div>
			<div class="form-group row">
				<?php echo $form->labelEx($model,'BILL_AMOUNT', array('class'=>'col-sm-2 form-control-label')); ?>
				<div class="col-sm-10">
					<p class="form-control-static">
						<?php echo $form->textField($model,'BILL_AMOUNT',array('size'=>40,'maxlength'=>100, 'value'=>$model->BILL_AMOUNT)); ?>
					</p>
				</div>
			</div>
			
			<div class="form-group row">
				<?php echo $form->labelEx($model,'PFMS_BILL_NO', array('class'=>'col-sm-2 form-control-label')); ?>
				<div class="col-sm-10">
					<p class="form-control-static">
						<?php echo $form->textField($model,'PFMS_BILL_NO',array('size'=>40,'maxlength'=>100, 'value'=>$model->PFMS_BILL_NO)); ?>
					</p>
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-2 form-control-label"></label>
				<div class="col-sm-10">
					<p class="form-control-static">
						<?php echo CHtml::submitButton('Search', array('class'=>'btn btn-inline')); ?>
					</p>
				</div>
			</div>
		</div>
	</div>

<?php $this->endWidget(); ?>

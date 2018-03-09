
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'pay-bill-tasks-form',
	'enableAjaxValidation'=>false,
)); ?>
	<div class="form-group row">
		<label class="col-sm-2 form-control-label">Select Employee</label>
		<div class="col-sm-10">	
			<div id="employees"  class="small-container">
				<div style="background: #333;padding: 5px;">
					<input type="text" class="employees-list-search" size="100" placeholder="SEARCH NAME" onkeyup="search(this, 'employees');"/>
				</div>
				<ul class="list">
				<?php
					$employees = Employee::model()->findAllByAttributes(array('IS_PERMANENT'=>1));
					$taskEmployee = $model->EMPLOYEE_ID_FK;
					foreach($employees as $employee){
						$class="";
						$status="";
						$checkedString="";
						
						if ($employee->ID == $taskEmployee){
							$checkedString = "checked";
						}
						if($employee->IS_TRANSFERRED == 1){
							$class="TRANSFERRED";
							$status="TRANSFERRED on ".date("d-m-Y", strtotime($employee->CURRENT_OFFICE_RELIEF_DATE))." to ".$employee->TRANSFERED_TO;
						}
						if($employee->IS_RETIRED == 1){
							$class="RETIRED";
							$status="RETIRED on ".date("d-m-Y", strtotime($employee->GOVT_SERVICE_EXIT_DATE));
						}
						if($employee->IS_SUSPENDED == 1){
							$class="SUSPENDED";
							$status="SUSPENDED on ".date("d-m-Y", strtotime($employee->SUSPENSION_DATE));
						}
						?>
							<li class="<?php echo $class;?>">
								<input type="radio" name="PayBillTasks[EMPLOYEE_ID_FK]" value="<?php echo $employee->ID;?>" <?php echo $checkedString;?>>
								<span><?php echo $employee->NAME.", ".Designations::model()->findByPK($employee->DESIGNATION_ID_FK)->DESIGNATION;?></span>
								<span class="status"><?php echo $status;?></span>
							</li>
						<?php
					}
				?>
				</ul>
			</div>
		</div>
	</div>
	<?php if(strtolower(Yii::app()->controller->action->id) !== 'update'){ ?>
	<div class="form-group row">
		<label class="col-sm-2 form-control-label"></label>
		<div class="col-sm-10">
			<input type="checkbox" id="IS_MULTIPLE_MONTH" name="PayBillTasks[IS_MULTIPLE_MONTH]" > Multiple Months/Year</p>
		</div>
	</div>
	<?php } ?>
	<div class="form-group row">
		<label class='col-sm-2 form-control-label'>START MONTH/YEAR</label>
		<div class="col-sm-10">
			<p class="form-control-static">
				<?php echo $form->dropDownList($model,'START_MONTH',
				array(1=>'January', 2=>'February', 3=>'March', 4=>'April', 5=>'May', 6=>'June', 7=>'July', 8=>'August', 9=>'September', 10=>'October', 11=>'November', 12=>'December'),
				array('options'=>array($model->MONTH=>array('selected'=>true)))); ?>
				<?php echo $form->dropDownList($model,'START_YEAR',
				array('2018'=>'2018', '2019'=>'2019'),
				array('options'=>array($model->YEAR=>array('selected'=>true)))); ?>
			</p>
		</div>
	</div>
	<?php if(strtolower(Yii::app()->controller->action->id) !== 'update'){ ?>
	<div class="form-group row" id="MULTIPLE_MONTH_SECTION" style="display:none;">
		<label class='col-sm-2 form-control-label'>END MONTH/YEAR</label>
		<div class="col-sm-10">
			<p class="form-control-static">
				<?php echo $form->dropDownList($model,'END_MONTH',
				array(1=>'January', 2=>'February', 3=>'March', 4=>'April', 5=>'May', 6=>'June', 7=>'July', 8=>'August', 9=>'September', 10=>'October', 11=>'November', 12=>'December'),
				array('options'=>array($model->MONTH=>array('selected'=>true)))); ?>
				<?php echo $form->dropDownList($model,'END_YEAR',
				array('2018'=>'2018', '2019'=>'2019'),
				array('options'=>array($model->YEAR=>array('selected'=>true)))); ?>
			</p>
		</div>
	</div>
	<?php } ?>
	<div class="form-group row">
		<?php echo $form->labelEx($model,'TASK', array('class'=>'col-sm-2 form-control-label')); ?>
		<div class="col-sm-10">
			<p class="form-control-static">
				<?php echo $form->textArea($model,'TASK',array('size'=>60,'rows'=>5, 'cols'=>100, 'value'=>$model->TASK, 'class'=>'form-control')); ?>
			</p>
		</div>
	</div>
	<div class="form-group row">
		<label class='col-sm-2 form-control-label'></label>
		<div class="col-sm-10">
			<p class="form-control-static">
				<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class'=>'btn btn-inline')); ?>
			</p>
		</div>
	</div>

<?php $this->endWidget(); ?>
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
<script>
$().ready(function (){
	$('#IS_MULTIPLE_MONTH').change(function(){
		if($(this).is(":checked")){
			$("#IS_MULTIPLE_MONTH").val(1);
			$('#MULTIPLE_MONTH_SECTION').show();
		}
		else{
			$("#IS_MULTIPLE_MONTH").val(0);
			$('#MULTIPLE_MONTH_SECTION').hide();
		}
	});
});
function search(searchBox, list){
	var input, filter, ul, li, a, i;
	input = searchBox;
	filter = input.value.toUpperCase();
	ul = $("#"+list+" ul");
	li = ul.find('li');

	// Loop through all list items, and hide those who don't match the search query
	for (i = 0; i < li.length; i++) {
		span = li[i].getElementsByTagName("span")[0];
		if (span.innerHTML.toUpperCase().indexOf(filter) > -1) {
			li[i].style.display = "";
		} else {
			li[i].style.display = "none";
		}
	}
}
function selectList(checkbox, list){
	var ul, li, i;
	ul = $("#"+list+" ul");
	li = ul.find('li');

	// Loop through all list items, and hide those who don't match the search query
	for (i = 0; i < li.length; i++) {
		item = li[i].getElementsByTagName("input")[0];
		if (!checkbox.checked) {
			item.checked = false;
		} else {
			if(!li[i].classList.contains('TRANSFERRED') && !li[i].classList.contains('RETIRED') && !li[i].classList.contains('SUSPENDED')){
				item.checked = true;
			}
		}
	}
}
</script>
<?php
/* @var $this IncrementController */
/* @var $model Increment */
/* @var $form CActiveForm */
?>
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'increment-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>
	<div class="form-group row">
		<?php echo $form->labelEx($model,'TITLE', array('class'=>'col-sm-2 form-control-label')); ?>
		<div class="col-sm-10">
			<p class="form-control-static">
				<?php echo $form->textField($model,'TITLE',array('size'=>80,'maxlength'=>200)); ?>
			</p>
		</div>
	</div>
	<div class="form-group row">
		<?php echo $form->labelEx($model,'DATE', array('class'=>'col-sm-2 form-control-label')); ?>
		<div class="col-sm-10">
			<p class="form-control-static">
				<input type="date" id="Increment_DATE" name="Increment[DATE]" value="<?php echo date('Y-m-d', strtotime($model->DATE))?>">
			</p>
		</div>
	</div>
	<div class="form-group row">
		<label class='col-sm-2 form-control-label'>Employee</label>
		<div class="col-sm-10">
			<p class="form-control-static">
				<div class="col-sm-10">
					<div id="employees" class="small-container">
						<div style="background: #333;padding: 5px;">
							<input type="text" class="employees-list-search" size="60" placeholder="SEARCH NAME" onkeyup="search(this, 'employees');"/>
						</div>
						<ul style="background: rgb(204, 204, 204);padding: 10px;height: 300px;overflow-y: scroll;">
						<?php
							$employees = Employee::model()->findAll(); 
							foreach($employees as $employee){
								?>
									<li>
										<input type="radio" value="<?php echo $employee->ID;?>" onchange="selectPayMatrix(this);">
										<span><?php echo $employee->NAME.", ".Designations::model()->findByPK($employee->DESIGNATION_ID_FK)->DESIGNATION;?></span>
										
									</li>
								<?php
							}
						?>
						</ul>
					</div>
				</div>
			</p>
		</div>
	</div>
	<div class="form-group row">
		<label class='col-sm-2 form-control-label'>Pay Matrix</label>
		<div class="col-sm-10">
			<p class="form-control-static">
				<select id="from-pay-matrix">
					<?php 
						$records=PayMatrix::model()->findAll();
						foreach($records as $record){
							?>
							<option value="<?php echo $record->ID; ?>"><?php echo $record->TEXT;?></option>
							<?php
						}
					?>
				</select>
				&nbsp; to &nbsp;
				<select id="to-pay-matrix">
					<?php 
						$records=PayMatrix::model()->findAll();
						foreach($records as $record){
							?>
							<option value="<?php echo $record->ID; ?>"><?php echo $record->TEXT;?></option>
							<?php
						}
					?>
				</select>
				<br/><br/>
				<input type="button" id="add" class="btn btn-inline" value="Add" onclick="addIncrement();"/>
			</p>
		</div>
	</div>
	<div class="form-group row">
		<label class="col-sm-2 form-control-label"></label>
		<style> #IncrementTable input[type=text] {width: 150px;} </style>
		<div class="col-sm-9">
			<table id="IncrementTable" class="table table-bordered table-hover">
				<tr>
					<td>S.No.</td>
					<td>Employee Name & Designation</td>
					<td>From Pay Matrix</td>
					<td>To Pay Matrix</td>
					<td></td>
				</tr>
				<tr>
					<td><span></span><input type='hidden'/></td>
					<td><span></span></td>
					<td><span></span></td>
					<td><span></span></td>
					<td><input type="button" onclick="deleteRow(this);" value="DELETE" class="btn btn-inline"></td>
				</tr>
				<?php
					if(strtolower(Yii::app()->controller->action->id) == 'update'){
						$employees = explode(",", $model->EMPLOYEE);
						$i = 1;
						foreach($employees as $employee){
							$data = explode('-', $employee);
							?>
								<tr>
									<td><span><?php echo $i;?></span><input type='hidden' name="Increment[EMPLOYEE][<?php echo  ($i+1);?>]" value="<?php echo $employee;?>"/></td>
									<td><span><?php echo Employee::model()->findByPK($data[0])->NAME.", ".Designations::model()->findByPK(Employee::model()->findByPK($data[0])->DESIGNATION_ID_FK)->DESIGNATION;?></span></td>
									<td><span><?php echo PayMatrix::model()->findByPK($data[1])->TEXT;?></span></td>
									<td><span><?php echo PayMatrix::model()->findByPK($data[2])->TEXT;?></span></td>
									<td><input type="button" onclick="deleteRow(this);" value="DELETE" class="btn btn-inline"></td>
								</tr>
							<?php	
							$i++;
						}
					}
				?>
			</table>
		</div>
	</div>
	<div class="form-group row">
		<label class='col-sm-2 form-control-label'></label>
		<div class="col-sm-10">
			<p class="form-control-static">
				<?php echo CHtml::submitButton('Save Increment', array('class'=>'btn btn-inline')); ?>
				
			</p>
		</div>
	</div>

<?php $this->endWidget(); ?>

<script>
	var selectedEmployee = 0,
		selectedEmployeeName = null;

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
function deleteRow(row)
{
	var i=row.parentNode.parentNode.rowIndex;
	document.getElementById('IncrementTable').deleteRow(i);
}

function addIncrement(){
	if(selectedEmployee == 0 || selectedEmployeeName == null){
		alert('Please select Employee');
		return false;
	}
	if($('#from-pay-matrix').val() == $('#to-pay-matrix').val()){
		alert('Please select next Pay Matrix for '+ selectedEmployeeName);
		return false;
	}
	
	var x=document.getElementById('IncrementTable');
	var new_row = x.rows[1].cloneNode(true);
	var len = x.rows.length;
	
	var span1 = new_row.cells[0].getElementsByTagName('span')[0];
	span1.innerHTML = len - 1;
	var inp1 = new_row.cells[0].getElementsByTagName('input')[0];
	inp1.name = "Increment[EMPLOYEE]["+len+"]";
	inp1.value = selectedEmployee + '-' + $("#from-pay-matrix").val() + '-' + $("#to-pay-matrix").val();
	var span2 = new_row.cells[1].getElementsByTagName('span')[0];
	span2.innerHTML = selectedEmployeeName;
	var span3 = new_row.cells[2].getElementsByTagName('span')[0];
	span3.innerHTML = $("#from-pay-matrix option:selected").text();
	var span4 = new_row.cells[3].getElementsByTagName('span')[0];
	span4.innerHTML = $("#to-pay-matrix option:selected").text();
	x.appendChild( new_row );
}
function selectPayMatrix(element){
	if(element.checked){
		var empId = element.value;
		selectedEmployee = empId;
		selectedEmployeeName = $(element).next().html();
		$.post( '<?php echo Yii::app()->createUrl('Employee/GetEmployeeMatrix')?>&id='+empId, {}, function(result) {
			$('#from-pay-matrix').val(result);
			$('#to-pay-matrix').val(result);
		});
	}
}
</script>

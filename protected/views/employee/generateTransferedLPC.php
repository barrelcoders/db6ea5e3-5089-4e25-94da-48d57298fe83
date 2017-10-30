<?php
/* @var $this EmployeeController */
/* @var $model Employee */

$this->breadcrumbs=array(
	'Employees'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Employee', 'url'=>array('index')),
	array('label'=>'Manage Employee', 'url'=>array('admin')),
);
?>
<nav class="side-menu-additional" style="overflow-y: auto; padding: 0px; width: 250px;margin-left: 141px;display:none;">
	<div style="width: 219px; height: 700px;">
		<div class="" style="padding: 0px;    margin-top: 100px; width: 219px;padding-top: 0px!important;">
			<ul class="side-menu-additional-list" id="footer_action" style="display:none;">
				<li><a id="LPC" target="_blank" ><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">LPC</span></span></a></li>
				<li><a id="LPCCover" target="_blank" ><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">LPC Cover Letter</span></span></a></li>
					
			</ul>
		</div>
	</div>
</nav>
<div class="container-fluid"  id="lpc-content">
	<header class="section-header">
		<div class="tbl">
			<div class="tbl-row">
				<div class="tbl-cell">
					<h2>Generate LPC (On Transfered)</h2>
					<div class="subtitle"></div>
				</div>
			</div>
		</div>
	</header>
	<div class="box-typical box-typical-padding">
		<?php $form=$this->beginWidget('CActiveForm', array(
			'id'=>'employee-form',
			// Please note: When you enable ajax validation, make sure the corresponding
			// controller action is handling ajax validation correctly.
			// There is a call to performAjaxValidation() commented in generated controller code.
			// See class documentation of CActiveForm for details on this.
			'enableAjaxValidation'=>false,
		)); ?>

	
		<div class="form-group row">
			<label class='col-sm-2 form-control-label'>Employee</label>
			<div class="col-sm-10">
				<p class="form-control-static">
					<div class="col-sm-10">
						<div id="employees" class="small-container">
							<div style="background: #333;padding: 5px;">
								<input type="text" class="employees-list-search" size="100" placeholder="SEARCH NAME" onkeyup="search(this, 'employees');"/>
							</div>
							<ul style="background: rgb(204, 204, 204);padding: 10px;height: 300px;overflow-y: scroll;">
							<?php
								$employees = Employee::model()->findAll(); 
								foreach($employees as $employee){
									?>
										<li><input type="radio" name="Employee[ID]" value="<?php echo $employee->ID;?>"><span><?php echo $employee->NAME.", ".Designations::model()->findByPK($employee->DESIGNATION_ID_FK)->DESIGNATION;?></span></li>
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
			<?php echo $form->labelEx($model,'DEPT_RELIEF_DATE', array('class'=>'col-sm-2 form-control-label')); ?>
			<div class="col-sm-10">
				<p class="form-control-static">
					<input value="<?php echo ($model->DEPT_RELIEF_DATE == "") ? "" : date('Y-m-d', strtotime($model->DEPT_RELIEF_DATE))?>" id="Employee_DEPT_RELIEF_DATE" name="Employee[DEPT_RELIEF_DATE]" type="date">
					<?php echo $form->dropDownList($model,'DEPT_RELIEF_TIME',array(''=>'', 'F/N'=>'F/N', 'A/N'=>'A/N'), array('options'=>array($model->DEPT_RELIEF_TIME=>array('selected'=>true)))); ?>
				</p>
			</div>
		</div>
		<div class="form-group row">
			<?php echo $form->labelEx($model,'TRANSFERED_TO', array('class'=>'col-sm-2 form-control-label')); ?>
			<div class="col-sm-10">
				<p class="form-control-static">
					<?php echo $form->textField($model,'TRANSFERED_TO',array('size'=>60,'maxlength'=>100)); ?>
				</p>
			</div>
		</div>
		<div class="form-group row">
			<?php echo $form->labelEx($model,'TRANSFER_ORDER', array('class'=>'col-sm-2 form-control-label')); ?>
			<div class="col-sm-10">
				<p class="form-control-static">
					<?php echo $form->textField($model,'TRANSFER_ORDER',array('size'=>60,'maxlength'=>100)); ?>
				</p>
			</div>
		</div>
		<div class="form-group row">
			<?php echo $form->labelEx($model,'LPC_REMARKS', array('class'=>'col-sm-2 form-control-label')); ?>
			<div class="col-sm-10">
				<p class="form-control-static">
					<?php echo $form->textArea($model,'LPC_REMARKS',array('maxlength' => 10000, 'rows' => 6, 'cols' => 50)); ?>
				</p>
			</div>
		</div>
		
		
		
		<div class="form-group row">
			<label class='col-sm-2 form-control-label'></label>
			<div class="col-sm-10">
				<p class="form-control-static">
					<?php echo CHtml::submitButton('Generate', array('class'=>'btn btn-inline')); ?>
					<input type="button" id="btnViewLPC" class="btn btn-inline" value="View LPC"/>
				</p>
			</div>
		</div>
		<?php 
			
		$this->endWidget(); ?>
	</div>
</div>
<style>
	.slide-content{
		margin-left: 225px;
	}
</style>
<script>
	
	$(document).ready(function(){
		$('#employees li input[type=radio]').change(function(){
			var empID = $(this).val();
			
			$('#LPC').attr('href', '<?php echo Yii::app()->createUrl('Employee/LPC_Transfered'); ?>'+'&id='+empID);
			//$('#LPCCover').attr('href', '<?php echo Yii::app()->createUrl('Employee/LPCCover'); ?>'+'&id='+empID);
			$('#footer_action').show();
		});
		
		$('#btnViewLPC').click(function(){
			//var empID = $('#slEmployee').val();
			
			//$('#LPC').attr('href', '<?php echo Yii::app()->createUrl('Employee/LPC'); ?>'+'&id='+empID);
			//$('#LPCCover').attr('href', '<?php echo Yii::app()->createUrl('Employee/LPCCover'); ?>'+'&id='+empID);
			$(".side-menu-additional").show();
			$("#lpc-content").addClass('slide-content');
			$('#footer_action').show();
		});
	});
</script>

<script>

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
</script>

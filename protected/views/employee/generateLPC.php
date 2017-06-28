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
					<h2>Generate Last Pay Certificate</h2>
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
					<?php echo $form->dropDownList($model,'ID',CHtml::listData(Employee::model()->findAll(), 'ID', 'NAME'), array(
						'id'=>'slEmployee',
						'empty'=>array('0'=>'Select Employee'))); ?>
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
								'style'=>'height:20px;',
							),
						));	?>
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
		$('#slEmployee').change(function(){
			var empID = $('#slEmployee').val();
			
			$('#LPC').attr('href', '<?php echo Yii::app()->createUrl('Employee/LPC'); ?>'+'&id='+empID);
			$('#LPCCover').attr('href', '<?php echo Yii::app()->createUrl('Employee/LPCCover'); ?>'+'&id='+empID);
			$('#footer_action').show();
		});
		
		$('#btnViewLPC').click(function(){
			var empID = $('#slEmployee').val();
			
			$('#LPC').attr('href', '<?php echo Yii::app()->createUrl('Employee/LPC'); ?>'+'&id='+empID);
			$('#LPCCover').attr('href', '<?php echo Yii::app()->createUrl('Employee/LPCCover'); ?>'+'&id='+empID);
			$(".side-menu-additional").show();
			$("#lpc-content").addClass('slide-content');
			$('#footer_action').show();
		});
	});
</script>

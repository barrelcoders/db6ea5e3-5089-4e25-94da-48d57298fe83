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

<div class="container-fluid">
	<header class="section-header">
		<div class="tbl">
			<div class="tbl-row">
				<div class="tbl-cell">
					<h2>Create Employee</h2>
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

		<div class="row">
			<div class="col-sm-8">
				<div class="form-group row">
					<label class='col-sm-4 form-control-label'>Custom 1</label>
					<div class="col-sm-8">
						<p class="form-control-static">
							<input type="text" name="Employee[Custom_attr_1]" class="col-sm-6 form-control-label"  />
						</p>
					</div>
				</div>
				<div class="form-group row">
					<label class='col-sm-4 form-control-label'>Custom 2</label>
					<div class="col-sm-8">
						<p class="form-control-static">
							<input type="text" name="Employee[Custom_attr_2]" class="col-sm-6 form-control-label"  />
						</p>
					</div>
				</div>
				<div class="form-group row">
					<label class='col-sm-4 form-control-label'>Custom 3</label>
					<div class="col-sm-8">
						<p class="form-control-static">
							<input type="text" name="Employee[Custom_attr_3]" class="col-sm-6 form-control-label"  />
						</p>
					</div>
				</div>
				<?php 
					foreach($model->attributes as $key=>$value){
				?>
				<div class="form-group row">
					<?php echo $form->labelEx($model, $key , array('class'=>'col-sm-4 form-control-label')); ?>
					<div class="col-sm-8">
						<p class="form-control-static">
							<input type="checkbox" name="Employee[Attributes][]" class="form-control-label"  value="<?php echo $key; ?>" />
						</p>
					</div>
				</div>
				<?php } ?>
				
				<div class="form-group row">
					<label class='col-sm-4 form-control-label'></label>
					<div class="col-sm-8">
						<p class="form-control-static">
							<?php echo CHtml::submitButton('Generate', array('class'=>'btn btn-inline')); ?>
						</p>
					</div>
				</div>
		
			</div>
			<div class="col-sm-4">
				<div>
					<?php 
						$Designations = Designations::model()->findAll();
						foreach($Designations as $designation){
							?>
								<p><input type="checkbox" name="Employee[Designations][]" value="<?php echo $designation->ID; ?>"><?php echo $designation->DESIGNATION?></p>
							<?php
						}
					?>
				</div>
			</div>
		</div>
		<?php 
			
		$this->endWidget(); ?>
	</div>
</div>


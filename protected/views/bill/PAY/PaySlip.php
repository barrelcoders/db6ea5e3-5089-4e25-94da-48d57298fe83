<?php
/* @var $this BillController */
/* @var $model Bill */

$this->breadcrumbs=array(
	'Bills'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'Manage Bill', 'url'=>array('admin')),
);

?>

<div class="container-fluid">
	<header class="section-header">
		<div class="tbl">
			<div class="tbl-row">
				<div class="tbl-cell">
					<h2>Pay Slip</h2>
					<div class="subtitle"></div>
				</div>
			</div>
		</div>
	</header>
	<div class="box-typical box-typical-padding">
		<?php $form=$this->beginWidget('CActiveForm', array(
		'id'=>'exp-form',
		'enableAjaxValidation'=>false,
	)); ?>

	<div class="form-group row">
		<label for="MONTH" class="col-sm-2 form-control-label">Select Month</label>
		<div class="col-sm-10">
			<p class="form-control-static">
				<select name="PaySlip[MONTH]" id="MONTH">
					<option value="1">January</option>
					<option value="2">February</option>
					<option value="3">March</option>
					<option value="4">April</option>
					<option value="5">May</option>
					<option value="6">June</option>
					<option value="7">July</option>
					<option value="8">August</option>
					<option value="9">September</option>
					<option value="10">October</option>
					<option value="11">November</option>
					<option value="12">December</option>
				</select>
			</p>
		</div>
	</div>
	
	<div class="form-group row">
		<label class="col-sm-2 form-control-label"></label>
		<div class="col-sm-10">
			<p class="form-control-static">
				<?php echo CHtml::Button('Generate', array('id'=>'btnSubmit', 'class'=>'btn btn-inline', 'name'=>'PaySlip[submit]')); ?>
			</p>
		</div>
	</div>
	
	<?php $this->endWidget(); ?>
	</div>
</div>
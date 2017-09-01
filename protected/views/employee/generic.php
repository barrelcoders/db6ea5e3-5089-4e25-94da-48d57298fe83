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
			<div class="col-sm-6">
				<div style="padding: 10px;height: 500px;overflow-y: scroll;overflow-x: hidden;">
					<div class="form-group row">
						<label class='col-sm-9 form-control-label'>Custom 1</label>
						<div class="col-sm-3">
							<p class="form-control-static">
								<input type="text" name="Employee[Custom_attr_1]" class="col-sm-12 form-control-label"  />
							</p>
						</div>
					</div>
					<div class="form-group row">
						<label class='col-sm-9 form-control-label'>Custom 2</label>
						<div class="col-sm-3">
							<p class="form-control-static">
								<input type="text" name="Employee[Custom_attr_2]" class="col-sm-12 form-control-label"  />
							</p>
						</div>
					</div>
					<div class="form-group row">
						<label class='col-sm-9 form-control-label'>Custom 3</label>
						<div class="col-sm-3">
							<p class="form-control-static">
								<input type="text" name="Employee[Custom_attr_3]" class="col-sm-12 form-control-label"  />
							</p>
						</div>
					</div>
					<?php 
						foreach($model->attributes as $key=>$value){
					?>
					<div class="form-group row">
						<label class="col-sm-9 form-control-label" for="Employee_<?php echo $key;?>"><?php echo strtoupper($model->getAttributeLabel($key));?></label>
						<div class="col-sm-3">
							<p class="form-control-static">
								<input type="checkbox" name="Employee[Attributes][]" class="form-control-label"  value="<?php echo $key; ?>" />
							</p>
						</div>
					</div>
					<?php } ?>
				</div>
				<div class="form-group row">
					<div class="col-sm-12">
						<p class="form-control-static">
							<?php echo CHtml::submitButton('Generate', array('class'=>'btn btn-inline')); ?>
						</p>
					</div>
				</div>
			</div>
			<div class="col-sm-6">
				<div id="designation" style="margin-bottom:10px;" class="col-sm-12">
					<div style="background: #333;padding: 5px;" class="col-sm-12" >
						<input type="text" class="designation-list-search" size="40" placeholder="SEARCH DESIGNATION" onkeyup="search(this, 'designation');" style="width: 55%;"/><span style="float: right;color: #FFF;"><input type="checkBox" class="designation-select-all" onclick="selectList('designation');"> SELECT ALL</span>
					</div>
					<ul style="background: rgb(204, 204, 204);padding: 10px;height: 200px;overflow-y: scroll;" class="col-sm-12">
					<?php 
						$Designations = Designations::model()->findAll();
						foreach($Designations as $designation){
							?>
								<li><input type="checkbox" name="Employee[Designations][]" value="<?php echo $designation->ID; ?>"> <span><?php echo $designation->DESIGNATION?></span></li>
							<?php
						}
					?>
					</ul>
				</div>
				<div id="pension-type" style="margin-bottom:10px;" class="col-sm-12">
					<div style="background: #333;padding: 5px;">
						<input type="text" class="pension-type-list-search" size="40" placeholder="SEARCH PENSION TYPE" onkeyup="search(this, 'pension-type');" style="width: 55%;"/><span style="float: right;color: #FFF;"><input type="checkBox" class="pension-type-select-all" onclick="selectList('pension-type');"> SELECT ALL</span>
					</div>
					<ul style="background: rgb(204, 204, 204);padding: 10px;height: 100px;overflow-y: scroll;">
						<li><input type="checkbox" name="Employee[PENSION][]" value="'OPS'"> <span>OLD PENSION SCHEME</span></li>
						<li><input type="checkbox" name="Employee[PENSION][]" value="'NPS'"> <span>NEW PENSION SCHEME</span></li>
					</ul>
				</div>
				<div id="uniform" style="margin-bottom:10px;" class="col-sm-12">
					<div style="background: #333;padding: 5px;">
						<input type="text" class="uniform-list-search" size="40" placeholder="SEARCH UNIFORM ALLOWANCE ELLIGIBLE" onkeyup="search(this, 'uniform');" style="width: 55%;"/><span style="float: right;color: #FFF;"><input type="checkBox" class="uniform-select-all" onclick="selectList('uniform');"> SELECT ALL</span>
					</div>
					<ul style="background: rgb(204, 204, 204);padding: 10px;height: 100px;overflow-y: scroll;">
						<li><input type="checkbox" name="Employee[UA][]" value="0"> <span>ELLIGIBLE</span></li>
						<li><input type="checkbox" name="Employee[UA][]" value="1"> <span>NOT ELLIGIBLE</span></li>
					</ul>
				</div>
				<div id="bonus" style="margin-bottom:10px;" class="col-sm-12">
					<div style="background: #333;padding: 5px;">
						<input type="text" class="bonus-list-search" size="40" placeholder="SEARCH AD-HOC BONUS ELLIGIBLE" onkeyup="search(this, 'bonus');" style="width: 55%;"/><span style="float: right;color: #FFF;"><input type="checkBox" class="bonus-all" onclick="selectList('bonus');"> SELECT ALL</span>
					</div>
					<ul style="background: rgb(204, 204, 204);padding: 10px;height: 100px;overflow-y: scroll;">
						<li><input type="checkbox" name="Employee[BONUS][]" value="0"> <span>ELLIGIBLE</span></li>
						<li><input type="checkbox" name="Employee[BONUS][]" value="1"> <span>NOT ELLIGIBLE</span></li>
					</ul>
				</div>
				<div id="gender" style="margin-bottom:10px;" class="col-sm-12">
					<div style="background: #333;padding: 5px;">
						<input type="text" class="gender-list-search" size="40" placeholder="SEARCH GENDER" onkeyup="search(this, 'gender');" style="width: 55%;"/><span style="float: right;color: #FFF;"><input type="checkBox" class="gender-all" onclick="selectList('gender');"> SELECT ALL</span>
					</div>
					<ul style="background: rgb(204, 204, 204);padding: 10px;height: 100px;overflow-y: scroll;">
						<li><input type="checkbox" name="Employee[GENDER][]" value="'Male'"> <span>MALE</span></li>
						<li><input type="checkbox" name="Employee[GENDER][]" value="'Female'"> <span>FEMALE</span></li>
					</ul>
				</div>
			</div>
		</div>
		<?php 
			
		$this->endWidget(); ?>
	</div>
</div>
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
function selectList(list){
	var ul, li, i;
	ul = $("#"+list+" ul");
	li = ul.find('li');

	// Loop through all list items, and hide those who don't match the search query
	for (i = 0; i < li.length; i++) {
		checkbox = li[i].getElementsByTagName("input")[0];
		if (checkbox.checked) {
			checkbox.checked = false;
		} else {
			checkbox.checked = true;
		}
	}
}

</script>

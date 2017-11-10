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
					<h2>Employee Search</h2>
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
					<div class="col-sm-12 list-header" >
						<label>DESIGNATION</label>
						<input type="text" class="designation-list-search" size="40" placeholder="SEARCH" onclick="stopPropagation(event);" onkeyup="search(this, 'designation');" style="width: 55%;"/>
						<span style="float: right;color: #FFF;"><input type="checkBox" class="designation-select-all" onclick="selectList(event, 'designation');"> SELECT ALL</span>
					</div>
					<ul class="col-sm-12 list closed">
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
					<div class="list-header">
						<label>PENSION TYPE</label>
						<span style="float: right;color: #FFF;"><input type="checkBox" class="pension-type-select-all" onclick="selectList(event, 'pension-type');"> SELECT ALL</span>
					</div>
					<ul class="list closed">
						<li><input type="checkbox" name="Employee[PENSION][]" value="'OPS'"> <span>OLD PENSION SCHEME</span></li>
						<li><input type="checkbox" name="Employee[PENSION][]" value="'NPS'"> <span>NEW PENSION SCHEME</span></li>
					</ul>
				</div>
				<div id="uniform" style="margin-bottom:10px;" class="col-sm-12">
					<div class="list-header">
						<label>UA ELLIGIBLE</label>
						<span style="float: right;color: #FFF;"><input type="checkBox" class="uniform-select-all" onclick="selectList(event, 'uniform');"> SELECT ALL</span>
					</div>
					<ul class="list closed">
						<li><input type="checkbox" name="Employee[UA][]" value="0"> <span>ELLIGIBLE</span></li>
						<li><input type="checkbox" name="Employee[UA][]" value="1"> <span>NOT ELLIGIBLE</span></li>
					</ul>
				</div>
				<div id="bonus" style="margin-bottom:10px;" class="col-sm-12">
					<div class="list-header">
						<label>BONUS ELLIGIBLE</label>
						<span style="float: right;color: #FFF;"><input type="checkBox" class="bonus-all" onclick="selectList(event, 'bonus');"> SELECT ALL</span>
					</div>
					<ul class="list closed">
						<li><input type="checkbox" name="Employee[BONUS][]" value="0"> <span>ELLIGIBLE</span></li>
						<li><input type="checkbox" name="Employee[BONUS][]" value="1"> <span>NOT ELLIGIBLE</span></li>
					</ul>
				</div>
				<div id="gender" style="margin-bottom:10px;" class="col-sm-12">
					<div class="list-header">
						<label>GENDER</label>
						<span style="float: right;color: #FFF;"><input type="checkBox" class="gender-all" onclick="selectList(event, 'gender');"> SELECT ALL</span>
					</div>
					<ul class="list closed">
						<li><input type="checkbox" name="Employee[GENDER][]" value="'Male'"> <span>MALE</span></li>
						<li><input type="checkbox" name="Employee[GENDER][]" value="'Female'"> <span>FEMALE</span></li>
					</ul>
				</div>
				<div id="quarter-alloc" style="margin-bottom:10px;" class="col-sm-12">
					<div class="list-header">
						<label>QUARTER ALLOTED</label>
						<span style="float: right;color: #FFF;"><input type="checkBox" class="quarter-alloc-select-all" onclick="selectList(event, 'quarter-alloc');"> SELECT ALL</span>
					</div>
					<ul class="list closed">
						<li><input type="checkbox" name="Employee[QUARTER_ALLOCATE][]" value="0"> <span>NO</span></li>
						<li><input type="checkbox" name="Employee[QUARTER_ALLOCATE][]" value="1"> <span>YES</span></li>
					</ul>
				</div>
				<div id="permanent" style="margin-bottom:10px;" class="col-sm-12">
					<div class="list-header">
						<label>PERMANENT</label>
						<span style="float: right;color: #FFF;"><input type="checkBox" class="permanent-select-all" onclick="selectList(event, 'permanent');"> SELECT ALL</span>
					</div>
					<ul class="list closed">
						<li><input type="checkbox" name="Employee[IS_PERMANENT][]" value="0"> <span>NO</span></li>
						<li><input type="checkbox" name="Employee[IS_PERMANENT][]" value="1"> <span>YES</span></li>
					</ul>
				</div>
				<div id="transfered" style="margin-bottom:10px;" class="col-sm-12">
					<div class="list-header">
						<label>TRANSFERED</label>
						<span style="float: right;color: #FFF;"><input type="checkBox" class="transfered-select-all" onclick="selectList(event, 'transfered');"> SELECT ALL</span>
					</div>
					<ul class="list closed">
						<li><input type="checkbox" name="Employee[IS_TRANSFERRED][]" value="0"> <span>NO</span></li>
						<li><input type="checkbox" name="Employee[IS_TRANSFERRED][]" value="1"> <span>YES</span></li>
					</ul>
				</div>
				<div id="retired" style="margin-bottom:10px;" class="col-sm-12">
					<div class="list-header">
						<label>RETIRED</label>
						<span style="float: right;color: #FFF;"><input type="checkBox" class="retired-select-all" onclick="selectList(event, 'retired');"> SELECT ALL</span>
					</div>
					<ul class="list closed">
						<li><input type="checkbox" name="Employee[IS_RETIRED][]" value="0"> <span>NO</span></li>
						<li><input type="checkbox" name="Employee[IS_RETIRED][]" value="1"> <span>YES</span></li>
					</ul>
				</div>
				<div id="suspended" style="margin-bottom:10px;" class="col-sm-12">
					<div class="list-header">
						<label>SUSPENDED</label>
						<span style="float: right;color: #FFF;"><input type="checkBox" class="suspended-select-all" onclick="selectList(event, 'suspended');"> SELECT ALL</span>
					</div>
					<ul class="list closed">
						<li><input type="checkbox" name="Employee[IS_SUSPENDED][]" value="0"> <span>NO</span></li>
						<li><input type="checkbox" name="Employee[IS_SUSPENDED][]" value="1"> <span>YES</span></li>
					</ul>
				</div>
				<div id="hra-slab" style="margin-bottom:10px;" class="col-sm-12">
					<div class="list-header">
						<label>HRA SLAB</label>
						<span style="float: right;color: #FFF;"><input type="checkBox" class="hra-slab-select-all" onclick="selectList(event, 'hra-slab');"> SELECT ALL</span>
					</div>
					<ul class="list closed">
						<?php 
							$slabs = HRASlabs::model()->findAll();
							foreach($slabs as $slab){
								?>
									<li><input type="checkbox" name="Employee[HRA_SLAB][]" value="<?php echo $slab->ID?>"><span><?php echo $slab->DESCRIPTION?></span></li>
								<?php
							}
						?>
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
function stopPropagation(event){
	event.stopPropagation();
}
function selectList(event, list){
	event.stopPropagation();
	//event.preventDefault();
	
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
$(document).ready(function(){
	$(".list-header").click(function(){
		if($(this).next(".list").hasClass("closed")){
			$(this).next(".list").removeClass("closed");
			$(this).next(".list").addClass("open");
		}
		else{
			$(this).next(".list").removeClass("open");
			$(this).next(".list").addClass("closed");
		}
	});
});

</script>

<style>
	.TRANSFERRED, .RETIRED, .SUSPENDED {
		background: #fd9595;
	}
	ul.list{
		overflow-y: scroll;
		border-left: 1px Solid #ccc;
	}
	ul.list.open{
		height: 300px;
	}
	ul.list.closed{
		height: 0;
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
	.list-header{
		height: 37px;
		cursor:pointer;
		background: #333;
		padding: 5px;
	}
	.list-header label{
		color: #FFF;
		display: inline-block;
	}
</style>

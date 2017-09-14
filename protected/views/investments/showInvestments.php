<?php $master = Master::model()->findByPK(1); ?>
<style>
label{width: 20.666667%}
</style>
<header class="section-header" >
	<div class="tbl">
		<div class="tbl-row">
			<div class="tbl-cell">
				<h2>Investments</h2>
				<div class="subtitle"></div>
			</div>
		</div>
	</div>
</header>
<div class="container-fluid">
	<div class="box-typical box-typical-padding">
		<?php $form=$this->beginWidget('CActiveForm', array(
			'id'=>'exp-form',
			'enableAjaxValidation'=>false,
		)); ?>
		<div class="form-group row">
			<label for="MONTH" class="col-sm-2 form-control-label">Select Employee</label>
			<div class="col-sm-10">
				<div id="employees" class="small-container">
					<div style="background: #333;padding: 5px;">
						<input type="text" class="employees-list-search" size="100" placeholder="SEARCH NAME" onkeyup="search(this, 'employees');"/>
					</div>
					<ul style="background: rgb(204, 204, 204);padding: 10px;height: 300px;overflow-y: scroll;">
					<?php
						$employees = Employee::model()->findAll(array('order'=>'DESIGNATION_ID_FK DESC')); 
						foreach($employees as $employee){
							?>
								<li><input type="radio" name="Investment[Employee][]" value="<?php echo $employee->ID;?>"><span><?php echo $employee->NAME.", ".Designations::model()->findByPK($employee->DESIGNATION_ID_FK)->DESIGNATION;?></span></li>
							<?php
						}
					?>
					</ul>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12">
				<div class="form-group row">
					<label></label>
					<div class="col-sm-10">
						<p class="form-control-static">
							<?php echo CHtml::submitButton('Show Investment', array('class'=>'btn btn-inline', 'name'=>'Investment[submit]')); ?>
						</p>
					</div>
				</div>
			</div>
		</div>
		<?php $this->endWidget(); ?>
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
</script>
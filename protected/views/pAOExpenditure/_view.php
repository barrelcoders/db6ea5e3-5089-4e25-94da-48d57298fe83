<?php 
	$monthName = array('1'=>'January', '2'=>'February', '3'=>'March', '4'=>'April', '5'=>'May', '6'=>'June', '7'=>'July', '8'=>'August', '9'=>'September', '10'=>'October', '11'=>'November', '12'=>'December');
	$yearName = array('2016'=>'2016', '2017'=>'2017', );
?>
	
	<div class="form-group row">
		<label class='col-sm-2 form-control-label'>MONTH</label>
		<div class="col-sm-10">
			<p class="form-control-static">
				<span><?php echo $monthName[$model->MONTH];?></span>
			</p>
		</div>
	</div>
	<div class="form-group row">
		<label class='col-sm-2 form-control-label'>YEAR</label>
		<div class="col-sm-10">
			<p class="form-control-static">
				<span><?php echo $model->YEAR;?></span>
			</p>
		</div>
	</div>
	<div class="form-group row">
		<label class='col-sm-2 form-control-label'>SALARY</label>
		<div class="col-sm-10">
			<p class="form-control-static">
				<span><?php echo $model->SALARY;?></span>
			</p>
		</div>
	</div>
	<div class="form-group row">
		<label class='col-sm-2 form-control-label'>MEDICAL</label>
		<div class="col-sm-10">
			<p class="form-control-static">
				<span><?php echo $model->MEDICAL;?></span>
			</p>
		</div>
	</div>
	<div class="form-group row">
		<label class='col-sm-2 form-control-label'>DTE</label>
		<div class="col-sm-10">
			<p class="form-control-static">
				<span><?php echo $model->DTE;?></span>
			</p>
		</div>
	</div>
	<div class="form-group row">
		<label class='col-sm-2 form-control-label'>OE</label>
		<div class="col-sm-10">
			<p class="form-control-static">
				<span><?php echo $model->OE;?></span>
			</p>
		</div>
	</div>
	<div class="form-group row">
		<label class='col-sm-2 form-control-label'>WAGES</label>
		<div class="col-sm-10">
			<p class="form-control-static">
				<span><?php echo $model->WAGES;?></span>
			</p>
		</div>
	</div>
	<div class="form-group row">
		<label class='col-sm-2 form-control-label'>RRT</label>
		<div class="col-sm-10">
			<p class="form-control-static">
				<span><?php echo $model->RRT;?></span>
			</p>
		</div>
	</div>
	<div class="form-group row">
		<label class='col-sm-2 form-control-label'>IT SALARY</label>
		<div class="col-sm-10">
			<p class="form-control-static">
				<span><?php echo $model->IT_SAL;?></span>
			</p>
		</div>
	</div>
	<div class="form-group row">
		<label class='col-sm-2 form-control-label'>IT ECSS</label>
		<div class="col-sm-10">
			<p class="form-control-static">
				<span><?php echo $model->IT_ECSS;?></span>
			</p>
		</div>
	</div>
	<div class="form-group row">
		<label class='col-sm-2 form-control-label'>IT HCESS</label>
		<div class="col-sm-10">
			<p class="form-control-static">
				<span><?php echo $model->IT_HCESS;?></span>
			</p>
		</div>
	</div>

</div>
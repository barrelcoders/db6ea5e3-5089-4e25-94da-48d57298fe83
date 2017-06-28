<?php $master = Master::model()->findByPK(1); ?>
<nav class="side-menu-additional" style="overflow-y: auto; padding: 0px; width: 250px;margin-left: 141px;">
	<div style="width: 219px; height: 700px;">
		<div class="" style="padding: 0px;    margin-top: 100px; width: 219px;padding-top: 0px!important;">
			<ul class="side-menu-additional-list" id="footer_action" style="display:none;">
				<li><a id="Monthly_Reconciliation" target="_blank" ><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">Reconciliation Letter</span></span></a></li>
				<li><a id="Monthly_BillStatus" target="_blank" ><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">Bill Status Report</span></span></a></li>
			</ul>
		</div>
	</div>
</nav>
<header class="section-header" style="margin-left: 225px;">
	<div class="tbl">
		<div class="tbl-row">
			<div class="tbl-cell">
				<h2>Reconciliation Report</h2>
				<div class="subtitle"></div>
			</div>
		</div>
	</div>
</header>
<div class="container-fluid">
	<div class="box-typical box-typical-padding" style="margin-left: 225px;">
	<?php $form=$this->beginWidget('CActiveForm', array(
		'id'=>'exp-form',
		'enableAjaxValidation'=>false,
	)); ?>

	<div class="form-group row">
		<label for="MONTH" class="col-sm-2 form-control-label">Select Month</label>
		<div class="col-sm-10">
			<p class="form-control-static">
				<select name="Expenditure[MONTH]" id="MONTH">
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
		<label for="YEAR" class="col-sm-2 form-control-label">Select Year</label>
		<div class="col-sm-10">
			<p class="form-control-static">
				<select name="Expenditure[YEAR]" id="YEAR">
					<option>2016</option>
					<option>2017</option>
				</select>
			</p>
		</div>
	</div>
	
	<div class="form-group row">
		<label class="col-sm-2 form-control-label"></label>
		<div class="col-sm-10">
			<p class="form-control-static">
				<?php echo CHtml::Button('Generate', array('id'=>'btnSubmit', 'class'=>'btn btn-inline')); ?>
			</p>
		</div>
	</div>
	
	<?php $this->endWidget(); ?>
	</div>
</div>
<script>
	$(document).ready(function(){
		$('#btnSubmit').click(function(){debugger;
			var month = $('#MONTH').val(),
				year = $('#YEAR').val();
			
			$('#Monthly_Reconciliation').attr('href', '<?php echo Yii::app()->createUrl('Expenditure/Monthly_Reconciliation'); ?>'+'&Month='+month+'&Year='+year);
			$('#Monthly_BillStatus').attr('href', '<?php echo Yii::app()->createUrl('Expenditure/BillStatus'); ?>'+'&Month='+month+'&Year='+year);
			
			$('#footer_action').show();
		});
		
	});
</script>
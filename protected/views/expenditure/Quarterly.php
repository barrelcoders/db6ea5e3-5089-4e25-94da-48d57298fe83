<?php $master = Master::model()->findByPK(1); ?>
<nav class="side-menu-additional" style="overflow-y: auto; padding: 0px; width: 250px;margin-left: 141px;">
	<div style="width: 219px; height: 700px;">
		<div class="" style="padding: 0px;    margin-top: 100px; width: 219px;padding-top: 0px!important;">
			<ul class="side-menu-additional-list" id="footer_action" style="display:none;">
				<li><a id="Quarterly_ANNEXURE_I" target="_blank" ><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">ANNEXURE I</span></span></a></li>
				<li><a id="Quarterly_ANNEXURE_II" target="_blank" ><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">ANNEXURE II</span></span></a></li>
				<li><a id="Quarterly_ANNEXURE_III" target="_blank" ><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">ANNEXURE III</span></span></a></li>
			</ul>
		</div>
	</div>
</nav>
<header class="section-header" style="margin-left: 225px;">
	<div class="tbl">
		<div class="tbl-row">
			<div class="tbl-cell">
				<h2>Quarterly Expenditure</h2>
				<div class="subtitle"></div>
			</div>
		</div>
	</div>
</header>
<div class="container-fluid">
	<div class="box-typical box-typical-padding" style="margin-left: 225px;">
		<?php $form=$this->beginWidget('CActiveForm', array(
			'id'=>'bill-form',
			// Please note: When you enable ajax validation, make sure the corresponding
			// controller action is handling ajax validation correctly.
			// There is a call to performAjaxValidation() commented in generated controller code.
			// See class documentation of CActiveForm for details on this.
			'enableAjaxValidation'=>false,
		)); ?>

		<div class="form-group row">
			<label for="QUARTER" class="col-sm-2 form-control-label">Select Quarter</label>
			<div class="col-sm-10">
				<p class="form-control-static">
					<select name="Expenditure[QUARTER]" id="QUARTER">
						<option value="1-3">January-Mar</option>
						<option value="4-6">April-June</option>
						<option value="7-9">July-September</option>
						<option value="10-12">October-December</option>
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
			<label for="" class="col-sm-2 form-control-label"></label>
			<div class="col-sm-10">
				<p class="form-control-static">
					<?php echo CHtml::Button('Generate', array('id'=>'btnSubmit', 'class'=>'btn btn-inline')); ?>
				</p>
			</div>
		</div>
		<?php $this->endWidget(); ?>
	</div>
</div><!-- form -->
<script>
	$(document).ready(function(){
		$('#btnSubmit').click(function(){debugger;
			var quarter = $('#QUARTER').val(),
				year = $('#YEAR').val();
			
			$('#Quarterly_ANNEXURE_I').attr('href', '<?php echo Yii::app()->createUrl('Expenditure/Quarterly_ANNEXURE_I'); ?>'+'&Quarter='+quarter+'&Year='+year);
			$('#Quarterly_ANNEXURE_II').attr('href', '<?php echo Yii::app()->createUrl('Expenditure/Quarterly_ANNEXURE_II'); ?>'+'&Quarter='+quarter+'&Year='+year);
			$('#Quarterly_ANNEXURE_III').attr('href', '<?php echo Yii::app()->createUrl('Expenditure/Quarterly_ANNEXURE_III'); ?>'+'&Quarter='+quarter+'&Year='+year);
			$('#footer_action').show();
		});
		
	});
</script>
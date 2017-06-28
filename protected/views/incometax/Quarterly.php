<?php $master = Master::model()->findByPK(1); ?>
<nav class="side-menu-additional" style="overflow-y: auto; padding: 0px; width: 250px;margin-left: 141px;">
	<div style="width: 219px; height: 700px;">
		<div class="" style="padding: 0px;    margin-top: 100px; width: 219px;padding-top: 0px!important;">
			<ul class="side-menu-additional-list" id="footer_action" style="display:none;">
				<li><a id="Quarterly_IT" target="_blank"><span class="tbl-row"><span class="tbl-cell tbl-cell-caption">Quarterly Report</span></span></a></li>
			</ul>
		</div>
	</div>
</nav>
<header class="section-header" style="margin-left: 225px;">
	<div class="tbl">
		<div class="tbl-row">
			<div class="tbl-cell">
				<h2>Quarterly Income Tax</h2>
				<div class="subtitle"></div>
			</div>
		</div>
	</div>
</header>
<div class="container-fluid">
	<div class="box-typical box-typical-padding" style="margin-left: 225px;">
		<?php $form=$this->beginWidget('CActiveForm', array(
			'id'=>'bill-form',
			'enableAjaxValidation'=>false,
		)); ?>

		<div class="form-group row">
			<label for="QUARTER" class="col-sm-2 form-control-label">Select Quarter</label>
			<div class="col-sm-10">
				<p class="form-control-static">
					<select name="IncomeTax[PERIOD]" id="PERIOD">
						<option value="4-6-2017">April-June 2017</option>
						<option value="7-9-2017">July-September 2017</option>
						<option value="10-12-2017">October-December 2017</option>
						<option value="1-3-2018">January-Mar 2018</option>
						<option value="4-6-2018">April-June 2018</option>
						<option value="7-9-2018">July-September 2018</option>
						<option value="10-12-2018">October-December 2018</option>
						<option value="1-3-2019">January-Mar 2019</option>
						<option value="4-6-2019">April-June 2019</option>
						<option value="7-9-2019">July-September 2019</option>
						<option value="10-12-2019">October-December 2019</option>
						<option value="1-3-2020">January-Mar 2020</option>
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
			var period = $('#PERIOD').val().split("-");
			
			$('#Quarterly_IT').attr('href', '<?php echo Yii::app()->createUrl('IncomeTax/QuarterlyIT'); ?>'+'&startMonth='+period[0]+'&endMonth='+period[1]+'&Year='+period[2]);
			$('#footer_action').show();
		});
		
	});
</script>
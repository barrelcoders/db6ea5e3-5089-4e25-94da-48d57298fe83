<?php 
	$monthName = array('1'=>'January', '2'=>'February', '3'=>'March', '4'=>'April', '5'=>'May', '6'=>'June', '7'=>'July', '8'=>'August', '9'=>'September', '10'=>'October', '11'=>'November', '12'=>'December');
	$yearName = array('2016'=>'2016', '2017'=>'2017', );
?>
<div class="container-fluid">
	<header class="section-header">
		<div class="tbl">
			<div class="tbl-row">
				<div class="tbl-cell">
					<h2>View PAO Expenditure for <?php echo $monthName[$model->MONTH]."-".$model->YEAR; ?></h2>
					<div class="subtitle"></div>
				</div>
			</div>
		</div>
	</header>
	<div class="box-typical box-typical-padding">
		<?php $this->renderPartial('_view', array('model'=>$model)); ?>
	</div>
</div>

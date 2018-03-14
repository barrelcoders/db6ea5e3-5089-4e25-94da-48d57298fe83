<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/oneadmin.css" rel="stylesheet">
<script type="text/javascript">window.onload = function() { window.print(); }</script>
<table class="table table-bordered table-hover" style="margin-bottom: 10px;">
	<tr>
		<td colspan="5">
			<?php echo $model->BILL_TITLE; ?>
		</td>
		<td colspan="3">
			<span style="float: right;"><?php echo $model->BILL_NO; ?></span>
		</td>
	</tr>
</table>
 <table  class="pay-schedule-table" style="margin-bottom: 10px;">
	<tr>
		<th class="small-xxx left-br right-br">S.No.</th>
		<th class="right-br">Tasks</th>
	</tr>
<?php 
	$i = 1;
	foreach($changes as $value){?>
<tr>
	<td class="small-xxx left-br right-br"><?php echo $i;?></td>
	<td class="right-br left-text"><?php echo $value;?></td>
</tr>
<?php 
	$i++;
} ?>
</table>
<style>
	.notified{
		background: #c5fbc5;
		color: #000;
	}
	.not-notified{
		background: #fbb;
		color: #000;
	}
	.left-text{
		text-align: left !important;
	}
</style>
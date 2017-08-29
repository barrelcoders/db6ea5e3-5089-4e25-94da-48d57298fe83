<?php

	Yii::app()->clientScript->registerScript('search', "
	$('.search-button').click(function(){
		$('.search-form').toggle();
		return false;
	});
");
?>
<style>
.pending {background: #FFF;/*background: #ffdaa2;*/}
.passed {background: #bfe0ba;}
tr.selected{background: #FFF;}
table.table.table-bordered.table-hover{font-size: 14px;}
</style>

<div class="container-fluid">
	<header class="section-header">
		<div class="tbl">
			<div class="tbl-row">
				<div class="tbl-cell">
					<h2>Manage Bills</h2>
					<div class="subtitle"><?php echo CHtml::link('Search Bills','#',array('class'=>'search-button')); ?></div>
				</div>
			</div>
		</div>
	</header>
	<div class="box-typical box-typical-padding search-form" style="display:none">
		<?php $this->renderPartial('_search',array(
			'model'=>$model,
		)); ?>
	</div>
	<div class="box-typical box-typical-padding">
		<?php $this->widget('zii.widgets.grid.CGridView', array(
			'id'=>'bill-grid',
			'itemsCssClass' => 'table table-bordered table-hover',
			'dataProvider'=>$model->search(array()),
			'rowCssClassExpression'=>'($data->PFMS_STATUS == "Generated")? "pending" : "passed"',
			'columns'=>array(
				array('header'=>'SN.',
					  'value'=>'++$row',
				),
				array(
					'header'=>'BILL NO',
					'type'=>'raw',
					'value'=>function ($data){ 
							return '<span style="color:#1fbad6;">'.$data->PFMS_BILL_NO.'</span><br><span style="color:#000;">'.$data->BILL_NO.'</span>';
					}
				), 
				array(
					'name'=>'BILL_TITLE',
					'type'=>'raw',
					'value'=>function ($data){ 
							return '<a href='.Yii::app()->createUrl('bill/update', array('id'=>$data->ID)).' target="_blank" style="color:#000;border-bottom:none;text-decoration:underline;">'.$data->BILL_TITLE.'</a>';
					}
				), 
				array(
					'name'=>'PFMS_STATUS',
					'type'=>'raw',
					'id' => 'PFMS_STATUS',
					'value'=>function($data){
						if($data->PFMS_STATUS == "Passed"){
							echo $data->PFMS_STATUS;
						}
						else{
							return "<input type='hidden' value='$data->ID'>"
							."<input type='date'>"
							.CHtml::dropDownList('PFMS_STATUS', null, array('Generated'=>'Generated', 'Passed'=>'Passed'), array('options'=>array($data->PFMS_STATUS => array('selected'=>true)), 'class'=>'billStatusType'));
							
						}
					}
				),

				array(
					'header'=>'BILL TYPE',
					'name'=>'BILL_TYPE',
					'type'=>'raw',
					'value'=>function ($data){ 
							return '<span style="color:#1fbad6;">'.BillType::model()->findByPK($data->BILL_TYPE)->TYPE."</span><br>".BillSubType::model()->findByPK($data->BILL_SUB_TYPE)->SUB_TYPE;
					}
				), 
				array(
					'header'=>'AMOUNT',
					'name'=>'BILL_AMOUNT',
					'type'=>'raw',
					'value'=>function ($data){ 
							return $data->BILL_AMOUNT;
					}
				), 
			),
		)); ?>
	</div>
</div>

<script>
$(document).ready(function(){
	$('.billStatusType').change(function(){
		var status = $(this).val(), bill_id = $(this).prev().prev().val(), date = $(this).prev().val();
		$.post( '<?php echo Yii::app()->createUrl('Bill/ChangeStatus')?>', { 'status': status, 'bill_id': bill_id, 'date': date}, function(result) {
			if(result == 'SUCCESS'){
				window.location.reload();	
			}
			else{
				alert('Error updating status, Please try again later');
			}
		   
		});
		
	});	
});
</script>
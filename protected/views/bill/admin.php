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
				array( 'header'=>'',
					'type'=>'raw',
					'value'=>function ($data){ 
						$text = "";
						if($data->RELATED_BILL_ID != 0){
							$text = "<br><a href='".Yii::app()->createUrl('bill/update', array('id'=>$data->RELATED_BILL_ID))."' target='_blank'
							title='".Bill::model()->findByPK($data->RELATED_BILL_ID)->BILL_TITLE."'><i class='fa fa-link'></i></a>";
						}
						else{
							$text = "<br><i class='fa fa-dot-circle-o'></i>";
						}
						return $text;
					}
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
							return '<a href='.Yii::app()->createUrl('bill/update', array('id'=>$data->ID)).' style="color:#000;border-bottom:none;text-decoration:underline;">'.$data->BILL_TITLE.'</a>';
					}
				), 
				array(
					'name'=>'PFMS_STATUS',
					'type'=>'raw',
					'id' => 'PFMS_STATUS',
					'value'=>function($data){
						if(strpos($data->BILL_TITLE, "HONORARIUM") > -1){
							echo "This bill can't be passed (Contact Admin)";
						}
						else{
							if($data->IS_PASSED){
								echo $data->PFMS_STATUS;
							}
							else{
								return "<input type='hidden' value='$data->ID'>"
								."<input type='date'>"
								.CHtml::dropDownList('PFMS_STATUS', null, array('Generated'=>'Generated', 'Passed'=>'Passed'), array('options'=>array($data->PFMS_STATUS => array('selected'=>true)), 'class'=>'billStatusType'));
								
							}
						}
					}
				),

				array(
					'name'=>'PASSED_DATE',
					'type'=>'raw',
					'id' => 'PASSED_DATE',
					'value'=>function($data){
						return date('d-M-Y', strtotime($data->PASSED_DATE));
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
				array(
					'class'=>'CButtonColumn',
					'htmlOptions' => array('style'=>'width:150px'),
					'template' => '{regenerate}',
					'buttons'=>array
					(
						'regenerate' => array
						(
							'url'=>'Yii::app()->createUrl("Bill/ReGenerate", array("id"=>$data->ID))',
							'options'=>array('class'=>'btn btn-rounded btn-inline btn-success'),
							'visible'=>function($row, $data){
								return (strtoupper($data->PFMS_STATUS) == "PASSED");
							},
							'click'=>'function(){return confirm("Are you sure wants to regenerate this bill ?");}',
							'imageUrl'=>'',
							'label'=>'Regenerate',
						),
					),
				),
			),
		)); ?>
	</div>
</div>
<style>
	a{color:#000; text-decoration: none;border:none !important;margin-right: 5px;}
	a:hover, a:visited, a:active{color:#000;text-decoration: underline;}
</style>
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
function regenerateBill(id){
	alert(id);
}
</script>
<?php
/* @var $this EmployeeController */
/* @var $model Employee */

$this->breadcrumbs=array(
	'Employees'=>array('index'),
	'Manage',
);
$employees = Employee::model()->findAll();
$EMPLOYEE_COUNT = count($employees);
$FOLIO_ARRAY = array();
for($i=1; $i<=$EMPLOYEE_COUNT; $i++){
	$FOLIO_ARRAY[$i]=$i;
}
?>
<div class="container-fluid">
	<header class="section-header">
		<div class="tbl">
			<div class="tbl-row">
				<div class="tbl-cell">
					<!--<h2></h2>-->
					<div class="subtitle"></div>
				</div>
			</div>
		</div>
	</header>
	<div class="box-typical box-typical-padding">
		<?php $this->renderPartial('_search',array(
			'model'=>$model,
		)); ?>
	</div>
	<div class="box-typical box-typical-padding">
		<?php $this->widget('zii.widgets.grid.CGridView', array(
			'id'=>'employee-grid',
			'itemsCssClass' => 'table table-bordered table-hover',
			'dataProvider'=>$model->search(),
			'columns'=>array(
				array(
					'header'=>'NAME',
					'name'=>'NAME',
					'type'=>'raw',
					'value'=>function ($data){ 
						$status="";
						if($data->IS_TRANSFERRED == 1){
							$status="TRANSFERRED on ".date("d-m-Y", strtotime($data->CURRENT_OFFICE_RELIEF_DATE))." to ".$data->TRANSFERED_TO;
						}
						if($data->IS_RETIRED == 1){
							$status="RETIRED on ".date("d-m-Y", strtotime($data->GOVT_SERVICE_EXIT_DATE));
						}
						if($data->IS_SUSPENDED == 1){
							$status="SUSPENDED on ".date("d-m-Y", strtotime($data->SUSPENSION_DATE));
						}
								
						return $data->NAME."<br><span style='color:#f00;font-size:10px;'>".$status."</span>";
					},
				),
				
				
				array(
					'header'=>'EIS Code',
					'name'=>'EIS_CODE',
					'type'=>'raw',
					'value'=>function ($data){ 
						$eis_code_text = "";
						if($data->EIS_CODE == ""){
							$eis_code_text = "<input type='hidden' value='".$data->ID."'><input type='text' class='txtEISCode'/>" ;
						}
						else{
							$eis_code_text = $data->EIS_CODE;
						}
						return $eis_code_text;
					}
				),
				
				array(
					'header'=>'DOB',
					'name'=>'DOB',
					'type'=>'raw',
					'value'=>function ($data){ 
						return date('d-m-Y', strtotime($data->DOB));
					}
				),
				/*array(
					'header'=>'ENTRY',
					'type'=>'raw',
					'value'=>function ($data){ 
						$content="";
						if($data->CURRENT_POST_JOIN_DATE != '0000-00-00' && $data->JOIN_DESIGNATION_ID_FK !=0){
							$content=date('d-m-Y', strtotime($data->CONTROLLER_JOIN_DATE)).", ".Designations::model()->findByPK($data->JOIN_DESIGNATION_ID_FK)->DESIGNATION;
						}
						return $content;
					}
				),*/
				array(
					'header'=>'DESIGNATION',
					'name'=>'DESIGNATION_ID_FK',
					'type'=>'raw',
					'value'=>function ($data){ 
							return Designations::model()->findByPK($data->DESIGNATION_ID_FK)->DESIGNATION;
					}
				), 
				/*array(
					'name'=>'CURRENT_POST_JOIN_DATE',
					'type'=>'raw',
					'value'=>function ($data){ 
							return date('d-m-Y', strtotime($data->CURRENT_POST_JOIN_DATE));
					}
				),
				array(
					'header'=>'AGE',
					'type'=>'raw',
					'value'=>function ($data){ 
							$date_1 = new DateTime($data->DOB);
							$date_2 = new DateTime(date('d-m-Y'));
							$difference = $date_2->diff( $date_1 );
							return (string)$difference->y;
					}
				),
				array(
					'header'=>'SERVICE YEAR',
					'type'=>'raw',
					'value'=>function ($data){ 
							$date_1 = new DateTime($data->CONTROLLER_JOIN_DATE);
							$date_2 = new DateTime(date('d-m-Y'));
							$difference = $date_2->diff( $date_1 );
							return (string)$difference->y;
					}
				),
				array(
					'header'=>'GROUP',
					'name'=>'GROUP_ID_FK',
					'type'=>'raw',
					'value'=>function ($data){ 
							return Groups::model()->findByPK($data->GROUP_ID_FK)->GROUP_NAME;
					}
				),
				array(
					'header'=>'Pay Matrix',
					'name'=>'PAY_MATRIX_ID_FK',
					'type'=>'raw',
					'value'=>function ($data){ 
							$matrix = "";
							if($data->PAY_MATRIX_ID_FK != 0){
								$matrix = PayMatrix::model()->findByPK($data->PAY_MATRIX_ID_FK);
								$matrix = "Basic: ".$matrix->BASIC." (Level: ".$matrix->LEVEL." Index: ".$matrix->INDEX.")";
							}
							
							return $matrix;
					}
				),
				'PENSION_TYPE',
				'PENSION_ACC_NO', */
				array(
					'name'=>'FOLIO_NO',
					'type'=>'raw',
					'id' => 'FOLIO_NO',
					'value'=>function($data) use($FOLIO_ARRAY){
						$folio_text = "";
						if($data->FOLIO_NO == '' || $data->FOLIO_NO == 0){
							$folio_text = "<input type='hidden' value='$data->ID'><input type='text' class='txtFolio' size='10'>";
						}
						else{
							$folio_text = $data->FOLIO_NO;
						}
						return $folio_text;
					}
				),
				array(
					'name'=>'POSTING_ID_FK',
					'type'=>'raw',
					'id' => 'POSTING_ID_FK',
					'value'=>function($data){
						$posting_text = "";
						if($data->POSTING_ID_FK == 0){
							$posting_text = "<input type='hidden' value='$data->ID'>" .CHtml::dropDownList('POSTING_ID_FK', null, CHtml::listData(Posting::model()->findAll(), 'ID', 'PLACE'),
							array('empty'=>array('0'=>''), 'options'=>array($data->POSTING_ID_FK => array('selected'=>true)), 'class'=>'slPosting'));
						}
						else{
							$posting_text = Posting::model()->findByPK($data->POSTING_ID_FK)->PLACE;
						}
						return $posting_text;
					}
				),
				array(
					'name'=>'PAY_MATRIX_ID_FK',
					'type'=>'raw',
					'id' => 'PAY_MATRIX_ID_FK',
					'value'=>function($data){
						$matrix = "";
						if($data->PAY_MATRIX_ID_FK == 0){
							$matrix = "<input type='hidden' value='$data->ID'>" .CHtml::dropDownList('PAY_MATRIX_ID_FK', null, CHtml::listData(PayMatrix::model()->findAll(), 'ID', 'TEXT'), 
							array('empty'=>array('0'=>''), 'options'=>array($data->PAY_MATRIX_ID_FK => array('selected'=>true)), 'class'=>'slPayMatrix'));
						}
						else{
							$matrix = PayMatrix::model()->findByPK($data->PAY_MATRIX_ID_FK)->TEXT;
						}
						return $matrix;
					}
				),
				array(
					'class'=>'CButtonColumn',
					'htmlOptions' => array('style'=>'width:150px'),
					'template' => '{view}{update}{salaryAdd}{investments}{incometax}',
					//{delete}
					'buttons'=>array
					(
						'view' => array
						(
							'url'=>'Yii::app()->createUrl("Employee/View", array("id"=>$data->ID))',
							'options'=>array('class'=>'glyphicon glyphicon-search'),
							'imageUrl'=>'',
							'label'=>'',
						),
						'update' => array
						(
							'url'=>'Yii::app()->createUrl("Employee/Update", array("id"=>$data->ID))',
							'options'=>array('class'=>'glyphicon glyphicon-pencil', 'target'=>"_blank",),
							'imageUrl'=>'',
							'label'=>'',
						),
						'salaryAdd' => array
						(
							'url'=>'Yii::app()->createUrl("SupplementarySalaryDetails/Update", array("id"=>$data->ID))',
							'options'=>array('class'=>'fa fa-rupee', 'target'=>"_blank", 'title'=>'Previous Office Salaries'),
							'imageUrl'=>'',
							'label'=>'',
						),
						'investments' => array
						(
							'url'=>'Yii::app()->createUrl("Investments/Update", array("id"=>$data->ID))',
							'options'=>array('class'=>'fa fa-bank', 'target'=>"_blank", 'title'=>'Investments'),
							'imageUrl'=>'',
							'label'=>'',
						),
						'incometax' => array
						(
							'url'=>'Yii::app()->createUrl("IncomeTax/SelectEmployeesForForm16", array("id"=>$data->ID))',
							'options'=>array('class'=>'fa fa-table', 'target'=>"_blank", 'title'=>'Provisional Form-16'),
							'imageUrl'=>'',
							'label'=>'',
						),
						/*'delete' => array
						(
							'url'=>'Yii::app()->createUrl("Employee/Delete", array("id"=>$data->ID))',
							'options'=>array('class'=>'glyphicon glyphicon-trash'),
							'imageUrl'=>'',
							'label'=>''
						),*/
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
	$('.slPayMatrix').change(function(){
		var element = $(this), matrix = element.val(), emp_id = element.prev().val();
		$.post('<?php echo Yii::app()->createUrl('Employee/SetEmployeeMatrix')?>', { 'matrix': matrix, 'emp_id': emp_id}, function(result) {
			var data = result.split("|");
			if(data[0] == 'SUCCESS'){
				element.parent().html(data[1]);
			}
			else{
				alert('Error updating Pay Matrix, Please try again later');
			}
		});
	});
	$('.slPosting').change(function(){
		var element = $(this), posting = element.val(), emp_id = element.prev().val();
		$.post('<?php echo Yii::app()->createUrl('Employee/SetPosting')?>', { 'posting': posting, 'emp_id': emp_id}, function(result) {
			var data = result.split("|");
			if(data[0] == 'SUCCESS'){
				element.parent().html(data[1]);
			}
			else{
				alert('Error updating Posting, Please try again later');
			}
		});
	});	
	$('.txtEISCode').keyup(function(e){
		if(e.which == 13) {		
			var element = $(this), code = element.val(), emp_id = element.prev().val();
			$.post('<?php echo Yii::app()->createUrl('Employee/SetEISCode')?>', { 'code': code, 'emp_id': emp_id}, function(result) {
				var data = result.split("|");
				if(data[0] == 'SUCCESS'){
					element.parent().html(data[1]);
				}
				else{
					alert('Error updating Posting, Please try again later');
				}
			});
		}
	});	
	$('.txtFolio').keyup(function(e){
		if(e.which == 13) {			
			var element = $(this), folio = element.val(), emp_id = element.prev().val();
			$.post('<?php echo Yii::app()->createUrl('Employee/SetFolio')?>', { 'folio': folio, 'emp_id': emp_id}, function(result) {
				var data = result.split("|");
				if(data[0] == 'SUCCESS'){
					element.parent().html(data[1]);
				}
				else{
					alert('Error updating Folio Number, Please try again later');
				}
			});
		}
	});	
});

function tableSearch(){
	var input, filter;
	input = document.getElementById('Employee_NAME');
	filter = input.value.toUpperCase();

	$('#employee-grid table tr').find("td:first").each(function(evt, element){
		element = $(element), row = element.parent('tr'), content = element.html();
		if (content.toUpperCase().indexOf(filter) > -1) {
			row.show();
		} else {
			row.hide();
		}
	});
}
</script>

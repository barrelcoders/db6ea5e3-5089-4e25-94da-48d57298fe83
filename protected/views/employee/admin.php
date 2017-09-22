<?php
/* @var $this EmployeeController */
/* @var $model Employee */

$this->breadcrumbs=array(
	'Employees'=>array('index'),
	'Manage',
);
?>
<div class="container-fluid">
	<header class="section-header">
		<div class="tbl">
			<div class="tbl-row">
				<div class="tbl-cell">
					<h2>Manage Employees</h2>
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
				'NAME',
				'NAME_HINDI',
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
						if($data->PRESENT_PROMOTION_DATE != '0000-00-00' && $data->JOIN_DESIGNATION_ID_FK !=0){
							$content=date('d-m-Y', strtotime($data->ORG_JOIN_DATE)).", ".Designations::model()->findByPK($data->JOIN_DESIGNATION_ID_FK)->DESIGNATION;
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
					'name'=>'PRESENT_PROMOTION_DATE',
					'type'=>'raw',
					'value'=>function ($data){ 
							return date('d-m-Y', strtotime($data->PRESENT_PROMOTION_DATE));
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
							$date_1 = new DateTime($data->ORG_JOIN_DATE);
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
				), */
				'PENSION_TYPE',
				'PENSION_ACC_NO',
				array(
					'name'=>'PAY_MATRIX_ID_FK',
					'type'=>'raw',
					'id' => 'PAY_MATRIX_ID_FK',
					'value'=>function($data){
						$matrix = "";
						if($data->PAY_MATRIX_ID_FK == 0){
							$matrix = "<input type='hidden' value='$data->ID'>" .CHtml::dropDownList('PAY_MATRIX_ID_FK', null, CHtml::listData(PayMatrix::model()->findAll(), 'ID', 'TEXT'), 
							array('options'=>array($data->PAY_MATRIX_ID_FK => array('selected'=>true)), 'class'=>'slPayMatrix'));
						}
						else{
							$matrix = PayMatrix::model()->findByPK($data->PAY_MATRIX_ID_FK)->TEXT;
						}
						return $matrix;
					}
				),
				array(
					'class'=>'CButtonColumn',
					'htmlOptions' => array('style'=>'width:100px'),
					'template' => '{view}{update}{salaryAdd}{investments}',
					//{delete}
					'buttons'=>array
					(
						'view' => array
						(
							'url'=>'Yii::app()->createUrl("Employee/View", array("id"=>$data->ID))',
							'options'=>array('class'=>'glyphicon glyphicon-search'),
							'imageUrl'=>'',
							'label'=>''
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
							'options'=>array('class'=>'fa fa-money', 'target'=>"_blank", 'title'=>'Mar-Jun 2017 Salary'),
							'imageUrl'=>'',
							'label'=>'',
						),
						'investments' => array
						(
							'url'=>'Yii::app()->createUrl("Investments/Update", array("id"=>$data->ID))',
							'options'=>array('class'=>'fa fa-user', 'target'=>"_blank", 'title'=>'Investments'),
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
	a:hover{color:#000;text-decoration: underline;}
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
});
</script>

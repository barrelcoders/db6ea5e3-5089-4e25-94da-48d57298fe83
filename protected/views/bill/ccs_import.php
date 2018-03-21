<div class="container-fluid">
	<header class="section-header">
		<div class="tbl">
			<div class="tbl-row">
				<div class="tbl-cell">
					<h2>Credit Co. Society File Import</h2>
					<div class="subtitle"><a href="<?php echo Yii::app()->createUrl('bill/update', array('id'=>$model->ID))?>"><?php echo $model->BILL_TITLE; ?></a></div>
				</div>
			</div>
		</div>
	</header>
	<div class="box-typical box-typical-padding">
		<?php 
			$form=$this->beginWidget('CActiveForm', 
				array(
					'id'=>'bill-form',
					'enableAjaxValidation'=>false,
					'htmlOptions' => array('enctype' => 'multipart/form-data'),
				)); 
		?>
		<form >
		<div class="form-group row">
			<label class='col-sm-2 form-control-label'>Select File</label>
			<div class="col-sm-4">
				<p class="form-control-static">
					<div><?php echo $form->fileField($model, 'CSS_FILE'); ?></div>
					<div>Allowed Files (*.xls, *.xlsx)</div>
				</p>
			</div>
			<div class="col-sm-6">
				<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/css_import.jpg" height="302" width="365"/>
			</div>
		</div>
		<div class="form-group row">
			<label class="col-sm-2 form-control-label"></label>
			<div class="col-sm-10">
				<p class="form-control-static">
					<?php echo CHtml::submitButton('Submit', array('class'=>'btn btn-inline')); ?>
				</p>
			</div>
		</div>
		<div>
			<?php echo $content;?>
		</div>
		<?php $this->endWidget(); ?>
	</div>
</div>
<script>
	$(document).ready(function(){
		$('.not-found-btn').click(function(event){
			event.stopPropagation();
			event.preventDefault();
			$(this).prev().toggle();
			return false;
		});
	});
	function removeParent(element){
		calculateCCSTotal();
		var current_content = "<div>"+$(element).parent('div').html()+"</div>",
			parent = $(element).parents('.td-parent'),
			parent_content = parent_content = parent.html();
		
		parent.empty();
		parent.html("<table class='table table-bordered table-hover'><tbody><tr><td>"+current_content+"</td></tr></tbody></table>");
			
		parent.find("table tr td").append('<a href="javascript:void(0);" onclick="undoClick();">Undo</a>');
		window.globalVar = {
			'parent': parent,
			'parent_content': parent_content
		};
	}
	function setCCSValue(element){
		var emp_id = $(element).val();
		$(element).prev().val(emp_id);
		$(element).prev().attr('name', 'Import['+emp_id+'][EMPLOYEE_ID_FK]');
		$(element).next().next().attr('name', 'Import['+emp_id+'][CCS]');
	}
	function setCCSValueForNotFound(element){
		var emp_id = $(element).val();
		$(element).parent().prev().prev().val(emp_id);
		$(element).parent().prev().prev().attr('name', 'Import['+emp_id+'][EMPLOYEE_ID_FK]');
		$(element).parent().prev().attr('name', 'Import['+emp_id+'][CCS]');
	}
	function undoClick(){
		calculateCCSTotal();
		$(window.globalVar.parent).html(window.globalVar.parent_content);
	}
	function calculateCCSTotal(){
		var total = 0;
		$('#ccs-import-table .ccs-amount').each(function(){
			total += parseInt($(this).val());
		});
		$('#ccs-total').val(total);
	}
	function validate() {
		var result = true;
		$( ".td-parent table" ).each(function(index, element) {
			if($(element).find('tr').length > 1){
				alert('Some employees have multiple entries. Please check');
				result = false;
				return false;
			}
		});
		return result;
	}
</script>


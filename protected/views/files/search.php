<?php
/* @var $this FilesController */
/* @var $model Files */

$this->breadcrumbs=array(
	'Files'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Files', 'url'=>array('index')),
	array('label'=>'Manage Files', 'url'=>array('admin')),
);
?>


<div class="container-fluid">
	<header class="section-header">
		<div class="tbl">
			<div class="tbl-row">
				<div class="tbl-cell">
					<h2>Search File Number</h2>
					<div class="subtitle"></div>
				</div>
			</div>
		</div>
	</header>
	<div class="box-typical box-typical-padding">
		
		<?php $form=$this->beginWidget('CActiveForm', array(
			'id'=>'files-form',
			// Please note: When you enable ajax validation, make sure the corresponding
			// controller action is handling ajax validation correctly.
			// There is a call to performAjaxValidation() commented in generated controller code.
			// See class documentation of CActiveForm for details on this.
			'enableAjaxValidation'=>false,
		)); ?>

			<div class="form-group row">
				<?php echo $form->labelEx($model,'SUBJECT', array('class'=>'col-sm-2 form-control-label')); ?>
				<div class="col-sm-10">
					<p class="form-control-static">
						<?php echo $form->textField($model,'SUBJECT',array('size'=>60,'maxlength'=>100, 'value'=>$model->SUBJECT)); ?>
					</p>
				</div>
			</div>
			
		<?php $this->endWidget(); ?>
		<div>
			<table style="width: 100%;margin-top:50px;">
				<?php 
					if(count($searchedFiles) > 0){
						foreach($searchedFiles as $file){
							?>
								<tr><td><h1 style="font-size: 80px;"><?php echo $file['1'];?></h1><p><?php echo $file['0'];?></p></td></tr>
							<?php
						}
						
					}
				?>
			</table>
		</div>
	</div>
</div>
<script>
	$(document).ready(function(){
		$('#Files_SUBJECT').keypress(function (e) {
		  if (e.which == 13) {
			$('#files-form').submit();
		  }
		});
	});
</script>
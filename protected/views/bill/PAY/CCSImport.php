<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'ccs-import-form',
	'enableAjaxValidation'=>false,
	'action' => Yii::app()->createUrl('Bill/CSSImport', array('id'=>$model->ID)),
	'htmlOptions'=>array('enctype'=>'multipart/form-data'),
)); ?>
<div class="container-fluid">
	<header class="section-header">
		<div class="tbl">
			<div class="tbl-row">
				<div class="tbl-cell">
					<h2>CCS Import</h2>
					<div class="subtitle"><a href="<?php echo Yii::app()->createUrl('bill/update', array('id'=>$model->ID))?>"><?php echo $model->BILL_TITLE; ?></a></div>
				</div>
			</div>
		</div>
	</header>
	
	<div class="box-typical box-typical-padding">
		<div class="form-group row">
			<label class='col-sm-2 form-control-label'>Select File</label>
			<div class="col-sm-10">
				<p class="form-control-static">
					<div><?php echo $form->fileField($model, 'CSS_FILE',array('id'=>'CSS_FILE', 'class'=>'form-control')); ?></div>
					<div>Allowed Files (*.xls, *.xlsx)</div>
				</p>
			</div>
		</div>
		<div class="form-group row">
			<label class='col-sm-2 form-control-label'></label>
			<div class="col-sm-10">
				<p class="form-control-static">
					<?php echo CHtml::submitButton('Submit', array('class'=>'btn btn-inline')); ?>
				</p>
			</div>
		</div>
	</div>
</div>
<?php $this->endWidget(); ?>
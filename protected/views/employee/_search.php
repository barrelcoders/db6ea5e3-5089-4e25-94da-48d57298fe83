<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<div class="col-sm-12">
			<div class="form-group row">
				<div class="col-sm-12">
					<p class="form-control-static">
						<?php echo $form->textField($model,'NAME',array('style'=>'width:100%','maxlength'=>100, 'value'=>$model->NAME, 'onkeyup'=>'tableSearch();', 'placeholder'=>'SEARCH NAME'));?>
					</p>
				</div>
			</div>
		</div>
	</div>

<?php $this->endWidget(); ?>

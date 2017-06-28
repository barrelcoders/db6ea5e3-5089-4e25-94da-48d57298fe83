<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - Login';
$this->breadcrumbs=array(
	'Login',
);
?>

<div class="container-fluid">
	<header class="section-header">
		<div class="tbl">
			<div class="tbl-row">
				<div class="tbl-cell">
					<h2>Change Password</h2>
					<div class="subtitle"></div>
				</div>
			</div>
		</div>
	</header>
	<div class="box-typical box-typical-padding">
		<?php $form=$this->beginWidget('CActiveForm', array(
			'enableClientValidation'=>true,
			'clientOptions'=>array(
				'validateOnSubmit'=>true,
			),
			'htmlOptions'=>array(
				'class'=>'sign-box',
			)
		)); ?>
		
		<div class="form-group row">
			<?php echo $form->labelEx($model,'PASSWORD', array('class'=>'col-sm-2 form-control-label')); ?>
			<div class="col-sm-10">
				<p class="form-control-static">
					<?php echo $form->passwordField($model,'PASSWORD',array('size'=>60,'maxlength'=>100)); ?>
				</p>
			</div>
		</div>
		<div class="form-group row">
			<?php echo $form->labelEx($model,'CONFIRM_PWD', array('class'=>'col-sm-2 form-control-label')); ?>
			<div class="col-sm-10">
				<p class="form-control-static">
					<?php echo $form->passwordField($model,'CONFIRM_PWD',array('size'=>60,'maxlength'=>100)); ?>
				</p>
			</div>
		</div>
		<div class="form-group row">
			<label class='col-sm-2 form-control-label'></label>
			<div class="col-sm-10">
				<p class="form-control-static">
					<?php echo CHtml::submitButton('Change Password', array('class'=>'btn btn-inline')); ?>
				</p>
			</div>
		</div>
		<?php $this->endWidget(); ?>
	</div>
</div>

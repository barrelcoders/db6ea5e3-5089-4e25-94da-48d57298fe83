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
	<?php $form=$this->beginWidget('CActiveForm', array(
		'enableClientValidation'=>true,
		'clientOptions'=>array(
			'validateOnSubmit'=>true,
		),
		'htmlOptions'=>array(
			'class'=>'sign-box',
		)
	)); ?>
	<form class="">
		<div class="sign-avatar">
			<img src="img/avatar-sign.png" alt="">
			<!--<img src="https://lh6.googleusercontent.com/-oabswUjcowI/ThicfuYfJ-I/AAAAAAAABHM/IUt-o-wQ2o4/crawling-bug.gif" alt="">-->
			
          
		</div>
		<header class="sign-title">Sign In</header>
		<div class="form-group">
		   <?php echo $form->textField($model,'USERNAME', array('class'=>'form-control', 'placeholder'=>'Username')); ?> 
		</div>
		<div class="form-group">
			<?php echo $form->passwordField($model,'PASSWORD', array('class'=>'form-control', 'placeholder'=>'Password')); ?>
		</div>
		<div class="form-group">
			<div class="checkbox float-left">
				<?php echo $form->checkBox($model,'rememberMe', array('id'=>'signed-in')); ?>
				<label for="signed-in">Keep me signed in</label>
			</div>
		</div>
		<?php echo CHtml::submitButton('Sign in', array('class'=>'btn btn-rounded')); ?>
	<?php $this->endWidget(); ?>
</div>


<?php
/* @var $this AppropiationRegisterController */
/* @var $model AppropiationRegister */

$this->breadcrumbs=array(
	'Appropiation Registers'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List AppropiationRegister', 'url'=>array('index')),
	array('label'=>'Manage AppropiationRegister', 'url'=>array('admin')),
);
?>

<h1>Create AppropiationRegister</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
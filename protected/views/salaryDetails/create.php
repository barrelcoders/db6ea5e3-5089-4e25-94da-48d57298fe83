<?php
/* @var $this SalaryDetailsController */
/* @var $model SalaryDetails */

$this->breadcrumbs=array(
	'Salary Details'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List SalaryDetails', 'url'=>array('index')),
	array('label'=>'Manage SalaryDetails', 'url'=>array('admin')),
);
?>

<h1>Create SalaryDetails</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
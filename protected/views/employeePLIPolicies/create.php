<?php
/* @var $this EmployeePLIPoliciesController */
/* @var $model EmployeePLIPolicies */

$this->breadcrumbs=array(
	'Employee Plipolicies'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List EmployeePLIPolicies', 'url'=>array('index')),
	array('label'=>'Manage EmployeePLIPolicies', 'url'=>array('admin')),
);
?>

<h1>Create EmployeePLIPolicies</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
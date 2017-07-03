<?php
/* @var $this EmployeeLICPoliciesController */
/* @var $model EmployeeLICPolicies */

$this->breadcrumbs=array(
	'Employee Licpolicies'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List EmployeeLICPolicies', 'url'=>array('index')),
	array('label'=>'Manage EmployeeLICPolicies', 'url'=>array('admin')),
);
?>

<h1>Create EmployeeLICPolicies</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
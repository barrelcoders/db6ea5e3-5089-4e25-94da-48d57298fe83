<?php
/* @var $this EmployeePLIPoliciesController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Employee Plipolicies',
);

$this->menu=array(
	array('label'=>'Create EmployeePLIPolicies', 'url'=>array('create')),
	array('label'=>'Manage EmployeePLIPolicies', 'url'=>array('admin')),
);
?>

<h1>Employee Plipolicies</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>

<?php
/* @var $this EmployeeLICPoliciesController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Employee Licpolicies',
);

$this->menu=array(
	array('label'=>'Create EmployeeLICPolicies', 'url'=>array('create')),
	array('label'=>'Manage EmployeeLICPolicies', 'url'=>array('admin')),
);
?>

<h1>Employee Licpolicies</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>

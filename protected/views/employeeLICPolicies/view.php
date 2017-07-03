<?php
/* @var $this EmployeeLICPoliciesController */
/* @var $model EmployeeLICPolicies */

$this->breadcrumbs=array(
	'Employee Licpolicies'=>array('index'),
	$model->ID,
);

$this->menu=array(
	array('label'=>'List EmployeeLICPolicies', 'url'=>array('index')),
	array('label'=>'Create EmployeeLICPolicies', 'url'=>array('create')),
	array('label'=>'Update EmployeeLICPolicies', 'url'=>array('update', 'id'=>$model->ID)),
	array('label'=>'Delete EmployeeLICPolicies', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->ID),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage EmployeeLICPolicies', 'url'=>array('admin')),
);
?>

<h1>View EmployeeLICPolicies #<?php echo $model->ID; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'ID',
		'EMPLOYEE_ID_FK',
		'POLICY_NO',
		'AMOUNT',
		'STATUS',
	),
)); ?>

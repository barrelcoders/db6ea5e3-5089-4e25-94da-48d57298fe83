<?php
/* @var $this EmployeePLIPoliciesController */
/* @var $model EmployeePLIPolicies */

$this->breadcrumbs=array(
	'Employee Plipolicies'=>array('index'),
	$model->ID,
);

$this->menu=array(
	array('label'=>'List EmployeePLIPolicies', 'url'=>array('index')),
	array('label'=>'Create EmployeePLIPolicies', 'url'=>array('create')),
	array('label'=>'Update EmployeePLIPolicies', 'url'=>array('update', 'id'=>$model->ID)),
	array('label'=>'Delete EmployeePLIPolicies', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->ID),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage EmployeePLIPolicies', 'url'=>array('admin')),
);
?>

<h1>View EmployeePLIPolicies #<?php echo $model->ID; ?></h1>

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

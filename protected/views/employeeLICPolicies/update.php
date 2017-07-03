<?php
/* @var $this EmployeeLICPoliciesController */
/* @var $model EmployeeLICPolicies */

$this->breadcrumbs=array(
	'Employee Licpolicies'=>array('index'),
	$model->ID=>array('view','id'=>$model->ID),
	'Update',
);

$this->menu=array(
	array('label'=>'List EmployeeLICPolicies', 'url'=>array('index')),
	array('label'=>'Create EmployeeLICPolicies', 'url'=>array('create')),
	array('label'=>'View EmployeeLICPolicies', 'url'=>array('view', 'id'=>$model->ID)),
	array('label'=>'Manage EmployeeLICPolicies', 'url'=>array('admin')),
);
?>

<h1>Update EmployeeLICPolicies <?php echo $model->ID; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
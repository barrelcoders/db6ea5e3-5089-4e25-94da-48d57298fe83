<?php
/* @var $this EmployeePLIPoliciesController */
/* @var $model EmployeePLIPolicies */

$this->breadcrumbs=array(
	'Employee Plipolicies'=>array('index'),
	$model->ID=>array('view','id'=>$model->ID),
	'Update',
);

$this->menu=array(
	array('label'=>'List EmployeePLIPolicies', 'url'=>array('index')),
	array('label'=>'Create EmployeePLIPolicies', 'url'=>array('create')),
	array('label'=>'View EmployeePLIPolicies', 'url'=>array('view', 'id'=>$model->ID)),
	array('label'=>'Manage EmployeePLIPolicies', 'url'=>array('admin')),
);
?>

<h1>Update EmployeePLIPolicies <?php echo $model->ID; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
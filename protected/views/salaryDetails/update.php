<?php
/* @var $this SalaryDetailsController */
/* @var $model SalaryDetails */

$this->breadcrumbs=array(
	'Salary Details'=>array('index'),
	$model->ID=>array('view','id'=>$model->ID),
	'Update',
);

$this->menu=array(
	array('label'=>'List SalaryDetails', 'url'=>array('index')),
	array('label'=>'Create SalaryDetails', 'url'=>array('create')),
	array('label'=>'View SalaryDetails', 'url'=>array('view', 'id'=>$model->ID)),
	array('label'=>'Manage SalaryDetails', 'url'=>array('admin')),
);
?>

<h1>Update SalaryDetails <?php echo $model->ID; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
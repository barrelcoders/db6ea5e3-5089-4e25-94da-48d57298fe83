<?php
/* @var $this SupplementarySalaryDetailsController */
/* @var $model SupplementarySalaryDetails */

$this->breadcrumbs=array(
	'Supplementary Salary Details'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List SupplementarySalaryDetails', 'url'=>array('index')),
	array('label'=>'Manage SupplementarySalaryDetails', 'url'=>array('admin')),
);
?>

<h1>Create SupplementarySalaryDetails</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
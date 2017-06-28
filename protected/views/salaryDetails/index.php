<?php
/* @var $this SalaryDetailsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Salary Details',
);

$this->menu=array(
	array('label'=>'Create SalaryDetails', 'url'=>array('create')),
	array('label'=>'Manage SalaryDetails', 'url'=>array('admin')),
);
?>

<h1>Salary Details</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>

<?php
/* @var $this PayBillTasksController */
/* @var $model PayBillTasks */

$this->breadcrumbs=array(
	'Pay Bill Tasks'=>array('index'),
	$model->ID,
);

$this->menu=array(
	array('label'=>'List PayBillTasks', 'url'=>array('index')),
	array('label'=>'Create PayBillTasks', 'url'=>array('create')),
	array('label'=>'Update PayBillTasks', 'url'=>array('update', 'id'=>$model->ID)),
	array('label'=>'Delete PayBillTasks', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->ID),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage PayBillTasks', 'url'=>array('admin')),
);
?>

<h1>View PayBillTasks #<?php echo $model->ID; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'ID',
		'EMPLOYEE_ID_FK',
		'MONTH',
		'YEAR',
		'TASK',
	),
)); ?>

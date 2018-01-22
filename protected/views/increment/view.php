<?php
/* @var $this IncrementController */
/* @var $model Increment */

$this->breadcrumbs=array(
	'Increments'=>array('index'),
	$model->TITLE,
);

$this->menu=array(
	array('label'=>'List Increment', 'url'=>array('index')),
	array('label'=>'Create Increment', 'url'=>array('create')),
	array('label'=>'Update Increment', 'url'=>array('update', 'id'=>$model->ID)),
	array('label'=>'Delete Increment', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->ID),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Increment', 'url'=>array('admin')),
);
?>

<h1>View Increment #<?php echo $model->ID; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'ID',
		'TITLE',
		'DATE',
		'EMPLOYEE',
	),
)); ?>

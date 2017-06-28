<?php
/* @var $this HindiReportController */
/* @var $model HindiReport */

$this->breadcrumbs=array(
	'Hindi Reports'=>array('index'),
	$model->ID,
);

$this->menu=array(
	array('label'=>'List HindiReport', 'url'=>array('index')),
	array('label'=>'Create HindiReport', 'url'=>array('create')),
	array('label'=>'Update HindiReport', 'url'=>array('update', 'id'=>$model->ID)),
	array('label'=>'Delete HindiReport', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->ID),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage HindiReport', 'url'=>array('admin')),
);
?>

<h1>View HindiReport #<?php echo $model->ID; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'ID',
		'QUARTER',
		'DATE',
		'EMPLOYEE_ID',
		'EMPLOYEE_ID_TYPE',
		'COL_1_1',
	),
)); ?>

<?php
/* @var $this MasterController */
/* @var $model Master */

$this->breadcrumbs=array(
	'Masters'=>array('index'),
	$model->ID,
);

$this->menu=array(
	array('label'=>'List Master', 'url'=>array('index')),
	array('label'=>'Create Master', 'url'=>array('create')),
	array('label'=>'Update Master', 'url'=>array('update', 'id'=>$model->ID)),
	array('label'=>'Delete Master', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->ID),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Master', 'url'=>array('admin')),
);
?>

<h1>View Master #<?php echo $model->ID; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'ID',
		'OFFICE_NAME',
		'OFFICE_ADDRESS',
		'DEPT_NAME',
		'DEPT_HEAD_EMPLOYEE',
		'DEPT_ADMIN_EMPLOYEE',
		'CURRENT_FINANCIAL_YEAR',
		'OFFICE_NAME_HINDI',
		'OFFICE_ADDRESS_HINDI',
		'DEPT_NAME_HINDI',
		'HOO_OFFICE_NAME',
		'HOO_OFFICE_NAME_HINDI',
		'FINANCIAL_YEAR_START',
		'FINANCIAL_YEAR_END',
	),
)); ?>

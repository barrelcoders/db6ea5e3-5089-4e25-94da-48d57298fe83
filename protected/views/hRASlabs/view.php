<?php
/* @var $this HRASlabsController */
/* @var $model HRASlabs */

$this->breadcrumbs=array(
	'Hraslabs'=>array('index'),
	$model->NAME,
);

$this->menu=array(
	array('label'=>'List HRASlabs', 'url'=>array('index')),
	array('label'=>'Create HRASlabs', 'url'=>array('create')),
	array('label'=>'Update HRASlabs', 'url'=>array('update', 'id'=>$model->ID)),
	array('label'=>'Delete HRASlabs', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->ID),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage HRASlabs', 'url'=>array('admin')),
);
?>

<h1>View HRASlabs #<?php echo $model->ID; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'ID',
		'NAME',
		'RATE',
		'DESCRIPTION',
	),
)); ?>

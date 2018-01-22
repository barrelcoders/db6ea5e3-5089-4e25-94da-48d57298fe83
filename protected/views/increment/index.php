<?php
/* @var $this IncrementController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Increments',
);

$this->menu=array(
	array('label'=>'Create Increment', 'url'=>array('create')),
	array('label'=>'Manage Increment', 'url'=>array('admin')),
);
?>

<h1>Increments</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>

<?php
/* @var $this PayBillTasksController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Pay Bill Tasks',
);

$this->menu=array(
	array('label'=>'Create PayBillTasks', 'url'=>array('create')),
	array('label'=>'Manage PayBillTasks', 'url'=>array('admin')),
);
?>

<h1>Pay Bill Tasks</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>

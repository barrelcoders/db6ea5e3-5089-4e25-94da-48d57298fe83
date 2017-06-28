<?php
/* @var $this AppropiationRegisterController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Appropiation Registers',
);

$this->menu=array(
	array('label'=>'Create AppropiationRegister', 'url'=>array('create')),
	array('label'=>'Manage AppropiationRegister', 'url'=>array('admin')),
);
?>

<h1>Appropiation Registers</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>

<?php
/* @var $this PAOExpenditureController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Paoexpenditures',
);

$this->menu=array(
	array('label'=>'Create PAOExpenditure', 'url'=>array('create')),
	array('label'=>'Manage PAOExpenditure', 'url'=>array('admin')),
);
?>

<h1>Paoexpenditures</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>

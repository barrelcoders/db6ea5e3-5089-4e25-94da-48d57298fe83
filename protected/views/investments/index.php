<?php
/* @var $this InvestmentsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Investments',
);

$this->menu=array(
	array('label'=>'Create Investments', 'url'=>array('create')),
	array('label'=>'Manage Investments', 'url'=>array('admin')),
);
?>

<h1>Investments</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>

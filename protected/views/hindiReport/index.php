<?php
/* @var $this HindiReportController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Hindi Reports',
);

$this->menu=array(
	array('label'=>'Create HindiReport', 'url'=>array('create')),
	array('label'=>'Manage HindiReport', 'url'=>array('admin')),
);
?>

<h1>Hindi Reports</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>

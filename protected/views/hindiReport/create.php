<?php
/* @var $this HindiReportController */
/* @var $model HindiReport */

$this->breadcrumbs=array(
	'Hindi Reports'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List HindiReport', 'url'=>array('index')),
	array('label'=>'Manage HindiReport', 'url'=>array('admin')),
);
?>

<h1>Create HindiReport</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
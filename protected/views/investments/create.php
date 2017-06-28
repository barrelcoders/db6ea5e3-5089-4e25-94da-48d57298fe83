<?php
/* @var $this InvestmentsController */
/* @var $model Investments */

$this->breadcrumbs=array(
	'Investments'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Investments', 'url'=>array('index')),
	array('label'=>'Manage Investments', 'url'=>array('admin')),
);
?>

<h1>Create Investments</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
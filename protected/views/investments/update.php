<?php
/* @var $this InvestmentsController */
/* @var $model Investments */

$this->breadcrumbs=array(
	'Investments'=>array('index'),
	$model->ID=>array('view','id'=>$model->ID),
	'Update',
);

$this->menu=array(
	array('label'=>'List Investments', 'url'=>array('index')),
	array('label'=>'Create Investments', 'url'=>array('create')),
	array('label'=>'View Investments', 'url'=>array('view', 'id'=>$model->ID)),
	array('label'=>'Manage Investments', 'url'=>array('admin')),
);
?>

<h1>Update Investments <?php echo $model->ID; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
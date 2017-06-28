<?php
/* @var $this HindiReportController */
/* @var $model HindiReport */

$this->breadcrumbs=array(
	'Hindi Reports'=>array('index'),
	$model->ID=>array('view','id'=>$model->ID),
	'Update',
);

$this->menu=array(
	array('label'=>'List HindiReport', 'url'=>array('index')),
	array('label'=>'Create HindiReport', 'url'=>array('create')),
	array('label'=>'View HindiReport', 'url'=>array('view', 'id'=>$model->ID)),
	array('label'=>'Manage HindiReport', 'url'=>array('admin')),
);
?>

<h1>Update HindiReport <?php echo $model->ID; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
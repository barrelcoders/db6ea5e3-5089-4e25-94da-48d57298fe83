<?php
/* @var $this AppropiationRegisterController */
/* @var $model AppropiationRegister */

$this->breadcrumbs=array(
	'Appropiation Registers'=>array('index'),
	$model->ID,
);

$this->menu=array(
	array('label'=>'List AppropiationRegister', 'url'=>array('index')),
	array('label'=>'Create AppropiationRegister', 'url'=>array('create')),
	array('label'=>'Update AppropiationRegister', 'url'=>array('update', 'id'=>$model->ID)),
	array('label'=>'Delete AppropiationRegister', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->ID),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage AppropiationRegister', 'url'=>array('admin')),
);
?>

<h1>View AppropiationRegister #<?php echo $model->ID; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'ID',
		'BILL_NO',
		'BILL_AMOUNT',
		'EXPENDITURE_INC_BILL',
		'BALANCE',
		'BUDGET_ID',
	),
)); ?>

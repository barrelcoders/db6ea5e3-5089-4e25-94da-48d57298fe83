<?php
/* @var $this BillController */
/* @var $model Bill */

$this->breadcrumbs=array(
	'Bills'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Bill', 'url'=>array('index')),
	array('label'=>'Create Bill', 'url'=>array('create')),
	array('label'=>'Update Bill', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Bill', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Bill', 'url'=>array('admin')),
);
?>

<h1>View Bill #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'BILL_NO',
		'PT_DED_BILL_NO',
		'LIC_DED_BILL_NO',
		'NILL_BILL_NO',
		'MONTH',
		'YEAR',
		'CREATION_DATE',
		'BILL_TYPE',
		'BILL_AMOUNT',
		'EXPENDITURE_INC_BILL',
		'APPROPIATION_BALANCE',
		'PFMS_BILL_NO',
		'FILE_NO',
		'BILL_TITLE',
		'CER_NO',
		'PFMS_STATUS',
		'BILL_SUB_TYPE',
	),
)); ?>

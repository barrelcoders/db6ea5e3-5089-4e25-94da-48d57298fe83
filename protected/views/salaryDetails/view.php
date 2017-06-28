<?php
/* @var $this SalaryDetailsController */
/* @var $model SalaryDetails */

$this->breadcrumbs=array(
	'Salary Details'=>array('index'),
	$model->ID,
);

$this->menu=array(
	array('label'=>'List SalaryDetails', 'url'=>array('index')),
	array('label'=>'Create SalaryDetails', 'url'=>array('create')),
	array('label'=>'Update SalaryDetails', 'url'=>array('update', 'id'=>$model->ID)),
	array('label'=>'Delete SalaryDetails', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->ID),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage SalaryDetails', 'url'=>array('admin')),
);
?>

<h1>View SalaryDetails #<?php echo $model->ID; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'ID',
		'BILL_ID_FK',
		'EMPLOYEE_ID_FK',
		'BASIC',
		'SP',
		'PP',
		'CCA',
		'HRA',
		'DA',
		'TA',
		'IT',
		'CGHS',
		'LF',
		'CGEGIS',
		'CPF_TIER_I',
		'CPF_TIER_II',
		'HBA_EMI',
		'MCA_EMI',
		'FAN_EMI',
		'FLOOD_EMI',
		'CYCLE_EMI',
		'PLI',
		'MISC',
		'PT',
		'FEST_EMI',
		'HBA_TOTAL',
		'MCA_TOTAL',
		'FLOOD_TOTAL',
		'CYCLE_TOTAL',
		'FEST_TOTAL',
		'HBA_INST',
		'MCA_INST',
		'FLOOD_INST',
		'CYCLE_INST',
		'FEST_INST',
		'HBA_BAL',
		'MCA_BAL',
		'FLOOD_BAL',
		'CYCLE_BAL',
		'FEST_BAL',
		'WA',
		'CCS',
		'LIC',
		'ASSOSC_SUB',
		'REMARKS',
		'FAN_TOTAL',
		'FAN_INST',
		'FAN_BAL',
	),
)); ?>

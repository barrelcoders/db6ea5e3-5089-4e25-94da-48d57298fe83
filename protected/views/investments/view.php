<?php
/* @var $this InvestmentsController */
/* @var $model Investments */

$this->breadcrumbs=array(
	'Investments'=>array('index'),
	$model->ID,
);

$this->menu=array(
	array('label'=>'List Investments', 'url'=>array('index')),
	array('label'=>'Create Investments', 'url'=>array('create')),
	array('label'=>'Update Investments', 'url'=>array('update', 'id'=>$model->ID)),
	array('label'=>'Delete Investments', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->ID),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Investments', 'url'=>array('admin')),
);
?>

<h1>View Investments #<?php echo $model->ID; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'ID',
		'FINANCIAL_YEAR_ID_FK',
		'EMPLOYEE_ID',
		'HRA',
		'MEDICAL_INSURANCE',
		'DONATION',
		'DISABILITY_MED_EXP',
		'EDU_LOAD_INT',
		'SELF_DISABILITY',
		'HOME_LOAN_INT',
		'HOME_LOAD_EXCESS_2013_14',
		'INSURANCE_LIC_OTHER',
		'TUITION_FESS_EXEMPTION',
		'PPF_NSC',
		'HOME_LOAD_PR',
		'PLI_ULIP',
		'TERM_DEPOSIT_ABOVE_5',
		'MUTUAL_FUND',
		'PENSION_FUND',
		'CPF',
	),
)); ?>

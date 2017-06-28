<?php
/* @var $this SalaryDetailsController */
/* @var $model SalaryDetails */

$this->breadcrumbs=array(
	'Salary Details'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List SalaryDetails', 'url'=>array('index')),
	array('label'=>'Create SalaryDetails', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#salary-details-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Salary Details</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'salary-details-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'ID',
		'BILL_ID_FK',
		'EMPLOYEE_ID_FK',
		'BASIC',
		'SP',
		'PP',
		/*
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
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>

<?php
/* @var $this MasterController */
/* @var $model Master */

$this->breadcrumbs=array(
	'Masters'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Master', 'url'=>array('index')),
	array('label'=>'Create Master', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#master-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Masters</h1>

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
	'id'=>'master-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'ID',
		'OFFICE_NAME',
		'OFFICE_ADDRESS',
		'DEPT_NAME',
		'DEPT_HEAD_EMPLOYEE',
		'DEPT_ADMIN_EMPLOYEE',
		/*
		'CURRENT_FINANCIAL_YEAR',
		'OFFICE_NAME_HINDI',
		'OFFICE_ADDRESS_HINDI',
		'DEPT_NAME_HINDI',
		'HOO_OFFICE_NAME',
		'HOO_OFFICE_NAME_HINDI',
		'FINANCIAL_YEAR_START',
		'FINANCIAL_YEAR_END',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>

<?php
/* @var $this OEBillDetailsController */
/* @var $model OEBillDetails */

$this->breadcrumbs=array(
	'Oebill Details'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List OEBillDetails', 'url'=>array('index')),
	array('label'=>'Create OEBillDetails', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#oebill-details-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Oebill Details</h1>

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
	'id'=>'oebill-details-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'ID',
		'BILL_ID_FK',
		'IT_DED',
		'NET_AMOUNT',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>

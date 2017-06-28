<?php
/* @var $this FilesController */
/* @var $model Files */

$this->breadcrumbs=array(
	'Files'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Files', 'url'=>array('index')),
	array('label'=>'Create Files', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#files-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<div class="container-fluid">
	<header class="section-header">
		<div class="tbl">
			<div class="tbl-row">
				<div class="tbl-cell">
					<h2>Manage Files</h2>
					<div class="subtitle"></div>
				</div>
			</div>
		</div>
	</header>
	<div class="box-typical box-typical-padding">
		<?php $this->widget('zii.widgets.grid.CGridView', array(
			'id'=>'files-grid',
			'itemsCssClass' => 'table table-bordered table-hover',
			'dataProvider'=>$model->search(),
			'filter'=>$model,
			'columns'=>array(
				'NUMBER',
				'SUBJECT',
				array(
					'class'=>'CButtonColumn',
					'htmlOptions' => array('style'=>'width:100px'),
					'template' => '{view}{update}{delete}',
					'buttons'=>array
					(
						'view' => array
						(
							'url'=>'Yii::app()->createUrl("Files/View", array("id"=>$data->ID))',
							'options'=>array('class'=>'glyphicon glyphicon-search'),
							'imageUrl'=>'',
							'label'=>''
						),
						'update' => array
						(
							'url'=>'Yii::app()->createUrl("Files/Update", array("id"=>$data->ID))',
							'options'=>array('class'=>'glyphicon glyphicon-pencil'),
							'imageUrl'=>'',
							'label'=>''
						),
						'delete' => array
						(
							'url'=>'Yii::app()->createUrl("Files/Delete", array("id"=>$data->ID))',
							'options'=>array('class'=>'glyphicon glyphicon-trash'),
							'imageUrl'=>'',
							'label'=>''
						),
					),
				),
			),
		)); ?>
	</div>
</div>
<style>
	a{color:#000; text-decoration: none;border:none !important;margin-right: 5px;}
	a:hover{color:#000;text-decoration: underline;}
</style>
<?php
/* @var $this HindiReportController */
/* @var $model HindiReport */

$this->breadcrumbs=array(
	'Hindi Reports'=>array('index'),
	'Manage',
);
?>

<div class="container-fluid">
	<header class="section-header">
		<div class="tbl">
			<div class="tbl-row">
				<div class="tbl-cell">
					<h2>Hindi Reports</h2>
					<div class="subtitle"></div>
				</div>
			</div>
		</div>
	</header>
	<div class="box-typical box-typical-padding">
		<div class="search-form">
		<?php $this->renderPartial('_search',array(
			'model'=>$model,
		)); ?>
		</div>
		<?php $this->widget('zii.widgets.grid.CGridView', array(
			'id'=>'hindi-report-grid',
			'itemsCssClass' => 'table table-bordered table-hover',
			'dataProvider'=>$model->search(),
			'filter'=>$model,
			'columns'=>array(
				'QUARTER',
				'DATE',
				'EMPLOYEE_ID',
				'EMPLOYEE_ID_TYPE',
				array(
					'class'=>'CButtonColumn',
				),
			),
		)); ?>

	</div>
</div>
<style>
	a{color:#000; text-decoration: none;border:none !important;margin-right: 5px;}
	a:hover{color:#000;text-decoration: underline;}
</style>

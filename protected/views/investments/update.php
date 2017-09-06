<?php
/* @var $this InvestmentsController */
/* @var $model Investments */

$this->breadcrumbs=array(
	'Investments'=>array('index'),
	$model->ID=>array('view','id'=>$model->ID),
	'Update',
);

$this->menu=array(
	array('label'=>'List Investments', 'url'=>array('index')),
	array('label'=>'Create Investments', 'url'=>array('create')),
	array('label'=>'View Investments', 'url'=>array('view', 'id'=>$model->ID)),
	array('label'=>'Manage Investments', 'url'=>array('admin')),
);
?>

<div class="container-fluid">
	<header class="section-header">
		<div class="tbl">
			<div class="tbl-row">
				<div class="tbl-cell">
					<h2>Investments for <?php echo FinancialYears::model()->find("STATUS=1")->NAME ?></h2>
					<div class="subtitle" style="text-align: right;">
						<a href="<?php echo Yii::app()->createUrl('Employee/admin')?>" style="float: left;font-size: 15px;">Employees</a>
					</div>
				</div>
			</div>
		</div>
	</header>
	<div class="box-typical box-typical-padding">
		<?php $this->renderPartial('_form', array('model'=>$model, 'id'=>$id)); ?>
	</div>
</div>
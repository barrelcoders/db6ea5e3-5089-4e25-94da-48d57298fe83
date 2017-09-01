<?php
/* @var $this EmployeeController */
/* @var $model Employee */

$this->breadcrumbs=array(
	'Employees'=>array('index'),
	$model->NAME=>array('view','id'=>$model->ID),
	'Update',
);

$this->menu=array(
	array('label'=>'List Employee', 'url'=>array('index')),
	array('label'=>'Create Employee', 'url'=>array('create')),
	array('label'=>'View Employee', 'url'=>array('view', 'id'=>$model->ID)),
	array('label'=>'Manage Employee', 'url'=>array('admin')),
);
?>

<div class="container-fluid">
	<header class="section-header">
		<div class="tbl">
			<div class="tbl-row">
				<div class="tbl-cell">
					<h2><?php echo $model->NAME; ?></h2>
					<div class="subtitle" style="text-align: right;">
						<a href="<?php echo Yii::app()->createUrl('Employee/admin')?>" style="float: left;font-size: 15px;">Employees</a>
						<a class="btn btn-inline" href="<?php echo Yii::app()->createUrl('SupplementarySalaryDetails/update', array('id'=>$model->ID))?>">Mar-Jun 2017 Salary</a>
					</div>
				</div>
			</div>
		</div>
	</header>
	<div class="box-typical box-typical-padding">
		<?php $this->renderPartial('_form', array('model'=>$model)); ?>
	</div>
</div>
<?php
/* @var $this SupplementarySalaryDetailsController */
/* @var $model SupplementarySalaryDetails */

$this->breadcrumbs=array(
	'Supplementary Salary Details'=>array('index'),
	$model->ID=>array('view','id'=>$model->ID),
	'Update',
);

$this->menu=array(
	array('label'=>'List SupplementarySalaryDetails', 'url'=>array('index')),
	array('label'=>'Create SupplementarySalaryDetails', 'url'=>array('create')),
	array('label'=>'View SupplementarySalaryDetails', 'url'=>array('view', 'id'=>$model->ID)),
	array('label'=>'Manage SupplementarySalaryDetails', 'url'=>array('admin')),
);
?>




<div class="container-fluid">
	<header class="section-header">
		<div class="tbl">
			<div class="tbl-row">
				<div class="tbl-cell">
					<div class="subtitle" >	
						<a class="btn btn-inline" target="_blank" href="<?php echo Yii::app()->createUrl('Investments/update', array('id'=>$this->ID))?>">
						<?php echo FinancialYears::model()->find("STATUS=1")->NAME ?> Investments</a>
					</div>
				</div>
			</div>
		</div>
	</header>
	<div class="box-typical box-typical-padding">
		<?php $this->renderPartial('_form', array('model'=>$model)); ?>
	</div>
</div>
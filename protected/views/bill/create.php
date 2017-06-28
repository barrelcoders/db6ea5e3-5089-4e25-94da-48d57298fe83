<?php
/* @var $this BillController */
/* @var $model Bill */

$this->breadcrumbs=array(
	'Bills'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'Manage Bill', 'url'=>array('admin')),
);

?>

<div class="container-fluid">
	<header class="section-header">
		<div class="tbl">
			<div class="tbl-row">
				<div class="tbl-cell">
					<h2>Create Bill</h2>
					<div class="subtitle"></div>
				</div>
			</div>
		</div>
	</header>
	<div class="box-typical box-typical-padding">
		<?php $this->renderPartial('_form', array('model'=>$model)); ?>
	</div>
</div>
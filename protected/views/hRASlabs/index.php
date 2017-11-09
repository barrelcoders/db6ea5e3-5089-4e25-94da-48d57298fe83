<?php
/* @var $this HRASlabsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Hraslabs',
);

$this->menu=array(
	array('label'=>'Create HRASlabs', 'url'=>array('create')),
	array('label'=>'Manage HRASlabs', 'url'=>array('admin')),
);
?>

<h1>Hraslabs</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>



<div class="container-fluid">
	<header class="section-header">
		<div class="tbl">
			<div class="tbl-row">
				<div class="tbl-cell">
					<!--<h2></h2>-->
					<div class="subtitle"></div>
				</div>
			</div>
		</div>
	</header>
	<div class="box-typical box-typical-padding">
		<?php $this->widget('zii.widgets.grid.CGridView', array(
			'id'=>'increment-grid',
			'itemsCssClass' => 'table table-bordered table-hover',
			'dataProvider'=>$model->search(),
			'filter'=>$model,
			'columns'=>array(
				'TITLE',
				'DATE',
				array(
					'header'=>'DATE',
					'name'=>'DATE',
					'type'=>'raw',
					'value'=>function ($data){ 
						return date('d-m-Y', strtotime($data->DATE));
					}
				),
				array(
					'header'=>'EMPLOYEES',
					'name'=>'EMPLOYEE',
					'type'=>'raw',
					'value'=>function ($data){ 
						$count = count(explode(",", $data->EMPLOYEE));
						return $count . " Employees";
					}
				),
				array(
					'class'=>'CButtonColumn',
					'htmlOptions' => array('style'=>'width:150px'),
					'template' => '{update}',
					'buttons'=>array
					(
						'update' => array
						(
							'url'=>'Yii::app()->createUrl("Increment/Update", array("id"=>$data->ID))',
							'options'=>array('class'=>'glyphicon glyphicon-pencil'),
							'imageUrl'=>'',
							'label'=>'',
						),
					)
				),
			),
		)); ?>
	</div>
</div>
<style>
		a{color:#000; text-decoration: none;border:none !important;margin-right: 5px;}
		a:hover, a:visited, a:active{color:#000;text-decoration: underline;}
</style>

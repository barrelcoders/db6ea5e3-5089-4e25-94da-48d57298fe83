<div class="container-fluid">
	<header class="section-header">
		<div class="tbl">
			<div class="tbl-row">
				<div class="tbl-cell">
					<h2>Manage Tasks </h2>
					<div class="subtitle"></div>
				</div>
			</div>
		</div>
	</header>
	<div class="box-typical box-typical-padding">
		<?php $this->widget('zii.widgets.grid.CGridView', array(
			'id'=>'pay-bill-tasks-grid',
			'itemsCssClass' => 'table table-bordered table-hover',
			'dataProvider'=>$model->search(),
			'filter'=>$model,
			'columns'=>array(
				'ID',
				array(
					'header'=>'Employee',
					'name'=>'EMPLOYEE_ID_FK',
					'type'=>'raw',
					'value'=>function ($data){ 
						return Employee::model()->findByPk($data->EMPLOYEE_ID_FK)->NAME;
					}
				),
				array(
					'header'=>'PERIOD',
					'name'=>'MONTH',
					'type'=>'raw',
					'value'=>function ($data){ 
						return date('M-Y', strtotime($data->YEAR."-".$data->MONTH."-01"));
					}
				),
				'TASK',
				array(
					'class'=>'CButtonColumn',
					'htmlOptions' => array('style'=>'width:100px'),
					'template' => '{update}{delete}',
					'buttons'=>array
					(
						'update' => array
						(
							'url'=>'Yii::app()->createUrl("PayBillTasks/Update", array("id"=>$data->ID))',
							'options'=>array('class'=>'glyphicon glyphicon-pencil'),
							'imageUrl'=>'',
							'label'=>''
						),
						'delete' => array
						(
							'url'=>'Yii::app()->createUrl("PayBillTasks/Delete", array("id"=>$data->ID))',
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

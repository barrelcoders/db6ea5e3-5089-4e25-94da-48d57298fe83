<?php
	
	$monthNameHindi = array('1'=>'जनवरी', '2'=>'फ़रवरी', '3'=>'मार्च', '4'=>'अप्रैल', '5'=>'मई', '6'=>'जून', '7'=>'जुलाई', '8'=>'अगस्त', '9'=>'सितंबर', '10'=>'अक्टूबर', '11'=>'नवंबर', '12'=>'दिसंबर'); 
	$master = Master::model()->findByPK(1);
?>
<div class="container-fluid">
	<header class="section-header">
		<div class="tbl">
			<div class="tbl-row">
				<div class="tbl-cell">
					<h2>Manage PAO expenditures</h2>
					<div class="subtitle"></div>
				</div>
			</div>
		</div>
	</header>
	<div class="box-typical box-typical-padding">
		<?php $this->widget('zii.widgets.grid.CGridView', array(
			'id'=>'paoexpenditure-grid',
			'itemsCssClass' => 'table table-bordered table-hover',
			'dataProvider'=>$model->search(),
			'filter'=>$model,
			'columns'=>array(
				'SALARY',
				'MEDICAL',
				'DTE',
				'OE',
				'RRT',
				'IT_SAL',
				'IT_ECSS',
				'IT_HCESS',
				array(
					'name'=>'MONTH',
					'type'=>'raw',
					'value'=>function ($data){ 
						$monthName = array('1'=>'January', '2'=>'February', '3'=>'March', '4'=>'April', '5'=>'May', '6'=>'June', '7'=>'July', '8'=>'August', '9'=>'September', '10'=>'October', '11'=>'November', '12'=>'December');
						return $monthName[$data->MONTH];
					}
				), 
				'YEAR',
				array(
					'class'=>'CButtonColumn',
					'htmlOptions' => array('style'=>'width:100px'),
					'template' => '{view}{update}{delete}',
					'buttons'=>array
					(
						'view' => array
						(
							'url'=>'Yii::app()->createUrl("PAOExpenditure/View", array("id"=>$data->ID))',
							'options'=>array('class'=>'glyphicon glyphicon-search'),
							'imageUrl'=>'',
							'label'=>''
						),
						'update' => array
						(
							'url'=>'Yii::app()->createUrl("PAOExpenditure/Update", array("id"=>$data->ID))',
							'options'=>array('class'=>'glyphicon glyphicon-pencil'),
							'imageUrl'=>'',
							'label'=>''
						),
						'delete' => array
						(
							'url'=>'Yii::app()->createUrl("PAOExpenditure/Delete", array("id"=>$data->ID))',
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

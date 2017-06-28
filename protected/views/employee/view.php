<div class="container-fluid">
	<header class="section-header">
		<div class="tbl">
			<div class="tbl-row">
				<div class="tbl-cell">
					<div class="subtitle"></div>
				</div>
			</div>
		</div>
	</header>
	<div class="box-typical box-typical-padding">
	<?php $form=$this->beginWidget('CActiveForm', array(
		'id'=>'employee-form',
		// Please note: When you enable ajax validation, make sure the corresponding
		// controller action is handling ajax validation correctly.
		// There is a call to performAjaxValidation() commented in generated controller code.
		// See class documentation of CActiveForm for details on this.
		'enableAjaxValidation'=>false,
	)); ?>
		<div class="form-group row">
			<?php echo $form->labelEx($model,'NAME', array('class'=>'col-sm-2 form-control-label')); ?>
			<div class="col-sm-10">
				<p class="form-control-static">
					<span><?php echo $model->NAME;?></span>
				</p>
			</div>
		</div>
		<div class="form-group row">
			<?php echo $form->labelEx($model,'NAME_HINDI', array('class'=>'col-sm-2 form-control-label')); ?>
			<div class="col-sm-10">
				<p class="form-control-static">
					<span><?php echo $model->NAME_HINDI;?></span>
				</p>
			</div>
		</div>
		<div class="form-group row">
			<?php echo $form->labelEx($model,'CATEGORY', array('class'=>'col-sm-2 form-control-label')); ?>
			<div class="col-sm-10">
				<p class="form-control-static">
					<span><?php echo $model->CATEGORY;?></span>
				</p>
			</div>
		</div>
		<div class="form-group row">
			<?php echo $form->labelEx($model,'GROUP_ID_FK', array('class'=>'col-sm-2 form-control-label')); ?>
			<div class="col-sm-10">
				<p class="form-control-static">
					<?php echo Groups::model()->findByPK($model->GROUP_ID_FK)->GROUP_NAME; ?>
				</p>
			</div>
		</div>
		<div class="form-group row">
			<?php echo $form->labelEx($model,'DESIGNATION_ID_FK', array('class'=>'col-sm-2 form-control-label')); ?>
			<div class="col-sm-10">
				<p class="form-control-static">
					<?php echo Designations::model()->findByPK($model->DESIGNATION_ID_FK)->DESIGNATION; ?>
				</p>
			</div>
		</div>
		<div class="form-group row">
			<?php echo $form->labelEx($model,'GRADE_PAY_ID_FK', array('class'=>'col-sm-2 form-control-label')); ?>
			<div class="col-sm-10">
				<p class="form-control-static">
					<?php echo Paybands::model()->findByPK($model->GRADE_PAY_ID_FK)->DESCRIPTION; ?>
				</p>
			</div>
		</div>
		<div class="form-group row">
			<?php echo $form->labelEx($model,'MICR', array('class'=>'col-sm-2 form-control-label')); ?>
			<div class="col-sm-10">
				<p class="form-control-static">
					<span><?php echo $model->MICR;?></span>
				</p>
			</div>
		</div>
		<div class="form-group row">
			<?php echo $form->labelEx($model,'ACCOUNT_NO', array('class'=>'col-sm-2 form-control-label')); ?>
			<div class="col-sm-10">
				<p class="form-control-static">
					<span><?php echo $model->ACCOUNT_NO;?></span>
				</p>
			</div>
		</div>
		<div class="form-group row">
			<?php echo $form->labelEx($model,'IFSC', array('class'=>'col-sm-2 form-control-label')); ?>
			<div class="col-sm-10">
				<p class="form-control-static">
					<span><?php echo $model->IFSC;?></span>
				</p>
			</div>
		</div>
		<div class="form-group row">
			<?php echo $form->labelEx($model,'PAN', array('class'=>'col-sm-2 form-control-label')); ?>
			<div class="col-sm-10">
				<p class="form-control-static">
					<span><?php echo $model->PAN;?></span>
				</p>
			</div>
		</div>
		<div class="form-group row">
			<?php echo $form->labelEx($model,'DOB', array('class'=>'col-sm-2 form-control-label')); ?>
			<div class="col-sm-10">
				<p class="form-control-static">
					<span><?php echo date('d-M-Y', strtotime($model->DOB));?></span>
				</p>
			</div>
		</div>
		<div class="form-group row">
			<?php echo $form->labelEx($model,'DOI', array('class'=>'col-sm-2 form-control-label')); ?>
			<div class="col-sm-10">
				<p class="form-control-static">
					<span><?php echo date('d-M-Y', strtotime($model->DOI));?></span>
				</p>
			</div>
		</div>
		<div class="form-group row">
			<?php echo $form->labelEx($model,'PENSION_ACC_NO', array('class'=>'col-sm-2 form-control-label')); ?>
			<div class="col-sm-10">
				<p class="form-control-static">
					<span><?php echo $model->PENSION_ACC_NO;?></span>
				</p>
			</div>
		</div>
		<div class="form-group row">
			<?php echo $form->labelEx($model,'PENSION_TYPE', array('class'=>'col-sm-2 form-control-label')); ?>
			<div class="col-sm-10">
				<p class="form-control-static">
					<span><?php echo $model->PENSION_TYPE;?></span>
				</p>
			</div>
		</div>
		<div class="form-group row">
			<?php echo $form->labelEx($model,'IS_PERMANENT', array('class'=>'col-sm-2 form-control-label')); ?>
			<div class="col-sm-10">
				<p class="form-control-static">
					<?php 
						if($model->IS_PERMANENT == 1){
							echo "Permanent";
						}
						else{
							echo "Contractor";
						}?>
				</p>
			</div>
		</div>
		<div class="form-group row">
			<?php echo $form->labelEx($model,'ORG_JOIN_DATE', array('class'=>'col-sm-2 form-control-label')); ?>
			<div class="col-sm-10">
				<p class="form-control-static">
					<span><?php echo date('d-M-Y', strtotime($model->ORG_JOIN_DATE));?></span>
				</p>
			</div>
		</div>
		<div class="form-group row">
			<?php echo $form->labelEx($model,'ORG_RETIRE_DATE', array('class'=>'col-sm-2 form-control-label')); ?>
			<div class="col-sm-10">
				<p class="form-control-static">
					<span><?php echo date('d-M-Y', strtotime($model->ORG_RETIRE_DATE));?></span>
				</p>
			</div>
		</div>
		<div class="form-group row">
			<?php echo $form->labelEx($model,'DEPT_JOIN_DATE', array('class'=>'col-sm-2 form-control-label')); ?>
			<div class="col-sm-10">
				<p class="form-control-static">
					<span><?php echo date('d-M-Y', strtotime($model->DEPT_JOIN_DATE));?></span>
				</p>
			</div>
		</div>
		<div class="form-group row">
			<?php echo $form->labelEx($model,'DEPT_RELIEF_DATE', array('class'=>'col-sm-2 form-control-label')); ?>
			<div class="col-sm-10">
				<p class="form-control-static">
					<span><?php echo date('d-M-Y', strtotime($model->DEPT_RELIEF_DATE));?></span>
				</p>
			</div>
		</div>
		<div class="form-group row">
			<?php echo $form->labelEx($model,'FOLIO_NO', array('class'=>'col-sm-2 form-control-label')); ?>
			<div class="col-sm-10">
				<p class="form-control-static">
					<span><?php echo $model->FOLIO_NO;?></span>
				</p>
			</div>
		</div>
		<?php $this->endWidget(); ?>
	</div>
</div>


	
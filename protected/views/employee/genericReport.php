<?php $master = Master::model()->findByPK(1);?>
<br/><br/><br/><h3 style="text-align: center;"><?php echo $master->DEPT_NAME."<br/>".$master->DEPT_NAME_HINDI?></h3><br/><br/>
<table border="1" style="margin: 0 auto;" class="one-table">
	<thead>
		<tr>
			<th>S.No.</th>
			<?php foreach($list as $key=>$value){ ?>
			<th><?php echo Employee::model()->getAttributeLabel($value);?></th>
			<?php }?>
			<?php if(isset($custom_1) && $custom_1 != ''){?>
			<th><?php echo $custom_1;?></th>
				<?php } 
				if(isset($custom_2) && $custom_2 != '') {?>
					<th><?php echo $custom_2;?></th>
				<?php } ?>
		</tr>
	</thead>
	<?php 
		$employees = null;
		$conditions = array();
		if(count($designations) > 0){
			array_push($conditions, "DESIGNATION_ID_FK IN (".implode(",", $designations).")");
		}
		if(count($pension) > 0){
			array_push($conditions, "PENSION_TYPE IN (".implode(",", $pension).")");
		}
		if(count($uniform) > 0){
			array_push($conditions, "UA_ELIGIBLE IN (".implode(",", $uniform).")");
		}
		if(count($bonus) > 0){
			array_push($conditions, "BONUS_ELIGIBLE IN (".implode(",", $bonus).")");
		}
		if(count($gender) > 0){
			array_push($conditions, "GENDER IN (".implode(",", $gender).")");
		}
		if(count($quarter) > 0){
			array_push($conditions, "IS_QUARTER_ALLOCATED IN (".implode(",", $quarter).")");
		}
		if(count($hra_slab) > 0){
			array_push($conditions, "HRA_SLAB_ID_FK IN (".implode(",", $hra_slab).")");
		}
		
		$conditionString = implode(" AND ", $conditions);
		
		if(count($conditions) > 0){
			//$employees = Yii::app()->db->createCommand("SELECT * FROM tbl_employee WHERE IS_TRANSFERRED=0 AND IS_RETIRED=0 AND DESIGNATION_ID_FK IN (".implode(",", $designations).") ORDER BY DESIGNATION_ID_FK DESC ")->queryAll();
			$employees = Yii::app()->db->createCommand("SELECT * FROM tbl_employee WHERE ".$conditionString." ORDER BY DESIGNATION_ID_FK DESC ")->queryAll();
		}
		else{
			//$employees = Yii::app()->db->createCommand("SELECT * FROM tbl_employee WHERE IS_TRANSFERRED=0 AND IS_RETIRED=0 ORDER BY DESIGNATION_ID_FK DESC ")->queryAll();
			$employees = Yii::app()->db->createCommand("SELECT * FROM tbl_employee ORDER BY DESIGNATION_ID_FK DESC ")->queryAll();
		}
	 ?>
	<tbody>
		<?php 
			$i=1;
			foreach($employees as $employee){ ?>
		<tr>
			<td><?php echo $i;?></td>
			<?php foreach($list as $key=>$value){  ?>
			<td>
			<?php 
				if($employee[$value] !='') {
					
					if($value == 'DESIGNATION_ID_FK'){
						echo ($employee[$value] == 0) ? "": Designations::model()->findByPK($employee[$value])->DESIGNATION."<br/>".Designations::model()->findByPK($employee[$value])->DESIGNATION_HINDI;
					}
					else if($value == 'PAY_MATRIX_ID_FK'){
						$matrix = "";
						if(($employee[$value] != 0)){
							$matrix = PayMatrix::model()->findByPK($employee[$value])->TEXT;
						}
						echo $matrix;
					}
					else if($value == 'GROUP_ID_FK'){
						echo ($employee[$value] == 0) ? "": Groups::model()->findByPK($employee[$value])->GROUP_NAME;
					}
					else if($value == 'NAME'){
						echo $employee['NAME']."<br>".$employee['NAME_HINDI'];
					}
					else if($value == 'DOB'){
						echo ($employee[$value] == "") ? "": date('d-m-Y', strtotime($employee['DOB']));
					}
					else if($value == 'DOI'){
						echo ($employee[$value] == "") ? "": date('d-m-Y', strtotime($employee['DOI']));
					}
					else if($value == 'ORG_JOIN_DATE'){
						echo ($employee[$value] == "") ? "": date('d-m-Y', strtotime($employee['ORG_JOIN_DATE']));
					}
					else if($value == 'DEPT_JOIN_DATE'){
						echo ($employee[$value] == "") ? "": date('d-m-Y', strtotime($employee['DEPT_JOIN_DATE']));
					}
					else if($value == 'DEPT_RELIEF_DATE'){
						echo ($employee[$value] == "") ? "": date('d-m-Y', strtotime($employee['DEPT_RELIEF_DATE']));
					}
					else if($value == 'PRESENT_PROMOTION_DATE'){
						echo ($employee[$value] == "") ? "": date('d-m-Y', strtotime($employee['PRESENT_PROMOTION_DATE']));
					}
					else{
						echo $employee[$value];
					}
				}
			?></td>
			<?php } ?>
			<?php if(isset($custom_1) && $custom_1 != '') {?>
			<td></td>
			<?php 
			}
			if(isset($custom_2) && $custom_2 != '') {?>
				<td></td>
			<?php } ?>
		</tr>
		<?php $i++;  } ?>
	</tbody>
</table>

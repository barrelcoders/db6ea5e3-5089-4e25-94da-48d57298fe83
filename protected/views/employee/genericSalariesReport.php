<?php $master = Master::model()->findByPK(1);?>
<?php
	$periods = array();
	$start    = (new DateTime($START_YEAR.'-'.$START_MONTH.'-01'))->modify('first day of this month');
	$end      = (new DateTime($END_YEAR.'-'.$END_MONTH.'-01'))->modify('last day of this month');
	$interval = DateInterval::createFromDateString('1 month');
	$intervals   = new DatePeriod($start, $interval, $end);

	foreach ($intervals as $int) {
		array_push($periods, array('FORMAT'=> $int->format("M-Y"), 'MONTH'=>$int->format("n"), 'YEAR'=>$int->format("Y")));
	}
	
	$IS_MULTIPLE_MONTH = false;
	if(count($periods) > 0)
		$IS_MULTIPLE_MONTH = true;
	
	$total_months = count($periods);
	
	
?>
<table border="1" style="margin: 0 auto;" class="one-table">
	<thead>
		<tr>
			<th class="small-xxx left-br right-br">S.No.</th>
			<th class="small-x right-br">NAME</th>
			<th class="small-x right-br">DESIGNATION</th>
			<?php if($IS_MULTIPLE_MONTH) {?>
			<th class="small-xx right-br">MONTH</th>
			<?php } ?>
			<th class="small-x right-br">BASIC</th>
			<th class="small-xxx right-br">SP</th>
			<th class="small-xx right-br">HRA</th>
			<th class="small-xx right-br">DA</th>
			<th class="small-xx right-br">TA</th>
			<th class="small-xxx right-br">WA</th>
			<th class="small-xx right-br">GROSS</th>
			<th class="small-xxx right-br">IT</th>
			<th class="small-xxx right-br">CGHS</th>
			<th class="small-xxx right-br">LF</th>
			<th class="small-xxx right-br">CGEGIS</th>
			<th class="small-xx right-br">GPF<br>Cont./CPF TIER I</th>
			<th class="small-xx right-br">GPF<br>Rec./CPF TIER II</th>
			<th class="small-xxx right-br">HBA</th>
			<th class="small-xxx right-br">MCA</th>
			<th class="small-xxx right-br">COMP</th>
			<th class="small-xxx right-br">MISC</th>
			<th class="small-xxx right-br">COURT</th>
			<th class="small-xxx right-br">PLI</th>
			<th class="small-xx right-br">DEDUCTION</th>
			<th class="small-xx right-br">NET</th>
			<th class="small-xxx right-br">PT</th>
			<th class="small-xx right-br">OTHER DED.</th>
			<th class="small-x  right-br">AMOUNT BANK</th>
			<th class="small-x  right-br">REMARKS</th>
		</tr>
	</thead>
	<?php 
		$employees = null;
		$conditions = array();
		if(count($employee_ids) > 0){
			array_push($conditions, "ID IN (".implode(",", $employee_ids).")");
		}
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
		if(count($permanent) > 0){
			array_push($conditions, "IS_PERMANENT IN (".implode(",", $permanent).")");
		}
		if(count($transfered) > 0){
			array_push($conditions, "IS_TRANSFERRED IN (".implode(",", $transfered).")");
		}
		if(count($retired) > 0){
			array_push($conditions, "IS_RETIRED IN (".implode(",", $retired).")");
		}
		if(count($suspended) > 0){
			array_push($conditions, "IS_SUSPENDED IN (".implode(",", $suspended).")");
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
		
		$i = 1;	
	 ?>
	<tbody>
		<?php foreach ($employees as $employee) {
				$j=1;
				foreach($periods as $period){
					$salary = null;
					;
					if(SalaryDetails::model()->exists("t.EMPLOYEE_ID_FK=".$employee['ID']." AND t.IS_SALARY_BILL=1 AND t.MONTH=".$period['MONTH']." AND t.YEAR=".$period['YEAR'])){
						$salary = SalaryDetails::model()->find("t.EMPLOYEE_ID_FK=".$employee['ID']." AND t.IS_SALARY_BILL=1 AND t.MONTH=".$period['MONTH']." AND t.YEAR=".$period['YEAR']);
					}
					else if (SupplementarySalaryDetails::model()->exists("t.EMPLOYEE_ID_FK=".$employee['ID']." AND t.MONTH=".$period['MONTH']." AND t.YEAR=".$period['YEAR'])){
						$salary = SupplementarySalaryDetails::model()->find("t.EMPLOYEE_ID_FK=".$employee['ID']." AND t.MONTH=".$period['MONTH']." AND t.YEAR=".$period['YEAR']);
					}
					else{
						$salary = SalaryDetails::model();
					}
					if($IS_MULTIPLE_MONTH) { 
						if($j==1){ ?>
							<tr>
								<td rowspan="<?php echo $total_months;?>" class="small-xxx left-br right-br"><?php echo $i; ?></td>
								<td rowspan="<?php echo $total_months;?>" class="small-x right-br"><b><?php echo Employee::model()->findByPK($employee['ID'])->NAME;?></b></td>
								<td rowspan="<?php echo $total_months;?>" class="small-x right-br"><b><?php echo Designations::model()->findByPK(Employee::model()->findByPK($employee['ID'])->DESIGNATION_ID_FK)->DESIGNATION;?></b></td>
								<td class="small-xx right-br"><?php echo $period['FORMAT']; ?></td>
								<td class="small-xx right-br"><?php echo $salary->BASIC; ?></td>
								<td class="small-xxx right-br"><?php echo $salary->SP; ?></td>
								<td class="small-xx right-br"><?php echo $salary->HRA; ?></td>
								<td class="small-xx right-br"><?php echo $salary->DA; ?></td>
								<td class="small-xx right-br"><?php echo $salary->TA; ?></td>
								<td class="small-xxx right-br"><?php echo $salary->WA; ?></td>
								<td class="small-xx right-br"><?php echo $salary->GROSS; ?></td>
								<td class="small-xxx right-br"><?php echo $salary->IT; ?></td>
								<td class="small-xxx right-br"><b><?php echo $salary->CGHS;?></b></td>
								<td class="small-xxx right-br"><b><?php echo $salary->LF;?></b></td>
								<td class="small-xxx right-br"><?php echo $salary->CGEGIS; ?></td>
								<td class="small-xx right-br"><?php echo $salary->CPF_TIER_I; ?></td>
								<td class="small-xx right-br"><?php echo $salary->CPF_TIER_II; ?></td>
								<td class="small-xxx right-br"><?php echo $salary->HBA_EMI; ?></td>
								<td class="small-xxx right-br"><?php echo $salary->MCA_EMI; ?></td>
								<td class="small-xxx right-br"><?php echo $salary->COMP_EMI; ?></td>
								<td class="small-xxx right-br"><?php echo $salary->MISC; ?></td>
								<td class="small-xxx right-br"><?php echo $salary->COURT_ATTACHMENT; ?></td>
								<td class="small-xxx right-br"><?php echo $salary->PLI; ?></td>
								<td class="small-xx right-br"><?php echo $salary->DED; ?></td>
								<td class="small-xx right-br"><?php echo $salary->NET; ?></td>
								<td class="small-xxx right-br"><?php echo $salary->PT; ?></td>
								<td class="small-xx right-br"><?php echo $salary->OTHER_DED; ?></td>
								<td class="small-x right-br"><?php echo $salary->AMOUNT_BANK; ?></td>
								<td class="small-x right-br"><?php echo $salary->REMARKS; ?></td>
							</tr>
						<?php } else { ?>
							<tr>
								<td class="small-xx right-br"><?php echo $period['FORMAT']; ?></td>
								<td class="small-xx right-br"><?php echo $salary->BASIC; ?></td>
								<td class="small-xxx right-br"><?php echo $salary->SP; ?></td>
								<td class="small-xx right-br"><?php echo $salary->HRA; ?></td>
								<td class="small-xx right-br"><?php echo $salary->DA; ?></td>
								<td class="small-xx right-br"><?php echo $salary->TA; ?></td>
								<td class="small-xxx right-br"><?php echo $salary->WA; ?></td>
								<td class="small-xx right-br"><?php echo $salary->GROSS; ?></td>
								<td class="small-xxx right-br"><?php echo $salary->IT; ?></td>
								<td class="small-xxx right-br"><b><?php echo $salary->CGHS;?></b></td>
								<td class="small-xxx right-br"><b><?php echo $salary->LF;?></b></td>
								<td class="small-xxx right-br"><?php echo $salary->CGEGIS; ?></td>
								<td class="small-xx right-br"><?php echo $salary->CPF_TIER_I; ?></td>
								<td class="small-xx right-br"><?php echo $salary->CPF_TIER_II; ?></td>
								<td class="small-xxx right-br"><?php echo $salary->HBA_EMI; ?></td>
								<td class="small-xxx right-br"><?php echo $salary->MCA_EMI; ?></td>
								<td class="small-xxx right-br"><?php echo $salary->COMP_EMI; ?></td>
								<td class="small-xxx right-br"><?php echo $salary->MISC; ?></td>
								<td class="small-xxx right-br"><?php echo $salary->COURT_ATTACHMENT; ?></td>
								<td class="small-xxx right-br"><?php echo $salary->PLI; ?></td>
								<td class="small-xx right-br"><?php echo $salary->DED; ?></td>
								<td class="small-xx right-br"><?php echo $salary->NET; ?></td>
								<td class="small-xxx right-br"><?php echo $salary->PT; ?></td>
								<td class="small-xx right-br"><?php echo $salary->OTHER_DED; ?></td>
								<td class="small-x right-br"><?php echo $salary->AMOUNT_BANK; ?></td>
								<td class="small-x right-br"><?php echo $salary->REMARKS; ?></td>
							</tr>
						<?php
						}
						$j++;
					} else { ?>
						<tr>
								<td class="small-xxx left-br right-br"><?php echo $i; ?></td>
								<td class="small-x right-br"><b><?php echo Employee::model()->findByPK($employee['ID'])->NAME;?></b></td>
								<td class="small-x right-br"><b><?php echo Designations::model()->findByPK(Employee::model()->findByPK($employee['ID'])->DESIGNATION_ID_FK)->DESIGNATION;?></b></td>
								<td class="small-xx right-br"><?php echo $salary->BASIC; ?></td>
								<td class="small-xxx right-br"><?php echo $salary->SP; ?></td>
								<td class="small-xx right-br"><?php echo $salary->HRA; ?></td>
								<td class="small-xx right-br"><?php echo $salary->DA; ?></td>
								<td class="small-xx right-br"><?php echo $salary->TA; ?></td>
								<td class="small-xxx right-br"><?php echo $salary->WA; ?></td>
								<td class="small-xx right-br"><?php echo $salary->GROSS; ?></td>
								<td class="small-xxx right-br"><?php echo $salary->IT; ?></td>
								<td class="small-xxx right-br"><b><?php echo $salary->CGHS;?></b></td>
								<td class="small-xxx right-br"><b><?php echo $salary->LF;?></b></td>
								<td class="small-xxx right-br"><?php echo $salary->CGEGIS; ?></td>
								<td class="small-xx right-br"><?php echo $salary->CPF_TIER_I; ?></td>
								<td class="small-xx right-br"><?php echo $salary->CPF_TIER_II; ?></td>
								<td class="small-xxx right-br"><?php echo $salary->HBA_EMI; ?></td>
								<td class="small-xxx right-br"><?php echo $salary->MCA_EMI; ?></td>
								<td class="small-xxx right-br"><?php echo $salary->COMP_EMI; ?></td>
								<td class="small-xxx right-br"><?php echo $salary->MISC; ?></td>
								<td class="small-xxx right-br"><?php echo $salary->COURT_ATTACHMENT; ?></td>
								<td class="small-xxx right-br"><?php echo $salary->PLI; ?></td>
								<td class="small-xx right-br"><?php echo $salary->DED; ?></td>
								<td class="small-xx right-br"><?php echo $salary->NET; ?></td>
								<td class="small-xxx right-br"><?php echo $salary->PT; ?></td>
								<td class="small-xx right-br"><?php echo $salary->OTHER_DED; ?></td>
								<td class="small-x right-br"><?php echo $salary->AMOUNT_BANK; ?></td>
								<td class="small-x right-br"><?php echo $salary->REMARKS; ?></td>
							</tr>
					<?php } ?>
			<?php } ?>
		<?php  $i++; 
		} ?>
	</tbody>
	
</table>

<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/oneadmin.css" rel="stylesheet">
<table class="table table-bordered table-hover" style="margin-bottom: 10px;">
	<tr>
		<td colspan="5">
			<a href="<?php echo Yii::app()->createUrl('bill/update', array('id'=>$model->ID))?>"><?php echo $model->BILL_TITLE; ?></a>
		</td>
		<td colspan="3">
			<span style="float: right;"><?php echo $model->BILL_NO; ?></span>
		</td>
	</tr>
</table>
 <table class="table table-bordered table-hover" style="margin-bottom: 10px;">
	<tr>
		<th>Change</th>
		<th>Status</th>
	</tr>
<?php
	$salaries = Yii::app()->db->createCommand("SELECT * FROM tbl_salary_details WHERE BILL_ID_FK=".$model->ID)->queryAll();
	
	foreach($salaries as $salary){
		$employee = Employee::model()->findByPk($salary['EMPLOYEE_ID_FK']);
		$MONTH = $salary['MONTH'];
		$YEAR = $salary['YEAR'];
		$CURRENT_SALARY = $salary;
		$LAST_SALARY = null;
		if(SalaryDetails::model()->exists('IS_SALARY_BILL = 1 AND EMPLOYEE_ID_FK='.$employee->ID.' AND YEAR='.(($MONTH ==1) ? ($YEAR - 1 ) : $YEAR).' AND MONTH='.(($MONTH ==1) ? 12 : ($MONTH - 1)))){
			$LAST_SALARY = Yii::app()->db->createCommand("SELECT * FROM tbl_salary_details WHERE IS_SALARY_BILL = 1 AND EMPLOYEE_ID_FK=".$employee->ID." AND YEAR=".(($MONTH ==1) ? ($YEAR - 1 ) : $YEAR)." AND MONTH=".(($MONTH ==1) ? 12 : ($MONTH - 1)))->queryRow();
		}
		else if(SupplementarySalaryDetails::model()->exists('EMPLOYEE_ID_FK='.$employee->ID.' AND YEAR='.(($MONTH ==1) ? ($YEAR - 1 ) : $YEAR).' AND MONTH='.(($MONTH ==1) ? 12 : ($MONTH - 1)))){
			$LAST_SALARY = Yii::app()->db->createCommand("SELECT * FROM tbl_supplementary_salary_details WHERE EMPLOYEE_ID_FK=".$employee->ID." AND YEAR=".(($MONTH ==1) ? ($YEAR - 1 ) : $YEAR)." AND MONTH=".(($MONTH ==1) ? 12 : ($MONTH - 1)))->queryRow();
		}
		if(count($LAST_SALARY) > 0 && count($CURRENT_SALARY) > 0)
		$change = calculateChanges($CURRENT_SALARY, $LAST_SALARY);
		if($change !=""){
			$message = $employee->NAME.", ".Designations::model()->findByPk($employee->DESIGNATION_ID_FK)->DESIGNATION. ": ".$change;
			if(!Changes::model()->exists("BILL_ID_FK = ".$model->ID." AND TITLE='".$message."'")){
				$change = new Changes;
				$change->BILL_ID_FK = $model->ID;
				$change->TITLE = $message;
				$change->STATUS = 0;
				$change->save(false);
			}
		}
	}
	
	function calculateChanges($newArray, $oldArray){
		$length = count($newArray);
		$result = array();
		foreach($newArray as $key=>$value){
			if($key != "MONTH" && $key != "YEAR" && $key != "ID" && $key != "BILL_ID_FK" && $key != "EMPLOYEE_ID_FK" && $key != "FLOOD_EMI" && $key != "CYCLE_EMI" && $key != "FEST_EMI" && $key != "FLOOD_TOTAL" && 
			$key != "FLOOD_TOTAL "  && $key != "CYCLE_TOTAL" && $key != "FEST_TOTAL" && $key != "FLOOD_INST" && $key != "CYCLE_INST" && $key != "FEST_INST" && 
			$key != "FLOOD_BAL" && $key != "CYCLE_BAL" && $key != "FEST_BAL" && $key != "WA" && $key != "GROSS" && $key != "DED" && $key != "NET" && $key != "OTHER_DED" && 
			$key != "AMOUNT_BANK" && $key != "CEA" && $key != "UA" && $key != "BONUS" && $key != "LTC_HTC" && $key != "IS_SALARY_BILL" && $key != "IS_FEST_RECOVERY" &&
			$key != "IS_FLOOD_RECOVERY" && $key != "IS_CYCLE_RECOVERY" && $key != "RECOVERY" && $key != "EL_ENCASHMENT" && $key != "LTC_HTC_GROSS" && $key != "LTC_HTC_ADVANCE"){
				 if($oldArray[$key] != $newArray[$key]){
					 $salaryModel = SalaryDetails::model();
					 array_push($result, $salaryModel->getAttributeLabel($key)." changes from ". $oldArray[$key]." to ".$newArray[$key]);
				 }
				 
			 }
		}
		return implode(",", $result);
	}
	
?>
<?php 
	$changes = Changes::model()->findAll("BILL_ID_FK=".$model->ID);
	foreach($changes as $change){?>
<tr
	class="<?php echo ($change->STATUS ==1) ? "notified" : "not-notified";?>"
>
	<td><?php echo $change->TITLE;?></td>
	<td>
	<?php 
		if($change->STATUS ==1){
			echo "Notified";
		}
		else{
		?>
			<form method="post" action="<?php echo Yii::app()->createUrl('Bill/PayBillChangesNotified', array('bill_id'=>$model->ID, 'change_id'=>$change->ID));?>">
				<input type="submit" value="Notify" class="btn btn-inline">
			</form>
		<?php
		}
	?>
	</td>
</tr>
<?php } ?>
</table>
<style>
	.notified{
		background: #c5fbc5;
		color: #000;
	}
	.not-notified{
		background: #fbb;
		color: #000;
	}
</style>
<?php require_once "/../../../../include/ExpenditureReportInclude.php";?>
<?php
	$monthName = array('1'=>'January',
						'2'=>'February',
						'3'=>'March',
						'4'=>'April',
						'5'=>'May',
						'6'=>'June',
						'7'=>'July',
						'8'=>'August',
						'9'=>'September',
						'10'=>'October',
						'11'=>'November',
						'12'=>'December');
	$monthNameHindi = array('1'=>'जनवरी',
						'2'=>'फ़रवरी',
						'3'=>'मार्च',
						'4'=>'अप्रैल',
						'5'=>'मई',
						'6'=>'जून',
						'7'=>'जुलाई',
						'8'=>'अगस्त',
						'9'=>'सितंबर',
						'10'=>'अक्टूबर',
						'11'=>'नवंबर',
						'12'=>'दिसंबर');
?><?php $master = Master::model()->findByPK(1); ?>
<p style="font-size: 15px;text-align: center;font-weight: bold;">PROFORMA FOR COLLECTING DATA ON ACTUAL EXPENDITURE INCURRED BY THE MINISTRIES 	</p>
<p style="font-size: 15px;text-align: center;font-weight: bold;">DEPARTMENTS/MINISTRIES AND THEIR ATTACHED AND SUBORDINATE OFFICES ON PAY & VARIOUS 	</p>
<p style="font-size: 15px;text-align: center;font-weight: bold;"> TYPES OF ALLOWANCES OF THEIR REGULAR CIVILIAN EMPLOYEES 	</p><br><br>
<p style="font-size: 15px;text-align: center;font-weight: bold;"> I. कार्यालय विशेष/OFFICE PARTICULARS 	</p>

<span style="font-size: 15px;font-weight: bold;"></span>
<br><br>
<table class="one-table" style="table-layout: fixed;width: 600px;display: block;margin: 0 auto;">
	<tbody>
		<tr>
			<td>1</td>
			<td>स्थापना का नाम, पुरे डाक पते के साथ/ Name of the establishment with full postal address</td>
			<td><?php echo $master->OFFICE_NAME_HINDI;?><br><?php echo $master->OFFICE_NAME;?></td>
		</tr>
		<tr>
			<td>2</td>
			<td>स्थापना की स्थिति/ Status of Establishment</td>
			<td>मंडल कार्यालय/Divisional Office</td>
		</tr>
		<tr>
			<td>3</td>
			<td>If the Establishment is an Attached or subordinate office, please write the name of the Min/Dept. under which it is functioning</td>
			<td><?php echo $master->HOO_OFFICE_NAME_HINDI;?><br><?php echo $master->HOO_OFFICE_NAME;?></td>
		</tr>
		<tr>
			<td>4</td>
			<td>Name , Designation ,Postal address, Telephone no, Fax No., email address of the Officer of the level of Depty Secy./Dir. Who is responsible for furnishing the return</td>
			<td><?php echo Employee::model()->findByPK($master['DEPT_HEAD_EMPLOYEE'])->NAME_HINDI.",".Designations::model()->findByPK(Employee::model()->findByPK($master['DEPT_HEAD_EMPLOYEE'])->DESIGNATION_ID_FK)->DESIGNATION_HINDI.",".$master->OFFICE_ADDRESS_HINDI;?><br>
				<?php echo Employee::model()->findByPK($master['DEPT_HEAD_EMPLOYEE'])->NAME.",".Designations::model()->findByPK(Employee::model()->findByPK($master['DEPT_HEAD_EMPLOYEE'])->DESIGNATION_ID_FK)->DESIGNATION.",".$master->OFFICE_ADDRESS;?><br>
			</td>
		</tr>
		<tr>
			<td>5</td>
			<td>Period of the quarter under the report (if the report is for the entire year, it may please be mentioned)</td>
			<td>Q.E. <?php echo date('t', strtotime($monthName[$this->QuarterEnd].' '.$this->Year))."-".$this->QuarterEnd."-".$this->Year?><br></td>
		</tr>
		<tr>
			<td>6</td>
			<td>तिमाही के अंत में कर्मचारियों के बारे में जानकारी/ INFORMATION ON EMPLOYEES( AT THE END OF THE QUARTER)</td>
			<td>
					<span style="display: inline-block;margin-right: 5px;float: left;">A<br/><?php echo Employee::model()->count('t.IS_TRANSFERRED=0 AND t.IS_RETIRED=0 AND t.DESIGNATION_ID_FK>=19')?></span>
					<span style="display: inline-block;margin-right: 5px;float: left;">B<br/><?php echo Employee::model()->count('t.IS_TRANSFERRED=0 AND t.IS_RETIRED=0 AND t.DESIGNATION_ID_FK<=18 AND t.DESIGNATION_ID_FK>=10')?></span>
					<span style="display: inline-block;margin-right: 5px;float: left;">C<br/><?php echo Employee::model()->count('t.IS_TRANSFERRED=0 AND t.IS_RETIRED=0 AND t.DESIGNATION_ID_FK<=9 AND t.DESIGNATION_ID_FK>=8')?></span>
					<span style="display: inline-block;margin-right: 5px;float: left;">D<br/><?php echo Employee::model()->count('t.IS_TRANSFERRED=0 AND t.IS_RETIRED=0 AND t.DESIGNATION_ID_FK<=7')?></span>
			</td>
		</tr>
	</tbody>
</table>
<div style="font-weight: bold; width:400px; float: right;text-align:center; margin-top:100px;margin-right:-10px;">
	<p><?php echo Employee::model()->findByPK($master['DEPT_ADMIN_EMPLOYEE'])->NAME;?></p>
	<p><?php echo Designations::model()->findByPK(Employee::model()->findByPK($master['DEPT_ADMIN_EMPLOYEE'])->DESIGNATION_ID_FK)->DESIGNATION;?></p>
	<p><?php echo $master['DEPT_NAME']?></p>
</div>
<style>
	th, td{text-align: center;}
</style>
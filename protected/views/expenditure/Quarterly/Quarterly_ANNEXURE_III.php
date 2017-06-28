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
<span style="font-size: 15px;font-weight: bold;"></span>
<br><br>
<table class="one-table" style="table-layout: fixed;width: 600px;display: block;margin: 0 auto;">
	<tbody>
		<tr>
			<td colspan="5">जानकारी प्रस्तुत करने वाले अधिकारी का नाम, पदनाम, डाक पता, टेलीफोन नं. एवं ईमेल आईडी /Name, Designation, Postal address, Tel.No. & e-mail of official responsible for furnishing the information				</td>
			<td colspan="4"><?php echo Employee::model()->findByPK($master['DEPT_HEAD_EMPLOYEE'])->NAME_HINDI.",".Designations::model()->findByPK(Employee::model()->findByPK($master['DEPT_HEAD_EMPLOYEE'])->DESIGNATION_ID_FK)->DESIGNATION_HINDI.",".$master->OFFICE_ADDRESS_HINDI;?><br>
				<?php echo Employee::model()->findByPK($master['DEPT_HEAD_EMPLOYEE'])->NAME.",".Designations::model()->findByPK(Employee::model()->findByPK($master['DEPT_HEAD_EMPLOYEE'])->DESIGNATION_ID_FK)->DESIGNATION.",".$master->OFFICE_ADDRESS;?>, Tel. No.-080-29730116<br>
			</td>
		</tr>
		<tr>
			<td colspan="9"> विभिन्न वेतन समूह एवं ग्रेड वेतन में पदों का ब्यौरा/ DETAILS OF POSTS IN DIFFERENT PAY BANDS AND GRADE PAY:</td>
		</tr>
		<tr>
			<th>सी. सं./ Sl.No.</th>
			<th>Pay Band</th>
			<th>Grade Pay</th>
			<th>Regular/ Temporary/ Adhoc</th>
			<th>Group of Post<br>A/B/C/D unclassified</th>
			<th>Gazetted/ Non-Gazetted</th>
			<th>No. of sanctioned Posts</th>
			<th>WORKING POSITION</th>
			<th>Name of the post</th>
		</tr>
		<tr>
			<th>1</th>
			<th>2</th>
			<th>3</th>
			<th>4</th>
			<th>5</th>
			<th>6</th>
			<th>7</th>
			<th>8</th>
			<th>9</th>
		</tr>
		<?php
			$Paybands = Paybands::model()->findAll(array('order'=>'ID DESC'));
			$i=1;
			foreach($Paybands as $Payband){
				if(Employee::model()->exists('IS_TRANSFERRED=0 AND IS_RETIRED=0 AND GRADE_PAY_ID_FK='.$Payband->ID)){
				?>
					<tr>
						<td><?php echo $i;?></td>
						<td><?php echo $Payband->PAY_DETAILS;?></td>
						<td><?php echo $Payband->GRADE_PAY;?></td>
						<td>Regular</td>
						<td><?php echo $Payband->GROUP; ?></td>
						<td><?php echo $Payband->GRADE_TYPE; ?></td>
						<td><?php echo $Payband->SANCTIONED_POST; ?></td>
						<td><?php echo Employee::model()->count('IS_TRANSFERRED=0 AND IS_RETIRED=0 AND GRADE_PAY_ID_FK='.$Payband->ID);?></td>
						<td></td>
					</tr>
				<?php
				$i++;
				}
			}
		?>
		<tr>
			<th colspan="6">TOTAL</th>
			<th><?php echo Yii::app()->db->createCommand("SELECT SUM(SANCTIONED_POST) as SANCTIONED_POST FROM tbl_paybands ")->queryRow()['SANCTIONED_POST']?></th>
			<th><?php echo Employee::model()->count('IS_TRANSFERRED=0 AND IS_RETIRED=0');?></th>
			<th></th>
		</tr>
		<tr>
			<td>Note:</td>
			<td colspan="8"> After re-organisation of formation, the Sanction Strength  of Divisions has  been communicated vide Administrative(General) Standing Order No. 02/2015 dt.18.12.2015 issued from File C.No.II/39/05/2015 Estt. B-IV/2746</td>
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
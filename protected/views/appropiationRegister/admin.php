<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/oneadmin.css" rel="stylesheet">
<script>
function openEmployeeSalaryDetails(evt, empID) {
	var i, tabcontent, tablinks;
	tabcontent = document.getElementsByClassName("tabcontent");
	for (i = 0; i < tabcontent.length; i++) {
		tabcontent[i].style.display = "none";
	}
	tablinks = document.getElementsByClassName("tablinks");
	for (i = 0; i < tablinks.length; i++) {
		tablinks[i].className = tablinks[i].className.replace(" active", "");
	}
	document.getElementById(empID).style.display = "block";
	evt.currentTarget.className += " active";
}
</script>
<div class="container-fluid">
	<div class="box-typical box-typical-padding">
		<ul class="tab">
			<?php foreach(Budget::model()->findAll() as $budget){ ?>
					<li><a href="javascript:void(0)" class="tablinks" onclick="openEmployeeSalaryDetails(event, <?php echo $budget->id?>)"><?php echo $budget->HEAD?></a></li>
			<?php }?>
		</ul>
		<?php foreach(Budget::model()->findAll() as $budget){ ?>
			<div id="<?php echo $budget->id?>" class="tabcontent">
				<table class="table table-bordered table-hover">
					<tr style='border-left:10px Solid #000;color:#000;'>
						<th>BILL NO</th>
						<th>BILL TITLE</th>
						<th>BILL AMOUNT</th>
						<th>PROGRESSIVE TOTAL</th>
						<th>BALANCE</th>
					</tr>
					<?php
					$appropiations = AppropiationRegister::model()->findAll('BUDGET_ID = '.$budget->id);
					foreach($appropiations as $appropiation){
					?>
						
							<tr <?php 
								if($appropiation->BILL_NO != 0) {
									if(Bill::model()->findByPK($appropiation->BILL_NO)->PFMS_STATUS == 'Passed') {
										echo "style='border-left:10px Solid #009a00;color:#000;'";
									}
									else{
										echo "style='border-left:10px Solid #F00;color:#000;'";
									}
								}
								else if($appropiation->BILL_NO == 0){
									echo "style='border-left:10px Solid #b30083;color:#000;'";
								} ?>>
								<td style=""> 
					<?php if($appropiation->BILL_NO != 0){
						if(Bill::model()->findByPK($appropiation->BILL_NO)->PFMS_STATUS == 'Passed') {
							echo Bill::model()->findByPK($appropiation->BILL_NO)->BILL_NO;
							if(Bill::model()->findByPK($appropiation->BILL_NO)->PFMS_BILL_NO != ''){
								echo "<hr>".Bill::model()->findByPK($appropiation->BILL_NO)->PFMS_BILL_NO;
							} 
							echo "<hr>".date('d-M-Y', strtotime(Bill::model()->findByPK($appropiation->BILL_NO)->PASSED_DATE));
						}
						else{
							echo Bill::model()->findByPK($appropiation->BILL_NO)->BILL_NO;
							if(Bill::model()->findByPK($appropiation->BILL_NO)->PFMS_BILL_NO != ''){
								echo "<hr>".Bill::model()->findByPK($appropiation->BILL_NO)->PFMS_BILL_NO;
							} 
						}
					}?> </td>
								<td><?php 
								if($appropiation->BILL_NO != 0){
									echo Bill::model()->findByPK($appropiation->BILL_NO)->BILL_TITLE; 
								}	
								else{
									$BALANCE = Yii::app()->db->createCommand("SELECT BALANCE FROM tbl_appropiation_register WHERE  ID < ".$appropiation->ID. " AND BUDGET_ID = ".$budget->id." ORDER BY ID DESC LIMIT 1 ")->queryRow()['BALANCE'];
									$CHANGE_SIGN = "";
									$CHANGE = 0;
									if($BALANCE > $appropiation->BALANCE){
										$CHANGE_SIGN = "DEDUCTED";
										$CHANGE = $BALANCE - $appropiation->BALANCE;
									}
									else{
										$CHANGE_SIGN = "ADDED";
										$CHANGE =  $appropiation->BALANCE - $BALANCE; 
									}
									echo "APPROPIATION UPDATE ( ".$CHANGE_SIGN." Rs. ".$CHANGE."/- on ".date('d M Y', strtotime($appropiation->UPDATION_DATE)).")";	
								} ?></td>
								<td><?php  if($appropiation->BILL_NO != 0)	echo $appropiation->BILL_AMOUNT; ?> </td>
								<td><?php echo $appropiation->EXPENDITURE_INC_BILL; ?></td>
								<td><?php echo $appropiation->BALANCE; ?></td>
							</tr>
					<?php } ?>
				</table>
			</div>
		<?php }  ?>
	</div>
</div>
<style>hr{margin:2px 0;}</style>
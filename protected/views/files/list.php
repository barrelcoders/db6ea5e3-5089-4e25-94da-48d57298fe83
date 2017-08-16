<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/oneadmin.css" rel="stylesheet">
<style>
	h1{font-size: 20px;font-weight: bold;}
	th,h1{text-align: center;}
	th{font-weight: bold;}
	.one-table tr, .one-table td, .one-table th {width: auto;}
</style>
<?php $master = Master::model()->findByPK(1); ?>
<h1>Files in R/O <?php echo $master->DEPT_NAME;?>(<?php echo $master->DEPT_NAME_HINDI;?>)</h1>
<table style="width: 100%;">
	<tr>
		<td colspan="2">Division & Comm'te: <?php echo $master->DEPT_NAME;?></td>
	</tr>
	<tr>
		<td>AO: <?php echo Employee::model()->findByPK($master->DEPT_ADMIN_EMPLOYEE)->NAME?></td>
		<td>DH: <?php echo Employee::model()->findByPK(16)->NAME?></td>
	</tr>
</table>
<br><br>

<table class="one-table" cellmargin="10" style="display: block; clear: both;">
	<thead>
		<tr>
			<th>S.No</th>
			<th>File Number</th>
			<th>File Description</th>
			<th>Notesheet No.</th>
			<th>Correspondence Page No.</th>
		</tr>
	</thead>
	<tbody>
		<?php
			$i=1;
			$files = Files::model()->findAll(array("order" => "YEAR, SUBSTRING(NUMBER, 1, POSITION('/' IN NUMBER) - 1)"));
			if(count($files) > 0) {
				foreach($files as $file){
			?>
				<tr>
					<td width="5%" style="text-align: center;"><?php echo $i;?></td>
					<td width="40%" style="text-align: center;"><?php echo $file->NUMBER;?></td>
					<td width="45%" style="text-align: left; padding-left: 10px"><?php echo $file->SUBJECT;?></td>
					<td width="5%" style="text-align: left; padding-left: 10px"><?php echo $file->NOTESHEET;?></td>
					<td width="5%" style="text-align: left; padding-left: 10px"><?php echo $file->CORRESPONDENCE;?></td>
				</tr>
			<?php
					$i++;
				}
			}
		?>
	</tbody>
</table>
<div style="font-weight: bold; width:400px; float: right;text-align:center; margin-top:20px;margin-right:-10px;">
	<p>(<?php echo Employee::model()->findByPK($master['DEPT_ADMIN_EMPLOYEE'])->NAME;?>)</p>
	<p><?php echo Designations::model()->findByPK(Employee::model()->findByPK($master['DEPT_ADMIN_EMPLOYEE'])->DESIGNATION_ID_FK)->DESIGNATION;?></p>
	<p><?php echo $master['DEPT_NAME']?></p>
</div>
<script type="text/javascript">window.onload = function() { window.print(); }</script><style>
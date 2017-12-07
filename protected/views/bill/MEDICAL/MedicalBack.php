<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/oneadmin.css" rel="stylesheet">
<?php $master = Master::model()->findByPK(1);
$monthName = array('1'=>'January', '2'=>'February', '3'=>'March', '4'=>'April', '5'=>'May', '6'=>'June', '7'=>'July', '8'=>'August', '9'=>'September', '10'=>'October', '11'=>'November', '12'=>'December');
	 ?>
<style>
	td{
		padding: 10px;
		min-height:300px;
	}
	* {
		font-size: 20px;
	}
</style>
<p>Appropriation for  ………………………………… Expenditure including this bill …………………………… </p><br>
<p>Passed for Rs. ………………………………………………… Balance ………………………………………… </p>
<br><br>
<p>Station: Bangalore</p>
<br>
<p>Date: <span style="text-decoration: underline;"><?php echo date('d-m-Y', strtotime($model->CREATION_DATE))?></span></p>
<p style="text-align: right;">Signature of Controlling Officer</p><br>
<p style="text-align: right;">Designation <span style="width: 100px;display: inline-block;"></span></p><br><br><br>

<p>Passed for Payment of Rs. ………………………………… (Rupees ……………………………………………………………<br><br>………………………………………………………………………………………………………………………………………………………………………………………………………………………<br><br> )
…………………………………………………………………………… by Cheque/Demand Draft No …………………………. </p><br><br><br><br>

<p style="text-align: right;">Pay and Accounts Officer/Cheque Drawing DDO</p><br><br><br>
<hr><br>
<p style="font-weight: bold;text-align: center;font-size: 20px;">For use in Pay and Accounts Office</p>
<p style="text-align: center;font-size: 15px;">(Post Check)</p><br><br><br>
<p style="text-align: left;">Admitted for Rs..............................................................................Objected to Rs........................................</p><br>
<p style="text-align: left;">Reasons for objection...............................................................................................................................</p><br>
<p style="text-align: left;">....................................................................................................................................................</p><br>
<br><br><br>
<p style="text-align: left;"><span style="font-weight: bold">Jr/Sr. Accountant</span><span style="font-weight: bold;margin-left: 150px;">J.A.O./A.A.O.</span><span style="font-weight: bold;margin-left: 150px;">Pay and Account Officer</span></p><br>












<script type="text/javascript">window.onload = function() { window.print(); }</script><style>
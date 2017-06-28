<?php

class ExpenditureController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/contentLayout', $amountInWords, $amountLessthanInWords ,$showActions = false, $Month, $Year, $QuarterStart, $QuarterEnd;

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('Monthly', 'Quarterly', 'Monthly_ANNEXURE_I'),
				'users'=>array('*'),
			),
		);
	}
	
	public function actionMonthly()
	{
		$this->render('Monthly');
	}
	
	public function actionReconciliation()
	{
		$this->render('Reconciliation');
	}
	
	
	public function actionMonthly_Reconciliation($Month, $Year)
	{
		$this->layout='//layouts/column1';
		$this->Month = $Month;
		$this->Year = $Year;
		$this->render('Monthly/Monthly_Reconciliation');
	}
	
	
	
	public function actionMonthlyDisposition()
	{
		$this->layout='//layouts/contentLayout';
		$this->render('MonthlyDisposition');
	}
	public function actionMonthly_Disposition_Cover_letter($Month, $Year)
	{
		$this->layout='//layouts/column1';
		$this->Month = $Month;
		$this->Year = $Year;
		$this->render('Monthly/Monthly_Disposition_Cover_letter');
	}
	
	public function actionMonthly_COVER($Month, $Year)
	{
		$this->layout='//layouts/column1';
		$this->Month = $Month;
		$this->Year = $Year;
		$this->render('Monthly/Monthly_COVER');
	}
	
	public function actionMonthly_Disposition_Data($Month, $Year)
	{
		$this->layout='//layouts/column1';
		$this->Month = $Month;
		$this->Year = $Year;
		$this->render('Monthly/Monthly_Disposition_Data');
	}
	
	public function actionMonthly_ANNEXURE_I($Month, $Year)
	{
		$this->layout='//layouts/column1';
		$this->Month = $Month;
		$this->Year = $Year;
		$this->render('Monthly/Monthly_ANNEXURE_I');
	}
	
	
	public function actionBillStatus($Month, $Year)
	{
		$this->layout='//layouts/column1';
		$this->Month = $Month;
		$this->Year = $Year;
		$this->render('BillStatus');
	}
	
	
	public function actionMonthly_MEDICAL($Month, $Year)
	{
		$this->layout='//layouts/column1';
		$this->Month = $Month;
		$this->Year = $Year;
		$this->render('Monthly/Monthly_MEDICAL');
	}
	
	public function actionMonthly_ANNEXURE_II($Month, $Year)
	{
		$this->layout='//layouts/column1';
		$this->Month = $Month;
		$this->Year = $Year;
		$this->render('Monthly/Monthly_ANNEXURE_II');
	}
	public function actionMonthly_ANNEXURE_IIA($Month, $Year)
	{
		$this->layout='//layouts/column1';
		$this->Month = $Month;
		$this->Year = $Year;
		$this->render('Monthly/Monthly_ANNEXURE_IIA');
	}
	public function actionMonthly_ANNEXURE_III($Month, $Year)
	{
		$this->layout='//layouts/column1';
		$this->Month = $Month;
		$this->Year = $Year;
		$this->render('Monthly/Monthly_ANNEXURE_III');
	}
	
	
	public function actionQuarterly()
	{
		$this->render('Quarterly');
	}
	
	public function actionQuarterly_ANNEXURE_I($Quarter, $Year)
	{
		$this->layout='//layouts/column1';
		$Quarters = explode("-", $Quarter);
		$this->QuarterStart = $Quarters[0];
		$this->QuarterEnd = $Quarters[1];
		$this->Year = $Year;
		$this->render('Quarterly/Quarterly_ANNEXURE_I');
	}
	public function actionQuarterly_ANNEXURE_II($Quarter, $Year)
	{
		$this->layout='//layouts/column1';
		$Quarters = explode("-", $Quarter);
		$this->QuarterStart = $Quarters[0];
		$this->QuarterEnd = $Quarters[1];
		$this->Year = $Year;
		$this->render('Quarterly/Quarterly_ANNEXURE_II');
	}
	public function actionQuarterly_ANNEXURE_III($Quarter, $Year)
	{
		$this->layout='//layouts/column1';
		$Quarters = explode("-", $Quarter);
		$this->QuarterStart = $Quarters[0];
		$this->QuarterEnd = $Quarters[1];
		$this->Year = $Year;
		$this->render('Quarterly/Quarterly_ANNEXURE_III');
	}
	
	public function amountToWord($number){
		$no = round($number);
		$point = round($number - $no, 2) * 100;
		$hundred = null;
		$digits_1 = strlen($no);
		$i = 0;
		$str = array();
		$words = array('0' => '', '1' => 'One', '2' => 'Two',
		'3' => 'Three', '4' => 'Four', '5' => 'Five', '6' => 'Six',
		'7' => 'Seven', '8' => 'Eight', '9' => 'Nine',
		'10' => 'Ten', '11' => 'Eleven', '12' => 'Twelve',
		'13' => 'Thirteen', '14' => 'Fourteen',
		'15' => 'Fifteen', '16' => 'Sixteen', '17' => 'Seventeen',
		'18' => 'Eighteen', '19' =>'Nineteen', '20' => 'Twenty',
		'30' => 'Thirty', '40' => 'Forty', '50' => 'Fifty',
		'60' => 'Sixty', '70' => 'Seventy',
		'80' => 'Eighty', '90' => 'Ninety');
		$digits = array('', 'hundred', 'thousand', 'lakh', 'crore');
		while ($i < $digits_1) {
		 $divider = ($i == 2) ? 10 : 100;
		 $number = floor($no % $divider);
		 $no = floor($no / $divider);
		 $i += ($divider == 10) ? 1 : 2;
		 if ($number) {
			$plural = (($counter = count($str)) && $number > 9) ? 's' : null;
			$hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
			$str [] = ($number < 21) ? $words[$number] .
				" " . $digits[$counter] . $plural . " " . $hundred
				:
				$words[floor($number / 10) * 10]
				. " " . $words[$number % 10] . " "
				. $digits[$counter] . $plural . " " . $hundred;
		 } else $str[] = null;
		}
		$str = array_reverse($str);
		$result = implode('', $str);
		if($number == 0)
			$result	= "Zero";
		
		$points = ($point) ?
		"." . $words[$point / 10] . " " . 
			  $words[$point = $point % 10] : '';
		return  "(Rupees ".$result . " Only)";
	}
	
	
	
}

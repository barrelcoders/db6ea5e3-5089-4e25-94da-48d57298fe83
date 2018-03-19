<?php

class IncomeTaxController extends Controller
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
	
	public function actionSelectEmployeesForForm16($id=0)
	{
		$this->layout = '//layouts/contentLayout';
		$list = array();
		
		if($id > 0){
			$list = array($id);
			$this->layout='//layouts/column1';
			
			$this->render('Form16',array(
				'list'=>$list,
				'type'=>'Screen'
			));
			exit;
		}
		
		if(isset($_POST['Form16']['submit'])){
			$list = $_POST['Form16']['Employee'];
			$this->layout='//layouts/column1';
			
			$this->render('Form16',array(
				'list'=>$list,
				'type'=>'Screen'
			));
			exit;
		}
		
		$this->render('SelectEmployeesForForm16');	
	}
	
	public function actionForm16($type=null, $id=null, $pension=null)
	{
		$this->layout = '';
		$list = array();
		
		if($type == "Dialog"){
			$list = array();
			array_push($list, $id);
			$this->render('Form16',array(
				'list'=>$list,
				'type'=>$type
			));
		}
		
		if($type == "Screen"){
			if($pension == "NPS"){
				$employees = Employee::model()->findAll(array('condition'=>'PENSION_TYPE="NPS" AND IS_RETIRED = 0', 'order'=>'DESIGNATION_ID_FK DESC'));
				foreach($employees as $employee){
					array_push($list, $employee->ID);
				}
				$this->render('Form16',array(
					'list'=>$list,
					'type'=>$type
				));
			}
			else if($pension == "OPS"){
				$employees = Employee::model()->findAll(array('condition'=>'PENSION_TYPE="OPS" AND IS_RETIRED = 0', 'order'=>'DESIGNATION_ID_FK DESC'));
				foreach($employees as $employee){
					array_push($list, $employee->ID);
				}
				$this->render('Form16',array(
					'list'=>$list,
					'type'=>$type
				));
			}
			else{
				$employees = Employee::model()->findAll(array('order'=>'DESIGNATION_ID_FK DESC'));
				foreach($employees as $employee){
					array_push($list, $employee->ID);
				}
				$this->render('Form16',array(
					'list'=>$list,
					'type'=>$type
				));
			}
		}
	}
	
	public function actionScreenForm16($type=null)
	{
		$this->layout = '';
		$list = array();
		array_push($list, $id);
		$this->render('ScreenForm16',array(
			'list'=>$list
		));
	}
	
	public function actionQuarterly()
	{
		$this->layout = '//layouts/contentLayout';
		
		$this->render('Quarterly');
	}
	
	public function actionQuarterlyIT($startMonth, $endMonth, $Year)
	{
		$this->layout = '';
		
		$this->render('Quarterly_IT',array(
			'startMonth'=>$startMonth,
			'endMonth'=>$endMonth,
			'Year'=>$Year,
		));
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

<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/oneadmin.css" rel="stylesheet">
<script type="text/javascript" src="js/salary-details.js"></script>
<div class="container-fluid">
	<div id="form-16-panel" style="display:none;">
		<section class="box-typical box-typical-padding">
			<header class="box-typical-header panel-heading">
				<h3 class="panel-title">Form-16 (<?php echo FinancialYears::model()->find('STATUS=1')->NAME;?>)</h3>
				<a href="javascript: void(0);" id="form-16-panel-close"><i class="fa fa-close"></i></a>
				<div class="dropdown">
					<ul class="dropdown-menu dropdown-menu-right">
						<li>
							<a data-func="editTitle" data-tooltip="Edit title" data-toggle="tooltip" data-title="Edit title" data-placement="bottom" data-original-title="" title="">
								<i class="panel-control-icon glyphicon glyphicon-pencil"></i>
								<span class="control-title">Edit title</span>
							</a>
						</li>
					</ul>
				</div>
			</header>
			<div class="box-typical-body panel-body">
				<input type="hidden" id="HDFORM16URL"/>
				<iframe style="width:100%;height:100%;"></iframe>
			</div><!--.box-typical-body-->
		</section>
	</div>
	<style>#form-16-panel{position: fixed;z-index: 9999;right: 0;top: 0;bottom: 0;width: 700px;}#form-16-panel section{height: 100%}
	#form-16-panel div{height: 95%}
	#it-icon{position: absolute;right: 6px;top: 13px;font-size: 25px;color: #000;text-decoration: none;}
	#form-16-panel-close{color: #000;position: absolute;right: 25px;top: 10px;padding: 10px;font-size: 25px;}</style>
	<div class="box-typical box-typical-padding" style="min-height:800px;">
	<?php
	$master = Master::model()->findByPK(1);
	
	if(isset($_REQUEST['id'])){
		$bill = Bill::model()->findByPK($_REQUEST['id']);
		?>
			<table class="table table-bordered table-hover" style="margin-bottom: 10px;">
				<tr>
					<td colspan="5">
						<a href="<?php echo Yii::app()->createUrl('bill/update', array('id'=>$bill->ID))?>"><?php echo $bill->BILL_TITLE; ?></a>
					</td>
					<td colspan="2">
						<span style="float: right;"><?php echo $bill->BILL_NO; ?></span>
					</td>
					<td colspan="1">
						<?php  if($bill->IS_SALARY_HEAD_PAY_BILL || $bill->IS_WAGES_HEAD_PAY_BILL) { ?>	
						<form id="bill-form" action="<?php echo Yii::app()->createUrl('Bill/AllITToBeZero', array('id'=>$bill->ID))?>" method="post">
							<input class="btn btn-inline" type="submit" value="IT = 0" onclick="return confirm('Are you sure for changing IT of all employees to be 0 ?');">
						</form>
						<?php } ?>
					</td>
				</tr>
				<?php if($bill->IS_SALARY_HEAD_OTHER_BILL || $bill->IS_WAGES_HEAD_OTHER_BILL){ ?>
				<form id="bill-form" action="<?php echo Yii::app()->createUrl('Bill/update', array('id'=>$bill->ID, 'isSalaryHead'=>1))?>" method="post">
					<tr>
						<td colspan="5"><b class="one-label">PFMS BILL NO: </b> <input size="100" maxlength="100" name="Bill[PFMS_BILL_NO]" id="Bill_PFMS_BILL_NO"  value="<?php echo Bill::model()->findByPK($bill->ID)->PFMS_BILL_NO;?>" type="text" style="line-height:30px;font-size: 20px;width: 80%;" ></td>
						<td colspan="3"><input class="btn btn-success" type="submit" name="yt0" value="SAVE PFMS BILL NO" 
						onclick="if(unsaved){unsaved = false;}"></td>
					</tr>
				</form>
				<?php } ?>
			</table>
			<form name="SalaryDetails" action="<?php echo Yii::app()->createUrl('Bill/SalaryDetails', array('id'=>$bill->ID))?>" method="post">
			<div class="row">
				<div class="col-sm-2">
					<p class="form-control-static">
						<?php if($model->IS_GENERATED){?>
						<input type="submit" name="SalaryDetails[save]" class="btn btn-inline" value="Save" style="float:left;" 
						onclick="if(unsaved){unsaved = false;}">
						<?php } ?>
					</p>
				</div>
				<div class="col-sm-8">
					<p class="form-control-static">
						<input type="text" id="textSearch"  style="line-height:30px;font-size: 20px;width: 80%;" onkeyup="search();">
					</p>
				</div>
				<div class="col-sm-2">
					<p class="form-control-static">
						<?php if($model->IS_GENERATED){?>
						<input type="submit" name="SalaryDetails[submit]" class="btn btn-inline" style="float: right;" value="Submit" onsubmit="return confirm('Are you sure wants to submit the bill, This will change the Appropiation Register');"
						onclick="submitSalaryDetails();">
						<?php } ?>
					</p>
				</div>
			</div>
			<p style="text-align: center;font-weight bold;font-size:11px;margin-bottom: 10px;">2. For navigation among employees use arrow (<mark class="unicode" data-char-info="" style="color: black;">←</mark>&nbsp;&nbsp;<mark class="unicode" data-char-info="U+2192: RIGHTWARDS ARROW" style="color: black;">→</mark>) keys</p>
			<?php
			$employees = array();
			if($bill->IS_SALARY_HEAD_PAY_BILL){ 
			?>
				<p style="text-align: center;font-weight bold;font-size:11px;margin-bottom: 10px;">1. For IT Provisional <?php echo FinancialYears::model()->find('STATUS=1')->NAME?> Toggle, click Employee Name & Press ( q )</p>
				<input type="hidden" name="SalaryDetails[IS_SALARY_BILL]" value="1"/>
				<?php
				if($bill->IS_OPS_PAY_BILL){
					/*if(SalaryDetails::model()->exists('BILL_ID_FK='.$model->ID)){
						$salaries = SalaryDetails::model()->findAllByAttributes(array('BILL_ID_FK'=>$model->ID));
						$salaryBillEmployees = array();foreach($salaries as $salary){array_push($salaryBillEmployees, $salary->EMPLOYEE_ID_FK);}
						$criteria=new CDbCriteria;
						$criteria->compare("PENSION_TYPE",'OPS');
						$criteria->addInCondition('ID', $salaryBillEmployees);
						$employees = Employee::model()->ByDesignation()->findAll($criteria);
					}
					else{
						$employees = Employee::model()->ByDesignation()->findAllByAttributes(array('PENSION_TYPE'=>'OPS', 'IS_TRANSFERRED'=>0, 'IS_RETIRED'=>0, 'IS_PERMANENT'=>1, 'IS_SUSPENDED'=>0));
					}*/
					
					$BillEmployees = explode(",", BillEmployees::model()->findByAttributes(array('BILL_ID'=>$model->ID))->EMPLOYEE_ID);
					$employees = Employee::model()->ByDesignation()->findAllByAttributes(array('ID'=>$BillEmployees));
					$DATA_URL = Yii::app()->createUrl('Employee/OPSSalaryBillEmployees');
				}
				if($bill->IS_NPS_PAY_BILL){
					/*if(SalaryDetails::model()->exists('BILL_ID_FK='.$model->ID)){
						$salaries = SalaryDetails::model()->findAllByAttributes(array('BILL_ID_FK'=>$model->ID));
						$salaryBillEmployees = array();foreach($salaries as $salary){array_push($salaryBillEmployees, $salary->EMPLOYEE_ID_FK);}
						$criteria=new CDbCriteria;
						$criteria->compare("PENSION_TYPE",'NPS');
						$criteria->addInCondition('ID', $salaryBillEmployees);
						$employees = Employee::model()->ByDesignation()->findAll($criteria);
					}
					else{
						$employees = Employee::model()->ByDesignation()->findAllByAttributes(array('PENSION_TYPE'=>'NPS', 'IS_TRANSFERRED'=>0, 'IS_RETIRED'=>0, 'IS_PERMANENT'=>1, 'IS_SUSPENDED'=>0));
					}*/
					$BillEmployees = explode(",", BillEmployees::model()->findByAttributes(array('BILL_ID'=>$model->ID))->EMPLOYEE_ID);
					$employees = Employee::model()->ByDesignation()->findAllByAttributes(array('ID'=>$BillEmployees));
					$DATA_URL = Yii::app()->createUrl('Employee/NPSSalaryBillEmployees');
				}
			}
			if($bill->IS_WAGES_HEAD_PAY_BILL){
				$BillEmployees = explode(",", BillEmployees::model()->findByAttributes(array('BILL_ID'=>$model->ID))->EMPLOYEE_ID);
				$employees = Employee::model()->ByDesignation()->findAllByAttributes(array('ID'=>$BillEmployees));
				$DATA_URL = Yii::app()->createUrl('Employee/WagesBillEmployees', array('BILL_ID'=>$model->ID));
				?>
				<p style="text-align: center;font-weight bold;font-size:11px;margin-bottom: 10px;">1. For IT Provisional <?php echo FinancialYears::model()->find('STATUS=1')->NAME?> Toggle, click Employee Name & Press ( q )</p>
				<input type="hidden" name="SalaryDetails[IS_SALARY_BILL]" value="1"/>
				<?php
			}
			if($bill->IS_SALARY_HEAD_OTHER_BILL || $bill->IS_WAGES_HEAD_OTHER_BILL){ 
				$BillEmployees = explode(",", BillEmployees::model()->findByAttributes(array('BILL_ID'=>$model->ID))->EMPLOYEE_ID);
				$employees = Employee::model()->ByDesignation()->findAllByAttributes(array('ID'=>$BillEmployees));
				$DATA_URL = Yii::app()->createUrl('Employee/BillEmployees', array('BILL_ID'=>$model->ID));
				?>
				<input type="hidden" name="SalaryDetails[IS_SALARY_BILL]" value="0"/>
				<?php
			}?>
			<input type="hidden" value="<?php echo $bill->ID?>" name="SalaryInfo[BILL_ID]">
			<div id="employee-container" style="position:relative;border: 1px solid #ccc;background-color: #f1f1f1;height: 50px;">
			<a href="javascript:void(0);" style="position: absolute;left: 0;width: 50px;height: 49px;background: #ccc;font-size: 30px;padding: 7px 10px;border: 1px solid #999;text-align: center;font-weight: bold;color: #000;" id="btn-prev"><i class="fa fa-angle-left"></i></a>
			<div style="position: absolute;right: 50px;left:50px;overflow:hidden;">
				<ul class="tab" id="tab" style="width:<?php echo count($employees)*400;?>px; min-width:400px;">    
				<?php 
					$i=0;
					foreach($employees as $employee){ 
						if($i == 0){
							?>
								<li id="tablink-<?php echo $employee->ID?>" onclick="openEmployeeSalaryDetails(<?php echo $employee->ID?>)" ><a href="javascript:void(0)" class="tablinks" style="border-left: 1px solid #999;border-right: 1px solid #999;"><?php echo $employee->NAME.", ".Designations::model()->findByPK($employee->DESIGNATION_ID_FK)->ABBREVIATIONS;?></a></li>
							<?php
						} else {
							?>
								<li id="tablink-<?php echo $employee->ID?>" onclick="openEmployeeSalaryDetails(<?php echo $employee->ID?>)" ><a href="javascript:void(0)" class="tablinks"style="border-right: 1px solid #999;"><?php echo $employee->NAME.", ".Designations::model()->findByPK($employee->DESIGNATION_ID_FK)->ABBREVIATIONS;?></a></li>
							<?php
						}
						$i++;
					} ?>
				</ul>
			</div>
			<a href="javascript:void(0);" style="position: absolute;right: 0;width: 50px;height: 49px;background: #ccc;font-size: 30px;padding: 7px 10px;border: 1px solid #999;text-align: center;font-weight: bold;color: #000;"  id="btn-next"><i class="fa  fa-angle-right"></i></a>
			</div>
			<?php
				$periods = array();
				$js_periods = array();
				if($bill->IS_MULTIPLE_MONTH){
					$start    = (new DateTime($bill->YEAR.'-'.$bill->MONTH.'-01'))->modify('first day of this month');
					$end      = (new DateTime($bill->YEAR_END.'-'.$bill->MONTH_END.'-01'))->modify('last day of this month');
					$interval = DateInterval::createFromDateString('1 month');
					$intervals   = new DatePeriod($start, $interval, $end);

					foreach ($intervals as $int) {
						array_push($periods, array('FORMAT'=> $int->format("M-Y"), 'MONTH'=>$int->format("n"), 'YEAR'=>$int->format("Y")));
						array_push($js_periods, $int->format("n").'-'.$int->format("Y"));
					}
				}
				else{
					$int    = (new DateTime($bill->YEAR.'-'.$bill->MONTH.'-01'))->modify('first day of this month');
					array_push($periods, array('FORMAT'=> $int->format("M-Y"), 'MONTH'=>$int->format("n"), 'YEAR'=>$int->format("Y")));
					array_push($js_periods, $int->format("n").'-'.$int->format("Y"));
				}
				
				$js_array = json_encode($js_periods);
				
			?>
			<?php
			foreach($employees as $employee){ ?>
				<div id="<?php echo $employee->ID?>" class="tabcontent" >
				  <table class="table table-bordered table-hover" style="margin-bottom: 10px;">
					<tr>
						<td><b class="one-label">Group: </b><span style="float: right;"><?php echo Groups::model()->findByPK($employee->GROUP_ID_FK)->GROUP_NAME; ?></span></td>
						<td><b class="one-label">Pay Matrix: </b><span style="float: right;">
							<?php 
							$matrix = "";
							if($employee->PAY_MATRIX_ID_FK != 0){
								$matrix = PayMatrix::model()->findByPK($employee->PAY_MATRIX_ID_FK);
								$matrix = $matrix->BASIC."(Level: ".$matrix->LEVEL." Index: ".$matrix->INDEX.")";
							}
							echo $matrix; ?> W.E.F. 
							<?php 
								if (date('M', strtotime($employee->PAY_WEF_DATE)) == date('M') && date('Y', strtotime($employee->PAY_WEF_DATE)) == date('Y')){
									?>
										<span style='color: #F00;'><?php echo date('d M,Y', strtotime($employee->PAY_WEF_DATE));?></span>
									<?php
								}
								else{
									echo date('d M,Y', strtotime($employee->PAY_WEF_DATE));
								}
							?></span>
						</td>
						<td><b class="one-label">HRA SLAB: </b><span style="float: right;"><?php echo HRASlabs::model()->findByPK($employee->HRA_SLAB_ID_FK)->DESCRIPTION; ?></span></td>
						<td><b class="one-label">Quarter Alloc.: </b><span style="float: right;"><?php echo ($employee->IS_QUARTER_ALLOCATED == 1) ? "YES" : "NO"; ?></span></td>
					</tr>
					<tr>
						<td><b class="one-label">Next Increment Date: </b><span style="float: right;"><?php echo date('d M, Y',strtotime($employee->NEXT_INCREMENT_DATE))?></span></td>
						<td><b class="one-label">MICR: </b><span style="float: right;"><?php echo $employee->MICR?></span></td>
						<td><b class="one-label">Account No: </b><span style="float: right;"><?php echo $employee->ACCOUNT_NO?></span></td>
						<td><b class="one-label">IFSC: </b><span style="float: right;"><?php echo $employee->IFSC?></span></td>
					</tr>
				  </table>
				  <input type="hidden" value="<?php echo $employee->ID?>" name="SalaryDetails[<?php echo $employee->ID?>][EMP_ID]">
				  <input type="hidden" value="<?php echo Employee::model()->findByPK($employee->ID)->PENSION_TYPE?>" id="PENSION_TYPE" name="SalaryDetails[<?php echo $employee->ID?>][PENSION_TYPE]">
				  						
				  <?php
					foreach($periods as $period){
						$month = $period['MONTH'];
						$year = $period['YEAR'];
						if($bill->IS_SALARY_HEAD_PAY_BILL || $bill->IS_WAGES_HEAD_PAY_BILL){
							if(SalaryDetails::model()->exists('EMPLOYEE_ID_FK='.$employee->ID.' AND BILL_ID_FK='.$bill->ID.' AND IS_SALARY_BILL = 1')){
								$salary = SalaryDetails::model()->find('EMPLOYEE_ID_FK='.$employee->ID.' AND BILL_ID_FK='.$bill->ID.' AND IS_SALARY_BILL = 1');
							}
							else if(SalaryDetails::model()->exists('IS_SALARY_BILL = 1 AND EMPLOYEE_ID_FK='.$employee->ID.' AND YEAR='.(($period['MONTH'] ==1) ? ($period['YEAR'] - 1 ) : $period['YEAR']).' AND MONTH='.(($period['MONTH'] ==1) ? 12 : ($period['MONTH'] - 1)))){
								$salary = SalaryDetails::model()->find('IS_SALARY_BILL = 1 AND EMPLOYEE_ID_FK='.$employee->ID.' AND YEAR='.(($period['MONTH'] ==1) ? ($period['YEAR'] - 1 ) : $period['YEAR']).' AND MONTH='.(($period['MONTH'] ==1) ? 12 : ($period['MONTH'] - 1)));
							}
							else{
								$salary = SalaryDetails::model();
							}
						}
						else if($bill->IS_SALARY_HEAD_OTHER_BILL || $bill->IS_WAGES_HEAD_OTHER_BILL){
							if($bill->IS_SALARY_HEAD_PAY_ARREAR_BILL){
								if(SalaryDetails::model()->exists('EMPLOYEE_ID_FK='.$employee->ID.' AND BILL_ID_FK='.$bill->ID.' AND MONTH='.$month.' AND YEAR='.$year)){
									$salary = SalaryDetails::model()->find('EMPLOYEE_ID_FK='.$employee->ID.' AND BILL_ID_FK='.$bill->ID.' AND MONTH='.$month.' AND YEAR='.$year);
								}
								else if(SalaryDetails::model()->exists('EMPLOYEE_ID_FK='.$employee->ID.' AND MONTH='.$month.' AND YEAR='.$year.' AND IS_SALARY_BILL = 1')){
									$salary = SalaryDetails::model()->find('EMPLOYEE_ID_FK='.$employee->ID.' AND MONTH='.$month.' AND YEAR='.$year.' AND IS_SALARY_BILL = 1');
								}
								else{
									$salary = SalaryDetails::model();
								}
							}
							else if($bill->IS_SALARY_HEAD_DA_ARREAR_BILL){
								if(SalaryDetails::model()->exists('EMPLOYEE_ID_FK='.$employee->ID.' AND BILL_ID_FK='.$bill->ID)){
									$salary = SalaryDetails::model()->find('EMPLOYEE_ID_FK='.$employee->ID.' AND BILL_ID_FK='.$bill->ID);
								}
								else{
									$salary = SalaryDetails::model();
								}
							}
							else{
								if(SalaryDetails::model()->exists('EMPLOYEE_ID_FK='.$employee->ID.' AND BILL_ID_FK='.$bill->ID)){
									$salary = SalaryDetails::model()->findByAttributes(array('EMPLOYEE_ID_FK'=>$employee->ID, 'BILL_ID_FK'=>$bill->ID));
								}
								else{
									$salary = SalaryDetails::model();
								}
							}
						}				
						else{
							$salary = SalaryDetails::model();
						}
						?>
						<table class="table table-bordered table-hover" style="margin-bottom: 10px;">
							<tr>
								<td colspan="1">
									<b><?php echo $period['FORMAT']?></b>
								</td>
							<?php  if($bill->IS_SALARY_HEAD_PAY_BILL || $bill->IS_WAGES_HEAD_PAY_BILL) { ?>	
								<td colspan="2">
									<?php
										$task = PayBillTasks::model()->find('EMPLOYEE_ID_FK='.$employee->ID.' AND MONTH='.$period['MONTH'].' AND YEAR = '.$period['YEAR']);
										?>
											<div class="alert alert-info alert-avatar alert-no-border alert-close alert-dismissible fade in" role="alert">
												<div class="avatar-preview avatar-preview-32">
													<img src="img/avatar-2-64.png" alt="">
												</div>
												<strong>PAY BILL task for <?php echo $employee->NAME;?> for <?php echo $period['FORMAT'];?></strong><br>
												<p><?php echo (count($task) > 0) ? $task->TASK : "<span style='color: #f00'> Not Available </span>"; ?></p>
											</div>
										<?php
									?>
								</td>
								<td colspan="2">
									<?php 
										$URL = 'http://'.$_SERVER['SERVER_NAME'].Yii::app()->createUrl('IncomeTax/SelectEmployeesForForm16', array('id'=>$employee->ID, 'ajax'=>true));
									?>
									<script>
										$.get('<?php echo $URL;?>', function( data ) {
											var period_month = '<?php echo $period['MONTH'];?>',
												period_year = <?php echo $period['YEAR'];?>,
												emp_id = <?php echo $employee->ID;?>,
												it_value = 0;
											
											setTimeout(function(){
												$('#it-div-'+emp_id).html(it_value);
												data = JSON.parse(data.substring(data.lastIndexOf("[JSON]")+6,data.lastIndexOf("[/JSON]")));
												for(var i=0; i<data.length; i++){
													if(data[i]['MONTH'] == period_month && data[i]['YEAR'] == period_year){
														it_value = data[i]['IT'];
													}
												}
												$('#it-div-'+emp_id).html(it_value);
												
											}(data, period_month, period_year, emp_id, it_value), 2000)
										});
									</script>
									<div class="alert alert-info alert-avatar alert-no-border alert-close alert-dismissible fade in" role="alert">
										<div class="avatar-preview avatar-preview-32">
											<img src="img/avatar-2-64.png" alt="">
										</div>
										<strong>Income Tax for <?php echo $employee->NAME;?> for <?php echo $period['FORMAT'];?></strong><br>
										<p><a href="javascript:void(0);" onclick="copyIncomeTaxValue(<?php echo $employee->ID;?>);">Rs. <span id='it-div-<?php echo $employee->ID;?>'></span>/- </a>&nbsp;&nbsp;(Click to Copy)</p>
									</div>
								</td>
								<td colspan="2">
									<b><a href="javascript:void(0);" class="btn btn-inline" style="float: right;" onclick="saveSalaryAjax(<?php echo $employee->ID;?>, <?php echo $period['MONTH'];?>, <?php echo $period['YEAR'];?>, <?php echo $bill->ID;?>, '<?php echo $employee->NAME;?>', '<?php echo $period['FORMAT'];?>', '<?php echo $employee->ID?>');"><i class='fa fa-save'></i> SAVE</a></b>
								</td>
								<?php } ?>
								<td>
									<button class="btn btn-primary swal-btn-input">IT Calculator</button>
								</td>
							</tr>
						</table>
						<?php  if($bill->IS_SALARY_HEAD_PAY_BILL || $bill->IS_WAGES_HEAD_PAY_BILL || $bill->IS_ARREAR_BILL) { ?>
							<input type="hidden" name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][MONTH]" id="SAL-MONTH" value="<?php echo $month?>"/>
							<input type="hidden" name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][YEAR]"  id="SAL-YEAR" value="<?php echo $year?>"/>
							<table class="table table-bordered table-hover" style="margin-bottom: 10px;" id="<?php echo $month."-".$year;?>">
								<tr>
									<input type="hidden" value="<?php echo HRASlabs::model()->findByPK($employee->HRA_SLAB_ID_FK)->RATE;?>" id="HRA_RATE">
									<input type="hidden" value="<?php echo $employee->IS_QUARTER_ALLOCATED?>" id="QURTER_ALLOCATED">
									<input type="hidden" id="PENSION_TYPE" value="<?php echo $employee->PENSION_TYPE;?>"/>
									<td>BASIC: <input type="number" size="10" name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][BASIC]" data-type="BASIC" class="gross-inc-amount basic-amount" value="<?php echo $salary->BASIC ? $salary->BASIC : 0;?>" placeholder="BASIC" id="SAL-BASIC" /></td>
									<td>SP: <input type="number" size="10" name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][SP]" data-type="SP" class="gross-inc-amount" value="<?php echo $salary->SP ? $salary->SP : 0;?>" placeholder="SP" id="SAL-SP" /></td>
									<td>PP: <input type="number" size="10" name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][PP]" data-type="PP" class="gross-inc-amount" value="<?php echo $salary->PP ? $salary->PP : 0;?>" placeholder="PP" id="SAL-PP" /></td>
									<td>CCA: <input type="number" size="10" name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][CCA]" data-type="CCA" class="gross-inc-amount" value="<?php echo $salary->CCA ? $salary->CCA : 0;?>" placeholder="CCA" id="SAL-CCA" /></td>
									<td>HRA: <input type="number" size="10" name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][HRA]" data-type="HRA" class="gross-inc-amount hra-amount" value="<?php echo $salary->HRA ? $salary->HRA : 0;?>" placeholder="HRA" id="SAL-HRA" /></td>
									<td>DA: <input type="number" size="10" name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][DA]" data-type="DA" class="gross-inc-amount da-amount" value="<?php echo $salary->DA ? $salary->DA : 0;?>" placeholder="DA" id="SAL-DA" /></td>
									<td>TA: <input type="number" size="10" name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][TA]" data-type="TA" class="gross-inc-amount ta-amount" value="<?php echo $salary->TA ? $salary->TA : 0;?>" placeholder="TA" id="SAL-TA" /></td>
									<td>WA: <input type="number" size="10" name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][WA]" data-type="WA" class="gross-inc-amount" value="<?php echo $salary->WA ? $salary->WA : 0;?>" placeholder="WA" id="SAL-WA" /></td>
								</tr>
								<tr>
									<td>IT: <input type="number" size="10" name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][IT]" data-type="IT" class="ded-inc-amount" value="<?php echo $salary->IT ? $salary->IT : 0;?>" placeholder="IT" id="SAL-IT" /></td>
									<td>CGHS: <input type="number" size="10" name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][CGHS]" data-type="CGHS" class="ded-inc-amount" value="<?php echo $salary->CGHS ? $salary->CGHS : 0;?>" placeholder="CGHS" id="SAL-CGHS" /></td>
									<td>LF: <input type="number" size="10" name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][LF]" data-type="LF" class="licence-fee-amount ded-inc-amount" value="<?php echo $salary->LF ? $salary->LF : 0;?>" placeholder="LF" id="SAL-LF" /></td>
									<td>CGEGIS: <input type="number" size="10" name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][CGEGIS]" data-type="CGEGIS" class="ded-inc-amount" value="<?php echo $salary->CGEGIS ? $salary->CGEGIS : 0;?>" placeholder="CGEGIS" id="SAL-CGEGIS" /></td>
									<td><?php echo ( $employee->PENSION_TYPE == 'OPS' ) ? "GPFC" : "CPF TIER I"; ?>: <input type="number" size="10" name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][CPF_TIER_I]" data-type="CPF_TIER_I" class="ded-inc-amount  cpf-1-amount" value="<?php echo $salary->CPF_TIER_I ? $salary->CPF_TIER_I : 0;?>" placeholder="<?php echo ( $employee->PENSION_TYPE == 'OPS' ) ? "GPFC" : "CPF TIER I"; ?>" id="SAL-CPF_TIER_I" /></td>
									<td><?php echo ( $employee->PENSION_TYPE == 'OPS' ) ? "GPFR" : "CPF TIER II"; ?>: <input type="number" size="10" name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][CPF_TIER_II]" data-type="CPF_TIER_II" class="ded-inc-amount" value="<?php echo $salary->CPF_TIER_II ? $salary->CPF_TIER_II : 0;?>" placeholder="<?php echo ( $employee->PENSION_TYPE == 'OPS' ) ? "GPFR" : "CPF TIER II"; ?>" id="SAL-CPF_TIER_II" /></td>
									<td>MISC: <input type="number" size="10" name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][MISC]" data-type="MISC" class="ded-inc-amount" value="<?php echo $salary->MISC ? $salary->MISC : 0;?>" placeholder="MISC" id="SAL-MISC" /></td>
									<?php 
										$pli = 0;
										if($salary->BILL_ID_FK == $bill->ID){									
											$pli = $salary->PLI;
										}
										if($pli == 0){
											$data = EmployeePLIPolicies::model()->findBySql('SELECT SUM(AMOUNT) as AMOUNT FROM tbl_employee_pli_policies WHERE STATUS=1 AND EMPLOYEE_ID_FK='.$employee->ID, array());
											$pli  = intVal($data['AMOUNT']);
										}
									?>
									<td>PLI: <input type="text" size="10" name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][PLI]" data-type="PLI" class="ded-inc-amount" value="<?php echo $pli;?>" placeholder="PLI" id="SAL-PLI" /></td>
								</tr>
								<tr>
									<td>COURT: <input type="number" size="10" name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][COURT_ATTACHMENT]" data-type="COURT_ATTACHMENT" class="ded-inc-amount" value="<?php echo $salary->COURT_ATTACHMENT ? $salary->COURT_ATTACHMENT : 0;?>" placeholder="COURT ATTACHMENT" id="SAL-COURT_ATTACHMENT" /></td>
									<td>PT: <input type="number" size="10" name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][PT]" data-type="PT" class="pt-ded-inc-amount" value="<?php echo $salary->PT ? $salary->PT : 0;?>" placeholder="PT" id="SAL-PT" /></td>
									<td>CCS: <input type="number" size="10" name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][CCS]" data-type="CCS" class="other-ded-inc-amount" value="<?php echo $salary->CCS ? $salary->CCS : 0;?>" placeholder="CCS" id="SAL-CCS" /></td>
									<?php 
										$lic = 0;
										if($salary->BILL_ID_FK == $model->ID){
											$lic = $salary->LIC;
										} 
										if($lic == 0){
											$data = EmployeeLICPolicies::model()->findBySql('SELECT SUM(AMOUNT) as AMOUNT FROM tbl_employee_lic_policies WHERE STATUS=1 AND EMPLOYEE_ID_FK='.$employee->ID, array());
											$lic  = intVal($data['AMOUNT']);
										}
									?>
									<td>LIC: <input type="number" size="10" name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][LIC]" data-type="LIC" class="other-ded-inc-amount" value="<?php echo $lic;?>" placeholder="LIC" id="SAL-LIC" /></td>
									<td>ASSOSC SUB.: <input type="number" size="10" name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][ASSOSC_SUB]" data-type="ASSOSC_SUB" class="other-ded-inc-amount" value="<?php echo $salary->ASSOSC_SUB ? $salary->ASSOSC_SUB : 0;?>" placeholder="ASSOSC SUB" id="SAL-ASSOSC_SUB" /></td>
									<td>JAYAMAHAL: <input type="number" size="10" name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][MAINT_JAYAMAHAL]" data-type="MAINT_JAYAMAHAL" class="other-ded-inc-amount" value="<?php echo $salary->MAINT_JAYAMAHAL ? $salary->MAINT_JAYAMAHAL : 0;?>" placeholder="MAINT. JAYAMAHAL" id="SAL-MAINT_JAYAMAHAL" /></td>
									<td>MADIWALA: <input type="number" size="10" name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][MAINT_MADIWALA]" data-type="MAINT_MADIWALA" class="other-ded-inc-amount" value="<?php echo $salary->MAINT_MADIWALA ? $salary->MAINT_MADIWALA : 0;?>" placeholder="MAINT. MADIWALA" id="SAL-MAINT_MADIWALA" /></td>				
									<td></td>
								</tr>
								<tr>
									<td>HBA</td>
									<td>
										<select name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month?>][IS_HBA_RECOVERY]"  id="SAL-IS_HBA_RECOVERY" >
											<option value="0" <?php echo ($salary->IS_HBA_RECOVERY && ($salary->IS_HBA_RECOVERY == 0)) ? "selected" : "";?>>PRINCIPAL</option>
											<option value="1" <?php echo ($salary->IS_HBA_RECOVERY && ($salary->IS_HBA_RECOVERY == 1)) ? "selected" : "";?>>INTEREST</option>
										</select>
									</td>
									<td>TOTAL: <input type="number" size="10" name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][HBA_TOTAL]" data-type="HBA_TOTAL" value="<?php echo $salary->HBA_TOTAL ? $salary->HBA_TOTAL : 0;?>" placeholder="TOTAL" class="hba-total" id="SAL-HBA_TOTAL" /></td>
									<td>INSTALLMENT: <input type="number" size="10" name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][HBA_INST]" data-type="HBA_INST" value="<?php echo $salary->HBA_INST ? $salary->HBA_INST : 0;?>" placeholder="INSTALLMENT" class="increment-field hba-inst" id="SAL-HBA_INST" /></td>
									<td>EMI: <input type="number" size="10" name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][HBA_EMI]" data-type="HBA_EMI" class="ded-inc-amount hba-emi" value="<?php echo $salary->HBA_EMI ? $salary->HBA_EMI : 0;?>" placeholder="EMI" id="SAL-HBA_EMI" /></td>
									<td>BALANCE: <input type="number" size="10" name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][HBA_BAL]" data-type="HBA_BAL" value="<?php echo $salary->HBA_BAL ? $salary->HBA_BAL : 0;?>" placeholder="BALANCE" class="hba-bal non-populated-field" id="SAL-HBA_BAL" /></td>
									<td></td><td></td>
								</tr>
								<tr>
									<td>MCA</td>
									<td>
										<select name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month?>][IS_MCA_RECOVERY]"  id="SAL-IS_MCA_RECOVERY" >
											<option value="0" <?php echo ($salary->IS_MCA_RECOVERY == 0) ? "selected" : "";?>>PRINCIPAL</option>
											<option value="1" <?php echo ($salary->IS_MCA_RECOVERY == 1) ? "selected" : "";?>>INTEREST</option>
										</select>
									</td>
									<td>TOTAL: <input type="number" size="10" name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][MCA_TOTAL]" data-type="MCA_TOTAL" value="<?php echo $salary->MCA_TOTAL ? $salary->MCA_TOTAL : 0;?>" placeholder="TOTAL" class="mca-total" id="SAL-MCA_TOTAL" /></td>
									<td>INSTALLMENT: <input type="number" size="10" name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][MCA_INST]" data-type="MCA_INST" value="<?php echo $salary->MCA_INST ? $salary->MCA_INST : 0;?>" placeholder="INSTALLMENT" class="increment-field mca-inst" id="SAL-MCA_INST" /></td>
									<td>EMI: <input type="number" size="10" name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][MCA_EMI]" data-type="MCA_EMI" class="ded-inc-amount mca-emi" value="<?php echo $salary->MCA_EMI ? $salary->MCA_EMI : 0;?>" placeholder="EMI" id="SAL-MCA_EMI" /></td>
									<td>BALANCE: <input type="number" size="10" name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][MCA_BAL]" data-type="MCA_BAL" value="<?php echo $salary->MCA_BAL ? $salary->MCA_BAL : 0;?>" placeholder="BALANCE" class="mca-bal non-populated-field" id="SAL-MCA_BAL" /></td>
									<td></td><td></td>
								</tr>
								<tr>
									<td>COMPUTER</td>
									<td>
										<select name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month?>][IS_COMP_RECOVERY]" id="SAL-IS_COMP_RECOVERY" >
											<option value="0" <?php echo ($salary->IS_COMP_RECOVERY == 0) ? "selected" : "";?>>PRINCIPAL</option>
											<option value="1" <?php echo ($salary->IS_COMP_RECOVERY == 1) ? "selected" : "";?>>INTEREST</option>
										</select>
									</td>
									<td>TOTAL: <input type="number" size="10" name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][COMP_TOTAL]" data-type="COMP_TOTAL" value="<?php echo $salary->COMP_TOTAL ? $salary->COMP_TOTAL : 0;?>" placeholder="TOTAL" class="comp-total" id="SAL-COMP_TOTAL" /></td>
									<td>INSTALLMENT: <input type="number" size="10" name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][COMP_INST]" data-type="COMP_INST" value="<?php echo $salary->COMP_INST ? $salary->COMP_INST : 0;?>" placeholder="INSTALLMENT" class="increment-field comp-inst" id="SAL-COMP_INST" /></td>
									<td>EMI: <input type="number" size="10" name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][COMP_EMI]" data-type="COMP_EMI" class="ded-inc-amount comp-emi" value="<?php echo $salary->COMP_EMI ? $salary->COMP_EMI : 0;?>" placeholder="EMI" id="SAL-COMP_EMI" /></td>
									<td>BALANCE: <input type="number" size="10" name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][COMP_BAL]" data-type="COMP_BAL" value="<?php echo $salary->COMP_BAL ? $salary->COMP_BAL : 0;?>" placeholder="BALANCE" class="comp-bal non-populated-field" id="SAL-COMP_BAL" /></td>
									<td></td><td></td>
								</tr>
								<tr>
									<td>GROSS: <input type="number" size="10" id='gross-components' name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][GROSS]" value="<?php echo $salary->GROSS ? $salary->GROSS : 0;?>" placeholder="GROSS" /></td>
									<td>DED: <input type="number" size="10" id='ded-components' name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][DED]" value="<?php echo $salary->DED ? $salary->DED : 0;?>" placeholder="DED" /></td>
									<td>NET: <input type="number" size="10" id='net-components' name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][NET]" value="<?php echo $salary->NET ? $salary->NET : 0;?>" placeholder="NET" /></td>
									<td>OTHER DED: <input type="number" size="10" id='other-ded-components' name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][OTHER_DED]" value="<?php echo $salary->OTHER_DED ? $salary->OTHER_DED : 0;?>" placeholder="OTHER DED"/></td>
									<td>AMT. BANK: <input type="number" size="10" id='credit-component' name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][AMOUNT_BANK]" value="<?php echo $salary->AMOUNT_BANK ? $salary->AMOUNT_BANK : 0;?>" placeholder="AMOUNT BANK" /></td>
									<td></td><td></td><td></td>
								</tr>
								<tr>
									<td>REMARKS: </td>
									<td colspan="7"><textarea style="width:100%;" name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][REMARKS]" placeholder='REMARKS' id="SAL-REMARKS" ><?php echo $salary->REMARKS ? $salary->REMARKS : ""?></textarea></td>
								</tr>
							</table>
						<?php } ?>
						<?php  if($bill->IS_DA_ARREAR_BILL) { ?>
							<input type="hidden" name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][MONTH]" value="<?php echo $month?>"/>
							<input type="hidden" name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][YEAR]" value="<?php echo $year?>"/>
							<table class="table table-bordered table-hover" style="margin-bottom: 10px;" id="<?php echo $month."-".$year;?>">
								<tr>
									<input type="hidden" id="PENSION_TYPE" value="<?php echo $employee->PENSION_TYPE;?>"/>
									<td>DA: <input type="number" size="10" name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][DA]" data-type="DA" class="gross-inc-amount da-amount" value="<?php echo $salary->DA ? $salary->DA : 0;?>" placeholder="DA"/></td>
									<td>TA: <input type="number" size="10" name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][TA]" data-type="TA" class="gross-inc-amount" value="<?php echo $salary->TA ? $salary->TA : 0;?>" placeholder="TA"/></td>
									<?php if($employee->PENSION_TYPE == "NPS") {?>
									<td>CPF TIER I: <input type="number" size="10" name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][CPF_TIER_I]" data-type="CPF_TIER_I" class="ded-inc-amount  cpf-1-amount" value="<?php echo $salary->CPF_TIER_I ? $salary->CPF_TIER_I : 0;?>" placeholder="CPF TIER I"/></td>
									<?php } ?>
									<td>GROSS: <input type="number" size="10" id='gross-components' name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][GROSS]" value="<?php echo $salary->GROSS ? $salary->GROSS : 0;?>" placeholder="GROSS"/></td>
									<td>DED: <input type="number" size="10" id='ded-components' name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][DED]" value="<?php echo $salary->DED ? $salary->DED : 0;?>" placeholder="DED"/></td>
									<td>NET: <input type="number" size="10" id='net-components' name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][NET]" value="<?php echo $salary->NET ? $salary->NET : 0;?>" placeholder="NET"/></td>
									<td>OTHER DED: <input type="number" size="10" id='other-ded-components' name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][OTHER_DED]" value="<?php echo $salary->OTHER_DED ? $salary->OTHER_DED : 0;?>" placeholder="OTHER DED"/></td>
									<td>AMT. BANK: <input type="number" size="10" id='credit-component' name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][AMOUNT_BANK]" value="<?php echo $salary->AMOUNT_BANK ? $salary->AMOUNT_BANK : 0;?>" placeholder="AMOUNT BANK"/></td>
								</tr>
								<tr>
									<td>REMARKS: </td>
									<td colspan="7"><textarea style="width:100%;" name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][REMARKS]" placeholder='REMARKS'><?php echo $salary->REMARKS ? $salary->REMARKS : ""?></textarea></td>
								</tr>
							</table>
						<?php } ?>
						<?php if($bill->IS_BONUS_BILL) {?>
							<table class="table table-bordered table-hover" style="margin-bottom: 10px;" id="<?php echo $month."-".$year;?>">
								<tr>
									<td>BONUS: <input type="number" size="10" name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][BONUS]" data-type="BONUS" class="gross-inc-amount" value="<?php echo $salary->BONUS ? $salary->BONUS : 0;?>" placeholder="BONUS"/></td>
									<td>GROSS: <input type="number" size="10" id='gross-components' name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][GROSS]" value="<?php echo $salary->GROSS ? $salary->GROSS : 0;?>" placeholder="GROSS"/></td>
									<td>DED: <input type="number" size="10" id='ded-components' name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][DED]" value="<?php echo $salary->DED ? $salary->DED : 0;?>" placeholder="DED"/></td>
									<td>NET: <input type="number" size="10" id='net-components' name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][NET]" value="<?php echo $salary->NET ? $salary->NET : 0;?>" placeholder="NET"/></td>
									<td>OTHER DED: <input type="number" size="10" id='other-ded-components' name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][OTHER_DED]" value="<?php echo $salary->OTHER_DED ? $salary->OTHER_DED : 0;?>" placeholder="OTHER DED"/></td>
									<td>AMT. BANK: <input type="number" size="10" id='credit-component' name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][AMOUNT_BANK]" value="<?php echo $salary->AMOUNT_BANK ? $salary->AMOUNT_BANK : 0;?>" placeholder="AMOUNT BANK"/></td>
								</tr>
								<tr>
									<td>REMARKS: </td>
									<td colspan="7"><textarea style="width:100%;" name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][REMARKS]" placeholder='REMARKS'><?php echo $salary->REMARKS ? $salary->REMARKS : ""?></textarea></td>
								</tr>
							</table>
						<?php } ?>
						<?php if($bill->IS_UA_BILL) {?>
							<table class="table table-bordered table-hover" style="margin-bottom: 10px;" id="<?php echo $month."-".$year;?>">
								<tr>
									<td>Uniform Allowance: <input type="number" size="10" name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][UA]" data-type="UA" class="gross-inc-amount" value="<?php echo $salary->UA ? $salary->UA : 0;?>" placeholder="UA"/></td>
									<td>GROSS: <input type="number" size="10" id='gross-components' name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][GROSS]" value="<?php echo $salary->GROSS ? $salary->GROSS : 0;?>" placeholder="GROSS"/></td>
									<td>DED: <input type="number" size="10" id='ded-components' name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][DED]" value="<?php echo $salary->DED ? $salary->DED : 0;?>" placeholder="DED"/></td>
									<td>NET: <input type="number" size="10" id='net-components' name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][NET]" value="<?php echo $salary->NET ? $salary->NET : 0;?>" placeholder="NET"/></td>
									<td>OTHER DED: <input type="number" size="10" id='other-ded-components' name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][OTHER_DED]" value="<?php echo $salary->OTHER_DED ? $salary->OTHER_DED : 0;?>" placeholder="OTHER DED"/></td>
									<td>AMT. BANK: <input type="number" size="10" id='credit-component' name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][AMOUNT_BANK]" value="<?php echo $salary->AMOUNT_BANK ? $salary->AMOUNT_BANK : 0;?>" placeholder="AMOUNT BANK"/></td>
								</tr>
								<tr>
									<td>REMARKS: </td>
									<td colspan="7"><textarea style="width:100%;" name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][REMARKS]" placeholder='REMARKS'><?php echo $salary->REMARKS ? $salary->REMARKS : ""?></textarea></td>
								</tr>
							</table>
						<?php } ?>
						<?php if($bill->IS_CEA_BILL) {?>
							<table class="table table-bordered table-hover" style="margin-bottom: 10px;" id="<?php echo $month."-".$year;?>">
								<tr>
									<td>CEA (Tuition): <input type="number" size="10" name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][CEA_TUITION]" data-type="CEA_TUITION" class="cea-tuition-amount" value="<?php echo $salary->CEA_TUITION ? $salary->CEA_TUITION : 0;?>" placeholder="CEA (Tuition)"/></td>
									<td>CEA (Other): <input type="number" size="10" name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][CEA_OTHER]" data-type="CEA_OTHER" class="cea-other-amount" value="<?php echo $salary->CEA_OTHER ? $salary->CEA_OTHER : 0;?>" placeholder="CEA (Other)"/></td>
									<td>CEA (Total): <input type="number" size="10" name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][CEA]" data-type="CEA" class="gross-inc-amount cea-total-amount" value="<?php echo $salary->CEA ? $salary->CEA : 0;?>" placeholder="CEA TOTAL"/></td>
									<td>GROSS: <input type="number" size="10" id='gross-components' name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][GROSS]" value="<?php echo $salary->GROSS ? $salary->GROSS : 0;?>" placeholder="GROSS"/></td>
									<td>DED: <input type="number" size="10" id='ded-components' name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][DED]" value="<?php echo $salary->DED ? $salary->DED : 0;?>" placeholder="DED"/></td>
									<td>NET: <input type="number" size="10" id='net-components' name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][NET]" value="<?php echo $salary->NET ? $salary->NET : 0;?>" placeholder="NET"/></td>
									<td>OTHER DED: <input type="number" size="10" id='other-ded-components' name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][OTHER_DED]" value="<?php echo $salary->OTHER_DED ? $salary->OTHER_DED : 0;?>" placeholder="OTHER DED"/></td>
									<td>AMT. BANK: <input type="number" size="10" id='credit-component' name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][AMOUNT_BANK]" value="<?php echo $salary->AMOUNT_BANK ? $salary->AMOUNT_BANK : 0;?>" placeholder="AMOUNT BANK"/></td>
								</tr>
								<tr>
									<td>REMARKS: </td>
									<td colspan="7"><textarea style="width:100%;" name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][REMARKS]" placeholder='REMARKS'><?php echo $salary->REMARKS ? $salary->REMARKS : ""?></textarea></td>
								</tr>
							</table>
						<?php } ?>
						<?php if($bill->IS_LTC_ADVANCE_BILL) {?>
							<table class="table table-bordered table-hover" style="margin-bottom: 10px;" id="<?php echo $month."-".$year;?>">
								<tr>
									<td>HTC/LTC ADVANCE: <input type="number" size="10" class="gross-inc-amount" name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][LTC_HTC]" data-type="LTC_HTC" value="<?php echo $salary->LTC_HTC ? $salary->LTC_HTC : 0;?>" placeholder="HTC/LTC ADVANCE."/></td>
									<td>GROSS: <input type="number" size="10" id='gross-components' name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][GROSS]" value="<?php echo $salary->GROSS ? $salary->GROSS : 0;?>" placeholder="GROSS"/></td>
									<td>DED: <input type="number" size="10" id='ded-components' name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][DED]" value="<?php echo $salary->DED ? $salary->DED : 0;?>" placeholder="DED"/></td>
									<td>NET: <input type="number" size="10" id='net-components' name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][NET]" value="<?php echo $salary->NET ? $salary->NET : 0;?>" placeholder="NET"/></td>
									<td>OTHER DED: <input type="number" size="10" id='other-ded-components' name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][OTHER_DED]" value="<?php echo $salary->OTHER_DED ? $salary->OTHER_DED : 0;?>" placeholder="OTHER DED"/></td>
									<td>AMT. BANK: <input type="number" size="10" id='credit-component' name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][AMOUNT_BANK]" value="<?php echo $salary->AMOUNT_BANK ? $salary->AMOUNT_BANK : 0;?>" placeholder="AMOUNT BANK"/></td>
								</tr>
								<tr>
									<td>REMARKS: </td>
									<td colspan="7"><textarea style="width:100%;" name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][REMARKS]" placeholder='REMARKS'><?php echo $salary->REMARKS ? $salary->REMARKS : ""?></textarea></td>
								</tr>
							</table>
						<?php } ?>
						<?php if($bill->IS_LTC_CLAIM_BILL) {?>
							<table class="table table-bordered table-hover" style="margin-bottom: 10px;" id="<?php echo $month."-".$year;?>">
								<tr>
									<td>GROSS CLAIM: <input type='number' size="10" class="gross-inc-amount" name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][LTC_HTC_GROSS]" data-type="LTC_HTC_GROSS" value='<?php echo $salary->LTC_HTC_GROSS ? $salary->LTC_HTC_GROSS : 0?>' placeholder='GROSS'></td>
									<td>ADVANCE: <input type='number' size="10" class="ltc-ded-inc-amount" name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][LTC_HTC_ADVANCE]" data-type="LTC_HTC_ADVANCE" value='<?php echo $salary->LTC_HTC_ADVANCE ? $salary->LTC_HTC_ADVANCE : 0?>' placeholder='ADVANCE'></td>
									<td>NET AMOUNT: <input type='number' size="10" id="ltc-credit-component" name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][LTC_HTC]" data-type="LTC_HTC" value='<?php echo $salary->LTC_HTC ? $salary->LTC_HTC : 0?>' placeholder='CLAIM AMOUNT'></td>
									<td>GROSS: <input type="number" size="10" id='gross-components' name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][GROSS]" value="<?php echo $salary->GROSS ? $salary->GROSS : 0;?>" placeholder="GROSS"/></td>
									<td>DED: <input type="number" size="10" id='ded-components' name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][DED]" value="<?php echo $salary->DED ? $salary->DED : 0;?>" placeholder="DED"/></td>
									<td>NET: <input type="number" size="10" id='net-components' name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][NET]" value="<?php echo $salary->NET ? $salary->NET : 0;?>" placeholder="NET"/></td>
									<td>OTHER DED: <input type="number" size="10" id='other-ded-components' name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][OTHER_DED]" value="<?php echo $salary->OTHER_DED ? $salary->OTHER_DED : 0;?>" placeholder="OTHER DED"/></td>
									<td>AMT. BANK: <input type="number" size="10" id='credit-component' name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][AMOUNT_BANK]" value="<?php echo $salary->AMOUNT_BANK ? $salary->AMOUNT_BANK : 0;?>" placeholder="AMOUNT BANK"/></td>
								</tr>
								<tr>
									<td>REMARKS: </td>
									<td colspan="7"><textarea style="width:100%;" name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][REMARKS]" placeholder='REMARKS'><?php echo $salary->REMARKS ? $salary->REMARKS : ""?></textarea></td>
								</tr>
							</table>
						<?php } ?>
						<?php if($bill->IS_EL_ENCASHMENT_BILL) {?>
							<table class="table table-bordered table-hover" style="margin-bottom: 10px;" id="<?php echo $month."-".$year;?>">
								<tr>
									<td>BLOCK YEAR: <input type="number" size="10" name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][BLOCK_YEAR]" data-type="BLOCK_YEAR" value="<?php echo $salary->BLOCK_YEAR ? $salary->BLOCK_YEAR : '';?>" placeholder="BLOCK YEAR"/></td>
									<td>DAYS: <input type="number" size="10" name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][EL_ENCASH_DAYS]" data-type="EL_ENCASH_DAYS" value="<?php echo $salary->EL_ENCASH_DAYS ? $salary->EL_ENCASH_DAYS : '';?>" placeholder="xx days"/></td>
									<td>EL APPLIED: <input type="number" size="10" name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][EL_ENCASH_LEAVE_APPLIED]" data-type="EL_ENCASH_LEAVE_APPLIED" value="<?php echo $salary->EL_ENCASH_LEAVE_APPLIED ? $salary->EL_ENCASH_LEAVE_APPLIED : '';?>" placeholder="xx days EL "/></td>
									<td colspan="2">EL BALANCE: <input type="number" size="10" name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][EL_ENCASH_LEAVE_BALANCE_BEFORE]" value="<?php echo $salary->EL_ENCASH_LEAVE_BALANCE_BEFORE ? $salary->EL_ENCASH_LEAVE_BALANCE_BEFORE : '';?>" placeholder="xx Days"/></td>
									<td colspan="2">PREVIOUS EL ENCASH DAYS: <input type="number" size="10" name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][PREVIOUS_EL_ENCASH_DAYS]" value="<?php echo $salary->PREVIOUS_EL_ENCASH_DAYS ? $salary->PREVIOUS_EL_ENCASH_DAYS : 0;?>" placeholder="PREVIOUS EL ENCASHMENT AMOUNT" /></td>
								</tr>
								<tr>
									<td>EL ENCASHMENT: <input type="number" size="10" name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][EL_ENCASHMENT]" data-type="EL_ENCASHMENT" class="gross-inc-amount" value="<?php echo $salary->EL_ENCASHMENT ? $salary->EL_ENCASHMENT : 0;?>" placeholder="EL ENCASHMENT"/></td>
									<td>IT: <input type="number" size="10" name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][IT]" data-type="IT" class="ded-inc-amount" value="<?php echo $salary->IT ? $salary->IT : 0;?>" placeholder="IT"/></td>
									<td>GROSS: <input type="number" size="10" id='gross-components' name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][GROSS]" value="<?php echo $salary->GROSS ? $salary->GROSS : 0;?>" placeholder="GROSS"/></td>
									<td>DED: <input type="number" size="10" id='ded-components' name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][DED]" value="<?php echo $salary->DED ? $salary->DED : 0;?>" placeholder="DED"/></td>
									<td>NET: <input type="number" size="10" id='net-components' name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][NET]" value="<?php echo $salary->NET ? $salary->NET : 0;?>" placeholder="NET"/></td>
									<td>OTHER DED: <input type="number" size="10" id='other-ded-components' name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][OTHER_DED]" value="<?php echo $salary->OTHER_DED ? $salary->OTHER_DED : 0;?>" placeholder="OTHER DED"/></td>
									<td>AMT. BANK: <input type="number" size="10" id='credit-component' name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][AMOUNT_BANK]" value="<?php echo $salary->AMOUNT_BANK ? $salary->AMOUNT_BANK : 0;?>" placeholder="AMOUNT BANK"/></td>
								</tr>
								<tr>
									<td>REMARKS: </td>
									<td colspan="7"><textarea style="width:100%;" name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][REMARKS]" placeholder='REMARKS'><?php echo $salary->REMARKS ? $salary->REMARKS : ""?></textarea></td>
								</tr>
							</table>
						<?php } ?>
						<?php if($bill->IS_RECOVERY_BILL) {?>
							<table class="table table-bordered table-hover" style="margin-bottom: 10px;" id="<?php echo $month."-".$year;?>">
								<tr>
									<td>RECOVERY: <input type="number" size="10" name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][RECOVERY]" data-type="RECOVERY" class="gross-inc-amount" value="<?php echo $salary->RECOVERY ? $salary->RECOVERY : 0;?>" placeholder="RECOVERY"/></td>
									<td>GROSS: <input type="number" size="10" id='gross-components' name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][GROSS]" value="<?php echo $salary->GROSS ? $salary->GROSS : 0;?>" placeholder="GROSS"/></td>
									<td>DED: <input type="number" size="10" id='ded-components' name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][DED]" value="<?php echo $salary->DED ? $salary->DED : 0;?>" placeholder="DED"/></td>
									<td>NET: <input type="number" size="10" id='net-components' name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][NET]" value="<?php echo $salary->NET ? $salary->NET : 0;?>" placeholder="NET"/></td>
									<td>OTHER DED: <input type="number" size="10" id='other-ded-components' name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][OTHER_DED]" value="<?php echo $salary->OTHER_DED ? $salary->OTHER_DED : 0;?>" placeholder="OTHER DED"/></td>
									<td>AMT. BANK: <input type="number" size="10" id='credit-component' name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][AMOUNT_BANK]" value="<?php echo $salary->AMOUNT_BANK ? $salary->AMOUNT_BANK : 0;?>" placeholder="AMOUNT BANK"/></td>
								</tr>
								<tr>
									<td>REMARKS: </td>
									<td colspan="7"><textarea style="width:100%;" name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][REMARKS]" placeholder='REMARKS'><?php echo $salary->REMARKS ? $salary->REMARKS : ""?></textarea></td>
								</tr>
							</table>
						<?php } ?>
					<?php
					}
				  ?>
				</div>
				<?php
			} ?>
			</form>
	<?php } ?>
	</div>
</div>
<?php echo "<script>var periods = $js_array;</script>";?>

<style>
	.one-label{
		width:140px;
		display: inline-block;
	}
	.table.small-table{
		width: 20%;
		float: left;
		display: inline-block;
		margin-top: 30px;
	}
	input{
		float: right;
	}
	.field-value{
		float: right;
	}
	input[type=number]{
		width: 75px;
	}
</style>
<script type="text/javascript"> 
	var IS_LTC_HTC_CLAIM_BILL = <?php echo ($bill->IS_LTC_CLAIM_BILL) ? 1 : 0;?>;
	var IS_LTC_ADVANCE_BILL = <?php echo ($bill->IS_LTC_ADVANCE_BILL) ? 1 : 0;?>;
	var FORM_16_URL = '<?php echo Yii::app()->createUrl('IncomeTax/Form16', array('type'=>'Dialog'));?>&id=';
	var TABLE_FORMAT = 0;
	var IS_ARREAR_BILL = <?php echo ($bill->IS_ARREAR_BILL) ? 1 : 0;?>;
	var IS_CEA_BILL = <?php echo ($bill->IS_CEA_BILL) ? 1 : 0;?>;
	var IS_BILL_PASSED = <?php echo ($bill->IS_PASSED) ? 1 : 0;?>;
	var SALARY_SAVE_URL = '<?php echo Yii::app()->createUrl('Bill/SaveSalaryDetailAjax');?>';
	var GET_IT_URL = '<?php echo Yii::app()->createUrl('IncomeTax/SelectEmployeesForForm16');?>';
	
	$(document).ready(function(){
		if(IS_BILL_PASSED){
			$('input, textarea').not("#textSearch").prop('readonly', true);
			$('select').prop('disabled', true);
		}
	});
	$('.swal-btn-input').click(function(e){
		e.preventDefault();
		swal({
			title: "IT Calculator",
			text: "<iframe style='width:300px;height:300px;border:none;' src='<?php echo Yii::app()->createUrl('Bill/TaxCalculate')?>'></iframe>",
			html:true,
			confirmButtonClass: "btn-error",
			confirmButtonText: "Close"
		});
	});
</script>	
<?php
	function get_string_between($string, $start, $end){
		$string = ' ' . $string;
		$ini = strpos($string, $start);
		if ($ini == 0) return '';
		$ini += strlen($start);
		$len = strpos($string, $end, $ini) - $ini;
		return substr($string, $ini, $len);
	}
?>
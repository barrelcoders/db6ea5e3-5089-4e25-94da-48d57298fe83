
<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/oneadmin.css" rel="stylesheet">
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
					<td colspan="3">
						<span style="float: right;"><?php echo $bill->BILL_NO; ?></span>
					</td>
				</tr>
				<?php if($bill->IS_SALARY_HEAD_OTHER_BILL || $bill->IS_WAGES_HEAD_OTHER_BILL){ ?>
				<form id="bill-form" action="<?php echo Yii::app()->createUrl('Bill/update', array('id'=>$bill->ID, 'isSalaryHead'=>1))?>" method="post">
					<tr>
						<td colspan="5"><b class="one-label">PFMS BILL NO: </b> <input size="100" maxlength="100" name="Bill[PFMS_BILL_NO]" id="Bill_PFMS_BILL_NO"  value="<?php echo Bill::model()->findByPK($bill->ID)->PFMS_BILL_NO;?>" type="text" style="line-height:30px;font-size: 20px;width: 80%;" ></td>
						<td colspan="3"><input class="btn btn-success" type="submit" name="yt0" value="SAVE PFMS BILL NO"></td>
					</tr>
				</form>
				<?php } ?>
			</table>
			<form name="SalaryDetails" action="<?php echo Yii::app()->createUrl('Bill/SalaryDetails', array('id'=>$bill->ID))?>" method="post">
			<div class="row">
				<div class="col-sm-2">
					<p class="form-control-static">
						<?php if($model->PFMS_STATUS != "Passed"){?>
						<input type="submit" name="SalaryDetails[save]" class="btn btn-inline" value="Save" style="float:left;">
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
						<?php if($model->PFMS_STATUS != "Passed"){?>
						<input type="submit" name="SalaryDetails[submit]" class="btn btn-inline" style="float: right;" value="Submit" onsubmit="return confirm('Are you sure wants to submit the bill, This will change the Appropiation Register');"
						onclick="return confirm('Are you sure wants to submit the bill, This will change the Appropiation Register');">
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
					if(SalaryDetails::model()->exists('BILL_ID_FK='.$model->ID)){
						$salaries = SalaryDetails::model()->findAllByAttributes(array('BILL_ID_FK'=>$model->ID));
						$salaryBillEmployees = array();foreach($salaries as $salary){array_push($salaryBillEmployees, $salary->EMPLOYEE_ID_FK);}
						$criteria=new CDbCriteria;
						$criteria->compare("PENSION_TYPE",'OPS');
						$criteria->addInCondition('ID', $salaryBillEmployees);
						$employees = Employee::model()->findAll($criteria);
					}
					else{
						$employees = Employee::model()->findAllByAttributes(array('PENSION_TYPE'=>'OPS', 'IS_TRANSFERRED'=>0, 'IS_RETIRED'=>0, 'IS_PERMANENT'=>1, 'IS_SUSPENDED'=>0));
					}
					$DATA_URL = Yii::app()->createUrl('Employee/OPSSalaryBillEmployees');
				}
				if($bill->IS_NPS_PAY_BILL){
					if(SalaryDetails::model()->exists('BILL_ID_FK='.$model->ID)){
						$salaries = SalaryDetails::model()->findAllByAttributes(array('BILL_ID_FK'=>$model->ID));
						$salaryBillEmployees = array();foreach($salaries as $salary){array_push($salaryBillEmployees, $salary->EMPLOYEE_ID_FK);}
						$criteria=new CDbCriteria;
						$criteria->compare("PENSION_TYPE",'NPS');
						$criteria->addInCondition('ID', $salaryBillEmployees);
						$employees = Employee::model()->findAll($criteria);
					}
					else{
						$employees = Employee::model()->findAllByAttributes(array('PENSION_TYPE'=>'NPS', 'IS_TRANSFERRED'=>0, 'IS_RETIRED'=>0, 'IS_PERMANENT'=>1, 'IS_SUSPENDED'=>0));
					}
					$DATA_URL = Yii::app()->createUrl('Employee/NPSSalaryBillEmployees');
				}
			}
			if($bill->IS_WAGES_HEAD_PAY_BILL){
				$OtherBillEmployees = explode(",", OtherBillEmployees::model()->findByAttributes(array('BILL_ID'=>$model->ID))->EMPLOYEE_ID);
				$employees = Employee::model()->findAllByAttributes(array('ID'=>$OtherBillEmployees));
				$DATA_URL = Yii::app()->createUrl('Employee/WagesBillEmployees', array('BILL_ID'=>$model->ID));
				?>
				<p style="text-align: center;font-weight bold;font-size:11px;margin-bottom: 10px;">1. For IT Provisional <?php echo FinancialYears::model()->find('STATUS=1')->NAME?> Toggle, click Employee Name & Press ( q )</p>
				<input type="hidden" name="SalaryDetails[IS_SALARY_BILL]" value="1"/>
				<?php
			}
			if($bill->IS_SALARY_HEAD_OTHER_BILL || $bill->IS_WAGES_HEAD_OTHER_BILL){ 
				$OtherBillEmployees = explode(",", OtherBillEmployees::model()->findByAttributes(array('BILL_ID'=>$model->ID))->EMPLOYEE_ID);
				$employees = Employee::model()->findAllByAttributes(array('ID'=>$OtherBillEmployees));
				$DATA_URL = Yii::app()->createUrl('Employee/OtherBillEmployees', array('BILL_ID'=>$model->ID));
				?>
				<input type="hidden" name="SalaryDetails[IS_SALARY_BILL]" value="0"/>
				<?php
			}?>
			<input type="hidden" value="<?php echo $bill->ID?>" name="SalaryInfo[BILL_ID]">
			<div id="employee-container" style="position:relative;border: 1px solid #ccc;background-color: #f1f1f1;height: 50px;">
			<a href="javascript:void(0);" style="position: absolute;left: 0;width: 50px;height: 49px;background: #ccc;font-size: 30px;padding: 7px 10px;border: 1px solid #999;text-align: center;font-weight: bold;color: #000;" id="btn-prev"><i class="fa fa-angle-left"></i></a>
			<div style="position: absolute;right: 50px;left:50px;overflow:hidden;">
				<ul class="tab" id="tab" style="width:<?php echo count($employees)*300;?>px; min-width:400px;">    
				<?php 
					$i=0;
					foreach($employees as $employee){ 
						if($i == 0){
							?>
								<li id="tablink-<?php echo $employee->ID?>" onclick="openEmployeeSalaryDetails(<?php echo $employee->ID?>)" ><a href="javascript:void(0)" class="tablinks" style="border-left: 1px solid #999;border-right: 1px solid #999;"><?php echo $employee->NAME?></a></li>
							<?php
						} else {
							?>
								<li id="tablink-<?php echo $employee->ID?>" onclick="openEmployeeSalaryDetails(<?php echo $employee->ID?>)" ><a href="javascript:void(0)" class="tablinks"style="border-right: 1px solid #999;"><?php echo $employee->NAME?></a></li>
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
				  <h1 style='margin-top:10px;'><?php echo $employee->NAME_HINDI?>, <?php echo Designations::model()->findByPK($employee->DESIGNATION_ID_FK)->DESIGNATION_HINDI?></h1>
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
							echo $matrix; ?></span>
						</td>
						<td><b class="one-label">DOI: </b><span style="float: right;"><?php echo date('d M, Y',strtotime($employee->DOI))?></span></td>
						<td colspan="2"><b class="one-label">MICR: </b><span style="float: right;"><?php echo $employee->MICR?></span></td>
						<td colspan="2"><b class="one-label">Account No: </b><span style="float: right;"><?php echo $employee->ACCOUNT_NO?></span></td>
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
								<td colspan="8"><b><?php echo $period['FORMAT']?></b></td>
							</tr>
						</table>
						<?php  if($bill->IS_SALARY_HEAD_PAY_BILL || $bill->IS_WAGES_HEAD_PAY_BILL || $bill->IS_ARREAR_BILL) { ?>
							<input type="hidden" name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][MONTH]" value="<?php echo $month?>"/>
							<input type="hidden" name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][YEAR]" value="<?php echo $year?>"/>
							<table class="table table-bordered table-hover" style="margin-bottom: 10px;" id="<?php echo $month."-".$year;?>">
								<tr>
									<input type="hidden" id="PENSION_TYPE" value="<?php echo $employee->PENSION_TYPE;?>"/>
									<td>BASIC: <input type="text" size="10" name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][BASIC]" data-type="BASIC" class="gross-inc-amount basic-amount" value="<?php echo $salary->BASIC ? $salary->BASIC : 0;?>" placeholder="BASIC"/></td>
									<td>SP: <input type="text" size="10" name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][SP]" data-type="SP" class="gross-inc-amount" value="<?php echo $salary->SP ? $salary->SP : 0;?>" placeholder="SP"/></td>
									<td>PP: <input type="text" size="10" name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][PP]" data-type="PP" class="gross-inc-amount" value="<?php echo $salary->PP ? $salary->PP : 0;?>" placeholder="PP"/></td>
									<td>CCA: <input type="text" size="10" name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][CCA]" data-type="CCA" class="gross-inc-amount" value="<?php echo $salary->CCA ? $salary->CCA : 0;?>" placeholder="CCA"/></td>
									<td>HRA: <input type="text" size="10" name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][HRA]" data-type="HRA" class="gross-inc-amount hra-amount" value="<?php echo $salary->HRA ? $salary->HRA : 0;?>" placeholder="HRA"/></td>
									<td>DA: <input type="text" size="10" name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][DA]" data-type="DA" class="gross-inc-amount da-amount" value="<?php echo $salary->DA ? $salary->DA : 0;?>" placeholder="DA"/></td>
									<td>TA: <input type="text" size="10" name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][TA]" data-type="TA" class="gross-inc-amount ta-amount" value="<?php echo $salary->TA ? $salary->TA : 0;?>" placeholder="TA"/></td>
									<td>WA: <input type="text" size="10" name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][WA]" data-type="WA" class="gross-inc-amount" value="<?php echo $salary->WA ? $salary->WA : 0;?>" placeholder="WA"/></td>
								</tr>
								<tr>
									<td>IT: <input type="text" size="10" name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][IT]" data-type="IT" class="ded-inc-amount" value="<?php echo $salary->IT ? $salary->IT : 0;?>" placeholder="IT"/></td>
									<td>CGHS: <input type="text" size="10" name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][CGHS]" data-type="CGHS" class="ded-inc-amount" value="<?php echo $salary->CGHS ? $salary->CGHS : 0;?>" placeholder="CGHS"/></td>
									<td>LF: <input type="text" size="10" name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][LF]" data-type="LF" class="ded-inc-amount" value="<?php echo $salary->LF ? $salary->LF : 0;?>" placeholder="LF"/></td>
									<td>CGEGIS: <input type="text" size="10" name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][CGEGIS]" data-type="CGEGIS" class="ded-inc-amount" value="<?php echo $salary->CGEGIS ? $salary->CGEGIS : 0;?>" placeholder="CGEGIS"/></td>
									<td><?php echo ( $employee->PENSION_TYPE == 'OPS' ) ? "GPFC" : "CPF TIER I"; ?>: <input type="text" size="10" name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][CPF_TIER_I]" data-type="CPF_TIER_I" class="ded-inc-amount  cpf-1-amount" value="<?php echo $salary->CPF_TIER_I ? $salary->CPF_TIER_I : 0;?>" placeholder="<?php echo ( $employee->PENSION_TYPE == 'OPS' ) ? "GPFC" : "CPF TIER I"; ?>"/></td>
									<td><?php echo ( $employee->PENSION_TYPE == 'OPS' ) ? "GPFR" : "CPF TIER II"; ?>: <input type="text" size="10" name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][CPF_TIER_II]" data-type="CPF_TIER_II" class="ded-inc-amount" value="<?php echo $salary->CPF_TIER_II ? $salary->CPF_TIER_II : 0;?>" placeholder="<?php echo ( $employee->PENSION_TYPE == 'OPS' ) ? "GPFR" : "CPF TIER II"; ?>"/></td>
									<td>MISC: <input type="text" size="10" name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][MISC]" data-type="MISC" class="ded-inc-amount" value="<?php echo $salary->MISC ? $salary->MISC : 0;?>" placeholder="MISC"/></td>
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
									<td>PLI: <input type="text" size="10" name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][PLI]" data-type="PLI" class="ded-inc-amount" value="<?php echo $pli;?>" placeholder="PLI"/></td>
								</tr>
								<tr>
									<td>COURT: <input type="text" size="10" name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][COURT_ATTACHMENT]" data-type="COURT_ATTACHMENT" class="ded-inc-amount" value="<?php echo $salary->COURT_ATTACHMENT ? $salary->COURT_ATTACHMENT : 0;?>" placeholder="COURT ATTACHMENT"/></td>
									<td>PT: <input type="text" size="10" name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][PT]" data-type="PT" class="pt-ded-inc-amount" value="<?php echo $salary->PT ? $salary->PT : 0;?>" placeholder="PT"/></td>
									<td>CCS: <input type="text" size="10" name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][CCS]" data-type="CCS" class="other-ded-inc-amount" value="<?php echo $salary->CCS ? $salary->CCS : 0;?>" placeholder="CCS"/></td>
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
									<td>LIC: <input type="text" size="10" name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][LIC]" data-type="LIC" class="other-ded-inc-amount" value="<?php echo $lic;?>" placeholder="LIC"/></td>
									<td>ASSOSC SUB.: <input type="text" size="10" name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][ASSOSC_SUB]" data-type="ASSOSC_SUB" class="other-ded-inc-amount" value="<?php echo $salary->ASSOSC_SUB ? $salary->ASSOSC_SUB : 0;?>" placeholder="ASSOSC SUB"/></td>
									<td>JAYAMAHAL: <input type="text" size="10" name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][MAINT_JAYAMAHAL]" data-type="MAINT_JAYAMAHAL" class="other-ded-inc-amount" value="<?php echo $salary->MAINT_JAYAMAHAL ? $salary->MAINT_JAYAMAHAL : 0;?>" placeholder="MAINT. JAYAMAHAL"/></td>
									<td>MADIWALA: <input type="text" size="10" name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][MAINT_MADIWALA]" data-type="MAINT_MADIWALA" class="other-ded-inc-amount" value="<?php echo $salary->MAINT_MADIWALA ? $salary->MAINT_MADIWALA : 0;?>" placeholder="MAINT. MADIWALA"/></td>				
									<td></td>
								</tr>
								<tr>
									<td>HBA</td>
									<td>
										<select name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month?>][IS_HBA_RECOVERY]" >
											<option value="0" <?php echo ($salary->IS_HBA_RECOVERY && ($salary->IS_HBA_RECOVERY == 0)) ? "selected" : "";?>>PRINCIPAL</option>
											<option value="1" <?php echo ($salary->IS_HBA_RECOVERY && ($salary->IS_HBA_RECOVERY == 1)) ? "selected" : "";?>>INTEREST</option>
										</select>
									</td>
									<td>TOTAL: <input type="text" size="10" name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][HBA_TOTAL]" data-type="HBA_TOTAL" value="<?php echo $salary->HBA_TOTAL ? $salary->HBA_TOTAL : 0;?>" placeholder="TOTAL" class="hba-total"/></td>
									<td>INSTALLMENT: <input type="text" size="10" name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][HBA_INST]" data-type="HBA_INST" value="<?php echo $salary->HBA_INST ? $salary->HBA_INST : 0;?>" placeholder="INSTALLMENT" class="increment-field hba-inst"/></td>
									<td>EMI: <input type="text" size="10" name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][HBA_EMI]" data-type="HBA_EMI" class="ded-inc-amount hba-emi" value="<?php echo $salary->HBA_EMI ? $salary->HBA_EMI : 0;?>" placeholder="EMI"/></td>
									<td>BALANCE: <input type="text" size="10" name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][HBA_BAL]" data-type="HBA_BAL" value="<?php echo $salary->HBA_BAL ? $salary->HBA_BAL : 0;?>" placeholder="BALANCE" class="hba-bal non-populated-field"/></td>
									<td></td><td></td>
								</tr>
								<tr>
									<td>MCA</td>
									<td>
										<select name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month?>][IS_MCA_RECOVERY]" >
											<option value="0" <?php echo ($salary->IS_MCA_RECOVERY == 0) ? "selected" : "";?>>PRINCIPAL</option>
											<option value="1" <?php echo ($salary->IS_MCA_RECOVERY == 1) ? "selected" : "";?>>INTEREST</option>
										</select>
									</td>
									<td>TOTAL: <input type="text" size="10" name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][MCA_TOTAL]" data-type="MCA_TOTAL" value="<?php echo $salary->MCA_TOTAL ? $salary->MCA_TOTAL : 0;?>" placeholder="TOTAL" class="mca-total"/></td>
									<td>INSTALLMENT: <input type="text" size="10" name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][MCA_INST]" data-type="MCA_INST" value="<?php echo $salary->MCA_INST ? $salary->MCA_INST : 0;?>" placeholder="INSTALLMENT" class="increment-field mca-inst"/></td>
									<td>EMI: <input type="text" size="10" name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][MCA_EMI]" data-type="MCA_EMI" class="ded-inc-amount mca-emi" value="<?php echo $salary->MCA_EMI ? $salary->MCA_EMI : 0;?>" placeholder="EMI"/></td>
									<td>BALANCE: <input type="text" size="10" name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][MCA_BAL]" data-type="MCA_BAL" value="<?php echo $salary->MCA_BAL ? $salary->MCA_BAL : 0;?>" placeholder="BALANCE" class="mca-bal non-populated-field"/></td>
									<td></td><td></td>
								</tr>
								<tr>
									<td>COMPUTER</td>
									<td>
										<select name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month?>][IS_COMP_RECOVERY]" >
											<option value="0" <?php echo ($salary->IS_COMP_RECOVERY == 0) ? "selected" : "";?>>PRINCIPAL</option>
											<option value="1" <?php echo ($salary->IS_COMP_RECOVERY == 1) ? "selected" : "";?>>INTEREST</option>
										</select>
									</td>
									<td>TOTAL: <input type="text" size="10" name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][COMP_TOTAL]" data-type="COMP_TOTAL" value="<?php echo $salary->COMP_TOTAL ? $salary->COMP_TOTAL : 0;?>" placeholder="TOTAL" class="comp-total"/></td>
									<td>INSTALLMENT: <input type="text" size="10" name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][COMP_INST]" data-type="COMP_INST" value="<?php echo $salary->COMP_INST ? $salary->COMP_INST : 0;?>" placeholder="INSTALLMENT" class="increment-field comp-inst"/></td>
									<td>EMI: <input type="text" size="10" name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][COMP_EMI]" data-type="COMP_EMI" class="ded-inc-amount comp-emi" value="<?php echo $salary->COMP_EMI ? $salary->COMP_EMI : 0;?>" placeholder="EMI"/></td>
									<td>BALANCE: <input type="text" size="10" name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][COMP_BAL]" data-type="COMP_BAL" value="<?php echo $salary->COMP_BAL ? $salary->COMP_BAL : 0;?>" placeholder="BALANCE" class="comp-bal non-populated-field"/></td>
									<td></td><td></td>
								</tr>
								<tr>
									<td>GROSS: <input type="text" size="10" id='gross-components' name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][GROSS]" value="<?php echo $salary->GROSS ? $salary->GROSS : 0;?>" placeholder="GROSS"/></td>
									<td>DED: <input type="text" size="10" id='ded-components' name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][DED]" value="<?php echo $salary->DED ? $salary->DED : 0;?>" placeholder="DED"/></td>
									<td>NET: <input type="text" size="10" id='net-components' name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][NET]" value="<?php echo $salary->NET ? $salary->NET : 0;?>" placeholder="NET"/></td>
									<td>OTHER DED: <input type="text" size="10" id='other-ded-components' name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][OTHER_DED]" value="<?php echo $salary->OTHER_DED ? $salary->OTHER_DED : 0;?>" placeholder="OTHER DED"/></td>
									<td>AMT. BANK: <input type="text" size="10" id='credit-component' name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][AMOUNT_BANK]" value="<?php echo $salary->AMOUNT_BANK ? $salary->AMOUNT_BANK : 0;?>" placeholder="AMOUNT BANK"/></td>
									<td></td><td></td><td></td>
								</tr>
								<tr>
									<td>REMARKS: </td>
									<td colspan="7"><textarea style="width:100%;" name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][REMARKS]" placeholder='REMARKS'><?php echo $salary->REMARKS ? $salary->REMARKS : ""?></textarea></td>
								</tr>
							</table>
						<?php } ?>
						<?php  if($bill->IS_DA_ARREAR_BILL) { ?>
							<input type="hidden" name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][MONTH]" value="<?php echo $month?>"/>
							<input type="hidden" name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][YEAR]" value="<?php echo $year?>"/>
							
							<table class="table table-bordered table-hover" style="margin-bottom: 10px;" id="<?php echo $month."-".$year;?>">
								<tr>
									<input type="hidden" id="PENSION_TYPE" value="<?php echo $employee->PENSION_TYPE;?>"/>
									<td>DA: <input type="text" size="10" name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][DA]" data-type="DA" class="gross-inc-amount da-amount" value="<?php echo $salary->DA ? $salary->DA : 0;?>" placeholder="DA"/></td>
									<td>TA: <input type="text" size="10" name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][TA]" data-type="TA" class="gross-inc-amount" value="<?php echo $salary->TA ? $salary->TA : 0;?>" placeholder="TA"/></td>
									<?php if($employee->PENSION_TYPE == "NPS") {?>
									<td>CPF TIER I: <input type="text" size="10" name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][CPF_TIER_I]" data-type="CPF_TIER_I" class="ded-inc-amount  cpf-1-amount" value="<?php echo $salary->CPF_TIER_I ? $salary->CPF_TIER_I : 0;?>" placeholder="CPF TIER I"/></td>
									<?php } ?>
									<td>GROSS: <input type="text" size="10" id='gross-components' name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][GROSS]" value="<?php echo $salary->GROSS ? $salary->GROSS : 0;?>" placeholder="GROSS"/></td>
									<td>DED: <input type="text" size="10" id='ded-components' name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][DED]" value="<?php echo $salary->DED ? $salary->DED : 0;?>" placeholder="DED"/></td>
									<td>NET: <input type="text" size="10" id='net-components' name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][NET]" value="<?php echo $salary->NET ? $salary->NET : 0;?>" placeholder="NET"/></td>
									<td>OTHER DED: <input type="text" size="10" id='other-ded-components' name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][OTHER_DED]" value="<?php echo $salary->OTHER_DED ? $salary->OTHER_DED : 0;?>" placeholder="OTHER DED"/></td>
									<td>AMT. BANK: <input type="text" size="10" id='credit-component' name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][AMOUNT_BANK]" value="<?php echo $salary->AMOUNT_BANK ? $salary->AMOUNT_BANK : 0;?>" placeholder="AMOUNT BANK"/></td>
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
									<td>BONUS: <input type="text" size="10" name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][BONUS]" data-type="BONUS" class="gross-inc-amount" value="<?php echo $salary->BONUS ? $salary->BONUS : 0;?>" placeholder="BONUS"/></td>
									<td>GROSS: <input type="text" size="10" id='gross-components' name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][GROSS]" value="<?php echo $salary->GROSS ? $salary->GROSS : 0;?>" placeholder="GROSS"/></td>
									<td>DED: <input type="text" size="10" id='ded-components' name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][DED]" value="<?php echo $salary->DED ? $salary->DED : 0;?>" placeholder="DED"/></td>
									<td>NET: <input type="text" size="10" id='net-components' name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][NET]" value="<?php echo $salary->NET ? $salary->NET : 0;?>" placeholder="NET"/></td>
									<td>OTHER DED: <input type="text" size="10" id='other-ded-components' name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][OTHER_DED]" value="<?php echo $salary->OTHER_DED ? $salary->OTHER_DED : 0;?>" placeholder="OTHER DED"/></td>
									<td>AMT. BANK: <input type="text" size="10" id='credit-component' name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][AMOUNT_BANK]" value="<?php echo $salary->AMOUNT_BANK ? $salary->AMOUNT_BANK : 0;?>" placeholder="AMOUNT BANK"/></td>
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
									<td>Uniform Allowance: <input type="text" size="10" name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][UA]" data-type="UA" class="gross-inc-amount" value="<?php echo $salary->UA ? $salary->UA : 0;?>" placeholder="UA"/></td>
									<td>GROSS: <input type="text" size="10" id='gross-components' name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][GROSS]" value="<?php echo $salary->GROSS ? $salary->GROSS : 0;?>" placeholder="GROSS"/></td>
									<td>DED: <input type="text" size="10" id='ded-components' name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][DED]" value="<?php echo $salary->DED ? $salary->DED : 0;?>" placeholder="DED"/></td>
									<td>NET: <input type="text" size="10" id='net-components' name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][NET]" value="<?php echo $salary->NET ? $salary->NET : 0;?>" placeholder="NET"/></td>
									<td>OTHER DED: <input type="text" size="10" id='other-ded-components' name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][OTHER_DED]" value="<?php echo $salary->OTHER_DED ? $salary->OTHER_DED : 0;?>" placeholder="OTHER DED"/></td>
									<td>AMT. BANK: <input type="text" size="10" id='credit-component' name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][AMOUNT_BANK]" value="<?php echo $salary->AMOUNT_BANK ? $salary->AMOUNT_BANK : 0;?>" placeholder="AMOUNT BANK"/></td>
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
									<td>Children Education Allowance: <input type="text" size="10" name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][CEA]" data-type="CEA" class="gross-inc-amount" value="<?php echo $salary->CEA ? $salary->CEA : 0;?>" placeholder="C.E.A."/></td>
									<td>GROSS: <input type="text" size="10" id='gross-components' name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][GROSS]" value="<?php echo $salary->GROSS ? $salary->GROSS : 0;?>" placeholder="GROSS"/></td>
									<td>DED: <input type="text" size="10" id='ded-components' name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][DED]" value="<?php echo $salary->DED ? $salary->DED : 0;?>" placeholder="DED"/></td>
									<td>NET: <input type="text" size="10" id='net-components' name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][NET]" value="<?php echo $salary->NET ? $salary->NET : 0;?>" placeholder="NET"/></td>
									<td>OTHER DED: <input type="text" size="10" id='other-ded-components' name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][OTHER_DED]" value="<?php echo $salary->OTHER_DED ? $salary->OTHER_DED : 0;?>" placeholder="OTHER DED"/></td>
									<td>AMT. BANK: <input type="text" size="10" id='credit-component' name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][AMOUNT_BANK]" value="<?php echo $salary->AMOUNT_BANK ? $salary->AMOUNT_BANK : 0;?>" placeholder="AMOUNT BANK"/></td>
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
									<td>HTC/LTC ADVANCE: <input type="text" size="10" class="gross-inc-amount" name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][LTC_HTC]" data-type="LTC_HTC" value="<?php echo $salary->LTC_HTC ? $salary->LTC_HTC : 0;?>" placeholder="HTC/LTC ADVANCE."/></td>
									<td>GROSS: <input type="text" size="10" id='gross-components' name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][GROSS]" value="<?php echo $salary->GROSS ? $salary->GROSS : 0;?>" placeholder="GROSS"/></td>
									<td>DED: <input type="text" size="10" id='ded-components' name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][DED]" value="<?php echo $salary->DED ? $salary->DED : 0;?>" placeholder="DED"/></td>
									<td>NET: <input type="text" size="10" id='net-components' name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][NET]" value="<?php echo $salary->NET ? $salary->NET : 0;?>" placeholder="NET"/></td>
									<td>OTHER DED: <input type="text" size="10" id='other-ded-components' name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][OTHER_DED]" value="<?php echo $salary->OTHER_DED ? $salary->OTHER_DED : 0;?>" placeholder="OTHER DED"/></td>
									<td>AMT. BANK: <input type="text" size="10" id='credit-component' name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][AMOUNT_BANK]" value="<?php echo $salary->AMOUNT_BANK ? $salary->AMOUNT_BANK : 0;?>" placeholder="AMOUNT BANK"/></td>
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
									<td>GROSS CLAIM: <input type='text' size="10" class="gross-inc-amount" name="SalaryDetails[<?php echo $employee->ID?>][LTC_HTC_GROSS]" data-type="LTC_HTC_GROSS" value='<?php echo $salary->LTC_HTC_GROSS ? $salary->LTC_HTC_GROSS : 0?>' placeholder='GROSS'></td>
									<td>ADVANCE: <input type='text' size="10" class="ltc-ded-inc-amount" name="SalaryDetails[<?php echo $employee->ID?>][LTC_HTC_ADVANCE]" data-type="LTC_HTC_ADVANCE" value='<?php echo $salary->LTC_HTC_ADVANCE ? $salary->LTC_HTC_ADVANCE : 0?>' placeholder='ADVANCE'></td>
									<td>NET AMOUNT: <input type='text' size="10" id="ltc-credit-component" name="SalaryDetails[<?php echo $employee->ID?>][LTC_HTC]" data-type="LTC_HTC" value='<?php echo $salary->LTC_HTC ? $salary->LTC_HTC : 0?>' placeholder='CLAIM AMOUNT'></td>
									<td>GROSS: <input type="text" size="10" id='gross-components' name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][GROSS]" value="<?php echo $salary->GROSS ? $salary->GROSS : 0;?>" placeholder="GROSS"/></td>
									<td>DED: <input type="text" size="10" id='ded-components' name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][DED]" value="<?php echo $salary->DED ? $salary->DED : 0;?>" placeholder="DED"/></td>
									<td>NET: <input type="text" size="10" id='net-components' name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][NET]" value="<?php echo $salary->NET ? $salary->NET : 0;?>" placeholder="NET"/></td>
									<td>OTHER DED: <input type="text" size="10" id='other-ded-components' name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][OTHER_DED]" value="<?php echo $salary->OTHER_DED ? $salary->OTHER_DED : 0;?>" placeholder="OTHER DED"/></td>
									<td>AMT. BANK: <input type="text" size="10" id='credit-component' name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][AMOUNT_BANK]" value="<?php echo $salary->AMOUNT_BANK ? $salary->AMOUNT_BANK : 0;?>" placeholder="AMOUNT BANK"/></td>
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
									<td>EL ENCASHMENT: <input type="text" size="10" name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][EL_ENCASHMENT]" data-type="EL_ENCASHMENT" class="gross-inc-amount" value="<?php echo $salary->EL_ENCASHMENT ? $salary->EL_ENCASHMENT : 0;?>" placeholder="EL ENCASHMENT"/></td>
									<td>GROSS: <input type="text" size="10" id='gross-components' name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][GROSS]" value="<?php echo $salary->GROSS ? $salary->GROSS : 0;?>" placeholder="GROSS"/></td>
									<td>DED: <input type="text" size="10" id='ded-components' name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][DED]" value="<?php echo $salary->DED ? $salary->DED : 0;?>" placeholder="DED"/></td>
									<td>NET: <input type="text" size="10" id='net-components' name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][NET]" value="<?php echo $salary->NET ? $salary->NET : 0;?>" placeholder="NET"/></td>
									<td>OTHER DED: <input type="text" size="10" id='other-ded-components' name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][OTHER_DED]" value="<?php echo $salary->OTHER_DED ? $salary->OTHER_DED : 0;?>" placeholder="OTHER DED"/></td>
									<td>AMT. BANK: <input type="text" size="10" id='credit-component' name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][AMOUNT_BANK]" value="<?php echo $salary->AMOUNT_BANK ? $salary->AMOUNT_BANK : 0;?>" placeholder="AMOUNT BANK"/></td>
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
									<td>RECOVERY: <input type="text" size="10" name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][RECOVERY]" data-type="RECOVERY" class="gross-inc-amount" value="<?php echo $salary->RECOVERY ? $salary->RECOVERY : 0;?>" placeholder="RECOVERY"/></td>
									<td>GROSS: <input type="text" size="10" id='gross-components' name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][GROSS]" value="<?php echo $salary->GROSS ? $salary->GROSS : 0;?>" placeholder="GROSS"/></td>
									<td>DED: <input type="text" size="10" id='ded-components' name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][DED]" value="<?php echo $salary->DED ? $salary->DED : 0;?>" placeholder="DED"/></td>
									<td>NET: <input type="text" size="10" id='net-components' name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][NET]" value="<?php echo $salary->NET ? $salary->NET : 0;?>" placeholder="NET"/></td>
									<td>OTHER DED: <input type="text" size="10" id='other-ded-components' name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][OTHER_DED]" value="<?php echo $salary->OTHER_DED ? $salary->OTHER_DED : 0;?>" placeholder="OTHER DED"/></td>
									<td>AMT. BANK: <input type="text" size="10" id='credit-component' name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][AMOUNT_BANK]" value="<?php echo $salary->AMOUNT_BANK ? $salary->AMOUNT_BANK : 0;?>" placeholder="AMOUNT BANK"/></td>
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
</style>
<script type="text/javascript"> 
	var IS_LTC_HTC_CLAIM_BILL = <?php echo ($bill->IS_LTC_CLAIM_BILL) ? 1 : 0;?>;
	var FORM_16_URL = '<?php echo Yii::app()->createUrl('IncomeTax/Form16', array('type'=>'Dialog'));?>&id=';
	var TABLE_FORMAT = 0;
</script>	
<script type="text/javascript" src="js/salary-details.js"></script>

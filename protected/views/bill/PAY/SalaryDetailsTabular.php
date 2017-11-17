
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
			<form name="SalaryDetails" action="<?php echo Yii::app()->createUrl('Bill/SalaryDetailsTabular', array('id'=>$bill->ID))?>" method="post">
			<div class="row">
				<div class="col-sm-2">
					<p class="form-control-static">
						<?php if($model->PFMS_STATUS != "Passed"){?>
						<input type="submit" name="SalaryDetails[save]" class="btn btn-inline" value="Save" style="float:left;">
						<?php } ?>
					</p>
				</div>
				<div class="col-sm-6">
					<p class="form-control-static">
						<input type="text" id="textSearch"  style="line-height:30px;font-size: 20px;width: 80%;" onkeyup="tableSearch();">
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
				<div class="col-sm-2">
					 <div class="dropdown dropdown-typical" style="margin-top:5px;">
						<a class="dropdown-toggle btn bt-inline" id="dd-header-form-builder" data-target="#" href="javascript:void(0);" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							<span class="fa fa-gear"></span>
							<span class="lbl">Options</span>
						</a>

						<div class="dropdown-menu" aria-labelledby="dd-header-form-builder" id="option-menu">
								<?php if($bill->IS_SALARY_HEAD_PAY_BILL || $bill->IS_WAGES_HEAD_PAY_BILL || $bill->IS_ARREAR_BILL) { ?>
								<a class="dropdown-item" href="#"><input type="checkbox" checked  onclick="toggleAllColumns(this)" class="TOGGLE_BTN">Toggle All</a>
								<a class="dropdown-item" href="#"><input type="checkbox" checked  onclick="toggleColumns(this, 'BASIC_COL')" class="ATTRIBUTE_BTN">BASIC</a>
								<a class="dropdown-item" href="#"><input type="checkbox" checked  onclick="toggleColumns(this, 'SP_COL')" class="ATTRIBUTE_BTN">SP</a>
								<a class="dropdown-item" href="#"><input type="checkbox" checked  onclick="toggleColumns(this, 'PP_COL')" class="ATTRIBUTE_BTN">PP</a>
								<a class="dropdown-item" href="#"><input type="checkbox" checked  onclick="toggleColumns(this, 'CCA_COL')" class="ATTRIBUTE_BTN">CCA</a>
								<a class="dropdown-item" href="#"><input type="checkbox" checked  onclick="toggleColumns(this, 'HRA_COL')" class="ATTRIBUTE_BTN">HRA</a>
								<a class="dropdown-item" href="#"><input type="checkbox" checked  onclick="toggleColumns(this, 'DA_COL')" class="ATTRIBUTE_BTN">DA</a>
								<a class="dropdown-item" href="#"><input type="checkbox" checked  onclick="toggleColumns(this, 'TA_COL')" class="ATTRIBUTE_BTN">TA</a>
								<a class="dropdown-item" href="#"><input type="checkbox" checked  onclick="toggleColumns(this, 'WA_COL')" class="ATTRIBUTE_BTN">WA</a>
								<a class="dropdown-item" href="#"><input type="checkbox" checked  onclick="toggleColumns(this, 'IT_COL')" class="ATTRIBUTE_BTN">IT</a>
								<a class="dropdown-item" href="#"><input type="checkbox" checked  onclick="toggleColumns(this, 'CGHS_COL')" class="ATTRIBUTE_BTN">CGHS</a>
								<a class="dropdown-item" href="#"><input type="checkbox" checked  onclick="toggleColumns(this, 'LF_COL')" class="ATTRIBUTE_BTN">LF</a>
								<a class="dropdown-item" href="#"><input type="checkbox" checked  onclick="toggleColumns(this, 'CGEGIS_COL')" class="ATTRIBUTE_BTN">CGEGIS</a>
								<a class="dropdown-item" href="#"><input type="checkbox" checked  onclick="toggleColumns(this, 'CPF_TIER_I_COL')" class="ATTRIBUTE_BTN">GPFC/CPF TIER I</a>
								<a class="dropdown-item" href="#"><input type="checkbox" checked  onclick="toggleColumns(this, 'CPF_TIER_II_COL')" class="ATTRIBUTE_BTN">GPFR / CPF TIER II</a>
								<a class="dropdown-item" href="#"><input type="checkbox" checked  onclick="toggleColumns(this, 'MISC_COL')" class="ATTRIBUTE_BTN">MISC</a>
								<a class="dropdown-item" href="#"><input type="checkbox" checked  onclick="toggleColumns(this, 'PLI_COL')" class="ATTRIBUTE_BTN">PLI</a>
								<a class="dropdown-item" href="#"><input type="checkbox" checked  onclick="toggleColumns(this, 'COURT_COL')" class="ATTRIBUTE_BTN">COURT</a>
								<a class="dropdown-item" href="#"><input type="checkbox" checked  onclick="toggleColumns(this, 'PT_COL')" class="ATTRIBUTE_BTN">PT</a>
								<a class="dropdown-item" href="#"><input type="checkbox" checked  onclick="toggleColumns(this, 'CCS_COL')" class="ATTRIBUTE_BTN">CCS</a>
								<a class="dropdown-item" href="#"><input type="checkbox" checked  onclick="toggleColumns(this, 'LIC_COL')" class="ATTRIBUTE_BTN">LIC</a>
								<a class="dropdown-item" href="#"><input type="checkbox" checked  onclick="toggleColumns(this, 'ASSOSC_SUB_COL')" class="ATTRIBUTE_BTN">ASSOSC SUB.</a>
								<a class="dropdown-item" href="#"><input type="checkbox" checked  onclick="toggleColumns(this, 'JAYAMAHAL_COL')" class="ATTRIBUTE_BTN">JAYAMAHAL</a>
								<a class="dropdown-item" href="#"><input type="checkbox" checked  onclick="toggleColumns(this, 'MADIWALA_COL')" class="ATTRIBUTE_BTN">MADIWALA</a>
								<a class="dropdown-item" href="#"><input type="checkbox" checked  onclick="toggleColumns(this, 'HBA_COL')" class="ATTRIBUTE_BTN">HBA</a>
								<a class="dropdown-item" href="#"><input type="checkbox" checked  onclick="toggleColumns(this, 'MCA_COL')" class="ATTRIBUTE_BTN">MCA</a>
								<a class="dropdown-item" href="#"><input type="checkbox" checked  onclick="toggleColumns(this, 'COMP_COL')" class="ATTRIBUTE_BTN">COMP</a>
								<?php } ?>
								<?php if($bill->IS_DA_ARREAR_BILL) { ?>
								<a class="dropdown-item" href="#"><input type="checkbox" checked  onclick="toggleAllColumns(this)" class="TOGGLE_BTN">Toggle All</a>
								<a class="dropdown-item" href="#"><input type="checkbox" checked  onclick="toggleColumns(this, 'DA_COL')" class="ATTRIBUTE_BTN">DA</a>
								<a class="dropdown-item" href="#"><input type="checkbox" checked  onclick="toggleColumns(this, 'TA_COL')" class="ATTRIBUTE_BTN">TA</a>
									<?php if($bill->IS_NPS_DA_ARREAR_BILL) { ?>
									<a class="dropdown-item" href="#"><input type="checkbox" checked  onclick="toggleColumns(this, 'CPF_TIER_I_COL')" class="ATTRIBUTE_BTN">CPF TIER I</a>
									<?php } ?>
								<?php } ?>
								<?php if($bill->IS_BONUS_BILL) { ?>
								<a class="dropdown-item" href="#"><input type="checkbox" checked  onclick="toggleColumns(this, 'BONUS_COL')" class="ATTRIBUTE_BTN">BONUS</a>
								<?php } ?>
								<?php if($bill->IS_UA_BILL) { ?>
								<a class="dropdown-item" href="#"><input type="checkbox" checked  onclick="toggleColumns(this, 'UA_COL')" class="ATTRIBUTE_BTN">Uniform Allowance</a>
								<?php } ?>
								<?php if($bill->IS_CEA_BILL) { ?>
								<a class="dropdown-item" href="#"><input type="checkbox" checked  onclick="toggleColumns(this, 'CEA_COL')" class="ATTRIBUTE_BTN">CEA</a>
								<?php } ?>
								<?php if($bill->IS_LTC_ADVANCE_BILL) { ?>
								<a class="dropdown-item" href="#"><input type="checkbox" checked  onclick="toggleColumns(this, 'HTC_LTC_ADV_COL')" class="ATTRIBUTE_BTN">HTC/LTC ADVANCE</a>
								<?php } ?>
								<?php if($bill->IS_LTC_CLAIM_BILL) { ?>
								<a class="dropdown-item" href="#"><input type="checkbox" checked  onclick="toggleAllColumns(this)" class="TOGGLE_BTN">Toggle All</a>
								<a class="dropdown-item" href="#"><input type="checkbox" checked  onclick="toggleColumns(this, 'GROSS_CLAIM_COL')" class="ATTRIBUTE_BTN">GROSS CLAIM</a>
								<a class="dropdown-item" href="#"><input type="checkbox" checked  onclick="toggleColumns(this, 'ADVANCE_COL')" class="ATTRIBUTE_BTN">ADVANCE</a>
								<a class="dropdown-item" href="#"><input type="checkbox" checked  onclick="toggleColumns(this, 'NET_AMOUNT_COL')" class="ATTRIBUTE_BTN">NET AMOUNT</a>
								<?php } ?>
								<?php if($bill->IS_EL_ENCASHMENT_BILL) { ?>
								<a class="dropdown-item" href="#"><input type="checkbox" checked  onclick="toggleColumns(this, 'EL_ENCASH_COL')" class="ATTRIBUTE_BTN">EL ENCASHMENT</a>
								<?php } ?>
								<?php if($bill->IS_RECOVERY_BILL) { ?>
								<a class="dropdown-item" href="#"><input type="checkbox" checked  onclick="toggleColumns(this, 'RECOVERY_COL')" class="ATTRIBUTE_BTN">RECOVERY</a>
								<?php } ?>
							
						</div>
					</div>
				</div>
			</div>
			<?php
			$employees = array();
			if($bill->IS_SALARY_HEAD_PAY_BILL){ 
			?>
				<input type="hidden" name="SalaryDetails[IS_SALARY_BILL]" value="1"/>
				<?php
				if($bill->IS_OPS_PAY_BILL){
					if(SalaryDetails::model()->exists('BILL_ID_FK='.$model->ID)){
						$salaries = SalaryDetails::model()->findAllByAttributes(array('BILL_ID_FK'=>$model->ID));
						$salaryBillEmployees = array();foreach($salaries as $salary){array_push($salaryBillEmployees, $salary->EMPLOYEE_ID_FK);}
						$criteria=new CDbCriteria;
						$criteria->compare("PENSION_TYPE",'OPS');
						$criteria->addInCondition('ID', $salaryBillEmployees);
						$employees = Employee::model()->ByDesignation()->findAll($criteria);
					}
					else{
						$employees = Employee::model()->ByDesignation()->findAllByAttributes(array('PENSION_TYPE'=>'OPS', 'IS_TRANSFERRED'=>0, 'IS_RETIRED'=>0, 'IS_PERMANENT'=>1, 'IS_SUSPENDED'=>0));
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
						$employees = Employee::model()->ByDesignation()->findAll($criteria);
					}
					else{
						$employees = Employee::model()->ByDesignation()->findAllByAttributes(array('PENSION_TYPE'=>'NPS', 'IS_TRANSFERRED'=>0, 'IS_RETIRED'=>0, 'IS_PERMANENT'=>1, 'IS_SUSPENDED'=>0));
					}
					$DATA_URL = Yii::app()->createUrl('Employee/NPSSalaryBillEmployees');
				}
			}
			if($bill->IS_WAGES_HEAD_PAY_BILL){
				$OtherBillEmployees = explode(",", OtherBillEmployees::model()->findByAttributes(array('BILL_ID'=>$model->ID))->EMPLOYEE_ID);
				$employees = Employee::model()->ByDesignation()->findAllByAttributes(array('ID'=>$OtherBillEmployees));
				$DATA_URL = Yii::app()->createUrl('Employee/WagesBillEmployees', array('BILL_ID'=>$model->ID));
				?>
				<input type="hidden" name="SalaryDetails[IS_SALARY_BILL]" value="1"/>
				<?php
			}
			if($bill->IS_SALARY_HEAD_OTHER_BILL || $bill->IS_WAGES_HEAD_OTHER_BILL){ 
				$OtherBillEmployees = explode(",", OtherBillEmployees::model()->findByAttributes(array('BILL_ID'=>$model->ID))->EMPLOYEE_ID);
				$employees = Employee::model()->ByDesignation()->findAllByAttributes(array('ID'=>$OtherBillEmployees));
				$DATA_URL = Yii::app()->createUrl('Employee/OtherBillEmployees', array('BILL_ID'=>$model->ID));
				?>
				<input type="hidden" name="SalaryDetails[IS_SALARY_BILL]" value="0"/>
				<?php
			}?>
			<input type="hidden" value="<?php echo $bill->ID?>" name="SalaryInfo[BILL_ID]">
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
			<div id="table-container">
				<table class="stripe row-border order-column display table table-striped table-bordered" id="data-table" style="margin-bottom: 10px;">
					<thead>
						<th>NAME</th>
						<th>DESIGNATION</th>
						<th>MONTH</th>
						<?php if($bill->IS_SALARY_HEAD_PAY_BILL || $bill->IS_WAGES_HEAD_PAY_BILL || $bill->IS_ARREAR_BILL) { ?>
						<th></th>
						<th class="BASIC_COL COL_ELEMENT">BASIC</th>
						<th class="SP_COL COL_ELEMENT">SP</th>
						<th class="PP_COL COL_ELEMENT">PP</th>
						<th class="CCA_COL COL_ELEMENT">CCA</th>
						<th class="HRA_COL COL_ELEMENT">HRA</th>
						<th class="DA_COL COL_ELEMENT">DA</th>
						<th class="TA_COL COL_ELEMENT">TA</th>
						<th class="WA_COL COL_ELEMENT">WA</th>
						<th class="IT_COL COL_ELEMENT">IT</th>
						<th class="CGHS_COL COL_ELEMENT">CGHS</th>
						<th class="LF_COL COL_ELEMENT">LF</th>
						<th class="CGEGIS_COL COL_ELEMENT">CGEGIS</th>
						<th class="CPF_TIER_I_COL COL_ELEMENT">GPFC/CPF TIER I</th>
						<th class="CPF_TIER_II_COL COL_ELEMENT">GPFR / CPF TIER II</th>
						<th class="MISC_COL COL_ELEMENT">MISC</th>
						<th class="PLI_COL COL_ELEMENT">PLI</th>
						<th class="COURT_COL COL_ELEMENT">COURT</th>
						<th class="PT_COL COL_ELEMENT">PT</th>
						<th class="CCS_COL COL_ELEMENT">CCS</th>
						<th class="LIC_COL COL_ELEMENT">LIC</th>
						<th class="ASSOSC_SUB_COL COL_ELEMENT">ASSOSC SUB.</th>
						<th class="JAYAMAHAL_COL COL_ELEMENT">JAYAMAHAL</th>
						<th class="MADIWALA_COL COL_ELEMENT">MADIWALA</th>
						<th class="HBA_COL COL_ELEMENT">HBA TYPE</th>
						<th class="HBA_COL COL_ELEMENT">HBA TOTAL</th>
						<th class="HBA_COL COL_ELEMENT">HBA INSTALLMENT</th>
						<th class="HBA_COL COL_ELEMENT">HBA EMI</th>
						<th class="HBA_COL COL_ELEMENT">HBA BALANCE</th>
						<th class="MCA_COL COL_ELEMENT">MCA TYPE</th>
						<th class="MCA_COL COL_ELEMENT">MCA TOTAL</th>
						<th class="MCA_COL COL_ELEMENT">MCA INSTALLMENT</th>
						<th class="MCA_COL COL_ELEMENT">MCA EMI</th>
						<th class="MCA_COL COL_ELEMENT">MCA BALANCE</th>
						<th class="COMP_COL COL_ELEMENT">COMP TYPE</th>
						<th class="COMP_COL COL_ELEMENT">COMP TOTAL</th>
						<th class="COMP_COL COL_ELEMENT">COMP INSTALLMENT</th>
						<th class="COMP_COL COL_ELEMENT">COMP EMI</th>
						<th class="COMP_COL COL_ELEMENT">COMP BALANCE</th>
						<th>GROSS</th>
						<th>DED</th>
						<th>NET</th>
						<th>OTHER DED</th>
						<th>AMOUNT BANK</th>
						<th>REMARKS</th>
						<?php } ?>
						<?php if($bill->IS_DA_ARREAR_BILL) { ?>
						<th class="DA_COL COL_ELEMENT">DA</th>
						<th class="TA_COL COL_ELEMENT">TA</th>
							<?php if($bill->IS_NPS_DA_ARREAR_BILL) { ?>
							<th class="CPF_TIER_I_COL COL_ELEMENT">CPF TIER I</th>
							<?php } ?>
						<th>GROSS</th>
						<th>DED</th>
						<th>NET</th>
						<th>OTHER DED</th>
						<th>AMOUNT BANK</th>
						<th>REMARKS</th>
						<?php } ?>
						<?php if($bill->IS_BONUS_BILL) { ?>
						<th class="BONUS_COL COL_ELEMENT">BONUS</th>
						<th>GROSS</th>
						<th>DED</th>
						<th>NET</th>
						<th>OTHER DED</th>
						<th>AMOUNT BANK</th>
						<th>REMARKS</th>
						<?php } ?>
						<?php if($bill->IS_UA_BILL) { ?>
						<th class="UA_COL COL_ELEMENT">Uniform Allowance</th>
						<th>GROSS</th>
						<th>DED</th>
						<th>NET</th>
						<th>OTHER DED</th>
						<th>AMOUNT BANK</th>
						<th>REMARKS</th>
						<?php } ?>
						<?php if($bill->IS_CEA_BILL) { ?>
						<th class="CEA_COL COL_ELEMENT">CEA (Tuition)</th>
						<th class="CEA_COL COL_ELEMENT">CEA (Other)</th>
						<th class="CEA_COL COL_ELEMENT">CEA (Total)</th>
						<th>GROSS</th>
						<th>DED</th>
						<th>NET</th>
						<th>OTHER DED</th>
						<th>AMOUNT BANK</th>
						<th>REMARKS</th>
						<?php } ?>
						<?php if($bill->IS_LTC_ADVANCE_BILL) { ?>
						<th class="HTC_LTC_ADV_COL COL_ELEMENT">HTC/LTC ADVANCE</th>
						<th>GROSS</th>
						<th>DED</th>
						<th>NET</th>
						<th>OTHER DED</th>
						<th>AMOUNT BANK</th>
						<th>REMARKS</th>
						<?php } ?>
						<?php if($bill->IS_LTC_CLAIM_BILL) { ?>
						<th class="GROSS_CLAIM_COL COL_ELEMENT">GROSS CLAIM</th>
						<th class="ADVANCE_COL COL_ELEMENT">ADVANCE</th>
						<th class="NET_AMOUNT_COL COL_ELEMENT">NET AMOUNT</th>
						<th>GROSS</th>
						<th>DED</th>
						<th>NET</th>
						<th>OTHER DED</th>
						<th>AMOUNT BANK</th>
						<th>REMARKS</th>
						<?php } ?>
						<?php if($bill->IS_EL_ENCASHMENT_BILL) { ?>
						<th class="EL_ENCASH_COL COL_ELEMENT">EL ENCASHMENT</th>
						<th>GROSS</th>
						<th>DED</th>
						<th>NET</th>
						<th>OTHER DED</th>
						<th>AMOUNT BANK</th>
						<th>REMARKS</th>
						<?php } ?>
						<?php if($bill->IS_RECOVERY_BILL) { ?>
						<th class="RECOVERY_COL COL_ELEMENT">RECOVERY</th>
						<th>GROSS</th>
						<th>DED</th>
						<th>NET</th>
						<th>OTHER DED</th>
						<th>AMOUNT BANK</th>
						<th>REMARKS</th>
						<?php } ?>
					</thead>
					<tbody>
						<?php foreach($employees as $employee){ ?>
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
										
									<tr id="<?php echo $employee->ID."-".$month."-".$year;?>">
										<td>
											<input type="hidden" value="<?php echo $employee->ID?>" id="employee-id" name="SalaryDetails[<?php echo $employee->ID?>][EMP_ID]">
											<input type="hidden" value="<?php echo Employee::model()->findByPK($employee->ID)->PENSION_TYPE?>" id="PENSION_TYPE" name="SalaryDetails[<?php echo $employee->ID?>][PENSION_TYPE]">
											<input type="hidden" value="<?php echo HRASlabs::model()->findByPK($employee->HRA_SLAB_ID_FK)->RATE;?>" id="HRA_RATE">
											<input type="hidden" value="<?php echo $employee->IS_QUARTER_ALLOCATED?>" id="QURTER_ALLOCATED">
											<?php echo $employee->NAME?>
										</td>
										<td><?php echo Designations::model()->findByPK($employee->DESIGNATION_ID_FK)->ABBREVIATIONS?></td>
										<td><b><?php echo $period['FORMAT']?></b></td>
										<?php  if($bill->IS_SALARY_HEAD_PAY_BILL || $bill->IS_WAGES_HEAD_PAY_BILL || $bill->IS_ARREAR_BILL) { ?>
											<td>
												<input type="hidden" name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][MONTH]" value="<?php echo $month?>"/>
												<input type="hidden" name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][YEAR]" value="<?php echo $year?>"/>
												<input type="hidden" id="PENSION_TYPE" value="<?php echo $employee->PENSION_TYPE;?>"/>
												<a href="javascript:void(0);" onclick="openForm16(<?php echo $employee->ID?>);" class="fa fa-table" title="Provisional Form-16" style="color: #000;text-decoration: none;"></a>
											</td>
											<td class="BASIC_COL COL_ELEMENT"><input type="text" size="10" name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][BASIC]" data-type="BASIC" class="gross-inc-amount basic-amount" value="<?php echo $salary->BASIC ? $salary->BASIC : 0;?>" placeholder="BASIC"/></td>
											<td class="SP_COL COL_ELEMENT"><input type="text" size="10" name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][SP]" data-type="SP" class="gross-inc-amount" value="<?php echo $salary->SP ? $salary->SP : 0;?>" placeholder="SP"/></td>
											<td class="PP_COL COL_ELEMENT"><input type="text" size="10" name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][PP]" data-type="PP" class="gross-inc-amount" value="<?php echo $salary->PP ? $salary->PP : 0;?>" placeholder="PP"/></td>
											<td class="CCA_COL COL_ELEMENT"><input type="text" size="10" name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][CCA]" data-type="CCA" class="gross-inc-amount" value="<?php echo $salary->CCA ? $salary->CCA : 0;?>" placeholder="CCA"/></td>
											<td class="HRA_COL COL_ELEMENT"><input type="text" size="10" name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][HRA]" data-type="HRA" class="gross-inc-amount hra-amount" value="<?php echo $salary->HRA ? $salary->HRA : 0;?>" placeholder="HRA"/></td>
											<td class="DA_COL COL_ELEMENT"><input type="text" size="10" name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][DA]" data-type="DA" class="gross-inc-amount da-amount" value="<?php echo $salary->DA ? $salary->DA : 0;?>" placeholder="DA"/></td>
											<td class="TA_COL COL_ELEMENT"><input type="text" size="10" name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][TA]" data-type="TA" class="gross-inc-amount ta-amount" value="<?php echo $salary->TA ? $salary->TA : 0;?>" placeholder="TA"/></td>
											<td class="WA_COL COL_ELEMENT"><input type="text" size="10" name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][WA]" data-type="WA" class="gross-inc-amount" value="<?php echo $salary->WA ? $salary->WA : 0;?>" placeholder="WA"/></td>
											<td class="IT_COL COL_ELEMENT"><input type="text" size="10" name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][IT]" data-type="IT" class="ded-inc-amount" value="<?php echo $salary->IT ? $salary->IT : 0;?>" placeholder="IT"/></td>
											<td class="CGHS_COL COL_ELEMENT"><input type="text" size="10" name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][CGHS]" data-type="CGHS" class="ded-inc-amount" value="<?php echo $salary->CGHS ? $salary->CGHS : 0;?>" placeholder="CGHS"/></td>
											<td class="LF_COL COL_ELEMENT"><input type="text" size="10" name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][LF]" data-type="LF" class="ded-inc-amount" value="<?php echo $salary->LF ? $salary->LF : 0;?>" placeholder="LF"/></td>
											<td class="CGEGIS_COL COL_ELEMENT"><input type="text" size="10" name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][CGEGIS]" data-type="CGEGIS" class="ded-inc-amount" value="<?php echo $salary->CGEGIS ? $salary->CGEGIS : 0;?>" placeholder="CGEGIS"/></td>
											<td class="CPF_TIER_I_COL COL_ELEMENT"><input type="text" size="10" name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][CPF_TIER_I]" data-type="CPF_TIER_I" class="ded-inc-amount  cpf-1-amount" value="<?php echo $salary->CPF_TIER_I ? $salary->CPF_TIER_I : 0;?>" placeholder="<?php echo ( $employee->PENSION_TYPE == 'OPS' ) ? "GPFC" : "CPF TIER I"; ?>"/></td>
											<td class="CPF_TIER_II_COL COL_ELEMENT"><input type="text" size="10" name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][CPF_TIER_II]" data-type="CPF_TIER_II" class="ded-inc-amount" value="<?php echo $salary->CPF_TIER_II ? $salary->CPF_TIER_II : 0;?>" placeholder="<?php echo ( $employee->PENSION_TYPE == 'OPS' ) ? "GPFR" : "CPF TIER II"; ?>"/></td>
											<td class="MISC_COL COL_ELEMENT"><input type="text" size="10" name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][MISC]" data-type="MISC" class="ded-inc-amount" value="<?php echo $salary->MISC ? $salary->MISC : 0;?>" placeholder="MISC"/></td>
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
											<td class="PLI_COL COL_ELEMENT"><input type="text" size="10" name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][PLI]" data-type="PLI" class="ded-inc-amount" value="<?php echo $pli;?>" placeholder="PLI"/></td>
											<td class="COURT_COL COL_ELEMENT"><input type="text" size="10" name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][COURT_ATTACHMENT]" data-type="COURT_ATTACHMENT" class="ded-inc-amount" value="<?php echo $salary->COURT_ATTACHMENT ? $salary->COURT_ATTACHMENT : 0;?>" placeholder="COURT ATTACHMENT"/></td>
											<td class="PT_COL COL_ELEMENT"><input type="text" size="10" name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][PT]" data-type="PT" class="pt-ded-inc-amount" value="<?php echo $salary->PT ? $salary->PT : 0;?>" placeholder="PT"/></td>
											<td class="CCS_COL COL_ELEMENT"><input type="text" size="10" name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][CCS]" data-type="CCS" class="other-ded-inc-amount" value="<?php echo $salary->CCS ? $salary->CCS : 0;?>" placeholder="CCS"/></td>
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
											<td class="LIC_COL COL_ELEMENT"><input type="text" size="10" name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][LIC]" data-type="LIC" class="other-ded-inc-amount" value="<?php echo $lic;?>" placeholder="LIC"/></td>
											<td class="ASSOSC_SUB_COL COL_ELEMENT"><input type="text" size="10" name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][ASSOSC_SUB]" data-type="ASSOSC_SUB" class="other-ded-inc-amount" value="<?php echo $salary->ASSOSC_SUB ? $salary->ASSOSC_SUB : 0;?>" placeholder="ASSOSC SUB"/></td>
											<td class="JAYAMAHAL_COL COL_ELEMENT"><input type="text" size="10" name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][MAINT_JAYAMAHAL]" data-type="MAINT_JAYAMAHAL" class="other-ded-inc-amount" value="<?php echo $salary->MAINT_JAYAMAHAL ? $salary->MAINT_JAYAMAHAL : 0;?>" placeholder="MAINT. JAYAMAHAL"/></td>
											<td class="MADIWALA_COL COL_ELEMENT"><input type="text" size="10" name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][MAINT_MADIWALA]" data-type="MAINT_MADIWALA" class="other-ded-inc-amount" value="<?php echo $salary->MAINT_MADIWALA ? $salary->MAINT_MADIWALA : 0;?>" placeholder="MAINT. MADIWALA"/></td>				
											<td class="HBA_COL COL_ELEMENT">
												<select name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month?>][IS_HBA_RECOVERY]" >
													<option value="0" <?php echo ($salary->IS_HBA_RECOVERY && ($salary->IS_HBA_RECOVERY == 0)) ? "selected" : "";?>>PRINCIPAL</option>
													<option value="1" <?php echo ($salary->IS_HBA_RECOVERY && ($salary->IS_HBA_RECOVERY == 1)) ? "selected" : "";?>>INTEREST</option>
												</select>
											</td>
											<td class="HBA_COL COL_ELEMENT"><input type="text" size="10" name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][HBA_TOTAL]" data-type="HBA_TOTAL" value="<?php echo $salary->HBA_TOTAL ? $salary->HBA_TOTAL : 0;?>" placeholder="TOTAL" class="hba-total"/></td>
											<td class="HBA_COL COL_ELEMENT"><input type="text" size="10" name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][HBA_INST]" data-type="HBA_INST" value="<?php echo $salary->HBA_INST ? $salary->HBA_INST : 0;?>" placeholder="INSTALLMENT" class="increment-field hba-inst"/></td>
											<td class="HBA_COL COL_ELEMENT"><input type="text" size="10" name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][HBA_EMI]" data-type="HBA_EMI" class="ded-inc-amount hba-emi" value="<?php echo $salary->HBA_EMI ? $salary->HBA_EMI : 0;?>" placeholder="EMI"/></td>
											<td class="HBA_COL COL_ELEMENT"><input type="text" size="10" name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][HBA_BAL]" data-type="HBA_BAL" value="<?php echo $salary->HBA_BAL ? $salary->HBA_BAL : 0;?>" placeholder="BALANCE" class="hba-bal non-populated-field"/></td>
											<td class="MCA_COL COL_ELEMENT">
												<select name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month?>][IS_MCA_RECOVERY]" >
													<option value="0" <?php echo ($salary->IS_MCA_RECOVERY == 0) ? "selected" : "";?>>PRINCIPAL</option>
													<option value="1" <?php echo ($salary->IS_MCA_RECOVERY == 1) ? "selected" : "";?>>INTEREST</option>
												</select>
											</td>
											<td class="MCA_COL COL_ELEMENT"><input type="text" size="10" name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][MCA_TOTAL]" data-type="MCA_TOTAL" value="<?php echo $salary->MCA_TOTAL ? $salary->MCA_TOTAL : 0;?>" placeholder="TOTAL" class="mca-total"/></td>
											<td class="MCA_COL COL_ELEMENT"><input type="text" size="10" name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][MCA_INST]" data-type="MCA_INST" value="<?php echo $salary->MCA_INST ? $salary->MCA_INST : 0;?>" placeholder="INSTALLMENT" class="increment-field mca-inst"/></td>
											<td class="MCA_COL COL_ELEMENT"><input type="text" size="10" name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][MCA_EMI]" data-type="MCA_EMI" class="ded-inc-amount mca-emi" value="<?php echo $salary->MCA_EMI ? $salary->MCA_EMI : 0;?>" placeholder="EMI"/></td>
											<td class="MCA_COL COL_ELEMENT"><input type="text" size="10" name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][MCA_BAL]" data-type="MCA_BAL" value="<?php echo $salary->MCA_BAL ? $salary->MCA_BAL : 0;?>" placeholder="BALANCE" class="mca-bal non-populated-field"/></td>
											<td class="COMP_COL COL_ELEMENT">
												<select name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month?>][IS_COMP_RECOVERY]" >
													<option value="0" <?php echo ($salary->IS_COMP_RECOVERY == 0) ? "selected" : "";?>>PRINCIPAL</option>
													<option value="1" <?php echo ($salary->IS_COMP_RECOVERY == 1) ? "selected" : "";?>>INTEREST</option>
												</select>
											</td>
											<td class="COMP_COL COL_ELEMENT"><input type="text" size="10" name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][COMP_TOTAL]" data-type="COMP_TOTAL" value="<?php echo $salary->COMP_TOTAL ? $salary->COMP_TOTAL : 0;?>" placeholder="TOTAL" class="comp-total"/></td>
											<td class="COMP_COL COL_ELEMENT"><input type="text" size="10" name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][COMP_INST]" data-type="COMP_INST" value="<?php echo $salary->COMP_INST ? $salary->COMP_INST : 0;?>" placeholder="INSTALLMENT" class="increment-field comp-inst"/></td>
											<td class="COMP_COL COL_ELEMENT"><input type="text" size="10" name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][COMP_EMI]" data-type="COMP_EMI" class="ded-inc-amount comp-emi" value="<?php echo $salary->COMP_EMI ? $salary->COMP_EMI : 0;?>" placeholder="EMI"/></td>
											<td class="COMP_COL COL_ELEMENT"><input type="text" size="10" name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][COMP_BAL]" data-type="COMP_BAL" value="<?php echo $salary->COMP_BAL ? $salary->COMP_BAL : 0;?>" placeholder="BALANCE" class="comp-bal non-populated-field"/></td>
											<td><input type="text" size="10" id='gross-components' name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][GROSS]" value="<?php echo $salary->GROSS ? $salary->GROSS : 0;?>" placeholder="GROSS"/></td>
											<td><input type="text" size="10" id='ded-components' name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][DED]" value="<?php echo $salary->DED ? $salary->DED : 0;?>" placeholder="DED"/></td>
											<td><input type="text" size="10" id='net-components' name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][NET]" value="<?php echo $salary->NET ? $salary->NET : 0;?>" placeholder="NET"/></td>
											<td><input type="text" size="10" id='other-ded-components' name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][OTHER_DED]" value="<?php echo $salary->OTHER_DED ? $salary->OTHER_DED : 0;?>" placeholder="OTHER DED"/></td>
											<td><input type="text" size="10" id='credit-component' name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][AMOUNT_BANK]" value="<?php echo $salary->AMOUNT_BANK ? $salary->AMOUNT_BANK : 0;?>" placeholder="AMOUNT BANK"/></td>
											<td><textarea style="width:100%;" name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][REMARKS]" placeholder='REMARKS'><?php echo $salary->REMARKS ? $salary->REMARKS : ""?></textarea></td>
										<?php } ?>
										<?php  if($bill->IS_DA_ARREAR_BILL) { ?>
											<td class="DA_COL COL_ELEMENT">
												<input type="hidden" name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][MONTH]" value="<?php echo $month?>"/>
												<input type="hidden" name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][YEAR]" value="<?php echo $year?>"/>
												<input type="hidden" id="PENSION_TYPE" value="<?php echo $employee->PENSION_TYPE;?>"/>											
												<input type="text" size="10" name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][DA]" data-type="DA" class="gross-inc-amount da-amount" value="<?php echo $salary->DA ? $salary->DA : 0;?>" placeholder="DA"/>
											</td>
											<td class="TA_COL COL_ELEMENT"><input type="text" size="10" name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][TA]" data-type="TA" class="gross-inc-amount" value="<?php echo $salary->TA ? $salary->TA : 0;?>" placeholder="TA"/></td>
											<?php if($employee->PENSION_TYPE == "NPS") {?>
											<td class="CPF_TIER_I_COL COL_ELEMENT"><input type="text" size="10" name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][CPF_TIER_I]" data-type="CPF_TIER_I" class="ded-inc-amount  cpf-1-amount" value="<?php echo $salary->CPF_TIER_I ? $salary->CPF_TIER_I : 0;?>" placeholder="CPF TIER I"/></td>
											<?php } ?>
											<td><input type="text" size="10" id='gross-components' name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][GROSS]" value="<?php echo $salary->GROSS ? $salary->GROSS : 0;?>" placeholder="GROSS"/></td>
											<td><input type="text" size="10" id='ded-components' name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][DED]" value="<?php echo $salary->DED ? $salary->DED : 0;?>" placeholder="DED"/></td>
											<td><input type="text" size="10" id='net-components' name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][NET]" value="<?php echo $salary->NET ? $salary->NET : 0;?>" placeholder="NET"/></td>
											<td><input type="text" size="10" id='other-ded-components' name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][OTHER_DED]" value="<?php echo $salary->OTHER_DED ? $salary->OTHER_DED : 0;?>" placeholder="OTHER DED"/></td>
											<td><input type="text" size="10" id='credit-component' name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][AMOUNT_BANK]" value="<?php echo $salary->AMOUNT_BANK ? $salary->AMOUNT_BANK : 0;?>" placeholder="AMOUNT BANK"/></td>
											<td><textarea style="width:100%;" name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][REMARKS]" placeholder='REMARKS'><?php echo $salary->REMARKS ? $salary->REMARKS : ""?></textarea></td>
										<?php } ?>
										<?php if($bill->IS_BONUS_BILL) {?>
											<td class="BONUS_COL COL_ELEMENT">BONUS: <input type="text" size="10" name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][BONUS]" data-type="BONUS" class="gross-inc-amount" value="<?php echo $salary->BONUS ? $salary->BONUS : 0;?>" placeholder="BONUS"/></td>
											<td>GROSS: <input type="text" size="10" id='gross-components' name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][GROSS]" value="<?php echo $salary->GROSS ? $salary->GROSS : 0;?>" placeholder="GROSS"/></td>
											<td>DED: <input type="text" size="10" id='ded-components' name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][DED]" value="<?php echo $salary->DED ? $salary->DED : 0;?>" placeholder="DED"/></td>
											<td>NET: <input type="text" size="10" id='net-components' name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][NET]" value="<?php echo $salary->NET ? $salary->NET : 0;?>" placeholder="NET"/></td>
											<td>OTHER DED: <input type="text" size="10" id='other-ded-components' name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][OTHER_DED]" value="<?php echo $salary->OTHER_DED ? $salary->OTHER_DED : 0;?>" placeholder="OTHER DED"/></td>
											<td>AMT. BANK: <input type="text" size="10" id='credit-component' name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][AMOUNT_BANK]" value="<?php echo $salary->AMOUNT_BANK ? $salary->AMOUNT_BANK : 0;?>" placeholder="AMOUNT BANK"/></td>
											<td>REMARKS: </td>
											<td><textarea style="width:100%;" name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][REMARKS]" placeholder='REMARKS'><?php echo $salary->REMARKS ? $salary->REMARKS : ""?></textarea></td>
										<?php } ?>
										<?php if($bill->IS_UA_BILL) {?>
											<td class="UA_COL COL_ELEMENT"><input type="text" size="10" name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][UA]" data-type="UA" class="gross-inc-amount" value="<?php echo $salary->UA ? $salary->UA : 0;?>" placeholder="UA"/></td>
											<td><input type="text" size="10" id='gross-components' name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][GROSS]" value="<?php echo $salary->GROSS ? $salary->GROSS : 0;?>" placeholder="GROSS"/></td>
											<td><input type="text" size="10" id='ded-components' name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][DED]" value="<?php echo $salary->DED ? $salary->DED : 0;?>" placeholder="DED"/></td>
											<td><input type="text" size="10" id='net-components' name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][NET]" value="<?php echo $salary->NET ? $salary->NET : 0;?>" placeholder="NET"/></td>
											<td><input type="text" size="10" id='other-ded-components' name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][OTHER_DED]" value="<?php echo $salary->OTHER_DED ? $salary->OTHER_DED : 0;?>" placeholder="OTHER DED"/></td>
											<td><input type="text" size="10" id='credit-component' name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][AMOUNT_BANK]" value="<?php echo $salary->AMOUNT_BANK ? $salary->AMOUNT_BANK : 0;?>" placeholder="AMOUNT BANK"/></td>
											<td><textarea style="width:100%;" name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][REMARKS]" placeholder='REMARKS'><?php echo $salary->REMARKS ? $salary->REMARKS : ""?></textarea></td>
										<?php } ?>
										<?php if($bill->IS_CEA_BILL) {?>
											<td class="CEA_COL COL_ELEMENT"><input type="text" size="10" name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][CEA_TUITION]" data-type="CEA_TUITION" class="cea-tuition-amount" value="<?php echo $salary->CEA_TUITION ? $salary->CEA_TUITION : 0;?>" placeholder="CEA (Tuition)"/></td>
											<td class="CEA_COL COL_ELEMENT"><input type="text" size="10" name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][CEA_OTHER]" data-type="CEA_OTHER" class="cea-other-amount" value="<?php echo $salary->CEA_OTHER ? $salary->CEA_OTHER : 0;?>" placeholder="CEA (Other)"/></td>
											<td class="CEA_COL COL_ELEMENT"><input type="text" size="10" name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][CEA]" data-type="CEA" class="gross-inc-amount cea-total-amount" value="<?php echo $salary->CEA ? $salary->CEA : 0;?>" placeholder="CEA (Total)"/></td>
											<td><input type="text" size="10" id='gross-components' name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][GROSS]" value="<?php echo $salary->GROSS ? $salary->GROSS : 0;?>" placeholder="GROSS"/></td>
											<td><input type="text" size="10" id='ded-components' name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][DED]" value="<?php echo $salary->DED ? $salary->DED : 0;?>" placeholder="DED"/></td>
											<td><input type="text" size="10" id='net-components' name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][NET]" value="<?php echo $salary->NET ? $salary->NET : 0;?>" placeholder="NET"/></td>
											<td><input type="text" size="10" id='other-ded-components' name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][OTHER_DED]" value="<?php echo $salary->OTHER_DED ? $salary->OTHER_DED : 0;?>" placeholder="OTHER DED"/></td>
											<td><input type="text" size="10" id='credit-component' name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][AMOUNT_BANK]" value="<?php echo $salary->AMOUNT_BANK ? $salary->AMOUNT_BANK : 0;?>" placeholder="AMOUNT BANK"/></td>
											<td><textarea style="width:100%;" name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][REMARKS]" placeholder='REMARKS'><?php echo $salary->REMARKS ? $salary->REMARKS : ""?></textarea></td>
										<?php } ?>
										<?php if($bill->IS_LTC_ADVANCE_BILL) {?>
											<td class="HTC_LTC_ADV_COL COL_ELEMENT"><input type="text" size="10" class="gross-inc-amount" name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][LTC_HTC]" data-type="LTC_HTC" value="<?php echo $salary->LTC_HTC ? $salary->LTC_HTC : 0;?>" placeholder="HTC/LTC ADVANCE."/></td>
											<td><input type="text" size="10" id='gross-components' name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][GROSS]" value="<?php echo $salary->GROSS ? $salary->GROSS : 0;?>" placeholder="GROSS"/></td>
											<td><input type="text" size="10" id='ded-components' name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][DED]" value="<?php echo $salary->DED ? $salary->DED : 0;?>" placeholder="DED"/></td>
											<td><input type="text" size="10" id='net-components' name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][NET]" value="<?php echo $salary->NET ? $salary->NET : 0;?>" placeholder="NET"/></td>
											<td><input type="text" size="10" id='other-ded-components' name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][OTHER_DED]" value="<?php echo $salary->OTHER_DED ? $salary->OTHER_DED : 0;?>" placeholder="OTHER DED"/></td>
											<td><input type="text" size="10" id='credit-component' name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][AMOUNT_BANK]" value="<?php echo $salary->AMOUNT_BANK ? $salary->AMOUNT_BANK : 0;?>" placeholder="AMOUNT BANK"/></td>
											<td><textarea style="width:100%;" name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][REMARKS]" placeholder='REMARKS'><?php echo $salary->REMARKS ? $salary->REMARKS : ""?></textarea></td>
										<?php } ?>
										<?php if($bill->IS_LTC_CLAIM_BILL) {?>
											<td class="GROSS_CLAIM_COL COL_ELEMENT"><input type='text' size="10" class="gross-inc-amount" name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][LTC_HTC_GROSS]" data-type="LTC_HTC_GROSS" value='<?php echo $salary->LTC_HTC_GROSS ? $salary->LTC_HTC_GROSS : 0?>' placeholder='GROSS'></td>
											<td class="ADVANCE_COL COL_ELEMENT"><input type='text' size="10" class="ltc-ded-inc-amount" name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][LTC_HTC_ADVANCE]" data-type="LTC_HTC_ADVANCE" value='<?php echo $salary->LTC_HTC_ADVANCE ? $salary->LTC_HTC_ADVANCE : 0?>' placeholder='ADVANCE'></td>
											<td class="NET_AMOUNT_COL COL_ELEMENT"><input type='text' size="10" id="ltc-credit-component" name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][LTC_HTC]" data-type="LTC_HTC" value='<?php echo $salary->LTC_HTC ? $salary->LTC_HTC : 0?>' placeholder='CLAIM AMOUNT'></td>
											<td><input type="text" size="10" id='gross-components' name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][GROSS]" value="<?php echo $salary->GROSS ? $salary->GROSS : 0;?>" placeholder="GROSS"/></td>
											<td><input type="text" size="10" id='ded-components' name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][DED]" value="<?php echo $salary->DED ? $salary->DED : 0;?>" placeholder="DED"/></td>
											<td><input type="text" size="10" id='net-components' name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][NET]" value="<?php echo $salary->NET ? $salary->NET : 0;?>" placeholder="NET"/></td>
											<td><input type="text" size="10" id='other-ded-components' name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][OTHER_DED]" value="<?php echo $salary->OTHER_DED ? $salary->OTHER_DED : 0;?>" placeholder="OTHER DED"/></td>
											<td><input type="text" size="10" id='credit-component' name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][AMOUNT_BANK]" value="<?php echo $salary->AMOUNT_BANK ? $salary->AMOUNT_BANK : 0;?>" placeholder="AMOUNT BANK"/></td>
											<td><textarea style="width:100%;" name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][REMARKS]" placeholder='REMARKS'><?php echo $salary->REMARKS ? $salary->REMARKS : ""?></textarea></td>
										<?php } ?>
										<?php if($bill->IS_EL_ENCASHMENT_BILL) {?>
											<td class="EL_ENCASH_COL COL_ELEMENT"><input type="text" size="10" name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][EL_ENCASHMENT]" data-type="EL_ENCASHMENT" class="gross-inc-amount" value="<?php echo $salary->EL_ENCASHMENT ? $salary->EL_ENCASHMENT : 0;?>" placeholder="EL ENCASHMENT"/></td>
											<td><input type="text" size="10" id='gross-components' name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][GROSS]" value="<?php echo $salary->GROSS ? $salary->GROSS : 0;?>" placeholder="GROSS"/></td>
											<td><input type="text" size="10" id='ded-components' name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][DED]" value="<?php echo $salary->DED ? $salary->DED : 0;?>" placeholder="DED"/></td>
											<td><input type="text" size="10" id='net-components' name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][NET]" value="<?php echo $salary->NET ? $salary->NET : 0;?>" placeholder="NET"/></td>
											<td><input type="text" size="10" id='other-ded-components' name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][OTHER_DED]" value="<?php echo $salary->OTHER_DED ? $salary->OTHER_DED : 0;?>" placeholder="OTHER DED"/></td>
											<td><input type="text" size="10" id='credit-component' name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][AMOUNT_BANK]" value="<?php echo $salary->AMOUNT_BANK ? $salary->AMOUNT_BANK : 0;?>" placeholder="AMOUNT BANK"/></td>
											<td><textarea style="width:100%;" name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][REMARKS]" placeholder='REMARKS'><?php echo $salary->REMARKS ? $salary->REMARKS : ""?></textarea></td>
										<?php } ?>
										<?php if($bill->IS_RECOVERY_BILL) {?>
											<td class="RECOVERY_COL COL_ELEMENT"><input type="text" size="10" name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][RECOVERY]" data-type="RECOVERY" class="gross-inc-amount" value="<?php echo $salary->RECOVERY ? $salary->RECOVERY : 0;?>" placeholder="RECOVERY"/></td>
											<td><input type="text" size="10" id='gross-components' name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][GROSS]" value="<?php echo $salary->GROSS ? $salary->GROSS : 0;?>" placeholder="GROSS"/></td>
											<td><input type="text" size="10" id='ded-components' name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][DED]" value="<?php echo $salary->DED ? $salary->DED : 0;?>" placeholder="DED"/></td>
											<td><input type="text" size="10" id='net-components' name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][NET]" value="<?php echo $salary->NET ? $salary->NET : 0;?>" placeholder="NET"/></td>
											<td><input type="text" size="10" id='other-ded-components' name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][OTHER_DED]" value="<?php echo $salary->OTHER_DED ? $salary->OTHER_DED : 0;?>" placeholder="OTHER DED"/></td>
											<td><input type="text" size="10" id='credit-component' name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][AMOUNT_BANK]" value="<?php echo $salary->AMOUNT_BANK ? $salary->AMOUNT_BANK : 0;?>" placeholder="AMOUNT BANK"/></td>
											<td><textarea style="width:100%;" name="SalaryDetails[<?php echo $employee->ID?>][<?php echo $year;?>][<?php echo $month;?>][REMARKS]" placeholder='REMARKS'><?php echo $salary->REMARKS ? $salary->REMARKS : ""?></textarea></td>
										<?php } ?>
									
									</tr>
									<?php } ?>
									</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
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
	#table-container{
		overflow-x: scroll;
	}
</style>
<script type="text/javascript"> 
	var IS_LTC_HTC_CLAIM_BILL = <?php echo ($bill->IS_LTC_CLAIM_BILL) ? 1 : 0;?>;
	var FORM_16_URL = '<?php echo Yii::app()->createUrl('IncomeTax/Form16', array('type'=>'Dialog'));?>&id=';
	var TABLE_FORMAT = 1;
	var IS_ARREAR_BILL = <?php echo $bill->IS_ARREAR_BILL;?>;
	var IS_CEA_BILL = <?php echo $bill->IS_CEA_BILL;?>;
</script>
<script type="text/javascript" src="js/salary-details.js"></script>
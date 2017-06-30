<!DOCTYPE html>
<html>
<head lang="en">
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>

	<link href="<?php echo Yii::app()->request->baseUrl; ?>/img/favicon.144x144.png" rel="apple-touch-icon" type="image/png" sizes="144x144">
	<link href="<?php echo Yii::app()->request->baseUrl; ?>/img/favicon.114x114.png" rel="apple-touch-icon" type="image/png" sizes="114x114">
	<link href="<?php echo Yii::app()->request->baseUrl; ?>/img/favicon.72x72.png" rel="apple-touch-icon" type="image/png" sizes="72x72">
	<link href="<?php echo Yii::app()->request->baseUrl; ?>/img/favicon.57x57.png" rel="apple-touch-icon" type="image/png">
	<link href="<?php echo Yii::app()->request->baseUrl; ?>/img/favicon.png" rel="icon" type="image/png">
	<link href="<?php echo Yii::app()->request->baseUrl; ?>/img/favicon.ico" rel="shortcut icon">

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
	<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/lib/lobipanel/lobipanel.min.css">
	<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/separate/vendor/lobipanel.min.css">
	<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/lib/jqueryui/jquery-ui.min.css">
	<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/separate/pages/widgets.min.css">
	<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/lib/font-awesome/font-awesome.min.css">
	<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/lib/bootstrap/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css">
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-3.1.1.min.js"></script>
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/moment.min.js"></script>
</head>
<body class="with-side-menu control-panel control-panel-compact">
	<header class="site-header">
	    <div class="container-fluid">
	
	        <a href="#" class="site-logo">
	            <h1></h1>
	            <img class="hidden-lg-up" src="img/logo-2-mob.png" alt="">
	        </a>
	
	        <button id="show-hide-sidebar-toggle" class="show-hide-sidebar">
	            <span>toggle menu</span>
	        </button>
	
	        <button class="hamburger hamburger--htla">
	            <span>toggle menu</span>
	        </button>
	        <div class="site-header-content">
	            <div class="site-header-content-in">
					<span style="margin-top: 5px;display: inline-block;"><?php echo Employee::model()->findByPK(Users::model()->findByPK(Yii::app()->user->ID)->EMPLOYEE_ID)->NAME;?>,&nbsp;&nbsp;<?php echo Designations::model()->findByPK(Employee::model()->findByPK(Users::model()->findByPK(Yii::app()->user->ID)->EMPLOYEE_ID)->DESIGNATION_ID_FK)->DESIGNATION;?>
					</span>
	                <div class="site-header-shown">
	                    <div class="dropdown user-menu">
	                        <button class="dropdown-toggle" id="dd-user-menu" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	                            <img src="img/avatar-sign.png" alt="">
	                        </button>
	                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dd-user-menu">
	                            
	                            <a class="dropdown-item" href="<?php echo Yii::app()->createUrl('Employee/view', array('id'=>Users::model()->findByPK(Yii::app()->user->ID)->EMPLOYEE_ID))?>"><span class="font-icon glyphicon glyphicon-user"></span>Profile</a>
	                            <a class="dropdown-item" href="<?php echo Yii::app()->createUrl('Employee/changePassword', array('id'=>Users::model()->findByPK(Yii::app()->user->ID)->EMPLOYEE_ID))?>"><span class="font-icon glyphicon glyphicon-user"></span>Change Password</a>
	                            <?php if(!Yii::app()->user->isGuest && Yii::app()->user->TYPE == 'ADMINISTRATION'){ ?>
								<a class="dropdown-item" href="<?php echo Yii::app()->createUrl('Master/update', array('id'=>1))?>"><span class="font-icon glyphicon glyphicon-cog"></span>Settings</a>
								<?php } ?>
	                            <div class="dropdown-divider"></div>
	                            <a class="dropdown-item" href="<?php echo Yii::app()->createUrl('site/logout');?>"><span class="font-icon glyphicon glyphicon-log-out"></span>Logout</a>
	                        </div>
	                    </div>
	
	                    <button type="button" class="burger-right">
	                        <i class="font-icon-menu-addl"></i>
	                    </button>
	                </div><!--.site-header-shown-->
	
	                <div class="mobile-menu-right-overlay"></div>
	                <div class="site-header-collapsed">
	                    <div class="site-header-collapsed-in">
	                        <div class="dropdown dropdown-typical">
	                            <div class="dropdown-menu" aria-labelledby="dd-header-sales">
	                                <a class="dropdown-item" href="#"><span class="font-icon font-icon-home"></span>Quant and Verbal</a>
	                                <a class="dropdown-item" href="#"><span class="font-icon font-icon-cart"></span>Real Gmat Test</a>
	                                <a class="dropdown-item" href="#"><span class="font-icon font-icon-speed"></span>Prep Official App</a>
	                                <a class="dropdown-item" href="#"><span class="font-icon font-icon-users"></span>CATprer Test</a>
	                                <a class="dropdown-item" href="#"><span class="font-icon font-icon-comments"></span>Third Party Test</a>
	                            </div>
	                        </div>
	                    </div><!--.site-header-collapsed-in-->
	                </div><!--.site-header-collapsed-->
	            </div><!--site-header-content-in-->
	        </div><!--.site-header-content-->
	    </div><!--.container-fluid-->
	</header>

	<div class="mobile-menu-left-overlay"></div>
	<nav class="side-menu">
		<?php if(!Yii::app()->user->isGuest && Yii::app()->user->TYPE == 'ADMINISTRATION'){ ?>
	    <ul class="side-menu-list">
	        <li class="grey with-sub">
	            <span>
	                <i class="font-icon font-icon-dashboard"></i>
	                <span class="lbl">Bills</span>
	            </span>
	            <ul>
	                <!--<li><a href="index.html"><span class="lbl">Default</span><span class="label label-custom label-pill label-danger">new</span></a></li>-->
	                <li><a href="<?php echo Yii::app()->createUrl('Bill/create');?>"><span class="lbl">Create Bill</span></a></li>
	                <li><a href="<?php echo Yii::app()->createUrl('Bill/admin');?>"><span class="lbl">Manage Bills</span></a></li>
	            </ul>
	        </li>
			<li class="grey with-sub">
	            <span>
	                <i class="font-icon font-icon-dashboard"></i>
	                <span class="lbl">Employees</span>
	            </span>
	            <ul>
	                <li><a href="<?php echo Yii::app()->createUrl('Employee/create');?>"><span class="lbl">Create Employee</span></a></li>
	                <li><a href="<?php echo Yii::app()->createUrl('Employee/admin');?>"><span class="lbl">Manage Employees</span></a></li>
	                <li><a href="<?php echo Yii::app()->createUrl('Investments/showInvestments');?>"><span class="lbl">Manage Employee Investments</span></a></li>
	                <li><a href="<?php echo Yii::app()->createUrl('Employee/generateLPC');?>"><span class="lbl">Last Pay Certificate</span></a></li>
	            </ul>
	        </li>
			<li class="grey with-sub">
	            <span>
	                <i class="font-icon font-icon-dashboard"></i>
	                <span class="lbl">Monthly Reports</span>
	            </span>
	            <ul>
	                <li><a href="<?php echo Yii::app()->createUrl('Expenditure/Monthly');?>"><span class="lbl">Monthly Expenditure</span></a></li>
	                <li><a href="<?php echo Yii::app()->createUrl('Expenditure/Reconciliation');?>" ><span class="lbl">Reconciliation</span></a></li>
	                <li><a href="<?php echo Yii::app()->createUrl('Expenditure/MonthlyDisposition');?>" ><span class="lbl">Monthly Disposition</span></a></li>
	            </ul>
	        </li>
			<li class="grey with-sub">
	            <span>
	                <i class="font-icon font-icon-dashboard"></i>
	                <span class="lbl">Quaterly Reports</span>
	            </span>
	            <ul>
	                <li><a href="<?php echo Yii::app()->createUrl('Expenditure/Quarterly');?>"><span class="lbl">Quarterly Expenditure</span></a></li>
	                <li><a href="<?php echo Yii::app()->createUrl('IncomeTax/Quarterly');?>"><span class="lbl">Quaterly Income Tax</span></a></li>
	                <li><a href="<?php echo Yii::app()->createUrl('HindiReport/Admin');?>"><span class="lbl">Hindi Report</span></a></li>
	            </ul>
	        </li>
			<li class="grey with-sub">
	            <span>
	                <i class="font-icon font-icon-dashboard"></i>
	                <span class="lbl">Yearly Reports</span>
	            </span>
	            <ul>
	                <li><a href="<?php echo Yii::app()->createUrl('IncomeTax/form16');?>" target="_blank"><span class="lbl">Form-16 (Provisional)</span></a></li>
	            </ul>
	        </li>
			<li class="grey with-sub">
	            <span>
	                <i class="font-icon font-icon-dashboard"></i>
	                <span class="lbl">Generic Reports</span>
	            </span>
	            <ul>
	                <li><a href="<?php echo Yii::app()->createUrl('Employee/Generic');?>"><span class="lbl">Employee List</span></a></li>
	            </ul>
	        </li>
			<li class="grey with-sub">
	            <span>
	                <i class="font-icon font-icon-dashboard"></i>
	                <span class="lbl">PAO Expenditure</span>
	            </span>
	            <ul>
	                <li><a href="<?php echo Yii::app()->createUrl('PAOExpenditure/create');?>"><span class="lbl">Add</span></a></li>
	                <li><a href="<?php echo Yii::app()->createUrl('PAOExpenditure/admin');?>"><span class="lbl">Manage</span></a></li>
	            </ul>
	        </li>
			<li class="grey with-sub">
	            <span>
	                <i class="font-icon font-icon-dashboard"></i>
	                <span class="lbl">Appropiation</span>
	            </span>
	            <ul>
	                <li><a href="<?php echo Yii::app()->createUrl('AppropiationRegister/admin');?>"><span class="lbl">Register</span></a></li>
	                <li><a href="<?php echo Yii::app()->createUrl('AppropiationRegister/update');?>"><span class="lbl">Manipulation</span></a></li>
	            </ul>
	        </li>
			<li class="grey with-sub">
	            <span>
	                <i class="font-icon font-icon-dashboard"></i>
	                <span class="lbl">Files</span>
	            </span>
	            <ul>
	                <li><a href="<?php echo Yii::app()->createUrl('Files/create');?>"><span class="lbl">Create</span></a></li>
	                <li><a href="<?php echo Yii::app()->createUrl('Files/admin');?>"><span class="lbl">Manage</span></a></li>
	                <li><a href="<?php echo Yii::app()->createUrl('Files/list');?>" target="_blank"><span class="lbl">List</span></a></li>
					<li><a href="<?php echo Yii::app()->createUrl('Files/SearchFile');?>" ><span class="lbl">Search</span></a></li>
					
	            </ul>
	        </li>
			<li class="grey with-sub">
	            <span>
	                <i class="font-icon font-icon-dashboard"></i>
	                <span class="lbl">Settings</span>
	            </span>
	            <ul>
	                <li><a href="<?php echo Yii::app()->createUrl('Master/update', array('id'=>1));?>"><span class="lbl">Master Settings</span></a></li>
	                <li><a href="<?php echo Yii::app()->createUrl('Vendors/create');?>"><span class="lbl">Add Vendor</span></a></li>
	                <li><a href="<?php echo Yii::app()->createUrl('Vendors/admin');?>"><span class="lbl">Manage Vendors</span></a></li>
	            </ul>
	        </li>
	     </ul>
		<?php } ?>
		<?php if(!Yii::app()->user->isGuest && Yii::app()->user->TYPE == 'EMPLOYEE'){ ?>
	    <ul class="side-menu-list"> 
			<li class="grey with-sub">
	            <span>
	                <i class="font-icon font-icon-dashboard"></i>
	                <span class="lbl">Misc</span>
	            </span>
	            <ul>
	                <li><a href="<?php echo Yii::app()->createUrl('Bill/Payslips', array('id'=>Yii::app()->User->EMPLOYEE_ID));?>" target="_blank"><span class="lbl">Pay Slips </span></a></li>
	            </ul>
	        </li>
		</ul>
		<?php } ?>
	</nav>
	<div class="page-content">
		<?php echo $content; ?>
	</div>
	<div style="position: absolute;bottom: 0;left: 0;right: 0;height: 20px;z-index: 100;background: #00a8ff;color: #FFF;">
		<marquee style="line-height: 10px;font-size: 12px;margin-top: 5px;display: block;">Designed &amp; Developed by Ankit Sharma, Tax Assistant, Yelahanka Service Tax Division</marquee>
	</div>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/lib/jquery/jquery.min.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/lib/tether/tether.min.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/lib/bootstrap/bootstrap.min.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/plugins.js"></script>

<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/lib/jqueryui/jquery-ui.min.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/lib/lobipanel/lobipanel.min.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/lib/match-height/jquery.matchHeight.min.js"></script>

<script>
	$(document).ready(function() {
		$('.panel').lobiPanel({
			sortable: true
		});
		$('.panel').on('dragged.lobiPanel', function(ev, lobiPanel){
			$('.dahsboard-column').matchHeight();
		});

	});
</script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/app.js"></script>

</body>
</html>

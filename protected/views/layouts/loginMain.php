<?php /* @var $this Controller */ ?>
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
	<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/separate/pages/login.min.css">
    <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/lib/font-awesome/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/lib/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css">
</head>

<body>
<?php echo $content; ?>

<div style="position: absolute;bottom: 0;left: 0;right: 0;height: 20px;z-index: 100;background: #00a8ff;color: #FFF;">
	<marquee style="line-height: 10px;font-size: 12px;margin-top: 5px;display: block;">Designed &amp; Developed by Ankit Sharma, Tax Assistant, Central Tax HQRS, Bangalore North Commissionerate</marquee>
</div>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/lib/jquery/jquery.min.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/lib/tether/tether.min.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/lib/bootstrap/bootstrap.min.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/plugins.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/lib/match-height/jquery.matchHeight.min.js"></script>
<script>
	$(function() {
		$('.page-center').matchHeight({
			target: $('html')
		});

		$(window).resize(function(){
			setTimeout(function(){
				$('.page-center').matchHeight({ remove: true });
				$('.page-center').matchHeight({
					target: $('html')
				});
			},100);
		});
	});
</script>
<script src="js/app.js"></script>
</body>
</html>

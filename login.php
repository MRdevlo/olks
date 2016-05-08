<?php

require($_SERVER["DOCUMENT_ROOT"] . "config.php");
    if ($config["install"] == true)
    {
    header("Location: install/index.php");
    }
require_once(__DIR__."/config.php");
require_once(__DIR__."/assets/lang/".$config["lang"].".php");
require_once(__DIR__."/assets/class/biuld.php");
require_once(__DIR__."/assets/class/function.php");
$biuld = new biuld();
$func = new func();
if (isset($_POST["inputUser"]) and isset($_POST["inputPassword"])){
$redirect = $_POST["redirect"];
$res = $func->login($_POST["inputUser"], $_POST["inputPassword"]);
if ($res == true){
header("Location: " . $redirect);
} else {
header("Location: login.php?redirect=" . $redirect . "&res=0&ertext=" . urlencode("Falsches Passwort"));
} 
}
$biuld->printerror();
echo '<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Forms</title>

<link href="assets/css/bootstrap.min.css" rel="stylesheet">
<link href="assets/css/datepicker3.css" rel="stylesheet">
<link href="assets/css/styles.css" rel="stylesheet">

<!--[if lt IE 9]>
<script src="assets/js/html5shiv.js"></script>
<script src="assets/js/respond.min.js"></script>
<![endif]-->

</head>

<body>
	
	<div class="row">
		<div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
			<div class="login-panel panel panel-default">
				<div class="panel-heading">' . $l['HEADER_LOGIN'] . '</div>
				<div class="panel-body">
					<form role="form" action="login.php"  method="post">
					<input type="hidden" name="redirect" value="' . $_GET["redirect"] . '">
						<fieldset>
							<div class="form-group">
								<input class="form-control" placeholder="' . $l['LABEL_USER'] . '" name="inputUser" type="text" autofocus="">
							</div>
							<div class="form-group">
								<input class="form-control" placeholder="' . $l['LABEL_PASSWORD'] . '" name="inputPassword" type="password" value="">
							</div>
							<button type="submit" class="btn btn-primary">' . $l['BUTTON_LOGIN'] . '</button>
						</fieldset>
					</form>
				</div>
			</div>
		</div><!-- /.col-->
	</div><!-- /.row -->	

';
    ?>
    	<script src="assets/js/jquery-1.11.1.min.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>
	<script src="assets/js/chart.min.js"></script>
	<script src="assets/js/chart-data.js"></script>
	<script src="assets/js/easypiechart.js"></script>
	<script src="assets/js/easypiechart-data.js"></script>
	<script src="assets/js/bootstrap-datepicker.js"></script>
	<script>
		!function ($) {
			$(document).on("click","ul.nav li.parent > a > span.icon", function(){		  
				$(this).find('em:first').toggleClass("glyphicon-minus");	  
			}); 
			$(".sidebar span.icon").find('em:first').addClass("glyphicon-plus");
		}(window.jQuery);

		$(window).on('resize', function () {
		  if ($(window).width() > 768) $('#sidebar-collapse').collapse('show')
		})
		$(window).on('resize', function () {
		  if ($(window).width() <= 767) $('#sidebar-collapse').collapse('hide')
		})
	</script>	
</body>

</html>
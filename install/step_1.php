<!DOCTYPE html>
<?php
if(!isset($_SESSION))
{session_start();}
require_once(__DIR__."/../assets/lang/".  $_SESSION["lang"]  .".php");
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
      <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php echo $l['INSTALL_TITLE_1']; ?></title>
	<!-- BOOTSTRAP STYLES-->
    <link href="../assets/css/bootstrap.css" rel="stylesheet" />
     <!-- FONTAWESOME STYLES-->
    <link href="../assets/css/font-awesome.css" rel="stylesheet" />
     <!-- MORRIS CHART STYLES-->
    <link href="../assets/js/morris/morris-0.4.3.min.css" rel="stylesheet" />
        <!-- CUSTOM STYLES-->
    <link href="../assets/css/custom.css" rel="stylesheet" />
     <!-- GOOGLE FONTS-->
   <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
</head>  
<body>               
<?php
include($_SERVER["DOCUMENT_ROOT"] . 'config.php');
if ($config["install"] == false) {
header("Location:../index.php");
exit;
}
 $url		= 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];
 
if (isset ($_POST["root_user"]))
{
$_SESSION["root_user"] = $_POST["root_user"];
	$my_user 	= $_SESSION["root_user"];
	
$_SESSION["root_pw"] = $_POST["root_pw"];
	$my_pw 		= $_SESSION["root_pw"];
	 $_SESSION["server"] 	= $_POST["server"];
	 $my_server = $_SESSION["server"];
	$mysqli = new mysqli($my_server, $my_user, $my_pw);
	if ($mysqli->connect_errno) {
		header("Location:" . $url . "?res=" . false . "&text=" . urlencode($l['TEXT_WRONG_PW']));
	} else {
header("Location: step_2.php");
}
} else {
if (isset($_GET['res'])){
        $text = $_GET['text'];
if ($_GET['res'] == true){
echo '<div class="alert alert-success alert-dismissable">
<span class="glyphicon glyphicon-ok-sign" aria-hidden="true"></span>
    
<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                               ' . $text . '
 </div>';
} else {
echo '<div class="alert alert-danger alert-dismissable">
<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
    
<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                               ' . $text . '
 </div>';
}
}
echo '<form action="index.php" method="post" enctype="multipart/form-data">
<div class="col-md-6 col-md-offset-3">
		<div class="panel panel-default">
			<div class="panel-heading">' . $l['PANEL_INSTALL_CHECK'] . '</div>
			<div class="panel-body">
			config.php ';
if (is_writable($_SERVER["DOCUMENT_ROOT"] . "config.php")){
echo '<span class="label label-success">' . $l['SPAN_INSTALL_OK'] . '</span>' ;
} else {
echo '<span class="label label-danger">' . $l['SPAN_INSTALL_ERROR'] . '</span><br>
<p class="text-danger">' . $l['TEXT_INSTALL_CONFIG_NOT_WRITABEL'] . '<pre>cd ' . $_SERVER["DOCUMENT_ROOT"].'
chown www-data:www-data config.php
chmod 660 config.php</pre>' ;
}
echo '
		</div>
	</div>
</div>';
if (is_writable($_SERVER["DOCUMENT_ROOT"] . "config.php")){
echo '	<div class="col-md-6 col-md-offset-3">
		<div class="panel panel-default">
			<div class="panel-heading">' . $l['PANEL_INSTALL_CONFIG'] . '</div>
			<div class="panel-body">
				<div class="form-group">
					<label>' . $l['LABEL_INSTALL_DATABASE_ROOT_USER'] . '</label>
					<input type="text" name="root_user" class="form-control" value="root" autocomplete="off" required />
				</div>
				<div class="form-group">
					<label>' . $l['LABEL_INSTALL_DATABASE_ROOT_PASSWORD'] . '</label>
					<input type="password" name="root_pw" class="form-control" autocomplete="off" required />
				</div>
				<div class="form-group">
					<label>' . $l['LABEL_INSTALL_DATABASE_SERVER'] . '</label>
					<input type="text" name="server" class="form-control" value="localhost" autocomplete="off" required />
				</div>
				</div>
			<div class="panel-footer">
				<button type="submit" class="btn btn-default">' . $l['BUTTON_INSTALL_NEXT'] . '</button>
</form>
		</div>
	</div>
</div>'; 
} 
} 
?>
    <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    <!-- JQUERY SCRIPTS -->
   <script src="../assets/js/jquery-1.10.2.js"></script>
      <!-- BOOTSTRAP SCRIPTS -->
    <script src="../assets/js/bootstrap.min.js"></script>
    <!-- METISMENU SCRIPTS -->
    <script src="../assets/js/jquery.metisMenu.js"></script>
     <!-- DATA TABLE SCRIPTS -->
    <script src="../assets/js/dataTables/jquery.dataTables.js"></script>
    <script src="../assets/js/dataTables/dataTables.bootstrap.js"></script>
         <!-- CUSTOM SCRIPTS -->
     <script src="../assets/js/custom.js"></script>
</body>
</html>

<!DOCTYPE html>
<?php
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
if(!isset($_SESSION))
{session_start();}
 $url		= 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];
 
if (isset($_POST["lang"]))
{
$_SESSION["lang"] = $_POST["lang"];
echo $_SESSION["lang"];
header("Location: step_1.php");
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
echo '<form action="index.php" method="post">
<div class="col-md-6 col-md-offset-3">
		<div class="panel panel-default">
			<div class="panel-heading">Language</div>
			<div class="panel-body">
				<div class="form-group">
					<label>Language</label>
					<select class="form-control" name="lang">
					';
foreach (glob(__DIR__."/../assets/lang/*.php") as $file) {
  echo '<option value="' . basename($file, ".php") . '">' . basename($file, ".php") . '</optipn>';
  
}
					echo'
					</select>
				</div>
				</div>
			<div class="panel-footer">
				<button type="submit" class="btn btn-default">Next</button>
</form>
		</div>
	</div>
</div>'; 
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

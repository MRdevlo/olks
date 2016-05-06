<!DOCTYPE html>
<?php
require_once(__DIR__."/../assets/lang/de.php");
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
include(__DIR__.'/../config.php');
if ($config["install"] == false) {
header("Location:../index.php");
exit;
}
if(!isset($_SESSION))
{session_start();}
if (!isset($_SESSION["root_user"])){
header("Location: index.php");
exit;
}
 $my_user 	= $_SESSION["root_user"];
	$my_pw 		= $_SESSION["root_pw"];
	$server = $_SESSION["server"];
if (isset ($_POST["db_user"]))
{
  $db_user = $_POST["db_user"];
  $db_pw = str_shuffle("abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789");
  $db = $_POST["db"];
  $db_prefix = $_POST["db_prefix"];
  $user = $_POST["user"];
  $pw = password_hash($_POST["pw"], PASSWORD_BCRYPT);
  
  $mysqli = new mysqli($server, $my_user, $my_pw);
	  $abfrage = "CREATE USER '$db_user'@'localhost' IDENTIFIED WITH mysql_native_password;
	  ";
		$abfrage .= "SET PASSWORD FOR '$db_user'@'localhost' = PASSWORD('$db_pw');
		";
		$abfrage .= "CREATE DATABASE IF NOT EXISTS `" . $db . "`;
		";
		$abfrage .= "GRANT ALL PRIVILEGES ON `" . $db . "`.* TO '$db_user'@'localhost';
		";
		
		
  $abfrage .= 
"CREATE TABLE `$db`.`" . $db_prefix . "_hash` (
  `ID` int(11) NOT NULL AUTO_INCREMENT ,
  `hash` varchar(128) NOT NULL,
  `Software_ID` int(11) NOT NULL,
  `Created_Date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP, PRIMARY KEY (`ID`)
) ENGINE=InnoDB ;

CREATE TABLE `$db`.`" . $db_prefix . "_Identifier` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Key_ID` int(11) NOT NULL,
  `Identifier` varchar(128) NOT NULL,
  `Created_Date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP, PRIMARY KEY (`ID`)
) ENGINE=InnoDB ;

CREATE TABLE `$db`.`" . $db_prefix . "_key` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `key` varchar(255) NOT NULL,
  `software` int(11) NOT NULL,
  `activations` int(11) NOT NULL DEFAULT '0',
  `licens_counter` int(11) NOT NULL,
  `Life_Time` date NOT NULL DEFAULT '0000-00-00',
  `last_aktivation` datetime NOT NULL,
  `last_IP` varchar(255) NOT NULL,
  `reg_date` date NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP, PRIMARY KEY (`ID`)
) ENGINE=InnoDB ;

CREATE TABLE `$db`.`" . $db_prefix . "_software` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `software` varchar(255) NOT NULL,
  `Hash` varchar(128) NOT NULL,
  `key_prefix` varchar(5) NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP, PRIMARY KEY (`ID`)
) ENGINE=InnoDB ;

CREATE TABLE `$db`.`" . $db_prefix . "_user` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `groupID` int(11) NOT NULL,
  `Created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP, PRIMARY KEY (`ID`)
) ENGINE=InnoDB;
CREATE TABLE `$db`.`" . $db_prefix . "_group` (
  `groupID` int(11) NOT NULL AUTO_INCREMENT,
  `groupName` varchar(100) NOT NULL, PRIMARY KEY (`groupID`)
) ENGINE=InnoDB ;

INSERT INTO `$db`.`" . $db_prefix . "_group` (`groupID`, `groupName`) VALUES
(1, '" . $l['GROUP_ADMIN'] . "'),
(2, '" . $l['GROUP_MD'] . "'),
(3, '" . $l['GROUP_D'] . "'),
(4, '" . $l['GROUP_M'] . "');

CREATE TABLE `$db`.`" . $db_prefix . "_group_rights` (
  `grouprightsID` int(11) NOT NULL AUTO_INCREMENT,
  `groupID` int(11) NOT NULL,
  `rightID` int(11) NOT NULL, PRIMARY KEY (`grouprightsID`)
) ENGINE=InnoDB ;

INSERT INTO `$db`.`" . $db_prefix . "_group_rights` (`grouprightsID`, `groupID`, `rightID`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 3),
(4, 1, 4),
(5, 1, 5),
(6, 1, 6),
(7, 1, 7),
(8, 1, 8),
(9, 1, 9),
(10, 1, 10),
(11, 1, 11),
(12, 1, 12),
(13, 2, 1),
(14, 2, 2),
(15, 2, 3),
(16, 2, 4),
(17, 2, 5),
(18, 2, 6),
(19, 3, 1),
(20, 3, 2),
(21, 3, 3),
(22, 3, 4),
(23, 4, 1);

CREATE TABLE `$db`.`" . $db_prefix . "_rights` (
  `rightID` int(11) NOT NULL AUTO_INCREMENT,
  `rightName` varchar(100) NOT NULL, PRIMARY KEY (`rightID`)
) ENGINE=InnoDB ;

INSERT INTO `$db`.`" . $db_prefix . "_rights` (`rightID`, `rightName`) VALUES
(1, 'create_key'),
(2, 'delete_key'),
(3, 'create_hash'),
(4, 'delete_hash'),
(5, 'create_software'),
(6, 'delete_software'),
(7, 'create_user'),
(8, 'delete_user'),
(9, 'delete_group'),
(10, 'create_group'),
(11, 'add_group_user'),
(12, 'remove_group_user');

CREATE TABLE `$db`.`" . $db_prefix . "_user_rights_adjust` (
  `userrightsadjustID` int(11) NOT NULL AUTO_INCREMENT,
  `accountID` int(11) NOT NULL,
  `rightID` int(11) NOT NULL,
  `adjustment` int(11) NOT NULL, PRIMARY KEY (`userrightsadjustID`)
) ENGINE=InnoDB ;

";
  
  
  
  $abfrage .= "INSERT INTO `$db`.`" . $db_prefix . "_user` (`username`, `password`, `groupID`) VALUE ('$user' , '$pw', '1');";
  if ($mysqli->multi_query($abfrage))
  {
   $datei = fopen($_SERVER["DOCUMENT_ROOT"] . "config.php","w");
					fwrite($datei, '<?php
$config["dbuser"] = "' . $db_user . '";
$config["dbpassword"] = "' . $db_pw . '";
$config["dbname"] = "' . $db . '";
$config["dbprefix"] = "' . $db_prefix . '";
$config["dbserver"] ="' . $server . '";
$config["install"] = false;
?>');
					fclose($datei);
					echo '<h1>' . $l['HEADER_INSTALL_SUCCES'] . '</h1>';
					session_destroy();
					header("Location : ../software.php");
  } else {
  echo $mysqli->error;
  }
} else {
echo '<form action="step_2.php" method="post" enctype="multipart/form-data">
<div class="col-md-6 col-md-offset-3">
		<div class="panel panel-default">
		<div class="panel-heading">' . $l['PANEL_INSTALL_CONFIG'] . '</div>
			<div class="panel-body">
				<div class="form-group">
					<label>' . $l['LABEL_INSTALL_DATABASE'] . '</label>
					<input type="text" name="db" class="form-control" value="olks" required> 
    </div>
    <div class="form-group">
			<label>' . $l['LABEL_INSTALL_DATABASE_USER'] . '</label>
			<input type="text" name="db_user" class="form-control" autocomplete="off" value="olks" required />
		</div>
    <div class="form-group">
			<label>' . $l['LABEL_INSTALL_DATABASE_PREFIX'] . '</label>
		  <input type="text" name="db_prefix" class="form-control" value="olks" autocomplete="off" />
    </div>
    <hr >
    <div class="form-group">
    <label>' . $l['LABEL_INSTALL_USER'] . '</label>
    <input type="text" name="user" class="form-control" autocomplete="off" required />
    </div>
    <div class="form-group">
    <label>' . $l['LABEL_INSTALL_PASSWORD'] . '</label>
    <input type="password" name="pw" class="form-control" autocomplete="off" required />
    </div>
    </div>
    <div class="panel-footer">
				<button type="submit" class="btn btn-default">' . $l['BUTTON_INSTALL_NEXT'] . '</button>
</form>';
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

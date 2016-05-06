<?php
if(!isset($_SESSION))
{session_start();}
session_destroy();
echo "Sie wurden abgemeldez";
header('Location:index.php');
exit();
?>
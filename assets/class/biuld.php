<?php
require_once(__DIR__."/../../config.php");
if (!isset($_SESSION)){
session_start();
}
if (!isset($_SESSION["lang"])){
$_SESSION["lang"] = $config["lang"];
}
require_once(__DIR__."/../lang/".$_SESSION["lang"] .".php");
require_once(__DIR__."/function.php");
$biuld = new biuld();
$func = new func();
  class biuld
  {
    public function header($author, $description, $title)
    {
      setlocale(LC_ALL, 'de_DE.UTF-8');
      
      session_start();
      echo '<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>OLKS Admin - ' . $title . '</title>

    <!-- Bootstrap Core CSS -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="assets/css/sb-admin.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="assets/css/plugins/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="assets/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn\'t work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>'; 
    }
    
    public function Nav($activ)
    {
      $rootpath = $_SERVER['DOCUMENT_ROOT'];
      include_once("function.php");
      require(__DIR__. "/../../config.php");
    if ($config["install"] == true)
    {
    header("Location: install/index.php");
    }
      
      $func = new func();
      if(!isset($_SESSION["User_ID"])){
      header("Location: login.php?redirect=" . $_SERVER['REQUEST_URI']);
      exit;
      }
      
      echo '
        <!-- NAVBAR
================================================== -->
        <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html">OLKS Admin</a>
            </div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">
                ';/*
                echo '<li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-envelope"></i> <b class="caret"></b></a>
                    <ul class="dropdown-menu message-dropdown">
                        <li class="message-preview">
                            <a href="#">
                                <div class="media">
                                    <span class="pull-left">
                                        <img class="media-object" src="http://placehold.it/50x50" alt="">
                                    </span>
                                    <div class="media-body">
                                        <h5 class="media-heading"><strong>John Smith</strong>
                                        </h5>
                                        <p class="small text-muted"><i class="fa fa-clock-o"></i> Yesterday at 4:32 PM</p>
                                        <p>Lorem ipsum dolor sit amet, consectetur...</p>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="message-preview">
                            <a href="#">
                                <div class="media">
                                    <span class="pull-left">
                                        <img class="media-object" src="http://placehold.it/50x50" alt="">
                                    </span>
                                    <div class="media-body">
                                        <h5 class="media-heading"><strong>John Smith</strong>
                                        </h5>
                                        <p class="small text-muted"><i class="fa fa-clock-o"></i> Yesterday at 4:32 PM</p>
                                        <p>Lorem ipsum dolor sit amet, consectetur...</p>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="message-preview">
                            <a href="#">
                                <div class="media">
                                    <span class="pull-left">
                                        <img class="media-object" src="http://placehold.it/50x50" alt="">
                                    </span>
                                    <div class="media-body">
                                        <h5 class="media-heading"><strong>John Smith</strong>
                                        </h5>
                                        <p class="small text-muted"><i class="fa fa-clock-o"></i> Yesterday at 4:32 PM</p>
                                        <p>Lorem ipsum dolor sit amet, consectetur...</p>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="message-footer">
                            <a href="#">Read All New Messages</a>
                        </li>
                    </ul>
                </li><li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bell"></i> <b class="caret"></b></a>
                    <ul class="dropdown-menu alert-dropdown">

$bell = $func->get_bell();
for($i = 0 ; $i < count($bell); $i ++){
echo '<li>
<a href="' . $bell[$i]["link"] . '">' . $bell[$i]["name"] . '<span class="label label-' . $bell[$i]["type"] . '">' . $bell[$i]["badge"] . '</span></a>
</li>'
}
                        <li>
                            <a href="#">Alert Name <span class="label label-primary">Alert Badge</span></a>
                        </li>
                        <li>
                            <a href="#">Alert Name <span class="label label-success">Alert Badge</span></a>
                        </li>
                        <li>
                            <a href="#">Alert Name <span class="label label-info">Alert Badge</span></a>
                        </li>
                        <li>
                            <a href="#">Alert Name <span class="label label-warning">Alert Badge</span></a>
                        </li>
                        <li>
                            <a href="#">Alert Name <span class="label label-danger">Alert Badge</span></a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">View All</a>
                        </li>
                    </ul>
                </li>';*/
                
                switch ($func->get_user_group($_SESSION["User_ID"])){
    case 1 :
    $icon = '<i class="fa fa-user-secret"></i>';
    break;
    case 2 :
    $icon = '<i class="fa fa-user-secret"></i> <i class="fa fa-code"></i>';
    break;
    case 3 :
    $icon = '<i class="fa fa-code"></i>';
    break;
    case 4 :
    $icon = '<i class="fa fa-money"></i>';
    break;
                }
                echo '
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"> ' . $icon . $_SESSION["Username"] . ' <b class="caret"></b></a>
                    <ul class="dropdown-menu">';
                    /*echo '
                        <li>
                            <a href="#"><i class="fa fa-fw fa-user"></i> Profile</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-fw fa-envelope"></i> Inbox</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-fw fa-gear"></i> Settings</a>
                        </li>
                        <li class="divider"></li>
           ';*/
           include(__DIR__. "/../lang/".$_SESSION["lang"].".php");
   echo '             <li>                         <a href="logout.php"><i class="fa fa-fw fa-power-off"></i> ' . $l['TEXT_LOGOUT'] . '</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
			';       
			$item[] = '<a href="/index.php"><i class="fa fa-fw fa-dashboard"></i>' . $l['NAV_DASH'] . '</a>';
			     
			if ($func->user_have_right("delete_key") == true or $func->user_have_right("create_key") == true){
			 $item[] = '<a href="/key.php"><i class="fa fa-fw fa-key"></i>' . $l['NAV_KEYS'] . '</a>';
			 }
						    if ($func->user_have_right("delete_software") == true or $func->user_have_right("create_software") == true){
			$item[] = '<a href="/software.php"><i class="fa fa-fw fa-archive"></i>' . $l['NAV_SOFTWARE'] . '</a>';
			}
			if ($func->user_have_right("delete_user") == true or $func->user_have_right("create_user") == true){
			$item[] = '<a href="/user.php"><i class="fa fa-fw fa-user"></i>' . $l['NAV_USERS'] . '</a>';
			}
				if ($func->user_have_right("remove_group_user") == true or $func->user_have_right("add_group_user") == true){
			$item[] = '<a href="/group.php"><i class="fa fa-fw fa-users"></i>' . $l['NAV_GROUP'] . '</a>';
			}

			if ($func->user_have_right("delete_hash") == true or $func->user_have_right("create_hash") == true){
			$item[] = '<a href="/hash.php"><i class="fa fa-fw fa-file-code-o"></i>' . $l['NAV_HASH'] . '</a>';
			}
                        for ($i = 0 ; $i < count($item) ; $i ++)
                        {
                          $cls = '';
                          if ($activ - 1 == $i)
                          {
                            $cls = ' class="active"';
                          }
                          echo '<li' . $cls . '>' . $item[$i] . '</li>';
                        }
                      echo'</ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>';
      $this->printerror();
    }
    public function printerror()
    {
    if (isset($_GET['res'])){
        $text = $_GET['ertext'];
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
    }
    public function footer()
    {
    echo '</div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="assets/js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="assets/js/bootstrap.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="assets/js/plugins/morris/raphael.min.js"></script>
    <script src="assets/js/plugins/morris/morris.min.js"></script>
    <script src="assets/js/plugins/morris/morris-data.js"></script>

</body>

</html>
';
    }
  public function modal($ID, $name, $body, $footer)
  {
  	echo ' <div class="modal fade" id="' . $ID . '" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">' . $name . '</h4>
      </div>
      <div class="modal-body">
      	' . $body . '
	</div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        ' . $footer . '
</div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
';
  }
  public function confirm_delete($redi)
  {
  echo ' <div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Löschen von</h4>
            </div>
            <div class="modal-body">
            <form action="' . $redi . '" method="post">
            <input type="hidden" name="delid" id="delid">
                <p> die daten werden unwiederuflich gelöscht</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Abbrechen</button>
                <button type="submit" class="btn btn-danger btn-ok"><i class="fa fa-trash-o"></i> Löschen</button></form>
            </div>
        </div>
    </div>
</div>';
  }
  }
?>
<?php
require_once(__DIR__."/assets/lang/de.php");
require_once(__DIR__."/assets/class/biuld.php");
require_once(__DIR__."/assets/class/function.php");
require_once(__DIR__."/config.php");
$biuld = new biuld();
$biuld->header("", "", $l['TEXT_GROUPS'] );
$biuld->Nav(4);
$func = new func();
if (isset($_POST["groupid"])){
$user = $_POST["user"];
$groupID = $_POST["groupid"];
if ($res = $func->set_group_user($user, $groupID) == true)
{
echo "true";
} else {
echo $res;
}
} else if (isset($_POST["delid"]))
{
if ($func->del_user($_POST["delid"]))
{

}
}
echo '<div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            ' . $l['NAV_GROUP'] . '
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="#">OLKS</a>
                            </li>
                            <li>
                                <i class="fa fa-users "></i>  <a href="user.php">' . $l['NAV_GROUP'] . '</a>
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->
<div class="row">
	<div class="col-lg-6">
		<h2></h2>
		<div class="table-responsive">
			<table class="table table-bordered table-hover">
				<thead>
						    <tr>
						        <th>'. $l['TEXT_GROUPS'] .'</th>
						        <th>' . $l['TEXT_MEMBERS'] . '</th>
						        <th></th>
						    </tr>
						    </thead>
						    <tbody>';
						    $res = $func->get_group();
						    for ($i =0 ; $i < count($res); $i++){
						    switch ($res[$i]["groupID"]){
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
						    echo '<tr><td>' . $icon . $res[$i]["groupName"]. '</td><td>';
						    $resuser = $func->get_group_user($res[$i]["groupID"]);
						    for ($j =0 ; $j < count($resuser); $j++){
						    echo $resuser[$j]["name"] . ", ";
						    }
						    if ($func->user_have_right("add_group_user") == true){
						    echo '</td><td> <button class="btn btn-success" data-groupid="'. $res[$i]["groupID"] . '" data-iname="' . $res[$i]["groupName"] . '" data-toggle="modal" data-target="#addgroupuser"><i class="fa fa-user-plus"></i> ' . $l['TEXT_ADD_USER'] . '</button></td>';
						    }
						    echo'</td></tr>';
						    }
					echo '	</tbody></table></div>
					</div>
				</div>
			</div>
		</div><!--/.row-->	
';
$ebody = '<form action="' . $_SERVER[REQUEST_URI] . '" method="post">
<input type="text" name="groupid" id="groupid" >
        <div class="form-group">
        <label>'. $l['LABEL_USER'] .'</label>
        <select name="user" class="form-control" required multible>
        ';
        $resus = $func->get_user();
						    for ($i =0 ; $i < count($resus); $i++){
						    $ebody .= '<option value="' . $resus[$i]["ID"] . '">' . $resus[$i]["name"]. '</option>';
						    }
        $ebody .= '
        </select>
        </div>
        ';
        $efooter = '<button type="submit" class="btn btn-success"> '. $l['BUTTON_ADD'] .' </button>
     </form>
    ';
   $biuld->modal("addgroupuser", $l['TITLE_ADD_USER'] , $ebody, $efooter);   
$biuld->footer();
?>
<script src="assets/js/custom.js"></script>
    <script>
    $('#addgroupuser').on('show.bs.modal', function(e) {
    $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
    document.getElementById("groupid").value = $(e.relatedTarget).data('groupid');
});
    </script>
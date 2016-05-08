<?php
require_once(__DIR__."/assets/class/biuld.php");
$biuld->header("", "", $l['NAV_USERS']);
$biuld->Nav(4);
if (isset($_POST["user"])){
$user = $_POST["user"];
$pw = $_POST["pw"];
if ($func->set_user($user, $pw))
{

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
                            '.$l['NAV_USERS'].'
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="#">OLKS</a>
                            </li>
                            <li>
                                <i class="fa fa-user "></i>  <a href="user.php">'.$l['NAV_USERS'].'</a>
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
						        <th>'. $l['TEXT_ID'] .'</th>
						        <th>'. $l['TEXT_NAME'] .'</th>
						        <th></th>
						    </tr>
						    </thead>
						    <tbody>';
						    $res = $func->get_user();
						    for ($i =0 ; $i < count($res); $i++){
						    echo '<tr><td>' . $res[$i]["ID"] . '</td><td>' . $res[$i]["name"]. '</td>';
						    if ($i >0)
						    {
						    echo '<td>';
						    if ($func->user_have_right("delete_user") == true){
						    echo ' <button class="btn btn-danger" data-delid="'. $res[$i]["ID"] . '" data-iname="' . $res[$i]["name"] . '" data-toggle="modal" data-target="#confirm-delete"><i class="fa fa-trash-o"></i> '. $l['BUTTON_DELL'] .'</button>';
						    }
						    echo'</td></tr>';
						    }
						    }
					echo '	</tbody></table></div>
					<span class="input-group-btn">';
						    if ($func->user_have_right("create_user") == true){
						    echo '
								<button class="btn btn-primary btn-md" id="btn-todo" data-toggle="modal" data-target="#adduser"> '. $l['BUTTON_ADD'] .' </button>';
								}
								echo'
							</span>
					</div>
				</div>
			</div>
		</div><!--/.row-->	
';
$ebody = '<form action="' . $_SERVER[REQUEST_URI] . '" method="post">
        <div class="form-group">
        <label>'. $l['TEXT_NAME'] .'</label>
        <input type="text" name="user" class="form-control" required>
        </div>
        <div class="form-group">
        <label>'. $l['LABEL_PASSWORD'] .'</label>
        <input type="text" name="pw" class="form-control" required>
        </div>
        ';
        $efooter = '<button type="submit" class="btn btn-success"> '. $l['BUTTON_ADD'] .' </button>
     </form>
    ';
   $biuld->modal("adduser", $l['TITLE_ADD_USER'] , $ebody, $efooter);   
$biuld->footer();
$biuld->confirm_delete($_SERVER[REQUEST_URI]);
?>
<script src="assets/js/custom.js"></script>
    <script>
    $('#confirm-delete').on('show.bs.modal', function(e) {
    $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
document.getElementById("myModalLabel").innerHTML = 'Löschen von '+ $(e.relatedTarget).data('iname');
    document.getElementById("delid").value = $(e.relatedTarget).data('delid');
});
    </script>
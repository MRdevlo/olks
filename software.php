<?php
require_once(__DIR__."/assets/lang/de.php");
require_once(__DIR__."/assets/class/biuld.php");
require_once(__DIR__."/assets/class/function.php");
require_once(__DIR__."/config.php");
$biuld = new biuld();
$biuld->header("", "", $l['NAV_SOFTWARE']);
$biuld->Nav(2);
$func = new func();
if (isset($_POST["prefix"])){
$sw_name = $_POST["name"];
$sw_prefix = strtoupper($_POST["prefix"]);
if ($func->set_software($sw_name, $sw_prefix))
{

}
} else if (isset($_POST["delid"]))
{
if ($func->del_software($_POST["delid"]))
{

}
}
echo '<div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            '.$l['NAV_SOFTWARE'].'
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="#">OLKS</a>
                            </li>
                            <li>
                                <i class="fa fa-archive "></i>  <a href="software.php">'.$l['NAV_SOFTWARE'].'</a>
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
						        <th>'. $l['TEXT_KEY_PREFIX'] .'</th>
						        <th></th>
						    </tr>
						    </thead>
						    <tbody>';
						    $res = $func->get_software();
						    for ($i =0 ; $i < count($res); $i++){
						    echo '<tr><td>' . $res[$i]["ID"] . '</td><td>' . $res[$i]["software"]. '</td><td>' . $res[$i]["key_prefix"]. '</td><td>';
						    if ($func->user_have_right("delete_software") == true){
						    echo '<button class="btn btn-danger" data-delid="'. $res[$i]["ID"] . '" data-iname="' . $res[$i]["software"] . '" data-toggle="modal" data-target="#confirm-delete"><i class="fa fa-trash-o"></i> '. $l['BUTTON_DELL'] .'</button>';
						    } 
						    echo '</td></tr>';
						    }
					echo '	</tbody></table></div>
					<span class="input-group-btn">';
						    if ($func->user_have_right("create_software") == true){
						    echo '
								<button class="btn btn-primary btn-md" id="btn-todo" data-toggle="modal" data-target="#addsw"> '. $l['BUTTON_ADD'] .' </button>';
								}
							echo '</span>
					</div>
				</div>
			</div>
		</div><!--/.row-->	
';
$ebody = '<form action="' . $_SERVER[REQUEST_URI] . '" method="post" enctype="multipart/form-data">
        <div class="form-group">
        <label>'. $l['TEXT_NAME'] .'</label>
        <input type="text" name="name" class="form-control" required>
        </div>
        <div class="form-group">
        <label>'. $l['TEXT_KEY_PREFIX'] .'</label>
        <input type="text" name="prefix" class="form-control" required>
        </div>
        ';
        $efooter = '<button type="submit" class="btn btn-success"> '. $l['BUTTON_ADD'] .' </button>
     </form>
    ';
   $biuld->modal("addsw", $l['TITLE_ADD_SOFTWARE'] , $ebody, $efooter);   
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
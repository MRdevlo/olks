<?php
require_once(__DIR__."/assets/lang/de.php");
require_once(__DIR__."/assets/class/biuld.php");
require_once(__DIR__."/assets/class/function.php");
require_once(__DIR__."/config.php");
$biuld = new biuld();
$biuld->header("", "", $l['NAV_HASH']);
$biuld->Nav(5);
$func = new func();
if (isset($_FILES['file'])){
$sw_id = $_POST["software"];
$md5sum = sha1_file( $_FILES['file']['tmp_name'] );
if ($func->set_hash($sw_id, $md5sum))
{

}
} else if (isset($_POST["delid"]))
{
if ($func->del_hash($_POST["delid"]))
{

}
}
echo '<div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            ' . $l['NAV_HASH'] . '
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="#">OLKS</a>
                            </li>
                            <li>
                                <i class="fa fa-file-code-o "></i>  <a href="hash.php">' . $l['NAV_HASH'] . '</a>
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
						    $sow = $func->get_software();
        for ($i = 0 ; $i < count($sow) ; $i ++)
        {
        $swaray [$sow[$i]["ID"]] = $sow[$i]["software"];
        }
						    $res = $func->get_hash();
						    for ($i =0 ; $i < count($res); $i++){
						    echo '<tr><td>' . $res[$i]["ID"] . '</td><td>' . $res[$i]["hash"]. '</td><td>' . $swaray[$res[$i]["Software_ID"]]. '</td><td> ';
						    if ($func->user_have_right("delete_hash") == true){
						    echo '<button class="btn btn-danger" data-delid="'. $res[$i]["ID"] . '" data-iname="' . $res[$i]["hash"] . '" data-toggle="modal" data-target="#confirm-delete"><i class="fa fa-trash-o"></i> ' . $l['BUTTON_DELL'] . '</button>'; 
						    }
						    echo '</td></tr>';
						    }
					echo '	</tbody></table></div>
					<span class="input-group-btn">';
						    if ($func->user_have_right("create_hash") == true){
						    echo '
								<button class="btn btn-primary btn-md" id="btn-todo" data-toggle="modal" data-target="#addsw"> '. $l['BUTTON_ADD'] .' </button>';
								}
								echo '
							</span>
					</div>
				</div>
			</div>
		</div><!--/.row-->	
';
$ebody = '<form action="' . $_SERVER[REQUEST_URI] . '" method="post" enctype="multipart/form-data">
 <div class="form-group">
        <label>'. $l['TEXT_HASH_FILE'] .'</label>
        <input type="file" name="file" class="form-control" required>
        </div>
        <div class="form-group">
        <label>'. $l['LABEL_SOFTWARE'] .'</label>
        <select name="software" class="form-control" required>
        ';
        $sow = $func->get_software();
        for ($i = 0 ; $i < count($sow) ; $i ++)
        {
        $ebody .= '<option value="' . $sow[$i]["ID"] . '">' . $sow[$i]["software"] . '</option>';
        }
        $ebody .= '
        </select>
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
<?php
require_once(__DIR__."/assets/lang/de.php");
require_once(__DIR__."/assets/class/biuld.php");
require_once(__DIR__."/assets/class/function.php");
require_once(__DIR__."/config.php");
$biuld = new biuld();
$biuld->header("", "", $l['NAV_KEYS']);
$biuld->Nav(1);
$func = new func();
if (isset($_POST["lifetime"])){
$key_sw = $_POST["software"];
$key_licens = $_POST["licens"];
$key_lt = $_POST["lifetime"];
if ($res = $func->set_key($key_sw, $key_licens, $key_lt))
{

} else {

}
}
$res = $func->get_key();
echo '<div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            ' . $l['NAV_KEYS'] . '
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="#">OLKS</a>
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
						<th>#</th>
						<th>'. $l['TEXT_KEY'] .'</th>
						<th>'. $l['TEXT_AKTIVATIONS'] .'</th>
						<th>'. $l['TEXT_LICENSES'] .'</th>
						
					</tr>
				</thead>
				<tbody>';
				for ($i = 0 ; $i < count($res) ; $i ++){
				echo '<tr> <td>' . $res[$i]["ID"] . '</td><td>' . $res[$i]["key"] . '</td><td>' . $res[$i]["activations"] . '</td><td>' . $res[$i]["licens_counter"] . '</td></tr>';
				}
				
				echo'
				</tbody>
			</table>	
					</div>
										<span class="input-group-btn">';
						    if ($func->user_have_right("create_key") == true){
						    echo '
								<button class="btn btn-primary btn-md" id="btn-todo" data-toggle="modal" data-target="#addkey">'. $l['BUTTON_ADD'] .'</button>' ;
								}
								echo '
							</span>
			</div>
		</div><!--/.row-->	
';
$ebody = '<form action="' . $_SERVER[REQUEST_URI] . '" method="post">
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
        <div class="form-group">
        <label>'. $l['TEXT_LICENSES'] .'</label>
        <input type="number" name="licens" class="form-control" required>
        </div>
        <div class="form-group">
        <label>'. $l['LABEL_LIFE_TIME'] .'</label>
        <input type="date" name="lifetime" class="form-control" required>
        </div>
        ';
        $efooter = '<button type="submit" class="btn btn-success">'. $l['BUTTON_ADD'] .'</button>
     </form>
    ';
   $biuld->modal("addkey", $l['TITLE_ADD_KEY'], $ebody, $efooter);   
$biuld->footer();
?>
<?php
require_once(__DIR__."/assets/class/biuld.php");
$biuld->header("", "", $l['NAV_KEYS']);
$biuld->Nav(1);	
if (isset($_POST["lifetime"])){
$key_sw = $_POST["software"];
$key_licens = $_POST["licens"];
$key_lt = $_POST["lifetime"];
if ($res = $func->set_key($key_sw, $key_licens, $key_lt))
{

} else {

}
}
echo '

                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-key fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge">'; 

                                        echo $func->stati_key_lcount();
                                        echo '</div>
                                        <div>'.$l['TEXT_LICENSES'].'</div>
                                    </div>
                                </div>
                            </div>
                            <a href="#">
                                <div class="panel-footer">
                                    
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-yellow">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-shopping-cart fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge">' .  $func->stati_key_aktivations() . '</div>
                                        <div>'.$l['TEXT_AKTIVATIONS'].'</div>
                                    </div>
                                </div>
                            </div>
                            <a href="#">
                                <div class="panel-footer">
                                   
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>';   
$biuld->footer();
?>
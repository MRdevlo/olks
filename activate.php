<?php
if (isset($_POST["key"]) and isset($_POST["hash"])) {
    require_once(__DIR__ . "/assets/class/function.php");
    $func = new func();
    echo $func->aktiv($_POST["key"], $_POST["hash"]);
} else if (isset($_POST["identifier"])) {
    require_once(__DIR__ . "/assets/class/function.php");
    $func = new func();
    echo $func->check_identifier($_POST["identifier"]);
}
?>
<?php
$headless = true;
include_once $_SERVER["DOCUMENT_ROOT"] . "/backend/utils.php";
include_once BACKEND."/appointments.php";

$missing = [];
if(!checkPost(["code"], $missing)){
    echo "ERROR:Missing args: ".join(",",$missing);
    exit(0);
}
session_start();
if(!(isset($_SESSION['loggedin']) && $_SESSION['loggedin'])){
    die("ERROR:Invalid login");
}

removeAppointment($_POST["code"]);
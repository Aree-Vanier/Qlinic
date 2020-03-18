<?php
$headless = true;
include_once $_SERVER["DOCUMENT_ROOT"] . "/backend/utils.php";
include_once BACKEND."/appointments.php";
include_once BACKEND."/notifications.php";

$missing = [];
if(!checkPost(["code"], $missing)){
    echo "ERROR:Missing args: ".join(",",$missing);
    exit(0);
}
session_start();
if(!(isset($_SESSION['loggedin']) && $_SESSION['loggedin'])){
  //  die("ERROR:Invalid login");
}

$code = sanitizeInput($_POST["code"]);

$appt = getAppointmentDetails($code);

removeAppointment($code);

$serverName = getServers()[$appt["server"]];
$timestr = date("D M jS \a\\t g:i A", $appt["time"]+strToTime($appt["date"]));

sendSMS("Your appointment with $serverName on $timestr has been cancelled.", $appt["phone"]);

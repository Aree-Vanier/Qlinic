<?php
$headless = true;
include_once $_SERVER["DOCUMENT_ROOT"] . "/backend/utils.php";
include_once BACKEND."/appointments.php";

$missing = [];
if(!checkPost(["code"], $missing)){
    echo "ERROR:Missing args: ".join(",",$missing);
    exit(0);
}

$code = sanitizeInput($_POST["code"]);

$appointment = getAppointmentDetails($code);
$appointment["timeString"] = date("g:i A", getDateTimestamp($appointment["date"])+$appointment["time"]);
$appointment["serverName"] = getServers()[$appointment["server"]];

echo json_encode($appointment);
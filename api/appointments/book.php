<?php
$headless = true;
include_once $_SERVER["DOCUMENT_ROOT"] . "/backend/utils.php";
include_once BACKEND."/appointments.php";
include_once BACKEND."/notifications.php";

$missing = [];
if(!checkPost(["firstName","lastName","server","time","reason","email","phone"], $missing)){
    echo "ERROR:Missing args: ".join(",",$missing);
    exit(0);
}

$firstName = sanitizeInput($_POST["firstName"]);
$lastName = sanitizeInput($_POST["lastName"]);
$server = sanitizeInput($_POST["server"]);
$time = sanitizeInput($_POST["time"]);
$reason = sanitizeInput($_POST["reason"]);
$email = sanitizeInput($_POST["email"]);
$phone = sanitizeInput($_POST["phone"]);

$date = getDateString($time);
$time = $time-getDateTimestamp($date);


$transac = MD5($firstName.$lastName.$server.$date.$time.getIP());

$stmt = createStatement("SELECT code FROM qlinic.booked WHERE transac LIKE ?");
$stmt->bind_param("s", $transac);
$stmt->execute();
$result = $stmt->get_result();
if($result->num_rows > 0){
    die("ERROR:Duplicate request");
}
$stmt->free_result();

$available = getAvailable($date)[$server];

if($time+strToTime($date) < time()){
    die ("ERROR:Timeslot has passed");
}

$bookable = false;
//Check if the timeslot is already in use
foreach($available as $appt){
    if($appt-getDateTimestamp($date) == $time){
        $bookable = true;
    }
}
if(!$bookable) {
    die("ERROR:Timeslot unavailable");
}
book($firstName, $lastName, $server, $date, $time, $headless, $reason, $email, $phone, $transac, $code);

echo $code;

$serverName = getServers()[$server];
$timestr = date("D M jS \a\\t g:i A", $time+strToTime($date));

sendSMS("Appointment booked with $serverName on $timestr.\nConfirmation code: $code", $phone);
//echo $code;

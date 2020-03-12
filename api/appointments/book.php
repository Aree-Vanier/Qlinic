<?php
$headless = true;
include_once $_SERVER["DOCUMENT_ROOT"] . "/backend/utils.php";
include_once BACKEND."/appointments.php";

echo "Booking appointment<br/>\n";
$missing = [];
if(!checkPost(["firstName","lastName","server","date","time","reason","email","phone"], $missing)){
    echo "ERROR:Missing args: ".join(",",$missing);
    exit(0);
}

$firstName = sanitizeInput($_POST["firstName"]);
$lastName = sanitizeInput($_POST["lastName"]);
$server = sanitizeInput($_POST["server"]);
$date = sanitizeInput($_POST["date"]);
$time = sanitizeInput($_POST["time"]);
$reason = sanitizeInput($_POST["reason"]);
$email = sanitizeInput($_POST["email"]);
$phone = sanitizeInput($_POST["phone"]);

$transac = MD5($firstName.$lastName.$server.$date.$time.getIP());

$stmt = createStatement("SELECT code FROM qlinic.booked WHERE transac LIKE ?");
$stmt->bind_param("s", $transac);
$stmt->execute();
$result = $stmt->get_result();
if($result->num_rows > 0){
    die("ERROR:Duplicate request");
}
$stmt->free_result();

book($firstName, $lastName, $server, $date, $time, $headless, $reason, $email, $phone, $transac, $code);

echo $code;
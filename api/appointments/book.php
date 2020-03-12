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

$firstName = urldecode($_POST["firstName"]);
$lastName = urldecode($_POST["lastName"]);
$server = urldecode($_POST["server"]);
$date = urldecode($_POST["date"]);
$time = urldecode($_POST["time"]);
$reason = urldecode($_POST["reason"]);
$email = urldecode($_POST["email"]);
$phone = urldecode($_POST["phone"]);

$transac = MD5($firstName.$lastName.$server.$date.$time.getIP());

$stmt = createStatement("SELECT code FROM qlinic.booked WHERE transac LIKE(?)");
$stmt->bind_param();

book($firstName, $lastName, $server, $date, $time, $headless, $reason, $email, $phone, $transac, $code);

echo $code;
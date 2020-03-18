<?php
$headless = true;
include_once($_SERVER["DOCUMENT_ROOT"] . "/backend/utils.php");
include_once(BACKEND."/queue.php");
include_once(BACKEND."/notifications.php");

$missing = [];
if(!checkPost(["name", "email", "phone"], $missing)){
    echo "ERROR:Missing args: ".join(",",$missing);
    exit(0);
}
$name = sanitizeInput($_POST["name"]);
$email = sanitizeInput($_POST["email"]);
$phone = sanitizeInput($_POST["phone"]);
$phone = str_replace("-", "", $phone);


//Generate a transaction ID using submitted data
$transacID = md5($name.$email.$phone.getIP());

$stmt = $conn->prepare("SELECT * FROM qlinic.queue WHERE transac LIKE(?)");
$stmt->bind_param("s", $transacID);
$stmt->execute();
$stmt->store_result();
if($stmt->num_rows != 0){
    echo "ERROR:DUPLICATE";
    exit(0);
}
$stmt->free_result();

$pos = null;
$code = null;
if(addToQueue($name, $email, $phone, $transacID, $pos, $code)){
	echo "SUCCESS:".$pos."-".$code;
	if($phone != ""){
		$host = $_SERVER["HTTP_HOST"];
		sendSMS("You are #$pos in queue.\nYou can review your confirmation at: https://qlinic.gregk.ca/queue/confirmation/$pos-$code", $phone);
	}
} else {
    echo "ERROR:UNKOWN";
}

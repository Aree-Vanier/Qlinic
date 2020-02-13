<?php
$headless = true;
include($_SERVER["DOCUMENT_ROOT"] . "/backend/utils.php");
include (BACKEND."/queue.php");

$missing = [];
if(!checkPost(["name", "email", "phone"], $missing)){
    echo "ERROR:Missing args: ".join(",",$missing);
    exit(0);
}
$name = $_POST["name"];
$email = $_POST["email"];
$phone = $_POST["phone"];
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
} else {
    echo "ERROR:UNKOWN";
}

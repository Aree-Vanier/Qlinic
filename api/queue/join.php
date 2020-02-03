<?php
include($_SERVER["DOCUMENT_ROOT"] . "/backend/utils.php");
include (BACKEND."/queue.php");

echo ("API to join queue<br/>");
echo ("There are ".getQueueLength()." people in queue<br/>");
echo ("The next available number is ".getNextAvailable()."<br/>");

$missing = [];
if(!checkPost(["name", "email", "phone"], $missing)){
    echo "Missing values: ".join(",",$missing);
    exit();
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
    echo "Transaction already processed";
    exit(0);
}
$stmt->free_result();

if(addToQueue($name, $email, $phone, $transacID)){
    echo "Added successfully";
} else {
    echo "ERROR";
}

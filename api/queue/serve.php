<?php
$headless = true;
include_once($_SERVER["DOCUMENT_ROOT"] . "/backend/utils.php");
include_once(BACKEND."/queue.php");
include_once(BACKEND."/notifications.php");

session_start();
if(!(isset($_SESSION['loggedin']) && $_SESSION['loggedin'])){
    echo "ERROR:Invalid login";
    exit;
}

$missing = [];
if(!checkPost([], $missing)){
    echo "ERROR:Missing args: ".join(",",$missing);
    exit(0);
}
//$position = $_POST["position"];

removeFromQueue();

$current = getEntry(getNextServed());

if($current["phone"] != ""){
	$pos = $current["position"];
	$code = $current["code"];
	sendSMS("You're being served.\n$pos-$code", $current["phone"]);
}

$warn = getEntry($current["position"]+$warnAhead);
if(isset($warn["phone"]) && $warn["phone"] != null){
	$link = getConfirmationLink($warn["position"], $warn["code"]);
	sendSMS("You will be served shortly, please make your way to the clinic.\nAdditionally, please have the confirmation page ready.\n$link", $warn["phone"]);
}



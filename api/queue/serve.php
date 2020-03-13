<?php
$headless = true;
include($_SERVER["DOCUMENT_ROOT"] . "/backend/utils.php");
include (BACKEND."/queue.php");

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
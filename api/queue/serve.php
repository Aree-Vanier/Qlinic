<?php
$headless = true;
include($_SERVER["DOCUMENT_ROOT"] . "/backend/utils.php");
include (BACKEND."/queue.php");

$missing = [];
if(!checkPost([], $missing)){
    echo "ERROR:Missing args: ".join(",",$missing);
    exit(0);
}
//$position = $_POST["position"];

removeFromQueue();
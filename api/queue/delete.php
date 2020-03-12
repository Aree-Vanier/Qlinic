<?php
$headless = true;
include($_SERVER["DOCUMENT_ROOT"] . "/backend/utils.php");
include (BACKEND."/queue.php");

$missing = [];
if(!checkPost(["code","position"], $missing)){
    echo "ERROR:Missing args: ".join(",",$missing);
    exit(0);
}
$code = sanitizeInput($_POST["code"]);
$position = sanitizeInput($_POST["position"]);

delete($position,$code);
?>
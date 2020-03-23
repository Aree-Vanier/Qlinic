<?php
$headless = true;
include($_SERVER["DOCUMENT_ROOT"] . "/backend/utils.php");
include (BACKEND."/appointments.php");

$missing = [];
if(!checkPost(["date"], $missing)){
    echo "date missing";
}
$dateSani = sanitizeInput($_POST["date"]);
getBookedOnDate($dateSani); //how do i actually get this back to the rio page.
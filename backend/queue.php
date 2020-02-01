<?php
include($_SERVER["DOCUMENT_ROOT"] . "/backend/utils.php");
$stmt_getAll = $conn->prepare("SELECT * FROM queue.active");
$stmt_getMax = $conn->prepare("SELECT MAX(position) FROM queue.active");

//Get the number of rows in the active queue (will be number of people in queue)
function getQueueLength(){
    global $stmt_getAll;
    $stmt_getAll->execute();
    $stmt_getAll->store_result();
    $result = null;
    $rows = $stmt_getAll->num_rows;
    $stmt_getAll->close();
    return $rows;
}

//Get the next available number
function getNextAvailable(){
    global $stmt_getMax;
    $stmt_getMax->execute();
    $stmt_getMax->store_result();
    $result = $stmt_getMax->get_result();
    return $result;
}

//Get the next number to be served
function getNextServed(){

}
<?php
//include($_SERVER["DOCUMENT_ROOT"] . "/backend/utils.php");
$stmt_getAll = $conn->prepare("SELECT * FROM qlinic.queue");
$stmt_getMax = $conn->prepare("SELECT MAX(position) FROM qlinic.queue");
$stmt_getMin = $conn->prepare("SELECT MIN(position) FROM qlinic.queue");
$stmt_add = $conn->prepare("INSERT INTO qlinic.queue (position, UUID, name, email, phone) VALUES (?,?,?,?,?)");
$stmt_getEntry = $conn->prepare("SELECT * FROM qlinic.queue WHERE position=?");

/**
 * Get the number of people in queue
 * @return int The number of rows in the queue
 * */
function getQueueLength(){
    global $stmt_getAll;
    $stmt_getAll->execute();
    $stmt_getAll->store_result();
    $rows = $stmt_getAll->num_rows;
    return $rows;
}

/**
 * Get the next available number in queue
 * @return int The highest position, plus one
 */
function getNextAvailable(){
    global $stmt_getMax;
    $result = null;
    $stmt_getMax->execute();
    $stmt_getMax->bind_result($result);
    $stmt_getMax->fetch();
    $stmt_getMax->store_result();
    $stmt_getMax->free_result();
    return $result+1;
}

/**
 * Get the next entry to be served
 * @return int The row with the lowest position
 */
function getNextServed(){
    global $stmt_getMin;
    $result = null;
    $stmt_getMin->execute();
    $stmt_getMin->bind_result($result);
    $stmt_getMin->fetch();
    $stmt_getMin->store_result();
    $stmt_getMin->free_result();
    return $result;
}

/**
 * Add an entry to the queue
 * @param $name string The associated name
 * @param $email string The associated email address
 * @param $phone string The associated phone number
 * @return bool true if added successfully
 */
function addToQueue($name, $email, $phone){
    global $stmt_add;
    $pos = getNextAvailable();
    $UUID = substr(preg_replace("/[\.\/]/", "",password_hash($name, CRYPT_MD5)), 7,5);
    $UUID = strtoupper($UUID);
    $stmt_add->bind_param("issss", $pos, $UUID,$name, $email, $phone);
    $stmt_add->execute();
    return $stmt_add->error == "";
}
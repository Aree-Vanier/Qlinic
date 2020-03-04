<?php
include $_SERVER["DOCUMENT_ROOT"] . "/backend/config.php";
//include $_SERVER["DOCUMENT_ROOT"] . "/backend/utils.php";

$stmt_getDocs = $conn->prepare("SELECT ID,server FROM qlinic.available");
$stmt_getDoc = $conn->prepare("SELECT * FROM qlinic.available WHERE ID = ?");

/**
 * Get a list of possible times for a specific doctor
 * @param $doc int ID of the target doctor
 * @param $date int UNIX timestamp for 0:00 (midnight) on selected date
 * @return array list of possible times, in unix timestamps
*/
function getDocPossibleTimes($doc , $date){
    global $stmt_getDoc;
    $stmt_getDoc->bind_param("i", $doc);
    $stmt_getDoc->execute();
    $result=$stmt_getDoc->get_result()->fetch_assoc();
    $stmt_getDoc->free_result();

    $start = $date + $result["start"];
    $end = $date + $result["end"];
    $len = $result["len"];

    $out = [];

    for($time=$start; $time+$len<=$end; $time+=$len){
        array_push($out, $time);
    }
    return $out;
}

/**
 * Get the possible times for all doctors
 * @param $date int Target day
 * @return array This list of available times sorted by doctor
*/
function getAllPossibleTimes($date){
    global $stmt_getDocs;
    $stmt_getDocs->execute();
    $ID="";
    $name="";
    $stmt_getDocs->bind_result($ID, $name);
    $stmt_getDocs->store_result();
    $out = [];
    while($stmt_getDocs->fetch()){
        $out[$name] = getDocPossibleTimes($ID, $date);
    }

    $stmt_getDocs->free_result();
    return $out;
}

/**
 *
*/
function getBookedTimes(){


}













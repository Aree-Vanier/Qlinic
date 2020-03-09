<?php
include $_SERVER["DOCUMENT_ROOT"] . "/backend/config.php";
//include $_SERVER["DOCUMENT_ROOT"] . "/backend/utils.php";

DEFINE("GET_DOCS", "SELECT ID,server FROM qlinic.available");
DEFINE("GET_DOC_INFO", "SELECT * FROM qlinic.available WHERE ID = ?");
DEFINE("GET_ALL_APPOINTMENTS", "SELECT * from qlinic.booked ORDER BY date");


/**
 * Get a list of possible times for a specific doctor
 * @param $server int ID of the target server
 * @param $date int UNIX timestamp for 0:00 (midnight) on selected date
 * @return array list of possible times, in unix timestamps
*/
function getDocPossibleTimes($date, $server){
    $stmt = createStmt(GET_DOC_INFO);
    $stmt->bind_param("i", $server);
    $stmt->execute();
    $result=$stmt->get_result()->fetch_assoc();
    $stmt->free_result();

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
    $stmt = createStmt(GET_DOCS);

    $stmt->execute();
    $ID="";
    $name="";
    $stmt->bind_result($ID, $name);
    $stmt->store_result();
    $out = [];
    while($stmt->fetch()){
        $out[$name] = getDocPossibleTimes($date,$ID);
    }

    $stmt->free_result();
    return $out;
}

/**
 *
*/
function getAllBookedTimes(){
    $stmt = createStmt(GET_ALL_APPOINTMENTS);
    $stmt->execute();
    $stmt->store_result();
    $result = $stmt->get_result();
    $stmt->free_result();
    $out = [];
    while ($row = $result->fetch_assoc()){
        array_push($out, $result);
    }
    return $out;
}














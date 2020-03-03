<?php
include $_SERVER["DOCUMENT_ROOT"] . "/backend/config.php";
//include $_SERVER["DOCUMENT_ROOT"] . "/backend/utils.php";

$stmt_getDoc = $conn->prepare("SELECT start,end,len FROM qlinic.available WHERE ID = ?");

/**
 * Get a list of possible times for a specific doctor
 * @param $doc int ID of the target doctor
 * @param $date int UNIX timestamp for 0:00 (midnight) on selected date
 * @return array list of possible times, in unix timestamps
*/
function getPossibleTimes($doc ,$date){
    global $stmt_getDoc;
    $stmt_getDoc->bind_param("i", $doc);
    $stmt_getDoc->execute();
    $result=$stmt_getDoc->get_result()->fetch_assoc();
    $stmt_getDoc->free_result();

    $start = $date + $result["start"];
    $end = $date + $result["end"];
    $len = $result["len"];

    echo $start."<br/>";
    echo $end."<br/>";
    echo $len."<br/>";

    $out = [];

    for($time=$start; $time+$len<=$end; $time+=$len){
        array_push($out, $time);
    }

    return $out;
}
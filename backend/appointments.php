<?php
include $_SERVER["DOCUMENT_ROOT"] . "/backend/config.php";
//include $_SERVER["DOCUMENT_ROOT"] . "/backend/utils.php";

define("GET_DOCS", "SELECT ID,server FROM qlinic.available");
define("GET_DOC_INFO", "SELECT * FROM qlinic.available WHERE ID = ?");
define("GET_ALL_BOOKED", "SELECT * from qlinic.booked ORDER BY date");
define("GET_BY_DATE", "SELECT (date+time) FROM qlinic.booked WHERE date = ?");
define("GET_BY_DATE_AND_SERVER", "SELECT (date+time) FROM qlinic.booked WHERE date = ? AND server = ?");
define("GET_ALL_IN_RANGE", "SELECT (date+time),server,length,code FROM qlinic.booked WHERE date>? AND date<?");


/**
 * Get a list of possible times for a specific doctor
 * @param $server int ID of the target server
 * @param $date int UNIX timestamp for 0:00 (midnight) on selected date
 * @return array list of possible times, in unix timestamps
*/
function getDocPossibleTimes($date, $server){
    $stmt = createStatement(GET_DOC_INFO);
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
    $stmt = createStatement(GET_DOCS);

    $stmt->execute();
    $ID="";
    $name="";
    $stmt->bind_result($ID, $name);
    $stmt->store_result();
    $out = [];
    while($stmt->fetch()){
        $out[$ID] = getDocPossibleTimes($date,$ID);
    }

    $stmt->free_result();
    return $out;
}

/**
 * Get basic information for all appointments booked within a timeframe
 * @param $start int The start of the timeframe, in seconds
 * @param $end int The end of the timeframe, in seconds
 * @return array Associative array containing: server, time, length, and code
 */
function getInRange($start, $end){
    $stmt = createStatement(GET_ALL_IN_RANGE);
    $stmt->bind_param("ii", $start, $end);
    $stmt->execute();
    $stmt->bind_result($time, $server,$len,$code);
    $stmt->store_result();
    $out = [];
    while($stmt->fetch()){
        array_push($out, array("server"=>$server, "time"=>$time, "length"=>$len, "code"=>$code));
    }
    $stmt->free_result();
    return $out;
}

/**
 * Get all booked appointments
*/
function getAllAppointments(){
    return getInRange(0,999999999999);
}

/**
 * Get appointments booked on a specific date
 * @param $date int The unix timestamp for midnight on the target date
 * @param $server int The ID of the server. If left null will get all servers.
 * @return array The list of booked appointment timestamps
 */
function getBookedOnDate($date, $server=null){
    if($server==null){
        $stmt = createStatement(GET_BY_DATE);
        $stmt->bind_param("i", $date);
    } else {
        $stmt = createStatement(GET_BY_DATE_AND_SERVER);
        $stmt->bind_param("ii", $date, $server);
    }
    $stmt->execute();
    $stmt->bind_result($time);

    $out = [];
    while ($stmt->fetch()){
        array_push($out, $time);
    }
    $stmt->free_result();
    return $out;
}

/**
 * Get available appointment slots on a given date
 * @param $date int The unix timestamp for midnight on the target date
 * @return array Associative array with array of times under server IDs
*/
function getAvailable($date){
    $possible = getAllPossibleTimes($date);
    $out = [];
    foreach($possible as $server=>$times){
        echo $server.":<br/>";
        echo implode(",", $times)."<br/>";
        $booked = getBookedOnDate($date, $server);
        echo implode(",", $booked)."<br/>";
        $available = array_diff($times, $booked);
        $out[$server] = $available;
    }
    return $out;
}







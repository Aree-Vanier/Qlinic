<?php
include $_SERVER["DOCUMENT_ROOT"] . "/backend/config.php";
//include($_SERVER["DOCUMENT_ROOT"] . "/backend/utils.php");
define("GET_QUEUE", "SELECT * FROM qlinic.queue ORDER BY position");
define("GET_MAX", "SELECT MAX(position) FROM qlinic.queue");
define("GET_MIN", "SELECT MIN(position) FROM qlinic.queue");
define("ADD_CLIENT", "INSERT INTO qlinic.queue (position, code, name, email, phone, transac) VALUES (?,?,?,?,?,?)");
define("GET_CLIENT", "SELECT * FROM qlinic.queue WHERE position=?");
define("GET_BEFORE", "SELECT * FROM qlinic.queue WHERE position<?");
define("REMOVE_CLIENT", "DELETE FROM qlinic.queue WHERE position=? AND code=?");
define("ARCHIVE_CLIENT", "INSERT INTO qlinic.archive (joined, processed, wait, delta) VALUES (from_unixtime(?),from_unixtime(?),?,?)");
define("LATEST_ARCHIVED", "SELECT * FROM qlinic.archive ORDER BY processed DESC limit 1");
define("AVERAGE_DELTA", "select AVG(delta) from qlinic.archive where delta<?;");
define('CHECK_CODE', "SELECT code FROM qlinic.queue WHERE code = ?");

/**
 * Get a link to the confirmation page
 * @param $pos int Position in queue
 * @param $code string Confirmation code
 * @return string Confirmation page link
 * */
function getConfirmationLink($pos, $code){
	return "https://qlinic.gregk.ca/queue/confirmation/$pos-$code";
}

/**
 * Get the contents of the queue
 * @return array contents of the queue
 * */
function getFullQueue(){
    $stmt = createStatement(GET_QUEUE);
    $stmt->execute();
    $result = $stmt->get_result();
    $out = [];
    while($row = $result->fetch_assoc()){
        array_push($out, $row);
    }
    $stmt->free_result();
    return $out;
}

/**
 * Get the number of people in queue
 * @return int The number of rows in the queue
 * */
function getQueueLength(){
    $stmt = createStatement(GET_QUEUE);
    $stmt->execute();
    $stmt->store_result();
    $rows = $stmt->num_rows;
    $stmt->free_result();
    return $rows;
}

/**
 * Get the number of people in queue
 * @param $position int
 * @return int The number of rows in the queue
 * */
function getBefore($position){
    $stmt = createStatement(GET_BEFORE);
    $stmt->bind_param("i" ,$position);
    $stmt->execute();
    $stmt->store_result();
    $rows = $stmt->num_rows;
    return $rows;
}

/**
 * Get the average wait time between clients
 * @param $timeout int Optional argument to specify max wait time to include (allows for ignoring overnights)
 * @return int The average amount of seconds between clients being served
 */
function getAverageDelta($timeout=999999999){
    $stmt = createStatement(AVERAGE_DELTA);
    $stmt->bind_param("i", $timeout);
    $stmt->execute();
    $stmt->bind_result($delta);
    $stmt->fetch();
    $stmt->free_result();
    return $delta;
}

/**
 * Get the wait time for a new client
 * @param $position int Optional argument to specify target position
 * @return int The time in seconds
*/
function getTime($position = -1){
    global $waitTime;
    if($position == -1)
        return getQueueLength()*$waitTime;
    else
        return getBefore($position)*$waitTime;
}

/**
 * Get the next available number in queue
 * @return int The highest position, plus one
 */
function getNextAvailable(){
    $stmt = createStatement(GET_MAX);
    $result = null;
    $stmt->execute();
    $stmt->bind_result($result);
    $stmt->fetch();
    $stmt->store_result();
    $stmt->free_result();
    return $result+1;
}

/**
 * Get the next entry to be served
 * @return int The row with the lowest position
 */
function getNextServed(){
    $stmt = createStatement(GET_MIN);
    $result = null;
    $stmt->execute();
    $stmt->bind_result($result);
    $stmt->fetch();
    $stmt->store_result();
    $stmt->free_result();
    return $result;
}

/**
 * Get the entry with at the specified position
 * @param $position int The position to get
 * @return array Row in specified position
*/
function getEntry($position){
    $stmt=createStatement(GET_CLIENT);
    $stmt->bind_param("i", $position);
    $stmt->execute();
//    $stmt->bind_result($result);
//    $stmt->fetch();
    $result = $stmt->get_result()->fetch_assoc();
    $stmt->free_result();
    return $result;
}


function checkCode($code){
	$stmt=createStatement(CHECK_CODE);
$stmt->bind_param("s", $code);
$stmt->execute();
if($stmt->num_rows ==0){
	$stmt->free_result();
	return true;
}	
$stmt->free_result();
return false;
}

/**
 * Add an entry to the queue
 * @param $name string The associated name
 * @param $email string The associated email address
 * @param $phone string The associated phone number
 * @param $transac string Unique transaction ID, used to prevent duplicates
 * @param $pos int Optional reference parameter, will contain position in queue if successful or -1 if not
 * @param $code string Optional reference parameter, will contain the unique code to accompany the entry, and the error if unsuccessful
 * @return bool true if added successfully
 */
function addToQueue($name, $email, $phone, $transac, &$pos=-1, &$code=''){
    $stmt = createStatement(ADD_CLIENT);
    $pos = getNextAvailable();
$unique = false;
while(!$unique){
    $UUID = substr(MD5($name.$email), 0,5);
    $UUID = strtoupper($UUID);
	$unique = checkCode($UUID);
}    
$stmt->bind_param("isssss", $pos, $UUID,$name, $email, $phone, $transac);
    $stmt->execute();
    if($stmt->error == ""){
        $code = $UUID;
        return true;
    } else {
        $pos = -1;
        $code = $stmt->error;
        return false;
    }
}

/**
 * Get the latest entry archived
 * @return array The latest row archived
 */
function getLastArchived(){
    $stmt = createStatement(LATEST_ARCHIVED);
    $stmt->execute();
    $result = $stmt->get_result()->fetch_assoc();
    $stmt->free_result();
    return $result;
}

/**
 * Remove the entry from the queue. This requires position and code for security
 * @param $position int The position in queue
 * @param $code int The accompanying code
*/
function delete($position, $code){
    $stmt = createStatement(REMOVE_CLIENT);
    $stmt->bind_param("is", $position, $code);
    $stmt->execute();
}

/**
 * Remove the person at the top of the queue, and add them to the archive
*/
function removeFromQueue(){
    $stmt = createStatement(ARCHIVE_CLIENT);
    $data = getEntry(getNextServed());
    $currentTime = time();
    $joinTime = strtotime($data["time"]);
    $waitTime = $currentTime-$joinTime;
    $prev = getLastArchived();
    echo "Dates: ".date("Y-m-d H:i:s", $currentTime)."--".$prev["processed"]."<br/>";
    echo "Timestamps: ".$currentTime."--".strtotime($prev["processed"])."<br/>";
    $betweenTime = $currentTime-strtotime($prev["processed"]);
    echo $currentTime." | ".$joinTime." | ".date("d H:i:s", $waitTime)." | ". date("d H:i:s", $betweenTime) . "<br/>";
    $stmt->bind_param("iiii",$joinTime, $currentTime, $waitTime, $betweenTime);
    $stmt->execute();
    echo "ERROR: ".$stmt->error;
    delete($data["position"], $data["code"]);
}

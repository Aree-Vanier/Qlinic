<?php
include $_SERVER["DOCUMENT_ROOT"] . "/backend/config.php";
include($_SERVER["DOCUMENT_ROOT"] . "/backend/utils.php");
$stmt_getAll = $conn->prepare("SELECT * FROM qlinic.queue ORDER BY position ASC");
$stmt_getMax = $conn->prepare("SELECT MAX(position) FROM qlinic.queue");
$stmt_getMin = $conn->prepare("SELECT MIN(position) FROM qlinic.queue");
$stmt_add = $conn->prepare("INSERT INTO qlinic.queue (position, code, name, email, phone, transac) VALUES (?,?,?,?,?,?)");
$stmt_getEntry = $conn->prepare("SELECT * FROM qlinic.queue WHERE position=?");
$stmt_getBefore = $conn->prepare("SELECT * FROM qlinic.queue WHERE position<?");
$stmt_remove = $conn->prepare("DELETE FROM qlinic.queue WHERE position=? AND code=?");
$stmt_archive = $conn->prepare("INSERT INTO qlinic.archive (joined, processed, wait, delta) VALUES (from_unixtime(?),from_unixtime(?),?,?)");
echo $stmt_archive->error;
$stmt_getLatestArchive = $conn->prepare("SELECT * FROM qlinic.archive ORDER BY processed DESC limit 1");


/**
 * Get the contents of the queue
 * @return array contents of the queue
 * */
function getFullQueue(){
    global $stmt_getAll;
    $stmt_getAll->execute();
    $result = $stmt_getAll->get_result();
    $out = [];
    while($row = $result->fetch_assoc()){
        array_push($out, $row);
    }
    $stmt_getAll->free_result();
    return $out;
}

/**
 * Get the number of people in queue
 * @return int The number of rows in the queue
 * */
function getQueueLength(){
    global $stmt_getAll;
    $stmt_getAll->execute();
    $stmt_getAll->store_result();
    $rows = $stmt_getAll->num_rows;
    $stmt_getAll->free_result();
    return $rows;
}

/**
 * Get the number of people in queue
 * @param $position int
 * @return int The number of rows in the queue
 * */
function getBefore($position){
    global $stmt_getBefore;
    $stmt_getBefore->bind_param("i" ,$position);
    $stmt_getBefore->execute();
    $stmt_getBefore->store_result();
    $rows = $stmt_getBefore->num_rows;
    return $rows;
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
 * Get the entry with at the specified position
 * @param $position int The position to get
 * @return array Row in specified position
*/
function getEntry($position){
    global $stmt_getEntry;
    $stmt_getEntry->bind_param("i", $position);
    $stmt_getEntry->execute();
//    $stmt_getEntry->bind_result($result);
//    $stmt_getEntry->fetch();
    $result = $stmt_getEntry->get_result()->fetch_assoc();
    $stmt_getEntry->free_result();
    return $result;
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
    global $stmt_add;
    $pos = getNextAvailable();
    $UUID = substr(preg_replace("/[\.\/]/", "",password_hash($name, CRYPT_MD5)), 7,5);
    $UUID = strtoupper($UUID);
    $stmt_add->bind_param("isssss", $pos, $UUID,$name, $email, $phone, $transac);
    $stmt_add->execute();
    if($stmt_add->error == ""){
        $code = $UUID;
        return true;
    } else {
        $pos = -1;
        $code = $stmt_add->error;
        return false;
    }
}

/**
 * Get the latest entry archived
 * @return array The latest row archived
 */
function getLastArchived(){
    global $stmt_getLatestArchive;
    $stmt_getLatestArchive->execute();
    $result = $stmt_getLatestArchive->get_result()->fetch_assoc();
    $stmt_getLatestArchive->free_result();
    return $result;
}

/**
 * Remove the entry from the queue. This requires position and code for security
 * @param $position int The position in queue
 * @param $code int The accompanying code
*/
function delete($position, $code){
    global $stmt_remove;
    $stmt_remove->bind_param("is", $position, $code);
    $stmt_remove->execute();
}

/**
 * Remove the person at the top of the queue, and add them to the archive
*/
function removeFromQueue(){
    global $stmt_archive;
    $data = getEntry(getNextServed());
    $currentTime = time();
    $joinTime = strtotime($data["time"]);
    $waitTime = $currentTime-$joinTime;
    $prev = getLastArchived();
    echo "Dates: ".date("Y-m-d H:i:s", $currentTime)."--".$prev["processed"]."<br/>";
    echo "Timestamps: ".$currentTime."--".strtotime($prev["processed"])."<br/>";
    $betweenTime = $currentTime-strtotime($prev["processed"]);
    echo $currentTime." | ".$joinTime." | ".date("d H:i:s", $waitTime)." | ". date("d H:i:s", $betweenTime) . "<br/>";
    $stmt_archive->bind_param("iiii",$joinTime, $currentTime, $waitTime, $betweenTime);
    $stmt_archive->execute();
    echo "ERROR: ".$stmt_archive->error;
    delete($data["position"], $data["code"]);
}

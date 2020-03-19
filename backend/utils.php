<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    if(!isset($headless) || $headless == false){
        echo "<!-- JQuery -->\n<script src=\"/public/scripts/jquery.js\"></script>";

    }

    define("ROOT", $_SERVER["DOCUMENT_ROOT"]);
    define("FILES", ROOT."/public");
    define("SHARED", FILES."/shared");
    define("HEADER", SHARED."/header.php");
    define("META", SHARED."/meta.html");
    define("BACKEND", ROOT."/backend");

    include(BACKEND."/config.php");
    include(BACKEND."/.cred.php");

    $conn = new mysqli(DB_ADDRESS, DB_USER, DB_PASS, "qlinic");
    if($conn->connect_error){
        echo("Connection Failed" . $conn->connect_error);
    }
    $conn->query("SET time_zone -4:00");
    date_default_timezone_set("America/Toronto");


    /**
     * List of existing statements
    */
    $statements = [];
    /**
     * Create a prepared statement from a MySQL query
     * @param $query string The query to be used
     * @return mysqli_stmt The prepared statement
     */
    function createStatement($query){
        global $conn, $statements;
        //Check if an identical query exists
        if(isset($statements[$query])){
            //Free the result to ensure clean for next use
            $statements[$query]->free_result();
            return $statements[$query];
        }
        //If not create a new one
        $statements[$query]  = $conn->prepare($query);
        if($conn->error!=""){
            die($conn->error);
        }
        return $statements[$query];
    }

    /**
     * Check that passed values exist in the POST statement
     * @param $values array Array of values to check for
     * @param $missing array Optional array to be populated with missing value names
     * @return bool false if a value is missing
     */
    function checkPost($values, &$missing=[]){
        foreach($values as $val) {
            if (!isset($_POST[$val]))
                array_push($missing, $val);
        }
        return count($missing) == 0;
    }

    /**
     * Sanitize user input to prevent XSS attacks
     * @param $input string The input string to sanitize
     * @param $URLDecode boolean If true, will run urlDecode
     * @return string The sanitized string
    */
    function sanitizeInput($input, $URLDecode=true){
        if($URLDecode) {
            $input = urldecode($input);
        }
        return htmlspecialchars($input, ENT_QUOTES, 'UTF-8');
    }

    function formatDuration($seconds, $includeSeconds=false){
	    $minutes = 0;
	    $hours = 0;
	    if($seconds > 60){
	    	$minutes = (int) $seconds/60;
		$seconds = $seconds % 60;
	    }
	    if($minutes > 60){
	    	$hours = (int) $minutes/60;
		$minutes = $minutes % 60;
	    }

	    if($includeSeconds){
	    	return "$hours:$minutes:$seconds";
	    }
	    return "$hours:$minutes";
    
    }

// Function to get the client IP address
// From:https://stackoverflow.com/questions/15699101/get-the-client-ip-address-using-php
function getIP() {
    $ipaddress='';
    if (getenv('HTTP_CLIENT_IP'))
        $ipaddress = getenv('HTTP_CLIENT_IP');
    else if(getenv('HTTP_X_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
    else if(getenv('HTTP_X_FORWARDED'))
        $ipaddress = getenv('HTTP_X_FORWARDED');
    else if(getenv('HTTP_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_FORWARDED_FOR');
    else if(getenv('HTTP_FORWARDED'))
        $ipaddress = getenv('HTTP_FORWARDED');
    else if(getenv('REMOTE_ADDR'))
        $ipaddress = getenv('REMOTE_ADDR');
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}

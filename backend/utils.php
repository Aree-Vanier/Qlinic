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

    $serverName = "qlinic.gregk.ca";
    $username = "dev";
    $password = "#Qlinic2020";

    $conn = new mysqli($serverName, $username, $password, "qlinic");
    if($conn->connect_error){
        echo("Connection Failed" . $conn->connect_error);
    }
    $conn->query("SET time_zone -5:00");
    date_default_timezone_set("EST");


    /**
     * List of existing statements
    */
    $statements = [];
    /**
     * Create a prepared statement from a MySQL query
     * @param $query string The query to be used
     * @return mysqli_stmt The prepared statement
     */
    function createStmt($query){
        global $conn, $statements;
        //Check if an identical query exists
        if(isset($statements[$query])){
            //Free the result to ensure clean for next use
            $statements[$query]->free_result();
            return $statements[$query];
        }
        //If not create a new one
        $statements[$query]  = $conn->prepare($query);
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


<!-- JQuery -->
<script src="/public/scripts/jquery.js"></script>
<?php
    define("ROOT", $_SERVER["DOCUMENT_ROOT"]);
    define("FILES", ROOT."/public");
    define("SHARED", FILES."/shared");
    define("HEADER", SHARED."/header.php");
    define("META", SHARED."/meta.html");
    define("BACKEND", ROOT."/backend");


    $serverName = "localhost";
    $username = "root";
    $password = "usbw";

    $queue = new mysqli($serverName, $username, $password, "queue");
    if($queue->connect_error){
        echo("Connection Failed" . $queue->connect_error);
    }
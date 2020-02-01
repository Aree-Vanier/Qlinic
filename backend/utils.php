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

    $conn = new mysqli($serverName, $username, $password, "queue");
    if($conn->connect_error){
        echo("Connection Failed" . $conn->connect_error);
    }
<!-- JQuery -->
<script src="/public/scripts/jquery.js"></script>
<?php
    define("ROOT", $_SERVER["DOCUMENT_ROOT"]);
    define("FILES", ROOT."/public");
    define("SHARED", FILES."/shared");
    define("HEADER", SHARED."/header.php");
    define("META", SHARED."/meta.html");
    define("BACKEND", ROOT."/backend");


    $serverName = "qlinic.gregk.ca";
    $username = "dev";
    $password = "#Qlinic2020";

    $conn = new mysqli($serverName, $username, $password, "qlinic");
    if($conn->connect_error){
        echo("Connection Failed" . $conn->connect_error);
    }
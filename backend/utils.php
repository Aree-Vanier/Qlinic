<!--Include bootstrap on all pages-->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

<?php
    define("ROOT", $_SERVER["DOCUMENT_ROOT"]);
    define("FILES", ROOT."/public");
    define("SHARED", FILES."/shared");
    define("HEADER", SHARED."/header.php");
    define("META", SHARED."/meta.html");
    define("END", SHARED."/end.html");
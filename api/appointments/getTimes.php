<?php

include $_SERVER["DOCUMENT_ROOT"] . "/backend/utils.php";
include BACKEND."/appointments.php";

//echo "Getting info <br/>";
//echo json_encode(getAvailable(1583298000));
echo "Running<br/>";
echo implode("<br/>", getInRange(0,99999999999));

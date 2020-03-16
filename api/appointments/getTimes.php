<?php

include $_SERVER["DOCUMENT_ROOT"] . "/backend/utils.php";
include BACKEND."/appointments.php";

//echo "Getting info <br/>";
//echo json_encode(getAvailable(1583298000));
echo "Running<br/>";
print_r(getBookedOnDate(1584118800));

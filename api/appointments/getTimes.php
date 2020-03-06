<?php

include $_SERVER["DOCUMENT_ROOT"] . "/backend/utils.php";
include BACKEND."/appointments.php";

//echo "Getting info <br/>";
echo json_encode(getAllPossibleTimes(strtotime('today midnight')));
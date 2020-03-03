<?php

include $_SERVER["DOCUMENT_ROOT"] . "/backend/utils.php";
include BACKEND."/appointments.php";

echo "Getting info <br/>";
echo implode(",",getPossibleTimes(1, strtotime('today midnight')));
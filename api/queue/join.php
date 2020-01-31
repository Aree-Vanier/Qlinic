<?php
include($_SERVER["DOCUMENT_ROOT"] . "/backend/utils.php");
include (BACKEND."/queue.php");

echo ("API to join queue<br/>");
echo ("There are ".getQueueLength()." people in queue<br/>");
echo ("The next available number is ".getNextAvailable());
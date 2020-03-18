<?php
include_once $_SERVER["DOCUMENT_ROOT"]."/backend/utils.php";
include_once BACKEND."/notifications.php";

sendSMS('Test Notification', '6139297295');
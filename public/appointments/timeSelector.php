<?php
$headless = true;
include_once($_SERVER["DOCUMENT_ROOT"] . "/backend/utils.php");
include_once(BACKEND."/appointments.php")
?>

<div class="scroller" style="height: 14em" id="timeScroller">

    <?php
        $times = getAvailable($_GET["date"])[$_GET["server"]];
        foreach($times as $time){
            if ($time < time())
                continue;
            $timeString = date("g:i A", $time);
            echo "<div class='scrollItem' id='$time'>\n";
            echo "\t<span class='scrollTitle'>$timeString</span>\n";
            echo "</div>\n";
        }

        ?>

    <input class="scrollerInput" name="time" id="time" value="" hidden>
</div>
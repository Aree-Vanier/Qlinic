<?php
include_once($_SERVER["DOCUMENT_ROOT"] . "/backend/utils.php");
include_once(BACKEND."/appointments.php")
?>

<div class="scroller" style="height: 14em">
    <input class="scrollerInput" name="time" type="hidden" value="">

    <?php
        $times = getAvailable($_GET["date"])[1];
        foreach($times as $time){
            $timeString = date("g:i A", $time);
            echo "<div class='scrollItem' id='$time'>\n";
            echo "\t<span class='scrollTitle'>$timeString</span>\n";
            echo "</div>\n";
        }

        ?>
</div>
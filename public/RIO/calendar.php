<?php include_once($_SERVER["DOCUMENT_ROOT"] . "/backend/utils.php") ?>
<?php include_once($_SERVER["DOCUMENT_ROOT"] . "/backend/appointments.php");
//$booked = FUNCTION();

$weekStart = strtotime("last sunday midnight", time());
$today = getDateTimestamp(time());
?>
<script>
    function onCalendarClick(element){
        element.classList.add("selected");
        let old = document.getElementById("calendarSelected").value;
        document.getElementById("calendarSelected").value = element.id;
        document.getElementById(old).classList.remove("selected");
    }

</script>

<h2>Upcoming:</h2>
<input id="calendarSelected" type="hidden" value="">
<table style="width:100%; height:100%">
    <?php
        define("WEEK_LENGTH", 3600*24*7);
        define("DAY_LENGTH", 3600*24);
        for($wk = 0; $wk<3; $wk++){
            echo "<tr>";
            for($day = 0; $day<7; $day++){
                $date = $weekStart+$wk*WEEK_LENGTH+$day*DAY_LENGTH;
                echo "<td onclick='onCalendarClick(this)' id='$date'>";
                if($date == $today){
                    echo "<strong>";
                }
                echo "<span class='date'>".date("D M dS", $date)."</span>";
                if($date == $today){
                    echo "</strong>";
                }
                echo "</td>";
            }
            echo "</tr>";
        }
    ?>

</table>
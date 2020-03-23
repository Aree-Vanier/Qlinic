<?php include_once($_SERVER["DOCUMENT_ROOT"] . "/backend/utils.php") ?>
<?php include_once($_SERVER["DOCUMENT_ROOT"] . "/backend/appointments.php");
//$booked = FUNCTION();

$weekStart = strtotime("last sunday midnight", time());
$today = getDateTimestamp(time());
?>
<script>
    function onCalendarClick(element){
        let old = document.getElementById("calendarSelected").value;
        document.getElementById("calendarSelected").value = element.id;
        document.getElementById(old).classList.remove("selected");
        element.classList.add("selected");
    }

</script>

<h2>Upcoming:</h2>
<input id="calendarSelected" type="hidden" value="<?php echo $today?>">
<table style="width:100%; height:100%">
    <?php
        define("WEEK_LENGTH", 3600*24*7);
        define("DAY_LENGTH", 3600*24);
        for($wk = 0; $wk<3; $wk++){
            echo "<tr>";
            for($day = 0; $day<7; $day++){
                $date = $weekStart+$wk*WEEK_LENGTH+$day*DAY_LENGTH;
                $booked = count(getBookedOnDate($date));
                $available = 0;
                foreach(getAvailable($date) as $s){
                    $available += count($s);
                }

                $dateString = date("D M dS", $date);
                $class = "";
                if($date == $today){
                    $dateString = "<strong>$dateString</strong>";
                    $class = "class='selected'";
                }
                echo "<td onclick='onCalendarClick(this)' id='$date' $class> 
                        <span class='date'>$dateString</span><br/><br/>
                        Booked:<br/>
                        <div style='margin-left:1em; font-size:1.5em'>$booked</div><br/>
                        Available:<br/>
                        <div style='margin-left:1em; font-size:1.5em'>$available</div>
                      </td>";
            }
            echo "</tr>";
        }
    ?>

</table>
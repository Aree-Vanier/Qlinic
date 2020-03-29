<?php
$headless = true;
include_once($_SERVER["DOCUMENT_ROOT"] . "/backend/utils.php");
include_once(BACKEND."/appointments.php");

$date = 0;
if(isset($_GET["date"])){
    $date = $_GET["date"];
} else {
    $date = time();
}
?>


<div style="width:100%; height:100%">
    <h2><?php
        if(getDateString($date) == getDateString(time())){
            echo "Today";
        } else {
            echo date("D M dS", $date);
        }
        ?></h2>
    <input id="agendaDate" type="hidden" value="<?php echo $date ?>">
    <div class="scroller" id="agendaScroller" style="height: 100%;">
        <input class="scrollerInput" id="agendaSelect" type="hidden" value="">
        <?php
            $booked = getAgendaDetails($date);
            foreach($booked as $appt){
                $code = $appt["code"];
                $name = $appt["firstname"]." ".$appt["lastname"];
                $server = getServers()[$appt["server"]];
                $time = date("g:i A", getDateTimestamp($appt["date"])+$appt["time"]);
                echo "
                    <div class=\"scrollItem\" id=\"appt-$code\" onclick=\"showAppointmentInfo(this)\">
                        <span class=\"scrollTitle\">$name</span>
                        <span class=\"scrollInfo\">$time</span><br/>
                        <span class=\"scrollTitle\">$code</span>
                        <span class=\"scrollInfo\">$server</span>
                    </div>
                ";

            }
        ?>
    </div>
</div>
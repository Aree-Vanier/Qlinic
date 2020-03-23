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
        <div class="scrollItem" id="">
            <span class="scrollTitle">Robert Alberts</span>
            <span class="scrollInfo">10:30</span><br/>
            <span class="scrollTitle">CJZFM</span>
            <span class="scrollInfo">Dr. Brown</span>
        </div>
        <div class="scrollItem" id="">
            <span class="scrollTitle">Nancy Kennelly</span>
            <span class="scrollInfo">10:30</span><br/>
            <span class="scrollTitle">XBGFZ</span>
            <span class="scrollInfo">Dr. Jones</span>
        </div>
        <div class="scrollItem" id="">
            <span class="scrollTitle">Roger Libby</span>
            <span class="scrollInfo">11:00</span><br/>
            <span class="scrollTitle">HSOLK</span>
            <span class="scrollInfo">Dr. Jones</span>
        </div>
        <div class="scrollItem" id="">
            <span class="scrollTitle">Elias Trent</span>
            <span class="scrollInfo">11:30</span><br/>
            <span class="scrollTitle">VVVGV</span>
            <span class="scrollInfo">Dr. Brown</span>
        </div>
        <div class="scrollItem" id="KXPEF">
            <span class="scrollTitle">Alice Grant</span>
            <span class="scrollInfo">12:00</span><br/>
            <span class="scrollTitle">KXPEF</span>
            <span class="scrollInfo">Dr. Brown</span>
        </div>
        <div class="scrollItem" id="">
            <span class="scrollTitle">Athur Jones</span>
            <span class="scrollInfo">12:00</span><br/>
            <span class="scrollTitle">UXLEB</span>
            <span class="scrollInfo">Dr. Jones</span>
        </div>
        <div class="scrollItem" id="">
            <span class="scrollTitle">Athur Jones</span>
            <span class="scrollInfo">12:00</span><br/>
            <span class="scrollTitle">UXLEB</span>
            <span class="scrollInfo">Dr. Jones</span>
        </div>
        <div class="scrollItem" id="">
            <span class="scrollTitle">Athur Jones</span>
            <span class="scrollInfo">12:00</span><br/>
            <span class="scrollTitle">UXLEB</span>
            <span class="scrollInfo">Dr. Jones</span>
        </div>
        <div class="scrollItem" id="">
            <span class="scrollTitle">Athur Jones</span>
            <span class="scrollInfo">12:00</span><br/>
            <span class="scrollTitle">UXLEB</span>
            <span class="scrollInfo">Dr. Jones</span>
        </div>
        <div class="scrollItem" id="">
            <span class="scrollTitle">Athur Jones</span>
            <span class="scrollInfo">12:00</span><br/>
            <span class="scrollTitle">UXLEB</span>
            <span class="scrollInfo">Dr. Jones</span>
        </div>
        <div class="scrollItem" id="">
            <span class="scrollTitle">Athur Jones</span>
            <span class="scrollInfo">12:00</span><br/>
            <span class="scrollTitle">UXLEB</span>
            <span class="scrollInfo">Dr. Jones</span>
        </div>
        <div class="scrollItem" id="">
            <span class="scrollTitle">Athur Jones</span>
            <span class="scrollInfo">12:00</span><br/>
            <span class="scrollTitle">UXLEB</span>
            <span class="scrollInfo">Dr. Jones</span>
        </div>
        <div class="scrollItem" id="">
            <span class="scrollTitle">Athur Jones</span>
            <span class="scrollInfo">12:00</span><br/>
            <span class="scrollTitle">UXLEB</span>
            <span class="scrollInfo">Dr. Jones</span>
        </div>
        <div class="scrollItem" id="">
            <span class="scrollTitle">Athur Jones</span>
            <span class="scrollInfo">12:00</span><br/>
            <span class="scrollTitle">UXLEB</span>
            <span class="scrollInfo">Dr. Jones</span>
        </div>
        <div class="scrollItem" id="">
            <span class="scrollTitle">Athur Jones</span>
            <span class="scrollInfo">12:00</span><br/>
            <span class="scrollTitle">UXLEB</span>
            <span class="scrollInfo">Dr. Jones</span>
        </div>
        <div class="scrollItem" id="">
            <span class="scrollTitle">Athur Jones</span>
            <span class="scrollInfo">12:00</span><br/>
            <span class="scrollTitle">UXLEB</span>
            <span class="scrollInfo">Dr. Jones</span>
        </div>
        <div class="scrollItem" id="">
            <span class="scrollTitle">Athur Jones</span>
            <span class="scrollInfo">12:00</span><br/>
            <span class="scrollTitle">UXLEB</span>
            <span class="scrollInfo">Dr. Jones</span>
        </div>
        <div class="scrollItem" id="">
            <span class="scrollTitle">Athur Jones</span>
            <span class="scrollInfo">12:00</span><br/>
            <span class="scrollTitle">UXLEB</span>
            <span class="scrollInfo">Dr. Jones</span>
        </div>
        <div class="scrollItem" id="">
            <span class="scrollTitle">Athur Jones</span>
            <span class="scrollInfo">12:00</span><br/>
            <span class="scrollTitle">UXLEB</span>
            <span class="scrollInfo">Dr. Jones</span>
        </div>
        <div class="scrollItem" id="">
            <span class="scrollTitle">Athur Jones</span>
            <span class="scrollInfo">12:00</span><br/>
            <span class="scrollTitle">UXLEB</span>
            <span class="scrollInfo">Dr. Jones</span>
        </div>
        <div class="scrollItem" id="">
            <span class="scrollTitle">Athur Jones</span>
            <span class="scrollInfo">12:00</span><br/>
            <span class="scrollTitle">UXLEB</span>
            <span class="scrollInfo">Dr. Jones</span>
        </div>
        <div class="scrollItem" id="">
            <span class="scrollTitle">Athur Jones</span>
            <span class="scrollInfo">12:00</span><br/>
            <span class="scrollTitle">UXLEB</span>
            <span class="scrollInfo">Dr. Jones</span>
        </div>
        <div class="scrollItem" id="">
            <span class="scrollTitle">Athur Jones</span>
            <span class="scrollInfo">12:00</span><br/>
            <span class="scrollTitle">UXLEB</span>
            <span class="scrollInfo">Dr. Jones</span>
        </div>
    </div>
</div>
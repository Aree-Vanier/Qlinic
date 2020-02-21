<?php include($_SERVER["DOCUMENT_ROOT"] . "/backend/utils.php") ?>
<!doctype html>
<html lang="en">
<head>
    <title>Template Page</title>
    <?php include(META) ?>
    <?php include(BACKEND . "/queue.php") ?>
    <link rel="stylesheet" type="text/css" href="/public/styles/rio.css"/>
    <script src="/public/scripts/scroller.js"></script>
    <script src="/public/scripts/dialog.js"></script>
    <script>
        function updateQueue(result) {
            $.ajax({
                url: "/RIO/rio", success: function (result) {
                    console.log("Updated");
                    var newer = new DOMParser().parseFromString(result, "text/html");
                    document.getElementById("queueScroller").innerHTML = newer.getElementById("queueScroller").innerHTML;
                }
            });
        }

        setInterval(updateQueue, 30000);

        new Dialog({
            title:"Dialog",
            content:"This is a dialog",
            buttons:"Buttons!"
        });
    </script>
</head>

<body>
<header>
    <img src="/public/images/logo.svg"/><br/>
    Receptionist Interface
</header>
<div id="container">
    <section id="queue">
        <h1>Queue</h1>
        <button>Serve Next</button>
        <br/>
        <div class="scroller" id="queueScroller">
            <input class="scrollerInput" name="time" type="hidden" value="">
            <?php
            $queue = getFullQueue();
            $idx = 0;
            foreach ($queue as $client) {
                $class = $idx == 0 ? "current" : ($idx == 1 ? "next" : "");
                $follow = $idx == 0 ? "(NOW SERVING)" : ($idx == 1 ? "(NEXT)" : "");
                echo ' <div class="scrollItem ' . $class . '" id="">
                    <span class="scrollTitle">' . $client["name"] . '</span>
                    <span class="scrollInfo position">#' . $client["position"] . '</span><br/>
                    <span class="scrollTitle">' . $client["code"] . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' . $follow . '</span>
                    </div>';
                $idx++;
            }

            ?>
        </div>
        <div id="buttons">
            <button>Add to queue</button>
            <button>Remove from queue</button>
        </div>
    </section>
    <section id="appointments">
        <div>
            <h1 style="margin-bottom:0">Appointments</h1>
            <div style="margin:0.25em 0">
                <button>Book</button>
                <button>Find</button>
            </div>
        </div>
        <div class="agenda">
            <h2>Today</h2>
            <div class="scroller">
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
                <div class="scrollItem" id="">
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
            </div>
        </div>
        <div class="calendar">
            <h2>This Month</h2>
            <div class="week">
                <div class="day">17-Mon</div>
                <div class="day">18-Tue</div>
                <div class="day">19-Wed</div>
                <div class="day">20-Thu</div>
                <div class="day">21-Fri</div>
            </div>
            <div class="week">
                <div class="day">24-Mon</div>
                <div class="day">25-Tue</div>
                <div class="day">26-Wed</div>
                <div class="day">27-Thu</div>
                <div class="day">28-Fri</div>
            </div>
        </div>
    </section>
</div>


</body>
</html>
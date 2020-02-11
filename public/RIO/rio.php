<?php include($_SERVER["DOCUMENT_ROOT"] . "/backend/utils.php") ?>
<!doctype html>
<html lang="en">
<head>
    <title>Template Page</title>
    <?php include(META) ?>
    <link rel="stylesheet" type="text/css" href="/public/styles/rio.css"/>
    <script src="/public/scripts/scroller.js"></script>
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
        <div class="scroller">
            <input class="scrollerInput" name="time" type="hidden" value="">
            <div class="scrollItem current" id="1100">
                <span class="scrollTitle">Gregory Kelly</span>
                <span class="scrollInfo position">#30</span><br/>
                <span class="scrollTitle">QWERTYT</span>
            </div>
            <div class="scrollItem next" id="1100">
                <span class="scrollTitle">Gregory Kelly</span>
                <span class="scrollInfo position">#30</span><br/>
                <span class="scrollTitle">QWERTYT</span>
            </div>
            <div class="scrollItem" id="1100">
                <span class="scrollTitle">Gregory Kelly</span>
                <span class="scrollInfo position">#30</span><br/>
                <span class="scrollTitle">QWERTYT</span>
            </div>
            <div class="scrollItem" id="1100">
                <span class="scrollTitle">Gregory Kelly</span>
                <span class="scrollInfo position">#30</span><br/>
                <span class="scrollTitle">QWERTYT</span>
            </div>
            <div class="scrollItem" id="1100">
                <span class="scrollTitle">Gregory Kelly</span>
                <span class="scrollInfo position">#30</span><br/>
                <span class="scrollTitle">QWERTYT</span>
            </div>
            <div class="scrollItem" id="1100">
                <span class="scrollTitle">Gregory Kelly</span>
                <span class="scrollInfo position">#30</span><br/>
                <span class="scrollTitle">QWERTYT</span>
            </div>
            <div class="scrollItem" id="1100">
                <span class="scrollTitle">Gregory Kelly</span>
                <span class="scrollInfo position">#30</span><br/>
                <span class="scrollTitle">QWERTYT</span>
            </div>
            <div class="scrollItem" id="1100">
                <span class="scrollTitle">Gregory Kelly</span>
                <span class="scrollInfo position">#30</span><br/>
                <span class="scrollTitle">QWERTYT</span>
            </div>
            <div class="scrollItem" id="1100">
                <span class="scrollTitle">Gregory Kelly</span>
                <span class="scrollInfo position">#30</span><br/>
                <span class="scrollTitle">QWERTYT</span>
            </div>
            <div class="scrollItem" id="1100">
                <span class="scrollTitle">Gregory Kelly</span>
                <span class="scrollInfo position">#30</span><br/>
                <span class="scrollTitle">QWERTYT</span>
            </div>
            <div class="scrollItem" id="1100">
                <span class="scrollTitle">Gregory Kelly</span>
                <span class="scrollInfo position">#30</span><br/>
                <span class="scrollTitle">QWERTYT</span>
            </div>
            <div class="scrollItem" id="1100">
                <span class="scrollTitle">Gregory Kelly</span>
                <span class="scrollInfo position">#30</span><br/>
                <span class="scrollTitle">QWERTYT</span>
            </div>
            <div class="scrollItem" id="1100">
                <span class="scrollTitle">Gregory Kelly</span>
                <span class="scrollInfo position">#30</span><br/>
                <span class="scrollTitle">QWERTYT</span>
            </div>
            <div class="scrollItem" id="1100">
                <span class="scrollTitle">Gregory Kelly</span>
                <span class="scrollInfo position">#30</span><br/>
                <span class="scrollTitle">QWERTYT</span>
            </div>
            <div class="scrollItem" id="1100">
                <span class="scrollTitle">Gregory Kelly</span>
                <span class="scrollInfo position">#30</span><br/>
                <span class="scrollTitle">QWERTYT</span>
            </div>
            <div class="scrollItem" id="1100">
                <span class="scrollTitle">Gregory Kelly</span>
                <span class="scrollInfo position">#30</span><br/>
                <span class="scrollTitle">QWERTYT</span>
            </div>
            <div class="scrollItem" id="1100">
                <span class="scrollTitle">Gregory Kelly</span>
                <span class="scrollInfo position">#30</span><br/>
                <span class="scrollTitle">QWERTYT</span>
            </div>
            <div class="scrollItem" id="1100">
                <span class="scrollTitle">Gregory Kelly</span>
                <span class="scrollInfo position">#30</span><br/>
                <span class="scrollTitle">QWERTYT</span>
            </div>
            <div class="scrollItem" id="1100">
                <span class="scrollTitle">Gregory Kelly</span>
                <span class="scrollInfo position">#30</span><br/>
                <span class="scrollTitle">QWERTYT</span>
            </div>
            <div class="scrollItem" id="1100">
                <span class="scrollTitle">Gregory Kelly</span>
                <span class="scrollInfo position">#30</span><br/>
                <span class="scrollTitle">QWERTYT</span>
            </div>
            <div class="scrollItem" id="1100">
                <span class="scrollTitle">Gregory Kelly</span>
                <span class="scrollInfo position">#30</span><br/>
                <span class="scrollTitle">QWERTYT</span>
            </div>
        </div>
        <div id="buttons">
            <button>Add to queue</button>
            <button>Remove from queue</button>
        </div>
    </section>
    <section id="appointments">
        <div>
            <h1>Appointments</h1>
            <button>Book Appointment</button>
            <button>Find Appointment</button>
        </div>
        <div class="agenda">
            <h2>Today's Appointments</h2>
            <div class="scroller">

            </div>
        </div>
        <div class="calendar">
            <h2>Two Weeks</h2>

        </div>
    </section>
</div>
</body>
</html>
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
            <div class="scrollItem" id="">
                <span class="scrollTitle">Gavin Estevez</span>
                <span class="scrollInfo position">#16</span><br/>
                <span class="scrollTitle">OJCPL</span>
            </div>
            <div class="scrollItem current" id="">
                <span class="scrollTitle">Gavin Estevez&nbsp;&nbsp;(NOW SERVING)</span>
                <span class="scrollInfo position">#16</span><br/>
                <span class="scrollTitle">OJCPL</span>
            </div>
            <div class="scrollItem next" id="">
                <span class="scrollTitle">Ned Everette&nbsp;&nbsp;(NEXT)</span>
                <span class="scrollInfo position">#17</span><br/>
                <span class="scrollTitle">QFAUF</span>
            </div>
            <div class="scrollItem" id="">
                <span class="scrollTitle">Bud Wedell</span>
                <span class="scrollInfo position">#18</span><br/>
                <span class="scrollTitle">JIKLO</span>
            </div>
            <div class="scrollItem" id="">
                <span class="scrollTitle">Whitney Sapp</span>
                <span class="scrollInfo position">#19</span><br/>
                <span class="scrollTitle">ZOSML</span>
            </div>
            <div class="scrollItem" id="">
                <span class="scrollTitle">Shon Pitzer</span>
                <span class="scrollInfo position">#20</span><br/>
                <span class="scrollTitle">OJIII</span>
            </div>
            <div class="scrollItem" id="">
                <span class="scrollTitle">Korey Winchenbach</span>
                <span class="scrollInfo position">#21</span><br/>
                <span class="scrollTitle">KHMON</span>
            </div>
            <div class="scrollItem" id="">
                <span class="scrollTitle">Chi Mount</span>
                <span class="scrollInfo position">#22</span><br/>
                <span class="scrollTitle">WUPIO</span>
            </div>
            <div class="scrollItem" id="">
                <span class="scrollTitle">Sung Tygart</span>
                <span class="scrollInfo position">#23</span><br/>
                <span class="scrollTitle">UDVDW</span>
            </div>
            <div class="scrollItem" id="">
                <span class="scrollTitle">Donnie Oliverio</span>
                <span class="scrollInfo position">#24</span><br/>
                <span class="scrollTitle">CBKUL</span>
            </div>
            <div class="scrollItem" id="">
                <span class="scrollTitle">Tomas Ptak</span>
                <span class="scrollInfo position">#25</span><br/>
                <span class="scrollTitle">ARLGC</span>
            </div>
            <div class="scrollItem" id="">
                <span class="scrollTitle">David Marcotte</span>
                <span class="scrollInfo position">#26</span><br/>
                <span class="scrollTitle">RPMFM</span>
            </div>
            <div class="scrollItem" id="">
                <span class="scrollTitle">Shirleen Bruch</span>
                <span class="scrollInfo position">#27</span><br/>
                <span class="scrollTitle">VCFOL</span>
            </div>
            <div class="scrollItem" id="">
                <span class="scrollTitle">Nada Fox</span>
                <span class="scrollInfo position">#28</span><br/>
                <span class="scrollTitle">BREIM</span>
            </div>
            <div class="scrollItem" id="">
                <span class="scrollTitle">Cornelia Edlin</span>
                <span class="scrollInfo position">#29</span><br/>
                <span class="scrollTitle">MYNEB</span>
            </div>
            <div class="scrollItem" id="">
                <span class="scrollTitle">Danica Muff</span>
                <span class="scrollInfo position">#30</span><br/>
                <span class="scrollTitle">NYQJR</span>
            </div>
            <div class="scrollItem" id="">
                <span class="scrollTitle">Lilia Lomas</span>
                <span class="scrollInfo position">#31</span><br/>
                <span class="scrollTitle">QGFMW</span>
            </div>
            <div class="scrollItem" id="">
                <span class="scrollTitle">Jeffry Brodie</span>
                <span class="scrollInfo position">#32</span><br/>
                <span class="scrollTitle">XBGFZ</span>
            </div>
            <div class="scrollItem" id="">
                <span class="scrollTitle">Cyril Teitelbaum</span>
                <span class="scrollInfo position">#33</span><br/>
                <span class="scrollTitle">CJZFM</span>
            </div>
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
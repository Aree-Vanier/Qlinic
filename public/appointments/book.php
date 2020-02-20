<?php include($_SERVER["DOCUMENT_ROOT"] . "/backend/utils.php") ?>
<!doctype html>
<html lang="en">
<head>
    <title>Template Page</title>
    <?php include(META) ?>
    <script src="/scripts/forms.js"></script>
    <script src="/scripts/scroller.js"></script>
</head>

<body>
<?php include(HEADER) ?>

<section>
    <h1>Book Appointment</h1>
    <form>
        <table>
            <tr>
                <td>Name</td>
                <td><input id="name" type="text" placeholder="John Doe" required/></td>
            </tr>
            <tr>
                <td>Email</td>
                <td><input id="email" type="email" placeholder="mail@example.com"/></td>
            </tr>
            <tr>
                <td>Phone #</td>
                <td><input id="phone" type="tel" placeholder="123-456-7890" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}"
                           oninput="formatNumber(this)"/>
                </td>
            </tr>
			<tr><td><br/></td></tr>
            <tr>
                <td>Date</td>
                <td>
                    <select>
                        <option value="0">Today</option>
                        <option value="1">Monday 03</option>
                        <option value="2">Tuesday 04</option>
                        <option value="3">Wednesday 05</option>
                        <option value="4">Thursday 06</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Doctor</td>
                <td>
                    <select>
                        <option value="0">Dr. Brown</option>
                        <option value="1">Dr. Flowers</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Time</td>
                <td>
                    <div class="scroller">
                        <input class="scrollerInput" name="time" type="hidden" value="">
                        <div class="scrollItem" id="1100">
                            <span class="scrollTitle">11:00</span>
                            <span class="scrollInfo">2 remaining</span><br/>
<!--                            <span class="scrollTitle">Subtitle</span>-->
                        </div>
                        <div class="scrollItem selected" id="1130">
                            <span class="scrollTitle">11:30</span>
                            <span class="scrollInfo">3 remaining</span><br/>
<!--                            <span class="scrollTitle">Subtitle</span>-->
                        </div>
                        <div class="scrollItem" id="1200">
                            <span class="scrollTitle">12:00</span>
                            <span class="scrollInfo">1 remaining</span><br/>
<!--                            <span class="scrollTitle">Time 1</span>-->
                        </div>
                        <div class="scrollItem" id="1230">
                            <span class="scrollTitle">12:30</span>
                            <span class="scrollInfo">2 remaining</span><br/>
<!--                            <span class="scrollTitle">Time 1</span>-->
                        </div>
                        <div class="scrollItem" id="1300">
                            <span class="scrollTitle">1:00</span>
                            <span class="scrollInfo">2 remaining</span><br/>
<!--                            <span class="scrollTitle">Time 1</span>-->
                        </div>
                    </div>
                </td>
            </tr>
			<tr><td><br/></td></tr>
            <tr>
                <td>Reason</td>
                <td><input type="text" id="reason" placeholder="Reason"></td>
            </tr>
        </table>


        </div>

        <input type="submit" value="Book">
    </form>
</section>

</body>
</html>
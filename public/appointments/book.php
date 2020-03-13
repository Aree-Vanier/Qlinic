<?php
include($_SERVER["DOCUMENT_ROOT"] . "/backend/utils.php");
include_once(BACKEND."/appointments.php")
?>
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
                        <?php
                            for($i=0; $i<14; $i++){
                                $date = date("D M d", strtotime("today midnight")+3600*24*$i);
                                echo "<option value=$i>$date   </option>";
                            }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Doctor</td>
                <td>
                    <select>
                        <?php
                            foreach(getServers() as $id=>$name){
                                echo "<option value='$id'>$name</option>";
                            }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Time</td>
                <td>
                    <?php include "timeSelector.php"?>
                </td>
            </tr>
			<tr><td><br/></td></tr>
            <tr>
                <td>Reason</td>
                <td><input type="text" id="reason" placeholder="Reason"></td>
            </tr>
        </table>


        <input type="submit" value="Book">
    </form>
</section>

</body>
</html>
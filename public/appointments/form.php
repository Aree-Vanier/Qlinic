<?php

include_once($_SERVER["DOCUMENT_ROOT"] . "/backend/utils.php");

include_once(BACKEND."/appointments.php");
include_once(META) 

?>


<script src="/scripts/forms.js"></script>
    <script src="/scripts/scroller.js"></script>
    <script src="/scripts/dialog.js"></script>

    <script>
        function updateTimes(){
            let date = Date.now()/1000 + document.getElementById("date").value*24*3600;
            console.log(date);
            let server = document.getElementById("server").value;
            console.log(server);

            $.ajax(`timeSelector?date=${date}&server=${server}`, {success: function(result){
                let selected = document.getElementById("time").value;
                document.getElementById("times").innerHTML=result;
                new SimpleBar(document.getElementById("timeScroller"), {
                    timeout:750,
                });
                try {
                    document.getElementById(selected).classList.add("selected");
                }catch (e) {
                    console.log("No item selected");
                }

                initScrollers();
            }})
        }

        var errorDiag = new Dialog({
            title:"Unknown Error",
            id:"errorDiag",
            content:"An unknown error has occured",
            buttons:[
                {
                    text:"Confirm",
                    onclick:"errorDiag.hide()"
                }
            ]
        });

        $(document).ready(function () {
            console.log("Loaded");
            updateTimes();
            errorDiag.create(errorDiag);
        });

        function onSubmit(){
            let server = document.getElementById("server").value;
            let time = document.getElementById("time").value;
            let name = document.getElementById("name").value;
            let email = document.getElementById("email").value;
            let phone = document.getElementById("phone").value;
            let reason = document.getElementById("email").value;

            if(time === ""){
                errorDiag.title = "No timeslot selected";
                errorDiag.content = "Please select a timeslot";
                errorDiag.rebuild(errorDiag);
                errorDiag.show();
                return false;
            }

            name = name.split(" ");
            let firstName = name[0];
            let lastName="";
            if(name.length > 1) {
                lastName = name[1];
            }

            $.post("/api/appointments/book", {server, time, firstName, lastName, email, phone, reason}, function(data, status){
                console.log(data);
                if(data.startsWith("ERROR:")){
                    errorDiag.title="Error";
                    errorDiag.content=data.split(":")[1];
                    errorDiag.rebuild(errorDiag);
                    errorDiag.show();
                } else {
                    window.location.replace("confirmation.php?code="+data)
                }
            });
            return false;
        }

        setInterval(updateTimes, 120000)

    </script>


    <form onsubmit="return onSubmit()">
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
                    <select id="date" onchange="updateTimes()">
                        <?php
                            for($i=0; $i<14; $i++){
                                $date = date("D M d", strtotime("today midnight")+3600*24*$i);
                                echo "<option value=$i>$date   </option>";
                                if(!isset($_GET["date"])){
                                    $_GET["date"]=strtotime("today midnight")+3600*24*$i;
                                }
                            }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Doctor</td>
                <td>
                    <select id="server" onchange="updateTimes()">
                        <?php
                            foreach(getServers() as $id=>$name){
                                echo "<option value='$id'>$name</option>";
                                if(!isset($_GET["server"])){
                                    $_GET["server"]=$id;
                                }
                            }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Time</td>
                <td id="times">
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
         

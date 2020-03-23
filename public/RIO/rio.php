<?php include_once($_SERVER["DOCUMENT_ROOT"] . "/backend/utils.php") ?>
<?php
	session_start();
?>
<?php
        if(!(isset($_SESSION['loggedin']) && $_SESSION['loggedin'])){
			echo($_SESSION['loggedin']);
			header("Location: /RIO/rlogin");
			exit();
		}
		?>
<!doctype html>
<html lang="en">
<head>
	
    <title>Template Page</title>
    <?php include_once(META) ?>
    <?php include_once(BACKEND . "/queue.php") ?>
    <link rel="stylesheet" type="text/css" href="/public/styles/rio.css"/>
    <script src="/public/scripts/scroller.js"></script>
    <script src="/public/scripts/dialog.js"></script>
	<script src="/public/scripts/forms.js"></script>
    <script>



		function deleteFromQueue() {
			let code = document.getElementById("queueSelect").value;
			let position = document.querySelector("#"+code+" .scrollInfo.position").innerHTML
			position = position.substring(1);
			//let position = document.getElementById(code).querySelector('scrollInfo.position');
			console.log(code);
			console.log(position);
			
			$.post("/api/queue/delete", {code: code, position: position}, function (data, status) {
				console.log(data);
				updateQueue();
				deleteDialog.hide();
			});
			
		}
		
		//TODO: Make content specify user
		//TODO: Add onclick
		deleteDialog = new Dialog({
			title:"",
			content:"Are you sure you want to remove this user?",
			buttons:[
			{
				text:"Confirm",
				onclick:"deleteFromQueue()"
			},
			{
				text:"Cancel",
				onclick:"deleteDialog.hide()"
			}
			]
		});
		
        function updateQueue() {
            $.ajax({
                url: "/RIO/rio", success: function (result) {
                    console.log("Updated");
                    let selected = document.getElementById("queueSelect").value;
                    var newer = new DOMParser().parseFromString(result, "text/html");
                    document.getElementById("queueScroller").outerHTML = newer.getElementById("queueScroller").outerHTML;

                    new SimpleBar(document.getElementById("queueScroller"), {
                        timeout:750,
                    });
                    try {
                        document.getElementById(selected).classList.add("selected");
                    }catch (e) {
                        console.log("No item selected");
                    }

                    initScrollers();
                }
            });
        }

        function serveNext(){
            $.post("/api/queue/serve", {}, function (result) {
                console.log(result);
                updateQueue();
            })
        }

        setInterval(updateQueue, 30000);

        let joinQueueDiag = new Dialog({
            title: "Add to Queue",
            content: `
            <form onsubmit="return addToQueue()" id="addToQueueForm">
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
                        <td><input id="phone" type="tel" placeholder="123-456-7890" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" oninput="formatNumber(this)"/>
                        </td>
                    </tr>
                </table>
            </form>`,
            buttons: [
                {
                    text: "Add",
                    onclick: "",
                    extra: `form="addToQueueForm" value="Submit"`
                },
                {
                    text: "Cancel",
                    onclick: "joinQueueDiag.hide()"
                }

            ]
        });
        let queueConfirmDiag = new Dialog({
            title: "Added to Queue",
            content: "User added to queue",
            buttons:[
                {
                    text:"Close",
                    onclick:"queueConfirmDiag.hide()"
                }
            ]
        });

        let xhttp = new XMLHttpRequest();

        function addToQueue() {
            console.log("Submitting");
            let name = encodeURIComponent(document.getElementById("name").value);
            let email = encodeURIComponent(document.getElementById("email").value);
            let phone = encodeURIComponent(document.getElementById("phone").value);

            $.post("/api/queue/join", {name: name, email: email, phone: phone}, function (data, status) {
                if (status === "success") {
                    if (data.startsWith("SUCCESS")) {
                        let code = data.split(":")[1].split("-");
                        console.log(code);
                        queueConfirmDiag.content="User added to queue in position: "+code[0]+" with code: "+code[1];
                        queueConfirmDiag.rebuild(queueConfirmDiag);
                        joinQueueDiag.hide();
                        queueConfirmDiag.show();
                        updateQueue();
                    } else {
                        console.log(data);
                    }
                }
            });
            return false;
        }

		let bookAppointmentDialog = new Dialog({
			title: "Book Appointment",
			content: "<iframe src='/appointments/form' id='form' seamless></iframe>",
			buttons: [
				{
					text:"Cancel",
					onclick:"bookAppointmentDialog.hide()"
				}
			]
		});

        function updateAgenda(date=null){
            //If date is null use existing date
            if(date == null){
                date = document.getElementById("agendaDate").value;
            }

            $.ajax(`agenda?date=${date}`, {success: function(result){
                    let selected = document.getElementById("agendaSelect").value;
                    document.getElementById("agenda").innerHTML=result;
                    new SimpleBar(document.getElementById("agendaScroller"), {
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

        function updateCalendar(){
            let selected = document.getElementById("calendarSelected").value;
            $.ajax(`calendar?date=${selected}`, {success: function(result){
                document.getElementById("calendar").innerHTML=result;
                try {
                    document.getElementById(selected).classList.add("selected");
                }catch (e) {
                    console.log("No item selected");
                }
            }})
        }

        setInterval(updateCalendar, 120000);
        setInterval(updateAgenda, 120000);

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
        <button onclick="serveNext()">Serve Next</button>
        <br/>
        <div class="scroller" id="queueScroller">
            <input class="scrollerInput" id="queueSelect" type="hidden" value="">
            <?php
            $queue = getFullQueue();
            $idx = 0;
            foreach ($queue as $client) {
                $class = $idx == 0 ? "current" : ($idx == 1 ? "next" : "");
                $follow = $idx == 0 ? "(NOW SERVING)" : ($idx == 1 ? "(NEXT)" : "");
                echo ' <div class="scrollItem ' . $class . '" id="'.$client["code"].'">
                    <span class="scrollTitle">' . $client["name"] . '</span>
                    <span class="scrollInfo position">#' . $client["position"] . '</span><br/>
                    <span class="scrollTitle">' . $client["code"] . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' . $follow . '</span>
                    </div>';
                $idx++;
            }

            ?>
        </div>
        <div id="buttons">
            <button onclick="joinQueueDiag.show()">Add to queue</button>
            <button onclick="deleteDialog.show()">Remove from queue</button>
        </div>
    </section>
    <section id="appointments">
        <div>
            <h1 style="margin-bottom:0">Appointments</h1>
            <div style="margin:0.25em 0">
                <button onclick="bookAppointmentDialog.show()">Book</button>
                <button>Find</button>
            </div>
        </div>
        <div class="agenda" id="agenda">
            <?php include("agenda.php");?>
        </div>
        <div class="calendar" id="calendar">
        <?php
            include "calendar.php";
        ?>
        </div>
    </section>
</div>


</body>
</html>

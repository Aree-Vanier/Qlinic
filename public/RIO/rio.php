<?php include($_SERVER["DOCUMENT_ROOT"] . "/backend/utils.php") ?>
<?php
	session_start();
?>
<?php
		if ($_SESSION['loggedin'] == false || isset($_SESSION['loggedin']) == false)
		{
			echo($_SESSION['loggedin']);
			header("Location: http://localhost/RIO/rlogin");
			exit();
		}
		?>
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
                    var newer = new DOMParser().parseFromString(result, "text/html");
                    document.getElementById("queueScroller").outerHTML = newer.getElementById("queueScroller").outerHTML;

                    new SimpleBar(document.getElementById("queueScroller"), {
                        timeout:750,
                    });
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
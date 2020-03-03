<?php include($_SERVER["DOCUMENT_ROOT"] . "/backend/utils.php") ?>
<!doctype html>
<html lang="en">
<head>
    <title>Join Queue</title>
    <?php include(META) ?>
    <?php include(BACKEND."/queue.php")?>
    <script src="/scripts/forms.js"></script>
    <script>
        let xhttp = new XMLHttpRequest();
        function onSubmit(){
            console.log("Submitting");
            let name = encodeURIComponent(document.getElementById("name").value);
            let email = encodeURIComponent(document.getElementById("email").value);
            let phone = encodeURIComponent(document.getElementById("phone").value);

            $.post("/api/queue/join", {name:name, email:email, phone:phone}, function (data, status) {
                if(status === "success"){
                    if(data.startsWith("SUCCESS")){
                        let code = data.split(":")[1];
                        console.log(code);
                        window.location.replace("/queue/confirmation/"+code);
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
<?php
include(HEADER); ?>
<section>
    <div style="text-align: center;">
        <h2>Estimated Wait Time</h2>
        <h1 style="font-size: 5em; margin:0"><?php echo gmdate("H:i", getTime()) ?></h1>
        <h3><?php echo(getQueueLength())?> people in queue</h3>
    </div>
</section>
<section>
    <h1>Join Queue</h1>
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
                <td><input id="phone" type="tel" placeholder="123-456-7890" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" oninput="formatNumber(this)"/>
                </td>
            </tr>
        </table>
        <input type="submit" value="Join">
    </form>
</section>
</body>
</html>

<?php include($_SERVER["DOCUMENT_ROOT"] . "/backend/utils.php") ?>
<!doctype html>
<html lang="en">
<head>
    <title>Landing Page</title>
    <?php include(META) ?>

</head>

<body>
<?php
include(HEADER); ?>
<section>
    <div style="text-align: center;">
        <h2>Estimated Wait Time</h2>
        <h1 style="font-size: 5em; margin:0">1:00</h1>
        <h3>30 people in queue</h3>
    </div>
</section>
<section>
    <h1>Join Queue</h1>
    <form>
        <table>
            <tr>
                <td>Name:</td>
                <td><input id="name" type="text" placeholder="name" required/></td>
            </tr>
            <tr>
                <td>Email</td>
                <td><input id="email" type="email" placeholder="mail@example.com"/></td>
            </tr>
            <tr>
                <td>Phone #</td>
                <td><input id="phone" type="tel" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" oninput="formatNumber(this)"/>
                </td>
            </tr>
        </table>
        <input type="submit" value="Join">
    </form>
</section>
</body>
</html>
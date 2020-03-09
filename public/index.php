<?php include($_SERVER["DOCUMENT_ROOT"] . "/backend/utils.php") ?>
<!doctype html>
<html lang="en">
<head>
    <title>Qlinic Home</title>
    <?php include(META) ?>
</head>


<body>
<?php include(HEADER); ?>
<section style="display: flex; flex-wrap: wrap; justify-content: center; align-content: space-between; align-items: baseline">
    <a class="button" href="/queue/join" style="font-size:1.5em; margin-bottom:0.5em">Join Queue</a>
    <a class="button" href="/appointments/book" style="font-size:1.5em; margin-top:0.5em">Book Appointment</a>
</section>
</body>
</html>
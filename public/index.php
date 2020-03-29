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

<section>
  <h1 id="about">About Us</h1>
  <p>An issue present to multiple Queen’s students is an inability to access quick healthcare due to the long wait times at the on-campus medical clinic. Qlinic is an app that provides an electronic version of the “take a number” system at clinics. Students can check in to the clinic, see the number of other people ahead of them in line, and see an estimated wait time to see a doctor. Students can also make appointments through Qlinic instead of calling the receptionist.</p>
    <!--<p><3 Raed ;) -___-</p>-->
  <p>Source code can be found at <a href="/github">https://qlinic.gregk.ca/github</a></p>
</section>

</body>
</html>

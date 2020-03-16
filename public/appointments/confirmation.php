<?php include_once($_SERVER["DOCUMENT_ROOT"] . "/backend/utils.php");
include_once(BACKEND . "/appointments.php");

if (!isset($_GET["code"])) {
    die("Missing code");
}

$code = $_GET["code"];

$appointment = getAppointmentDetails($code);

?>
<!doctype html>
<html lang="en">
<head>
    <title>Appointment Confirmation</title>
    <?php include(META) ?>
</head>

<body>
<?php include(HEADER) ?>

<section>
    <h1>Appointment Booked!</h1>
    Details:
    <table>
        <tr>
            <td>Doctor:</td>
            <td><?php echo getServers()[$appointment['server']] ?></td
        </tr>
        <tr>
            <td>Time:</td>
            <td><?php echo date("D M d, g:i A", $appointment['time'] + strtotime($appointment['date'])) ?></td>
        </tr>
        <tr>
            <td>Code</td>
            <td><?php echo $code ?></td>
        </tr>
    </table>
    <p>
        <?php
        $email = $appointment["email"];
        $phone = $appointment["phone"];
        if ($email != "") {
            $phone = substr($phone, 0, 3) . '-' . substr($phone, 3, 3) . '-' . substr($phone, 6);
            echo "Confirmation email sent to $email";
        }
        if ($email != "" and $phone != "") echo "<br/>";
        if ($phone != "") echo "Confirmation text sent to $phone";
        ?>
    </p>

</section>

</body>
</html>
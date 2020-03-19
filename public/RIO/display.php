<?php //include($_SERVER["DOCUMENT_ROOT"] . "/backend/utils.php") ?>
<!doctype html>
<html lang="en">
<head>
    <title>Waiting Room Display</title>
    <link rel="stylesheet" type="text/css" href="/public/styles/display.css">
    <style>
    </style>
</head>

<body>

<table>
    <tr>
        <td>
            <table>
                <tr id="current">
                    <td style="font-size:1.5em">
                        Now Serving<br/>
                        <span id="serving">3</span>
                    </td>
                </tr>
                <tr>
                    <td id="wait" style="font-size:1.5em">
                        Estimated Wait<br/>
                        <span id="serving">5:00</span><br/><br/>
                        Next Number: 7
                    </td>
                </tr>
            </table>
        </td>
        <td style="width:25%">
            <table>
                <tr class="queueTitle">
                    <td>Up Next</td>
                </tr>
                <tr class="queueItem">
                    <td>4</td>
                </tr>
                <tr class="queueItem">
                    <td>5</td>
                </tr>
                <tr class="queueItem" id="time">
                    <td>12:00</td>
                </tr>
            </table>
        </td>
    </tr>
</table>
</body>
</html>
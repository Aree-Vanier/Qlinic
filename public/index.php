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
    <?php
    $var = "Greg is the best!";

    echo "<h1>$var</h1>";

    echo "This is a demonstration page";
    echo "</section>";
    for ($i = 0; $i < 100; $i++) {
        echo "<br/>";
    }
    ?>

</body>
</html>
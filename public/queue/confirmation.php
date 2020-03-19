<?php include($_SERVER["DOCUMENT_ROOT"] . "/backend/utils.php") ?>
<!doctype html>
<html lang="en">
<head>
    <title>Queue Confirmation</title>
    <?php include(META) ?>
    <link rel="stylesheet" href="/styles/header.css">
    <?php
        include(BACKEND."/queue.php");
        $req = explode("-", $_GET["q"]);
        $data = getEntry($req[0]);
        //Don't allow false identifications
        if($req[1] != $data["code"]){
            echo ("Invalid code");
            exit();
        }
?>

<style>
header h1{
	color:white;
	width:fit-content;
	margin:auto;
	margin-top:1em;
}

header img{
	clear:none;
	float:left;
}

@media only screen and (max-width:500px){
header img{
	float:unset;
}

header h1{
	margin-top:0.25em;
}
}
</style>
</head>

<body>
    <header style="text-align: center;">
        <img src="/images/logo.svg">
        <h1 style="color:white">You're in queue!</h1>
    </header>
    <section style="text-align: center;">
        <h2>Your number</h2>
        <h1 style="font-size: 5em; margin:0" id="position"><?php echo $data["position"]?></h1>
        <h2>Code: <span id="code"><?php echo $data["code"]?></span></h2>
    </section>

    <section style="text-align: center;">
        <h2>Estimated wait</h2>
        <h1 style="font-size: 5em; margin:0"><?php echo gmdate("H:i", getTime($data["position"]))?></h1>
        <h2><?php echo getBefore($data["position"]) ?> People ahead of you</h2>
    </section>
</body>
</html>

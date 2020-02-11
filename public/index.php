
<?php include($_SERVER["DOCUMENT_ROOT"] . "/backend/utils.php") ?>
<!doctype html>
<html lang="en">
	<head>
		<style>
			.sbutton { 
				background-color: #87eaed; 
				color: black; 
				padding: 8px; 
				margin: auto;
				margin-top: 1em;
				margin-bottom: 1em;
				display: block;
				-webkit-transition-duration: 0.4s; /* Safari */
				transition-duration: 0.4s;
			} 
			.sbutton:hover{
				background-color: #5d9c9e;
			}
		</style>
		<title>Qlinic Home</title>
		<?php include(META) ?>
	</head>


	<body>
		<?php include(HEADER); ?>
		<div style="margin:auto;background-color: #ebebeb;display: block;width:40%;overflow: hidden">
			<button class="sbutton">This is a button</button>
			<button class="sbutton">This is a second button</button>
		</div>
	</body>
</html>
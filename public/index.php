
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
		<section>
			<button class="sbutton">This is a button</button>
			<button class="sbutton">This is a second button</button>
		</section>
		
		<section>

<div class="about-section">
  <h1>About Us</h1>
  <p>An issue present to multiple Queen’s students is an inability to access quick healthcare due to the long wait times at the on-campus medical clinic. Qlinic is an app that provides an electronic version of the “take a number” system at clinics. Students can check in to the clinic, see the number of other people ahead of them in line, and see an estimated wait time to see a doctor. Students can also make appointments through Qlinic instead of calling the receptionist.</p>
    <p><3 Raed ;) -___-</p>
</div>

		</section>
	</body>
</html>
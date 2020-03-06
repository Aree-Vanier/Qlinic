<?php include($_SERVER["DOCUMENT_ROOT"] . "/backend/utils.php") ?>
<?php session_start(); ?>
<!doctype html>
<html lang="en">
	<head>
    <link rel="stylesheet" href="/styles/login.css">
	</head>
	<body>
		<div class="login">
			<h1>Login to Qlinic Receptionist Interface</h1>
			<form method="post" action="logincheck.php">
				<p><input type="text" name="login" value="" placeholder="Username"></p>
				<p><input type="password" name="password" value="" placeholder="Password"></p>
				<p class="submit"><input type="submit" name="commit" value="Login"></p>
			</form>
		</div>
		<?php
			if(isset($_SESSION['loggedin']) == true && $_SESSION['loggedin'] == false)
			{
				echo "<div class='login'>";
				echo "incorrect credentials, please try again. If the password has been forgotten, contact system administrator";
				echo "<div>";
			}
		?>
		
	</body>
</html>
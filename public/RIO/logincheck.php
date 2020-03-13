<?php
//echo "Serving";
$headless = true;
include($_SERVER["DOCUMENT_ROOT"] . "/backend/utils.php");
include (BACKEND."/queue.php");
session_start();
   if(isset($_POST['login'])&&isset($_POST['password'])) 
   {
		$result = $conn->query("SELECT * FROM qlinic.receptionists");
		while($row = $result->fetch_assoc()){
			$username = ($row['name']);
			$pass = ($row['password']);

			if($_POST['login'] == $username && password_verify($_POST['password'], $pass))
			{
				$_SESSION['loggedin'] = true;
				//echo ("REDIR RIO");
				header("Location: http://localhost/RIO/rio");
				exit();
			}
		

		}
		$conn->close();
		$_SESSION['loggedin'] = false;
		//echo ("REDIR login");
		header("Location: http://localhost/RIO/rlogin");
		exit();
		
   }
?>
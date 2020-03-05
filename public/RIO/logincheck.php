<?php
//echo "Serving";
$headless = true;
include($_SERVER["DOCUMENT_ROOT"] . "/backend/utils.php");
include (BACKEND."/queue.php");
session_start();
   if(isset($_POST['login'])&&isset($_POST['password'])) 
   {
		if($_POST['login'] == "Jeff" && $_POST['password'] == "Bezos")
		{
			$_SESSION['loggedin'] = true;
			echo ("REDIR RIO");
			header("Location: http://localhost/RIO/rio");
			exit();
		}
		else
		{
			$_SESSION['loggedin'] = false;
			echo ("REDIR login");
			header("Location: http://localhost/RIO/rlogin");
			exit();
		}
   }
?>
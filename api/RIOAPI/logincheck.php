<?php
$headless = true;
include($_SERVER["DOCUMENT_ROOT"] . "/backend/utils.php");
include (BACKEND."/queue.php");
session_start();
   if(isset($_POST['login']&&isset($_POST['password')) 
   {
		if($_POST['login'] == "Jeff" && $_POST['password'] == "Bezos")
		{
			$_SESSIONS['loggedin'] = true;
			echo "<a href='/rio.php'></a>";
		}
		else
		{
			echo "<a href='/rlogin.php'></a>";
		}
   }
?>
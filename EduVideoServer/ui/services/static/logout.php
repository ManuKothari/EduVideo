<?php
	session_start();
	if( isset($_SESSION["username"]) )
	{
		unset($_SESSION['username']);
	}
	if( isset($_SESSION['usertype']) )
	{
		unset($_SESSION['usertype']);
	}
	if( isset($_SESSION['uid']) )
	{
		unset($_SESSION['uid']);
	}
	session_destroy();
	header("Location: index.php");
?>

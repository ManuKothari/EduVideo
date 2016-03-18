<?php
	session_start();
	extract( $_POST );
	$_SESSION['uid'] = $uid;
	$_SESSION['username'] = $usrnm;
	$_SESSION['usertype'] = $usrtype;
?>


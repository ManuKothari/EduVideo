<?php
	session_start();
	extract( $_POST );
	$vids = array();

	$cwd = getcwd();
	chdir("../");

	if( isset($_SESSION["usertype"]) )
	{
		$uid = $_SESSION["uid"];
		$resource = popen( "python search.py " . escapeshellarg( $qry ) . " " . $uid . " 2>&1" , "r" );
	}	
	else
	{
		$resource = popen( "python search.py " . escapeshellarg( $qry ) . " 2>&1" , "r" );
	}

	if( is_resource( $resource ) )
	{
		while( ! feof( $resource ) )
		{
			$vids[] = fgets( $resource );
		}
	}
	pclose( $resource );
	echo json_encode( $vids );
	chdir( $cwd );	
?>

<?php
	extract( $_POST );
	$vids = array();
	//$uid = "56d33b120a9ded2248d38bef";
	
	$cwd = getcwd();
	chdir("../");

	$resource = popen( "python search.py " . escapeshellarg( $qry ) . " 2>&1" , "r" );
	//$resource = popen( "python search.py " . escapeshellarg( $qry ) . " " . $uid . " 2>&1" , "r" );

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

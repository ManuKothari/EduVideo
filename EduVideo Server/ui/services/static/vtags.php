<?php
	extract($_POST);
	$tags = array();
	$file = fopen("../tags.txt","r");
	
	while( $line = fgets($file) )
	{
		$tag = trim( $line );
		if( strncasecmp( $tag, $tagpart, strlen( $tagpart ) ) == 0 )
		{
			$tags[] = $tag;
		}
	}
	
	fclose( $file );
	echo json_encode( $tags );
?>

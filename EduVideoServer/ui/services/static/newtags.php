<?php
	extract($_POST);
	$otags = file_get_contents( "../tags.txt" );
	$oldtags = explode( "\n", $otags );

	$tagfile = fopen( "../tags.txt", "a" ) or die( 'Cannot open file:  ' . $tagfile ); 
	foreach( $ntags as $nt )
	{
		if( in_array( $nt, $oldtags ) == false )
		{
			fwrite( $tagfile, "\n" . $nt );
		}
	}
	fclose( $tagfile );
?>

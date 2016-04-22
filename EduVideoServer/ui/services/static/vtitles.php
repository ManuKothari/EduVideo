<?php
	extract($_POST);
	$titles = array();
	$file = fopen("../vidnm.txt","r");
	
	while( $line = fgets($file) )
	{
		$ln = trim( $line );
		list( $vid, $title, $desc ) = explode(' $@$ ', $ln);

		foreach( explode(' ', $qry) as $wrd )
		{
			if( strpos($desc, $wrd) !== false && in_array($title, $titles) == false )
			{
				$titles[] = $title;
			}
		}
	}
	fclose( $file );
	echo json_encode( $titles );
?>

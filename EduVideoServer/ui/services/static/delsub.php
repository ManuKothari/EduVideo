<?php
	extract( $_POST );
	try 
	{
		$conn = new Mongo('localhost');
		$db = $conn->eduvideo;
		$newsub = $db->newsub;
		if( $no == 1 )
		{
			$category = $db->category;
			$cursor = $newsub->find( array( "sub" => $sub ) );
			foreach( $cursor as $obj )
			{
				echo $category->insert( $obj );
			}
		}
		echo $newsub->remove( array( "sub" => $sub ) );
		$conn->close();
	} 
	catch (MongoConnectionException $e) 
	{
		die('Error connecting to MongoDB server');
	} 
	catch (MongoException $e)
	{
	  	die('Error: ' . $e->getMessage());
	}
?>

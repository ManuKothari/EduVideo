<?php
	extract( $_POST );
	try 
	{
		$conn = new Mongo('localhost');
		$db = $conn->eduvideo;
		$newsub = $db->newsub;
		echo $newsub->insert( json_decode( $obj ) );
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

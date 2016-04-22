<?php
	extract( $_POST );
	try 
	{
		$conn = new MongoClient('mongodb://admin:root@ds055564.mlab.com:55564/eduvideo');
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

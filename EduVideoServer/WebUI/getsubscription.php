<?php
	extract( $_GET);
	try 
	{
		$conn = new MongoClient('mongodb://admin:root@ds055564.mlab.com:55564/eduvideo');
		if($conn)
			echo "Successful";
		$db = $conn->eduvideo;
		$collection = $db->video;
		$cursor = $collection->find();
		$videos = array();
		echo json_encode($db->video->find());
		foreach ($cursor as $obj)
		{
			$videos[] = $obj;
			echo $obj['title'];
		}
		echo $videos;
		$conn->close();
		echo json_encode($videos);
		
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

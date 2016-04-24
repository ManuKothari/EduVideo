<?php
	extract( $_POST );
	try 
	{
		$conn = new MongoClient('mongodb://admin:root@ds055564.mlab.com:55564/eduvideo');
		$db = $conn->eduvideo;
		$collection = $db->category;
		$cursor = $collection->find();
		foreach ($cursor as $obj)
		{
			if( $sub == $obj['sub'])
			{
				foreach( $obj['ut'] as $t )
				{
					echo $t . ";";		
				}
				break;
			}
		}
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

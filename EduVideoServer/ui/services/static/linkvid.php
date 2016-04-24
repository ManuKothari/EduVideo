<?php
	extract( $_POST );
	try 
	{
		$conn = new Mongo('localhost');
		$db = $conn->eduvideo;
		$video = $db->video;
		if( $no == 1 )
		{
			echo $video->update( array('_id' => new MongoId( $ovid ) ), array('$set' => array('linkedto' => $nvid ) ) );
			echo $video->update( array('_id' => new MongoId( $nvid ) ), array('$set' => array('linkedby' => $ovid ) ) );
		}
		else if( $no == 2 )
		{
			echo $video->update( array('_id' => new MongoId( $ovid ) ), array('$set' => array('linkedto' => "" ) ) );
			echo $video->update( array('_id' => new MongoId( $nvid ) ), array('$set' => array('linkedby' => "" ) ) );
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

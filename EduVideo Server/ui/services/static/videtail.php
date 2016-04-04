<?php
	extract( $_POST );
	try 
	{
		$conn = new MongoClient('mongodb://admin:root@ds055564.mlab.com:55564/eduvideo');
		$db = $conn->eduvideo;
		$user = $db->user;
		$video = $db->video;

	    if( $no == 1 )
	    {
    		echo $video->update( array('_id' => new MongoId( $vid ) ), array('$inc' => array('rates.good' => new MongoInt32( 1 ) ) ) );
		if( strcmp( $uid , "" ) != 0 )
		{
			echo $user->update( array('_id' => new MongoId( $uid ) ), array('$push' => array('rates.good' => $vid ) ) );
		}
	    }
	    else if( $no == 2 )
	    {
    		echo $video->update( array('_id' => new MongoId( $vid ) ), array('$inc' => array('rates.avg' => new MongoInt32( 1 ) ) ) );
		if( strcmp( $uid , "" ) != 0 )
		{
			echo $user->update( array('_id' => new MongoId( $uid ) ), array('$push' => array('rates.avg' => $vid ) ) );
		}
	    }
	    else if( $no == 3 )
	    {
		echo $video->update( array('_id' => new MongoId( $vid ) ), array('$inc' => array('rates.poor' => new MongoInt32( 1 ) ) ) );
		if( strcmp( $uid , "" ) != 0 )
		{
			echo $user->update( array('_id' => new MongoId( $uid ) ), array('$push' => array('rates.poor' => $vid ) ) );
		}
	    }
	    else if( $no == 4 && ( strcmp( $uid , "" ) != 0 ) )
	    {
		echo $user->update( array('_id' => new MongoId( $uid ) ), array('$push' => array('watch_later_ids' => $vid ) ) );
	    }
	    else if( $no == 5 && ( strcmp( $uid , "" ) != 0 ) )
	    {
		echo $user->update( array('_id' => new MongoId( $uid ) ), array('$pull' => array('watch_later_ids' => $vid ) ) );
	    }
	    else if( $no == 6 && ( strcmp( $uid , "" ) != 0 ) )
	    {
		echo $user->update( array('_id' => new MongoId( $uid ) ), array('$pull' => array('rates.good' => $vid ) ) );
	    }
	    else if( $no == 7 && ( strcmp( $uid , "" ) != 0 ) )
	    {
		echo $user->update( array('_id' => new MongoId( $uid ) ), array('$pull' => array('rates.avg' => $vid ) ) );
	    }
	    else if( $no == 8 && ( strcmp( $uid , "" ) != 0 ) )
	    {
		echo $user->update( array('_id' => new MongoId( $uid ) ), array('$pull' => array('rates.poor' => $vid ) ) );
	    }
	    else if( $no == 9 && ( strcmp( $uid , "" ) != 0 ) )
	    {
  echo $video->update( array('_id' => new MongoId( $vid ) ), array('$push' => array('comments' => array( 'uid' => $uid , 'msg' => $msg ) ) ) );
	    }
	    else if( $no == 10 && ( strcmp( $uid , "" ) != 0 ) )
	    {
		echo $video->update( array('_id' => new MongoId( $vid ) ), array('$pull' => array('comments' => array( 'uid' => $uid ) ) ) );
  echo $video->update( array('_id' => new MongoId( $vid ) ), array('$push' => array('comments' => array( 'uid' => $uid , 'msg' => $msg ) ) ) );
	    }
	    else if( $no == 11 && ( strcmp( $uid , "" ) != 0 ) )
	    {
		echo $video->update( array('_id' => new MongoId( $vid ) ), array('$pull' => array('comments' => array( 'uid' => $uid ) ) ) );
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

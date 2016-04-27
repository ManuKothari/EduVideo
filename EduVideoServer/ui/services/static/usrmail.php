<?php
	extract( $_POST );
	try 
	{
		$conn = new Mongo('localhost');
		$db = $conn->eduvideo;
		$channel = $db->channel;
		$user = $db->user;

	    if( $no == 1 )
	    {
    		echo $channel->update( array('_id' => new MongoId( $cid ) ), array('$push' => array('subscriber_ids' => array( 'uid' => $uid , 'mail' => new MongoInt32( $mailno ) ) ) ) );
		echo $user->update( array('_id' => new MongoId( $uid ) ), array('$push' => array('subscribed_ids' => $cid) ) );

		if( $mailno == 1 && (strcmp($email, "") != 0) )
		{
		    echo $user->update( array('_id' => new MongoId( $uid ) ), array('$set' => array('email' => $email) ) );
		}
	    }
	    else if( $no == 2 )
	    {
    		echo $channel->update( array('_id' => new MongoId( $cid ) ), array('$pull' => array('subscriber_ids' => array( 'uid' => $uid ) ) ) );
		echo $user->update( array('_id' => new MongoId( $uid ) ), array('$pull' => array('subscribed_ids' => $cid) ) );
	    }
	    else if( $no == 3 )
	    {
		echo $user->update( array('_id' => new MongoId( $uid ) ), array('$set' => array('notify' => array() ) ) );
	    }
	    else if( $no == 4 )
	    {
		echo $user->update( array('_id' => new MongoId( $uid ) ), array('$set' => array('history' => array() ) ) );
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

<?php
	session_start();
	if( !isset($_SESSION["usertype"]) || !isset($_SESSION["username"]) )
	{
		header("Location: index.php");
	}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>EduVideo</title>
    <link rel="shortcut icon" href="favicon.ico">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <!-- Bootstrap css -->
    <link type="text/css" rel='stylesheet' href="css/bootstrap.min.css">
    <link href="css/dashboard.css" rel="stylesheet">
    <link href="css/style.css" rel='stylesheet' type='text/css' media="all" />
    <!-- End Bootstrap css -->
    <!-- Fancybox -->
    <link type="text/css" rel='stylesheet' href="js/fancybox/jquery.fancybox.css">
    <!-- End Fancybox -->

    <link type="text/css" rel='stylesheet' href="fonts/fonts.css">
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800&amp;subset=latin,cyrillic-ext' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>

    <link type="text/css" data-themecolor="default" rel='stylesheet' href="css/main-default.css">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
    <script src="js/jquery-1.11.1.min.js"></script>
    <link href='//fonts.googleapis.com/css?family=Poiret+One' rel='stylesheet' type='text/css'>
    <!-- //fonts -->

    <link rel="stylesheet" type="text/css" href="css/mynav.css">
    <script type="text/javascript" src = "js/jquery.min.js"></script>
    <script type="text/javascript" src = "js/bootstrap.min.js"></script>

</head>

 <body>

    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container-fluid">

        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="about.php"><h1><img src="images/weblogo.png" style= "width:150px" alt="" /></h1></a>
        </div>

        <div id="navbar" class="navbar-collapse collapse">
		<div class="top-search">
			<form class="navbar-form navbar-right">
				<input id="srch" type="text" class="form-control" placeholder="Search..." autocomplete="off" onkeyup="geTitles();" list="titles">
				<datalist id="titles"> </datalist>
				<input type="submit" value=" " onclick="searchvid(); return false;">
			</form>
		</div>
		<div class="header-top-right">
			<ul class="nav navbar-nav navbar-right">
				<li> <div class="file" >
					<a href="index.php"><i class="glyphicon glyphicon-home ">&nbsp;Home</i></a>
				</div> </li>
				<li class="dropdown">
					<button class="btn btn-default dropdown-toggle user" type="button" id="username" data-toggle="dropdown"> <i class="glyphicon glyphicon-user"></i> <?php echo $_SESSION["username"]; ?> &nbsp; <span class="caret"></span> </button>
					<ul class="dropdown-menu">
						<li><a href="chngPwd.php">Change Details</a></li>
						<li><a href="logout.php">Log Out</a></li>
					</ul>
				</li>
			</ul>
		</div>
	</div>
	<div class="clearfix"> </div>

      </div>
    </nav>

    <div class="col-sm-3 col-md-2 sidebar">
	<div class="top-navigation">
		<div class="t-menu">MENU</div>
		<div class="t-img">
			<img src="images/lines.png" alt="" />
		</div>
		<div class="clearfix"> </div>
	</div>

	<div class="drop-navigation drop-navigation">
		<ul class="nav nav-sidebar"><br/> <br>
			<li class="active"><a href="syllabus.php" class="home-icon"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>CURRICULUM</a></li>	
			<li><a href="trending.php" class="trending"><span class="glyphicon glyphicon-home glyphicon-fire" aria-hidden="true"></span>Trending</a></li>
			<li><a href="mychns.php" class="channel"><span class="glyphicon glyphicon-home glyphicon-blackboard" aria-hidden="true"></span>My Channels</a></li>
			<li><a href="#" onclick="recommend(); return false;" class="recommendv"><span class="glyphicon glyphicon-home glyphicon-blackboard" aria-hidden="true"></span>Recommendations</a></li>
			<li><a href="subscription.php" class="subscription"><span class= "glyphicon glyphicon-home glyphicon-check" aria-hidden="true"></span>Subscriptions</a></li>					
			<li><a href="#" onclick="usrhist(); return false;" class="history"><span class= "glyphicon glyphicon-home glyphicon-hourglass" aria-hidden="true"></span>History</a></li>			
			<li><a href="#" onclick="usrwatchlater(); return false;" class="watchlater"><span class="glyphicon glyphicon-home glyphicon-time" aria-hidden="true"></span>Watch Later</a></li>
		</ul>	<hr>

		<ul class="nav nav-sidebar"> <br>
			<li class="active"> <a href="browsech.php" class="browse">  <span class="glyphicon glyphicon-home glyphicon-plus-sign" aria-hidden="true"></span>Browse Channels</a> </li> <br>
			<li class="active"> <a href="notifications.php" class="notify"> <span class="glyphicon glyphicon-home glyphicon-tasks" aria-hidden="true"></span>Notifications</a> </li> <br>
	<?php
		if( $_SESSION["usertype"] == "admin" )
		{
			echo ' <li class="active"> <a href="adminsub.php" class="managesubjects"> <span class="glyphicon glyphicon-home glyphicon-cog" aria-hidden="true"></span>Manage Subjects</a> </li> <br>	';
		}
	?>
		</ul>				
	</div>	
    </div>


    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
	<div class="main-grids"> <hr>
	<h2 style="text-align: center;" class="maintext"> MY SUBSCRIBED CHANNELS </h2> <hr><hr>
	<?php
		try 
		{
			$conn = new Mongo('localhost');
			$db = $conn->eduvideo;
			$channel = $db->channel;
			$user = $db->user;
			$video = $db->video;
			$usrcur = $user->findOne( array('_id' => new MongoId( $_SESSION["uid"] ) ) );
		if( count( $usrcur['subscribed_ids'] ) != 0 )
		{
			foreach( $usrcur['subscribed_ids'] as $chnid )
			{
				$chnobj = $channel->findOne( array('_id' => new MongoId( $chnid ) ) );
				$nm = $user->findOne( array('_id' => new MongoId( $chnobj['author_id'] ) ) );
				echo '
		<div class="recommended">
			<div class="recommended-grids english-grid">
				<div class="recommended-info">
					<div class="heading">';
	printf('<h3> <a href="#" onclick="chnpg(\'%s\'); return false;" ><center> %s</center> </a> </h3>', $chnobj['_id'], $chnobj['channel_name']);
						echo ' <p style="color:blue;"> Featuring';
						foreach( $chnobj['subjects'] as $sub )
						{
							echo ' ' . $sub . ' , ';
						}
				  		echo '</p> </div>
					<div class="heading-right">
						<h4 class ="othername">' . $nm['username'] . '</h4>
					</div>
					<div class="heading-right">
						<h4 class ="othername">' . count( $chnobj['subscriber_ids'] ) . ' Subscribers</h4>
					</div>
					<div class="heading-right">
						<h4 class ="othername">' . count( $chnobj['video_ids'] ) . ' Videos</h4>	
					</div>
					<div class="heading-right"> ';
	printf('<button onclick="unsubscribe(\'%s\');" class="btn btn-md btn-primary btn-block" type="button"> UNSUBSCRIBE </button>' ,   $chnobj['_id'] );
				echo '	</div>
					<div class="clearfix"> </div>
				</div> <br>';
				$chnvid9 = array_slice( $chnobj['video_ids'], 0, 9 );
				foreach( array_slice( $chnobj['video_ids'], 0, 5 ) as $vid )
				{
					$vobj = $video->findOne( array('_id' => new MongoId( $vid ) ) );
					echo'
				<div class="col-md-2 resent-grid recommended-grid sports-recommended-grid">
					<div class="resent-grid-img recommended-grid-img"> ';

	printf('<video src="http://localhost:3000/video/%s" controls width="150px" height="150px" onclick="singlevid(\'%s\',\'%s\');"></video>', $vobj['video_id'], $vobj['_id'], implode(";", $chnvid9) );
						
					echo '	
					</div>
					<div class="resent-grid-info recommended-grid-info avgvideobox"> ';
	printf('<h5><a href="#" onclick="singlevid(\'%s\',\'%s\'); return false;" class="title"> %s </a></h5>', $vobj['_id'], implode(";", $chnvid9), $vobj['title'] );
					echo '	<p class="views">'. $vobj['view_count'] .'views</p>
					</div>
				</div>';
				}

				if( count( $chnobj['video_ids'] ) != 0 )
				{
					echo'	
				<div class="heading-right">  </div> ';
				}

			echo'	<div class="clearfix"> </div>
			</div>
		</div>	<hr> ';

			}
		}
		else
		{
			echo' <h1> None as yet! </h1> <br>
			<h1> Subscribe to Channels to avail this feature! </h1> <br> ';
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
	</div>
    </div>


    <script type="text/javascript">
	
	videosURI = 'http://localhost:5000/eduvideo/videos';
	usersURI = 'http://localhost:5000/eduvideo/users';
	channelsURI = 'http://localhost:5000/eduvideo/channels';
	custom_ajax = function( uri, method, data ) 
	{
	    var request = 
		{
	        	url: uri,
		        type: method,
		        contentType: "application/json",
		        accepts: "application/json",
		        cache: false,
		        dataType: 'json',
		        data: JSON.stringify( data ),
		        error: function( jqXHR ) 
			{
		            console.log( "ajax error " + jqXHR.status );
		        }
		};
	    return $.ajax( request );
	}


	function createvidlist( vids, chno, qry )
	{
		var res = [];
		var j = 0;
		custom_ajax( videosURI, 'GET' ).done(
			function( data ) 
			{
				for( var i = 0; i < vids.length; i++ )
				{
					data.videos.some( function( video ) {
						if( video._id.trim() == vids[i].trim() )
						{
							res[ j ] = video;
							j += 1;
							return true;
					    	}
					} );
				}
				var restr = JSON.stringify( res );
				restr = encodeURIComponent( restr );
				var vform = $('<form action="vidlist.php" method="post" style="display:none;">' + 
			'<input type="textarea" maxlength="5000" name="vidlist" value="' + restr + '" /' + '>' +
			'<input type="number" name="chno" value="' + chno + '" /' + '>' +
			'<input type="text" name="qry" value="' + qry + '" /' + '>' + '</form>');
				$('body').append( vform );
				vform.submit();
			} );
	}

	function searchvid()
	{
		var query =  $("#srch").val();
		$.ajax({
			    url: 'vsearch.php',
			    data: "qry=" + encodeURIComponent(query),
			    type: 'POST',
			    cache: false,
			    error: function( jqXHR )
				   {
				   	console.log("ajax error " + jqXHR.status);
				   },
			    success: function( data )
				    {					
					var vids = JSON.parse( data );
					vids.pop();
					createvidlist( vids, 1, query );
				    }
			});
	}

	function geTitles()
	{
		var query =  $("#srch").val();
		$("#titles").empty();
		$.ajax({
			    url: 'vtitles.php',
			    data: "qry=" + encodeURIComponent(query),
			    type: 'POST',
			    cache: false,
			    error: function( jqXHR )
				   {
				   	console.log("ajax error " + jqXHR.status);
				   },
			    success: function( data )
				    {
					var titles = JSON.parse( data );
					titles.forEach( function( title ) {
						$("#titles").append("<option value='" + title + "'></option>");	
					});
				    }
			});
	}


	function usrhist()
	{
		custom_ajax( usersURI + "/" + <?php echo json_encode($_SESSION["uid"])?> , 'GET' ).done(
			function( data ) 
			{
				createvidlist( data.user.history.reverse(), 2, "" );
			} );
	}

	function usrwatchlater()
	{
		custom_ajax( usersURI + "/" + <?php echo json_encode($_SESSION["uid"])?> , 'GET' ).done(
			function( data ) 
			{
				createvidlist( data.user.watch_later_ids, 3, "" );
			} );
	}

	function chnpg( cid )
	{
		var vform = $('<form action="channel.php" method="post" style="display:none;">' + 
		'<input type="text" name="cid" value="' + cid + '" /' + '>' + '</form>');
		$('body').append( vform );
		vform.submit();
	}

	function unsubscribe( cid )
	{
		var uid = <?php echo json_encode($_SESSION["uid"])?> ;
		$.ajax({
			    url: 'usrmail.php',
			    data: "cid=" + cid + "&uid=" + uid + "&no=" + 2 ,
			    type: 'POST',
			    cache: false,
			    error: function( jqXHR )
				   {
				   	console.log("ajax error " + jqXHR.status);
				   },
			    success: function( data )
				    {
					if( data )
					{
						location.href = "subscription.php";
					}
				    }
			});		
	}

	function singlevid( vid, vidlist )
	{
		vidlist = vidlist.split( ";" );
		vidlist.splice( vidlist.indexOf( vid ) , 1 );
		vidlist = vidlist.join();
		vidlist = vid + ";" + vidlist;
		var vform = $('<form action="singlevid.php" method="post" style="display:none;">' + 
		'<input type="text" name="vidlist" value="' + vidlist + '" /' + '>' + '</form>');
		$('body').append( vform );
		vform.submit();
	}

	function recommend()
	{
		var uid = <?php echo json_encode($_SESSION["uid"])?> ;
		$.ajax({
			    url: 'recommend.php',
			    data: "uid=" + uid,
			    type: 'POST',
			    cache: false,
			    error: function( jqXHR )
				   {
				   	console.log("ajax error " + jqXHR.status);
				   },
			    success: function( data )
				    {	
					
					var data = JSON.parse( data );
					var usrs = []
					data.forEach(function(d){
						usrs.push(d)
					});
					user_data = usrs[usrs.length-2]
					
					user_data = user_data.replace('[','')
					user_data = user_data.replace(']','')
			
					similar_users = user_data.split(",");
					for( var i = 0; i < similar_users.length; i++ )
					{
						similar_users[i] = similar_users[i].trim()
						similar_users[i] = similar_users[i].slice(1,similar_users[i].length-1)		
					}

					var res = [];
					
					custom_ajax( usersURI, 'GET' ).done(
						function( usrdata ) 
						{
							for( var i = 0; i < similar_users.length; i++ )
							{
								usrdata.users.some( function( user ) {	
								if( user._id.trim() == similar_users[i] )
									{
										videos = user['rates']['good']
										for( var k = 0; k < videos.length; k++ )
										{
										   
										    res.push(videos[k]);
										}
										
										return true;
								    	}
								} );
							}
							res = res.reduce(function(a,b){
								if(a.indexOf(b)<0)
								a.push(b)
								return a;
							},[])
							console.log(res)
							createvidlist( res, 4, "" );
	
						} );
					

				    }
			});
	}


    </script>
						
</body>
</html>

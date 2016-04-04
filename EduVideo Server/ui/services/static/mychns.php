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
				<li> <div class="file" style="width:1%;font-size:5px;">
					<a href="index.php"><i class="glyphicon glyphicon-home">&nbsp;Home</i></a>
				</div> </li>
				<li class="dropdown">
					<button class="btn btn-default dropdown-toggle" type="button" id="username" data-toggle="dropdown"> <i class="glyphicon glyphicon-user"></i> <?php echo $_SESSION["username"]; ?> &nbsp; <span class="caret"></span> </button>
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
	<div class="show-top-grids">		
	    <div class="col-sm-10 show-grid-left main-grids"> <hr>
	    	<h2 style="text-align: center;"> MY CHANNELS </h2> <hr><hr>
    <?php
	try 
	{
		$conn = new MongoClient('mongodb://admin:root@ds055564.mlab.com:55564/eduvideo');
		$db = $conn->eduvideo;
		$channel = $db->channel;
		$user = $db->user;
		$video = $db->video;
		$usrcur = $user->findOne( array('_id' => new MongoId( $_SESSION["uid"] ) ) );
		if( count( $usrcur['channel_ids'] ) != 0 )
		{
			foreach( $usrcur['channel_ids'] as $chnid )
			{
				$chnobj = $channel->findOne( array('_id' => new MongoId( trim( $chnid ) ) ) );
				$nm = $user->findOne( array('_id' => new MongoId( $chnobj['author_id'] ) ) );	
				echo '
		<div class="recommended">
			<div class="recommended-grids english-grid">
				<div class="recommended-info">
					<div class="heading">';
	printf('<h3> <a href="#" onclick="chnpg(\'%s\'); return false;" > %s </a> </h3>', $chnobj['_id'], $chnobj['channel_name']);
						echo ' <h5> Featuring';
						$chnsub = "";
						foreach( $chnobj['subjects'] as $sub )
						{
							echo ' ' . $sub . ' , ';
							$chnsub = $chnsub . $sub . ",";
						}
				  		echo '</h5> </div>
					<div class="heading-right">';
					printf('<button onclick="newchnvid(\'%s\');" class="btn btn-md btn-primary btn-block" type="button"> UPLOAD VIDEO </button>', $chnobj['_id']);
				echo'	</div>
					<div class="heading-right">';
					printf('<button onclick="editchnvid(\'%s\',\'%s\',\'%s\');" class="btn btn-md btn-primary btn-block" type="button"> EDIT </button>', $chnobj['_id'], $chnobj['channel_name'], $chnsub);	
				echo'	</div>
					<div class="heading-right">';
					printf('<button onclick="delchn(\'%s\');" class="btn btn-md btn-primary btn-block" type="button"> DELETE </button>', $chnobj['_id']);
				echo'	</div>
					<div class="clearfix"> </div>
				</div> <br>';
				$chnvid9 = array_slice( $chnobj['video_ids'], 0, 9 );
				foreach( array_slice( $chnobj['video_ids'], 0, 3 ) as $vid )
				{
					$vobj = $video->findOne( array('_id' => new MongoId( $vid ) ) );
					echo'
				<div class="col-md-2 resent-grid recommended-grid sports-recommended-grid">
					<div class="resent-grid-img recommended-grid-img"> ';

	printf('<video src="http://localhost:3000/video/%s" controls width="250px" height="100px" onclick="singlevid(\'%s\',\'%s\');"></video>', $vobj['video_id'], $vobj['_id'], implode(";", $chnvid9) );
						
					echo '	<div class="time small-time sports-tome">
							<p style="color:black; font-size:15px;">'. $vobj['vlength'] .'</p>
						</div>
						<div class="clck sports-clock">
							<span class="glyphicon glyphicon-time" aria-hidden="true"></span>
						</div>
					</div>
					<div class="resent-grid-info recommended-grid-info"> ';
	printf('<h5><a href="#" onclick="singlevid(\'%s\',\'%s\'); return false;" class="title"> %s </a></h5>', $vobj['_id'], implode(";", $chnvid9), $vobj['title'] );
					echo '	<p class="views">'. $vobj['view_count'] .'views</p>
					</div>
				</div>';
				}

				if( count( $chnobj['video_ids'] ) != 0 )
				{
					echo'	
				<div class="heading-right"> &nbsp;&nbsp;&nbsp; So on ... </div> ';
				}

			echo'	<div class="clearfix"> </div>
			</div>
		</div>	<hr> ';
			}
		}
		else
		{
			echo' <h1> None as yet! </h1> <br>
			<h1> Create New Channels of your own! </h1> <br> ';
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
	    </div> <br> 
	    <div class="col-md-2 show-grid-right">
    		<button class="btn btn-md btn-primary btn-block" onclick="chnew();" type="button"> ADD NEW CHANNEL </button>			
	    </div>
	    <div class="clearfix"> </div>
	</div>
    </div>


     <div id="addchn" class="modal fade" tabindex="=1" role="dialog" aria-labelledby="addDialogLabel" aria-hidden="true">
	<div class="modal-dialog">
	    <div class="modal-content">
		<div class="modal-header">
       		    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
       		    <h3 class="modal-title" id="addDialogLabel">Add New Channel</h3>
       		</div>
       		<div class="modal-body">
       		    <form class="form-horizontal">
		       <div class="container-fluid">
	       	           <div class="form-group">
	       		       <label class="control-label" for="chnm" style="float:left">Channel Name:&nbsp;&nbsp;</label>
	  		       <input type="text" class="form-control" id="chnm" placeholder="Channel Name" style="width: 300px;">
			   </div> <hr>
			   <div class="form-group">
				<label class="control-label">Enter all Subjects separated by comma:</label>
			   </div>
			   <div class="form-group">
				<label class="control-label" for="chsub" style="float:left">&nbsp;Subjects:&nbsp;&nbsp;</label>
				<input type="text" class="form-control" id="chsub" placeholder="Subjects" style="width: 300px;">
			   </div> <hr>
		       </div>
		    </form>
		    <div id="chnmsg" style="color:green;"></div>
		    <br><hr>
		</div>
		<div class="modal-footer">
		    <button onclick="addchn();" class="btn btn-primary">Add Channel</button>
		    <button class="btn" data-dismiss="modal" id="cancel" aria-hidden="true">Cancel</button>
		</div>
	    </div>
	</div>
    </div>
    

    <div id="editchndetails" class="modal fade" tabindex="=1" role="dialog" aria-labelledby="editchnDialogLabel" aria-hidden="true">
	<div class="modal-dialog">
	    <div class="modal-content">
		<div class="modal-header">
       		    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
       		    <h3 class="modal-title" id="editchnDialogLabel">Edit Channel</h3>
       		</div>
       		<div class="modal-body">
		    <button onclick="editviddet();" class="btn btn-md btn-primary btn-block">Edit Videos in Channel</button> <hr>
		    <button onclick="editchndet();" class="btn btn-md btn-primary btn-block">Edit Channel Details</button> <hr>
		    <form id="chneditform" class="form-horizontal">
			<div class="container-fluid">
	       	           <div class="form-group">
	       		       <label class="control-label" for="echnm" style="float:left">Channel Name:&nbsp;&nbsp;</label>
	  		       <input type="text" class="form-control" id="echnm" placeholder="Channel Name" style="width: 300px;">
			   </div> <hr>
			   <div class="form-group">
				<label class="control-label">Enter all Subjects separated by comma:</label>
			   </div>
			   <div class="form-group">
				<label class="control-label" for="echsub" style="float:left">&nbsp;Subjects:&nbsp;&nbsp;</label>
				<input type="text" class="form-control" id="echsub" placeholder="Subjects" style="width: 300px;">
			   </div> <hr>
		       </div>
		    </form>
		    <div id="echnmsg" style="color:green;"></div>
		    <br><hr>
		</div>
		<div class="modal-footer">
		    <button onclick="editchn();" class="btn btn-primary">Edit Channel</button>
		    <button class="btn" data-dismiss="modal" id="edcancel" aria-hidden="true">Cancel</button>
		</div>
	    </div>
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


	function createvidlist( vids )
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
			'<input type="textarea" maxlength="5000" name="vidlist" value="' + restr + '" /' + '>' + '</form>');
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
					createvidlist( vids );
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
				createvidlist( data.user.history.reverse() );
			} );
	}

	function usrwatchlater()
	{
		custom_ajax( usersURI + "/" + <?php echo json_encode($_SESSION["uid"])?> , 'GET' ).done(
			function( data ) 
			{
				createvidlist( data.user.watch_later_ids );
			} );
	}


	function newchnvid( cid )
	{
		var vform = $('<form action="upload.php" method="post" style="display:none;">' + 
			'<input type="text" name="cid" value="' + cid + '" /' + '>' + '</form>');
		$('body').append( vform );
		vform.submit();
	}

	function editchnvid( cid, nm, sub )
	{
		$("#echnm").val( nm );
		$("#echsub").val( sub.slice(0, -1) );
		$("#echnmsg").html( cid );
		$("#echnmsg").hide();
		$("#chneditform").hide();
		$('#editchndetails').modal('show');
	}

	function delchn( cid )
	{
		custom_ajax( channelsURI + "/" + cid, 'DELETE' ).done(
		    function() 
		    {
		       	alert("DELETED the channel and all its videos!");
		    } );
	}

	function chnew()
	{
		$("#chnmsg").html("");
		$("#chnm").val("");
		$("#chsub").val("");
		$('#addchn').modal('show');
	}

	function addchn()
	{
		var newchnl = {
					channel_name: $("#chnm").val(),
					subjects: $("#chsub").val().split(","), 
					author_id: <?php echo json_encode($_SESSION["uid"]) ?>
			      };
		custom_ajax( channelsURI, 'POST', newchnl ).done( 
		    function( data ) 
		    {
			if( data )
			{
				$("#chnmsg").html("Successfully created your own new channel!");
				$("#cancel").html('Close');
			}
		    });
	}

	function editchndet()
	{
		$("#chneditform").show();			
	}

	function editviddet()
	{
		var cid = $("#echnmsg").html();
		$("#echnmsg").html("Redirecting to edit video details of the channel...............");
		$("#echnmsg").show();
		var vform = $('<form action="chnvids.php" method="post" style="display:none;">' + 
		'<input type="text" name="cid" value="' + cid + '" /' + '>' + '</form>');
		$('body').append( vform );
		vform.submit();
	}

	function editchn()
	{
		var chndet = {
				channel_name: $("#echnm").val(),
				subjects: $("#echsub").val().split(",")
			     };
		custom_ajax( channelsURI + "/" + $("#echnmsg").html(), 'PUT', chndet ).done( 
		    function( data ) 
		    {
			if( data )
			{
				$("#echnmsg").html("Successfully updated your channel details!");
				$("#echnmsg").show();
				$("#edcancel").html('Close');
			}
		    });	
	}

	function chnpg( cid )
	{
		var vform = $('<form action="channel.php" method="post" style="display:none;">' + 
		'<input type="text" name="cid" value="' + cid + '" /' + '>' + '</form>');
		$('body').append( vform );
		vform.submit();
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


    </script>
						
</body>
</html>

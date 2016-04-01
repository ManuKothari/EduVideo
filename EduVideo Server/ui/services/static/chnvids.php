<?php
	session_start();
	extract( $_POST );
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
    <?php
	try 
	{
		$conn = new MongoClient('mongodb://admin:root@ds055564.mlab.com:55564/eduvideo');
		$db = $conn->eduvideo;
		$channel = $db->channel;
		$user = $db->user;
		$video = $db->video;
		$chnobj = $channel->findOne( array('_id' => new MongoId( $cid ) ) );
		echo ' <h2 style="text-align: center;">'. $chnobj['channel_name'] .'</h2> <hr><hr> ';

		$chnvid9 = array_slice( $chnobj['video_ids'], 0, 9 );
		foreach( $chnobj['video_ids'] as $vid )
		{
			$vobj = $video->findOne( array('_id' => new MongoId( $vid ) ) );
			echo '	
			<div class="col-md-4 resent-grid recommended-grid slider-top-grids">
				<div class="resent-grid-img recommended-grid-img"> ';

	printf('<video src="http://localhost:3000/video/%s" controls width="350px" height="200px" onclick="singlevid(\'%s\',\'%s\');"></video>', $vobj['video_id'], $vobj['_id'], implode(";", $chnvid9) );
							
				echo '	<div class="time">
						<p style="color:black; font-size:15px;"> '. $vobj['vlength'] .' </p>
					</div>
					<div class="clck">
						<span class="glyphicon glyphicon-time" aria-hidden="true"></span>
					</div>
				</div>
				<div class="resent-grid-info recommended-grid-info"> ';
	printf('<h3><a href="#" onclick="singlevid(\'%s\',\'%s\'); return false;" class="title title-info"> %s </a></h3>', $vobj['_id'], implode(";", $chnvid9), $vobj['title'] );
				echo '	<ul>
						<li class="right-list"><p class="views views-info"> '. $vobj['view_count'] .'  views</p></li>
					</ul>
				</div> <br>
				<div id="wrapper">
					<div style="width:90px; float:left;"> ';
	if( $vobj['linkedto'] == "" )
	{
		printf('<button onclick="linkvid(\'%s\',\'%s\');" class="btn btn-md btn-primary btn-block" type="button"> LINK </button>', $vobj['_id'], implode( ";", $chnobj['video_ids'] ) );
	}
	else
	{
		$lnkvobj = $video->findOne( array('_id' => new MongoId( $vobj['linkedto'] ) ) );
		printf('<button onclick="unlinkvid(\'%s\',\'%s\',\'%s\');" class="btn btn-md btn-primary btn-block" type="button"> UNLINK </button>', $vobj['_id'], $vobj['linkedto'], $lnkvobj['title'] );
	}
				echo'	</div> <br>
					<div style="width:90px; float:left;"> ';
	printf('<button onclick="editvid(\'%s\',\'%s\');" class="btn btn-md btn-primary btn-block" type="button"> EDIT </button>', $vobj['_id'], $cid);	
				echo'	</div> <br>
					<div style="width:90px; float:left;"> ';
    printf('<button onclick="delvid(\'%s\');" class="btn btn-md btn-primary btn-block" type="button"> DELETE </button>', $vobj['_id']);
				echo'	</div>
				</div>
				<br><br><br>
			</div> ';
		}
     echo ' </div> <br>
	    <div class="col-md-2 show-grid-right"> ';
		printf('<button onclick="linkallvid(\'%s\');" class="btn btn-md btn-primary btn-block" type="button"> LINK VIDEOS </button>',  implode( ";", $chnobj['video_ids'] ) );	
     echo ' </div>  ';

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
	    <div class="clearfix"> </div>
	</div>
    </div>


    <div id="choosevid" class="modal fade" tabindex="=1" role="dialog" aria-labelledby="selvidDialogLabel" aria-hidden="true">
	<div class="modal-dialog">
	    <div class="modal-content">
		<div class="modal-header">
       		    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
       		    <h3 class="modal-title" id="selvidDialogLabel">Choose a Video to Link to</h3>
       		</div>
       		<div class="modal-body">
		    <form id="selvidform" class="form-horizontal">
			<div class="container-fluid">
			   <div class="form-group">
				<label class="control-label">List of Videos in this Channel:</label>
			   </div>
			   <div class="form-group">
				<label class="control-label" for="vidnm" style="float:left">&nbsp;Video Titles:&nbsp;&nbsp;</label>
				<select id="vidnm" class="form-control" style="width: 400px;"></select>
			   </div> <hr>
		       </div>
		    </form>
		    <div id="selvidmsg" style="color:green;"></div>
		    <br><hr>
		</div>
		<div class="modal-footer">
		    <button id="vidsel" onclick="selvid();" class="btn btn-primary">Select Video</button>
		    <button class="btn" data-dismiss="modal" id="scancel" aria-hidden="true">Cancel</button>
		</div>
	    </div>
	</div>
    </div>


    <div id="unlkvid" class="modal fade" tabindex="=1" role="dialog" aria-labelledby="ulvidDialogLabel" aria-hidden="true">
	<div class="modal-dialog">
	    <div class="modal-content">
		<div class="modal-header">
       		    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
       		    <h3 class="modal-title" id="ulvidDialogLabel">Are you sure you want to Unlink Video?</h3>
       		</div>
       		<div class="modal-body">
		    <form class="form-horizontal">
			<div class="container-fluid">
			   <div class="form-group">
				<label class="control-label">The Video is currently Linked to:</label>
			   </div>
			   <div class="form-group">
				<label class="control-label" for="vidtl" style="float:left">&nbsp;Video Title:&nbsp;&nbsp;</label>
				<input type="text" class="form-control" id="vidtl" style="width: 500px;"></select>
			   </div> <hr>
		       </div>
		    </form>
		    <div id="ulvidmsg" style="color:green;"></div>
		    <br><hr>
		</div>
		<div class="modal-footer">
		    <button onclick="unlkvid();" class="btn btn-primary">Unlink Video</button>
		    <button class="btn" data-dismiss="modal" id="ucancel" aria-hidden="true">Cancel</button>
		</div>
	    </div>
	</div>
    </div>


    <div id="lnkallvid" class="modal fade" tabindex="=1" role="dialog" aria-labelledby="vidDialogLabel" aria-hidden="true">
	<div class="modal-dialog">
	    <div class="modal-content">
		<div class="modal-header">
       		    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
       		    <h3 class="modal-title" id="vidDialogLabel">Link all unlinked adjacent Videos containing a common pharse?</h3>
       		</div>
       		<div class="modal-body">
		    <form id="lnkvidform" class="form-horizontal">
			<div class="container-fluid">
			   <div class="form-group">
				<label class="control-label">Enter a common phrase in all the video titles:</label>
			   </div>
			   <div class="form-group">
				<label class="control-label" for="vidph" style="float:left">&nbsp;Title Phrase:&nbsp;&nbsp;</label>
				<input type="text" class="form-control" id="vidph" placeholder="Title Phrase" style="width: 500px;"></select>
			   </div> <hr>
		       </div>
		    </form>
		    <div id="lnkallmsg" style="color:green;"></div>
		    <br><hr>
		</div>
		<div class="modal-footer">
		    <button id="lnkvid" onclick="lnkallvid();" class="btn btn-primary">Link all adjacent Videos with the phrase</button>
		    <button class="btn" data-dismiss="modal" id="acancel" aria-hidden="true">Cancel</button>
		</div>
	    </div>
	</div>
    </div>


    <div id="videoedit" class="modal fade" tabindex="=1" role="dialog" aria-labelledby="editDialogLabel" aria-hidden="true">
	<div class="modal-dialog">
	    <div class="modal-content">
		<div class="modal-header">
       		    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
       		    <h3 class="modal-title" id="editDialogLabel">Edit Video</h3>
       		</div>
       		<div class="modal-body">
       		    <form class="form-horizontal">
		       <div class="container-fluid">
			   <div class="form-group">
			        <label class="control-label" for="vtitle" style="float:left">Video Title:&nbsp;&nbsp;</label>
			        <input type="text" class="form-control" id="vtitle" placeholder="Video Title" style="width: 400px;">
			   </div>
			   <div class="form-group">
			        <label class="control-label" for="vcategory" style="float:left">Category:&nbsp;&nbsp;</label>
			        <input type="text" class="form-control" id="vcategory" placeholder="Category" style="width: 500px;">
			    </div>
			    <div class="form-group">
			        <label class="control-label" for="vdescrip" style="float:left">Description:&nbsp;&nbsp;</label>
			        <input type="text" class="form-control" id="vdescrip" placeholder="Description" style="width: 400px;">
			    </div>
			    <div class="form-group">
			        <label class="control-label" for="vlen" style="float:left">Video Length:&nbsp;&nbsp;</label>
			        <input type="text" class="form-control" id="vlen" placeholder="Video Length" style="width: 200px;">
			    </div>
			    <div class="form-group">
			        <label class="control-label" for="vtags" style="float:left">Additional Tags:&nbsp;&nbsp;</label>
			        <input type="text" class="form-control" id="vtags" placeholder="Additional Tags" style="width: 400px;">
			    </div>
			    <div class="form-group">
			        <label class="control-label" for="vnotes" style="float:left">Notes:&nbsp;&nbsp;</label>
			        <input type="text" class="form-control" id="vnotes" placeholder="Notes" style="width: 500px;">
			    </div>
			    <div class="form-group">
			        <label class="control-label" for="vref" style="float:left">Reference:&nbsp;&nbsp;</label>
			        <input type="text" class="form-control" id="vref" placeholder="Reference" style="width: 500px;">
			    </div>       
		       </div>
		    </form>
		    <div id="vidmsg" style="color:green;"></div>
		    <br><hr>
		</div>
		<div class="modal-footer">
		    <button onclick="editvideo();" class="btn btn-primary">Edit Video</button>
		    <button class="btn" data-dismiss="modal" id="ecancel" aria-hidden="true">Cancel</button>
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


	function signUp()
	{
		var newUsr = {
				username: $("#newusername").val(),
				password: $("#newpassword").val()
			     };

 		custom_ajax( usersURI, 'POST', newUsr ).done( 
		    function( data ) 
		    {
				var uid = data.user.uri.split("/")[3];
				$("#newusermsg").css('color', 'green');
				$("#newusermsg").html("Successfully created user account!");
				$.post( "login.php", { "usrnm" : $("#newusername").val() , "usrtype" : "genuser" , "uid" : uid } ,
                                        function() { location.href = "index.php"; } );
		    } );
	}

	function login()
	{
		var usrnm = $("#oldusername").val();
		var usrpwd = $("#oldpassword").val();
		var usrtype = $("#oldusertype").val();

		custom_ajax( usersURI, 'GET' ).done(
			function( data ) 
			{
				data.users.forEach( function( user ) {
					if( user.username == usrnm && user.password == usrpwd && user.usertype == usrtype )
					{
					    $.post( "login.php", { "usrnm" : usrnm , "usrtype" : usrtype, "uid" : user.uri.split("/")[3] } ,
                                        	function() {
							location.href = "index.php";
						} );
					}
				});
				$("#oldusermsg").css('color', 'red');
				$("#oldusermsg").html("Incorrect Credentials! Try again");
		    	} );
	}

	function usrhist()
	{
		custom_ajax( usersURI + "/" + <?php echo json_encode($_SESSION["uid"])?> , 'GET' ).done(
			function( data ) 
			{
				createvidlist( data.user.history );
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

	function editvideo()
	{
		var vid = $("#vidmsg").html().split(";")[0];
		var cid = $("#vidmsg").html().split(";")[1];
		var ntags = $("#vtags").val();
		var taglist = ( typeof( ntags ) == "string" ) ? ntags.split(",") : ntags ;
		if( typeof( ntags ) == "string" )
		{
			$.post( "newtags.php", { "ntags" : taglist } );
		}
		var newvid = {
				title: $("#vtitle").val() ,
				description: $("#vdescrip").val() ,
				vlength: $("#vlen").val() ,
				tags: taglist,
				notes: $("#vnotes").val() ,
				reference: $("#vref").val()
			     };
		custom_ajax( videosURI + "/" + vid, 'PUT', newvid ).done(
		    function() 
		    {
			$("#vidmsg").html("Succefuuly Edited the Video's Details!");
		       	$("#vidmsg").show();
			$("#ecancel").html('Close');
		    } );		
	}
	
	function editvid( vid , cid )
	{
		$("#vidmsg").html( vid + ";" + cid );
		$("#vidmsg").hide();
		custom_ajax( videosURI + "/" + vid, 'GET' ).done(
		    function( data ) 
		    {
		       	$("#vtitle").val( data.video.title );
			$("#vcategory").val( data.video.category );
			$("#vdescrip").val( data.video.description );
			$("#vlen").val( data.video.vlength );
			$("#vtags").val( data.video.tags );
			$("#vnotes").val( data.video.notes );
			$("#vref").val( data.video.reference );
		    } );
		$("#videoedit").modal('show');
	}

	function delvid( vid )
	{
		custom_ajax( videosURI + "/" + vid, 'DELETE' ).done(
		    function() 
		    {
		       	alert("DELETED!");
		    } );
	}

	function linkvid( vid , vidlist )
	{
		vidlist = vidlist.split( ";" );
		vidlist.splice( vidlist.indexOf( vid ) , 1 );
		$("#choosevid").modal('show');
		if( vidlist.length == 0)
		{
			$("#vidsel").hide();
			$("#selvidform").hide();
			$("#selvidmsg").html("Your channel doesn't have any other video to link this with!  First upload another video!");
			$("#selvidmsg").show();
		}
		else
		{
			var vidnm = document.getElementById("vidnm");
			vidnm.options.length = 0;
			var res = [];
			var j = 0;
			custom_ajax( videosURI, 'GET' ).done(
			    function( data ) 
			    {
				for( var i = 0; i < vidlist.length; i++ )
				{
					data.videos.some( function( video ) {
						if( video._id.trim() == vidlist[i].trim() )
						{
							res[ j ] = video;
							j += 1;
							return true;
					    	}
					} );
				}
				for( i=0; i < res.length; i++ )
				{
					vidnm.options[vidnm.options.length] = new Option(res[i].title, res[i]._id);
				}
				$("#selvidmsg").html( vid );
				$("#selvidmsg").hide();
				$("#selvidform").show();
			    });
		}
	}

	function unlinkvid( orivid , newvid , nvtitle )
	{
		$("#ulvidmsg").html( orivid + ";" + newvid );
		$("#ulvidmsg").hide();
		$("#vidtl").val( nvtitle );
		$("#unlkvid").modal('show');
	}

	function unlkvid()
	{
		var orivid = $("#ulvidmsg").html().split(";")[0];
		var newvid = $("#ulvidmsg").html().split(";")[1];
		$.ajax({
			    url: 'linkvid.php',
			    data: "ovid=" + orivid + "&nvid=" + newvid + "&no=" + 2 ,
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
						$("#ulvidmsg").html("Successfully unlinked the videos!");
						$("#ulvidmsg").show();
						$("#ucancel").html('Close');
					}
				    }
			});
	}

	function selvid()
	{
		var orivid = $("#selvidmsg").html();
		var newvid = $("#vidnm").val();
		$.ajax({
			    url: 'linkvid.php',
			    data: "ovid=" + orivid + "&nvid=" + newvid + "&no=" + 1 ,
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
						$("#selvidmsg").html("Successfully linked the videos!");
						$("#selvidmsg").show();
						$("#scancel").html('Close');
					}
				    }
			});
	}

	function linkallvid( vidlstr )
	{
		vidlist = vidlstr.split( ";" );
		if( vidlist.length == 0 || vidlist.length == 1 )
		{
			$("#lnkvid").hide();
			$("#lnkvidform").hide();
			$("#lnkallmsg").html("Your channel doesn't have enough videos for linking!  First upload videos!");
		}
		else
		{
			$("#vidph").val("");
			$("#lnkallmsg").html( vidlstr );
			$("#lnkallmsg").hide();
		}
		$("#lnkallvid").modal('show');
	}

	function lnkallvid()
	{
		vidlist = $("#lnkallmsg").html().split( ";" );
		$("#lnkallmsg").html("");
		$("#lnkallmsg").show();
		var phr = $("#vidph").val();	
		var res = [];
		var j = 0;
		custom_ajax( videosURI, 'GET' ).done(
		    function( data ) 
		    {
			for( var i = 0; i < vidlist.length; i++ )
			{
			    data.videos.some( function( video ) {
	if( video._id.trim() == vidlist[i].trim() && ( video.title.indexOf( phr ) > -1 ) && (video.linkedto == "" || video.linkedby == "") )
				{	
					res[ j ] = video;
					j += 1;
					return true;
				}
			    });
			}
			if( res.length == 0 || res.length == 1 )
			{
				$("#lnkallmsg").html("Couldn't find enough videos that matched the criteria for linking!");
				$("#acancel").html('Close');
			}
			else
			{
				res.sort( function( a, b ) {
				    return ( parseInt( a.title.match(/\d+/)[0] ) - parseInt( b.title.match(/\d+/)[0] ) );
				});
				for( var i = 0; i < res.length - 1; i++ )
				{
					var prno = parseInt( res[i].title.match(/\d+/)[0] );
					var nxno = parseInt( res[i+1].title.match(/\d+/)[0] );
					if( (prno + 1 == nxno) && (res[i].linkedto != res[i+1]._id) )
					{
						$.ajax({
						    url: 'linkvid.php',
						    data: "ovid=" + res[i]._id + "&nvid=" + res[i+1]._id + "&no=" + 1 ,
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
				$("#lnkallmsg").html( "Successfully linked the videos " + res[i].title + " and " + res[i+1].title );
								}
							    }
						});
				
					}
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


    </script>
						
</body>
</html>

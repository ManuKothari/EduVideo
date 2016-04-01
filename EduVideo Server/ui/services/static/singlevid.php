<?php
	session_start();
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
	<?php
		if( !isset($_SESSION["usertype"]) && !isset($_SESSION["username"]) )
		{
			echo '	
			<div class="signin">
				<a href="#small-dialog2" class="play-icon popup-with-zoom-anim">Sign Up</a>

				<!-- pop-up-box -->
				<script type="text/javascript" src="js/modernizr.custom.min.js"></script>    
				<link href="css/popuo-box.css" rel="stylesheet" type="text/css" media="all" />
				<script src="js/jquery.magnific-popup.js" type="text/javascript"></script>
				<!--//pop-up-box -->

				<div id="small-dialog2" class="mfp-hide">
					<h3>Create Account</h3> 
					<div class="social-sits">
						<div class="facebook-button">
							<a href="#">Connect with Facebook</a>
						</div>
						<div class="chrome-button">
							<a href="#">Connect with Google</a>
						</div>
					</div>
	
					<div class="signup">
						<form class="form-horizontal" onsubmit="return false;">
							<div class="row">
								<div class="col-xs-10">
									<input type="text" id="newusername" class="form-control" placeholder="Enter Username" style="width:250px; padding-right:30px;"/>
									<i class="glyphicon glyphicon-user" style="position:absolute; right:0; padding:8px 27px;"></i>
								</div>
							</div>
							<div class="row">
								<div class="col-xs-10">
									<input type="password" id="newpassword" class="form-control" placeholder="Enter Password" style="width:250px; padding-right:30px;"/>
									<i class="glyphicon glyphicon-lock" style="position:absolute; right:0; padding:8px 27px;"></i>
								</div>
							</div>
							</br>
							<div class="row">
								<div class="col-xs-10">
									<button class="btn btn-block btn-info" onclick="signUp();">SIGN UP</button>
								</div>
							</div>
							</br>
							<div class="row">
								<div class="col-xs-10">
									<center><div id="newusermsg"></div></center>
								</div>
							</div>
						</form>	
					</div>
					<div class="clearfix"> </div>
				</div>	
				<script>
					$(document).ready(function() {
					$(".popup-with-zoom-anim").magnificPopup({
						type: "inline",
						fixedContentPos: false,
						fixedBgPos: true,
						overflowY: "auto",
						closeBtnInside: true,
						preloader: false,
						midClick: true,
						removalDelay: 300,
						mainClass: "my-mfp-zoom-in"
						});
					});
				</script>	
			</div>

			<div class="signin">
				<a href="#small-dialog" class="play-icon popup-with-zoom-anim">Sign In</a>
				<div id="small-dialog" class="mfp-hide">
					<h3>Login</h3>
					<div class="social-sits">
						<div class="facebook-button">
							<a href="#">Connect with Facebook</a>
						</div>
						<div class="chrome-button">
							<a href="#">Connect with Google</a>
						</div>
					</div>

					<div class="signup">
						<form class="form-horizontal" onsubmit="return false;">
							<div class="row">
								<div class="col-xs-10">
									<input type="text" id="oldusername" class="form-control" placeholder="Enter Username" style="width:250px; padding-right:30px;"/>
									<i class="glyphicon glyphicon-user" style="position:absolute; right:0; padding:8px 27px;"></i>
								</div>
							</div>
							<div class="row">
								<div class="col-xs-10">
									<input type="password" id="oldpassword" class="form-control" placeholder="Enter Password" style="width:250px; padding-right:30px;"/>
									<i class="glyphicon glyphicon-lock" style="position:absolute; right:0; padding:8px 27px;"></i>
								</div>
							</div>
							<div class="row">
								<div class="col-xs-10">
									<select class="form-control" id="oldusertype">
										<option value="genuser">User</option>
										<option value="admin">Admin</option>
									</select>
								</div>
							</div>
							</br>
							<div class="row">
								<div class="col-xs-10">
									<button class="btn btn-block btn-info" onclick="login();">LOGIN</button>
								</div>
							</div>
							</br>
							<div class="row">
								<div class="col-xs-10">
									<center><div id="oldusermsg"></div></center>
								</div>
							</div>
							</br>
							<div class="forgot">
								<a href="#">Forgot password ?</a>
							</div>
						</form>	
					</div>
					<div class="clearfix"> </div>

				</div>
			</div>
			<div class="clearfix"> </div>	';
		}
		else if( isset($_SESSION["usertype"]) && isset($_SESSION["username"]) )
		{
			echo '
			<ul class="nav navbar-nav navbar-right">
				<li> <div class="file" style="width:1%;font-size:5px;">
					<a href="index.php"><i class="glyphicon glyphicon-home">&nbsp;Home</i></a>
				</div> </li>
				<li class="dropdown">
					<button class="btn btn-default dropdown-toggle" type="button" id="username" data-toggle="dropdown"> <i class="glyphicon glyphicon-user"></i>'. $_SESSION["username"] . '&nbsp; <span class="caret"></span> </button>
					<ul class="dropdown-menu">
						<li><a href="chngPwd.php">Change Details</a></li>
						<li><a href="logout.php">Log Out</a></li>
					</ul>
				</li>
			</ul>	';	
		}
	?>
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

	<?php
		if( isset($_SESSION["usertype"]) && isset($_SESSION["username"]) )
		{
			echo '
			<li><a href="mychns.php" class="channel"><span class="glyphicon glyphicon-home glyphicon-blackboard" aria-hidden="true"></span>My Channels</a></li>
			<li><a href="subscription.php" class="subscription"><span class= "glyphicon glyphicon-home glyphicon-check" aria-hidden="true"></span>Subscriptions</a></li>					
			<li><a href="#" onclick="usrhist(); return false;" class="history"><span class= "glyphicon glyphicon-home glyphicon-hourglass" aria-hidden="true"></span>History</a></li>			
			<li><a href="#" onclick="usrwatchlater(); return false;" class="watchlater"><span class="glyphicon glyphicon-home glyphicon-time" aria-hidden="true"></span>Watch Later</a></li>	';
		}
	?>
		</ul>	<hr>

		<ul class="nav nav-sidebar"> <br>
			<li class="active"> <a href="browsech.php" class="browse">  <span class="glyphicon glyphicon-home glyphicon-plus-sign" aria-hidden="true"></span>Browse Channels</a> </li> <br>

	<?php
		if( isset($_SESSION["usertype"]) && isset($_SESSION["username"]) )
		{
			echo '	<li class="active"> <a href="notifications.php" class="notify"> <span class="glyphicon glyphicon-home glyphicon-tasks" aria-hidden="true"></span>Notifications</a> </li> <br>	';

			if( $_SESSION["usertype"] == "admin" )
			{
				echo ' <li class="active"> <a href="adminsub.php" class="managesubjects"> <span class="glyphicon glyphicon-home glyphicon-cog" aria-hidden="true"></span>Manage Subjects</a> </li> <br>	';
			}
		}
	?>
		</ul>				
	</div>	
    </div>


    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
	<div class="show-top-grids"> <hr>
    <?php
		extract( $_POST );
		$vid = explode( ';' , $vidlist )[0];
		$vlist = explode( ';' , $vidlist )[1];
		$vlist = explode( ',' , $vlist );
	try 
	{
		$conn = new MongoClient('mongodb://admin:root@ds055564.mlab.com:55564/eduvideo');
		$db = $conn->eduvideo;
		$channel = $db->channel;
		$user = $db->user;
		$video = $db->video;
		$usrvid = $video->findOne( array('_id' => new MongoId( $vid ) ) );
		
      echo' <div class="col-sm-8 single-left">
		<div class="song">
		    <div class="song-info">
			<h3>'. $usrvid['title'] .'</h3>	
		    </div>
		    <div class="video-grid">
    			<video src="http://localhost:3000/video/'. $usrvid['video_id'] .'" controls width="550px" height="450px" autoplay onended="nextvid();"></video>
          	    </div>
		</div>
		<div class="song-grid-right">
		    <div class="share">
			<ul><br><br><br>
				<li><a href="#" class="icon like">Good</a></li><br>
				<li><a href="#" class="icon dribbble-icon">Avg</a></li><br>
				<li><a href="#" class="icon pinterest-icon">Poor</a></li><br>
				<li class="view">'. $usrvid['view_count'] .' Views</li><br> ';
		if( isset($_SESSION["usertype"]) && isset($_SESSION["username"]) )
		{
			echo '	<li><a href="#" class="icon comment-icon">Watch Later</a></li> ';
		}
		echo '	</ul>
		    </div>
		</div>
		<div class="clearfix"> </div>
		
		<div class="all-comments"> ';
			$authusr = $user->findOne( array('_id' => new MongoId( $usrvid['author'] ) ) );
		echo '	<h5 style="float:left; display:inline; width:25%; color:blue;">'. $authusr['username']  .'</h5>';
			$authchn = $channel->findOne( array('_id' => new MongoId( $usrvid['channel'] ) ) );
		echo '	<h5 style="float:left; display:inline; width:30%; color:blue;">'. $authchn['channel_name']  .'</h5>
			<h5 style="float:left; display:inline; width:15%; color:green;">'. $usrvid['rates']['good']  .' goods </h5>
			<h5 style="float:left; display:inline; width:15%; color:purple;">'. $usrvid['rates']['avg']  .' avgs </h5>
			<h5 style="float:left; display:inline; width:15%; color:red;">'. $usrvid['rates']['poor']  .' poors </h5>
			<div class="clearfix"> </div> <hr> ';

	foreach( $usrvid['category'] as $cat )
	{
		echo' <h5 style="float:left; display:inline; width:40%; color:#006400;"> '. $cat['subject'] .' - '. $cat['unitTopic'] .' - '. $cat['subtopic'].' , </h5> ';
	}
		echo' <div class="clearfix"> </div> <hr> ';

	if( count( $usrvid['tags'] ) > 0 )
	{
		echo' <h5 style="color:#191970;"> Tags:  '. implode(" , ", $usrvid['tags']) .' </h5> <hr> ';
	}
	if( strcmp( $usrvid['description'], "" ) != 0 )
	{
		echo' <h5 style="color:#800000;"> Description:  '. $usrvid['description'] .' </h5> <hr>';
	}

	    echo '  <div class="all-comments-info"> ';
	    if( isset($_SESSION["usertype"]) && isset($_SESSION["username"]) )
	    {	
		echo '	<div class="box">  
			    <form id="cmtform">
				<textarea placeholder="Comment" required=" "></textarea>
				<input type="submit" value="Add your comment">
				<div class="clearfix"> </div>
			    </form>
			</div> <br><hr> ';
	    }
		echo '	<h5 style="text-align:center; color:brown;"> All Comments ( '. count( $usrvid['comments'] ) .' ) </h5>
		    </div><hr> ';

	if( count( $usrvid['comments'] ) > 0 )
	{
	    foreach( array_reverse( $usrvid['comments'] ) as $cmt )
	    {
		$cmtusr = $user->findOne( array('_id' => new MongoId( $cmt['uid'] ) ) );
	      echo' <div class="media-grids">
			<div class="media">
			    <h5 style="float:left; display:inline; width:20%;">'. $cmtusr['username'] .': </h5>
			    <div class="media-body" style="float:left; display:inline; width:50%;">
				<p>'. $cmt['msg'] .'</p>
			    </div>
			</div> <hr>
		    </div> ';
	    }
	}		    
	echo '	</div>
	    </div>
		
	    <div class="col-md-4 single-right">
		<h3>Up Next</h3>
		<div class="single-grid-right">
		    <div class="single-right-grids">
			<div class="col-md-4 single-right-grid-left">
			    <a href="single.html"><img src="images/r1.jpg" alt="" /></a>
			</div>
			<div class="col-md-8 single-right-grid-right">
			    <a href="single.html" class="title"> Nullam interdum metus</a>
			    <p class="author"><a href="#" class="author">John Maniya</a></p>
			    <p class="views">2,114,200 views</p>
			</div>
			<div class="clearfix"> </div>
		    </div>
		    <div class="single-right-grids">
			<div class="col-md-4 single-right-grid-left">
			    <a href="single.html"><img src="images/r2.jpg" alt="" /></a>
			</div>
			<div class="col-md-8 single-right-grid-right">
			    <a href="single.html" class="title"> Nullam interdum metus</a>
			    <p class="author"><a href="#" class="author">John Maniya</a></p>
			    <p class="views">2,114,200 views </p>
			</div>
			<div class="clearfix"> </div>
		    </div>
		</div>
	    </div> ';
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


    <script type="text/javascript">
	
	videosURI = 'http://localhost:5000/eduvideo/videos';
	usersURI = 'http://localhost:5000/eduvideo/users';
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
	var cancel_autoplay = 0;


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

	function nextvid()
	{
		var orivid = <?php echo json_encode( $vid ) ?>;
		var vidlist = <?php echo json_encode( $vlist ) ?>;
		if( cancel_autoplay == 0 )
		{
		    custom_ajax( videosURI + "/" + orivid , 'GET' ).done(
			function( data ) 
			{
				if( data.video.linkedto != "" )
				{
					var vid = data.video.linkedto;					
					vidlist.splice( vidlist.indexOf( vid ) , 1 );
					vidlist = vidlist.join();
					vidlist = vid + ";" + vidlist;
					var nform = $('<form action="singlevid.php" method="post" style="display:none;">' + 
					'<input type="text" name="vidlist" value="' + vidlist + '" /' + '>' + '</form>');
					$('body').append( nform );
					nform.submit();
				}
			});
		}
	}

	function cancelnext()
	{
		cancel_autoplay = 1;
	}


    </script>
						
</body>
</html>

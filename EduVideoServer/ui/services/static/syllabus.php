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
				<li> <div class="file" >
					<a href="index.php"><span class="glyphicon glyphicon-home">&nbsp;Home</span></a>
				</div> </li>
				<li class="dropdown">
					<button class="btn btn-default dropdown-toggle user" type="button" id="username" data-toggle="dropdown"> <i class="glyphicon glyphicon-user"></i>'. $_SESSION["username"] . '&nbsp; <span class="caret"></span> </button>
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
			<li><a href="#" onclick="recommend(); return false;" class="recommendv"><span class="glyphicon glyphicon-home glyphicon-blackboard" aria-hidden="true"></span>Recommendations</a></li>
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
	<div class="show-top-grids">
		<div class="col-sm-10 show-grid-left main-grids">

	  <div class="col-sm-3">
	    <div class="sidebar-nav">
	      <div class="navbar navbar-default" role="navigation">
	        <div class="navbar-header">
	          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-navbar-collapse">
	            <span class="sr-only">Toggle navigation</span>
	            <span class="icon-bar"></span>
	            <span class="icon-bar"></span>
	            <span class="icon-bar"></span>
	          </button>
          <span class="visible-xs navbar-brand">Sidebar menu</span>
        </div>
        <div class="navbar-collapse collapse sidebar-navbar-collapse">
	<?php
		try 
		{
			$conn = new Mongo('localhost');
			$db = $conn->eduvideo;
			$vid = $db->video;
			$chn = $db->channel;
			$curriculum = $db->category;
			$cursor = $curriculum->find();
			foreach( $cursor as $obj )
			{			
			    echo '<ul class="nav navbar-nav list" style = "">';	
				$subject = $obj['sub'];
				$totvids = $vid->count( array( "category.subject" => $subject ) );

	printf('<li class="active"> <a href="#" onclick="subvids(\'%s\'); return false;"> %s <span class="badge"> %s </span></a></li>', $subject, $subject, $totvids );
				
				/*
				$chn_cursor = $chn->find( array( "subjects" => $subject ) );
				foreach( $chn_cursor as $chn_obj )
				{
					echo '<li><a href="#">'.$chn_obj['channel_name'] . '</a></li>';			
				}	
				*/		
	
				foreach( $obj['ut'] as $topic )
				{
					echo '<li><a href="#">'. $topic . '</a></li>';			
				}

				
				echo '</ul>';
					
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
		</div><!--/.nav-collapse -->
      </div>
    </div>
  </div>
		</div>
		<div class="col-md-2 show-grid-right">
			<button class="btn btn-md btn-primary btn-block" onclick="newsub();" type="button"> ADD NEW SUBJECT </button>			
		</div>
		<div class="clearfix"> </div>
	</div>			
    </div>


    <div id="addsub" class="modal fade" tabindex="=1" role="dialog" aria-labelledby="addDialogLabel" aria-hidden="true">
	<div class="modal-dialog">
	    <div class="modal-content">
		<div class="modal-header">
       		    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
       		    <h3 class="modal-title" id="addDialogLabel">Add New Subject</h3>
       		</div>
       		<div class="modal-body">
       		    <form class="form-horizontal">
		       <div class="container-fluid">
	       	           <div class="form-group">
	       		       <label class="control-label" for="subnm" style="float:left">Subject Name:&nbsp;&nbsp;</label>
	  		       <input type="text" class="form-control" id="subnm" placeholder="Subject Name" style="width: 300px;">
			   </div> <hr>
			   <div class="form-group">
				<label class="control-label">Unit-wise Topic Names:</label>
			   </div>
			   <div class="form-group">
				<label class="control-label" for="unit1" style="float:left">&nbsp;Unit 1:&nbsp;&nbsp;</label>
				<input type="text" class="form-control" id="unit1" placeholder="Topic Name" style="width: 300px;">
			   </div>
			   <div class="form-group">
				<label class="control-label" for="unit2" style="float:left">&nbsp;Unit 2:&nbsp;&nbsp;</label>
				<input type="text" class="form-control" id="unit2" placeholder="Topic Name" style="width: 300px;">
			   </div>
			   <div class="form-group">
				<label class="control-label" for="unit3" style="float:left">&nbsp;Unit 3:&nbsp;&nbsp;</label>
				<input type="text" class="form-control" id="unit3" placeholder="Topic Name" style="width: 300px;">
			   </div>
			   <div class="form-group">
				<label class="control-label" for="unit4" style="float:left">&nbsp;Unit 4:&nbsp;&nbsp;</label>
				<input type="text" class="form-control" id="unit4" placeholder="Topic Name" style="width: 300px;">
			   </div>
			   <div class="form-group">
				<label class="control-label" for="unit5" style="float:left">&nbsp;Unit 5:&nbsp;&nbsp;</label>
				<input type="text" class="form-control" id="unit5" placeholder="Topic Name" style="width: 300px;">
			   </div> <hr>
		       </div>
		    </form>
		    <div id="submsg" style="color:green;"></div>
		    <br><hr>
		</div>
		<div class="modal-footer">
		    <button onclick="addsub();" class="btn btn-primary">Add Subject</button>
		    <button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
		</div>
	    </div>
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

	function newsub()
	{
		$("#submsg").html("");
		$('#addsub').modal('show');	
	}

	function addsub()
	{
		var topics = [];
		for( var i = 0; i<5; i++ )
		{
			topics[ i ] = $( "#unit" + (i+1).toString() ).val();
		}
		var newSub = {
				sub: $("#subnm").val(),
				ut: topics
			     };
		$.ajax({
		    url: 'newsub.php',
		    type: 'POST',
		    data: "obj="+ JSON.stringify( newSub ),
		    success: function( data )
			    {
				if( data )
					$("#submsg").html("Successfully stored but yet to be approved by admin!");
			    }
		});
	}

	function subvids( subj )
	{
		var vform = $('<form action="subjvids.php" method="post" style="display:none;">' + 
		'<input type="text" name="subj" value="' + subj + '" /' + '>' + '</form>');
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

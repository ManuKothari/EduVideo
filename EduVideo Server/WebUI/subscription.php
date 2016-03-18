<?php
	session_start();
	if( isset($_SESSION["username"]) && isset($_SESSION["usertype"]) )
	{
		if( $_SESSION["usertype"]=="admin")
		{
			header("Location: admin.php");
		}
		elseif( $_SESSION["usertype"]=="guser")
		{
			header("Location: guser.php");
		}
	}
	
?>

<!DOCTYPE html>
<html>


<head>
    <meta charset="utf-8">
    <title>Eduvideo</title>
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

	<script type="text/javascript">
	
	function getvid()
	{
		var self = this;
		self.videosURI = 'http://localhost:5000/eduvideo/videos';

		self.ajax = function(uri, method, data) {
		    var request = {
		        url: uri,
		        type: method,
		        contentType: "application/json",
		        accepts: "application/json",
		        cache: false,
		        dataType: 'json',
		        data: JSON.stringify(data),
		        error: function(jqXHR) {
		            console.log("ajax error " + jqXHR.status);
		        }
		    };
		    return $.ajax(request);
		}

		$.ajax({
			    url: 'getsubscription.php',
			    type: 'GET',
			    cache: false,
			    error: function( jqXHR )
				   {
				   	console.log("ajax error " + jqXHR.status);
				   },
			    success: function( data )
				    {		
					console.log(data)			
					var vids = JSON.parse( data );
					console.log(vids)
					vids.pop();
					var res = [];
					for( var i = 0; i < vids.length; i++ )
					{
						self.ajax( self.videosURI + "/" + vids[i], 'GET' ).done(
						    function( data ) 
						    {
							res[i] = data;
					    	    } );
						alert(res.length);
						if( res.length == vids.length )
						{
							var restr = JSON.stringify( res );
							restr = encodeURIComponent( restr );

							var vform = $('<form action="subscription.php" method="post" style="display:none;">' + 
						'<input type="textarea" maxlength="5000" name="vidlist" value="' + restr + '" /' + '>' +
						  	'</form>');
							$('body').append( vform );
							vform.submit();
						}	
					}
					
				    }
			});
	}
	</script>
</head>
 <body onload = "getvid()">

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
				<div class="file">
					<a href="upload.html">Upload</a>
				</div>	
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
											<div class="button-bottom">
												<p>Already have an account? <a href="#small-dialog" class="play-icon popup-with-zoom-anim">Login</a></p>
											</div>
										</div>
										<div class="signup">
											<form>
												<input type="text" class="email" placeholder="Mobile Number" maxlength="10" pattern="[1-9]{1}\d{9}" title="Enter a valid mobile number" />
											</form>
											<div class="continue-button">
												<a href="#small-dialog3" class="hvr-shutter-out-horizontal play-icon popup-with-zoom-anim">CONTINUE</a>
											</div>
										</div>
										<div class="clearfix"> </div>
									</div>	
									<div id="small-dialog3" class="mfp-hide">
										<h3>Create Account</h3> 
										<div class="social-sits">
											<div class="facebook-button">
												<a href="#">Connect with Facebook</a>
											</div>
											<div class="chrome-button">
												<a href="#">Connect with Google</a>
											</div>
											<div class="button-bottom">
												<p>Already have an account? <a href="#small-dialog" class="play-icon popup-with-zoom-anim">Login</a></p>
											</div>
										</div>
										<div class="signup">
											<form>
												<input type="text" class="email" placeholder="Email" required="required" pattern="([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?" title="Enter a valid email"/>
												<input type="password" placeholder="Password" required="required" pattern=".{6,}" title="Minimum 6 characters required" autocomplete="off" />
												<input type="text" class="email" placeholder="Mobile Number" maxlength="10" pattern="[1-9]{1}\d{9}" title="Enter a valid mobile number" />
												<input type="submit"  value="Sign Up"/>
											</form>
										</div>
										<div class="clearfix"> </div>
									</div>	
									<div id="small-dialog7" class="mfp-hide">
										<h3>Create Account</h3> 
										<div class="social-sits">
											<div class="facebook-button">
												<a href="#">Connect with Facebook</a>
											</div>
											<div class="chrome-button">
												<a href="#">Connect with Google</a>
											</div>
											<div class="button-bottom">
												<p>Already have an account? <a href="#small-dialog" class="play-icon popup-with-zoom-anim">Login</a></p>
											</div>
										</div>
										<div class="signup">
											<form action="upload.html">
												<input type="text" class="email" placeholder="Email" required="required" pattern="([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?" title="Enter a valid email"/>
												<input type="password" placeholder="Password" required="required" pattern=".{6,}" title="Minimum 6 characters required" autocomplete="off" />
												<input type="submit"  value="Sign In"/>
											</form>
										</div>
										<div class="clearfix"> </div>
									</div>		
									<div id="small-dialog4" class="mfp-hide">
										<h3>Feedback</h3> 
										<div class="feedback-grids">
											<div class="feedback-grid">
												<p>Suspendisse tristique magna ut urna pellentesque, ut egestas velit faucibus. Nullam mattis lectus ullamcorper dui dignissim, sit amet egestas orci ullamcorper.</p>
											</div>
											<div class="button-bottom">
												<p><a href="#small-dialog" class="play-icon popup-with-zoom-anim">Sign in</a> to get started.</p>
											</div>
										</div>
									</div>
									<div id="small-dialog5" class="mfp-hide">
										<h3>Help</h3> 
											<div class="help-grid">
												<p>Suspendisse tristique magna ut urna pellentesque, ut egestas velit faucibus. Nullam mattis lectus ullamcorper dui dignissim, sit amet egestas orci ullamcorper.</p>
											</div>
											<div class="help-grids">
												<div class="help-button-bottom">
													<p><a href="#small-dialog4" class="play-icon popup-with-zoom-anim">Feedback</a></p>
												</div>
												<div class="help-button-bottom">
													<p><a href="#small-dialog6" class="play-icon popup-with-zoom-anim">Lorem ipsum dolor sit amet</a></p>
												</div>
												<div class="help-button-bottom">
													<p><a href="#small-dialog6" class="play-icon popup-with-zoom-anim">Nunc vitae rutrum enim</a></p>
												</div>
												<div class="help-button-bottom">
													<p><a href="#small-dialog6" class="play-icon popup-with-zoom-anim">Mauris at volutpat leo</a></p>
												</div>
												<div class="help-button-bottom">
													<p><a href="#small-dialog6" class="play-icon popup-with-zoom-anim">Mauris vehicula rutrum velit</a></p>
												</div>
												<div class="help-button-bottom">
													<p><a href="#small-dialog6" class="play-icon popup-with-zoom-anim">Aliquam eget ante non orci fac</a></p>
												</div>
											</div>
									</div>
									<div id="small-dialog6" class="mfp-hide">
										<div class="video-information-text">
											<h4>Video information & settings</h4>
											<p>Suspendisse tristique magna ut urna pellentesque, ut egestas velit faucibus. Nullam mattis lectus ullamcorper dui dignissim, sit amet egestas orci ullamcorper.</p>
											<ol>
												<li>Nunc vitae rutrum enim. Mauris at volutpat leo. Vivamus dapibus mi ut elit fermentum tincidunt.</li>
												<li>Nunc vitae rutrum enim. Mauris at volutpat leo. Vivamus dapibus mi ut elit fermentum tincidunt.</li>
												<li>Nunc vitae rutrum enim. Mauris at volutpat leo. Vivamus dapibus mi ut elit fermentum tincidunt.</li>
												<li>Nunc vitae rutrum enim. Mauris at volutpat leo. Vivamus dapibus mi ut elit fermentum tincidunt.</li>
												<li>Nunc vitae rutrum enim. Mauris at volutpat leo. Vivamus dapibus mi ut elit fermentum tincidunt.</li>
											</ol>
										</div>
									</div>
									<script>
											$(document).ready(function() {
											$('.popup-with-zoom-anim').magnificPopup({
												type: 'inline',
												fixedContentPos: false,
												fixedBgPos: true,
												overflowY: 'auto',
												closeBtnInside: true,
												preloader: false,
												midClick: true,
												removalDelay: 300,
												mainClass: 'my-mfp-zoom-in'
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
							<div class="button-bottom">
								<p>New account? <a href="#small-dialog2" class="play-icon popup-with-zoom-anim">Signup</a></p>
							</div>
						</div>
						<div class="signup">
							<form>
								<input type="text" class="email" placeholder="Enter email / mobile" required="required" pattern="([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?"/>
								<input type="password" placeholder="Password" required="required" pattern=".{6,}" title="Minimum 6 characters required" autocomplete="off" />
								<input type="submit"  value="LOGIN"/>
							</form>
							<div class="forgot">
								<a href="#">Forgot password ?</a>
							</div>
						</div>
						<div class="clearfix"> </div>
					</div>
				</div>
				<div class="clearfix"> </div>
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
				  <ul class="nav nav-sidebar"><br/>
					<li class="active"><a href="index.html" class="home-icon"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>CURRICULUM</a></li>
					<li><a href="#" class="channel"><span class="glyphicon glyphicon-home glyphicon-blackboard" aria-hidden="true"></span>My Channels</a></li>
					
					<li><a href="#" class="trending"><span class="glyphicon glyphicon-home glyphicon-fire" aria-hidden="true"></span>Trending</a></li>
					
					<li><a href="#" class="subscription"><span class= "glyphicon glyphicon-home glyphicon-check" aria-hidden="true"></span>Subscriptions</a></li>
					
					<li><a href="#" class="history"><span class= "glyphicon glyphicon-home glyphicon-hourglass" aria-hidden="true"></span>History</a></li>
						
					<li><a href="#" class="watchlater"><span class="glyphicon glyphicon-home glyphicon-time" aria-hidden="true"></span>Watch Later</a></li>
				  </ul>
				
				<hr>

				  <ul class="nav nav-sidebar" id="ul_subscribe"><br/>
					<li class="active"> <a href="#" class="subscribe"> <span class="glyphicon glyphicon-home glyphicon-tasks" aria-hidden="true"></span>Subscription</a> </li>
				  </ul>
	
				 <ul class="nav nav-sidebar" id="ul_subscribe"><br/>
					<li class="active"> <a href="#" class="browse">  <span class="glyphicon glyphicon-home glyphicon-plus-sign" aria-hidden="true"></span>Browse Channels</a> </li>
					<li class="active"> <a href="#" class="managesubscription"> <span class="glyphicon glyphicon-home  glyphicon-cog" aria-hidden="true"></span>Manage Subscriptions</a> </li>
				  </ul>
				
			</div>		
     </div>
     <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
			<div class="show-top-grids">
				<div class="col-sm-10 show-grid-left main-grids">
					<?php
							extract( $_REQUEST );		
							$vidlist = urldecode( $vidlist );
							$vidlist = json_decode( $vidlist, true );
							foreach( $vidlist as $vid )
							{
								echo '	<div class="recommended-grids english-grid">
											<div class="recommended-info">
											<div class="heading">
											<h3>'. $vid['video']['title'] .'</h3>
											</div>
									<div class="heading-right">
										<a  href="#small-dialog8" class="play-icon popup-with-zoom-anim">Subscribe</a>
									</div>
								<div class="clearfix"> </div>
								</div>
								<div class="col-md-2 resent-grid recommended-grid show-video-grid">
								<div class="resent-grid-img recommended-grid-img">
									<a href="single.html"><video src="http://localhost:3000/video/'. $vid['video']['video_id'] .'" controls width="350px" height="200px"></video></a>
									<div class="time small-time show-time">
										<p>'. $vid['video']['vlength'] .' </p>
									</div>
									<div class="clck show-clock">
										<span class="glyphicon glyphicon-time" aria-hidden="true"></span>
									</div>
								</div>
								<div class="resent-grid-info recommended-grid-info">
									<h5><a href="single.html" class="title">Varius sit sed Nullam interdum</a></h5>
									<p class="author"><a href="#" class="author">John Maniya</a></p>
									<p class="views"> '. $vid['video']['view_count'] .' </p>
								</div>
							 </div>
							 <div class="clearfix"> </div>
						</div>
					</div> ';
										
							}
					?>

					
				</div>
			</div>
				
			<div class="clearfix"> </div>
	</div>

	<script type="text/javascript">
	
	function searchvid()
	{
		var self = this;
		self.videosURI = 'http://localhost:5000/eduvideo/videos';

		self.ajax = function(uri, method, data) {
		    var request = {
		        url: uri,
		        type: method,
		        contentType: "application/json",
		        accepts: "application/json",
		        cache: false,
		        dataType: 'json',
		        data: JSON.stringify(data),
		        error: function(jqXHR) {
		            console.log("ajax error " + jqXHR.status);
		        }
		    };
		    return $.ajax(request);
		}

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
					var res = [];
					for( var i = 0; i < vids.length; i++ )
					{
						self.ajax( self.videosURI + "/" + vids[i], 'GET' ).done(
						    function( data ) 
						    {
							res[i] = data;
					    	    } );
						alert(res.length);
						if( res.length == vids.length )
						{
							var restr = JSON.stringify( res );
							restr = encodeURIComponent( restr );

							var vform = $('<form action="vidlist.php" method="post" style="display:none;">' + 
						'<input type="textarea" maxlength="5000" name="vidlist" value="' + restr + '" /' + '>' +
						  	'</form>');
							$('body').append( vform );
							vform.submit();
						}	
					}
					
				    }
			});
	}
	</script>

	
</body>
</html>		


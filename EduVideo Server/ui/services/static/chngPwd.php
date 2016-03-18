<?php
	session_start();
	if( !isset($_SESSION["username"]) || !isset($_SESSION["usertype"]) )
	{
		header("Location: index.php");
	}
?>

<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="css/mynav.css">
	</head>
	<body style="background-color:#F0F0F0;">
		<nav class="navbar navbar-inverse navbar-static-top">
	    	<div class="container">
		        <div class="navbar-header">
		        	<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
			            <span class="sr-only">Toggle navigation</span>
			            <span class="icon-bar"></span>
			            <span class="icon-bar"></span>
			            <span class="icon-bar"></span>
		        	</button>
		        	
		        </div>
		        <div id="navbar" class="navbar-collapse collapse">
		        	<ul class="nav navbar-nav  navbar-right">
		        		<li><a href="index.php" style="color:white"><span class="glyphicon glyphicon-home"></span> &nbsp;&nbsp;Home</a></li>
						<li class = "dropdown active">
						<a href="#" class = "dropdown-toggle" id="username" data-toggle = "dropdown" style="color:white">USERNAME <b class = "caret"></b></a>
						<ul class = "dropdown-menu">
							<li><a href="chngPwd.php">Change Password</a></li>
							<li><a href="logout.php">Log Out</a></li>
						</ul>
						</li>
		          	</ul>
		        </div>
	    	</div>
    	</nav>
		

		<div class = "container">
			<div class = "row">
				<div class = "col-sm-12">
					<div class="panel panel-default">
						<div class = "panel-body">
							<div class = "page-header">
								<h2 style = "padding-left:5%">Change Details</h2>
							</div>
							<br>
							<div>
								<div class="row">
									<div class="col-sm-2 col-sm-offset-1" style="align:center"><label style="padding-top:4%;">Username</label></div>
									<div class="col-sm-6">
										<input type="text" autofocus id="usernm" class="form-control"/>
									</div>
								</div>
								<br>
								<div class="row">
									<div class="col-sm-2 col-sm-offset-1" style="align:center"><label style="padding-top:4%;">Current Password</label></div>
									<div class="col-sm-6">
										<input type="password" placeholder = "Current Password" id = "oldpassword" class="form-control"/>
									</div>
								</div>
								<br>
								<div class="row">
									<div class="col-sm-2 col-sm-offset-1" style="align:center"><label style="padding-top:4%;">New Password</label></div>
									<div class="col-sm-6">
										<input type="password" placeholder = "New Password" id = "newpassword" class="form-control"/>
									</div>
								</div>
								<br>
								<div class="row">
									<div class="col-sm-2 col-sm-offset-1" style="align:center"><label style="padding-top:4%;">Confirm Password</label></div>
									<div class="col-sm-6">
										<input type="password" placeholder = "Confirm Password" id = "confirmpassword" class="form-control"/>
									</div>
								</div>
								<br>
								<div class="row">
									<div class="col-sm-6 col-sm-offset-3" id="errormsg" style="color:red;"></div>
								</div>
								<br>
								<div class="row">
									<div class="col-sm-3 col-sm-offset-3">
										<button type="button" class="btn btn-md btn-primary btn-block" onclick="editusr();">Submit</button>
									</div>
									<div class="col-sm-3">
										<button type="button" id="cancel" class="btn btn-md btn-primary btn-block" onclick="cancel();">Cancel</button>
									</div>
								</div>
								<br> <hr> <br>
								<div class="row">
									<div class="col-sm-3 col-sm-offset-4">
										<button type="button" class="btn btn-md btn-primary btn-block" onclick="delusr();">Delete Account?</button>
									</div>
								</div>
								<hr><br>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<script type="text/javascript" src = "js/jquery.min.js"></script>
		<script type="text/javascript" src = "js/bootstrap.min.js"></script>
		<script type="text/javascript">

			window.onload = function ()
			{
			    var username = document.getElementById("username");
			    var usernm = document.getElementById("usernm");
			    username.innerHTML = <?php echo json_encode($_SESSION["username"]) ?> + "&nbsp;<b class = \"caret\"></b>";
			    usernm.value = <?php echo json_encode($_SESSION["username"]) ?> ;
			}

			function editusr()
			{	
				var self = this;
				self.usersURI = 'http://localhost:5000/eduvideo/users';

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

				var usrnm = $("#usernm").val();
				var oldpwd = $("#oldpassword").val();
				var newpwd = $("#newpassword").val();
				var cnfpwd = $("#confirmpassword").val();

				if( usrnm == "" || oldpwd == "" || newpwd == "" || cnfpwd == "" )
				{
					$("#errormsg").html("Enter all details!");
				}
				else if( cnfpwd != newpwd )
				{
					$("#errormsg").html("Confirm Password does Not match New Password!");
					$("#newpassword").focus();
				}
				else
				{
					var uri = self.usersURI + "/" + <?php echo json_encode($_SESSION["uid"]) ?> ;
					self.ajax( uri , 'GET' ).done(
						function( res ) 
						{
							if( res.user.password != oldpwd )
							{
								$("#errormsg").html("The old password is incorrect!");
								$("#oldpassword").focus();
							}
							else
							{
								var data = { username : usrnm, password: newpwd };
								self.ajax( uri , 'PUT', data ).done(
									function( res ) 
									{
										$("#errormsg").css('color', 'green');
										$("#errormsg").html("Successfully updated account!");
										$("#cancel").html('Close');
									} );
							}
						} );
				}	
			    	
			}

			function delusr()
			{
				var self = this;
				self.usersURI = 'http://localhost:5000/eduvideo/users';
				var uri = self.usersURI + "/" + <?php echo json_encode($_SESSION["uid"]) ?> ;

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
				
				self.ajax( uri , 'DELETE' ).done(
					function() 
					{
						location.href = "logout.php";
					} );
			}

			function cancel()
			{
				location.href = "index.php";
			}

		</script>
	</body>
</html>

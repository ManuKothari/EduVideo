<!DOCTYPE HTML>
<html>
<head>
<title>EduVideo</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- bootstrap -->
<link href="css/bootstrap.min.css" rel='stylesheet' type='text/css' media="all" />
<!-- //bootstrap -->
<link href="css/dashboard.css" rel="stylesheet">
<!-- Custom Theme files -->
<link href="css/style.css" rel='stylesheet' type='text/css' media="all" />
<script src="js/jquery-1.11.1.min.js"></script>
<!--start-smoth-scrolling-->
<!-- fonts -->
<link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Poiret+One' rel='stylesheet' type='text/css'>
<!-- //fonts -->

<script src="http://ajax.aspnetcdn.com/ajax/jquery/jquery-1.9.1.js"></script>
<script src="http://netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/js/bootstrap.min.js"></script>
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
          <a class="navbar-brand" href="#"><h1><img src="images/logo.png" alt="" width=50px height=50px /></h1></a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
			<div class="top-search">
				<form class="navbar-form navbar-right">
					<input type="text" class="form-control" placeholder="Search...">
					<input type="submit" value=" ">
				</form>
			</div>  
			<div class="header-top-right">
				<div class="file">
					<a href="upload.html">Upload</a>
				</div>	
				<div class="signin">
					<a href="#">Sign Up</a>
				</div>
				<div class="signin">
					<a href="#">Sign In</a>
				</div>
				<div class="clearfix"> </div>
			</div>
        </div>
		<div class="clearfix"> </div>
      </div>
    </nav>
		<div></div>

		<!-- upload -->
		<div class="upload">
			<!-- container -->
			<div class="container">
				<div class="upload-grids">
					<div class="upload-right">
						<div class="upload-file">
							<div class="services-icon">
								<span class="glyphicon glyphicon-open" aria-hidden="true"></span>
							</div>
							<form name="vidUploadForm" method="post" enctype="multipart/form-data">
								<input type="file" value="Choose file.." id="vidfile" accept="video/*" onchange="displayinfo();">
							</form>
						</div>
						<div id="vidinfo" class="upload-info">
							<h5>Select a video file to upload</h5>
							<span>or</span>
							<p>Drag and drop a video file</p>
						</div>
					</div>	
				</div>
			</div>
			<!-- //container -->
		</div>
		<!-- //upload -->

		<div class="row">
			<div class="col-sm-12"><hr></div>
		</div>

		<div id = "new_video_form" class="row" style="display:none;">
			<div class="col-sm-12">
				<div class="panel panel-default">
					<div class="panel-body">
						<div class="row">
							<div class="col-sm-2">
								<h3>Video Details</h3>
							</div>
						</div>
						<br>
						<form>
							<div class="form-group">
								<div class="row">
									<div class="col-sm-3">
										<label style="padding-top:5%;font-size:14px;">Enter video title</label>
									</div>
									<div class="col-sm-4">
										<input type="text" name="vidtitle" style="width: 600px;" class="form-control" id="vidtitle" placeholder = "Enter video title" />
									</div>
									<div class="col-sm-5">
										<div id="vidtitle_msg" style="color:red;padding-top:2%;"></div>
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="row">
									<div class="col-sm-12">
										<textarea class="form-control" rows="3" style="resize:none;" id="descrip" placeholder = "Enter description..."></textarea>
									</div>
								</div>
								<div class="row">
									<div class="col-sm-11 col-sm-offset-1">
										<div id="descrip_msg" style="color:red;padding-top:1%;"></div>
									</div>
								</div>
							</div>
							<hr>
							<div class="form-group">
								<div class="row">
									<div class="col-sm-3">
										<label style="padding-top:5%;font-size:14px;">Choose video category</label>
									</div>
									<div class="col-sm-4">
										<label style="padding-top:4%;">Subject</label>
										<select id="subject" class="form-control">
						<?php

							try {
								$conn = new MongoClient('mongodb://admin:root@ds055564.mlab.com:55564/eduvideo');
								$db = $conn->eduvideo;
								$collection = $db->category;
								$cursor = $collection->find();
								foreach ($cursor as $obj)
								{
									echo "<option value='". $obj['sub'] ."'>". $obj['sub'] ."</option>";
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
										</select>
									</div>
									<div class="col-sm-5">
										<label style="padding-top:4%;">Unit & Topic</label>
										<select id="uniTopic" class="form-control"></select>
									</div>
								<div>
								<div class="row">	
									<label class="col-sm-2 col-sm-offset-3" style="padding-top:4%;">Subtopic</label>
									<div class="col-sm-7 col-sm-offset-4">
										<input type="text" name="subtopic" placeholder="Subtopic, if any" class="form-control" id="subtopic" />
									</div>
									<div class="col-sm-5">
										<div id="category_msg" style="color:red;padding-top:2%;"></div>
									</div>
								</div>
							</div>
							</br>
							<div class="form-group">
								<div class="row">
									<div class="col-sm-12">
										<textarea class="form-control" rows="2" style="resize:none;" id="tags" placeholder = "Enter additional tags, if any, separated by comma..."></textarea>
									</div>
								</div>
								<div class="row">
									<div class="col-sm-11 col-sm-offset-1">
										<div id="tags_msg" style="color:red;padding-top:1%;"></div>
									</div>
								</div>
							</div>
							<hr>
							<div class="form-group">
								<div class="row">
									<div class="col-sm-3">
										<label style="padding-top:5%;font-size:14px;">Enter video length</label>
									</div>
									<div class="col-sm-4">
										<input type="text" name="vlength" placeholder="Video Length" class="form-control" id="vlength" />
									</div>
									<div class="col-sm-5">
										<div id="vlength_msg" style="color:red;padding-top:2%;"></div>
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="row">
									<div class="col-sm-12">
										<textarea class="form-control" rows="2" style="resize:none;" id="notes" placeholder = "Enter notes, if any, for the video..."></textarea>
									</div>
								</div>
								<div class="row">
									<div class="col-sm-11 col-sm-offset-1">
										<div id="notes_msg" style="color:red;padding-top:1%;"></div>
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="row">
									<div class="col-sm-12">
										<textarea class="form-control" rows="2" style="resize:none;" id="reference" placeholder = "Enter reference, if any, for the video..."></textarea>
									</div>
								</div>
								<div class="row">
									<div class="col-sm-11 col-sm-offset-1">
										<div id="reference_msg" style="color:red;padding-top:1%;"></div>
									</div>
								</div>
							</div>
							<hr>				
							<div class="form-group">
								<div class="row">
									<div class="col-sm-2 col-sm-offset-5">
										<input type="button" value="SUBMIT" class="btn btn-primary btn-block" onclick="post_vid();" />
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
			
		<div class="clearfix"> </div>
    <script src="js/bootstrap.min.js"></script>

    <script type="text/javascript">

        function displayinfo()
	{
            myFile = document.getElementById("vidfile").files[0];
	    myDiv = document.getElementById("vidinfo");
	    myDiv.innerHTML = "<p>" + myFile.name + "</p>";
 
	    $("#vidtitle").val( myFile.name.split(".")[0] );
	    $("#descrip").val("");
	    $("#subtopic").val("");
	    $("#tags").val("");
	    $("#vlength").val("");
	    $("#notes").val("");
	    $("#reference").val("");
	
	    $( "#subject" ).change( function() 
		{
			var sub = $("#subject").val();
			var units = document.getElementById("uniTopic");
			units.options.length = 0;
			$.ajax({
			    url: 'subject.php',
			    data: "sub=" + encodeURIComponent(sub),
			    type: 'POST',
			    cache: false,
			    error: function( jqXHR )
				   {
				   	console.log("ajax error " + jqXHR.status);
				   },
			    success: function( data )
				    {
					 var topics = data.split(";");
					 for( i=0; i<5; i++ )
					 {
						units.options[units.options.length] = new Option(topics[i], topics[i]);
					 }		
				    }
			});
			
	    	}); 
					   
	    var formData = new FormData();
            formData.append( "video", myFile );
	    $.ajax({
		    url: 'http://localhost:3000/video',
		    contentType: false,
		    processData: false,
		    data: formData,
		    type: 'POST',
		    cache: false,
		    dataType: 'json',
		    accepts: "application/json",
		    error: function( jqXHR )
			   {
			   	console.log("ajax error " + jqXHR.status);
			   },
		    success: function( data )
		    {
			 vidgrid_id = data["_id"];
			 $("#new_video_form").show();
 			 $("#vidtitle").focus();			
		    }
		});
        }

	function post_vid()
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

		var newVid = {
				title: $("#vidtitle").val(),
				description: $("#descrip").val(),
				category: [{
						'subject'  : $("#subject").val(),
    						'unitTopic': $("#uniTopic").val(),
    						'subtopic' : $("#subtopic").val()
					  }],
				tags: $("#tags").val().split(","),
				vlength: $("#vlength").val(),
				notes: $("#notes").val(),
				reference: $("#reference").val(),
				video_id : vidgrid_id
		};

 		self.ajax( self.videosURI, 'POST', newVid ).done( 
		    function( data ) 
		    {			
				var output = '';
				for (var property in data.video) 
				{
					output += property + ': ' + data.video[ property ]+';  ';
				}
				alert(output);				
		    } );
	}

    </script>

  </body>
</html>
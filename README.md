# EduVideo

## Running the Node.js Server Locally

1. Make sure you have an up-to-date version of Node.js installed on your system. If you don't have Node.js installed, you can install it from [here](http://nodejs.org/).

1. Clone this repository

1. On the command line, navigate (cd) to the **EduVideo Server** folder

1. Install the server dependencies

  ```
  npm install
  ```

1. Start the server

  ```
  node server
  ```

1. Open a browser and access: [http://localhost:3000](http://localhost:3000) Should display {"error":false,"message":"Hello World"}

1. If the above fails, make sure a mongod instance is running on your system. 

1. To add a video to your DB open POSTMAN (Chrome extension for HTTP) and do a POST to localhost:3000/video with a file with key - video and value - choose video file. It will return '_id' - save it. Launch index.html with the '_id' (hardcoded) inside the .html file and see the magic. 

REST APIs

|   URI   |   HTTP Verb     |   Remark   |
| ------  | :-------------: | -----------|
|/get/video/{id}	|	  GET	|	Provides link to the video with id = {id}|
|/post/video	|	    	POST|	Add new video to the database|
|/put/video/{id}|		  PUT| 	Update video with id = {id}|
|/get/user/{id}	|	  GET |	Read user details|
|/post/user		|	    POST| 	Add new user into database|
|/put/user/{id}	|	  PUT |	Update user details|
|/get/channel/{id}	 | GET |	Read channel details|
|/post/channel 	|	  POST |	Add new channel (owner - user)|
|/put/channel/{id}	|  PUT |	Update channel details - add subscribers|


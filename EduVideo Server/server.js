var express     =   require("express");
var app         =   express();
var bodyParser  =   require("body-parser");
var router      =   express.Router();
var mongoose 	=   require('mongoose');
var Grid 		=   require('gridfs-stream');
var fs 			= 	require('fs')
Grid.mongo 		=	mongoose.mongo;
var multer		= 	require('multer')
var conn 		= 	mongoose.createConnection('mongodb://admin:root@ds059365.mongolab.com:59365/eduvideo');


app.use(bodyParser.json());
app.use(bodyParser.urlencoded({"extended" : false}));

router.get("/",function(req,res){
    res.json({"error" : false,"message" : "Hello World"});
});

router.get("/video/:id",function(req,res){
  	var gfs = Grid(conn.db);
	var readstream = gfs.createReadStream({
		'_id': req.params.id
	});
	readstream.pipe(res);	
  // all set!
});

var upload = multer({
    dest:'./uploads/',
    onFileUploadStart: function (file) {
        console.log('uploading of ' + file.originalname + ' is starting ...')
    },
    onFileUploadComplete: function (file) {
        console.log("completed....");
    }
});

app.post("/video", upload.single('video'), function(req,res) {
	var gfs = Grid(conn.db);

	// console.log(req.file)
	// res.json(req.file)
    var source = fs.createReadStream(req.file.path);

     var target = gfs.createWriteStream({
         filename: req.file.originalname
     });

     source.pipe(target);

    target.on('close', function(file) {
    	console.log(file._id);
    	console.log(JSON.stringify(file))
    	res.json({'_id':file._id})
    });
});

app.use('/',router);

app.listen(process.env.port || 3000);
console.log("Listening to PORT 3000");


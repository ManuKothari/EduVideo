from __future__ import print_function
from flask import Flask, jsonify, abort, make_response
from flask.ext.restful import Api, Resource, reqparse, fields, marshal
from flask.ext.cors import CORS
from bson.objectid import ObjectId
from pymongo import MongoClient
import collections, fileinput
import pymongo

try:
    client = MongoClient('mongodb://admin:root@ds055564.mlab.com:55564/eduvideo',serverSelectionTimeoutMS=5000)
    client.server_info()
    print("Connceted to MongoDB@online")
except:
    client = MongoClient()
    print("Connected to MongoDB@localhost");

db = client.eduvideo
video_col = db.video
user_col = db.user
channel_col = db.channel
chunks_col = db.fs.chunks
files_col = db.fs.files

app = Flask(__name__, static_url_path="")
api = Api(app)
CORS(app)


usr_rates = {
    'good': fields.List( fields.String ),
    'avg': fields.List( fields.String ),
    'poor': fields.List( fields.String )
}

user_fields = {
    'username': fields.String,
    'password': fields.String,
    'usertype': fields.String,
    '_id': fields.String,
    'history': fields.List( fields.String ),
    'rates': fields.Nested( usr_rates ),
    'channel_ids': fields.List( fields.String ),
    'subscribed_ids': fields.List( fields.String ),
    'watch_later_ids': fields.List( fields.String ),
    'uri': fields.Url('user')
}

vid_category = {
    'subject': fields.String,
    'unitTopic': fields.String,
    'subtopic': fields.String
}

vid_rates = {
    'good': fields.Integer,
    'avg': fields.Integer,
    'poor': fields.Integer
}

video_fields = {
    'title': fields.String,
    'description': fields.String,
    'vlength': fields.String,
    'category': fields.List( fields.Nested( vid_category ) ),
    'tags': fields.List( fields.String ),
    'notes': fields.String,
    'reference': fields.String,
    'view_count': fields.Integer,
    'rates': fields.Nested( vid_rates ),
    '_id': fields.String,
    'video_id' : fields.String,
    'author': fields.String,
    'linkedto': fields.String,
    'linkedby': fields.String,
    'channel': fields.String,
    'comments': fields.List( fields.String ),
    'uri': fields.Url('video')
}

channel_fields = {
    'subjects': fields.List( fields.String ),
    'channel_name': fields.String,
    'author_id': fields.String,
    '_id': fields.String,
    'subscriber_ids': fields.List( fields.String ),
    'video_ids': fields.List( fields.String ),
    'uri': fields.Url('channel')
}

#----------------------------------------------------User----------------------------------------------------------------------------------

class UserListAPI(Resource):

    def __init__(self):
        self.reqparse = reqparse.RequestParser()
        self.reqparse.add_argument('username', type=str, required=True, help='No username provided', location='json')
        self.reqparse.add_argument('password', type=str, required=True, help='No password provided', location='json')
        super(UserListAPI, self).__init__()

    def get(self):
        return {'users': [marshal(user, user_fields) for user in user_col.find()]}

    def post(self):
        args = self.reqparse.parse_args()
        user = {
            'username': args['username'],
            'password': args['password'],
            'usertype': "genuser",
            'history': [],
            'rates': {
			'good': [],
                        'avg': [],
                        'poor': []
                     },
            'channel_ids': [],
            'subscribed_ids': [],
            'watch_later_ids': []
        }
        user['_id'] = str(user_col.insert_one(user).inserted_id)
        return {'user': marshal(user, user_fields)}, 201


class UserAPI(Resource):

    def __init__(self):
        self.reqparse = reqparse.RequestParser()
        self.reqparse.add_argument('username', type=str, location='json')
        self.reqparse.add_argument('password', type=str, location='json')
        super(UserAPI, self).__init__()

    def get(self, _id):
        user = [user for user in user_col.find() if str(user['_id']) == _id]
        if len(user) == 0:
            abort(404)
        return {'user': marshal(user[0], user_fields)}

    def put(self, _id):
        user = [user for user in user_col.find() if str(user['_id']) == _id]
        if len(user) == 0:
            abort(404)
        user = user[0]
        args = self.reqparse.parse_args()
        for k, v in args.items():
            if v is not None:
                user[k] = v
        user_col.find_one_and_update({'_id': ObjectId(_id) }, { '$set':user })
        return {'user': marshal(user, user_fields)}

    def delete(self, _id):
        user = [user for user in user_col.find() if str(user['_id']) == _id]
        if len(user) == 0:
            abort(404)
        user = user[0]
        delchn = getattr( ChannelAPI() , 'delete' )
        for cid in user['channel_ids']:
            delchn( cid )
        for cid in user['subscribed_ids']:
            channel_col.find_one_and_update( {'_id': ObjectId( cid ) } , { '$pull': { 'subscriber_ids' : _id } } )
        user_col.find_one_and_delete({'_id': ObjectId(_id) })
        return {'result': True}

#----------------------------------------------------Channel----------------------------------------------------------------------------------

class ChannelListAPI(Resource):

    def __init__(self):
        self.reqparse = reqparse.RequestParser()
        self.reqparse.add_argument('subjects', type=list, required=True, help='No subjects provided', location='json')
        self.reqparse.add_argument('channel_name', type=str, required=True, help='Channel name not provided', location='json')
        self.reqparse.add_argument('author_id', type=str, required=True, help='Author Id not provided', location='json')
        super(ChannelListAPI, self).__init__()

    def get(self):
        return {'channels': [marshal(channel, channel_fields) for channel in channel_col.find()]}

    def post(self):
        args = self.reqparse.parse_args()
        channel = {
            'subjects': args['subjects'],
            'channel_name': args['channel_name'],
            'author_id': args['author_id'],
            'subscriber_ids': [],
            'video_ids': []
        }
        channel['_id'] = str(channel_col.insert_one(channel).inserted_id)
        user_col.find_one_and_update( {'_id': ObjectId( channel['author_id'] ) } , { '$push': { 'channel_ids' : channel['_id'] } } )
        return {'channel': marshal(channel, channel_fields)}, 201


class ChannelAPI(Resource):

    def __init__(self):
        self.reqparse = reqparse.RequestParser()
        self.reqparse.add_argument('subjects', type=list, location='json')
        self.reqparse.add_argument('channel_name', type=str, location='json')
        self.reqparse.add_argument('author_id', type=str, location='json')
        super(ChannelAPI, self).__init__()

    def get(self, _id):
        channel = [channel for channel in channel_col.find() if str(channel['_id']) == _id]
        if len(channel) == 0:
            abort(404)
        return {'channel': marshal(channel[0], channel_fields)}

    def put(self, _id):
        channel = [channel for channel in channel_col.find() if str(channel['_id']) == _id]
        if len(channel) == 0:
            abort(404)
        channel = channel[0]
        args = self.reqparse.parse_args()
        for k, v in args.items():
            if v is not None:
                channel[k] = v
        channel_col.find_one_and_update({'_id': ObjectId(_id) }, { '$set':channel })
        return {'channel': marshal(channel, channel_fields)}

    def delete(self, _id):
        channel = [channel for channel in channel_col.find() if str(channel['_id']) == _id]
        if len(channel) == 0:
            abort(404)
        channel = channel[0]
        delvid = getattr( VideoAPI() , 'delete' )
        for vid in channel['video_ids']:
            delvid( vid )
        user_col.find_one_and_update( {'_id': ObjectId( channel['author_id'] ) } , { '$pull': { 'channel_ids' : _id } } )
        for uid in channel['subscriber_ids']:
            user_col.find_one_and_update( {'_id': ObjectId( uid ) } , { '$pull': { 'subscribed_ids' : _id } } )
        channel_col.find_one_and_delete({'_id': ObjectId(_id) })
        return {'result': True}

#----------------------------------------------------Video----------------------------------------------------------------------------------

def setwrd( myset, wordstr ):
	for word in wordstr.split(" "):
		myset.add( word.lower() )

def wrtfile( video ):
	extras = set()
	setwrd( extras, video['title'] )
	setwrd( extras, video['description'] )
	for vid in video['category']:
		setwrd( extras, vid['subject'] )
		setwrd( extras, vid['unitTopic'] )
		if( vid['subtopic'] != "" ):
			setwrd( extras, vid['subtopic'] )
	for tag in video['tags']:
		extras.add( tag )
	extras = list( extras )
	extras = " ".join( extras )
	return extras


class VideoListAPI(Resource):

    def __init__(self):
        self.reqparse = reqparse.RequestParser()
        self.reqparse.add_argument('title', type=str, required=True, help='No video title provided',location='json')
        self.reqparse.add_argument('description', type=str, default="", location='json')
        self.reqparse.add_argument('vlength', type=str, required=True, help='No video length provided',location='json')
        self.reqparse.add_argument('category', type=list, required=True, help='No category provided', location='json')
        self.reqparse.add_argument('tags', type=list, default="", location='json')
        self.reqparse.add_argument('notes', type=str, default="", location='json')
        self.reqparse.add_argument('reference', type=str, default="", location='json')
        self.reqparse.add_argument('channel', type=str, required=True, help='No channel provided', location='json')
        self.reqparse.add_argument('author', type=str, required=True, help='No author provided', location='json')
        self.reqparse.add_argument('video_id', type=str, required=True, help='No _id provided', location='json')
        super(VideoListAPI, self).__init__()

    def get(self):
        return {'videos': [marshal(video, video_fields) for video in video_col.find()]}

    def post(self):
        args = self.reqparse.parse_args()
        video = {
            'title': args['title'],
            'description': args['description'],
            'vlength': args['vlength'],
    	    'category': args['category'],
    	    'tags': args['tags'],
            'notes': args['notes'],
            'reference': args['reference'],
            'channel': args['channel'],
            'author': args['author'],
            'video_id': args['video_id'],
	    'rates': { 
			'good': 0,
	    		'avg': 0,
    			'poor': 0 
		     },
	    'view_count': 0,
            'linkedto': "",
            'linkedby': "",
            'comments': []
        }
        video['_id'] = str(video_col.insert_one(video).inserted_id)
        channel_col.find_one_and_update( {'_id': ObjectId( video['channel'] ) } , { '$push': { 'video_ids' : video['_id'] } } )
        extras = wrtfile( video )
        with open('vidnm.txt', 'a') as f:
        	f.write( str(video['_id']) + " $@$ " + video['title'] + " $@$ " + extras + "\n")
        return {'video': marshal(video, video_fields)}, 201


class VideoAPI(Resource):

    def __init__(self):
        self.reqparse = reqparse.RequestParser()
        self.reqparse.add_argument('title', type=str, location='json')
        self.reqparse.add_argument('description', type=str, location='json')
        self.reqparse.add_argument('vlength', type=str, location='json')
        self.reqparse.add_argument('category', type=list, location='json')
        self.reqparse.add_argument('tags', type=list, location='json')
        self.reqparse.add_argument('notes', type=str, location='json')
        self.reqparse.add_argument('reference', type=str, location='json')
        self.reqparse.add_argument('channel', type=str, location='json')
        self.reqparse.add_argument('author', type=str, location='json')
        self.reqparse.add_argument('video_id', type=str, location='json')
        super(VideoAPI, self).__init__()

    def get(self, _id):
        video = [video for video in video_col.find() if str(video['_id']) == _id]
        if len(video) == 0:
            abort(404)
        return {'video': marshal(video[0], video_fields)}

    def put(self, _id):
        video = [video for video in video_col.find() if str(video['_id']) == _id]
        if len(video) == 0:
            abort(404)
        video = video[0]
        args = self.reqparse.parse_args()
        updfile = 0
        for k, v in args.items():
            if v is not None:
               	video[k] = v
            if k in ['description', 'tags', 'category']:
                updfile = 1
            elif k == 'title':
                updfile = 2
        video_col.find_one_and_update({'_id': ObjectId(_id) }, { '$set':video })
        if( updfile in [1, 2] ):
            extras = wrtfile( video )
            for line in fileinput.input( "vidnm.txt", inplace=1 ):
                if( line.split(" $@$ ")[0] == _id ):
                    line = line.replace( line.split(" $@$ ")[2] , extras + "\n" )
                    if( updfile == 2 ):
                        line = line.replace( line.split(" $@$ ")[1] , video['title'] )
                print( line, end="" )
        return {'video': marshal(video, video_fields)}

    def delete(self, _id):
        video = [video for video in video_col.find() if str(video['_id']) == _id]
        if len( video ) == 0:
            abort(404)
        video = video[0]
        grid_id = video['video_id']
        channel_col.find_one_and_update( {'_id': ObjectId( video['channel'] ) } , { '$pull': { 'video_ids' : _id } } )
        if( video['linkedto'] != "" ):
            video_col.find_one_and_update( {'_id': ObjectId( video['linkedto'] ) } , { '$set': { 'linkedby' : "" } } )
        if( video['linkedby'] != "" ):
            video_col.find_one_and_update( {'_id': ObjectId( video['linkedby'] ) } , { '$set': { 'linkedto' : "" } } )
        video_col.find_one_and_delete({'_id': ObjectId(_id) })
        files_col.remove({'_id': ObjectId( grid_id ) })
        chunks_col.remove({'files_id': ObjectId( grid_id ) })
        user_col.update_many( { 'history' : _id } , { '$pull' : { 'history' : _id } } )
        user_col.update_many( { 'watch_later_ids' : _id } , { '$pull' : { 'watch_later_ids' : _id } } )
        user_col.update_many( { 'rates.good' : _id } , { '$pull' : { 'rates.good' : _id } } )
        user_col.update_many( { 'rates.avg' : _id } , { '$pull' : { 'rates.avg' : _id } } )
        user_col.update_many( { 'rates.poor' : _id } , { '$pull' : { 'rates.poor' : _id } } )
        for line in fileinput.input( "vidnm.txt", inplace=1 ):
            if( line.split(" $@$ ")[0] != _id ):
                print( line, end="" )
        return {'result': True}

api.add_resource(UserListAPI, '/eduvideo/users', endpoint='users')
api.add_resource(UserAPI, '/eduvideo/users/<_id>', endpoint='user')

api.add_resource(ChannelListAPI, '/eduvideo/channels', endpoint='channels')
api.add_resource(ChannelAPI, '/eduvideo/channels/<_id>', endpoint='channel')

api.add_resource(VideoListAPI, '/eduvideo/videos', endpoint='videos')
api.add_resource(VideoAPI, '/eduvideo/videos/<_id>', endpoint='video')


if __name__ == '__main__':
    app.run(debug=True)


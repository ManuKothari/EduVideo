from flask import Flask, jsonify, abort, make_response
from flask.ext.restful import Api, Resource, reqparse, fields, marshal
from pymongo import MongoClient
import collections

client = MongoClient('mongodb://admin:root@ds059365.mongolab.com:59365/eduvideo')

db = client.eduvideo
video_col = db.video
user_col = db.user
channel_col = db.channel
app = Flask(__name__, static_url_path="")
api = Api(app)

videos = [
    {
	'title' : 'Intro',
	'description' : 'Introduction', 
	'video_id' : 1,
	'vlength' : "02:58",
	'category' :  [ { 'subject' : 'C++',
			  'unit' : 1,
			  'topic' : 'Introduction',
			  'sub_topic' : ''
			} 
		      ],
	'tags' : "Codeblocks",
	'notes' : "Example",
	'reference' : "",
	'subtitle' : ""
    },
    {
    'title' : 'Strings in C++',
	'description' : '', 
	'video_id' : 2,
	'vlength' : "02:39",
	'category' :  [ { 'subject' : 'C++',
			  'unit' : 2,
			  'topic' : 'Basics',
			  'sub_topic' : 'String'
			} 
		      ],
	'tags' : "",
	'notes' : "",
	'reference' : "", 
	'subtitle' : ""
    }
]

user_fields = {
    'username': fields.String,
    'password': fields.String,
    'uri': fields.Url('user')
}

video_fields = {
    'title': fields.String,
    'description': fields.String,
    'vlength': fields.String,
    'category': fields.String,
    'tags': fields.String,
    'notes': fields.String,
    'reference': fields.String,
    'subtitle': fields.String,
    'uri': fields.Url('video')
}

channel_fields = {
    'subjects': fields.String,
    'no_of_videos': fields.Integer,
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
            'password': args['password']
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
        user = [user for user in user_col.find() if user['_id'] == _id]
        if len(user) == 0:
            abort(404)
        return {'user': marshal(user[0], user_fields)}

    def put(self, _id):
        print(list(user_col.find()))
        user = [user for user in user_col.find() if user['_id'] == _id]
        if len(user) == 0:
            abort(404)
        user = user[0]
        args = self.reqparse.parse_args()
        for k, v in args.items():
            if v is not None:
                user[k] = v
        user_col.find_one_and_update({'_id': _id }, user)
        return {'user': marshal(user, user_fields)}

    def delete(self, _id):
        user = [user for user in user_col.find() if user['_id'] == _id]
        if len(user) == 0:
            abort(404)
        users.find_one_and_delete({'_id': _id })
        return {'result': True}

#----------------------------------------------------Channel----------------------------------------------------------------------------------

class ChannelListAPI(Resource):

    def __init__(self):
        self.reqparse = reqparse.RequestParser()
        self.reqparse.add_argument('subjects', type=str, required=True, help='No subjects provided', location='json')
        self.reqparse.add_argument('no_of_videos', type=int, required=True, help='Total number of videos not provided', location='json')
        super(ChannelListAPI, self).__init__()

    def get(self):
        return {'channels': [marshal(channel, channel_fields) for channel in channel_col.find()]}

    def post(self):
        args = self.reqparse.parse_args()
        channel = {
            'subjects': args['subjects'],
            'no_of_videos': args['no_of_videos']
        }
        channel['_id'] = str(channel_col.insert_one(channel).inserted_id)
        return {'channel': marshal(channel, channel_fields)}, 201


class ChannelAPI(Resource):

    def __init__(self):
        self.reqparse = reqparse.RequestParser()
        self.reqparse.add_argument('subjects', type=str, location='json')
        self.reqparse.add_argument('no_of_videos', type=int, location='json')
        super(ChannelAPI, self).__init__()

    def get(self, _id):
        channel = [channel for channel in channel_col.find() if channel['_id'] == _id]
        if len(channel) == 0:
            abort(404)
        return {'channel': marshal(channel[0], channel_fields)}

    def put(self, _id):
        channel = [channel for channel in channel_col.find() if channel['_id'] == _id]
        if len(channel) == 0:
            abort(404)
        channel = channel[0]
        args = self.reqparse.parse_args()
        for k, v in args.items():
            if v is not None:
                channel[k] = v
        channel_col.find_one_and_update({'_id': _id }, channel)
        return {'channel': marshal(channel, channel_fields)}

    def delete(self, _id):
        channel = [channel for channel in channel_col.find() if channel['_id'] == _id]
        if len(channel) == 0:
            abort(404)
        channel_col.find_one_and_delete({'_id': _id })
        return {'result': True}

#----------------------------------------------------Video----------------------------------------------------------------------------------

class VideoListAPI(Resource):

    def __init__(self):
        self.reqparse = reqparse.RequestParser()
        self.reqparse.add_argument('title', type=str, required=True, help='No video title provided',location='json')
        self.reqparse.add_argument('description', type=str, default="", location='json')
        self.reqparse.add_argument('vlength', type=str, required=True, help='No video length provided',location='json')
        self.reqparse.add_argument('category', type=str, required=True, help='No category provided', location='json')
        self.reqparse.add_argument('tags', type=str, default="", location='json')
        self.reqparse.add_argument('notes', type=str, default="", location='json')
        self.reqparse.add_argument('reference', type=str, default="", location='json')
        self.reqparse.add_argument('subtitle', type=str, default="", location='json')
        super(VideoListAPI, self).__init__()

    def get(self):
        return {'videos': [marshal(video, video_fields) for video in videos]}

    def post(self):
        args = self.reqparse.parse_args()
        video = {
            'video_id': videos[-1]['video_id'] + 1,
            'title': args['title'],
            'description': args['description'],
            'vlength': args['vlength'],
    	    'category': args['category'],
    	    'tags': args['tags'],
            'notes': args['notes'],
            'reference': args['reference'],
    	    'subtitle': args['subtitle']
        }
        videos.append(video)
        return {'video': marshal(video, video_fields)}, 201


class VideoAPI(Resource):

    def __init__(self):
        self.reqparse = reqparse.RequestParser()
        self.reqparse.add_argument('title', type=str, location='json')
        self.reqparse.add_argument('description', type=str, location='json')
        self.reqparse.add_argument('vlength', type=str, location='json')
        self.reqparse.add_argument('category', type=str, location='json')
        self.reqparse.add_argument('tags', type=str, location='json')
        self.reqparse.add_argument('notes', type=str, location='json')
        self.reqparse.add_argument('reference', type=str, location='json')
        self.reqparse.add_argument('subtitle', type=str, location='json')
        super(VideoAPI, self).__init__()

    def get(self, video_id):
        video = [video for video in videos if video['video_id'] == video_id]
        if len(video) == 0:
            abort(404)
        return {'video': marshal(video[0], video_fields)}

    def put(self, video_id):
        video = [video for video in videos if video['video_id'] == video_id]
        if len(video) == 0:
            abort(404)
        video = video[0]
        args = self.reqparse.parse_args()
        for k, v in args.items():
            if v is not None:
                video[k] = v
        return {'video': marshal(video, video_fields)}

    def delete(self, video_id):
        video = [video for video in videos if video['video_id'] == video_id]
        if len(video) == 0:
            abort(404)
        videos.remove(video[0])
        return {'result': True}

api.add_resource(UserListAPI, '/eduvideo/users', endpoint='users')
api.add_resource(UserAPI, '/eduvideo/users/<_id>', endpoint='user')

api.add_resource(ChannelListAPI, '/eduvideo/channels', endpoint='channels')
api.add_resource(ChannelAPI, '/eduvideo/channels/<_id>', endpoint='channel')

api.add_resource(VideoListAPI, '/eduvideo/videos', endpoint='videos')
api.add_resource(VideoAPI, '/eduvideo/videos/<video_id>', endpoint='video')


if __name__ == '__main__':
    app.run(debug=True)


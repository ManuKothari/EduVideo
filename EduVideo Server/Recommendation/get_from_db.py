from pymongo import MongoClient

client = ''
db = ''
user_info = ''

user_data = dict()

def connect_db():
	
	global client, db, user_info
	
	client = MongoClient()
	
	if client:
		
		"Successfully connected to db"
		
	else:
		
		exit(0)
		
	db = client.eduvideo
	
	user_info = db.user




def get_data_from_db():
	
	cursor = db.restaurants.find()
	
	with open("User_info.txt","w") as f:
	
		for doc in cursor:
				
				user = doc[user]
				
				#considering each has list of video and it's rating
				
				video_id = doc[video_id]
				
				rates = doc[video_id][rates]
				
				viewCount = doc[video_id][view_count]
			
				#yet to finish
			
			

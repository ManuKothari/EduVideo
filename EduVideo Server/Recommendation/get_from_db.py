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


def write_in_file(user, list_of_weight):
	
	with open("User_info.txt", "w"):
		
			f.write("\n"+user+">")
		
			for i in list_of_weight:
				
				for j in i[0]:
					
					f.write(j[0]+":"+i[1]+"\t")
					
			f.write("\n")


def get_data_from_db():
	
	cursor = db.restaurants.find()
	
	for doc in cursor:
		
		user = doc[user]

				#a list of videos rated good 
				
		Good = doc[good]
				
				#a list of videos rated avg 
				
		Avg= doc[avg]
				
				#a list of videos rated poor 
				
		Poor = doc[poor]
				
				#a list of videos rated viewed 
				
		view = doc[view]
		
		write_in_file('user' [(Good,8), (avg,6), (view,4), (Poor,1)])
				
				
				
				
		
				
	
		
				
			
			
			
			

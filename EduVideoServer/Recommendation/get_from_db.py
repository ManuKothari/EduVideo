from pymongo import MongoClient

client = ''

db = ''

user_info = ''

user_data = dict()

def connect_db():
	
	global client
	
	global db
	
	try:

	    client = MongoClient('mongodb://admin:root@ds055564.mlab.com:55564/eduvideo',serverSelectionTimeoutMS=10000)

	    client.server_info()

	    print("Connceted to MongoDB@online")

	except:

	    client = MongoClient()

	    print("Connected to MongoDB@localhost");

	db = client.eduvideo




def write_in_file(user, list_of_weight):
	
	with open("User_info.txt", "a") as f:
		
			f.write("\n"+str(user)+">")
		
			for i in list_of_weight:
				
				for j in i[0]:
					
					f.write(str(j)+":"+str(i[1])+"\t")
					
			f.write("\n")


def get_data_from_db():
	
	cursor = db.user.find()
	
	if cursor:
	
		print "inside get data from db"
	
	for doc in cursor:
		
		print doc
		
		user = doc['_id'] #a list of videos rated good 
				
		Good = doc['rates']['good'] #a list of videos rated avg 
				
		print "Good", Good	
				
		Avg= doc['rates']['avg'] #a list of videos rated poor
				
		print "Avg", Avg		 
				
		Poor = doc['rates']['poor'] #a list of videos rated viewed 
				
		print "Poor", Poor		
				
		#view = doc['view_count']
		
		write_in_file(user, [[Good,8], [Avg,6], [Poor,-1]])
				
				
connect_db()			
				
get_data_from_db()	
				
	
		
				
			
			
			
			

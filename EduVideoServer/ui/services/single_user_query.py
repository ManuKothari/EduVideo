import sys

from get_nearest_neighbours import * 

current_user = sys.argv[1]

#current_user = "5719b3f20a9ded0d89b7c739"

def get_recommendation(current_user):
	
	cursor = db.user.find()
	
	for doc in cursor:
		
		user = doc['_id']
		
		if str(user) == str(current_user):
			
			get_nearest_neighbours(user_vector[str(user)])

get_recommendation(current_user)

						

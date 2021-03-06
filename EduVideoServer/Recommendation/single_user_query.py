
from get_nearest_neighbours import * 

current_user = sys.argv[1]

def get_recommendation(current_user):
	
	cursor = db.user.find()
	
	for doc in cursor:
		
		user = doc['_id']
		
		if user == current_user:

			Good = doc['rates']['good'] 	
				
			Avg= doc['rates']['avg'] 	 
				
			Poor = doc['rates']['poor'] 
				
			list_of_weight = [[Good,8], [Avg,6], [Poor,-1]]
		
			with open("current_user_info.txt", "w") as f:
		
				f.write("\n"+str(user)+">")
		
				for i in list_of_weight:
				
					for j in i[0]:
					
						f.write(str(j)+":"+str(i[1])+"\t")
					
				f.write("\n")

			with open("current_user_info.txt","r") as f:
		
				for line in f.readlines():
			
					line = line.strip()
			
					data = line.split(">")
			
					if len(data) > 1:
			
						user = data[0].strip()
			
						list_of_vid = data[1]
					else:
						user = data[0].strip()
			
						list_of_vid = []

			list_of_watched_videos = []
	
			if list_of_vid:
	
				vid_rat_pair = list_of_vid.split("\t")
	
				for pair in vid_rat_pair:
		
					list_of_watched_videos.append((pair.split(":")[0],pair.split(":")[1]))
		
					list_of_videos.add(pair.split(":")[0])
		
			current_user_rating[user] = list_of_watched_videos

			for user in current_user_rating:
		
				current_user_vector[user] = [0 for i in range(len(list_of_videos))]
		
				for vid in range(len(list_of_videos)):
			
					for v_id in user:
				
						if list_of_videos[vid] == v_id[0]:
					
							current_user_vector[user][vid] = v_id[1]
					
				current_user_vector[user] = np.array(user_vector[user],dtype=float)

			return get_nearest_neighbours(current_user_vector[user])

get_recommendation(current_user)

						

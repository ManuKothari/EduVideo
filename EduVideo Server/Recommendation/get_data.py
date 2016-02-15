
user_rating = dict()

list_of_videos = set()

def assign_rating(user, videos):
	
	list_of_watched_videos = []
	
	vid_rat_pair = videos.split("\t")
	
	for pair in vid_rat_pair:
		
		list_of_watched_videos.append((pair.split(":")[0],pair.split(":")[1]))
		
	user_rating[user] = list_of_watched_videos
	

'''
each line will be of the form :

user_id> vid_id1:rating	vid_id2:rading  and so on 

'''

def read_from_file():
	
	with open("somefile.txt","r") as f:
		
		for line in f.readlines():
			
			line = line.strip()
			
			data = line.split(">")
			
			user = data[0].strip()
			
			list_of_vid = data[1]
			
			assign_ratings(user, list_of_vid)

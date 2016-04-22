from get_from_db import *

user_rating = dict()

list_of_videos = set()

def assign_rating(user, videos):
	
	list_of_watched_videos = []
	
	if videos:
	
		vid_rat_pair = videos.split("\t")
	
		for pair in vid_rat_pair:
		
			list_of_watched_videos.append((pair.split(":")[0],pair.split(":")[1]))
		
			list_of_videos.add(pair.split(":")[0])
		
	user_rating[user] = list_of_watched_videos
	

'''
each line will be of the form :

user_id> vid_id1:rating	vid_id2:rading  and so on 

'''

def read_from_file():
	
	with open("User_info.txt","r") as f:
		
		for line in f.readlines():
			
			line = line.strip()
			
			data = line.split(">")
			
			if len(data) > 1:
			
				user = data[0].strip()
			
				list_of_vid = data[1]
			else:
				user = data[0].strip()
			
				list_of_vid = []
			
			assign_rating(user, list_of_vid)

read_from_file()
print user_rating

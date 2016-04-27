import numpy as np
import scipy
import unittest
from nearpy import Engine
from nearpy.distances import CosineDistance
from nearpy.hashes import RandomBinaryProjections, RandomBinaryProjectionTree, HashPermutations, HashPermutationMapper
from get_data import *
import time
from redis import Redis
from nearpy.storage import RedisStorage
'''

user_rating -  Mapping between userid and map ( video id and and it's rating)
list_of_videos - Dimension of each vector


'''


list_of_videos = list(list_of_videos)
#mapping of user_id to user_vector
user_vector = dict()

k_dimen = len(list_of_videos)

total_num_of_users_per_cluster = len(list_of_videos)/5

d_dimen = 5

for k in range(0,100):

	if total_num_of_users_per_cluster  <= 2**k:

		d_dimen = k-1

		break

def get_user_vectors():
	
	for user in user_rating:
		
		user_vector[user] = [0 for i in range(len(list_of_videos))]
		
		for vid in range(len(list_of_videos)):
			
			for v_id in user:
				
				if list_of_videos[vid] == v_id[0]:
					
					user_vector[user][vid] = v_id[1]

					
		user_vector[user] = np.array(user_vector[user],dtype=float)


#yet to check storing on to mongo		
		
def index_user_vectors():
	
	#print 'Performing indexing with HashPermutations...'
	
	global engine_perm 
	
	t0 = time.time()
	
	#print k_dimen, d_dimen
	
	rbp_perm = RandomBinaryProjections('rbp_perm', d_dimen)
	
	rbp_perm.reset(k_dimen)
	
	# Create permutations meta-hash
	permutations = HashPermutations('permut')
	
	rbp_conf = {'num_permutation':50,'beam_size':10,'num_neighbour':250}
	
        # Add rbp as child hash of permutations hash
	permutations.add_child_hash(rbp_perm, rbp_conf)
	
        # Create engine
        engine_perm = Engine(k_dimen, lshashes=[permutations], distance=CosineDistance())
    
	for u in user_vector:
		
		engine_perm.store_vector(user_vector[u], data=u)
		
	 # Then update permuted index
        permutations.build_permuted_index()
    
	t1 = time.time()
	
	#print 'Indexing took %f seconds', (t1-t0)

def get_nearest_neighbours(query):

	#print '\nNeighbour distances with HashPermutations:'

        #print '  -> Candidate count is ', engine_perm.candidate_count(query)

        results = engine_perm.neighbours(query)

        dists = [(x[1], x[2]) for x in results]

	similar_users = [x[1] for x in results]

        print similar_users		
        		
def begin_form_LSH():
	   
	get_user_vectors()

	index_user_vectors()

begin_form_LSH()


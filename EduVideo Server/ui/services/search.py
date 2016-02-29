import math, nltk, re
from nltk.tokenize import word_tokenize
from nltk.stem import WordNetLemmatizer
from nltk.corpus import stopwords
from bson.objectid import ObjectId
from pymongo import MongoClient
import collections

client = MongoClient()
db = client.eduvideo
video_col = db.video
user_col = db.user

stop = stopwords.words('english')
punct = ["-","(",")","_",","]
for i in punct:
	stop.append( i )
#del stop[stop.index('out')]
wordnet_lemmatizer = WordNetLemmatizer()

def clean(di):
	doc = [x for x in word_tokenize( str(di) ) if x not in stop]
	newdoc = []
	for word in doc:
		try:
			if( wordnet_lemmatizer.lemmatize(word) ):
				newdoc.append(str(word))
		except UnicodeDecodeError as u:
			print("-----------------------------------------------------")	
	return newdoc

def tf(t,d):
	return d.count(t)

def idf(t,d):
	N = len(d)
	D = 0
	for doc in d:
		if t in doc:
			D = D + 1
	if D == 0:
		return 0
	return math.log(N/D)

def tfidf(t,d,D):
	return tf(t,d) * idf(t,D)

def score(q,d,D):
	terms = clean(q)
	s = 0.0
	plural = set()
	for term in terms:
		if( len(term) > 2 and term[-1] != "s" and term[-2:] != "ed" and term[-3:] != "ing" ):
			if( term[-1] == "y" ):                                                             #Plural  
				if( term[-2] not in ['a','e','i','o','u'] ):
					plural.add( term[:-1] + "ies" )
				else:
					plural.add( term + "s" )
			elif( (term[-1] == "h" and term[-2] in ["s","c"]) or term[-1] in ["x","z","s"] ):
				plural.add( term + "es" )
			else:
				plural.add( term + "s" )
		elif( len(term) > 2 and term[-1] == "s" ):                                                 #Singular 
			plural.add( term[:-1] )
		elif( len(term) > 4 and term[-3:] == "ing" ):                                              #ing
			plural.add( str( wordnet_lemmatizer.lemmatize( term, 'v' ) ) )
				
	for t in plural:
		if t not in terms:
			terms.append( t )
	#print( terms )
	for term in terms:
		x = tfidf(term,d,D)
		s += x
	return s


def tfsearch( query ):
	ranks = []
	vidoc = {}
	with open('vidnm.txt', 'r') as f:
		documents = f.read().split("\n")[:-1]
		docs = []		
		for vid in documents:
			doc = vid.split(" $@$ ")[1]
			d = clean( doc )
			docs.append( d )
			vidoc[ " ".join( d ) ] = vid			#For verification alone, will return only ids later
	for d in docs:
		docscore = score( query, d, docs )
		ranks.append( [ vidoc[ " ".join( d ) ] , docscore ] )
	ranks = sorted( ranks, key = lambda x: x[1], reverse=True )
	return ranks[:10]


def simple_search( query ):
	res = tfsearch( query )
	for i in range(0, len( res ) ):
		vid = res[i][0].split(" $@$ ")[ 0 ]
		res[i][1] *= 10
		v = video_col.find_one( {'_id': ObjectId( vid ) } )
		rank = v['rates']['good']*3 + v['view_count']*2 + v['rates']['avg'] - v['rates']['poor']
		res[i][1] += rank
	res = sorted( res, key = lambda x: x[1], reverse=True )
	return res

def wrds( sent, qset ):
	for wrd in sent.split(" "):
		qset.add( wrd )

def personalized_search( query, user_id ):
	u = user_col.find_one( {'_id': ObjectId( user_id ) } )
	newquery = set()
	wrds( query, newquery )
	with open('vidnm.txt', 'r') as f:
		documents = f.read().split("\n")[:-1]
		for h in u['history']:
			for vid in documents:
				v = vid.split(" $@$ ")[0]
				if(v == h):
					wrds( vid.split(" $@$ ")[1], newquery )
	newquery = " ".join( list( newquery ) )
	res = tfsearch( newquery )
	for i in range(0, len( res ) ):
		vid = res[i][0].split(" $@$ ")[ 0 ]
		res[i][1] *= 10
		v = video_col.find_one( {'_id': ObjectId( vid ) } )
		rank = v['rates']['good']*3 + v['view_count']*2 + v['rates']['avg'] - v['rates']['poor']
		if( vid in u['rates']['good'] ):
			rank += 6
		elif( vid in u['rates']['avg'] ):			
			rank += 1
		elif( vid in u['rates']['poor'] ):			
			rank -= 2
		res[i][1] += rank
	res = sorted( res, key = lambda x: x[1], reverse=True )
	return res	
	

def main():
	
	while True:
		query = raw_input("\nEnter the query (To quit: Enter 'q'): ").lower()
		if query == "q":
			break	
		res = personalized_search( query, "56cffd440a9ded124a720d96" )
		print "Query Results: \n"
		for doc, rank in res:
			print "Document: {0}\nRank: {1}".format(doc, rank)
		
main()


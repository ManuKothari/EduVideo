with open('attributeMapData') as inputfile:
	for line in inputfile:
		data,dbid = line.split('\t')
		print data, dbid
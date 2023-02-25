init:
	symfony console d:d:d --force
	symfony console d:d:c
	symfony console d:m:m
	symfony console push:stats
	symfony console push:items
import datetime
from sys import argv

timestamp = argv
timestamp = int(timestamp[1])
value = datetime.datetime.fromtimestamp(timestamp)
print(value.strftime('%H:%M'))

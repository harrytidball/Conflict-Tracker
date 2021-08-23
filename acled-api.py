import requests
from datetime import datetime, time

def toTextFile(file_name, type):
    textfile = open(file_name, "w", encoding="utf8")
    for x in range(len(type)):
        textfile.write(str(type[x]) + "\n")
    textfile.close()

URL = "https://api.acleddata.com/acled/read"

PARAMS = {
    'key': "*AdNpEvCqZWct!QnK7pT",
    'email': "harry2.tidball@live.uwe.ac.uk",
    'event_date': "2021-07-30"
    }

response = requests.get(url=URL, params=PARAMS)

lat = []
lng = []
date = []
type = []
country = []
region = []
location = []
source = []
notes = []
fatalities = []
timestamp = []
actor_one = []
actor_two = []

for data in response.json()['data']:
    lat.append(data['latitude'])
    lng.append(data['longitude'])
    date.append(data['event_date'])
    type.append(data['event_type'])
    country.append(data['country'])
    region.append(data['region'])
    location.append(data['location'] + ", " + data['country'])
    source.append(data['source'])
    notes.append(data['notes'])
    fatalities.append(data['fatalities'])
    timestamp.append(data['timestamp'])
    actor_one.append(data['actor1'])
    actor_two.append(data['actor2'])

for x in range(len(timestamp)):
    timestamp[x] = datetime.fromtimestamp(int(timestamp[x])).strftime("%H:%M")

print(timestamp)

for x in range(len(type)):
    if type[x] == "Protests":
        lat[x] = None
        lng[x] = None
        date[x] = None
        type[x] = ""
        country[x] = None
        region[x] = None
        location[x] = None
        source[x] = None
        notes[x] = None
        fatalities[x] = None
        timestamp[x] = None
        actor_one[x] = None
        actor_two[x] = ""

icons = []

for x in range(len(type)):
    if type[x] == "Violence against civilians":
        icons.append("strike")
    elif type[x] == "Riots":
        icons.append("revolt")
    elif type[x] == "Strategic developments":
        icons.append("administration")
    elif type[x] == "Battles":
        icons.append("shooting")
    elif type[x] == "Explosions/Remote violence":
        icons.append("bomb")
    elif type[x] == "":
        icons.append("")

for x in range(len(actor_one)):
    if actor_one[x] == actor_two[x]:
        actor_two[x] = ""

for x in range(len(actor_two)):
    if len(actor_two[x]) > 0:
        actor_two[x] = " vs. " + actor_two[x]

toTextFile("text-files/lat.txt", lat)
toTextFile("text-files/lng.txt", lng)
toTextFile("text-files/date.txt", date)
toTextFile("text-files/type.txt", type)
toTextFile("text-files/country.txt", country)
toTextFile("text-files/region.txt", region)
toTextFile("text-files/location.txt", location)
toTextFile("text-files/source.txt", source)
toTextFile("text-files/notes.txt", notes)
toTextFile("text-files/fatalities.txt", fatalities)
toTextFile("text-files/timestamp.txt", timestamp)
toTextFile("text-files/actor_one.txt", actor_one)
toTextFile("text-files/actor_two.txt", actor_two)
toTextFile("text-files/icon.txt", icons)

print("Success")
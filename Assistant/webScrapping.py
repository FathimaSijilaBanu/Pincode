import webbrowser
import requests
from bs4 import BeautifulSoup
import threading
import smtplib
import urllib.request
import os
from geopy.geocoders import Nominatim
from geopy.distance import great_circle

def maps(text):
	text = text.replace('maps', '')
	text = text.replace('map', '')
	text = text.replace('google', '')
	openWebsite('https://www.google.com/maps/place/'+text)

def giveDirections(startingPoint, destinationPoint):

	geolocator = Nominatim(user_agent='assistant')
	if 'current' in startingPoint:
		res = requests.get("https://ipinfo.io/")
		data = res.json()
		startinglocation = geolocator.reverse(data['loc'])
	else:
		startinglocation = geolocator.geocode(startingPoint)

	destinationlocation = geolocator.geocode(destinationPoint)
	startingPoint = startinglocation.address.replace(' ', '+')
	destinationPoint = destinationlocation.address.replace(' ', '+')

	openWebsite('https://www.google.co.in/maps/dir/'+startingPoint+'/'+destinationPoint+'/')

	startinglocationCoordinate = (startinglocation.latitude, startinglocation.longitude)
	destinationlocationCoordinate = (destinationlocation.latitude, destinationlocation.longitude)
	total_distance = great_circle(startinglocationCoordinate, destinationlocationCoordinate).km #.mile
	return str(round(total_distance, 2)) + 'KM'

def openWebsite(url='https://www.google.com/'):
	webbrowser.open(url)

def jokes():
	URL = 'https://icanhazdadjoke.com/'
	result = requests.get(URL)
	src = result.content

	soup = BeautifulSoup(src, 'html.parser')

	try:
		p = soup.find('p')
		return p.text
	except Exception as e:
		raise e

def youtube(query):
	from youtube_search import YoutubeSearch
	query = query.replace('play',' ')
	query = query.replace('on youtube',' ')
	query = query.replace('youtube',' ')
	results = YoutubeSearch(query,max_results=1).to_dict()
	webbrowser.open('https://www.youtube.com/watch?v=' + results[0]['id'])
	return "Enjoy Sir..."


def googleSearch(query):
	if 'image' in query:
		query += "&tbm=isch"
	query = query.replace('images','')
	query = query.replace('image','')
	query = query.replace('search','')
	query = query.replace('show','')
	webbrowser.open("https://www.google.com/search?q=" + query)
	return "Here you go..."

def sendWhatsapp(phone_no='',message=''):
	phone_no = '+91' + str(phone_no)
	webbrowser.open('https://web.whatsapp.com/send?phone='+phone_no+'&text='+message)
	import time
	from pynput.keyboard import Key, Controller
	time.sleep(10)
	k = Controller()
	k.press(Key.enter)

def email(rec_email=None, text="Hello, It's F.R.I.D.A.Y. here...", sub='F.R.I.D.A.Y.'):
	if '@gmail.com' not in rec_email: return
	s = smtplib.SMTP('smtp.gmail.com', 587)
	s.starttls()
	s.login("sender_email", "sender_password")
	message = 'Subject: {}\n\n{}'.format(sub, text)
	s.sendmail("sender_email", rec_email, message)
	print("Sent")
	s.quit()


def downloadImage(query, n=4):
	query = query.replace('images','')
	query = query.replace('image','')
	query = query.replace('search','')
	query = query.replace('show','')
	URL = "https://www.google.com/search?tbm=isch&q=" + query
	result = requests.get(URL)
	src = result.content

	soup = BeautifulSoup(src, 'html.parser')
	imgTags = soup.find_all('img', class_='t0fcAb')

	if os.path.exists('Downloads')==False:
		os.mkdir('Downloads')

	count=0
	for i in imgTags:
		if count==n: break
		try:
			urllib.request.urlretrieve(i['src'], 'Downloads/' + str(count) + '.jpg')
			count+=1
			print('Downloaded', count)
		except Exception as e:
			raise e

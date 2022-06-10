import sys  #系統用的lib
import requests #HTTP GET元件
import json     #解譯json元件
import time     ##時間用的lib
import datetime #時間用的lib
from datetime import datetime       #轉unix time to date time 用的lib
import math     #數學用的lib
import os      #作業系統元件
import http.client  #網頁連線物件lib
import unicodedata  #解unicode用的lib
from pathlib import Path   #解路徑用的lib
import numpy as np
import matplotlib.pyplot as plt

from requests.exceptions import HTTPError       #連線錯誤的lib

# mac = input("請輸入您要查詢裝置的網卡編號(MAC):")
# dt1 = input("請您輸入查詢起始日期(當年月最後日):")
# dt2 = input("請您輸入查詢結束日期(當年月最後日):")
mac = "CC50E3B5BB20"
dt1 = "20220406"
dt2 = "20220430"


#http://localhost:8088/fcu/dhtdata/dht2jsonwithdate.php?MAC=246F289E48D4&start=20210101&end=20211231
url1="http://localhost:8000/cloud/visual/dhtdata/dht2jsonwithdate.php?MAC=%s&start=%s&end=%s"
url = url1 % (mac,dt1,dt2)

print(mac)
print("-----------------------")
print(dt1,"~",dt2)
print("-----------------------")
print(url1)
print("-----------------------")
print(url)
print("========================")

try:
	res = requests.get(url)     #使用http Get將http Get 之資料擷取之連線URL 傳入連線物件，進行連線
	res.raise_for_status()      #使用http Get將http Get 狀態讀回
except HTTPError as http_err:
	print('HTTP error occurred: {http_err}')
	sys.exit(0)
except Exception as err:
	print('Other error occurred: {err}')
	sys.exit(0)
else:
	print('Success!')
	# print(res.content.decode('utf-8'))
	table=json.loads(res.content.decode('utf-8'))       

print("----------------------")

s01 = table['Device']   #json的device的MAc
s02 = table['Datalist'] #抓Temperature的ARRAY裡面






datet=[]
dateh=[]
tmp=int(s02[0]["Datetime"])
# origin
Temperature = []
Humidity = []
Datetime =[]
i=0
da=[]
for x in s02:
	d01 = x["Datetime"] 
	d02 = x["Temperature"] 
	d03 = x["Humidity"]
	if int(x["Datetime"])-tmp>1000000:
		datet.append(Temperature)
		Temperature=[]
		dateh.append(Humidity)
		Humidity=[]
		tmp=int(d01)
		da.append(str(d01))
	else:
		Datetime.append(float(d01))
		Temperature.append(float(d02))
		Humidity.append(float(d03))
		print(d01,float(d02),d03)

print(datet[1])

data=[]
labels=[]
for i in datet:
	data.append(i)

for i in da:
	labels.append(i[4:8])

plt.rcParams["font.family"] = ["Microsoft JhengHei"]
plt.rcParams["axes.unicode_minus"] = False
np.random.seed(10)
plt.boxplot(data,labels=labels)
plt.title("Temperature",fontsize=16,color='b')
plt.show() 


data=[]
for i in dateh:
	data.append(i)


plt.rcParams["font.family"] = ["Microsoft JhengHei"]
plt.rcParams["axes.unicode_minus"] = False
np.random.seed(10)
plt.boxplot(data,labels=labels)
plt.title("Humidity",fontsize=16,color='b')
plt.show() 



      



      

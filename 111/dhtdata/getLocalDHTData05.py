import matplotlib.pyplot as plt
import sys	#作業系統套件，用於檔案、目錄資料使用
import requests	#建立雲端WinSocket連線的套件
import json	#了解json內容的json物件的套件
import time	#系統時間套件
import datetime	#時鐘物件
import math	#數學運算套件
import os	# #作業系統套件，用於檔案、目錄資料使用
import http.client	#winsock連線物件之討建
import unicodedata	#Unicode
from pathlib import Path	#存取檔案路徑之套件

from requests.exceptions import HTTPError
xdata=[]
y1data=[]
y2data=[]
#http://localhost:8088/fcu/dhtdata/dht2jsonwithdate.php?MAC=3C71BFFD882C&start=20210101&end=20211231
#可以用下面SQL語法，進行擷取筆數
# select  MAC, count(*) as cnt from dhtdata  where 1 group by MAC  order by MAC
url1 = "http://localhost:8000/cloud/111/dht2jsonwithdate.php?MAC=%s&start=%s&end=%s"
#dt = input("請您輸入查詢日期(當年月最後日):")
mac = input("請您輸入查詢裝置網路卡編號(MAC Address):")
dt1 = input("請您輸入查詢開始日期(YYYYMMDD):")
dt2 = input("請您輸入查詢結束日期(YYYYMMDD):")
url = url1 % (mac,dt1,dt2)  #將輸入資料：MAC，DT1、DT2與URL1(php網址)整合再一起，組成要求資料的Restful API
 #將輸入資料：MAC，DT1、DT2與URL1(php網址)整合再一起，組成要求資料的Restful API
print(url)
#MAC=3C71BFFD882C
#    083AF24406C4
#start=20210101
#end=20211231

#20210429025837
#20210429031100
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
    table=json.loads(res.content.decode('utf-8'))    
    print(json.dumps(table, sort_keys=True, indent=4)) 
    #用json beauty 方式顯示
    
s01 = table['Device']  
s02 = table['Datalist'] # get datalist array]
olddate = ""
oldhour = ""
i=0
d1=[]
t=[]
for x in s02:
    d01 = x[ "Datetime"]
    d02 = x["Temperature"]
    d03 = x["Humidity"]
    print(d01,d02,d03)
    newdate = "%s/%s" % (d01[4:6],d01[6:8])
    newhour = d01[8:10]
    if (newdate != olddate):
        d1.append(y1data)
        y1data=[]
        xtmp = newdate
        olddate = newdate
    else:
        if (newhour != oldhour):
            xtmp = "%s:%s:%s" % (d01[8:10],d01[10:12],d01[12:14])
            oldhour = newhour 
        else:
            xtmp = "%s:%s" % (d01[10:12],d01[12:14])
    
    print("%s/%s %s:%s:%s" % (d01[4:6],d01[6:8],d01[8:10],d01[10:12],d01[12:14]))
    print("------",xtmp)
    xdata.append(xtmp)
    y1data.append(float(d02))
    y2data.append(float(d03))

#print(xdata)
#print(y1data)
#print(y2data)

plt.plot(xdata, y1data, color='c')          # 設定青色cyan            
plt.plot(xdata, y2data, color='r')          # 設定紅色red
plt.show()



# # # ch16_3.py
# import matplotlib.pyplot as plt
# import numpy as np

# plt.rcParams["font.family"] = ["Microsoft JhengHei"]
# plt.rcParams["axes.unicode_minus"] = False
# np.random.seed(10) 
# data1 = np.random.normal(80, 30, 250) 
# data2 = np.random.normal(90, 50, 250) 
# data3 = np.random.normal(100, 20, 250) 
# data4 = np.random.normal(75, 40, 250) 
# data5 = np.random.normal(60, 35, 250)
# data = [data1, data2, data3, data4, data5] 
# labels = ['data1','data2','data3','data4','data5']
# plt.boxplot(data,labels=labels)
# plt.title("5 組數據的箱線圖",fontsize=16,color='b')
# plt.show() 



      

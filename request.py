import requests
import json

url1 = {"url":"https://opendata.cwb.gov.tw/api/v1/rest/datastore/A-B0062-001?timeFrom=2023-08-01", "api_name":"日出日沒時刻資料API"} #日出日沒時刻資料API

url2 = {"url":"https://opendata.cwb.gov.tw/api/v1/rest/datastore/A-B0063-001?timeFrom=2023-08-01", "api_name":"月出月沒時刻資料API"} #月出月沒時刻資料API

url3 = {"url":"https://opendata.cwb.gov.tw/fileapi/v1/opendataapi/F-B0053-067?Authorization=CWB-CAC27F1E-62D1-4465-80A0-D9830AE72D11&downloadType=WEB&format=JSON", "api_name":"育樂天氣預報資料"} #育樂天氣預報資料-觀星一週24小時天氣預報(中文)

url4 = {"url":"https://opendata.cwb.gov.tw/fileapi/v1/opendataapi/F-C0032-003?Authorization=CWB-CAC27F1E-62D1-4465-80A0-D9830AE72D11&downloadType=WEB&format=JSON", "api_name":"一般天氣預報-七天天氣預報"} #一般天氣預報-七天天氣預報

headers = {
    "Authorization": "CWB-CAC27F1E-62D1-4465-80A0-D9830AE72D11"
}


url=url1     #要抓甚麼資料改這裡的url

response = requests.get(url["url"], headers=headers)


if response.status_code == 200:
    
    data = response.json()
    print(data)
    with open(url["api_name"]+".json", "w") as json_file:
        json.dump(data, json_file)
else:
    print(f"Request failed with status code {response.status_code}")
    
    
url=url2     #要抓甚麼資料改這裡的url

response = requests.get(url["url"], headers=headers)


if response.status_code == 200:
    
    data = response.json()
    print(data)
    with open(url["api_name"]+".json", "w") as json_file:
        json.dump(data, json_file)
else:
    print(f"Request failed with status code {response.status_code}")

url=url3     #要抓甚麼資料改這裡的url

response = requests.get(url["url"], headers=headers)


if response.status_code == 200:
    
    data = response.json()
    print(data)
    with open(url["api_name"]+".json", "w") as json_file:
        json.dump(data, json_file)
else:
    print(f"Request failed with status code {response.status_code}")

url=url4     #要抓甚麼資料改這裡的url

response = requests.get(url["url"], headers=headers)


if response.status_code == 200:
    
    data = response.json()
    print(data)
    with open(url["api_name"]+".json", "w") as json_file:
        json.dump(data, json_file)
else:
    print(f"Request failed with status code {response.status_code}")
    

    

from selenium import webdriver
from selenium.webdriver.common.by import By
from selenium.webdriver.edge.service import Service
from selenium.webdriver.support.wait import WebDriverWait
from selenium.webdriver.common.keys import Keys
from webdriver_manager.microsoft import EdgeChromiumDriverManager
from selenium.webdriver.support import expected_conditions as EC
import requests
from lib import *
url = "http://www.luxcorporationrr.com.br:8282/"
folder = "C:/Users/Alexandro/Repos/blackroute/app/Models/"
files = get_files_paths(folder)
datas = []
for file in files:
    datas_aux = []
    with open(file) as f:
        for line in f:
            if line.find('menu') != -1:
                datas_aux += [file[:-4].split('/')[-1].lower()+'s']
                aux = url + "api/tests/" + datas_aux[-1] + "/form"
                response = requests.get(aux)
                datas_aux += [response.json()]
                aux = url + "api/tests/" + datas_aux[-1] + "/tests"
                response = requests.get(aux)                                                                                                                                                                                                                                                                                                                                                                                              
                datas_aux += [response.json()]
                break
input('Pre Processamento Pronto?')
options = webdriver.EdgeOptions()
with webdriver.Edge(service=Service(EdgeChromiumDriverManager().install()), options=options) as a9:
    a9.get(url)
    login_screen(a9, 10)
    input("Fim...")
if __name__ == '__main__' :
    pass